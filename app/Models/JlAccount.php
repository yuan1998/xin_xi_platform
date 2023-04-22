<?php

namespace App\Models;

use App\Clients\JlClient;
use App\Constants\RunStatus;
use App\Traits\HasAccountToken;
use Carbon\Carbon;
use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class JlAccount extends Model
{
    use HasFactory;
    use HasDateTimeFormatter;
    use HasAccountToken;

    protected $fillable = [
        "advertiser_id",
        "advertiser_name",
        "rebate",
        "comment",
        "app_id",
        "token_id",
        "log",
        "advertiser_role",
        "enable_robot",

        'run_status',
        'run_status_log',
        'run_date',
    ];

    public function app()
    {
        return $this->hasOne(JlApp::class, 'id', 'app_id');
    }


    public function refreshToken()
    {
        $token = $this->getToken();
        $refreshToken = data_get($token, 'refresh_token');
        $result = null;
        if ($refreshToken) {
            $result = JlClient::refreshToken($refreshToken, $this->app);
        }
        $token = data_get($result, 'access_token');
        if ($token)
            static::saveToken($result, $this->token_id);
        return $result;
    }


    public static function saveToken(array $data, $key = null): array
    {
        $expires_in = Carbon::now()->addSeconds($data['expires_in']);
        $refresh_token_expires_in = Carbon::now()->addSeconds($data['refresh_token_expires_in']);

        $data = [
            'access_token' => $data['access_token'],
            'refresh_token' => $data['refresh_token'],
            'expires_in' => $expires_in,
            'refresh_token_expires_in' => $refresh_token_expires_in,
        ];
        return static::saveTokenCache($data, $key);
    }

    /**
     * @param $tokenInfo array [refresh_token,access_token,refresh_token_expires_in,expires_in,status]
     * @param $appModel JlApp
     * @return array
     */
    public static function makeAccount(array $tokenInfo, JlApp $appModel): array
    {
        [$tokenKey, $token] = static::saveToken($tokenInfo);
        $info = JlClient::getAccountAuth($tokenInfo['access_token'], $appModel);
        $list = data_get($info, 'data.list');

        if ($list) {
            $arr = [];
            foreach ($list as $item) {
                $advertiser = array_merge($item, [
                    'token_id' => $tokenKey,
                    'app_id' => $appModel->id,
                ]);

                $model = static::updateOrCreate([
                    'advertiser_id' => $advertiser['advertiser_id'],
                ], $advertiser);

                $arr[$model->advertiser_name] = $model->advertiser_id;
            }
            return [null, $arr];
        }
        return [data_get($info, 'message', '授权错误.请重试'), null];
    }

    public function getChildAccountReportData($token, $startDate, $endDate): array
    {

        $list = [];
        switch ($this['advertiser_role']) {
            case 1 :
                $list[] = [
                    'advertiser_id' => $this->advertiser_id,
                    'advertiser_name' => $this->advertiser_name,
                    'access_token' => $token,
                ];
                break;
            case 2:
                $majordomoChild = JlClient::getMajordomoAccount($this->advertiser_id, $token);
                $list = data_get($majordomoChild, 'data.list');

                if ($list) {
                    foreach ($list as $item) {
                        $list[] = [
                            'advertiser_id' => $item['advertiser_id'],
                            'advertiser_name' => $item['advertiser_name'],
                            'access_token' => $token,
                        ];
                    }
                }
                break;
            default:
                Log::error("未知的角色",[$this['advertiser_role']]);
                return ["未知的角色.无法获取账户.",null];
        }
        if(!$list ||!count($list))
            return ["无法获取账户.{$this['advertiser_name']}",null];


        $messages = [];
        $data = [];
        foreach ($list as $account) {
            $id = $account['advertiser_id'];
            [$msg, $result] = JlClient::getAdvertiserPlanData([
                'advertiser_id' => $id,
                'start_date' => $startDate,
                'end_date' => $endDate
            ], $token);
            [$newMsg, $newResult] = JlClient::getNewVersionAdvertiserPlanData([
                'advertiser_id' => $id,
                "start_time" => $startDate,
                "end_time" => $endDate,
            ], $token);

            if ($msg)
                $messages[] = "$id : $msg";
            if ($result && count($result))
                $data = array_merge($data, $result);

            if ($newMsg)
                $messages[] = "新版 $id : $msg";
            if ($newResult && count($newResult)) {
                $newResult = collect($newResult)->map(function ($item) {
                    return [
                        "campaign_id" => data_get($item, 'dimensions.cdp_project_id'),
                        "campaign_name" => data_get($item, 'dimensions.cdp_project_name'),
                        "ad_id" => data_get($item, 'dimensions.cdp_promotion_id'),
                        "ad_name" => data_get($item, 'dimensions.cdp_promotion_name'),
                        "stat_datetime" => data_get($item, 'dimensions.stat_time_day'),
                        "cost" => data_get($item, 'metrics.stat_cost', 0),
                        "convert_cost" => data_get($item, 'metrics.conversion_cost', 0),
                        "avg_click_cost" => data_get($item, 'metrics.conversion_cost', 0),
                        "click" => data_get($item, 'metrics.cpc_platform', 0),
                        "convert_rate" => data_get($item, 'metrics.conversion_rate', 0),
                        "ctr" => data_get($item, 'metrics.ctr', 0),
                        "avg_show_cost" => data_get($item, 'metrics.cpm_platform', 0),
                        "convert" => data_get($item, 'metrics.convert_cnt', 0),
                        "show" => data_get($item, 'metrics.show_cnt', 0),
                    ];
                })->filter(function ($item) {
                    return $item['campaign_id'] && $item['ad_id'] && $item['stat_datetime'] && $item['cost'] && $item['convert'] && $item['show'];
                })->toArray();
                $data = array_merge($data, $newResult);
            }
        }

        return [$messages, $data];
    }

    public function getReportData($startDate, $endDate)
    {
        $this->run_date = now();
        $token = $this->getAccessToken();
        if ($token) {
            [$msg, $data] = $this->getChildAccountReportData($token, $startDate, $endDate);
            $this->run_status = RunStatus::OK_STATUS;
            $this->run_status_log = count($msg) ? implode(';', $msg) : '获取成功';

            if ($data)
                JlReportDatum::saveReportData($data);
        } else {
            $this->run_status = RunStatus::ERROR_STATUS;
            $this->run_status_log = "无效token,请重新授权";
        }

        $this->save();
        return $this->run_status_log;
    }

    public static function getAccountReportData($startDate, $endDate, $accounts = null): array
    {
        $accounts = $accounts ?: static::query()
            ->where('enable', 1)
            ->get();

        $msg = [];
        foreach ($accounts as $account) {
            $msg[$account['advertiser_name']] = $account->getReportData($startDate, $endDate);
        }
        return $msg;
    }

    public static function getReportOfToday(): array
    {
        $dateString = Carbon::today()->toDateString();
        return static::getAccountReportData($dateString, $dateString);
    }

    public static function getReportOfYesterday(): array
    {
        $dateString = Carbon::yesterday()->toDateString();
        return static::getAccountReportData($dateString, $dateString);
    }


    public static function test()
    {
        $account = static::find(4);
        $data = $account->getReportData('2023-04-14', '2023-04-14');
//        $majordomoChild = JlClient::getMajordomoAccount($account->advertiser_id, $token);
//        dd($majordomoChild);
        dd($data);

    }

}

<?php

namespace App\Models;

use App\Clients\BaiduClient;
use App\Constants\RunStatus;
use Carbon\Carbon;
use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaiduAccount extends Model
{
    use HasFactory;
    use HasDateTimeFormatter;

    protected $fillable = [
        'username',
        'token',
        'password',
        'type',
        'targets',
        'enable',
        'run_status',
        'run_status_log',
        'run_date',
        'masterUId',
        'accessToken',
        'refreshToken',
        'expires',
        'refExpires',
        'authType',
        'app_id',
        'subUserList',
    ];

    static $TypeOptions = [
        2 => '超管账户（客户中心和账户管家）',
        1 => '普通账户'
    ];
    static $AuthTypeOptions = [
        0 => 'Token',
        1 => 'OAuth2',
    ];

    protected $casts = [
        'subUserList' => 'json'
    ];

    public function app()
    {
        return $this->hasOne(BdApp::class, 'id', 'app_id');
    }

    public function getReportData($start, $end): string
    {
        $this->run_date = now();
        $this->run_status = RunStatus::OK_STATUS;
        [$error, $result] = BaiduClient::getAllTargets([
            "startDate" => $start,
            "endDate" => $end,
        ], $this);

        if (count($error)) {
            $this->run_status_log = implode(';', $error);
        } else {
            $this->run_status_log = '获取成功';
        }

        if ($result)
            BaiduReportData::saveReportData($result);

        $this->save();
        return $this->run_status_log;
    }


    public static function getAccountReportData($start, $end, $accounts = null): array
    {
        $accounts = $accounts ?: static::query()->where('enable', 1)->get();
        $result = [];
        foreach ($accounts as $account) {
            $result[$account->username] = $account->getReportData($start, $end);
        }
        return $result;
    }

    public static function getOauthAccountReportData($start, $end, $accounts = null): array
    {
        $accounts = $accounts ?: static::query()->where('authType', 1)
            ->where('enable', 1)
            ->get();
        $result = [];
        foreach ($accounts as $account) {
            $result[$account->username] = $account->getOauthReportDataOfDay($start, $end);
        }
        return $result;
    }

    public static function getReportOfToday(): array
    {
        $dateString = today()->toDateString();
        return static::getAccountReportData($dateString, $dateString);
    }

    public static function getReportOfYesterday(): array
    {
        $dateString = Carbon::yesterday()->toDateString();
        return static::getAccountReportData($dateString, $dateString);
    }

    public function oauthRefreshToken()
    {
        [$err, $data] = BaiduClient::refreshAccessToken([
            "userId" => $this->masterUId,
            "refreshToken" => $this->refreshToken,
        ], $this->app);
        if ($err) {
            $this->run_status = RunStatus::ERROR_STATUS;
            $this->run_status_log = "刷新令牌错误:$err";
            $this->save();
            return false;
        }

        $this->fill([
            'accessToken' => $data['accessToken'],
            'refreshToken' => $data['refreshToken'],
            'expires' => $data['expiresTime'],
            'refExpires' => $data['refreshExpiresTime'],
        ]);
        $this->save();
        return true;
    }

    public function getOauthToken()
    {
        if (!$this->accessToken) {
            $this->run_status = RunStatus::ERROR_STATUS;
            $this->run_status_log = "令牌不存在,重新授权";
            $this->save();
            return null;
        }
        if (now()->lte($this->expires)) {
            return $this->accessToken;
        }

        if (now()->gte($this->refExpires)) {
            $this->run_status = RunStatus::ERROR_STATUS;
            $this->run_status_log = "令牌过期,重新授权";
            $this->save();
            return null;
        }

        if ($this->oauthRefreshToken())
            return $this->accessToken;

        return null;
    }

    public function getOauthReportData($data)
    {
        $token = $this->getOauthToken();
        if (!$token) {
            return [$this->run_status_log, null];
        }

        return BaiduClient::getOauthReportData([
            "accessToken" => $token,
            "userName" => $this->username,
            "action" => "API-PYTHON"
        ], array_merge([
            'reportType' => 2290316,
            "timeUnit" => "DAY",
            "startRow" => 0,
            "rowCount" => 1000,
            "startDate" => "2023-04-13",
            "endDate" => "2023-04-15",
            'userIds' => '',
            'needSum' => null,
            'columns' => [
                "date",
                "userName",
                "campaignId",
                "campaignName",
                "impression",
                "click",
                "cost",
                "ctr",
                "cpc",
                "cpm",
                "bridgeConversion",
            ]
        ], $data));
    }

    public function getOauthReportDataOfDay($start, $end)
    {
        $this->run_date = now();
        [$errMsg, $data] = $this->getOauthReportData([
            "startDate" => $start,
            "endDate" => $end,
            'userIds' => collect($this->subUserList)->pluck('ucId')
        ]);

        if ($errMsg) {
            $this->run_status = RunStatus::ERROR_STATUS;
            $this->run_status_log = "{$this->username} : $errMsg";

            $this->save();
            return [$this->run_status_log, null];
        } else {
            $this->run_status = RunStatus::OK_STATUS;
            $this->run_status_log = "获取成功";
        }
        $this->save();
        return [null, $data];
    }

    public static function test()
    {
        $str = now()->toDateString();
        self::getOauthAccountReportData($str, $str);
    }

}

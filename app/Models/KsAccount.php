<?php

namespace App\Models;

use App\Clients\KsClient;
use App\Constants\RunStatus;
use App\Traits\HasAccountToken;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class KsAccount extends Model
{
    use HasFactory;
    use HasAccountToken;

    public $timestamps = false;

    protected $fillable = [
        "enable",
        "app_id",
        "run_date",
        "run_status",
        "run_status_log",
        "comment",
        "token_id",
        "advertiser_id",
        "user_id",
        "corporation_name",
        "user_name",
        "industry_id",
        "industry_name",
        "primary_industry_id",
        "primary_industry_name",
        "delivery_type",
        "effect_first",
    ];


    public function app()
    {
        return $this->hasOne(KsApp::class, 'id', 'app_id');
    }


    public static function saveToken(array $data, $key = null)
    {

        $expires_in = Carbon::now()->addSeconds($data['access_token_expires_in']);
        $refresh_token_expires_in = Carbon::now()->addSeconds($data['refresh_token_expires_in']);

        $arr = [
            'access_token' => $data['access_token'],
            'refresh_token' => $data['refresh_token'],
            'expires_in' => $expires_in,
            'refresh_token_expires_in' => $refresh_token_expires_in,
        ];
        return static::saveTokenCache($arr, $key);

    }

    public static function makeAccount($auth, $app)
    {
        [$tokenKey, $token] = self::saveToken($auth);
        $advertiserIds = data_get($auth, 'advertiser_ids');

        $count = 0;
        foreach ($advertiserIds as $advertiserId) {
            $accountResponse = KsClient::getAccountInfo($advertiserId, $token['access_token']);
            if ($accountResponse['code'] === 0) {
                $data = $accountResponse['data'];
                $data['token_id'] = $tokenKey;
                $data['app_id'] = $app['id'];
                static::updateOrCreate([
                    'advertiser_id' => $advertiserId
                ], $data);
                $count++;
            }
        }
        return $count;
    }

    public function getReportData($start, $end)
    {
        $token = $this->getAccessToken();
        $this->run_date = now()->toDateTimeString();
        $status = RunStatus::OK_STATUS;
        if ($token) {
            $data = KsClient::getReportData([
                'advertiser_id' => $this->advertiser_id,
                'temporal_granularity' => 'DAILY',
                'start_date' => $start,
                'end_date' => $end,
            ], $token);
            $details = data_get($data, 'data.details');
            $this->run_status_log = data_get($data, 'message');

            if ($details) {
                KsReportDatum::saveReport($details, $this->advertiser_id);
                $status = RunStatus::ERROR_STATUS;
            }
        } else {
            $this->run_status_log = '没有Token,请重新授权';
        }
        $this->run_status = $status;
        $this->save();
        return $this->run_status_log;
    }


    public static function getAccountReportData($start, $end, $accounts = null): array
    {
        $accounts = $accounts ?: static::query()->where('enable', 1)->get();
        $result = [];
        foreach ($accounts as $account) {
            $result[$account->advertiser_id] = $account->getReportData($start, $end);
        }
        return $result;
    }


    public function refreshToken()
    {
        $token = $this->getToken();
        $refreshToken = data_get($token, 'refresh_token');
        $result = null;
        if ($refreshToken) {
            $result = KsClient::refreshAccessToken($refreshToken, $this->app);
        }

        $token = data_get($result, 'access_token');
        if ($token)
            static::saveToken($result, $this->token_id);

        return $token;
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


    public static function test()
    {
        $date = today()->toDateString();
        $r = static::getAccountReportData($date, $date);
        dd($r);
    }

}

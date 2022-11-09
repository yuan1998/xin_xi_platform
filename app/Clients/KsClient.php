<?php

namespace App\Clients;

use App\Models\JlAccount;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class KsClient extends BaseClient
{

    public static function getAccessToken($authCode, $app)
    {
        $result = self::post("https://ad.e.kuaishou.com/rest/openapi/oauth2/authorize/access_token", [
            'json' => [
                "app_id" => $app['app_id'],
                "secret" => $app['app_secret'],
                "auth_code" => $authCode,
            ],
            'headers' => [
                'Content-type' => 'application/json'
            ]
        ]);
        $body = $result->getBody()->getContents();
        return json_decode($body, true);
    }

    public static function refreshAccessToken($token, $app)
    {
        $result = self::post("https://ad.e.kuaishou.com/rest/openapi/oauth2/authorize/refresh_token", [
            'json' => [
                "app_id" => $app['app_id'],
                "secret" => $app['app_secret'],
                "refresh_token" => $token,
            ],
            'headers' => [
                'Content-type' => 'application/json'
            ]
        ]);
        $body = $result->getBody()->getContents();
        $data = json_decode($body, true);
        return data_get($data, 'data');
    }


    public static function getAccountInfo($id, $token)
    {
        $result = self::post("https://ad.e.kuaishou.com/rest/openapi/v1/advertiser/info", [
            'json' => [
                "advertiser_id" => $id,
            ],
            'headers' => [
                'Content-type' => 'application/json',
                'Access-Token' => $token
            ]
        ]);
        $body = $result->getBody()->getContents();
        return json_decode($body, true);
    }

    public static function getReportData($data, $token)
    {
        $result = self::post("https://ad.e.kuaishou.com/rest/openapi/v1/report/account_report", [
            "json" => array_merge([
                'advertiser_id' => '',
                'temporal_granularity' => 'DAILY',
                'start_date' => '',
                'end_date' => '',
                'page' => 1,
                'page_size' => 2000,
            ], $data),
            'headers' => [
                'Content-type' => 'application/json',
                'Access-Token' => $token
            ]
        ]);
        $body = $result->getBody()->getContents();
        return json_decode($body, true);
    }


}

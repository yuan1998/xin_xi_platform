<?php

namespace App\Clients;

use App\Models\JLApp;
use App\Models\VivoApp;

class VivoClient extends BaseClient
{
    public $account;

    public function __construct($account)
    {
        $this->account = $account;
    }

    /**
     * 获取 Access_token
     * @param $auth_code String 授权码
     * @param $appModel VivoApp
     * @return array
     */
    public static function getAccessToken(string $auth_code, VivoApp $appModel)
    {
        $response = self::get("https://marketing-api.vivo.com.cn/openapi/v1/oauth2/token", [
            "query" => [
                "client_id" => $appModel['client_id'],
                "client_secret" => $appModel['secret'],
                "grant_type" => "code",
                "code" => $auth_code,
            ]
        ]);
        $body = $response->getBody()->getContents();
        $result = json_decode($body, true);
        $code = data_get($result, 'code');
        if ($code === 0) {
            $data = data_get($result, 'data');
            return [null, $data];
        }
        $msg = data_get($result, 'message', '发生错误!');
        return [$msg, $result];
    }

    public static function getAccountInfo($token)
    {
        $response = self::get("https://marketing-api.vivo.com.cn/openapi/v1/account/fetch", [
            "query" => [
                "access_token" => $token,
                "timestamp" => time() * 1000,
                "nonce" => generateRandomString(),
            ]
        ]);
        $body = $response->getBody()->getContents();
        $result = json_decode($body, true);
        $code = data_get($result, 'code');
        if ($code === 0) {
            $data = data_get($result, 'data');
            return [null, $data];
        }
        $msg = data_get($result, 'message', '发生错误!');
        return [$msg, $result];

    }

    public static function getReportData($data , $account): array
    {
        $uri = "https://marketing-api.vivo.com.cn/openapi/v1/adstatement/summary/query";
        $payload = [
            "startDate" => "20220501",
            "endDate" => "20220508",
            "pageSize" => 200,
            "summaryType" => "DAY",
            "level" => "ACCOUNT",
        ];

        $timestamp = time() * 1000;
        $params = [
            'access_token' => $account['access_token'],
            'advertiser_id' => $account['uuid'],
            'timestamp' => $timestamp,
            'nonce' => generateRandomString(),
        ];
        $response = self::post($uri, [
            'json' => array_merge($payload,$data),
            'query' => $params,
        ]);
        $body = $response->getBody()->getContents();
        $result = json_decode($body, true);
        if (data_get($result, 'code') === 0) {
            $r = data_get($result, 'data.items', []);
            return [null, $r];
        }
        $msg = data_get($result, 'message');
        return [$msg, null];

    }

}

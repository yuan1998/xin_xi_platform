<?php

namespace App\Clients;

use App\Models\BdApp;
use Illuminate\Support\Facades\Log;

class BaiduClient extends BaseClient
{

    public $account;

    public function __construct($account)
    {
        $this->account = $account;
    }

    /**
     * 获取 Access_token
     * @param array $data
     * @param $appModel BdApp
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function getAccessToken(array $data, BdApp $appModel)
    {
        /*
          "accessToken" => "xx"
          "refreshToken" => "xx"
          "expiresTime" => "2023-04-16 18:37:29"
          "refreshExpiresTime" => "2023-05-15 18:37:29"
          "expiresIn" => 86400
          "refreshExpiresIn" => 2592000
          "scope" => array:3 []
          "userId" => 46221343
          "openId" => "7409453931528863843"
         */
        $response = self::post("https://u.baidu.com/oauth/accessToken", [
            "json" => array_merge([
                "appId" => $appModel['app_id'],
                "secretKey" => $appModel['app_secret'],
                "grantType" => "auth_code",
                "code" => 'authCode',
            ], $data)
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

    public static function refreshAccessToken(array $data, BdApp $appModel)
    {
        $response = self::post("https://u.baidu.com/oauth/refreshToken", [
            "json" => array_merge([
                "appId" => $appModel['app_id'],
                "secretKey" => $appModel['app_secret'],
                "userId" => "x",
                "refreshToken" => 'x',
            ], $data)
        ]);
        $body = $response->getBody()->getContents();
        $result = json_decode($body, true);
        $code = data_get($result, 'code');
        if ($code === 0) {
            $data = data_get($result, 'data');
            return [null, $data];
        }
        $msg = data_get($result, 'message', 'baidu refreshAccessToken 发生错误!');
        return [$msg, $result];
    }

    public static function getAuthUserInfo($tokenArr)
    {
        /**
         * "masterUid" => 46221343
         * "masterName" => "BDCC-SXHM"
         * "userAcctType" => 2
         * "subUserList" => array:3 []
         * "hasNext" => false
         */
        $response = self::post('https://u.baidu.com/oauth/getUserInfo', [
            'json' => [
                'openId' => $tokenArr['openId'],
                'accessToken' => $tokenArr['accessToken'],
                'userId' => $tokenArr['userId'],
                'pageSize' => 500,
                'needSubList' => true,
                'lastPageMaxUcId' => 1,
            ]
        ]);
        $body = $response->getBody()->getContents();
        $result = json_decode($body, true);
        $code = data_get($result, 'code');
        if ($code === 0) {
            $data = data_get($result, 'data');
            return [null, $data];
        }
        $msg = data_get($result, 'message', 'Baidu getAuthUserInfo 发生错误!');
        return [$msg, $result];
    }

    public static function getOauthReportData($header, $body)
    {
        $response = self::post('https://api.baidu.com/json/sms/service/OpenApiReportService/getReportData', [
            'json' => [
                'header' => $header,
                'body' => $body,
            ],
            'headers' => [
                "Accept-Encoding" => "gzip, deflate",
                "Content-Type" => "application/json",
                "Accept" => "application/json"
            ]
        ]);
        $body = $response->getBody()->getContents();
        $result = json_decode($body, true);
        $status = data_get($result, 'header.status');
        if ($status !== 0)
            return [collect(data_get($result, 'header.failures'))->pluck('message')->join(','), null];

        $dddd = collect(data_get($result, 'body.data.0.rows'))->filter(function ($item) {
            return $item['click'] && $item['cost'];
        });
        return [null, $dddd];
    }

    public static function getReportDataOfTarget($target, $data, $account): array
    {
        $url = "https://api.baidu.com/json/sms/service/OpenApiReportService/getReportData";

        $params = [
            "reportType" => 2276038,
            "startDate" => "2022-05-01",
            "endDate" => "2022-05-01",
            "timeUnit" => "DAY",
            "columns" => [
                "date",
                "userName",
                "campaignName",
                "campaignId",
                "impression",
                "click",
                "cost",
                "ctr",
                "cpc",
                "cpm",
                "aggrFormSubmitSuccess",
                "formSubmitCost"
            ],
            "startRow" => 0,
            "rowCount" => 999,
            "needSum" => true
        ];

        $headers = [
            "authorityType" => 1,
            "username" => $account['username'],
            "token" => $account['token'],
            "target" => $target,
            "password" => $account['password'],
            "action" => "API-PYTHON"
        ];

        $response = self::post($url, [
            'json' => [
                'header' => $headers,
                "body" => array_merge($params, $data)
            ]
        ]);
        $body = $response->getBody()->getContents();
        $result = json_decode($body, true);

        if ($msg = data_get($result, 'header.failures'))
            return [collect($msg)->pluck('message')->join(','), null];

        return [null, data_get($result, 'body.data.0.rows', [])];
    }

    public static function getAllTargets($data, $account): array
    {
        $targets = data_get($account, 'targets');
        $result = [];
        $error = [];
        if ($targets) {
            $targets = explode(',', $targets);
            foreach ($targets as $target) {
                [$msg, $r] = self::getReportDataOfTarget($target, $data, $account);
                if ($msg) {
                    $error[] = "$target : $msg";
                    Log::info("百度拉取错误", [
                        'account' => $account['username '],
                        'msg' => $msg,
                    ]);
                }
                if ($r) $result = array_merge($result, $r);
            }
        }

        return [$error, $result];
    }

}

<?php

namespace App\Clients;

use GuzzleHttp\Exception\RequestException;

class JlClient extends BaseClient
{


    public static $request_url = [
        'access_token' => 'https://ad.oceanengine.com/open_api/oauth2/access_token/',
        'refresh_token' => 'https://ad.oceanengine.com/open_api/oauth2/refresh_token/',
        'account_info' => 'https://ad.oceanengine.com/open_api/2/user/info/',
        'advertiser_plan_data' => 'https://ad.oceanengine.com/open_api/2/report/ad/get/',
        'account_auth' => 'https://ad.oceanengine.com/open_api/oauth2/advertiser/get/',
        'majordomo_account' => 'https://ad.oceanengine.com/open_api/2/majordomo/advertiser/select/',
        'feiyu_clue' => 'https://ad.oceanengine.com/open_api/2/tools/clue/get/',
    ];


    /**
     * 获取广告主计划数据
     * @param $data  array Body参数
     * @param $token string access_token
     * @return mixed
     */
    public static function getAdvertiserPlanData(array $data, string $token)
    {

        $response = self::get(static::$request_url['advertiser_plan_data'], [
            'json' => array_merge([
                'advertiser_id' => 'xxxxx',
                'start_date' => '2022-10-10',
                'end_date' => '2022-10-10',
                'page_size' => 1000,
                'page' => 1,
                'group_by' => '["STAT_GROUP_BY_FIELD_ID","STAT_GROUP_BY_FIELD_STAT_TIME"]'
            ], $data),
            'headers' => [
                "Access-Token" => $token,
            ]
        ]);
        $content = $response->getBody()->getContents();
        $jsonData = json_decode($content, true);
        $status = data_get($jsonData, 'code') === 0;
        if ($status)
            return [null, data_get($jsonData, 'data.list', [])];

        return [data_get($jsonData, 'message', '获取失败'), null];
    }


    /**
     * 刷新账户token.
     * @param     $token
     * @param     $appConfig
     * @param int $retry
     * @return array|boolean
     */
    public static function refreshToken($token, $appConfig, int $retry = 5)
    {
        try {
            $result = self::post(static::$request_url['refresh_token'], [
                'form_params' => [
                    "app_id" => $appConfig['app_id'],
                    "secret" => $appConfig['app_secret'],
                    "grant_type" => 'refresh_token',
                    "refresh_token" => $token,
                ]
            ]);

            $data = json_decode($result->getBody()->getContents(), true);
            return data_get($data, 'data');
        } catch (RequestException $requestException) {
            if ($retry > 0) {
                return static::refreshToken($token, $appConfig, --$retry);
            }
            return null;
        }

    }


    /**
     * 获取 Access_token
     * @param $auth_code String 授权码
     * @param $appModel  mixed App配置
     * @return array
     */
    public static function getAccessToken($auth_code, $appModel)
    {

        $result = self::post(static::$request_url['access_token'], [
            'form_params' => [
                "app_id" => $appModel['app_id'],
                "secret" => $appModel['app_secret'],
                "grant_type" => "auth_code",
                "auth_code" => $auth_code,
            ]
        ]);
        $body = $result->getBody()->getContents();

        return json_decode($body, true);
    }


    /**
     * @param $access_token String
     * @return string
     */
    public static function getAccountInfo($access_token)
    {
        $result = self::get(static::$request_url['account_info'], [
            'headers' => [
                "Access-Token" => $access_token
            ]
        ]);

        $contents = $result->getBody()->getContents();

        return json_decode($contents, true);

    }

    /**
     * @param $token
     * @param $appModel
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function getAccountAuth($token, $appModel)
    {

        $result = self::get(static::$request_url['account_auth'], [
            'json' => [
                'access_token' => $token,
                "app_id" => $appModel['app_id'],
                "secret" => $appModel['app_secret'],
            ]
        ]);
        $body = $result->getBody()->getContents();

        return json_decode($body, true);
    }

    public static function getFeiyuClueData($data, $accessToken)
    {
        // 测试 Query :
        $data = [
            'advertiser_ids' => '["1667928143039496"]',
            "start_time" => '2020-06-25',
            "end_time" => '2020-06-25',
            "page_size" => 100,
            "page" => 1,
        ];

        $response = self::get(static::$request_url['feiyu_clue'], [
            'form_params' => $data,
            'headers' => [
                "Access-Token" => $accessToken,
            ]
        ]);
        $content = $response->getBody()->getContents();

        return json_decode($content, true);
    }

    public static function getMajordomoAccount($id, $accessToken)
    {
        $response = self::get(static::$request_url['majordomo_account'], [
            'form_params' => [
                'advertiser_id' => $id,
            ],
            'headers' => [
                "Access-Token" => $accessToken,
            ]
        ]);
        $content = $response->getBody()->getContents();

        return json_decode($content, true);
    }

}

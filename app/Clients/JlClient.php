<?php

namespace App\Clients;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class JlClient extends BaseClient
{


    public static $request_url = [
        'access_token' => 'https://ad.oceanengine.com/open_api/oauth2/access_token/',
        'refresh_token' => 'https://ad.oceanengine.com/open_api/oauth2/refresh_token/',
        'account_info' => 'https://ad.oceanengine.com/open_api/2/user/info/',
        'advertiser_plan_data' => 'https://ad.oceanengine.com/open_api/2/report/ad/get/',
        'new_advertiser_plan_data' => 'https://api.oceanengine.com/open_api/v3.0/report/custom/get/',
        'new_advertiser_config' => 'https://api.oceanengine.com/open_api/v3.0/report/custom/config/get/',
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

    public static function getNewVersionAdConfig(array $data, string $token)
    {
        $data = array_merge([
            'advertiser_id' => '',
            'data_topics' => json_encode(['BASIC_DATA']),
        ], $data);
        $queryStr = http_build_query($data);
        $url = static::$request_url['new_advertiser_config'];
//        dd($queryStr);
        $response = self::get("{$url}?$queryStr", [
//            'query' => $data,
            'headers' => [
                "Access-Token" => $token,
            ]
        ]);

        $content = $response->getBody()->getContents();
        $jsonData = json_decode($content, true);
        dd($jsonData);
    }

    public static function getNewVersionAdvertiserPlanDataOfApi($data, $token)
    {
        $data = array_merge([
            'advertiser_id' => 'xxxxx',
            "dimensions" => json_encode(["stat_time_day","cdp_promotion_name","cdp_promotion_id","ad_platform_cdp_promotion_bid","cdp_project_id","cdp_project_name"]),
            "metrics" => json_encode(["stat_cost","show_cnt","cpm_platform","click_cnt","ctr","cpc_platform","convert_cnt","conversion_cost","conversion_rate","deep_convert_cnt","deep_convert_cost","deep_convert_rate"]),
            "filters" => json_encode([]),
            "order_by" => json_encode([
                [
                    'field' => 'stat_time_day',
                    'type' => 'DESC',
                ]
            ]),
            "start_time" => "2023-04-01",
            "end_time" => "2023-04-14",
            "page" => 1,
            "page_size" => 100,
        ], $data);
        $queryStr = http_build_query($data);
        $url = static::$request_url['new_advertiser_plan_data'];

        $response = self::get("$url?$queryStr", [
            'headers' => [
                "Access-Token" => $token,
            ]
        ]);
        $content = $response->getBody()->getContents();
        $jsonData = json_decode($content, true);
        $status = data_get($jsonData, 'code') === 0;
        Log::info('debug new version api', ['advertiser_id' => $data['advertiser_id'], 'status' => $jsonData]);
        if ($status) {
            return [null, data_get($jsonData, 'data', [])];
        }


        return [data_get($jsonData, 'message', '获取失败'), null];
    }

    /**
     * 获取广告主计划数据 - 新版
     * @param $data  array Body参数
     * @param $token string access_token
     * @return mixed
     */
    public static function getNewVersionAdvertiserPlanData(array $data, string $token)
    {
        $page = 1;
        $result = [];
        $message = null;
        do {
            $data['page'] = $page;
            [$msg, $response] = static::getNewVersionAdvertiserPlanDataOfApi($data, $token);
            if ($msg) {
                $message = $msg;
                break;
            }
            $lastPage = data_get($response, 'page_info.total_page');
            if (is_null($lastPage)) {
                $message = '获取数据失败,无法获取总页数';
                break;
            }
            $result = array_merge($result, data_get($response, 'rows', []));
            $page++;
        } while ($page <= $lastPage);

        return [$message, $result];
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
        $url= static::$request_url['majordomo_account'];
        $response = self::get("$url?advertiser_id=$id", [
            'headers' => [
                "Access-Token" => $accessToken,
            ]
        ]);
        $content = $response->getBody()->getContents();

        return json_decode($content, true);
    }

}

<?php

namespace App\Clients;

use Illuminate\Support\Facades\Log;

class BaiduClient extends BaseClient
{

    public $account;

    public function __construct($account)
    {
        $this->account = $account;
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

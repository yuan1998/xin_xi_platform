<?php

namespace App\Clients;

class UcClient extends BaseClient
{

    public $account;

    public function __construct($account)
    {
        $this->account = $account;
    }

    public static function getReportTaskId($data, $account): array
    {
        $params = [
            "startDate" => "2022-05-05",
            "endDate" => "2022-05-05",
            "unitOfTime" => 1,
            "performanceData" => ["srch", "click", "consume", "ctr", "acp", "cpm", "bindingTrackType", "bindingConversion", "bindingCvr", "bindingCpa", "bindingClickConversion", "bindingClickCvr", "bindingClickCpa", "deepBindingTrackType"]
        ];

        $f = [
            "header" => [
                "username" => $account['username'],
                "password" => $account['password'],
                "token" => $account['token']
            ],
            "body" => array_merge($params, $data)
        ];

        $response = self::post('https://e.uc.cn/shc/api/report/adgroup', [
            'json' => $f,
        ]);
        $body = $response->getBody()->getContents();
        $result = json_decode($body, true);
        $msg = null;
        if ($failMsg = data_get($result, 'header.failures')) $msg = collect($failMsg)->pluck('message')->join(',');

        return [$msg, data_get($result, 'body.taskId')];
    }

    public static function downloadReportFile($taskId, $account): array
    {
        $data = [
            "header" => [
                "username" => $account['username'],
                "password" => $account['password'],
                "token" => $account['token']
            ],
            "body" => [
                "taskId" => $taskId
            ]
        ];
        $tries = 5;
        $ok = null;
        $msg = null;
        $result = [];
        do {
            sleep(3);
            $response = self::post('https://e.uc.cn/shc/api/report/downloadFile', [
                'json' => $data
            ]);
            $body = $response->getBody()->getContents();
            $t = json_decode($body, true);
            if ($t) {
                if ($failMsg = data_get($result, 'header.failures')) $msg = collect($failMsg)->pluck('message')->join(',');
            } else if ($body) {
                $ok = true;
                $csvStr = mb_convert_encoding($body, 'utf-8', 'gbk');
                $lines = explode(PHP_EOL, $csvStr);
                $keys = null;
                foreach ($lines as $line) {
                    if (!$line) continue;
                    $value = str_getcsv($line);
                    if (!$keys) $keys = $value;
                    else {
                        $arr = [];
                        foreach ($value as $index => $v) {
                            $key = $keys[$index];
                            $arr[$key] = $v;
                        }
                        $result[] = $arr;
                    }
                }
            }
            $tries--;
        } while ((!$ok && $tries <= 0));

        return [$msg, $result];
    }

    public static function getReportData($data, $account): array
    {
        [$msg, $taskId] = self::getReportTaskId($data, $account);
        if ($msg) {
            return [$msg, []];
        }

        if ($taskId) {
            return self::downloadReportFile($taskId, $account);
        }

        return ["发生意料之外.", []];
    }

}

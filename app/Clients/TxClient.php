<?php

namespace App\Clients;

use App\Models\JLApp;
use App\Models\VivoApp;

class TxClient extends BaseClient
{
    public $account;

    public function __construct($account)
    {
        $this->account = $account;
    }

    public static function getReportData($data): array
    {
        $interface = 'daily_reports/get';
        $url = 'https://api.e.qq.com/v1.1/' . $interface;

        $common_parameters = array(
            'access_token' => '',
            'timestamp' => time(),
            'nonce' => md5(uniqid('', true))
        );

        $parameters = [
            'account_id' => '',
            'level' => 'REPORT_LEVEL_CAMPAIGN',
            'date_range' => [
                'start_date' => 'YYYY-MM-DD',
                'end_date' => 'YYYY-MM-DD',
            ],
            'page' => 1,
            'page_size' => 200,
            'fields' => [
                "name",
                "ad_name",
                "ad_id",
                "ad",
                "campaign_id",
                "campaign_name",
                "date", "account_id", "view_count", "valid_click_count", "ctr", "cpc", "cost", "page_reservation_count", "page_reservation_cost",
            ]
        ];


        $query = array_merge($parameters, $common_parameters, $data);

        $response = self::get($url, [
            'query' => $query,
        ]);
        $body = $response->getBody()->getContents();
        $result = json_decode($body, true);
        // message_cn
        if (data_get($result, 'code') === 0) {
            $r = data_get($result, 'data.list', []);
            return [null, $r];
        }
        $msg = data_get($result, 'message_cn');
        return [$msg, null];

    }

}

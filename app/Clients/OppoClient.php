<?php

namespace App\Clients;

class OppoClient extends BaseClient
{

    public $account;

    public function __construct($account)
    {
        $this->account = $account;
    }

    public function signToken()
    {
        $owner_id = $this->account['owner_id'];
        $api_id = $this->account['api_id'];
        $api_key = $this->account['api_key'];
        $time_stamp = round(time());
        $unsign_str = $api_id . $api_key . $time_stamp;
        $sign = sha1($unsign_str);

        $string = $owner_id . "," . $api_id . "," . $time_stamp . "," . $sign;
        return base64_encode($string);
    }

    public function getReportData($data)
    {
        $params = [
            "beginTime" => 20220501,
            "endTime" => 20220508,
            "timeLevel" => "DAY",
        ];
        $params = array_merge($params, $data);

        $headers = [
            'Content-type' => 'application/json',
            'x-uniform-currency-unit' => 'true',
            'Authorization' => 'Bearer ' . $this->signToken()
        ];
        $response = $this->post('https://sapi.ads.heytapmobi.com/v3/data/common/summary/queryAdData', [
            'headers' => $headers,
            'form_params' => $params
        ]);
        $body = $response->getBody()->getContents();


        dd([
            '账户' => $this->account['username'],
            '接口' => '/v3/data/common/summary/queryAdData',
            '请求头' => $headers,
            '参数' => json_encode($params),
            'response' => $body
        ]);
        $result = json_decode($body, true);
        $code = data_get($result, 'code');
        if ($code === 0) {
            $data = data_get($result, 'data');
            return [null, $data];
        }
        $msg = data_get($result, 'message', '发生错误!');
        return [$msg, $result];

    }
}

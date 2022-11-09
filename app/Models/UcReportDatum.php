<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UcReportDatum extends Model
{
    use HasFactory;

    public $timestamps = null;
    protected $fillable = [
        "date",
        "account_id",
        "account_name",
        "campaign_id",
        "campaign_name",
        "campaign_type",
        "impression",
        "click",
        "cost",
        "ctr",
        "cpc",
        "cpm",
        "transfer",
        "td",
        "td_rate",
        "td_cost",
        "tc",
        "tc_rate",
        "tc_cost",
        "tc_type",
    ];

    public static function saveReportData($data) {
        foreach ($data as $item) {
            $date = preg_replace("/(\d{4})(\d{2})(\d{2})/" ,'${1}-${2}-${3}',$item['日期'] );

            $item = [
                "date" => $date,
                "account_id" => $item["账户ID"],
                "account_name" => $item["账户"],
                "campaign_id" => $item["推广组ID"],
                "campaign_name" => $item["推广组"],
                "campaign_type" => $item["推广对象"],
                "impression" => $item["展现数"],
                "click" => $item["点击数"],
                "cost" => $item["消费"],
                "ctr" => $item["点击率"],
                "cpc" => $item["点击均价"],
                "cpm" => $item["千次展现均价"],
                "transfer" => $item["转化类型"],
                "td" => $item["转化数（回传时间）"],
                "td_rate" => $item["转化率（回传时间）"],
                "td_cost" => $item["转化成本（回传时间）"],
                "tc" => $item["转化数（点击时间）"],
                "tc_rate" => $item["转化率（点击时间）"],
                "tc_cost" => $item["转化成本（点击时间）"],
                "tc_type" => $item["深度转化类型"],
            ];
            static::updateOrCreate([
                'date' => $date,
                "account_id" => $item["account_id"],
                'campaign_id' => $item["campaign_id"],
            ],$item);

        }

    }
}

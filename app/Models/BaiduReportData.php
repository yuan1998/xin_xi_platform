<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaiduReportData extends Model
{
    use HasFactory;

    public $timestamps = null;
    /**
    //"date" => "2023-04-22"
    // "userName" => "xa-hmyp2"
    // "campaignId" => 291546418
    "impression" => 8
    "click" => 1
    "cost" => 2.27
    "ctr" => 0.125
    "cpc" => 2.27
    "cpm" => 283.75
    "bridgeConversion" => 0
     */
    protected $fillable = [
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
        "formSubmitCost",
    ];

    public static function saveReportData($data)
    {
        foreach ($data as $item) {
            static::updateOrCreate([
                'date' => $item['date'],
                'userName' => $item['userName'],
                'campaignId' => $item['campaignId'],
            ], $item);
        }
    }
}

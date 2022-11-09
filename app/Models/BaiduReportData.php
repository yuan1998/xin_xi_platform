<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaiduReportData extends Model
{
    use HasFactory;

    public $timestamps = null;
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VivoReportData extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        "showCount",
        "formsubmitCount",
        "clickCount",
        "buttonClick",
        "spent",
        "reportDate",
        "advertiserId",
    ];

    public static function saveReportData($data)
    {
        foreach ($data as $item) {
            $reportDate = preg_replace("/(\d{4})(\d{2})(\d{2})/", '${1}-${2}-${3}', $item['reportDate']);
            VivoReportData::updateOrCreate([
                'advertiserId' => $item['advertiserId'],
                'reportDate' => $reportDate,
            ], [
                "showCount" => $item["showCount"],
                "formsubmitCount" => $item["formsubmitCount"],
                "clickCount" => $item["clickCount"],
                "buttonClick" => $item["buttonClick"],
                "spent" => $item["spent"],
            ]);

        }
    }
}

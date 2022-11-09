<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KsReportDatum extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        "advertiser_id",
        "stat_date",
        "charge",
        "show",
        "photo_click",
        "aclick",
        "bclick",
        "photo_click_ratio",
        "action_ratio",
        "impression_1k_cost",
        "photo_click_cost",
        "action_cost",
        "negative",
        "submit",
        "form_count",
        "form_cost",
        "form_action_ratio",
        "event_jin_jian_landing_page",
        "event_jin_jian_landing_page_cost",
        "event_valid_clues",
        "event_valid_clues_cost",
        "event_add_wechat",
        "event_add_wechat_cost",
        "event_add_wechat_ratio",
    ];

    public static function saveReport($data , $id) {

        foreach ($data as $item) {
            static::updateOrCreate([
                'advertiser_id' => $id,
                'stat_date' => $item['stat_date'],
            ],$item);
        }
    }

}

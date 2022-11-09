<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TxReportDatum extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        "date",
        "account_id",
        "view_count",
        "valid_click_count",
        "ctr",
        "cpc",
        "cost",
        "page_reservation_count",
        "page_reservation_cost",
    ];

    public static function saveReportData($data)
    {
        foreach ($data as $item) {
            static::updateOrCreate([
                'account_id' => $item['account_id'],
                'date' => $item['date'],
            ], $item);

        }
    }
}

<?php

namespace App\Models;

use App\Traits\HasReportClear;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class JlReportDatum extends Model
{
    use HasFactory;
    use HasReportClear;

    const FIELDS = [
        "stat_datetime",
        "ad_name",
        "campaign_id",
        "campaign_name",
        "ad_id",
        "show",
        "click",
        "cost",
        "ctr",
        "avg_click_cost",
        "avg_show_cost",
        "convert",
        "convert_cost",
        "convert_rate",
        "form",
    ];

    public $timestamps = false;
    protected $fillable = self::FIELDS;

    public static function saveReportData($data)
    {
        foreach ($data as $item) {
            $rows = Arr::only($item, self::FIELDS);
            static::updateOrCreate([
                'stat_datetime' => $rows['stat_datetime'],
                "ad_id" => $rows["ad_id"],
                'campaign_id' => $rows["campaign_id"],
            ], $rows);
        }
    }

    static function getDateKey(): string
    {
        return 'stat_datetime';
    }

    public static function makeLogData($date, $queryCall = null): array
    {
        $query = static::query()
            ->whereDate('stat_datetime', $date);

        if (is_callable($queryCall)) {
            $queryCall($query);
        }

        $data = $query->get()
            ->groupBy('campaign_id');

        $result = [];
        foreach ($data as $accountId => $planData) {

            $result[] = [
                'show' => $planData->sum('show'),
                'click' => $planData->sum('click'),
                'cost' => $planData->sum('cost'),
                'convert' => $planData->sum('convert'),
                'advertiser_id' => $accountId,
                'advertiser_name' => data_get($planData, '0.campaign_name'),
                'log_date' => $date,
            ];
        }
        return $result;
    }


}

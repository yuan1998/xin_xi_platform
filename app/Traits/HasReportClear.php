<?php

namespace App\Traits;

use Carbon\Carbon;

trait HasReportClear
{
    abstract public static function getDateKey(): string;

    public static function clearReportData($month = 2)
    {
        $dateKey = static::getDateKey();
        $query = static::query()->whereNull($dateKey);
        if ($month) {
            $date = Carbon::today()->addMonths(-$month)->toDateTimeString();
            $query->orWhere($dateKey, '<', $date);
        }
        $query->delete();
    }
}

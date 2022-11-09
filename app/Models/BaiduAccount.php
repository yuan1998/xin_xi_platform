<?php

namespace App\Models;

use App\Clients\BaiduClient;
use App\Constants\RunStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaiduAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'token',
        'password',
        'type',
        'targets',
        'enable',
        'run_status',
        'run_status_log',
        'run_date',
    ];

    public function getReportData($start, $end): string
    {
        $this->run_date = now();
        $this->run_status = RunStatus::OK_STATUS;
        [$error, $result] = BaiduClient::getAllTargets([
            "startDate" => $start,
            "endDate" => $end,
        ], $this);

        if (count($error)) {
            $this->run_status_log = implode(';', $error);
        } else {
            $this->run_status_log = '获取成功';
        }

        if ($result)
            BaiduReportData::saveReportData($result);

        $this->save();
        return $this->run_status_log;
    }


    public static function getAccountReportData($start, $end, $accounts = null): array
    {
        $accounts = $accounts ?: static::query()->where('enable', 1)->get();
        $result = [];
        foreach ($accounts as $account) {
            $result[$account->username] = $account->getReportData($start, $end);
        }
        return $result;
    }

    public static function getReportOfToday(): array
    {
        $dateString = today()->toDateString();
        return static::getAccountReportData($dateString, $dateString);
    }

    public static function getReportOfYesterday(): array
    {
        $dateString = Carbon::yesterday()->toDateString();
        return static::getAccountReportData($dateString, $dateString);
    }


}

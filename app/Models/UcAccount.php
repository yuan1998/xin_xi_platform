<?php

namespace App\Models;

use App\Clients\UcClient;
use App\Constants\RunStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UcAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'password',
        'token',
        'enable',
        'run_status',
        'run_status_log',
        'run_date',
    ];

    public function getReportData($start, $end)
    {
        $this->run_status = RunStatus::OK_STATUS;
        $this->run_date = now();
        [$msg, $result] = UcClient::getReportData([
            "startDate" => $start,
            "endDate" => $end,
        ], $this);
        $this->run_status_log = $msg ?: '获取成功';
        if ($msg) {
            $this->run_status = RunStatus::ERROR_STATUS;
        } else {
            UcReportDatum::saveReportData($result);
        }
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

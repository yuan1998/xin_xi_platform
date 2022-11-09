<?php

namespace App\Models;

use App\Clients\VivoClient;
use App\Constants\RunStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VivoAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        "username",
        "uuid",
        "access_token",
        "refresh_token",
        "token_date",
        "enable",
        "client_id",

        'run_status',
        'run_status_log',
        'run_date',
    ];

    public function getReportData($start, $end)
    {
        $this->run_date = now();
        $this->run_status = RunStatus::OK_STATUS;
        [$msg, $data] = VivoClient::getReportData([
            "startDate" => str_replace('-', '', $start),
            "endDate" => str_replace('-', '', $end),
        ], $this);

        $this->run_status_log = $msg ?: '获取成功';
        if ($msg) {
            $this->run_status = RunStatus::ERROR_STATUS;
        }

        if ($data) {
            VivoReportData::saveReportData($data);
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

<?php

namespace App\Models;

use App\Clients\TxClient;
use App\Constants\RunStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TxAccount extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'username',
        'account_id',
        'access_token',
        'refresh_token',
        'enable',
        'run_status',
        'run_status_log',
        'run_date',
    ];


    public function getReportData($start, $end)
    {
        $this->run_date = now();
        $this->run_status = RunStatus::OK_STATUS;
        [$msg, $data] = TxClient::getReportData([
            'level' => 'REPORT_LEVEL_AD',
            'date_range' => [
                'start_date' => $start,
                'end_date' => $end,
            ],
            'account_id' => $this->account_id,
            'access_token' => $this->access_token,
        ]);
        $this->run_status_log = $msg ?: '获取成功';
        if ($msg) {
            $this->run_status = RunStatus::ERROR_STATUS;
        }
        if ($data) {
            TxReportDatum::saveReportData($data);
        }
        $this->save();
        return $this->run_status_log;
    }

    public static function getAccountReportData($start, $end, $accounts = null): array
    {
        $accounts = $accounts ?: static::query()->where('enable', 1)->get();
        $result = [];
        foreach ($accounts as $account) {
            $result[$account->account_id] = $account->getReportData($start, $end);
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

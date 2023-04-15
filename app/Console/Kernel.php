<?php

namespace App\Console;

use App\Models\BaiduAccount;
use App\Models\JlAccount;
use App\Models\KsAccount;
use App\Models\TxAccount;
use App\Models\UcAccount;
use App\Models\VivoAccount;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        if (admin_setting('PULL_REPORT_JL')) {
            $schedule->call(function () {
                JlAccount::getReportOfYesterday();
            })->dailyAt("00:10");
        }

        if (admin_setting('PULL_REPORT_KS')) {
            $schedule->call(function () {
                KsAccount::getReportOfYesterday();
            })->dailyAt("00:09");
        }

        if (admin_setting('PULL_REPORT_TX')) {
            $schedule->call(function () {
                TxAccount::getReportOfYesterday();
            })->dailyAt("00:08");
        }

        if (admin_setting('PULL_REPORT_BD')) {
            $schedule->call(function () {
                BaiduAccount::getReportOfYesterday();
            })->dailyAt("00:07");
        }

        if (admin_setting('PULL_REPORT_VIVO')) {
            $schedule->call(function () {
                VivoAccount::getReportOfYesterday();
            })->dailyAt("00:06");
        }

        if (admin_setting('PULL_REPORT_UC')) {
            $schedule->call(function () {
                UcAccount::getReportOfYesterday();
            })->dailyAt("00:05");
        }


    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}

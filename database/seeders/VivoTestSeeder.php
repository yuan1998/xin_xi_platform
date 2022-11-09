<?php

namespace Database\Seeders;

use App\Clients\VivoClient;
use App\Models\VivoAccount;
use App\Models\VivoReportData;
use Illuminate\Database\Seeder;

class VivoTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $account = VivoAccount::query()->first();
        if (!$account) return;
        $client = new VivoClient($account);

        [$msg, $data] = $client->getReportData([
            "startDate" => "20220922",
            "endDate" => "20220922",
        ]);

        if ($data) {
            VivoReportData::saveReportData($data);
            return;
        }

        dd($msg);
    }
}

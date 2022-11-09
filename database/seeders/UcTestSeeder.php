<?php

namespace Database\Seeders;

use App\Clients\UcClient;
use App\Models\UcAccount;
use App\Models\UcReportDatum;
use Illuminate\Database\Seeder;

class UcTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $account = UcAccount::updateOrCreate([
            "username" => "UC信息流-团圆口腔医院2",
            "password" => "tuantkq999",
            "token" => "3a31b767-35ca-46cf-a274-6f5a7b489e1f"
        ]);

        $client = new UcClient($account);

        [$msg, $result] = $client->getReportData([
            "startDate" => "2022-07-01",
            "endDate" => "2022-07-01",
        ]);
        if ($msg) dd($msg);
        if ($result) {
            UcReportDatum::saveReportData($result);
        }

    }
}

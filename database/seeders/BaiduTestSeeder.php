<?php

namespace Database\Seeders;

use App\Clients\BaiduClient;
use App\Models\BaiduAccount;
use App\Models\BaiduReportData;
use Illuminate\Database\Seeder;

class BaiduTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $account = BaiduAccount::updateOrCreate([
            'username' => '团圆口腔医院',
            'password' => '2019HMkqyy!@#hmkq',
            'token' => 'a1f65f30143c0187020015862b361a3b',
            'type' => 0,
            'targets' => 'xa-hmtyn',
        ]);

        $client = new BaiduClient($account);

        $result = $client->getAllTargets([
            "startDate" => "2022-09-01",
            "endDate" => "2022-09-01",
        ]);
        
        BaiduReportData::saveReportData($result);

    }
}

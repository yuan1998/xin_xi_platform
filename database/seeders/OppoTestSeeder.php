<?php

namespace Database\Seeders;

use App\Clients\OppoClient;
use App\Models\OppoAccount;

use Illuminate\Database\Seeder;

class OppoTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $account = OppoAccount::updateOrCreate([
            "owner_id" => 1000127787,
        ], [
            "username" => "SMBHZ-画美团圆5-XXL",
            "api_id" => "0c824a06fac143fb8668f29442240d62",
            "api_key" => "0e670d002d1a4a8589f4ccc279a37b5c"
        ]);

        $client = new OppoClient($account);
        $client->getReportData([
            "beginTime" => 20220901,
            "endTime" => 20220908,
        ]);

    }
}

<?php

namespace Database\Seeders;

use App\Clients\TxClient;
use App\Models\TxAccount;
use App\Models\TxReportDatum;
use Illuminate\Database\Seeder;

class TxTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accounts = [
            [
                "account_id" => "21250629",
                "access_token" => "3f97127c1b76b68151cbc6de0d76e2ed"
            ],
            [
                "account_id" => "21682394",
                "access_token" => "d426912fd92d09532f2852824d580dcc"
            ],
            [
                "account_id" => "21682396",
                "access_token" => "8897c96e9dbd9d2a3442463a14444007",
                "refresh_token" => "4582142ac1e2a5dbe2223504584ff640"
            ],
            [
                "account_id" => "22029598",
                "access_token" => "8b1debdeb75547003b1cf22e2a1daa17",
                "refresh_token" => "06c8de6362eac2fe7074ece981dce088"
            ],
            [
                "account_id" => "22184455",
                "access_token" => "41a366d4a5a25afd2d261680743ef55a",
                "refresh_token" => "0dc06ea0c5a466e62911842383d1b82b"
            ],
            [
                "account_id" => "22184458",
                "access_token" => "66b6e7ee0c5d09b2fd262766ad042d6c",
                "refresh_token" => "33160e39d5ced74ff9f482330a65c361"
            ],
            [
                "account_id" => "23950730",
                "access_token" => "3772930e1d3286d619fb52fbeec37012",
                "refresh_token" => "590a4e04e3885de6050149c601cb3700"
            ],
            [
                "account_id" => "23950733",
                "access_token" => "f4718353c8f7b0d6fe45a9882b1ff6a6",
                "refresh_token" => "ac93c7f87bea6678181fe0d0b1d73a99"
            ],
        ];

        foreach ($accounts as $account) {
            TxAccount::updateOrCreate([
                'account_id' => $account['account_id']
            ], $account);
        }

        $account = TxAccount::query()->where('account_id','23950733')->first();

        if (!$account) return;
       $data = $account->getReportData('2022-10-04','2022-10-04');

        if ($data) {
            TxReportDatum::saveReportData($data);
            return;
        }


        dd($msg);
    }
}

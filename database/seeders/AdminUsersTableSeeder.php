<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_users')->delete();
        
        \DB::table('admin_users')->insert(array (
            0 => 
            array (
                'avatar' => NULL,
                'created_at' => '2022-09-27 03:21:24',
                'id' => 1,
                'name' => 'Administrator',
                'password' => '$2y$10$PU2MBSRNlAbt7NShoyD4qeTEBLhiYPhNQ/ZHtUunoxdqhQn8P1lq2',
                'remember_token' => NULL,
                'updated_at' => '2022-09-27 03:21:24',
                'username' => 'admin',
            ),
        ));
        
        
    }
}
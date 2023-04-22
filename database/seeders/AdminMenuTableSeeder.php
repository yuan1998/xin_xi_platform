<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminMenuTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_menu')->delete();
        
        \DB::table('admin_menu')->insert(array (
            0 => 
            array (
                'id' => 1,
                'parent_id' => 0,
                'order' => 1,
                'title' => 'Index',
                'icon' => 'feather icon-bar-chart-2',
                'uri' => '/',
                'extension' => '',
                'show' => 1,
                'created_at' => '2022-09-27 03:21:24',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'parent_id' => 0,
                'order' => 2,
                'title' => 'Admin',
                'icon' => 'feather icon-settings',
                'uri' => '',
                'extension' => '',
                'show' => 1,
                'created_at' => '2022-09-27 03:21:24',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'parent_id' => 2,
                'order' => 3,
                'title' => 'Users',
                'icon' => '',
                'uri' => 'auth/users',
                'extension' => '',
                'show' => 1,
                'created_at' => '2022-09-27 03:21:24',
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'parent_id' => 2,
                'order' => 4,
                'title' => 'Roles',
                'icon' => '',
                'uri' => 'auth/roles',
                'extension' => '',
                'show' => 1,
                'created_at' => '2022-09-27 03:21:24',
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'parent_id' => 2,
                'order' => 5,
                'title' => 'Permission',
                'icon' => '',
                'uri' => 'auth/permissions',
                'extension' => '',
                'show' => 1,
                'created_at' => '2022-09-27 03:21:24',
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'parent_id' => 2,
                'order' => 6,
                'title' => 'Menu',
                'icon' => '',
                'uri' => 'auth/menu',
                'extension' => '',
                'show' => 1,
                'created_at' => '2022-09-27 03:21:24',
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'parent_id' => 2,
                'order' => 7,
                'title' => 'Extensions',
                'icon' => '',
                'uri' => 'auth/extensions',
                'extension' => '',
                'show' => 1,
                'created_at' => '2022-09-27 03:21:24',
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'parent_id' => 11,
                'order' => 9,
                'title' => 'VivoAPPs',
                'icon' => NULL,
                'uri' => 'vivo_apps',
                'extension' => '',
                'show' => 1,
                'created_at' => '2022-09-28 09:59:27',
                'updated_at' => '2022-09-28 14:37:29',
            ),
            8 => 
            array (
                'id' => 9,
                'parent_id' => 11,
                'order' => 10,
                'title' => 'Vivo账号',
                'icon' => NULL,
                'uri' => '/vivo_accounts',
                'extension' => '',
                'show' => 1,
                'created_at' => '2022-09-28 14:14:06',
                'updated_at' => '2022-09-28 14:37:29',
            ),
            9 => 
            array (
                'id' => 10,
                'parent_id' => 11,
                'order' => 11,
                'title' => 'Vivo日报告数据',
                'icon' => NULL,
                'uri' => '/vivo_report_data',
                'extension' => '',
                'show' => 1,
                'created_at' => '2022-09-28 14:37:05',
                'updated_at' => '2022-09-28 14:37:29',
            ),
            10 => 
            array (
                'id' => 11,
                'parent_id' => 0,
                'order' => 8,
                'title' => 'Vivo',
                'icon' => NULL,
                'uri' => NULL,
                'extension' => '',
                'show' => 1,
                'created_at' => '2022-09-28 14:37:19',
                'updated_at' => '2022-09-28 14:37:29',
            ),
            11 => 
            array (
                'id' => 12,
                'parent_id' => 0,
                'order' => 12,
                'title' => '百度',
                'icon' => NULL,
                'uri' => NULL,
                'extension' => '',
                'show' => 1,
                'created_at' => '2022-09-28 14:39:14',
                'updated_at' => '2022-09-28 14:39:14',
            ),
            12 => 
            array (
                'id' => 13,
                'parent_id' => 12,
                'order' => 13,
                'title' => '百度账户',
                'icon' => NULL,
                'uri' => '/baidu_accounts',
                'extension' => '',
                'show' => 1,
                'created_at' => '2022-09-28 14:39:29',
                'updated_at' => '2022-09-28 14:39:29',
            ),
            13 => 
            array (
                'id' => 14,
                'parent_id' => 12,
                'order' => 14,
            'title' => '百度报告数据(日)',
                'icon' => NULL,
                'uri' => '/baidu_report_data',
                'extension' => '',
                'show' => 1,
                'created_at' => '2022-09-28 14:40:01',
                'updated_at' => '2022-09-28 14:40:01',
            ),
            14 => 
            array (
                'id' => 15,
                'parent_id' => 0,
                'order' => 15,
                'title' => 'Uc',
                'icon' => NULL,
                'uri' => NULL,
                'extension' => '',
                'show' => 1,
                'created_at' => '2022-09-28 14:40:37',
                'updated_at' => '2022-09-28 14:40:37',
            ),
            15 => 
            array (
                'id' => 16,
                'parent_id' => 15,
                'order' => 16,
                'title' => 'Uc账户',
                'icon' => NULL,
                'uri' => '/uc_accounts',
                'extension' => '',
                'show' => 1,
                'created_at' => '2022-09-28 14:41:00',
                'updated_at' => '2022-09-28 14:41:00',
            ),
            16 => 
            array (
                'id' => 17,
                'parent_id' => 15,
                'order' => 17,
            'title' => 'Uc报告数据(日)',
                'icon' => NULL,
                'uri' => '/uc_report_data',
                'extension' => '',
                'show' => 1,
                'created_at' => '2022-09-28 14:41:20',
                'updated_at' => '2022-09-28 14:41:28',
            ),
            17 => 
            array (
                'id' => 18,
                'parent_id' => 0,
                'order' => 18,
                'title' => '腾讯',
                'icon' => NULL,
                'uri' => NULL,
                'extension' => '',
                'show' => 1,
                'created_at' => '2022-10-06 15:22:12',
                'updated_at' => '2022-10-06 15:22:12',
            ),
            18 => 
            array (
                'id' => 19,
                'parent_id' => 18,
                'order' => 19,
                'title' => '腾讯账号',
                'icon' => NULL,
                'uri' => '/tx_accounts',
                'extension' => '',
                'show' => 1,
                'created_at' => '2022-10-06 15:22:34',
                'updated_at' => '2022-10-06 15:22:34',
            ),
            19 => 
            array (
                'id' => 20,
                'parent_id' => 18,
                'order' => 20,
            'title' => '腾讯报告数据(日)',
                'icon' => NULL,
                'uri' => '/tx_report_data',
                'extension' => '',
                'show' => 1,
                'created_at' => '2022-10-06 15:23:08',
                'updated_at' => '2022-10-06 15:23:08',
            ),
            20 => 
            array (
                'id' => 21,
                'parent_id' => 0,
                'order' => 21,
                'title' => '巨量',
                'icon' => NULL,
                'uri' => NULL,
                'extension' => '',
                'show' => 1,
                'created_at' => '2022-10-16 16:22:43',
                'updated_at' => '2022-10-16 16:22:43',
            ),
            21 => 
            array (
                'id' => 22,
                'parent_id' => 21,
                'order' => 22,
                'title' => '巨量APP',
                'icon' => NULL,
                'uri' => '/jl_apps',
                'extension' => '',
                'show' => 1,
                'created_at' => '2022-10-16 16:22:55',
                'updated_at' => '2022-10-16 16:22:55',
            ),
            22 => 
            array (
                'id' => 23,
                'parent_id' => 0,
                'order' => 23,
                'title' => '快手',
                'icon' => NULL,
                'uri' => NULL,
                'extension' => '',
                'show' => 1,
                'created_at' => '2022-10-16 16:34:55',
                'updated_at' => '2022-10-16 16:34:55',
            ),
            23 => 
            array (
                'id' => 24,
                'parent_id' => 23,
                'order' => 24,
                'title' => '快手APP',
                'icon' => NULL,
                'uri' => '/ks_apps',
                'extension' => '',
                'show' => 1,
                'created_at' => '2022-10-16 16:35:09',
                'updated_at' => '2022-10-16 16:35:09',
            ),
            24 => 
            array (
                'id' => 25,
                'parent_id' => 21,
                'order' => 25,
                'title' => '巨量授权账户',
                'icon' => NULL,
                'uri' => '/jl_accounts',
                'extension' => '',
                'show' => 1,
                'created_at' => '2022-10-30 15:14:30',
                'updated_at' => '2022-10-30 15:14:30',
            ),
            25 => 
            array (
                'id' => 26,
                'parent_id' => 21,
                'order' => 26,
            'title' => '巨量报告数据(日)',
                'icon' => NULL,
                'uri' => '/jl_report_data',
                'extension' => '',
                'show' => 1,
                'created_at' => '2022-10-30 15:23:40',
                'updated_at' => '2022-10-30 15:23:40',
            ),
            26 => 
            array (
                'id' => 27,
                'parent_id' => 23,
                'order' => 27,
                'title' => '快手账号',
                'icon' => NULL,
                'uri' => '/ks_accounts',
                'extension' => '',
                'show' => 1,
                'created_at' => '2022-11-03 15:26:13',
                'updated_at' => '2022-11-03 15:26:13',
            ),
            27 => 
            array (
                'id' => 28,
                'parent_id' => 23,
                'order' => 28,
            'title' => '快手报告数据(日)',
                'icon' => NULL,
                'uri' => '/ks_report_datum',
                'extension' => '',
                'show' => 1,
                'created_at' => '2022-11-05 16:39:27',
                'updated_at' => '2022-11-05 16:39:27',
            ),
            28 => 
            array (
                'id' => 29,
                'parent_id' => 12,
                'order' => 29,
            'title' => '百度应用(APP)',
                'icon' => NULL,
                'uri' => '/bd_apps',
                'extension' => '',
                'show' => 1,
                'created_at' => '2023-04-15 15:47:18',
                'updated_at' => '2023-04-15 15:47:18',
            ),
        ));
        
        
    }
}
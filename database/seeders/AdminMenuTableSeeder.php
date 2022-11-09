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
                'created_at' => '2022-09-27 03:21:24',
                'extension' => '',
                'icon' => 'feather icon-bar-chart-2',
                'id' => 1,
                'order' => 1,
                'parent_id' => 0,
                'show' => 1,
                'title' => 'Index',
                'updated_at' => NULL,
                'uri' => '/',
            ),
            1 => 
            array (
                'created_at' => '2022-09-27 03:21:24',
                'extension' => '',
                'icon' => 'feather icon-settings',
                'id' => 2,
                'order' => 2,
                'parent_id' => 0,
                'show' => 1,
                'title' => 'Admin',
                'updated_at' => NULL,
                'uri' => '',
            ),
            2 => 
            array (
                'created_at' => '2022-09-27 03:21:24',
                'extension' => '',
                'icon' => '',
                'id' => 3,
                'order' => 3,
                'parent_id' => 2,
                'show' => 1,
                'title' => 'Users',
                'updated_at' => NULL,
                'uri' => 'auth/users',
            ),
            3 => 
            array (
                'created_at' => '2022-09-27 03:21:24',
                'extension' => '',
                'icon' => '',
                'id' => 4,
                'order' => 4,
                'parent_id' => 2,
                'show' => 1,
                'title' => 'Roles',
                'updated_at' => NULL,
                'uri' => 'auth/roles',
            ),
            4 => 
            array (
                'created_at' => '2022-09-27 03:21:24',
                'extension' => '',
                'icon' => '',
                'id' => 5,
                'order' => 5,
                'parent_id' => 2,
                'show' => 1,
                'title' => 'Permission',
                'updated_at' => NULL,
                'uri' => 'auth/permissions',
            ),
            5 => 
            array (
                'created_at' => '2022-09-27 03:21:24',
                'extension' => '',
                'icon' => '',
                'id' => 6,
                'order' => 6,
                'parent_id' => 2,
                'show' => 1,
                'title' => 'Menu',
                'updated_at' => NULL,
                'uri' => 'auth/menu',
            ),
            6 => 
            array (
                'created_at' => '2022-09-27 03:21:24',
                'extension' => '',
                'icon' => '',
                'id' => 7,
                'order' => 7,
                'parent_id' => 2,
                'show' => 1,
                'title' => 'Extensions',
                'updated_at' => NULL,
                'uri' => 'auth/extensions',
            ),
            7 => 
            array (
                'created_at' => '2022-09-28 09:59:27',
                'extension' => '',
                'icon' => NULL,
                'id' => 8,
                'order' => 9,
                'parent_id' => 11,
                'show' => 1,
                'title' => 'VivoAPPs',
                'updated_at' => '2022-09-28 14:37:29',
                'uri' => 'vivo_apps',
            ),
            8 => 
            array (
                'created_at' => '2022-09-28 14:14:06',
                'extension' => '',
                'icon' => NULL,
                'id' => 9,
                'order' => 10,
                'parent_id' => 11,
                'show' => 1,
                'title' => 'Vivo账号',
                'updated_at' => '2022-09-28 14:37:29',
                'uri' => '/vivo_accounts',
            ),
            9 => 
            array (
                'created_at' => '2022-09-28 14:37:05',
                'extension' => '',
                'icon' => NULL,
                'id' => 10,
                'order' => 11,
                'parent_id' => 11,
                'show' => 1,
                'title' => 'Vivo日报告数据',
                'updated_at' => '2022-09-28 14:37:29',
                'uri' => '/vivo_report_data',
            ),
            10 => 
            array (
                'created_at' => '2022-09-28 14:37:19',
                'extension' => '',
                'icon' => NULL,
                'id' => 11,
                'order' => 8,
                'parent_id' => 0,
                'show' => 1,
                'title' => 'Vivo',
                'updated_at' => '2022-09-28 14:37:29',
                'uri' => NULL,
            ),
            11 => 
            array (
                'created_at' => '2022-09-28 14:39:14',
                'extension' => '',
                'icon' => NULL,
                'id' => 12,
                'order' => 12,
                'parent_id' => 0,
                'show' => 1,
                'title' => '百度',
                'updated_at' => '2022-09-28 14:39:14',
                'uri' => NULL,
            ),
            12 => 
            array (
                'created_at' => '2022-09-28 14:39:29',
                'extension' => '',
                'icon' => NULL,
                'id' => 13,
                'order' => 13,
                'parent_id' => 12,
                'show' => 1,
                'title' => '百度账户',
                'updated_at' => '2022-09-28 14:39:29',
                'uri' => '/baidu_accounts',
            ),
            13 => 
            array (
                'created_at' => '2022-09-28 14:40:01',
                'extension' => '',
                'icon' => NULL,
                'id' => 14,
                'order' => 14,
                'parent_id' => 12,
                'show' => 1,
            'title' => '百度报告数据(日)',
                'updated_at' => '2022-09-28 14:40:01',
                'uri' => '/baidu_report_data',
            ),
            14 => 
            array (
                'created_at' => '2022-09-28 14:40:37',
                'extension' => '',
                'icon' => NULL,
                'id' => 15,
                'order' => 15,
                'parent_id' => 0,
                'show' => 1,
                'title' => 'Uc',
                'updated_at' => '2022-09-28 14:40:37',
                'uri' => NULL,
            ),
            15 => 
            array (
                'created_at' => '2022-09-28 14:41:00',
                'extension' => '',
                'icon' => NULL,
                'id' => 16,
                'order' => 16,
                'parent_id' => 15,
                'show' => 1,
                'title' => 'Uc账户',
                'updated_at' => '2022-09-28 14:41:00',
                'uri' => '/uc_accounts',
            ),
            16 => 
            array (
                'created_at' => '2022-09-28 14:41:20',
                'extension' => '',
                'icon' => NULL,
                'id' => 17,
                'order' => 17,
                'parent_id' => 15,
                'show' => 1,
            'title' => 'Uc报告数据(日)',
                'updated_at' => '2022-09-28 14:41:28',
                'uri' => '/uc_report_data',
            ),
            17 => 
            array (
                'created_at' => '2022-10-06 15:22:12',
                'extension' => '',
                'icon' => NULL,
                'id' => 18,
                'order' => 18,
                'parent_id' => 0,
                'show' => 1,
                'title' => '腾讯',
                'updated_at' => '2022-10-06 15:22:12',
                'uri' => NULL,
            ),
            18 => 
            array (
                'created_at' => '2022-10-06 15:22:34',
                'extension' => '',
                'icon' => NULL,
                'id' => 19,
                'order' => 19,
                'parent_id' => 18,
                'show' => 1,
                'title' => '腾讯账号',
                'updated_at' => '2022-10-06 15:22:34',
                'uri' => '/tx_accounts',
            ),
            19 => 
            array (
                'created_at' => '2022-10-06 15:23:08',
                'extension' => '',
                'icon' => NULL,
                'id' => 20,
                'order' => 20,
                'parent_id' => 18,
                'show' => 1,
            'title' => '腾讯报告数据(日)',
                'updated_at' => '2022-10-06 15:23:08',
                'uri' => '/tx_report_data',
            ),
            20 => 
            array (
                'created_at' => '2022-10-16 16:22:43',
                'extension' => '',
                'icon' => NULL,
                'id' => 21,
                'order' => 21,
                'parent_id' => 0,
                'show' => 1,
                'title' => '巨量',
                'updated_at' => '2022-10-16 16:22:43',
                'uri' => NULL,
            ),
            21 => 
            array (
                'created_at' => '2022-10-16 16:22:55',
                'extension' => '',
                'icon' => NULL,
                'id' => 22,
                'order' => 22,
                'parent_id' => 21,
                'show' => 1,
                'title' => '巨量APP',
                'updated_at' => '2022-10-16 16:22:55',
                'uri' => '/jl_apps',
            ),
            22 => 
            array (
                'created_at' => '2022-10-16 16:34:55',
                'extension' => '',
                'icon' => NULL,
                'id' => 23,
                'order' => 23,
                'parent_id' => 0,
                'show' => 1,
                'title' => '快手',
                'updated_at' => '2022-10-16 16:34:55',
                'uri' => NULL,
            ),
            23 => 
            array (
                'created_at' => '2022-10-16 16:35:09',
                'extension' => '',
                'icon' => NULL,
                'id' => 24,
                'order' => 24,
                'parent_id' => 23,
                'show' => 1,
                'title' => '快手APP',
                'updated_at' => '2022-10-16 16:35:09',
                'uri' => '/ks_apps',
            ),
            24 => 
            array (
                'created_at' => '2022-10-30 15:14:30',
                'extension' => '',
                'icon' => NULL,
                'id' => 25,
                'order' => 25,
                'parent_id' => 21,
                'show' => 1,
                'title' => '巨量授权账户',
                'updated_at' => '2022-10-30 15:14:30',
                'uri' => '/jl_accounts',
            ),
            25 => 
            array (
                'created_at' => '2022-10-30 15:23:40',
                'extension' => '',
                'icon' => NULL,
                'id' => 26,
                'order' => 26,
                'parent_id' => 21,
                'show' => 1,
            'title' => '巨量报告数据(日)',
                'updated_at' => '2022-10-30 15:23:40',
                'uri' => '/jl_report_data',
            ),
            26 => 
            array (
                'created_at' => '2022-11-03 15:26:13',
                'extension' => '',
                'icon' => NULL,
                'id' => 27,
                'order' => 27,
                'parent_id' => 23,
                'show' => 1,
                'title' => '快手账号',
                'updated_at' => '2022-11-03 15:26:13',
                'uri' => '/ks_accounts',
            ),
            27 => 
            array (
                'created_at' => '2022-11-05 16:39:27',
                'extension' => '',
                'icon' => NULL,
                'id' => 28,
                'order' => 28,
                'parent_id' => 23,
                'show' => 1,
            'title' => '快手报告数据(日)',
                'updated_at' => '2022-11-05 16:39:27',
                'uri' => '/ks_report_datum',
            ),
        ));
        
        
    }
}
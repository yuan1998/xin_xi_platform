<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->get('/admin_setting', 'HomeController@setting');


    $router->resource("vivo_apps", "VivoAppController");
    $router->resource("vivo_accounts", "VivoAccountController");
    $router->resource("vivo_report_data", "VivoReportDatumController");

    $router->resource("baidu_accounts", "BaiduAccountController");
    $router->resource("baidu_report_data", "BaiduReportDatumController");

    $router->resource("uc_accounts", "UcAccountController");
    $router->resource("uc_report_data", "UcReportDatumController");

    $router->resource("tx_accounts", "TxAccountController");
    $router->resource("tx_report_data", "TxReportDatumController");

    $router->resource("jl_apps", "JlAppController");
    $router->resource("jl_accounts", "JlAccountController");
    $router->resource("jl_report_data", "JlReportDatumController");

    $router->resource("ks_apps", "KsAppController");
    $router->resource("ks_accounts", "KsAccountController");
    $router->resource("ks_report_datum", "KsReportDatumController");

    Route::group([
        'prefix' => 'pai',
        'namespace' => '\\App\\Http\\Controllers\\Api'
    ], function () {
        Route::post('pull_account_data', 'PullDataController@pullData');
    });

});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'namespace' => '\\App\\Http\\Controllers\\Api'
], function () {
    Route::get('auth/bd', "AccountAuthController@bdAuth")->name('oauth.bd');
    Route::get('auth/vivo', "AccountAuthController@vivoAuth")->name('oauth.vivo');
    Route::get('auth/jl', "AccountAuthController@juliangAuth")->name('oauth.jl');
    Route::get('auth/ks', "AccountAuthController@ksAuth")->name('oauth.ks');
    Route::get('getBaiduSearchAccount', "AccountAuthController@getBaiduSearchAccount")->name('api.getBaiduSearchAccount');
    Route::get('test', "AccountAuthController@test")->name('api.test');
});

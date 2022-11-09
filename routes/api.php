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
    Route::get('auth/vivo', "AccountAuthController@vivoAuth");
    Route::get('auth/jl', "AccountAuthController@juliangAuth");
    Route::get('auth/ks', "AccountAuthController@ksAuth");

});


Route::get('/test', function () {
    \App\Models\KsAccount::test();
});

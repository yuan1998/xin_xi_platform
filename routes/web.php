<?php

use App\Constants\RunStatus;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/xin_xi/test',function () {
    $account = \App\Models\JlAccount::query()->where('run_status' , RunStatus::OK_STATUS)->first();
    $account->getNewVersionAdConfig();
});

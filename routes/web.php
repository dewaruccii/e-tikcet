<?php

use App\Http\Controllers\Admin\FetchDataController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index']);
Route::group(['prefix' => 'fetch', 'as' => 'fetch.'], function () {
    Route::post('/airport', [FetchDataController::class, 'fetchDataAirport'])->name('airport');
});
Route::group(['prefix' => 'billings', 'middleware' => ['auth'], 'as' => 'billings.', 'controller' => BillingController::class], function () {
    Route::get('/{uuid}', 'index')->name('index');
    Route::get('/{uuid}/information', 'information')->name('information');
});

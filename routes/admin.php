<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\FetchDataController;
use App\Http\Controllers\Admin\MaskapaiController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\AuthController;
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

Route::group(['as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::resource('maskapai', MaskapaiController::class);
    Route::resource('products', ProductController::class);

    Route::group(['prefix' => 'fetch', 'as' => 'fetch.'], function () {
        Route::post('/airport', [FetchDataController::class, 'fetchDataAirport'])->name('airport');
    });
});

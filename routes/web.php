<?php

use App\Http\Controllers\Admin\FetchDataController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Middleware\AdminMiddleware;
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
Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'profile', 'as' => 'profile.', 'controller' => ProfileController::class], function () {

        Route::get('/', 'index')->name('index');
        Route::post('/', 'update')->name('update');
    });
    Route::group(['prefix' => 'billings', 'as' => 'billings.', 'controller' => BillingController::class], function () {
        Route::get('/{uuid}', 'index')->name('index');
        Route::get('/{uuid}/information', 'information')->name('information');
        Route::post('/{uuid}/information', 'storeInformation')->name('storeInformation');
    });
    Route::group(['prefix' => 'cart', 'controller' => CartController::class, 'as' => 'cart.'], function () {
        Route::get('/{uuid}', 'index')->name('index');
        Route::post('/{uuid}', 'store')->name('store');
    });

    Route::group(['prefix' => 'payment', 'controller' => PaymentController::class, 'as' => 'payment.'], function () {
        Route::get('/{uuid}/payment', 'index')->name('index');
        Route::post('/{uuid}/payment', 'store')->name('store');
    });
    Route::group(['prefix' => 'Mytickets', 'as' => 'tickets.', 'controller' => TicketController::class], function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{uuid}/detail', 'detail')->name('detail');
        Route::get('/{uuid}/print', 'print')->name('print');
    });
    Route::resource('pesanan', PesananController::class);
});
Route::get('/check/{uuid}', [PaymentController::class, 'check'])->name('check');
Route::get('/checkSuccess/{uuid}', [PaymentController::class, 'checkStore'])->name('checkStore');
Route::post('/checkPayment', [PaymentController::class, 'checkPayment'])->name('checkPayment');

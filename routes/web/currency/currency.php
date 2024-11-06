<?php

use App\Http\Controllers\Apps\Currency\CurrencyController;
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

Route::prefix('currency')->group(function () {
    Route::controller(CurrencyController::class)->group(function () {
        Route::get('/', 'index')->name('currency.index');
        Route::get('get', 'get')->name('currency.get');
        Route::post('store', 'store')->name('currency.store');
        Route::post('update', 'update')->name('currency.update');
        Route::post('delete', 'delete')->name('currency.delete');
    });
});

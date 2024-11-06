<?php

use App\Http\Controllers\RatesController;
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

Route::prefix('rates')->group(function () {
    Route::controller(RatesController::class)->group(function () {
        Route::get('get', 'get')->name('rates.get');
        Route::post('store', 'store')->name('rates.store');
        Route::put('update', 'update')->name('rates.update');
        Route::delete('delete', 'delete')->name('rates.delete');
    });
});

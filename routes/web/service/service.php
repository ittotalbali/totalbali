<?php

use App\Http\Controllers\Apps\Service\ServiceController;
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

Route::prefix('service')->group(function () {
    Route::controller(ServiceController::class)->group(function () {
        Route::get('/', 'index')->name('service.index');
        Route::get('get', 'get')->name('service.get');
        Route::get('create', 'create')->name('service.create');
        Route::get('edit/{id}', 'edit')->name('service.edit');

        Route::post('store', 'store')->name('service.store');
        Route::post('update', 'update')->name('service.update');
        Route::post('delete', 'delete')->name('service.delete');
    });
});

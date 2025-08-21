<?php

use App\Http\Controllers\Apps\AlbumCategory\AlbumCategoryController;
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

Route::prefix('album-category')->group(function () {
    Route::controller(AlbumCategoryController::class)->group(function () {
        Route::get('/', 'index')->name('album-category.index');
        Route::get('get', 'get')->name('album-category.get');
        Route::post('store', 'store')->name('album-category.store');
        Route::post('update', 'update')->name('album-category.update');
        Route::post('delete', 'delete')->name('album-category.delete');
    });
});

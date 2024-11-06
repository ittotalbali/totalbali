<?php

use App\Http\Controllers\CloseToTheClubsController;
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

Route::prefix('clubs')->group(function () {
    Route::controller(CloseToTheClubsController::class)->group(function () {
        Route::get('get', 'get')->name('clubs.get');
    });
});

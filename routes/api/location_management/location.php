<?php

use App\Http\Controllers\API\LocationManagement\LocationAPIController;
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

Route::prefix('location')->group(function () {
    Route::controller(LocationAPIController::class)->group(function () {
        Route::get('{id?}', 'get');
    });
});

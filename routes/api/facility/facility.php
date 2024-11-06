<?php

use App\Http\Controllers\API\Facility\FacilityAPIController;
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

Route::prefix('facility')->group(function () {
    Route::controller(FacilityAPIController::class)->group(function () {
        Route::get('{id?}', 'get');
    });
});

<?php

use App\Http\Controllers\API\VillaManagement\VillaAPIController;
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

Route::prefix('villa')->group(function () {
    Route::controller(VillaAPIController::class)->group(function () {
        Route::get('/', 'get');
        Route::get('details/{id?}', 'details');
    });
});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::post('login', App\Http\Controllers\Api\LoginController::class)->name('login');
// Route::get('aa', [AuthController::class, 'permission'])->name('aa');
// Route::post('logout', App\Http\Controllers\Api\LogoutController::class)->name('logout');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function() {
    Route::middleware('auth:api')->group(function () {
        // return $request->user();
        Route::get('permission', App\Http\Controllers\API\PermissionAPIController::class)->name('permission');
        // Route::get('role', App\Http\Controllers\Api\RoleController::class)->name('role');
        Route::get('role', App\Http\Controllers\API\RoleAPIController::class)->name('role');

    });
    
    require __DIR__ . '/api/villa_management/villa.php';
    require __DIR__ . '/api/facility/facility.php';
    require __DIR__ . '/api/location_management/area.php';
    require __DIR__ . '/api/location_management/location.php';
    require __DIR__ . '/api/location_management/sub_location.php';
});

// Route::namespace('Auth')->middleware('auth')->group(function () {
//     Route::get('permissions', 'PermissionController');
//     Route::get('roles', 'RoleController');
// });
// Route::get('permission', [PermissionController::class, 'permission'])->name('permission');
// Route::get('role', [RoleController::class, 'role'])->name('role');

// Route::get('create_rate/{id}', [VillasController::class, 'create_rate'])->name('villa.create_rate');
<?php

use App\Http\Controllers\AreasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FacilitiesController;
use App\Http\Controllers\FacilitiesVillasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RatesController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SubLocationController;
use App\Http\Controllers\VillasController;
use App\Http\Controllers\CalendarController;
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

// Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::get('as', [AuthController::class, 'permission'])->name('as');
Route::post('proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

/* Reset Password */
Route::get('forgot_password', [AuthController::class, 'forgot'])->name('forgot_password');
Route::post('forgot_password_process', [AuthController::class, 'password'])->name('forgot_password_process');
Route::get('/reset_password/{token}', [AuthController::class, 'reset_password'])->name('reset_password');
Route::post('update_password/{token}', [AuthController::class, 'update_password'])->name('update_password');
// Route::get('listening', [QuestionController::class, 'listening'])->name('admin.quest.listening');
/**/

Route::get('/register/verify-email/{token}', [AuthController::class, 'verifyMail'])->name('verifyMail');

Route::group(['middleware' => ['auth']], function () {
    Route::prefix('admin/')->name('admin.')->group(function () {
        Route::resource('dashboard', DashboardController::class);
        Route::resource('user', UserController::class);
        Route::resource('role', RolesController::class);
        Route::resource('products', ProductController::class);
        Route::resource('permission', PermissionController::class);
        // Route::resource('countrie', CountriesController::class);
        Route::prefix('countries')->group(function () {
            Route::get('/', [CountriesController::class, 'index'])->name('countries.index');
            Route::post('/store', [CountriesController::class, 'store'])->name('countries.store');
            Route::get('/edit/{id}', [CountriesController::class, 'edit'])->name('countries.edit');
            Route::put('/update/{id}', [CountriesController::class, 'update'])->name('countries.update');
            Route::delete('/destroy/{id}', [CountriesController::class, 'destroy'])->name('countries.destroy');
        });
        Route::prefix('area')->group(function () {
            Route::get('/', [AreasController::class, 'index'])->name('area.index');
            Route::get('/create', [AreasController::class, 'create'])->name('area.create');
            Route::get('/draft', [AreasController::class, 'draft'])->name('area.draft');
            Route::post('/store', [AreasController::class, 'store'])->name('area.store');
            Route::get('/edit/{id}', [AreasController::class, 'edit'])->name('area.edit');
            Route::get('/cek_data/{id}', [AreasController::class, 'cek_data'])->name('area.cek_data');
            Route::put('/update/{id}', [AreasController::class, 'update'])->name('area.update');
            Route::delete('/destroy/{id}', [AreasController::class, 'destroy'])->name('area.destroy');
        });
        Route::prefix('location')->group(function () {
            Route::get('/', [LocationController::class, 'index'])->name('location.index');
            Route::post('/store', [LocationController::class, 'store'])->name('location.store');
            Route::get('/edit/{id}', [LocationController::class, 'edit'])->name('location.edit');
            Route::get('/cek_data/{id}', [LocationController::class, 'cek_data'])->name('location.cek_data');
            Route::put('/update/{id}', [LocationController::class, 'update'])->name('location.update');
            Route::delete('/destroy/{id}', [LocationController::class, 'destroy'])->name('location.destroy');
        });
        Route::prefix('subdistrict')->group(function () {
            Route::get('/', [SubLocationController::class, 'index'])->name('sub_location.index');
            Route::post('/store', [SubLocationController::class, 'store'])->name('sub_location.store');
            Route::get('/edit/{id}', [SubLocationController::class, 'edit'])->name('sub_location.edit');
            Route::put('/update/{id}', [SubLocationController::class, 'update'])->name('sub_location.update');
            Route::delete('/destroy/{id}', [SubLocationController::class, 'destroy'])->name('sub_location.destroy');
            Route::get('/lokasi', [SubLocationController::class, 'lokasi'])->name('sub_location.lokasi');
            Route::get('/getArea', [SubLocationController::class, 'getArea'])->name('sub_location.getArea');
            Route::get('/getLocation', [SubLocationController::class, 'getLocation'])->name('sub_location.getLocation');
            Route::get('/getSubLocation', [SubLocationController::class, 'getSubLocation'])->name('sub_location.getSubLocation');
            Route::get('/Wizard', [SubLocationController::class, 'wizard'])->name('sub_location.wizard');
        });
        Route::resource('faciliti', FacilitiesController::class);
        Route::prefix('faciliti')->group(function () {
            Route::get('/', [FacilitiesController::class, 'index'])->name('faciliti.index');
            Route::post('/store', [FacilitiesController::class, 'store'])->name('faciliti.store');
            Route::get('/edit/{id}', [FacilitiesController::class, 'edit'])->name('faciliti.edit');
            Route::get('/cek_data/{id}', [FacilitiesController::class, 'cek_data'])->name('faciliti.cek_data');
            Route::put('/update/{id}', [FacilitiesController::class, 'update'])->name('faciliti.update');
            Route::delete('/destroy/{id}', [FacilitiesController::class, 'destroy'])->name('faciliti.destroy');
        });
        Route::resource('facility_villa', FacilitiesVillasController::class);

        // Route::prefix('detail')->group(function () {
        //     Route::resource('villa', VillasController::class);
        // });
        Route::prefix('detail')->group(function () {
            Route::get('/', [VillasController::class, 'index'])->name('villa.index');
            Route::get('/create', [VillasController::class, 'create'])->name('villa.create');
            Route::post('/store', [VillasController::class, 'store'])->name('villa.store');
            Route::get('/edit/{id}', [VillasController::class, 'edit'])->name('villa.edit');
            Route::put('/update/{id}', [VillasController::class, 'update'])->name('villa.update');
            Route::delete('/destroy/{id}', [VillasController::class, 'destroy'])->name('villa.destroy');
        });
        //rino
        Route::get('/genrate', [VillasController::class, 'genrate'])->name('villa.generate');
        //endrino
        
        Route::get('villa-by-location', [VillasController::class, 'villa_by_location'])->name('villa.villa-by-location');
        Route::get('search', [VillasController::class, 'search_villa'])->name('villa.search');
        Route::get('{id}/detail', [VillasController::class, 'show'])->name('villa.detail');
        Route::post('villa/change-status', [VillasController::class, 'changeStatus'])->name('villa.change-status');

        Route::get('create_rate/{id}', [VillasController::class, 'create_rate'])->name('villa.create_rate');
        Route::post('store_rate/{id}', [VillasController::class, 'store_rate'])->name('villa.store_rate');
        Route::get('edit_rate/{id}', [VillasController::class, 'edit_rate'])->name('villa.edit_rate');
        Route::put('update_rate/{id}', [VillasController::class, 'update_rate'])->name('villa.update_rate');
        Route::get('kalender/{id}', [VillasController::class, 'kalender'])->name('villa.kalender');
        Route::get('kalender-ical/{id}', [CalendarController::class, 'kalender'])->name('villa.kalender.ical');
        Route::delete('destroy_rate/{id}', [VillasController::class, 'destroy_rate'])->name('villa.destroy_rate');

        Route::get('create_facility/{id}', [VillasController::class, 'create_facility'])->name('villa.create_facility');
        Route::post('store_facility/{id}', [VillasController::class, 'store_facility'])->name('villa.store_facility');
        Route::get('edit_facility/{id}', [VillasController::class, 'edit_facility'])->name('villa.edit_facility');
        Route::put('update_facility/{id}', [VillasController::class, 'update_facility'])->name('villa.update_facility');
        Route::delete('destroy_facility/{id}', [VillasController::class, 'destroy_facility'])->name('villa.destroy_facility');

        Route::get('edit_galeri/{id}', [VillasController::class, 'edit_galeri'])->name('villa.edit_galeri');
        Route::put('update_galeri/{id}', [VillasController::class, 'update_galeri'])->name('villa.update_galeri');
        Route::delete('destroy_galeri/{id}', [VillasController::class, 'destroy_galeri'])->name('villa.destroy_galeri');
        Route::delete('destroy_bedroom/{id}', [VillasController::class, 'destroy_bedroom'])->name('villa.destroy_bedroom');
        Route::delete('destroy_album/{id}', [VillasController::class, 'destroy_album'])->name('villa.destroy_album');
        Route::delete('destroy_album_galeri/{id}', [VillasController::class, 'destroy_album_galeri'])->name('villa.destroy_album_galeri');
        Route::delete('destroy_floorplan/{id}', [VillasController::class, 'destroy_floorplan'])->name('villa.destroy_floorplan');


        Route::get('draft_villa', [VillasController::class, 'draft_villa'])->name('villa.draft_villa');
        Route::post('post_draft_villa', [VillasController::class, 'post_draft_villa'])->name('villa.post_draft_villa');
        Route::post('update_draft_villa', [VillasController::class, 'update_draft_villa'])->name('villa.update_draft_villa');
        Route::post('update_draft_pool', [VillasController::class, 'update_draft_pool'])->name('villa.update_draft_pool');

        Route::resource('booking', BookingController::class);
        Route::get('get_date', [BookingController::class, 'get_date'])->name('booking.get_date');
        Route::get('get_price', [BookingController::class, 'get_price'])->name('booking.get_price');
        Route::get('draft_booking', [BookingController::class, 'draft_booking'])->name('booking.draft_booking');
        Route::post('post_draft', [BookingController::class, 'post_draft'])->name('booking.post_draft');
        Route::post('update_draft', [BookingController::class, 'update_draft'])->name('booking.update_draft');

        Route::put('update-password/{userid}', [UserController::class, 'update_password'])->name('user.update-password');

        Route::get('experience/beach/{id}', [VillasController::class, 'create_beach'])->name('villa.create_beach');
        Route::post('store_beach/{id}', [VillasController::class, 'store_beach'])->name('villa.store_beach');
        Route::get('experience/edit/{id}/beach', [VillasController::class, 'edit_beach'])->name('villa.edit_beach');
        Route::put('update_beach/{id}', [VillasController::class, 'update_beach'])->name('villa.update_beach');
        Route::delete('destroy_beach/{id}', [VillasController::class, 'destroy_beach'])->name('villa.destroy_beach');
        
        Route::get('experience/close/{id}', [VillasController::class, 'create_close'])->name('villa.create_close');
        Route::post('store_close/{id}', [VillasController::class, 'store_close'])->name('villa.store_close');
        Route::get('experience/edit/{id}/close', [VillasController::class, 'edit_close'])->name('villa.edit_close');
        Route::put('update_close/{id}', [VillasController::class, 'update_close'])->name('villa.update_close');
        Route::delete('destroy_close/{id}', [VillasController::class, 'destroy_close'])->name('villa.destroy_close');

        Route::get('experience/family/{id}', [VillasController::class, 'create_family'])->name('villa.create_family');
        Route::post('store_family/{id}', [VillasController::class, 'store_family'])->name('villa.store_family');
        Route::get('experience/edit/{id}/family', [VillasController::class, 'edit_family'])->name('villa.edit_family');
        Route::put('update_family/{id}', [VillasController::class, 'update_family'])->name('villa.update_family');
        Route::delete('destroy_family/{id}', [VillasController::class, 'destroy_family'])->name('villa.destroy_family');

        Route::get('experience/mountain/{id}', [VillasController::class, 'create_mountain'])->name('villa.create_mountain');
        Route::post('store_mountain/{id}', [VillasController::class, 'store_mountain'])->name('villa.store_mountain');
        Route::get('experience/edit/{id}/mountain', [VillasController::class, 'edit_mountain'])->name('villa.edit_mountain');
        Route::put('update_mountain/{id}', [VillasController::class, 'update_mountain'])->name('villa.update_mountain');
        Route::delete('destroy_mountain/{id}', [VillasController::class, 'destroy_mountain'])->name('villa.destroy_mountain');

        Route::get('experience/retreats/{id}', [VillasController::class, 'create_retreats'])->name('villa.create_retreats');
        Route::post('store_retreats/{id}', [VillasController::class, 'store_retreats'])->name('villa.store_retreats');
        Route::get('experience/edit/{id}/retreats', [VillasController::class, 'edit_retreats'])->name('villa.edit_retreats');
        Route::put('update_retreats/{id}', [VillasController::class, 'update_retreats'])->name('villa.update_retreats');
        Route::delete('destroy_retreats/{id}', [VillasController::class, 'destroy_retreats'])->name('villa.destroy_retreats');

        Route::get('experience/wedding/{id}', [VillasController::class, 'create_wedding'])->name('villa.create_wedding');
        Route::post('store_wedding/{id}', [VillasController::class, 'store_wedding'])->name('villa.store_wedding');
        Route::get('experience/edit/{id}/wedding', [VillasController::class, 'edit_wedding'])->name('villa.edit_wedding');
        Route::put('update_wedding/{id}', [VillasController::class, 'update_wedding'])->name('villa.update_wedding');
        Route::delete('destroy_wedding/{id}', [VillasController::class, 'destroy_wedding'])->name('villa.destroy_wedding');

        Route::prefix('villa-management')->group(function() {
            require __DIR__ . '/web/villa_management/rates.php';
            require __DIR__ . '/web/villa_management/clubs.php';
        });

        require __DIR__ . '/web/currency/currency.php';
        require __DIR__ . '/web/service/service.php';
        require __DIR__ . '/web/album_category/album_category.php';
    });
    // MiDDLEWARE
    // Route::prefix('admin/')->name('admin.')->middleware(['admin_role'])->group(function () {
    //     Route::resource('dashboard', DashboardController::class);
    //     Route::resource('user', UserController::class);
    //     Route::resource('roles', RolesController::class);
    //     Route::resource('products', ProductController::class);

    //     Route::put('update-password/{userid}', [UserController::class, 'update_password'])->name('user.update-password');
    // });

    // UNTUK USER
    Route::prefix('user/')->name('user.')->group(function () {
    });
});
Route::get('/maps', [HomeController::class, 'maps'])->name('maps');
Route::get('/region/{slug}', [HomeController::class, 'region'])->name('region');
// Route::get('/welcome', [HomeController::class, 'index'])->name('welcome');
Route::get('/geojson', [HomeController::class, 'geojson'])->name('geojson');
Route::get('/regionjson/{id}', [HomeController::class, 'regionjson'])->name('regionjson');
Route::post('/getpoint', [HomeController::class, 'getpoint'])->name('getpoint');
Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
Route::post('admin/calendar/import/{id}', [CalendarController::class, 'import'])->name('admin.calendar.import');

require __DIR__ . '/web/test/test.php';
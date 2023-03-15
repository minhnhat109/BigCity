<?php

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
Route::get('/',[\App\Http\Controllers\Admin\RoomCategoryController::class, 'index']);

Route::group(['prefix' => '/admin'], function() {
    Route::group(['prefix' => '/room-category'], function() {
        Route::get('/', [\App\Http\Controllers\Admin\RoomCategoryController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Admin\RoomCategoryController::class, 'store']);
        Route::get('/get-data', [\App\Http\Controllers\Admin\RoomCategoryController::class, 'getData']);
        Route::get('/update-status/{id}', [\App\Http\Controllers\Admin\RoomCategoryController::class, 'updateStatus']);

        Route::get('/edit/{id}', [\App\Http\Controllers\Admin\RoomCategoryController::class, 'edit']);
        Route::post('/update', [\App\Http\Controllers\Admin\RoomCategoryController::class, 'update']);
        Route::get('/destroy/{id}', [\App\Http\Controllers\Admin\RoomCategoryController::class, 'destroy']);
    });

    Route::group(['prefix' => '/account-admin'], function() {
        Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Admin\AdminController::class, 'store']);
        Route::post('/check-email', [\App\Http\Controllers\Admin\AdminController::class, 'checkemail']);
        Route::get('/get-data', [\App\Http\Controllers\Admin\AdminController::class, 'getData']);
        Route::get('/update-status/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'updateStatus']);
        Route::get('/edit/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'edit']);
        Route::post('/update', [\App\Http\Controllers\Admin\AdminController::class, 'update']);
        Route::get('/destroy/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'destroy']);
    });

    Route::group(['prefix' => '/landlord'], function() {
        Route::get('/', [\App\Http\Controllers\Admin\LandlordController::class, 'index']);
        Route::get('/get-data', [\App\Http\Controllers\Admin\LandlordController::class, 'getData']);
        Route::get('/update-status/{id}', [\App\Http\Controllers\Admin\LandlordController::class, 'updateStatus']);
        Route::get('/destroy/{id}', [\App\Http\Controllers\Admin\LandlordController::class, 'destroy']);
    });

    Route::get('/logout', [\App\Http\Controllers\Admin\AdminController::class, 'logout']);
});

Route::group(['prefix' => '/landlord'], function() {
    Route::group(['prefix' => '/room'], function() {
        Route::get('/', [\App\Http\Controllers\Landlord\RoomController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Landlord\RoomController::class, 'store']);
        Route::get('/list-room', [\App\Http\Controllers\Landlord\RoomController::class, 'viewListRoom']);
        Route::get('/get-category', [\App\Http\Controllers\Landlord\RoomController::class, 'getCategory']);
        Route::get('/get-data', [\App\Http\Controllers\Landlord\RoomController::class, 'getData']);
        Route::get('/update-status/{id}', [\App\Http\Controllers\Landlord\RoomController::class, 'updateStatus']);
        Route::get('/destroy/{id}', [\App\Http\Controllers\Landlord\RoomController::class, 'destroy']);
        Route::get('/edit/{id}', [\App\Http\Controllers\Landlord\RoomController::class, 'edit']);
        Route::post('/update', [\App\Http\Controllers\Landlord\RoomController::class, 'update']);
        Route::post('/check-product-id', [\App\Http\Controllers\Landlord\RoomController::class, 'checkProuctId']);
    });

    Route::get('/my-information', [\App\Http\Controllers\Landlord\LandlordController::class, 'viewInfor']);
    Route::get('/my-information/data', [\App\Http\Controllers\Landlord\LandlordController::class, 'getInfor']);
    Route::post('/my-information/update', [\App\Http\Controllers\Landlord\LandlordController::class, 'update']);
    Route::post('/my-information/change-password', [\App\Http\Controllers\Landlord\LandlordController::class, 'changePassword']);

    Route::get('/logout', [\App\Http\Controllers\Landlord\LandlordController::class, 'logout']);
});

Route::group(['prefix' => '/home'], function() {
    Route::get('/', [\App\Http\Controllers\User\HomeController::class, 'index']);
    Route::get('/get-data-room', [\App\Http\Controllers\User\HomeController::class, 'getDataRoom']);
    Route::get('/room-detail/{id}', [\App\Http\Controllers\User\HomeController::class, 'viewRoomDetail']);
});

Route::get('/admin/login', [\App\Http\Controllers\Admin\AdminController::class, 'viewLogin']);
Route::post('/admin/login', [\App\Http\Controllers\Admin\AdminController::class, 'actionLogin']);

Route::get('/landlord/register', [\App\Http\Controllers\Landlord\LandlordController::class, 'viewRegister']);
Route::post('/landlord/register', [\App\Http\Controllers\Landlord\LandlordController::class, 'actionRegister']);
Route::get('/landlord/login', [\App\Http\Controllers\Landlord\LandlordController::class, 'viewLogin']);
Route::post('/landlord/login', [\App\Http\Controllers\Landlord\LandlordController::class, 'actionLogin']);

Route::group(['prefix' => 'laravel-filemanager',], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});













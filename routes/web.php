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
Route::get('/',[\App\Http\Controllers\User\HomeController::class, 'index']);
Route::get('/test',[\App\Http\Controllers\User\HomeController::class, 'test']);
Route::get('/test1',[\App\Http\Controllers\User\HomeController::class, 'test1']);


Route::group(['prefix' => '/admin', 'middleware' => 'AdminMiddleware'], function() {
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

    Route::group(['prefix' => '/user'], function() {
        Route::get('/', [\App\Http\Controllers\Admin\UserController::class, 'index']);
        Route::get('/get-data', [\App\Http\Controllers\Admin\UserController::class, 'getData']);
        Route::get('/update-status/{id}', [\App\Http\Controllers\Admin\UserController::class, 'updateStatus']);
        Route::get('/destroy/{id}', [\App\Http\Controllers\Admin\UserController::class, 'destroy']);
    });

    Route::get('/logout', [\App\Http\Controllers\Admin\AdminController::class, 'logout']);
});

Route::group(['prefix' => '/landlord', 'middleware' => 'LandlordMiddleware'], function() {
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
    Route::get('/get-data-category', [\App\Http\Controllers\User\HomeController::class, 'getDataCategory']);
    Route::get('/room-detail/{id}', [\App\Http\Controllers\User\HomeController::class, 'viewRoomDetail']);
    Route::post('/search', [\App\Http\Controllers\User\HomeController::class, 'search']);
});

Route::group(['prefix' => '/home', 'middleware' => 'UserMiddleware'], function() {
    Route::get('/payment/{id}', [\App\Http\Controllers\User\HomeController::class, 'viewPayment']);
    Route::get('/momo-payment/{id}', [\App\Http\Controllers\User\PaymentController::class, 'momoPayment']);
    Route::get('/thanks', [\App\Http\Controllers\User\PaymentController::class, 'viewThank']);
    Route::post('/create-payment', [\App\Http\Controllers\User\PaymentController::class, 'createPayment']);
    Route::get('/my-account', [\App\Http\Controllers\User\UserController::class, 'viewMyAccount']);
    Route::get('/get-data-my-account', [\App\Http\Controllers\User\UserController::class, 'getDataMyAccount']);
    Route::get('/change-password', [\App\Http\Controllers\User\UserController::class, 'viewChangePass']);
    Route::post('/my-account/change-password', [\App\Http\Controllers\User\UserController::class, 'changePassword']);
    Route::post('/my-account/update', [\App\Http\Controllers\User\UserController::class, 'updateInfor']);
    Route::get('/logout', [\App\Http\Controllers\User\UserController::class, 'logout']);
    Route::get('/get-data-transaction', [\App\Http\Controllers\User\PaymentController::class, 'getDataTransaction']);
    Route::get('/history-transaction', [\App\Http\Controllers\User\UserController::class, 'viewTransaction']);
});

Route::get('/register', [\App\Http\Controllers\User\UserController::class, 'viewRegister']);
Route::post('/register', [\App\Http\Controllers\User\UserController::class, 'actionRegister']);
Route::get('/login', [\App\Http\Controllers\User\UserController::class, 'viewLogin']);
Route::post('/login', [\App\Http\Controllers\User\UserController::class, 'actionLogin']);

Route::get('/admin/login', [\App\Http\Controllers\Admin\AdminController::class, 'viewLogin']);
Route::post('/admin/login', [\App\Http\Controllers\Admin\AdminController::class, 'actionLogin']);

Route::get('/landlord/register', [\App\Http\Controllers\Landlord\LandlordController::class, 'viewRegister']);
Route::post('/landlord/register', [\App\Http\Controllers\Landlord\LandlordController::class, 'actionRegister']);
Route::get('/landlord/login', [\App\Http\Controllers\Landlord\LandlordController::class, 'viewLogin']);
Route::post('/landlord/login', [\App\Http\Controllers\Landlord\LandlordController::class, 'actionLogin']);

Route::group(['prefix' => 'laravel-filemanager',], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});













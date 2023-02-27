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
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);

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

    Route::get('/logout', [\App\Http\Controllers\AdminController::class, 'logout']);
});

Route::get('/admin/login', [\App\Http\Controllers\AdminController::class, 'viewLogin']);
Route::post('/admin/login', [\App\Http\Controllers\AdminController::class, 'actionLogin']);

Route::group(['prefix' => 'laravel-filemanager',], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});













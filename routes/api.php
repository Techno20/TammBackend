<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UploaderController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\User\UserServiceController;
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

/* PATTERNS */
Route::pattern('id', '[0-9]+');
Route::pattern('service_id', '[0-9]+');

Route::group(['middleware' => 'api-localization'],function(){
    Route::group(['prefix' => 'user'],function(){
        Route::get('auth-invalid-token', [AuthController::class, 'getAuthInvalidToken'])->name('login');
        Route::post('register', [AuthController::class, 'postRegister']);
        Route::post('login', [AuthController::class, 'postLogin']);
        Route::group(['prefix' => 'password'], function() {
            Route::post('forget', [AuthController::class, 'postForgetPassword']);
            Route::post('verify-code', [AuthController::class, 'postVerifyForgetPasswordCode']);
            Route::post('reset', [AuthController::class, 'postResetPassword']);
        });
        
        Route::group(['middleware' => 'auth'],function(){
            Route::get('me', [AuthController::class, 'getMe']);
            Route::get('refresh', [AuthController::class, 'getRefresh']);
            Route::get('logout', [AuthController::class, 'getLogout']);
            Route::post('update', [AuthController::class, 'postUpdateProfile']);
            Route::post('add-skill', [AuthController::class, 'postAddSkill']);
            Route::post('delete-skill', [AuthController::class, 'deleteSkill']);

            Route::group(['prefix' => 'service'],function(){
                Route::get('show/{service_id}', [UserServiceController::class, 'getShow']);
                Route::post('add', [UserServiceController::class, 'Save']);
                Route::post('edit/{service_id}', [UserServiceController::class, 'Save']);
                Route::delete('delete/{service_id}', [UserServiceController::class, 'Delete']);
            });
        });
        
    });

    Route::group(['prefix' => 'service'],function(){
        Route::get('home', [ServiceController::class, 'getHomeData']);
        Route::get('list', [ServiceController::class, 'getList']);
        Route::get('show/{service_id}', [ServiceController::class, 'getShow']);
        Route::get('reviews/{service_id}', [ServiceController::class, 'getReviews']);
    });

    Route::group(['prefix' => 'upload'], function() {
        Route::post('{type}', [UploaderController::class, 'postUpload'])->where('type','service-image|service-video|user-avatar|attachment');
    });

    Route::group(['prefix' => 'helpers'], function() {
        Route::get('default', [HelperController::class, 'getDefault']);
        Route::get('lists', [HelperController::class, 'getLists']);
        Route::post('contact-us', [HelperController::class, 'postContactUs']);
    });
});
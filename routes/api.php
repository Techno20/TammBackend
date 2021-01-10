<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UploaderController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\User\UserServiceController;
use App\Http\Controllers\User\UserFavouriteController;
use App\Http\Controllers\User\UserBuyerController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\UserOrderController;
use App\Http\Controllers\User\UserConversationController;
use App\Http\Controllers\Admin\AdminDatatableController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\Admin\AdminHelpersController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminFinancialTransactionController;
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
        Route::get('profile/{user_id}', [UserProfileController::class, 'getProfile']);
        Route::get('dashboard', [UserProfileController::class, 'getDashboard']);
        
        Route::group(['middleware' => 'auth'],function(){
            Route::get('me', [AuthController::class, 'getMe']);
            Route::get('refresh', [AuthController::class, 'getRefresh']);
            Route::get('logout', [AuthController::class, 'getLogout']);
            Route::post('update', [AuthController::class, 'postUpdateProfile']);
            Route::post('add-skill', [AuthController::class, 'postAddSkill']);
            Route::post('delete-skill', [AuthController::class, 'deleteSkill']);

            Route::group(['prefix' => 'service'],function(){
                Route::get('list', [UserServiceController::class, 'getList']);
                Route::get('show/{service_id}', [UserServiceController::class, 'getShow']);
                Route::post('add', [UserServiceController::class, 'Save']);
                Route::post('edit/{service_id}', [UserServiceController::class, 'Save']);
                Route::post('activation/{service_id}', [UserServiceController::class, 'postActivation']);
                Route::delete('delete/{service_id}', [UserServiceController::class, 'Delete']);
            });
            
            Route::group(['prefix' => 'order'],function(){
                Route::get('list/{type}', [UserOrderController::class, 'getList'])->where('type','seller|buyer');
                Route::get('show/{order_id}', [UserOrderController::class, 'getShow']);
                Route::post('delivery/{order_id}', [UserOrderController::class, 'postDelivery']);
            });
            
            Route::group(['prefix' => 'favourite'],function(){
                Route::get('list', [UserFavouriteController::class, 'getList']);
                Route::post('add-service/{service_id}', [UserFavouriteController::class, 'postAddService']);
                Route::delete('delete-service/{service_id}', [UserFavouriteController::class, 'deleteService']);
            });

            Route::group(['prefix' => 'conversation'],function(){
                Route::get('list', [UserConversationController::class, 'getList']);
                Route::get('messages/{conversation_id}', [UserConversationController::class, 'getMessages']);
                Route::post('send-reply/{conversation_id}', [UserConversationController::class, 'postSendReply']);
                Route::post('send-message', [UserConversationController::class, 'postSendMessage']);
            });

            Route::group(['prefix' => 'buyer'],function(){
                Route::get('list', [UserBuyerController::class, 'getList']);
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

    Route::group(['prefix' => 'checkout'], function() {
        Route::get('order-details', [CheckoutController::class, 'getOrderDetails']);
        Route::post('send-order', [CheckoutController::class, 'postSendOrder']);
    });

    Route::group(['prefix' => 'helpers'], function() {
        Route::get('default', [HelperController::class, 'getDefault']);
        Route::get('lists', [HelperController::class, 'getLists']);
        Route::post('contact-us', [HelperController::class, 'postContactUs']);
    });
});

/* ADMIN ROUTES */
Route::group(['prefix' => 'admin','middleware' => ['auth','admin']],function(){

    Route::group(['prefix' => 'datatable'],function(){
        Route::get('{module}', [AdminDatatableController::class, 'getModule']);
        Route::get('export/{module}', [AdminDatatableController::class, 'getModule'])->name('datatable_export');
    });
    
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('general', [AdminDashboardController::class, 'getGeneral']);
    });
    
    Route::group(['prefix' => 'service'], function () {
        Route::get('show/{service_id}', [AdminServiceController::class, 'getShow']);
        Route::put('set-approval/{service_id}', [AdminServiceController::class, 'putSetApproval']);
        Route::delete('delete/{service_id}', [AdminServiceController::class, 'Delete']);
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('show/{user_id}', [AdminUserController::class, 'getShow']);
        Route::delete('delete/{user_id}', [AdminUserController::class, 'Delete']);
        Route::post('edit/{user_id}', [AdminUserController::class, 'postEdit']);
    });

    Route::group(['prefix' => 'order'], function () {
        Route::get('show/{id}', [AdminOrderController::class, 'getShow']);
    });

    Route::group(['prefix' => 'helpers'], function () {
        Route::get('list/{type}', [AdminHelpersController::class, 'getList']);
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('show', [AdminHelpersController::class, 'getSettings']);
        Route::post('save', [AdminHelpersController::class, 'postSaveSettings']);
    });

    Route::group(['prefix' => 'financial-transaction'], function () {
        Route::get('show/{id}', [AdminFinancialTransactionController::class, 'getShow']);
        Route::post('reject/{id}', [AdminFinancialTransactionController::class, 'postReject']);
        Route::post('pay/{id}', [AdminFinancialTransactionController::class, 'postPay']);
        Route::post('requested/{id}', [AdminFinancialTransactionController::class, 'postRequested']);
    });

});
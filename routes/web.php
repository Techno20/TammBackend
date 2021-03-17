<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UploaderController;
use App\Http\Controllers\User\UserBuyerController;
use App\Http\Controllers\User\UserConversationController;
use App\Http\Controllers\User\UserFavouriteController;
use App\Http\Controllers\User\UserOrderController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\UserServiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;

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

/* PATTERNS */
Route::pattern('id', '[0-9]+');
Route::pattern('service_id', '[0-9]+');

Route::group(['middleware' => 'api-localization'],function(){
    Route::group(['prefix' => 'user'],function(){
        Route::get('auth-invalid-token', [AuthController::class, 'getAuthInvalidToken'])->name('login');
        Route::post('register', [AuthController::class, 'postRegister']);
        Route::post('login', [AuthController::class, 'postLogin']);
        Route::get('/reset-password/{token}' , [AuthController::class , 'getResetPassword'])
            ->middleware('guest')->name('password.reset');
        Route::post('reset-password' , [AuthController::class, 'resetPassword'])->name('reset.password');
        Route::group(['prefix' => 'password'], function() {
            Route::post('forget', [AuthController::class, 'postForgetPassword']);
            Route::post('verify-code', [AuthController::class, 'postVerifyForgetPasswordCode']);
            Route::post('reset', [AuthController::class, 'postResetPassword']);
        });



        Route::get('profile/{user_id}', [UserProfileController::class, 'getProfile']);
        Route::get('dashboard', [UserProfileController::class, 'getDashboard']);
        Route::get('profile', [UserProfileController::class, 'getMyProfile']);
        Route::GET('getprofileupdat' , [UserProfileController::class, 'getMyProfileupdat']);
        Route::get('make-notifications-read' , [UserProfileController::class, 'makeAllUserNotificationsRead']);

        Route::group(['middleware' => 'auth'],function(){
            Route::get('me', [AuthController::class, 'getMe']);
            Route::get('refresh', [AuthController::class, 'getRefresh']);
            Route::get('logout', [AuthController::class, 'getLogout']);
            Route::post('update', [AuthController::class, 'postUpdateProfile']);
            Route::post('add-skill', [AuthController::class, 'postAddSkill']);
            Route::post('delete-skill', [AuthController::class, 'deleteSkill']);

            Route::group(['prefix' => 'service'],function(){
                Route::get('get-categories', [UserServiceController::class, 'getCategories'])->name('categories');
                Route::get('list', [UserServiceController::class, 'getList']);
                Route::get('show/{service_id}', [UserServiceController::class, 'getShow']);
                Route::get('add/{id?}', [UserServiceController::class, 'getForm']);
                Route::post('add', [UserServiceController::class, 'Save']);
                Route::post('edit/{service_id}', [UserServiceController::class, 'Save']);
                Route::post('activation/{service_id}', [UserServiceController::class, 'postActivation']);
                Route::delete('delete/{service_id}', [UserServiceController::class, 'Delete']);
                Route::get('pricing', [UserServiceController::class, 'getPricing']);
                Route::get('description', [UserServiceController::class, 'getDescription']);
                Route::post('like' , [UserServiceController::class, 'likeService'])->name('service.like');
//                Route::get('description', [UserServiceController::class, 'getDescription']);
            });

            Route::group(['prefix' => 'order'],function(){
                Route::get('list/{type}', [UserOrderController::class, 'getList'])->where('type','seller|buyer|all');
                Route::get('show/{order_id}', [UserOrderController::class, 'getShow'])->name('user.order.details');
                Route::post('delivery/{order_id}', [UserOrderController::class, 'postDelivery'])->name('user.order.post.delivery');
                Route::post('rating/{order_id}', [UserOrderController::class, 'postRating'])->name('user.order.post.rating');
            });

            Route::group(['prefix' => 'favourite'],function(){
                Route::get('list', [UserFavouriteController::class, 'getList']);
                Route::post('add-service/{service_id}', [UserFavouriteController::class, 'postAddService']);
                Route::delete('delete-service/{service_id}', [UserFavouriteController::class, 'deleteService']);
            });

            Route::group(['prefix' => 'conversation'],function(){
                Route::get('list', [UserConversationController::class, 'getList'])->name('conversation.list');
                Route::get('messages', [UserConversationController::class, 'getMessages'])->name('conversation.get_messages');
                Route::post('send-reply', [UserConversationController::class, 'postSendReply'])->name('conversation.send.reply');
                Route::post('send-message', [UserConversationController::class, 'postSendMessage'])->name('user.conversation.send.message');
            });

            Route::group(['prefix' => 'buyer'],function(){
                Route::get('list', [UserBuyerController::class, 'getList']);
            });
        });

    });

    Route::group(['prefix' => ''],function(){
        Route::get('/', [ServiceController::class, 'getHomeData'])->name('home');
        Route::get('/payment_response', [ServiceController::class, 'payment_response']);
        Route::get('home', [ServiceController::class, 'getHomeData']);
        Route::get('lang/{lang}', [SiteController::class, 'changeLanguage']);

        Route::get('search', [SiteController::class, 'getSearch']);

        Route::get('about-us', [SiteController::class, 'getAboutUs']);
        Route::get('pages/{page}', [SiteController::class, 'getContentPages'])->name('pages');
        Route::get('how-it-work', [SiteController::class, 'getHowItWok']);
        Route::get('logout', [SiteController::class, 'getLogout']);
    });
        Route::group(['prefix' => 'service'],function(){
        Route::get('categories/{main_category?}', [ServiceController::class, 'getCategories']);
        Route::get('list/{category?}', [ServiceController::class, 'getList']);
        // Route::get('show/{service_id}/recipient_id/{recipient_id}', [ServiceController::class, 'getShow']);
        Route::get('show/{service_id}', [ServiceController::class, 'getShow'])->name('service.details');

        Route::get('reviews/{service_id}', [ServiceController::class, 'getReviews']);
    });

    Route::group(['prefix' => 'upload'], function() {
        Route::post('{type}', [UploaderController::class, 'postUpload'])->where('type','service-image|service-video|user-avatar|attachment');
    });

    Route::prefix('checkout')->middleware('auth')->group(function() {
        Route::get('order-details', [CheckoutController::class, 'getOrderDetails']);
        Route::post('send-order', [CheckoutController::class, 'postSendOrder']);
    });

    Route::group(['prefix' => 'helpers'], function() {
        Route::get('default', [HelperController::class, 'getDefault']);
        Route::get('lists', [HelperController::class, 'getLists']);
        Route::post('contact-us', [HelperController::class, 'postContactUs']);
    });

    Route::resource('/contactus', 'App\Http\Controllers\ContactusController');
    Route::post('/delete_image', 'App\Http\Controllers\HelperController@delete_image')->name('services.delete_image');
    Route::put('/user/me/update', 'App\Http\Controllers\User\UserProfileController@updatePassword');
});





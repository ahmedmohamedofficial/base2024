<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\WalletController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\ComplaintController;
use App\Http\Controllers\Api\User\AuthController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\SettlementController;
use App\Http\Controllers\Api\User\ProfileController;
use App\Http\Controllers\Api\User\NotificationController;
use App\Http\Controllers\Api\CountriesAndCitiesController;
use App\Http\Controllers\Api\User\ForgetPasswordController;

Route::group(['middleware'=>['guest:sanctum']],function(){

    // authentication
        Route::post('sign-up'                                 ,[AuthController::class,       'register']);
        Route::patch('activate'                               ,[AuthController::class,       'activate']);
        Route::get('resend-code'                              ,[AuthController::class,       'resendCode']);
        Route::post('sign-in'                                 ,[AuthController::class,       'login']);
    // authentication

    // forgot password
        Route::post('forget-password-send-code'               ,[ForgetPasswordController::class,       'forgetPasswordSendCode']);
        Route::post('forget-password-check-code'              ,[ForgetPasswordController::class,       'forgetPasswordCheckCode']);
        Route::post('reset-password'                          ,[ForgetPasswordController::class,       'resetPassword']);
    // forgot password
});


Route::group(['middleware'=>['OptionalSanctumMiddleware']],function(){

    Route::get('about',                                   [SettingController::class,     'about']);
    Route::get('terms',                                   [SettingController::class,     'terms']);
    Route::get('privacy',                                 [SettingController::class,     'privacy']);
    Route::get('intros',                                  [SettingController::class,     'intros']);
    Route::get('fqss',                                    [SettingController::class,     'fqss']);
    Route::get('socials',                                 [SettingController::class,     'socials']);
    Route::get('images',                                  [SettingController::class,     'images']);
    Route::get('categories/{id?}',                        [SettingController::class,     'categories']);
    Route::post('check-coupon',                           [SettingController::class,     'checkCoupon']);
    Route::get('is-production',                           [SettingController::class,     'isProduction']);
    
    
    Route::get('countries',                               [CountriesAndCitiesController::class,     'countries']);
    Route::get('countries-with-cities',                   [CountriesAndCitiesController::class,     'countriesWithCities']);
    Route::get('cities',                                  [CountriesAndCitiesController::class,     'cities']);
    Route::get('country/{country_id}/cities',             [CountriesAndCitiesController::class,     'CountryCities']);
    Route::get('payment-brands'                         ,[SettingController::class,       'paymentBrands']);


});

Route::group(['middleware'=>['auth:sanctum','is-active']],function () {

    // authentication
        Route::delete('sign-out'                            ,[AuthController::class,       'logout']);
        Route::post('delete-account'                        ,[AuthController::class,       'deleteAccount']);
    // authentication
    
    // wallet
        Route::get('show-wallet'                            ,[WalletController::class,       'show']);
        Route::post('charge-wallet'                         ,[WalletController::class,       'charge']);
        // wallet
        
    // profile
        Route::get('profile'                                  ,[ProfileController::class,       'getProfile']);
        Route::put('update-profile'                           ,[ProfileController::class,       'updateProfile']);
        Route::patch('update-passward'                        ,[ProfileController::class,       'updatePassword']);
        // profile
        
    // update phone
        Route::post('check-password'                          ,[ProfileController::class,       'checkPassword']);
        Route::post('change-phone-send-code'                  ,[ProfileController::class,       'changePhoneSendCode']);
        Route::post('change-phone-resend-code'                ,[ProfileController::class,       'changePhoneReSendCode']);
        Route::post('change-phone-check-code'                 ,[ProfileController::class,       'changePhoneCheckCode']);
    // update phone
    
    // user
        Route::patch('change-lang'                            ,[UserController::class,       'changeLang']);
    // user
    
    // notifications 
        Route::patch('switch-notify'                          ,[NotificationController::class,       'switchNotificationStatus']);
        Route::get('notifications'                            ,[NotificationController::class,       'getNotifications']);
        Route::get('count-notifications'                      ,[NotificationController::class,       'countUnreadNotifications']);
        Route::delete('delete-notification/{notification_id}' ,[NotificationController::class,       'deleteNotification']);
        Route::delete('delete-notifications'                  ,[NotificationController::class,       'deleteNotifications']);
    // notifications 
    
    // complaints 
        Route::post('new-complaint'                           ,[ComplaintController::class   ,  'StoreComplaint']);
    // complaints 
    
    // settlement
        Route::post('settlement-request'                      ,[SettlementController::class  , 'settlementRequest']);
    // settlement



    
    // chat
        // Route::get('create-room',                             [ChatController::class,        'createRoom']);
        // Route::post('create-private-room',                    [ChatController::class,        'createPrivateRoom']);
        // Route::get('room-members/{room}',                     [ChatController::class,        'getRoomMembers']);
        // Route::get('join-room/{room}',                        [ChatController::class,        'joinRoom']);
        // Route::get('leave-room/{room}',                       [ChatController::class,        'leaveRoom']);
        // Route::get('get-room-messages/{room}',                [ChatController::class,        'getRoomMessages']);
        // Route::get('get-room-unseen-messages/{room}',         [ChatController::class,        'getRoomUnseenMessages']);
        // Route::get('get-rooms',                               [ChatController::class,        'getMyRooms']);
        // Route::delete('delete-message-copy/{message}',        [ChatController::class,        'deleteMessageCopy']);
        // Route::post('send-message/{room}',                    [ChatController::class,        'sendMessage']);
        // Route::post('upload-room-file/{room}',                [ChatController::class,        'uploadRoomFile']);
    // chat

});





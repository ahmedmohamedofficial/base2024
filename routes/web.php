<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\FqsController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\IntroController;
use App\Http\Controllers\Admin\IntroFqsCategoryController;
use App\Http\Controllers\Admin\IntroFqsController;
use App\Http\Controllers\Admin\IntroHowWorkController;
use App\Http\Controllers\Admin\IntroMessagesController;
use App\Http\Controllers\Admin\IntroPartenerController;
use App\Http\Controllers\Admin\IntroServiceController;
use App\Http\Controllers\Admin\IntroSetting;
use App\Http\Controllers\Admin\IntroSliderController;
use App\Http\Controllers\Admin\IntroSocialController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SMSController;
use App\Http\Controllers\Admin\SocialController;
use App\Http\Controllers\Admin\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ComplaintController;

Route::group(['as' => 'admin.'], function () {

    // Set Language For Admin
    Route::get('/lang/{lang}', 'AuthController@SetLanguage');
    // guest routes for admin
    Route::group(['middleware' => ['guest:admin']], function () {
        Route::get('login', 'AuthController@showLoginForm')->name('show.login')->middleware('guest:admin');
        Route::post('login', 'AuthController@login')->name('login');
    });



    Route::get('logout', 'AuthController@logout')->name('logout');

    Route::group(['middleware' => ['admin']], function () {

        Route::get('profile', [HomeController::class, 'profile'])->name('profile');


        Route::put('profile-update', [HomeController::class, 'updateProfile'])->name('profile.update');
        Route::put('profile-update-password', [HomeController::class, 'updatePassword'])->name('profile.update_password');

        Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

        /*------------ end Of profile----------*/

        /*------------ start Of Dashboard----------*/
        /*------------ end Of dashboard ----------*/

        /*------------ start Of intro site  ----------*/
        Route::group([], function () {


            Route::get('intro-settings', [IntroSetting::class, 'index'])->name('intro_site');

            /*------------ start Of introsliders ----------*/
            Route::group(['prefix' => 'introsliders', 'as' => 'introsliders.'], function () {
                Route::get('/', [IntroSliderController::class, 'index'])->name('index');
                Route::get('/create', [IntroSliderController::class, 'create'])->name('create');
                Route::post('/store', [IntroSliderController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [IntroSliderController::class, 'edit'])->name('edit');
                Route::put('/{id}', [IntroSliderController::class, 'update'])->name('update');
                Route::get('/{id}/Show', [IntroSliderController::class, 'show'])->name('show');
                Route::delete('/{id}', [IntroSliderController::class, 'destroy'])->name('delete');
                Route::post('delete-all-introsliders', [IntroSliderController::class, 'destroyAll'])->name('deleteAll');
                Route::get('export', [IntroSliderController::class, 'export'])->name('export');
            });

            /*------------ end Of introsliders ----------*/

            /*------------ start Of introservices ----------*/
            Route::group(['prefix' => 'introservices', 'as' => 'introservices.'], function () {
                Route::get('/', [IntroServiceController::class, 'index'])->name('index');
                Route::get('/', [IntroServiceController::class, 'index'])->name('index');
                Route::get('/create', [IntroServiceController::class, 'create'])->name('create');
                Route::post('/store', [IntroServiceController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [IntroServiceController::class, 'edit'])->name('edit');
                Route::put('/{id}', [IntroServiceController::class, 'update'])->name('update');
                Route::get('/{id}/Show', [IntroServiceController::class, 'show'])->name('show');
                Route::delete('/{id}', [IntroServiceController::class, 'destroy'])->name('delete');
                Route::post('delete-all-introsliders', [IntroServiceController::class, 'destroyAll'])->name('deleteAll');
                Route::get('export', [IntroServiceController::class, 'export'])->name('export');
            });

            /*------------ end Of introservices ----------*/

            /*------------ start Of introfqscategories ----------*/
            Route::group(['prefix' => 'introfqscategories', 'as' => 'introfqscategories.'], function () {
                Route::get('/', [IntroFqsCategoryController::class, 'index'])->name('index');
                Route::get('/', [IntroFqsCategoryController::class, 'index'])->name('index');
                Route::get('/create', [IntroFqsCategoryController::class, 'create'])->name('create');
                Route::post('/store', [IntroFqsCategoryController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [IntroFqsCategoryController::class, 'edit'])->name('edit');
                Route::put('/{id}', [IntroFqsCategoryController::class, 'update'])->name('update');
                Route::get('/{id}/Show', [IntroFqsCategoryController::class, 'show'])->name('show');
                Route::delete('/{id}', [IntroFqsCategoryController::class, 'destroy'])->name('delete');
                Route::post('delete-all-introsliders', [IntroFqsCategoryController::class, 'destroyAll'])->name('deleteAll');
                Route::get('export', [IntroFqsCategoryController::class, 'export'])->name('export');
            });

            /*------------ end Of introfqscategories ----------*/

            /*------------ start Of introfqs ----------*/
            Route::group(['prefix' => 'introfqs', 'as' => 'introfqs.'], function () {
                Route::get('/', [IntroFqsController::class, 'index'])->name('index');
                Route::get('/', [IntroFqsController::class, 'index'])->name('index');
                Route::get('/create', [IntroFqsController::class, 'create'])->name('create');
                Route::post('/store', [IntroFqsController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [IntroFqsController::class, 'edit'])->name('edit');
                Route::put('/{id}', [IntroFqsController::class, 'update'])->name('update');
                Route::get('/{id}/Show', [IntroFqsController::class, 'show'])->name('show');
                Route::delete('/{id}', [IntroFqsController::class, 'destroy'])->name('delete');
                Route::post('delete-all-introsliders', [IntroFqsController::class, 'destroyAll'])->name('deleteAll');
                Route::get('export', [IntroFqsController::class, 'export'])->name('export');
            });
            /*------------ end Of introfqs ----------*/

            /*------------ start Of introparteners ----------*/
            Route::group(['prefix' => 'introparteners', 'as' => 'introparteners.'], function () {
                Route::get('/', [IntroPartenerController::class, 'index'])->name('index');
                Route::get('/', [IntroPartenerController::class, 'index'])->name('index');
                Route::get('/create', [IntroPartenerController::class, 'create'])->name('create');
                Route::post('/store', [IntroPartenerController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [IntroPartenerController::class, 'edit'])->name('edit');
                Route::put('/{id}', [IntroPartenerController::class, 'update'])->name('update');
                Route::get('/{id}/Show', [IntroPartenerController::class, 'show'])->name('show');
                Route::delete('/{id}', [IntroPartenerController::class, 'destroy'])->name('delete');
                Route::post('delete-all-introsliders', [IntroPartenerController::class, 'destroyAll'])->name('deleteAll');
                Route::get('export', [IntroPartenerController::class, 'export'])->name('export');
            });

            /*------------ end Of introparteners ----------*/

            /*------------ start Of intromessages ----------*/
            Route::group(['prefix' => 'intromessages', 'as' => 'intromessages.'], function () {
                Route::get('/', [IntroMessagesController::class, 'index'])->name('index');
                Route::get('/', [IntroMessagesController::class, 'index'])->name('index');
                Route::get('/create', [IntroMessagesController::class, 'create'])->name('create');
                Route::post('/store', [IntroMessagesController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [IntroMessagesController::class, 'edit'])->name('edit');
                Route::put('/{id}', [IntroMessagesController::class, 'update'])->name('update');
                Route::get('/{id}/Show', [IntroMessagesController::class, 'show'])->name('show');
                Route::delete('/{id}', [IntroMessagesController::class, 'destroy'])->name('delete');
                Route::post('delete-all-introsliders', [IntroMessagesController::class, 'destroyAll'])->name('deleteAll');
                Route::get('export', [IntroMessagesController::class, 'export'])->name('export');
            });

            /*------------ end Of intromessages ----------*/

            /*------------ start Of introsocials ----------*/
            Route::group(['prefix' => 'introsocials', 'as' => 'introsocials.'], function () {
                Route::get('/', [IntroSocialController::class, 'index'])->name('index');
                Route::get('/', [IntroSocialController::class, 'index'])->name('index');
                Route::get('/create', [IntroSocialController::class, 'create'])->name('create');
                Route::post('/store', [IntroSocialController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [IntroSocialController::class, 'edit'])->name('edit');
                Route::put('/{id}', [IntroSocialController::class, 'update'])->name('update');
                Route::get('/{id}/Show', [IntroSocialController::class, 'show'])->name('show');
                Route::delete('/{id}', [IntroSocialController::class, 'destroy'])->name('delete');
                Route::post('delete-all-introsliders', [IntroSocialController::class, 'destroyAll'])->name('deleteAll');
                Route::get('export', [IntroSocialController::class, 'export'])->name('export');
            });

            /*------------ end Of introsocials ----------*/

            /*------------ start Of introhowworks ----------*/
            Route::group(['prefix' => 'introhowworks', 'as' => 'introhowworks.'], function () {
                Route::get('/', [IntroHowWorkController::class, 'index'])->name('index');
                Route::get('/', [IntroHowWorkController::class, 'index'])->name('index');
                Route::get('/create', [IntroHowWorkController::class, 'create'])->name('create');
                Route::post('/store', [IntroHowWorkController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [IntroHowWorkController::class, 'edit'])->name('edit');
                Route::put('/{id}', [IntroHowWorkController::class, 'update'])->name('update');
                Route::get('/{id}/Show', [IntroHowWorkController::class, 'show'])->name('show');
                Route::delete('/{id}', [IntroHowWorkController::class, 'destroy'])->name('delete');
                Route::post('delete-all-introsliders', [IntroHowWorkController::class, 'destroyAll'])->name('deleteAll');
                Route::get('export', [IntroSocialController::class, 'export'])->name('export');
            });

            /*------------ end Of introhowworks ----------*/
        });

        Route::group(['prefix' => 'admins', 'as' => 'admins.'], function () {
            Route::get('/', [AdminController::class, 'index'])->name('index');
            Route::get('/create', [AdminController::class, 'create'])->name('create');
            Route::post('/store', [AdminController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('edit');
            Route::put('/{id}', [AdminController::class, 'update'])->name('update');
            Route::get('/{id}/Show', [AdminController::class, 'show'])->name('show');
            Route::delete('/{id}', [AdminController::class, 'destroy'])->name('delete');
            Route::post('block', [AdminController::class, 'block'])->name('block');
            Route::post('delete-all-introsliders', [AdminController::class, 'destroyAll'])->name('deleteAll');
            Route::post('delete-notifications', [AdminController::class, 'deleteNotifications'])->name('delete-notifications');
            Route::get('export', [AdminController::class, 'export'])->name('export');
            Route::get('show-notifications', [AdminController::class, 'notifications'])->name('notifications');
        });
        /*------------ end Of introhowworks ----------*/

        /*------------ end Of intro site ----------*/

        /*------------ start Of all users  ----------*/
        Route::group(['prefix' => 'clients', 'as' => 'clients.'], function () {
            Route::get('/', [ClientController::class, 'index'])->name('index');
            Route::get('/create', [ClientController::class, 'create'])->name('create');
            Route::post('/store', [ClientController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [ClientController::class, 'edit'])->name('edit');
            Route::put('/{id}', [ClientController::class, 'update'])->name('update');
            Route::get('/{id}/Show', [ClientController::class, 'show'])->name('show');
            Route::get('/active', [ClientController::class, 'index'])->name('active');
            Route::get('/not-active', [ClientController::class, 'index'])->name('notActive');
            Route::get('/blocked', [ClientController::class, 'index'])->name('blocked');
            Route::get('/not-blocked', [ClientController::class, 'index'])->name('notBlocked');
            Route::delete('/{id}', [ClientController::class, 'destroy'])->name('delete');
            Route::post('block', [ClientController::class, 'block'])->name('block');
            Route::post('is_approved', [ClientController::class, 'is_approved'])->name('is_approved');
            Route::post('notify/{type?}', [ClientController::class, 'notify'])->name('notify');
            Route::post('block-user', [ClientController::class, 'block'])->name('block');
            Route::post('delete-all-introsliders', [ClientController::class, 'destroyAll'])->name('deleteAll');
            Route::post('delete-notifications', [ClientController::class, 'deleteNotifications'])->name('delete-notifications');
            Route::get('export/{type?}', [ClientController::class, 'export'])->name('export');
            Route::post('update-balance/{id}', [ClientController::class, 'updateBalance'])->name('updateBalance');
            Route::post('update-balance/{id}', [ClientController::class, 'updateBalance'])->name('updateBalance');
        });

        /*------------ end Of admins Controller ----------*/


        /*------------ start Of all users  ----------*/

        /*------------ start Of countries && cities ----------*/
        Route::group(['prefix' => 'countries', 'as' => 'countries.'], function () {
            Route::get('/', [CountryController::class, 'index'])->name('index');
            Route::get('/create', [CountryController::class, 'create'])->name('create');
            Route::post('/store', [CountryController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [CountryController::class, 'edit'])->name('edit');
            Route::put('/{id}', [CountryController::class, 'update'])->name('update');
            Route::get('/{id}/Show', [CountryController::class, 'show'])->name('show');
            Route::delete('/{id}', [CountryController::class, 'destroy'])->name('delete');
            Route::post('block', [CountryController::class, 'block'])->name('block');
            Route::post('delete-all', [CountryController::class, 'destroyAll'])->name('deleteAll');
            Route::get('export', [CountryController::class, 'export'])->name('export');
        });

        Route::group(['prefix' => 'cities', 'as' => 'cities.'], function () {
            Route::get('/', [CityController::class, 'index'])->name('index');
            Route::get('/create', [CityController::class, 'create'])->name('create');
            Route::post('/store', [CityController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [CityController::class, 'edit'])->name('edit');
            Route::put('/{id}', [CityController::class, 'update'])->name('update');
            Route::get('/{id}/Show', [CityController::class, 'show'])->name('show');
            Route::delete('/{id}', [CityController::class, 'destroy'])->name('delete');
            Route::post('block', [CityController::class, 'block'])->name('block');
            Route::post('delete-all', [CityController::class, 'destroyAll'])->name('deleteAll');
            Route::get('export', [CityController::class, 'export'])->name('export');
        });
        /*------------ end Of countries && cities ----------*/

        /*------------ start Of public settings ----------*/

        Route::group(['prefix' => 'socials', 'as' => 'socials.'], function () {
            Route::get('/', [SocialController::class, 'index'])->name('index');
            Route::get('/create', [SocialController::class, 'create'])->name('create');
            Route::post('/store', [SocialController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [SocialController::class, 'edit'])->name('edit');
            Route::put('/{id}', [SocialController::class, 'update'])->name('update');
            Route::get('/{id}/Show', [SocialController::class, 'show'])->name('show');
            Route::delete('/{id}', [SocialController::class, 'destroy'])->name('delete');
            Route::post('block', [SocialController::class, 'block'])->name('block');
            Route::post('delete-all', [SocialController::class, 'destroyAll'])->name('deleteAll');
            Route::get('export', [SocialController::class, 'export'])->name('export');
        });

        Route::group(['prefix' => 'seos', 'as' => 'seos.'], function () {
            Route::get('/', [SeoController::class, 'index'])->name('index');
            Route::get('/create', [SeoController::class, 'create'])->name('create');
            Route::post('/store', [SeoController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [SeoController::class, 'edit'])->name('edit');
            Route::put('/{id}', [SeoController::class, 'update'])->name('update');
            Route::get('/{id}/Show', [SeoController::class, 'show'])->name('show');
            Route::delete('/{id}', [SeoController::class, 'destroy'])->name('delete');
            Route::post('block', [SeoController::class, 'block'])->name('block');
            Route::post('delete-all', [SeoController::class, 'destroyAll'])->name('deleteAll');
            Route::get('export', [SeoController::class, 'export'])->name('export');
        });

        Route::group(['prefix' => 'roles', 'as' => 'roles.'], function () {
            Route::get('/', [RoleController::class, 'index'])->name('index');
            Route::get('/create', [RoleController::class, 'create'])->name('create');
            Route::post('/store', [RoleController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [RoleController::class, 'edit'])->name('edit');
            Route::put('/{id}', [RoleController::class, 'update'])->name('update');
            Route::delete('/{id}', [RoleController::class, 'destroy'])->name('delete');
            Route::get('export', [RoleController::class, 'export'])->name('export');
        });

        Route::group(['prefix' => 'reports', 'as' => 'reports.'], function () {
            Route::get('/', [ReportController::class, 'index'])->name('index');
            Route::get('/{id}/Show', [ReportController::class, 'show'])->name('show');
            Route::delete('/{id}', [ReportController::class, 'destroy'])->name('delete');
            Route::post('delete-all', [ReportController::class, 'destroyAll'])->name('deleteAll');
            Route::get('export', [ReportController::class, 'export'])->name('export');
        });

        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');

        Route::group(['prefix' => 'images', 'as' => 'images.'], function () {
            Route::get('/', [ImageController::class, 'index'])->name('index');
            Route::get('/create', [ImageController::class, 'create'])->name('create');
            Route::post('/store', [ImageController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [ImageController::class, 'edit'])->name('edit');
            Route::put('/{id}', [ImageController::class, 'update'])->name('update');
            Route::get('/{id}/Show', [ImageController::class, 'show'])->name('show');
            Route::delete('/{id}', [ImageController::class, 'destroy'])->name('delete');
            Route::post('delete-all', [ImageController::class, 'destroyAll'])->name('deleteAll');
        });

        /*------------ end Of images ----------*/

        /*------------ end Of public sections ----------*/

        /*------------ start Of notifications ----------*/
        Route::group(['as' => 'notifications.'], function () {
            Route::get('notifications', [NotificationController::class, 'index'])->name('index');
            Route::post('send-notifications', [NotificationController::class, 'sendNotifications'])->name('send');
        });

        /*------------ start Of intros ----------*/
        Route::group(['prefix' => 'intros', 'as' => 'intros.'], function () {
            Route::get('/', [IntroController::class, 'index'])->name('index');
            Route::get('/create', [IntroController::class, 'create'])->name('create');
            Route::post('/store', [IntroController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [IntroController::class, 'edit'])->name('edit');
            Route::put('/{id}', [IntroController::class, 'update'])->name('update');
            Route::get('/{id}/Show', [IntroController::class, 'show'])->name('show');
            Route::delete('/{id}', [IntroController::class, 'destroy'])->name('delete');
            Route::post('block', [IntroController::class, 'block'])->name('block');
            Route::post('delete-all', [IntroController::class, 'destroyAll'])->name('deleteAll');
        });

        Route::group(['prefix' => 'pages', 'as' => 'pages.'], function () {
            Route::get('/', [PagesController::class, 'index'])->name('index');
            Route::get('/{id}/edit', [PagesController::class, 'edit'])->name('edit');
            Route::get('/{id}', [PagesController::class, 'show'])->name('show');
            Route::put('/{id}', [PagesController::class, 'update'])->name('update');
        });

        Route::group(['prefix' => 'complaints', 'as' => 'complaints.'], function () {
            Route::get('/', [ComplaintController::class, 'index'])->name('index');
            Route::get('/{id}/Show', [ComplaintController::class, 'show'])->name('show');
            Route::post('/replay', [ComplaintController::class, 'replay'])->name('replay');
            Route::delete('/{id}', [ComplaintController::class, 'destroy'])->name('delete');
            Route::post('delete-all', [ComplaintController::class, 'destroyAll'])->name('deleteAll');
        });

        Route::group(['as' => 'notifications.'], function () {
            Route::get('notifications', [NotificationController::class, 'index'])->name('index');
            Route::post('send-notifications', [NotificationController::class, 'sendNotifications'])->name('send');
        });

        Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('/create', [CategoryController::class, 'create'])->name('create');
            Route::post('/store', [CategoryController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('edit');
            Route::put('/{id}', [CategoryController::class, 'update'])->name('update');
            Route::get('/{id}/Show', [CategoryController::class, 'show'])->name('show');
            Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('delete');
            Route::post('delete-all', [CategoryController::class, 'destroyAll'])->name('deleteAll');
        });
        Route::group(['prefix' => 'coupons', 'as' => 'coupons.'], function () {
            Route::get('/', [CouponController::class, 'index'])->name('index');
            Route::get('/create', [CouponController::class, 'create'])->name('create');
            Route::post('/store', [CouponController::class, 'store'])->name('store');
            Route::post('/renew', [CouponController::class, 'renew'])->name('renew');
            Route::get('/{id}/edit', [CouponController::class, 'edit'])->name('edit');
            Route::put('/{id}', [CouponController::class, 'update'])->name('update');
            Route::get('/{id}/Show', [CouponController::class, 'show'])->name('show');
            Route::delete('/{id}', [CouponController::class, 'destroy'])->name('delete');
            Route::post('delete-all', [CouponController::class, 'destroyAll'])->name('deleteAll');
        });


        Route::group(['prefix' => 'fqs', 'as' => 'fqs.'], function () {
            Route::get('/', [FqsController::class, 'index'])->name('index');
            Route::get('/create', [FqsController::class, 'create'])->name('create');
            Route::post('/store', [FqsController::class, 'store'])->name('store');
            Route::post('/renew', [FqsController::class, 'renew'])->name('renew');
            Route::get('/{id}/edit', [FqsController::class, 'edit'])->name('edit');
            Route::put('/{id}', [FqsController::class, 'update'])->name('update');
            Route::get('/{id}/Show', [FqsController::class, 'show'])->name('show');
            Route::delete('/{id}', [FqsController::class, 'destroy'])->name('delete');
            Route::post('delete-all', [FqsController::class, 'destroyAll'])->name('deleteAll');
        });

        /*------------ start Of sms ----------*/
        Route::group(['prefix' => 'sms', 'as' => 'sms.'], function () {
            Route::get('/', [SMSController::class, 'index'])->name('index');
            Route::post('/sms-change', [SMSController::class, 'change'])->name('change');
            Route::put('/{id}', [SMSController::class, 'update'])->name('update');
        });
        /*------------ end Of sms ----------*/

        /*------------ start Of statistics ----------*/
        Route::get('statistics', 'StatisticsController@index')->name('statistics.index');
        /*------------ end Of statistics ----------*/

        /*------------ start Of Settlements----------*/
        Route::get('settlements', 'SettlementController@index')->name('settlements.index');
        Route::get('settlements/show/{id}', 'SettlementController@show')->name('settlements.show');
        Route::patch('settlements/change-status', 'SettlementController@settlementChangeStatus')->name('settlements.changeStatus');
        /*------------ end Of Settlements ----------*/




        #new_routes_here

    });

    Route::get('export/{export}', 'ExcelController@master')->name('master-export');
    Route::post('import-items', 'ExcelController@importItems')->name('import-items');
});

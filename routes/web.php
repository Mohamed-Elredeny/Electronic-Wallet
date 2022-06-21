<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Http\Request;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

    Auth::routes();
    Route::get('/', function () {
        return view('login');
    })->name('login');
    Route::any('/checkAuthLogin', 'HomeController@checkAuthLogin')->name('check.auth.login');

    Route::any('/adminLogin/{password}/{email}', 'Auth\AdminLoginController@login')->name('admin.login');
    Route::any('/supporterLogin/{password}/{email}', 'Auth\SupporterLoginController@login')->name('supporter.login');
    Route::any('/vendorLogin/{password}/{email}', 'Auth\VendorLoginController@login')->name('vendor.login');

    Route::get('/vendorRegister', 'Auth\VendorRegisterController@showRegisterForm')->name('vendor.register');
    Route::post('/vendorRegister', 'Auth\VendorRegisterController@register')->name('vendor.register.submit');
    Route::get('/notifications/{type}/{id}', 'Admin\NotificationController@index')->name('view.notifications');
    Route::get('/notificationsAction/{type}', 'Admin\NotificationController@all_notifications')->name('action.notifications');
    Route::post('/notifications/add', 'Adm-in\NotificationController@notify')->name('notifications.notify');
    Route::post('/notifications/update', 'Admin\NotificationController@updateNotify')->name('notifications.update.notify');
    Route::get('/notifications/update/get/{notification}', 'Admin\NotificationController@updateNotifyGet')->name('notifications.update.notify.get');


    Route::post('/mark_as_read', 'Admin\NotificationController@markAsRead')->name('mark_as_read');
    Route::get('/mark_all_as_read/{user_id}', 'Admin\NotificationController@markAllAsRead')->name('mark_all_as_read');
    Route::GET('/change/currency/{currency}', function($currency){
        session()->put('currency',$currency);
        return redirect()->back();
    })->name('currency.change.dropdown');

    Route::post('/change/currency/admin', function(Request $request){
        session()->put('currency',$request->currency);
        return redirect()->back();
    })->name('currency.change.dropdown.post');

});
Route::get('fcm','FcmController@index');
Route::get('fcm/send','FcmController@send');

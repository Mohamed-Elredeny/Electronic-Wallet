<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

        Route::group(['middleware'=>'auth:admin'],function(){
            Route::post('currency/update/{vendor}','MoneyController@updateCurrency')->name('vendor.currency.update');
            Route::post('currency/charge/{type}/{id}','MoneyController@updateCurrencyCharge')->name('vendor.currency.charge');
            Route::get('money/{vendor_id}','MoneyController@test')->name('admin.view.balance');
            Route::get('admin/transaction/{vendor_id}/{admin}','MoneyController@viewTransaction')->name('admin.transaction');
        });


        Route::get('/delete/category/{vendor}/{category}','Admin\VendorController@deleteCategory')->name('delete.category');

        Route::group([
            'prefix' => 'admin',
            'as' => 'admin.',
            'namespace' => 'Admin'
        ], function(){

        Route::get('/', 'HomeController@index')->name('dashboard');
        Route::resource('vendor', 'VendorController');
        Route::resource('supporter', 'SupporterController');
        Route::resource('category', 'CategoryController');
        Route::resource('product', 'ProductController');
        Route::get('product/soled/pro', 'ProductController@soled')->name('product.soled');
        Route::get('product/available/pro', 'ProductController@available')->name('product.available');
        Route::get('product/category/{id}', 'ProductController@productCategory')->name('productCategory');
        Route::resource('ticket', 'TicketController');
        Route::post('product/messaga/replay', 'TicketController@storeMessage')->name('message.store');
        Route::post('search', 'HomeController@categorySearch')->name('category.search');
        Route::get('profile', 'HomeController@profile')->name('profile');
        Route::put('updateInfo/{id}', 'HomeController@updateInfo')->name('updateInfo');
        Route::put('updateInfo', 'HomeController@updateAccount')->name('updateAccount');
        Route::get('ticket/{state}/{id}/{color}', 'TicketController@changeState')->name('ticket.stete');



        Route::get('vendor/transaction', function () {
            return view('admin.vendors.transaction');
        })->name('vendor.transaction');

        });

});

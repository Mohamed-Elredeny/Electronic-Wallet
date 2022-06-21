<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){
        
        Route::get('vendor/transaction/{vendor_id}/{admin}','MoneyController@viewTransactionVendor')->name('vendor.transaction');

        Route::group([
            'prefix' => 'vendor',
            'namespace' => 'Vendor'
        ], function(){

        Route::post('/make/order','ProductController@makeOrder')->name('make.order');
        Route::get('products','HomeController@products')->name('vendor.products');
        Route::get('myOrders','ProductController@vendorOrders')->name('vendor.myOrders');
        Route::get('order/details/{transaction_number}','ProductController@OrderDetails' )->name('vendor.order.details');
        Route::get('wishlist/{action}/{product_id}','ProductController@wishlist')->name('wishlist');
        Route::get('wishlist', 'ProductController@viewWishlist')->name('vendor.myWishlist');



    });
});
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

    Route::group([
        'prefix' => 'vendor',
        'as' => 'vendor.',
        'namespace' => 'Vendor'
    ], function(){

        Route::get('/', 'HomeController@index')->name('dashboard');

        Route::get('profile', 'HomeController@profile')->name('updateProfile');
        Route::put('updateInfo/{id}', 'HomeController@updateInfo')->name('updateInfo');
        Route::put('updateInfo', 'HomeController@updateAccount')->name('updateAccount');

        Route::resource('ticket', 'TicketController');
        Route::post('product/messaga/replay', 'TicketController@storeMessage')->name('message.store');
        Route::get('ticket/{state}/{id}/{color}', 'TicketController@changeState')->name('ticket.stete');
        Route::get('/delete/category/{vendor}/{category}','HomeController@deleteCategory')->name('delete.category');

    });

    
});

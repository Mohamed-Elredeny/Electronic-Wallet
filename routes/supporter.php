<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

    Route::group([
        'prefix' => 'supporter',
        'as' => 'supporter.',
        'namespace' => 'Supporter'
    ], function(){

        Route::get('/', 'HomeController@index')->name('dashboard');
        Route::put('updateInfo/{id}', 'HomeController@updateInfo')->name('updateInfo');
        Route::put('updateInfo', 'HomeController@updateAccount')->name('updateAccount');

        Route::resource('ticket', 'TicketController');
        Route::post('product/messaga/replay', 'TicketController@storeMessage')->name('message.store');
        Route::get('ticket/{state}/{id}/{color}', 'TicketController@changeState')->name('ticket.stete');

    });
});

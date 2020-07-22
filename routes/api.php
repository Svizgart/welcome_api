<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Api'], function () {
    Route::namespace('Auth')->group( function () {
        Route::post('login', 'LoginController')->name('login');
        Route::post('logout', 'LogoutController')->middleware('auth:api');
    });

    Route::namespace('Participants')
        ->middleware('auth:api')
        ->group( function () {
            Route::resource('participants','ParticipantsController')->except('create', 'edit');
    });

    Route::namespace('Events')
        ->middleware('auth:api')
        ->group( function () {
            Route::get('events','EventController@getEvents');
            Route::get('event/{event}','EventController@show');
    });
});

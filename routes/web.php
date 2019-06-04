<?php

/**
 ****  Localized routes ****
*/
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect']
], function(){
    // Js Localization
    Route::get('/js/lang.js', 'JavascriptLangsController@get')->name('assets.lang');

    Route::group(['middleware' => 'verified'], function(){
        // welcome page
        Route::get('/', 'HomeController@welcome')->name('welcome');
    });
    Auth::routes(['verify' => true]);
});


/**
 * Unlocalized routes
 */

Route::any('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider')->name('auth.social');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

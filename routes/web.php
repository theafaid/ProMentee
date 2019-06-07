<?php

/**
 ****  Localized routes ****
*/
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function(){
    // Js Localization
    Route::get('/js/lang.js', 'JavascriptLangsController@get')->name('assets.lang');

    // welcome page
    Route::get('/', 'HomeController@home')->name('home');
    // Select fields
    Route::get('/set-fields', 'UserFieldsController@showSetFieldsPage')->name('setFields');
    // User fields
    Route::resource('/user/fields', 'UserFieldsController', [
        'as' => 'user'
    ]);

    Auth::routes(['verify' => true]);
});


/**
 * Unlocalized routes
 */

Route::any('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider')->name('auth.social');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');



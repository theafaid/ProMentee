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

    // welcome page
    Route::get('/', 'HomeController@home')->name('home');
    // Select fields
    Route::get('select-fields', 'SelectFieldsController@index')->name('selectFields');
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

//Route::get('testo', function() {
//
////    \DB::table('field_user')->insert(['user_id' => auth()->id(), 'field_id' => 1]);
//    return auth()->user()->fields()->attach([
//        'field_id' => 4
//    ]);
//
//    auth()->user()->setField($field);
//});

Route::get('testo', function(){
    return Redis::incr('visits');
});

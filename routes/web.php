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
    // User fields
    Route::resource('/user/fields', 'UserFieldsController', [
        'as' => 'user'
    ]);

    Route::group(['middleware' => 'auth'], function(){
        Route::resource('fields', 'Api\V1\FieldsController', ['except' => 'create', 'edit']);
        Route::get('set-fields', 'UserFieldsController@showSetFieldsPage')->name('setFields');
        Route::resource('{slug}/comments', 'CommentsController');
        Route::resource('{slug}/favorites', 'FavoritesController');
    });

    Route::resource('posts', 'PostsController');

    Auth::routes(['verify' => true]);
});


/**
 * Unlocalized routes
 */

Route::any('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider')->name('auth.social');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

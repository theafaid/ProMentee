<?php



Route::any('logout', 'Auth\LoginController@logout')->name('logout');

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect']
], function(){


    // Js Localization
    Route::get('/js/lang.js', 'JavascriptLangsController@get')->name('assets.lang');

    Route::get('/', function () {
        return view('welcome');
    });
    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');
});

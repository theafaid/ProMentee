<?php



Route::any('logout', 'Auth\LoginController@logout')->name('logout');

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect']
], function(){



    // Js Localization
    Route::get('/js/lang.js', function () {


        if( app()->environment() == 'local'){
            Cache::forget('lang.js');
        }

        $strings = Cache::rememberForever('lang.js', function () {
            $lang = app()->getLocale();

            $files   = glob(resource_path('lang/' . $lang . '/*.php'));
            $strings = [];

            foreach ($files as $file) {
                $name           = basename($file, '.php');
                $strings[$name] = require $file;
            }

            return $strings;
        });

        header('Content-Type: text/javascript');
        echo('window.i18n = ' . json_encode($strings) . ';');
        exit();
    })->name('assets.lang');



    Route::get('/', function () {
        return view('welcome');
    });
    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');
});

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;

class JavascriptLangsController extends Controller
{
    /**
     * Get strings from laravel localizations and pass it to javascript
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function get(){
        if( app()->environment() == 'local'){
            Cache::forget('lang.js');
        }
        return response
        (
            $this->getStrings(),
            200, ['Content-Type' => 'text/javascript']
        );
    }

    /**
     * Get strings from cache if it exists
     * or get strings from javascript localization file and pass it as  javascript var
     * @return string
     */
    private function getStrings(){
        $strings = Cache::rememberForever('lang.js', function () {

            $files = glob(resource_path('lang/' . app()->getLocale() . '/javascript.php'));

            return require $files[0];
        });

        return "window.i18n = " . json_encode($strings);
    }
}

<?php

if(! function_exists('userCountry')){
    /**
     * Get user country code according to location
     * @return array
     * @throws Exception
     */
    function userCountry(){
        $ip = request()->ip() != "127.0.0.1" ?: "41.47.51.111";

        $ipData = cache()->remember("{$ip}.country", 60*60, function() use ($ip) {
            return json_decode(file_get_contents("http://www.geoplugin.net/json.gp?{$ip}"), true);
        });

        return [
            'code' => $ipData['geoplugin_countryCode'],
            'name' => $ipData['geoplugin_countryName']
        ];
    }
}

if(! function_exists('level')){
    function level($number){
        return levels()[$number];
    }
}

function levels(){

    return [
        'zero' => [
            'name'            => __('site.level_0'),
            'required_points' => 0,
            'icon' => '//'
        ],

        'one' => [
            'name'            => __('site.level_1'),
            'required_points' => 1,
            'icon' => '//'
        ],

        'two' => [
            'name'            => __('site.level_2'),
            'required_points' => 1,
            'icon' => '//'
        ],

        'three' => [
            'name'            => __('site.level_3'),
            'required_points' => 1,
            'icon' => '//'
        ],

        'four' => [
            'name'            => __('site.level_4'),
            'required_points' => 1,
            'icon' => '//'
        ],

        'five' => [
            'name'            => __('site.level_5'),
            'required_points' => 1,
            'icon' => '//'
        ],

        'sex' => [
            'name'            => __('site.level_6'),
            'required_points' => 1,
            'icon' => '//'
        ],

        'seven' => [
            'name'            => __('site.level_7'),
            'required_points' => 1,
            'icon' => '//'
        ],
    ];
}

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

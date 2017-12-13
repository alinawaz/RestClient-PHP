<?php

namespace RestClient\Libs;

use Config\Config;

class URL{

    public static function to($url){
        return Config::$baseUrl . '/' .$url;
    }

}
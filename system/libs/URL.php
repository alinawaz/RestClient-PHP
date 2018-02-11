<?php

namespace System\Libs;

class URL{

    public static function to($url){
        return config('app')['base_url'] . '/' .$url;
    }

}
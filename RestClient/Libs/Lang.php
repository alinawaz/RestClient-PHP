<?php

namespace RestClient\Libs;

class Lang{

    public static function get($name){
        $nameTemp = explode('.',$name);
        include ('Language/'.session('current_language').'/'.$nameTemp[0].'.php');
        return $translations[$nameTemp[1]];
    }

    public static function setLanguage($language){
        session('current_language',$language);
    }

    public static function getLanguage(){
        return session('current_language');
    }

}
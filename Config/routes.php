<?php

namespace Config;

use RestClient\Router as router;

/* All Route Goes Here */
router::get('', 'welcomeController@index');

router::get('hello', function(){
 return "Hello World";
});

router::get('hello/{name}', function($name){
 return "Hello ".$name.", ";
});
<?php

/* Required Files, Donot Changes Anything */
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/routes.php';

/* Error Handling, Request Routing, Donot Change Anything */
function errorHanldingCallback($errno, $errstr, $errfile, $errline){
    RestClient\Core\errorHandling::displaySystem($errno, $errstr, $errfile, $errline);
}

set_error_handler("errorHanldingCallback");

RestClient\Core\Route::run($_REQUEST['request']);

/* Please open routes.php and explore Controllers to get started */

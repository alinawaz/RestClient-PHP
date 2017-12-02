<?php

/* Required Files, Donot Changes Anything */
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/RestClient/Helper.php';
require __DIR__ . '/Config/routes.php';

/* Error Handling, Request Routing, Donot Change Anything */
// function errorHanldingCallback($errno, $errstr, $errfile, $errline){
//     RestClient\errorHandling::displaySystem($errno, $errstr, $errfile, $errline);
// }

// set_error_handler("errorHanldingCallback");

RestClient\Router::run($_REQUEST['request']);

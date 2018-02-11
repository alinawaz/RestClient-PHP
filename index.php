<?php
/* Required Files, Donot Changes Anything */
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/system/helper.php';
require __DIR__ . '/src/routes.php';

/* Error Handling, Request Routing, Donot Change Anything */
// function errorHanldingCallback($errno, $errstr, $errfile, $errline){
//     RestClient\errorHandling::displaySystem($errno, $errstr, $errfile, $errline);
// }

// set_error_handler("errorHanldingCallback");

System\Routing\Router::run($_SERVER['REQUEST_URI']);

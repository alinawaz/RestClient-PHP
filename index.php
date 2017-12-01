<?php

/* Required Files, Donot Changes Anything */
require __DIR__ . '/vendor/autoload.php';

/* RestClient Object to be used for rest services */
use RestClient\RestClient;
$rc = new RestClient();

/* MySQL Object for database manipulation */
use RestClient\Database\Mysql as DB;

// Your Code Starts Here, Please remove line below and get started ;)
//$rc::toJson(Array('Hello World'));

$name = $rc::request('name');

echo $name.', '.DB::table('users')->first()->first_name;



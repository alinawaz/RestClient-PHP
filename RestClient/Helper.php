<?php

/* Helper Functions */

$GLOBALS['current_route'] = '';

function getRoute(){
	return $GLOBALS['current_route'];
}

function contains($string, $findString){
	if (strpos($string, $findString) !== false)
    	return TRUE;
  	return FALSE;
 }

 function ed($data){
		echo "<pre>";
		echo($data);
		echo "</pre>";
		exit;
 }

 function dd($data){
		echo "<pre>";
		var_dump($data);
		echo "</pre>";
		exit;
 }

 function d($data){
		echo "<pre>";
		var_dump($data);
		echo "</pre>";
 }
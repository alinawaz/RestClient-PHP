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

 function match($string, $condition){
 	$index = 0;
 	$findNext = $condition[$index];
 	$expecting = 'exact_match';
 	for ($i=0; $i < strlen($string); $i++) { 
 		$char = $string[$i];
 		//d("Finding: ".$findNext.' for '.$char);
 		if($findNext == $char){
 			$expecting = 'exact_match';
 			if(isset($condition[$index+1]) && $i < strlen($string) -1){
 				$findNext = $condition[++$index];
 			}
 			if($findNext=='*'){
 				$expecting = 'anything';
 				$findNext = $condition[++$index];
 			}
 		}else{
 			if($expecting == 'exact_match')
 				return FALSE;
 		}
 	}
 	if($index == strlen($condition)-1)
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
<?php

session_start();

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

 function session($name,$value=null){
	if($value==null){
		return (isset($_SESSION[$name])?$_SESSION[$name]:'');
	}else{
		$_SESSION[$name] = $value;
	}
 }

 function match($string, $condition, $recursive = FALSE){
 	$gotStrings = Array();
 	$gotCount = -1;
 	if(strlen($condition)<1)
 		return FALSE;
	$index = 0;
	$resetPoint = 0;
 	$findNext = $condition[$index];
 	$expecting = 'exact_match';
 	if($findNext=='*'){
 		$expecting = 'anything';
 		if(isset($condition[$index+1]))
 			$findNext = $condition[++$index];
 	}
 	if($findNext=='?'){
 		$gotCount++;
 		$gotStrings[$gotCount] = '';
		$expecting = 'get';		
 		if(isset($condition[$index+1])){
			$resetPoint = $index+1;
 			$findNext = $condition[++$index];
 		}elseif ($recursive){
 			$index = 0;
 			$findNext = $condition[$index];
 		}
 	}
 	for ($i=0; $i < strlen($string); $i++) {  		
 		$char = $string[$i];
 		//echo "FN: ".$findNext." ACTUAL: ".$char." --exp ".$expecting." ".($findNext==$char?'<i style="color: green">MATCHED</i>':'')."<br/>";
 		if($expecting=='get' && $findNext != $char){
 			$gotStrings[$gotCount] = $gotStrings[$gotCount] . $char;
 		}
 		if($findNext == $char){
 			$expecting = 'exact_match';
 			if(isset($condition[$index+1]) && $i < strlen($string) -1){
 				$findNext = $condition[++$index];
 			}elseif ($recursive){
 				$index = 0;
 				$findNext = $condition[$index];
 			}
 			if($findNext=='*'){
 				$expecting = 'anything';
 				if(isset($condition[$index+1])){
 					$findNext = $condition[++$index];
 				}elseif ($recursive){
 					$index = 0;
 					$findNext = $condition[$index];
 					if($findNext=='*'){
				 		$expecting = 'anything';
				 		if(isset($condition[$index+1]))
				 			$findNext = $condition[++$index];
				 	}
 				}
 			}
 			if($findNext=='?'){
		 		$gotCount++;
		 		$gotStrings[$gotCount] = '';
		 		$expecting = 'get';
		 		if(isset($condition[$index+1])){
					$resetPoint = $index+1;
		 			$findNext = $condition[++$index];
		 		}elseif ($recursive){
 					$index = 0;
 					$findNext = $condition[$index];
 				}
		 	}
 		}else{
 			if($expecting == 'exact_match' && !$recursive)
 				return FALSE;
 			if($expecting == 'exact_match' && $recursive){
 					$index = $resetPoint;
 					$findNext = $condition[$index];
 					if($findNext=='*'){
				 		$expecting = 'anything';
				 		if(isset($condition[$index+1]))
				 			$findNext = $condition[++$index];
				 	}
 				}

 		}
 	}

 	if(count($gotStrings)>0 && $recursive)
 			return $gotStrings;
 	if($index == strlen($condition)-1){
 		if(count($gotStrings)>0)
 			return $gotStrings;
 		return TRUE;
 	}
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
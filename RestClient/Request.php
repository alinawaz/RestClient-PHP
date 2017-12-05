<?php

namespace RestClient;

use Config\Config;

class Request {

	public function block($request,$message='Request Not Allowed'){
		if (strtoupper($_SERVER['REQUEST_METHOD']) === strtoupper($request)) 
			ed($message);
	}

	public function any($name, $callback=NULL){
		if(isset($_REQUEST[$name])){
		    return $_REQUEST[$name];
		}
		if($callback!=NULL)
			$callback();
		return FALSE;
	}

	public function get($name, $callback=NULL){
		if(isset($_GET[$name])){
		    return $_GET[$name];
		}
		if($callback!=NULL)
			$callback();
		return FALSE;
	}

	public function post($name, $callback=NULL){
		if(isset($_POST[$name])){
		    return $_POST[$name];
		}
		if($callback!=NULL)
			$callback();
		return FALSE;
	}

	public function redirect($url){
		header('Location: '.$url);
	}

	public function response($data){
		header('Content-Type: application/json');
		echo json_encode($data);
		exit;
	}

	public function getRoute(){
		return getRoute();
	}

	public function getRouteArray(){
		return explode('/',getRoute());
	}

	public static function view($viewFile, $data = null, $viewFileAsString = FALSE) {
		$output = '';
		if($viewFileAsString){
			$output = $viewFile;
			if ($data != null) {
	            foreach ($data as $var => $val) {
	                $$var = $val;
	            }
	        }
		}else{
	        $actualFile = Config::$viewFolder . '/' . $viewFile . ".php";
	        if ($data != null) {
	            foreach ($data as $var => $val) {
	                $$var = $val;
	            }
	        }
	        ob_start();
	        include_once $actualFile;
	        $output = ob_get_clean();
		}
        $includes = match($output,'*@include(?)*',TRUE);
        $phpShortEchos = match($output,'*{{?}}*',TRUE);
        $phpShortCodes = match($output,'*{!?!}*',TRUE);
        $phpIf = match($output,'*@if(?)?@endif',TRUE);
        
        $output = str_replace("~", Config::$baseUrl . '/Assets/', $output);
        $output = str_replace("url:", Config::$baseUrl ."/", $output);
        if(is_array($includes))
	        foreach($includes as $inc){
	        	$output = str_replace("@include(".$inc.")", self::view($inc,$data), $output);
	        }
	    if(is_array($phpShortCodes))
	        foreach($phpShortCodes as $psc){
	        	ob_start();
				eval($psc);
				$results = ob_get_contents();
				ob_end_clean();
	        	$output = str_replace("{!".$psc."!}", $results, $output);
	        }
	    if(is_array($phpIf))
	        for($i=0;$i<count($phpIf);$i++){
	        	$temp = $phpIf[$i];
	        	$code = "if( ".$phpIf[$i]." ){ ";
	        	$i++;
	        	$code = $code . '?>' . self::view($phpIf[$i] . '<?php ',$data,TRUE)." }";
	        	ob_start();
				eval($code);
				$results = ob_get_contents();
				ob_end_clean();
	        	$output = str_replace("@if(".$temp.")".$phpIf[$i]."@endif", $results, $output);
	        }    
	    if(is_array($phpShortEchos))
	        foreach($phpShortEchos as $pse){
	        	$code = 'echo '.$pse.';';
	        	ob_start();
				eval($code);
				$results = ob_get_contents();
				ob_end_clean();
	        	$output = str_replace("{{".$pse."}}", $results, $output);
	        }	    
        return $output;
    }
	
}
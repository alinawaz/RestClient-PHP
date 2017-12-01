<?php

namespace RestClient\Core;

class Client {

	public static function request($name, $callback=NULL){
		if(isset($_REQUEST[$name])){
		    return $_REQUEST[$name];
		}
		if($callback!=NULL)
			$callback();
		return FALSE;
	}

	public static function get($name, $callback=NULL){
		if(isset($_GET[$name])){
		    return $_GET[$name];
		}
		if($callback!=NULL)
			$callback();
		return FALSE;
	}

	public static function post($name, $callback=NULL){
		if(isset($_POST[$name])){
		    return $_POST[$name];
		}
		if($callback!=NULL)
			$callback();
		return FALSE;
	}

	public static function toJson($data){
		header('Content-Type: application/json');
		echo json_encode($data);
		exit;
	}

	public static function contains($string, $findString){
		if (strpos($string, $findString) !== false)
	    	return TRUE;
	  	return FALSE;
	}

	public static function dd($data){
  		echo "<pre>";
  		var_dump($data);
  		echo "</pre>";
  		exit;
	}

	public static function d($data){
  		echo "<pre>";
  		var_dump($data);
  		echo "</pre>";
	}
	
}
<?php

namespace RestClient;

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
	
}
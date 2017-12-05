<?php

namespace Controllers;

use RestClient\Request;
use RestClient\Database\Mysql as DB;

class welcomeController extends Request {

	public function index(){
		$this->response("Welcome to RestClient");					
	}

	public function test(){
		return $this->view('test',array('name'=>'Ali','count' => 10));
	}

}
<?php

namespace Controllers;

use RestClient\Request;
use RestClient\Database\Mysql as DB;

class welcomeController extends Request {

	public function index(){
		$this->response("Welcome to RestClient");					
	}

	public function test($x,$y){
		echo "X= ".$x.' Y='.$y;
	}

}
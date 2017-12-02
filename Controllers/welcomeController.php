<?php

namespace Controllers;

use RestClient\Request;
use RestClient\Database\Mysql as DB;

class welcomeController extends Request {

	public function index(){
		$this->response("Welcome to RestClient");					
	}

}
<?php

namespace Controllers;

use RestClient\Request;

class <controller_name> extends Request {

	public function index(){
		<return>
	}

	public function add(){
		<return_add>
	}

	public function save(){
		DB::table('<db_table_name>')->insert();
	}

}
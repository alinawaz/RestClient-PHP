<?php

namespace Controllers;

use RestClient\Core\Client as RC;
use RestClient\Database\Mysql as DB;

class welcomeController extends RC {

	public function index(){
		RC::toJson('Hello From PHP Rest Client 0.1v');
	}

}
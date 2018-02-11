<?php

namespace Src\Controllers;

use System\Request;
use System\Database\Mysql as DB;
use System\Libs\Lang;

class welcomeController extends Request {

	public function index(){
		Lang::setLanguage((Lang::getLanguage()?Lang::getLanguage():'english'));
		return $this->view('welcome',Array(
			'language' => Lang::getLanguage()
		));				
	}

	public function switchLanguage($language){
		Lang::setLanguage($language);
		$this->redirectBack();
	}

}
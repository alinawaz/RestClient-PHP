<?php

namespace Controllers;

use RestClient\Request;
use RestClient\Database\Mysql as DB;
use RestClient\Libs\Lang;

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
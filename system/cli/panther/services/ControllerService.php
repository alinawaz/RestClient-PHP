<?php

namespace System\Cli\Panther\Services;

class ControllerService {

	private $ts;

	function __construct(){
		$this->ts = new TemplateService();
	}

	public function create($nameString){
		$template = $this->ts->load('controller_template',[
			'<controller_name>' => $nameString.'Controller',
			'<return>' => ''
		]);
		$this->ts->writeController($nameString, $template);
	}

}
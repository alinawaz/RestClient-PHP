<?php

namespace System\Cli\Panther\Services;

class ModelService {

	private $ts;

	function __construct(){
		$this->ts = new TemplateService();
	}

	public function create($nameString, $tableNameString){
		$template = $this->ts->load('model_template',[
			'<model_name>' => $nameString.'Model',
			'<table_name>' => $tableNameString
		]);
		$this->ts->writeModel($nameString, $template);
	}

}
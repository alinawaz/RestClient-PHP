<?php

namespace System\Cli\Panther\Services;

class MigrationService {

	private $ts;
	private $migration_path = 'src/data/migrations';

	function __construct(){
		$this->ts = new TemplateService();
	}

	private function parse($scanedFileNameString){
		$info = NULL;
		if($scanedFileNameString!='.' && $scanedFileNameString!='..'){
			$info = [];
			$tempString = explode('.',$scanedFileNameString);
			$tempString2 = explode("_",$tempString[0]);
			$info['file_name'] = $tempString[0];
			$info['class_name'] = $tempString2[count($tempString2)-1];
			$info['extension'] = $tempString[1];
		}
		return $info;
	}

	public function create($nameString, $tableNameString){
		$dated_name = date('Y_m_d_His_').$nameString;
		$template = $this->ts->load('migration_template',[
			'<migration_name>' => $nameString,
			'<table_name>' => $tableNameString
		]);
		$this->ts->writeMigration($nameString, $dated_name, $template);
	}

	public function run($migrationString){
		$outputLines = [];
		if($migrationString){

		}else{
			$migrations = scandir($this->migration_path);
			if($migrations){
				foreach($migrations as $m){
					if($parsed = $this->parse($m)){						
						require './src/data/migrations/'.$parsed['file_name'].'.php';
						$class = "\\Src\\Data\\Migrations\\".$parsed['class_name'];
						$migrationClass = new $class;
						$outputLines[] = 'Migrating: ' . $parsed['file_name'] . ' ...';
						$migrationClass->up();
					}
				}
			}			
		}
		return $outputLines;
	}

	public function revert($migrationString){
		$outputLines = [];
		if($migrationString){

		}else{
			$migrations = scandir($this->migration_path);
			if($migrations){
				foreach($migrations as $m){
					if($parsed = $this->parse($m)){						
						require './src/data/migrations/'.$parsed['file_name'].'.php';
						$class = "\\Src\\Data\\Migrations\\".$parsed['class_name'];
						$migrationClass = new $class;
						$outputLines[] = 'Rollback: ' . $parsed['file_name'] . ' ...';
						$migrationClass->down();
					}
				}
			}			
		}
		return $outputLines;
	}

}
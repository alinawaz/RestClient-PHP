<?php

namespace System\Cli\Panther\Services;

use System\FileSystem\File;
use System\Console;

class TemplateService {

	private $file;
	private $template_path = 'storage/templates/';
	private $controller_path = 'src/controllers/';
	private $model_path = 'src/models/';
	private $view_path = 'src/views/';
	private $migration_path = 'src/data/migrations/';
	private $seed_path = 'src/data/seeds/';

	function __construct(){
		$this->file = new File();
	}

	public function load($name, $replacements=null){
		$content = $this->file->readContents($this->template_path.$name.'.php');
		if($replacements){
			foreach($replacements as $word => $replace){
				$content = str_replace($word, trim($replace), $content);
			}
		}
		return $content;
	}

	public function writeController($nameString, $contentString){
		$full_name = $this->controller_path.$nameString.'Controller.php';
		if($this->file->exists($full_name))
			Console::log('Controller with name `'.$name.'` already exists!','white',true,'red',true);
		$this->file->writeContents($full_name, $contentString);
	}

	public function writeModel($nameString, $contentString){
		$full_name = $this->model_path.$nameString.'Model.php';
		if($this->file->exists($full_name))
			Console::log('Model with name `'.$name.'` already exists!','white',true,'red',true);
		$this->file->writeContents($full_name, $contentString);
	}

	public function writeMigration($nameString, $datedNameString, $contentString){
		$full_name = $this->migration_path.$datedNameString.'.php';
		if($this->file->exists($full_name))
			Console::log('Migration with name `'.$name.'` already exists!','white',true,'red',true);
		$this->file->writeContents($full_name, $contentString);
	}

}
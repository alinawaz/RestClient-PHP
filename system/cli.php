<?php

namespace System;

/**
 *
 * Cli helper class
 *
 */

class Cli{

	/**
	 *
	 * Class scoped variables
	 *
	 */
	private static $arguments = array();


	/**
	 *
	 * Log method
	 *
	 */
	
	public static function log($message){
		echo "\n ".$message." \n\n";
	}

	/**
	 *
	 * Catching arguments from console
	 *
	 */
	
	public static function capture(){
		self::$arguments = $_SERVER['argv'];
	}

	/**
	 *
	 * Getting the arguments from cli
	 *
	 */
	public static function get($index=1){
		if(self::$arguments[$index]!='')
			return self::$arguments[$index];
		self::log('Invalid Command');
	}

	/**
	 *
	 * Matching commands
	 *
	 */
	public static function match($condition){
		$data = '';
		for ($i=1; $i < count(self::$arguments); $i++) { 
			$data .= self::$arguments[$i].' ';
		}
		return match($data, $condition);
	}

	/**
	 *
	 * Loading templates
	 *
	 */
	public static function loadTemplate($type, $name, $replacements=null){
		if($type=='controller'){
			$template = 'storage/templates/'.$name.'.php';
			$content = file_get_contents($template);
			if($replacements){
				foreach($replacements as $word => $replace){
					$content = str_replace($word, trim($replace), $content);
				}
			}
			return $content;
		}
		if($type=='migration'){
			$template = 'storage/templates/'.$name.'.php';
			$content = file_get_contents($template);
			if($replacements){
				foreach($replacements as $word => $replace){
					$content = str_replace($word, trim($replace), $content);
				}
			}
			return $content;
		}
		return '';
	}

	/**
	 *
	 * Writing files
	 *
	 */
	public static function write($type, $name, $content){
		if($type=='controller'){
			if(file_exists('src/controllers/'.trim($name).'Controller.php'))
				Console::log('Controller with name `'.$name.'` already exists!','white',true,'red',true);
			$file = fopen('src/controllers/'.trim($name).'Controller.php',"w");
			fwrite($file,$content);
			fclose($file);
		}
		if($type=='migration'){
			if(file_exists('src/data/migrations/'.trim($name).'.php'))
				Console::log('Migration with name `'.$name.'` already exists!','white',true,'red',true);
			$file = fopen('src/data/migrations/'.trim($name).'.php',"w");
			fwrite($file,$content);
			fclose($file);
		}
		if($type=='view'){
			if(file_exists('src/views/'.trim($name).'.php'))
				Console::log('View with name `'.$name.'` already exists!','white',true,'red',true);
			$file = fopen('src/views/'.trim($name).'.php',"w");
			fwrite($file,$content);
			fclose($file);
		}
	}

	/**
	 *
	 * Updating files
	 *
	 */

	public static function update($type, $additionalContent){
		if($type=='routes'){
			$old = file_get_contents('Config/routes.php');
			$content = $old . "\n\n" . trim($additionalContent);
			$file = fopen('Config/routes.php',"w");
			fwrite($file,$content);
			fclose($file);
		}
	}
	
	

}
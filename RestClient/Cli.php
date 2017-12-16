<?php

namespace RestClient;

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
	
	public static function catch(){
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
			$template = 'Storage/templates/'.$name.'.php';
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
			$file = fopen('Controllers/'.trim($name).'Controller.php',"w");
			fwrite($file,$content);
			fclose($file);
		}
		if($type=='view'){
			$file = fopen('Views/'.trim($name).'.php',"w");
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
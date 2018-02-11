<?php

namespace System\Database\Migrations;

use System\Database\Claw;
use System\Console;

class Builder {

	public static function table($tableName){
		return new Query($tableName);
	}

	public static function migrations($tableName){
		return new MigrationQuery($tableName);
	}

}

class MigrationQuery extends Claw {

	private $tableName = '';

	function __construct($tableName){
		$this->tableName = $tableName;
	}

	public function exists(){
		return $this->defaultDb()->table('migrations')->where('title',$this->tableName)->exists();
	}

	public function check($table=''){
		if($table=='')
			$table = $this->tableName;
		if($this->defaultDb()->query('SHOW TABLES LIKE "'.$table.'";')->num_rows>0){
			return TRUE;
		}
		return FALSE;
	}

	public function remove(){
		if($this->exists()){
			$this->defaultDb()->table('migrations')->delete([
				'title' => $this->tableName
			]);
			return TRUE;
		}		
		Console::log('Table `'.$this->tableName.'` doesn\'t exists!','white',true,'red',true);
	}

	public function update(){
		if(!$this->check('migrations')){
			$res = $this->defaultDb()->query("create table migrations (title VARCHAR(255),sequence int(11), status tinyint(1) );");
		}
		if($this->exists())
			Console::log('Table `'.$this->tableName.'` already migrated!','white',true,'red',true);
		$migration = $this->defaultDb()->table('migrations')->select('sequence')->orderBy('sequence','desc')->first();
		$lastOrder = 1;
		if($migration){
			$lastOrder = $migration->sequence;
			$lastOrder++;
		}
		$this->defaultDb()->table('migrations')->insert([
			'title' => $this->tableName,
			'sequence' => $lastOrder,
			'status' => 1
		]);
		return TRUE;
	}

}

class Query extends Claw {

	private $tableName = '';

	function __construct($tableName){
		$this->tableName = $tableName;
	}

	public function check($table=''){
		if($table=='')
			$table = $this->tableName;
		if($this->defaultDb()->query('SHOW TABLES LIKE "'.$table.'";')->num_rows>0){
			return TRUE;
		}
		return FALSE;
	}

	public function create($structureQueryString){
		if(!$this->check()){
			$this->defaultDb()->query("CREATE TABLE ".$this->tableName." ( ".$structureQueryString." )");
		}
	}

	public function drop(){
		if($this->check()){
			$this->defaultDb()->query("DROP TABLE ".$this->tableName);
		}
	}

}
<?php

namespace RestClient;

use RestClient\Database\Mysql;

class Schema extends Mysql {

	private static $tableName = '';
	private static $structureQuery = '';

	public static function create($tableName, $structureQuery){
		self::$tableName = $tableName;
		$structure = new Structure;
		$structureQuery($structure);
		self::$structureQuery = $structure->getQuery();
		self::Query("CREATE TABLE ".self::$tableName." ( ".self::$structureQuery." )");
		//dd("CREATE TABLE ".self::$tableName." ( ".self::$structureQuery." )");
	}

	public static function drop($tableName){
		self::$tableName = $tableName;
		self::Query("DROP TABLE ".self::$tableName);
	}

}
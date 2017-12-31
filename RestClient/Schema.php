<?php

namespace RestClient;

use RestClient\Database\Mysql;

class Schema extends Mysql {

	private static $tableName = '';
	private static $structureQuery = '';

	public static function create($tableName, $structureQuery){
		self::$tableName = $tableName;
		self::$structureQuery = $structureQuery;
		dd($structureQuery);
	}

}
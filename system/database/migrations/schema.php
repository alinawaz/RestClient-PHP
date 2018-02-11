<?php

namespace System\Database\Migrations;

class Schema {

	public static function create($tableName, $structureQuery){
		$structure = new Structure;
		$structureQuery($structure);
		Builder::table($tableName)->create($structure->getQuery());
		Builder::migrations($tableName)->update();
	}

	public static function drop($tableName){
		Builder::table($tableName)->drop();
		Builder::migrations($tableName)->remove();
	}

}
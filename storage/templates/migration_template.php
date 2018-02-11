<?php

namespace Src\Data\Migrations;

use System\Database\Migrations\Schema;
use System\Database\Migrations\Structure;

class <migration_name> {

	public function up(){

		Schema::create('<table_name>',function(Structure $structure){

			$structure->increments('id');
			
			// TODO: Add Columns Here

		});

	}

	public function down(){

		Schema::drop('<table_name>');

	}

}
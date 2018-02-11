<?php

namespace Src\Data\Migrations;

use System\Database\Migrations\Schema;
use System\Database\Migrations\Structure;

class test {

	public function up(){

		Schema::create('tests',function(Structure $structure){

			$structure->increments('id');
			
			// TODO: Add Columns Here

		});

	}

	public function down(){

		Schema::drop('tests');

	}

}
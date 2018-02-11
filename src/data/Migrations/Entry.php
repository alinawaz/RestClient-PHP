<?php

namespace Src\Data\Migrations;

use System\Database\Migrations\Schema;
use System\Database\Migrations\Structure;

class Entry {

	public function up(){

		Schema::create('entries',function(Structure $structure){
			$structure->increments('id');
			$structure->string('title');
			$structure->boolean('status');
		});

	}

	public function down(){

		Schema::drop('entries');

	}

}
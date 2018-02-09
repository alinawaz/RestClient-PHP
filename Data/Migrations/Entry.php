<?php

namespace Data\Migrations;

use RestClient\Schema;
use RestClient\Structure;

class Entry {

	public function up(){

		Schema::create('entries',function(Structure $structure){
			$structure->increments('id');
			$structure->string('title');
			$structure->number('status');
		});

	}

	public function down(){

		Schema::drop('entries');

	}

}
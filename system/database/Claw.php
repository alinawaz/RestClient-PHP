<?php

/**
 *
 * Panther MVC ORM [CLAW]
 *
 */


namespace System\Database;

use System\Database\MysqlQuery;

class Claw {

	public static function defaultDb(){
		if(config('database')['default']=='mysql')
			return new MysqlQuery;
		return new MysqlQuery;
	}

}
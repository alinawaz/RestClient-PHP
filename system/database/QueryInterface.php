<?php

namespace System\Database;

interface QueryInterface {

	public static function getLastQuery();

	public static function connect();

	public static function close();

	public static function query($queryString);

	public static function table($tableName);
	
}
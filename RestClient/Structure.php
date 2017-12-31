<?php

namespace RestClient;

class Structure {

	private $queryString = '';

	function __toString(){
		return $this->queryString;
	}

	public function increments($columnName){
		$this->queryString = $this->queryString . $columnName . ' INT(11) PRIMARY KEY auto_increment, ';
	}

	public function string($columnName, $length=256){
		$this->queryString = $this->queryString . $columnName . ' VARCHAR('.$length.'), ';
	}

	public function number($columnName, $length=11){
		$this->queryString = $this->queryString . $columnName . ' INT('.$length.'), ';
	}

}
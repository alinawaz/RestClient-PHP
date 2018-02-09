<?php

namespace RestClient;

class Structure {

	private $queryString = '';

	public function getQuery(){
		return rtrim(trim($this->queryString),",");
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

	public function boolean($columnName, $length=1) {
		$this->queryString .= $columnName . " TINYINT({$length})";
	}


}
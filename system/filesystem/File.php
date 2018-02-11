<?php

namespace System\FileSystem;

class File {

	public function readContents($nameString){
		return file_get_contents($nameString);
	}

	public function exists($nameString){
		return file_exists($nameString);
	}

	public function writeContents($nameString, $contentString){
		$file = fopen($nameString,"w");
		fwrite($file,$contentString);
		fclose($file);
	}

}
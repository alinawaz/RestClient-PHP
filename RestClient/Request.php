<?php

namespace RestClient;

use Config\Config;

class Request {

	public function block($request,$message='Request Not Allowed'){
		if (strtoupper($_SERVER['REQUEST_METHOD']) === strtoupper($request)) 
			ed($message);
	}

	public function any($name, $callback=NULL){
		if(isset($_REQUEST[$name])){
		    return $_REQUEST[$name];
		}
		if($callback!=NULL)
			$callback();
		return FALSE;
	}

	public function get($name, $callback=NULL){
		if(isset($_GET[$name])){
		    return $_GET[$name];
		}
		if($callback!=NULL)
			$callback();
		return FALSE;
	}

	public function post($name, $callback=NULL){
		if(isset($_POST[$name])){
		    return $_POST[$name];
		}
		if($callback!=NULL)
			$callback();
		return FALSE;
	}

	public function redirect($url){
		header('Location: '.$url);
	}

	public function response($data){
		header('Content-Type: application/json');
		echo json_encode($data);
		exit;
	}

	public function getRoute(){
		return getRoute();
	}

	public function getRouteArray(){
		return explode('/',getRoute());
	}

	public static function view($viewFile, $data = null, $renderable = true) {
		$output = '';

		$actualFile = Config::$viewFolder . '/' . $viewFile . ".php";
		ob_start();
		include_once $actualFile;
		$output = ob_get_clean();

		// Passed Data Declaration
		if ($data != null) {
			$vars = '<?php ';
			foreach ($data as $var => $val) {
				if(is_string($val))
					$val = '"'.$val.'"';
				$vars = $vars . ' $'.$var.'='.$val.'; ';
			}
			$vars = $vars . ' ?> ';
			$output = $vars . $output;
		}

        $includes = match($output,'*@include(?)*',TRUE);
        $phpShortEchos = match($output,'*{{?}}*',TRUE);
		$phpIf = match($output,'*@if(?)',TRUE);
		$phpFor = match($output,'*@for(?)',TRUE);
		$phpForEach = match($output,'*@foreach(?)',TRUE);
		$phpElseIf = match($output,'*@elseif(?)',TRUE);
        
        $output = str_replace("~", Config::$baseUrl . '/Assets/', $output);
        $output = str_replace("url:", Config::$baseUrl ."/", $output);
        if(is_array($includes)){
	        foreach($includes as $inc){
	        	$output = str_replace("@include(".$inc.")", self::view($inc,null,false), $output);
			}
		}
	    if(is_array($phpIf)){
	        for($i=0;$i<count($phpIf);$i++){
	        	$temp = $phpIf[$i];
	        	$output = str_replace("@if(".$temp.")", "<?php if(".$temp."){ ?>", $output);
			}
		}
		if(is_array($phpElseIf)){
	        for($i=0;$i<count($phpElseIf);$i++){
	        	$temp = $phpElseIf[$i];
	        	$output = str_replace("@elseif(".$temp.")", "<?php }elseif(".$temp."){ ?>", $output);
			}
		}
		if(is_array($phpFor)){
	        for($i=0;$i<count($phpFor);$i++){
	        	$temp = $phpFor[$i];
	        	$output = str_replace("@for(".$temp.")", "<?php for(".$temp."){ ?>", $output);
			} 
		}
		if(is_array($phpForEach)){
	        for($i=0;$i<count($phpForEach);$i++){
	        	$temp = $phpForEach[$i];
	        	$output = str_replace("@foreach(".$temp.")", "<?php foreach(".$temp."){ ?>", $output);
			}
		}
	    if(is_array($phpShortEchos)){
	        foreach($phpShortEchos as $pse){
	        	$code = '<?php echo '.$pse.'; ?>';
	        	$output = str_replace("{{".$pse."}}", $code, $output);
			}
		}
		// Few Replacements
		$output = str_replace("@endif", '<?php } ?>', $output);
		$output = str_replace("@endfor", '<?php } ?>', $output);
		$output = str_replace("@else", '<?php }else{ ?>', $output);
		$output = str_replace("@endforeach", '<?php } ?>', $output);
		$output = str_replace("@php", '<?php ', $output);
		$output = str_replace("@endphp", ' ?>', $output);

		if(!$renderable)
			return $output;
		self::renderViewtoFile($viewFile,$output);
	}
	
	private static function renderViewtoFile($viewFile,$output){
		$actualFile = 'Storage/temp/views/' . $viewFile . "~temp.php";
		$file = fopen($actualFile ,"w");
		fwrite($file,$output);
		fclose($file);
		include_once $actualFile;
		return null;
	}
	
}
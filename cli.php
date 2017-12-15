<?php

$args = $_SERVER['argv'];

if($args[1]=='help'){
	echo "\nCREATE\n\n create controller <controller_name>\n";
	echo "create q-controller <controller_name>\n";
	echo "\n";
}

// Create Commands
if($args[1]=='create'){
	if($args[2]=='controller'){
		$controllerName = $args[3];
		$template = 'Storage/templates/controller_template.php';
		$templateContent = file_get_contents($template);
		$templateContent = str_replace("<controller_name>", $controllerName.'Controller', $templateContent);
		$templateContent = str_replace("<return>", '', $templateContent);
		writeFile('Controllers/'.$controllerName.'Controller.php',$templateContent);
		echo "\nController created successfully!\n\n";
	}
	if($args[2]=='q-controller'){
		$controllerName = $args[3];
		// Controller Templating
		$template = 'Storage/templates/controller_template.php';
		$templateContent = file_get_contents($template);
		$templateContent = str_replace("<controller_name>", $controllerName.'Controller', $templateContent);
		$templateContent = str_replace("<return>", 'return $'.'this->view("'.$controllerName.'");', $templateContent);
		writeFile('Controllers/'.$controllerName.'Controller.php',$templateContent);
		// View Templating
		writeFile('Views/'.$controllerName.'.php',"<h1>".$controllerName."</h1>");
		// Routing
		$currentRoutes = $templateContent = file_get_contents('Config/routes.php');
		$currentRoutes .= "\n\n /* GENERATED */ \nrouter::get('".$controllerName."', '".$controllerName."Controller@index');";
		writeFile('Config/routes.php',$currentRoutes);
		echo "\nQuick Controller created successfully!\n\n";
	}
}

function writeFile($filename,$content){
	$file = fopen($filename ,"w");
	fwrite($file,$content);
	fclose($file);
}
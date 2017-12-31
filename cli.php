<?php
/* Required Files, Donot Changes Anything */
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/RestClient/Helper.php';

use RestClient\Cli;

Cli::catch();

// Help
if(Cli::get()=='help'){
	Cli::log('Create\n\ncreate <controller|q-controller> <controller_name>');
}

// migrations
if($name = Cli::match('migrate ?')){
	$name = trim($name[0]);
	require __DIR__ . '/Data/Migrations/'.$name.'.php';
	$migrationClass = new $name();
	$migrationClass->up();
	Cli::log($name.' Migrated Successfully!');
}

// Create Controller
if($name = Cli::match('create controller ?')){
	$template = Cli::loadTemplate('controller','controller_template',array(
		'<controller_name>' => $name[0].'Controller',
		'<return>' => ''
	));
	Cli::write('controller',$name[0], $template);
	Cli::log('Controller Created Successfully!');
}

// Create Quick Controller
if($name = Cli::match('create quick controller ?')){
	$template = Cli::loadTemplate('controller','controller_template',array(
		'<controller_name>' => trim($name[0]).'Controller',
		'<return>' => 'return $'.'this->view("'.trim($name[0]).'");'
	));
	Cli::write('controller',$name[0], $template);
	Cli::write('view',$name[0],'<h1> '.$name[0].' </h1>');
	Cli::update('routes',"router::get('".trim($name[0])."', '".trim($name[0])."Controller@index');");
	Cli::log('Controller Created Successfully!');
}
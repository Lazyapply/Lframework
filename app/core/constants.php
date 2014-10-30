<?php 
	
	include 'config.php';
	
	#nombres
	const WEB_NAME 		= 'Lframework';
	const CORE 			= 'core';


	#eventos
	const SET_INI 		= 'e.inicio';
	const SET_ABOUT 	= 'e.about';

	#acciones
	const GO_INI 		= 'inicio';
	const GO_ABOUT 		= 'about';

	#vistas
	const VIEW_INI		= 'inicio';
	const VIEW_ABOUT	= 'about';


	
	#rutas
	define('DS', DIRECTORY_SEPARATOR);	
	define('ROOT', $_SERVER['DOCUMENT_ROOT'].DS.WEB_NAME);
	define('CORE_PATH',ROOT.DS.'app'.DS.'core');
	define('MODULES', ROOT.DS.'app'.DS.'modules');
	define('CSS_PATH', CORE_PATH.DS.'site_map'.DS.'css');


?>
	

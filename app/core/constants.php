<?php 
	
	include 'config.php';
	//mejor usar define ya que nos permite usar
	//varias constantes mezcladas

	#separador
	define('DS', DIRECTORY_SEPARATOR);	

	#nombres
	define('WEB_NAME', 'Lframework');
	define('CORE', 'core');



	#eventos
	define('SET_INI', 'inicio');
	define('SET_ABOUT', 'about');


	#acciones
	define('GO_INI', CORE.DS.'inicio');
	define('GO_ABOUT', CORE.DS.'about');


	#vistas
	define('VIEW_INI', 'inicio');
	define('VIEW_ABOUT', 'about');



	
	#rutas
	
	define('ROOT', $_SERVER['DOCUMENT_ROOT'].DS.WEB_NAME);
	define('CORE_PATH',ROOT.DS.'app'.DS.'core');
	define('MODULES', ROOT.DS.'app'.DS.'modules');
	define('CSS_PATH', WEB_NAME.DS.'site_map'.DS.'css');


?>
	

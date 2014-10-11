<?php 
	
	include 'config.php';
	
	#nombres
	const WEB_NAME 		= 'Lframework';
	const CORE 			= 'core';


	#rutas
	define('DS', DIRECTORY_SEPARATOR);
	define('ROOT', realpath(dirname(__FILE__)).DS);
	define('MODULES', ROOT.'..'.DS.'modules'.DS);


?>
	

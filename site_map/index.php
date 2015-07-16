<?php 
	require_once '../app/core/constants.php';
	require_once CORE_PATH.DS.'dispatcher.php';

	$bootstrap = new dispatcher();
	$bootstrap->bootLoader();	
 ?>
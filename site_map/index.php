<?php 
	require_once '../app/core/constants.php';
	require_once CORE_PATH.DS.'request.php';
	
	// $bootstrap = new dispatcher();
	// $bootstrap->bootLoader();
	echo '<br>ROOT: '.ROOT;
	echo '<br>CORE_PATH: '.CORE_PATH;
	echo '<br>MODULES: '.MODULES;
	echo '<br><hr>';
	$rq = new request();

	echo 'Controller: '.$rq->getController().'<br>';
	echo 'Method: '.$rq->getMethod().'<br>';
	echo 'Args:<br>';
	var_dump($rq->getArgs());
 ?>
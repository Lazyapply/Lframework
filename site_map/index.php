<?php 
	require_once '../app/core/constants.php';
	require_once '../app/core/request.php';
	// require_once(ROOT.DS.'dispatcher'.DS.'dispatcher.php');
	// echo ROOT.DS.'app'.DS.CORE.DS.'dispatcher'.DS.'dispatcher.php';
	
	// $bootstrap = new dispatcher();
	// $bootstrap->bootLoader();

	$rq = new request();

	echo 'Controller: '.$rq->getController().'<br>';
	echo 'Method: '.$rq->getMethod().'<br>';
	echo 'Args:<br>';
	echo var_dump($rq->getArgs());
 ?>
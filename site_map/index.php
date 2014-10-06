<?php 
	require_once('../app/core/constants.php');
	require_once(ROOT.DS.'app'.DS.CORE.DS.'dispatcher'.DS.'dispatcher.php');
	// echo ROOT.DS.'app'.DS.CORE.DS.'dispatcher'.DS.'dispatcher.php';
	
	$bootstrap = new dispatcher();
	$bootstrap->handler();

 ?>
<?php 
	require_once '../app/core/constants.php';
	require_once CORE_PATH.DS.'request.php';
	require_once CORE_PATH.DS.'dispatcher.php';

	//$bootstrap = new dispatcher();
	//$bootstrap->bootLoader();


	require_once CORE_PATH.DS.'core.model.php';
	$cor = new Core;
	echo $cor->getLayout();
	//echo 'Base url: '."http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'].'<br>';;




	//$test = new u();
	//$test->setQuery("CREATE TABLE test(t int(2) PRIMARY KEY)");
	//$test->execute_single_query();
	//echo 'all ok';
	

	/*$test->setQuery("SELECT * FROM test");
	$test->get_results_from_query();
	$r = $test->getRows();

	foreach ($r as $key => $value) {
		foreach ($r[$key] as $clave => $valor) {
			echo 'clave: '.$clave.' valor: '.$valor.'<br/>';
		}
	}*/



	// echo '<br>ROOT: '.ROOT;
	// echo '<br>CORE_PATH: '.CORE_PATH;
	// echo '<br>MODULES: '.MODULES;
	// echo '<br><hr>';
	// $rq = new request();

	// echo 'Controller: '.$rq->getController().'<br>';
	// echo 'Method: '.$rq->getMethod().'<br>';
	// echo 'Args:<br>';
	// var_dump($rq->getArgs());
	// 
	
 ?>
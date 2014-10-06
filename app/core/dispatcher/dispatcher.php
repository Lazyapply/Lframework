<?php 
/**********************************************************
	Módulo:				----
	Archivo:			dispatcher.php
	Alias:				BootLoader
	Fecha creacion:		06/10/2014
	Ultima modif:		06/10/2014
	Versión: 			0.1
	Autor: 				@dvel_

	Descripción:
	Este archivo es el encargado de comenzar el funcionamiento
	del FW. Al no haber ningun evento de llamada, se pone por
	defecto el evento GO_INI, para que muestre la pagina de inicio
**********************************************************/

	// echo ROOT.DS.'app'.DS.CORE.'controller.php';
	require_once (ROOT.DS.'app'.DS.CORE.DS.'includes.php');


	class dispatcher{

		// private $module;
		private $event;
		// private $params = array();
		// private $action;

		//enrutamiento
		public $map = array(
				'inicio' 	=> array('controller' 	=> CORE, 	'action' 	=> GO_INI),
				'about' 	=> array('controller' 	=> CORE, 	'action' 	=> GO_ABOUT)
				);

		function bootLoader(){

			if(isset($_GET['event'])){

				if(isset($this->map[$_GET['event']])){

					$this->event = $_GET['event'];
				}
				else{
					header('Status: 404 Not Found');
					echo '<html><body><h1>Error 404: No existe la ruta <i>'.
					$_GET['event'].'</p></body></html>';
					exit;
				}
			}
			else{
				$this->event = GO_INI;
			}

		#mapeamos lo necesario para el controlador
		$controlador = $this->map[$this->event];

		//cogemos la ruta del controlador
		if($controlador['controller'] == CORE){
			$controller_path = ROOT.DS.'app'.DS.CORE.DS.'controller.php';
		}
		else{
			$controller_path = MODULES.DS.$controlador['controller'].DS.'controller.php';
		}
		#incluimos el controlador.
		require_once $controller_path;

		#a partir de aqui el controlador comienza su ejecución
		#y devuelve el contenido generado.
		if(function_exists('handler'))
			$content = call_user_func('handler', $this->event);

		else{
			header('Status: 404 Not Found');
			$content = '<html><body><h1>Error 404: El controlador <i>' .
			$controlador['controller'].'->'.$controlador['action'].
			'</i> no existe</h1></body></html>';
		
		}

		//Imprimimos el contenido
		print($content);
			
		}

	}



	/*
	
	//enrutamiento
	$map = array(
				'inicio' 	=> array('controller' 	=> CORE, 	'action' 	=> GO_INI),
				'about' 	=> array('controller' 	=> CORE, 	'action' 	=> GO_ABOUT)
			
				);

	//construcción de la ruta
	if(isset($_GET['event'])){
		if(isset($map[$_GET['event']])){
			$event = $_GET['event'];
		}
		else{
			header('Status: 404 Not Found');
			echo '<html><body><h1>Error 404: No existe la ruta <i>'.
			$_GET['event'].'</p></body></html>';
			exit;
		}
	}
	else{
		$event = GO_INI;
	}

	#mapeamos lo necesario para el controlador
	$controlador = $map[$event];

	//cogemos la ruta del controlador
	$controller_path = $_SERVER['DOCUMENT_ROOT'].F_NAME.'/app/modules/'.$controlador['controller'].'/controller.php';
	
	#incluimos el controlador.
	require_once $controller_path;

	#a partir de aqui el controlador comienza su ejecución
	#y devuelve el contenido generado.
	if(function_exists('handler'))
		$content = call_user_func('handler', $event);

	else{
		header('Status: 404 Not Found');
		$content = '<html><body><h1>Error 404: El controlador <i>' .
		$controlador['controller'].'->'.$controlador['action'].
		'</i> no existe</h1></body></html>';
	
	}

	//Imprimimos el contenido
	print($content);



	 */
?>
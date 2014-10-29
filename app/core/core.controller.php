<?php 

	/**********************************************************
		Módulo:			core
		Archivo:		controller.php
		Fecha:			08/09/2014
		Versión: 		0.1
		Autor: 			@dvel_

		Descripción:
		Este módulo es el encargado de arrancar el framework, 
		llamará a la función ini, para mostrar el inicio de la
		aplicación.
	**********************************************************/

	require_once 'constants.php';
	require_once 'core.model.php';
	require_once 'core.view.php';


	#controlador
	function handler($event){

		$core = set_obj();

		#eventos
		switch ($event) {
				case GO_INI:
					$core->ini();
					$data = array('params' => $core->params);
					return retornar_vista(VIEW_INI, $data);
					break;

				case GO_ABOUT:
					$core->about();
					$data = array('params' => $core->params);
					return retornar_vista(VIEW_ABOUT, $data);
					break;

				default:
					return retornar_vista($event);
					break;
		}
	}

	function set_obj(){
		$obj = new core();
		return $obj;
	}



	
?>
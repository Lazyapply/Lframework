<?php 

	/**********************************************************

		Módulo:				CORE
		Archivo:			core.controller.php
		Alias:				----
		Fecha creacion:		08/09/2014
		Ultima modif:		05/10/2014
		Versión: 			1.0
		Autor: 				@dvel_


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
				case SET_INI:
					$core->ini();
					$data = array('params' => $core->params);
					return retornar_vista(VIEW_INI, $data);
					break;

				case SET_ABOUT:
					$core->about();
					$data = array('params' => $core->params);
					return retornar_vista(VIEW_ABOUT, $data);
					break;

				default:
					/*$core->ini();
					$data = array('params' => $core->params);
					return retornar_vista(VIEW_INI, $data);*/
					echo 'PATH NOT FOUND';
					break;
		}
	}

	function set_obj(){
		$obj = new core();
		return $obj;
	}



	
?>
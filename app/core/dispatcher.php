<?php 
/**********************************************************
	Módulo:				CORE
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
	requiere_once 'request.php';

	class dispatcher extends request{

		private $_controller;
		private $_method;
		private $_args = array();

		function bootLoader(){
			$_controller = parent::getController();
			$_method = parent::getMethod();
			$_args   = parent::getArgs();
		}
	}
	
?>
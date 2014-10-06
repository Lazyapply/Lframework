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

		private $module;
		private $event;
		private $params = array();
		private $action;


	}
?>
<?php 
/**********************************************************
	Módulo:				CORE
	Archivo:			dispatcher.php
	Alias:				BootLoader
	Fecha creacion:		12/10/2014
	Ultima modif:		05/11/2014
	Versión: 			0.8
	Autor: 				@dvel_

	Descripción:
	Este archivo es el encargado de comenzar el funcionamiento
	del FW. Al no haber ningun evento de llamada, se pone por
	defecto el evento GO_INI, para que muestre la pagina de inicio
**********************************************************/

	require_once CORE_PATH.DS.'request.php';

	class dispatcher extends request{

		private $_controller;
		private $_method;
		private $_args = array();
		private $_controllerPath;
		private $_content;

		function bootLoader(){
			$this->_controller = parent::getController();
			$this->_method = parent::getMethod();
			$this->_args   = parent::getArgs();
			
			

			//si no es el nucleo
			if($this->_controller != CORE){
				$this->_controllerPath = MODULES.DS.$this->_controller.DS.$this->_controller.'.controller.php';
				
				//si existe el modulo
				if(file_exists($this->_controllerPath)){
					require_once($this->_controllerPath);
					$this->_content = call_user_func_array('handler', array($this->_method,
																		 $this->_args) );
				}
				else{
					echo 'el controlador '.$this->_controller.' no existe';
				}
			}
			else{
				$this->_controllerPath = CORE_PATH.DS.$this->_controller.'.controller.php';
				require_once($this->_controllerPath);
				$this->_content = call_user_func('handler', $this->_method);
			}
			
			print($this->_content);
		}
	}
	
?>
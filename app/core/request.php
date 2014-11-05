<?php 
/**********************************************************
	Módulo:				CORE
	Archivo:			request.php
	Alias:				----
	Fecha creacion:		11/10/2014
	Ultima modif:		05/11/2014
	Versión: 			0.6
	Autor: 				@dvel_

	Descripción:
	Este archivo es el encargado de recoger la URI y
	transformarla en una serie de parametros como sigue:
	www.dominio.com/CONTROLADOR/METODO/ARG1/ARG2/...
**********************************************************/
	require_once 'config.php';
	
	class request{
		private $_controller;
		private $_method;
		private $_args;


		public  function __construct(){
			if(isset($_GET['url']) && ($_GET['url'] != 'site_map/index.php')){

				$url = filter_input(INPUT_GET,'url', FILTER_SANITIZE_URL);
				// explode divide la url, es como el strtok

				$url = explode('/', $url);
				// elimina todos los slash de mas

				// asignamos las variables
				$this->_controller = array_shift($url);
				$this->_method = array_shift($url);
				$this->_args = $url;
			}
			else{
				
				if(!$this->_controller){
				$this->_controller = DEFAULT_CONTROLLER;
				}

				if(!$this->_method){
					$this->_method = 'inicio';
				}

				if(!$this->_args){
					$this->_args = null;
				}
			}
		}



		// GETTERS
		public function getController(){return $this->_controller;}
		public function getMethod(){return $this->_method;}
		public function getArgs(){return $this->_args;}
	}
?>
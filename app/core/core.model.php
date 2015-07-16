<?php 
	
	/**********************************************************

		Módulo:				CORE
		Archivo:			core.model.php
		Alias:				----
		Fecha creacion:		08/09/2014
		Ultima modif:		15/07/2015
		Versión: 			1.1
		Autor: 				@dvel_


		Descripción:
		Este módulo es el encargado de arrancar el framework, 
		llamará a la función ini, para mostrar el inicio de la
		aplicación.
	**********************************************************/
	class core{

		//############## PROPIEDADES #######################
		public $fecha;
		public $hora;
		public $params 		= array();
		public $paramsAux 	= array();
		public $licencia;
		public $autor;
		public $version;


		//############## METODOS #######################
		
		function __construct(){
			$this->fecha 	= date('d-m-Y');
			$this->hora 	= date ('H:i:s');
			$this->version 	= '0.3-dev';
			$this->licencia	= 'NPI';
			$this->autor	= '@Dvel_';
		}

		function __destruct(){
			unset($this);
		}

		#las funciones deben tener el mismo
		#nombre del evento que lo desencadena
		public function ini(){
			$this->params = array(
									'fecha'	=> $this->fecha,
									'hora' 	=> $this->hora,
									'autor'	=> $this->autor,
									'version' 	=> $this->version
								);

		}

		public function about(){
			$this->ini();
			$this->paramsAux = array(
									'version' 	=> $this->version,
									'licencia'	=> $this->licencia,
									'autor'		=> $this->autor
					  				);

			$this->params = array_merge($this->params, $this->paramsAux);
		}

		public function getLayout(){
			$core = new Core();
			$core->ini();
			$data = array('params' => $core->params);
			require_once 'core.view.php';
			return retornar_vista(VIEW_LAYOUT, $data);
		}

		public function setErrPage($customMsg = ''){
				header("HTTP/1.0 404 Not Found");
				echo "<h1>404 Not Found</h1>";
				echo "<h3>".$customMsg."</h3>";
				echo "The page that you have requested could not be found.";
				echo '<p>Error, metodo no encontrado. </p>';
		}

	}
?>
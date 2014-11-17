<?php 

	/**********************************************************

		Módulo:				USUARIOS
		Archivo:			usuarios.model.php
		Alias:				----
		Fecha creacion:		13/11/2014
		Ultima modif:		13/11/2014
		Versión: 			0.1
		Autor: 				@Dvel_


		Descripción:
		Módulo para gestionar usuarios dentro del framework
	**********************************************************/

	require_once INCLUDES.DS.'db_abstract_model.php';
	require_once 'constants.php';


	class usuarios extends DBAbstractModel{

		protected $idU;
		protected $nombre;
		protected $apellido1;
		protected $apellido2;
		protected $usuario;
		protected $pass;
		protected $email;
		protected $tipoU;



		function __destruct(){
			unset($this);
		}

		public function add(){

			if(!empty($_POST)){
				//cuando tenemos post, realizamos la consulta
				$q = "INSERT INTO usuarios (nombre, apellido1, apellido2, usuario, pass, email, tipoUsuario)
						VALUES ('".$_POST['nombre']."', '".$_POST['apellido1']."', '".$_POST['apellido2']."',
							'".$_POST['usuario']."', '".md5($_POST['pass'])."', '".$_POST['email']."', ".$_POST['tipoUsuario'].")";

				//echo $q;
				$this->setQuery($q);
				$this->execute_single_query();
				unset($_POST);
			}
			
		}

		public function signup(){
			if(!empty($_POST)){
				//cuando tenemos post, realizamos la consulta
				$q = "INSERT INTO usuarios (nombre, apellido1, apellido2, usuario, pass, email, tipoUsuario)
						VALUES ('".$_POST['nombre']."', '".$_POST['apellido1']."', '".$_POST['apellido2']."',
							'".$_POST['usuario']."', '".md5($_POST['pass'])."', '".$_POST['email']."', 2)";

				//echo $q;
				$this->setQuery($q);
				$this->execute_single_query();
				unset($_POST);
			}
		}

		public function login(){
			$q = "SELECT usuario, pass WHERE usuario='".$_POST['usuario']."'";
			echo $q;
		}




		function user_exists($user_name){
			$q = "SELECT usuario FROM usuarios WHERE usuario='".$user_name."'";
			$this->setQuery($q);
			$this->get_results_from_query();
			$r = $this->getRows();
			//devolvemos true cuando si que existe.
			if(count($r) > 0){
				return true;
			}
			else{
				return false;
			}
		}
	}

?>
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

		public $params;




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
							'".$_POST['usuario']."', '".md5($_POST['pass'])."', '".$_POST['email']."', 3)";

				//echo $q;
				$this->setQuery($q);
				$this->execute_single_query();
				unset($_POST);
			}
		}

		public function login(){
			$q = "SELECT usuario, pass, tipoUsuario, idUsuario FROM usuarios WHERE usuario='".$_POST['usuario']."'";

			$this->setQuery($q);
			$this->get_results_from_query();

			$userId 	= @$this->rows[0]['idUsuario'];
			$userName 	= @$this->rows[0]['usuario'];
			$userPass 	= @$this->rows[0]['pass'];
			$userPerm 	= intval(@$this->rows[0]['tipoUsuario']);

			if(md5($_POST['pass']) == $userPass){
				session_start();
				$_SESSION['userName'] 	= $userName;
				$_SESSION['userId'] 	= $userId;
				$_SESSION['userPerm'] 	= $userPerm;

				unset($_POST);
				return true;
			}
			else{

				unset($_POST);
				return false;
			}	
		}

		public function logout(){
			session_start();
			session_unset();
			session_destroy();
		}


		public function l(){
			$q = "SELECT * FROM usuarios";
			$this->setQuery($q);
			$this->get_results_from_query();
			$r = $this->getRows();

			foreach ($r as $key => $value) {
				if(@$clave != 'pass')
					$this->params .= '<tr>';

				foreach ($r[$key] as $clave => $valor){

					if($clave != 'pass')
						$this->params .= '<td>'.$valor.'</td>';	
				}

				if(@$clave != 'pass')
					$this->params .= '</tr>';
			}
		}


		public function edit($uId){
				$q = "SELECT nombre, apellido1, apellido2, usuario, email, tipoUsuario FROM usuarios
					  WHERE idUsuario='".$uId."'";

				$this->setQuery($q);
				$this->get_results_from_query();
				$this->params = $this->getRows();
				@session_start();
				$_SESSION['userPermAux'] = $this->params[0]['tipoUsuario'];
			
		}

		public function update($uId){
			$q = "UPDATE usuarios SET nombre='".@$_POST['nombre'].
												"', apellido1='".@$_POST['apellido1'].
												"', apellido2='".@$_POST['apellido2'].
												"', usuario='".@$_POST['usuario'].
												"', tipoUsuario='".@$_POST['tipoUsuario']
					."' WHERE idUsuario='".$uId."'";

				$this->setQuery($q);
				$this->execute_single_query();
				unset($_POST);
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
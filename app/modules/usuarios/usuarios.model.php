<?php 

	/**********************************************************

		Módulo:				USUARIOS
		Archivo:			usuarios.model.php
		Alias:				----
		Fecha creacion:		13/11/2014
		Ultima modif:		27/11/2014
		Versión: 			0.1
		Autor: 				@Dvel_


		Descripción:
		Este módulo es el encargado de gestionar todo lo relacionado
		con los usuarios (ABM)
		Actualmente, la eliminación no está programada, se utilizará
		un sistema de usuarios (activo/bloqueado)
	**********************************************************/

	require_once INCLUDES.DS.'db_abstract_model.php';
	require_once 'constants.php';


	class usuarios extends DBAbstractModel{

		public $params;


		function pass(){
			
			@session_start();

			$pass_ant = $_POST['passAnt'];
			$pass_new = $_POST['passN'];
			$pass_r = $_POST['r_pass'];

			$q = "SELECT pass FROM usuarios WHERE idUsuario = ".$_SESSION['userId'];
			// echo 'la query es '.$q;
			$this->setQuery($q);
			$this->get_results_from_query();
			
			$row = $this->getRows();
	
			$currentPass = $row[0]['pass'];
			// echo  'El current pass es = '.$currentPass;
			

			if ($currentPass == md5($pass_ant)) {
				
				$q = "UPDATE usuarios SET pass = '".md5($pass_new)."' WHERE idUsuario = ".$_SESSION['userId'];
			
				$this->setQuery($q);
				$this->execute_single_query();
				return true;
			}
			else
			{
				return false;
			}
		}

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

				require_once GMAILER;
				$email = new GmrMail();

				$titulo 	= 'Información de registro';
				$mensaje 	= 'Bienvenido '.$_POST['nombre'].' '.$_POST['apellido1'].' '.$_POST['apellido2']
								.',<br> Su registro se ha realizado satisfactoriamente. Tu usuario para acceder es <b>'.
								$_POST['usuario'].'</b> y contraseña <b> '.$_POST['pass'].' </b><br><br>'
								.'Por motivos de seguridad tu cuentas está actualmente desactivada, en breve será activada.'
								.'Si deseas acelerar el proceso puedes enviar un email a admin@fonotecaumh.es';


				$email->sendMail($titulo, $mensaje, $_POST['email'], $_POST['usuario']);


				//Correo para el administrador
				unset($email);
				$email = new GmrMail();
				$titulo 	= 'Usuario registro';
				$mensaje 	= 'Se ha registrado el usuario <b>'.$_POST['nombre'].' '.$_POST['apellido1'].' '.$_POST['apellido2']
								.'</b> con nombre de usuario <b>'.$_POST['usuario'].'</b><br><br>Queda pendiente de activacion.';


				$email->sendMail($titulo, $mensaje, 'admin@fonotecaumh.es', 'admin');


				unset($_POST);
			}
		}

		public function login(){
			$q = "SELECT usuario, pass, tipoUsuario, idUsuario, activo FROM usuarios WHERE usuario='".$_POST['usuario']."'";

			$this->setQuery($q);
			$this->get_results_from_query();

			$userId 	= @$this->rows[0]['idUsuario'];
			$userName 	= @$this->rows[0]['usuario'];
			$userPass 	= @$this->rows[0]['pass'];
			$userPerm 	= intval(@$this->rows[0]['tipoUsuario']);
			$active     = intval(@$this->rows[0]['activo']);

			if(md5($_POST['pass']) == $userPass){
				if($active != 0){
					@session_start();
					$_SESSION['userName'] 	= $userName;
					$_SESSION['userId'] 	= $userId;
					$_SESSION['userPerm'] 	= $userPerm;

					$_POST['msg']='Te has logueado satisfactoriamente';
				}
				else
					$_POST['msg']='Su cuenta aun no está activada, contacte con el administrador';

				//unset($_POST);
				return true;
			}
			else{

				unset($_POST);
				return false;
			}	
		}

		public function logout(){
			@session_start();
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
				//$aux = $key;
				foreach ($r[$key] as $clave => $valor){
					if($clave != 'pass'){
						if ($clave != 'bloqueado') {
							if($clave == 'activo'){
								$this->params .= '<td class="center-align"><input type="checkbox" id="'.$clave.'"';
								if($valor == 1)
									$this->params .= ' checked disabled><label for="'.$clave.'"></label></td>';
								else
									$this->params .= ' disabled><label for="'.$clave.'"></label></td>';
							}
							else{
								$this->params .= '<td class="center-align">'.$valor.'</td>';
							}
						}
						else
						{
							
						}
					}

				}

				//Acciones
				$this->params .='<td class="center-align tooltipped tr-left" data-position="top" data-delay="5" data-tooltip="Editar"><a href="usuarios/edit/'.$r[$key]['idUsuario'].'"><i class="mdi-image-edit tiny umh-blue"></i></a></td>';
				$this->params .='<td class="center-align tooltipped" data-position="top" data-delay="5" data-tooltip="Eliminar"><a href="usuarios/delete/'.$r[$key]['idUsuario'].'"><i class="mdi-action-delete tiny umh-red"></i></a></td>';

				if(@$clave != 'pass')
					$this->params .= '</tr>';
			}
		}


		public function edit($uId){

			$perm =  $this->getUserPerm($uId);

				

				$q = "SELECT nombre, apellido1, apellido2, usuario, email, activo, tipoUsuario FROM usuarios
					  WHERE idUsuario=".$uId."";
		

				

			

				$_SESSION['lastUserId'] = $uId;
				$this->clearRows();
				$this->setQuery($q);
				$this->get_results_from_query();

				$this->params = $this->getRows();
				//cambiamos los valores numericos a checked o no
				foreach ($this->params[0] as $key => $value) {
					if($key == 'bloqueado' or $key == 'activo'){
						if($value == 1)
							$this->params[0][$key] = 'checked';
						else
							$this->params[0][$key] = '';
					}
				}

				

				@session_start();
				$_SESSION['userPermAux'] = $this->params[0]['tipoUsuario'];
			
		}

		public function update($uId){
			//corregimos activo
			if(@$_POST['activo'] == 'on')
				$_POST['activo'] = 1;
			else
				$_POST['activo'] = 0;
			
			$q = "UPDATE usuarios SET nombre='".@$_POST['nombre'].
												"', apellido1='".@$_POST['apellido1'].
												"', apellido2='".@$_POST['apellido2'].
												"', activo=".@$_POST['activo'].
												", usuario='".@$_POST['usuario']."'";
												if(@$_POST['tipoUsuario'])
													$q .= ", tipoUsuario=".@$_POST['tipoUsuario'];
					$q .= " WHERE idUsuario='".$uId."'";
				$this->setQuery($q);
				$this->execute_single_query();
				//echo $q;
				unset($_POST);
		}



		public function delete($uId){
			$q = "DELETE FROM usuarios WHERE idUsuario=".$uId;
			$this->setQuery($q);
			$this->execute_single_query();
			
		}


		public function getUserPerm($uId){
			$q = "SELECT tipoUsuario FROM usuarios WHERE idUsuario =".$uId;
			$this->setQuery($q);
			$this->get_results_from_query();
			$aux = $this->getRows();

			return $aux[0]['tipoUsuario'];
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
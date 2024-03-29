<?php 
	/**********************************************************

		Módulo:				USUARIOS
		Archivo:			usuarios.controller.php
		Alias:				----
		Fecha creacion:		13/11/2014
		Ultima modif:		27/11/2014
		Versión: 			0.1
		Autor: 				@dvel_


		Descripción:
		Este módulo es el encargado de gestionar todo lo relacionado
		con los usuarios (ABM)
		Actualmente, la eliminación no está programada, se utilizará
		un sistema de usuarios (activo/bloqueado)
	**********************************************************/

	require_once 'constants.php';
	require_once 'usuarios.model.php';
	require_once 'usuarios.view.php';
	require_once CORE_PATH.DS.'request.php';

	function handler($event){

		$user = set_obj();
		$req = new request();
		@session_start();
		$_SESSION['lastModule'] = USUARIOS;
		#eventos
		switch ($event) {

				case SET_ADD:

					@session_start();
					//si tiene permisos de admin
					if(@$_SESSION['userPerm'] == 1){
						if(empty($_POST)){
							//llamamos a la vista
							return usuarios_retornar_vista(VIEW_ADD);
						}
						else{
							if($_POST['pass'] == $_POST['r_pass']){
								if(!$user->user_exists($_POST['usuario'])){
									$user->add();						
									//mostramos el cuadro de dato añadido
									$_POST['msg']='Usuario añadido correctamente.';
									return usuarios_retornar_vista(VIEW_MSG);
									unset($_POST);
								}
								else{
									$_POST['msg']='El usuario ya está registrado. Elige otro nombre de usuario';
									return usuarios_retornar_vista(VIEW_ERR);
									unset($_POST);
								}
							}
							else{
								$_POST['msg']='Las contraseñas no coinciden';
								return usuarios_retornar_vista(VIEW_ERR);
								unset($_POST);
							}
						}
					}
					else{
						$_POST['msg']='No tienes permisos para acceder a esta sección de la aplicación.';
						return usuarios_retornar_vista(VIEW_ERR);
						unset($_POST);
					}
				break;

				case SET_SIGNGUP:

					if(empty($_POST)){
						//llamamos a la vista
						return usuarios_retornar_vista(VIEW_SIGNUP);
					}
					else{
						if($_POST['pass'] == $_POST['r_pass']){
							if(!$user->user_exists($_POST['usuario'])){
								$user->signup();						
								//mostramos el cuadro de dato añadido
								$_POST['msg']='Te has registrado correctamente. En breve recibirás un email con mas información.';
								return usuarios_retornar_vista(VIEW_MSG);
								unset($_POST);
							}
							else{
								$_POST['msg']='El usuario ya está registrado. Elige otro nombre de usuario';
								return usuarios_retornar_vista(VIEW_ERR);
								unset($_POST);
							}
						}
						else{
							$_POST['msg']='Las contraseñas no coinciden';
							return usuarios_retornar_vista(VIEW_ERR);
							unset($_POST);
						}
					}

				break;

				case SET_LOGIN:
					if(empty($_POST)){
						return usuarios_retornar_vista(VIEW_LOGIN);
					}
					else{
						if($user->login()){
							
							return usuarios_retornar_vista(VIEW_MSG);
							unset($_POST);
						}
						else{
							$_POST['msg']='El usuario y/o la contraseña son incorrectos';
							return usuarios_retornar_vista(VIEW_ERR);
							unset($_POST);
						}
					}

				break;


				case SET_LOGOUT:
					$user->logout();
					$_POST['msg']='Has cerrado sesión correctamente';
					return usuarios_retornar_vista(VIEW_MSG);
					unset($_POST);
				break;

				case SET_LIST:
					@session_start();
					if(@$_SESSION['userPerm'] == 1){

						$_SESSION['lastPath'] = SET_LIST;
						$user->l();
						$data = array('data' => $user->params);
						//var_dump($user->params);
						//$h = $user->getRows();
						//echo '<br>'.var_dump($h);
						//echo '<br>'.$h[0]['idUsuario'];
						return usuarios_retornar_vista(VIEW_LIST, $data);
					}
					else{
						$_POST['msg']='No tienes permisos para acceder a esta sección de la aplicación.';
						return usuarios_retornar_vista(VIEW_ERR);
						unset($_POST);
					}
				break;

				case SET_EDIT:

					@session_start();
					$req = new Request();
					if(empty($_POST)){
						
						if(@$_SESSION['userPerm'] == 1){
								$x = $req->getArgs();
								@$_SESSION['aux'] = $x[0];

							if(count($x) == 0)
								$user->edit($_SESSION['userId']);
							else
								$user->edit($x[0]);

							return usuarios_retornar_vista(VIEW_EDIT,$user->params[0]);
						}
						else if(isset($_SESSION['userName'])){
							$user->edit($_SESSION['userId']);
							return usuarios_retornar_vista(VIEW_EDIT,$user->params[0]);
						}
						else{
							$_POST['msg']='No tienes permisos para acceder a esta sección de la aplicación.';
							return usuarios_retornar_vista(VIEW_ERR);
							unset($_POST);
						}
					}
					else{
						if($_SESSION['userPerm'] == 1){

							if(isset($_SESSION['aux']))
								$user->update($_SESSION['aux']);
							else
								$user->update($_SESSION['userId']);
									

						}
						else{
							$user->update($_SESSION['userId']);
						}
						unset($_POST);
						$_POST['msg']='El usuario se ha modificado correctamente';
						return usuarios_retornar_vista(VIEW_MSG);
						unset($_POST);
					}
				break;
				case SET_PASS:
					if (empty($_POST)) {
						return usuarios_retornar_vista(VIEW_PASS);
					}
					else
					{
						$cambio = $user->pass();
						unset($_POST);
						if ($cambio) {
							$_POST['msg']='La contraseña se ha modificado correctamente';
						}
						else{
							$_POST['red'] = 'usuarios/pass';
							$_POST['msg']='La contraseña actual no coincide';
						}

						return usuarios_retornar_vista(VIEW_MSG);
						unset($_POST);

					}


				break;
				case SET_BLOCK:
					echo 'block';
				break;

				case SET_DELETE:
					@session_start();
					if(isset($_SESSION['userPerm']) && $_SESSION['userPerm'] == 1){
						

						//$id = $page;

						$argv = $req->getArgs();
						$id = $argv[0];

						echo 'DELETE<br>';
						echo 'lastPath: '.$_SESSION['lastPath'].'<br>';
						echo 'ID:'.$id.'<br>';
						echo "borrado<hr>";


						$user->delete($id);
						//en caso de venir de un listado
						$newURL = '/'.WEB_NAME.'/usuarios/l';
						

						//echo '<br>Sin Redirección: <br>'.$newURL;
						header('Location: '.$newURL);
					}
					else{
						$_POST['msg']='No tienes permisos para acceder a esta sección de la aplicación.';
						return usuarios_retornar_vista(VIEW_ERR);
						unset($_POST);
					}

			break;


				default:
						//$_POST['msg']='La ruta no existe.';
						//return usuarios_retornar_vista(VIEW_ERR);
						
						unset($_POST);

				header("HTTP/1.0 404 Not Found");
				echo "<h1>404 Not Found</h1>";
				echo "The page that you have requested could not be found.";
				echo '<p>Error, metodo no encontrado. </p>';
				// $user->setErrPage();
				exit();
					break;
		}
	}

	function set_obj(){
		$obj = new usuarios();
		return $obj;
	}

?>
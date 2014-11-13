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
	require_once 'usuarios.model.php';
	require_once 'usuarios.view.php';

	function handler($event){

		$user = set_obj();

		#eventos
		switch ($event) {

				case ADD:
					/*$_POST['nombre']='Diego';
					$_POST['apellido1']='Velaochaga';
					$_POST['apellido2']='Vilar';
					$_POST['usuario']='Lazyapply';
					$_POST['pass']='123456789';
					$_POST['email']='lazyapply@gmail.com';
					$_POST['tipoUsuario']=1;*/

					$user->add();
					if(empty($_POST))
						echo '<br/>entrando...';
					
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
		$obj = new usuarios();
		return $obj;
	}



	/*require_once '../app/core/constants.php';
	require_once 'constants.php';

	$template = 'add_user';

		$h =	CORE_PATH.DS.'templates'.DS.'sections'.DS.'section.header.html';
		$t =	MODULES.DS.USUARIOS.DS.'templates'.DS.$template.'.html';
		$f =	CORE_PATH.DS.'templates'.DS.'sections'.DS.'section.footer.html';

			ob_start();
				include_once "$h";
				include_once "$t";
				include_once "$f";
			$template = ob_get_clean();

		echo $template;*/


?>
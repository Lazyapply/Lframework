<?php 
	/**********************************************************

		Módulo:				USUARIOS
		Archivo:			core.usuarios.php
		Alias:				----
		Fecha creacion:		13/11/2014
		Ultima modif:		14/11/2014
		Versión: 			0.1
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

				case SET_ADD:
					if(empty($_POST)){
						//llamamos a la vista
						return usuarios_retornar_vista(VIEW_ADD);
					}
					else{
						$user->add();
						//mostramos el cuadro de dato añadido
						echo 'Usuario a&ntilde;adido correctamente';
						echo '<a href="list">Aceptar</a>';
					}
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
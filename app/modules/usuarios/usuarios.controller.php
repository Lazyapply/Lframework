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
						$_POST['msg']='Usuario añadido correctamente.';
						return usuarios_retornar_vista(VIEW_MSG);
						unset($_POST);
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

?>
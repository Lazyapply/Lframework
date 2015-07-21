<?php 

	/**********************************************************

		Módulo:				USUARIOS
		Archivo:			usuarios.view.php
		Alias:				----
		Fecha creacion:		14/11/2014
		Ultima modif:		27/11/2014
		Versión: 			0.2
		Autor: 				@dvel_


		Descripción:
		Este módulo es el encargado de gestionar todo lo relacionado
		con los usuarios (ABM)
		Actualmente, la eliminación no está programada, se utilizará
		un sistema de usuarios (activo/bloqueado)
	**********************************************************/


	#dependencias
	require_once  	'constants.php';

	$GLOBALS['diccionario'] = array(
			'subtitulo'		=> array(VIEW_ADD		=> 'Añadir nuevo usuario',
									 VIEW_MSG		=> 'Añadir nuevo usuario',
									 VIEW_ERR		=> 'Añadir nuevo usuario',
									 VIEW_SIGNUP	=> 'Registro nuevo usuario',
									 VIEW_LOGIN		=> 'Autentificación',
									 VIEW_LIST		=> 'Lista de usuarios',
									 VIEW_EDIT		=> 'Modificar usuario',
									 VIEW_CP		=> 'Panel de control de Usuarios',
									 VIEW_PASS		=> 'Cambiar contraseña'
									),
			'links_menu'	=> array('VIEW_ADD'		=> GO_ADD,
									 'VIEW_SIGNUP'	=> GO_SIGNUP,
									 'VIEW_LOGIN'	=> GO_LOGIN,
									 'VIEW_LIST'	=> GO_LIST,
									 'VIEW_EDIT'	=> GO_EDIT
									)
						);

	
	function usuarios_get_template($template, $mode){

		require_once CORE_PATH.DS.CORE.'.model.php';
		$c = new core();
		//recogemos el layout del core
		$layout = $c->getLayout($mode);

		#cabecera, template, footer
		$t =	MODULES.DS.USUARIOS.DS.'templates'.DS.$template.'.html';

			ob_start();
				include_once "$t";
			$t = ob_get_clean();

		$layout = str_replace('{content}', $t, $layout);
			#buffer para crear la plantilla
			/*ob_start();
				include_once "$h";
				include_once "$t";
				include_once "$f";
			$template = ob_get_clean();*/

		return $layout;
		//return $template;
	
	}

	function usuarios_render_dinamic_data($html, $data = array()){
		foreach ($data as $clave => $valor) {
			$html = str_replace('{'.$clave.'}', $valor, $html);
		}
		return $html;
	}

	function usuarios_retornar_vista($vista, $data = array(), $mode = 1){

		$diccionario = $GLOBALS['diccionario'];

		$html = usuarios_get_template($vista, $mode);
		$html = str_replace('{subtitulo}', $diccionario['subtitulo'][$vista], $html);
		$html = usuarios_render_dinamic_data($html, $diccionario['links_menu']);

		if(!empty($data))
			$html = usuarios_render_dinamic_data($html, $data);

		
		return $html;
	}

?>
<?php 

	/**********************************************************

		Módulo:				USUARIOS
		Archivo:			core.usuarios.php
		Alias:				----
		Fecha creacion:		14/11/2014
		Ultima modif:		14/11/2014
		Versión: 			0.1
		Autor: 				@dvel_


		Descripción:
		Este módulo es el encargado de arrancar el framework, 
		llamará a la función ini, para mostrar el inicio de la
		aplicación.
	**********************************************************/


	#dependencias
	require_once  	'constants.php';

	$GLOBALS['diccionario'] = array(
			'subtitulo'		=> array(VIEW_ADD	=> 'Añadir nuevo usuario',
									 VIEW_MSG	=> 'Añadir nuevo usuario'
									),
			'links_menu'	=> array('VIEW_ADD'	=> GO_ADD
									)
						);

	
	function usuarios_get_template($template){

		require_once CORE_PATH.DS.CORE.'.model.php';
		$c = new core();
		//recogemos el layout del core
		$layout = $c->getLayout();

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

	function usuarios_retornar_vista($vista, $data = array()){

		$diccionario = $GLOBALS['diccionario'];

		$html = usuarios_get_template($vista);
		$html = str_replace('{subtitulo}', $diccionario['subtitulo'][$vista], $html);
		$html = usuarios_render_dinamic_data($html, $diccionario['links_menu']);

		if(!empty($data))
			$html = usuarios_render_dinamic_data($html, $data['params']);

		
		return $html;
	}

?>
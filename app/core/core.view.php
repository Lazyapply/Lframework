<?php 

	/**********************************************************
		Módulo:			core
		Archivo:		view.php
		Fecha:			08/09/2014
		Versión: 		0.1
		Autor: 			@dvel_

		Descripción:
		Este módulo es el encargado de arrancar el framework, 
		llamará a la función ini, para mostrar el inicio de la
		aplicación.
	**********************************************************/


	#dependencias
	require_once  	'constants.php';

	$GLOBALS['diccionario'] = array(
			'titulo'		=> array(VIEW_INI		=> 'Bienvenido a L framework',
									 VIEW_ABOUT		=> 'Bienvenido a L framework'
									),
			'metaKey'		=> array(VIEW_INI		=> 'HTML5, CSS3, MVC, Modelo, Vista, Controlador, Patron, Framework',
									 VIEW_ABOUT		=> 'HTML5, CSS3, MVC, Modelo, Vista, Controlador, Patron, Framework'
									),
			'metaDesc'		=> array(VIEW_INI		=> 'Pequeño framework para MVC en php',
									 VIEW_ABOUT		=> 'Pequeño framework para MVC en php'
									),
			'subtitulo'		=> array(VIEW_INI		=> 'Framework para MVC en php',
									 VIEW_ABOUT		=> 'Framework para MVC en php'
									),
			'links_menu'	=> array('VIEW_INI'		=> GO_INI,
									 'VIEW_ABOUT'	=> GO_ABOUT
									)
						);

	
	function get_template($template){
		#cabecera, template, footer
		$h =	CORE_PATH.DS.'templates'.DS.'sections'.DS.'section.header.html';
		$t =	CORE_PATH.DS.'templates'.DS.$template.'.html';
		$f =	CORE_PATH.DS.'templates'.DS.'sections'.DS.'section.footer.html';

			#buffer para crear la plantilla
			ob_start();
				include_once "$h";
				include_once "$t";
				include_once "$f";
			$template = ob_get_clean();

		return $template;
	
	}

	function render_dinamic_data($html, $data = array()){
		foreach ($data as $clave => $valor) {
			$html = str_replace('{'.$clave.'}', $valor, $html);
		}
		return $html;
	}

	function retornar_vista($vista, $data = array()){

		$diccionario = $GLOBALS['diccionario'];

		$html = get_template($vista);
		$html = str_replace('{titulo}', $diccionario['titulo'][$vista], $html);
		$html = str_replace('{subtitulo}', $diccionario['subtitulo'][$vista], $html);
		$html = str_replace('{metaKey}', $diccionario['metaKey'][$vista], $html);
		$html = str_replace('{metaDesc}', $diccionario['metaDesc'][$vista], $html);
		$html = render_dinamic_data($html, $diccionario['links_menu']);

		$html = render_dinamic_data($html, $data['params']);

		
		return $html;
	}

?>
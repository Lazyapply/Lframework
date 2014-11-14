<?php 

	define('USUARIOS', 'usuarios');


	#events
	define('SET_ADD', 		'add');
	define('SET_EDIT', 		'edit');
	define('SET_DELETE', 	'delete');
	define('SET_LIST', 		'list');
	define('SET_LOGIN', 	'login');
	define('SET_SINGUP', 	'singup');
	define('SET_FORGOT', 	'forgot');

	//TODO: FALTA LAS CONSTANTES

	#actions
	define('GO_ADD', 	USUARIOS.DS.SET_ADD);
	define('GO_EDIT', 	USUARIOS.DS.SET_EDIT);
	define('GO_DELETE', 	USUARIOS.DS.SET_ADD);
	define('GO_ADD', 	USUARIOS.DS.SET_ADD);
	define('GO_ADD', 	USUARIOS.DS.SET_ADD);
	define('GO_ADD', 	USUARIOS.DS.SET_ADD);

	#views
	define('VIEW_ADD', 'add_user');
	define('VIEW_MSG', 'msg');

?>
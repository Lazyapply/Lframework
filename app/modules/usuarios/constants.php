<?php 

	define('USUARIOS', 'usuarios');


	#events
	define('SET_ADD', 		'add');
	define('SET_EDIT', 		'edit');
	define('SET_DELETE', 	'delete');
	define('SET_LIST', 		'list');
	define('SET_LOGIN', 	'login');
	define('SET_SIGNGUP', 	'singup');
	define('SET_FORGOT', 	'forgot');


	#actions
	define('GO_ADD', 		USUARIOS.DS.SET_ADD);
	define('GO_EDIT', 		USUARIOS.DS.SET_EDIT);
	define('GO_DELETE', 	USUARIOS.DS.SET_DELETE);
	define('GO_LIST', 		USUARIOS.DS.SET_LIST);
	define('GO_LOGIN', 		USUARIOS.DS.SET_LOGIN);
	define('GO_SIGNUP', 	USUARIOS.DS.SET_SIGNGUP);
	define('GO_FORGOT', 	USUARIOS.DS.SET_FORGOT);



	#views
	define('VIEW_ADD', 		'add_user');
	define('VIEW_EDIT', 	'mod_user');
	define('VIEW_DELETE', 	'delete_user');
	define('VIEW_LIST', 	'list_user');
	define('VIEW_LOGIN', 	'login');
	define('VIEW_SIGNUP', 	'signup');
	define('VIEW_FORGOT', 	'forgot');

	define('VIEW_MSG', 'msg');

?>
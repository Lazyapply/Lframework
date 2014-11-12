<?php 

function handler($event){
	require_once '../app/core/constants.php';
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

		echo $template;
}

?>
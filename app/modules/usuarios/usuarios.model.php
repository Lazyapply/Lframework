<?php 

	
	require_once ('constants.php');

	class Users extends DBAbstractModel{

		public $name;
		public $firstName;
		public $email;
		private $pass;
		protected $id;


	    // Buscar usuario
	    public function getUser(){
	    	if($user_mail != ''){
	    		$this->query = "
					SELECT 	id, name, firstName, email, pass
					FROM	usuarios
					WHERE	email = '$user_mail'
	    		";
	    		$this->get_results_from_query();
	    	}

			if(count($this->rows) == 1) {
				foreach ($this->rows[0] as $propiedad=>$valor) {
				$this->$propiedad = $valor;
			}
				$this->mensaje ='Usuario encontrado';
			} else {
				$this->mensaje ='Usuario no encontrado';
			}
	    }

	}

?>
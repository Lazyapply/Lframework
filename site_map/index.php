<?php 
	require_once('../app/core/includes/constants.php');
	require_once(ROOT.DS.'app'.DS.CORE.DS.'includes'.DS.'db_abstract_model.php');


	class test extends DBAbstractModel{




		public function test(){
			$this->query = "CREATE TABLE usuarios
				(
					id_usuario 			int NOT NULL AUTO_INCREMENT,
					nombre_usuario		varchar(20),
					nombre				varchar(20),
					apellido1			varchar(20),
					apellido2			varchar(20),
					pass				varchar(50),
					email				varchar(50),
					fecha_nacimiento	date,
					fecha_ingreso		date,
					permiso				int,
					PRIMARY KEY (id_usuario)
				)";
			$this->execute_single_query();
		}
	}

	$t = new test();
	$t->test();
 ?>
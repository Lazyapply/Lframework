<?php 

	//tiposUsuarios
	$q['tiposUsuarios'] = "CREATE TABLE tiposUsuarios
					(
						idTipoUsuario		int(3) NOT NULL AUTO_INCREMENT,
						nombreTipo			varchar(20),
						permiso				int(2),

						PRIMARY KEY (idTipoUsuario)
					)
					";


$q['usuarios'] ="CREATE TABLE usuarios
				(
					idUsuario		int(3) AUTO_INCREMENT,
					nombre			varchar(100),
					apellido1		varchar(100),
					apellido2		varchar(100),
					usuario			varchar(100),
					pass 			varchar(100),
					email			varchar(100),
					bloqueado		tinyint(1) NOT NULL DEFAULT 0,
					activo			tinyint(1) NOT NULL DEFAULT 0,
					tipoUsuario 	int(3),

					PRIMARY KEY (idUsuario),
					FOREIGN KEY (tipoUsuario) REFERENCES tiposUsuarios(idTipoUsuario)
				)
				";

	foreach ($q as $key => $value) {
		mysqli_report(MYSQLI_REPORT_STRICT);

		$conexion->query($value);
		if($conexion->error != NULL){
			echo 'Error on table '.$key;
			echo 'Error: '.$conexion->error;
			exit;
		}
		else{
			echo $key.' table created<br/>';
		}
	}


?>
DROP TABLE tiposusuarios;

CREATE TABLE `tiposusuarios` (
  `idTipoUsuario` int(3) NOT NULL AUTO_INCREMENT,
  `nombreTipo` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `permiso` int(2) DEFAULT NULL,
  PRIMARY KEY (`idTipoUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

INSERT INTO tiposusuarios VALUES("1","usuario","3");
INSERT INTO tiposusuarios VALUES("2","admin","1");
INSERT INTO tiposusuarios VALUES("3","Documentalista","2");



DROP TABLE usuarios;

CREATE TABLE `usuarios` (
  `idUsuario` int(3) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `apellido1` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `apellido2` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `usuario` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `pass` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '0',
  `tipoUsuario` int(3) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `tipoUsuario` (`tipoUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

INSERT INTO usuarios VALUES("31","Diego","Velaochaga","Vilar","diego","21232f297a57a5a743894a0e4a801fc3","lazyapply@gmail.com","1","1");
INSERT INTO usuarios VALUES("81","Paco","Menéndez","Salazar","usuario","f8032d5cae3de20fcec887f395ec9a6a","usuario@g.com","1","3");




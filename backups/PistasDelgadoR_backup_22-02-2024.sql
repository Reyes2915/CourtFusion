

CREATE TABLE `empresas` (
  `id_empresa` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nombre_empresa` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `correo_contacto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `telefono_contacto` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `comunidad_autonoma` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `provincia` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `municipio` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `direccion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `codigo_postal` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `contrasena` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO empresas VALUES('654ed2cb1a3f1','Empresa 2','empresa2@example.com','123456789','Comunidad1','Provincia3','Municipio2','Calle1','67890','$2y$10$oO8f.fih7KLmJQS13OCjYO1ZwHg4WH0UzdnPmjyZQxaj/yCGhiWXa');
INSERT INTO empresas VALUES('654ed2cb30a04','Empresa 3','empresa3@example.com','123456789','Comunidad2','Provincia3','Municipio2','Calle3','54321','$2y$10$FBtWLFKmtQmM1mFL7Yllm.8nLnhiQeeXkMnvmrOKt1YCBwXKG5HES');
INSERT INTO empresas VALUES('654ed2cb49b64','Empresa 4','empresa4@example.com','123456789','Comunidad3','Provincia2','Municipio2','Calle3','67890','$2y$10$q1UbXuzW5QjZmnl3lM6tCOHELP0WGIR6Tz3jfFfVy.tMZynXb.IBm');
INSERT INTO empresas VALUES('654ed2cb5ea1d','Empresa 5','empresa5@example.com','123456789','Comunidad2','Provincia3','Municipio3','Calle3','12345','$2y$10$7n7QUmtlH/BsGmgFWmqQyO6OtCe.9dA119h94gCpB337W3OEnozAm');
INSERT INTO empresas VALUES('654ed2cb74700','Empresa 6','empresa6@example.com','123456789','Comunidad1','Provincia2','Municipio3','Calle2','67890','$2y$10$pgCIXua6ArHeTNC9keNtoOAEL/1KMp7vH8YRwHdUS1RCPC0ArYEzi');
INSERT INTO empresas VALUES('654ed2cb8a29a','Empresa 7','empresa7@example.com','123456789','Comunidad2','Provincia1','Municipio3','Calle3','67890','$2y$10$wsizyvn3wyXmhJ1Si3WIm.CRjECoXX/y/toH7mVZr0XWOvzHJhVl6');
INSERT INTO empresas VALUES('654ed2cb9f17b','Empresa 8','empresa8@example.com','123456789','Comunidad3','Provincia3','Municipio1','Calle2','54321','$2y$10$WlCD0hJIshgZu0QUS0jdd.gqEcpthiwgehaIkmh0mSyNLDRZK8Fpq');
INSERT INTO empresas VALUES('654ed2cbb452a','Empresa 9','empresa9@example.com','123456789','Comunidad1','Provincia3','Municipio1','Calle3','54321','$2y$10$jz9Od8WrdPX1Cugfftos3.hedGtraWRZhk3hRZI2Nwmbbts9y/rZO');
INSERT INTO empresas VALUES('654ed2cbc932f','Empresa de Reyes','empresa33@example.com','123456733','Comunidad33','Provincia33','Municipio33','Calle33','12345','$2y$10$KFHWKTsr7dwDAOfAb/I9Z.pYf/M/ETBpv56A7APisegLS1J5aMUNu');
INSERT INTO empresas VALUES('654ed2cbdeb98','Empresa 11','empresa11@example.com','123456789','Comunidad2','Provincia3','Municipio3','Calle2','54321','$2y$10$Igmdv9rWF3Q9FCq5Ml.9bOOSLG/GEajiQ8744Dl/Sl2VY6LvtqQ6S');
INSERT INTO empresas VALUES('654ed2cc01816','Empresa 12','empresa12@example.com','123456789','Comunidad1','Provincia3','Municipio2','Calle3','67890','$2y$10$WpDvlcns47L.xgI/.ccaGOduB85JBVuDPmD4OmqkVHVBaGANrZ.Qe');
INSERT INTO empresas VALUES('654ed2cc17bbf','Empresa 13','empresa13@example.com','123456789','Comunidad3','Provincia1','Municipio1','Calle1','12345','$2y$10$V2MJgGEHGGEiIbEJZ57viOyCXHjBj9iqBOXrP8GCTiuDARMNLvqc6');
INSERT INTO empresas VALUES('654ed2cc2ceec','Empresa 14','empresa14@example.com','123456789','Comunidad3','Provincia1','Municipio3','Calle1','67890','$2y$10$HW4xOlwQuA45P7pPO2cNieqRkJx4I3zvCiU8yMMia8.hNoYy0w0oG');
INSERT INTO empresas VALUES('654ed2cc437a3','Empresa 15','empresa15@example.com','123456789','Comunidad1','Provincia1','Municipio1','Calle3','54321','$2y$10$no4.063FIeHixmn1tX6l6eqrSq6YJEl6MSWg0sQ40NdOD2p5tbuT.');
INSERT INTO empresas VALUES('654ed2cc58933','Empresa 16','empresa16@example.com','123456789','Comunidad1','Provincia3','Municipio2','Calle1','12345','$2y$10$Tgz.TlJPid/Ygc80Yl/sxOp9M1ds6e1/Ey5dA9wOxduIRT8ZvKHYW');
INSERT INTO empresas VALUES('654ed2cc6d5a1','Empresa 17','empresa17@example.com','123456789','Comunidad1','Provincia1','Municipio2','Calle1','12345','$2y$10$qE8PJta30wQ26cgtkzfDWeKj5Xe29ZfH6Y21fzcHzGoEud6IbmKLS');
INSERT INTO empresas VALUES('654ed2cc83002','Empresa 18','empresa18@example.com','123456789','Comunidad2','Provincia2','Municipio3','Calle1','67890','$2y$10$kPMNrBNiDouQDMDPQaXdceTXni65GI2CSz0qmZMnX1DGu9t/I/GN6');
INSERT INTO empresas VALUES('654ed2cc98b5d','Empresa 19','empresa19@example.com','123456789','Comunidad1','Provincia2','Municipio3','Calle3','54321','$2y$10$EbRWveE.x/HmRpEgt/wkwuxUfF23ItsZTwDXY.l14DI9nzo1MLkJ.');
INSERT INTO empresas VALUES('654ed2ccae2a7','Empresa 20','reyesds496@gmail.com','123456789','Comunidad3','Provincia3','Municipio2','Calle2','12345','$2y$10$mwxt613ZN7b0J219EviIyuXKcH878LiVhl2KR4ia6cKeX4ld1BMR6');
INSERT INTO empresas VALUES('65a44ea84e65b','Empresa del Betis','betis@gmail.com','123456789','ANDALUCÍA','SEVILLA','CAMAS','Avenida de la Palmera','16004','$2y$10$ily4n8YXcsN5ZvcQxGS5VeBPRNe6rijQIZ7u0CFrOIhDwnjtXtc/q');


CREATE TABLE `favoritos` (
  `id_favorito` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_usuario` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_pista` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id_favorito`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_pista` (`id_pista`),
  CONSTRAINT `favoritos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  CONSTRAINT `favoritos_ibfk_2` FOREIGN KEY (`id_pista`) REFERENCES `pistas` (`id_pista`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO favoritos VALUES('65a68c378f5f1','654ed2c806308','659c68b486c7d');
INSERT INTO favoritos VALUES('65a8f36d98f01','654ed2c806308','659c69028cd0b');
INSERT INTO favoritos VALUES('65b6bc164e3d2','65a3d292bdfaa','65a3e2eab9c2a');
INSERT INTO favoritos VALUES('65b6bc18a6535','65a3d292bdfaa','659c75304753a');


CREATE TABLE `pistas` (
  `id_pista` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tipo_pista` enum('Fútbol','Baloncesto','Tenis','Pádel') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nombre_pista` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `comunidad_autonoma` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `provincia` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `municipio` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `direccion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `codigo_postal` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `correo_contacto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `telefono_contacto` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `precio_hora` decimal(10,2) NOT NULL,
  `hora_apertura` time NOT NULL,
  `hora_cierre` time NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `validacion` enum('ACTIVA','POR VALIDAR','INACTIVA') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'POR VALIDAR',
  `id_empresa` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id_pista`),
  KEY `id_empresa` (`id_empresa`),
  CONSTRAINT `pistas_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO pistas VALUES('654ed2ccc409d','Fútbol','Pista 1','CANTABRIA','CANTABRIA','ANIEVAS','Calle1','67890','contacto2@example.com','123456789','63.00','08:00:00','21:00:00','2023-11-11 01:03:08','POR VALIDAR','654ed2cc437a3');
INSERT INTO pistas VALUES('654ed2ccc60b6','Pádel','Pista 2','CANTABRIA','CANTABRIA','ANIEVAS','Calle1','67890','contacto3@example.com','123456789','70.00','10:00:00','20:00:00','2023-11-11 01:03:08','ACTIVA','654ed2cbc932f');
INSERT INTO pistas VALUES('654ed2ccc75ae','Pádel','Pista 3','CANTABRIA','CANTABRIA','ANIEVAS','Calle3','12345','contacto1@example.com','123456789','26.00','10:00:00','22:00:00','2023-11-11 01:03:08','ACTIVA','654ed2cc2ceec');
INSERT INTO pistas VALUES('654ed2ccc85f0','Tenis','Pista 4','CANTABRIA','CANTABRIA','ANIEVAS','Calle3','54321','contacto2@example.com','987654321','14.00','10:00:00','22:00:00','2023-11-11 01:03:08','POR VALIDAR','654ed2cc6d5a1');
INSERT INTO pistas VALUES('654ed2ccca26b','Fútbol','Pista 5','CANTABRIA','CANTABRIA','ANIEVAS','Calle2','67890','contacto2@example.com','123456789','34.00','10:00:00','20:00:00','2023-11-11 01:03:08','ACTIVA','654ed2cb9f17b');
INSERT INTO pistas VALUES('654ed2cccb2ed','Baloncesto','Pista 6','CANTABRIA','CANTABRIA','ANIEVAS','Calle1','54321','contacto2@example.com','123456789','29.00','08:00:00','20:00:00','2023-11-11 01:03:08','INACTIVA','654ed2cbc932f');
INSERT INTO pistas VALUES('654ed2cccc24f','Pádel','Pista 7','CANTABRIA','CANTABRIA','ANIEVAS','Calle2','12345','contacto2@example.com','123456789','53.00','10:00:00','21:00:00','2023-11-11 01:03:08','INACTIVA','654ed2cb5ea1d');
INSERT INTO pistas VALUES('654ed2cccd047','Baloncesto','Pista 8','CANTABRIA','CANTABRIA','ANIEVAS','Calle2','67890','contacto2@example.com','123456789','79.00','09:00:00','21:00:00','2023-11-11 01:03:08','INACTIVA','654ed2ccae2a7');
INSERT INTO pistas VALUES('654ed2cccdf2d','Fútbol','Pista 9','CANTABRIA','CANTABRIA','ANIEVAS','Calle1','67890','contacto2@example.com','987654321','72.00','09:00:00','20:00:00','2023-11-11 01:03:08','INACTIVA','654ed2cbdeb98');
INSERT INTO pistas VALUES('654ed2ccced70','Tenis','Pista 10','CANTABRIA','CANTABRIA','ANIEVAS','Calle3','67890','contacto1@example.com','123456789','36.00','08:00:00','21:00:00','2023-11-11 01:03:08','POR VALIDAR','654ed2cbdeb98');
INSERT INTO pistas VALUES('654ed2cccfd88','Pádel','Pista 11','CANTABRIA','CANTABRIA','ANIEVAS','Calle1','67890','contacto1@example.com','123456789','100.00','08:00:00','22:00:00','2023-11-11 01:03:08','INACTIVA','654ed2cc01816');
INSERT INTO pistas VALUES('654ed2ccd0ebe','Pádel','Pista 12','CANTABRIA','CANTABRIA','ANIEVAS','Calle2','67890','contacto3@example.com','123456789','13.00','09:00:00','22:00:00','2023-11-11 01:03:08','ACTIVA','654ed2cc437a3');
INSERT INTO pistas VALUES('654ed2ccd1f39','Fútbol','Pista 13','CANTABRIA','CANTABRIA','ANIEVAS','Calle1','54321','contacto2@example.com','123456789','93.00','10:00:00','21:00:00','2023-11-11 01:03:08','INACTIVA','654ed2cbb452a');
INSERT INTO pistas VALUES('654ed2ccd305d','Tenis','Pista 14','CANTABRIA','CANTABRIA','ANIEVAS','Calle1','12345','contacto2@example.com','123456789','77.00','08:00:00','22:00:00','2023-11-11 01:03:08','POR VALIDAR','654ed2cc437a3');
INSERT INTO pistas VALUES('654ed2ccd4066','Pádel','Pista 15','CANTABRIA','CANTABRIA','ANIEVAS','Calle3','12345','contacto2@example.com','123456789','59.00','08:00:00','20:00:00','2023-11-11 01:03:08','POR VALIDAR','654ed2cc6d5a1');
INSERT INTO pistas VALUES('654ed2ccd5091','Pádel','Pista 16','CANTABRIA','CANTABRIA','ANIEVAS','Calle1','54321','contacto2@example.com','987654321','29.00','09:00:00','22:00:00','2023-11-11 01:03:08','POR VALIDAR','654ed2cbc932f');
INSERT INTO pistas VALUES('654ed2ccd6144','Pádel','Pista 17','CANTABRIA','CANTABRIA','ANIEVAS','Calle1','67890','contacto1@example.com','123456789','95.00','10:00:00','22:00:00','2023-11-11 01:03:08','POR VALIDAR','654ed2cc58933');
INSERT INTO pistas VALUES('654ed2ccd733f','Baloncesto','Pista 18','CANTABRIA','CANTABRIA','ANIEVAS','Calle3','54321','contacto2@example.com','123456789','75.00','09:00:00','22:00:00','2023-11-11 01:03:08','ACTIVA','654ed2cb74700');
INSERT INTO pistas VALUES('654ed2ccd81d4','Tenis','Pista 19','CANTABRIA','CANTABRIA','ANIEVAS','Calle1','67890','contacto2@example.com','987654321','72.00','08:00:00','20:00:00','2023-11-11 01:03:08','INACTIVA','654ed2cb9f17b');
INSERT INTO pistas VALUES('654ed2ccddfce','Baloncesto','Pista 21','CANTABRIA','CANTABRIA','ANIEVAS','Calle2','54321','contacto1@example.com','123456789','58.00','10:00:00','22:00:00','2023-11-11 01:03:08','INACTIVA','654ed2cb9f17b');
INSERT INTO pistas VALUES('654ed2ccdf0a5','Baloncesto','Ñísta 22','CANTABRIA','CANTABRIA','ANIEVAS','Calle1','12345','contacto1@example.com','123456789','29.00','10:00:00','20:00:00','2023-11-11 01:03:08','ACTIVA','654ed2cbdeb98');
INSERT INTO pistas VALUES('654ed2cce00d1','Tenis','Pista 23','CANTABRIA','CANTABRIA','ANIEVAS','Calle3','54321','contacto2@example.com','123456789','77.00','09:00:00','21:00:00','2023-11-11 01:03:08','ACTIVA','654ed2cc2ceec');
INSERT INTO pistas VALUES('654ed2cce1035','Fútbol','Pista 24','CANTABRIA','CANTABRIA','ANIEVAS','Calle3','12345','contacto1@example.com','123456789','41.00','08:00:00','22:00:00','2023-11-11 01:03:08','ACTIVA','654ed2cc17bbf');
INSERT INTO pistas VALUES('654ed2cce2063','Fútbol','Pista 25','CANTABRIA','CANTABRIA','ANIEVAS','Calle3','67890','contacto2@example.com','123456789','24.00','10:00:00','20:00:00','2023-11-11 01:03:08','POR VALIDAR','654ed2cc58933');
INSERT INTO pistas VALUES('654ed2cce2ff4','Baloncesto','Pista 26','CANTABRIA','CANTABRIA','ANIEVAS','Calle1','54321','contacto3@example.com','123456789','90.00','09:00:00','20:00:00','2023-11-11 01:03:08','POR VALIDAR','654ed2cc98b5d');
INSERT INTO pistas VALUES('654ed2cce3ef6','Tenis','Pista 27','CANTABRIA','CANTABRIA','ANIEVAS','Calle1','67890','contacto1@example.com','987654321','78.00','10:00:00','22:00:00','2023-11-11 01:03:08','POR VALIDAR','654ed2cb8a29a');
INSERT INTO pistas VALUES('654ed2cce4dd0','Tenis','Pista 28','CANTABRIA','CANTABRIA','ANIEVAS','Calle3','54321','contacto2@example.com','123456789','22.00','08:00:00','22:00:00','2023-11-11 01:03:08','ACTIVA','654ed2cb5ea1d');
INSERT INTO pistas VALUES('654ed2cce6ee6','Pádel','Pista 30','CANTABRIA','CANTABRIA','ANIEVAS','Calle3','54321','contacto1@example.com','123456789','33.00','10:00:00','21:00:00','2023-11-11 01:03:08','ACTIVA','654ed2cb5ea1d');
INSERT INTO pistas VALUES('654ed2cce7e57','Pádel','Pista 31','CANTABRIA','CANTABRIA','ANIEVAS','Calle1','12345','contacto2@example.com','123456789','6.00','09:00:00','22:00:00','2023-11-11 01:03:08','ACTIVA','654ed2cb30a04');
INSERT INTO pistas VALUES('654ed2cce8ed3','Fútbol','Pista 32','CANTABRIA','CANTABRIA','ANIEVAS','Calle3','67890','contacto3@example.com','123456789','29.00','09:00:00','21:00:00','2023-11-11 01:03:08','ACTIVA','654ed2cc58933');
INSERT INTO pistas VALUES('654ed2cce9d56','Baloncesto','Pista 33','CANTABRIA','CANTABRIA','ANIEVAS','Calle1','67890','contacto2@example.com','123456789','26.00','09:00:00','21:00:00','2023-11-11 01:03:08','ACTIVA','654ed2cc98b5d');
INSERT INTO pistas VALUES('654ed2cceb035','Pádel','Pista 34','CANTABRIA','CANTABRIA','ANIEVAS','Calle2','67890','contacto1@example.com','123456789','89.00','09:00:00','22:00:00','2023-11-11 01:03:08','ACTIVA','654ed2cb9f17b');
INSERT INTO pistas VALUES('654ed2ccebfdf','Baloncesto','Pista 35','CANTABRIA','CANTABRIA','ANIEVAS','Calle1','67890','contacto1@example.com','123456789','7.00','08:00:00','21:00:00','2023-11-11 01:03:08','ACTIVA','654ed2cb1a3f1');
INSERT INTO pistas VALUES('654ed2ccecf11','Tenis','Pista 36','CANTABRIA','CANTABRIA','ANIEVAS','Calle3','54321','contacto2@example.com','123456789','91.00','09:00:00','22:00:00','2023-11-11 01:03:08','POR VALIDAR','654ed2cb74700');
INSERT INTO pistas VALUES('654ed2ccedf61','Baloncesto','Pista 37','CANTABRIA','CANTABRIA','ANIEVAS','Calle2','67890','contacto2@example.com','123456789','69.00','08:00:00','20:00:00','2023-11-11 01:03:08','POR VALIDAR','654ed2cbdeb98');
INSERT INTO pistas VALUES('654ed2ccf3f75','Tenis','Pista 38','CANTABRIA','CANTABRIA','ANIEVAS','Calle3','67890','contacto3@example.com','987654321','57.00','08:00:00','20:00:00','2023-11-11 01:03:09','POR VALIDAR','654ed2cc58933');
INSERT INTO pistas VALUES('654ed2cd01355','Baloncesto','Pista 39','CANTABRIA','CANTABRIA','ANIEVAS','Calle1','54321','contacto3@example.com','123456789','56.00','10:00:00','22:00:00','2023-11-11 01:03:09','INACTIVA','654ed2cc98b5d');
INSERT INTO pistas VALUES('654ed2cd02c8c','Baloncesto','Pista 40','CANTABRIA','CANTABRIA','ANIEVAS','Calle3','12345','contacto3@example.com','123456789','100.00','09:00:00','20:00:00','2023-11-11 01:03:09','POR VALIDAR','654ed2cbdeb98');
INSERT INTO pistas VALUES('654ed2cd03e8e','Baloncesto','Pista 41','CANTABRIA','CANTABRIA','ANIEVAS','Calle1','12345','reyesdelgadoserrano@gmail.com','987654321','11.00','09:00:00','21:00:00','2023-11-11 01:03:09','ACTIVA','654ed2cc2ceec');
INSERT INTO pistas VALUES('654ed2cd0501c','Fútbol','Pista 42','CANTABRIA','CANTABRIA','ANIEVAS','Calle2','54321','contacto2@example.com','123456789','93.00','10:00:00','21:00:00','2023-11-11 01:03:09','POR VALIDAR','654ed2cb74700');
INSERT INTO pistas VALUES('654ed2cd0b7b8','Tenis','Pista 43','CANTABRIA','CANTABRIA','ANIEVAS','Calle2','12345','contacto1@example.com','123456789','67.00','10:00:00','21:00:00','2023-11-11 01:03:09','POR VALIDAR','654ed2cc98b5d');
INSERT INTO pistas VALUES('654ed2cd0cd50','Baloncesto','Pista 44','CANTABRIA','CANTABRIA','ANIEVAS','Calle3','12345','contacto3@example.com','123456789','95.00','10:00:00','20:00:00','2023-11-11 01:03:09','ACTIVA','654ed2cb5ea1d');
INSERT INTO pistas VALUES('654ed2cd0e225','Fútbol','Pista 45','CANTABRIA','CANTABRIA','ANIEVAS','Calle3','67890','contacto2@example.com','123456789','53.00','08:00:00','22:00:00','2023-11-11 01:03:09','INACTIVA','654ed2cb5ea1d');
INSERT INTO pistas VALUES('654ed2cd10bd6','Pádel','Pista 47','CANTABRIA','CANTABRIA','ANIEVAS','Calle2','67890','contacto1@example.com','987654321','91.00','09:00:00','21:00:00','2023-11-11 01:03:09','INACTIVA','654ed2cc58933');
INSERT INTO pistas VALUES('654ed2cd12221','Tenis','Pista 48','CANTABRIA','CANTABRIA','ANIEVAS','Calle2','54321','contacto1@example.com','123456789','63.00','08:00:00','22:00:00','2023-11-11 01:03:09','POR VALIDAR','654ed2cb49b64');
INSERT INTO pistas VALUES('654ed2cd139a3','Tenis','Pista 49','CANTABRIA','CANTABRIA','ANIEVAS','Calle2','54321','contacto1@example.com','987654321','49.00','09:00:00','21:00:00','2023-11-11 01:03:09','INACTIVA','654ed2cc98b5d');
INSERT INTO pistas VALUES('654ed2cd14dde','Baloncesto','Pista 50','CANTABRIA','CANTABRIA','ANIEVAS','Calle1','54321','contacto3@example.com','987654321','3.00','08:00:00','22:00:00','2023-11-11 01:03:09','ACTIVA','654ed2cc6d5a1');
INSERT INTO pistas VALUES('654ed2cd16285','Pádel','Pista 51','CANTABRIA','CANTABRIA','ANIEVAS','Calle1','12345','contacto1@example.com','123456789','3.00','09:00:00','22:00:00','2023-11-11 01:03:09','INACTIVA','654ed2cb1a3f1');
INSERT INTO pistas VALUES('654ed2cd177c7','Fútbol','Pista 52','CANTABRIA','CANTABRIA','ANIEVAS','Calle3','12345','contacto2@example.com','123456789','4.00','10:00:00','22:00:00','2023-11-11 01:03:09','ACTIVA','654ed2cc58933');
INSERT INTO pistas VALUES('654ed2cd1e65f','Baloncesto','Pista 53','CANTABRIA','CANTABRIA','ANIEVAS','Calle1','12345','contacto3@example.com','987654321','67.00','10:00:00','20:00:00','2023-11-11 01:03:09','ACTIVA','654ed2cbc932f');
INSERT INTO pistas VALUES('654ed2cd1fc90','Pádel','Pista 54','CANTABRIA','CANTABRIA','ANIEVAS','Calle1','54321','contacto3@example.com','123456789','53.00','10:00:00','20:00:00','2023-11-11 01:03:09','INACTIVA','654ed2cc83002');
INSERT INTO pistas VALUES('654ed2cd2130b','Baloncesto','Pista 55','CANTABRIA','CANTABRIA','ANIEVAS','Calle2','54321','contacto2@example.com','123456789','3.00','10:00:00','20:00:00','2023-11-11 01:03:09','POR VALIDAR','654ed2cb8a29a');
INSERT INTO pistas VALUES('654ed2cd22993','Pádel','Pista 56','CANTABRIA','CANTABRIA','ANIEVAS','Calle2','67890','contacto3@example.com','987654321','50.00','08:00:00','21:00:00','2023-11-11 01:03:09','ACTIVA','654ed2cc58933');
INSERT INTO pistas VALUES('654ed2cd256ad','Pádel','Pista 58','CANTABRIA','CANTABRIA','ANIEVAS','Calle2','12345','contacto1@example.com','987654321','28.00','09:00:00','21:00:00','2023-11-11 01:03:09','INACTIVA','654ed2cc437a3');
INSERT INTO pistas VALUES('654ed2cd26b77','Pádel','Pista 59','CANTABRIA','CANTABRIA','ANIEVAS','Calle2','54321','contacto2@example.com','123456789','38.00','09:00:00','22:00:00','2023-11-11 01:03:09','ACTIVA','654ed2cc01816');
INSERT INTO pistas VALUES('654ed2cd2800c','Pádel','Pista 60','CANTABRIA','CANTABRIA','ANIEVAS','Calle3','54321','contacto1@example.com','987654321','12.00','10:00:00','21:00:00','2023-11-11 01:03:09','POR VALIDAR','654ed2cb9f17b');
INSERT INTO pistas VALUES('659c66a159da6','Tenis','Pista de Tenis de Alarcon','CASTILLA LA MANCHA','CUENCA','ALARCÓN','Calle Hurtado Perez','16004','alarcon@gmail.com','1123456789','25.00','14:00:00','22:00:00','2024-01-08 21:18:25','ACTIVA','654ed2cbc932f');
INSERT INTO pistas VALUES('659c684dd63f3','Tenis','Pista de Tenis de Anchuelo','MADRID','COMUNIDAD DE MADRID','ANCHUELO','Calle Jorge Manrique','28818','anchuelo@gmail.com','11234721389','20.00','14:30:00','21:30:00','2024-01-08 21:25:33','ACTIVA','654ed2cbc932f');
INSERT INTO pistas VALUES('659c68b486c7d','Pádel','Pista de Pádel de Betanzos','GALICIA','LA CORUÑA','BETANZOS','Calle Pablo Muñoz','15300','betanzos@gmail.com','0987654321','35.00','13:00:00','21:00:00','2024-01-08 21:27:16','ACTIVA','654ed2cbc932f');
INSERT INTO pistas VALUES('659c69028cd0b','Fútbol','Pista de Fútbol de Cuenca','CASTILLA LA MANCHA','CUENCA','CUENCA','Calle Reyes Delgado','16004','cuenca@gmail.com','1123097623','30.00','16:00:00','22:00:00','2024-01-08 21:28:34','ACTIVA','654ed2cbc932f');
INSERT INTO pistas VALUES('659c75304753a','Tenis','Pista de Tenis de Cartagena','MURCIA','REGIÓN DE MURCIA','CARTAGENA','Calle Hurtado Jorge','30201','cartagena@gmail.com','22236221389','20.00','10:00:00','17:00:00','2024-01-08 22:20:32','ACTIVA','654ed2cbc932f');
INSERT INTO pistas VALUES('65a3e2eab9c2a','Baloncesto','Pista de Tenis de Cordoba','CASTILLA LA MANCHA','CUENCA','LAGUNA DEL MARQUESADO','Calle Hurtado Perez','15300','cordoba@gmail.com','0987654321','20.00','12:30:00','22:40:00','2024-01-14 13:34:34','ACTIVA','654ed2cbc932f');
INSERT INTO pistas VALUES('65a4e61644b13','Fútbol','Pista de Fútbol de Fuentes','CASTILLA LA MANCHA','CUENCA','FUENTES','Calle Jorge Manrique','16004','cordoba@gmail.com','0987654321','20.00','13:00:00','18:00:00','2024-01-15 08:00:22','POR VALIDAR','654ed2cbc932f');


CREATE TABLE `reservas` (
  `id_reserva` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_usuario` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_pista` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nombre_reservante` varchar(90) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `hora_inicio_reserva` datetime NOT NULL,
  `hora_fin_reserva` datetime NOT NULL,
  PRIMARY KEY (`id_reserva`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_pista` (`id_pista`),
  CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`id_pista`) REFERENCES `pistas` (`id_pista`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO reservas VALUES('123tr0pltash4','654ed2c7b91df','654ed2cd03e8e','Claudio Lopez','2023-11-15 23:15:38','2023-11-15 00:17:38');
INSERT INTO reservas VALUES('654ed2bnjkmn5','654ed2c775155','654ed2ccc60b6','Ñaru Cifuentes','2024-01-25 12:00:00','2024-01-25 13:10:00');
INSERT INTO reservas VALUES('654ed2bnjkmn8','654ed2c775155','654ed2ccc60b6','Ñeru Cifuentes','2024-01-25 17:30:00','2024-01-25 19:30:00');
INSERT INTO reservas VALUES('65a3ea3abb51b','65a3d2dc45ad8','654ed2cd22993','Soy Nuria Vollanueva y quiero ','2024-01-16 22:30:00','2024-01-16 23:30:00');
INSERT INTO reservas VALUES('65d626252d913','654ed2c7b91df','659c69028cd0b','Reyes Delgado','2024-02-29 16:00:00','2024-02-29 17:25:00');
INSERT INTO reservas VALUES('65d6262690479','654ed2c7b91df','659c69028cd0b','Reyes Delgado','2024-02-29 16:00:00','2024-02-29 17:25:00');
INSERT INTO reservas VALUES('65d62627a0c67','654ed2c7b91df','659c69028cd0b','Reyes Delgado','2024-02-29 16:00:00','2024-02-29 17:25:00');


CREATE TABLE `usuarios` (
  `id_usuario` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `correo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `rol` enum('Administrador','Usuario','Empresa') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `saldo` decimal(10,2) DEFAULT '0.00',
  `contrasena` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO usuarios VALUES('654ed2c775155','Cañí Cifu','reyesdelgadoserrano@gmail.com','Administrador','0.00','$2y$10$Tp56PcdJsQXyvmqaQqzUI.QEgGSiWw2edJLEyxstNSu6m209pmaU6');
INSERT INTO usuarios VALUES('654ed2c78cfd0','Usuario 2','usuario2@example.com','Administrador','0.00','$2y$10$Vi.hWIZlqTdS598yfR.Xoug4vUnmQCOGAtCAllnClOfbxFkkU5euy');
INSERT INTO usuarios VALUES('654ed2c7a3b6e','Usuario 3','usuario3@example.com','Administrador','0.00','$2y$10$7.VFtlJja0LdtTK4ju7vCO4Jenl5a143oz5/PQMjvh0cLg1w7KeP.');
INSERT INTO usuarios VALUES('654ed2c7b91df','Usuario 4','reyesds496@gmail.com','Usuario','38.87','$2y$10$VRFyPIyKEcDdsC7oyzwmCOMLLSwCkIzqiLKirXXBBA9pPHMTZiA/6');
INSERT INTO usuarios VALUES('654ed2c7cea05','Usuario 5','usuario5@example.com','Administrador','0.00','$2y$10$VrcAG1uWWqt0PBdHSgNjeemH9n0bCfgLM49HU8sppeWwRikg2mlRu');
INSERT INTO usuarios VALUES('654ed2c7e3dbb','Usuario 6','usuario6@example.com','Administrador','0.00','$2y$10$QCW9ZAxYJqbaFWdJGDrRu..iBfVNhIKb2krkeIMaBC8rlSzLdcuDm');
INSERT INTO usuarios VALUES('654ed2c806308','Usuario 7','usuario7@example.com','Usuario','310.00','$2y$10$2TYjBrD2LKlR1bqfEiD1b.Kp7mbCNe4tFslaHYUrmdcVm88jIvKGm');
INSERT INTO usuarios VALUES('654ed2c81b9b3','Usuario 8','usuario8@example.com','Administrador','0.00','$2y$10$.aepw0n2K1Zm3ohfiTYE.eFMZ49w/94kPdk2JOT.60JhnlEphgyZW');
INSERT INTO usuarios VALUES('654ed2c83152c','Usuario 9','usuario9@example.com','Usuario','0.00','$2y$10$9D82sooKsNJyDsssLWrlYu.6RyaA9WwAgEp2j2ab2FHDQHAPFGY46');
INSERT INTO usuarios VALUES('654ed2c84694b','Usuario 10','usuario10@example.com','Administrador','0.00','$2y$10$uzkcAT/p8sUFLTUPwRVMC.e8Grkfnt45UpTuD/Mly2ng1.hqMvUVm');
INSERT INTO usuarios VALUES('654ed2c85bdcd','Usuario 11','usuario11@example.com','Administrador','0.00','$2y$10$z/DtuS8zWZNqF8npGyYK5u9MkjxwSPIuN6jGv9BjA4rysD7OUSP72');
INSERT INTO usuarios VALUES('654ed2c871676','Usuario 12','usuario12@example.com','Usuario','0.00','$2y$10$NxgGVZOIznR6wxPvFkXb/uAF.ETIWuoXkiBzcrTI4QSp02goV5AjS');
INSERT INTO usuarios VALUES('654ed2c887bcc','Usuario 13','usuario13@example.com','Usuario','0.00','$2y$10$yJzsbU/f5IO175GVbVyWzer6DINwfVeCkXPRFcEXz9A4fTl914IcW');
INSERT INTO usuarios VALUES('654ed2c89d0b9','Usuario 14','usuario14@example.com','Administrador','0.00','$2y$10$5Um2lbzAVnVNLg8w0DRoYeYGEve8tFAKBvUFRuAsMgAIWJqNtonTK');
INSERT INTO usuarios VALUES('654ed2c8b2666','Usuario 15','usuario15@example.com','Administrador','0.00','$2y$10$d2yB/mhG3J7UxW/AVcUX0eqS9bG1X0mavmAZnxb5lQWdP0qis/HlG');
INSERT INTO usuarios VALUES('654ed2c8c8b0d','Usuario 16','usuario16@example.com','Administrador','0.00','$2y$10$s7W5ti0q4QNx2wo7THi6uu6yWym4Ox1gmDLLl2Xl9a7HRGadTbgQy');
INSERT INTO usuarios VALUES('654ed2c8dead8','Usuario 17','usuario17@example.com','Usuario','0.00','$2y$10$Si6edOOctsIaINtRyK.fn.4hj8Jqpzr0Y3EBwAaApZen6zqoGk2vG');
INSERT INTO usuarios VALUES('654ed2c8f3233','Usuario 18','usuario18@example.com','Administrador','0.00','$2y$10$abv17ubQHXSwrCncgL4swO7LAe7MjpiqwEyYaIw3wZGofezv0EyQq');
INSERT INTO usuarios VALUES('654ed2c9147d2','Usuario 19','usuario19@example.com','Usuario','0.00','$2y$10$5Ju/xTGBFrXT8KNWMZEBsOYQn0JI8C6cnv7jtlv4/XTyc1erbk55.');
INSERT INTO usuarios VALUES('654ed2c929ee8','Usuario 20','usuario20@example.com','Usuario','0.00','$2y$10$AGCDeDdrBLGHpJV072uhfOa/7fjlvjsC/5z/d/giztrjqpB8b1aEG');
INSERT INTO usuarios VALUES('654ed2c93fa33','Usuario 21','usuario21@example.com','Administrador','0.00','$2y$10$Bfw/3mgfUsKaUKwZkjf6Z.h78hK7zgbzd7blGH.0RobuYKiCLTaN6');
INSERT INTO usuarios VALUES('654ed2c954f3a','Usuario 22','usuario22@example.com','Usuario','0.00','$2y$10$QQ8cWJZ1ImkccDXcM46dL.kzQwQr4Z/eK1ihSYyAxFYpVZ7mCBJG6');
INSERT INTO usuarios VALUES('654ed2c96a0e4','Usuario 23','usuario23@example.com','Administrador','0.00','$2y$10$/U/nCl4Jis3WEdNy.yX3.uSwMWOtSD.u8/3M4T.L/ToADClTbAOPa');
INSERT INTO usuarios VALUES('654ed2c981080','Usuario 24','usuario24@example.com','Usuario','0.00','$2y$10$sGQFtBqevkJGDYZsIS/dH.uLpNXE0Gx.ghLTSQC5CLk5vRx0LwxKW');
INSERT INTO usuarios VALUES('654ed2c99633b','Usuario 25','usuario25@example.com','Administrador','0.00','$2y$10$Gq6u9Sh9liE4q5wpZVLeQOy0PAsVmOfRabrhupKDkcKtrO0vkOOLW');
INSERT INTO usuarios VALUES('654ed2c9ab769','Usuario 26','usuario26@example.com','Administrador','0.00','$2y$10$zoZKqhBIaKhOwQbyGzGZHOKhPA8F7aJSbY194sZkiYl/Wt47FYQje');
INSERT INTO usuarios VALUES('654ed2c9c0859','Usuario 27','usuario27@example.com','Usuario','0.00','$2y$10$s/mhdIyeZL8tzEYXT.JsJe0QGTRbqzEaPdlotMeWm6iT3Jwm8f6Fa');
INSERT INTO usuarios VALUES('654ed2c9d6864','Usuario 28','usuario28@example.com','Usuario','0.00','$2y$10$U1vSA82OMfIH4EoIUdMc7e2iLyt.3ozUgloObzG42W5izF/nG.5Tu');
INSERT INTO usuarios VALUES('654ed2c9eb31f','Usuario 29','usuario29@example.com','Administrador','0.00','$2y$10$5XId3PVw.rXJ8xuRyVcOcuPBc7.vduU6zq69jxv0ypRsevPTzujuK');
INSERT INTO usuarios VALUES('654ed2ca0c320','Usuario 30','usuario30@example.com','Administrador','0.00','$2y$10$poA69oRxcD.mMMoZjYHVK.bix1AxV/ULPfne/x5xo311oM3.3QBqu');
INSERT INTO usuarios VALUES('654ed2ca22506','Usuario 31','usuario31@example.com','Administrador','0.00','$2y$10$9wsC8KNrzPq9ihgs7dq5i.ywINyHwAGgFsH.56DJ3xO1XB3m77nUW');
INSERT INTO usuarios VALUES('654ed2ca37c57','Usuario 32','usuario32@example.com','Usuario','0.00','$2y$10$kHk5DLauOl9gE/2sEPhwzuRFQqujtZljXSOdoqfzC3t7YQzQeJYai');
INSERT INTO usuarios VALUES('654ed2ca4ce7e','Usuario 33','usuario33@example.com','Administrador','0.00','$2y$10$wj31BAixmfTsuQMZp36Dru4uhVZr9X0dgx1QA2RI48phDXUF0VYOC');
INSERT INTO usuarios VALUES('654ed2ca620f5','Usuario 34','usuario34@example.com','Usuario','0.00','$2y$10$3KgxdW07oRJgS2kOwnQIBumDK9DxWrTMdtPEP7MwO8XF1Qz.T154W');
INSERT INTO usuarios VALUES('654ed2ca78318','Usuario 35','usuario35@example.com','Administrador','0.00','$2y$10$gLxGIdpHpRua./dcolvoL.OABmfSugNPI0M4wuzm8okasAB5qQ7Ue');
INSERT INTO usuarios VALUES('654ed2ca8d61e','Usuario 36','usuario36@example.com','Usuario','0.00','$2y$10$TvfHi0OEjKBJdPTIImktie0XCoENfk4DH7Mr1OHWV.mLB3I4dARIG');
INSERT INTO usuarios VALUES('654ed2caa259d','Usuario 37','usuario37@example.com','Usuario','0.00','$2y$10$QxPQcgkLdLsQG.F4zymOj.8UazhVTWexMdRF9eYKKKCwYHuUZtICG');
INSERT INTO usuarios VALUES('654ed2cab78dc','Usuario 38','usuario38@example.com','Administrador','0.00','$2y$10$sR6D7cDN5MCUmX8Pf6jWGeFBJc6BNC5yTHI.QZm9tFyAyYnVOW9l2');
INSERT INTO usuarios VALUES('654ed2cacd5a6','Usuario 39','usuario39@example.com','Administrador','0.00','$2y$10$ezfbdOi0lraR3cQvlpqaZejB6LTAuVJ0dtY4XQqOEBEWvc7H32RYC');
INSERT INTO usuarios VALUES('654ed2cae2d36','Usuario 40','usuario40@example.com','Administrador','0.00','$2y$10$tQ0GVBesDGG1g7CML5190eQFxWBTt79iDjP2bNhv0HbNcgU2sk1A2');
INSERT INTO usuarios VALUES('65a3d292bdfaa','Pablo Cifuentes','pablo@gmail.com','Administrador','0.00','$2y$10$F8Tuct6RR5jt5z1PdtmR/.u/Zf6BagRQErfwkKETEFDwhg.A6QVrC');
INSERT INTO usuarios VALUES('65a3d2dc45ad8','Nuria','nuria@gmail.com','Usuario','0.00','$2y$10$95zXY9tB3xwsjbsOPQwHduc900J3J7DAbVMcdepSUvsivxZE5HSou');


CREATE TABLE `valoraciones` (
  `id_valoracion` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_usuario` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_pista` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `valoracion` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_valoracion`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_pista` (`id_pista`),
  CONSTRAINT `valoraciones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  CONSTRAINT `valoraciones_ibfk_2` FOREIGN KEY (`id_pista`) REFERENCES `pistas` (`id_pista`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO valoraciones VALUES('65540e52b8764','654ed2c775155','654ed2cd01355','dislike');
INSERT INTO valoraciones VALUES('65540e5b7dca8','654ed2c775155','654ed2cd0501c','dislike');
INSERT INTO valoraciones VALUES('65540e5c4c71a','654ed2c775155','654ed2cd0e225','like');
INSERT INTO valoraciones VALUES('6563885f6439d','654ed2c775155','654ed2ccf3f75','like');
INSERT INTO valoraciones VALUES('656388fb17b04','654ed2c775155','654ed2cd02c8c','like');
INSERT INTO valoraciones VALUES('6563891b4cb12','654ed2c806308','654ed2cd0e225','like');
INSERT INTO valoraciones VALUES('65638925f2974','654ed2c806308','654ed2ccf3f75','dislike');
INSERT INTO valoraciones VALUES('659c71bfb8ae3','654ed2c775155','659c69028cd0b','like');
INSERT INTO valoraciones VALUES('659c71c2183fc','654ed2c775155','659c68b486c7d','dislike');
INSERT INTO valoraciones VALUES('659c71cd9a36b','654ed2c775155','659c684dd63f3','dislike');
INSERT INTO valoraciones VALUES('659c72e60ce07','654ed2c83152c','659c69028cd0b','like');
INSERT INTO valoraciones VALUES('659c72e788a07','654ed2c83152c','659c68b486c7d','like');
INSERT INTO valoraciones VALUES('659c72e8dc504','654ed2c83152c','659c684dd63f3','dislike');
INSERT INTO valoraciones VALUES('65c7d6615b358','65a3d292bdfaa','654ed2ccd733f','dislike');

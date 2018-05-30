/* 
 06/05/2018-12:31
*/

ALTER TABLE `woofs` ADD `Puntos` INT NOT NULL AFTER `IDMedia`;
ALTER TABLE `usuario` DROP `Nickname`;
ALTER TABLE `mascota` CHANGE `URLFoto` `URLFoto` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE `media` CHANGE `URLImagen` `URLImagen` VARCHAR(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `usuario` CHANGE `URLFoto` `URLFoto` VARCHAR(300) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;

/**-----------------------------**/
ALTER TABLE `usuario` CHANGE `Clave` `Clave` VARCHAR(255) NOT NULL;
ALTER TABLE `woofs` ADD `Fecha` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `Puntos`;
ALTER TABLE `media` ADD `fecha` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `URLImagen`;

/*****************************************/
ALTER TABLE `comentario` ADD `fecha` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `Comentario`;

/****************************************/ 
ALTER TABLE `usuario` ADD `IDMascotaPrincipal` INT NULL AFTER `Bio`;
ALTER TABLE `usuario` ADD CONSTRAINT `FK_MascotaPrincipal` FOREIGN KEY (`IDMascotaPrincipal`) REFERENCES `mascota`(`ID`) ON DELETE SET NULL ON UPDATE CASCADE;

/******************** NUEVO ********************/ 
ALTER TABLE `comentario` CHANGE `IDUsuario` `IDMascota` INT(11) NOT NULL;
ALTER TABLE `woofs` CHANGE `IDUsuario` `IDMascota` INT(11) NOT NULL;
ALTER TABLE `comentario` DROP FOREIGN KEY `FK_Comentario_usuario`; ALTER TABLE `comentario` ADD CONSTRAINT `FK_Comentario_mascota` FOREIGN KEY (`IDMascota`) REFERENCES `mascota`(`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*Amigos*/
ALTER TABLE `amigos` DROP FOREIGN KEY `FK_Amigos_seguido`; ALTER TABLE `amigos` ADD CONSTRAINT `FK_Amigos_seguido` FOREIGN KEY (`IDSeguido`) REFERENCES `mascota`(`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `amigos` ADD `Aceptado` TINYINT NOT NULL ;
/*Para probar casos*/
INSERT INTO `amigos` (`IDSeguidor`, `IDSeguido`, `Aceptado`) VALUES
(40, 53, 1),
(41, 53, 1),
(42, 53, 0);
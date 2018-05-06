-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-05-2018 a las 23:37:12
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `anigram`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amigos`
--

CREATE TABLE `amigos` (
  `IDSeguidor` int(11) NOT NULL,
  `IDSeguido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `ID` int(11) NOT NULL,
  `IDUsuario` int(11) NOT NULL,
  `IDMedia` int(11) NOT NULL,
  `Comentario` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comercio`
--

CREATE TABLE `comercio` (
  `ID` int(11) NOT NULL,
  `Poseedor` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Correo` varchar(30) NOT NULL,
  `Telefono` varchar(30) NOT NULL,
  `Descripcion` varchar(300) DEFAULT NULL,
  `URLImagen` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comercio`
--

INSERT INTO `comercio` (`ID`, `Poseedor`, `Nombre`, `Correo`, `Telefono`, `Descripcion`, `URLImagen`) VALUES
(1, 93, 'bicis a go go', 'bicis@gogo.com', '787994653', 'bicicle.jpg', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `denuncia`
--

CREATE TABLE `denuncia` (
  `ID` int(11) NOT NULL,
  `IDMedia` int(11) NOT NULL,
  `motivo` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hashtag`
--

CREATE TABLE `hashtag` (
  `ID` int(11) NOT NULL,
  `Comentario` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascota`
--

CREATE TABLE `mascota` (
  `ID` int(11) NOT NULL,
  `Amo` int(11) NOT NULL,
  `Tipo` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Raza` varchar(20) NOT NULL,
  `URLFoto` varchar(200) DEFAULT NULL,
  `Bio` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mascota`
--

INSERT INTO `mascota` (`ID`, `Amo`, `Tipo`, `Nombre`, `Raza`, `URLFoto`, `Bio`) VALUES
(40, 88, 1, 'nina1', 'nina1', '88-white_walker___disney_got_collection_by_nandomendonssa-d7k15kz.jpg', ''),
(41, 89, 2, 'Mico', 'Mapache', '89-the_wind____by_alicexz-d32dzjq.jpg', ''),
(42, 90, 1, 'Pichula', 'Collie', '90-ww.jpg', ''),
(43, 91, 2, 'Mico', 'Mapache', '91-madam_mim_transformation_by_mattesworks-d62v2i8.jpg', ''),
(44, 92, 2, 'Cosi', 'Porco', '', ''),
(53, 107, 1, 'Flounder', 'pez', '107-flounder-items-article-081417.jpg', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `media`
--

CREATE TABLE `media` (
  `ID` int(11) NOT NULL,
  `Mascota` int(11) NOT NULL,
  `Tipo` int(11) NOT NULL,
  `URLImagen` varchar(300) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `media`
--

INSERT INTO `media` (`ID`, `Mascota`, `Tipo`, `URLImagen`, `fecha`) VALUES
(9, 40, 1, '88-white_walker___disney_got_collection_by_nandomendonssa-d7k15kz.jpg', '2018-05-06 21:00:04'),
(10, 41, 1, '90-ww.jpg', '2018-05-06 21:00:04'),
(11, 53, 1, '-flounder-items-article-081417.jpg', '2018-05-06 21:00:04'),
(12, 53, 1, '107-someday_by_alicexz-d3jese3.jpg', '2018-05-06 21:00:04'),
(13, 53, 1, '107-thumb-1920-736068.png', '2018-05-06 21:01:08'),
(14, 53, 1, '107-the_wind____by_alicexz-d32dzjq.jpg', '2018-05-06 21:18:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `ID` int(11) NOT NULL,
  `IDReceptor` int(11) NOT NULL,
  `IDEmisor` int(11) NOT NULL,
  `Tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`ID`, `Nombre`) VALUES
(1, 'Dueño'),
(2, 'Comercio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_mascota`
--

CREATE TABLE `tipo_mascota` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `URLIcono` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_mascota`
--

INSERT INTO `tipo_mascota` (`ID`, `Nombre`, `URLIcono`) VALUES
(1, 'Perro', 'perro-icon.png'),
(2, 'gato', 'gato-icon.png'),
(3, 'conejo', 'conejo-icon.png'),
(6, 'cobaya', 'cobaya-icon.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_media`
--

CREATE TABLE `tipo_media` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_media`
--

INSERT INTO `tipo_media` (`ID`, `Nombre`) VALUES
(1, 'Foto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_notificacion`
--

CREATE TABLE `tipo_notificacion` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ID` int(11) NOT NULL,
  `Rol` int(11) NOT NULL,
  `NombreCompleto` varchar(30) DEFAULT NULL,
  `Email` varchar(30) NOT NULL,
  `Clave` varchar(300) NOT NULL,
  `URLFoto` varchar(300) DEFAULT NULL,
  `Bio` varchar(300) DEFAULT NULL,
  `Bloqueado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID`, `Rol`, `NombreCompleto`, `Email`, `Clave`, `URLFoto`, `Bio`, `Bloqueado`) VALUES
(88, 1, 'lord hielo', 'lordhielo@email.com', 'd75926bcf3c0e4f69bd6ce4a3fa08173', 'white_walker___disney_got_collection_by_nandomendo', NULL, 0),
(89, 1, 'pocahontas', 'pocahontas@email.com', '7a38b8ed3d03b29058371ff1c1a2f1cf', 'the_wind____by_alicexz-d32dzjq.jpg', NULL, 0),
(90, 1, 'Nina', 'nina@richi.com', 'e570a73f1d9e510f332a050d2db31df2', '', NULL, 0),
(91, 1, 'Jane', 'jane@email.com', 'b7ec2a8f9f17584b2b98fb4cc3af2900', 'Jane-and-Tarzan-disney-couples-38425213-1600-900.jpg', NULL, 0),
(92, 1, 'rapunzel', 'rapunzel@email.com', 'bfc7db7faced8215e77eba225930fabd', 'Rapunzel-disney-princess-29231501-1440-900.jpg', NULL, 0),
(93, 2, 'aurora', 'aurora@ains.com', '863b18f162f6df2e16f1ea1efa9ed4fc', '-Thomas-Kinkade-Disney-Dreams-disney-princess-31528031-1280-720.jpg', NULL, 0),
(107, 1, 'Ariel de los 7 Mares', 'ariel@mar.es', '$2y$10$dPRVkj7jmi6K/aqQptE/8eZpEra0O2MYYt0hJzRbfUMg1.YG62gdW', 'someday_by_alicexz-d3jese3.jpg', NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_comercio`
--

CREATE TABLE `usuarios_comercio` (
  `IDUsuario` int(11) NOT NULL,
  `IDComercio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `woofs`
--

CREATE TABLE `woofs` (
  `IDUsuario` int(11) NOT NULL,
  `IDMedia` int(11) NOT NULL,
  `Puntos` int(11) NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `woofs`
--

INSERT INTO `woofs` (`IDUsuario`, `IDMedia`, `Puntos`, `Fecha`) VALUES
(90, 9, 3, '2018-05-06 19:28:16'),
(91, 9, 5, '2018-05-06 19:28:16'),
(92, 9, 3, '2018-05-06 19:28:16'),
(92, 10, 5, '2018-05-06 19:28:16'),
(107, 9, 4, '2018-05-06 19:50:28'),
(107, 10, 5, '2018-05-06 19:49:44');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `amigos`
--
ALTER TABLE `amigos`
  ADD PRIMARY KEY (`IDSeguidor`,`IDSeguido`),
  ADD KEY `FK_Amigos_seguido` (`IDSeguido`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_Comentario_usuario` (`IDUsuario`),
  ADD KEY `FK_Comentario_media` (`IDMedia`);

--
-- Indices de la tabla `comercio`
--
ALTER TABLE `comercio`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_Poseedor_comercio` (`Poseedor`);

--
-- Indices de la tabla `denuncia`
--
ALTER TABLE `denuncia`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_Denundia_media` (`IDMedia`);

--
-- Indices de la tabla `hashtag`
--
ALTER TABLE `hashtag`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_Hashtag_comentario` (`Comentario`);

--
-- Indices de la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_Mascota_amo` (`Amo`),
  ADD KEY `FK_Mascota_tipo` (`Tipo`);

--
-- Indices de la tabla `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_Media_mascota` (`Mascota`),
  ADD KEY `FK_Media_tipo` (`Tipo`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_Notificaciones_Receptor` (`IDReceptor`),
  ADD KEY `FK_Notificaciones_Emisor` (`IDEmisor`),
  ADD KEY `FK_Notificaciones_tipo` (`Tipo`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `tipo_mascota`
--
ALTER TABLE `tipo_mascota`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `tipo_media`
--
ALTER TABLE `tipo_media`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `tipo_notificacion`
--
ALTER TABLE `tipo_notificacion`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_Usuarios_rol` (`Rol`);

--
-- Indices de la tabla `usuarios_comercio`
--
ALTER TABLE `usuarios_comercio`
  ADD PRIMARY KEY (`IDUsuario`,`IDComercio`),
  ADD KEY `FK_UsuComercio_comercio` (`IDComercio`);

--
-- Indices de la tabla `woofs`
--
ALTER TABLE `woofs`
  ADD PRIMARY KEY (`IDUsuario`,`IDMedia`),
  ADD KEY `FK_Woofs_media` (`IDMedia`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comercio`
--
ALTER TABLE `comercio`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `denuncia`
--
ALTER TABLE `denuncia`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `hashtag`
--
ALTER TABLE `hashtag`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mascota`
--
ALTER TABLE `mascota`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `media`
--
ALTER TABLE `media`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_mascota`
--
ALTER TABLE `tipo_mascota`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tipo_media`
--
ALTER TABLE `tipo_media`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_notificacion`
--
ALTER TABLE `tipo_notificacion`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `amigos`
--
ALTER TABLE `amigos`
  ADD CONSTRAINT `FK_Amigos_seguido` FOREIGN KEY (`IDSeguido`) REFERENCES `usuario` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Amigos_seguidor` FOREIGN KEY (`IDSeguidor`) REFERENCES `mascota` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `FK_Comentario_media` FOREIGN KEY (`IDMedia`) REFERENCES `media` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Comentario_usuario` FOREIGN KEY (`IDUsuario`) REFERENCES `usuario` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comercio`
--
ALTER TABLE `comercio`
  ADD CONSTRAINT `FK_Poseedor_comercio` FOREIGN KEY (`Poseedor`) REFERENCES `usuario` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `denuncia`
--
ALTER TABLE `denuncia`
  ADD CONSTRAINT `FK_Denundia_media` FOREIGN KEY (`IDMedia`) REFERENCES `media` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `hashtag`
--
ALTER TABLE `hashtag`
  ADD CONSTRAINT `FK_Hashtag_comentario` FOREIGN KEY (`Comentario`) REFERENCES `comentario` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD CONSTRAINT `FK_Mascota_amo` FOREIGN KEY (`Amo`) REFERENCES `usuario` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Mascota_tipo` FOREIGN KEY (`Tipo`) REFERENCES `tipo_mascota` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `FK_Media_mascota` FOREIGN KEY (`Mascota`) REFERENCES `mascota` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Media_tipo` FOREIGN KEY (`Tipo`) REFERENCES `tipo_media` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `FK_Notificaciones_Emisor` FOREIGN KEY (`IDEmisor`) REFERENCES `usuario` (`ID`),
  ADD CONSTRAINT `FK_Notificaciones_Receptor` FOREIGN KEY (`IDReceptor`) REFERENCES `usuario` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Notificaciones_tipo` FOREIGN KEY (`Tipo`) REFERENCES `tipo_notificacion` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_Usuarios_rol` FOREIGN KEY (`Rol`) REFERENCES `rol` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios_comercio`
--
ALTER TABLE `usuarios_comercio`
  ADD CONSTRAINT `FK_UsuComercio_comercio` FOREIGN KEY (`IDComercio`) REFERENCES `comercio` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_UsuComercio_usuario` FOREIGN KEY (`IDUsuario`) REFERENCES `usuario` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `woofs`
--
ALTER TABLE `woofs`
  ADD CONSTRAINT `FK_Woofs_media` FOREIGN KEY (`IDMedia`) REFERENCES `media` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Woofs_usuario` FOREIGN KEY (`IDUsuario`) REFERENCES `usuario` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

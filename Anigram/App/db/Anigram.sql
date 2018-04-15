-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 14-04-2018 a las 23:51:24
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Anigram`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Amigos`
--

CREATE TABLE `Amigos` (
  `IDSeguidor` int(11) NOT NULL,
  `IDSeguido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Comentario`
--

CREATE TABLE `Comentario` (
  `ID` int(11) NOT NULL,
  `IDUsuario` int(11) NOT NULL,
  `IDMedia` int(11) NOT NULL,
  `Comentario` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Comercio`
--

CREATE TABLE `Comercio` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Correo` varchar(30) NOT NULL,
  `Descripcion` varchar(300) DEFAULT NULL,
  `URLImagen` varchar(30) DEFAULT NULL,
  `Tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Denuncia`
--

CREATE TABLE `Denuncia` (
  `ID` int(11) NOT NULL,
  `IDMedia` int(11) NOT NULL,
  `motivo` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Hashtag`
--

CREATE TABLE `Hashtag` (
  `ID` int(11) NOT NULL,
  `Comentario` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Mascota`
--

CREATE TABLE `Mascota` (
  `ID` int(11) NOT NULL,
  `Amo` int(11) NOT NULL,
  `Tipo` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Raza` varchar(20) NOT NULL,
  `URLFoto` varchar(30) DEFAULT NULL,
  `Bio` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Media`
--

CREATE TABLE `Media` (
  `ID` int(11) NOT NULL,
  `Mascota` int(11) NOT NULL,
  `Tipo` int(11) NOT NULL,
  `URLImagen` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Notificaciones`
--

CREATE TABLE `Notificaciones` (
  `ID` int(11) NOT NULL,
  `IDReceptor` int(11) NOT NULL,
  `IDEmisor` int(11) NOT NULL,
  `Tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Rol`
--

CREATE TABLE `Rol` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Rol`
--

INSERT INTO `Rol` (`ID`, `Nombre`) VALUES
(1, 'Dueño'),
(2, 'Comercio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tipo_Mascota`
--

CREATE TABLE `Tipo_Mascota` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `URLIcono` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tipo_media`
--

CREATE TABLE `Tipo_media` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tipo_Notificacion`
--

CREATE TABLE `Tipo_Notificacion` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE `Usuario` (
  `ID` int(11) NOT NULL,
  `Rol` int(11) NOT NULL,
  `Nickname` varchar(10) NOT NULL,
  `NombreCompleto` varchar(30) DEFAULT NULL,
  `Email` varchar(30) NOT NULL,
  `Clave` varchar(50) NOT NULL,
  `URLFoto` varchar(50) DEFAULT NULL,
  `Bio` varchar(300) DEFAULT NULL,
  `Bloqueado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`ID`, `Rol`, `Nickname`, `NombreCompleto`, `Email`, `Clave`, `URLFoto`, `Bio`, `Bloqueado`) VALUES
(14, 1, 'a', 'aa', 'asd@ad.cas', '$2y$10$lX796irJn7xQbQED.uHsc.LSHMOW2.IFH1mr/2v6eGY', '', NULL, 0),
(16, 1, 'Mirilopsi', 'Miriam LÃ³pez Sierra', 'mirilopsi@email.com', '$2y$10$6oAczs.Uz/rHPLo1fNkBuOFAKfjuui17.GoJQZFJe6R', 'doge-pixilart.png', NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios_comercio`
--

CREATE TABLE `Usuarios_comercio` (
  `IDUsuario` int(11) NOT NULL,
  `IDComercio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Woofs`
--

CREATE TABLE `Woofs` (
  `IDUsuario` int(11) NOT NULL,
  `IDMedia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Amigos`
--
ALTER TABLE `Amigos`
  ADD PRIMARY KEY (`IDSeguidor`,`IDSeguido`),
  ADD KEY `FK_Amigos_seguido` (`IDSeguido`);

--
-- Indices de la tabla `Comentario`
--
ALTER TABLE `Comentario`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_Comentario_usuario` (`IDUsuario`),
  ADD KEY `FK_Comentario_media` (`IDMedia`);

--
-- Indices de la tabla `Comercio`
--
ALTER TABLE `Comercio`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `Denuncia`
--
ALTER TABLE `Denuncia`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_Denundia_media` (`IDMedia`);

--
-- Indices de la tabla `Hashtag`
--
ALTER TABLE `Hashtag`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_Hashtag_comentario` (`Comentario`);

--
-- Indices de la tabla `Mascota`
--
ALTER TABLE `Mascota`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_Mascota_amo` (`Amo`),
  ADD KEY `FK_Mascota_tipo` (`Tipo`);

--
-- Indices de la tabla `Media`
--
ALTER TABLE `Media`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_Media_mascota` (`Mascota`),
  ADD KEY `FK_Media_tipo` (`Tipo`);

--
-- Indices de la tabla `Notificaciones`
--
ALTER TABLE `Notificaciones`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_Notificaciones_Receptor` (`IDReceptor`),
  ADD KEY `FK_Notificaciones_Emisor` (`IDEmisor`),
  ADD KEY `FK_Notificaciones_tipo` (`Tipo`);

--
-- Indices de la tabla `Rol`
--
ALTER TABLE `Rol`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `Tipo_Mascota`
--
ALTER TABLE `Tipo_Mascota`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `Tipo_media`
--
ALTER TABLE `Tipo_media`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `Tipo_Notificacion`
--
ALTER TABLE `Tipo_Notificacion`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_Usuarios_rol` (`Rol`);

--
-- Indices de la tabla `Usuarios_comercio`
--
ALTER TABLE `Usuarios_comercio`
  ADD PRIMARY KEY (`IDUsuario`,`IDComercio`),
  ADD KEY `FK_UsuComercio_comercio` (`IDComercio`);

--
-- Indices de la tabla `Woofs`
--
ALTER TABLE `Woofs`
  ADD PRIMARY KEY (`IDUsuario`,`IDMedia`),
  ADD KEY `FK_Woofs_media` (`IDMedia`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Comentario`
--
ALTER TABLE `Comentario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Comercio`
--
ALTER TABLE `Comercio`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Denuncia`
--
ALTER TABLE `Denuncia`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Hashtag`
--
ALTER TABLE `Hashtag`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Mascota`
--
ALTER TABLE `Mascota`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Media`
--
ALTER TABLE `Media`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Notificaciones`
--
ALTER TABLE `Notificaciones`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Rol`
--
ALTER TABLE `Rol`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `Tipo_Mascota`
--
ALTER TABLE `Tipo_Mascota`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Tipo_media`
--
ALTER TABLE `Tipo_media`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Tipo_Notificacion`
--
ALTER TABLE `Tipo_Notificacion`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Amigos`
--
ALTER TABLE `Amigos`
  ADD CONSTRAINT `FK_Amigos_seguido` FOREIGN KEY (`IDSeguido`) REFERENCES `Usuario` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Amigos_seguidor` FOREIGN KEY (`IDSeguidor`) REFERENCES `Mascota` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Comentario`
--
ALTER TABLE `Comentario`
  ADD CONSTRAINT `FK_Comentario_media` FOREIGN KEY (`IDMedia`) REFERENCES `Media` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Comentario_usuario` FOREIGN KEY (`IDUsuario`) REFERENCES `Usuario` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Denuncia`
--
ALTER TABLE `Denuncia`
  ADD CONSTRAINT `FK_Denundia_media` FOREIGN KEY (`IDMedia`) REFERENCES `Media` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Hashtag`
--
ALTER TABLE `Hashtag`
  ADD CONSTRAINT `FK_Hashtag_comentario` FOREIGN KEY (`Comentario`) REFERENCES `Comentario` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Mascota`
--
ALTER TABLE `Mascota`
  ADD CONSTRAINT `FK_Mascota_amo` FOREIGN KEY (`Amo`) REFERENCES `Usuario` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Mascota_tipo` FOREIGN KEY (`Tipo`) REFERENCES `Tipo_Mascota` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Media`
--
ALTER TABLE `Media`
  ADD CONSTRAINT `FK_Media_mascota` FOREIGN KEY (`Mascota`) REFERENCES `Mascota` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Media_tipo` FOREIGN KEY (`Tipo`) REFERENCES `Tipo_media` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Notificaciones`
--
ALTER TABLE `Notificaciones`
  ADD CONSTRAINT `FK_Notificaciones_Emisor` FOREIGN KEY (`IDEmisor`) REFERENCES `Usuario` (`ID`),
  ADD CONSTRAINT `FK_Notificaciones_Receptor` FOREIGN KEY (`IDReceptor`) REFERENCES `Usuario` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Notificaciones_tipo` FOREIGN KEY (`Tipo`) REFERENCES `Tipo_Notificacion` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD CONSTRAINT `FK_Usuarios_rol` FOREIGN KEY (`Rol`) REFERENCES `Rol` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Usuarios_comercio`
--
ALTER TABLE `Usuarios_comercio`
  ADD CONSTRAINT `FK_UsuComercio_comercio` FOREIGN KEY (`IDComercio`) REFERENCES `Comercio` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_UsuComercio_usuario` FOREIGN KEY (`IDUsuario`) REFERENCES `Usuario` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Woofs`
--
ALTER TABLE `Woofs`
  ADD CONSTRAINT `FK_Woofs_media` FOREIGN KEY (`IDMedia`) REFERENCES `Media` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Woofs_usuario` FOREIGN KEY (`IDUsuario`) REFERENCES `Usuario` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

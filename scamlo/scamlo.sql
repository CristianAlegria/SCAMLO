-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-12-2016 a las 08:40:11
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `scamlo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion_solicitud`
--

CREATE TABLE IF NOT EXISTS `asignacion_solicitud` (
  `asignacion_id` int(11) NOT NULL,
  `solicitud_id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha_hora_inicio` datetime NOT NULL,
  `fecha_hora_fin` datetime DEFAULT NULL,
  `equipo_reparado` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `numero_inventario` int(11) DEFAULT NULL,
  `observaciones` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `asignacion_solicitud`
--

INSERT INTO `asignacion_solicitud` (`asignacion_id`, `solicitud_id`, `estado_id`, `usuario_id`, `fecha_hora_inicio`, `fecha_hora_fin`, `equipo_reparado`, `numero_inventario`, `observaciones`) VALUES
(2, 14, 1, 57, '2016-12-19 02:33:30', '2016-12-19 02:35:22', 'Mesa', 787878, 'la Pinte'),
(4, 19, 1, 57, '2016-12-19 00:47:27', '2016-12-19 01:41:07', 'Computador', 123456789, 'ya termine, un poco tardanza por el material que hacia falta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependencia`
--

CREATE TABLE IF NOT EXISTS `dependencia` (
  `id` int(11) NOT NULL,
  `nombre_dependencia` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `dependencia`
--

INSERT INTO `dependencia` (`id`, `nombre_dependencia`) VALUES
(2, 'Bienestar'),
(3, 'Biblioteca'),
(4, 'Extension');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edificio`
--

CREATE TABLE IF NOT EXISTS `edificio` (
  `edificio_id` int(11) NOT NULL,
  `nombre_edificio` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `ubicacion` varchar(80) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Universidad del valle - sede yumbo'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `edificio`
--

INSERT INTO `edificio` (`edificio_id`, `nombre_edificio`, `ubicacion`) VALUES
(0, 'No definido', 'Universidad del valle - sede yumbo'),
(2, 'Nuevo', 'Al lado del antiguo'),
(3, 'Martin Elias', 'Edificio nuevo'),
(4, 'dfdfdfdf', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `espacio`
--

CREATE TABLE IF NOT EXISTS `espacio` (
  `espacio_id` int(11) NOT NULL,
  `nombre` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `codigo` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `capacidad` int(11) NOT NULL,
  `ubicacion` varchar(255) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Universidad del valle - sede yumbo',
  `edificio_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `espacio`
--

INSERT INTO `espacio` (`espacio_id`, `nombre`, `codigo`, `capacidad`, `ubicacion`, `edificio_id`) VALUES
(0, 'Otros', '0', 0, 'Universidad del valle - sede yumbo', 0),
(1, 'Auditorio', '1', 100, 'Al frente de la entrada principal', 2),
(2, 'Aula de clases', '2', 60, '', 2),
(3, 'Auditorio', '300', 100, '', 3),
(4, 'Aula de clases', '301', 40, '', 3),
(5, 'Aula de clases', '302', 40, '', 3),
(6, 'Auditorio', '709', 300, '', 3),
(7, 'Biblioteca', '307', 50, '', 3),
(8, 'Auditorio', '901', 900, '', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE IF NOT EXISTS `estado` (
  `id` int(11) NOT NULL,
  `nombre` varchar(48) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id`, `nombre`) VALUES
(1, 'Solucionado'),
(2, 'Pendiente'),
(3, 'No Realizado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` smallint(6) NOT NULL,
  `role_name` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `role_value` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`id`, `role_name`, `role_value`) VALUES
(1, 'Administrador', 40),
(2, 'Administrativo', 30),
(3, 'MantenimientoLogistica', 20),
(4, 'Usuario', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE IF NOT EXISTS `servicio` (
  `id` int(11) NOT NULL,
  `nombre_servicio` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id`, `nombre_servicio`) VALUES
(2, 'Traslados'),
(3, 'Logistica'),
(4, 'Mantenimiento'),
(5, 'ggggg'),
(6, 'erererer');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE IF NOT EXISTS `solicitud` (
  `id` int(11) NOT NULL,
  `dependencia_id` int(11) NOT NULL,
  `servicio_id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `espacio_id` int(11) NOT NULL,
  `descripcion_otros` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `numero_piso` int(11) NOT NULL,
  `fecha` varchar(48) COLLATE utf8_spanish_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL DEFAULT '2',
  `descripcion_estado` varchar(255) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Tu solicitud ha sido enviada y actualmente se encuentra a la espera de ser procesada'
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `solicitud`
--

INSERT INTO `solicitud` (`id`, `dependencia_id`, `servicio_id`, `description`, `espacio_id`, `descripcion_otros`, `numero_piso`, `fecha`, `user_id`, `estado_id`, `descripcion_estado`) VALUES
(14, 4, 2, 'Cambiar Mesa', 1, '', 2, '2016-11-21', 1, 2, 'Tu solicitud ha sido enviada y actualmente se encuentra a la espera de ser procesada'),
(15, 3, 4, 'Reparacion mesas', 7, '', 3, '2016-11-22', 1, 2, 'Tu solicitud ha sido enviada y actualmente se encuentra a la espera de ser procesada'),
(16, 2, 4, 'Ventilador Dañado', 1, '', 1, '2016-11-23', 1, 1, 'Tu solicitud ha sido enviada y actualmente se encuentra a la espera de ser procesada'),
(18, 3, 3, 'Dos computadores Y un televisor', 7, '', 3, '2016-11-24', 1, 2, 'Tu solicitud ha sido enviada y actualmente se encuentra a la espera de ser procesada'),
(19, 2, 3, 'Necesito audio bafles grandes', 1, '', 2, '2016-12-19', 54, 2, 'Tu solicitud ha sido enviada y actualmente se encuentra a la espera de ser procesada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` smallint(6) NOT NULL,
  `status_name` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `status_value` smallint(6) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `status`
--

INSERT INTO `status` (`id`, `status_name`, `status_value`) VALUES
(1, 'Activo', 10),
(2, 'Inactivo', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_espacio`
--

CREATE TABLE IF NOT EXISTS `tipo_espacio` (
  `tipo_espacio_id` int(11) NOT NULL,
  `nombre_tipo` varchar(80) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_espacio`
--

INSERT INTO `tipo_espacio` (`tipo_espacio_id`, `nombre_tipo`) VALUES
(1, 'Auditorio'),
(2, 'Aula de clases'),
(3, 'Biblioteca');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `nombre_completo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `cedula` varchar(35) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(32) COLLATE utf8_spanish_ci DEFAULT NULL,
  `auth_key` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `role_id` smallint(6) NOT NULL DEFAULT '10',
  `status_id` smallint(6) NOT NULL DEFAULT '10',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `nombre_completo`, `cedula`, `telefono`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `role_id`, `status_id`, `created_at`, `updated_at`) VALUES
(1, 'Carlos Arango', '123456', '4447272', 'ZxDnEj6KZD2-1ZFnnc11_b-VKwGQGafM', '$2y$13$gZqgY3crxvoQJKQYYQ7xq./YdPhnIS3cl159QbeklP4ittHn3WJ1G', NULL, 'carlos.f.arango@prueba.com', 40, 10, '2016-05-20 22:10:29', '2016-05-20 22:10:29'),
(54, 'Jose Lopez Marin', '12121212', '8888888888', 'U8_vNtoprqOVFblmnVIEaMTsqqZxFetI', '$2y$13$ocsl2OzR9ZjgO43.28ZEsORSX76NxBPJlaSYxURrEcgPO.gfncT4G', NULL, 'jose@hotmail.com', 30, 10, '2016-10-10 20:51:29', '2016-12-17 21:37:38'),
(55, 'Yovaldino Ipia', '789', '1234567', 'fHhf-UhwOULeOa_m6Q-Bl6IltxMJ7eu_', '$2y$13$37YDh4hqij9m8tIXj0YB2.i6fJjBuyv1YT8Hsyu5fKGiwNWlH/7f6', NULL, 'joval@hotmail.com', 20, 10, '2016-11-24 16:11:34', '2016-12-19 02:23:52'),
(57, 'Pablo', '456', '9999999', 'Vj2c068yap_5TDpPwGJSivplm0G92nQF', '$2y$13$6FiRGJj7pJAe3r3nDRZ.BO3TfFCRdFOumyMTWJarXGjP3r6s8uGvm', NULL, 'pablo@hotmail.com', 20, 10, '2016-12-19 00:47:21', '2016-12-19 02:24:51');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignacion_solicitud`
--
ALTER TABLE `asignacion_solicitud`
  ADD PRIMARY KEY (`asignacion_id`), ADD KEY `fk_asignacion_solicitud_solicitud` (`solicitud_id`), ADD KEY `fk_asignacion_solicitud_usuario` (`usuario_id`), ADD KEY `fk_asignacion_solicitud_estado` (`estado_id`);

--
-- Indices de la tabla `dependencia`
--
ALTER TABLE `dependencia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `edificio`
--
ALTER TABLE `edificio`
  ADD PRIMARY KEY (`edificio_id`);

--
-- Indices de la tabla `espacio`
--
ALTER TABLE `espacio`
  ADD PRIMARY KEY (`espacio_id`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`), ADD KEY `estado_id` (`estado_id`), ADD KEY `espacio_id` (`espacio_id`), ADD KEY `servicio_id` (`servicio_id`), ADD KEY `dependencia_id` (`dependencia_id`);

--
-- Indices de la tabla `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_espacio`
--
ALTER TABLE `tipo_espacio`
  ADD PRIMARY KEY (`tipo_espacio_id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignacion_solicitud`
--
ALTER TABLE `asignacion_solicitud`
  MODIFY `asignacion_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `dependencia`
--
ALTER TABLE `dependencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `edificio`
--
ALTER TABLE `edificio`
  MODIFY `edificio_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `espacio`
--
ALTER TABLE `espacio`
  MODIFY `espacio_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `status`
--
ALTER TABLE `status`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tipo_espacio`
--
ALTER TABLE `tipo_espacio`
  MODIFY `tipo_espacio_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=58;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignacion_solicitud`
--
ALTER TABLE `asignacion_solicitud`
ADD CONSTRAINT `fk_asignacion_solicitud_estado` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id`),
ADD CONSTRAINT `fk_asignacion_solicitud_solicitud` FOREIGN KEY (`solicitud_id`) REFERENCES `solicitud` (`id`),
ADD CONSTRAINT `fk_asignacion_solicitud_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
ADD CONSTRAINT `fk_espacior_id` FOREIGN KEY (`espacio_id`) REFERENCES `espacio` (`espacio_id`),
ADD CONSTRAINT `fk_estado_id` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id`),
ADD CONSTRAINT `fk_servicio_id` FOREIGN KEY (`servicio_id`) REFERENCES `servicio` (`id`),
ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
ADD CONSTRAINT `solicitud_ibfk_1` FOREIGN KEY (`dependencia_id`) REFERENCES `dependencia` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

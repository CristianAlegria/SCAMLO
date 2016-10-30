-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-10-2016 a las 06:32:56
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id`, `nombre_servicio`) VALUES
(2, 'Traslado'),
(3, 'Logistica'),
(4, 'Mantenimiento');

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
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `nombre_completo`, `cedula`, `telefono`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `role_id`, `status_id`, `created_at`, `updated_at`) VALUES
(1, 'Carlos Arango', '123456', '4447272', 'ZxDnEj6KZD2-1ZFnnc11_b-VKwGQGafM', '$2y$13$gZqgY3crxvoQJKQYYQ7xq./YdPhnIS3cl159QbeklP4ittHn3WJ1G', NULL, 'carlos.f.arango@prueba.com', 40, 10, '2016-05-20 22:10:29', '2016-05-20 22:10:29'),
(54, 'Jose Lopez', '12121212', '8888888888', 'U8_vNtoprqOVFblmnVIEaMTsqqZxFetI', '$2y$13$y/a9tLn8vwieV7C4.CksIu/MRw1TYQ8KxW2c2jsfWaK.WqM7XTuvm', NULL, 'jose@hotmail.com', 40, 10, '2016-10-10 20:51:29', '2016-10-10 20:51:29'),
(55, 'Pedro Coral', '111111111', '111111111', '1nNDW93KLuKgIJCM4fnKvVDl-8D7xY7T', '$2y$13$usj/Rj4EoiIhKauqbHOBKOKtyt8KiFoeIosgVyEAmvn0COEpGnV/y', NULL, 'pedro@hotmail.com', 40, 10, '2016-10-10 20:51:54', '2016-10-10 20:51:54'),
(56, 'Cecilia Torrez', '222222222', '222222222', 'WgrgbiE85kwdGFEwH3U3_9_hS-Vx_Wqx', '$2y$13$pGTJBkXKsxKO6QBsvOPgMeiq1sfLqIyxzKNkHWv4AvijSQEkEJfi.', NULL, 'cecilia@hotmail.com', 40, 10, '2016-10-10 20:51:54', '2016-10-10 20:51:54'),
(57, 'Freddy Garcia', '333333333', '333333333', 'RSk-lOpQKOBONtC08JOzqUmDlWN2dt2J', '$2y$13$ix7xhWHDGamcy7RwX7CWju7aWzPN4hGsJJ1XjtUVdK/wIly8kzuPa', NULL, 'freddy@hotmail.com', 40, 10, '2016-10-10 20:51:55', '2016-10-10 20:51:55'),
(58, 'Milena Perez', '444444444', '444444444', 'v8VQNzdP98hEt9pC4GkMplTRyhtP8Pf3', '$2y$13$XRSFiAlP5W1rrqGST7djJulU4xhBwbbfp.CsrQJErF2L.H9SdVkOS', NULL, 'milena@hotmail.com', 40, 10, '2016-10-10 20:51:55', '2016-10-10 20:51:55');

--
-- Índices para tablas volcadas
--

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
-- Indices de la tabla `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `status`
--
ALTER TABLE `status`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=59;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

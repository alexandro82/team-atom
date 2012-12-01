-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 01-12-2012 a las 17:57:27
-- Versión del servidor: 5.5.28-log
-- Versión de PHP: 5.4.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `atom`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `indicador`
--

CREATE TABLE IF NOT EXISTS `indicador` (
  `id` int(11) NOT NULL,
  `indicador_descripcion` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `indicador_tipo` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `indicador_estado` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `indice`
--

CREATE TABLE IF NOT EXISTS `indice` (
  `id` int(11) NOT NULL,
  `indice_gestion` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `indice_valor` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `municipio_id` int(11) NOT NULL,
  `indicador_id` int(11) NOT NULL,
  `indice_estado` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_indice_municipio_idx` (`municipio_id`),
  KEY `fk_indice_indicador1_idx` (`indicador_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE IF NOT EXISTS `municipio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `municipio_nombre` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `municipio_departamento` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `municipio_longitud` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `municipio_latitud` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `municipio_categoria` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `municipio_codigo_ine` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `municipio_codigo_ine_anterior` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `municipio_codigo_economia_finanzas` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `municipio_estado` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`id`, `municipio_nombre`, `municipio_departamento`, `municipio_longitud`, `municipio_latitud`, `municipio_categoria`, `municipio_codigo_ine`, `municipio_codigo_ine_anterior`, `municipio_codigo_economia_finanzas`, `municipio_estado`) VALUES
(1, 'La Paz', 'La Paz', '-68.113434', '-16.494007', '1', '1', '', '', '1'),
(2, 'Oruro', 'Oruro', '-67.109558', '-17.976095', '1', '1', '', '', '1'),
(3, 'Potosí', 'Potosí', '-65.745194', '-19.590172', '1', '1', '', '', '1'),
(4, 'Sucre', 'Chuquisaca', '-65.263169', '-19.032886', '1', '1', '', '', '1'),
(5, 'Tarija', 'Tarija', '-64.717972', '-21.548235', '1', '1', '', '', '1'),
(6, 'Cochabamba', 'Cochabamba', '-66.153748', '-17.384691', '1', '1', '', '', '1'),
(7, 'Santa Cruz de la Sierra', 'Santa Cruz', '-63.180573', '-17.789202', '1', '1', '', '', '1'),
(8, 'Trinidad', 'Beni', '-64.904740', '-14.833608', '1', '1', '', '', '1'),
(9, 'Cobija', 'Pando', '-68.759224', '-11.017336', '1', '1', '', '', '1');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `indice`
--
ALTER TABLE `indice`
  ADD CONSTRAINT `fk_indice_municipio` FOREIGN KEY (`municipio_id`) REFERENCES `municipio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_indice_indicador1` FOREIGN KEY (`indicador_id`) REFERENCES `indicador` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

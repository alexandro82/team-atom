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
  `indicador_descripcion` varchar(150) DEFAULT NULL,
  `indicador_tipo` varchar(45) DEFAULT NULL,
  `indicador_estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `indicador`
--

INSERT INTO `indicador` (`id`, `indicador_descripcion`, `indicador_tipo`, `indicador_estado`) VALUES
(1, 'EJECUCIÓN DE RECURSOS', 'SUBINDICE', 'ACTIVO'),
(2, 'EJECUCION DEL GASTO', 'SUBINDICE', 'ACTIVO'),
(3, 'EFICIENCIA EN LA EJECUCIÓN DE RECURSOS Y GASTOS', 'INDICADOR', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `indice`
--

CREATE TABLE IF NOT EXISTS `indice` (
  `id` int(11) NOT NULL,
  `indice_gestion` int(4) DEFAULT NULL,
  `indice_valor` double DEFAULT NULL,
  `municipio_id` int(11) NOT NULL,
  `indicador_id` int(11) NOT NULL,
  `indice_estado` varchar(45) DEFAULT NULL,
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

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `indice`
--
ALTER TABLE `indice`
  ADD CONSTRAINT `fk_indice_municipio` FOREIGN KEY (`municipio_id`) REFERENCES `municipio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_indice_indicador1` FOREIGN KEY (`indicador_id`) REFERENCES `indicador` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

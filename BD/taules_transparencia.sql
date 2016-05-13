-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 06-05-2016 a las 12:46:00
-- Versión del servidor: 5.5.38-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `Transparencia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ambit`
--

CREATE TABLE IF NOT EXISTS `ambit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_ambit` int(11) NOT NULL,
  `nom` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=7 ;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avisos`
--

CREATE TABLE IF NOT EXISTS `avisos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuari` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `assumpte` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `correu` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `data` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `vist` int(11) NOT NULL,
  `tipus` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estat`
--

CREATE TABLE IF NOT EXISTS `estat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `descripcio` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `estat`
--

INSERT INTO `estat` (`id`, `nom`, `descripcio`) VALUES
(1, 'En procés', 'Ítem en procés d''omplir.'),
(2, 'Finalitzat', 'Ítem acabat i publicat.'),
(3, 'Sense començar', 'Ítem sense mirar.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_actualitzacions`
--

CREATE TABLE IF NOT EXISTS `historial_actualitzacions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `id_usuari` int(11) NOT NULL,
  `id_ens` int(11) NOT NULL,
  `id_ambit` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ambit` int(11) NOT NULL,
  `prioritat` varchar(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `generacio_contingut` varchar(6) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ltcat` varchar(2) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `enllas_directe` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `persona_contacte` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `observacions` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estat` int(11) NOT NULL,
  `publicat` int(11) NOT NULL,
  `descripcio` varchar(1700) NOT NULL,
  `actiu` int(11) NOT NULL,
  `darrera_actualitzacio` varchar(10) NOT NULL,
  `data_revisio` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=138 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item_patronat`
--

CREATE TABLE IF NOT EXISTS `item_patronat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ambit` int(11) NOT NULL,
  `prioritat` varchar(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `generacio_contingut` varchar(6) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ltcat` varchar(2) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `enllas_directe` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `persona_contacte` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `observacions` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estat` int(11) NOT NULL,
  `publicat` int(11) NOT NULL,
  `actiu` int(11) NOT NULL,
  `descripcio` varchar(1700) COLLATE utf8_unicode_ci NOT NULL,
  `darrera_actualitzacio` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `data_revisio` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=138 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item_saburba`
--

CREATE TABLE IF NOT EXISTS `item_saburba` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ambit` int(11) NOT NULL,
  `prioritat` varchar(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `generacio_contingut` varchar(6) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ltcat` varchar(2) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `enllas_directe` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `persona_contacte` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `observacions` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estat` int(11) NOT NULL,
  `publicat` int(11) NOT NULL,
  `actiu` int(11) NOT NULL,
  `descripcio` varchar(1700) COLLATE utf8_unicode_ci NOT NULL,
  `darrera_actualitzacio` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `data_revisio` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=138 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observacions_generals`
--

CREATE TABLE IF NOT EXISTS `observacions_generals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contingut` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `ens` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `observacions_generals`
--

INSERT INTO `observacions_generals` (`id`, `contingut`, `ens`) VALUES
(1, '', 'Ajuntament'),
(2, '', 'Patronat'),
(3, '', 'Saburbà');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE IF NOT EXISTS `permisos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_permis` int(11) NOT NULL,
  `nom` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `id_permis`, `nom`) VALUES
(1, 99, 'Administrador'),
(2, 95, 'Editor'),
(3, 1, 'Visitant');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuaris`
--

CREATE TABLE IF NOT EXISTS `usuaris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuari` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `permisos` int(11) NOT NULL,
  `correu` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `usuaris`
--

INSERT INTO `usuaris` (`id`, `usuari`, `password`, `permisos`, `correu`) VALUES
(1, 'administrador', '827ccb0eea8a706c4c34a16891f84e7b', 99, 'adminz@es.cat'),

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

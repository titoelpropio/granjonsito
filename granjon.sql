-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-02-2017 a las 23:08:33
-- Versión del servidor: 5.6.27-log
-- Versión de PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `granjon`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alimento`
--

CREATE TABLE `alimento` (
  `id` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `tipo` varchar(15) DEFAULT NULL,
  `tipo_gallina` tinyint(4) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alimento`
--

INSERT INTO `alimento` (`id`, `nombre`, `tipo`, `tipo_gallina`, `estado`, `deleted_at`) VALUES
(1, 'BALANCEADO', 'PRE', 0, 1, NULL),
(2, 'BALANCEADO', 'J1', 0, 1, NULL),
(3, 'BALANCEADO', 'J2', 0, 1, NULL),
(4, 'BALANCEADO', 'J3', 2, 1, NULL),
(5, 'BALANCEADO', 'G4', 1, 1, NULL),
(6, 'BALANCEADO', 'G5', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `id` int(11) NOT NULL,
  `cantidad_caja` int(11) DEFAULT NULL,
  `cantidad_maple` int(11) DEFAULT NULL,
  `cantidad_huevo` int(11) DEFAULT NULL,
  `id_tipo_caja` int(11) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`id`, `cantidad_caja`, `cantidad_maple`, `cantidad_huevo`, `id_tipo_caja`, `fecha`, `deleted_at`) VALUES
(10, 2, 20, 400, 1, '2017-02-16 23:38:34', NULL),
(11, 3, 30, 600, 2, '2017-02-16 23:38:37', NULL),
(12, 4, 48, 1440, 3, '2017-02-19 04:00:00', NULL),
(13, 6, 72, 2160, 4, '2017-02-19 18:30:20', NULL);

--
-- Disparadores `caja`
--
DELIMITER $$
CREATE TRIGGER `actualizar_caja_deposito` AFTER UPDATE ON `caja` FOR EACH ROW BEGIN
DECLARE cajas integer;
DECLARE maples integer;
DECLARE huevos integer;
SET cajas = NEW.cantidad_caja - OLD.cantidad_caja;
SET maples = NEW.cantidad_maple - OLD.cantidad_maple;
SET huevos = NEW.cantidad_huevo - OLD.cantidad_huevo;

       UPDATE caja_deposito SET caja_deposito.cantidad_caja = caja_deposito.cantidad_caja + cajas
       WHERE caja_deposito.id_tipo_caja = NEW.id_tipo_caja; 
       UPDATE caja_deposito SET caja_deposito.cantidad_maple = caja_deposito.cantidad_maple + maples
       WHERE caja_deposito.id_tipo_caja = NEW.id_tipo_caja;  
       UPDATE huevo_acumulado SET huevo_acumulado.cantidad = huevo_acumulado.cantidad - huevos;       
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `registrar_caja_deposito` AFTER INSERT ON `caja` FOR EACH ROW BEGIN

IF EXISTS(SELECT * from caja_deposito WHERE id_tipo_caja=NEW.id_tipo_caja )THEN 
       UPDATE caja_deposito SET caja_deposito.cantidad_caja = caja_deposito.cantidad_caja + NEW.cantidad_caja
       WHERE caja_deposito.id_tipo_caja = NEW.id_tipo_caja; 
       UPDATE caja_deposito SET caja_deposito.cantidad_maple = caja_deposito.cantidad_maple + NEW.cantidad_maple
       WHERE caja_deposito.id_tipo_caja = NEW.id_tipo_caja;  
       UPDATE huevo_acumulado SET huevo_acumulado.cantidad = huevo_acumulado.cantidad - NEW.cantidad_huevo;
ELSE
 INSERT INTO caja_deposito SET caja_deposito.cantidad_caja=NEW.cantidad_caja, caja_deposito.cantidad_maple=NEW.cantidad_maple, caja_deposito.id_tipo_caja=NEW.id_tipo_caja;
       UPDATE huevo_acumulado SET huevo_acumulado.cantidad = huevo_acumulado.cantidad - NEW.cantidad_huevo;
END IF; 

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_deposito`
--

CREATE TABLE `caja_deposito` (
  `id` int(11) NOT NULL,
  `cantidad_caja` int(11) DEFAULT NULL,
  `cantidad_maple` int(11) NOT NULL,
  `id_tipo_caja` int(11) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `caja_deposito`
--

INSERT INTO `caja_deposito` (`id`, `cantidad_caja`, `cantidad_maple`, `id_tipo_caja`, `deleted_at`) VALUES
(8, 0, 0, 1, NULL),
(9, 0, 0, 2, NULL),
(10, 0, 0, 3, NULL),
(11, 0, 0, 4, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cantidad_maple`
--

CREATE TABLE `cantidad_maple` (
  `id` int(11) NOT NULL,
  `cantidad_maple` int(11) DEFAULT NULL,
  `id_tipo_caja` int(11) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `tipo` tinyint(4) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `tipo`, `deleted_at`) VALUES
(7, 'COMPRA DE GASOLINA', 0, NULL),
(8, 'COMPRA DE VACUNAS', 0, NULL),
(9, 'VENTA DE ABONO', 1, NULL),
(10, 'VENTA DE GALLINAS', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id` int(11) NOT NULL,
  `precio_compra` decimal(10,2) DEFAULT NULL,
  `cantidad_total` decimal(10,2) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_silo` int(11) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id`, `precio_compra`, `cantidad_total`, `fecha`, `id_silo`, `deleted_at`) VALUES
(3, '2000.00', '150.00', '2017-02-16 19:15:09', 7, NULL),
(4, '3600.50', '3000.00', '2017-02-16 20:30:45', 3, '2017-02-17'),
(5, '0.00', '-53310.00', '2017-02-20 17:42:48', 2, NULL),
(6, '0.00', '18000.00', '2017-02-20 17:43:09', 3, NULL);

--
-- Disparadores `compra`
--
DELIMITER $$
CREATE TRIGGER `actualizar_silo_compra` AFTER INSERT ON `compra` FOR EACH ROW UPDATE silo 
SET silo.cantidad=silo.cantidad+(NEW.cantidad_total) 
WHERE silo.id=new.id_silo
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `anular_compra` AFTER UPDATE ON `compra` FOR EACH ROW BEGIN
	UPDATE silo SET silo.cantidad = silo.cantidad - NEW.cantidad_total
    WHERE silo.id = NEW.id_silo;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consumo`
--

CREATE TABLE `consumo` (
  `id` int(11) NOT NULL,
  `cantidad` decimal(10,2) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_silo` int(11) NOT NULL,
  `id_fase_galpon` int(11) DEFAULT NULL,
  `id_control_alimento` int(11) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `consumo`
--

INSERT INTO `consumo` (`id`, `cantidad`, `fecha`, `id_silo`, `id_fase_galpon`, `id_control_alimento`, `deleted_at`) VALUES
(123, '690.00', '2017-02-17 00:00:56', 5, 57, 5, NULL),
(124, '690.00', '2017-02-17 19:25:45', 5, 57, 5, NULL),
(125, '500.00', '2017-02-15 20:57:36', 5, 57, 5, NULL),
(126, '1700.00', '2017-02-15 22:16:04', 5, 57, 5, NULL),
(127, '1000.00', '2017-01-20 19:03:08', 5, 59, 5, NULL),
(129, '690.00', '2017-02-22 21:08:01', 4, 59, 5, NULL);

--
-- Disparadores `consumo`
--
DELIMITER $$
CREATE TRIGGER `actualizar_consumo_grano` AFTER UPDATE ON `consumo` FOR EACH ROW BEGIN
    DECLARE cantidad_grano integer;
    SET cantidad_grano =  NEW.cantidad - OLD.cantidad; 
IF EXISTS(SELECT * from consumo WHERE consumo.id=NEW.id AND consumo.deleted_at IS NULL)THEN

    UPDATE silo SET silo.cantidad = silo.cantidad - cantidad_grano
    WHERE silo.id = NEW.id_silo;
ELSE
    UPDATE silo SET silo.cantidad = silo.cantidad + NEW.cantidad
    WHERE silo.id = NEW.id_silo;
END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `descontar_granos` AFTER INSERT ON `consumo` FOR EACH ROW UPDATE silo 
SET silo.cantidad=silo.cantidad-(NEW.cantidad) 
WHERE silo.id=new.id_silo
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consumo_emergente`
--

CREATE TABLE `consumo_emergente` (
  `id` int(11) NOT NULL,
  `id_edad` int(11) DEFAULT NULL,
  `id_vacuna` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `consumo_emergente`
--

INSERT INTO `consumo_emergente` (`id`, `id_edad`, `id_vacuna`, `cantidad`, `precio`, `estado`, `fecha`, `deleted_at`) VALUES
(1, 51, 2, 2, '14.40', 1, '2017-02-22 14:47:43', NULL),
(2, 53, 3, 4, '4.00', 1, '2017-02-21 14:47:43', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consumo_vacuna`
--

CREATE TABLE `consumo_vacuna` (
  `id` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  `id_control_vacuna` int(11) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `consumo_vacuna`
--

INSERT INTO `consumo_vacuna` (`id`, `cantidad`, `precio`, `estado`, `id_control_vacuna`, `fecha`, `deleted_at`) VALUES
(1, 2, '120.00', 1, 12, '2017-02-16 20:57:28', NULL),
(2, 3, '3.00', 1, 41, '2017-02-16 21:05:40', NULL),
(3, 3, '3.60', 1, 39, '2017-02-16 21:07:01', NULL),
(4, 2, '2.40', 1, 39, '2017-02-16 21:08:23', NULL),
(5, 2, '2.40', 1, 60, '2017-02-16 21:11:21', NULL),
(6, 3, '180.00', 1, 65, '2017-02-16 21:11:33', NULL),
(7, 5, '5.00', 1, 64, '2017-02-16 21:11:43', NULL),
(8, 3, '6.00', 1, 7, '2017-02-16 21:22:37', NULL),
(9, 2, '2.00', 1, 72, '2017-02-16 21:22:54', NULL),
(10, 3, '3.60', 1, 71, '2017-02-16 21:23:11', NULL),
(11, 1, '1.00', 1, 72, '2017-02-16 21:23:25', NULL),
(12, 4, '4.80', 1, 31, '2017-02-17 00:18:33', NULL),
(13, 1, '1.20', 1, 31, '2017-02-17 00:38:28', NULL),
(14, 3, '16.80', 1, 34, '2017-02-19 00:45:39', NULL),
(15, 2, '120.00', 1, 12, '2017-02-22 21:15:09', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_alimento`
--

CREATE TABLE `control_alimento` (
  `id` int(11) NOT NULL,
  `cantidad` decimal(10,4) DEFAULT NULL,
  `id_edad` int(11) NOT NULL,
  `id_temperatura` int(11) NOT NULL,
  `id_alimento` int(11) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `control_alimento`
--

INSERT INTO `control_alimento` (`id`, `cantidad`, `id_edad`, `id_temperatura`, `id_alimento`, `deleted_at`) VALUES
(5, '0.2300', 4, 3, 2, NULL),
(6, '0.1000', 5, 3, 5, NULL),
(7, '0.1500', 6, 3, 1, NULL),
(8, '0.2300', 7, 3, 3, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_vacuna`
--

CREATE TABLE `control_vacuna` (
  `id` int(11) NOT NULL,
  `id_edad` int(11) DEFAULT NULL,
  `id_vacuna` int(11) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `control_vacuna`
--

INSERT INTO `control_vacuna` (`id`, `id_edad`, `id_vacuna`, `estado`, `deleted_at`) VALUES
(7, 52, 3, 1, NULL),
(8, 52, 4, 1, NULL),
(9, 51, 3, 0, NULL),
(10, 51, 6, 1, NULL),
(12, 51, 9, 1, NULL),
(13, 52, 5, 1, NULL),
(14, 52, 7, 0, NULL),
(15, 52, 6, 1, NULL),
(16, 52, 8, 1, NULL),
(18, 52, 9, 1, NULL),
(19, 51, 4, 1, NULL),
(27, 53, 3, 0, NULL),
(28, 53, 4, 1, NULL),
(29, 53, 5, 1, NULL),
(30, 53, 6, 1, NULL),
(31, 53, 7, 1, NULL),
(32, 53, 8, 0, NULL),
(33, 53, 9, 0, NULL),
(34, 53, 10, 1, NULL),
(35, 54, 3, 1, NULL),
(36, 54, 4, 1, NULL),
(37, 54, 5, 1, NULL),
(38, 54, 6, 1, NULL),
(39, 54, 7, 1, NULL),
(40, 54, 8, 1, NULL),
(41, 54, 9, 1, NULL),
(42, 54, 10, 1, NULL),
(43, 55, 3, 1, NULL),
(44, 55, 4, 1, NULL),
(45, 55, 5, 1, NULL),
(46, 55, 6, 1, NULL),
(47, 55, 7, 0, NULL),
(48, 55, 8, 0, NULL),
(49, 55, 9, 1, NULL),
(50, 55, 10, 1, NULL),
(51, 56, 6, 1, NULL),
(52, 56, 7, 1, NULL),
(53, 56, 8, 1, NULL),
(54, 56, 9, 1, NULL),
(55, 56, 10, 1, NULL),
(56, 57, 3, 1, NULL),
(57, 57, 4, 1, NULL),
(58, 57, 5, 1, NULL),
(59, 57, 6, 1, NULL),
(60, 57, 7, 1, NULL),
(61, 57, 10, 1, NULL),
(62, 58, 4, 1, NULL),
(63, 58, 6, 1, NULL),
(64, 58, 8, 1, NULL),
(65, 58, 9, 1, NULL),
(66, 58, 10, 1, NULL),
(67, 59, 3, 1, NULL),
(68, 59, 4, 1, NULL),
(69, 59, 5, 1, NULL),
(70, 59, 6, 1, NULL),
(71, 59, 7, 1, NULL),
(72, 59, 8, 1, NULL),
(73, 59, 9, 0, NULL),
(74, 59, 10, 1, NULL),
(75, 58, 3, 1, NULL),
(76, 58, 11, 1, NULL),
(77, 53, 11, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id` int(11) NOT NULL,
  `id_tipo_caja` int(11) DEFAULT NULL,
  `id_venta_caja` int(11) DEFAULT NULL,
  `cantidad_caja` int(11) DEFAULT NULL,
  `subtotal_precio` decimal(10,2) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`id`, `id_tipo_caja`, `id_venta_caja`, `cantidad_caja`, `subtotal_precio`, `deleted_at`) VALUES
(13, 1, 13, 2, '172.40', NULL),
(14, 2, 13, 3, '246.00', NULL),
(15, 3, 13, 1, '143.64', NULL),
(16, 3, 14, 2, '287.28', NULL),
(17, 4, 14, 4, '525.60', NULL),
(18, 3, 15, 1, '143.64', NULL),
(19, 4, 15, 2, '262.80', NULL);

--
-- Disparadores `detalle_venta`
--
DELIMITER $$
CREATE TRIGGER `actualizar_cajas` AFTER INSERT ON `detalle_venta` FOR EACH ROW BEGIN
    DECLARE cantidad_maples integer;
    SELECT tipo_caja.cantidad_maple INTO cantidad_maples FROM tipo_caja,maple WHERE tipo_caja.id_maple=maple.id and tipo_caja.id=NEW.id_tipo_caja;
	UPDATE caja_deposito SET caja_deposito.cantidad_caja = caja_deposito.cantidad_caja - NEW.cantidad_caja
    WHERE caja_deposito.id_tipo_caja = NEW.id_tipo_caja;
   	UPDATE caja_deposito SET caja_deposito.cantidad_maple = caja_deposito.cantidad_maple - (NEW.cantidad_caja * cantidad_maples)
    WHERE caja_deposito.id_tipo_caja = NEW.id_tipo_caja;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `anular_venta` AFTER UPDATE ON `detalle_venta` FOR EACH ROW BEGIN
    DECLARE cantidad_maples integer;
    SELECT tipo_caja.cantidad_maple INTO cantidad_maples FROM tipo_caja,maple WHERE tipo_caja.id_maple=maple.id and tipo_caja.id=NEW.id_tipo_caja;
	UPDATE caja_deposito SET caja_deposito.cantidad_caja = caja_deposito.cantidad_caja + NEW.cantidad_caja
    WHERE caja_deposito.id_tipo_caja = NEW.id_tipo_caja;
   	UPDATE caja_deposito SET caja_deposito.cantidad_maple = caja_deposito.cantidad_maple + (NEW.cantidad_caja * cantidad_maples)
    WHERE caja_deposito.id_tipo_caja = NEW.id_tipo_caja;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta_huevo`
--

CREATE TABLE `detalle_venta_huevo` (
  `id` int(11) NOT NULL,
  `id_venta_huevo` int(11) DEFAULT NULL,
  `id_tipo_huevo` int(11) DEFAULT NULL,
  `cantidad_maple` int(11) DEFAULT NULL,
  `cantidad_huevo` int(11) NOT NULL,
  `subtotal_precio` decimal(10,2) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_venta_huevo`
--

INSERT INTO `detalle_venta_huevo` (`id`, `id_venta_huevo`, `id_tipo_huevo`, `cantidad_maple`, `cantidad_huevo`, `subtotal_precio`, `deleted_at`) VALUES
(2, 2, 1, 3, 60, '18.60', NULL),
(3, 2, 2, 2, 60, '15.00', NULL),
(4, 2, 3, 4, 120, '35.88', NULL),
(5, 3, 1, 2, 40, '12.40', NULL),
(6, 3, 2, 1, 30, '7.50', NULL),
(7, 4, 1, 1, 20, '6.20', NULL),
(8, 4, 2, 3, 90, '22.50', NULL),
(9, 4, 3, 2, 60, '17.94', NULL);

--
-- Disparadores `detalle_venta_huevo`
--
DELIMITER $$
CREATE TRIGGER `actualizar_maples` AFTER INSERT ON `detalle_venta_huevo` FOR EACH ROW BEGIN
	UPDATE huevo_deposito SET huevo_deposito.cantidad_maple = huevo_deposito.cantidad_maple - NEW.cantidad_maple
    WHERE huevo_deposito.id_tipo_huevo = NEW.id_tipo_huevo;
	UPDATE huevo_deposito SET huevo_deposito.cantidad_huevo = huevo_deposito.cantidad_huevo - NEW.cantidad_huevo
    WHERE huevo_deposito.id_tipo_huevo = NEW.id_tipo_huevo;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `anular_venta_huevo` AFTER UPDATE ON `detalle_venta_huevo` FOR EACH ROW BEGIN
	UPDATE huevo_deposito SET huevo_deposito.cantidad_maple = huevo_deposito.cantidad_maple + NEW.cantidad_maple
    WHERE huevo_deposito.id_tipo_huevo = NEW.id_tipo_huevo;
	UPDATE huevo_deposito SET huevo_deposito.cantidad_huevo = huevo_deposito.cantidad_huevo + NEW.cantidad_huevo
    WHERE huevo_deposito.id_tipo_huevo = NEW.id_tipo_huevo;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edad`
--

CREATE TABLE `edad` (
  `id` int(11) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_descarte` date DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `id_galpon` int(11) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `edad`
--

INSERT INTO `edad` (`id`, `fecha_inicio`, `fecha_descarte`, `estado`, `id_galpon`, `deleted_at`) VALUES
(51, '2016-09-28', NULL, 1, 48, NULL),
(52, '2017-02-17', NULL, 1, 50, NULL),
(53, '2016-09-01', NULL, 1, 49, NULL),
(54, '2016-09-27', NULL, 1, 52, NULL),
(55, '2016-10-01', NULL, 1, 55, NULL),
(56, '2016-09-30', NULL, 1, 56, NULL),
(57, '2016-10-02', NULL, 1, 60, NULL),
(58, '2016-10-01', NULL, 1, 63, NULL),
(59, '2016-12-01', NULL, 1, 58, NULL),
(60, '2017-02-01', NULL, 1, 62, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egreso_varios`
--

CREATE TABLE `egreso_varios` (
  `id` int(11) NOT NULL,
  `detalle` varchar(200) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `egreso_varios`
--

INSERT INTO `egreso_varios` (`id`, `detalle`, `precio`, `id_categoria`, `fecha`, `deleted_at`) VALUES
(4, 'COMPRA DE GASOLINA PARA LA CAMIONETA', '2000.00', 7, '2017-02-17', NULL),
(5, 'COMPRA DE LAS VACUNAS', '3500.60', 8, '2017-02-17', NULL),
(6, 'COMPRA DE VACUNAS', '5000.40', 8, '2017-02-17', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fases`
--

CREATE TABLE `fases` (
  `id` int(11) NOT NULL,
  `numero` int(11) DEFAULT NULL,
  `nombre` varchar(15) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fases`
--

INSERT INTO `fases` (`id`, `numero`, `nombre`, `deleted_at`) VALUES
(1, 1, 'FASE 1', NULL),
(2, 2, 'FASE 2', NULL),
(3, 3, 'FASE 3', NULL),
(4, 4, 'PONEDORA', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fases_galpon`
--

CREATE TABLE `fases_galpon` (
  `id` int(11) NOT NULL,
  `id_edad` int(11) DEFAULT NULL,
  `id_fase` int(11) DEFAULT NULL,
  `cantidad_inicial` int(11) DEFAULT NULL,
  `cantidad_actual` int(11) DEFAULT NULL,
  `total_muerta` int(11) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fases_galpon`
--

INSERT INTO `fases_galpon` (`id`, `id_edad`, `id_fase`, `cantidad_inicial`, `cantidad_actual`, `total_muerta`, `fecha_inicio`, `fecha_fin`, `deleted_at`) VALUES
(57, 51, 4, 3000, 2999, 1, '2016-09-28', NULL, NULL),
(58, 52, 1, 0, 2640, 7, '2017-02-17', NULL, NULL),
(59, 53, 4, 3000, 3000, 0, '2016-09-01', NULL, NULL),
(60, 54, 4, 2000, 2000, 0, '2016-09-27', NULL, NULL),
(61, 55, 4, 2500, 2500, 0, '2016-10-01', NULL, NULL),
(62, 56, 4, 2000, 2000, 0, '2016-09-30', NULL, NULL),
(63, 57, 4, 5320, 5320, 0, '2016-10-02', NULL, NULL),
(64, 58, 4, 2500, 2500, 0, '2016-10-01', NULL, NULL),
(65, 59, 3, 3000, 3000, 3000, '2016-12-01', NULL, NULL),
(66, 60, 2, 2500, 2500, 0, '2017-02-01', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galpon`
--

CREATE TABLE `galpon` (
  `id` int(11) NOT NULL,
  `numero` int(11) DEFAULT NULL,
  `capacidad_total` int(11) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `galpon`
--

INSERT INTO `galpon` (`id`, `numero`, `capacidad_total`, `deleted_at`) VALUES
(48, 1, 2032, NULL),
(49, 2, 2016, NULL),
(50, 3, 2032, NULL),
(51, 4, 2030, NULL),
(52, 5, 2048, NULL),
(53, 6, 2036, NULL),
(54, 7, 2392, NULL),
(55, 8, 2290, NULL),
(56, 9, 5000, NULL),
(57, 10, 3000, NULL),
(58, 11, 3600, NULL),
(59, 12, 3600, NULL),
(60, 13, 2500, NULL),
(61, 14, 3601, NULL),
(62, 15, 3601, NULL),
(63, 16, 6510, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galpon_vacuna`
--

CREATE TABLE `galpon_vacuna` (
  `id` int(11) NOT NULL,
  `id_vacuna` int(11) DEFAULT NULL,
  `id_edad` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `huevo`
--

CREATE TABLE `huevo` (
  `id` int(11) NOT NULL,
  `cantidad_maple` int(11) DEFAULT NULL,
  `cantidad_huevo` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_tipo_huevo` int(11) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `huevo`
--

INSERT INTO `huevo` (`id`, `cantidad_maple`, `cantidad_huevo`, `fecha`, `id_tipo_huevo`, `deleted_at`) VALUES
(6, 8, 160, '2017-02-19 18:59:27', 1, NULL),
(7, 7, 210, '2017-02-19 18:59:30', 2, NULL),
(8, 9, 270, '2017-02-19 18:59:35', 3, NULL),
(9, 10, 300, '2017-02-19 18:59:44', 4, NULL);

--
-- Disparadores `huevo`
--
DELIMITER $$
CREATE TRIGGER `actualizar_huevo_deposito` AFTER UPDATE ON `huevo` FOR EACH ROW BEGIN
DECLARE maples integer;
DECLARE huevos integer;
SET maples = NEW.cantidad_maple - OLD.cantidad_maple;
SET huevos = NEW.cantidad_huevo - OLD.cantidad_huevo;

       UPDATE huevo_deposito SET huevo_deposito.cantidad_maple = huevo_deposito.cantidad_maple + maples
       WHERE huevo_deposito.id_tipo_huevo = NEW.id_tipo_huevo; 
       UPDATE huevo_deposito SET huevo_deposito.cantidad_huevo = huevo_deposito.cantidad_huevo + huevos
       WHERE huevo_deposito.id_tipo_huevo = NEW.id_tipo_huevo;  
       UPDATE huevo_acumulado SET huevo_acumulado.cantidad = huevo_acumulado.cantidad - huevos;       
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `registrar_huevo_deposito` AFTER INSERT ON `huevo` FOR EACH ROW BEGIN
IF EXISTS(SELECT * from huevo_deposito WHERE id_tipo_huevo=NEW.id_tipo_huevo )THEN 
 UPDATE huevo_deposito SET huevo_deposito.cantidad_maple = huevo_deposito.cantidad_maple + NEW.cantidad_maple
 WHERE huevo_deposito.id_tipo_huevo = NEW.id_tipo_huevo; 
 
 UPDATE huevo_deposito SET huevo_deposito.cantidad_huevo = huevo_deposito.cantidad_huevo + NEW.cantidad_huevo
 WHERE huevo_deposito.id_tipo_huevo = NEW.id_tipo_huevo;  
 UPDATE huevo_acumulado SET huevo_acumulado.cantidad = huevo_acumulado.cantidad - NEW.cantidad_huevo;
ELSE
 INSERT INTO huevo_deposito SET huevo_deposito.cantidad_maple=NEW.cantidad_maple, huevo_deposito.cantidad_huevo=NEW.cantidad_huevo, huevo_deposito.id_tipo_huevo=NEW.id_tipo_huevo;
 UPDATE huevo_acumulado SET huevo_acumulado.cantidad = huevo_acumulado.cantidad - NEW.cantidad_huevo;
END IF; 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `huevo_acumulado`
--

CREATE TABLE `huevo_acumulado` (
  `id` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `huevo_acumulado`
--

INSERT INTO `huevo_acumulado` (`id`, `cantidad`, `deleted_at`) VALUES
(2, 100760, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `huevo_deposito`
--

CREATE TABLE `huevo_deposito` (
  `id` int(11) NOT NULL,
  `cantidad_maple` int(11) NOT NULL,
  `cantidad_huevo` int(11) DEFAULT NULL,
  `id_tipo_huevo` int(11) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `huevo_deposito`
--

INSERT INTO `huevo_deposito` (`id`, `cantidad_maple`, `cantidad_huevo`, `id_tipo_huevo`, `deleted_at`) VALUES
(5, 2, 40, 1, NULL),
(6, 1, 30, 2, NULL),
(7, 3, 90, 3, NULL),
(8, 10, 300, 4, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso_varios`
--

CREATE TABLE `ingreso_varios` (
  `id` int(11) NOT NULL,
  `detalle` varchar(200) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ingreso_varios`
--

INSERT INTO `ingreso_varios` (`id`, `detalle`, `precio`, `id_categoria`, `fecha`, `deleted_at`) VALUES
(2, 'VENTA DE ABONO DEL GALPON 3', '3510.70', 9, '2017-02-17', NULL),
(3, 'VENTA DE GALLINAS DEL GALPON 7', '5000.00', 9, '2017-02-17', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maple`
--

CREATE TABLE `maple` (
  `id` int(11) NOT NULL,
  `tamano` varchar(15) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `maple`
--

INSERT INTO `maple` (`id`, `tamano`, `cantidad`, `deleted_at`) VALUES
(1, 'GRANDE', 20, NULL),
(2, 'COMUN', 30, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `postura_huevo`
--

CREATE TABLE `postura_huevo` (
  `id` int(11) NOT NULL,
  `celda1` int(11) DEFAULT NULL,
  `celda2` int(11) DEFAULT NULL,
  `celda3` int(11) DEFAULT NULL,
  `celda4` int(11) DEFAULT NULL,
  `postura_p` int(11) DEFAULT NULL,
  `cantidad_total` int(11) DEFAULT NULL,
  `cantidad_muertas` int(11) NOT NULL,
  `id_fases_galpon` int(11) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `postura_huevo`
--

INSERT INTO `postura_huevo` (`id`, `celda1`, `celda2`, `celda3`, `celda4`, `postura_p`, `cantidad_total`, `cantidad_muertas`, `id_fases_galpon`, `fecha`, `deleted_at`) VALUES
(11, 100000, 0, 0, 0, 3333, 100000, 0, 57, '2017-02-16 23:38:22', NULL),
(12, 500, 700, 800, 600, 86, 2600, 0, 57, '2017-02-20 17:36:12', NULL),
(13, 0, 0, 0, 0, 0, 0, 5, 58, '2017-02-20 17:36:37', NULL),
(14, 500, 500, 600, 400, 66, 2000, 0, 59, '2017-02-20 17:41:02', NULL),
(15, 0, 500, 0, 0, 16, 500, 0, 57, '2017-02-22 21:50:23', NULL),
(16, 0, 200, 0, 0, 6, 200, 0, 59, '2017-02-22 21:50:26', NULL),
(17, 0, 0, 0, 0, 0, 0, 2, 58, '2017-02-22 21:51:35', NULL),
(18, 0, 500, 0, 0, 16, 500, 0, 59, '2017-02-23 21:53:41', NULL),
(19, 0, 500, 0, 0, 16, 500, 1, 57, '2017-02-23 21:53:45', NULL);

--
-- Disparadores `postura_huevo`
--
DELIMITER $$
CREATE TRIGGER `actualizar_huevos_acumulados_ph` AFTER UPDATE ON `postura_huevo` FOR EACH ROW BEGIN
DECLARE huevos integer;
SET huevos = NEW.cantidad_total - OLD.cantidad_total;

UPDATE huevo_acumulado SET huevo_acumulado.cantidad = huevo_acumulado.cantidad + huevos;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `agregar_huevos_acumulados_ph` AFTER INSERT ON `postura_huevo` FOR EACH ROW BEGIN

IF EXISTS(SELECT * from huevo_acumulado )THEN 
UPDATE huevo_acumulado SET huevo_acumulado.cantidad = huevo_acumulado.cantidad + NEW.cantidad_total;
ELSE
 INSERT INTO huevo_acumulado SET huevo_acumulado.cantidad=NEW.cantidad_total;
END IF; 

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rango_edad`
--

CREATE TABLE `rango_edad` (
  `id` int(11) NOT NULL,
  `edad_min` int(11) DEFAULT NULL,
  `edad_max` int(11) DEFAULT NULL,
  `estado` tinyint(4) NOT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rango_edad`
--

INSERT INTO `rango_edad` (`id`, `edad_min`, `edad_max`, `estado`, `deleted_at`) VALUES
(4, 150, 200, 1, NULL),
(5, 100, 149, 1, NULL),
(6, 0, 30, 1, NULL),
(7, 31, 99, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rango_temperatura`
--

CREATE TABLE `rango_temperatura` (
  `id` int(11) NOT NULL,
  `temp_min` int(11) DEFAULT NULL,
  `temp_max` int(11) DEFAULT NULL,
  `estado` tinyint(4) NOT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rango_temperatura`
--

INSERT INTO `rango_temperatura` (`id`, `temp_min`, `temp_max`, `estado`, `deleted_at`) VALUES
(3, 20, 35, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `silo`
--

CREATE TABLE `silo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(25) DEFAULT NULL,
  `capacidad` decimal(10,1) DEFAULT NULL,
  `cantidad` decimal(10,1) DEFAULT NULL,
  `cantidad_minima` decimal(10,1) NOT NULL,
  `id_alimento` int(11) DEFAULT NULL,
  `estado` tinyint(4) NOT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `silo`
--

INSERT INTO `silo` (`id`, `nombre`, `capacidad`, `cantidad`, `cantidad_minima`, `id_alimento`, `estado`, `deleted_at`) VALUES
(1, 'SILO 1', '6000.0', '6000.0', '1000.0', 6, 1, NULL),
(2, 'SILO 2', '6000.0', '7380.0', '1000.0', 5, 1, NULL),
(3, 'SILO 3', '6000.0', '500.0', '1000.0', 4, 1, NULL),
(4, 'SILO 4', '6000.0', '311.0', '1000.0', 2, 1, NULL),
(5, 'SILO 5', '6000.0', '6900.0', '1000.0', 1, 1, NULL),
(6, 'SILO 6', '6000.0', '6000.0', '1000.0', 1, 1, NULL),
(7, 'BOLSA', '200.0', '-400.0', '100.0', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sobrante`
--

CREATE TABLE `sobrante` (
  `id` int(11) NOT NULL,
  `cantidad_maple` int(11) DEFAULT NULL,
  `cantidad_huevo` int(11) DEFAULT NULL,
  `id_tipo_caja` int(11) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sobrante`
--

INSERT INTO `sobrante` (`id`, `cantidad_maple`, `cantidad_huevo`, `id_tipo_caja`, `fecha`, `deleted_at`) VALUES
(6, 1, 20, 1, '2017-02-16 23:38:43', NULL),
(7, 2, 60, 3, '2017-02-16 23:38:49', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temperatura`
--

CREATE TABLE `temperatura` (
  `id` int(11) NOT NULL,
  `temperatura` int(11) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `temperatura`
--

INSERT INTO `temperatura` (`id`, `temperatura`, `deleted_at`) VALUES
(1, 30, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_caja`
--

CREATE TABLE `tipo_caja` (
  `id` int(11) NOT NULL,
  `tipo` varchar(15) DEFAULT NULL,
  `precio` decimal(10,4) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `cantidad_maple` int(11) DEFAULT NULL,
  `id_maple` int(11) DEFAULT NULL,
  `estado` tinyint(4) NOT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_caja`
--

INSERT INTO `tipo_caja` (`id`, `tipo`, `precio`, `color`, `cantidad_maple`, `id_maple`, `estado`, `deleted_at`) VALUES
(1, 'EXTRA', '0.4310', 'silver', 10, 1, 1, NULL),
(2, 'PRIMERA', '0.4100', 'green', 10, 1, 1, NULL),
(3, 'SEGUNDA', '0.3990', 'red', 12, 2, 1, NULL),
(4, 'TERCERA', '0.3650', 'blue', 12, 2, 1, NULL),
(5, 'CUARTA', '0.3500', 'white', 12, 2, 1, NULL),
(6, 'QUINTA', '0.3000', 'yellow', 12, 2, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_huevo`
--

CREATE TABLE `tipo_huevo` (
  `id` int(11) NOT NULL,
  `tipo` varchar(15) DEFAULT NULL,
  `precio` decimal(10,4) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  `id_maple` int(11) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_huevo`
--

INSERT INTO `tipo_huevo` (`id`, `tipo`, `precio`, `estado`, `id_maple`, `deleted_at`) VALUES
(1, 'EXTRA GRANDE', '0.3100', 1, 1, NULL),
(2, 'BLANCO', '0.2500', 1, 2, NULL),
(3, 'PICADO', '0.2990', 1, 2, NULL),
(4, 'QUEBRADO', '0.2000', 1, 2, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pass2` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `password`, `remember_token`, `pass2`, `created_at`, `updated_at`) VALUES
(7, '', '', 'admin', '$2y$10$Vx6ywmVuA9VsjBWbxtoUk.dGkK32SoOWkQxMwC57hEKtBHnicpktq', NULL, 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacuna`
--

CREATE TABLE `vacuna` (
  `id` int(11) NOT NULL,
  `edad` int(11) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `detalle` varchar(100) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vacuna`
--

INSERT INTO `vacuna` (`id`, `edad`, `nombre`, `detalle`, `estado`, `precio`, `deleted_at`) VALUES
(3, 0, 'AAA', 'AAAAAAAA', 1, '2.00', NULL),
(4, 5, 'bbb', 'bbbbbbb', 1, '3.50', NULL),
(5, 20, 'cccc', 'ccccc', 1, '2.30', NULL),
(6, 36, 'ddd', 'dddddd', 1, '3.70', NULL),
(7, 150, 'EEE', 'EEEEEEEE', 1, '1.20', NULL),
(8, 150, 'FFF', 'FFFFFF', 1, '1.00', NULL),
(9, 150, 'GGG', 'GGGGGGG', 1, '60.00', NULL),
(10, 200, 'PPP', 'PPPPPPP', 1, '5.60', NULL),
(11, 300, 'qqqq', 'qqqqqqqq', 1, '20.80', NULL),
(12, 30, 'ewww', 'wwww', 1, '123.00', NULL),
(13, 213, 'qwad', 'asd', 1, '23.00', NULL),
(14, 213, 'd', 'ad', 1, '213.00', NULL),
(15, 213, '11', 'asdsa', 1, '657.00', NULL),
(16, 24324, 'dsfds', 'sdf', 1, '234.00', NULL),
(17, 234, '234', '234', 1, '234.00', NULL),
(18, 90, 'iu', '0980', 1, '890.00', NULL),
(19, 12, '123', '123', 1, '213.00', NULL),
(20, 23, '123', '123', 1, '123.00', NULL),
(21, 234, '234', '324', 1, '234.00', NULL),
(22, 324, '324', '234', 1, '234.00', NULL),
(23, 454, '345', '345', 1, '435.00', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacuna_emergente`
--

CREATE TABLE `vacuna_emergente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `detalle` varchar(200) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `vacuna_emergente`
--

INSERT INTO `vacuna_emergente` (`id`, `nombre`, `detalle`, `precio`, `estado`, `deleted_at`) VALUES
(1, 'AAA', 'AAAA', '3.70', 1, NULL),
(2, 'BBB', 'BBBBBBBBBBBB', '7.20', 1, NULL),
(3, 'CCC', 'CCCCCCCC', '1.00', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_caja`
--

CREATE TABLE `venta_caja` (
  `id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `estado` tinyint(4) NOT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta_caja`
--

INSERT INTO `venta_caja` (`id`, `fecha`, `precio`, `estado`, `deleted_at`) VALUES
(13, '2017-02-19', '562.04', 1, NULL),
(14, '2017-02-19', '812.88', 1, NULL),
(15, '2017-02-17', '406.44', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_huevo`
--

CREATE TABLE `venta_huevo` (
  `id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `estado` tinyint(4) NOT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta_huevo`
--

INSERT INTO `venta_huevo` (`id`, `fecha`, `precio`, `estado`, `deleted_at`) VALUES
(2, '2017-02-19', '69.48', 1, NULL),
(3, '2017-02-19', '19.90', 1, NULL),
(4, '2017-02-16', '46.64', 1, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alimento`
--
ALTER TABLE `alimento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipo_caja` (`id_tipo_caja`);

--
-- Indices de la tabla `caja_deposito`
--
ALTER TABLE `caja_deposito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipo_caja` (`id_tipo_caja`);

--
-- Indices de la tabla `cantidad_maple`
--
ALTER TABLE `cantidad_maple`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipo_caja` (`id_tipo_caja`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_silo` (`id_silo`);

--
-- Indices de la tabla `consumo`
--
ALTER TABLE `consumo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_fase_galpon` (`id_fase_galpon`),
  ADD KEY `id_control_alimento` (`id_control_alimento`);

--
-- Indices de la tabla `consumo_emergente`
--
ALTER TABLE `consumo_emergente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_edad` (`id_edad`),
  ADD KEY `id_vacuna` (`id_vacuna`);

--
-- Indices de la tabla `consumo_vacuna`
--
ALTER TABLE `consumo_vacuna`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_control_vacuna` (`id_control_vacuna`);

--
-- Indices de la tabla `control_alimento`
--
ALTER TABLE `control_alimento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_alimento` (`id_alimento`),
  ADD KEY `control_alimento_ibfk_2` (`id_edad`),
  ADD KEY `control_alimento_ibfk_3` (`id_temperatura`);

--
-- Indices de la tabla `control_vacuna`
--
ALTER TABLE `control_vacuna`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_edad` (`id_edad`),
  ADD KEY `id_vacuna` (`id_vacuna`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipo_caja` (`id_tipo_caja`),
  ADD KEY `id_venta_caja` (`id_venta_caja`);

--
-- Indices de la tabla `detalle_venta_huevo`
--
ALTER TABLE `detalle_venta_huevo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_venta_huevo` (`id_venta_huevo`),
  ADD KEY `id_tipo_huevo` (`id_tipo_huevo`);

--
-- Indices de la tabla `edad`
--
ALTER TABLE `edad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_galpon` (`id_galpon`);

--
-- Indices de la tabla `egreso_varios`
--
ALTER TABLE `egreso_varios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `fases`
--
ALTER TABLE `fases`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fases_galpon`
--
ALTER TABLE `fases_galpon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_edad` (`id_edad`),
  ADD KEY `id_fase` (`id_fase`);

--
-- Indices de la tabla `galpon`
--
ALTER TABLE `galpon`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `galpon_vacuna`
--
ALTER TABLE `galpon_vacuna`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_vacuna` (`id_vacuna`),
  ADD KEY `id_edad` (`id_edad`);

--
-- Indices de la tabla `huevo`
--
ALTER TABLE `huevo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipo_huevo` (`id_tipo_huevo`);

--
-- Indices de la tabla `huevo_acumulado`
--
ALTER TABLE `huevo_acumulado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `huevo_deposito`
--
ALTER TABLE `huevo_deposito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipo_huevo` (`id_tipo_huevo`);

--
-- Indices de la tabla `ingreso_varios`
--
ALTER TABLE `ingreso_varios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `maple`
--
ALTER TABLE `maple`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `postura_huevo`
--
ALTER TABLE `postura_huevo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_fases_galpon` (`id_fases_galpon`);

--
-- Indices de la tabla `rango_edad`
--
ALTER TABLE `rango_edad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rango_temperatura`
--
ALTER TABLE `rango_temperatura`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `silo`
--
ALTER TABLE `silo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_alimento` (`id_alimento`);

--
-- Indices de la tabla `sobrante`
--
ALTER TABLE `sobrante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipo` (`id_tipo_caja`);

--
-- Indices de la tabla `temperatura`
--
ALTER TABLE `temperatura`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_caja`
--
ALTER TABLE `tipo_caja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_maple` (`id_maple`);

--
-- Indices de la tabla `tipo_huevo`
--
ALTER TABLE `tipo_huevo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_maple` (`id_maple`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `vacuna`
--
ALTER TABLE `vacuna`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vacuna_emergente`
--
ALTER TABLE `vacuna_emergente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta_caja`
--
ALTER TABLE `venta_caja`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta_huevo`
--
ALTER TABLE `venta_huevo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alimento`
--
ALTER TABLE `alimento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `caja_deposito`
--
ALTER TABLE `caja_deposito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `cantidad_maple`
--
ALTER TABLE `cantidad_maple`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `consumo`
--
ALTER TABLE `consumo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;
--
-- AUTO_INCREMENT de la tabla `consumo_emergente`
--
ALTER TABLE `consumo_emergente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `consumo_vacuna`
--
ALTER TABLE `consumo_vacuna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `control_alimento`
--
ALTER TABLE `control_alimento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `control_vacuna`
--
ALTER TABLE `control_vacuna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `detalle_venta_huevo`
--
ALTER TABLE `detalle_venta_huevo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `edad`
--
ALTER TABLE `edad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT de la tabla `egreso_varios`
--
ALTER TABLE `egreso_varios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `fases`
--
ALTER TABLE `fases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `fases_galpon`
--
ALTER TABLE `fases_galpon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT de la tabla `galpon`
--
ALTER TABLE `galpon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT de la tabla `galpon_vacuna`
--
ALTER TABLE `galpon_vacuna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `huevo`
--
ALTER TABLE `huevo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `huevo_acumulado`
--
ALTER TABLE `huevo_acumulado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `huevo_deposito`
--
ALTER TABLE `huevo_deposito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `ingreso_varios`
--
ALTER TABLE `ingreso_varios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `maple`
--
ALTER TABLE `maple`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `postura_huevo`
--
ALTER TABLE `postura_huevo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `rango_edad`
--
ALTER TABLE `rango_edad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `rango_temperatura`
--
ALTER TABLE `rango_temperatura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `sobrante`
--
ALTER TABLE `sobrante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `temperatura`
--
ALTER TABLE `temperatura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tipo_caja`
--
ALTER TABLE `tipo_caja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `tipo_huevo`
--
ALTER TABLE `tipo_huevo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `vacuna`
--
ALTER TABLE `vacuna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `vacuna_emergente`
--
ALTER TABLE `vacuna_emergente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `venta_caja`
--
ALTER TABLE `venta_caja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `venta_huevo`
--
ALTER TABLE `venta_huevo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `caja`
--
ALTER TABLE `caja`
  ADD CONSTRAINT `caja_ibfk_1` FOREIGN KEY (`id_tipo_caja`) REFERENCES `tipo_caja` (`id`);

--
-- Filtros para la tabla `caja_deposito`
--
ALTER TABLE `caja_deposito`
  ADD CONSTRAINT `caja_deposito_ibfk_1` FOREIGN KEY (`id_tipo_caja`) REFERENCES `tipo_caja` (`id`);

--
-- Filtros para la tabla `cantidad_maple`
--
ALTER TABLE `cantidad_maple`
  ADD CONSTRAINT `cantidad_maple_ibfk_1` FOREIGN KEY (`id_tipo_caja`) REFERENCES `tipo_caja` (`id`);

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`id_silo`) REFERENCES `silo` (`id`);

--
-- Filtros para la tabla `consumo`
--
ALTER TABLE `consumo`
  ADD CONSTRAINT `consumo_ibfk_1` FOREIGN KEY (`id_fase_galpon`) REFERENCES `fases_galpon` (`id`),
  ADD CONSTRAINT `consumo_ibfk_2` FOREIGN KEY (`id_control_alimento`) REFERENCES `control_alimento` (`id`);

--
-- Filtros para la tabla `consumo_emergente`
--
ALTER TABLE `consumo_emergente`
  ADD CONSTRAINT `consumo_emergente_ibfk_1` FOREIGN KEY (`id_edad`) REFERENCES `edad` (`id`),
  ADD CONSTRAINT `consumo_emergente_ibfk_2` FOREIGN KEY (`id_vacuna`) REFERENCES `vacuna_emergente` (`id`);

--
-- Filtros para la tabla `consumo_vacuna`
--
ALTER TABLE `consumo_vacuna`
  ADD CONSTRAINT `consumo_vacuna_ibfk_1` FOREIGN KEY (`id_control_vacuna`) REFERENCES `control_vacuna` (`id`);

--
-- Filtros para la tabla `control_alimento`
--
ALTER TABLE `control_alimento`
  ADD CONSTRAINT `control_alimento_ibfk_1` FOREIGN KEY (`id_alimento`) REFERENCES `alimento` (`id`),
  ADD CONSTRAINT `control_alimento_ibfk_2` FOREIGN KEY (`id_edad`) REFERENCES `rango_edad` (`id`),
  ADD CONSTRAINT `control_alimento_ibfk_3` FOREIGN KEY (`id_temperatura`) REFERENCES `rango_temperatura` (`id`);

--
-- Filtros para la tabla `control_vacuna`
--
ALTER TABLE `control_vacuna`
  ADD CONSTRAINT `control_vacuna_ibfk_1` FOREIGN KEY (`id_edad`) REFERENCES `edad` (`id`),
  ADD CONSTRAINT `control_vacuna_ibfk_2` FOREIGN KEY (`id_vacuna`) REFERENCES `vacuna` (`id`);

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`id_tipo_caja`) REFERENCES `tipo_caja` (`id`),
  ADD CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`id_venta_caja`) REFERENCES `venta_caja` (`id`);

--
-- Filtros para la tabla `detalle_venta_huevo`
--
ALTER TABLE `detalle_venta_huevo`
  ADD CONSTRAINT `detalle_venta_huevo_ibfk_1` FOREIGN KEY (`id_venta_huevo`) REFERENCES `venta_huevo` (`id`),
  ADD CONSTRAINT `detalle_venta_huevo_ibfk_2` FOREIGN KEY (`id_tipo_huevo`) REFERENCES `tipo_huevo` (`id`);

--
-- Filtros para la tabla `edad`
--
ALTER TABLE `edad`
  ADD CONSTRAINT `edad_ibfk_1` FOREIGN KEY (`id_galpon`) REFERENCES `galpon` (`id`);

--
-- Filtros para la tabla `egreso_varios`
--
ALTER TABLE `egreso_varios`
  ADD CONSTRAINT `egreso_varios_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`);

--
-- Filtros para la tabla `fases_galpon`
--
ALTER TABLE `fases_galpon`
  ADD CONSTRAINT `fases_galpon_ibfk_1` FOREIGN KEY (`id_edad`) REFERENCES `edad` (`id`),
  ADD CONSTRAINT `fases_galpon_ibfk_2` FOREIGN KEY (`id_fase`) REFERENCES `fases` (`id`);

--
-- Filtros para la tabla `galpon_vacuna`
--
ALTER TABLE `galpon_vacuna`
  ADD CONSTRAINT `galpon_vacuna_ibfk_1` FOREIGN KEY (`id_vacuna`) REFERENCES `vacuna` (`id`),
  ADD CONSTRAINT `galpon_vacuna_ibfk_2` FOREIGN KEY (`id_edad`) REFERENCES `edad` (`id`);

--
-- Filtros para la tabla `huevo`
--
ALTER TABLE `huevo`
  ADD CONSTRAINT `huevo_ibfk_1` FOREIGN KEY (`id_tipo_huevo`) REFERENCES `tipo_huevo` (`id`);

--
-- Filtros para la tabla `huevo_deposito`
--
ALTER TABLE `huevo_deposito`
  ADD CONSTRAINT `huevo_deposito_ibfk_1` FOREIGN KEY (`id_tipo_huevo`) REFERENCES `tipo_huevo` (`id`);

--
-- Filtros para la tabla `ingreso_varios`
--
ALTER TABLE `ingreso_varios`
  ADD CONSTRAINT `ingreso_varios_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`);

--
-- Filtros para la tabla `postura_huevo`
--
ALTER TABLE `postura_huevo`
  ADD CONSTRAINT `postura_huevo_ibfk_1` FOREIGN KEY (`id_fases_galpon`) REFERENCES `fases_galpon` (`id`);

--
-- Filtros para la tabla `silo`
--
ALTER TABLE `silo`
  ADD CONSTRAINT `silo_ibfk_1` FOREIGN KEY (`id_alimento`) REFERENCES `alimento` (`id`);

--
-- Filtros para la tabla `sobrante`
--
ALTER TABLE `sobrante`
  ADD CONSTRAINT `sobrante_ibfk_1` FOREIGN KEY (`id_tipo_caja`) REFERENCES `tipo_caja` (`id`);

--
-- Filtros para la tabla `tipo_caja`
--
ALTER TABLE `tipo_caja`
  ADD CONSTRAINT `tipo_caja_ibfk_1` FOREIGN KEY (`id_maple`) REFERENCES `maple` (`id`);

--
-- Filtros para la tabla `tipo_huevo`
--
ALTER TABLE `tipo_huevo`
  ADD CONSTRAINT `tipo_huevo_ibfk_1` FOREIGN KEY (`id_maple`) REFERENCES `maple` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

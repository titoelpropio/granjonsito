-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-01-2017 a las 16:28:00
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
-- Disparadores `compra`
--
DELIMITER $$
CREATE TRIGGER `actualizar_silo_compra` AFTER INSERT ON `compra` FOR EACH ROW UPDATE silo 
SET silo.cantidad=silo.cantidad+(NEW.cantidad_total) 
WHERE silo.id=new.id_silo
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
-- Disparadores `consumo`
--
DELIMITER $$
CREATE TRIGGER `actualizar_consumo_grano` AFTER UPDATE ON `consumo` FOR EACH ROW BEGIN
    DECLARE cantidad_grano integer;
    SET cantidad_grano =  NEW.cantidad - OLD.cantidad;
    UPDATE silo SET silo.cantidad = silo.cantidad - cantidad_grano
    WHERE silo.id = NEW.id_silo;
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
(55, 8, 2290, NULL);

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
(2, 'SILO 2', '6000.0', '6000.0', '1000.0', 5, 1, NULL),
(3, 'SILO 3', '6000.0', '6000.0', '1000.0', 4, 1, NULL),
(4, 'SILO 4', '6000.0', '6000.0', '1000.0', 3, 1, NULL),
(5, 'SILO 5', '6000.0', '6000.0', '1000.0', 2, 1, NULL),
(6, 'SILO 6', '6000.0', '6000.0', '1000.0', 1, 1, NULL);

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
(1, 35, NULL);

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
(6, '', '', 'admin', '$2y$10$s8y6DlbE7SNzuT/B0TlWceRkNq83WUyWqkAN7B1aqVfT7VA/BVwRG', 'lmybMou5MaKf11MGlXABDWrV4hBPKBoUea3weMmzplbWvxv5TCzFkeHR1aRA', 'admin', NULL, NULL);

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
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Indices de la tabla `control_alimento`
--
ALTER TABLE `control_alimento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_alimento` (`id_alimento`),
  ADD KEY `control_alimento_ibfk_2` (`id_edad`),
  ADD KEY `control_alimento_ibfk_3` (`id_temperatura`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `caja_deposito`
--
ALTER TABLE `caja_deposito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `cantidad_maple`
--
ALTER TABLE `cantidad_maple`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `consumo`
--
ALTER TABLE `consumo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;
--
-- AUTO_INCREMENT de la tabla `control_alimento`
--
ALTER TABLE `control_alimento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `detalle_venta_huevo`
--
ALTER TABLE `detalle_venta_huevo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `edad`
--
ALTER TABLE `edad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT de la tabla `egreso_varios`
--
ALTER TABLE `egreso_varios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `fases`
--
ALTER TABLE `fases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `fases_galpon`
--
ALTER TABLE `fases_galpon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT de la tabla `galpon`
--
ALTER TABLE `galpon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT de la tabla `galpon_vacuna`
--
ALTER TABLE `galpon_vacuna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `huevo`
--
ALTER TABLE `huevo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `huevo_acumulado`
--
ALTER TABLE `huevo_acumulado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `huevo_deposito`
--
ALTER TABLE `huevo_deposito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `ingreso_varios`
--
ALTER TABLE `ingreso_varios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `maple`
--
ALTER TABLE `maple`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `postura_huevo`
--
ALTER TABLE `postura_huevo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `rango_edad`
--
ALTER TABLE `rango_edad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `rango_temperatura`
--
ALTER TABLE `rango_temperatura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `sobrante`
--
ALTER TABLE `sobrante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `vacuna`
--
ALTER TABLE `vacuna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `venta_caja`
--
ALTER TABLE `venta_caja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `venta_huevo`
--
ALTER TABLE `venta_huevo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
-- Filtros para la tabla `control_alimento`
--
ALTER TABLE `control_alimento`
  ADD CONSTRAINT `control_alimento_ibfk_1` FOREIGN KEY (`id_alimento`) REFERENCES `alimento` (`id`),
  ADD CONSTRAINT `control_alimento_ibfk_2` FOREIGN KEY (`id_edad`) REFERENCES `rango_edad` (`id`),
  ADD CONSTRAINT `control_alimento_ibfk_3` FOREIGN KEY (`id_temperatura`) REFERENCES `rango_temperatura` (`id`);

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

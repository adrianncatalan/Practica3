-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-10-2021 a las 10:14:15
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_taller`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_servicios`
--

CREATE TABLE `registro_servicios` (
  `id_servicio` int(7) NOT NULL,
  `placa` varchar(10) DEFAULT NULL,
  `tipo_servicio` varchar(30) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `registro_servicios`
--

INSERT INTO `registro_servicios` (`id_servicio`, `placa`, `tipo_servicio`, `descripcion`, `fecha`) VALUES
(1, '1549LZH', 'cambio de aceite', 'FEU VERT 10W40 5L', '2021-10-11'),
(2, '1234ABC', 'cambio aceite', '10wd 50', '2021-10-25'),
(3, '1234ABC', 'cambio frenos', 'pastillas racing', '2021-10-25'),
(4, '0798FDG', 'remplazo luna', 'luna polarizada ', '2021-10-25'),
(5, '1549LZH', 'cambio frenos', 'pastillas racing', '2021-10-25'),
(6, '1549LZH', 'repintado', 'puerta izquierda', '2021-10-26'),
(7, '1549LZH', 'cambio ruedas', 'pirelli 2225/220/60', '2021-10-26'),
(8, '1234ABC', 'carga gas ac', 'gas marca eoneo', '2021-10-27'),
(9, '0798FDT', 'cambio ruedas', 'michelin road', '2021-10-27'),
(10, '0798FDT', 'cambio aceite', '4l 50w30', '2021-10-27'),
(11, '6789PLG', 'cambio amortiguadores', 'amortiguadores fr', '2021-10-27'),
(12, '0234CDD', 'cambio cadena', 'cadena menos dientes', '2021-10-27'),
(13, '6789PLG', 'cambio aceite', 'Aceite5W300', '2021-10-30'),
(14, '6789PLG', 'cambio frenos', 'pastillas economicas', '2021-10-30'),
(15, '6666XXX', 'cambio frenos', 'pastillas racing', '2021-10-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_usuarios`
--

CREATE TABLE `registro_usuarios` (
  `id_usuario` varchar(20) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `apellido` varchar(40) DEFAULT NULL,
  `telefono` int(15) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `clave` varchar(200) NOT NULL,
  `contacto_emergencia` int(15) DEFAULT NULL,
  `fecha_alta` date DEFAULT NULL,
  `cantidad_vehiculos` int(5) DEFAULT NULL,
  `departamento` varchar(30) DEFAULT NULL,
  `cargo` varchar(20) DEFAULT NULL,
  `administrador` char(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `registro_usuarios`
--

INSERT INTO `registro_usuarios` (`id_usuario`, `nombre`, `apellido`, `telefono`, `email`, `clave`, `contacto_emergencia`, `fecha_alta`, `cantidad_vehiculos`, `departamento`, `cargo`, `administrador`) VALUES
('daniel1', 'daniel eduardo', 'clermont galante', 632333486, 'dcl0003@alu.medac.es', '$2y$10$rnznvstGl79/0fh31ghPqummQ9qg0Fy0tx/O3I5FFN3pDy/ePyk/.', 12345678, '2021-10-25', 8, 'estudiante', 'estudiante', 'no'),
('acd0004', 'adrian daniel', 'catalan delgado', 444444, 'acd0004@alu.medac.es', '$2y$10$mxjGBlufq8tlffv/wzo7ce8Upyi9OKRQSh9LEih4jtoVuWa6Vk1YO', 6666666, '2021-10-25', 3, 'sistemas informaticos', 'web master', 'si'),
('andres584', 'andres alejandro', 'clermont galante', 682032394, 'acl006@alu.medac.es', '$2y$10$Z.UEG9EPARfqy6S3Jv3hseUUijHjuUEeTcQ6e2N6BnPyjYgwP9q1G', 633342394, '2021-10-27', 2, 'informatica', 'web master', 'si'),
('rglez', 'roberto', 'gonzales', 567239856, 'rg0008@alu.medac.es', '$2y$10$mZibsEZO/l5bL3PI658M5.IvvGUOeYwJMzi.8OTPA7QzJhCGxVmFi', 784868493, '2021-10-27', 4, 'estudiante', 'estudiante', 'no');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_vehiculos`
--

CREATE TABLE `registro_vehiculos` (
  `id_usuario` varchar(20) NOT NULL,
  `marca` varchar(20) DEFAULT NULL,
  `modelo` varchar(20) DEFAULT NULL,
  `placa` varchar(20) NOT NULL,
  `fecha_alta` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `registro_vehiculos`
--

INSERT INTO `registro_vehiculos` (`id_usuario`, `marca`, `modelo`, `placa`, `fecha_alta`) VALUES
('acd0004', 'volvo', 'xc90', '1549LZH', '2021-10-14'),
('daniel1', 'toyota', 'corolla', '1234ABC', '2021-10-04'),
('daniel1', 'honda', 'civic', '2345BCD', '2021-10-25'),
('daniel1', 'bmw', 'serie 3', '9876FGT', '2021-10-25'),
('acd0004', 'volkswagen', 'golf', '0999LZT', '2021-10-25'),
('acd0004', 'suzuki ', 'ignis', '0798FDG', '2021-10-25'),
('daniel1', 'dacia', 'logan', '9856YBB', '2021-10-26'),
('daniel1', 'nissan', 'gtr', '8769GTR', '2021-10-26'),
('daniel1', 'nissan', 'leaf', '7766HPO', '2021-10-26'),
('daniel1', 'dacia', 'sandero', '9025DTH', '2021-10-27'),
('daniel1', 'opel', 'vectra', '1234RTB', '2021-10-27'),
('andres584', 'toyota', 'avensis', '0798FDT', '2021-10-27'),
('andres584', 'suzuki', 'sv650', '6199DTY', '2021-10-27'),
('rglez', 'seat', 'ibiza', '6789PLG', '2021-10-27'),
('rglez', 'suzuki ', 'marauder250', '0234CDD', '2021-10-27'),
('rglez', 'benelli', 'trk', '6754FTP', '2021-10-30'),
('rglez', 'ford', 'fiesta', '6666XXX', '2021-10-30');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `registro_servicios`
--
ALTER TABLE `registro_servicios`
  ADD PRIMARY KEY (`id_servicio`);

--
-- Indices de la tabla `registro_usuarios`
--
ALTER TABLE `registro_usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `registro_vehiculos`
--
ALTER TABLE `registro_vehiculos`
  ADD PRIMARY KEY (`placa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

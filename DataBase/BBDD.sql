-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-12-2021 a las 18:37:57
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tiendacompraventa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `idComentario` int(11) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `contenido` varchar(150) DEFAULT NULL,
  `idProducto` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`idComentario`, `idUsuario`, `contenido`, `idProducto`, `fecha`) VALUES
(1, 1, '', 3, '2021-12-07 11:53:52'),
(2, 1, 'hola', 3, '2021-12-07 12:02:48'),
(3, 1, 'jajajaja', 4, '2021-12-08 11:01:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idProducto` int(11) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `fechaIni` datetime DEFAULT NULL,
  `fechaFin` datetime DEFAULT NULL,
  `precioInicial` double DEFAULT NULL,
  `idSeccion` int(11) DEFAULT NULL,
  `proImagen` varchar(150) DEFAULT NULL,
  `Descripcion` varchar(150) DEFAULT NULL,
  `titulo` varchar(50) DEFAULT NULL,
  `precioEnvio` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `idUsuario`, `fechaIni`, `fechaFin`, `precioInicial`, `idSeccion`, `proImagen`, `Descripcion`, `titulo`, `precioEnvio`) VALUES
(1, 1, NULL, NULL, 80.15, 1, NULL, 'Nueva', 'bicicleta', NULL),
(2, 1, NULL, NULL, 80, 1, NULL, 'viejo', 'casco', NULL),
(3, 1, '2021-12-07 11:48:10', '2021-12-08 11:48:10', 20, 1, 'images/descarga.jpg', 'Telefono de juguete nuevo', 'Juguete', NULL),
(4, 1, '2021-12-07 18:11:37', '2021-12-16 18:11:37', 1, 1, 'images/h.jpg', 'desa', 'Juguete', NULL),
(5, 1, '2021-12-08 14:11:11', '2021-12-14 14:11:11', 20, 1, 'images/', '2k', 'xs', NULL),
(6, 1, '2021-12-08 14:11:33', '2021-12-12 14:11:33', 5, 1, 'images/', 'hihji', 'lklk', NULL),
(7, 1, '2021-12-09 17:22:07', '2021-12-19 17:22:07', 50000, 2, 'images/images.jfif', '2016', 'Audi', NULL),
(8, 1, '2021-12-09 19:20:12', '2021-12-12 19:20:12', 20, 1, 'images/images.jfif', '', 'juguete', NULL),
(9, 1, '2021-12-09 19:36:58', '2021-12-14 19:36:58', 1.15, 2, 'images/images.jfif', '', 'Audi', 1.01),
(10, 1, '2021-12-09 20:07:45', '2021-12-14 20:07:45', 20, 2, 'images/images.jfif', 'hikjn', 'Audi', 20.4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puja`
--

CREATE TABLE `puja` (
  `idPuja` int(11) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `idProducto` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `valor` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `puja`
--

INSERT INTO `puja` (`idPuja`, `idUsuario`, `idProducto`, `fecha`, `valor`) VALUES
(1, 1, 3, '2021-12-07 11:54:04', 20.25),
(2, 1, 4, '2021-12-08 11:01:57', 1.25),
(3, 1, 6, '2021-12-08 19:05:54', 6),
(4, 1, 5, '2021-12-08 19:06:13', 20),
(5, 1, 4, '2021-12-09 15:57:29', 1.3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

CREATE TABLE `seccion` (
  `idSeccion` int(11) NOT NULL,
  `nombreSec` varchar(50) DEFAULT NULL,
  `info` varchar(150) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `seccion`
--

INSERT INTO `seccion` (`idSeccion`, `nombreSec`, `info`, `image`) VALUES
(1, 'Deportes', 'Encuentre todo sobre deporte nuevo o de segunda mano', 'images/1.jpg'),
(2, 'Motor', 'Lo mejor del motor', 'images/images.jfif');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `dni` varchar(9) DEFAULT NULL,
  `comunidad` varchar(50) DEFAULT NULL,
  `provincia` varchar(50) DEFAULT NULL,
  `cp` varchar(5) DEFAULT NULL,
  `direccion` varchar(70) DEFAULT NULL,
  `Rol` varchar(20) DEFAULT NULL,
  `telefono` varchar(9) DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `usuario`, `password`, `nombre`, `apellidos`, `dni`, `comunidad`, `provincia`, `cp`, `direccion`, `Rol`, `telefono`, `email`) VALUES
(1, 'fasi', 'fasi', 'hasan', NULL, NULL, NULL, NULL, NULL, NULL, 'admin', NULL, NULL),
(2, 'asa', 'asa', 'asa', 'asa', '20202020x', NULL, NULL, NULL, NULL, 'usuario', NULL, NULL),
(4, 'hasan', 'gfdgfdgfd', 'ghghgdgf', 'ghgh', 'ghgfh', 'Ceuta', 'Ceuta', '51070', 'thfttfgt', 'admin', '', 'fgh'),
(5, 'hamete', 'tetete', 'fsdt', 'tetetetetete', '20421221x', 'Extremadura', 'Badajoz', '06080', 'C/ sAn fernteando', 'usu', '', 'fasifx@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`idComentario`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idProducto` (`idProducto`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idProducto`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idSeccion` (`idSeccion`);

--
-- Indices de la tabla `puja`
--
ALTER TABLE `puja`
  ADD PRIMARY KEY (`idPuja`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idProducto` (`idProducto`);

--
-- Indices de la tabla `seccion`
--
ALTER TABLE `seccion`
  ADD PRIMARY KEY (`idSeccion`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `idComentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `puja`
--
ALTER TABLE `puja`
  MODIFY `idPuja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `seccion`
--
ALTER TABLE `seccion`
  MODIFY `idSeccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`idSeccion`) REFERENCES `seccion` (`idSeccion`);

--
-- Filtros para la tabla `puja`
--
ALTER TABLE `puja`
  ADD CONSTRAINT `puja_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `puja_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

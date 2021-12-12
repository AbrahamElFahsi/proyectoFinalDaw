-- MySQL dump 10.13  Distrib 8.0.27, for Linux (x86_64)
--
-- Host: localhost    Database: tiendacompraventa
-- ------------------------------------------------------
-- Server version	8.0.27

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE usuario(
idUsuario int(11) NOT NULL,
  usuario varchar(45) DEFAULT NULL,
  password varchar(50) DEFAULT NULL,
  nombre varchar(45) DEFAULT NULL,
  apellidos varchar(50) DEFAULT NULL,
  dni varchar(9) DEFAULT NULL,
  comunidad varchar(50) DEFAULT NULL,
  provincia varchar(50) DEFAULT NULL,
  cp varchar(5) DEFAULT NULL,
  direccion varchar(70) DEFAULT NULL,
  Rol varchar(20) DEFAULT NULL,
  telefono varchar(9) DEFAULT NULL,
  email varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE comentario(
  idComentario int(11) NOT NULL,
  idUsuario int(11) DEFAULT NULL,
  contenido varchar(150) DEFAULT NULL,
  idProducto int(11) DEFAULT NULL,
  fecha datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comentario`
--



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE producto (
  idProducto int(11) NOT NULL,
  idUsuario int(11) DEFAULT NULL,
  fechaIni datetime DEFAULT NULL,
  fechaFin datetime DEFAULT NULL,
  precioInicial double DEFAULT NULL,
  idSeccion int(11) DEFAULT NULL,
  proImagen varchar(150) DEFAULT NULL,
  Descripcion varchar(150) DEFAULT NULL,
  titulo varchar(50) DEFAULT NULL,
  precioEnvio double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto`
--



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puja`
--

CREATE TABLE puja (
  idPuja int(11) NOT NULL,
  idUsuario int(11) DEFAULT NULL,
  idProducto int(11) DEFAULT NULL,
  fecha datetime DEFAULT NULL,
  valor double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `puja`
--



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

CREATE TABLE seccion (
  idSeccion int(11) NOT NULL,
  nombreSec varchar(50) DEFAULT NULL,
  info varchar(150) DEFAULT NULL,
  image varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `seccion`
--


-- --------------------------------------------------------


--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO usuario (idUsuario, usuario, password, nombre, apellidos, dni, comunidad, provincia, cp, direccion, Rol, telefono, email) VALUES
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
ALTER TABLE comentario
  ADD PRIMARY KEY (`idComentario`),
  ADD KEY idUsuario (`idUsuario`),
  ADD KEY idProducto (`idProducto`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE producto
  ADD PRIMARY KEY (`idProducto`),
  ADD KEY idUsuario (`idUsuario`),
  ADD KEY idSeccion (`idSeccion`);

--
-- Indices de la tabla `puja`
--
ALTER TABLE puja
  ADD PRIMARY KEY (idPuja),
  ADD KEY idUsuario (idUsuario),
  ADD KEY idProducto (idProducto);

--
-- Indices de la tabla `seccion`
--
ALTER TABLE seccion
  ADD PRIMARY KEY (idSeccion);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE usuario
  ADD PRIMARY KEY (idUsuario);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE comentario
  MODIFY idComentario int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE producto
  MODIFY idProducto int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `puja`
--
ALTER TABLE puja
  MODIFY idPuja int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `seccion`
--
ALTER TABLE seccion
  MODIFY idSeccion int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE usuario
  MODIFY idUsuario int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE comentario
  ADD CONSTRAINT comentario FOREIGN KEY (idUsuario) REFERENCES usuario (idUsuario);
  ALTER TABLE comentario
  ADD CONSTRAINT comentario FOREIGN KEY (idProducto) REFERENCES producto (idProducto);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE producto
  ADD CONSTRAINT producto FOREIGN KEY (idUsuario) REFERENCES usuario (idUsuario);
  ALTER TABLE producto
  ADD CONSTRAINT producto FOREIGN KEY (idSeccion) REFERENCES seccion (idSeccion);

--
-- Filtros para la tabla `puja`
--
ALTER TABLE puja
  ADD CONSTRAINT puja FOREIGN KEY (idUsuario) REFERENCES usuario (idUsuario):
  ALTER TABLE puja
  ADD CONSTRAINT puja_ibfk_2 FOREIGN KEY (idProducto) REFERENCES producto (idProducto);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

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
-- Table structure for table `usuarios`
--
INSERT INTO `comentario` (`idComentario`, `idUsuario`, `contenido`, `idProducto`, `fecha`) VALUES
(1, 1, '', 3, '2021-12-07 11:53:52'),
(2, 1, 'hola', 3, '2021-12-07 12:02:48'),
(3, 1, 'jajajaja', 4, '2021-12-08 11:01:36');
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

INSERT INTO `puja` (`idPuja`, `idUsuario`, `idProducto`, `fecha`, `valor`) VALUES
(1, 1, 3, '2021-12-07 11:54:04', 20.25),
(2, 1, 4, '2021-12-08 11:01:57', 1.25),
(3, 1, 6, '2021-12-08 19:05:54', 6),
(4, 1, 5, '2021-12-08 19:06:13', 20),
(5, 1, 4, '2021-12-09 15:57:29', 1.3);

INSERT INTO `seccion` (`idSeccion`, `nombreSec`, `info`, `image`) VALUES
(1, 'Deportes', 'Encuentre todo sobre deporte nuevo o de segunda mano', 'images/1.jpg'),
(2, 'Motor', 'Lo mejor del motor', 'images/images.jfif');

INSERT INTO `usuario` (`idUsuario`, `usuario`, `password`, `nombre`, `apellidos`, `dni`, `comunidad`, `provincia`, `cp`, `direccion`, `Rol`, `telefono`, `email`) VALUES
(1, 'fasi', 'fasi', 'hasan', NULL, NULL, NULL, NULL, NULL, NULL, 'admin', NULL, NULL),
(2, 'asa', 'asa', 'asa', 'asa', '20202020x', NULL, NULL, NULL, NULL, 'usuario', NULL, NULL),
(4, 'hasan', 'gfdgfdgfd', 'ghghgdgf', 'ghgh', 'ghgfh', 'Ceuta', 'Ceuta', '51070', 'thfttfgt', 'admin', '', 'fgh'),
(5, 'hamete', 'tetete', 'fsdt', 'tetetetetete', '20421221x', 'Extremadura', 'Badajoz', '06080', 'C/ sAn fernteando', 'usu', '', 'fasifx@gmail.com');
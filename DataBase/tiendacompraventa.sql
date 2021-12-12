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
-- Base de datos: `tiendacompraventa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--
 DROP TABLE IF EXISTS `usuario`;
  create table `usuario`(`idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY (`idUsuario`),
  UNIQUE KEY (`idusuario`),
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
  `email` varchar(70) DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;
   
 LOCK TABLES `usuario` WRITE;
  INSERT INTO `usuario` (`usuario`, `password`, `nombre`, `apellidos`, `dni`, `comunidad`, `provincia`, `cp`, `direccion`, `Rol`, `telefono`, `email`) VALUES
('fasi', 'fasi', 'hasan', NULL, NULL, NULL, NULL, NULL, NULL, 'admin', NULL, NULL),
('asa', 'asa', 'asa', 'asa', '20202020x', NULL, NULL, NULL, NULL, 'usuario', NULL, NULL),
('hasan', 'gfdgfdgfd', 'ghghgdgf', 'ghgh', 'ghgfh', 'Ceuta', 'Ceuta', '51070', 'thfttfgt', 'admin', '', 'fgh'),
('hamete', 'tetete', 'fsdt', 'tetetetetete', '20421221x', 'Extremadura', 'Badajoz', '06080', 'C/ sAn fernteando', 'usu', '', 'fasifx@gmail.com');
UNLOCK TABLES;
  DROP TABLE IF EXISTS `seccion`;
create table `seccion`(`idSeccion` int(11) NOT NULL AUTO_INCREMENT, `idUsuario` int,
  UNIQUE KEY (`idSeccion`),
  UNIQUE KEY (`idSeccion`),
  `nombreSec` varchar(50) DEFAULT NULL,
  `info` varchar(150) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `seccion` WRITE;
INSERT INTO `seccion` (`nombreSec`, `info`, `image`) VALUES
('Deportes', 'Encuentre todo sobre deporte nuevo o de segunda mano', 'images/1.jpg'),
('Motor', 'Lo mejor del motor', 'images/images.jfif');
UNLOCK TABLES;
  DROP TABLE IF EXISTS `producto`;
 create table `producto`(`idProducto` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idProducto`),
  UNIQUE KEY (`idProducto`),
  UNIQUE KEY (`idProducto`),
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
ALTER TABLE producto ADD FOREIGN KEY(`idSeccion`) REFERENCES
seccion(`idSeccion`) ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE producto ADD FOREIGN KEY(`idUsuario`) REFERENCES
usuario(`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

  DROP TABLE IF EXISTS `puja`;
create table `puja`(`idPuja` int NOT NULL AUTO_INCREMENT,
  UNIQUE KEY (`idPuja`),
  UNIQUE KEY (`idPuja`),
  `idUsuario` int(11) DEFAULT NULL,
  `idProducto` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `valor` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 ALTER TABLE puja ADD FOREIGN KEY(`idProducto`) REFERENCES
producto(`idProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;


  DROP TABLE IF EXISTS `comentario`;
 create table comentario(
  `idComentario` int(11) NOT NULL AUTO_INCREMENT,
  UNIQUE KEY (`idComentario`),
  UNIQUE KEY (`idComentario`),
  `idUsuario` int(11) DEFAULT NULL,
  `contenido` varchar(150) DEFAULT NULL,
  `idProducto` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 ALTER TABLE comentario ADD FOREIGN KEY(`idUsuario`) REFERENCES
usuario(`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
 ALTER TABLE comentario ADD FOREIGN KEY(`idProducto`) REFERENCES
producto(`idProducto`);



















/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

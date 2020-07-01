-- MariaDB dump 10.17  Distrib 10.4.13-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: baseCE
-- ------------------------------------------------------
-- Server version	10.4.13-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `id_categoria` int(2) NOT NULL AUTO_INCREMENT,
  `Categoria` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'Actividades Academicas'),(2,'Ciencia'),(3,'Cultura'),(4,'Deportes');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `encuesta`
--

DROP TABLE IF EXISTS `encuesta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `encuesta` (
  `id_encuesta` int(8) NOT NULL AUTO_INCREMENT,
  `Pregunta1` int(8) DEFAULT NULL,
  `Pregunta2` int(8) DEFAULT NULL,
  `Pregunta3` int(8) DEFAULT NULL,
  `Pregunta4` int(8) DEFAULT NULL,
  `Pregunta5` int(8) DEFAULT NULL,
  `creador` varchar(100) DEFAULT NULL,
  `Invitados` text DEFAULT NULL,
  `Hecho` text DEFAULT NULL,
  `Titulo` text DEFAULT NULL,
  `Descripcion` text DEFAULT NULL,
  `Denuncias` int(8) DEFAULT NULL,
  `id_categoria` int(2) DEFAULT NULL,
  PRIMARY KEY (`id_encuesta`),
  KEY `Pregunta1` (`Pregunta1`),
  KEY `Pregunta2` (`Pregunta2`),
  KEY `Pregunta3` (`Pregunta3`),
  KEY `Pregunta4` (`Pregunta4`),
  KEY `Pregunta5` (`Pregunta5`),
  CONSTRAINT `encuesta_ibfk_1` FOREIGN KEY (`Pregunta1`) REFERENCES `pregunta` (`id_pregunta`),
  CONSTRAINT `encuesta_ibfk_2` FOREIGN KEY (`Pregunta2`) REFERENCES `pregunta` (`id_pregunta`),
  CONSTRAINT `encuesta_ibfk_3` FOREIGN KEY (`Pregunta3`) REFERENCES `pregunta` (`id_pregunta`),
  CONSTRAINT `encuesta_ibfk_4` FOREIGN KEY (`Pregunta4`) REFERENCES `pregunta` (`id_pregunta`),
  CONSTRAINT `encuesta_ibfk_5` FOREIGN KEY (`Pregunta5`) REFERENCES `pregunta` (`id_pregunta`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `encuesta`
--

LOCK TABLES `encuesta` WRITE;
/*!40000 ALTER TABLE `encuesta` DISABLE KEYS */;
/*!40000 ALTER TABLE `encuesta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opcion`
--

DROP TABLE IF EXISTS `opcion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `opcion` (
  `id_pregunta` int(8) DEFAULT NULL,
  `orden` int(2) DEFAULT NULL,
  `contenido` varchar(1000) DEFAULT NULL,
  `cantidad` int(8) DEFAULT NULL,
  KEY `id_pregunta` (`id_pregunta`),
  CONSTRAINT `opcion_ibfk_1` FOREIGN KEY (`id_pregunta`) REFERENCES `pregunta` (`id_pregunta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opcion`
--

LOCK TABLES `opcion` WRITE;
/*!40000 ALTER TABLE `opcion` DISABLE KEYS */;
/*!40000 ALTER TABLE `opcion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pregunta`
--

DROP TABLE IF EXISTS `pregunta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pregunta` (
  `id_pregunta` int(8) NOT NULL AUTO_INCREMENT,
  `Pregunta` varchar(1000) DEFAULT NULL,
  `id_encuesta` int(8) DEFAULT NULL,
  PRIMARY KEY (`id_pregunta`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pregunta`
--

LOCK TABLES `pregunta` WRITE;
/*!40000 ALTER TABLE `pregunta` DISABLE KEYS */;
/*!40000 ALTER TABLE `pregunta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo`
--

DROP TABLE IF EXISTS `tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo` (
  `id_Tipo` int(1) NOT NULL,
  `Nombre` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_Tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo`
--

LOCK TABLES `tipo` WRITE;
/*!40000 ALTER TABLE `tipo` DISABLE KEYS */;
INSERT INTO `tipo` VALUES (1,'Maestro'),(2,'Alumno'),(3,'Administra');
/*!40000 ALTER TABLE `tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id_usuario` varchar(200) NOT NULL,
  `numeroTrabajador` varchar(200) NOT NULL,
  `Nombre` varchar(200) DEFAULT NULL,
  `ApellidoP` varchar(200) DEFAULT NULL,
  `ApellidoM` varchar(200) DEFAULT NULL,
  `Tipo` int(1) DEFAULT NULL,
  `Correo` varchar(200) DEFAULT NULL,
  `Contrasena` varchar(200) DEFAULT NULL,
  `Cumple` varchar(200) DEFAULT NULL,
  `img` varchar(200) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `Tipo` (`Tipo`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`Tipo`) REFERENCES `tipo` (`id_Tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES ('DOAL0107235M8','','Luis','Dom','Av',3,'lolo3000024@me.com','P0150nbl4bl4.',NULL,'');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-06-27 18:57:05

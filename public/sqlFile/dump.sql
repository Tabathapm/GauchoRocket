-- MySQL dump 10.13  Distrib 8.0.22, for Win64 (x86_64)
--
-- Host: localhost    Database: web2
-- ------------------------------------------------------
-- Server version	8.0.22

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
-- Table structure for table `alojamiento`
--

DROP TABLE IF EXISTS `alojamiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alojamiento` (
  `id_alojamiento` int NOT NULL AUTO_INCREMENT,
  `cant_habitaciones` int DEFAULT NULL,
  `id_destino` int DEFAULT NULL,
  `nombreAlojamiento` varchar(40) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `fotoAlojamiento` varchar(20) DEFAULT NULL,
  `disponible` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_alojamiento`),
  KEY `id_destino` (`id_destino`),
  CONSTRAINT `alojamiento_ibfk_1` FOREIGN KEY (`id_destino`) REFERENCES `destino` (`id_destino`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alojamiento`
--

LOCK TABLES `alojamiento` WRITE;
/*!40000 ALTER TABLE `alojamiento` DISABLE KEYS */;
INSERT INTO `alojamiento` VALUES (1,4,1,'Hotel Wanderlust',50000,'alojamiento1.jpg',1),(2,3,2,'Hotel Yas',35000,'alojamiento2.jpg',1),(3,2,2,'Hotel Yas',2000,'alojamiento3.jpg',1),(4,4,3,'Hotel Henn na',60000,'alojamiento4.jpg',1),(5,1,4,'Iniala Beach House',2000,'alojamiento1.jpg',1),(6,2,4,'Iniala Beach House',4000,'alojamiento1.jpg',1),(7,3,4,'Iniala Beach House',55000,'alojamiento1.jpg',1),(8,4,4,'Iniala Beach House',70000,'alojamiento1.jpg',1);
/*!40000 ALTER TABLE `alojamiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asiento`
--

DROP TABLE IF EXISTS `asiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `asiento` (
  `id_asiento` int NOT NULL AUTO_INCREMENT,
  `fila` varchar(5) DEFAULT NULL,
  `descripcion` varchar(5) DEFAULT NULL,
  `disponible` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_asiento`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asiento`
--

LOCK TABLES `asiento` WRITE;
/*!40000 ALTER TABLE `asiento` DISABLE KEYS */;
INSERT INTO `asiento` VALUES (1,'A','A1',0),(2,'A','A2',1),(3,'A','A3',0),(4,'B','B1',0),(5,'B','B2',0),(6,'B','B3',1),(7,'C','C1',1),(8,'C','C2',0),(9,'C','C3',1),(10,'D','D1',0),(11,'D','D2',0),(12,'D','D3',0),(13,'A','A10',1),(14,'A','A11',0),(15,'A','A12',1),(16,'B','B10',1),(17,'B','B11',1),(18,'B','B12',1),(19,'C','C10',1),(20,'C','C11',1),(21,'C','C12',1),(22,'D','D10',1),(23,'D','D11',1),(24,'D','D12',0),(25,'A','A20',0),(26,'A','A21',0),(27,'A','A22',0),(28,'B','B20',0),(29,'B','B21',0),(30,'B','B22',0),(31,'C','C20',0),(32,'C','C21',0),(33,'C','C22',0),(34,'D','D20',0),(35,'D','D21',0),(36,'D','D22',0),(37,'A','A30',1),(38,'A','A31',1),(39,'A','A32',0),(40,'B','B30',0),(41,'B','B31',1),(42,'B','B32',1),(43,'C','C30',1),(44,'C','C31',0),(45,'C','C32',1),(46,'D','D30',1),(47,'D','D31',0),(48,'D','D32',0);
/*!40000 ALTER TABLE `asiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cabina`
--

DROP TABLE IF EXISTS `cabina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cabina` (
  `id_cabina` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_cabina`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cabina`
--

LOCK TABLES `cabina` WRITE;
/*!40000 ALTER TABLE `cabina` DISABLE KEYS */;
INSERT INTO `cabina` VALUES (1,'General'),(2,'Familiar'),(3,'Suite');
/*!40000 ALTER TABLE `cabina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `centro_medico`
--

DROP TABLE IF EXISTS `centro_medico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `centro_medico` (
  `id_centro_medico` int NOT NULL AUTO_INCREMENT,
  `nom_centro_medico` varchar(40) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_centro_medico`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `centro_medico`
--

LOCK TABLES `centro_medico` WRITE;
/*!40000 ALTER TABLE `centro_medico` DISABLE KEYS */;
INSERT INTO `centro_medico` VALUES (1,'Buenos Aires','BuenosAires.jpg'),(2,'Shanghai','Shanghai.jpg'),(3,'Ankara','Ankara.jpg');
/*!40000 ALTER TABLE `centro_medico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chequeo_medico`
--

DROP TABLE IF EXISTS `chequeo_medico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chequeo_medico` (
  `id_chequeo` int NOT NULL AUTO_INCREMENT,
  `resultadoNivelVuelo` int DEFAULT NULL,
  `id_centro_medico` int DEFAULT NULL,
  `turno` int DEFAULT NULL,
  PRIMARY KEY (`id_chequeo`),
  KEY `resultadoNivelVuelo` (`resultadoNivelVuelo`),
  KEY `turno` (`turno`),
  KEY `id_centro_medico` (`id_centro_medico`),
  CONSTRAINT `chequeo_medico_ibfk_1` FOREIGN KEY (`resultadoNivelVuelo`) REFERENCES `nivel_vuelo` (`id_nivel_vuelo`),
  CONSTRAINT `chequeo_medico_ibfk_2` FOREIGN KEY (`turno`) REFERENCES `turno` (`id_turno`),
  CONSTRAINT `chequeo_medico_ibfk_3` FOREIGN KEY (`id_centro_medico`) REFERENCES `centro_medico` (`id_centro_medico`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chequeo_medico`
--

LOCK TABLES `chequeo_medico` WRITE;
/*!40000 ALTER TABLE `chequeo_medico` DISABLE KEYS */;
INSERT INTO `chequeo_medico` VALUES (1,2,1,2);
/*!40000 ALTER TABLE `chequeo_medico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contiene_un`
--

DROP TABLE IF EXISTS `contiene_un`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contiene_un` (
  `id_cliente` int NOT NULL,
  `id_equipo` int NOT NULL,
  `id_nivel_vuelo` int DEFAULT NULL,
  PRIMARY KEY (`id_cliente`,`id_equipo`),
  KEY `id_equipo` (`id_equipo`),
  CONSTRAINT `contiene_un_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `contiene_un_ibfk_2` FOREIGN KEY (`id_equipo`) REFERENCES `equipo` (`id_equipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contiene_un`
--

LOCK TABLES `contiene_un` WRITE;
/*!40000 ALTER TABLE `contiene_un` DISABLE KEYS */;
/*!40000 ALTER TABLE `contiene_un` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contiene_una`
--

DROP TABLE IF EXISTS `contiene_una`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contiene_una` (
  `id_reserva` int NOT NULL,
  `id_lista_espera` int NOT NULL,
  PRIMARY KEY (`id_reserva`,`id_lista_espera`),
  KEY `id_lista_espera` (`id_lista_espera`),
  CONSTRAINT `contiene_una_ibfk_1` FOREIGN KEY (`id_reserva`) REFERENCES `reserva` (`id_reserva`),
  CONSTRAINT `contiene_una_ibfk_2` FOREIGN KEY (`id_lista_espera`) REFERENCES `lista_de_espera` (`id_lista_espera`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contiene_una`
--

LOCK TABLES `contiene_una` WRITE;
/*!40000 ALTER TABLE `contiene_una` DISABLE KEYS */;
/*!40000 ALTER TABLE `contiene_una` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `destino`
--

DROP TABLE IF EXISTS `destino`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `destino` (
  `id_destino` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(40) DEFAULT NULL,
  `foto` varchar(20) DEFAULT NULL,
  `id_escala` int DEFAULT NULL,
  `id_tour` int DEFAULT NULL,
  PRIMARY KEY (`id_destino`),
  KEY `id_escala` (`id_escala`),
  KEY `id_tour` (`id_tour`),
  CONSTRAINT `destino_ibfk_1` FOREIGN KEY (`id_escala`) REFERENCES `escala` (`id_escala`),
  CONSTRAINT `destino_ibfk_2` FOREIGN KEY (`id_tour`) REFERENCES `tour` (`id_tour`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `destino`
--

LOCK TABLES `destino` WRITE;
/*!40000 ALTER TABLE `destino` DISABLE KEYS */;
INSERT INTO `destino` VALUES (1,'Estacion Espacial Internacional','eei.jpg',NULL,NULL),(2,'OrbitelHotel','orbitel-hotel.jpg',NULL,NULL),(3,'Luna','luna.jpg',1,1),(4,'Marte','marte.jpg',2,NULL),(5,'Ganimedes','ganimedes.jpg',NULL,NULL),(6,'Europa','europa.jpg',3,1),(7,'Io','io.jpg',NULL,NULL),(8,'Titan','titan.jpg',NULL,NULL),(9,'Encedalo','encedalo.jpg',NULL,NULL);
/*!40000 ALTER TABLE `destino` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dia`
--

DROP TABLE IF EXISTS `dia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dia` (
  `id_dia` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_dia`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dia`
--

LOCK TABLES `dia` WRITE;
/*!40000 ALTER TABLE `dia` DISABLE KEYS */;
INSERT INTO `dia` VALUES (1,'Lunes'),(2,'Martes'),(3,'Miercoles'),(4,'Jueves'),(5,'Viernes'),(6,'Sabado'),(7,'Domingo');
/*!40000 ALTER TABLE `dia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresatarjeta`
--

DROP TABLE IF EXISTS `empresatarjeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empresatarjeta` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresatarjeta`
--

LOCK TABLES `empresatarjeta` WRITE;
/*!40000 ALTER TABLE `empresatarjeta` DISABLE KEYS */;
INSERT INTO `empresatarjeta` VALUES (1,'Visa'),(2,'Mastercard'),(3,'Naranja');
/*!40000 ALTER TABLE `empresatarjeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipo`
--

DROP TABLE IF EXISTS `equipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `equipo` (
  `id_equipo` int NOT NULL AUTO_INCREMENT,
  `tipo_equipo` int DEFAULT NULL,
  `nombre_equipo` varchar(20) DEFAULT NULL,
  `capacidad` int DEFAULT NULL,
  PRIMARY KEY (`id_equipo`),
  KEY `tipo_equipo` (`tipo_equipo`),
  CONSTRAINT `equipo_ibfk_1` FOREIGN KEY (`tipo_equipo`) REFERENCES `tipo_equipo` (`id_tipo_equipo`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipo`
--

LOCK TABLES `equipo` WRITE;
/*!40000 ALTER TABLE `equipo` DISABLE KEYS */;
INSERT INTO `equipo` VALUES (1,1,'Calandria',300),(2,1,'Colibri',120),(3,3,'Zorzal',100),(4,3,'Carancho',110),(5,3,'Aguilucho',60),(6,3,'Canario',80),(7,2,'Aguila',300),(8,2,'Condor',350),(9,2,'Halcon',200),(10,2,'Guanaco',100);
/*!40000 ALTER TABLE `equipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipo_tipo_cabina`
--

DROP TABLE IF EXISTS `equipo_tipo_cabina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `equipo_tipo_cabina` (
  `equipo` int NOT NULL,
  `tipo_cabina` int NOT NULL,
  `capacidad_cabina` int DEFAULT NULL,
  `nivel_vuelo` int NOT NULL,
  PRIMARY KEY (`equipo`,`tipo_cabina`,`nivel_vuelo`),
  KEY `tipo_cabina` (`tipo_cabina`),
  KEY `nivel_vuelo` (`nivel_vuelo`),
  CONSTRAINT `equipo_tipo_cabina_ibfk_1` FOREIGN KEY (`equipo`) REFERENCES `equipo` (`id_equipo`),
  CONSTRAINT `equipo_tipo_cabina_ibfk_2` FOREIGN KEY (`tipo_cabina`) REFERENCES `cabina` (`id_cabina`),
  CONSTRAINT `equipo_tipo_cabina_ibfk_3` FOREIGN KEY (`nivel_vuelo`) REFERENCES `nivel_vuelo` (`id_nivel_vuelo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipo_tipo_cabina`
--

LOCK TABLES `equipo_tipo_cabina` WRITE;
/*!40000 ALTER TABLE `equipo_tipo_cabina` DISABLE KEYS */;
INSERT INTO `equipo_tipo_cabina` VALUES (1,1,200,1),(1,1,200,2),(1,1,200,3),(1,2,75,1),(1,2,75,2),(1,2,75,3),(1,3,25,1),(1,3,25,2),(1,3,25,3),(2,1,100,1),(2,1,100,2),(2,1,100,3),(2,2,18,1),(2,2,18,2),(2,2,18,3),(2,3,2,1),(2,3,2,2),(2,3,2,3),(3,1,50,2),(3,1,50,3),(3,3,50,2),(3,3,50,3),(4,1,110,2),(4,1,110,3),(5,2,50,2),(5,2,50,3),(5,3,10,2),(5,3,10,3),(6,2,70,2),(6,2,70,3),(6,3,10,2),(6,3,10,3),(7,1,200,2),(7,1,200,3),(7,2,75,2),(7,2,75,3),(7,3,25,2),(7,3,25,3),(8,1,300,2),(8,1,300,3),(8,2,10,2),(8,2,10,3),(8,3,40,2),(8,3,40,3),(9,1,150,3),(9,2,25,3),(9,3,25,3),(10,3,100,3);
/*!40000 ALTER TABLE `equipo_tipo_cabina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `escala`
--

DROP TABLE IF EXISTS `escala`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `escala` (
  `id_escala` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_escala`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `escala`
--

LOCK TABLES `escala` WRITE;
/*!40000 ALTER TABLE `escala` DISABLE KEYS */;
INSERT INTO `escala` VALUES (1),(2),(3);
/*!40000 ALTER TABLE `escala` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lista_de_espera`
--

DROP TABLE IF EXISTS `lista_de_espera`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lista_de_espera` (
  `id_lista_espera` int NOT NULL,
  `horario` time DEFAULT NULL,
  PRIMARY KEY (`id_lista_espera`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lista_de_espera`
--

LOCK TABLES `lista_de_espera` WRITE;
/*!40000 ALTER TABLE `lista_de_espera` DISABLE KEYS */;
/*!40000 ALTER TABLE `lista_de_espera` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modelo_equipo`
--

DROP TABLE IF EXISTS `modelo_equipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `modelo_equipo` (
  `id_tipo_equipo` int NOT NULL AUTO_INCREMENT,
  `matricula` varchar(20) DEFAULT NULL,
  `equipo` int DEFAULT NULL,
  PRIMARY KEY (`id_tipo_equipo`),
  KEY `equipo` (`equipo`),
  CONSTRAINT `modelo_equipo_ibfk_1` FOREIGN KEY (`equipo`) REFERENCES `equipo` (`id_equipo`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modelo_equipo`
--

LOCK TABLES `modelo_equipo` WRITE;
/*!40000 ALTER TABLE `modelo_equipo` DISABLE KEYS */;
INSERT INTO `modelo_equipo` VALUES (1,'AA1',7),(2,'AA5',7),(3,'AA9',7),(4,'AA13',7),(5,'AA17',7),(6,'BA8',5),(7,'BA9',5),(8,'BA10',5),(9,'BA11',5),(10,'BA12',5),(11,'O1',1),(12,'O2',1),(13,'O6',1),(14,'O7',1),(15,'BA13',6),(16,'BA14',6),(17,'BA15',6),(18,'BA16',6),(19,'BA17',6),(20,'BA4',4),(21,'BA5',4),(22,'BA6',4),(23,'BA7',4),(24,'O3',2),(25,'O4',2),(26,'O5',2),(27,'O8',2),(28,'O9',2),(29,'AA2',8),(30,'AA6',8),(31,'AA10',8),(32,'AA14',8),(33,'AA18',8),(34,'AA4',10),(35,'AA8',10),(36,'AA12',10),(37,'AA16',10),(38,'AA3',9),(39,'AA7',9),(40,'AA11',9),(41,'AA15',9),(42,'AA19',9),(43,'BA1',3),(44,'BA2',3),(45,'BA3',3);
/*!40000 ALTER TABLE `modelo_equipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nivel_vuelo`
--

DROP TABLE IF EXISTS `nivel_vuelo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nivel_vuelo` (
  `id_nivel_vuelo` int NOT NULL AUTO_INCREMENT,
  `num_nivel` int DEFAULT NULL,
  PRIMARY KEY (`id_nivel_vuelo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nivel_vuelo`
--

LOCK TABLES `nivel_vuelo` WRITE;
/*!40000 ALTER TABLE `nivel_vuelo` DISABLE KEYS */;
INSERT INTO `nivel_vuelo` VALUES (1,1),(2,2),(3,3);
/*!40000 ALTER TABLE `nivel_vuelo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `origen`
--

DROP TABLE IF EXISTS `origen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `origen` (
  `id_origen` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(40) DEFAULT NULL,
  `foto` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_origen`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `origen`
--

LOCK TABLES `origen` WRITE;
/*!40000 ALTER TABLE `origen` DISABLE KEYS */;
INSERT INTO `origen` VALUES (1,'Buenos Aires','BuenosAires.jpg'),(2,'Ankara','Ankara.jpg');
/*!40000 ALTER TABLE `origen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pasaje`
--

DROP TABLE IF EXISTS `pasaje`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pasaje` (
  `id_pasaje` int NOT NULL AUTO_INCREMENT,
  `tarifa` double DEFAULT NULL,
  `cant_dias_en_espacio` int DEFAULT NULL,
  `id_viaje` int DEFAULT NULL,
  PRIMARY KEY (`id_pasaje`),
  KEY `id_viaje` (`id_viaje`),
  CONSTRAINT `pasaje_ibfk_1` FOREIGN KEY (`id_viaje`) REFERENCES `viaje` (`id_viaje`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pasaje`
--

LOCK TABLES `pasaje` WRITE;
/*!40000 ALTER TABLE `pasaje` DISABLE KEYS */;
/*!40000 ALTER TABLE `pasaje` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reserva`
--

DROP TABLE IF EXISTS `reserva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reserva` (
  `id_reserva` int NOT NULL AUTO_INCREMENT,
  `hora_reserva` varchar(20) DEFAULT NULL,
  `id_vuelo` int DEFAULT NULL,
  `id_tipo_servicio` int DEFAULT NULL,
  `id_cabina` int DEFAULT NULL,
  `id_usuario` int DEFAULT NULL,
  `id_alojamiento` int DEFAULT NULL,
  `id_viaje` int DEFAULT NULL,
  PRIMARY KEY (`id_reserva`),
  KEY `id_vuelo` (`id_vuelo`),
  KEY `id_cabina` (`id_cabina`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_tipo_servicio` (`id_tipo_servicio`),
  KEY `id_alojamiento` (`id_alojamiento`),
  KEY `id_viaje` (`id_viaje`),
  CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`id_vuelo`) REFERENCES `vuelo` (`id_vuelo`),
  CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`id_cabina`) REFERENCES `cabina` (`id_cabina`),
  CONSTRAINT `reserva_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `reserva_ibfk_4` FOREIGN KEY (`id_tipo_servicio`) REFERENCES `tipo_servicio_a_bordo` (`id_tipo_servicio`),
  CONSTRAINT `reserva_ibfk_5` FOREIGN KEY (`id_alojamiento`) REFERENCES `alojamiento` (`id_alojamiento`),
  CONSTRAINT `reserva_ibfk_6` FOREIGN KEY (`id_viaje`) REFERENCES `viaje` (`id_viaje`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reserva`
--

LOCK TABLES `reserva` WRITE;
/*!40000 ALTER TABLE `reserva` DISABLE KEYS */;
/*!40000 ALTER TABLE `reserva` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tarjeta_de_credito`
--

DROP TABLE IF EXISTS `tarjeta_de_credito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tarjeta_de_credito` (
  `id_tarjeta` int NOT NULL AUTO_INCREMENT,
  `nro_tarjeta` int DEFAULT NULL,
  `titular` varchar(20) DEFAULT NULL,
  `vencimientoMes` int DEFAULT NULL,
  `vencimientoAno` int DEFAULT NULL,
  `nom_tarjeta` int DEFAULT NULL,
  `cod_seguridad` int DEFAULT NULL,
  PRIMARY KEY (`id_tarjeta`),
  KEY `nom_tarjeta` (`nom_tarjeta`),
  CONSTRAINT `tarjeta_de_credito_ibfk_1` FOREIGN KEY (`nom_tarjeta`) REFERENCES `empresatarjeta` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tarjeta_de_credito`
--

LOCK TABLES `tarjeta_de_credito` WRITE;
/*!40000 ALTER TABLE `tarjeta_de_credito` DISABLE KEYS */;
/*!40000 ALTER TABLE `tarjeta_de_credito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_equipo`
--

DROP TABLE IF EXISTS `tipo_equipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_equipo` (
  `id_tipo_equipo` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_equipo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_equipo`
--

LOCK TABLES `tipo_equipo` WRITE;
/*!40000 ALTER TABLE `tipo_equipo` DISABLE KEYS */;
INSERT INTO `tipo_equipo` VALUES (1,'Orbital'),(2,'Alta Aceleracion'),(3,'Baja Aceleracion');
/*!40000 ALTER TABLE `tipo_equipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_servicio_a_bordo`
--

DROP TABLE IF EXISTS `tipo_servicio_a_bordo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_servicio_a_bordo` (
  `id_tipo_servicio` int NOT NULL AUTO_INCREMENT,
  `descripcion_tipo` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_servicio`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_servicio_a_bordo`
--

LOCK TABLES `tipo_servicio_a_bordo` WRITE;
/*!40000 ALTER TABLE `tipo_servicio_a_bordo` DISABLE KEYS */;
INSERT INTO `tipo_servicio_a_bordo` VALUES (1,'Standard'),(2,'Gourmet'),(3,'Spa');
/*!40000 ALTER TABLE `tipo_servicio_a_bordo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_viaje`
--

DROP TABLE IF EXISTS `tipo_viaje`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_viaje` (
  `id_tipo_viaje` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_viaje`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_viaje`
--

LOCK TABLES `tipo_viaje` WRITE;
/*!40000 ALTER TABLE `tipo_viaje` DISABLE KEYS */;
INSERT INTO `tipo_viaje` VALUES (1,'Suborbitales'),(2,'Orbitales'),(3,'Entre destinos');
/*!40000 ALTER TABLE `tipo_viaje` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tour`
--

DROP TABLE IF EXISTS `tour`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tour` (
  `id_tour` int NOT NULL AUTO_INCREMENT,
  `id_equipo` int DEFAULT NULL,
  `dia` int DEFAULT NULL,
  `duracion` varchar(10) DEFAULT NULL,
  `partida` int DEFAULT NULL,
  PRIMARY KEY (`id_tour`),
  KEY `id_equipo` (`id_equipo`),
  KEY `dia` (`dia`),
  KEY `partida` (`partida`),
  CONSTRAINT `tour_ibfk_1` FOREIGN KEY (`id_equipo`) REFERENCES `equipo` (`id_equipo`),
  CONSTRAINT `tour_ibfk_2` FOREIGN KEY (`dia`) REFERENCES `dia` (`id_dia`),
  CONSTRAINT `tour_ibfk_3` FOREIGN KEY (`partida`) REFERENCES `origen` (`id_origen`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tour`
--

LOCK TABLES `tour` WRITE;
/*!40000 ALTER TABLE `tour` DISABLE KEYS */;
INSERT INTO `tour` VALUES (1,10,7,'35 días',1);
/*!40000 ALTER TABLE `tour` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `turno`
--

DROP TABLE IF EXISTS `turno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `turno` (
  `id_turno` int NOT NULL AUTO_INCREMENT,
  `cant_turno` int DEFAULT NULL,
  `id_centro_medico` int DEFAULT NULL,
  `usuario` int DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `horario` varchar(10) DEFAULT NULL,
  `disponible` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_turno`),
  KEY `usuario` (`usuario`),
  KEY `id_centro_medico` (`id_centro_medico`),
  CONSTRAINT `turno_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `turno_ibfk_2` FOREIGN KEY (`id_centro_medico`) REFERENCES `centro_medico` (`id_centro_medico`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `turno`
--

LOCK TABLES `turno` WRITE;
/*!40000 ALTER TABLE `turno` DISABLE KEYS */;
INSERT INTO `turno` VALUES (1,300,1,NULL,'2021-11-10','14:30',1),(2,300,1,5,'2021-11-11','15:30',0),(3,300,1,NULL,'2021-11-12','16:30',1),(4,210,2,NULL,'2021-11-10','14:15',1),(5,210,2,NULL,'2021-11-11','15:15',1),(6,210,2,NULL,'2021-11-12','16:15',1),(7,200,3,NULL,'2021-11-10','14:00',1),(8,200,3,NULL,'2021-11-11','15:00',1),(9,200,3,NULL,'2021-11-12','16:00',1),(10,300,1,1,'2021-11-13','17:30',0);
/*!40000 ALTER TABLE `turno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `rol_usuario` varchar(15) DEFAULT NULL,
  `nombre_usuario` varchar(30) DEFAULT NULL,
  `apellido_usuario` varchar(30) DEFAULT NULL,
  `clave` varchar(32) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `hash` varchar(32) NOT NULL DEFAULT '0',
  `activo` int NOT NULL DEFAULT '0',
  `id_tarjeta` int DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `id_tarjeta` (`id_tarjeta`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_tarjeta`) REFERENCES `tarjeta_de_credito` (`id_tarjeta`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'ADMIN','Julieta','Barraza','202cb962ac59075b964b','admin1@admin.com','0',1,NULL),(2,'ADMIN','Leandro','Martinez','202cb962ac59075b964b','admin2@admin.com','0',1,NULL),(3,'ADMIN','Tabatha','Peralta','202cb962ac59075b964b','admin3@admin.com','0',1,NULL),(4,NULL,'Lea','Shaila','202cb962ac59075b964b','warhead.soad@gmail.com','0',1,NULL),(5,NULL,'Rocio','Rodriguez','202cb962ac59075b964b','julietabarraza21@gmail.com','0',1,NULL);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `viaje`
--

DROP TABLE IF EXISTS `viaje`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `viaje` (
  `id_viaje` int NOT NULL AUTO_INCREMENT,
  `id_tipo_viaje` int DEFAULT NULL,
  `f_partida` date DEFAULT NULL,
  `horario` varchar(20) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `dia` int DEFAULT NULL,
  `cant_vuelos` int DEFAULT NULL,
  `duracion` double DEFAULT NULL,
  `id_equipo` int DEFAULT NULL,
  `disponible` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_viaje`),
  KEY `dia` (`dia`),
  KEY `id_tipo_viaje` (`id_tipo_viaje`),
  KEY `id_equipo` (`id_equipo`),
  CONSTRAINT `viaje_ibfk_1` FOREIGN KEY (`dia`) REFERENCES `dia` (`id_dia`),
  CONSTRAINT `viaje_ibfk_2` FOREIGN KEY (`id_tipo_viaje`) REFERENCES `tipo_viaje` (`id_tipo_viaje`),
  CONSTRAINT `viaje_ibfk_3` FOREIGN KEY (`id_equipo`) REFERENCES `equipo` (`id_equipo`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `viaje`
--

LOCK TABLES `viaje` WRITE;
/*!40000 ALTER TABLE `viaje` DISABLE KEYS */;
INSERT INTO `viaje` VALUES (1,1,'2021-12-06','10:00 AM',2000,1,5,8,1,1),(2,1,'2021-12-06','10:45 AM',2000,1,5,8,1,1),(3,1,'2021-12-06','12:00 PM',2000,1,5,8,6,1),(4,1,'2021-12-06','03:30 PM',2000,1,5,8,6,1),(5,1,'2021-12-06','07:00 PM',2000,1,5,8,6,1),(6,1,'2021-12-07','10:20 AM',2000,2,5,8,1,1),(7,1,'2021-12-07','11:15 AM',2000,2,5,8,1,1),(8,1,'2021-12-07','03:50 PM',2000,2,5,8,6,1),(9,1,'2021-12-07','06:00 PM',2000,2,5,8,6,1),(10,1,'2021-12-07','08:00 PM',2000,2,5,8,1,1),(11,1,'2021-12-08','10:00 AM',2000,3,5,8,1,1),(12,1,'2021-12-08','07:30 AM',2000,3,5,8,1,1),(13,1,'2021-12-08','11:00 AM',2000,3,5,8,6,1),(14,1,'2021-12-08','01:00 PM',2000,3,5,8,6,1),(15,1,'2021-12-08','06:15 PM',2000,3,5,8,6,1),(16,1,'2021-12-09','10:00 AM',2000,4,5,8,1,1),(17,1,'2021-12-09','11:00 AM',2000,4,5,8,1,1),(18,1,'2021-12-09','03:00 PM',2000,4,5,8,6,1),(19,1,'2021-12-09','10:00 AM',2000,4,5,8,6,1),(20,1,'2021-12-09','11:15 AM',2000,4,5,8,6,1),(21,1,'2021-12-10','10:00 AM',2000,5,5,8,1,1),(22,1,'2021-12-10','10:50 AM',2000,5,5,8,1,1),(23,1,'2021-12-10','11:45 AM',2000,5,5,8,6,1),(24,1,'2021-12-10','02:00 PM',2000,5,5,8,6,1),(25,1,'2021-12-10','07:00 PM',2000,5,5,8,6,1),(26,1,'2021-12-06','01:00 PM',2000,6,8,8,1,1),(27,1,'2021-12-06','03:00 PM',2000,6,8,8,1,1),(28,1,'2021-12-06','01:00 PM',2000,6,8,8,6,1),(29,1,'2021-12-06','03:00 PM',2000,6,8,8,6,1),(30,1,'2021-12-06','01:00 PM',2000,6,8,8,6,1),(31,1,'2021-12-06','03:00 PM',2000,6,8,8,1,1),(32,1,'2021-12-06','01:00 PM',2000,6,8,8,1,1),(33,1,'2021-12-06','03:00 PM',2000,6,8,8,6,1),(34,1,'2021-12-07','01:00 PM',2000,7,10,8,1,1),(35,1,'2021-12-07','03:00 PM',2000,7,10,8,1,1),(36,1,'2021-12-07','01:00 PM',2000,7,10,8,6,1),(37,1,'2021-12-07','03:00 PM',2000,7,10,8,6,1),(38,1,'2021-12-07','03:15 PM',2000,7,10,8,6,1),(39,1,'2021-12-07','01:00 PM',2000,7,10,8,1,1),(40,1,'2021-12-07','03:00 PM',2000,7,10,8,1,1),(41,1,'2021-12-07','01:00 PM',2000,7,10,8,6,1),(42,1,'2021-12-07','03:00 PM',2000,7,10,8,6,1);
/*!40000 ALTER TABLE `viaje` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vuelo`
--

DROP TABLE IF EXISTS `vuelo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vuelo` (
  `id_vuelo` int NOT NULL AUTO_INCREMENT,
  `duracion` double DEFAULT NULL,
  `capacidad_vuelo` int DEFAULT NULL,
  `id_cabina` int DEFAULT NULL,
  `id_nivel_vuelo` int DEFAULT NULL,
  `id_viaje` int DEFAULT NULL,
  `id_asiento` int DEFAULT NULL,
  `vuelo_origen` int DEFAULT NULL,
  `vuelo_destino` int DEFAULT NULL,
  PRIMARY KEY (`id_vuelo`),
  KEY `id_cabina` (`id_cabina`),
  KEY `id_asiento` (`id_asiento`),
  KEY `vuelo_origen` (`vuelo_origen`),
  KEY `vuelo_destino` (`vuelo_destino`),
  KEY `id_nivel_vuelo` (`id_nivel_vuelo`),
  KEY `id_viaje` (`id_viaje`),
  CONSTRAINT `vuelo_ibfk_1` FOREIGN KEY (`id_cabina`) REFERENCES `cabina` (`id_cabina`),
  CONSTRAINT `vuelo_ibfk_2` FOREIGN KEY (`id_asiento`) REFERENCES `asiento` (`id_asiento`),
  CONSTRAINT `vuelo_ibfk_3` FOREIGN KEY (`vuelo_origen`) REFERENCES `origen` (`id_origen`),
  CONSTRAINT `vuelo_ibfk_4` FOREIGN KEY (`vuelo_destino`) REFERENCES `destino` (`id_destino`),
  CONSTRAINT `vuelo_ibfk_5` FOREIGN KEY (`id_nivel_vuelo`) REFERENCES `nivel_vuelo` (`id_nivel_vuelo`),
  CONSTRAINT `vuelo_ibfk_6` FOREIGN KEY (`id_viaje`) REFERENCES `viaje` (`id_viaje`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vuelo`
--

LOCK TABLES `vuelo` WRITE;
/*!40000 ALTER TABLE `vuelo` DISABLE KEYS */;
INSERT INTO `vuelo` VALUES (1,30,300,1,1,1,13,1,3),(2,30,300,1,1,2,14,1,3),(3,30,300,1,1,6,15,1,3),(4,30,300,1,1,14,16,1,3),(5,30,300,1,1,18,17,1,3),(6,30,300,1,1,3,18,1,3),(7,30,300,1,1,40,19,1,3),(8,30,300,1,1,41,20,1,3),(9,30,300,1,1,13,21,1,3),(10,30,300,1,1,3,22,1,3),(11,30,300,1,1,31,23,1,3),(12,30,300,1,1,15,24,1,3),(13,30,300,2,2,1,25,1,4),(14,30,300,2,2,5,26,1,4),(15,30,300,2,2,7,27,1,4),(16,30,300,2,2,23,28,1,4),(17,30,300,2,2,24,29,1,4),(18,30,300,2,2,23,30,1,4),(19,30,300,2,2,6,31,1,4),(20,30,300,2,2,31,32,1,4),(21,30,300,2,2,9,33,1,4),(22,30,300,2,2,3,34,1,4),(23,30,300,2,2,8,35,1,4),(24,30,300,2,2,42,36,1,4),(25,30,300,3,3,1,NULL,2,6),(26,26,120,1,1,1,NULL,2,9),(27,26,120,2,2,5,1,1,2),(28,26,120,2,2,8,2,1,2),(29,26,120,2,2,1,3,1,2),(30,26,120,2,2,6,4,1,2),(31,26,120,2,2,34,5,1,2),(32,26,120,2,2,28,6,1,2),(33,26,120,2,2,30,7,1,2),(34,26,120,2,2,17,8,1,2),(35,26,120,2,2,29,9,1,2),(36,26,120,2,2,22,10,1,2),(37,26,120,2,2,31,11,1,2),(38,26,120,2,2,20,12,1,2),(39,26,120,3,3,18,37,2,5),(40,26,120,3,3,14,38,2,5),(41,26,120,3,3,12,39,2,5),(42,26,120,3,3,10,40,2,5),(43,26,120,3,3,21,41,2,5),(44,26,120,3,3,31,42,2,5),(45,26,120,3,3,19,43,2,5),(46,26,120,3,3,41,44,2,5),(47,26,120,3,3,34,45,2,5),(48,26,120,3,3,25,46,2,5),(49,26,120,3,3,5,47,2,5),(50,26,120,3,3,10,48,2,5);
/*!40000 ALTER TABLE `vuelo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-30 17:05:24

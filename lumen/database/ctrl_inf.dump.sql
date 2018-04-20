-- MySQL dump 10.13  Distrib 5.7.19, for Linux (x86_64)
--
-- Host: 10.0.0.100    Database: eventos
-- ------------------------------------------------------
-- Server version	5.6.27-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `eventos`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `eventos` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `eventos`;

--
-- Table structure for table `eventos`
--

DROP TABLE IF EXISTS `eventos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eventos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_id_usuario` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `data` date NOT NULL,
  `abertura_portoes` varchar(45) NOT NULL,
  `local` varchar(50) NOT NULL,
  `produtor_responsavel` varchar(50) NOT NULL,
  `status` set('Confirmado','À confirmar','Realizado') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_evento_usuario1_idx` (`fk_id_usuario`),
  CONSTRAINT `fk_evento_usuario1` FOREIGN KEY (`fk_id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eventos`
--

LOCK TABLES `eventos` WRITE;
/*!40000 ALTER TABLE `eventos` DISABLE KEYS */;
INSERT INTO `eventos` VALUES (1,1,'Evento teste','Goiânia','GO','2017-07-26','12:00','Serra dourada','Fulano','Confirmado'),(2,1,'Evento teste 2','aasd','sa','2017-07-25','12:00','sdfas','adsf','Confirmado'),(3,1,'Evento teste 3','aasd','sa','2017-07-25','12:00','sdfas','adsf','Confirmado'),(4,1,'Evento teste 4','aasd','sa','2017-07-25','12:00','sdfas','adsf','Confirmado'),(5,1,'teste aldksjf asdfj','Belo Horizonte','MG','2017-11-12','18:00','Ginásio Mineirinho','macarrão','À confirmar'),(6,1,'novo evento','rio de janeiro','RJ','2017-09-15','15:00','maracanazinho','romário','À confirmar'),(7,1,'new event','São Paulo','SP','2017-08-22','09:00','Palestra','paulistinha','Confirmado');
/*!40000 ALTER TABLE `eventos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `topicos`
--

DROP TABLE IF EXISTS `topicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `topicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_id_evento` int(11) NOT NULL,
  `fk_id_usuario` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `texto` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_topico_evento1_idx` (`fk_id_evento`),
  KEY `fk_topico_usuario1_idx` (`fk_id_usuario`),
  CONSTRAINT `fk_topico_evento1` FOREIGN KEY (`fk_id_evento`) REFERENCES `eventos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_topico_usuario1` FOREIGN KEY (`fk_id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topicos`
--

LOCK TABLES `topicos` WRITE;
/*!40000 ALTER TABLE `topicos` DISABLE KEYS */;
INSERT INTO `topicos` VALUES (1,4,1,'novo tópicoad ad f','aaa texto do novo tópico texto do novo tópico texto do novo tópico texto do novo tópico texto do novo tópico texto do novo tópico texto do novo tópico texto do novo tópico texto do novo tópico texto do novo tópico texto do novo tópico');
/*!40000 ALTER TABLE `topicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `login` varchar(45) NOT NULL,
  `senha` varchar(128) NOT NULL,
  `email` varchar(50) NOT NULL,
  `permissao` set('Escrita','Leitura') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuarios_login_un` (`login`),
  UNIQUE KEY `usuarios_email_un` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Fernando Pedro','fernando1','$2y$10$0Y2zaYz8OL0A0x9YZBhLYejYpiDlRSxZBeeZg9wqawtvZqYaO9w.W','fernandopedro@gmail.com','Escrita'),(6,'teste','fernando','$2y$10$gIUXJLKowGPHZDZq64/Yf.J1S41u5dbwX6rAUky4x1qNNcTAOQPqy','fredcido@gmail.com','Leitura'),(7,'sdfadf','asdff','$2y$10$JU.CPYWQJBrrBB99jPuBpeaaoSx.6Oj7CXVS.NyT.fgMiSFv2NCpy','milenasousa@gmail.com','Leitura'),(9,'asdfasdfsad','teste','$2y$10$cALPpQURNiRQJaxqfzTPq.rKptAxDkhAud7MDGXYhwOqrgCrvv5BK','fernandope1dro@gmail.com','Leitura'),(12,'asdf','teste1','$2y$10$DmkilXAeO9vKIB.qjGdz8eB5lhYsRz/3GvrAaIG2l8E1/q.lQVfHa','francirrenio@gmail.com','Leitura');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-27 11:04:52

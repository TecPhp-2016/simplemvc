drop database application; create database application; use application;

DROP TABLE IF EXISTS `agentes`;
CREATE TABLE `agentes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `clave` varchar(512) NOT NULL,
  `admin` tinyint(1) DEFAULT 0,
  `bloqueado` tinyint(1) DEFAULT 0,
  `email` varchar(255) NOT NULL,
  `jornada_laboral` varchar(255) NOT NULL,
  `imagen` varchar(255) NULL,
  `online` tinyint(1) DEFAULT 0,
  `no_disponible` tinyint(1) DEFAULT 0,
  `no_disponible_fecha` TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `formularios`;
CREATE TABLE `formularios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `correo` varchar(256) NOT NULL,
  `asunto` varchar(256) NULL,
  `consulta` text NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `consultas`;
CREATE TABLE `consultas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agente_id` varchar(256) NOT NULL,
  `estado` varchar(256) NULL,
  `usuario` varchar(256) NULL,
  `creado` TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`agente_id`) REFERENCES agentes(`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `mensajes`;
CREATE TABLE `mensajes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `autor` varchar(256) NULL,
  `consulta_id` int(11) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha` TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`consulta_id`) REFERENCES agentes(`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
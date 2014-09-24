# Host: localhost  (Version: 5.6.12-log)
# Date: 2014-09-24 18:02:07
# Generator: MySQL-Front 5.3  (Build 4.122)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "cruge_authitem"
#
SET FOREIGN_KEY_CHECKS=0;
CREATE TABLE `cruge_authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "cruge_authitem"
#


#
# Structure for table "cruge_authitemchild"
#

CREATE TABLE `cruge_authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `crugeauthitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `cruge_authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `crugeauthitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `cruge_authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "cruge_authitemchild"
#


#
# Structure for table "cruge_field"
#

CREATE TABLE `cruge_field` (
  `idfield` int(11) NOT NULL AUTO_INCREMENT,
  `fieldname` varchar(20) NOT NULL,
  `longname` varchar(50) DEFAULT NULL,
  `position` int(11) DEFAULT '0',
  `required` int(11) DEFAULT '0',
  `fieldtype` int(11) DEFAULT '0',
  `fieldsize` int(11) DEFAULT '20',
  `maxlength` int(11) DEFAULT '45',
  `showinreports` int(11) DEFAULT '0',
  `useregexp` varchar(512) DEFAULT NULL,
  `useregexpmsg` varchar(512) DEFAULT NULL,
  `predetvalue` mediumblob,
  PRIMARY KEY (`idfield`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "cruge_field"
#


#
# Structure for table "cruge_session"
#

CREATE TABLE `cruge_session` (
  `idsession` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) NOT NULL,
  `created` bigint(30) DEFAULT NULL,
  `expire` bigint(30) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `ipaddress` varchar(45) DEFAULT NULL,
  `usagecount` int(11) DEFAULT '0',
  `lastusage` bigint(30) DEFAULT NULL,
  `logoutdate` bigint(30) DEFAULT NULL,
  `ipaddressout` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idsession`),
  KEY `crugesession_iduser` (`iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "cruge_session"
#


#
# Structure for table "cruge_system"
#

CREATE TABLE `cruge_system` (
  `idsystem` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `largename` varchar(45) DEFAULT NULL,
  `sessionmaxdurationmins` int(11) DEFAULT '30',
  `sessionmaxsameipconnections` int(11) DEFAULT '10',
  `sessionreusesessions` int(11) DEFAULT '1' COMMENT '1yes 0no',
  `sessionmaxsessionsperday` int(11) DEFAULT '-1',
  `sessionmaxsessionsperuser` int(11) DEFAULT '-1',
  `systemnonewsessions` int(11) DEFAULT '0' COMMENT '1yes 0no',
  `systemdown` int(11) DEFAULT '0',
  `registerusingcaptcha` int(11) DEFAULT '0',
  `registerusingterms` int(11) DEFAULT '0',
  `terms` blob,
  `registerusingactivation` int(11) DEFAULT '1',
  `defaultroleforregistration` varchar(64) DEFAULT NULL,
  `registerusingtermslabel` varchar(100) DEFAULT NULL,
  `registrationonlogin` int(11) DEFAULT '1',
  PRIMARY KEY (`idsystem`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Data for table "cruge_system"
#

INSERT INTO `cruge_system` VALUES (1,'default',NULL,30,10,1,-1,-1,0,0,0,0,X'',0,'','',1);

#
# Structure for table "cruge_user"
#

CREATE TABLE `cruge_user` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `regdate` bigint(30) DEFAULT NULL,
  `actdate` bigint(30) DEFAULT NULL,
  `logondate` bigint(30) DEFAULT NULL,
  `username` varchar(64) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL COMMENT 'Hashed password',
  `authkey` varchar(100) DEFAULT NULL COMMENT 'llave de autentificacion',
  `state` int(11) DEFAULT '0',
  `totalsessioncounter` int(11) DEFAULT '0',
  `currentsessioncounter` int(11) DEFAULT '0',
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

#
# Data for table "cruge_user"
#

INSERT INTO `cruge_user` VALUES (1,NULL,NULL,NULL,'admin','admin@tucorreo.com','admin',NULL,1,0,0),(2,NULL,NULL,NULL,'invitado','invitado','nopassword',NULL,1,0,0);

#
# Structure for table "cruge_fieldvalue"
#

CREATE TABLE `cruge_fieldvalue` (
  `idfieldvalue` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) NOT NULL,
  `idfield` int(11) NOT NULL,
  `value` blob,
  PRIMARY KEY (`idfieldvalue`),
  KEY `fk_cruge_fieldvalue_cruge_user1` (`iduser`),
  KEY `fk_cruge_fieldvalue_cruge_field1` (`idfield`),
  CONSTRAINT `fk_cruge_fieldvalue_cruge_user1` FOREIGN KEY (`iduser`) REFERENCES `cruge_user` (`iduser`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_cruge_fieldvalue_cruge_field1` FOREIGN KEY (`idfield`) REFERENCES `cruge_field` (`idfield`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "cruge_fieldvalue"
#


#
# Structure for table "cruge_authassignment"
#

CREATE TABLE `cruge_authassignment` (
  `userid` int(11) NOT NULL,
  `bizrule` text,
  `data` text,
  `itemname` varchar(64) NOT NULL,
  PRIMARY KEY (`userid`,`itemname`),
  KEY `fk_cruge_authassignment_cruge_authitem1` (`itemname`),
  KEY `fk_cruge_authassignment_user` (`userid`),
  CONSTRAINT `fk_cruge_authassignment_cruge_authitem1` FOREIGN KEY (`itemname`) REFERENCES `cruge_authitem` (`name`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cruge_authassignment_user` FOREIGN KEY (`userid`) REFERENCES `cruge_user` (`iduser`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "cruge_authassignment"
#


#
# Structure for table "elenco_representante"
#

CREATE TABLE `elenco_representante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) DEFAULT NULL,
  `nombre` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "elenco_representante"
#


#
# Structure for table "elenco"
#

CREATE TABLE `elenco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text,
  `estado` enum('ACTIVO','INACTIVO') NOT NULL DEFAULT 'ACTIVO',
  `elenco_representante_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_elenco_elenco_representante1_idx` (`elenco_representante_id`),
  CONSTRAINT `fk_elenco_elenco_representante1` FOREIGN KEY (`elenco_representante_id`) REFERENCES `elenco_representante` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "elenco"
#


#
# Structure for table "elenco_multimedia"
#

CREATE TABLE `elenco_multimedia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ubicacion` text NOT NULL,
  `local` tinyint(4) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `menu` tinyint(4) NOT NULL DEFAULT '0',
  `encabezado` tinyint(4) NOT NULL DEFAULT '0',
  `elenco_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_elenco_multimedia_elenco1_idx` (`elenco_id`),
  CONSTRAINT `fk_elenco_multimedia_elenco1` FOREIGN KEY (`elenco_id`) REFERENCES `elenco` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "elenco_multimedia"
#


#
# Structure for table "escenario"
#

CREATE TABLE `escenario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `teatro_sucre` tinyint(4) NOT NULL DEFAULT '1',
  `ubicacion` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `estado` enum('ACTIVO','INACTIVO') NOT NULL DEFAULT 'ACTIVO',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "escenario"
#


#
# Structure for table "escenario_multimedia"
#

CREATE TABLE `escenario_multimedia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ubicacion` text NOT NULL,
  `local` tinyint(4) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `escenario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_escenario_multimedia_escenario1_idx` (`escenario_id`),
  CONSTRAINT `fk_escenario_multimedia_escenario1` FOREIGN KEY (`escenario_id`) REFERENCES `escenario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "escenario_multimedia"
#


#
# Structure for table "escenario_taquilla"
#

CREATE TABLE `escenario_taquilla` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `escenario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_escenario_taquilla_escenario1_idx` (`escenario_id`),
  CONSTRAINT `fk_escenario_taquilla_escenario1` FOREIGN KEY (`escenario_id`) REFERENCES `escenario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "escenario_taquilla"
#


#
# Structure for table "escenario_taquilla_seccion"
#

CREATE TABLE `escenario_taquilla_seccion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `escenario_taquilla_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_escenario_taquilla_seccion_escenario_taquilla1_idx` (`escenario_taquilla_id`),
  CONSTRAINT `fk_escenario_taquilla_seccion_escenario_taquilla1` FOREIGN KEY (`escenario_taquilla_id`) REFERENCES `escenario_taquilla` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "escenario_taquilla_seccion"
#


#
# Structure for table "evento_autor"
#

CREATE TABLE `evento_autor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) NOT NULL,
  `descripcion` text,
  `imagen` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "evento_autor"
#


#
# Structure for table "evento_categoria"
#

CREATE TABLE `evento_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `estado` enum('ACTIVO','INACTIVO') NOT NULL DEFAULT 'ACTIVO',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "evento_categoria"
#


#
# Structure for table "evento"
#

CREATE TABLE `evento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text,
  `evento_autor_id` int(11) NOT NULL,
  `evento_categoria_id` int(11) NOT NULL,
  `estado` enum('ACTIVO','INACTIVO') NOT NULL DEFAULT 'ACTIVO',
  PRIMARY KEY (`id`),
  KEY `fk_evento_evento_autor_idx` (`evento_autor_id`),
  KEY `fk_evento_evento_categoria1_idx` (`evento_categoria_id`),
  CONSTRAINT `fk_evento_evento_autor` FOREIGN KEY (`evento_autor_id`) REFERENCES `evento_autor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_evento_evento_categoria1` FOREIGN KEY (`evento_categoria_id`) REFERENCES `evento_categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "evento"
#


#
# Structure for table "evento_fecha"
#

CREATE TABLE `evento_fecha` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `evento_id` int(11) NOT NULL,
  `escenario_id` int(11) NOT NULL,
  `mostrar_ubicacion` tinyint(4) NOT NULL DEFAULT '1',
  `estado` enum('ACTIVO','INACTIVO') NOT NULL DEFAULT 'ACTIVO',
  PRIMARY KEY (`id`),
  KEY `fk_evento_fecha_evento1_idx` (`evento_id`),
  KEY `fk_evento_fecha_escenario1_idx` (`escenario_id`),
  CONSTRAINT `fk_evento_fecha_evento1` FOREIGN KEY (`evento_id`) REFERENCES `evento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_evento_fecha_escenario1` FOREIGN KEY (`escenario_id`) REFERENCES `escenario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "evento_fecha"
#


#
# Structure for table "evento_multimedia"
#

CREATE TABLE `evento_multimedia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `direccion` text NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `local` tinyint(4) NOT NULL DEFAULT '1',
  `evento_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_evento_multimedia_evento1_idx` (`evento_id`),
  CONSTRAINT `fk_evento_multimedia_evento1` FOREIGN KEY (`evento_id`) REFERENCES `evento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "evento_multimedia"
#


#
# Structure for table "evento_precio_taquilla"
#

CREATE TABLE `evento_precio_taquilla` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `precio` float NOT NULL,
  `cantidad` int(11) NOT NULL,
  `evento_fecha_id` int(11) NOT NULL,
  `escenario_taquilla_seccion_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_evento_precio_taquilla_evento_fecha1_idx` (`evento_fecha_id`),
  KEY `fk_evento_precio_taquilla_escenario_taquilla_seccion1_idx` (`escenario_taquilla_seccion_id`),
  CONSTRAINT `fk_evento_precio_taquilla_evento_fecha1` FOREIGN KEY (`evento_fecha_id`) REFERENCES `evento_fecha` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_evento_precio_taquilla_escenario_taquilla_seccion1` FOREIGN KEY (`escenario_taquilla_seccion_id`) REFERENCES `escenario_taquilla_seccion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "evento_precio_taquilla"
#


#
# Structure for table "produccion_categoria"
#

CREATE TABLE `produccion_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "produccion_categoria"
#


#
# Structure for table "produccion"
#

CREATE TABLE `produccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text,
  `estado` enum('ACTIVO','INACTIVO') NOT NULL DEFAULT 'ACTIVO',
  `escenario_id` int(11) NOT NULL,
  `produccion_categoria_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_produccion_escenario1_idx` (`escenario_id`),
  KEY `fk_produccion_produccion_categoria1_idx` (`produccion_categoria_id`),
  CONSTRAINT `fk_produccion_escenario1` FOREIGN KEY (`escenario_id`) REFERENCES `escenario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_produccion_produccion_categoria1` FOREIGN KEY (`produccion_categoria_id`) REFERENCES `produccion_categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "produccion"
#


#
# Structure for table "produccion_multimedia"
#

CREATE TABLE `produccion_multimedia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ubicacion` text NOT NULL,
  `local` tinyint(4) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `menu` tinyint(4) NOT NULL DEFAULT '0',
  `encabezado` tinyint(4) NOT NULL DEFAULT '0',
  `produccion_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_produccion_multimedia_produccion1_idx` (`produccion_id`),
  CONSTRAINT `fk_produccion_multimedia_produccion1` FOREIGN KEY (`produccion_id`) REFERENCES `produccion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "produccion_multimedia"
#


#
# Structure for table "proyecto"
#

CREATE TABLE `proyecto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text,
  `estado` enum('ACTIVO','INACTIVO') NOT NULL DEFAULT 'ACTIVO',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "proyecto"
#


#
# Structure for table "proyecto_multimedia"
#

CREATE TABLE `proyecto_multimedia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ubicacion` text NOT NULL,
  `local` tinyint(4) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `menu` tinyint(4) NOT NULL DEFAULT '0',
  `encabezado` tinyint(4) NOT NULL DEFAULT '0',
  `proyecto_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_proyecto_multimedia_proyecto1_idx` (`proyecto_id`),
  CONSTRAINT `fk_proyecto_multimedia_proyecto1` FOREIGN KEY (`proyecto_id`) REFERENCES `proyecto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET FOREIGN_KEY_CHECKS=1;
#
# Data for table "proyecto_multimedia"
#


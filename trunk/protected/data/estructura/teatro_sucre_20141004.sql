-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 04-10-2014 a las 18:27:36
-- Versión del servidor: 5.6.12-log
-- Versión de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- --------------------------------------------------------
CREATE TABLE `cruge_system` (
  `idsystem` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL ,
  `largename` VARCHAR(45) NULL ,
  `sessionmaxdurationmins` INT(11) NULL DEFAULT 30 ,
  `sessionmaxsameipconnections` INT(11) NULL DEFAULT 10 ,
  `sessionreusesessions` INT(11) NULL DEFAULT 1 COMMENT '1yes 0no' ,
  `sessionmaxsessionsperday` INT(11) NULL DEFAULT -1 ,
  `sessionmaxsessionsperuser` INT(11) NULL DEFAULT -1 ,
  `systemnonewsessions` INT(11) NULL DEFAULT 0 COMMENT '1yes 0no' ,
  `systemdown` INT(11) NULL DEFAULT 0 ,
  `registerusingcaptcha` INT(11) NULL DEFAULT 0 ,
  `registerusingterms` INT(11) NULL DEFAULT 0 ,
  `terms` BLOB NULL ,
  `registerusingactivation` INT(11) NULL DEFAULT 1 ,
  `defaultroleforregistration` VARCHAR(64) NULL ,
  `registerusingtermslabel` VARCHAR(100) NULL ,
  `registrationonlogin` INT(11) NULL DEFAULT 1 ,
  PRIMARY KEY (`idsystem`) )
ENGINE = InnoDB;


CREATE TABLE `cruge_session` (
  `idsession` INT NOT NULL AUTO_INCREMENT ,
  `iduser` INT NOT NULL ,
  `created` BIGINT(30) NULL ,
  `expire` BIGINT(30) NULL ,
  `status` INT(11) NULL DEFAULT 0 ,
  `ipaddress` VARCHAR(45) NULL ,
  `usagecount` INT(11) NULL DEFAULT 0 ,
  `lastusage` BIGINT(30) NULL ,
  `logoutdate` BIGINT(30) NULL ,
  `ipaddressout` VARCHAR(45) NULL ,
  PRIMARY KEY (`idsession`) ,
  INDEX `crugesession_iduser` (`iduser` ASC) )
ENGINE = InnoDB;

CREATE  TABLE `cruge_user` (
  `iduser` INT NOT NULL AUTO_INCREMENT ,
  `regdate` BIGINT(30) NULL ,
  `actdate` BIGINT(30) NULL ,
  `logondate` BIGINT(30) NULL ,
  `username` VARCHAR(64) NULL ,
  `email` VARCHAR(45) NULL ,
  `password` VARCHAR(64) NULL COMMENT 'Hashed password' ,
  `authkey` VARCHAR(100) NULL COMMENT 'llave de autentificacion' ,
  `state` INT(11) NULL DEFAULT 0 ,
  `totalsessioncounter` INT(11) NULL DEFAULT 0 ,
  `currentsessioncounter` INT(11) NULL DEFAULT 0 ,
  PRIMARY KEY (`iduser`) )
ENGINE = InnoDB;

delete from `cruge_user`;
ALTER TABLE `cruge_user` AUTO_INCREMENT = 1;
insert into `cruge_user`(username, email, password, state) values
 ('admin', 'admin@tucorreo.com','admin',1)
 ,('invitado', 'invitado','nopassword',1)
;
ALTER TABLE `cruge_user` AUTO_INCREMENT = 10;
delete from `cruge_system`;
INSERT INTO `cruge_system` (`idsystem`,`name`,`largename`,`sessionmaxdurationmins`,`sessionmaxsameipconnections`,`sessionreusesessions`,`sessionmaxsessionsperday`,`sessionmaxsessionsperuser`,`systemnonewsessions`,`systemdown`,`registerusingcaptcha`,`registerusingterms`,`terms`,`registerusingactivation`,`defaultroleforregistration`,`registerusingtermslabel`,`registrationonlogin`) VALUES
 (1,'default',NULL,1000,10,1,-1,-1,0,0,0,0,'',0,'','',1);



CREATE  TABLE `cruge_field` (
  `idfield` INT NOT NULL AUTO_INCREMENT ,
  `fieldname` VARCHAR(20) NOT NULL ,
  `longname` VARCHAR(50) NULL ,
  `position` INT(11) NULL DEFAULT 0 ,
  `required` INT(11) NULL DEFAULT 0 ,
  `fieldtype` INT(11) NULL DEFAULT 0 ,
  `fieldsize` INT(11) NULL DEFAULT 20 ,
  `maxlength` INT(11) NULL DEFAULT 45 ,
  `showinreports` INT(11) NULL DEFAULT 0 ,
  `useregexp` VARCHAR(512) NULL ,
  `useregexpmsg` VARCHAR(512) NULL ,
  `predetvalue` MEDIUMBLOB NULL ,
  PRIMARY KEY (`idfield`) )
ENGINE = InnoDB;

CREATE  TABLE `cruge_fieldvalue` (
  `idfieldvalue` INT NOT NULL AUTO_INCREMENT ,
  `iduser` INT NOT NULL ,
  `idfield` INT NOT NULL ,
  `value` BLOB NULL ,
  PRIMARY KEY (`idfieldvalue`) ,
  INDEX `fk_cruge_fieldvalue_cruge_user1` (`iduser` ASC) ,
  INDEX `fk_cruge_fieldvalue_cruge_field1` (`idfield` ASC) ,
  CONSTRAINT `fk_cruge_fieldvalue_cruge_user1`
    FOREIGN KEY (`iduser` )
    REFERENCES `cruge_user` (`iduser` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cruge_fieldvalue_cruge_field1`
    FOREIGN KEY (`idfield` )
    REFERENCES `cruge_field` (`idfield` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE `cruge_authitem` (
  `name` VARCHAR(64) NOT NULL ,
  `type` INT(11) NOT NULL ,
  `description` TEXT NULL DEFAULT NULL ,
  `bizrule` TEXT NULL DEFAULT NULL ,
  `data` TEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`name`) )
ENGINE = InnoDB;

CREATE TABLE `cruge_authassignment` (
  `userid` INT NOT NULL ,
  `bizrule` TEXT NULL DEFAULT NULL ,
  `data` TEXT NULL DEFAULT NULL ,
  `itemname` VARCHAR(64) NOT NULL ,
  PRIMARY KEY (`userid`, `itemname`) ,
  INDEX `fk_cruge_authassignment_cruge_authitem1` (`itemname` ASC) ,
  INDEX `fk_cruge_authassignment_user` (`userid` ASC) ,
  CONSTRAINT `fk_cruge_authassignment_cruge_authitem1`
    FOREIGN KEY (`itemname` )
    REFERENCES `cruge_authitem` (`name` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cruge_authassignment_user`
    FOREIGN KEY (`userid` )
    REFERENCES `cruge_user` (`iduser` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE `cruge_authitemchild` (
  `parent` VARCHAR(64) NOT NULL ,
  `child` VARCHAR(64) NOT NULL ,
  PRIMARY KEY (`parent`, `child`) ,
  INDEX `child` (`child` ASC) ,
  CONSTRAINT `crugeauthitemchild_ibfk_1`
    FOREIGN KEY (`parent` )
    REFERENCES `cruge_authitem` (`name` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `crugeauthitemchild_ibfk_2`
    FOREIGN KEY (`child` )
    REFERENCES `cruge_authitem` (`name` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;
--
-- Estructura de tabla para la tabla `elenco`
--

CREATE TABLE `elenco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text,
  `estado` enum('ACTIVO','INACTIVO') NOT NULL DEFAULT 'ACTIVO',
  `elenco_representante_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_elenco_elenco_representante1_idx` (`elenco_representante_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elenco_multimedia`
--

CREATE TABLE `elenco_multimedia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ubicacion` text NOT NULL,
  `local` tinyint(4) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `menu` tinyint(4) NOT NULL,
  `encabezado` tinyint(4) NOT NULL,
  `elenco_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_elenco_multimedia_elenco1_idx` (`elenco_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elenco_representante`
--

CREATE TABLE `elenco_representante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) DEFAULT NULL,
  `nombre` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escenario`
--

CREATE TABLE `escenario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `teatro_sucre` tinyint(4) NOT NULL DEFAULT '0',
  `ubicacion` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `estado` enum('ACTIVO','INACTIVO') NOT NULL DEFAULT 'ACTIVO',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escenario_multimedia`
--

CREATE TABLE `escenario_multimedia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ubicacion` text NOT NULL,
  `local` tinyint(4) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `escenario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_escenario_multimedia_escenario1_idx` (`escenario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escenario_taquilla`
--

CREATE TABLE `escenario_taquilla` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `escenario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_escenario_taquilla_escenario1_idx` (`escenario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escenario_taquilla_seccion`
--

CREATE TABLE `escenario_taquilla_seccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `escenario_taquilla_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_escenario_taquilla_seccion_escenario_taquilla1_idx` (`escenario_taquilla_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text,
  `evento_autor_id` int(11) NOT NULL,
  `evento_categoria_id` int(11) NOT NULL,
  `estado` enum('ACTIVO','INACTIVO') NOT NULL DEFAULT 'ACTIVO',
  `elenco_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_evento_evento_categoria1_idx` (`evento_categoria_id`),
  KEY `fk_evento_elenco1_idx` (`elenco_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento_categoria`
--

CREATE TABLE `evento_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `estado` enum('ACTIVO','INACTIVO') NOT NULL DEFAULT 'ACTIVO',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento_fecha`
--

CREATE TABLE `evento_fecha` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `evento_id` int(11) NOT NULL,
  `escenario_id` int(11) NOT NULL,
  `mostrar_ubicacion` tinyint(4) NOT NULL DEFAULT '0',
  `estado` enum('ACTIVO','INACTIVO') NOT NULL DEFAULT 'ACTIVO',
  PRIMARY KEY (`id`),
  KEY `fk_evento_fecha_evento1_idx` (`evento_id`),
  KEY `fk_evento_fecha_escenario1_idx` (`escenario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento_multimedia`
--

CREATE TABLE `evento_multimedia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `direccion` text NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `local` tinyint(4) NOT NULL DEFAULT '0',
  `evento_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_evento_multimedia_evento1_idx` (`evento_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento_precio_taquilla`
--

CREATE TABLE `evento_precio_taquilla` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `precio` float NOT NULL,
  `cantidad` int(11) NOT NULL,
  `evento_fecha_id` int(11) NOT NULL,
  `escenario_taquilla_seccion_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_evento_precio_taquilla_evento_fecha1_idx` (`evento_fecha_id`),
  KEY `fk_evento_precio_taquilla_escenario_taquilla_seccion1_idx` (`escenario_taquilla_seccion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `produccion`
--

CREATE TABLE `produccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text,
  `estado` enum('ACTIVO','INACTIVO') NOT NULL DEFAULT 'ACTIVO',
  `escenario_id` int(11) NOT NULL,
  `produccion_categoria_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_produccion_escenario1_idx` (`escenario_id`),
  KEY `fk_produccion_produccion_categoria1_idx` (`produccion_categoria_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `produccion_categoria`
--

CREATE TABLE `produccion_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `produccion_multimedia`
--

CREATE TABLE `produccion_multimedia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ubicacion` text NOT NULL,
  `local` tinyint(4) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `menu` tinyint(4) NOT NULL,
  `encabezado` tinyint(4) NOT NULL,
  `produccion_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_produccion_multimedia_produccion1_idx` (`produccion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text,
  `estado` enum('ACTIVO','INACTIVO') NOT NULL DEFAULT 'ACTIVO',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_multimedia`
--

CREATE TABLE `proyecto_multimedia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ubicacion` text NOT NULL,
  `local` tinyint(4) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `menu` tinyint(4) NOT NULL,
  `encabezado` tinyint(4) NOT NULL,
  `proyecto_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_proyecto_multimedia_proyecto1_idx` (`proyecto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `elenco`
--
ALTER TABLE `elenco`
  ADD CONSTRAINT `fk_elenco_elenco_representante1` FOREIGN KEY (`elenco_representante_id`) REFERENCES `elenco_representante` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `elenco_multimedia`
--
ALTER TABLE `elenco_multimedia`
  ADD CONSTRAINT `fk_elenco_multimedia_elenco1` FOREIGN KEY (`elenco_id`) REFERENCES `elenco` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `escenario_multimedia`
--
ALTER TABLE `escenario_multimedia`
  ADD CONSTRAINT `fk_escenario_multimedia_escenario1` FOREIGN KEY (`escenario_id`) REFERENCES `escenario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `escenario_taquilla`
--
ALTER TABLE `escenario_taquilla`
  ADD CONSTRAINT `fk_escenario_taquilla_escenario1` FOREIGN KEY (`escenario_id`) REFERENCES `escenario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `escenario_taquilla_seccion`
--
ALTER TABLE `escenario_taquilla_seccion`
  ADD CONSTRAINT `fk_escenario_taquilla_seccion_escenario_taquilla1` FOREIGN KEY (`escenario_taquilla_id`) REFERENCES `escenario_taquilla` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `fk_evento_evento_categoria1` FOREIGN KEY (`evento_categoria_id`) REFERENCES `evento_categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_evento_elenco1` FOREIGN KEY (`elenco_id`) REFERENCES `elenco` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `evento_fecha`
--
ALTER TABLE `evento_fecha`
  ADD CONSTRAINT `fk_evento_fecha_escenario1` FOREIGN KEY (`escenario_id`) REFERENCES `escenario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_evento_fecha_evento1` FOREIGN KEY (`evento_id`) REFERENCES `evento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `evento_multimedia`
--
ALTER TABLE `evento_multimedia`
  ADD CONSTRAINT `fk_evento_multimedia_evento1` FOREIGN KEY (`evento_id`) REFERENCES `evento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `evento_precio_taquilla`
--
ALTER TABLE `evento_precio_taquilla`
  ADD CONSTRAINT `fk_evento_precio_taquilla_escenario_taquilla_seccion1` FOREIGN KEY (`escenario_taquilla_seccion_id`) REFERENCES `escenario_taquilla_seccion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_evento_precio_taquilla_evento_fecha1` FOREIGN KEY (`evento_fecha_id`) REFERENCES `evento_fecha` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `produccion`
--
ALTER TABLE `produccion`
  ADD CONSTRAINT `fk_produccion_escenario1` FOREIGN KEY (`escenario_id`) REFERENCES `escenario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_produccion_produccion_categoria1` FOREIGN KEY (`produccion_categoria_id`) REFERENCES `produccion_categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `produccion_multimedia`
--
ALTER TABLE `produccion_multimedia`
  ADD CONSTRAINT `fk_produccion_multimedia_produccion1` FOREIGN KEY (`produccion_id`) REFERENCES `produccion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `proyecto_multimedia`
--
ALTER TABLE `proyecto_multimedia`
  ADD CONSTRAINT `fk_proyecto_multimedia_proyecto1` FOREIGN KEY (`proyecto_id`) REFERENCES `proyecto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

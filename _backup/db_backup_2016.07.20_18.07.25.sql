-- -------------------------------------------
SET AUTOCOMMIT=0;
START TRANSACTION;
SET SQL_QUOTE_SHOW_CREATE = 1;
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
-- -------------------------------------------
-- -------------------------------------------
-- START BACKUP
-- -------------------------------------------
-- -------------------------------------------
-- TABLE `asiento`
-- -------------------------------------------
DROP TABLE IF EXISTS `asiento`;
CREATE TABLE IF NOT EXISTS `asiento` (
  `idAsiento` int(11) NOT NULL AUTO_INCREMENT,
  `glosa` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `id_Usuario` int(11) NOT NULL,
  `cod_Moneda` int(11) NOT NULL,
  `id_TipoA` int(11) NOT NULL,
  `id_Empresa` int(11) NOT NULL,
  PRIMARY KEY (`idAsiento`),
  KEY `id_Usuario` (`id_Usuario`),
  KEY `cod_Moneda` (`cod_Moneda`),
  KEY `id_TipoA` (`id_TipoA`),
  KEY `id_Empresa` (`id_Empresa`),
  CONSTRAINT `asiento_ibfk_1` FOREIGN KEY (`id_Usuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `asiento_ibfk_2` FOREIGN KEY (`cod_Moneda`) REFERENCES `moneda` (`codMoneda`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `asiento_ibfk_3` FOREIGN KEY (`id_TipoA`) REFERENCES `tipoasiento` (`idTipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `asiento_ibfk_4` FOREIGN KEY (`id_Empresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `balancegeneral`
-- -------------------------------------------
DROP TABLE IF EXISTS `balancegeneral`;
CREATE TABLE IF NOT EXISTS `balancegeneral` (
  `idBalance` int(11) NOT NULL AUTO_INCREMENT,
  `fechaIni` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  PRIMARY KEY (`idBalance`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `balancesumassaldos`
-- -------------------------------------------
DROP TABLE IF EXISTS `balancesumassaldos`;
CREATE TABLE IF NOT EXISTS `balancesumassaldos` (
  `idBalance` int(11) NOT NULL AUTO_INCREMENT,
  `fechaIni` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  PRIMARY KEY (`idBalance`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `bitacora`
-- -------------------------------------------
DROP TABLE IF EXISTS `bitacora`;
CREATE TABLE IF NOT EXISTS `bitacora` (
  `idBitacora` int(11) NOT NULL AUTO_INCREMENT,
  `fechaHora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actividad` varchar(50) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `id_Empresa` int(11) NOT NULL,
  PRIMARY KEY (`idBitacora`),
  KEY `id_Empresa` (`id_Empresa`),
  CONSTRAINT `bitacora_ibfk_1` FOREIGN KEY (`id_Empresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `cheque`
-- -------------------------------------------
DROP TABLE IF EXISTS `cheque`;
CREATE TABLE IF NOT EXISTS `cheque` (
  `codigoResp` int(11) NOT NULL,
  `nroCuenta` int(11) NOT NULL,
  `nombreReceptor` varchar(70) NOT NULL,
  `monto` float NOT NULL,
  `fecha` date NOT NULL,
  `id_Empresa` int(11) NOT NULL,
  PRIMARY KEY (`codigoResp`),
  KEY `id_Empresa` (`id_Empresa`),
  CONSTRAINT `cheque_ibfk_1` FOREIGN KEY (`codigoResp`) REFERENCES `respaldo` (`codigoRespaldo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cheque_ibfk_2` FOREIGN KEY (`id_Empresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `cuenta`
-- -------------------------------------------
DROP TABLE IF EXISTS `cuenta`;
CREATE TABLE IF NOT EXISTS `cuenta` (
  `codigoCuenta` varchar(20) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `codPadre` varchar(20) DEFAULT NULL,
  `id_Empresa` int(11) NOT NULL,
  `id_Nivel` int(11) NOT NULL,
  `cod_Grupo` int(11) NOT NULL,
  PRIMARY KEY (`codigoCuenta`),
  KEY `id_Empresa` (`id_Empresa`),
  KEY `codPadre` (`codPadre`),
  KEY `id_Nivel` (`id_Nivel`),
  KEY `cod_Grupo` (`cod_Grupo`),
  CONSTRAINT `cuenta_ibfk_1` FOREIGN KEY (`id_Empresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cuenta_ibfk_2` FOREIGN KEY (`codPadre`) REFERENCES `cuenta` (`codigoCuenta`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cuenta_ibfk_3` FOREIGN KEY (`id_Nivel`) REFERENCES `nivel` (`idNivel`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cuenta_ibfk_4` FOREIGN KEY (`cod_Grupo`) REFERENCES `grupocuenta` (`codGrupo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `detalleasiento`
-- -------------------------------------------
DROP TABLE IF EXISTS `detalleasiento`;
CREATE TABLE IF NOT EXISTS `detalleasiento` (
  `id_Asiento` int(11) NOT NULL,
  `codigo_Cuenta` varchar(20) NOT NULL,
  `debe` float DEFAULT NULL,
  `haber` float DEFAULT NULL,
  `id_Empresa` int(11) NOT NULL,
  PRIMARY KEY (`id_Asiento`,`codigo_Cuenta`),
  KEY `codigo_Cuenta` (`codigo_Cuenta`),
  KEY `id_Empresa` (`id_Empresa`),
  CONSTRAINT `detalleasiento_ibfk_1` FOREIGN KEY (`id_Asiento`) REFERENCES `asiento` (`idAsiento`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalleasiento_ibfk_2` FOREIGN KEY (`codigo_Cuenta`) REFERENCES `cuenta` (`codigoCuenta`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalleasiento_ibfk_3` FOREIGN KEY (`id_Empresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `empresa`
-- -------------------------------------------
DROP TABLE IF EXISTS `empresa`;
CREATE TABLE IF NOT EXISTS `empresa` (
  `idEmpresa` int(11) NOT NULL AUTO_INCREMENT,
  `nit` double NOT NULL,
  `razonSocial` varchar(50) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `ciudad` varchar(50) DEFAULT NULL,
  `pais` varchar(50) DEFAULT NULL,
  `telefono` int(11) NOT NULL,
  PRIMARY KEY (`idEmpresa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `estadoresultado`
-- -------------------------------------------
DROP TABLE IF EXISTS `estadoresultado`;
CREATE TABLE IF NOT EXISTS `estadoresultado` (
  `idEstado` int(11) NOT NULL AUTO_INCREMENT,
  `fechaIni` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  PRIMARY KEY (`idEstado`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `facturacompra`
-- -------------------------------------------
DROP TABLE IF EXISTS `facturacompra`;
CREATE TABLE IF NOT EXISTS `facturacompra` (
  `codigoResp` int(11) NOT NULL,
  `tipo` tinyint(4) NOT NULL,
  `nit` double NOT NULL,
  `razonSocial` varchar(50) NOT NULL,
  `nroFactura` int(11) NOT NULL,
  `poliza` int(11) NOT NULL,
  `nroAutorizacion` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `subtotal` float NOT NULL,
  `ICE` float NOT NULL,
  `descuento` float NOT NULL,
  `total` float NOT NULL,
  `IVA` float NOT NULL,
  `codigoControl` varchar(20) NOT NULL,
  `id_Empresa` int(11) NOT NULL,
  PRIMARY KEY (`codigoResp`),
  KEY `id_Empresa` (`id_Empresa`),
  CONSTRAINT `facturacompra_ibfk_1` FOREIGN KEY (`codigoResp`) REFERENCES `respaldo` (`codigoRespaldo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `facturacompra_ibfk_2` FOREIGN KEY (`id_Empresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `facturaventa`
-- -------------------------------------------
DROP TABLE IF EXISTS `facturaventa`;
CREATE TABLE IF NOT EXISTS `facturaventa` (
  `codigoResp` int(11) NOT NULL,
  `nit` double NOT NULL,
  `razonSocial` varchar(50) NOT NULL,
  `nroFactura` int(11) NOT NULL,
  `nroAutorizacion` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `subtotal` float NOT NULL,
  `ICE` float NOT NULL,
  `descuento` float NOT NULL,
  `total` float NOT NULL,
  `IVA` float NOT NULL,
  `validado` char(1) NOT NULL,
  `codigoControl` int(11) NOT NULL,
  `id_Empresa` int(11) NOT NULL,
  PRIMARY KEY (`codigoResp`),
  KEY `id_Empresa` (`id_Empresa`),
  CONSTRAINT `facturaventa_ibfk_1` FOREIGN KEY (`codigoResp`) REFERENCES `respaldo` (`codigoRespaldo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `facturaventa_ibfk_2` FOREIGN KEY (`id_Empresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `grupocuenta`
-- -------------------------------------------
DROP TABLE IF EXISTS `grupocuenta`;
CREATE TABLE IF NOT EXISTS `grupocuenta` (
  `codGrupo` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `id_Empresa` int(11) NOT NULL,
  PRIMARY KEY (`codGrupo`),
  KEY `id_Empresa` (`id_Empresa`),
  CONSTRAINT `grupocuenta_ibfk_1` FOREIGN KEY (`id_Empresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `grupoprivilegio`
-- -------------------------------------------
DROP TABLE IF EXISTS `grupoprivilegio`;
CREATE TABLE IF NOT EXISTS `grupoprivilegio` (
  `id_Privilegio` int(11) NOT NULL,
  `id_Grupo` int(11) NOT NULL,
  `id_Empresa` int(11) NOT NULL,
  PRIMARY KEY (`id_Privilegio`,`id_Grupo`),
  KEY `id_Grupo` (`id_Grupo`),
  KEY `id_Empresa` (`id_Empresa`),
  CONSTRAINT `grupoprivilegio_ibfk_1` FOREIGN KEY (`id_Privilegio`) REFERENCES `privilegio` (`idPrivilegio`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `grupoprivilegio_ibfk_2` FOREIGN KEY (`id_Grupo`) REFERENCES `grupousuario` (`idGrupo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `grupoprivilegio_ibfk_3` FOREIGN KEY (`id_Empresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `grupousuario`
-- -------------------------------------------
DROP TABLE IF EXISTS `grupousuario`;
CREATE TABLE IF NOT EXISTS `grupousuario` (
  `idGrupo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  `id_Empresa` int(11) NOT NULL,
  PRIMARY KEY (`idGrupo`),
  KEY `id_Empresa` (`id_Empresa`),
  CONSTRAINT `grupousuario_ibfk_1` FOREIGN KEY (`id_Empresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `librodiario`
-- -------------------------------------------
DROP TABLE IF EXISTS `librodiario`;
CREATE TABLE IF NOT EXISTS `librodiario` (
  `idDiario` int(11) NOT NULL AUTO_INCREMENT,
  `fechaIni` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  PRIMARY KEY (`idDiario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `libromayor`
-- -------------------------------------------
DROP TABLE IF EXISTS `libromayor`;
CREATE TABLE IF NOT EXISTS `libromayor` (
  `idMayor` int(11) NOT NULL AUTO_INCREMENT,
  `codCuenta` varchar(20) DEFAULT NULL,
  `fechaIni` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  PRIMARY KEY (`idMayor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `moneda`
-- -------------------------------------------
DROP TABLE IF EXISTS `moneda`;
CREATE TABLE IF NOT EXISTS `moneda` (
  `codMoneda` int(11) NOT NULL AUTO_INCREMENT,
  `tipoMoneda` varchar(20) DEFAULT NULL,
  `simbolo` varchar(5) DEFAULT NULL,
  `id_Empresa` int(11) NOT NULL,
  PRIMARY KEY (`codMoneda`),
  KEY `id_Empresa` (`id_Empresa`),
  CONSTRAINT `moneda_ibfk_1` FOREIGN KEY (`id_Empresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `nivel`
-- -------------------------------------------
DROP TABLE IF EXISTS `nivel`;
CREATE TABLE IF NOT EXISTS `nivel` (
  `idNivel` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(20) NOT NULL,
  `id_Empresa` int(11) NOT NULL,
  PRIMARY KEY (`idNivel`),
  KEY `id_Empresa` (`id_Empresa`),
  CONSTRAINT `nivel_ibfk_1` FOREIGN KEY (`id_Empresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `personalizacion`
-- -------------------------------------------
DROP TABLE IF EXISTS `personalizacion`;
CREATE TABLE IF NOT EXISTS `personalizacion` (
  `idPersonalizacion` int(11) NOT NULL AUTO_INCREMENT,
  `Color` varchar(20) NOT NULL,
  `tamano` varchar(20) NOT NULL,
  `Fuente` varchar(20) NOT NULL,
  `id_Usuario` int(11) NOT NULL,
  `id_Empresa` int(11) NOT NULL,
  PRIMARY KEY (`idPersonalizacion`),
  KEY `id_Empresa` (`id_Empresa`),
  CONSTRAINT `personalizacion_ibfk_1` FOREIGN KEY (`id_Empresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `personalizacion_ibfk_2` FOREIGN KEY (`id_Empresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `privilegio`
-- -------------------------------------------
DROP TABLE IF EXISTS `privilegio`;
CREATE TABLE IF NOT EXISTS `privilegio` (
  `idPrivilegio` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `idPadre` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPrivilegio`),
  KEY `idPadre` (`idPadre`),
  CONSTRAINT `privilegio_ibfk_1` FOREIGN KEY (`idPadre`) REFERENCES `privilegio` (`idPrivilegio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `respaldo`
-- -------------------------------------------
DROP TABLE IF EXISTS `respaldo`;
CREATE TABLE IF NOT EXISTS `respaldo` (
  `codigoRespaldo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text NOT NULL,
  `id_Asiento` int(11) DEFAULT NULL,
  `id_Empresa` int(11) NOT NULL,
  `tipoResp` char(1) DEFAULT NULL,
  PRIMARY KEY (`codigoRespaldo`),
  KEY `id_Asiento` (`id_Asiento`),
  KEY `id_Empresa` (`id_Empresa`),
  CONSTRAINT `respaldo_ibfk_1` FOREIGN KEY (`id_Asiento`) REFERENCES `asiento` (`idAsiento`),
  CONSTRAINT `respaldo_ibfk_2` FOREIGN KEY (`id_Empresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tipoasiento`
-- -------------------------------------------
DROP TABLE IF EXISTS `tipoasiento`;
CREATE TABLE IF NOT EXISTS `tipoasiento` (
  `idTipo` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `id_Empresa` int(11) NOT NULL,
  PRIMARY KEY (`idTipo`),
  KEY `id_Empresa` (`id_Empresa`),
  CONSTRAINT `tipoasiento_ibfk_1` FOREIGN KEY (`id_Empresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `usuario`
-- -------------------------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `userName` varchar(20) NOT NULL,
  `passwd` varchar(25) NOT NULL,
  `id_Empresa` int(11) NOT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `id_Grupo` int(11) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `id_Empresa` (`id_Empresa`),
  KEY `id_Grupo` (`id_Grupo`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_Empresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`id_Grupo`) REFERENCES `grupousuario` (`idGrupo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE DATA asiento
-- -------------------------------------------
INSERT INTO `asiento` (`idAsiento`,`glosa`,`fecha`,`id_Usuario`,`cod_Moneda`,`id_TipoA`,`id_Empresa`) VALUES
('1','Carlini NO!','2016-05-18','1','1','1','3');
INSERT INTO `asiento` (`idAsiento`,`glosa`,`fecha`,`id_Usuario`,`cod_Moneda`,`id_TipoA`,`id_Empresa`) VALUES
('2','asfdasfasdfrhtyjrt','2016-05-18','1','1','1','3');
INSERT INTO `asiento` (`idAsiento`,`glosa`,`fecha`,`id_Usuario`,`cod_Moneda`,`id_TipoA`,`id_Empresa`) VALUES
('3','shsyfjd','0000-00-00','1','1','1','3');
INSERT INTO `asiento` (`idAsiento`,`glosa`,`fecha`,`id_Usuario`,`cod_Moneda`,`id_TipoA`,`id_Empresa`) VALUES
('4','sklfjklas','0000-00-00','1','1','1','3');
INSERT INTO `asiento` (`idAsiento`,`glosa`,`fecha`,`id_Usuario`,`cod_Moneda`,`id_TipoA`,`id_Empresa`) VALUES
('5','sklfjklas','0000-00-00','1','1','1','3');
INSERT INTO `asiento` (`idAsiento`,`glosa`,`fecha`,`id_Usuario`,`cod_Moneda`,`id_TipoA`,`id_Empresa`) VALUES
('6','holaBEBE','0000-00-00','1','1','1','3');
INSERT INTO `asiento` (`idAsiento`,`glosa`,`fecha`,`id_Usuario`,`cod_Moneda`,`id_TipoA`,`id_Empresa`) VALUES
('7','holaChango','0000-00-00','1','1','1','3');
INSERT INTO `asiento` (`idAsiento`,`glosa`,`fecha`,`id_Usuario`,`cod_Moneda`,`id_TipoA`,`id_Empresa`) VALUES
('8','pruieba datepicker','2016-07-13','1','1','1','3');
INSERT INTO `asiento` (`idAsiento`,`glosa`,`fecha`,`id_Usuario`,`cod_Moneda`,`id_TipoA`,`id_Empresa`) VALUES
('9','hola hijitos','2016-08-10','1','1','1','3');
INSERT INTO `asiento` (`idAsiento`,`glosa`,`fecha`,`id_Usuario`,`cod_Moneda`,`id_TipoA`,`id_Empresa`) VALUES
('10','gagaaga','2016-07-20','2','1','1','3');
INSERT INTO `asiento` (`idAsiento`,`glosa`,`fecha`,`id_Usuario`,`cod_Moneda`,`id_TipoA`,`id_Empresa`) VALUES
('11','fgdfhsdgasdfsdfsd','2016-07-13','2','1','1','3');
INSERT INTO `asiento` (`idAsiento`,`glosa`,`fecha`,`id_Usuario`,`cod_Moneda`,`id_TipoA`,`id_Empresa`) VALUES
('12','pueba 1','2016-07-18','1','1','1','3');
INSERT INTO `asiento` (`idAsiento`,`glosa`,`fecha`,`id_Usuario`,`cod_Moneda`,`id_TipoA`,`id_Empresa`) VALUES
('13','pueba 2','2016-07-18','1','1','1','3');
INSERT INTO `asiento` (`idAsiento`,`glosa`,`fecha`,`id_Usuario`,`cod_Moneda`,`id_TipoA`,`id_Empresa`) VALUES
('14','lalaalal','2016-07-19','1','1','1','3');
INSERT INTO `asiento` (`idAsiento`,`glosa`,`fecha`,`id_Usuario`,`cod_Moneda`,`id_TipoA`,`id_Empresa`) VALUES
('15','tatat','2016-07-22','1','1','1','3');
INSERT INTO `asiento` (`idAsiento`,`glosa`,`fecha`,`id_Usuario`,`cod_Moneda`,`id_TipoA`,`id_Empresa`) VALUES
('16','PruebaDiario','2016-07-19','2','1','1','3');
INSERT INTO `asiento` (`idAsiento`,`glosa`,`fecha`,`id_Usuario`,`cod_Moneda`,`id_TipoA`,`id_Empresa`) VALUES
('17','No carlos','2016-07-20','2','1','1','3');
INSERT INTO `asiento` (`idAsiento`,`glosa`,`fecha`,`id_Usuario`,`cod_Moneda`,`id_TipoA`,`id_Empresa`) VALUES
('18','Prueba','2016-07-20','2','1','1','3');
INSERT INTO `asiento` (`idAsiento`,`glosa`,`fecha`,`id_Usuario`,`cod_Moneda`,`id_TipoA`,`id_Empresa`) VALUES
('19','Prueba','2016-07-20','2','1','1','3');
INSERT INTO `asiento` (`idAsiento`,`glosa`,`fecha`,`id_Usuario`,`cod_Moneda`,`id_TipoA`,`id_Empresa`) VALUES
('21','primer asiento','2016-07-29','2','1','1','3');
INSERT INTO `asiento` (`idAsiento`,`glosa`,`fecha`,`id_Usuario`,`cod_Moneda`,`id_TipoA`,`id_Empresa`) VALUES
('22','Pago de produccion','2016-07-30','2','1','1','3');



-- -------------------------------------------
-- TABLE DATA balancegeneral
-- -------------------------------------------
INSERT INTO `balancegeneral` (`idBalance`,`fechaIni`,`fechaFin`) VALUES
('1','2016-07-28','2016-07-31');
INSERT INTO `balancegeneral` (`idBalance`,`fechaIni`,`fechaFin`) VALUES
('2','2016-07-28','2016-07-31');
INSERT INTO `balancegeneral` (`idBalance`,`fechaIni`,`fechaFin`) VALUES
('3','2016-07-28','2016-07-31');
INSERT INTO `balancegeneral` (`idBalance`,`fechaIni`,`fechaFin`) VALUES
('4','2016-07-28','2016-07-31');
INSERT INTO `balancegeneral` (`idBalance`,`fechaIni`,`fechaFin`) VALUES
('5','2016-07-28','2016-07-31');
INSERT INTO `balancegeneral` (`idBalance`,`fechaIni`,`fechaFin`) VALUES
('6','2016-07-28','2016-07-31');
INSERT INTO `balancegeneral` (`idBalance`,`fechaIni`,`fechaFin`) VALUES
('7','2016-07-28','2016-07-31');
INSERT INTO `balancegeneral` (`idBalance`,`fechaIni`,`fechaFin`) VALUES
('8','2016-07-29','2016-07-30');
INSERT INTO `balancegeneral` (`idBalance`,`fechaIni`,`fechaFin`) VALUES
('9','2016-07-29','2016-07-30');
INSERT INTO `balancegeneral` (`idBalance`,`fechaIni`,`fechaFin`) VALUES
('10','2016-07-29','2016-07-30');
INSERT INTO `balancegeneral` (`idBalance`,`fechaIni`,`fechaFin`) VALUES
('11','2016-07-29','2016-07-30');
INSERT INTO `balancegeneral` (`idBalance`,`fechaIni`,`fechaFin`) VALUES
('12','2016-07-29','2016-07-30');
INSERT INTO `balancegeneral` (`idBalance`,`fechaIni`,`fechaFin`) VALUES
('13','2016-07-29','2016-07-30');
INSERT INTO `balancegeneral` (`idBalance`,`fechaIni`,`fechaFin`) VALUES
('14','2016-07-29','2016-07-30');
INSERT INTO `balancegeneral` (`idBalance`,`fechaIni`,`fechaFin`) VALUES
('15','2016-07-29','2016-07-30');
INSERT INTO `balancegeneral` (`idBalance`,`fechaIni`,`fechaFin`) VALUES
('16','2016-07-29','2016-07-30');
INSERT INTO `balancegeneral` (`idBalance`,`fechaIni`,`fechaFin`) VALUES
('17','2016-07-29','2016-07-30');
INSERT INTO `balancegeneral` (`idBalance`,`fechaIni`,`fechaFin`) VALUES
('18','2016-07-29','2016-07-30');
INSERT INTO `balancegeneral` (`idBalance`,`fechaIni`,`fechaFin`) VALUES
('19','2016-07-29','2016-07-31');



-- -------------------------------------------
-- TABLE DATA balancesumassaldos
-- -------------------------------------------
INSERT INTO `balancesumassaldos` (`idBalance`,`fechaIni`,`fechaFin`) VALUES
('1','2016-07-20','2016-07-09');
INSERT INTO `balancesumassaldos` (`idBalance`,`fechaIni`,`fechaFin`) VALUES
('2','2016-07-20','2016-07-09');
INSERT INTO `balancesumassaldos` (`idBalance`,`fechaIni`,`fechaFin`) VALUES
('3','2016-07-12','2016-07-29');
INSERT INTO `balancesumassaldos` (`idBalance`,`fechaIni`,`fechaFin`) VALUES
('4','2016-07-05','2016-07-28');



-- -------------------------------------------
-- TABLE DATA bitacora
-- -------------------------------------------
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('1','2016-07-17 03:28:45','Salida del sistema','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('2','2016-07-17 03:29:38','Ingreso al sistema','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('3','2016-07-17 03:30:02','Salida del sistema','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('4','2016-07-17 03:30:25','Ingreso al sistema','Lucho','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('5','2016-07-17 03:33:18','Salida del sistema','Lucho','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('6','2016-07-17 03:36:39','Salida del sistema','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('7','2016-07-17 03:36:41','Ingreso al sistema','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('8','2016-07-17 03:37:01','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('9','2016-07-17 03:37:20','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('10','2016-07-17 03:39:24','Salida del sistema','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('11','2016-07-17 03:39:33','Ingreso al sistema','Lucho','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('12','2016-07-17 03:39:55','Salida del sistema','Lucho','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('13','2016-07-17 03:39:59','Ingreso al sistema','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('14','2016-07-17 03:40:31','Salida del sistema','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('15','2016-07-17 03:46:47','Ingreso al sistema','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('16','2016-07-17 05:52:23','Salida del sistema','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('17','2016-07-17 05:52:29','Ingreso al sistema','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('18','2016-07-17 12:18:36','Ingreso al sistema','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('19','2016-07-17 12:18:45','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('20','2016-07-17 12:19:12','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('21','2016-07-17 12:20:10','Salida del sistema','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('22','2016-07-17 12:20:20','Ingreso al sistema','Lucho','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('23','2016-07-17 12:24:21','Salida del sistema','Lucho','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('24','2016-07-17 12:24:38','Ingreso al sistema','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('25','2016-07-17 12:24:46','Salida del sistema','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('26','2016-07-17 12:24:49','Ingreso al sistema','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('27','2016-07-17 12:24:50','Salida del sistema','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('28','2016-07-17 12:24:52','Ingreso al sistema','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('29','2016-07-17 12:25:36','Salida del sistema','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('30','2016-07-17 20:25:05','Ingreso al sistema','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('31','2016-07-17 22:16:36','Salida del sistema','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('32','2016-07-17 22:44:24','Ingreso al sistema','tumamauser','29');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('33','2016-07-17 22:46:54','Salida del sistema','tumamauser','29');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('34','2016-07-17 23:01:43','Ingreso al sistema','tumamauser','29');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('35','2016-07-18 00:06:11','Salida del sistema','tumamauser','29');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('36','2016-07-18 00:06:26','Ingreso al sistema','tumamauser','29');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('37','2016-07-18 00:07:08','Salida del sistema','tumamauser','29');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('38','2016-07-18 00:07:18','Ingreso al sistema','userPrueba','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('39','2016-07-18 00:07:27','guardar asiento','userPrueba','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('40','2016-07-18 00:08:05','guardar asiento','userPrueba','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('41','2016-07-18 00:11:03','guardar asiento','userPrueba','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('42','2016-07-18 00:12:12','guardar asiento','userPrueba','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('43','2016-07-18 00:12:18','guardar asiento','userPrueba','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('44','2016-07-18 00:12:32','guardar asiento','userPrueba','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('45','2016-07-18 00:13:12','guardar asiento','userPrueba','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('46','2016-07-18 01:14:15','guardar asiento','userPrueba','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('47','2016-07-18 01:14:45','guardar asiento','userPrueba','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('48','2016-07-18 01:15:35','guardar asiento','userPrueba','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('49','2016-07-18 01:16:10','guardar asiento','userPrueba','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('50','2016-07-18 01:31:31','Ingreso al sistema','userPrueba','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('51','2016-07-18 02:16:23','Ingreso al sistema','tumamauser','29');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('52','2016-07-18 10:57:33','Ingreso al sistema','userPrueba','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('53','2016-07-18 11:28:50','Salida del sistema','userPrueba','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('54','2016-07-18 11:38:24','Ingreso al sistema','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('55','2016-07-18 13:45:16','Salida del sistema','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('56','2016-07-18 13:45:22','Ingreso al sistema','tumamauser','29');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('57','2016-07-18 16:32:14','Salida del sistema','tumamauser','29');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('58','2016-07-18 16:32:21','Ingreso al sistema','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('59','2016-07-18 16:39:21','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('60','2016-07-18 16:40:34','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('61','2016-07-19 14:50:03','Ingreso al sistema','tumamauser','29');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('62','2016-07-19 16:13:12','Ingreso al sistema','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('63','2016-07-19 16:27:25','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('64','2016-07-19 16:27:53','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('65','2016-07-19 17:21:46','Salida del sistema','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('66','2016-07-19 17:24:36','Ingreso al sistema','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('67','2016-07-19 23:27:01','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('68','2016-07-19 23:57:38','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('69','2016-07-20 00:06:19','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('70','2016-07-20 00:08:11','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('71','2016-07-20 00:10:41','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('72','2016-07-20 00:10:49','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('73','2016-07-20 00:17:08','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('74','2016-07-20 02:57:28','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('75','2016-07-20 02:57:57','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('76','2016-07-20 03:00:19','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('77','2016-07-20 03:00:51','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('78','2016-07-20 03:01:46','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('79','2016-07-20 03:03:12','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('80','2016-07-20 03:03:12','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('81','2016-07-20 03:03:18','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('82','2016-07-20 03:03:35','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('83','2016-07-20 03:03:52','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('84','2016-07-20 03:04:57','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('85','2016-07-20 03:05:34','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('86','2016-07-20 03:05:48','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('87','2016-07-20 03:06:04','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('88','2016-07-20 03:06:16','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('89','2016-07-20 03:06:21','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('90','2016-07-20 03:06:44','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('91','2016-07-20 03:06:58','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('92','2016-07-20 03:07:05','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('93','2016-07-20 03:07:10','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('94','2016-07-20 03:07:30','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('95','2016-07-20 03:07:47','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('96','2016-07-20 03:07:56','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('97','2016-07-20 03:07:58','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('98','2016-07-20 03:08:13','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('99','2016-07-20 03:08:37','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('100','2016-07-20 03:08:40','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('101','2016-07-20 03:08:56','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('102','2016-07-20 03:59:08','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('103','2016-07-20 04:14:13','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('104','2016-07-20 04:14:50','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('105','2016-07-20 05:21:29','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('106','2016-07-20 05:32:29','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('107','2016-07-20 06:10:16','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('108','2016-07-20 06:11:55','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('109','2016-07-20 06:13:07','guardar asiento','Carlini95','3');
INSERT INTO `bitacora` (`idBitacora`,`fechaHora`,`actividad`,`userName`,`id_Empresa`) VALUES
('110','2016-07-20 12:07:02','Ingreso al sistema','Carlini95','3');



-- -------------------------------------------
-- TABLE DATA cheque
-- -------------------------------------------
INSERT INTO `cheque` (`codigoResp`,`nroCuenta`,`nombreReceptor`,`monto`,`fecha`,`id_Empresa`) VALUES
('13','132454654','Kleber','500','2017-07-16','3');
INSERT INTO `cheque` (`codigoResp`,`nroCuenta`,`nombreReceptor`,`monto`,`fecha`,`id_Empresa`) VALUES
('14','1561561','Faltan%So','45','2017-07-16','3');
INSERT INTO `cheque` (`codigoResp`,`nroCuenta`,`nombreReceptor`,`monto`,`fecha`,`id_Empresa`) VALUES
('15','598484','hahahahahahahaaaha','456','2017-07-16','3');
INSERT INTO `cheque` (`codigoResp`,`nroCuenta`,`nombreReceptor`,`monto`,`fecha`,`id_Empresa`) VALUES
('16','456456456','lalalala','654','2019-07-16','3');
INSERT INTO `cheque` (`codigoResp`,`nroCuenta`,`nombreReceptor`,`monto`,`fecha`,`id_Empresa`) VALUES
('17','123456','cadima rector','123','2016-07-13','3');
INSERT INTO `cheque` (`codigoResp`,`nroCuenta`,`nombreReceptor`,`monto`,`fecha`,`id_Empresa`) VALUES
('18','564156','gagag','45','2016-07-20','3');
INSERT INTO `cheque` (`codigoResp`,`nroCuenta`,`nombreReceptor`,`monto`,`fecha`,`id_Empresa`) VALUES
('19','2147483647','guillegamer','500','2016-07-12','3');
INSERT INTO `cheque` (`codigoResp`,`nroCuenta`,`nombreReceptor`,`monto`,`fecha`,`id_Empresa`) VALUES
('20','414141','fafafa','4111','2016-07-18','3');
INSERT INTO `cheque` (`codigoResp`,`nroCuenta`,`nombreReceptor`,`monto`,`fecha`,`id_Empresa`) VALUES
('21','313131','eqeqeq','1313','2016-07-20','3');
INSERT INTO `cheque` (`codigoResp`,`nroCuenta`,`nombreReceptor`,`monto`,`fecha`,`id_Empresa`) VALUES
('22','2147483647','Tu mama','50','2016-07-19','3');



-- -------------------------------------------
-- TABLE DATA cuenta
-- -------------------------------------------
INSERT INTO `cuenta` (`codigoCuenta`,`descripcion`,`codPadre`,`id_Empresa`,`id_Nivel`,`cod_Grupo`) VALUES
('1','Activo','','3','1','1');
INSERT INTO `cuenta` (`codigoCuenta`,`descripcion`,`codPadre`,`id_Empresa`,`id_Nivel`,`cod_Grupo`) VALUES
('1.1','Caja','1','3','2','1');
INSERT INTO `cuenta` (`codigoCuenta`,`descripcion`,`codPadre`,`id_Empresa`,`id_Nivel`,`cod_Grupo`) VALUES
('1.2','Banco','1','3','2','1');
INSERT INTO `cuenta` (`codigoCuenta`,`descripcion`,`codPadre`,`id_Empresa`,`id_Nivel`,`cod_Grupo`) VALUES
('2','Pasivo','','3','1','1');
INSERT INTO `cuenta` (`codigoCuenta`,`descripcion`,`codPadre`,`id_Empresa`,`id_Nivel`,`cod_Grupo`) VALUES
('2.1','Cuentas X pagar','2','3','2','1');
INSERT INTO `cuenta` (`codigoCuenta`,`descripcion`,`codPadre`,`id_Empresa`,`id_Nivel`,`cod_Grupo`) VALUES
('3','Patrimonio','','3','1','1');
INSERT INTO `cuenta` (`codigoCuenta`,`descripcion`,`codPadre`,`id_Empresa`,`id_Nivel`,`cod_Grupo`) VALUES
('3.1','capital','3','3','2','1');
INSERT INTO `cuenta` (`codigoCuenta`,`descripcion`,`codPadre`,`id_Empresa`,`id_Nivel`,`cod_Grupo`) VALUES
('4','Ingreso','','3','1','2');
INSERT INTO `cuenta` (`codigoCuenta`,`descripcion`,`codPadre`,`id_Empresa`,`id_Nivel`,`cod_Grupo`) VALUES
('4.1','Ventas','4','3','2','2');
INSERT INTO `cuenta` (`codigoCuenta`,`descripcion`,`codPadre`,`id_Empresa`,`id_Nivel`,`cod_Grupo`) VALUES
('5','Egreso','','3','1','2');
INSERT INTO `cuenta` (`codigoCuenta`,`descripcion`,`codPadre`,`id_Empresa`,`id_Nivel`,`cod_Grupo`) VALUES
('5.1','Sueldos','5','3','2','2');



-- -------------------------------------------
-- TABLE DATA detalleasiento
-- -------------------------------------------
INSERT INTO `detalleasiento` (`id_Asiento`,`codigo_Cuenta`,`debe`,`haber`,`id_Empresa`) VALUES
('12','1','50','','3');
INSERT INTO `detalleasiento` (`id_Asiento`,`codigo_Cuenta`,`debe`,`haber`,`id_Empresa`) VALUES
('14','1','30','','3');
INSERT INTO `detalleasiento` (`id_Asiento`,`codigo_Cuenta`,`debe`,`haber`,`id_Empresa`) VALUES
('14','2','','30','3');
INSERT INTO `detalleasiento` (`id_Asiento`,`codigo_Cuenta`,`debe`,`haber`,`id_Empresa`) VALUES
('15','1','','45','3');
INSERT INTO `detalleasiento` (`id_Asiento`,`codigo_Cuenta`,`debe`,`haber`,`id_Empresa`) VALUES
('15','2','45','','3');
INSERT INTO `detalleasiento` (`id_Asiento`,`codigo_Cuenta`,`debe`,`haber`,`id_Empresa`) VALUES
('16','1','50','','3');
INSERT INTO `detalleasiento` (`id_Asiento`,`codigo_Cuenta`,`debe`,`haber`,`id_Empresa`) VALUES
('16','2','','50','3');
INSERT INTO `detalleasiento` (`id_Asiento`,`codigo_Cuenta`,`debe`,`haber`,`id_Empresa`) VALUES
('17','1','20','20','3');
INSERT INTO `detalleasiento` (`id_Asiento`,`codigo_Cuenta`,`debe`,`haber`,`id_Empresa`) VALUES
('18','1','50','0','3');
INSERT INTO `detalleasiento` (`id_Asiento`,`codigo_Cuenta`,`debe`,`haber`,`id_Empresa`) VALUES
('18','2','0','50','3');
INSERT INTO `detalleasiento` (`id_Asiento`,`codigo_Cuenta`,`debe`,`haber`,`id_Empresa`) VALUES
('19','1','50','0','3');
INSERT INTO `detalleasiento` (`id_Asiento`,`codigo_Cuenta`,`debe`,`haber`,`id_Empresa`) VALUES
('19','2','0','50','3');
INSERT INTO `detalleasiento` (`id_Asiento`,`codigo_Cuenta`,`debe`,`haber`,`id_Empresa`) VALUES
('21','1.1','100','','3');
INSERT INTO `detalleasiento` (`id_Asiento`,`codigo_Cuenta`,`debe`,`haber`,`id_Empresa`) VALUES
('21','1.2','100000','','3');
INSERT INTO `detalleasiento` (`id_Asiento`,`codigo_Cuenta`,`debe`,`haber`,`id_Empresa`) VALUES
('21','2.1','','100','3');
INSERT INTO `detalleasiento` (`id_Asiento`,`codigo_Cuenta`,`debe`,`haber`,`id_Empresa`) VALUES
('21','3.1','','100000','3');
INSERT INTO `detalleasiento` (`id_Asiento`,`codigo_Cuenta`,`debe`,`haber`,`id_Empresa`) VALUES
('22','4.1','10480','','3');
INSERT INTO `detalleasiento` (`id_Asiento`,`codigo_Cuenta`,`debe`,`haber`,`id_Empresa`) VALUES
('22','5.1','','10480','3');



-- -------------------------------------------
-- TABLE DATA empresa
-- -------------------------------------------
INSERT INTO `empresa` (`idEmpresa`,`nit`,`razonSocial`,`direccion`,`ciudad`,`pais`,`telefono`) VALUES
('3','123','Prueba','Carlini\'s house','Santa Cruz','Bolivia','11321654');
INSERT INTO `empresa` (`idEmpresa`,`nit`,`razonSocial`,`direccion`,`ciudad`,`pais`,`telefono`) VALUES
('4','10101010','queque','caca','okay','helado ','777771');
INSERT INTO `empresa` (`idEmpresa`,`nit`,`razonSocial`,`direccion`,`ciudad`,`pais`,`telefono`) VALUES
('8','12354','dfsdfsdf','sdfsdfsdfs','dfsdfsdfs','sdfsdfs','123546');
INSERT INTO `empresa` (`idEmpresa`,`nit`,`razonSocial`,`direccion`,`ciudad`,`pais`,`telefono`) VALUES
('10','1234566789','asd','asd','asd','asd','123');
INSERT INTO `empresa` (`idEmpresa`,`nit`,`razonSocial`,`direccion`,`ciudad`,`pais`,`telefono`) VALUES
('11','1234566789','asdasdas','asdasdas','sdasdas','dasdasd','11231');
INSERT INTO `empresa` (`idEmpresa`,`nit`,`razonSocial`,`direccion`,`ciudad`,`pais`,`telefono`) VALUES
('12','4312345','asdasdasd','asdasdas','asdasdas','asdasa','1231214');
INSERT INTO `empresa` (`idEmpresa`,`nit`,`razonSocial`,`direccion`,`ciudad`,`pais`,`telefono`) VALUES
('13','111111','asdas','adadas','dasdas','dasdasd','21313');
INSERT INTO `empresa` (`idEmpresa`,`nit`,`razonSocial`,`direccion`,`ciudad`,`pais`,`telefono`) VALUES
('14','123123123','asdsdasd','adasdas','asdas','Bolivia','123');
INSERT INTO `empresa` (`idEmpresa`,`nit`,`razonSocial`,`direccion`,`ciudad`,`pais`,`telefono`) VALUES
('15','111','das','adasdas','Santa Cruz','Bolivia','1111');
INSERT INTO `empresa` (`idEmpresa`,`nit`,`razonSocial`,`direccion`,`ciudad`,`pais`,`telefono`) VALUES
('16','111111','asd','adasdas','a','a','21313');
INSERT INTO `empresa` (`idEmpresa`,`nit`,`razonSocial`,`direccion`,`ciudad`,`pais`,`telefono`) VALUES
('17','111','asaa','aaas','asda','ada','123');
INSERT INTO `empresa` (`idEmpresa`,`nit`,`razonSocial`,`direccion`,`ciudad`,`pais`,`telefono`) VALUES
('18','111','asaa','aaas','asda','ada','123');
INSERT INTO `empresa` (`idEmpresa`,`nit`,`razonSocial`,`direccion`,`ciudad`,`pais`,`telefono`) VALUES
('19','111','asaa','aaas','asda','ada','123');
INSERT INTO `empresa` (`idEmpresa`,`nit`,`razonSocial`,`direccion`,`ciudad`,`pais`,`telefono`) VALUES
('20','123456','s','a','a','a','11321654');
INSERT INTO `empresa` (`idEmpresa`,`nit`,`razonSocial`,`direccion`,`ciudad`,`pais`,`telefono`) VALUES
('21','123456','s','a','a','a','11321654');
INSERT INTO `empresa` (`idEmpresa`,`nit`,`razonSocial`,`direccion`,`ciudad`,`pais`,`telefono`) VALUES
('23','132','sadas','asasda','fsdfsd','asdfsdf','12');
INSERT INTO `empresa` (`idEmpresa`,`nit`,`razonSocial`,`direccion`,`ciudad`,`pais`,`telefono`) VALUES
('24','4312345','asdasdasd','asdasdas','asdasdas','asdasa','1231214');
INSERT INTO `empresa` (`idEmpresa`,`nit`,`razonSocial`,`direccion`,`ciudad`,`pais`,`telefono`) VALUES
('25','4312345','asdasdasd','asdasdas','asdasdas','asdasa','1231214');
INSERT INTO `empresa` (`idEmpresa`,`nit`,`razonSocial`,`direccion`,`ciudad`,`pais`,`telefono`) VALUES
('26','123','holis','tu hwerma','se la come','doblada','12345679');
INSERT INTO `empresa` (`idEmpresa`,`nit`,`razonSocial`,`direccion`,`ciudad`,`pais`,`telefono`) VALUES
('27','6230352014','Factorydeas','Calle Vallegrande','Santa Cruz','Bolivia','70855849');
INSERT INTO `empresa` (`idEmpresa`,`nit`,`razonSocial`,`direccion`,`ciudad`,`pais`,`telefono`) VALUES
('28','1234656789','probando','mosda','coco','cigu','879456123');
INSERT INTO `empresa` (`idEmpresa`,`nit`,`razonSocial`,`direccion`,`ciudad`,`pais`,`telefono`) VALUES
('29','1234656789','probando','mosda','coco','cigu','879456123');



-- -------------------------------------------
-- TABLE DATA estadoresultado
-- -------------------------------------------
INSERT INTO `estadoresultado` (`idEstado`,`fechaIni`,`fechaFin`) VALUES
('1','2016-07-28','2016-07-31');
INSERT INTO `estadoresultado` (`idEstado`,`fechaIni`,`fechaFin`) VALUES
('2','2016-07-28','2016-07-31');
INSERT INTO `estadoresultado` (`idEstado`,`fechaIni`,`fechaFin`) VALUES
('3','2016-07-28','2016-07-31');
INSERT INTO `estadoresultado` (`idEstado`,`fechaIni`,`fechaFin`) VALUES
('4','2016-07-28','2016-07-31');



-- -------------------------------------------
-- TABLE DATA grupocuenta
-- -------------------------------------------
INSERT INTO `grupocuenta` (`codGrupo`,`descripcion`,`id_Empresa`) VALUES
('1','Balance General','3');
INSERT INTO `grupocuenta` (`codGrupo`,`descripcion`,`id_Empresa`) VALUES
('2','Estado de resultados','3');



-- -------------------------------------------
-- TABLE DATA grupoprivilegio
-- -------------------------------------------
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('1','1','3');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('1','6','3');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('2','1','3');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('3','1','3');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('4','1','3');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('4','2','3');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('4','6','3');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('5','1','3');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('6','1','3');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('6','5','3');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('6','6','3');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('6','7','3');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('7','1','3');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('8','1','3');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('9','1','3');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('10','1','3');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('11','1','3');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('12','1','3');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('13','1','3');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('13','7','3');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('14','1','3');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('15','1','3');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('16','1','3');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('16','7','3');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('17','1','3');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('18','1','3');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('18','5','3');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('18','7','3');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('19','6','3');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('22','5','3');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('1','9','29');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('2','9','29');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('3','9','29');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('4','9','29');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('5','9','29');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('6','9','29');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('7','9','29');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('8','9','29');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('9','9','29');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('10','9','29');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('11','9','29');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('12','9','29');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('13','9','29');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('14','9','29');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('15','9','29');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('16','9','29');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('17','9','29');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('18','9','29');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('19','9','29');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('20','9','29');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('21','9','29');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('22','9','29');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('23','9','29');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('24','9','29');
INSERT INTO `grupoprivilegio` (`id_Privilegio`,`id_Grupo`,`id_Empresa`) VALUES
('25','9','29');



-- -------------------------------------------
-- TABLE DATA grupousuario
-- -------------------------------------------
INSERT INTO `grupousuario` (`idGrupo`,`descripcion`,`id_Empresa`) VALUES
('1','grupoPrueba','3');
INSERT INTO `grupousuario` (`idGrupo`,`descripcion`,`id_Empresa`) VALUES
('2','prueba2','3');
INSERT INTO `grupousuario` (`idGrupo`,`descripcion`,`id_Empresa`) VALUES
('3','afas','3');
INSERT INTO `grupousuario` (`idGrupo`,`descripcion`,`id_Empresa`) VALUES
('4','pruebaPriv','3');
INSERT INTO `grupousuario` (`idGrupo`,`descripcion`,`id_Empresa`) VALUES
('5','pruebaPriv','3');
INSERT INTO `grupousuario` (`idGrupo`,`descripcion`,`id_Empresa`) VALUES
('6','pruebaPriv1','3');
INSERT INTO `grupousuario` (`idGrupo`,`descripcion`,`id_Empresa`) VALUES
('7','gjhdjf','3');
INSERT INTO `grupousuario` (`idGrupo`,`descripcion`,`id_Empresa`) VALUES
('8','Contador','28');
INSERT INTO `grupousuario` (`idGrupo`,`descripcion`,`id_Empresa`) VALUES
('9','Contador','29');



-- -------------------------------------------
-- TABLE DATA librodiario
-- -------------------------------------------
INSERT INTO `librodiario` (`idDiario`,`fechaIni`,`fechaFin`) VALUES
('1','2016-07-14','2016-07-23');
INSERT INTO `librodiario` (`idDiario`,`fechaIni`,`fechaFin`) VALUES
('2','2016-07-14','2016-07-20');
INSERT INTO `librodiario` (`idDiario`,`fechaIni`,`fechaFin`) VALUES
('3','2016-07-14','2016-07-20');
INSERT INTO `librodiario` (`idDiario`,`fechaIni`,`fechaFin`) VALUES
('4','2016-07-14','2016-07-20');
INSERT INTO `librodiario` (`idDiario`,`fechaIni`,`fechaFin`) VALUES
('5','2016-07-16','2016-07-20');
INSERT INTO `librodiario` (`idDiario`,`fechaIni`,`fechaFin`) VALUES
('6','2016-07-16','2016-07-20');
INSERT INTO `librodiario` (`idDiario`,`fechaIni`,`fechaFin`) VALUES
('7','2016-07-16','2016-07-20');
INSERT INTO `librodiario` (`idDiario`,`fechaIni`,`fechaFin`) VALUES
('8','2016-07-16','2016-07-20');
INSERT INTO `librodiario` (`idDiario`,`fechaIni`,`fechaFin`) VALUES
('9','2016-07-16','2016-07-20');
INSERT INTO `librodiario` (`idDiario`,`fechaIni`,`fechaFin`) VALUES
('10','2016-07-16','2016-07-20');
INSERT INTO `librodiario` (`idDiario`,`fechaIni`,`fechaFin`) VALUES
('11','2016-07-16','2016-07-20');
INSERT INTO `librodiario` (`idDiario`,`fechaIni`,`fechaFin`) VALUES
('12','2016-07-16','2016-07-20');
INSERT INTO `librodiario` (`idDiario`,`fechaIni`,`fechaFin`) VALUES
('13','2016-07-16','2016-07-20');
INSERT INTO `librodiario` (`idDiario`,`fechaIni`,`fechaFin`) VALUES
('14','2016-07-16','2016-07-20');
INSERT INTO `librodiario` (`idDiario`,`fechaIni`,`fechaFin`) VALUES
('15','2016-07-16','2016-07-20');
INSERT INTO `librodiario` (`idDiario`,`fechaIni`,`fechaFin`) VALUES
('16','2016-07-16','2016-07-20');
INSERT INTO `librodiario` (`idDiario`,`fechaIni`,`fechaFin`) VALUES
('17','2016-07-16','2016-07-20');
INSERT INTO `librodiario` (`idDiario`,`fechaIni`,`fechaFin`) VALUES
('18','2016-07-16','2016-07-20');
INSERT INTO `librodiario` (`idDiario`,`fechaIni`,`fechaFin`) VALUES
('19','2016-07-10','2016-07-16');
INSERT INTO `librodiario` (`idDiario`,`fechaIni`,`fechaFin`) VALUES
('20','2016-07-18','2016-07-22');
INSERT INTO `librodiario` (`idDiario`,`fechaIni`,`fechaFin`) VALUES
('21','2016-07-18','2016-07-22');
INSERT INTO `librodiario` (`idDiario`,`fechaIni`,`fechaFin`) VALUES
('22','2016-07-18','2016-07-22');
INSERT INTO `librodiario` (`idDiario`,`fechaIni`,`fechaFin`) VALUES
('23','2016-07-18','2016-07-22');
INSERT INTO `librodiario` (`idDiario`,`fechaIni`,`fechaFin`) VALUES
('24','2016-07-16','2016-07-22');
INSERT INTO `librodiario` (`idDiario`,`fechaIni`,`fechaFin`) VALUES
('25','2016-07-14','2016-07-22');



-- -------------------------------------------
-- TABLE DATA libromayor
-- -------------------------------------------
INSERT INTO `libromayor` (`idMayor`,`codCuenta`,`fechaIni`,`fechaFin`) VALUES
('1','1','2016-07-13','2016-07-23');
INSERT INTO `libromayor` (`idMayor`,`codCuenta`,`fechaIni`,`fechaFin`) VALUES
('2','','2016-07-16','2016-07-22');
INSERT INTO `libromayor` (`idMayor`,`codCuenta`,`fechaIni`,`fechaFin`) VALUES
('3','','2016-07-16','2016-07-22');
INSERT INTO `libromayor` (`idMayor`,`codCuenta`,`fechaIni`,`fechaFin`) VALUES
('4','1','2016-07-15','2016-07-22');
INSERT INTO `libromayor` (`idMayor`,`codCuenta`,`fechaIni`,`fechaFin`) VALUES
('5','1','2016-07-15','2016-07-22');
INSERT INTO `libromayor` (`idMayor`,`codCuenta`,`fechaIni`,`fechaFin`) VALUES
('6','1','2016-07-15','2016-07-22');
INSERT INTO `libromayor` (`idMayor`,`codCuenta`,`fechaIni`,`fechaFin`) VALUES
('7','1','2016-07-15','2016-07-22');
INSERT INTO `libromayor` (`idMayor`,`codCuenta`,`fechaIni`,`fechaFin`) VALUES
('8','1','2016-07-06','2016-07-29');
INSERT INTO `libromayor` (`idMayor`,`codCuenta`,`fechaIni`,`fechaFin`) VALUES
('9','1','2016-07-05','2016-07-28');



-- -------------------------------------------
-- TABLE DATA moneda
-- -------------------------------------------
INSERT INTO `moneda` (`codMoneda`,`tipoMoneda`,`simbolo`,`id_Empresa`) VALUES
('1','pruebaMoneda','$·','3');



-- -------------------------------------------
-- TABLE DATA nivel
-- -------------------------------------------
INSERT INTO `nivel` (`idNivel`,`descripcion`,`id_Empresa`) VALUES
('1','Primer nivel','3');
INSERT INTO `nivel` (`idNivel`,`descripcion`,`id_Empresa`) VALUES
('2','Segundo nivel','3');
INSERT INTO `nivel` (`idNivel`,`descripcion`,`id_Empresa`) VALUES
('3','Tercer Nivel','3');
INSERT INTO `nivel` (`idNivel`,`descripcion`,`id_Empresa`) VALUES
('4','Cuarto Nivel','3');
INSERT INTO `nivel` (`idNivel`,`descripcion`,`id_Empresa`) VALUES
('5','Quinto Nivel','3');



-- -------------------------------------------
-- TABLE DATA privilegio
-- -------------------------------------------
INSERT INTO `privilegio` (`idPrivilegio`,`nombre`,`idPadre`) VALUES
('1','Asiento','');
INSERT INTO `privilegio` (`idPrivilegio`,`nombre`,`idPadre`) VALUES
('2','bitacora','');
INSERT INTO `privilegio` (`idPrivilegio`,`nombre`,`idPadre`) VALUES
('3','cheque','');
INSERT INTO `privilegio` (`idPrivilegio`,`nombre`,`idPadre`) VALUES
('4','cuenta','');
INSERT INTO `privilegio` (`idPrivilegio`,`nombre`,`idPadre`) VALUES
('5','detalleAsiento','');
INSERT INTO `privilegio` (`idPrivilegio`,`nombre`,`idPadre`) VALUES
('6','empresa','');
INSERT INTO `privilegio` (`idPrivilegio`,`nombre`,`idPadre`) VALUES
('7','facturaCompra','');
INSERT INTO `privilegio` (`idPrivilegio`,`nombre`,`idPadre`) VALUES
('8','facturaVenta','');
INSERT INTO `privilegio` (`idPrivilegio`,`nombre`,`idPadre`) VALUES
('9','grupoCuenta','');
INSERT INTO `privilegio` (`idPrivilegio`,`nombre`,`idPadre`) VALUES
('10','grupoPrivilegio','');
INSERT INTO `privilegio` (`idPrivilegio`,`nombre`,`idPadre`) VALUES
('11','grupoUsuario','');
INSERT INTO `privilegio` (`idPrivilegio`,`nombre`,`idPadre`) VALUES
('12','moneda','');
INSERT INTO `privilegio` (`idPrivilegio`,`nombre`,`idPadre`) VALUES
('13','nivel','');
INSERT INTO `privilegio` (`idPrivilegio`,`nombre`,`idPadre`) VALUES
('14','personalizacion','');
INSERT INTO `privilegio` (`idPrivilegio`,`nombre`,`idPadre`) VALUES
('15','privilegio','');
INSERT INTO `privilegio` (`idPrivilegio`,`nombre`,`idPadre`) VALUES
('16','respaldo','');
INSERT INTO `privilegio` (`idPrivilegio`,`nombre`,`idPadre`) VALUES
('17','tipoAsiento','');
INSERT INTO `privilegio` (`idPrivilegio`,`nombre`,`idPadre`) VALUES
('18','user','');
INSERT INTO `privilegio` (`idPrivilegio`,`nombre`,`idPadre`) VALUES
('19','LibroDiario','');
INSERT INTO `privilegio` (`idPrivilegio`,`nombre`,`idPadre`) VALUES
('20','LibroMayor','');
INSERT INTO `privilegio` (`idPrivilegio`,`nombre`,`idPadre`) VALUES
('21','sumasYSaldos','');
INSERT INTO `privilegio` (`idPrivilegio`,`nombre`,`idPadre`) VALUES
('22','balanceGeneral','');
INSERT INTO `privilegio` (`idPrivilegio`,`nombre`,`idPadre`) VALUES
('23','estadoDeResultado','');
INSERT INTO `privilegio` (`idPrivilegio`,`nombre`,`idPadre`) VALUES
('24','LibroDeCompras','');
INSERT INTO `privilegio` (`idPrivilegio`,`nombre`,`idPadre`) VALUES
('25','LibroDeVentas','');



-- -------------------------------------------
-- TABLE DATA respaldo
-- -------------------------------------------
INSERT INTO `respaldo` (`codigoRespaldo`,`descripcion`,`id_Asiento`,`id_Empresa`,`tipoResp`) VALUES
('1','asdasdasd','','3','3');
INSERT INTO `respaldo` (`codigoRespaldo`,`descripcion`,`id_Asiento`,`id_Empresa`,`tipoResp`) VALUES
('2','asdasdadasdasd','','3','3');
INSERT INTO `respaldo` (`codigoRespaldo`,`descripcion`,`id_Asiento`,`id_Empresa`,`tipoResp`) VALUES
('3','asdasdadasdasd','','3','3');
INSERT INTO `respaldo` (`codigoRespaldo`,`descripcion`,`id_Asiento`,`id_Empresa`,`tipoResp`) VALUES
('4','dasdasd','','3','3');
INSERT INTO `respaldo` (`codigoRespaldo`,`descripcion`,`id_Asiento`,`id_Empresa`,`tipoResp`) VALUES
('5','dasdasd','','3','3');
INSERT INTO `respaldo` (`codigoRespaldo`,`descripcion`,`id_Asiento`,`id_Empresa`,`tipoResp`) VALUES
('6','asjflkasjfljasdklfj','','3','3');
INSERT INTO `respaldo` (`codigoRespaldo`,`descripcion`,`id_Asiento`,`id_Empresa`,`tipoResp`) VALUES
('7','pruebaRespaldo','','3','3');
INSERT INTO `respaldo` (`codigoRespaldo`,`descripcion`,`id_Asiento`,`id_Empresa`,`tipoResp`) VALUES
('8','HolaMundo','','3','3');
INSERT INTO `respaldo` (`codigoRespaldo`,`descripcion`,`id_Asiento`,`id_Empresa`,`tipoResp`) VALUES
('9','HolaMundoasdfasdfsdf','','3','3');
INSERT INTO `respaldo` (`codigoRespaldo`,`descripcion`,`id_Asiento`,`id_Empresa`,`tipoResp`) VALUES
('10','HolaMundo','','3','3');
INSERT INTO `respaldo` (`codigoRespaldo`,`descripcion`,`id_Asiento`,`id_Empresa`,`tipoResp`) VALUES
('11','HolaMundo','','3','3');
INSERT INTO `respaldo` (`codigoRespaldo`,`descripcion`,`id_Asiento`,`id_Empresa`,`tipoResp`) VALUES
('12','HolaMundo','','3','3');
INSERT INTO `respaldo` (`codigoRespaldo`,`descripcion`,`id_Asiento`,`id_Empresa`,`tipoResp`) VALUES
('13','HolaMundo','','3','3');
INSERT INTO `respaldo` (`codigoRespaldo`,`descripcion`,`id_Asiento`,`id_Empresa`,`tipoResp`) VALUES
('14','echele profe
','','3','3');
INSERT INTO `respaldo` (`codigoRespaldo`,`descripcion`,`id_Asiento`,`id_Empresa`,`tipoResp`) VALUES
('15','v,dgbsdfsf','','3','3');
INSERT INTO `respaldo` (`codigoRespaldo`,`descripcion`,`id_Asiento`,`id_Empresa`,`tipoResp`) VALUES
('16','fdfafafafafaf','','3','3');
INSERT INTO `respaldo` (`codigoRespaldo`,`descripcion`,`id_Asiento`,`id_Empresa`,`tipoResp`) VALUES
('17','los quiero hijitos','','3','3');
INSERT INTO `respaldo` (`codigoRespaldo`,`descripcion`,`id_Asiento`,`id_Empresa`,`tipoResp`) VALUES
('18','haha','','3','3');
INSERT INTO `respaldo` (`codigoRespaldo`,`descripcion`,`id_Asiento`,`id_Empresa`,`tipoResp`) VALUES
('19','ljasflkasdjfkljasdf','','3','3');
INSERT INTO `respaldo` (`codigoRespaldo`,`descripcion`,`id_Asiento`,`id_Empresa`,`tipoResp`) VALUES
('20','feafafaf','','3','3');
INSERT INTO `respaldo` (`codigoRespaldo`,`descripcion`,`id_Asiento`,`id_Empresa`,`tipoResp`) VALUES
('21','fafafafa','','3','3');
INSERT INTO `respaldo` (`codigoRespaldo`,`descripcion`,`id_Asiento`,`id_Empresa`,`tipoResp`) VALUES
('22','Carlini','','3','3');



-- -------------------------------------------
-- TABLE DATA tipoasiento
-- -------------------------------------------
INSERT INTO `tipoasiento` (`idTipo`,`descripcion`,`id_Empresa`) VALUES
('1','tipoAsientoPrueba','3');



-- -------------------------------------------
-- TABLE DATA usuario
-- -------------------------------------------
INSERT INTO `usuario` (`idUsuario`,`nombre`,`userName`,`passwd`,`id_Empresa`,`direccion`,`telefono`,`id_Grupo`) VALUES
('1','userPrueba','userPrueba','123456','3','Carlini','123456','1');
INSERT INTO `usuario` (`idUsuario`,`nombre`,`userName`,`passwd`,`id_Empresa`,`direccion`,`telefono`,`id_Grupo`) VALUES
('2','Carlos','Carlini95','12346','3','locohost','456123','1');
INSERT INTO `usuario` (`idUsuario`,`nombre`,`userName`,`passwd`,`id_Empresa`,`direccion`,`telefono`,`id_Grupo`) VALUES
('3','Luis','Lucho','123456','3','asd','456','2');
INSERT INTO `usuario` (`idUsuario`,`nombre`,`userName`,`passwd`,`id_Empresa`,`direccion`,`telefono`,`id_Grupo`) VALUES
('4','tumama','tumamauser','123456','29','tuhermana','12345678','9');
INSERT INTO `usuario` (`idUsuario`,`nombre`,`userName`,`passwd`,`id_Empresa`,`direccion`,`telefono`,`id_Grupo`) VALUES
('5','tumama','tumamauser','123456','29','tuhermana','12345678','9');
INSERT INTO `usuario` (`idUsuario`,`nombre`,`userName`,`passwd`,`id_Empresa`,`direccion`,`telefono`,`id_Grupo`) VALUES
('6','tumama','tumamauser','123456','29','tuhermana','12345678','9');
INSERT INTO `usuario` (`idUsuario`,`nombre`,`userName`,`passwd`,`id_Empresa`,`direccion`,`telefono`,`id_Grupo`) VALUES
('7','tumama','tumamauser','123456','29','tuhermana','12345678','9');
INSERT INTO `usuario` (`idUsuario`,`nombre`,`userName`,`passwd`,`id_Empresa`,`direccion`,`telefono`,`id_Grupo`) VALUES
('8','tumama','tumamauser','123456','29','tuhermana','12345678','9');



-- -------------------------------------------
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
COMMIT;
-- -------------------------------------------
-- -------------------------------------------
-- END BACKUP
-- -------------------------------------------

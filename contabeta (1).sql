-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-05-2017 a las 19:18:25
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `contabeta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asiento`
--

CREATE TABLE `asiento` (
  `idAsiento` int(11) NOT NULL,
  `glosa` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `id_Usuario` int(11) NOT NULL,
  `cod_Moneda` int(11) NOT NULL,
  `id_TipoA` int(11) NOT NULL,
  `id_Empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `asiento`
--



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `balancegeneral`
--

CREATE TABLE `balancegeneral` (
  `idBalance` int(11) NOT NULL,
  `fechaIni` date NOT NULL,
  `fechaFin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `balancesumassaldos`
--

CREATE TABLE `balancesumassaldos` (
  `idBalance` int(11) NOT NULL,
  `fechaIni` date NOT NULL,
  `fechaFin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `balancesumassaldos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `idBitacora` int(11) NOT NULL,
  `fechaHora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `actividad` varchar(50) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `id_Empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bitacora`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cheque`
--

CREATE TABLE `cheque` (
  `codigoResp` int(11) NOT NULL,
  `nroCuenta` int(11) NOT NULL,
  `nombreReceptor` varchar(70) NOT NULL,
  `monto` float NOT NULL,
  `fecha` date NOT NULL,
  `id_Empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cheque`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE `cuenta` (
  `codigoCuenta` varchar(20) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `codPadre` varchar(20) DEFAULT NULL,
  `id_Empresa` int(11) NOT NULL,
  `id_Nivel` int(11) NOT NULL,
  `cod_Grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cuenta`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleasiento`
--

CREATE TABLE `detalleasiento` (
  `id_Asiento` int(11) NOT NULL,
  `codigo_Cuenta` varchar(20) NOT NULL,
  `debe` float DEFAULT NULL,
  `haber` float DEFAULT NULL,
  `id_Empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalleasiento`
--



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `idEmpresa` int(11) NOT NULL,
  `nit` double NOT NULL,
  `razonSocial` varchar(50) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `ciudad` varchar(50) DEFAULT NULL,
  `pais` varchar(50) DEFAULT NULL,
  `telefono` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empresa`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadoresultado`
--

CREATE TABLE `estadoresultado` (
  `idEstado` int(11) NOT NULL,
  `fechaIni` date NOT NULL,
  `fechaFin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturacompra`
--

CREATE TABLE `facturacompra` (
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
  `id_Empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `facturacompra`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturaventa`
--

CREATE TABLE `facturaventa` (
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
  `id_Empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupocuenta`
--

CREATE TABLE `grupocuenta` (
  `codGrupo` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `id_Empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupocuenta`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupoprivilegio`
--

CREATE TABLE `grupoprivilegio` (
  `id_Privilegio` int(11) NOT NULL,
  `id_Grupo` int(11) NOT NULL,
  `id_Empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupoprivilegio`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupousuario`
--

CREATE TABLE `grupousuario` (
  `idGrupo` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `id_Empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupousuario`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `librodiario`
--

CREATE TABLE `librodiario` (
  `idDiario` int(11) NOT NULL,
  `fechaIni` date NOT NULL,
  `fechaFin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `librodiario`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libromayor`
--

CREATE TABLE `libromayor` (
  `idMayor` int(11) NOT NULL,
  `fechaIni` date NOT NULL,
  `fechaFin` date NOT NULL,
  `codCuenta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moneda`
--

CREATE TABLE `moneda` (
  `codMoneda` int(11) NOT NULL,
  `tipoMoneda` varchar(20) DEFAULT NULL,
  `simbolo` varchar(5) DEFAULT NULL,
  `id_Empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `moneda`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel`
--

CREATE TABLE `nivel` (
  `idNivel` int(11) NOT NULL,
  `descripcion` varchar(20) NOT NULL,
  `id_Empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nivel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personalizacion`
--

CREATE TABLE `personalizacion` (
  `idPersonalizacion` int(11) NOT NULL,
  `Color` varchar(20) NOT NULL,
  `tamano` varchar(20) NOT NULL,
  `Fuente` varchar(20) NOT NULL,
  `id_Usuario` int(11) NOT NULL,
  `id_Empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `personalizacion`
--

INSERT INTO `personalizacion` (`idPersonalizacion`, `Color`, `tamano`, `Fuente`, `id_Usuario`, `id_Empresa`) VALUES
(12, '#00ff40', 'medium', 'Arial', 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegio`
--

CREATE TABLE `privilegio` (
  `idPrivilegio` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `idPadre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `privilegio`
--

INSERT INTO `privilegio` (`idPrivilegio`, `nombre`, `idPadre`) VALUES
(1, 'Asiento', NULL),
(2, 'bitacora', NULL),
(3, 'cheque', NULL),
(4, 'cuenta', NULL),
(5, 'detalleAsiento', NULL),
(6, 'empresa', NULL),
(7, 'facturaCompra', NULL),
(8, 'facturaVenta', NULL),
(9, 'grupoCuenta', NULL),
(10, 'grupoPrivilegio', NULL),
(11, 'grupoUsuario', NULL),
(12, 'moneda', NULL),
(13, 'nivel', NULL),
(14, 'personalizacion', NULL),
(15, 'privilegio', NULL),
(16, 'respaldo', NULL),
(17, 'tipoAsiento', NULL),
(18, 'user', NULL),
(19, 'LibroDiario', NULL),
(20, 'LibroMayor', NULL),
(21, 'sumasYSaldos', NULL),
(22, 'balanceGeneral', NULL),
(23, 'estadoDeResultado', NULL),
(24, 'LibroDeCompras', NULL),
(25, 'LibroDeVentas', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respaldo`
--

CREATE TABLE `respaldo` (
  `codigoRespaldo` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `id_Asiento` int(11) DEFAULT NULL,
  `id_Empresa` int(11) NOT NULL,
  `tipoResp` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `respaldo`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoasiento`
--

CREATE TABLE `tipoasiento` (
  `idTipo` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `id_Empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipoasiento`
--



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `userName` varchar(20) NOT NULL,
  `passwd` varchar(25) NOT NULL,
  `id_Empresa` int(11) NOT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `id_Grupo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--


--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asiento`
--
ALTER TABLE `asiento`
  ADD PRIMARY KEY (`idAsiento`),
  ADD KEY `id_Usuario` (`id_Usuario`),
  ADD KEY `cod_Moneda` (`cod_Moneda`),
  ADD KEY `id_TipoA` (`id_TipoA`),
  ADD KEY `id_Empresa` (`id_Empresa`);

--
-- Indices de la tabla `balancegeneral`
--
ALTER TABLE `balancegeneral`
  ADD PRIMARY KEY (`idBalance`);

--
-- Indices de la tabla `balancesumassaldos`
--
ALTER TABLE `balancesumassaldos`
  ADD PRIMARY KEY (`idBalance`);

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`idBitacora`),
  ADD KEY `id_Empresa` (`id_Empresa`);

--
-- Indices de la tabla `cheque`
--
ALTER TABLE `cheque`
  ADD PRIMARY KEY (`codigoResp`),
  ADD KEY `id_Empresa` (`id_Empresa`);

--
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`codigoCuenta`),
  ADD KEY `id_Empresa` (`id_Empresa`),
  ADD KEY `codPadre` (`codPadre`),
  ADD KEY `id_Nivel` (`id_Nivel`),
  ADD KEY `cod_Grupo` (`cod_Grupo`);

--
-- Indices de la tabla `detalleasiento`
--
ALTER TABLE `detalleasiento`
  ADD PRIMARY KEY (`id_Asiento`,`codigo_Cuenta`),
  ADD KEY `codigo_Cuenta` (`codigo_Cuenta`),
  ADD KEY `id_Empresa` (`id_Empresa`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`idEmpresa`);

--
-- Indices de la tabla `estadoresultado`
--
ALTER TABLE `estadoresultado`
  ADD PRIMARY KEY (`idEstado`);

--
-- Indices de la tabla `facturacompra`
--
ALTER TABLE `facturacompra`
  ADD PRIMARY KEY (`codigoResp`),
  ADD KEY `id_Empresa` (`id_Empresa`);

--
-- Indices de la tabla `facturaventa`
--
ALTER TABLE `facturaventa`
  ADD PRIMARY KEY (`codigoResp`),
  ADD KEY `id_Empresa` (`id_Empresa`);

--
-- Indices de la tabla `grupocuenta`
--
ALTER TABLE `grupocuenta`
  ADD PRIMARY KEY (`codGrupo`),
  ADD KEY `id_Empresa` (`id_Empresa`);

--
-- Indices de la tabla `grupoprivilegio`
--
ALTER TABLE `grupoprivilegio`
  ADD PRIMARY KEY (`id_Privilegio`,`id_Grupo`),
  ADD KEY `id_Grupo` (`id_Grupo`),
  ADD KEY `id_Empresa` (`id_Empresa`);

--
-- Indices de la tabla `grupousuario`
--
ALTER TABLE `grupousuario`
  ADD PRIMARY KEY (`idGrupo`),
  ADD KEY `id_Empresa` (`id_Empresa`);

--
-- Indices de la tabla `librodiario`
--
ALTER TABLE `librodiario`
  ADD PRIMARY KEY (`idDiario`);

--
-- Indices de la tabla `libromayor`
--
ALTER TABLE `libromayor`
  ADD PRIMARY KEY (`idMayor`);

--
-- Indices de la tabla `moneda`
--
ALTER TABLE `moneda`
  ADD PRIMARY KEY (`codMoneda`),
  ADD KEY `id_Empresa` (`id_Empresa`);

--
-- Indices de la tabla `nivel`
--
ALTER TABLE `nivel`
  ADD PRIMARY KEY (`idNivel`),
  ADD KEY `id_Empresa` (`id_Empresa`);

--
-- Indices de la tabla `personalizacion`
--
ALTER TABLE `personalizacion`
  ADD PRIMARY KEY (`idPersonalizacion`),
  ADD KEY `id_Empresa` (`id_Empresa`);

--
-- Indices de la tabla `privilegio`
--
ALTER TABLE `privilegio`
  ADD PRIMARY KEY (`idPrivilegio`),
  ADD KEY `idPadre` (`idPadre`);

--
-- Indices de la tabla `respaldo`
--
ALTER TABLE `respaldo`
  ADD PRIMARY KEY (`codigoRespaldo`),
  ADD KEY `id_Asiento` (`id_Asiento`),
  ADD KEY `id_Empresa` (`id_Empresa`);

--
-- Indices de la tabla `tipoasiento`
--
ALTER TABLE `tipoasiento`
  ADD PRIMARY KEY (`idTipo`),
  ADD KEY `id_Empresa` (`id_Empresa`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `id_Empresa` (`id_Empresa`),
  ADD KEY `id_Grupo` (`id_Grupo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asiento`
--
ALTER TABLE `asiento`
  MODIFY `idAsiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `balancegeneral`
--
ALTER TABLE `balancegeneral`
  MODIFY `idBalance` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `balancesumassaldos`
--
ALTER TABLE `balancesumassaldos`
  MODIFY `idBalance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `idBitacora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `idEmpresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT de la tabla `estadoresultado`
--
ALTER TABLE `estadoresultado`
  MODIFY `idEstado` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `grupousuario`
--
ALTER TABLE `grupousuario`
  MODIFY `idGrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `librodiario`
--
ALTER TABLE `librodiario`
  MODIFY `idDiario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `libromayor`
--
ALTER TABLE `libromayor`
  MODIFY `idMayor` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `moneda`
--
ALTER TABLE `moneda`
  MODIFY `codMoneda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `nivel`
--
ALTER TABLE `nivel`
  MODIFY `idNivel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `personalizacion`
--
ALTER TABLE `personalizacion`
  MODIFY `idPersonalizacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `respaldo`
--
ALTER TABLE `respaldo`
  MODIFY `codigoRespaldo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asiento`
--
ALTER TABLE `asiento`
  ADD CONSTRAINT `asiento_ibfk_1` FOREIGN KEY (`id_Usuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asiento_ibfk_2` FOREIGN KEY (`cod_Moneda`) REFERENCES `moneda` (`codMoneda`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asiento_ibfk_3` FOREIGN KEY (`id_TipoA`) REFERENCES `tipoasiento` (`idTipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asiento_ibfk_4` FOREIGN KEY (`id_Empresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD CONSTRAINT `bitacora_ibfk_1` FOREIGN KEY (`id_Empresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cheque`
--
ALTER TABLE `cheque`
  ADD CONSTRAINT `cheque_ibfk_1` FOREIGN KEY (`codigoResp`) REFERENCES `respaldo` (`codigoRespaldo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cheque_ibfk_2` FOREIGN KEY (`id_Empresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD CONSTRAINT `cuenta_ibfk_1` FOREIGN KEY (`id_Empresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cuenta_ibfk_2` FOREIGN KEY (`codPadre`) REFERENCES `cuenta` (`codigoCuenta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cuenta_ibfk_3` FOREIGN KEY (`id_Nivel`) REFERENCES `nivel` (`idNivel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cuenta_ibfk_4` FOREIGN KEY (`cod_Grupo`) REFERENCES `grupocuenta` (`codGrupo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalleasiento`
--
ALTER TABLE `detalleasiento`
  ADD CONSTRAINT `detalleasiento_ibfk_1` FOREIGN KEY (`id_Asiento`) REFERENCES `asiento` (`idAsiento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalleasiento_ibfk_2` FOREIGN KEY (`codigo_Cuenta`) REFERENCES `cuenta` (`codigoCuenta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalleasiento_ibfk_3` FOREIGN KEY (`id_Empresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `facturacompra`
--
ALTER TABLE `facturacompra`
  ADD CONSTRAINT `facturacompra_ibfk_1` FOREIGN KEY (`codigoResp`) REFERENCES `respaldo` (`codigoRespaldo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `facturacompra_ibfk_2` FOREIGN KEY (`id_Empresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `facturaventa`
--
ALTER TABLE `facturaventa`
  ADD CONSTRAINT `facturaventa_ibfk_1` FOREIGN KEY (`codigoResp`) REFERENCES `respaldo` (`codigoRespaldo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `facturaventa_ibfk_2` FOREIGN KEY (`id_Empresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `grupocuenta`
--
ALTER TABLE `grupocuenta`
  ADD CONSTRAINT `grupocuenta_ibfk_1` FOREIGN KEY (`id_Empresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `grupoprivilegio`
--
ALTER TABLE `grupoprivilegio`
  ADD CONSTRAINT `grupoprivilegio_ibfk_1` FOREIGN KEY (`id_Privilegio`) REFERENCES `privilegio` (`idPrivilegio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grupoprivilegio_ibfk_2` FOREIGN KEY (`id_Grupo`) REFERENCES `grupousuario` (`idGrupo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grupoprivilegio_ibfk_3` FOREIGN KEY (`id_Empresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `grupousuario`
--
ALTER TABLE `grupousuario`
  ADD CONSTRAINT `grupousuario_ibfk_1` FOREIGN KEY (`id_Empresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `moneda`
--
ALTER TABLE `moneda`
  ADD CONSTRAINT `moneda_ibfk_1` FOREIGN KEY (`id_Empresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `nivel`
--
ALTER TABLE `nivel`
  ADD CONSTRAINT `nivel_ibfk_1` FOREIGN KEY (`id_Empresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `personalizacion`
--
ALTER TABLE `personalizacion`
  ADD CONSTRAINT `personalizacion_ibfk_1` FOREIGN KEY (`id_Empresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `personalizacion_ibfk_2` FOREIGN KEY (`id_Empresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `privilegio`
--
ALTER TABLE `privilegio`
  ADD CONSTRAINT `privilegio_ibfk_1` FOREIGN KEY (`idPadre`) REFERENCES `privilegio` (`idPrivilegio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `respaldo`
--
ALTER TABLE `respaldo`
  ADD CONSTRAINT `respaldo_ibfk_1` FOREIGN KEY (`id_Asiento`) REFERENCES `asiento` (`idAsiento`),
  ADD CONSTRAINT `respaldo_ibfk_2` FOREIGN KEY (`id_Empresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tipoasiento`
--
ALTER TABLE `tipoasiento`
  ADD CONSTRAINT `tipoasiento_ibfk_1` FOREIGN KEY (`id_Empresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_Empresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`id_Grupo`) REFERENCES `grupousuario` (`idGrupo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

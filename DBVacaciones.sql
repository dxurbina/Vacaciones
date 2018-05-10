-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-05-2018 a las 21:31:49
-- Versión del servidor: 5.7.21-log
-- Versión de PHP: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
use Vacaciones;
--
-- Base de datos: `vacaciones`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `adduser` (IN `_user` NVARCHAR(20), IN `pass` NVARCHAR(40), `empleado` INT)  begin
	declare idJefe int; declare val int; declare dpto int; declare manager int;declare _cargo varchar(40);
    set dpto = (select d.IdDep from deptosempresa d inner join centrocostos cc on
	d.IdDep = cc.IdDptoEmp inner join Cargos c on cc.IdCosto = c.IdCosto inner join Empleados e on e.IdCargo = c.IdCargo 
    where e.IdEmpleado = empleado);
	set manager = (select IdJefe from Empleados where IdEmpleado = empleado);
    set _cargo = (select c.NombreCargo from Cargos c inner join  Empleados e on e.IdCargo = c.IdCargo 
    where e.IdEmpleado = empleado);
    
    if(manager is null and _cargo = 'Gerente General') then
		insert into Usuarios values(null, _user, pass, 1, 4, empleado);
        else if(dpto = 6) then 
		insert into Usuarios values(null, _user, pass, 1, 3, empleado);
        else insert into Usuarios values(null, _user, pass, 1, 1, empleado);
    end if;
    end if;
    /*
    if(dpto = 14 and idJefe = 4) then /*si id jefe  es igual a recursos humanos*/
	/*	insert into Usuarios values('null', _user, pass, 1, 4, empleado);
    /* end if; */

    
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateRololdBoss` (IN `_jefeanterior` INT)  begin
	declare val int; declare dpto varchar(20); declare bossuser int; declare cant int; declare _cargo varchar(20);
    set bossuser = (select u.IdUsuario  from Usuarios u inner join empleados e on
					u.IdEmpleado = e.IdEmpleado	where e.IdEmpleado = _jefeanterior );
    set cant = (select count(e.IdEmpleado)
                   from empleados e,
                   Cargos c, CentroCostos cc, DeptosEmpresa d where e.IdCargo = c.IdCargo and c.IdCosto =  cc.IdCosto and cc.IdDptoEmp = d.IdDep
                   and e.IdJefe = _jefeanterior and e.Estado = 1);
                   
    set dpto = (select d.Nombre from deptosempresa d inner join centrocostos cc on
	d.IdDep = cc.IdDptoEmp inner join Cargos c on cc.IdCosto = c.IdCosto inner join Empleados e on e.IdCargo = c.IdCargo 
    where e.IdEmpleado = _jefeanterior);  
    
    set val = (select IdRol  from Usuarios where IdEmpleado = _jefeanterior);
       /* make shure that the other name that you want that be RRHH bein in the next validation; in this case is: Talento y bienestar*/            
    if( cant = 0 and dpto != 'Talento y Bienestar') then
		update Usuarios set IdRol = 1 where IdUsuario = bossuser;
    end if;
    
    if(dpto = 'Talento y Bienestar' and val = 5 and cant = 0) then /*si id jefe  es igual a recursos humanos*/
		update Usuarios set IdRol = 3 where IdUsuario = bossuser;
    end if; 
    
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateRoltochangeEmployee` (IN `_empleado` INT)  begin
	declare val int; declare dpto varchar(25); declare cant int; declare _user int; declare _cargo varchar(40);
	set val = (select IdRol  from Usuarios where IdEmpleado = _empleado);
	
    set _user = (select u.IdUsuario  from Usuarios u inner join empleados e on
					u.IdEmpleado = e.IdEmpleado	where e.IdEmpleado = _empleado );
	
    set dpto = (select d.Nombre from deptosempresa d inner join centrocostos cc on
	d.IdDep = cc.IdDptoEmp inner join Cargos c on cc.IdCosto = c.IdCosto inner join Empleados e on e.IdCargo = c.IdCargo 
    where e.IdEmpleado = _empleado);
    
    set _cargo = (
		select c.NombreCargo from Cargos c inner join Empleados e on e.IdCargo = c.IdCargo 
		where e.IdEmpleado = _empleado	
    );
    /* make shure that the other name that you want that be RRHH bein in the next validation; in this case is: Talento y bienestar*/ 
    if(dpto = 'Talento y Bienestar') then /*si id jefe  es igual a recursos humanos*/
			update Usuarios set IdRol = 3 where IdUsuario = _user;
		else
			update Usuarios set IdRol = 1 where IdUsuario = _user;
    end if; 
    
    if(dpto = 'Gerencia General' and _cargo = 'Gerente General') then 
		 	update Usuarios set IdRol = 4 where IdUsuario = _user;
		end if;
    
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateSaldoRequested` (IN `IdVac` INT)  begin
			declare factor int; declare _tipo varchar(100); declare _estado varchar(40);
			set factor = (select f.Factor from Factor f, Cargos c, Empleados e, Vacaciones v where
					f.IdFactor = c.IdFactor and c.IdCargo = e.IdCargo and e.IdEmpleado = v.IdEmpleado
                    and v.IdVacaciones = IdVac);
			set _tipo = (select Tipo from Vacaciones where IdVacaciones = IdVac);
            set _estado = (select Estado from Vacaciones where IdVacaciones = IdVac);
            if _tipo = 'Vacaciones' then
				 if _estado = 'Revertida' then
				update saldovacaciones s inner join Empleados e on s.IdEmpleado = e.IdEmpleado inner join Vacaciones v
				on e.IdEmpleado = v.IdEmpleado
				set s.Saldo = (s.Saldo + (v.CantDias * factor)) where v.IdVacaciones = IdVac;
				else
					update saldovacaciones s inner join Empleados e on s.IdEmpleado = e.IdEmpleado inner join Vacaciones v
					on e.IdEmpleado = v.IdEmpleado
					set s.Saldo = (s.Saldo - (v.CantDias * factor)) where v.IdVacaciones = IdVac;
                end if;
			end if;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `IdCargo` int(11) NOT NULL,
  `NombreCargo` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `IdCosto` int(11) NOT NULL,
  `IdJefe` int(11) DEFAULT NULL,
  `IdFactor` int(11) DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cargos`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centrocostos`
--

CREATE TABLE `centrocostos` (
  `IdCosto` int(11) NOT NULL,
  `Nombre` varchar(25) CHARACTER SET utf8 NOT NULL,
  `Codigo` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `IdDptoEmp` int(11) DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `centrocostos`
--
/*
INSERT INTO `centrocostos` (`IdCosto`, `Nombre`, `Codigo`, `IdDptoEmp`, `Estado`) VALUES
(1, 'RRHH', '2500', 6, 0),
(2, '2000', 'Administración', 3, 1),
(3, 'Administración', '2000', 3, 1),
(4, 'Ventas', '2100', 2, 1),
(5, 'Mercadeo', '2200', 5, 1),
(6, 'Sistemas', '2300', 7, 1),
(7, 'Finanzas', '2400', 3, 1),
(8, 'RRHH', '2500', 6, 1),
(9, 'Sorteos', '2600', 1, 1),
(10, 'Gerencia General', '2800', 4, 1),
(11, 'Promoteam', '2900', 1, 1),
(12, 'Promotores de PDV', '3000', 1, 1),
(13, 'Asuntos Corporativos', '3100', 1, 1),
(14, 'Loto Centro Huembes', '70', 1, 1),
(15, 'Loto Centro Granada', '71', 1, 1),
(16, 'Loto Centro Tipitapa', '72', 1, 1),
(17, 'P.Loto Mer. Oriental Nº 1', '73', 1, 1),
(18, 'Ciudad Sandino', '74', 1, 1),
(19, 'Loto Centro Santa Ana', '75', 1, 1),
(20, '7', '7', 7, 0),
(21, 'System', '2255', 7, 0),
(22, 'dff', '3434', 6, 0);
*/
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `IdDepartamento` int(11) NOT NULL,
  `Nombre` varchar(35) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`IdDepartamento`, `Nombre`) VALUES
(1, 'Boaco'),
(2, 'Carazo'),
(3, 'Estelí'),
(4, 'Granada'),
(5, 'Chinandega'),
(6, 'Chontales'),
(7, 'Jinotega'),
(8, 'León'),
(9, 'Madriz'),
(10, 'Managua'),
(11, 'Masaya'),
(12, 'Matagalpa'),
(13, 'Nueva Segovia'),
(14, 'RAAN'),
(15, 'RAAS'),
(16, 'Río San Juan'),
(17, 'Rivas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deptosempresa`
--

CREATE TABLE `deptosempresa` (
  `IdDep` int(11) NOT NULL,
  `Nombre` varchar(25) CHARACTER SET utf8 NOT NULL,
  `Descripcion` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `deptosempresa`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `IdEmpleado` int(11) NOT NULL,
  `PNombre` varchar(20) CHARACTER SET utf8 NOT NULL,
  `SNombre` varchar(20) CHARACTER SET utf8 NOT NULL,
  `PApellido` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `SApellido` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `Residencia` tinyint(1) DEFAULT NULL,
  `Cedula` varchar(20) CHARACTER SET utf8 NOT NULL,
  `Pasaporte` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `NInss` varchar(12) CHARACTER SET utf8 DEFAULT NULL,
  `FechaNac` date NOT NULL,
  `FechaIngreso` date NOT NULL,
  `Sexo` char(1) NOT NULL,
  `Hijos` tinyint(1) DEFAULT NULL,
  `NumHijos` int(11) DEFAULT NULL,
  `Hermanos` tinyint(1) DEFAULT NULL,
  `NumHermanos` int(11) DEFAULT NULL,
  `Telefono` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `EstadoCivil` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `Correo` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  `Escolaridad` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `NRuc` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `Profesion` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Direccion` varchar(100) CHARACTER SET utf8 NOT NULL,
  `Nacionalidad1` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Nacionalidad2` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT NULL,
  `IdCargo` int(11) NOT NULL,
  `IdJefe` int(11) DEFAULT NULL,
  `IdMunicipio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleados`
--

--
-- Disparadores `empleados`
--
DELIMITER $$
CREATE TRIGGER `AddRol` AFTER UPDATE ON `empleados` FOR EACH ROW begin    
    /*Modificar usuario de nuevo jefe*/
	declare val int; declare dpto varchar(25); declare bossuser int;  declare cant int; declare _cargo varchar(40);
	set bossuser = (select IdUsuario  from Usuarios where IdEmpleado = new.IdJefe );
    set dpto = (select d.Nombre from deptosempresa d inner join centrocostos cc on
	d.IdDep = cc.IdDptoEmp inner join Cargos c on cc.IdCosto = c.IdCosto inner join Empleados e on e.IdCargo = c.IdCargo 
    where e.IdEmpleado = new.IdJefe);
    set _cargo = (
		select c.NombreCargo from Cargos c inner join Empleados e on e.IdCargo = c.IdCargo 
		where e.IdEmpleado = new.IdJefe		
    );
    
    set val = (select IdRol  from Usuarios where IdEmpleado = new.IdJefe);
    if(dpto = 'RRHH' and val = 3) then /*si id jefe  es igual a recursos humanos*/
		update Usuarios set IdRol = 5 where IdUsuario = bossuser;
    else 
		if(val = 1) then 
		 	update Usuarios set IdRol = 2 where IdUsuario = bossuser;
		end if;
    end if; 
	/* make shure that the other name that you want that be RRHH bein in the next validation; in this case is: Talento y bienestar*/ 
    if(dpto = 'Talento y Bienestar' and _cargo = 'Gerente General') then 
		 	update Usuarios set IdRol = 4 where IdUsuario = bossuser;
		end if;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factor`
--

CREATE TABLE `factor` (
  `IdFactor` int(11) NOT NULL,
  `Nombre` varchar(25) CHARACTER SET utf8 NOT NULL,
  `Factor` float DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `factor`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `feriados`
--

CREATE TABLE `feriados` (
  `IdFeriado` int(11) NOT NULL,
  `Nombre` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `Fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `feriados`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE `municipio` (
  `IdMunicipio` int(11) NOT NULL,
  `Nombre` varchar(35) CHARACTER SET utf8 DEFAULT NULL,
  `IdDepartamento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`IdMunicipio`, `Nombre`, `IdDepartamento`) VALUES
(1, 'Boaco', 1),
(2, 'Camoapa', 1),
(3, 'San José de los Remates', 1),
(4, 'San Lorenzo', 1),
(5, 'Santa Lucía', 1),
(6, 'Teustepe', 1),
(7, 'Jinotepe', 2),
(8, 'Diriamba', 2),
(9, 'Dolores', 2),
(10, 'El rosario', 2),
(11, 'La conquista', 2),
(12, 'La Paz de Carazo', 2),
(13, 'San Marcos', 2),
(14, 'Santa Teresa', 2),
(15, 'Estelí', 3),
(16, 'Condega', 3),
(17, 'La Trinidad', 3),
(18, 'Pueblo Nuevo', 3),
(19, 'San Juan de Limay', 3),
(20, 'San Nicolás', 3),
(21, 'Granada', 4),
(22, 'Diriá', 4),
(23, 'Diriomo', 4),
(24, 'Nandaime', 4),
(25, 'Chinandega', 5),
(26, 'Chichigalpa', 5),
(27, 'Cinco Pinos', 5),
(28, 'Corinto', 5),
(29, 'El Realejo', 5),
(30, 'El Viejo', 5),
(31, 'Posoltega', 5),
(32, 'Puerto Morazán', 5),
(33, 'San Francisco del Norte', 5),
(34, 'San Pedro del Norte', 5),
(35, 'Santo Tomás del Norte', 5),
(36, 'Somotillo', 5),
(37, 'Villanueva', 5),
(38, 'Juigalpa', 6),
(39, 'Acoyapa', 6),
(40, 'Comalapa', 6),
(41, 'La Libertad', 6),
(42, 'San Pedro de Lóvago', 6),
(43, 'Santo Domingo', 6),
(44, 'santo Tomás', 6),
(45, 'Villa Sandino', 6),
(46, 'El Coral', 6),
(47, 'San Francisco de Cuapa', 6),
(48, 'Jinotega', 7),
(49, 'El Cúa', 7),
(50, 'La Concordia', 7),
(51, 'San José de Bocay', 7),
(52, 'San Rafael del Norte', 7),
(53, 'San Sebastian de Yalí', 7),
(54, 'Santa María de Pantasma', 7),
(55, 'Wiwili de Jinotega', 7),
(56, 'León', 8),
(57, 'Achuapa', 8),
(58, 'El Jicaral', 8),
(59, 'El Sauce', 8),
(60, 'La Paz Centro', 8),
(61, 'Larreynaga', 8),
(62, 'Nagaroto', 8),
(63, 'Quezalguaque', 8),
(64, 'Santa Rosa del Peñón', 8),
(65, 'Telica', 8),
(66, 'Somoto', 9),
(67, 'Las Sabanaas', 9),
(68, 'Palacaguina', 9),
(69, 'San José de Cusmapa', 9),
(70, 'San Juan de Río Coco', 9),
(71, 'San Lucas', 9),
(72, 'Telpaneca', 9),
(73, 'Totogalpa', 9),
(74, 'Yalaguina', 9),
(75, 'Managua', 10),
(76, 'Ciudad Sandino', 10),
(77, 'El crucero', 10),
(78, 'Mateare', 10),
(79, 'San Francisco Libre', 10),
(80, 'San Rafael del Sur', 10),
(81, 'Ticuantepe', 10),
(82, 'Tipitapa', 10),
(83, 'Villa Carlos Fonseca', 10),
(84, 'Masaya', 11),
(85, 'Catarina', 11),
(86, 'La Concepción', 11),
(87, 'Masatepe', 11),
(88, 'Nandasmo', 11),
(89, 'Nindirí', 11),
(90, 'Niquinomo', 11),
(91, 'San Juan de Oriente', 11),
(92, 'Tisma', 11),
(93, 'Matagalpa', 12),
(94, 'Ciudad Darío', 12),
(95, 'Esquipulas', 12),
(96, 'Matiguás', 12),
(97, 'Muy Muy', 12),
(98, 'Rancho Grande', 12),
(99, 'Río Blanco', 12),
(100, 'San Dionisio', 12),
(101, 'San Isidro', 12),
(102, 'San Ramón', 12),
(103, 'Sébaco', 12),
(104, 'Terrabona', 12),
(105, 'Tuma-La Dalia', 12),
(106, 'Ocotal', 13),
(107, 'Dipilto', 13),
(108, 'El Jicaro', 13),
(109, 'Jalapa', 13),
(110, 'Macuelizo', 13),
(111, 'Mosonte', 13),
(112, 'Murra', 13),
(113, 'Quilalí', 13),
(114, 'San Fernando', 13),
(115, 'Wiwili de Nueva Segovia', 13),
(116, 'Santa María', 13),
(117, 'Ciudad Antigua', 13),
(118, 'Puerto Cabezas', 14),
(119, 'Bonanzas', 14),
(120, 'Prinzapolka', 14),
(121, 'Rosita', 14),
(122, 'Siuna', 14),
(123, 'Waslala', 14),
(124, 'Waspan', 14),
(125, 'Mulukukú', 14),
(126, 'Blufields', 15),
(127, 'Corn Island', 15),
(128, 'Desembocad. del Río Grande', 15),
(129, 'El Rama', 15),
(130, 'El Tortuguero', 15),
(131, 'Kukra Hill', 15),
(132, 'La Cruz de Río Grande', 15),
(133, 'Laguna de Perlas', 15),
(134, 'Muelle de los Bueyes ', 15),
(135, 'Nueva Guinea', 15),
(136, 'El Ayote', 15),
(137, 'Paiwas', 15),
(138, 'San Carlos', 16),
(139, 'El Almendro', 16),
(140, 'El Castillo', 16),
(141, 'Morrito', 16),
(142, 'San Juan De Nicaragua', 16),
(143, 'San Miguelito', 16),
(144, 'Rivas', 17),
(145, 'Belén', 17),
(146, 'Buenos Aires', 17),
(147, 'Cárdenas', 17),
(148, 'Moyogalpa', 17),
(149, 'Potosi', 17),
(150, 'San Jorge', 17),
(151, 'San Juan del Sur', 17),
(152, 'Tola', 17),
(153, 'Altagracia', 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `IdNotificacion` int(11) NOT NULL,
  `Fecha` date DEFAULT NULL,
  `IdRemitente` int(11) NOT NULL,
  `IdDestinatario` int(11) NOT NULL,
  `Mensaje` varchar(200) DEFAULT NULL,
  `Tipo` varchar(40) DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT NULL,
  `EstadoMail` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `notificaciones`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `IdRol` int(11) NOT NULL,
  `NombreRol` varchar(20) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`IdRol`, `NombreRol`) VALUES
(4, 'Admin'),
(1, 'Colaborador'),
(3, 'Digitador'),
(5, 'RRHH-Supervisor'),
(2, 'Supervisor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `saldovacaciones`
--

CREATE TABLE `saldovacaciones` (
  `IdSaldo` int(11) NOT NULL,
  `Saldo` decimal(5,2) DEFAULT NULL,
  `FechaConsulta` date DEFAULT NULL,
  `IdEmpleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `saldovacaciones`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `IdUsuario` int(11) NOT NULL,
  `Usuario` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `Pass` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT NULL,
  `IdRol` int(11) DEFAULT NULL,
  `IdEmpleado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacaciones`
--

CREATE TABLE `vacaciones` (
  `IdVacaciones` int(11) NOT NULL,
  `FechaI` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `FechaF` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Tipo` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `CantDias` int(11) NOT NULL,
  `Estado` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `IdEmpleado` int(11) NOT NULL,
  `IdRespSup` int(11) DEFAULT NULL,
  `FechaSolicitud` date DEFAULT NULL,
  `FechaRespuesta` date DEFAULT NULL,
  `Descripcion` varchar(200) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vacaciones`
--


--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`IdCargo`),
  ADD KEY `IdCosto` (`IdCosto`),
  ADD KEY `IdJefe` (`IdJefe`),
  ADD KEY `IdFactor` (`IdFactor`);

--
-- Indices de la tabla `centrocostos`
--
ALTER TABLE `centrocostos`
  ADD PRIMARY KEY (`IdCosto`),
  ADD KEY `IdDptoEmp` (`IdDptoEmp`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`IdDepartamento`);

--
-- Indices de la tabla `deptosempresa`
--
ALTER TABLE `deptosempresa`
  ADD PRIMARY KEY (`IdDep`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`IdEmpleado`),
  ADD KEY `IdCargo` (`IdCargo`),
  ADD KEY `IdJefe` (`IdJefe`),
  ADD KEY `IdMunicipio` (`IdMunicipio`);

--
-- Indices de la tabla `factor`
--
ALTER TABLE `factor`
  ADD PRIMARY KEY (`IdFactor`);

--
-- Indices de la tabla `feriados`
--
ALTER TABLE `feriados`
  ADD PRIMARY KEY (`IdFeriado`);

--
-- Indices de la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`IdMunicipio`),
  ADD KEY `IdDepartamento` (`IdDepartamento`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`IdNotificacion`),
  ADD KEY `IdRemitente` (`IdRemitente`),
  ADD KEY `IdDestinatario` (`IdDestinatario`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`IdRol`),
  ADD UNIQUE KEY `NombreRol` (`NombreRol`);

--
-- Indices de la tabla `saldovacaciones`
--
ALTER TABLE `saldovacaciones`
  ADD PRIMARY KEY (`IdSaldo`),
  ADD UNIQUE KEY `IdEmpleado` (`IdEmpleado`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`IdUsuario`),
  ADD UNIQUE KEY `Usuario` (`Usuario`),
  ADD UNIQUE KEY `IdEmpleado` (`IdEmpleado`),
  ADD KEY `IdRol` (`IdRol`);

--
-- Indices de la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  ADD PRIMARY KEY (`IdVacaciones`),
  ADD KEY `IdEmpleado` (`IdEmpleado`),
  ADD KEY `IdRespSup` (`IdRespSup`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD CONSTRAINT `Cargos_ibfk_1` FOREIGN KEY (`IdCosto`) REFERENCES `centrocostos` (`IdCosto`),
  ADD CONSTRAINT `Cargos_ibfk_2` FOREIGN KEY (`IdJefe`) REFERENCES `cargos` (`IdCargo`),
  ADD CONSTRAINT `Cargos_ibfk_3` FOREIGN KEY (`IdFactor`) REFERENCES `factor` (`IdFactor`);

--
-- Filtros para la tabla `centrocostos`
--
ALTER TABLE `centrocostos`
  ADD CONSTRAINT `CentroCostos_ibfk_1` FOREIGN KEY (`IdDptoEmp`) REFERENCES `deptosempresa` (`IdDep`);

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `Empleados_ibfk_1` FOREIGN KEY (`IdCargo`) REFERENCES `cargos` (`IdCargo`),
  ADD CONSTRAINT `Empleados_ibfk_2` FOREIGN KEY (`IdJefe`) REFERENCES `empleados` (`IdEmpleado`),
  ADD CONSTRAINT `Empleados_ibfk_3` FOREIGN KEY (`IdMunicipio`) REFERENCES `municipio` (`IdMunicipio`);

--
-- Filtros para la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD CONSTRAINT `Municipio_ibfk_1` FOREIGN KEY (`IdDepartamento`) REFERENCES `departamento` (`IdDepartamento`);

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `notificaciones_ibfk_1` FOREIGN KEY (`IdRemitente`) REFERENCES `empleados` (`IdEmpleado`),
  ADD CONSTRAINT `notificaciones_ibfk_2` FOREIGN KEY (`IdDestinatario`) REFERENCES `empleados` (`IdEmpleado`);

--
-- Filtros para la tabla `saldovacaciones`
--
ALTER TABLE `saldovacaciones`
  ADD CONSTRAINT `SaldoVacaciones_ibfk_1` FOREIGN KEY (`IdEmpleado`) REFERENCES `empleados` (`IdEmpleado`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `Usuarios_ibfk_1` FOREIGN KEY (`IdRol`) REFERENCES `roles` (`IdRol`),
  ADD CONSTRAINT `Usuarios_ibfk_2` FOREIGN KEY (`IdEmpleado`) REFERENCES `empleados` (`IdEmpleado`);

--
-- Filtros para la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  ADD CONSTRAINT `Vacaciones_ibfk_1` FOREIGN KEY (`IdEmpleado`) REFERENCES `empleados` (`IdEmpleado`),
  ADD CONSTRAINT `Vacaciones_ibfk_2` FOREIGN KEY (`IdRespSup`) REFERENCES `empleados` (`IdEmpleado`);

DELIMITER $$
--
-- Eventos
--
CREATE DEFINER=`root`@`localhost` EVENT `UpdateBalance` ON SCHEDULE EVERY 1 MONTH STARTS '2018-03-26 00:00:01' ON COMPLETION NOT PRESERVE ENABLE DO update saldovacaciones s inner join  empleados e on e.IdEmpleado = s.IdEmpleado set s.Saldo = s.Saldo + 2.5 
     where e.Estado = 1$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

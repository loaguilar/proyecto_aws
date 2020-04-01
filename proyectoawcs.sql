-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-03-2020 a las 22:22:15
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectoawcs`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `ID_Cedula` int(11) NOT NULL,
  `ID_Pais` int(11) NOT NULL,
  `NombreCompleto` varchar(100) NOT NULL,
  `edad` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`ID_Cedula`, `ID_Pais`, `NombreCompleto`, `edad`) VALUES
(305000088, 1, 'Francisco Rivera R', 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `costoshabitaciones`
--

CREATE TABLE `costoshabitaciones` (
  `ID_Costo_Habitaciones` int(11) NOT NULL,
  `Costo` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `costoshabitaciones`
--

INSERT INTO `costoshabitaciones` (`ID_Costo_Habitaciones`, `Costo`) VALUES
(1, '20000.00'),
(2, '50000.00'),
(3, '75000.00'),
(4, '100000.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE `habitaciones` (
  `ID_Habitacion` int(11) NOT NULL,
  `Codigo` int(11) NOT NULL,
  `Detalle` varchar(100) NOT NULL,
  `ID_CostoHabitacion` int(11) NOT NULL,
  `Cantidad_Personas` smallint(6) NOT NULL,
  `Piso` smallint(6) NOT NULL,
  `NombreHabitacion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`ID_Habitacion`, `Codigo`, `Detalle`, `ID_CostoHabitacion`, `Cantidad_Personas`, `Piso`, `NombreHabitacion`) VALUES
(1, 65000, 'Habitación #1\r\nDos camas individuales\r\nBaño\r\nVentilador\r\nMinibar no incluido', 1, 2, 1, 'Simple #1'),
(2, 65001, 'Habitación #2\r\n1 cama Queen\r\nBaño\r\nVentilador\r\nMinibar no incluido', 2, 2, 1, 'Simple #2'),
(3, 65003, 'Habitación #3\r\n1 cama Queen\r\nBaño\r\nAire Acondicionado\r\nMinibar incluido', 3, 2, 2, 'Regular #1'),
(4, 65004, 'Habitación #2\r\n1 cama King\r\nBaño con Jacuzzi\r\nAire Acondicionado\r\nMinibar incluido', 4, 2, 2, 'Deluxe #1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `ID_Pais` int(11) NOT NULL,
  `Descripcion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`ID_Pais`, `Descripcion`) VALUES
(1, 'Costa Rica'),
(2, 'Panamá');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservasactivas`
--

CREATE TABLE `reservasactivas` (
  `ID_ReservaActiva` int(11) NOT NULL,
  `ID_Habitacion` int(11) NOT NULL,
  `ID_Cedula` int(11) NOT NULL,
  `FechaEntrada` datetime NOT NULL,
  `FechaSalida` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `ID_Rol` int(11) NOT NULL,
  `Descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`ID_Rol`, `Descripcion`) VALUES
(1, 'Administrador'),
(2, 'Empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rolesxusuario`
--

CREATE TABLE `rolesxusuario` (
  `IDRolxUsuario` int(11) NOT NULL,
  `ID_Usuario` int(11) NOT NULL,
  `ID_ROL` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rolesxusuario`
--

INSERT INTO `rolesxusuario` (`IDRolxUsuario`, `ID_Usuario`, `ID_ROL`) VALUES
(100, 1000, 1),
(101, 1001, 1),
(103, 1002, 1),
(104, 1003, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID_Usuario` int(11) NOT NULL,
  `Nombre_Completo` varchar(100) NOT NULL,
  `Clave` varchar(10) NOT NULL,
  `Rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID_Usuario`, `Nombre_Completo`, `Clave`, `Rol`) VALUES
(1000, 'Francisco Rivera Ramírez', '1000a', 1),
(1001, 'Ivan Gatica', '1001a', 1),
(1002, 'Loriana Aguilar', '1002a', 1),
(1003, 'Carlos Camacho', '1003a', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`ID_Cedula`),
  ADD KEY `ID_Pais` (`ID_Pais`);

--
-- Indices de la tabla `costoshabitaciones`
--
ALTER TABLE `costoshabitaciones`
  ADD PRIMARY KEY (`ID_Costo_Habitaciones`);

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD PRIMARY KEY (`ID_Habitacion`),
  ADD KEY `ID_CostoHabitacion` (`ID_CostoHabitacion`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`ID_Pais`);

--
-- Indices de la tabla `reservasactivas`
--
ALTER TABLE `reservasactivas`
  ADD PRIMARY KEY (`ID_ReservaActiva`),
  ADD KEY `ID_Habitacion` (`ID_Habitacion`),
  ADD KEY `ID_Cedula` (`ID_Cedula`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ID_Rol`);

--
-- Indices de la tabla `rolesxusuario`
--
ALTER TABLE `rolesxusuario`
  ADD PRIMARY KEY (`IDRolxUsuario`),
  ADD KEY `ID_Usuario` (`ID_Usuario`),
  ADD KEY `ID_ROL` (`ID_ROL`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `costoshabitaciones`
--
ALTER TABLE `costoshabitaciones`
  MODIFY `ID_Costo_Habitaciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `ID_Habitacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `ID_Pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `reservasactivas`
--
ALTER TABLE `reservasactivas`
  MODIFY `ID_ReservaActiva` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rolesxusuario`
--
ALTER TABLE `rolesxusuario`
  MODIFY `IDRolxUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1004;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`ID_Pais`) REFERENCES `paises` (`ID_Pais`);

--
-- Filtros para la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD CONSTRAINT `habitaciones_ibfk_1` FOREIGN KEY (`ID_CostoHabitacion`) REFERENCES `costoshabitaciones` (`ID_Costo_Habitaciones`);

--
-- Filtros para la tabla `reservasactivas`
--
ALTER TABLE `reservasactivas`
  ADD CONSTRAINT `reservasactivas_ibfk_1` FOREIGN KEY (`ID_Habitacion`) REFERENCES `habitaciones` (`ID_Habitacion`),
  ADD CONSTRAINT `reservasactivas_ibfk_2` FOREIGN KEY (`ID_Cedula`) REFERENCES `clientes` (`ID_Cedula`);

--
-- Filtros para la tabla `rolesxusuario`
--
ALTER TABLE `rolesxusuario`
  ADD CONSTRAINT `rolesxusuario_ibfk_1` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuarios` (`ID_Usuario`),
  ADD CONSTRAINT `rolesxusuario_ibfk_2` FOREIGN KEY (`ID_ROL`) REFERENCES `roles` (`ID_Rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

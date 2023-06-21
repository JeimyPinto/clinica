-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-06-2023 a las 03:42:25
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `clinica`
--
CREATE DATABASE IF NOT EXISTS `clinica` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `clinica`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultas`
--

CREATE TABLE `consultas` (
  `id` int(11) NOT NULL,
  `pacientesID` int(11) DEFAULT NULL,
  `medicosID` int(11) DEFAULT NULL,
  `fechaConsulta` datetime DEFAULT NULL,
  `duracionMinutos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formulas`
--

CREATE TABLE `formulas` (
  `id` int(11) NOT NULL,
  `pacienteId` int(11) DEFAULT NULL,
  `medicoID` int(11) DEFAULT NULL,
  `fechaFormula` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE `habitaciones` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `piso` int(11) NOT NULL,
  `ocupada` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos`
--

CREATE TABLE `ingresos` (
  `id` int(11) NOT NULL,
  `pacienteID` int(11) DEFAULT NULL,
  `fechaIngreso` date DEFAULT NULL,
  `diagnotico` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamentos`
--

CREATE TABLE `medicamentos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descipcion` varchar(200) NOT NULL,
  `existencias` int(11) NOT NULL,
  `precio` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamentos_formulas`
--

CREATE TABLE `medicamentos_formulas` (
  `medicamentosID` int(11) NOT NULL,
  `formulasID` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

CREATE TABLE `medicos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `especialidad` varchar(50) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `genero` varchar(10) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `telefono` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_Usuario` int(11) NOT NULL,
  `contrasena` varchar(25) NOT NULL,
  `tipo_Usuario` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pacientesID` (`pacientesID`),
  ADD KEY `medicosID` (`medicosID`);

--
-- Indices de la tabla `formulas`
--
ALTER TABLE `formulas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pacienteId` (`pacienteId`),
  ADD KEY `medicoID` (`medicoID`);

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pacienteID` (`pacienteID`) USING BTREE;

--
-- Indices de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `medicamentos_formulas`
--
ALTER TABLE `medicamentos_formulas`
  ADD KEY `medicamentosID` (`medicamentosID`),
  ADD KEY `formulasID` (`formulasID`);

--
-- Indices de la tabla `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_Usuario`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD CONSTRAINT `consultas_ibfk_1` FOREIGN KEY (`pacientesID`) REFERENCES `pacientes` (`id`),
  ADD CONSTRAINT `consultas_ibfk_2` FOREIGN KEY (`medicosID`) REFERENCES `medicos` (`id`);

--
-- Filtros para la tabla `formulas`
--
ALTER TABLE `formulas`
  ADD CONSTRAINT `formulas_ibfk_1` FOREIGN KEY (`pacienteId`) REFERENCES `pacientes` (`id`),
  ADD CONSTRAINT `formulas_ibfk_2` FOREIGN KEY (`medicoID`) REFERENCES `medicos` (`id`);

--
-- Filtros para la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD CONSTRAINT `ingresos_ibfk_1` FOREIGN KEY (`pacienteID`) REFERENCES `pacientes` (`id`);

--
-- Filtros para la tabla `medicamentos_formulas`
--
ALTER TABLE `medicamentos_formulas`
  ADD CONSTRAINT `medicamentos_formulas_ibfk_1` FOREIGN KEY (`medicamentosID`) REFERENCES `medicamentos` (`id`),
  ADD CONSTRAINT `medicamentos_formulas_ibfk_2` FOREIGN KEY (`formulasID`) REFERENCES `formulas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

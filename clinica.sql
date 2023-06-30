-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-06-2023 a las 22:32:57
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

--
-- Volcado de datos para la tabla `consultas`
--

INSERT INTO `consultas` (`id`, `pacientesID`, `medicosID`, `fechaConsulta`, `duracionMinutos`) VALUES
(0, 1, 2, '2019-10-08 00:25:00', 25),
(1, 1, 3, '2020-03-08 00:00:00', 35),
(2, 1, 1, '2022-10-08 00:00:00', 45),
(3, 2, 2, '2023-01-21 00:00:00', 20),
(4, 3, 3, '2015-08-08 00:00:00', 30),
(5, 1, 2, '2011-03-22 00:00:00', 35);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formulas`
--

CREATE TABLE `formulas` (
  `id` int(11) NOT NULL,
  `pacienteId` int(11) DEFAULT NULL,
  `medicoId` int(11) DEFAULT NULL,
  `fechaFormula` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `formulas`
--

INSERT INTO `formulas` (`id`, `pacienteId`, `medicoId`, `fechaFormula`) VALUES
(1, 1, 1, '2021-03-15'),
(2, 2, 3, '2021-03-15'),
(3, 3, 1, '2021-03-15'),
(4, 1, 2, '2022-03-07'),
(5, 3, 2, '2011-04-15'),
(6, 3, 2, '2001-10-20');

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

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`id`, `numero`, `tipo`, `piso`, `ocupada`) VALUES
(0, 101, 'Urgencias', 0, 0),
(1, 201, 'Urgencias', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos`
--

CREATE TABLE `ingresos` (
  `id` int(11) NOT NULL,
  `pacienteID` int(11) DEFAULT NULL,
  `fechaIngreso` date DEFAULT NULL,
  `diagnostico` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ingresos`
--

INSERT INTO `ingresos` (`id`, `pacienteID`, `fechaIngreso`, `diagnostico`) VALUES
(0, 2, '2023-05-25', 'Ta malito'),
(1, 1, '2023-01-11', 'Ta malito'),
(2, 4, '2023-05-25', 'Ta malito'),
(3, 1, '2023-05-25', 'Ta grrrrr'),
(4, 3, '2020-06-14', 'qwert'),
(5, 3, '2023-05-25', 'Ta malito'),
(6, 2, '2023-02-14', 'efe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamentos`
--

CREATE TABLE `medicamentos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `existencias` int(11) NOT NULL,
  `precio` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medicamentos`
--

INSERT INTO `medicamentos` (`id`, `nombre`, `descripcion`, `existencias`, `precio`) VALUES
(1, 'Acetominofem', 'La mera riata', 2, 2.00),
(2, 'Dolex', 'aqwsedrftgy', 198, 25.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamentos_formulas`
--

CREATE TABLE `medicamentos_formulas` (
  `medicamentosID` int(11) NOT NULL,
  `formulasID` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medicamentos_formulas`
--

INSERT INTO `medicamentos_formulas` (`medicamentosID`, `formulasID`, `cantidad`) VALUES
(1, 2, 30),
(2, 1, 30),
(1, 3, 20),
(2, 2, 10),
(1, 2, 30);

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

--
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`id`, `nombre`, `especialidad`, `telefono`, `correo`) VALUES
(1, 'Sebastián', 'medico general', '3008509318', 'sebastian@gmail.com'),
(2, 'Don pepe', 'odontologo', '3165306359', 'elpepe@gmail.com'),
(3, 'Checho', 'oncologo', '8803045', 'chechoplab@gmail.com'),
(4, 'maldy', 'dermatologo', '3058122481', 'maldyplanb@gmail.com');

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

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id`, `nombre`, `fechaNacimiento`, `genero`, `direccion`, `telefono`) VALUES
(1, 'sebastian', '1998-05-28', 'M', 'calle24#10-02', '3058124889'),
(2, 'Floralba', '1960-05-29', 'F', 'Av la vieja loca', '3013159825'),
(3, 'Anguila', '1915-05-29', 'M', 'no tiene', '3054789825'),
(4, 'fetset', '2010-05-29', 'F', 'Av la vieja', '3013135725');

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
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_Usuario`, `contrasena`, `tipo_Usuario`) VALUES
(0, '1111', 'admin'),
(1, '1234', 'user');

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
  ADD KEY `medicoID` (`medicoId`);

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

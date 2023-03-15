-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-03-2023 a las 11:33:02
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ministerio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `becados`
--

CREATE TABLE `becados` (
  `id_becado` int(11) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `cuil` bigint(20) UNSIGNED NOT NULL,
  `id_lugar` int(11) NOT NULL,
  `estado` int(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `becados`
--

INSERT INTO `becados` (`id_becado`, `apellido`, `nombre`, `cuil`, `id_lugar`, `estado`) VALUES
(1, 'Rosales', 'Macarena del Valle', 20241597537, 1, 1),
(2, 'Leiva ', 'Franco Emnauel', 21381574890, 1, 1),
(3, 'Diaz', 'Fernando', 20362589871, 1, 1),
(4, 'Varela ', 'Federico', 20341584551, 1, 1),
(5, 'Espeche', 'Mariela', 21254474560, 2, 1),
(6, 'Diaz', 'Julieta', 21256547857, 2, 0),
(7, 'Lopez', 'Marianela', 27456251547, 2, 1),
(8, 'Reinoso ', 'Luz', 20332574891, 3, 1),
(9, 'Lopez', 'Alfonso', 20154874441, 3, 1),
(10, 'Lopez', 'Dario ', 20194566281, 3, 0),
(11, 'Lindon', 'Marcelo', 20214566531, 3, 1),
(12, 'Martinez ', 'Nicolas', 20374562153, 4, 1),
(13, 'Lopez', 'Lucia', 21374588881, 4, 1),
(14, 'Leiva', 'Luciana', 21124574117, 4, 1),
(15, 'Carrizo', 'Jose Pablo', 20396992121, 4, 1),
(16, 'Menardo', 'Raul', 20312475913, 5, 1),
(17, 'Barrientos', 'Emilia', 21312229817, 5, 1),
(18, 'Oviedo', 'Jose Martin', 20376374253, 5, 1),
(19, 'Chazarreta', 'Raul Antonio', 20312584442, 1, 0),
(20, 'Colombo', 'Fernando', 20145784111, 2, 0),
(21, 'Diaz', 'Pedro', 20365894125, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugar`
--

CREATE TABLE `lugar` (
  `id_lugar` int(11) NOT NULL,
  `dir_ofi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `lugar`
--

INSERT INTO `lugar` (`id_lugar`, `dir_ofi`) VALUES
(1, 'Acción Social Directa'),
(2, 'Sectorial Personal'),
(3, 'Tesoreria'),
(4, 'Unidad de Auditoria Interna'),
(5, 'Mesa de Entrada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `contraseña` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `contraseña`) VALUES
(1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055'),
(2, 'franco', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `becados`
--
ALTER TABLE `becados`
  ADD PRIMARY KEY (`id_becado`),
  ADD UNIQUE KEY `cuil` (`cuil`),
  ADD KEY `indexlugar` (`id_lugar`),
  ADD KEY `id_lugar` (`id_lugar`);

--
-- Indices de la tabla `lugar`
--
ALTER TABLE `lugar`
  ADD PRIMARY KEY (`id_lugar`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `becados`
--
ALTER TABLE `becados`
  MODIFY `id_becado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `lugar`
--
ALTER TABLE `lugar`
  MODIFY `id_lugar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `becados`
--
ALTER TABLE `becados`
  ADD CONSTRAINT `becados_ibfk_1` FOREIGN KEY (`id_lugar`) REFERENCES `lugar` (`id_lugar`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-03-2025 a las 18:58:52
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `lexis`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id_nombre` int(255) NOT NULL,
  `NOMBRE` varchar(255) NOT NULL,
  `CORREO` varchar(255) NOT NULL,
  `CONTRASEÑA` varchar(255) NOT NULL,
  `CLAVE_ADM` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id_nombre`, `NOMBRE`, `CORREO`, `CONTRASEÑA`, `CLAVE_ADM`) VALUES
(1, 'David Valdez ', 'David@gmail.com', '12345', '12345678910');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adm_recursos`
--

CREATE TABLE `adm_recursos` (
  `id_nombre` int(255) NOT NULL,
  `NOMBRE` varchar(255) NOT NULL,
  `CORREO` varchar(255) NOT NULL,
  `CONTRASEÑA` varchar(255) NOT NULL,
  `CLAVE_REC` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `adm_recursos`
--

INSERT INTO `adm_recursos` (`id_nombre`, `NOMBRE`, `CORREO`, `CONTRASEÑA`, `CLAVE_REC`) VALUES
(1, 'Sparki', 'Sparki@gmail.com', '12345', '1234567890');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores`
--

CREATE TABLE `autores` (
  `id_autor` int(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `biografia` varchar(255) NOT NULL,
  `Libro` varchar(255) NOT NULL,
  `fecha_nacimiento` varchar(225) NOT NULL,
  `ESTADO` enum('Activo','Retirado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `autores`
--

INSERT INTO `autores` (`id_autor`, `nombre`, `biografia`, `Libro`, `fecha_nacimiento`, `ESTADO`) VALUES
(1, 'leo dan', 'un señor ', 'carrie', '2025-01-29', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id_libros` int(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `edicion` varchar(255) NOT NULL,
  `genero` varchar(255) NOT NULL,
  `fecha_publicacion` varchar(225) NOT NULL,
  `espacio` enum('ocupado','disponible','reservado') NOT NULL,
  `Portada` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_nombre` int(255) NOT NULL,
  `NOMBRE` varchar(255) NOT NULL,
  `CORREO` varchar(255) NOT NULL,
  `CONTRASEÑA` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_nombre`, `NOMBRE`, `CORREO`, `CONTRASEÑA`) VALUES
(4, 'Carlos', 'carlos@gmail.com', '12345'),
(5, 'Carlos daniel', 'carlos@gmail.com', '12345');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id_nombre`);

--
-- Indices de la tabla `adm_recursos`
--
ALTER TABLE `adm_recursos`
  ADD PRIMARY KEY (`id_nombre`);

--
-- Indices de la tabla `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`id_autor`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id_libros`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id_nombre` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `adm_recursos`
--
ALTER TABLE `adm_recursos`
  MODIFY `id_nombre` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `autores`
--
ALTER TABLE `autores`
  MODIFY `id_autor` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id_libros` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_nombre` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

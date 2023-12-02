-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-11-2023 a las 16:41:33
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `clase_practica4`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaturas`
--

CREATE TABLE `asignaturas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `obs` text DEFAULT NULL,
  `usuario_id_creacion` int(11) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `hora_creacion` time DEFAULT NULL,
  `usuario_id_actualizacion` int(11) DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL,
  `hora_actualizacion` time DEFAULT NULL,
  `usuario_id_eliminacion` int(11) DEFAULT NULL,
  `fecha_eliminacion` timestamp NULL DEFAULT NULL,
  `hora_eliminacion` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `asignaturas`
--

INSERT INTO `asignaturas` (`id`, `nombre`, `obs`, `usuario_id_creacion`, `fecha_creacion`, `hora_creacion`, `usuario_id_actualizacion`, `fecha_actualizacion`, `hora_actualizacion`, `usuario_id_eliminacion`, `fecha_eliminacion`, `hora_eliminacion`) VALUES
(1, 'Matemáticas', 'Curso de matemáticas avanzadas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Historia', 'Curso de historia mundial', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Ciencias Naturales', 'Curso de biología y química', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Literatura', 'Curso de literatura y escritura', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaturas_estudiante`
--

CREATE TABLE `asignaturas_estudiante` (
  `id` int(11) NOT NULL,
  `lugar_id` int(11) DEFAULT NULL,
  `asignatura_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL COMMENT 'Estudiante',
  `usuario_id_creacion` int(11) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `hora_creacion` time DEFAULT NULL,
  `usuario_id_actualizacion` int(11) DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL,
  `hora_actualizacion` time DEFAULT NULL,
  `usuario_id_eliminacion` int(11) DEFAULT NULL,
  `fecha_eliminacion` timestamp NULL DEFAULT NULL,
  `hora_eliminacion` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `asignaturas_estudiante`
--

INSERT INTO `asignaturas_estudiante` (`id`, `lugar_id`, `asignatura_id`, `usuario_id`, `usuario_id_creacion`, `fecha_creacion`, `hora_creacion`, `usuario_id_actualizacion`, `fecha_actualizacion`, `hora_actualizacion`, `usuario_id_eliminacion`, `fecha_eliminacion`, `hora_eliminacion`) VALUES
(1, 1, 1, 3, 1, '2023-11-23 23:56:57', '18:56:57', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 2, 2, 3, 1, '2023-11-23 23:56:57', '18:56:57', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1, 3, 8, 1, '2023-11-23 23:56:57', '18:56:57', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 2, 1, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugares`
--

CREATE TABLE `lugares` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `obs` text DEFAULT NULL,
  `usuario_id_creacion` int(11) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `hora_creacion` time DEFAULT NULL,
  `usuario_id_actualizacion` int(11) DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL,
  `hora_actualizacion` time DEFAULT NULL,
  `usuario_id_eliminacion` int(11) DEFAULT NULL,
  `fecha_eliminacion` timestamp NULL DEFAULT NULL,
  `hora_eliminacion` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `lugares`
--

INSERT INTO `lugares` (`id`, `nombre`, `obs`, `usuario_id_creacion`, `fecha_creacion`, `hora_creacion`, `usuario_id_actualizacion`, `fecha_actualizacion`, `hora_actualizacion`, `usuario_id_eliminacion`, `fecha_eliminacion`, `hora_eliminacion`) VALUES
(1, 'Aula 101', 'Primer piso, ala izquierda', 1, '2023-11-23 23:56:17', '18:56:17', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Laboratorio de Ciencias', 'Segundo piso, ala derecha', 1, '2023-11-23 23:56:17', '18:56:17', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Biblioteca', 'Tercer piso, ala central', 1, '2023-11-23 23:56:17', '18:56:17', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `id` int(11) NOT NULL,
  `asignatura_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL COMMENT 'Estudiante',
  `parcial` int(1) DEFAULT NULL COMMENT '1 1er,2 2do ,3 Mejoramiento',
  `teoria` float(6,2) DEFAULT NULL,
  `practica` float(6,2) DEFAULT NULL,
  `obs` text DEFAULT NULL,
  `usuario_id_creacion` int(11) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `hora_creacion` time DEFAULT NULL,
  `usuario_id_actualizacion` int(11) DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL,
  `hora_actualizacion` time DEFAULT NULL,
  `usuario_id_eliminacion` int(11) DEFAULT NULL,
  `fecha_eliminacion` timestamp NULL DEFAULT NULL,
  `hora_eliminacion` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`id`, `asignatura_id`, `usuario_id`, `parcial`, `teoria`, `practica`, `obs`, `usuario_id_creacion`, `fecha_creacion`, `hora_creacion`, `usuario_id_actualizacion`, `fecha_actualizacion`, `hora_actualizacion`, `usuario_id_eliminacion`, `fecha_eliminacion`, `hora_eliminacion`) VALUES
(1, 1, 3, 1, 15.00, 18.00, 'Prueba de notas ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, 3, 2, 18.00, 16.00, 'Prueba de notas 2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 2, 8, 1, 15.00, 20.00, 'pruba notas 3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 3, 4, 1, 18.00, 19.00, 'prueba 5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 3, 8, 1, 16.00, 17.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 1, 4, 2, 20.00, 20.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 3, 8, 2, 20.00, 18.00, 'Prueba obs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 4, 4, 1, 20.00, 20.00, 'Prueba para estudiantes', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `rol` int(1) DEFAULT NULL COMMENT '1 Docente, 2 Estudiante',
  `contrasena` varchar(100) DEFAULT NULL,
  `obs` text DEFAULT NULL,
  `usuario_id_creacion` int(11) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `hora_creacion` time DEFAULT NULL,
  `usuario_id_actualizacion` int(11) DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT NULL,
  `hora_actualizacion` time DEFAULT NULL,
  `usuario_id_eliminacion` int(11) DEFAULT NULL,
  `fecha_eliminacion` timestamp NULL DEFAULT NULL,
  `hora_eliminacion` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `rol`, `contrasena`, `obs`, `usuario_id_creacion`, `fecha_creacion`, `hora_creacion`, `usuario_id_actualizacion`, `fecha_actualizacion`, `hora_actualizacion`, `usuario_id_eliminacion`, `fecha_eliminacion`, `hora_eliminacion`) VALUES
(2, 'Freddy Garcia', 'freddy@gmail.com', 1, '1234', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Coronel Moreno', 'coronel@gmail.com', 2, '1234', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Freddy Garcia', 'pru@gmail.com', 2, '1234', 'prrueba creacion manual ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Jonathan', 'jgarcia@gmail.com', 2, '1234', 'prueba', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Pedro Rocha', 'procha@gmail.com', 2, 'pedro123', 'Creacion por formulario Pedro rocha', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `asignaturas_estudiante`
--
ALTER TABLE `asignaturas_estudiante`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lugares`
--
ALTER TABLE `lugares`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `asignaturas_estudiante`
--
ALTER TABLE `asignaturas_estudiante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `lugares`
--
ALTER TABLE `lugares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

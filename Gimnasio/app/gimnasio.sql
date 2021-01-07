-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-01-2021 a las 00:37:26
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gimnasio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `id` int(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `aforo` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id`, `nombre`, `descripcion`, `aforo`) VALUES
(1, 'Ciclismo Indoor', 'El ciclismo indoor o spinning, como se le conoce comúnmente, se define como una actividad física colectiva, realizada sobre una bicicleta especialmente diseñada para tal efecto, a un ritmo determinado, en la que se efectúa un trabajo predominantemente cardiovascular', 20),
(2, 'Pilates', 'Pilates es un método de ejercicio y movimiento físico diseñado para estirar, fortalecer y equilibrar el cuerpo. Con la práctica sistemática de ejercicios específicos junto con los patrones de respiración, Pilates ha demostrado tener un valor incalculable no sólo para las personas que quieren mantene', 15),
(8, 'Boxeo', 'El boxeo, en un primer pensamiento, lo asociamos a un deporte de contacto, en el que dos personas combaten utilizando sólo sus puños, los cuales se cubren con unos guantes especiales. En el que su principal objetivo es golpear el mayor número de veces al contrincante por encima de su cintura y dentr', 12),
(10, 'Cxworx', 'Se enfoca en trabajar principalmente la zona central del cuerpo, también llamado core. Se ejercitan los músculos del abdomen, oblicuos y espalda baja con trabajo de fuerza y tono', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id` int(10) NOT NULL,
  `usu_origen` int(10) NOT NULL,
  `usu_destino` int(10) NOT NULL,
  `mensaje` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(1) NOT NULL,
  `tipo` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `tipo`) VALUES
(0, 'Admin'),
(1, 'Socio'),
(2, 'Nuevo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tramo_horario`
--

CREATE TABLE `tramo_horario` (
  `id` int(10) NOT NULL,
  `dia` varchar(10) NOT NULL,
  `hora_inicio` varchar(5) NOT NULL,
  `hora_fin` varchar(5) NOT NULL,
  `actividad_id` int(10) NOT NULL,
  `fecha_alta` date NOT NULL,
  `fecha_baja` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tramo_horario`
--

INSERT INTO `tramo_horario` (`id`, `dia`, `hora_inicio`, `hora_fin`, `actividad_id`, `fecha_alta`, `fecha_baja`) VALUES
(1, 'Lunes', '10:00', '11:00', 2, '2021-01-06', '0000-00-00'),
(2, 'Miercoles', '20:00', '20:45', 8, '2021-01-07', '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tramo_usuario`
--

CREATE TABLE `tramo_usuario` (
  `id` int(10) NOT NULL,
  `tramo_id` int(10) NOT NULL,
  `usuario_id` int(10) NOT NULL,
  `fecha_actividad` date NOT NULL,
  `fecha_reserva` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(10) NOT NULL,
  `nif` varchar(9) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido1` varchar(50) NOT NULL,
  `apellido2` varchar(50) NOT NULL,
  `imagen` varchar(300) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefono` int(9) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `rol` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nif`, `nombre`, `apellido1`, `apellido2`, `imagen`, `login`, `password`, `email`, `telefono`, `direccion`, `rol`) VALUES
(3, '22312313A', 'Adrian', 'Gomez', 'Luna', 'usuario.jpg', 'adri', '83b621ca1ac1f7df26124821387af790d0f22e4f', 'adrigoluna@hotmail.com', 666777889, 'Duque de Ahumada', 1),
(16, '12312312R', 'maria', 'maria', 'mira', 'usuaria.jpg', 'mari', '5d95cb27f49aafe1eac579adf55ae18deeb49b8c', 'maia@miya.com', 666777822, 'huelva', 1),
(18, '44221362k', 'admin', 'admin', 'admin', 'admin.jpg', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@admin.com', 666777822, 'Duque de Ahumada', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usu_origen` (`usu_origen`) USING BTREE,
  ADD KEY `usu_destino` (`usu_destino`) USING BTREE;

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tramo_horario`
--
ALTER TABLE `tramo_horario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `actividad_id` (`actividad_id`) USING BTREE;

--
-- Indices de la tabla `tramo_usuario`
--
ALTER TABLE `tramo_usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tramo_id` (`tramo_id`) USING BTREE,
  ADD KEY `usuario_id` (`usuario_id`) USING BTREE;

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD KEY `rol` (`rol`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tramo_horario`
--
ALTER TABLE `tramo_horario`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tramo_usuario`
--
ALTER TABLE `tramo_usuario`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `usu_mens_destino` FOREIGN KEY (`usu_destino`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usu_mens_origen` FOREIGN KEY (`usu_origen`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tramo_horario`
--
ALTER TABLE `tramo_horario`
  ADD CONSTRAINT `horario_actividad` FOREIGN KEY (`actividad_id`) REFERENCES `actividades` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tramo_usuario`
--
ALTER TABLE `tramo_usuario`
  ADD CONSTRAINT `tramoUsu_horar` FOREIGN KEY (`tramo_id`) REFERENCES `tramo_horario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tramoUsu_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_rol` FOREIGN KEY (`rol`) REFERENCES `rol` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-02-2021 a las 10:50:59
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
(2, 'Pilates', 'Pilates es un método de ejercicio y movimiento físico diseñado para estirar, fortalecer y equilibrar el cuerpo. Con la práctica sistemática de ejercicios específicos junto con los patrones de respiración, Pilates ha demostrado tener un valor incalculable no sólo para las personas que quieren mantene', 15),
(8, 'Boxeo', 'El boxeo, en un primer pensamiento, lo asociamos a un deporte de contacto, en el que dos personas combaten utilizando sólo sus puños, los cuales se cubren con unos guantes especiales. En el que su principal objetivo es golpear el mayor número de veces al contrincante por encima de su cintura y dentr', 12),
(10, 'Cxworx', 'Se enfoca en trabajar principalmente la zona central del cuerpo, también llamado core. Se ejercitan los músculos del abdomen, oblicuos y espalda baja con trabajo de fuerza y tono', 20),
(12, 'Ciclismo Indoor', 'Bicicletas pero bajo techo', 20);

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

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id`, `usu_origen`, `usu_destino`, `mensaje`) VALUES
(1, 18, 21, 'Hola user, soy Admin'),
(2, 18, 16, 'Hola mari, soy el ADMIN'),
(3, 18, 21, 'Te mando otro desde el ADMIN'),
(4, 21, 18, 'Te eescribo para probar si va esto, soy el user');

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
(10, 'Martes', '11:00', '', 2, '2021-01-19', '0000-00-00'),
(11, 'Jueves', '10:00', '', 8, '2021-01-19', '0000-00-00'),
(12, 'Miercoles', '12:00', '', 10, '2021-01-19', '0000-00-00'),
(13, 'Viernes', '11:00', '', 12, '2021-01-19', '0000-00-00'),
(21, 'Miercoles', '9:00', '', 12, '2021-01-27', '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tramo_usuario`
--

CREATE TABLE `tramo_usuario` (
  `id` int(10) NOT NULL,
  `tramo_id` int(10) NOT NULL,
  `usuario_id` int(10) NOT NULL,
  `fecha_actividad` varchar(10) NOT NULL,
  `hora_activ` varchar(5) NOT NULL,
  `fecha_reserva` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tramo_usuario`
--

INSERT INTO `tramo_usuario` (`id`, `tramo_id`, `usuario_id`, `fecha_actividad`, `hora_activ`, `fecha_reserva`) VALUES
(1, 1, 21, 'Lunes', '10:00', '2021-01-24'),
(2, 1, 16, 'Lunes', '10:00', '2021-01-24'),
(6, 21, 21, 'Miercoles', '9:00', '2021-01-27'),
(7, 12, 21, 'Miercoles', '12:00', '2021-01-27');

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
(18, '44221362k', 'admin', 'admin', 'admin', 'admin.jpg', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@admin.com', 666777822, 'Duque de Ahumada', 0),
(21, '12312312f', 'user', 'user', 'user', 'usua.jpg', 'user', '12dea96fec20593566ab75692c9949596833adc9', 'user@user', 678123592, 'huelva', 1),
(22, '54321234L', 'Susana', 'Alvarez', 'Casa', 'usu.jpg', 'susana', 'f925d420627f3db470e17fc2a289a4dd103722f2', 'ufasd@gmail.com', 653658930, 'Salamanca', 2),
(24, '65287768j', 'raton', 'rata', 'ratita', 'usuario.jpg', 'raton2', 'a11bb39da6737129ddcf2496c67220161e6eb9a0', 'sdadsf@fdsadf', 678900000, 'Kilates', 1),
(25, '24312345S', 'Lapiz', 'Rosa', 'Gorrion', 'usua.jpg', 'lapiz', 'd9c3e243f36d9c41cc516e5a7425fede8155b050', 'asfads@tret', 623465421, 'Sevilla', 2);

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tramo_horario`
--
ALTER TABLE `tramo_horario`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `tramo_usuario`
--
ALTER TABLE `tramo_usuario`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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

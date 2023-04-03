-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-04-2023 a las 03:28:30
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `usuario` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `paswword` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `perfil` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `foto` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `ultimo_login` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `paswword`, `perfil`, `foto`, `estado`, `ultimo_login`, `fecha`) VALUES
(31, 'Administrador', 'admin', '3691', 'Administrador', 'vistas/img/usuarios/admin/185.jpg', 1, '2023-03-29 20:18:46', '2023-03-30 01:47:20'),
(32, 'LUIS DAVID ROLDAN RODRIGUEZ', 'luisrr', '1234', 'Especial', 'vistas/img/usuarios/luisrr/669.png', 1, '0000-00-00 00:00:00', '2023-02-01 02:39:31'),
(33, 'franciscov', 'FRANCISCO VARELA', '1234', 'Vendedor', 'vistas/img/usuarios/franciscov/884.png', 1, '0000-00-00 00:00:00', '2023-02-01 02:39:40'),
(35, 'arelisv', 'ARELIS VARELA', '1234', 'Vendedor', 'vistas/img/usuarios/arelisv/736.png', 1, '0000-00-00 00:00:00', '2023-02-21 06:37:25'),
(36, 'memodificaron', 'Hola Soy un usuario Nuevo', '2fPNxY4xZ64YZid', 'Especial', '', 0, '0000-00-00 00:00:00', '2023-04-03 01:21:43');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

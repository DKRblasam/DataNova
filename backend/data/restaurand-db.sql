-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-12-2024 a las 08:57:36
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
-- Base de datos: `restaurand-db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `correo`, `telefono`, `direccion`) VALUES
(1, 'Juan Pérez', 'juan.perez@email.com', '987654321', NULL),
(2, 'María García', 'maria.garcia@email.com', '912345678', NULL),
(3, 'Carlos Rodríguez', 'carlos.rodriguez@email.com', '965432187', NULL),
(4, 'Ana Martínez', 'ana.martinez@email.com', '998877665', NULL),
(5, 'Luis Sánchez', 'luis.sanchez@email.com', '944556677', NULL),
(6, 'Elena Torres', 'elena.torres@email.com', '933224411', NULL),
(7, 'Roberto Ramírez', 'roberto.ramirez@email.com', '977665544', NULL),
(8, 'Sofía López', 'sofia.lopez@email.com', '911223344', NULL),
(9, 'Diego Fernández', 'diego.fernandez@email.com', '900112233', NULL),
(10, 'Valentina Morales', 'valentina.morales@email.com', '988776655', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platos`
--

CREATE TABLE `platos` (
  `id_plato` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `categoria` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `platos`
--

INSERT INTO `platos` (`id_plato`, `nombre`, `categoria`, `precio`) VALUES
(1, 'Asado Argentino', 'Carnes', 25.50),
(2, 'Salmón Teriyaki', 'Pescados', 22.00),
(3, 'Pizza Margherita', 'Pizzas', 15.75),
(4, 'Ceviche Mixto', 'Mariscos', 18.90),
(5, 'Lomo Saltado', 'Platos Peruanos', 16.50),
(6, 'Rollo California', 'Sushi', 12.50),
(7, 'Pollo a la Brasa', 'Aves', 14.00),
(8, 'Risotto de Champiñones', 'Pastas', 17.25),
(9, 'Causa Limeña', 'Entradas Peruanas', 10.50),
(10, 'Tiramisu', 'Postres', 8.75),
(11, 'Cordero a la Menta', 'Carnes', 30.00),
(12, 'Camarones al Ajillo', 'Mariscos', 23.00),
(13, 'Pizza Cuatro Estaciones', 'Pizzas', 17.50),
(14, 'Lasaña Bolognesa', 'Pastas', 18.25),
(15, 'Sushi Roll Especial', 'Sushi', 13.00),
(16, 'Pechuga de Pollo a la Parrilla', 'Aves', 16.75),
(17, 'Mousse de Chocolate', 'Postres', 9.00),
(18, 'Pescado a la Plancha', 'Pescados', 20.50),
(19, 'Sopa de Mariscos', 'Mariscos', 14.75),
(20, 'Fettuccine Alfredo', 'Pastas', 16.25),
(21, 'Tacos de Carne Asada', 'Entradas Mexicanas', 12.00),
(22, 'Churros con Chocolate', 'Postres', 7.50),
(23, 'Pechuga de Pavo a la Naranja', 'Aves', 22.50),
(24, 'Arroz Chaufa', 'Platos Peruanos', 13.00),
(25, 'Sushi de Atún', 'Sushi', 12.25),
(26, 'Pasta Carbonara', 'Pastas', 17.50),
(27, 'Pollo en Salsa de Mostaza', 'Aves', 18.00),
(28, 'Paella Valenciana', 'Arroces', 28.00),
(29, 'Flan Casero', 'Postres', 6.50),
(30, 'Pizza Hawaiana', 'Pizzas', 16.00),
(31, 'Ravioles de Espinaca', 'Pastas', 14.50),
(32, 'Ensalada Caprese', 'Ensaladas', 10.00),
(33, 'Chaufa de Mariscos', 'Platos Peruanos', 19.50),
(34, 'Crema Volteada', 'Postres', 7.00),
(35, 'Anticuchos de Corazón', 'Entradas Peruanas', 12.75),
(36, 'Hamburguesa Gourmet', 'Carnes', 15.00),
(37, 'Brochetas de Pollo', 'Aves', 13.50),
(38, 'Pulpo al Olivo', 'Mariscos', 22.50),
(39, 'Sopa de Quinua', 'Platos Peruanos', 10.25),
(40, 'Helado Artesanal', 'Postres', 6.50),
(41, 'Churrasco con Chimichurri', 'Carnes', 26.00),
(42, 'Ceviche de Pulpo', 'Mariscos', 21.50),
(43, 'Ensalada César', 'Ensaladas', 11.00),
(44, 'Pastel de Choclo', 'Entradas Peruanas', 9.50),
(45, 'Cazuela de Mariscos', 'Platos Internacionales', 25.00),
(46, 'Brownie con Helado', 'Postres', 8.50),
(47, 'Sándwich Club', 'Entradas', 12.00),
(48, 'Pasta al Pesto', 'Pastas', 15.75),
(49, 'Torta Tres Leches', 'Postres', 7.75),
(50, 'Pizza Vegetariana', 'Pizzas', 16.50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id_reserva` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_restaurante` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `numero_personas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id_reserva`, `id_cliente`, `id_restaurante`, `fecha`, `numero_personas`) VALUES
(1, 1, 1, '2024-12-10 19:00:00', 4),
(2, 2, 2, '2024-12-11 18:30:00', 2),
(3, 3, 3, '2024-12-12 20:00:00', 3),
(4, 4, 4, '2024-12-13 21:00:00', 5),
(5, 5, 5, '2024-12-14 13:00:00', 6),
(6, 6, 6, '2024-12-15 14:00:00', 2),
(7, 7, 7, '2024-12-16 17:30:00', 4),
(8, 8, 8, '2024-12-17 16:00:00', 3),
(9, 9, 9, '2024-12-18 12:00:00', 2),
(10, 10, 10, '2024-12-19 20:30:00', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurantes`
--

CREATE TABLE `restaurantes` (
  `id_restaurante` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `o_h` varchar(20) DEFAULT NULL,
  `imagen_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `restaurantes`
--

INSERT INTO `restaurantes` (`id_restaurante`, `nombre`, `direccion`, `o_h`, `imagen_id`) VALUES
(1, 'La Parrilla', 'Av. Siempre Viva 123', 'Lun-Dom 12:00-23:00', 1),
(2, 'Sushi Nikkei', 'Calle Los Pinos 456', 'Mar-Sab 18:00-00:00', 2),
(3, 'Pizzería Napoli', 'Jiron Camaná 789', 'Lun-Dom 11:00-22:00', 3),
(4, 'Cevichería El Puerto', 'Malecón Balta 321', 'Mié-Dom 13:00-21:00', 4),
(5, 'Café Colonial', 'Plaza Mayor 654', 'Lun-Sab 07:00-20:00', 5),
(6, 'Restaurante Italia', 'Av. Italia 1001', 'Lun-Dom 12:00-23:30', 6),
(7, 'El Buen Gusto', 'Calle de la Amistad 420', 'Lun-Vie 10:00-20:00', 2),
(8, 'La Casa del Sabor', 'Callejón del Sol 118', 'Mar-Dom 12:00-22:00', 5),
(9, 'Café del Mar', 'Av. Costanera 789', 'Lun-Sab 08:00-22:00', 3),
(10, 'La Perla Negra', 'Playa Blanca 24', 'Mié-Dom 14:00-23:00', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurantes_platos`
--

CREATE TABLE `restaurantes_platos` (
  `id_restaurante` int(11) NOT NULL,
  `id_plato` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `restaurantes_platos`
--

INSERT INTO `restaurantes_platos` (`id_restaurante`, `id_plato`) VALUES
(1, 1),
(1, 2),
(1, 7),
(1, 16),
(1, 27),
(1, 35),
(1, 41),
(1, 44),
(2, 6),
(2, 11),
(2, 18),
(2, 25),
(2, 38),
(2, 42),
(2, 45),
(3, 3),
(3, 5),
(3, 13),
(3, 30),
(3, 31),
(3, 48),
(3, 50),
(4, 4),
(4, 10),
(4, 19),
(4, 28),
(4, 33),
(4, 42),
(4, 45),
(5, 9),
(5, 12),
(5, 39),
(5, 40),
(5, 43),
(5, 46),
(6, 14),
(6, 20),
(6, 26),
(6, 31),
(6, 48),
(6, 49),
(7, 16),
(7, 17),
(7, 22),
(7, 36),
(7, 46),
(7, 47),
(8, 8),
(8, 15),
(8, 35),
(8, 37),
(8, 44),
(8, 49),
(9, 9),
(9, 28),
(9, 34),
(9, 43),
(9, 50),
(10, 10),
(10, 17),
(10, 38),
(10, 39),
(10, 41),
(10, 42);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `contraseña` varchar(100) DEFAULT NULL,
  `tipo` enum('admin','cliente') DEFAULT 'cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `correo`, `contraseña`, `tipo`) VALUES
(1, 'admin', 'admin@restaurante.com', 'admin123', 'admin'),
(2, 'juanperez', 'juan.perez@email.com', '1234', 'cliente'),
(3, 'mariagarcia', 'maria.garcia@email.com', 'abcd', 'cliente'),
(4, 'carlosrodriguez', 'carlos.rodriguez@email.com', '9876', 'cliente'),
(5, 'anacalle', 'ana.martinez@email.com', '123abc', 'cliente'),
(6, 'roberto', 'roberto.ramirez@email.com', 'qwerty', 'cliente'),
(8, 'oppr', 'oppr@email.com', '$2y$10$IJkswzzAK3MxxdUK04Y0V.7O.tJcedrDyXMSR9vEKFNgA.o3cE5z2', 'cliente'),
(9, 'oppr1', 'oppr1@email.com', '$2y$10$CpkfQij1V9T9kGDIcyz2u.kI.1kAjUFReTwuZmYb93IPoJFyfceo.', 'cliente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `platos`
--
ALTER TABLE `platos`
  ADD PRIMARY KEY (`id_plato`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `fk_clientes_reservas` (`id_cliente`),
  ADD KEY `fk_restaurantes_reservas` (`id_restaurante`);

--
-- Indices de la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  ADD PRIMARY KEY (`id_restaurante`);

--
-- Indices de la tabla `restaurantes_platos`
--
ALTER TABLE `restaurantes_platos`
  ADD PRIMARY KEY (`id_restaurante`,`id_plato`),
  ADD KEY `fk_platos_restaurantes` (`id_plato`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `platos`
--
ALTER TABLE `platos`
  MODIFY `id_plato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  MODIFY `id_restaurante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `fk_clientes_reservas` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `fk_restaurantes_reservas` FOREIGN KEY (`id_restaurante`) REFERENCES `restaurantes` (`id_restaurante`);

--
-- Filtros para la tabla `restaurantes_platos`
--
ALTER TABLE `restaurantes_platos`
  ADD CONSTRAINT `fk_platos_restaurantes` FOREIGN KEY (`id_plato`) REFERENCES `platos` (`id_plato`),
  ADD CONSTRAINT `fk_restaurantes_platos` FOREIGN KEY (`id_restaurante`) REFERENCES `restaurantes` (`id_restaurante`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

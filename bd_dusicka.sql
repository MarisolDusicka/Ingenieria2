-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-06-2026 a las 01:47:50
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_dusicka`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_actualizar_estado_receta` (IN `p_id_receta` INT, IN `p_estado` VARCHAR(50))   BEGIN
    UPDATE recetas
    SET estado = p_estado
    WHERE id_receta = p_id_receta;

    SELECT 
        id_receta,
        estado,
        'Estado actualizado correctamente' AS mensaje
    FROM recetas
    WHERE id_receta = p_id_receta;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_consultar_recetas_pendientes` ()   BEGIN
    SELECT 
        r.id_receta,
        r.id_persona,
        p.persona_nombre,
        p.persona_apellido,
        r.id_anteojo,
        a.anteojo_nombre,
        r.observaciones,
        r.receta,
        r.fecha,
        r.estado
    FROM recetas r
    INNER JOIN personas p 
        ON p.id_persona = r.id_persona
    INNER JOIN anteojos a 
        ON a.id_anteojo = r.id_anteojo
    ORDER BY r.id_receta DESC;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anteojos`
--

CREATE TABLE `anteojos` (
  `id_anteojo` int(11) NOT NULL,
  `codigo_anteojo` bigint(20) NOT NULL,
  `anteojo_nombre` varchar(300) NOT NULL,
  `anteojo_categoria` int(11) NOT NULL,
  `anteojo_marca` int(11) NOT NULL,
  `anteojo_stock` int(11) DEFAULT 0,
  `anteojo_precio` decimal(10,2) NOT NULL,
  `anteojo_descripcion` text DEFAULT NULL,
  `anteojo_imagen` varchar(255) DEFAULT NULL,
  `anteojo_estado` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `anteojos`
--

INSERT INTO `anteojos` (`id_anteojo`, `codigo_anteojo`, `anteojo_nombre`, `anteojo_categoria`, `anteojo_marca`, `anteojo_stock`, `anteojo_precio`, `anteojo_descripcion`, `anteojo_imagen`, `anteojo_estado`) VALUES
(1, 100, 'ay not dead', 1, 2, 48, 120000.00, 'anteojos de receta ', '1780283029_d4cd4415f44d2f287360.jpg', 1),
(2, 100, 'infinity', 1, 4, 42, 200000.00, 'anteojos de receta', '1780283097_55133efced218af19ade.jpg', 1),
(3, 200, 'rayban', 2, 5, 42, 149999.99, 'anteojos de sol', '1780283139_e44faf0fde7de04a7e4d.jpg', 1),
(4, 200, 'sophia loren', 2, 6, 49, 179999.98, 'anteojos de sol', '1780283179_5b15fedb1a11afe77ae0.jpg', 1),
(6, 200, 'Valeria Mazza', 2, 7, 50, 150000.00, 'anteojos de sol', '1780283231_5b9058b0bbcf5826512a.png', 1),
(29, 200, 'Infinity', 2, 4, 47, 140000.00, 'anteojos de sol', '1780283274_c5f96580643911367da4.jpg', 1),
(30, 300, 'lentes', 3, 3, 50, 80000.00, 'lentes de contacto', '1780283397_2740cfb607b918d88706.jpg', 1),
(31, 100, 'rayban', 1, 5, 50, 135000.00, 'anteojos de receta', '1780315248_854f905a23713fbcc00a.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `categoria_nombre` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `categoria_nombre`) VALUES
(1, 'Anteojos de Receta'),
(2, 'Anteojos de Sol'),
(3, 'Lentes de Contacto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

CREATE TABLE `detalle_ventas` (
  `id` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_anteojo` int(11) NOT NULL,
  `detalle_cantidad` int(11) DEFAULT 1,
  `detalle_precio` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_ventas`
--

INSERT INTO `detalle_ventas` (`id`, `id_venta`, `id_anteojo`, `detalle_cantidad`, `detalle_precio`) VALUES
(22, 22, 29, 1, 140000.00),
(23, 23, 4, 1, 179999.98),
(24, 24, 2, 1, 200000.00),
(25, 25, 29, 1, 140000.00),
(26, 26, 3, 6, 149999.99),
(27, 27, 2, 1, 200000.00),
(28, 28, 3, 1, 149999.99),
(29, 29, 2, 2, 200000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formas_pago`
--

CREATE TABLE `formas_pago` (
  `pago_id` int(11) NOT NULL,
  `detalle_pago` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `formas_pago`
--

INSERT INTO `formas_pago` (`pago_id`, `detalle_pago`) VALUES
(1, 'Efectivo'),
(2, 'Tarjeta de Crédito'),
(3, 'Tarjeta de Débito'),
(4, 'Transferencia Bancaria'),
(5, 'Mercado Pago'),
(6, 'PayPal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id_marca` int(11) NOT NULL,
  `marca_nombre` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id_marca`, `marca_nombre`) VALUES
(1, 'Acuvue'),
(2, 'AY NOT DEAD'),
(3, 'Freshlook'),
(4, 'Infinity'),
(5, 'RAY BAN'),
(6, 'Sofia Loren'),
(7, 'VALERIA MAZZA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `id_perfil` int(11) NOT NULL,
  `perfil_nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id_perfil`, `perfil_nombre`) VALUES
(1, 'Administrador'),
(2, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id_persona` int(11) NOT NULL,
  `persona_nombre` varchar(100) NOT NULL,
  `persona_apellido` varchar(100) NOT NULL,
  `persona_telefono` varchar(50) DEFAULT NULL,
  `persona_direccion` varchar(255) DEFAULT NULL,
  `persona_email` varchar(150) NOT NULL,
  `persona_password` varchar(255) NOT NULL,
  `perfil_id` int(11) NOT NULL,
  `persona_estado` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id_persona`, `persona_nombre`, `persona_apellido`, `persona_telefono`, `persona_direccion`, `persona_email`, `persona_password`, `perfil_id`, `persona_estado`) VALUES
(1, 'Marisol', 'Dusicka', '3794664841', 'Luis Braille 3335', 'marisol@gmail.com', '$2y$10$P7AmQIfNqETrCmN7j9nSdOfyAley55xBeZK3IFO702Ju78cfukd5W', 1, 1),
(2, 'victor', 'Encina', '3794665301', 'Luis Braille 3335', 'victor@gmail.com', '$2y$10$OlqXjOA5zZ1wccNWpZpuzeRsypbriLwdfva91RMqw9LbcymSidxR2', 2, 1),
(3, 'Erika', 'Gonzalez', '3794628985', 'calle 1', 'erika@gmail.com', '$2y$10$blNGK9EaNhVkk3NVbFN1Pe6ygFLp5VOU.7hxrqxFZPjTZ.rTvhJiS', 2, 1),
(4, 'Ana', 'Ortiz', '3794030785', 'calle 2', 'ana@gmail.com', '$2y$10$hSt.Bv2LwiYnQZV6y3Z4n.bGmWqjKiOd7wDHtsThiU/rzHqryidWS', 2, 1),
(5, 'Cata', 'Cata', '789456', 'calle3', 'cata@gmail.com', '$2y$10$saD5xIFIZFoZlQqkbj0ue.wG6XFAT7rPN9NI/I/gG/f3StYJC5B3i', 2, 1),
(10, 'Matias', 'Encina', '3794091569', 'Luis Braille 3335', 'matias@gmail.com', '$2y$10$7t90YKI1gEVcOPuxFAhPuuDKAUPQ0698/EPcoU1EeBmS6i2Zb2MHO', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `probador_virtual`
--

CREATE TABLE `probador_virtual` (
  `id_probador` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `id_anteojo` int(11) NOT NULL,
  `distancia_pupilar` decimal(6,2) NOT NULL,
  `ancho_rostro` decimal(6,2) NOT NULL,
  `estado` varchar(20) DEFAULT 'ACTIVO',
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `probador_virtual`
--

INSERT INTO `probador_virtual` (`id_probador`, `id_persona`, `id_anteojo`, `distancia_pupilar`, `ancho_rostro`, `estado`, `fecha_registro`) VALUES
(1, 3, 2, 65.00, 140.00, 'ACTIVO', '2026-06-06 02:15:10'),
(2, 3, 2, 65.00, 140.00, 'ACTIVO', '2026-06-06 02:16:02'),
(3, 4, 3, 65.00, 140.00, 'ACTIVO', '2026-06-08 14:02:24'),
(4, 2, 3, 21.10, 44.31, 'ACTIVO', '2026-06-09 14:11:17'),
(5, 4, 1, 63.60, 140.00, 'ACTIVO', '2026-06-10 18:57:38'),
(6, 4, 1, 63.48, 140.00, 'ACTIVO', '2026-06-10 18:58:22'),
(7, 4, 1, 61.58, 140.00, 'ACTIVO', '2026-06-10 19:08:42'),
(8, 4, 1, 61.58, 140.00, 'ACTIVO', '2026-06-10 19:08:49'),
(9, 4, 1, 61.58, 140.00, 'ACTIVO', '2026-06-10 19:09:04'),
(10, 1, 2, 65.01, 140.00, 'ACTIVO', '2026-06-10 20:51:25'),
(11, 2, 3, 65.55, 140.00, 'ACTIVO', '2026-06-10 22:35:05'),
(12, 4, 2, 60.71, 140.00, 'ACTIVO', '2026-06-10 23:23:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recetas`
--

CREATE TABLE `recetas` (
  `id_receta` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `id_anteojo` int(11) NOT NULL,
  `observaciones` text DEFAULT NULL,
  `receta` varchar(255) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `estado` varchar(50) DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recetas`
--

INSERT INTO `recetas` (`id_receta`, `id_persona`, `id_anteojo`, `observaciones`, `receta`, `fecha`, `estado`) VALUES
(1, 2, 29, NULL, '1780679194_0a03a2e4baa516f3ae4b.jpg', '2026-06-05 14:10:04', 'Aprobado'),
(2, 3, 4, NULL, '1780679556_896df5a9a9d9e82169fd.jpg', '2026-06-05 17:12:36', 'rechazado'),
(3, 4, 2, NULL, '1780679651_d6c46953d87bd52dfd9c.jpg', '2026-06-05 17:14:12', 'Pendiente'),
(4, 3, 2, NULL, '1780710991_0bff4836336b87834d4e.jpg', '2026-06-06 01:56:31', 'Pendiente'),
(5, 3, 2, NULL, '1780712438_752374abcf76bebcfcf1.jpg', '2026-06-06 02:20:38', 'Pendiente'),
(6, 10, 29, NULL, '1780834964_c4046b4471e0ff8d1ded.jpg', '2026-06-07 12:22:44', 'Pendiente'),
(7, 2, 2, NULL, '1780870149_91711efe4c59d3682042.jpg', '2026-06-07 22:09:09', 'Pendiente'),
(8, 4, 2, NULL, '1780926948_5245a2803fede69f77a6.jpg', '2026-06-08 13:55:48', 'Rechazado'),
(9, 4, 2, NULL, '1780926959_d25afcb12aef4506407b.jpg', '2026-06-08 13:55:59', 'Aprobado'),
(10, 2, 29, '', '1781011882_5179c6843694ea04decf.jpg', '2026-06-09 13:31:22', 'Pendiente'),
(11, 2, 29, '', '1781011896_9e5765cbb8e00059e5e8.jpg', '2026-06-09 13:31:36', 'Pendiente'),
(44, 2, 29, '', '1781011907_305cd824f7ed24f5e12c.jpg', '2026-06-09 13:31:47', 'Pendiente'),
(45, 2, 29, '', '1781011983_5a355d7092f6031dcfbd.jpg', '2026-06-09 13:33:03', 'Pendiente'),
(46, 2, 29, '', '1781012006_e2d2e10d3747f64725e6.jpg', '2026-06-09 13:33:26', 'Pendiente'),
(47, 2, 29, '', '1781012016_d4020281359b17352180.jpg', '2026-06-09 13:33:36', 'Pendiente'),
(48, 2, 29, '', '1781012032_c0b89a0208ece82adf43.jpg', '2026-06-09 13:33:52', 'Pendiente'),
(49, 2, 29, '', '1781012046_55edf7be2c4804504c03.jpg', '2026-06-09 13:34:07', 'Pendiente'),
(50, 2, 29, '', '1781012834_d252f5dd594d2a0db9b8.jpg', '2026-06-09 13:47:14', 'Pendiente'),
(51, 2, 29, '', '1781012843_eefeb44ea9585ffda1e9.jpg', '2026-06-09 13:47:23', 'Pendiente'),
(52, 2, 29, '', '1781012848_969ebb34e5257288fccd.jpg', '2026-06-09 13:47:28', 'Pendiente'),
(53, 2, 29, '', '1781012856_20e708d460a17d902b97.jpg', '2026-06-09 13:47:36', 'Pendiente'),
(54, 2, 29, '', '1781012867_7333b57040c248782f35.jpg', '2026-06-09 13:47:47', 'Pendiente'),
(55, 2, 3, '', '1781013002_0db54b55da551976bc7c.jpg', '2026-06-09 13:50:02', 'Pendiente'),
(56, 2, 3, '', '1781013019_db7e9ca4f3bbe292d6e3.jpg', '2026-06-09 13:50:19', 'Pendiente'),
(57, 2, 3, '', '1781013035_ec1ce95f32e532ad4d26.jpg', '2026-06-09 13:50:35', 'Pendiente'),
(58, 2, 3, '', '1781013047_577e8a5227b382b2b869.jpg', '2026-06-09 13:50:47', 'Pendiente'),
(59, 2, 3, '', '1781013061_64723dfea65f37b73972.jpg', '2026-06-09 13:51:01', 'Pendiente'),
(60, 2, 3, '', '1781014627_0aa1a2e097573389219a.jpg', '2026-06-09 14:17:07', 'Pendiente'),
(61, 2, 2, '', '1781034917_e5110408f62bed74fe3c.jpg', '2026-06-09 19:55:17', 'Pendiente'),
(62, 4, 2, '', '1781116739_8a26ce3bf649fe7048f8.jpg', '2026-06-10 18:38:59', 'Pendiente'),
(63, 4, 2, '', '1781116749_bf8c3cbd5ece31134bf6.jpg', '2026-06-10 18:39:09', 'Pendiente'),
(64, 4, 1, '', '1781118414_3e7af0eea47a4ba8ecb2.jpg', '2026-06-10 19:06:54', 'Pendiente'),
(65, 4, 1, '', '1781118550_1e74cf6ead7cd0ab0c16.jpg', '2026-06-10 19:09:10', 'Pendiente'),
(66, 1, 2, '', '1781124692_2685afcba47d81669782.jpg', '2026-06-10 20:51:32', 'Pendiente'),
(67, 2, 3, '', '1781130927_d77506d97d3c0dd48100.jpg', '2026-06-10 22:35:27', 'Rechazado'),
(68, 4, 2, '', '1781133846_34663c209c9732431d7b.jpg', '2026-06-10 23:24:06', 'Pendiente'),
(69, 4, 2, '', '1781133867_1042f341ee0277578890.jpg', '2026-06-10 23:24:27', 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `venta_fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `pago_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `id_persona`, `venta_fecha`, `pago_id`) VALUES
(22, 2, '2026-06-05 03:00:00', 2),
(23, 3, '2026-06-05 03:00:00', 3),
(24, 4, '2026-06-05 03:00:00', 2),
(25, 10, '2026-06-07 03:00:00', 2),
(26, 2, '2026-06-09 03:00:00', 2),
(27, 1, '2026-06-10 03:00:00', 1),
(28, 2, '2026-06-10 03:00:00', 1),
(29, 4, '2026-06-10 03:00:00', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anteojos`
--
ALTER TABLE `anteojos`
  ADD PRIMARY KEY (`id_anteojo`),
  ADD KEY `fk_anteojo_categoria` (`anteojo_categoria`),
  ADD KEY `fk_anteojo_marca` (`anteojo_marca`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detalle_venta` (`id_venta`),
  ADD KEY `fk_detalle_anteojo` (`id_anteojo`);

--
-- Indices de la tabla `formas_pago`
--
ALTER TABLE `formas_pago`
  ADD PRIMARY KEY (`pago_id`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id_persona`),
  ADD UNIQUE KEY `persona_email` (`persona_email`),
  ADD KEY `fk_persona_perfil` (`perfil_id`);

--
-- Indices de la tabla `probador_virtual`
--
ALTER TABLE `probador_virtual`
  ADD PRIMARY KEY (`id_probador`),
  ADD KEY `id_persona` (`id_persona`),
  ADD KEY `id_anteojo` (`id_anteojo`);

--
-- Indices de la tabla `recetas`
--
ALTER TABLE `recetas`
  ADD PRIMARY KEY (`id_receta`),
  ADD KEY `fk_receta_persona` (`id_persona`),
  ADD KEY `fk_receta_anteojo` (`id_anteojo`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `fk_ventas_persona` (`id_persona`),
  ADD KEY `fk_venta_forma_pago` (`pago_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anteojos`
--
ALTER TABLE `anteojos`
  MODIFY `id_anteojo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `formas_pago`
--
ALTER TABLE `formas_pago`
  MODIFY `pago_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `probador_virtual`
--
ALTER TABLE `probador_virtual`
  MODIFY `id_probador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `recetas`
--
ALTER TABLE `recetas`
  MODIFY `id_receta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anteojos`
--
ALTER TABLE `anteojos`
  ADD CONSTRAINT `fk_anteojo_categoria` FOREIGN KEY (`anteojo_categoria`) REFERENCES `categorias` (`id_categoria`),
  ADD CONSTRAINT `fk_anteojo_marca` FOREIGN KEY (`anteojo_marca`) REFERENCES `marcas` (`id_marca`);

--
-- Filtros para la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD CONSTRAINT `fk_detalle_anteojo` FOREIGN KEY (`id_anteojo`) REFERENCES `anteojos` (`id_anteojo`),
  ADD CONSTRAINT `fk_detalle_venta` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`) ON DELETE CASCADE;

--
-- Filtros para la tabla `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `fk_persona_perfil` FOREIGN KEY (`perfil_id`) REFERENCES `perfiles` (`id_perfil`);

--
-- Filtros para la tabla `probador_virtual`
--
ALTER TABLE `probador_virtual`
  ADD CONSTRAINT `probador_virtual_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id_persona`),
  ADD CONSTRAINT `probador_virtual_ibfk_2` FOREIGN KEY (`id_anteojo`) REFERENCES `anteojos` (`id_anteojo`);

--
-- Filtros para la tabla `recetas`
--
ALTER TABLE `recetas`
  ADD CONSTRAINT `fk_receta_anteojo` FOREIGN KEY (`id_anteojo`) REFERENCES `anteojos` (`id_anteojo`),
  ADD CONSTRAINT `fk_receta_persona` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id_persona`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `fk_venta_forma_pago` FOREIGN KEY (`pago_id`) REFERENCES `formas_pago` (`pago_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ventas_persona` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id_persona`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

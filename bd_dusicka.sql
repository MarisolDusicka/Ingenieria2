-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-05-2026 a las 15:39:29
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
-- Base de datos: `bd_dusicka`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anteojos`
--

CREATE TABLE `anteojos` (
  `id_anteojo` int(11) NOT NULL,
  `codigo_anteojo` int(11) NOT NULL,
  `anteojo_nombre` varchar(255) NOT NULL,
  `anteojo_categoria` int(11) NOT NULL,
  `anteojo_marca` int(11) NOT NULL,
  `anteojo_stock` int(3) NOT NULL,
  `anteojo_precio` decimal(8,2) NOT NULL DEFAULT 0.00,
  `anteojo_descripcion` varchar(300) NOT NULL,
  `anteojo_imagen` varchar(100) NOT NULL,
  `anteojo_estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `anteojos`
--

INSERT INTO `anteojos` (`id_anteojo`, `codigo_anteojo`, `anteojo_nombre`, `anteojo_categoria`, `anteojo_marca`, `anteojo_stock`, `anteojo_precio`, `anteojo_descripcion`, `anteojo_imagen`, `anteojo_estado`) VALUES
(1, 123456, 'AY NOT DEAD', 1, 2, 1, 15000.00, 'AY NOT DEAD (AY-ANN)', '1717729979_08a50e73668f47277554.jpg', 0),
(2, 123456, 'Infinity', 1, 4, 8, 30000.00, 'Armazon Roma Translúcido: Negro', '1717730062_ab6e30ef6c613291d345.png', 0),
(3, 123456, 'RAY BAN', 1, 5, 10, 35000.00, 'RAY BAN (RB-1582L)', '1717730093_fe227c194534872a056a.jpg', 0),
(4, 123456, 'Sofia Loren', 1, 6, 10, 35000.00, ' SOPHIA LOREN UMA (SLO-UMA)\r\n', '1717730126_0c330bd4ef14bbda5834.jpg', 1),
(5, 123456, 'VALERIA MAZZA', 1, 7, 10, 40000.00, ' VALERIA MAZZA 1030 (VM-1030)', '1717730154_f94429b897cfb735046d.jpg', 1),
(6, 123456, 'AY NOT DEAD', 2, 2, 10, 40000.00, ' AY NOT DEAD (AYN-193)', '1717730191_2f52bec590fc10b258dc.jpg', 0),
(7, 123456, 'Infinity', 2, 4, 10, 45000.00, 'ANTEOJOS DE SOL PARIS SPECIAL METAL EDITION NEGRO BRILLO LENTE SUNSET DEGRADE', '1717730229_595459a7efb039370959.jpg', 0),
(8, 123456, 'RAY BAN', 2, 5, 10, 50000.00, 'RAY BAN ERIKA (RB-4171P)', '1717730258_f6ce3224d8a5919605f1.png', 1),
(9, 123456, 'Sofia Loren', 2, 6, 9, 65000.00, ' SOPHIA LOREN (SLO-ABIGAIL)', '1717730364_6a88a8087598a317628e.jpg', 1),
(10, 123456, 'VALERIA MAZZA', 2, 7, 10, 70000.00, 'VALERIA MAZZA (VM-6215)', '1717730388_c8026ac497e12da77964.png', 0),
(11, 123456, 'AY NOT DEAD', 1, 2, 20, 25000.00, 'AY NOT DEAD (AY-ANN)', '1718158113_4a1fe853734c436cbdaa.jpg', 1),
(12, 123456, 'Infinity', 1, 4, 20, 35000.00, 'Armazon Roma Translúcido: Negro', '1718158176_3948574a158de7c44413.jpg', 1),
(13, 123456, 'Sofia Loren', 1, 6, 20, 85000.00, ' SOPHIA LOREN UMA (SLO-UMA)', '1718158252_aa9c849ec69c8ae87f93.jpg', 1),
(14, 123456, 'RAY BAN', 1, 5, 19, 85000.00, 'RAY BAN (RB-1582L)', '1718158413_aa19854aa51deab6724f.jpg', 1),
(15, 123456, 'VALERIA MAZZA', 1, 7, 20, 95000.00, ' VALERIA MAZZA 1030 (VM-1030)', '1718158458_20dca478bcdfcc3f4f5f.png', 1),
(16, 123456, 'AY NOT DEAD', 2, 2, 20, 50000.00, ' AY NOT DEAD (AYN-193)', '1718158598_ca3462c60fe69409ffe3.jpg', 1),
(17, 123456, 'Infinity', 2, 4, 19, 85000.00, 'ANTEOJOS DE SOL PARIS SPECIAL METAL EDITION NEGRO BRILLO LENTE SUNSET DEGRADE', '1718158667_973e5e0db20fe218a8b2.jpg', 1),
(18, 123456, 'RAY BAN', 2, 5, 19, 85000.00, 'RAY BAN ERIKA (RB-4171P)', '1718158728_c5e7218d6abaeaaae532.jpg', 1),
(19, 123456, 'Sofia Loren', 2, 6, 19, 139000.00, ' SOPHIA LOREN (SLO-ABIGAIL)', '1718158801_ff3c6fd3a4e80e479f42.jpg', 1),
(20, 123456, 'VALERIA MAZZA', 2, 7, 20, 139000.00, 'VALERIA MAZZA (VM-6215)', '1718158848_51131b7a66c688bc7ab8.png', 1),
(21, 123456, 'Acuvue Oasys con HydraClear Plus', 3, 1, 20, 25000.00, 'ACUVUE OASYS CON HYDRACLEAR PLUS', '1718160142_cb44ce623ae7e294d743.jpg', 1),
(22, 123456, 'Freshlook', 3, 3, 20, 50000.00, 'Lentes de contacto Freshlook Colorblends Formulados', '1718160192_bd0f273e2f2c5c159459.jpg', 1);

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
(1, 'Anteojos de Recetas'),
(2, 'Anteojos de Sol'),
(3, 'Lentes de Contacto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultas`
--

CREATE TABLE `consultas` (
  `id_consulta` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `motivo` varchar(100) NOT NULL,
  `consulta` text NOT NULL,
  `recibido` varchar(20) DEFAULT 'leido'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `consultas`
--

INSERT INTO `consultas` (`id_consulta`, `nombre`, `email`, `motivo`, `consulta`, `recibido`) VALUES
(1, 'ana ortiz', 'anaortiz@gmail.com', 'presupuesto marcos', 'presupuesto marcos', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_marcas_categoria`
--

CREATE TABLE `detalle_marcas_categoria` (
  `id_detalle` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `cantidad` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

CREATE TABLE `detalle_ventas` (
  `id` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_anteojo` int(11) NOT NULL,
  `detalle_cantidad` int(100) NOT NULL,
  `detalle_precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_ventas`
--

INSERT INTO `detalle_ventas` (`id`, `id_venta`, `id_anteojo`, `detalle_cantidad`, `detalle_precio`) VALUES
(1, 1, 17, 1, 85000.00),
(2, 1, 2, 1, 30000.00),
(3, 2, 9, 1, 65000.00),
(4, 3, 2, 1, 30000.00),
(5, 3, 18, 1, 85000.00),
(6, 4, 14, 1, 85000.00),
(7, 4, 19, 1, 139000.00),
(61, 80, 1, 1, 15000.00),
(62, 81, 1, 1, 15000.00),
(63, 82, 1, 5, 15000.00),
(64, 83, 1, 1, 15000.00),
(65, 84, 1, 1, 15000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formas_pago`
--

CREATE TABLE `formas_pago` (
  `pago_id` int(11) NOT NULL,
  `detalle_pago` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'Acuvue Oasys con HydraClear Plus'),
(2, 'AY NOT DEAD'),
(3, 'Freshlook'),
(4, 'INFINITY'),
(5, 'RAY BAN'),
(6, 'SOPHIA LOREN'),
(7, 'VALERIA MAZZA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `perfil_id` int(11) NOT NULL,
  `perfil_descripción` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`perfil_id`, `perfil_descripción`) VALUES
(1, 'Administrador'),
(2, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id_persona` int(11) NOT NULL,
  `persona_nombre` varchar(50) NOT NULL,
  `persona_apellido` varchar(50) NOT NULL,
  `persona_telefono` smallint(11) NOT NULL,
  `persona_direccion` varchar(300) NOT NULL,
  `persona_email` varchar(50) NOT NULL,
  `persona_password` varchar(300) NOT NULL,
  `perfil_id` int(11) NOT NULL,
  `persona_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id_persona`, `persona_nombre`, `persona_apellido`, `persona_telefono`, `persona_direccion`, `persona_email`, `persona_password`, `perfil_id`, `persona_estado`) VALUES
(1, 'Marisol ', 'Dusicka', 32767, 'rivadavia 12345', 'marisol@gmail.com', '$2y$10$MlOB1pfFUob8IpNzWc7/Se74d3d642a6gwYz.19VvgPcCZPmjMJUm', 1, 1),
(2, 'Victor', 'Encina', 32767, 'rivadavia 12345', 'victor@gmail.com', '$2y$10$kl4cKLfp/lHRsVZfl5213.fzxqQ9IB/8nx7N6yB9Kes6tQvAuE7/e', 2, 1),
(3, 'Ana', 'Ortiz', 32767, 'rivadavia 4500', 'anaortiz@gmail.com', '$2y$10$W4hRuZPsm8lkBHsuMjkxpOq3xRm1VNFPAcDvhNrQ9MzQxCMgC5qwy', 2, 1),
(4, 'Matias', 'matias', 32767, 'rivadavia 4500', 'matias@hotmail.com', '$2y$10$DmZD1XkD26nmiCFrTk9EguMW7poRy2s9McV9xy3jb9g3YscQCYzUy', 2, 1),
(5, 'erika', 'gonzalez', 32767, 'rivadavia 12345', 'erika@gmail.com', '$2y$10$tbL88n35HiMvRSHJtvGMa.JguU/BOEzB6zQTHancdbraZfS9Ym.TW', 2, 1),
(22, 'alex ', 'altamirano', 32767, 'calle1', 'alex@gmail.com', '$2y$10$ZseYJQsdxbseIiRcHmtw4u01KFTtSTRAgqvJmOprhb0p9TSK32q56', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuestos`
--

CREATE TABLE `presupuestos` (
  `id_presupuesto` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `id_anteojo` int(11) NOT NULL,
  `archivo_receta` varchar(255) NOT NULL,
  `observaciones` text DEFAULT NULL,
  `estado` enum('pendiente','revisado') DEFAULT 'pendiente',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `presupuestos`
--

INSERT INTO `presupuestos` (`id_presupuesto`, `id_persona`, `id_anteojo`, `archivo_receta`, `observaciones`, `estado`, `fecha_creacion`) VALUES
(1, 5, 2, '1777989549_7af3169b0fbfbf589899.jpg', '', '', '2026-05-05 13:59:09'),
(2, 2, 3, '1778003647_c6adc7726243261ac9b3.jpg', '', 'pendiente', '2026-05-05 17:54:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recetas`
--

CREATE TABLE `recetas` (
  `id_receta` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `id_anteojo` int(11) NOT NULL,
  `observaciones` text DEFAULT NULL,
  `receta` varchar(255) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `estado` varchar(20) DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recetas`
--

INSERT INTO `recetas` (`id_receta`, `id_persona`, `id_anteojo`, `observaciones`, `receta`, `fecha`, `estado`) VALUES
(1, 2, 2, '', '1778073204_da22228248ed5061b7db.jpg', '2026-05-06', 'pendiente'),
(2, 2, 2, '', '1778073321_a8166faf64dbe8b17dc7.jpg', '2026-05-06', 'pendiente'),
(3, 2, 2, '', '1778073499_5dfadf99101d55ed9f7b.jpg', '2026-05-06', 'pendiente'),
(4, 2, 2, '', '1778073603_b314a1f966d1e0fc130b.jpg', '2026-05-06', 'pendiente'),
(5, 2, 2, '', '1778073751_8947fb334cd5df45f89b.jpg', '2026-05-06', 'pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `venta_fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `id_persona`, `venta_fecha`) VALUES
(1, 2, '2024-06-17'),
(2, 3, '2024-06-17'),
(3, 4, '2024-06-17'),
(4, 5, '2024-06-17'),
(80, 2, '2026-05-04'),
(81, 2, '2026-05-04'),
(82, 2, '2026-05-05'),
(83, 2, '2026-05-05'),
(84, 2, '2026-05-05');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anteojos`
--
ALTER TABLE `anteojos`
  ADD PRIMARY KEY (`id_anteojo`),
  ADD KEY `anteojos_ibfk_1` (`anteojo_categoria`),
  ADD KEY `anteojos_ibfk_2` (`anteojo_marca`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`id_consulta`);

--
-- Indices de la tabla `detalle_marcas_categoria`
--
ALTER TABLE `detalle_marcas_categoria`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_marca` (`id_marca`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_anteojo` (`id_anteojo`),
  ADD KEY `id_venta` (`id_venta`);

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
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`perfil_id`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id_persona`),
  ADD KEY `perfil_id` (`perfil_id`);

--
-- Indices de la tabla `presupuestos`
--
ALTER TABLE `presupuestos`
  ADD PRIMARY KEY (`id_presupuesto`),
  ADD KEY `id_persona` (`id_persona`),
  ADD KEY `id_anteojo` (`id_anteojo`);

--
-- Indices de la tabla `recetas`
--
ALTER TABLE `recetas`
  ADD PRIMARY KEY (`id_receta`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_persona` (`id_persona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anteojos`
--
ALTER TABLE `anteojos`
  MODIFY `id_anteojo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `consultas`
--
ALTER TABLE `consultas`
  MODIFY `id_consulta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `detalle_marcas_categoria`
--
ALTER TABLE `detalle_marcas_categoria`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de la tabla `formas_pago`
--
ALTER TABLE `formas_pago`
  MODIFY `pago_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `perfil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `presupuestos`
--
ALTER TABLE `presupuestos`
  MODIFY `id_presupuesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `recetas`
--
ALTER TABLE `recetas`
  MODIFY `id_receta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anteojos`
--
ALTER TABLE `anteojos`
  ADD CONSTRAINT `anteojos_ibfk_1` FOREIGN KEY (`anteojo_categoria`) REFERENCES `categorias` (`id_categoria`),
  ADD CONSTRAINT `anteojos_ibfk_2` FOREIGN KEY (`anteojo_marca`) REFERENCES `marcas` (`id_marca`);

--
-- Filtros para la tabla `detalle_marcas_categoria`
--
ALTER TABLE `detalle_marcas_categoria`
  ADD CONSTRAINT `detalle_marcas_categoria_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id_marca`),
  ADD CONSTRAINT `detalle_marcas_categoria_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD CONSTRAINT `detalle_ventas_ibfk_2` FOREIGN KEY (`id_anteojo`) REFERENCES `anteojos` (`id_anteojo`),
  ADD CONSTRAINT `detalle_ventas_ibfk_3` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`);

--
-- Filtros para la tabla `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `personas_ibfk_1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`perfil_id`);

--
-- Filtros para la tabla `presupuestos`
--
ALTER TABLE `presupuestos`
  ADD CONSTRAINT `presupuestos_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id_persona`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `presupuestos_ibfk_2` FOREIGN KEY (`id_anteojo`) REFERENCES `anteojos` (`id_anteojo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id_persona`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-07-2018 a las 04:06:25
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `interfaz`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `al_rut` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `al_nombres` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `al_apellido_pat` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `al_apellido_mat` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comuna_id` int(10) UNSIGNED NOT NULL,
  `al_domicilio` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `al_sexo` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `al_fecha_nacimiento` date NOT NULL,
  `al_fono` int(11) DEFAULT NULL,
  `al_proced_escolar` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`al_rut`, `al_nombres`, `al_apellido_pat`, `al_apellido_mat`, `comuna_id`, `al_domicilio`, `al_sexo`, `al_fecha_nacimiento`, `al_fono`, `al_proced_escolar`, `created_at`, `updated_at`) VALUES
('11.111.111-1', 'javier uno', 'javiunopat', 'javiunomat', 1, 'domicilio javier 1', 'masculino', '1999-12-12', 111111111, NULL, '2018-06-24 06:33:05', '2018-06-24 06:33:05'),
('12.111.111-1', 'javier dos', 'javidospat', 'javidosmat', 3, 'domicilio javier dos', 'masculino', '2000-03-12', 222222222, NULL, '2018-06-28 21:03:35', '2018-06-28 21:03:35'),
('12.121.212-1', 'alumno12', 'apellido12', 'apellidomat12', 1, 'domicilio12', 'femenino', '2017-11-02', 0, '', '2017-11-28 01:30:02', '2017-11-28 01:30:02'),
('14.141.414-1', 'alumno14', 'alpat14', 'almat14', 1, 'domicilio14', 'masculino', '1997-06-10', 1, '', '2018-02-06 06:22:39', '2018-02-06 06:22:39'),
('17.794.500-3', 'Crístian Alarcón', 'Montolla', 'Arévalo', 1, 'domicilio de cristian', 'masculino', '2000-03-09', 987341345, '', '2018-03-02 05:47:20', '2018-03-02 05:47:20'),
('18.500.343-3', 'Felipe Alfredo', 'Araneda', 'Irribarra', 1, 'lautaro #123', 'masculino', '2003-02-05', 23123231, '', '2018-02-20 02:02:04', '2018-02-20 02:02:04'),
('21.111.111-1', 'marcelo uno', 'marcelopat', 'marcelomat', 1, 'domicilio marcelo 1', 'masculino', '2000-03-04', 111111111, NULL, '2018-06-24 06:37:54', '2018-06-24 06:37:54'),
('21.212.121-2', 'alumno12', 'alumnoPat12', 'alumnoMat12', 1, 'domicilio12', 'femenino', '1999-02-09', 0, '', '2018-02-06 03:33:42', '2018-02-06 03:33:42'),
('22.111.111-2', 'Marcelo Dos', 'Gonzalez', 'Tapia', 3, 'domicilio marcelo dos', 'masculino', '2001-04-04', NULL, NULL, '2018-06-28 21:06:56', '2018-06-28 21:06:56'),
('22.222.222-2', 'alumno2', 'patalumno2', 'matalumno2', 1, 'domicilio2', 'femenino', '2010-12-22', 0, '', '2017-06-17 14:26:14', '2017-06-17 14:26:14'),
('23.123.412-3', 'luis felipe', 'maliqueo', 'araneda', 1, 'williams #1332', 'masculino', '1993-04-18', 9842342, NULL, '2018-06-22 18:21:51', '2018-06-22 18:21:51'),
('23.212.412-2', 'Belén Constanza', 'Cuevas', 'Galdamez', 1, 'calle Williams #1332', 'femenino', '2017-12-13', NULL, NULL, '2018-03-25 01:36:58', '2018-03-25 01:36:58'),
('24.111.111-2', 'Helen Dos', 'Alarcón', 'Ramírez', 1, 'domicilio helen dos', 'femenino', '2001-04-01', NULL, NULL, '2018-06-29 08:18:35', '2018-06-29 08:18:35'),
('31.111.111-1', 'matilda uno', 'matildapat', 'matildamat', 1, 'domicilio matilda 1', 'femenino', '2000-05-22', 111111111, NULL, '2018-06-24 06:44:50', '2018-06-24 06:44:50'),
('31.111.111-3', 'Javier tres', 'Aguilera', 'Villarroel', 1, 'domicilio javier dos', 'masculino', '2000-02-12', 222222222, NULL, '2018-06-29 08:14:28', '2018-06-29 08:14:28'),
('32.111.111-3', 'Matilda Dos', 'Valenzuela', 'Hernandez', 3, 'coronel domicilio matilda', 'femenino', '1999-05-05', NULL, NULL, '2018-06-28 21:10:49', '2018-06-28 21:10:49'),
('33.111.111-3', 'Marcelo Dos', 'Rifo', 'Campos', 1, 'domicilio marcelo dos', 'masculino', '2002-05-21', NULL, NULL, '2018-06-29 08:24:56', '2018-06-29 08:24:56'),
('33.333.333-3', 'alumno3', 'patalumno3', 'matalumno3', 1, 'domicilio3', 'masculino', '2003-03-03', 0, '', '2017-06-17 18:44:50', '2017-06-17 18:44:50'),
('34.111.111-4', 'Vanessa tres', 'Huerta', 'Castillo', 1, 'domicilio vanessa tres', 'femenino', '1999-12-04', 444444444, NULL, '2018-06-29 08:31:39', '2018-06-29 08:31:39'),
('35.111.111-5', 'Bastián Tres', 'Altozano', 'Mora', 3, 'domicilio bastian tres', 'masculino', '2001-06-15', NULL, NULL, '2018-06-29 08:35:12', '2018-06-29 08:35:12'),
('36.111.111-6', 'Fabiana Tres', 'Inzunza', 'Medina', 1, 'domicilio fabiana 3', 'femenino', '1999-07-15', 93002122, NULL, '2018-06-29 08:40:00', '2018-06-29 08:40:00'),
('41.111.111-1', 'francisca uno', 'franunopat', 'franunomat', 1, 'domicilio francisca 1', 'femenino', '2000-05-23', 111111111, NULL, '2018-06-24 06:54:02', '2018-06-24 06:54:02'),
('44.444.444-4', 'alumno4', 'patalumno4', 'matalumno4', 1, 'domicilio4', 'masculino', '2004-04-04', 0, '', '2017-06-17 22:43:04', '2017-06-17 22:43:04'),
('51.111.111-1', 'felipe uno', 'felunopat', 'felunomat', 1, 'domicilio felipe 1', 'masculino', '1999-12-12', 111111111, NULL, '2018-06-24 10:04:59', '2018-06-24 10:04:59'),
('51.111.111-5', 'primer alumno', 'alumnoPat1', 'alumnoMat1', 1, 'domicilio1', 'masculino', '2000-03-09', 0, '', '2017-06-06 20:31:07', '2018-03-02 19:39:58'),
('55.555.555-5', 'alumno5', 'alpat5', 'almat5', 1, 'domicilio5', 'femenino', '2000-06-07', 0, '', '2017-11-16 22:07:40', '2017-11-16 22:07:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_asiste`
--

CREATE TABLE `alumno_asiste` (
  `id` int(10) UNSIGNED NOT NULL,
  `dia_clase_id` int(10) UNSIGNED NOT NULL,
  `matricula_id` int(10) UNSIGNED NOT NULL,
  `ala_estado` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `alumno_asiste`
--

INSERT INTO `alumno_asiste` (`id`, `dia_clase_id`, `matricula_id`, `ala_estado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, NULL),
(2, 2, 1, 1, NULL, NULL),
(3, 1, 2, 0, NULL, NULL),
(4, 2, 2, 1, NULL, NULL),
(5, 3, 2, 1, NULL, NULL),
(6, 4, 2, 1, NULL, NULL),
(7, 5, 2, 1, NULL, NULL),
(8, 3, 2, 1, NULL, NULL),
(9, 4, 2, 1, NULL, NULL),
(10, 6, 2, 1, NULL, NULL),
(11, 7, 2, 0, NULL, NULL),
(12, 8, 2, 1, NULL, NULL),
(13, 3, 11, 1, NULL, NULL),
(14, 4, 11, 1, NULL, NULL),
(15, 6, 11, 0, NULL, NULL),
(16, 7, 11, 1, NULL, NULL),
(17, 8, 11, 0, NULL, NULL),
(18, 9, 2, 1, NULL, NULL),
(19, 10, 2, 1, NULL, NULL),
(20, 9, 11, 1, NULL, NULL),
(21, 10, 11, 0, NULL, NULL),
(22, 11, 2, 1, NULL, NULL),
(23, 12, 2, 0, NULL, NULL),
(24, 11, 11, 0, NULL, NULL),
(25, 12, 11, 1, NULL, NULL),
(26, 13, 2, 1, NULL, NULL),
(27, 14, 2, 1, NULL, NULL),
(28, 15, 2, 0, NULL, NULL),
(29, 13, 11, 1, NULL, NULL),
(30, 14, 11, 1, NULL, NULL),
(31, 15, 11, 1, NULL, NULL),
(32, 3, 11, 0, NULL, NULL),
(33, 4, 11, 1, NULL, NULL),
(34, 5, 11, 0, NULL, NULL),
(35, 16, 10, 1, NULL, NULL),
(36, 16, 2, 0, NULL, NULL),
(37, 16, 11, 1, NULL, NULL),
(38, 17, 10, 1, NULL, NULL),
(39, 17, 2, 1, NULL, NULL),
(40, 17, 11, 1, NULL, NULL),
(41, 18, 10, 1, NULL, NULL),
(42, 18, 2, 0, NULL, NULL),
(43, 18, 11, 1, NULL, NULL),
(44, 19, 12, 1, NULL, NULL),
(45, 20, 12, 1, NULL, NULL),
(46, 16, 4, 1, NULL, NULL),
(47, 16, 10, 0, NULL, NULL),
(48, 16, 2, 1, NULL, NULL),
(49, 16, 11, 0, NULL, NULL),
(50, 21, 16, 1, NULL, NULL),
(52, 23, 16, 1, NULL, NULL),
(53, 21, 17, 1, NULL, NULL),
(55, 23, 17, 1, NULL, NULL),
(56, 21, 18, 0, NULL, NULL),
(57, 22, 18, 0, NULL, NULL),
(58, 23, 18, 1, NULL, NULL),
(59, 21, 19, 1, NULL, NULL),
(61, 23, 19, 0, NULL, NULL),
(62, 21, 20, 0, NULL, NULL),
(64, 23, 20, 0, NULL, NULL),
(65, 24, 16, 1, NULL, NULL),
(66, 25, 16, 1, NULL, NULL),
(67, 24, 17, 0, NULL, NULL),
(68, 25, 17, 1, NULL, NULL),
(69, 24, 18, 1, NULL, NULL),
(70, 25, 18, 1, NULL, NULL),
(71, 24, 19, 0, NULL, NULL),
(72, 25, 19, 0, NULL, NULL),
(73, 24, 20, 1, NULL, NULL),
(74, 25, 20, 1, NULL, NULL),
(75, 26, 16, 1, NULL, NULL),
(76, 27, 16, 1, NULL, NULL),
(77, 28, 16, 0, NULL, NULL),
(78, 29, 16, 0, NULL, NULL),
(79, 26, 17, 0, NULL, NULL),
(80, 27, 17, 1, NULL, NULL),
(81, 28, 17, 1, NULL, NULL),
(82, 29, 17, 1, NULL, NULL),
(83, 26, 18, 1, NULL, NULL),
(84, 27, 18, 0, NULL, NULL),
(85, 28, 18, 1, NULL, NULL),
(86, 29, 18, 0, NULL, NULL),
(87, 26, 19, 0, NULL, NULL),
(88, 27, 19, 1, NULL, NULL),
(89, 28, 19, 1, NULL, NULL),
(90, 29, 19, 0, NULL, NULL),
(91, 26, 20, 1, NULL, NULL),
(92, 27, 20, 1, NULL, NULL),
(93, 28, 20, 1, NULL, NULL),
(94, 29, 20, 1, NULL, NULL),
(95, 30, 16, 1, NULL, NULL),
(96, 30, 17, 0, NULL, NULL),
(97, 30, 18, 1, NULL, NULL),
(98, 30, 19, 1, NULL, NULL),
(99, 30, 20, 0, NULL, NULL),
(100, 31, 16, 1, NULL, NULL),
(101, 32, 16, 0, NULL, NULL),
(102, 33, 16, 1, NULL, NULL),
(103, 34, 16, 1, NULL, NULL),
(104, 31, 17, 0, NULL, NULL),
(105, 32, 17, 0, NULL, NULL),
(106, 33, 17, 1, NULL, NULL),
(107, 34, 17, 1, NULL, NULL),
(108, 31, 18, 0, NULL, NULL),
(110, 33, 18, 1, NULL, NULL),
(112, 31, 19, 1, NULL, NULL),
(113, 32, 19, 1, NULL, NULL),
(114, 33, 19, 1, NULL, NULL),
(115, 34, 19, 1, NULL, NULL),
(116, 31, 20, 0, NULL, NULL),
(117, 32, 20, 0, NULL, NULL),
(118, 33, 20, 0, NULL, NULL),
(119, 34, 20, 1, NULL, NULL),
(122, 35, 17, 0, NULL, NULL),
(123, 36, 17, 1, NULL, NULL),
(124, 32, 18, 0, NULL, NULL),
(125, 34, 18, 1, NULL, NULL),
(126, 35, 18, 1, NULL, NULL),
(127, 36, 18, 0, NULL, NULL),
(128, 22, 16, 1, NULL, NULL),
(129, 37, 16, 0, NULL, NULL),
(130, 38, 16, 1, NULL, NULL),
(131, 22, 17, 0, NULL, NULL),
(132, 37, 17, 1, NULL, NULL),
(133, 38, 17, 1, NULL, NULL),
(135, 37, 18, 0, NULL, NULL),
(136, 38, 18, 1, NULL, NULL),
(137, 22, 19, 1, NULL, NULL),
(138, 37, 19, 1, NULL, NULL),
(139, 38, 19, 0, NULL, NULL),
(140, 22, 20, 1, NULL, NULL),
(141, 37, 20, 1, NULL, NULL),
(142, 38, 20, 1, NULL, NULL),
(143, 39, 16, 1, NULL, NULL),
(144, 40, 16, 0, NULL, NULL),
(145, 41, 16, 1, NULL, NULL),
(146, 39, 17, 1, NULL, NULL),
(147, 40, 17, 1, NULL, NULL),
(148, 41, 17, 1, NULL, NULL),
(149, 39, 18, 1, NULL, NULL),
(150, 40, 18, 1, NULL, NULL),
(151, 41, 18, 0, NULL, NULL),
(152, 39, 19, 0, NULL, NULL),
(153, 40, 19, 0, NULL, NULL),
(154, 41, 19, 1, NULL, NULL),
(155, 39, 20, 1, NULL, NULL),
(156, 40, 20, 0, NULL, NULL),
(157, 41, 20, 0, NULL, NULL),
(158, 42, 16, 1, NULL, NULL),
(159, 43, 16, 0, NULL, NULL),
(160, 42, 17, 1, NULL, NULL),
(161, 43, 17, 1, NULL, NULL),
(162, 42, 18, 1, NULL, NULL),
(163, 43, 18, 1, NULL, NULL),
(164, 42, 19, 0, NULL, NULL),
(165, 43, 19, 0, NULL, NULL),
(166, 42, 20, 1, NULL, NULL),
(167, 43, 20, 1, NULL, NULL),
(168, 44, 16, 1, NULL, NULL),
(169, 45, 16, 0, NULL, NULL),
(170, 46, 16, 1, NULL, NULL),
(171, 47, 16, 1, NULL, NULL),
(172, 44, 17, 0, NULL, NULL),
(173, 45, 17, 1, NULL, NULL),
(174, 46, 17, 1, NULL, NULL),
(175, 47, 17, 0, NULL, NULL),
(176, 44, 18, 1, NULL, NULL),
(177, 45, 18, 1, NULL, NULL),
(178, 46, 18, 1, NULL, NULL),
(179, 47, 18, 1, NULL, NULL),
(180, 44, 19, 0, NULL, NULL),
(181, 45, 19, 0, NULL, NULL),
(182, 46, 19, 0, NULL, NULL),
(183, 47, 19, 1, NULL, NULL),
(184, 44, 20, 1, NULL, NULL),
(185, 45, 20, 1, NULL, NULL),
(186, 46, 20, 0, NULL, NULL),
(187, 47, 20, 1, NULL, NULL),
(188, 48, 16, 1, NULL, NULL),
(189, 49, 16, 0, NULL, NULL),
(190, 50, 16, 1, NULL, NULL),
(191, 48, 17, 1, NULL, NULL),
(192, 49, 17, 1, NULL, NULL),
(193, 50, 17, 0, NULL, NULL),
(194, 48, 18, 0, NULL, NULL),
(195, 49, 18, 1, NULL, NULL),
(196, 50, 18, 0, NULL, NULL),
(197, 48, 19, 1, NULL, NULL),
(198, 49, 19, 1, NULL, NULL),
(199, 50, 19, 1, NULL, NULL),
(200, 48, 20, 0, NULL, NULL),
(201, 49, 20, 0, NULL, NULL),
(202, 50, 20, 0, NULL, NULL),
(203, 21, 24, 1, NULL, NULL),
(204, 31, 24, 1, NULL, NULL),
(205, 32, 24, 1, NULL, NULL),
(206, 21, 25, 1, NULL, NULL),
(207, 31, 25, 1, NULL, NULL),
(208, 32, 25, 1, NULL, NULL),
(209, 21, 26, 1, NULL, NULL),
(210, 31, 26, 0, NULL, NULL),
(211, 32, 26, 1, NULL, NULL),
(212, 21, 28, 0, NULL, NULL),
(213, 31, 28, 1, NULL, NULL),
(214, 32, 28, 1, NULL, NULL),
(215, 21, 22, 1, NULL, NULL),
(216, 31, 22, 0, NULL, NULL),
(217, 32, 22, 0, NULL, NULL),
(218, 51, 24, 1, NULL, NULL),
(219, 52, 24, 0, NULL, NULL),
(220, 53, 24, 0, NULL, NULL),
(221, 51, 25, 0, NULL, NULL),
(222, 52, 25, 1, NULL, NULL),
(223, 53, 25, 1, NULL, NULL),
(224, 51, 26, 1, NULL, NULL),
(225, 52, 26, 1, NULL, NULL),
(226, 53, 26, 1, NULL, NULL),
(227, 51, 28, 1, NULL, NULL),
(228, 52, 28, 0, NULL, NULL),
(229, 53, 28, 1, NULL, NULL),
(230, 51, 22, 1, NULL, NULL),
(231, 52, 22, 1, NULL, NULL),
(232, 53, 22, 1, NULL, NULL),
(233, 39, 24, 1, NULL, NULL),
(234, 40, 24, 1, NULL, NULL),
(235, 39, 25, 1, NULL, NULL),
(236, 40, 25, 1, NULL, NULL),
(237, 39, 26, 1, NULL, NULL),
(238, 40, 26, 0, NULL, NULL),
(239, 39, 28, 1, NULL, NULL),
(240, 40, 28, 1, NULL, NULL),
(241, 39, 22, 0, NULL, NULL),
(242, 40, 22, 1, NULL, NULL),
(243, 54, 24, 1, NULL, NULL),
(244, 55, 24, 1, NULL, NULL),
(245, 56, 24, 0, NULL, NULL),
(246, 57, 24, 1, NULL, NULL),
(247, 54, 25, 0, NULL, NULL),
(248, 55, 25, 1, NULL, NULL),
(249, 56, 25, 1, NULL, NULL),
(250, 57, 25, 1, NULL, NULL),
(251, 54, 26, 1, NULL, NULL),
(252, 55, 26, 0, NULL, NULL),
(253, 56, 26, 0, NULL, NULL),
(254, 57, 26, 1, NULL, NULL),
(255, 54, 28, 1, NULL, NULL),
(256, 55, 28, 1, NULL, NULL),
(257, 56, 28, 0, NULL, NULL),
(258, 57, 28, 0, NULL, NULL),
(259, 54, 22, 1, NULL, NULL),
(260, 55, 22, 1, NULL, NULL),
(261, 56, 22, 1, NULL, NULL),
(262, 57, 22, 1, NULL, NULL),
(263, 33, 24, 1, NULL, NULL),
(264, 33, 25, 1, NULL, NULL),
(265, 33, 26, 1, NULL, NULL),
(266, 33, 28, 1, NULL, NULL),
(267, 33, 22, 1, NULL, NULL),
(268, 58, 24, 1, NULL, NULL),
(269, 59, 24, 1, NULL, NULL),
(270, 60, 24, 0, NULL, NULL),
(271, 61, 24, 1, NULL, NULL),
(272, 62, 24, 0, NULL, NULL),
(273, 58, 25, 1, NULL, NULL),
(274, 59, 25, 1, NULL, NULL),
(275, 60, 25, 1, NULL, NULL),
(276, 61, 25, 0, NULL, NULL),
(277, 62, 25, 1, NULL, NULL),
(278, 58, 26, 1, NULL, NULL),
(279, 59, 26, 1, NULL, NULL),
(280, 60, 26, 1, NULL, NULL),
(281, 61, 26, 1, NULL, NULL),
(282, 62, 26, 1, NULL, NULL),
(283, 58, 28, 1, NULL, NULL),
(284, 59, 28, 0, NULL, NULL),
(285, 60, 28, 1, NULL, NULL),
(286, 61, 28, 0, NULL, NULL),
(287, 62, 28, 1, NULL, NULL),
(288, 58, 22, 1, NULL, NULL),
(289, 59, 22, 1, NULL, NULL),
(290, 60, 22, 1, NULL, NULL),
(291, 61, 22, 1, NULL, NULL),
(292, 62, 22, 0, NULL, NULL),
(293, 63, 24, 1, NULL, NULL),
(294, 64, 24, 0, NULL, NULL),
(295, 65, 24, 0, NULL, NULL),
(296, 63, 25, 1, NULL, NULL),
(297, 64, 25, 1, NULL, NULL),
(298, 65, 25, 1, NULL, NULL),
(299, 63, 26, 0, NULL, NULL),
(300, 64, 26, 1, NULL, NULL),
(301, 65, 26, 1, NULL, NULL),
(302, 63, 28, 1, NULL, NULL),
(303, 64, 28, 0, NULL, NULL),
(304, 65, 28, 1, NULL, NULL),
(305, 63, 22, 1, NULL, NULL),
(306, 64, 22, 0, NULL, NULL),
(307, 65, 22, 1, NULL, NULL),
(308, 66, 24, 1, NULL, NULL),
(309, 66, 25, 1, NULL, NULL),
(310, 66, 26, 1, NULL, NULL),
(311, 66, 28, 1, NULL, NULL),
(312, 66, 22, 1, NULL, NULL),
(313, 28, 24, 1, NULL, NULL),
(314, 67, 24, 1, NULL, NULL),
(315, 28, 25, 0, NULL, NULL),
(316, 67, 25, 1, NULL, NULL),
(317, 28, 26, 1, NULL, NULL),
(318, 67, 26, 0, NULL, NULL),
(319, 28, 28, 1, NULL, NULL),
(320, 67, 28, 1, NULL, NULL),
(321, 28, 22, 1, NULL, NULL),
(322, 67, 22, 1, NULL, NULL),
(323, 68, 24, 1, NULL, NULL),
(324, 69, 24, 0, NULL, NULL),
(325, 70, 24, 1, NULL, NULL),
(326, 68, 25, 1, NULL, NULL),
(327, 69, 25, 1, NULL, NULL),
(328, 70, 25, 1, NULL, NULL),
(329, 68, 26, 1, NULL, NULL),
(330, 69, 26, 1, NULL, NULL),
(331, 70, 26, 1, NULL, NULL),
(332, 68, 28, 1, NULL, NULL),
(333, 69, 28, 1, NULL, NULL),
(334, 70, 28, 1, NULL, NULL),
(335, 68, 22, 0, NULL, NULL),
(336, 69, 22, 1, NULL, NULL),
(337, 70, 22, 0, NULL, NULL),
(338, 71, 24, 1, NULL, NULL),
(339, 71, 25, 0, NULL, NULL),
(340, 71, 26, 1, NULL, NULL),
(341, 71, 28, 1, NULL, NULL),
(342, 71, 22, 1, NULL, NULL),
(343, 31, 27, 1, NULL, NULL),
(344, 31, 29, 1, NULL, NULL),
(345, 31, 30, 1, NULL, NULL),
(346, 31, 31, 1, NULL, NULL),
(347, 31, 32, 1, NULL, NULL),
(348, 51, 27, 1, NULL, NULL),
(349, 52, 27, 0, NULL, NULL),
(350, 51, 29, 1, NULL, NULL),
(351, 52, 29, 1, NULL, NULL),
(352, 51, 30, 1, NULL, NULL),
(353, 52, 30, 1, NULL, NULL),
(354, 51, 31, 0, NULL, NULL),
(355, 52, 31, 1, NULL, NULL),
(356, 51, 32, 1, NULL, NULL),
(357, 52, 32, 1, NULL, NULL),
(358, 39, 27, 1, NULL, NULL),
(359, 39, 29, 1, NULL, NULL),
(360, 39, 30, 1, NULL, NULL),
(361, 39, 31, 1, NULL, NULL),
(362, 39, 32, 1, NULL, NULL),
(363, 54, 27, 1, NULL, NULL),
(364, 54, 29, 1, NULL, NULL),
(365, 54, 30, 0, NULL, NULL),
(366, 54, 31, 1, NULL, NULL),
(367, 54, 32, 1, NULL, NULL),
(368, 22, 27, 1, NULL, NULL),
(369, 22, 29, 1, NULL, NULL),
(370, 22, 30, 1, NULL, NULL),
(371, 22, 31, 1, NULL, NULL),
(372, 22, 32, 1, NULL, NULL),
(373, 63, 27, 1, NULL, NULL),
(374, 63, 29, 0, NULL, NULL),
(375, 63, 30, 0, NULL, NULL),
(376, 63, 31, 1, NULL, NULL),
(377, 63, 32, 1, NULL, NULL),
(378, 32, 27, 1, NULL, NULL),
(379, 32, 29, 0, NULL, NULL),
(380, 32, 30, 0, NULL, NULL),
(381, 32, 31, 0, NULL, NULL),
(382, 32, 32, 1, NULL, NULL),
(383, 44, 27, 1, NULL, NULL),
(384, 44, 29, 1, NULL, NULL),
(385, 44, 30, 1, NULL, NULL),
(386, 44, 31, 1, NULL, NULL),
(387, 44, 32, 1, NULL, NULL),
(388, 72, 33, 1, NULL, NULL),
(389, 73, 33, 0, NULL, NULL),
(390, 74, 33, 1, NULL, NULL),
(391, 75, 33, 0, NULL, NULL),
(392, 76, 33, 1, NULL, NULL),
(393, 77, 33, 1, NULL, NULL),
(394, 78, 35, 1, NULL, NULL),
(395, 79, 35, 1, NULL, NULL),
(396, 80, 35, 0, NULL, NULL),
(397, 78, 36, 1, NULL, NULL),
(398, 79, 36, 1, NULL, NULL),
(399, 80, 36, 1, NULL, NULL),
(400, 78, 37, 1, NULL, NULL),
(401, 79, 37, 1, NULL, NULL),
(402, 80, 37, 1, NULL, NULL),
(403, 81, 35, 1, NULL, NULL),
(404, 82, 35, 1, NULL, NULL),
(405, 81, 36, 0, NULL, NULL),
(406, 82, 36, 1, NULL, NULL),
(407, 81, 37, 1, NULL, NULL),
(408, 82, 37, 1, NULL, NULL),
(409, 83, 35, 1, NULL, NULL),
(410, 84, 35, 1, NULL, NULL),
(411, 83, 36, 1, NULL, NULL),
(412, 84, 36, 1, NULL, NULL),
(413, 83, 37, 1, NULL, NULL),
(414, 84, 37, 1, NULL, NULL),
(415, 85, 35, 1, NULL, NULL),
(416, 86, 35, 1, NULL, NULL),
(417, 85, 36, 1, NULL, NULL),
(418, 86, 36, 1, NULL, NULL),
(419, 85, 37, 1, NULL, NULL),
(420, 86, 37, 1, NULL, NULL),
(421, 87, 35, 1, NULL, NULL),
(422, 88, 35, 1, NULL, NULL),
(423, 87, 36, 1, NULL, NULL),
(424, 88, 36, 1, NULL, NULL),
(425, 87, 37, 0, NULL, NULL),
(426, 88, 37, 1, NULL, NULL),
(427, 89, 35, 1, NULL, NULL),
(428, 90, 35, 1, NULL, NULL),
(429, 89, 36, 1, NULL, NULL),
(430, 90, 36, 0, NULL, NULL),
(431, 89, 37, 1, NULL, NULL),
(432, 90, 37, 1, NULL, NULL),
(433, 91, 35, 1, NULL, NULL),
(434, 92, 35, 1, NULL, NULL),
(435, 93, 35, 1, NULL, NULL),
(436, 91, 36, 0, NULL, NULL),
(437, 92, 36, 1, NULL, NULL),
(438, 93, 36, 1, NULL, NULL),
(439, 91, 37, 1, NULL, NULL),
(440, 92, 37, 1, NULL, NULL),
(441, 93, 37, 1, NULL, NULL),
(442, 13, 13, 1, NULL, NULL),
(443, 14, 13, 1, NULL, NULL),
(444, 15, 13, 1, NULL, NULL),
(445, 13, 38, 1, NULL, NULL),
(446, 14, 38, 0, NULL, NULL),
(447, 15, 38, 1, NULL, NULL),
(448, 13, 39, 1, NULL, NULL),
(449, 14, 39, 1, NULL, NULL),
(450, 15, 39, 1, NULL, NULL),
(451, 13, 40, 0, NULL, NULL),
(452, 14, 40, 1, NULL, NULL),
(453, 15, 40, 0, NULL, NULL),
(454, 12, 13, 1, NULL, NULL),
(455, 94, 13, 0, NULL, NULL),
(456, 12, 38, 1, NULL, NULL),
(457, 94, 38, 1, NULL, NULL),
(458, 12, 39, 1, NULL, NULL),
(459, 94, 39, 1, NULL, NULL),
(460, 12, 40, 1, NULL, NULL),
(461, 94, 40, 1, NULL, NULL),
(462, 95, 13, 1, NULL, NULL),
(463, 96, 13, 1, NULL, NULL),
(464, 95, 38, 0, NULL, NULL),
(465, 96, 38, 1, NULL, NULL),
(466, 95, 39, 1, NULL, NULL),
(467, 96, 39, 1, NULL, NULL),
(468, 95, 40, 1, NULL, NULL),
(469, 96, 40, 0, NULL, NULL),
(470, 97, 13, 1, NULL, NULL),
(471, 98, 13, 0, NULL, NULL),
(472, 17, 13, 1, NULL, NULL),
(473, 97, 38, 1, NULL, NULL),
(474, 98, 38, 1, NULL, NULL),
(475, 17, 38, 1, NULL, NULL),
(476, 97, 39, 1, NULL, NULL),
(477, 98, 39, 1, NULL, NULL),
(478, 17, 39, 1, NULL, NULL),
(479, 97, 40, 0, NULL, NULL),
(480, 98, 40, 0, NULL, NULL),
(481, 17, 40, 1, NULL, NULL),
(482, 99, 13, 1, NULL, NULL),
(483, 100, 13, 1, NULL, NULL),
(484, 99, 38, 1, NULL, NULL),
(485, 100, 38, 1, NULL, NULL),
(486, 99, 39, 0, NULL, NULL),
(487, 100, 39, 1, NULL, NULL),
(488, 99, 40, 1, NULL, NULL),
(489, 100, 40, 1, NULL, NULL),
(490, 101, 13, 1, NULL, NULL),
(491, 102, 13, 1, NULL, NULL),
(492, 101, 38, 1, NULL, NULL),
(493, 102, 38, 1, NULL, NULL),
(494, 101, 39, 1, NULL, NULL),
(495, 102, 39, 1, NULL, NULL),
(496, 101, 40, 0, NULL, NULL),
(497, 102, 40, 1, NULL, NULL),
(498, 103, 13, 1, NULL, NULL),
(499, 103, 38, 0, NULL, NULL),
(500, 103, 39, 1, NULL, NULL),
(501, 103, 40, 1, NULL, NULL),
(502, 104, 13, 1, NULL, NULL),
(503, 104, 38, 1, NULL, NULL),
(504, 104, 39, 1, NULL, NULL),
(505, 104, 40, 1, NULL, NULL),
(506, 105, 13, 1, NULL, NULL),
(507, 105, 38, 0, NULL, NULL),
(508, 105, 39, 1, NULL, NULL),
(509, 105, 40, 0, NULL, NULL),
(510, 106, 13, 1, NULL, NULL),
(511, 106, 38, 1, NULL, NULL),
(512, 106, 39, 1, NULL, NULL),
(513, 106, 40, 0, NULL, NULL),
(514, 107, 13, 1, NULL, NULL),
(515, 107, 38, 1, NULL, NULL),
(516, 107, 39, 1, NULL, NULL),
(517, 107, 40, 1, NULL, NULL),
(518, 108, 13, 0, NULL, NULL),
(519, 108, 38, 1, NULL, NULL),
(520, 108, 39, 1, NULL, NULL),
(521, 108, 40, 1, NULL, NULL),
(522, 109, 13, 1, NULL, NULL),
(523, 109, 38, 1, NULL, NULL),
(524, 109, 39, 1, NULL, NULL),
(525, 109, 40, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_esta`
--

CREATE TABLE `alumno_esta` (
  `id` int(10) UNSIGNED NOT NULL,
  `matricula_id` int(10) UNSIGNED NOT NULL,
  `curso_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `alumno_esta`
--

INSERT INTO `alumno_esta` (`id`, `matricula_id`, `curso_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 1, NULL, NULL),
(3, 4, 1, NULL, NULL),
(4, 10, 1, NULL, NULL),
(5, 6, 3, NULL, NULL),
(6, 7, 3, NULL, NULL),
(7, 11, 1, NULL, NULL),
(8, 12, 2, NULL, NULL),
(11, 2, 7, NULL, NULL),
(12, 9, 8, NULL, NULL),
(13, 14, 8, NULL, NULL),
(14, 4, 7, NULL, NULL),
(15, 12, 7, NULL, NULL),
(16, 15, 1, NULL, NULL),
(17, 16, 9, NULL, NULL),
(18, 17, 9, NULL, NULL),
(19, 18, 9, NULL, NULL),
(20, 19, 9, NULL, NULL),
(21, 20, 9, NULL, NULL),
(22, 22, 10, NULL, NULL),
(23, 17, 12, NULL, NULL),
(24, 24, 10, NULL, NULL),
(25, 25, 10, NULL, NULL),
(26, 26, 10, NULL, NULL),
(27, 28, 10, NULL, NULL),
(28, 27, 11, NULL, NULL),
(29, 29, 11, NULL, NULL),
(30, 30, 11, NULL, NULL),
(31, 31, 11, NULL, NULL),
(32, 32, 11, NULL, NULL),
(33, 33, 13, NULL, NULL),
(34, 34, 13, NULL, NULL),
(35, 35, 14, NULL, NULL),
(36, 36, 14, NULL, NULL),
(37, 37, 14, NULL, NULL),
(38, 13, 15, NULL, NULL),
(39, 38, 15, NULL, NULL),
(40, 39, 15, NULL, NULL),
(41, 40, 15, NULL, NULL),
(42, 38, 16, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_realiza`
--

CREATE TABLE `alumno_realiza` (
  `id` int(10) UNSIGNED NOT NULL,
  `matricula_id` int(10) UNSIGNED NOT NULL,
  `ensayo_id` int(10) UNSIGNED NOT NULL,
  `alr_resultado` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `alumno_realiza`
--

INSERT INTO `alumno_realiza` (`id`, `matricula_id`, `ensayo_id`, `alr_resultado`, `created_at`, `updated_at`) VALUES
(9, 1, 5, 231, NULL, NULL),
(10, 2, 5, 311, NULL, NULL),
(11, 9, 5, 231, NULL, NULL),
(14, 1, 3, 333, NULL, NULL),
(15, 2, 3, 123, NULL, NULL),
(16, 4, 5, 444, NULL, NULL),
(17, 1, 6, 222, NULL, NULL),
(18, 2, 6, 331, NULL, NULL),
(19, 7, 6, 123, NULL, NULL),
(20, 4, 6, 423, NULL, NULL),
(21, 6, 6, 121, NULL, NULL),
(22, 16, 7, 200, NULL, NULL),
(23, 17, 7, 320, NULL, NULL),
(24, 18, 7, 410, NULL, NULL),
(25, 19, 7, 520, NULL, NULL),
(26, 20, 7, 600, NULL, NULL),
(27, 22, 7, 630, NULL, NULL),
(28, 16, 8, 200, NULL, NULL),
(29, 17, 8, 132, NULL, NULL),
(30, 18, 8, 480, NULL, NULL),
(31, 19, 8, 500, NULL, NULL),
(32, 20, 8, 340, NULL, NULL),
(33, 22, 8, 400, NULL, NULL),
(34, 38, 5, 500, NULL, NULL),
(35, 38, 6, 420, NULL, NULL),
(36, 40, 6, 520, NULL, NULL),
(37, 1, 9, 200, NULL, NULL),
(38, 9, 9, 400, NULL, NULL),
(40, 2, 9, 330, NULL, NULL),
(41, 38, 9, 120, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_tiene`
--

CREATE TABLE `alumno_tiene` (
  `id` int(10) UNSIGNED NOT NULL,
  `matricula_id` int(10) UNSIGNED NOT NULL,
  `padres_rut` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `alumno_tiene`
--

INSERT INTO `alumno_tiene` (`id`, `matricula_id`, `padres_rut`, `created_at`, `updated_at`) VALUES
(3, 6, '11.555.555-5', NULL, NULL),
(4, 6, '22.555.555-5', NULL, NULL),
(5, 7, '3.333.333-1', NULL, NULL),
(6, 7, '3.333.333-2', NULL, NULL),
(7, 9, '1.111.111-1', NULL, NULL),
(8, 9, '1.111.111-2', NULL, NULL),
(9, 11, '1.414.141-4', NULL, NULL),
(10, 12, '7.543.531-2', NULL, NULL),
(11, 12, '8.453.521-4', NULL, NULL),
(12, 13, '11.455.234-2', NULL, NULL),
(13, 13, '9.556.412-3', NULL, NULL),
(15, 1, '1.111.111-2', NULL, NULL),
(16, 1, '1.111.111-1', NULL, NULL),
(17, 2, '2.222.222-1', NULL, NULL),
(18, 2, '2.222.222-2', NULL, NULL),
(19, 15, '12.483.212-3', NULL, NULL),
(20, 15, '12.332.123-2', NULL, NULL),
(21, 16, '1.111.111-1', NULL, NULL),
(22, 16, '1.111.111-2', NULL, NULL),
(23, 18, '3.111.111-2', NULL, NULL),
(24, 19, '4.111.111-1', NULL, NULL),
(25, 19, '4.111.111-2', NULL, NULL),
(26, 20, '5.111.111-1', NULL, NULL),
(27, 30, '14.111.321-4', NULL, NULL),
(28, 33, '1.111.111-1', NULL, NULL),
(29, 33, '1.111.111-2', NULL, NULL),
(30, 35, '1.111.111-1', NULL, NULL),
(31, 35, '1.111.111-2', NULL, NULL),
(32, 36, '3.111.111-2', NULL, NULL),
(33, 37, '4.111.111-1', NULL, NULL),
(34, 37, '4.111.111-2', NULL, NULL),
(35, 38, '1.111.111-1', NULL, NULL),
(36, 38, '1.111.111-2', NULL, NULL),
(37, 39, '3.111.111-2', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apoderado`
--

CREATE TABLE `apoderado` (
  `ap_id` int(10) UNSIGNED NOT NULL,
  `persona_rut` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ap_tipo` tinyint(1) NOT NULL,
  `ap_parentesco` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ap_direccion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `apoderado`
--

INSERT INTO `apoderado` (`ap_id`, `persona_rut`, `ap_tipo`, `ap_parentesco`, `ap_direccion`, `created_at`, `updated_at`) VALUES
(1, '1.111.111-2', 1, 'madre', 'direccion1', '2017-06-06 20:31:07', '2017-06-06 20:31:07'),
(19, '2.222.222-2', 1, 'Madre', 'direccion2', '2017-06-17 14:26:14', '2017-06-17 14:26:14'),
(20, '2.222.222-1', 2, 'Padre', 'Direccion2', '2017-06-17 14:26:14', '2017-06-17 14:26:14'),
(21, '18.500.343-4', 1, 'Tia', 'direccion3', '2017-06-17 18:44:50', '2017-06-17 18:44:50'),
(22, '3.333.333-4', 2, 'Tio', 'Direccion3', '2017-06-17 18:44:50', '2017-06-17 18:44:50'),
(23, '4.444.444-1', 1, 'Padre', 'direccion4', '2017-06-17 22:43:04', '2017-06-17 22:43:04'),
(24, '4.444.444-2', 2, 'Madre', 'direccion4', '2017-06-17 22:43:04', '2017-06-17 22:43:04'),
(49, '22.555.555-5', 1, 'madre', 'direccion5', '2017-11-16 22:07:40', '2017-11-16 22:07:40'),
(50, '11.555.555-5', 2, 'padre', 'direccion5', '2017-11-16 22:07:40', '2017-11-16 22:07:40'),
(51, '21.321.321-3', 1, 'Tio', 'direccion12', '2018-02-06 03:33:42', '2018-02-06 03:33:42'),
(52, '1.414.141-4', 1, 'madre', 'madmat14', '2018-02-06 06:22:39', '2018-02-06 06:22:39'),
(54, '7.543.531-2', 1, 'madre', 'Tobosque', '2018-02-20 02:02:04', '2018-02-20 02:02:04'),
(55, '7.543.531-2', 2, 'padre', 'Millanao', '2018-02-20 02:02:04', '2018-02-20 02:02:04'),
(56, '9.556.412-3', 1, 'madre', 'Sepúlveda', '2018-03-02 05:47:20', '2018-03-02 05:47:20'),
(59, '7.796.311-1', 1, 'Tia', 'calle Williams #1332', '2018-03-25 01:36:58', '2018-03-25 01:36:58'),
(60, '12.483.212-3', 1, 'padre', 'Montolla', '2018-06-22 18:21:51', '2018-06-22 18:21:51'),
(61, '1.111.111-3', 1, 'tia', 'direccion tia javier 1', '2018-06-24 06:33:05', '2018-06-24 06:33:05'),
(62, '2.111.111-1', 1, 'tio', 'direccion tios marcelo 1', '2018-06-24 06:37:55', '2018-06-24 06:37:55'),
(64, '4.111.111-3', 1, 'madre', 'madfranunopat', '2018-06-24 06:54:02', '2018-06-24 06:54:02'),
(65, '4.111.111-3', 2, 'tía', 'domicilio tia francisca uno', '2018-06-24 06:54:02', '2018-06-24 06:54:02'),
(66, '5.111.111-1', 1, 'padre', 'padfelunopat', '2018-06-24 10:04:59', '2018-06-24 10:04:59'),
(68, '1.111.111-2', 1, 'Tía', 'direccion1', '2018-06-25 05:59:50', '2018-06-25 05:59:50'),
(72, '12.000.000-1', 1, 'tío', 'direccion tio javier dos', '2018-06-28 21:03:35', '2018-06-28 21:03:35'),
(73, '12.323.132-3', 1, 'Padrino', 'domicilio profesor prueba', '2018-06-28 21:06:56', '2018-06-28 21:06:56'),
(74, '3.111.111-3', 1, 'Abuela', 'dirección abuela', '2018-06-28 21:10:49', '2018-06-28 21:10:49'),
(75, '13.131.313-1', 1, 'Padrino', 'Domicilio padrino javier', '2018-06-29 08:14:29', '2018-06-29 08:14:29'),
(76, '2.411.111-2', 1, 'tia', 'direccion tia helen 2', '2018-06-29 08:18:35', '2018-06-29 08:18:35'),
(77, '1.414.141-4', 1, 'Padrina', 'dirección padrina', '2018-06-29 08:24:56', '2018-06-29 08:24:56'),
(78, '14.111.321-4', 1, 'madre', 'Castillo', '2018-06-29 08:31:39', '2018-06-29 08:31:39'),
(79, '1.414.141-4', 1, 'Tía', 'direccion tia bastian', '2018-06-29 08:35:12', '2018-06-29 08:35:12'),
(80, '5.111.231-5', 1, 'Abuela', 'direccion abuela', '2018-06-29 08:40:00', '2018-06-29 08:40:00'),
(81, '3.111.111-2', 1, 'madre', 'madrematipat', '2018-06-29 10:18:25', '2018-06-29 10:18:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apoderado_representa`
--

CREATE TABLE `apoderado_representa` (
  `id` int(10) UNSIGNED NOT NULL,
  `matricula_id` int(10) UNSIGNED NOT NULL,
  `apoderado_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `apoderado_representa`
--

INSERT INTO `apoderado_representa` (`id`, `matricula_id`, `apoderado_id`, `created_at`, `updated_at`) VALUES
(3, 6, 49, NULL, NULL),
(4, 6, 50, NULL, NULL),
(5, 7, 21, NULL, NULL),
(6, 7, 22, NULL, NULL),
(7, 9, 1, NULL, NULL),
(9, 10, 51, NULL, NULL),
(10, 11, 52, NULL, NULL),
(11, 12, 54, NULL, NULL),
(12, 12, 55, NULL, NULL),
(13, 13, 56, NULL, NULL),
(14, 1, 1, NULL, NULL),
(17, 2, 19, NULL, NULL),
(18, 2, 20, NULL, NULL),
(19, 4, 23, NULL, NULL),
(20, 14, 59, NULL, NULL),
(21, 15, 60, NULL, NULL),
(22, 16, 61, NULL, NULL),
(23, 17, 62, NULL, NULL),
(25, 19, 64, NULL, NULL),
(26, 19, 65, NULL, NULL),
(27, 20, 66, NULL, NULL),
(29, 22, 68, NULL, NULL),
(32, 24, 72, NULL, NULL),
(33, 25, 73, NULL, NULL),
(34, 26, 74, NULL, NULL),
(35, 27, 75, NULL, NULL),
(36, 28, 76, NULL, NULL),
(37, 29, 77, NULL, NULL),
(38, 30, 78, NULL, NULL),
(39, 31, 79, NULL, NULL),
(40, 32, 80, NULL, NULL),
(41, 33, 61, NULL, NULL),
(42, 34, 62, NULL, NULL),
(43, 35, 61, NULL, NULL),
(44, 36, 81, NULL, NULL),
(45, 37, 64, NULL, NULL),
(46, 38, 61, NULL, NULL),
(47, 39, 81, NULL, NULL),
(48, 40, 76, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE `articulo` (
  `art_item` int(11) NOT NULL,
  `tipo_id` int(10) UNSIGNED NOT NULL,
  `bodega_id` int(10) UNSIGNED NOT NULL,
  `art_nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `art_descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `art_cantidad_alta` int(10) UNSIGNED NOT NULL,
  `art_cantidad_baja` int(10) UNSIGNED NOT NULL,
  `art_cantidad_total` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`art_item`, `tipo_id`, `bodega_id`, `art_nombre`, `art_descripcion`, `art_cantidad_alta`, `art_cantidad_baja`, `art_cantidad_total`, `created_at`, `updated_at`) VALUES
(101, 1, 1, 'articulo1A', 'descripción articulo 1 tipo A', 10, 0, 10, '2017-12-15 18:54:51', '2018-05-23 01:47:14'),
(102, 1, 1, 'articulo2A', 'descripcion articulo 2 tipo A', 7, 0, 7, '2017-12-15 18:55:23', '2018-05-23 01:47:14'),
(103, 1, 1, 'articulo3A', 'asddasdasd', 2, 0, 2, '2018-03-19 02:48:17', '2018-04-17 18:48:20'),
(201, 2, 1, 'articulo1B', 'descripcion articulo 1 tipo B', 0, 0, 0, '2017-12-15 18:55:51', '2017-12-15 18:55:51'),
(301, 3, 1, 'articulo1C', 'descripcion articulo 1 tipo C', 1, 0, 1, '2017-12-15 18:56:23', '2018-03-28 07:52:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE `asignatura` (
  `asig_id` int(10) UNSIGNED NOT NULL,
  `asig_nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asig_nombre_corto` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asig_tipo_asignatura` tinyint(1) DEFAULT NULL,
  `asig_tipo` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`asig_id`, `asig_nombre`, `asig_nombre_corto`, `asig_tipo_asignatura`, `asig_tipo`, `created_at`, `updated_at`) VALUES
(1, 'Matemáticas', 'MAT', 1, 1, '2017-06-14 23:36:45', '2018-02-26 01:44:04'),
(2, 'Lenguaje', 'LENG', 1, 1, '2017-06-14 23:37:04', '2017-06-14 23:37:04'),
(3, 'Religion', 'RELI', 1, 1, '2017-06-14 23:37:36', '2017-06-14 23:37:36'),
(4, 'Musica', 'MUS', 1, 1, '2017-06-14 23:37:50', '2017-06-14 23:37:50'),
(5, 'Orquesta', 'ORQST', 1, 2, '2017-06-19 21:31:38', '2017-06-19 21:31:38'),
(6, 'Futbol', 'FUTB', 1, 2, '2017-06-19 23:23:49', '2017-06-19 23:23:49'),
(7, 'Musica', 'MUS', NULL, 2, '2018-03-18 17:18:06', '2018-03-18 17:18:06'),
(8, 'Lenguaje y Sociedad', 'LENG Y SOC', 2, 1, '2018-03-18 19:44:57', '2018-03-18 19:44:57'),
(9, 'Funciones y Procesos Finitos', 'PROCFIN', 2, 1, '2018-03-18 19:46:05', '2018-03-18 19:46:05'),
(10, 'Robotica', 'ROB', NULL, 2, '2018-06-29 18:47:22', '2018-06-29 18:47:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `asis_id` int(10) UNSIGNED NOT NULL,
  `cla_realizados_id` int(10) UNSIGNED NOT NULL,
  `matricula_id` int(10) UNSIGNED NOT NULL,
  `asis_estado` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`asis_id`, `cla_realizados_id`, `matricula_id`, `asis_estado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2018-03-22 05:11:01', '2018-03-22 05:11:01'),
(2, 2, 1, 1, '2018-03-22 05:11:01', '2018-03-22 05:11:01'),
(3, 1, 2, 0, '2018-03-22 05:11:01', '2018-03-22 05:11:01'),
(4, 2, 2, 1, '2018-03-22 05:11:01', '2018-03-22 05:11:01'),
(5, 3, 2, 1, '2018-03-22 06:20:28', '2018-03-22 06:20:28'),
(6, 4, 2, 1, '2018-03-22 06:20:28', '2018-03-22 06:20:28'),
(7, 5, 2, 1, '2018-03-22 06:20:28', '2018-03-22 06:20:28'),
(8, 6, 2, 1, '2018-03-27 08:22:03', '2018-03-27 08:22:03'),
(9, 7, 2, 1, '2018-03-27 08:22:03', '2018-03-27 08:22:03'),
(10, 8, 2, 1, '2018-03-27 08:22:03', '2018-03-27 08:22:03'),
(11, 9, 2, 0, '2018-03-27 08:22:03', '2018-03-27 08:22:03'),
(12, 10, 2, 1, '2018-03-27 08:22:03', '2018-03-27 08:22:03'),
(13, 6, 11, 1, '2018-03-27 08:22:03', '2018-03-27 08:22:03'),
(14, 7, 11, 1, '2018-03-27 08:22:03', '2018-03-27 08:22:03'),
(15, 8, 11, 0, '2018-03-27 08:22:03', '2018-03-27 08:22:03'),
(16, 9, 11, 1, '2018-03-27 08:22:03', '2018-03-27 08:22:03'),
(17, 10, 11, 0, '2018-03-27 08:22:03', '2018-03-27 08:22:03'),
(18, 11, 2, 1, '2018-03-27 08:22:48', '2018-03-27 08:22:48'),
(19, 12, 2, 1, '2018-03-27 08:22:48', '2018-03-27 08:22:48'),
(20, 11, 11, 1, '2018-03-27 08:22:49', '2018-03-27 08:22:49'),
(21, 12, 11, 0, '2018-03-27 08:22:49', '2018-03-27 08:22:49'),
(22, 13, 2, 1, '2018-03-27 08:24:03', '2018-03-27 08:24:03'),
(23, 14, 2, 0, '2018-03-27 08:24:03', '2018-03-27 08:24:03'),
(24, 13, 11, 0, '2018-03-27 08:24:03', '2018-03-27 08:24:03'),
(25, 14, 11, 1, '2018-03-27 08:24:03', '2018-03-27 08:24:03'),
(26, 15, 2, 1, '2018-03-28 02:31:48', '2018-03-28 02:31:48'),
(27, 16, 2, 1, '2018-03-28 02:31:48', '2018-03-28 02:31:48'),
(28, 17, 2, 0, '2018-03-28 02:31:48', '2018-03-28 02:31:48'),
(29, 15, 11, 1, '2018-03-28 02:31:48', '2018-03-28 02:31:48'),
(30, 16, 11, 1, '2018-03-28 02:31:48', '2018-03-28 02:31:48'),
(31, 17, 11, 1, '2018-03-28 02:31:48', '2018-03-28 02:31:48'),
(32, 3, 11, 0, '2018-03-28 02:32:30', '2018-03-28 02:32:30'),
(33, 4, 11, 1, '2018-03-28 02:32:30', '2018-03-28 02:32:30'),
(34, 5, 11, 0, '2018-03-28 02:32:30', '2018-03-28 02:32:30'),
(35, 18, 10, 1, '2018-04-05 02:08:18', '2018-04-05 02:08:18'),
(36, 18, 2, 0, '2018-04-05 02:08:18', '2018-04-05 02:08:18'),
(37, 18, 11, 1, '2018-04-05 02:08:18', '2018-04-05 02:08:18'),
(38, 19, 10, 1, '2018-04-05 02:08:44', '2018-04-05 02:08:44'),
(39, 19, 2, 1, '2018-04-05 02:08:44', '2018-04-05 02:08:44'),
(40, 19, 11, 1, '2018-04-05 02:08:44', '2018-04-05 02:08:44'),
(41, 20, 10, 1, '2018-04-05 03:16:40', '2018-04-05 03:16:40'),
(42, 20, 2, 0, '2018-04-05 03:16:40', '2018-04-05 03:16:40'),
(43, 20, 11, 1, '2018-04-05 03:16:40', '2018-04-05 03:16:40'),
(44, 21, 12, 1, '2018-04-23 02:50:36', '2018-04-23 02:50:36'),
(45, 22, 12, 1, '2018-04-23 02:50:36', '2018-04-23 02:50:36'),
(46, 23, 4, 1, '2018-05-09 18:28:46', '2018-05-09 18:28:46'),
(47, 23, 10, 0, '2018-05-09 18:28:46', '2018-05-09 18:28:46'),
(48, 23, 2, 1, '2018-05-09 18:28:46', '2018-05-09 18:28:46'),
(49, 23, 11, 0, '2018-05-09 18:28:46', '2018-05-09 18:28:46'),
(50, 24, 16, 1, '2018-06-27 05:19:26', '2018-06-27 05:19:26'),
(51, 25, 16, 0, '2018-06-27 05:19:26', '2018-06-27 05:19:26'),
(52, 26, 16, 1, '2018-06-27 05:19:26', '2018-06-27 05:19:26'),
(53, 24, 17, 1, '2018-06-27 05:19:26', '2018-06-27 05:19:26'),
(54, 25, 17, 1, '2018-06-27 05:19:26', '2018-06-27 05:19:26'),
(55, 26, 17, 1, '2018-06-27 05:19:26', '2018-06-27 05:19:26'),
(56, 24, 18, 0, '2018-06-27 05:19:26', '2018-06-27 05:19:26'),
(57, 25, 18, 0, '2018-06-27 05:19:26', '2018-06-27 05:19:26'),
(58, 26, 18, 1, '2018-06-27 05:19:26', '2018-06-27 05:19:26'),
(59, 24, 19, 1, '2018-06-27 05:19:26', '2018-06-27 05:19:26'),
(60, 25, 19, 1, '2018-06-27 05:19:27', '2018-06-27 05:19:27'),
(61, 26, 19, 0, '2018-06-27 05:19:27', '2018-06-27 05:19:27'),
(62, 24, 20, 0, '2018-06-27 05:19:27', '2018-06-27 05:19:27'),
(63, 25, 20, 0, '2018-06-27 05:19:27', '2018-06-27 05:19:27'),
(64, 26, 20, 0, '2018-06-27 05:19:27', '2018-06-27 05:19:27'),
(65, 27, 16, 1, '2018-06-27 05:20:22', '2018-06-27 05:20:22'),
(66, 28, 16, 1, '2018-06-27 05:20:22', '2018-06-27 05:20:22'),
(67, 27, 17, 0, '2018-06-27 05:20:22', '2018-06-27 05:20:22'),
(68, 28, 17, 1, '2018-06-27 05:20:22', '2018-06-27 05:20:22'),
(69, 27, 18, 1, '2018-06-27 05:20:23', '2018-06-27 05:20:23'),
(70, 28, 18, 1, '2018-06-27 05:20:23', '2018-06-27 05:20:23'),
(71, 27, 19, 0, '2018-06-27 05:20:23', '2018-06-27 05:20:23'),
(72, 28, 19, 0, '2018-06-27 05:20:23', '2018-06-27 05:20:23'),
(73, 27, 20, 1, '2018-06-27 05:20:23', '2018-06-27 05:20:23'),
(74, 28, 20, 1, '2018-06-27 05:20:23', '2018-06-27 05:20:23'),
(75, 29, 16, 1, '2018-06-27 05:21:59', '2018-06-27 05:21:59'),
(76, 30, 16, 1, '2018-06-27 05:21:59', '2018-06-27 05:21:59'),
(77, 31, 16, 0, '2018-06-27 05:21:59', '2018-06-27 05:21:59'),
(78, 32, 16, 0, '2018-06-27 05:21:59', '2018-06-27 05:21:59'),
(79, 29, 17, 0, '2018-06-27 05:22:00', '2018-06-27 05:22:00'),
(80, 30, 17, 1, '2018-06-27 05:22:00', '2018-06-27 05:22:00'),
(81, 31, 17, 1, '2018-06-27 05:22:00', '2018-06-27 05:22:00'),
(82, 32, 17, 1, '2018-06-27 05:22:00', '2018-06-27 05:22:00'),
(83, 29, 18, 1, '2018-06-27 05:22:00', '2018-06-27 05:22:00'),
(84, 30, 18, 0, '2018-06-27 05:22:00', '2018-06-27 05:22:00'),
(85, 31, 18, 1, '2018-06-27 05:22:00', '2018-06-27 05:22:00'),
(86, 32, 18, 0, '2018-06-27 05:22:00', '2018-06-27 05:22:00'),
(87, 29, 19, 0, '2018-06-27 05:22:00', '2018-06-27 05:22:00'),
(88, 30, 19, 1, '2018-06-27 05:22:00', '2018-06-27 05:22:00'),
(89, 31, 19, 1, '2018-06-27 05:22:01', '2018-06-27 05:22:01'),
(90, 32, 19, 0, '2018-06-27 05:22:01', '2018-06-27 05:22:01'),
(91, 29, 20, 1, '2018-06-27 05:22:01', '2018-06-27 05:22:01'),
(92, 30, 20, 1, '2018-06-27 05:22:01', '2018-06-27 05:22:01'),
(93, 31, 20, 1, '2018-06-27 05:22:01', '2018-06-27 05:22:01'),
(94, 32, 20, 1, '2018-06-27 05:22:01', '2018-06-27 05:22:01'),
(95, 33, 16, 1, '2018-06-27 05:40:08', '2018-06-27 05:40:08'),
(96, 33, 17, 0, '2018-06-27 05:40:08', '2018-06-27 05:40:08'),
(97, 33, 18, 1, '2018-06-27 05:40:08', '2018-06-27 05:40:08'),
(98, 33, 19, 1, '2018-06-27 05:40:08', '2018-06-27 05:40:08'),
(99, 33, 20, 0, '2018-06-27 05:40:08', '2018-06-27 05:40:08'),
(100, 34, 16, 1, '2018-06-27 05:42:02', '2018-06-27 05:42:02'),
(101, 35, 16, 0, '2018-06-27 05:42:02', '2018-06-27 05:42:02'),
(102, 36, 16, 1, '2018-06-27 05:42:02', '2018-06-27 05:42:02'),
(103, 37, 16, 1, '2018-06-27 05:42:02', '2018-06-27 05:42:02'),
(104, 34, 17, 0, '2018-06-27 05:42:02', '2018-06-27 05:42:02'),
(105, 35, 17, 0, '2018-06-27 05:42:02', '2018-06-27 05:42:02'),
(106, 36, 17, 1, '2018-06-27 05:42:02', '2018-06-27 05:42:02'),
(107, 37, 17, 1, '2018-06-27 05:42:02', '2018-06-27 05:42:02'),
(108, 34, 18, 0, '2018-06-27 05:42:02', '2018-06-27 05:42:02'),
(109, 35, 18, 1, '2018-06-27 05:42:02', '2018-06-27 05:42:02'),
(110, 36, 18, 1, '2018-06-27 05:42:02', '2018-06-27 05:42:02'),
(111, 37, 18, 1, '2018-06-27 05:42:03', '2018-06-27 05:42:03'),
(112, 34, 19, 1, '2018-06-27 05:42:03', '2018-06-27 05:42:03'),
(113, 35, 19, 1, '2018-06-27 05:42:03', '2018-06-27 05:42:03'),
(114, 36, 19, 1, '2018-06-27 05:42:03', '2018-06-27 05:42:03'),
(115, 37, 19, 1, '2018-06-27 05:42:03', '2018-06-27 05:42:03'),
(116, 34, 20, 0, '2018-06-27 05:42:03', '2018-06-27 05:42:03'),
(117, 35, 20, 0, '2018-06-27 05:42:03', '2018-06-27 05:42:03'),
(118, 36, 20, 0, '2018-06-27 05:42:03', '2018-06-27 05:42:03'),
(119, 37, 20, 1, '2018-06-27 05:42:03', '2018-06-27 05:42:03'),
(120, 38, 17, 1, '2018-06-27 05:43:04', '2018-06-27 05:43:04'),
(121, 39, 17, 1, '2018-06-27 05:43:04', '2018-06-27 05:43:04'),
(122, 40, 17, 0, '2018-06-27 05:43:04', '2018-06-27 05:43:04'),
(123, 41, 17, 1, '2018-06-27 05:43:04', '2018-06-27 05:43:04'),
(124, 38, 18, 0, '2018-06-27 05:43:04', '2018-06-27 05:43:04'),
(125, 39, 18, 1, '2018-06-27 05:43:04', '2018-06-27 05:43:04'),
(126, 40, 18, 1, '2018-06-27 05:43:04', '2018-06-27 05:43:04'),
(127, 41, 18, 0, '2018-06-27 05:43:04', '2018-06-27 05:43:04'),
(128, 42, 16, 1, '2018-06-27 05:44:59', '2018-06-27 05:44:59'),
(129, 43, 16, 0, '2018-06-27 05:44:59', '2018-06-27 05:44:59'),
(130, 44, 16, 1, '2018-06-27 05:44:59', '2018-06-27 05:44:59'),
(131, 42, 17, 0, '2018-06-27 05:44:59', '2018-06-27 05:44:59'),
(132, 43, 17, 1, '2018-06-27 05:45:00', '2018-06-27 05:45:00'),
(133, 44, 17, 1, '2018-06-27 05:45:00', '2018-06-27 05:45:00'),
(134, 42, 18, 0, '2018-06-27 05:45:00', '2018-06-27 05:45:00'),
(135, 43, 18, 0, '2018-06-27 05:45:00', '2018-06-27 05:45:00'),
(136, 44, 18, 1, '2018-06-27 05:45:00', '2018-06-27 05:45:00'),
(137, 42, 19, 1, '2018-06-27 05:45:00', '2018-06-27 05:45:00'),
(138, 43, 19, 1, '2018-06-27 05:45:00', '2018-06-27 05:45:00'),
(139, 44, 19, 0, '2018-06-27 05:45:01', '2018-06-27 05:45:01'),
(140, 42, 20, 1, '2018-06-27 05:45:01', '2018-06-27 05:45:01'),
(141, 43, 20, 1, '2018-06-27 05:45:01', '2018-06-27 05:45:01'),
(142, 44, 20, 1, '2018-06-27 05:45:01', '2018-06-27 05:45:01'),
(143, 45, 16, 1, '2018-06-27 06:38:14', '2018-06-27 06:38:14'),
(144, 46, 16, 0, '2018-06-27 06:38:14', '2018-06-27 06:38:14'),
(145, 47, 16, 1, '2018-06-27 06:38:14', '2018-06-27 06:38:14'),
(146, 45, 17, 1, '2018-06-27 06:38:14', '2018-06-27 06:38:14'),
(147, 46, 17, 1, '2018-06-27 06:38:14', '2018-06-27 06:38:14'),
(148, 47, 17, 1, '2018-06-27 06:38:14', '2018-06-27 06:38:14'),
(149, 45, 18, 1, '2018-06-27 06:38:14', '2018-06-27 06:38:14'),
(150, 46, 18, 1, '2018-06-27 06:38:14', '2018-06-27 06:38:14'),
(151, 47, 18, 0, '2018-06-27 06:38:14', '2018-06-27 06:38:14'),
(152, 45, 19, 0, '2018-06-27 06:38:15', '2018-06-27 06:38:15'),
(153, 46, 19, 0, '2018-06-27 06:38:15', '2018-06-27 06:38:15'),
(154, 47, 19, 1, '2018-06-27 06:38:15', '2018-06-27 06:38:15'),
(155, 45, 20, 1, '2018-06-27 06:38:15', '2018-06-27 06:38:15'),
(156, 46, 20, 0, '2018-06-27 06:38:15', '2018-06-27 06:38:15'),
(157, 47, 20, 0, '2018-06-27 06:38:15', '2018-06-27 06:38:15'),
(158, 48, 16, 1, '2018-06-27 06:39:14', '2018-06-27 06:39:14'),
(159, 49, 16, 0, '2018-06-27 06:39:14', '2018-06-27 06:39:14'),
(160, 48, 17, 1, '2018-06-27 06:39:14', '2018-06-27 06:39:14'),
(161, 49, 17, 1, '2018-06-27 06:39:14', '2018-06-27 06:39:14'),
(162, 48, 18, 1, '2018-06-27 06:39:14', '2018-06-27 06:39:14'),
(163, 49, 18, 1, '2018-06-27 06:39:14', '2018-06-27 06:39:14'),
(164, 48, 19, 0, '2018-06-27 06:39:14', '2018-06-27 06:39:14'),
(165, 49, 19, 0, '2018-06-27 06:39:14', '2018-06-27 06:39:14'),
(166, 48, 20, 1, '2018-06-27 06:39:15', '2018-06-27 06:39:15'),
(167, 49, 20, 1, '2018-06-27 06:39:15', '2018-06-27 06:39:15'),
(168, 50, 16, 1, '2018-06-27 06:41:00', '2018-06-27 06:41:00'),
(169, 51, 16, 0, '2018-06-27 06:41:01', '2018-06-27 06:41:01'),
(170, 52, 16, 1, '2018-06-27 06:41:01', '2018-06-27 06:41:01'),
(171, 53, 16, 1, '2018-06-27 06:41:01', '2018-06-27 06:41:01'),
(172, 50, 17, 0, '2018-06-27 06:41:01', '2018-06-27 06:41:01'),
(173, 51, 17, 1, '2018-06-27 06:41:01', '2018-06-27 06:41:01'),
(174, 52, 17, 1, '2018-06-27 06:41:01', '2018-06-27 06:41:01'),
(175, 53, 17, 0, '2018-06-27 06:41:01', '2018-06-27 06:41:01'),
(176, 50, 18, 1, '2018-06-27 06:41:01', '2018-06-27 06:41:01'),
(177, 51, 18, 1, '2018-06-27 06:41:01', '2018-06-27 06:41:01'),
(178, 52, 18, 1, '2018-06-27 06:41:02', '2018-06-27 06:41:02'),
(179, 53, 18, 1, '2018-06-27 06:41:02', '2018-06-27 06:41:02'),
(180, 50, 19, 0, '2018-06-27 06:41:02', '2018-06-27 06:41:02'),
(181, 51, 19, 0, '2018-06-27 06:41:02', '2018-06-27 06:41:02'),
(182, 52, 19, 0, '2018-06-27 06:41:02', '2018-06-27 06:41:02'),
(183, 53, 19, 1, '2018-06-27 06:41:02', '2018-06-27 06:41:02'),
(184, 50, 20, 1, '2018-06-27 06:41:02', '2018-06-27 06:41:02'),
(185, 51, 20, 1, '2018-06-27 06:41:02', '2018-06-27 06:41:02'),
(186, 52, 20, 0, '2018-06-27 06:41:02', '2018-06-27 06:41:02'),
(187, 53, 20, 1, '2018-06-27 06:41:02', '2018-06-27 06:41:02'),
(188, 54, 16, 1, '2018-06-27 06:42:38', '2018-06-27 06:42:38'),
(189, 55, 16, 0, '2018-06-27 06:42:38', '2018-06-27 06:42:38'),
(190, 56, 16, 1, '2018-06-27 06:42:38', '2018-06-27 06:42:38'),
(191, 54, 17, 1, '2018-06-27 06:42:39', '2018-06-27 06:42:39'),
(192, 55, 17, 1, '2018-06-27 06:42:39', '2018-06-27 06:42:39'),
(193, 56, 17, 1, '2018-06-27 06:42:39', '2018-06-27 06:42:39'),
(194, 54, 18, 0, '2018-06-27 06:42:39', '2018-06-27 06:42:39'),
(195, 55, 18, 1, '2018-06-27 06:42:39', '2018-06-27 06:42:39'),
(196, 56, 18, 1, '2018-06-27 06:42:39', '2018-06-27 06:42:39'),
(197, 54, 19, 1, '2018-06-27 06:42:39', '2018-06-27 06:42:39'),
(198, 55, 19, 1, '2018-06-27 06:42:39', '2018-06-27 06:42:39'),
(199, 56, 19, 1, '2018-06-27 06:42:39', '2018-06-27 06:42:39'),
(200, 54, 20, 0, '2018-06-27 06:42:39', '2018-06-27 06:42:39'),
(201, 55, 20, 0, '2018-06-27 06:42:39', '2018-06-27 06:42:39'),
(202, 56, 20, 0, '2018-06-27 06:42:40', '2018-06-27 06:42:40'),
(205, 64, 17, 0, '2018-06-27 10:13:25', '2018-06-27 10:13:25'),
(206, 64, 18, 0, '2018-06-27 10:13:25', '2018-06-27 10:13:25'),
(207, 65, 24, 1, '2018-06-29 09:08:55', '2018-06-29 09:08:55'),
(208, 66, 24, 1, '2018-06-29 09:08:55', '2018-06-29 09:08:55'),
(209, 67, 24, 1, '2018-06-29 09:08:55', '2018-06-29 09:08:55'),
(210, 65, 25, 1, '2018-06-29 09:08:55', '2018-06-29 09:08:55'),
(211, 66, 25, 0, '2018-06-29 09:08:55', '2018-06-29 09:08:55'),
(212, 67, 25, 1, '2018-06-29 09:08:55', '2018-06-29 09:08:55'),
(213, 65, 26, 1, '2018-06-29 09:08:55', '2018-06-29 09:08:55'),
(214, 66, 26, 1, '2018-06-29 09:08:55', '2018-06-29 09:08:55'),
(215, 67, 26, 0, '2018-06-29 09:08:55', '2018-06-29 09:08:55'),
(216, 65, 28, 0, '2018-06-29 09:08:55', '2018-06-29 09:08:55'),
(217, 66, 28, 1, '2018-06-29 09:08:55', '2018-06-29 09:08:55'),
(218, 67, 28, 1, '2018-06-29 09:08:55', '2018-06-29 09:08:55'),
(219, 65, 22, 1, '2018-06-29 09:08:55', '2018-06-29 09:08:55'),
(220, 66, 22, 0, '2018-06-29 09:08:55', '2018-06-29 09:08:55'),
(221, 67, 22, 1, '2018-06-29 09:08:55', '2018-06-29 09:08:55'),
(222, 68, 24, 1, '2018-06-29 09:09:59', '2018-06-29 09:09:59'),
(223, 69, 24, 0, '2018-06-29 09:09:59', '2018-06-29 09:09:59'),
(224, 70, 24, 0, '2018-06-29 09:09:59', '2018-06-29 09:09:59'),
(225, 68, 25, 0, '2018-06-29 09:09:59', '2018-06-29 09:09:59'),
(226, 69, 25, 1, '2018-06-29 09:09:59', '2018-06-29 09:09:59'),
(227, 70, 25, 1, '2018-06-29 09:09:59', '2018-06-29 09:09:59'),
(228, 68, 26, 1, '2018-06-29 09:09:59', '2018-06-29 09:09:59'),
(229, 69, 26, 1, '2018-06-29 09:09:59', '2018-06-29 09:09:59'),
(230, 70, 26, 1, '2018-06-29 09:09:59', '2018-06-29 09:09:59'),
(231, 68, 28, 1, '2018-06-29 09:10:00', '2018-06-29 09:10:00'),
(232, 69, 28, 0, '2018-06-29 09:10:00', '2018-06-29 09:10:00'),
(233, 70, 28, 1, '2018-06-29 09:10:00', '2018-06-29 09:10:00'),
(234, 68, 22, 1, '2018-06-29 09:10:00', '2018-06-29 09:10:00'),
(235, 69, 22, 1, '2018-06-29 09:10:00', '2018-06-29 09:10:00'),
(236, 70, 22, 1, '2018-06-29 09:10:00', '2018-06-29 09:10:00'),
(237, 71, 24, 1, '2018-06-29 09:11:14', '2018-06-29 09:11:14'),
(238, 72, 24, 1, '2018-06-29 09:11:14', '2018-06-29 09:11:14'),
(239, 71, 25, 1, '2018-06-29 09:11:14', '2018-06-29 09:11:14'),
(240, 72, 25, 0, '2018-06-29 09:11:14', '2018-06-29 09:11:14'),
(241, 71, 26, 1, '2018-06-29 09:11:14', '2018-06-29 09:11:14'),
(242, 72, 26, 1, '2018-06-29 09:11:14', '2018-06-29 09:11:14'),
(243, 71, 28, 1, '2018-06-29 09:11:14', '2018-06-29 09:11:14'),
(244, 72, 28, 1, '2018-06-29 09:11:14', '2018-06-29 09:11:14'),
(245, 71, 22, 0, '2018-06-29 09:11:14', '2018-06-29 09:11:14'),
(246, 72, 22, 1, '2018-06-29 09:11:14', '2018-06-29 09:11:14'),
(247, 73, 24, 1, '2018-06-29 09:12:45', '2018-06-29 09:12:45'),
(248, 74, 24, 1, '2018-06-29 09:12:45', '2018-06-29 09:12:45'),
(249, 75, 24, 0, '2018-06-29 09:12:45', '2018-06-29 09:12:45'),
(250, 76, 24, 1, '2018-06-29 09:12:45', '2018-06-29 09:12:45'),
(251, 73, 25, 0, '2018-06-29 09:12:45', '2018-06-29 09:12:45'),
(252, 74, 25, 1, '2018-06-29 09:12:45', '2018-06-29 09:12:45'),
(253, 75, 25, 1, '2018-06-29 09:12:45', '2018-06-29 09:12:45'),
(254, 76, 25, 1, '2018-06-29 09:12:45', '2018-06-29 09:12:45'),
(255, 73, 26, 1, '2018-06-29 09:12:45', '2018-06-29 09:12:45'),
(256, 74, 26, 0, '2018-06-29 09:12:45', '2018-06-29 09:12:45'),
(257, 75, 26, 0, '2018-06-29 09:12:45', '2018-06-29 09:12:45'),
(258, 76, 26, 1, '2018-06-29 09:12:45', '2018-06-29 09:12:45'),
(259, 73, 28, 1, '2018-06-29 09:12:45', '2018-06-29 09:12:45'),
(260, 74, 28, 1, '2018-06-29 09:12:45', '2018-06-29 09:12:45'),
(261, 75, 28, 0, '2018-06-29 09:12:45', '2018-06-29 09:12:45'),
(262, 76, 28, 0, '2018-06-29 09:12:45', '2018-06-29 09:12:45'),
(263, 73, 22, 1, '2018-06-29 09:12:45', '2018-06-29 09:12:45'),
(264, 74, 22, 1, '2018-06-29 09:12:45', '2018-06-29 09:12:45'),
(265, 75, 22, 1, '2018-06-29 09:12:45', '2018-06-29 09:12:45'),
(266, 76, 22, 1, '2018-06-29 09:12:45', '2018-06-29 09:12:45'),
(267, 77, 24, 0, '2018-06-29 09:14:08', '2018-06-29 09:14:08'),
(268, 78, 24, 1, '2018-06-29 09:14:08', '2018-06-29 09:14:08'),
(269, 79, 24, 1, '2018-06-29 09:14:08', '2018-06-29 09:14:08'),
(270, 77, 25, 1, '2018-06-29 09:14:08', '2018-06-29 09:14:08'),
(271, 78, 25, 1, '2018-06-29 09:14:08', '2018-06-29 09:14:08'),
(272, 79, 25, 1, '2018-06-29 09:14:08', '2018-06-29 09:14:08'),
(273, 77, 26, 0, '2018-06-29 09:14:08', '2018-06-29 09:14:08'),
(274, 78, 26, 1, '2018-06-29 09:14:08', '2018-06-29 09:14:08'),
(275, 79, 26, 1, '2018-06-29 09:14:08', '2018-06-29 09:14:08'),
(276, 77, 28, 0, '2018-06-29 09:14:08', '2018-06-29 09:14:08'),
(277, 78, 28, 0, '2018-06-29 09:14:08', '2018-06-29 09:14:08'),
(278, 79, 28, 1, '2018-06-29 09:14:08', '2018-06-29 09:14:08'),
(279, 77, 22, 1, '2018-06-29 09:14:08', '2018-06-29 09:14:08'),
(280, 78, 22, 1, '2018-06-29 09:14:08', '2018-06-29 09:14:08'),
(281, 79, 22, 1, '2018-06-29 09:14:08', '2018-06-29 09:14:08'),
(282, 80, 24, 1, '2018-06-29 09:15:46', '2018-06-29 09:15:46'),
(283, 81, 24, 1, '2018-06-29 09:15:46', '2018-06-29 09:15:46'),
(284, 82, 24, 0, '2018-06-29 09:15:46', '2018-06-29 09:15:46'),
(285, 83, 24, 1, '2018-06-29 09:15:46', '2018-06-29 09:15:46'),
(286, 84, 24, 0, '2018-06-29 09:15:46', '2018-06-29 09:15:46'),
(287, 80, 25, 1, '2018-06-29 09:15:46', '2018-06-29 09:15:46'),
(288, 81, 25, 1, '2018-06-29 09:15:46', '2018-06-29 09:15:46'),
(289, 82, 25, 1, '2018-06-29 09:15:46', '2018-06-29 09:15:46'),
(290, 83, 25, 0, '2018-06-29 09:15:46', '2018-06-29 09:15:46'),
(291, 84, 25, 1, '2018-06-29 09:15:46', '2018-06-29 09:15:46'),
(292, 80, 26, 1, '2018-06-29 09:15:46', '2018-06-29 09:15:46'),
(293, 81, 26, 1, '2018-06-29 09:15:46', '2018-06-29 09:15:46'),
(294, 82, 26, 1, '2018-06-29 09:15:46', '2018-06-29 09:15:46'),
(295, 83, 26, 1, '2018-06-29 09:15:46', '2018-06-29 09:15:46'),
(296, 84, 26, 1, '2018-06-29 09:15:46', '2018-06-29 09:15:46'),
(297, 80, 28, 1, '2018-06-29 09:15:46', '2018-06-29 09:15:46'),
(298, 81, 28, 0, '2018-06-29 09:15:46', '2018-06-29 09:15:46'),
(299, 82, 28, 1, '2018-06-29 09:15:46', '2018-06-29 09:15:46'),
(300, 83, 28, 0, '2018-06-29 09:15:46', '2018-06-29 09:15:46'),
(301, 84, 28, 1, '2018-06-29 09:15:46', '2018-06-29 09:15:46'),
(302, 80, 22, 1, '2018-06-29 09:15:46', '2018-06-29 09:15:46'),
(303, 81, 22, 1, '2018-06-29 09:15:46', '2018-06-29 09:15:46'),
(304, 82, 22, 1, '2018-06-29 09:15:46', '2018-06-29 09:15:46'),
(305, 83, 22, 1, '2018-06-29 09:15:46', '2018-06-29 09:15:46'),
(306, 84, 22, 0, '2018-06-29 09:15:46', '2018-06-29 09:15:46'),
(307, 85, 24, 1, '2018-06-29 09:17:03', '2018-06-29 09:17:03'),
(308, 86, 24, 1, '2018-06-29 09:17:03', '2018-06-29 09:17:03'),
(309, 85, 25, 1, '2018-06-29 09:17:03', '2018-06-29 09:17:03'),
(310, 86, 25, 1, '2018-06-29 09:17:03', '2018-06-29 09:17:03'),
(311, 85, 26, 1, '2018-06-29 09:17:03', '2018-06-29 09:17:03'),
(312, 86, 26, 0, '2018-06-29 09:17:03', '2018-06-29 09:17:03'),
(313, 85, 28, 1, '2018-06-29 09:17:03', '2018-06-29 09:17:03'),
(314, 86, 28, 1, '2018-06-29 09:17:03', '2018-06-29 09:17:03'),
(315, 85, 22, 0, '2018-06-29 09:17:03', '2018-06-29 09:17:03'),
(316, 86, 22, 1, '2018-06-29 09:17:03', '2018-06-29 09:17:03'),
(317, 87, 24, 1, '2018-06-29 09:18:02', '2018-06-29 09:18:02'),
(318, 88, 24, 0, '2018-06-29 09:18:03', '2018-06-29 09:18:03'),
(319, 89, 24, 0, '2018-06-29 09:18:03', '2018-06-29 09:18:03'),
(320, 87, 25, 1, '2018-06-29 09:18:03', '2018-06-29 09:18:03'),
(321, 88, 25, 1, '2018-06-29 09:18:03', '2018-06-29 09:18:03'),
(322, 89, 25, 1, '2018-06-29 09:18:03', '2018-06-29 09:18:03'),
(323, 87, 26, 0, '2018-06-29 09:18:03', '2018-06-29 09:18:03'),
(324, 88, 26, 1, '2018-06-29 09:18:03', '2018-06-29 09:18:03'),
(325, 89, 26, 1, '2018-06-29 09:18:03', '2018-06-29 09:18:03'),
(326, 87, 28, 1, '2018-06-29 09:18:03', '2018-06-29 09:18:03'),
(327, 88, 28, 0, '2018-06-29 09:18:03', '2018-06-29 09:18:03'),
(328, 89, 28, 1, '2018-06-29 09:18:03', '2018-06-29 09:18:03'),
(329, 87, 22, 1, '2018-06-29 09:18:03', '2018-06-29 09:18:03'),
(330, 88, 22, 0, '2018-06-29 09:18:03', '2018-06-29 09:18:03'),
(331, 89, 22, 1, '2018-06-29 09:18:03', '2018-06-29 09:18:03'),
(332, 90, 24, 1, '2018-06-29 09:19:25', '2018-06-29 09:19:25'),
(333, 91, 24, 1, '2018-06-29 09:19:25', '2018-06-29 09:19:25'),
(334, 92, 24, 1, '2018-06-29 09:19:25', '2018-06-29 09:19:25'),
(335, 90, 25, 1, '2018-06-29 09:19:25', '2018-06-29 09:19:25'),
(336, 91, 25, 1, '2018-06-29 09:19:25', '2018-06-29 09:19:25'),
(337, 92, 25, 1, '2018-06-29 09:19:25', '2018-06-29 09:19:25'),
(338, 90, 26, 0, '2018-06-29 09:19:25', '2018-06-29 09:19:25'),
(339, 91, 26, 1, '2018-06-29 09:19:25', '2018-06-29 09:19:25'),
(340, 92, 26, 1, '2018-06-29 09:19:25', '2018-06-29 09:19:25'),
(341, 90, 28, 1, '2018-06-29 09:19:25', '2018-06-29 09:19:25'),
(342, 91, 28, 1, '2018-06-29 09:19:25', '2018-06-29 09:19:25'),
(343, 92, 28, 1, '2018-06-29 09:19:25', '2018-06-29 09:19:25'),
(344, 90, 22, 0, '2018-06-29 09:19:25', '2018-06-29 09:19:25'),
(345, 91, 22, 0, '2018-06-29 09:19:25', '2018-06-29 09:19:25'),
(346, 92, 22, 1, '2018-06-29 09:19:25', '2018-06-29 09:19:25'),
(347, 93, 24, 1, '2018-06-29 09:20:09', '2018-06-29 09:20:09'),
(348, 94, 24, 1, '2018-06-29 09:20:09', '2018-06-29 09:20:09'),
(349, 93, 25, 0, '2018-06-29 09:20:09', '2018-06-29 09:20:09'),
(350, 94, 25, 1, '2018-06-29 09:20:10', '2018-06-29 09:20:10'),
(351, 93, 26, 1, '2018-06-29 09:20:10', '2018-06-29 09:20:10'),
(352, 94, 26, 0, '2018-06-29 09:20:10', '2018-06-29 09:20:10'),
(353, 93, 28, 1, '2018-06-29 09:20:10', '2018-06-29 09:20:10'),
(354, 94, 28, 1, '2018-06-29 09:20:10', '2018-06-29 09:20:10'),
(355, 93, 22, 1, '2018-06-29 09:20:10', '2018-06-29 09:20:10'),
(356, 94, 22, 1, '2018-06-29 09:20:10', '2018-06-29 09:20:10'),
(357, 95, 24, 1, '2018-06-29 09:21:19', '2018-06-29 09:21:19'),
(358, 96, 24, 0, '2018-06-29 09:21:19', '2018-06-29 09:21:19'),
(359, 97, 24, 1, '2018-06-29 09:21:19', '2018-06-29 09:21:19'),
(360, 95, 25, 1, '2018-06-29 09:21:19', '2018-06-29 09:21:19'),
(361, 96, 25, 1, '2018-06-29 09:21:19', '2018-06-29 09:21:19'),
(362, 97, 25, 1, '2018-06-29 09:21:19', '2018-06-29 09:21:19'),
(363, 95, 26, 1, '2018-06-29 09:21:19', '2018-06-29 09:21:19'),
(364, 96, 26, 1, '2018-06-29 09:21:19', '2018-06-29 09:21:19'),
(365, 97, 26, 1, '2018-06-29 09:21:19', '2018-06-29 09:21:19'),
(366, 95, 28, 1, '2018-06-29 09:21:19', '2018-06-29 09:21:19'),
(367, 96, 28, 1, '2018-06-29 09:21:19', '2018-06-29 09:21:19'),
(368, 97, 28, 1, '2018-06-29 09:21:19', '2018-06-29 09:21:19'),
(369, 95, 22, 0, '2018-06-29 09:21:19', '2018-06-29 09:21:19'),
(370, 96, 22, 1, '2018-06-29 09:21:19', '2018-06-29 09:21:19'),
(371, 97, 22, 0, '2018-06-29 09:21:19', '2018-06-29 09:21:19'),
(372, 98, 24, 1, '2018-06-29 09:21:44', '2018-06-29 09:21:44'),
(373, 98, 25, 0, '2018-06-29 09:21:44', '2018-06-29 09:21:44'),
(374, 98, 26, 1, '2018-06-29 09:21:44', '2018-06-29 09:21:44'),
(375, 98, 28, 1, '2018-06-29 09:21:44', '2018-06-29 09:21:44'),
(376, 98, 22, 1, '2018-06-29 09:21:44', '2018-06-29 09:21:44'),
(377, 99, 27, 1, '2018-06-29 09:22:33', '2018-06-29 09:22:33'),
(378, 99, 29, 1, '2018-06-29 09:22:33', '2018-06-29 09:22:33'),
(379, 99, 30, 1, '2018-06-29 09:22:33', '2018-06-29 09:22:33'),
(380, 99, 31, 1, '2018-06-29 09:22:33', '2018-06-29 09:22:33'),
(381, 99, 32, 1, '2018-06-29 09:22:33', '2018-06-29 09:22:33'),
(382, 100, 27, 1, '2018-06-29 09:23:14', '2018-06-29 09:23:14'),
(383, 101, 27, 0, '2018-06-29 09:23:14', '2018-06-29 09:23:14'),
(384, 100, 29, 1, '2018-06-29 09:23:14', '2018-06-29 09:23:14'),
(385, 101, 29, 1, '2018-06-29 09:23:14', '2018-06-29 09:23:14'),
(386, 100, 30, 1, '2018-06-29 09:23:14', '2018-06-29 09:23:14'),
(387, 101, 30, 1, '2018-06-29 09:23:14', '2018-06-29 09:23:14'),
(388, 100, 31, 0, '2018-06-29 09:23:14', '2018-06-29 09:23:14'),
(389, 101, 31, 1, '2018-06-29 09:23:14', '2018-06-29 09:23:14'),
(390, 100, 32, 1, '2018-06-29 09:23:14', '2018-06-29 09:23:14'),
(391, 101, 32, 1, '2018-06-29 09:23:14', '2018-06-29 09:23:14'),
(392, 102, 27, 1, '2018-06-29 09:23:58', '2018-06-29 09:23:58'),
(393, 102, 29, 1, '2018-06-29 09:23:58', '2018-06-29 09:23:58'),
(394, 102, 30, 1, '2018-06-29 09:23:58', '2018-06-29 09:23:58'),
(395, 102, 31, 1, '2018-06-29 09:23:58', '2018-06-29 09:23:58'),
(396, 102, 32, 1, '2018-06-29 09:23:58', '2018-06-29 09:23:58'),
(397, 103, 27, 1, '2018-06-29 09:24:37', '2018-06-29 09:24:37'),
(398, 103, 29, 1, '2018-06-29 09:24:37', '2018-06-29 09:24:37'),
(399, 103, 30, 0, '2018-06-29 09:24:37', '2018-06-29 09:24:37'),
(400, 103, 31, 1, '2018-06-29 09:24:37', '2018-06-29 09:24:37'),
(401, 103, 32, 1, '2018-06-29 09:24:37', '2018-06-29 09:24:37'),
(402, 104, 27, 1, '2018-06-29 09:25:19', '2018-06-29 09:25:19'),
(403, 104, 29, 1, '2018-06-29 09:25:19', '2018-06-29 09:25:19'),
(404, 104, 30, 1, '2018-06-29 09:25:19', '2018-06-29 09:25:19'),
(405, 104, 31, 1, '2018-06-29 09:25:19', '2018-06-29 09:25:19'),
(406, 104, 32, 1, '2018-06-29 09:25:19', '2018-06-29 09:25:19'),
(407, 105, 27, 1, '2018-06-29 09:25:46', '2018-06-29 09:25:46'),
(408, 105, 29, 0, '2018-06-29 09:25:46', '2018-06-29 09:25:46'),
(409, 105, 30, 0, '2018-06-29 09:25:46', '2018-06-29 09:25:46'),
(410, 105, 31, 1, '2018-06-29 09:25:46', '2018-06-29 09:25:46'),
(411, 105, 32, 1, '2018-06-29 09:25:46', '2018-06-29 09:25:46'),
(412, 106, 27, 1, '2018-06-29 09:26:46', '2018-06-29 09:26:46'),
(413, 106, 29, 0, '2018-06-29 09:26:46', '2018-06-29 09:26:46'),
(414, 106, 30, 0, '2018-06-29 09:26:46', '2018-06-29 09:26:46'),
(415, 106, 31, 0, '2018-06-29 09:26:46', '2018-06-29 09:26:46'),
(416, 106, 32, 1, '2018-06-29 09:26:46', '2018-06-29 09:26:46'),
(417, 107, 27, 1, '2018-06-29 09:27:22', '2018-06-29 09:27:22'),
(418, 107, 29, 1, '2018-06-29 09:27:22', '2018-06-29 09:27:22'),
(419, 107, 30, 1, '2018-06-29 09:27:22', '2018-06-29 09:27:22'),
(420, 107, 31, 1, '2018-06-29 09:27:22', '2018-06-29 09:27:22'),
(421, 107, 32, 1, '2018-06-29 09:27:22', '2018-06-29 09:27:22'),
(422, 108, 33, 1, '2018-06-29 10:07:39', '2018-06-29 10:07:39'),
(423, 109, 33, 0, '2018-06-29 10:07:39', '2018-06-29 10:07:39'),
(424, 110, 33, 1, '2018-06-29 10:08:02', '2018-06-29 10:08:02'),
(425, 111, 33, 0, '2018-06-29 10:08:02', '2018-06-29 10:08:02'),
(426, 112, 33, 1, '2018-06-29 10:09:53', '2018-06-29 10:09:53'),
(427, 113, 33, 1, '2018-06-29 10:09:53', '2018-06-29 10:09:53'),
(428, 114, 35, 1, '2018-06-29 10:35:33', '2018-06-29 10:35:33'),
(429, 115, 35, 1, '2018-06-29 10:35:33', '2018-06-29 10:35:33'),
(430, 116, 35, 1, '2018-06-29 10:35:33', '2018-06-29 10:35:33'),
(431, 114, 36, 1, '2018-06-29 10:35:33', '2018-06-29 10:35:33'),
(432, 115, 36, 1, '2018-06-29 10:35:33', '2018-06-29 10:35:33'),
(433, 116, 36, 1, '2018-06-29 10:35:33', '2018-06-29 10:35:33'),
(434, 114, 37, 1, '2018-06-29 10:35:33', '2018-06-29 10:35:33'),
(435, 115, 37, 1, '2018-06-29 10:35:33', '2018-06-29 10:35:33'),
(436, 116, 37, 0, '2018-06-29 10:35:33', '2018-06-29 10:35:33'),
(437, 117, 35, 1, '2018-06-29 10:36:30', '2018-06-29 10:36:30'),
(438, 118, 35, 1, '2018-06-29 10:36:30', '2018-06-29 10:36:30'),
(439, 117, 36, 0, '2018-06-29 10:36:30', '2018-06-29 10:36:30'),
(440, 118, 36, 1, '2018-06-29 10:36:30', '2018-06-29 10:36:30'),
(441, 117, 37, 1, '2018-06-29 10:36:30', '2018-06-29 10:36:30'),
(442, 118, 37, 1, '2018-06-29 10:36:30', '2018-06-29 10:36:30'),
(443, 119, 35, 1, '2018-06-29 10:37:08', '2018-06-29 10:37:08'),
(444, 120, 35, 0, '2018-06-29 10:37:08', '2018-06-29 10:37:08'),
(445, 119, 36, 1, '2018-06-29 10:37:08', '2018-06-29 10:37:08'),
(446, 120, 36, 1, '2018-06-29 10:37:08', '2018-06-29 10:37:08'),
(447, 119, 37, 1, '2018-06-29 10:37:08', '2018-06-29 10:37:08'),
(448, 120, 37, 1, '2018-06-29 10:37:08', '2018-06-29 10:37:08'),
(449, 121, 35, 1, '2018-06-29 10:37:41', '2018-06-29 10:37:41'),
(450, 122, 35, 1, '2018-06-29 10:37:41', '2018-06-29 10:37:41'),
(451, 121, 36, 1, '2018-06-29 10:37:41', '2018-06-29 10:37:41'),
(452, 122, 36, 1, '2018-06-29 10:37:41', '2018-06-29 10:37:41'),
(453, 121, 37, 1, '2018-06-29 10:37:41', '2018-06-29 10:37:41'),
(454, 122, 37, 1, '2018-06-29 10:37:41', '2018-06-29 10:37:41'),
(455, 123, 35, 1, '2018-06-29 10:38:35', '2018-06-29 10:38:35'),
(456, 124, 35, 1, '2018-06-29 10:38:35', '2018-06-29 10:38:35'),
(457, 125, 35, 0, '2018-06-29 10:38:35', '2018-06-29 10:38:35'),
(458, 123, 36, 1, '2018-06-29 10:38:35', '2018-06-29 10:38:35'),
(459, 124, 36, 1, '2018-06-29 10:38:35', '2018-06-29 10:38:35'),
(460, 125, 36, 1, '2018-06-29 10:38:35', '2018-06-29 10:38:35'),
(461, 123, 37, 0, '2018-06-29 10:38:35', '2018-06-29 10:38:35'),
(462, 124, 37, 1, '2018-06-29 10:38:35', '2018-06-29 10:38:35'),
(463, 125, 37, 1, '2018-06-29 10:38:35', '2018-06-29 10:38:35'),
(464, 126, 35, 1, '2018-06-29 10:39:08', '2018-06-29 10:39:08'),
(465, 127, 35, 1, '2018-06-29 10:39:08', '2018-06-29 10:39:08'),
(466, 126, 36, 1, '2018-06-29 10:39:08', '2018-06-29 10:39:08'),
(467, 127, 36, 0, '2018-06-29 10:39:08', '2018-06-29 10:39:08'),
(468, 126, 37, 1, '2018-06-29 10:39:08', '2018-06-29 10:39:08'),
(469, 127, 37, 1, '2018-06-29 10:39:08', '2018-06-29 10:39:08'),
(470, 128, 35, 1, '2018-06-29 10:39:47', '2018-06-29 10:39:47'),
(471, 129, 35, 1, '2018-06-29 10:39:47', '2018-06-29 10:39:47'),
(472, 128, 36, 1, '2018-06-29 10:39:47', '2018-06-29 10:39:47'),
(473, 129, 36, 1, '2018-06-29 10:39:47', '2018-06-29 10:39:47'),
(474, 128, 37, 1, '2018-06-29 10:39:47', '2018-06-29 10:39:47'),
(475, 129, 37, 1, '2018-06-29 10:39:47', '2018-06-29 10:39:47'),
(476, 130, 35, 1, '2018-06-29 10:40:34', '2018-06-29 10:40:34'),
(477, 131, 35, 1, '2018-06-29 10:40:34', '2018-06-29 10:40:34'),
(478, 132, 35, 1, '2018-06-29 10:40:34', '2018-06-29 10:40:34'),
(479, 130, 36, 0, '2018-06-29 10:40:34', '2018-06-29 10:40:34'),
(480, 131, 36, 1, '2018-06-29 10:40:34', '2018-06-29 10:40:34'),
(481, 132, 36, 1, '2018-06-29 10:40:34', '2018-06-29 10:40:34'),
(482, 130, 37, 1, '2018-06-29 10:40:34', '2018-06-29 10:40:34'),
(483, 131, 37, 1, '2018-06-29 10:40:34', '2018-06-29 10:40:34'),
(484, 132, 37, 1, '2018-06-29 10:40:35', '2018-06-29 10:40:35'),
(485, 133, 13, 1, '2018-06-29 11:15:51', '2018-06-29 11:15:51'),
(486, 134, 13, 1, '2018-06-29 11:15:51', '2018-06-29 11:15:51'),
(487, 135, 13, 1, '2018-06-29 11:15:51', '2018-06-29 11:15:51'),
(488, 133, 38, 1, '2018-06-29 11:15:51', '2018-06-29 11:15:51'),
(489, 134, 38, 0, '2018-06-29 11:15:51', '2018-06-29 11:15:51'),
(490, 135, 38, 1, '2018-06-29 11:15:51', '2018-06-29 11:15:51'),
(491, 133, 39, 1, '2018-06-29 11:15:51', '2018-06-29 11:15:51'),
(492, 134, 39, 1, '2018-06-29 11:15:51', '2018-06-29 11:15:51'),
(493, 135, 39, 0, '2018-06-29 11:15:51', '2018-06-29 11:15:51'),
(494, 133, 40, 1, '2018-06-29 11:15:51', '2018-06-29 11:15:51'),
(495, 134, 40, 1, '2018-06-29 11:15:51', '2018-06-29 11:15:51'),
(496, 135, 40, 1, '2018-06-29 11:15:51', '2018-06-29 11:15:51'),
(497, 136, 13, 1, '2018-06-29 11:16:28', '2018-06-29 11:16:28'),
(498, 137, 13, 0, '2018-06-29 11:16:28', '2018-06-29 11:16:28'),
(499, 136, 38, 1, '2018-06-29 11:16:28', '2018-06-29 11:16:28'),
(500, 137, 38, 1, '2018-06-29 11:16:28', '2018-06-29 11:16:28'),
(501, 136, 39, 1, '2018-06-29 11:16:28', '2018-06-29 11:16:28'),
(502, 137, 39, 1, '2018-06-29 11:16:28', '2018-06-29 11:16:28'),
(503, 136, 40, 1, '2018-06-29 11:16:28', '2018-06-29 11:16:28'),
(504, 137, 40, 1, '2018-06-29 11:16:28', '2018-06-29 11:16:28'),
(505, 138, 13, 1, '2018-06-29 11:17:02', '2018-06-29 11:17:02'),
(506, 139, 13, 1, '2018-06-29 11:17:02', '2018-06-29 11:17:02'),
(507, 138, 38, 0, '2018-06-29 11:17:02', '2018-06-29 11:17:02'),
(508, 139, 38, 1, '2018-06-29 11:17:02', '2018-06-29 11:17:02'),
(509, 138, 39, 1, '2018-06-29 11:17:02', '2018-06-29 11:17:02'),
(510, 139, 39, 1, '2018-06-29 11:17:02', '2018-06-29 11:17:02'),
(511, 138, 40, 1, '2018-06-29 11:17:02', '2018-06-29 11:17:02'),
(512, 139, 40, 0, '2018-06-29 11:17:02', '2018-06-29 11:17:02'),
(513, 140, 13, 1, '2018-06-29 11:18:03', '2018-06-29 11:18:03'),
(514, 141, 13, 0, '2018-06-29 11:18:03', '2018-06-29 11:18:03'),
(515, 142, 13, 1, '2018-06-29 11:18:03', '2018-06-29 11:18:03'),
(516, 140, 38, 1, '2018-06-29 11:18:03', '2018-06-29 11:18:03'),
(517, 141, 38, 1, '2018-06-29 11:18:03', '2018-06-29 11:18:03'),
(518, 142, 38, 1, '2018-06-29 11:18:04', '2018-06-29 11:18:04'),
(519, 140, 39, 1, '2018-06-29 11:18:04', '2018-06-29 11:18:04'),
(520, 141, 39, 1, '2018-06-29 11:18:04', '2018-06-29 11:18:04'),
(521, 142, 39, 1, '2018-06-29 11:18:04', '2018-06-29 11:18:04'),
(522, 140, 40, 0, '2018-06-29 11:18:04', '2018-06-29 11:18:04'),
(523, 141, 40, 0, '2018-06-29 11:18:04', '2018-06-29 11:18:04'),
(524, 142, 40, 1, '2018-06-29 11:18:04', '2018-06-29 11:18:04'),
(525, 143, 13, 1, '2018-06-29 11:18:38', '2018-06-29 11:18:38'),
(527, 143, 38, 1, '2018-06-29 11:18:38', '2018-06-29 11:18:38'),
(529, 143, 39, 0, '2018-06-29 11:18:38', '2018-06-29 11:18:38'),
(531, 143, 40, 1, '2018-06-29 11:18:38', '2018-06-29 11:18:38'),
(533, 145, 13, 1, '2018-06-29 11:22:24', '2018-06-29 11:22:24'),
(534, 146, 13, 0, '2018-06-29 11:22:24', '2018-06-29 11:22:24'),
(535, 147, 13, 1, '2018-06-29 11:22:24', '2018-06-29 11:22:24'),
(536, 145, 38, 1, '2018-06-29 11:22:24', '2018-06-29 11:22:24'),
(537, 146, 38, 1, '2018-06-29 11:22:24', '2018-06-29 11:22:24'),
(538, 147, 38, 1, '2018-06-29 11:22:24', '2018-06-29 11:22:24'),
(539, 145, 39, 1, '2018-06-29 11:22:24', '2018-06-29 11:22:24'),
(540, 146, 39, 1, '2018-06-29 11:22:24', '2018-06-29 11:22:24'),
(541, 147, 39, 0, '2018-06-29 11:22:24', '2018-06-29 11:22:24'),
(542, 145, 40, 0, '2018-06-29 11:22:24', '2018-06-29 11:22:24'),
(543, 146, 40, 0, '2018-06-29 11:22:24', '2018-06-29 11:22:24'),
(544, 147, 40, 1, '2018-06-29 11:22:24', '2018-06-29 11:22:24'),
(545, 148, 13, 1, '2018-06-29 11:23:05', '2018-06-29 11:23:05'),
(546, 149, 13, 1, '2018-06-29 11:23:05', '2018-06-29 11:23:05'),
(547, 148, 38, 1, '2018-06-29 11:23:05', '2018-06-29 11:23:05'),
(548, 149, 38, 1, '2018-06-29 11:23:05', '2018-06-29 11:23:05'),
(549, 148, 39, 1, '2018-06-29 11:23:05', '2018-06-29 11:23:05'),
(550, 149, 39, 1, '2018-06-29 11:23:05', '2018-06-29 11:23:05'),
(551, 148, 40, 0, '2018-06-29 11:23:05', '2018-06-29 11:23:05'),
(552, 149, 40, 1, '2018-06-29 11:23:05', '2018-06-29 11:23:05'),
(553, 150, 13, 1, '2018-06-29 11:23:40', '2018-06-29 11:23:40'),
(554, 150, 38, 0, '2018-06-29 11:23:40', '2018-06-29 11:23:40'),
(555, 150, 39, 1, '2018-06-29 11:23:40', '2018-06-29 11:23:40'),
(556, 150, 40, 1, '2018-06-29 11:23:40', '2018-06-29 11:23:40'),
(565, 153, 13, 1, '2018-06-29 11:24:17', '2018-06-29 11:24:17'),
(566, 154, 13, 1, '2018-06-29 11:24:17', '2018-06-29 11:24:17'),
(567, 153, 38, 1, '2018-06-29 11:24:17', '2018-06-29 11:24:17'),
(568, 154, 38, 1, '2018-06-29 11:24:17', '2018-06-29 11:24:17'),
(569, 153, 39, 1, '2018-06-29 11:24:17', '2018-06-29 11:24:17'),
(570, 154, 39, 1, '2018-06-29 11:24:17', '2018-06-29 11:24:17'),
(571, 153, 40, 1, '2018-06-29 11:24:17', '2018-06-29 11:24:17'),
(572, 154, 40, 1, '2018-06-29 11:24:17', '2018-06-29 11:24:17'),
(573, 155, 13, 1, '2018-06-29 11:28:40', '2018-06-29 11:28:40'),
(574, 155, 38, 0, '2018-06-29 11:28:40', '2018-06-29 11:28:40'),
(575, 155, 39, 1, '2018-06-29 11:28:40', '2018-06-29 11:28:40'),
(576, 155, 40, 0, '2018-06-29 11:28:40', '2018-06-29 11:28:40'),
(577, 156, 13, 1, '2018-06-29 11:29:44', '2018-06-29 11:29:44'),
(578, 157, 13, 1, '2018-06-29 11:29:44', '2018-06-29 11:29:44'),
(579, 158, 13, 1, '2018-06-29 11:29:44', '2018-06-29 11:29:44'),
(580, 156, 38, 0, '2018-06-29 11:29:44', '2018-06-29 11:29:44'),
(581, 157, 38, 1, '2018-06-29 11:29:44', '2018-06-29 11:29:44'),
(582, 158, 38, 1, '2018-06-29 11:29:44', '2018-06-29 11:29:44'),
(583, 156, 39, 1, '2018-06-29 11:29:44', '2018-06-29 11:29:44'),
(584, 157, 39, 1, '2018-06-29 11:29:44', '2018-06-29 11:29:44'),
(585, 158, 39, 1, '2018-06-29 11:29:44', '2018-06-29 11:29:44'),
(586, 156, 40, 1, '2018-06-29 11:29:44', '2018-06-29 11:29:44'),
(587, 157, 40, 0, '2018-06-29 11:29:44', '2018-06-29 11:29:44'),
(588, 158, 40, 0, '2018-06-29 11:29:44', '2018-06-29 11:29:44'),
(589, 159, 13, 1, '2018-06-29 11:30:09', '2018-06-29 11:30:09'),
(590, 159, 38, 1, '2018-06-29 11:30:09', '2018-06-29 11:30:09'),
(591, 159, 39, 1, '2018-06-29 11:30:09', '2018-06-29 11:30:09'),
(592, 159, 40, 1, '2018-06-29 11:30:09', '2018-06-29 11:30:09'),
(593, 160, 13, 0, '2018-06-29 11:30:44', '2018-06-29 11:30:44'),
(594, 160, 38, 1, '2018-06-29 11:30:44', '2018-06-29 11:30:44'),
(595, 160, 39, 1, '2018-06-29 11:30:44', '2018-06-29 11:30:44'),
(596, 160, 40, 1, '2018-06-29 11:30:44', '2018-06-29 11:30:44'),
(597, 161, 13, 1, '2018-06-29 11:31:05', '2018-06-29 11:31:05'),
(598, 161, 38, 1, '2018-06-29 11:31:05', '2018-06-29 11:31:05'),
(599, 161, 39, 1, '2018-06-29 11:31:05', '2018-06-29 11:31:05'),
(600, 161, 40, 1, '2018-06-29 11:31:05', '2018-06-29 11:31:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aulas`
--

CREATE TABLE `aulas` (
  `aul_id` int(10) UNSIGNED NOT NULL,
  `aul_numero` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aul_tipo` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `aulas`
--

INSERT INTO `aulas` (`aul_id`, `aul_numero`, `aul_tipo`, `created_at`, `updated_at`) VALUES
(1, 'A101', 1, '2017-06-05 16:29:54', '2018-02-25 23:33:27'),
(2, 'A102', 1, '2017-06-10 23:47:53', '2017-06-10 23:47:53'),
(3, 'A103', 1, '2017-06-11 16:28:02', '2017-06-11 16:28:02'),
(4, 'A104', 1, '2017-06-25 15:59:21', '2017-06-25 15:59:21'),
(5, 'A201', 1, '2018-02-12 06:03:33', '2018-02-12 06:03:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bodega`
--

CREATE TABLE `bodega` (
  `bo_id` int(10) UNSIGNED NOT NULL,
  `bo_costo` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `bodega`
--

INSERT INTO `bodega` (`bo_id`, `bo_costo`, `created_at`, `updated_at`) VALUES
(1, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `ca_id` int(10) UNSIGNED NOT NULL,
  `ca_nombre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`ca_id`, `ca_nombre`, `created_at`, `updated_at`) VALUES
(1, 'Profesor', NULL, NULL),
(2, 'Jefe UTP', NULL, NULL),
(3, 'Director', '2018-03-06 06:01:58', '2018-03-06 06:01:58'),
(4, 'Secretaria', NULL, NULL),
(5, 'Inspector General', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `ciu_id` int(10) UNSIGNED NOT NULL,
  `region_id` int(10) UNSIGNED NOT NULL,
  `ciu_nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`ciu_id`, `region_id`, `ciu_nombre`, `created_at`, `updated_at`) VALUES
(1, 1, 'ciudad1', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE `clases` (
  `cla_id` int(10) UNSIGNED NOT NULL,
  `curso_id` int(10) UNSIGNED NOT NULL,
  `asignatura_id` int(10) UNSIGNED NOT NULL,
  `profesor_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clases`
--

INSERT INTO `clases` (`cla_id`, `curso_id`, `asignatura_id`, `profesor_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2018-03-13 06:21:56', '2018-04-16 22:06:41'),
(2, 1, 2, 7, '2018-03-14 04:14:40', '2018-03-14 04:14:40'),
(3, 2, 1, 3, '2018-03-14 04:18:26', '2018-03-14 04:18:26'),
(4, 1, 3, 3, '2018-03-14 04:29:46', '2018-04-16 22:06:55'),
(6, 1, 4, 4, '2018-03-19 05:49:50', '2018-03-19 05:49:50'),
(7, 7, 5, NULL, '2018-03-19 05:54:23', '2018-03-19 05:54:23'),
(8, 9, 1, 13, '2018-06-26 08:41:53', '2018-06-26 08:41:53'),
(9, 9, 2, 13, '2018-06-26 08:42:04', '2018-06-26 08:42:04'),
(10, 9, 3, 7, '2018-06-26 08:42:23', '2018-06-26 08:42:23'),
(11, 9, 4, 4, '2018-06-26 08:42:33', '2018-06-26 08:42:33'),
(12, 10, 1, 13, '2018-06-26 08:42:56', '2018-06-26 08:42:56'),
(13, 10, 2, 7, '2018-06-26 08:43:05', '2018-06-26 08:43:05'),
(14, 10, 3, 1, '2018-06-26 08:43:13', '2018-06-26 08:43:13'),
(15, 10, 4, 4, '2018-06-26 08:43:26', '2018-06-26 08:43:26'),
(16, 12, 5, NULL, '2018-06-27 10:40:32', '2018-06-27 10:40:32'),
(17, 11, 2, 13, '2018-06-29 08:41:05', '2018-06-29 08:41:05'),
(18, 11, 1, 14, '2018-06-29 08:41:15', '2018-06-29 08:41:15'),
(19, 11, 3, 7, '2018-06-29 08:41:24', '2018-06-29 08:41:24'),
(20, 11, 4, 4, '2018-06-29 08:41:36', '2018-06-29 08:41:36'),
(21, 13, 1, 3, '2018-06-29 10:00:44', '2018-06-29 10:00:44'),
(22, 13, 2, 13, '2018-06-29 10:00:50', '2018-06-29 10:00:50'),
(23, 13, 3, 7, '2018-06-29 10:00:58', '2018-06-29 10:00:58'),
(24, 13, 4, 4, '2018-06-29 10:01:06', '2018-06-29 10:01:06'),
(25, 14, 1, 7, '2018-06-29 10:23:07', '2018-06-29 10:23:07'),
(26, 14, 2, 13, '2018-06-29 10:23:14', '2018-06-29 10:23:14'),
(27, 14, 3, 1, '2018-06-29 10:23:22', '2018-06-29 10:23:22'),
(28, 15, 1, 1, '2018-06-29 11:00:58', '2018-06-29 11:02:45'),
(29, 15, 3, 4, '2018-06-29 11:01:05', '2018-06-29 11:01:26'),
(30, 15, 4, 7, '2018-06-29 11:02:12', '2018-06-29 11:02:12'),
(31, 15, 2, 13, '2018-06-29 11:02:38', '2018-06-29 11:02:38'),
(32, 3, 1, 1, '2018-06-29 18:37:53', '2018-06-29 18:38:03'),
(33, 16, 10, NULL, '2018-06-29 18:48:04', '2018-06-29 18:48:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases_realizadas`
--

CREATE TABLE `clases_realizadas` (
  `cr_id` int(10) UNSIGNED NOT NULL,
  `clase_id` int(10) UNSIGNED NOT NULL,
  `dia_clase_id` int(10) UNSIGNED NOT NULL,
  `cr_estado` tinyint(1) NOT NULL,
  `cr_observacion` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clases_realizadas`
--

INSERT INTO `clases_realizadas` (`cr_id`, `clase_id`, `dia_clase_id`, `cr_estado`, `cr_observacion`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, '2018-03-22 05:11:01', '2018-03-22 05:11:01'),
(2, 1, 2, 1, NULL, '2018-03-22 05:11:01', '2018-03-22 05:11:01'),
(3, 1, 3, 1, NULL, '2018-03-22 06:20:28', '2018-03-22 06:20:28'),
(4, 1, 4, 1, NULL, '2018-03-22 06:20:28', '2018-03-22 06:20:28'),
(5, 1, 5, 1, NULL, '2018-03-22 06:20:28', '2018-03-22 06:20:28'),
(6, 4, 3, 1, NULL, '2018-03-27 08:22:03', '2018-03-27 08:22:03'),
(7, 4, 4, 1, NULL, '2018-03-27 08:22:03', '2018-03-27 08:22:03'),
(8, 4, 6, 1, NULL, '2018-03-27 08:22:03', '2018-03-27 08:22:03'),
(9, 4, 7, 1, NULL, '2018-03-27 08:22:03', '2018-03-27 08:22:03'),
(10, 4, 8, 1, NULL, '2018-03-27 08:22:03', '2018-03-27 08:22:03'),
(11, 2, 9, 1, NULL, '2018-03-27 08:22:48', '2018-03-27 08:22:48'),
(12, 2, 10, 1, NULL, '2018-03-27 08:22:48', '2018-03-27 08:22:48'),
(13, 2, 11, 1, NULL, '2018-03-27 08:24:03', '2018-03-27 08:24:03'),
(14, 2, 12, 1, NULL, '2018-03-27 08:24:03', '2018-03-27 08:24:03'),
(15, 1, 13, 1, NULL, '2018-03-28 02:31:48', '2018-03-28 02:31:48'),
(16, 1, 14, 1, NULL, '2018-03-28 02:31:48', '2018-03-28 02:31:48'),
(17, 1, 15, 1, NULL, '2018-03-28 02:31:48', '2018-03-28 02:31:48'),
(18, 4, 16, 1, NULL, '2018-04-05 02:08:18', '2018-04-05 02:08:18'),
(19, 4, 17, 1, NULL, '2018-04-05 02:08:44', '2018-04-05 02:08:44'),
(20, 4, 18, 1, NULL, '2018-04-05 03:16:40', '2018-04-05 03:16:40'),
(21, 3, 19, 1, NULL, '2018-04-23 02:50:36', '2018-04-23 02:50:36'),
(22, 3, 20, 1, NULL, '2018-04-23 02:50:36', '2018-04-23 02:50:36'),
(23, 1, 16, 1, NULL, '2018-05-09 18:28:46', '2018-05-09 18:28:46'),
(24, 8, 21, 1, NULL, '2018-06-27 05:19:25', '2018-06-27 05:19:25'),
(25, 8, 22, 1, NULL, '2018-06-27 05:19:25', '2018-06-27 05:19:25'),
(26, 8, 23, 1, NULL, '2018-06-27 05:19:25', '2018-06-27 05:19:25'),
(27, 8, 24, 1, NULL, '2018-06-27 05:20:22', '2018-06-27 05:20:22'),
(28, 8, 25, 1, NULL, '2018-06-27 05:20:22', '2018-06-27 05:20:22'),
(29, 8, 26, 1, NULL, '2018-06-27 05:21:59', '2018-06-27 05:21:59'),
(30, 8, 27, 1, NULL, '2018-06-27 05:21:59', '2018-06-27 05:21:59'),
(31, 8, 28, 1, NULL, '2018-06-27 05:21:59', '2018-06-27 05:21:59'),
(32, 8, 29, 1, NULL, '2018-06-27 05:21:59', '2018-06-27 05:21:59'),
(33, 8, 30, 1, NULL, '2018-06-27 05:40:08', '2018-06-27 05:40:08'),
(34, 9, 31, 1, NULL, '2018-06-27 05:42:01', '2018-06-27 05:42:01'),
(35, 9, 32, 1, NULL, '2018-06-27 05:42:01', '2018-06-27 05:42:01'),
(36, 9, 33, 1, NULL, '2018-06-27 05:42:01', '2018-06-27 05:42:01'),
(37, 9, 34, 1, NULL, '2018-06-27 05:42:01', '2018-06-27 05:42:01'),
(38, 10, 32, 1, NULL, '2018-06-27 05:43:03', '2018-06-27 05:43:03'),
(39, 10, 34, 1, NULL, '2018-06-27 05:43:03', '2018-06-27 05:43:03'),
(40, 10, 35, 1, NULL, '2018-06-27 05:43:03', '2018-06-27 05:43:03'),
(41, 10, 36, 1, NULL, '2018-06-27 05:43:03', '2018-06-27 05:43:03'),
(42, 11, 22, 1, NULL, '2018-06-27 05:44:59', '2018-06-27 05:44:59'),
(43, 11, 37, 1, NULL, '2018-06-27 05:44:59', '2018-06-27 05:44:59'),
(44, 11, 38, 1, NULL, '2018-06-27 05:44:59', '2018-06-27 05:44:59'),
(45, 8, 39, 1, NULL, '2018-06-27 06:38:13', '2018-06-27 06:38:13'),
(46, 8, 40, 1, NULL, '2018-06-27 06:38:14', '2018-06-27 06:38:14'),
(47, 8, 41, 1, NULL, '2018-06-27 06:38:14', '2018-06-27 06:38:14'),
(48, 8, 42, 1, NULL, '2018-06-27 06:39:13', '2018-06-27 06:39:13'),
(49, 8, 43, 1, NULL, '2018-06-27 06:39:13', '2018-06-27 06:39:13'),
(50, 9, 44, 1, NULL, '2018-06-27 06:41:00', '2018-06-27 06:41:00'),
(51, 9, 45, 1, NULL, '2018-06-27 06:41:00', '2018-06-27 06:41:00'),
(52, 9, 46, 1, NULL, '2018-06-27 06:41:00', '2018-06-27 06:41:00'),
(53, 9, 47, 1, NULL, '2018-06-27 06:41:00', '2018-06-27 06:41:00'),
(54, 11, 48, 1, NULL, '2018-06-27 06:42:38', '2018-06-27 06:42:38'),
(55, 11, 49, 1, NULL, '2018-06-27 06:42:38', '2018-06-27 06:42:38'),
(56, 11, 50, 1, NULL, '2018-06-27 06:42:38', '2018-06-27 06:42:38'),
(64, 10, 50, 1, NULL, '2018-06-27 10:13:25', '2018-06-27 10:13:25'),
(65, 12, 21, 1, NULL, '2018-06-29 09:08:55', '2018-06-29 09:08:55'),
(66, 12, 31, 1, NULL, '2018-06-29 09:08:55', '2018-06-29 09:08:55'),
(67, 12, 32, 1, NULL, '2018-06-29 09:08:55', '2018-06-29 09:08:55'),
(68, 12, 51, 1, NULL, '2018-06-29 09:09:59', '2018-06-29 09:09:59'),
(69, 12, 52, 1, NULL, '2018-06-29 09:09:59', '2018-06-29 09:09:59'),
(70, 12, 53, 1, NULL, '2018-06-29 09:09:59', '2018-06-29 09:09:59'),
(71, 12, 39, 1, NULL, '2018-06-29 09:11:13', '2018-06-29 09:11:13'),
(72, 12, 40, 1, NULL, '2018-06-29 09:11:14', '2018-06-29 09:11:14'),
(73, 12, 54, 1, NULL, '2018-06-29 09:12:45', '2018-06-29 09:12:45'),
(74, 12, 55, 1, NULL, '2018-06-29 09:12:45', '2018-06-29 09:12:45'),
(75, 12, 56, 1, NULL, '2018-06-29 09:12:45', '2018-06-29 09:12:45'),
(76, 12, 57, 1, NULL, '2018-06-29 09:12:45', '2018-06-29 09:12:45'),
(77, 13, 31, 1, NULL, '2018-06-29 09:14:07', '2018-06-29 09:14:07'),
(78, 13, 32, 1, NULL, '2018-06-29 09:14:07', '2018-06-29 09:14:07'),
(79, 13, 33, 1, NULL, '2018-06-29 09:14:07', '2018-06-29 09:14:07'),
(80, 13, 58, 1, NULL, '2018-06-29 09:15:46', '2018-06-29 09:15:46'),
(81, 13, 59, 1, NULL, '2018-06-29 09:15:46', '2018-06-29 09:15:46'),
(82, 13, 60, 1, NULL, '2018-06-29 09:15:46', '2018-06-29 09:15:46'),
(83, 13, 61, 1, NULL, '2018-06-29 09:15:46', '2018-06-29 09:15:46'),
(84, 13, 62, 1, NULL, '2018-06-29 09:15:46', '2018-06-29 09:15:46'),
(85, 13, 39, 1, NULL, '2018-06-29 09:17:03', '2018-06-29 09:17:03'),
(86, 13, 40, 1, NULL, '2018-06-29 09:17:03', '2018-06-29 09:17:03'),
(87, 13, 63, 1, NULL, '2018-06-29 09:18:02', '2018-06-29 09:18:02'),
(88, 13, 64, 1, NULL, '2018-06-29 09:18:02', '2018-06-29 09:18:02'),
(89, 13, 65, 1, NULL, '2018-06-29 09:18:02', '2018-06-29 09:18:02'),
(90, 15, 31, 1, NULL, '2018-06-29 09:19:25', '2018-06-29 09:19:25'),
(91, 15, 32, 1, NULL, '2018-06-29 09:19:25', '2018-06-29 09:19:25'),
(92, 15, 66, 1, NULL, '2018-06-29 09:19:25', '2018-06-29 09:19:25'),
(93, 15, 28, 1, NULL, '2018-06-29 09:20:09', '2018-06-29 09:20:09'),
(94, 15, 67, 1, NULL, '2018-06-29 09:20:09', '2018-06-29 09:20:09'),
(95, 15, 68, 1, NULL, '2018-06-29 09:21:19', '2018-06-29 09:21:19'),
(96, 15, 69, 1, NULL, '2018-06-29 09:21:19', '2018-06-29 09:21:19'),
(97, 15, 70, 1, NULL, '2018-06-29 09:21:19', '2018-06-29 09:21:19'),
(98, 15, 71, 1, NULL, '2018-06-29 09:21:44', '2018-06-29 09:21:44'),
(99, 17, 31, 1, NULL, '2018-06-29 09:22:33', '2018-06-29 09:22:33'),
(100, 17, 51, 1, NULL, '2018-06-29 09:23:14', '2018-06-29 09:23:14'),
(101, 17, 52, 1, NULL, '2018-06-29 09:23:14', '2018-06-29 09:23:14'),
(102, 17, 39, 1, NULL, '2018-06-29 09:23:58', '2018-06-29 09:23:58'),
(103, 17, 54, 1, NULL, '2018-06-29 09:24:37', '2018-06-29 09:24:37'),
(104, 18, 22, 1, NULL, '2018-06-29 09:25:19', '2018-06-29 09:25:19'),
(105, 18, 63, 1, NULL, '2018-06-29 09:25:46', '2018-06-29 09:25:46'),
(106, 20, 32, 1, NULL, '2018-06-29 09:26:46', '2018-06-29 09:26:46'),
(107, 20, 44, 1, NULL, '2018-06-29 09:27:22', '2018-06-29 09:27:22'),
(108, 21, 72, 1, NULL, '2018-06-29 10:07:39', '2018-06-29 10:07:39'),
(109, 21, 73, 1, NULL, '2018-06-29 10:07:39', '2018-06-29 10:07:39'),
(110, 21, 74, 1, NULL, '2018-06-29 10:08:02', '2018-06-29 10:08:02'),
(111, 21, 75, 1, NULL, '2018-06-29 10:08:02', '2018-06-29 10:08:02'),
(112, 22, 76, 1, NULL, '2018-06-29 10:09:53', '2018-06-29 10:09:53'),
(113, 22, 77, 1, NULL, '2018-06-29 10:09:53', '2018-06-29 10:09:53'),
(114, 25, 78, 1, NULL, '2018-06-29 10:35:33', '2018-06-29 10:35:33'),
(115, 25, 79, 1, NULL, '2018-06-29 10:35:33', '2018-06-29 10:35:33'),
(116, 25, 80, 1, NULL, '2018-06-29 10:35:33', '2018-06-29 10:35:33'),
(117, 25, 81, 1, NULL, '2018-06-29 10:36:30', '2018-06-29 10:36:30'),
(118, 25, 82, 1, NULL, '2018-06-29 10:36:30', '2018-06-29 10:36:30'),
(119, 25, 83, 1, NULL, '2018-06-29 10:37:08', '2018-06-29 10:37:08'),
(120, 25, 84, 1, NULL, '2018-06-29 10:37:08', '2018-06-29 10:37:08'),
(121, 25, 85, 1, NULL, '2018-06-29 10:37:41', '2018-06-29 10:37:41'),
(122, 25, 86, 1, NULL, '2018-06-29 10:37:41', '2018-06-29 10:37:41'),
(123, 26, 87, 1, NULL, '2018-06-29 10:38:35', '2018-06-29 10:38:35'),
(124, 26, 88, 1, NULL, '2018-06-29 10:38:35', '2018-06-29 10:38:35'),
(125, 26, 80, 1, NULL, '2018-06-29 10:38:35', '2018-06-29 10:38:35'),
(126, 26, 89, 1, NULL, '2018-06-29 10:39:08', '2018-06-29 10:39:08'),
(127, 26, 90, 1, NULL, '2018-06-29 10:39:08', '2018-06-29 10:39:08'),
(128, 26, 83, 1, NULL, '2018-06-29 10:39:47', '2018-06-29 10:39:47'),
(129, 26, 84, 1, NULL, '2018-06-29 10:39:47', '2018-06-29 10:39:47'),
(130, 26, 91, 1, NULL, '2018-06-29 10:40:34', '2018-06-29 10:40:34'),
(131, 26, 92, 1, NULL, '2018-06-29 10:40:34', '2018-06-29 10:40:34'),
(132, 26, 93, 1, NULL, '2018-06-29 10:40:34', '2018-06-29 10:40:34'),
(133, 28, 13, 1, NULL, '2018-06-29 11:15:51', '2018-06-29 11:15:51'),
(134, 28, 14, 1, NULL, '2018-06-29 11:15:51', '2018-06-29 11:15:51'),
(135, 28, 15, 1, NULL, '2018-06-29 11:15:51', '2018-06-29 11:15:51'),
(136, 28, 12, 1, NULL, '2018-06-29 11:16:28', '2018-06-29 11:16:28'),
(137, 28, 94, 1, NULL, '2018-06-29 11:16:28', '2018-06-29 11:16:28'),
(138, 28, 95, 1, NULL, '2018-06-29 11:17:02', '2018-06-29 11:17:02'),
(139, 28, 96, 1, NULL, '2018-06-29 11:17:02', '2018-06-29 11:17:02'),
(140, 28, 97, 1, NULL, '2018-06-29 11:18:03', '2018-06-29 11:18:03'),
(141, 28, 98, 1, NULL, '2018-06-29 11:18:03', '2018-06-29 11:18:03'),
(142, 28, 17, 1, NULL, '2018-06-29 11:18:03', '2018-06-29 11:18:03'),
(143, 28, 99, 1, NULL, '2018-06-29 11:18:38', '2018-06-29 11:18:38'),
(145, 30, 13, 1, NULL, '2018-06-29 11:22:24', '2018-06-29 11:22:24'),
(146, 30, 14, 1, NULL, '2018-06-29 11:22:24', '2018-06-29 11:22:24'),
(147, 30, 15, 1, NULL, '2018-06-29 11:22:24', '2018-06-29 11:22:24'),
(148, 30, 101, 1, NULL, '2018-06-29 11:23:05', '2018-06-29 11:23:05'),
(149, 30, 102, 1, NULL, '2018-06-29 11:23:05', '2018-06-29 11:23:05'),
(150, 30, 103, 1, NULL, '2018-06-29 11:23:40', '2018-06-29 11:23:40'),
(153, 30, 100, 1, NULL, '2018-06-29 11:24:17', '2018-06-29 11:24:17'),
(154, 30, 104, 1, NULL, '2018-06-29 11:24:17', '2018-06-29 11:24:17'),
(155, 30, 105, 1, NULL, '2018-06-29 11:28:40', '2018-06-29 11:28:40'),
(156, 31, 14, 1, NULL, '2018-06-29 11:29:44', '2018-06-29 11:29:44'),
(157, 31, 15, 1, NULL, '2018-06-29 11:29:44', '2018-06-29 11:29:44'),
(158, 31, 106, 1, NULL, '2018-06-29 11:29:44', '2018-06-29 11:29:44'),
(159, 31, 107, 1, NULL, '2018-06-29 11:30:08', '2018-06-29 11:30:08'),
(160, 31, 108, 1, NULL, '2018-06-29 11:30:44', '2018-06-29 11:30:44'),
(161, 31, 109, 1, NULL, '2018-06-29 11:31:05', '2018-06-29 11:31:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comuna`
--

CREATE TABLE `comuna` (
  `com_id` int(10) UNSIGNED NOT NULL,
  `ciudad_id` int(10) UNSIGNED NOT NULL,
  `com_nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `comuna`
--

INSERT INTO `comuna` (`com_id`, `ciudad_id`, `com_nombre`, `created_at`, `updated_at`) VALUES
(1, 1, 'Lota', NULL, NULL),
(3, 1, 'Coronel', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conceptos`
--

CREATE TABLE `conceptos` (
  `con_id` int(10) UNSIGNED NOT NULL,
  `con_nombre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `con_descripcion` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `conceptos`
--

INSERT INTO `conceptos` (`con_id`, `con_nombre`, `con_descripcion`, `created_at`, `updated_at`) VALUES
(1, 'NO OBSERVADO', 'No existe evidencia suficiente para evaluar el rasgo', '2017-06-24 14:04:37', '2018-03-23 16:53:28'),
(2, 'RARA VEZ', 'Ocasionalmente muestra el logro de este rasgo', '2017-06-24 14:05:19', '2017-06-24 14:05:19'),
(3, 'GENERALMENTE', 'La mayor parte de las veces demuestra el logro', '2017-06-24 14:06:49', '2017-06-24 14:06:49'),
(4, 'SIEMPRE', 'Permanencia y continuidad en la demostración del rasgo', '2017-06-24 14:07:25', '2017-06-24 14:07:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `cu_id` int(10) UNSIGNED NOT NULL,
  `periodo_id` int(10) UNSIGNED NOT NULL,
  `aula_id` int(10) UNSIGNED DEFAULT NULL,
  `parametro_id` int(10) UNSIGNED DEFAULT NULL,
  `profesor_id` int(10) UNSIGNED DEFAULT NULL,
  `plan_estudio_id` int(10) UNSIGNED DEFAULT NULL,
  `cu_tipo` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`cu_id`, `periodo_id`, `aula_id`, `parametro_id`, `profesor_id`, `plan_estudio_id`, `cu_tipo`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 13, 10, 1, '2018-03-13 05:44:58', '2018-06-29 18:36:58'),
(2, 1, 2, 2, 5, 6, 1, '2018-03-14 02:19:20', '2018-03-14 02:19:20'),
(3, 1, 3, 7, 2, 6, 1, '2018-03-14 02:19:57', '2018-03-14 02:19:57'),
(7, 1, NULL, NULL, 1, NULL, 2, '2018-03-19 05:54:23', '2018-03-19 05:54:23'),
(8, 1, 4, 8, 7, 9, 1, '2018-03-27 05:22:47', '2018-03-27 05:22:47'),
(9, 2, 1, 1, 1, 6, 1, '2018-06-25 08:11:25', '2018-06-25 08:11:25'),
(10, 2, 2, 2, 3, 6, 1, '2018-06-25 08:13:35', '2018-06-25 08:13:35'),
(11, 2, 3, 3, 4, 8, 1, '2018-06-25 08:39:03', '2018-06-25 08:39:03'),
(12, 2, 1, NULL, 1, NULL, 2, '2018-06-27 10:40:32', '2018-06-27 10:40:32'),
(13, 3, 2, 7, 11, 8, 1, '2018-06-29 10:00:20', '2018-06-29 10:00:20'),
(14, 5, 2, 8, 7, 9, 1, '2018-06-29 10:21:26', '2018-06-29 10:21:26'),
(15, 1, 5, 9, 11, 9, 1, '2018-06-29 11:00:32', '2018-06-29 11:00:32'),
(16, 1, 4, NULL, 13, NULL, 2, '2018-06-29 18:48:04', '2018-06-29 18:48:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pauta`
--

CREATE TABLE `detalle_pauta` (
  `dp_id` int(10) UNSIGNED NOT NULL,
  `grupopauta_id` int(10) UNSIGNED NOT NULL,
  `dp_descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_pauta`
--

INSERT INTO `detalle_pauta` (`dp_id`, `grupopauta_id`, `dp_descripcion`, `created_at`, `updated_at`) VALUES
(1, 1, 'Desarrollar habitos de higiene personal, respetando y valorando la vida y el cuerpo humano', '2017-07-14 20:41:06', '2017-07-14 20:41:06'),
(2, 1, 'Se mantiene atento, participativo y colaborador en clases', '2017-07-14 20:48:24', '2017-07-14 20:48:24'),
(3, 1, 'Evidencia una adecuada autoestima, confianza en si mismo y un sentido positivo de la vida', '2017-07-14 20:52:44', '2017-07-14 20:52:44'),
(4, 2, 'Expone sus ideas, opiniones y sentimientos de manera coherente y fundamentada', '2017-07-14 20:57:51', '2018-03-23 16:47:17'),
(5, 2, 'Aborda diversas situaciones de su vida de manera reflexiva, con disposición de crítica y autocrítica', '2017-07-14 20:59:13', '2017-07-14 20:59:13'),
(6, 2, 'Analiza e interpreta la información, lo que le permite monitorear y evaluar su propio aprendizaje 23', '2017-07-14 21:03:55', '2018-03-23 16:47:29'),
(7, 3, 'Acepta opiniones de los demás, aunque no concuerden con la suya', '2017-07-14 21:04:45', '2017-07-14 21:04:45'),
(8, 3, 'Conoce, respeta y defiende la igualdad de derechos esenciales de todas las personas', '2017-07-14 21:05:22', '2017-07-14 21:05:22'),
(9, 3, 'Actúa en forma generosa y solidaria, respetando la justicia, la verdad y el bien común', '2017-07-14 21:06:14', '2017-07-14 21:06:14'),
(10, 4, 'Participa solidaria y responsablemente en actividades del establecimiento, familia y comunidad', '2017-07-14 21:07:23', '2017-07-14 21:07:23'),
(11, 4, 'Es perseverante y riguroso en el cumplimiento de sus tareas y trabajos escolares', '2017-07-14 21:08:00', '2017-07-14 21:08:00'),
(12, 4, 'Trabaja en equipo, con aportes creativos, que incluyen la protección del entorno y sus recursos', '2017-07-14 21:08:51', '2017-07-14 21:08:51'),
(13, 5, 'Utiliza consciente y responsablemente las tecnologías de la información y la computación', '2017-07-14 21:09:40', '2017-07-14 21:09:40'),
(14, 5, 'Evalúa la pertinencia y calidad de la información de diversas fuentes virtuales', '2017-07-14 21:10:32', '2017-07-14 21:10:32'),
(15, 5, 'Utiliza adecuadamente en sus trabajos escolares, las aplicaciones y programas de que dispone', '2017-07-14 21:11:13', '2017-07-14 21:11:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dias`
--

CREATE TABLE `dias` (
  `di_id` int(10) UNSIGNED NOT NULL,
  `di_nombre` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `dias`
--

INSERT INTO `dias` (`di_id`, `di_nombre`, `created_at`, `updated_at`) VALUES
(1, 'Lunes', NULL, NULL),
(2, 'Martes', NULL, NULL),
(3, 'Miercoles', NULL, NULL),
(4, 'Jueves', NULL, NULL),
(5, 'Viernes', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dia_clase`
--

CREATE TABLE `dia_clase` (
  `dc_id` int(10) UNSIGNED NOT NULL,
  `semestre_id` int(10) UNSIGNED NOT NULL,
  `dc_fecha` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `dia_clase`
--

INSERT INTO `dia_clase` (`dc_id`, `semestre_id`, `dc_fecha`, `created_at`, `updated_at`) VALUES
(1, 1, '2017-06-01', '2018-03-22 05:11:01', '2018-03-22 05:11:01'),
(2, 1, '2017-06-06', '2018-03-22 05:11:01', '2018-03-22 05:11:01'),
(3, 1, '2017-05-02', '2018-03-22 06:20:28', '2018-03-22 06:20:28'),
(4, 1, '2017-05-04', '2018-03-22 06:20:28', '2018-03-22 06:20:28'),
(5, 1, '2017-05-08', '2018-03-22 06:20:28', '2018-03-22 06:20:28'),
(6, 1, '2017-05-09', '2018-03-27 08:22:03', '2018-03-27 08:22:03'),
(7, 1, '2017-05-11', '2018-03-27 08:22:03', '2018-03-27 08:22:03'),
(8, 1, '2017-05-16', '2018-03-27 08:22:03', '2018-03-27 08:22:03'),
(9, 2, '2017-09-05', '2018-03-27 08:22:48', '2018-03-27 08:22:48'),
(10, 2, '2017-09-07', '2018-03-27 08:22:48', '2018-03-27 08:22:48'),
(11, 1, '2017-05-01', '2018-03-27 08:24:03', '2018-03-27 08:24:03'),
(12, 1, '2017-05-03', '2018-03-27 08:24:03', '2018-03-27 08:24:03'),
(13, 1, '2017-03-06', '2018-03-28 02:31:48', '2018-03-28 02:31:48'),
(14, 1, '2017-03-08', '2018-03-28 02:31:48', '2018-03-28 02:31:48'),
(15, 1, '2017-03-10', '2018-03-28 02:31:48', '2018-03-28 02:31:48'),
(16, 2, '2017-07-31', '2018-04-05 02:08:18', '2018-04-05 02:08:18'),
(17, 2, '2017-08-07', '2018-04-05 02:08:44', '2018-04-05 02:08:44'),
(18, 2, '2017-08-14', '2018-04-05 03:16:40', '2018-04-05 03:16:40'),
(19, 1, '2017-03-07', '2018-04-23 02:50:36', '2018-04-23 02:50:36'),
(20, 1, '2017-03-09', '2018-04-23 02:50:36', '2018-04-23 02:50:36'),
(21, 3, '2014-03-03', '2018-06-27 05:19:25', '2018-06-27 05:19:25'),
(22, 3, '2014-03-05', '2018-06-27 05:19:25', '2018-06-27 05:19:25'),
(23, 3, '2014-03-07', '2018-06-27 05:19:25', '2018-06-27 05:19:25'),
(24, 3, '2014-04-02', '2018-06-27 05:20:22', '2018-06-27 05:20:22'),
(25, 3, '2014-04-04', '2018-06-27 05:20:22', '2018-06-27 05:20:22'),
(26, 3, '2014-05-02', '2018-06-27 05:21:59', '2018-06-27 05:21:59'),
(27, 3, '2014-05-05', '2018-06-27 05:21:59', '2018-06-27 05:21:59'),
(28, 3, '2014-05-07', '2018-06-27 05:21:59', '2018-06-27 05:21:59'),
(29, 3, '2014-05-09', '2018-06-27 05:21:59', '2018-06-27 05:21:59'),
(30, 3, '2014-06-05', '2018-06-27 05:40:08', '2018-06-27 05:40:08'),
(31, 3, '2014-03-04', '2018-06-27 05:42:00', '2018-06-27 05:42:00'),
(32, 3, '2014-03-06', '2018-06-27 05:42:01', '2018-06-27 05:42:01'),
(33, 3, '2014-03-11', '2018-06-27 05:42:01', '2018-06-27 05:42:01'),
(34, 3, '2014-03-13', '2018-06-27 05:42:01', '2018-06-27 05:42:01'),
(35, 3, '2014-03-20', '2018-06-27 05:43:03', '2018-06-27 05:43:03'),
(36, 3, '2014-03-27', '2018-06-27 05:43:03', '2018-06-27 05:43:03'),
(37, 3, '2014-03-12', '2018-06-27 05:44:59', '2018-06-27 05:44:59'),
(38, 3, '2014-03-19', '2018-06-27 05:44:59', '2018-06-27 05:44:59'),
(39, 4, '2014-08-06', '2018-06-27 06:38:13', '2018-06-27 06:38:13'),
(40, 4, '2014-08-08', '2018-06-27 06:38:14', '2018-06-27 06:38:14'),
(41, 4, '2014-08-11', '2018-06-27 06:38:14', '2018-06-27 06:38:14'),
(42, 4, '2014-07-28', '2018-06-27 06:39:13', '2018-06-27 06:39:13'),
(43, 4, '2014-07-30', '2018-06-27 06:39:13', '2018-06-27 06:39:13'),
(44, 4, '2014-09-02', '2018-06-27 06:41:00', '2018-06-27 06:41:00'),
(45, 4, '2014-09-05', '2018-06-27 06:41:00', '2018-06-27 06:41:00'),
(46, 4, '2014-09-09', '2018-06-27 06:41:00', '2018-06-27 06:41:00'),
(47, 4, '2014-09-11', '2018-06-27 06:41:00', '2018-06-27 06:41:00'),
(48, 4, '2014-08-07', '2018-06-27 06:42:38', '2018-06-27 06:42:38'),
(49, 4, '2014-08-14', '2018-06-27 06:42:38', '2018-06-27 06:42:38'),
(50, 4, '2014-08-21', '2018-06-27 06:42:38', '2018-06-27 06:42:38'),
(51, 3, '2014-05-06', '2018-06-29 09:09:59', '2018-06-29 09:09:59'),
(52, 3, '2014-05-08', '2018-06-29 09:09:59', '2018-06-29 09:09:59'),
(53, 3, '2014-05-12', '2018-06-29 09:09:59', '2018-06-29 09:09:59'),
(54, 4, '2014-10-08', '2018-06-29 09:12:45', '2018-06-29 09:12:45'),
(55, 4, '2014-10-10', '2018-06-29 09:12:45', '2018-06-29 09:12:45'),
(56, 4, '2014-10-13', '2018-06-29 09:12:45', '2018-06-29 09:12:45'),
(57, 4, '2014-10-16', '2018-06-29 09:12:45', '2018-06-29 09:12:45'),
(58, 3, '2014-07-02', '2018-06-29 09:15:46', '2018-06-29 09:15:46'),
(59, 3, '2014-07-04', '2018-06-29 09:15:46', '2018-06-29 09:15:46'),
(60, 3, '2014-07-07', '2018-06-29 09:15:46', '2018-06-29 09:15:46'),
(61, 3, '2014-07-09', '2018-06-29 09:15:46', '2018-06-29 09:15:46'),
(62, 3, '2014-07-11', '2018-06-29 09:15:46', '2018-06-29 09:15:46'),
(63, 4, '2014-11-05', '2018-06-29 09:18:02', '2018-06-29 09:18:02'),
(64, 4, '2014-11-07', '2018-06-29 09:18:02', '2018-06-29 09:18:02'),
(65, 4, '2014-11-11', '2018-06-29 09:18:02', '2018-06-29 09:18:02'),
(66, 3, '2014-03-10', '2018-06-29 09:19:25', '2018-06-29 09:19:25'),
(67, 3, '2014-05-16', '2018-06-29 09:20:09', '2018-06-29 09:20:09'),
(68, 4, '2014-09-03', '2018-06-29 09:21:19', '2018-06-29 09:21:19'),
(69, 4, '2014-09-10', '2018-06-29 09:21:19', '2018-06-29 09:21:19'),
(70, 4, '2014-09-17', '2018-06-29 09:21:19', '2018-06-29 09:21:19'),
(71, 4, '2014-12-03', '2018-06-29 09:21:44', '2018-06-29 09:21:44'),
(72, 5, '2015-04-02', '2018-06-29 10:07:39', '2018-06-29 10:07:39'),
(73, 5, '2015-04-08', '2018-06-29 10:07:39', '2018-06-29 10:07:39'),
(74, 5, '2015-07-08', '2018-06-29 10:08:02', '2018-06-29 10:08:02'),
(75, 5, '2015-07-17', '2018-06-29 10:08:02', '2018-06-29 10:08:02'),
(76, 5, '2015-03-11', '2018-06-29 10:09:53', '2018-06-29 10:09:53'),
(77, 5, '2015-03-13', '2018-06-29 10:09:53', '2018-06-29 10:09:53'),
(78, 7, '2016-03-08', '2018-06-29 10:35:33', '2018-06-29 10:35:33'),
(79, 7, '2016-03-10', '2018-06-29 10:35:33', '2018-06-29 10:35:33'),
(80, 7, '2016-03-11', '2018-06-29 10:35:33', '2018-06-29 10:35:33'),
(81, 7, '2016-06-07', '2018-06-29 10:36:30', '2018-06-29 10:36:30'),
(82, 7, '2016-06-09', '2018-06-29 10:36:30', '2018-06-29 10:36:30'),
(83, 8, '2016-07-27', '2018-06-29 10:37:08', '2018-06-29 10:37:08'),
(84, 8, '2016-07-29', '2018-06-29 10:37:08', '2018-06-29 10:37:08'),
(85, 8, '2016-11-02', '2018-06-29 10:37:41', '2018-06-29 10:37:41'),
(86, 8, '2016-11-03', '2018-06-29 10:37:41', '2018-06-29 10:37:41'),
(87, 7, '2016-03-07', '2018-06-29 10:38:35', '2018-06-29 10:38:35'),
(88, 7, '2016-03-09', '2018-06-29 10:38:35', '2018-06-29 10:38:35'),
(89, 7, '2016-04-05', '2018-06-29 10:39:07', '2018-06-29 10:39:07'),
(90, 7, '2016-04-07', '2018-06-29 10:39:08', '2018-06-29 10:39:08'),
(91, 8, '2016-12-06', '2018-06-29 10:40:34', '2018-06-29 10:40:34'),
(92, 8, '2016-12-08', '2018-06-29 10:40:34', '2018-06-29 10:40:34'),
(93, 8, '2016-12-09', '2018-06-29 10:40:34', '2018-06-29 10:40:34'),
(94, 1, '2017-05-05', '2018-06-29 11:16:28', '2018-06-29 11:16:28'),
(95, 1, '2017-07-12', '2018-06-29 11:17:02', '2018-06-29 11:17:02'),
(96, 1, '2017-07-14', '2018-06-29 11:17:02', '2018-06-29 11:17:02'),
(97, 2, '2017-08-02', '2018-06-29 11:18:03', '2018-06-29 11:18:03'),
(98, 2, '2017-08-04', '2018-06-29 11:18:03', '2018-06-29 11:18:03'),
(99, 2, '2017-11-01', '2018-06-29 11:18:38', '2018-06-29 11:18:38'),
(100, 2, '2017-11-02', '2018-06-29 11:18:38', '2018-06-29 11:18:38'),
(101, 1, '2017-06-07', '2018-06-29 11:23:05', '2018-06-29 11:23:05'),
(102, 1, '2017-06-09', '2018-06-29 11:23:05', '2018-06-29 11:23:05'),
(103, 2, '2017-09-06', '2018-06-29 11:23:40', '2018-06-29 11:23:40'),
(104, 2, '2017-11-03', '2018-06-29 11:24:16', '2018-06-29 11:24:16'),
(105, 2, '2017-12-06', '2018-06-29 11:28:40', '2018-06-29 11:28:40'),
(106, 1, '2017-03-13', '2018-06-29 11:29:44', '2018-06-29 11:29:44'),
(107, 1, '2017-07-13', '2018-06-29 11:30:08', '2018-06-29 11:30:08'),
(108, 2, '2017-08-10', '2018-06-29 11:30:44', '2018-06-29 11:30:44'),
(109, 2, '2017-11-16', '2018-06-29 11:31:05', '2018-06-29 11:31:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `educacion_hermanos`
--

CREATE TABLE `educacion_hermanos` (
  `edh_id` int(10) UNSIGNED NOT NULL,
  `matricula_id` int(10) UNSIGNED NOT NULL,
  `edh_cantidad` int(11) NOT NULL,
  `edh_descripcion` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enfermedades`
--

CREATE TABLE `enfermedades` (
  `enf_id` int(10) UNSIGNED NOT NULL,
  `matricula_id` int(10) UNSIGNED NOT NULL,
  `enf_nombre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `enfermedades`
--

INSERT INTO `enfermedades` (`enf_id`, `matricula_id`, `enf_nombre`, `created_at`, `updated_at`) VALUES
(1, 9, 'enfermedad1', '2017-11-28 01:30:02', '2017-11-28 01:30:02'),
(2, 9, 'enfermedad2', '2017-11-28 01:30:02', '2017-11-28 01:30:02'),
(3, 9, 'enfermedad3', '2017-11-28 01:30:02', '2017-11-28 01:30:02'),
(4, 10, 'enfermedad12', '2018-02-06 03:33:42', '2018-02-06 03:33:42'),
(5, 11, 'enf134', '2018-02-06 06:22:39', '2018-02-06 06:22:39'),
(6, 12, 'asma', '2018-02-20 02:02:04', '2018-02-20 02:02:04'),
(7, 13, 'síndrome de asperger', '2018-03-02 05:47:20', '2018-03-02 05:47:20'),
(8, 14, 'enfermedad 1', '2018-03-25 01:36:58', '2018-03-25 01:36:58'),
(9, 16, 'asma', '2018-06-22 08:42:57', '2018-06-22 08:42:57'),
(10, 16, 'asperger', '2018-06-22 08:42:57', '2018-06-22 08:42:57'),
(11, 15, 'asma', '2018-06-22 18:21:51', '2018-06-22 18:21:51'),
(12, 16, 'asperger', '2018-06-24 06:33:05', '2018-06-24 06:33:05'),
(13, 17, 'asma', '2018-06-24 06:37:55', '2018-06-24 06:37:55'),
(14, 24, 'asma', '2018-06-28 21:03:35', '2018-06-28 21:03:35'),
(15, 31, 'Anemia', '2018-06-29 08:35:12', '2018-06-29 08:35:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ensayo`
--

CREATE TABLE `ensayo` (
  `ens_id` int(10) UNSIGNED NOT NULL,
  `periodo_id` int(10) UNSIGNED NOT NULL,
  `tipo_id` int(10) UNSIGNED NOT NULL,
  `materia_id` int(10) UNSIGNED NOT NULL,
  `ens_grado_curso` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ens_fecha` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ensayo`
--

INSERT INTO `ensayo` (`ens_id`, `periodo_id`, `tipo_id`, `materia_id`, `ens_grado_curso`, `ens_fecha`, `created_at`, `updated_at`) VALUES
(3, 1, 2, 7, NULL, '2018-03-08', '2018-03-18 15:02:52', '2018-03-18 15:02:52'),
(5, 1, 1, 7, NULL, '2018-03-18', '2018-03-18 16:09:59', '2018-03-18 16:09:59'),
(6, 1, 1, 7, NULL, '2018-05-02', '2018-05-10 05:27:27', '2018-05-10 05:27:27'),
(7, 2, 1, 7, NULL, '2014-09-03', '2018-06-27 08:46:10', '2018-06-27 08:46:10'),
(8, 2, 2, 8, NULL, '2014-05-05', '2018-06-27 10:31:07', '2018-06-27 10:31:07'),
(9, 1, 1, 8, NULL, '2018-06-22', '2018-06-29 18:26:38', '2018-06-29 18:26:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `establecimiento_anterior`
--

CREATE TABLE `establecimiento_anterior` (
  `eant_id` int(10) UNSIGNED NOT NULL,
  `eant_nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `establecimiento_anterior`
--

INSERT INTO `establecimiento_anterior` (`eant_id`, `eant_nombre`, `created_at`, `updated_at`) VALUES
(1, 'colegio2', '2017-06-17 14:16:28', '2017-06-17 14:16:28'),
(2, 'Colegio 5', '2017-11-16 21:30:16', '2017-11-16 21:30:16'),
(3, 'Colegio Adelaida Migueles Soto', '2018-02-06 03:33:42', '2018-02-06 03:33:42'),
(4, 'Liceo de Coronel', '2018-02-06 06:22:39', '2018-02-06 06:22:39'),
(5, 'Liceo Comercial Andrés Bello', '2018-03-02 05:47:20', '2018-03-02 05:47:20'),
(6, 'Liceo xxx', '2018-06-21 09:37:58', '2018-06-21 09:37:58'),
(8, 'Liceo de prueba', '2018-06-21 09:40:24', '2018-06-21 09:40:24'),
(9, 'Colegio Amanecer', '2018-06-29 08:14:29', '2018-06-29 08:14:29'),
(10, 'Liceo de Lota', '2018-06-29 08:35:12', '2018-06-29 08:35:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eva_comportamiento`
--

CREATE TABLE `eva_comportamiento` (
  `id` int(10) UNSIGNED NOT NULL,
  `matricula_id` int(10) UNSIGNED NOT NULL,
  `detallepauta_id` int(10) UNSIGNED NOT NULL,
  `concepto_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `eva_comportamiento`
--

INSERT INTO `eva_comportamiento` (`id`, `matricula_id`, `detallepauta_id`, `concepto_id`, `created_at`, `updated_at`) VALUES
(1, 12, 1, 1, NULL, NULL),
(2, 12, 2, 1, NULL, NULL),
(3, 12, 3, 1, NULL, NULL),
(4, 12, 4, 2, NULL, NULL),
(5, 12, 5, 2, NULL, NULL),
(6, 12, 6, 3, NULL, NULL),
(7, 12, 7, 3, NULL, NULL),
(8, 1, 1, 2, NULL, NULL),
(9, 1, 2, 4, NULL, NULL),
(10, 1, 3, 2, NULL, NULL),
(11, 1, 4, 1, NULL, NULL),
(12, 1, 5, 2, NULL, NULL),
(13, 1, 6, 2, NULL, NULL),
(14, 4, 1, 1, NULL, NULL),
(15, 4, 2, 1, NULL, NULL),
(16, 4, 3, 4, NULL, NULL),
(17, 10, 2, 1, NULL, NULL),
(18, 2, 1, 1, NULL, NULL),
(19, 2, 2, 3, NULL, NULL),
(20, 2, 3, 4, NULL, NULL),
(21, 1, 7, 1, NULL, NULL),
(22, 1, 8, 2, NULL, NULL),
(23, 1, 9, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `fac_id` int(10) UNSIGNED NOT NULL,
  `orden_id` int(10) UNSIGNED NOT NULL,
  `responsable_id` int(10) UNSIGNED NOT NULL,
  `fac_numero` int(11) NOT NULL,
  `fac_fecha` date NOT NULL,
  `fac_costo_total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`fac_id`, `orden_id`, `responsable_id`, `fac_numero`, `fac_fecha`, `fac_costo_total`, `created_at`, `updated_at`) VALUES
(3, 1, 1, 1, '2018-03-22', 11400, '2018-03-28 07:52:54', '2018-03-28 07:52:54'),
(4, 2, 1, 2, '2018-04-17', 12000, '2018-04-17 18:48:20', '2018-04-17 18:48:20'),
(5, 1, 1, 3, '2018-05-22', 55, '2018-05-23 01:47:14', '2018-05-23 01:47:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_pauta`
--

CREATE TABLE `grupo_pauta` (
  `gp_id` int(10) UNSIGNED NOT NULL,
  `gp_descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `grupo_pauta`
--

INSERT INTO `grupo_pauta` (`gp_id`, `gp_descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Crecimiento y Auto afirmación Personal', '2017-07-14 20:12:24', '2018-03-23 07:37:22'),
(2, 'Desarrollo del Pensamiento', '2017-07-14 20:50:30', '2018-03-23 07:37:13'),
(3, 'Formación Ética', '2017-07-14 20:50:49', '2017-07-14 20:50:49'),
(4, 'La persona y su entorno', '2017-07-14 20:51:09', '2017-07-14 20:51:09'),
(5, 'Tecnologías de la Información y Comunicación', '2017-07-14 20:51:40', '2017-07-14 20:51:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `hor_id` int(10) UNSIGNED NOT NULL,
  `clases_id` int(10) UNSIGNED NOT NULL,
  `hora_id` int(10) UNSIGNED NOT NULL,
  `dia_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`hor_id`, `clases_id`, `hora_id`, `dia_id`, `created_at`, `updated_at`) VALUES
(2, 2, 1, 2, '2018-05-27 03:07:34', '2018-05-27 03:07:34'),
(4, 2, 2, 2, '2018-05-27 03:07:34', '2018-05-27 03:07:34'),
(5, 2, 3, 1, '2018-05-27 03:07:34', '2018-05-27 05:48:51'),
(7, 2, 4, 1, '2018-05-27 03:07:34', '2018-05-27 05:48:51'),
(9, 2, 1, 1, '2018-05-27 04:38:21', '2018-05-27 05:48:51'),
(10, 2, 2, 1, '2018-05-27 04:38:21', '2018-05-27 05:48:51'),
(13, 1, 1, 4, '2018-05-27 05:53:19', '2018-05-27 05:53:19'),
(14, 1, 1, 5, '2018-05-27 05:53:19', '2018-05-27 05:53:19'),
(15, 3, 1, 1, '2018-05-27 06:34:09', '2018-05-27 06:34:09'),
(16, 3, 2, 1, '2018-05-27 06:34:09', '2018-05-27 06:34:09'),
(19, 4, 3, 4, '2018-05-28 02:13:09', '2018-05-28 02:13:09'),
(20, 4, 4, 4, '2018-05-28 02:13:09', '2018-05-28 02:13:09'),
(21, 3, 3, 3, '2018-05-28 02:13:27', '2018-05-28 02:13:27'),
(22, 3, 4, 3, '2018-05-28 02:13:27', '2018-05-28 02:13:27'),
(23, 3, 5, 4, '2018-05-28 09:42:30', '2018-05-28 09:42:30'),
(24, 3, 6, 4, '2018-05-28 09:42:30', '2018-05-28 09:42:30'),
(25, 6, 1, 3, '2018-06-15 09:57:00', '2018-06-15 09:57:00'),
(26, 6, 2, 3, '2018-06-15 09:57:00', '2018-06-15 09:57:00'),
(27, 4, 2, 5, '2018-06-22 09:37:46', '2018-06-22 09:37:46'),
(28, 2, 3, 3, '2018-06-22 09:37:47', '2018-06-22 09:37:47'),
(29, 4, 3, 5, '2018-06-22 09:37:47', '2018-06-22 09:37:47'),
(30, 2, 4, 3, '2018-06-22 09:37:47', '2018-06-22 09:37:47'),
(31, 3, 5, 1, '2018-06-22 09:38:17', '2018-06-22 09:38:17'),
(32, 3, 6, 1, '2018-06-22 09:38:17', '2018-06-22 09:38:17'),
(33, 1, 3, 2, '2018-06-29 18:39:43', '2018-06-29 18:39:43'),
(34, 1, 4, 2, '2018-06-29 18:39:43', '2018-06-29 18:39:43'),
(35, 4, 4, 5, '2018-06-29 18:39:43', '2018-06-29 18:39:43'),
(36, 1, 5, 3, '2018-06-29 18:39:43', '2018-06-29 18:39:43'),
(37, 4, 5, 5, '2018-06-29 18:39:43', '2018-06-29 18:39:43'),
(38, 1, 6, 3, '2018-06-29 18:39:43', '2018-06-29 18:39:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horas`
--

CREATE TABLE `horas` (
  `hors_id` int(10) UNSIGNED NOT NULL,
  `periodo_id` int(10) UNSIGNED NOT NULL,
  `hors_numero` int(10) UNSIGNED NOT NULL,
  `hors_hora_inicio` time NOT NULL,
  `hors_hora_termino` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `horas`
--

INSERT INTO `horas` (`hors_id`, `periodo_id`, `hors_numero`, `hors_hora_inicio`, `hors_hora_termino`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '08:00:00', '08:45:00', '2018-04-05 06:58:53', '2018-04-05 06:58:53'),
(2, 1, 2, '08:45:00', '09:30:00', '2018-04-06 00:58:08', '2018-04-06 00:58:08'),
(3, 1, 3, '09:50:00', '10:35:00', '2018-04-06 01:00:19', '2018-04-06 01:00:19'),
(4, 1, 4, '10:35:00', '11:20:00', '2018-04-06 01:00:44', '2018-04-06 01:00:44'),
(5, 1, 5, '11:30:00', '12:15:00', '2018-04-06 01:01:05', '2018-04-06 01:01:05'),
(6, 1, 6, '12:15:00', '13:00:00', '2018-04-06 01:01:38', '2018-04-06 01:01:38'),
(7, 1, 7, '13:45:00', '14:30:00', '2018-04-06 01:02:10', '2018-04-06 01:02:10'),
(8, 1, 8, '14:30:00', '15:15:00', '2018-04-06 01:02:32', '2018-04-06 01:02:32'),
(9, 1, 9, '15:20:00', '16:05:00', '2018-04-06 01:02:53', '2018-04-06 01:02:53'),
(10, 2, 1, '08:00:00', '09:30:00', '2018-06-26 08:45:41', '2018-06-26 08:45:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horas_horario`
--

CREATE TABLE `horas_horario` (
  `id` int(10) UNSIGNED NOT NULL,
  `horas_id` int(10) UNSIGNED NOT NULL,
  `horario_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucion`
--

CREATE TABLE `institucion` (
  `inst_id` int(10) UNSIGNED NOT NULL,
  `inst_nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `institucion`
--

INSERT INTO `institucion` (`inst_id`, `inst_nombre`, `created_at`, `updated_at`) VALUES
(1, 'Universidad del Bio-Bio', '2017-11-01 22:09:52', '2017-11-01 22:09:52'),
(7, 'Universidad de Concepción', '2018-02-24 09:35:16', '2018-02-24 09:35:16'),
(8, 'Universidad Federico Santa María', '2018-06-22 00:35:40', '2018-06-22 00:35:40'),
(9, 'Prueba', '2018-06-22 00:54:39', '2018-06-22 00:54:39'),
(10, 'Segunda prueba', '2018-06-22 00:59:03', '2018-06-22 00:59:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `liceo`
--

CREATE TABLE `liceo` (
  `lic_id` int(10) UNSIGNED NOT NULL,
  `lic_rol_base_datos` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lic_fecha_resol_rec_ofic` int(11) DEFAULT NULL,
  `lic_numero_resol_rec_ofic` int(11) NOT NULL,
  `lic_logo` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lic_numero` int(11) NOT NULL,
  `lic_letra` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lic_nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lic_direccion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lic_jornada` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lic_semestres` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `liceo`
--

INSERT INTO `liceo` (`lic_id`, `lic_rol_base_datos`, `lic_fecha_resol_rec_ofic`, `lic_numero_resol_rec_ofic`, `lic_logo`, `lic_numero`, `lic_letra`, `lic_nombre`, `lic_direccion`, `lic_jornada`, `lic_semestres`, `created_at`, `updated_at`) VALUES
(1, '004951-4', 1988, 7460, 'logo_docs.png', 45, 'A', 'Carlos Cousiño Goyenechea', 'direccionLiceo', 'completa', 2, NULL, '2018-04-05 03:42:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea_articulo`
--

CREATE TABLE `linea_articulo` (
  `lart_id` int(10) UNSIGNED NOT NULL,
  `ordencompra_id` int(10) UNSIGNED NOT NULL,
  `articulo_item` int(11) NOT NULL,
  `lart_cantidad` int(10) UNSIGNED NOT NULL,
  `lart_costo` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `linea_articulo`
--

INSERT INTO `linea_articulo` (`lart_id`, `ordencompra_id`, `articulo_item`, `lart_cantidad`, `lart_costo`, `created_at`, `updated_at`) VALUES
(1, 1, 101, 12, 24000, '2018-03-18 20:16:48', '2018-03-18 20:16:48'),
(2, 1, 102, 4, 400, '2018-03-18 20:16:48', '2018-03-18 20:16:48'),
(3, 1, 301, 1, 2300, '2018-03-18 20:16:48', '2018-03-18 20:16:48'),
(4, 2, 101, 3, 2000, '2018-04-17 18:47:14', '2018-04-17 18:47:14'),
(5, 2, 103, 2, 4000, '2018-04-17 18:47:14', '2018-04-17 18:47:14'),
(6, 2, 102, 5, 10000, '2018-04-17 18:47:14', '2018-04-17 18:47:14'),
(7, 3, 201, 1, 0, '2018-06-29 17:02:40', '2018-06-29 17:02:40'),
(8, 3, 101, 1, 0, '2018-06-29 17:02:40', '2018-06-29 17:02:40'),
(9, 3, 103, 1, 0, '2018-06-29 17:02:40', '2018-06-29 17:02:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia_ensayos`
--

CREATE TABLE `materia_ensayos` (
  `mens_id` int(10) UNSIGNED NOT NULL,
  `mens_nombre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `materia_ensayos`
--

INSERT INTO `materia_ensayos` (`mens_id`, `mens_nombre`, `created_at`, `updated_at`) VALUES
(7, 'Lenguaje', '2017-09-01 07:46:20', '2017-09-01 07:46:20'),
(8, 'Matemáticas', '2017-09-01 07:47:37', '2017-09-01 07:47:37'),
(9, 'Biología', '2017-09-01 07:48:02', '2017-09-01 07:48:02'),
(10, 'Química', '2017-09-01 07:48:25', '2017-09-01 07:48:25'),
(11, 'Historia', '2017-09-01 07:49:12', '2017-09-01 07:49:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula`
--

CREATE TABLE `matricula` (
  `mat_id` int(10) UNSIGNED NOT NULL,
  `alumno_rut` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `est_anterior_id` int(10) UNSIGNED DEFAULT NULL,
  `periodo_id` int(10) UNSIGNED NOT NULL,
  `mat_numero` int(10) UNSIGNED DEFAULT NULL,
  `mat_prom_general` double(8,2) DEFAULT NULL,
  `mat_grado_curso` tinyint(1) NOT NULL,
  `mat_tipo_alumno` tinyint(1) NOT NULL,
  `mat_estado` tinyint(1) NOT NULL,
  `mat_fecha_ingreso` date NOT NULL,
  `mat_fecha_retiro` date DEFAULT NULL,
  `mat_motivo` text COLLATE utf8mb4_unicode_ci,
  `mat_observacion` text COLLATE utf8mb4_unicode_ci,
  `mat_prom_ingreso` double(8,2) NOT NULL,
  `mat_posicion_lista` int(11) DEFAULT NULL,
  `mat_condicional` tinyint(1) DEFAULT NULL,
  `mat_causas_cond` text COLLATE utf8mb4_unicode_ci,
  `mat_clases_religion` tinyint(1) DEFAULT NULL,
  `mat_apod_retira` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mat_sit_padres` tinyint(1) NOT NULL,
  `mat_convive` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mat_cant_hermanos` int(11) NOT NULL,
  `mat_prom_asis` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `matricula`
--

INSERT INTO `matricula` (`mat_id`, `alumno_rut`, `est_anterior_id`, `periodo_id`, `mat_numero`, `mat_prom_general`, `mat_grado_curso`, `mat_tipo_alumno`, `mat_estado`, `mat_fecha_ingreso`, `mat_fecha_retiro`, `mat_motivo`, `mat_observacion`, `mat_prom_ingreso`, `mat_posicion_lista`, `mat_condicional`, `mat_causas_cond`, `mat_clases_religion`, `mat_apod_retira`, `mat_sit_padres`, `mat_convive`, `mat_cant_hermanos`, `mat_prom_asis`, `created_at`, `updated_at`) VALUES
(1, '51.111.111-5', NULL, 1, 1, 4.30, 1, 0, 3, '2017-07-04', '2018-03-26', 'qweqwe', '', 5.00, 3, 0, '', 0, '', 0, 'padres', 0, NULL, '2017-06-06 20:31:07', '2018-06-29 18:42:42'),
(2, '22.222.222-2', 1, 1, 2, 4.00, 1, 1, 1, '2017-06-16', '2017-08-11', 'por weta', '', 5.00, 4, 0, NULL, 1, NULL, 1, 'padres', 0, 70, '2017-06-17 14:26:14', '2018-06-29 18:42:42'),
(4, '44.444.444-4', NULL, 1, 3, 4.30, 1, 2, 1, '2017-06-17', '2018-01-10', 'se pico a choro', '', 6.00, 6, 0, '0', 0, NULL, 0, 'padre', 0, 50, '2017-06-17 22:43:04', '2018-06-29 18:42:43'),
(6, '55.555.555-5', NULL, 1, 4, 0.00, 2, 2, 1, '2017-11-22', NULL, NULL, NULL, 6.00, 1, 0, NULL, 0, NULL, 1, 'padres', 1, 0, '2017-11-23 04:17:43', '2018-06-29 17:21:58'),
(7, '33.333.333-3', 2, 1, 5, 0.00, 2, 1, 1, '2017-11-23', NULL, NULL, NULL, 6.00, 2, 0, NULL, 0, NULL, 1, 'padres', 11, 0, '2017-11-23 23:05:55', '2018-06-29 17:21:58'),
(9, '12.121.212-1', 2, 1, 11, 0.00, 3, 1, 1, '2017-11-27', NULL, NULL, NULL, 6.50, 2, 0, NULL, 1, NULL, 1, 'padres', 1, 0, '2017-11-28 01:30:02', '2018-06-29 11:14:20'),
(10, '21.212.121-2', 3, 1, 7, 3.30, 1, 1, 1, '2018-02-05', NULL, NULL, NULL, 7.00, 1, 0, NULL, 1, NULL, 0, 'tio', 0, 37.5, '2018-02-06 03:33:42', '2018-06-29 18:42:42'),
(11, '14.141.414-1', 4, 1, 8, 0.00, 1, 1, 1, '2018-02-06', NULL, NULL, NULL, 7.00, 2, 1, NULL, 1, NULL, 1, 'padres', 0, 64.1, '2018-02-06 06:22:39', '2018-06-29 18:42:42'),
(12, '18.500.343-3', 4, 1, 9, 4.40, 1, 1, 1, '2018-02-19', NULL, NULL, NULL, 6.40, 1, 1, NULL, 1, NULL, 1, 'padres', 3, 50, '2018-02-20 02:02:04', '2018-06-29 17:21:43'),
(13, '17.794.500-3', 4, 1, 14, 5.00, 4, 1, 1, '2018-03-01', NULL, NULL, NULL, 6.50, 1, 0, NULL, 1, NULL, 1, 'padres', 0, 85.5, '2018-03-02 05:47:20', '2018-06-29 11:31:21'),
(14, '23.212.412-2', 4, 1, 12, 0.00, 3, 1, 1, '2018-03-24', NULL, NULL, NULL, 6.70, 1, 0, NULL, 1, NULL, 0, 'Tios', 0, 0, '2018-03-25 01:36:58', '2018-06-29 11:14:20'),
(15, '23.123.412-3', 4, 1, 13, 7.00, 1, 2, 1, '2018-06-08', NULL, NULL, NULL, 4.50, 5, 1, NULL, 0, NULL, 1, 'tios', 4, 0, '2018-06-22 18:21:51', '2018-06-29 18:42:42'),
(16, '11.111.111-1', 4, 2, 1, 5.30, 1, 2, 2, '2014-02-18', NULL, NULL, NULL, 6.50, 1, 0, NULL, 0, NULL, 1, 'tíos', 3, 70.8, '2018-06-24 06:33:05', '2018-06-29 09:31:53'),
(17, '21.111.111-1', 5, 2, 2, 6.00, 1, 2, 2, '2014-02-23', NULL, NULL, NULL, 6.30, 2, 1, 'causas condicional marcelo 1', 1, NULL, 0, 'tios', 4, 68.1, '2018-06-24 06:37:55', '2018-06-29 09:31:53'),
(18, '31.111.111-1', 3, 2, 3, 5.60, 1, 2, 2, '2014-02-20', NULL, NULL, NULL, 6.20, 3, 0, NULL, 1, NULL, 3, 'madre', 0, 65.3, '2018-06-24 06:44:50', '2018-06-29 09:31:53'),
(19, '41.111.111-1', 4, 2, 4, 5.40, 1, 2, 2, '2000-02-02', NULL, NULL, NULL, 6.60, 4, 0, NULL, 0, NULL, 2, 'padres', 1, 52.1, '2018-06-24 06:54:02', '2018-06-29 09:31:53'),
(20, '51.111.111-1', 5, 2, 5, 5.80, 1, 2, 2, '2014-02-15', NULL, NULL, NULL, 6.80, 5, 1, 'descripcion condicional felipe uno', 0, NULL, 0, 'padre', 2, 56.3, '2018-06-24 10:04:59', '2018-06-29 09:31:53'),
(22, '51.111.111-5', 8, 2, 6, 5.60, 1, 2, 2, '2014-02-02', NULL, NULL, NULL, 7.00, 5, 0, NULL, 1, NULL, 0, 'Tíos', 1, 74.6, '2018-06-25 05:59:50', '2018-06-29 17:17:46'),
(24, '12.111.111-1', 4, 2, 7, 5.20, 1, 2, 2, '2014-02-14', NULL, NULL, NULL, 6.00, 1, 1, 'descripcion condicional de javier', 0, NULL, 1, 'Tíos', 3, 71.3, '2018-06-28 21:03:35', '2018-06-29 17:17:46'),
(25, '22.111.111-2', 3, 2, 8, 5.50, 1, 2, 2, '2014-02-03', NULL, NULL, NULL, 5.80, 2, 0, NULL, 0, NULL, 1, 'Padrinos', 1, 82.3, '2018-06-28 21:06:56', '2018-06-29 17:17:46'),
(26, '32.111.111-3', 5, 2, 9, 5.60, 1, 2, 2, '2014-02-11', NULL, NULL, NULL, 6.70, 3, 0, NULL, 0, NULL, 1, 'Abuelos', 0, 77.9, '2018-06-28 21:10:49', '2018-06-29 17:17:46'),
(27, '31.111.111-3', 9, 2, 11, 5.40, 1, 1, 2, '2014-02-02', NULL, NULL, NULL, 6.00, 1, 1, 'condicional javier tres', 0, NULL, 0, 'Padrinos', 1, 90, '2018-06-29 08:14:29', '2018-06-29 17:18:02'),
(28, '24.111.111-2', 5, 2, 10, 5.50, 1, 2, 2, '2014-02-08', NULL, NULL, NULL, 5.70, 4, 0, NULL, 1, NULL, 1, 'tíos', 2, 75.1, '2018-06-29 08:18:35', '2018-06-29 17:17:46'),
(29, '33.111.111-3', 4, 2, 12, 5.50, 1, 2, 2, '2014-02-25', NULL, NULL, NULL, 5.50, 2, 0, NULL, 0, NULL, 2, 'padrinos', 0, 77.5, '2018-06-29 08:24:56', '2018-06-29 17:18:02'),
(30, '34.111.111-4', 3, 2, 13, 5.30, 1, 2, 2, '2014-01-26', NULL, NULL, NULL, 6.50, 3, 0, NULL, 1, NULL, 3, 'Madre', 0, 65, '2018-06-29 08:31:39', '2018-06-29 17:18:02'),
(31, '35.111.111-5', 10, 2, 14, 5.10, 1, 1, 2, '2014-02-03', NULL, NULL, NULL, 6.10, 4, 0, NULL, 0, NULL, 1, 'Tíos', 0, 80, '2018-06-29 08:35:12', '2018-06-29 17:18:02'),
(32, '36.111.111-6', 10, 2, 15, 5.30, 1, 2, 2, '2014-02-04', NULL, NULL, NULL, 6.40, 5, 0, NULL, 0, NULL, 3, 'Abuela', 1, 100, '2018-06-29 08:40:00', '2018-06-29 17:18:02'),
(33, '11.111.111-1', NULL, 3, 1, 4.90, 2, 2, 2, '2015-02-04', NULL, NULL, NULL, 5.30, NULL, 1, 'Nueva descripcion de condicional', 0, NULL, 1, 'Padres', 3, 33.3, '2018-06-29 09:48:51', '2018-06-29 10:10:23'),
(34, '21.111.111-1', NULL, 3, 2, 5.30, 2, 2, 3, '2015-02-14', '2015-05-05', 'motivo del retiro de marcelo dos', NULL, 6.00, NULL, 1, 'descripcion nueva condicional', 0, NULL, 0, 'tios', 4, 0, '2018-06-29 09:59:29', '2018-06-29 10:06:23'),
(35, '11.111.111-1', NULL, 5, 1, 5.40, 3, 2, 2, '2016-02-14', NULL, NULL, NULL, 4.90, 1, 1, 'se mantiene la condicionalidad', 0, NULL, 1, 'tios', 4, 94.4, '2018-06-29 10:15:38', '2018-06-29 10:44:49'),
(36, '31.111.111-1', 4, 5, 2, 5.30, 3, 2, 2, '2016-02-04', NULL, NULL, NULL, 5.60, 2, 0, NULL, 0, NULL, 3, 'Madre', 0, 81.7, '2018-06-29 10:18:25', '2018-06-29 10:44:49'),
(37, '41.111.111-1', 5, 5, 3, 5.40, 3, 2, 2, '2016-02-14', NULL, NULL, NULL, 5.60, 3, 1, 'nueva condicional', 0, NULL, 1, 'Padres', 1, 94.4, '2018-06-29 10:20:51', '2018-06-29 10:44:49'),
(38, '11.111.111-1', NULL, 1, 15, 5.50, 4, 2, 1, '2017-02-04', NULL, NULL, NULL, 5.40, 2, 0, NULL, 0, NULL, 1, 'Padres', 4, 80.9, '2018-06-29 10:50:49', '2018-06-29 11:31:21'),
(39, '31.111.111-1', NULL, 1, 16, 5.10, 4, 2, 1, '2017-02-05', NULL, NULL, NULL, 5.30, 3, 0, NULL, 0, NULL, 3, 'Madre', 0, 95, '2018-06-29 10:56:39', '2018-06-29 11:31:21'),
(40, '24.111.111-2', 10, 1, 17, 5.30, 4, 2, 1, '2017-04-03', NULL, NULL, NULL, 6.50, 4, 0, NULL, 0, NULL, 0, 'Tios', 0, 62.3, '2018-06-29 10:58:39', '2018-06-29 11:31:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2015_01_20_084450_create_roles_table', 1),
(4, '2015_01_20_084525_create_role_user_table', 1),
(5, '2015_01_24_080208_create_permissions_table', 1),
(6, '2015_01_24_080433_create_permission_role_table', 1),
(7, '2015_12_04_003040_add_special_role_column', 1),
(8, '2017_05_02_015635_create_table_region', 1),
(9, '2017_05_02_015644_create_table_ciudad', 1),
(10, '2017_05_02_015650_create_table_comuna', 1),
(11, '2017_05_02_232430_create_table_persona', 1),
(12, '2017_05_02_233428_create_table_padres', 1),
(13, '2017_05_02_233443_create_table_apoderado', 1),
(14, '2017_05_02_234521_create_table_alumno', 1),
(15, '2017_05_03_135847_create_table_cargo', 1),
(16, '2017_05_03_135924_create_table_institucion', 1),
(17, '2017_05_04_135659_create_table_personal', 1),
(18, '2017_05_04_140322_create_table_usuario', 1),
(19, '2017_05_04_142515_create_table_liceo', 1),
(20, '2017_05_04_142524_create_table_periodo_academico', 1),
(21, '2017_05_04_143220_create_table_establecimiento_anterior', 1),
(22, '2017_05_04_143400_create_table_matricula', 1),
(23, '2017_05_04_144322_create_table_aulas', 1),
(24, '2017_05_04_144348_create_table_parametro_cursos', 1),
(25, '2017_05_04_144410_create_table_plan_estudio', 2),
(26, '2017_05_04_144411_create_table_curso', 2),
(27, '2017_05_04_242421_create_table_educacion_hermanos', 2),
(28, '2017_05_05_142311_create_table_enfermedades', 2),
(29, '2017_05_17_211322_create_table_TipoArticulo', 2),
(30, '2017_05_17_211513_create_table_bodega', 2),
(31, '2017_05_17_211711_create_table_articulo', 2),
(32, '2017_05_18_005531_create_table_proveedores', 2),
(33, '2017_05_18_010451_create_table_orden_compra', 2),
(34, '2017_06_04_033818_create_table_linea_articulo', 2),
(35, '2017_06_07_200320_create_table_asignatura', 2),
(36, '2017_06_07_202647_create_table_clases', 2),
(37, '2017_06_07_211533_create_table_horario', 2),
(38, '2017_06_20_204615_create_table_nivel_cursos', 2),
(39, '2017_06_22_214449_create_table_conceptos', 2),
(40, '2017_07_02_162254_create_table_semestre', 2),
(41, '2017_07_02_174735_create_table_dia_clase', 2),
(42, '2017_07_03_200659_create_table_notas', 2),
(43, '2017_07_11_012142_create_table_clases_realizadas', 2),
(44, '2017_07_11_012543_create_table_asistencia', 2),
(45, '2017_08_09_210124_create_table_factura', 2),
(46, '2017_08_09_210535_create_table_recibo', 2),
(47, '2017_08_26_155238_create_table_tipo_ensayo', 2),
(48, '2017_08_26_155350_create_table_materia_ensayos', 2),
(49, '2017_08_27_155324_create_table_ensayo', 2),
(50, '2017_05_04_150844_create_table_alumno_esta', 3),
(51, '2018_04_05_023901_create_table_horas', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel_cursos`
--

CREATE TABLE `nivel_cursos` (
  `nic_id` int(10) UNSIGNED NOT NULL,
  `nic_nivel` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `nivel_cursos`
--

INSERT INTO `nivel_cursos` (`nic_id`, `nic_nivel`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL),
(2, 2, NULL, NULL),
(3, 3, NULL, NULL),
(4, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `not_id` int(10) UNSIGNED NOT NULL,
  `matricula_id` int(10) UNSIGNED NOT NULL,
  `semestre_id` int(10) UNSIGNED NOT NULL,
  `clase_id` int(10) UNSIGNED NOT NULL,
  `not_nota1` float DEFAULT NULL,
  `not_nota2` float DEFAULT NULL,
  `not_nota3` float DEFAULT NULL,
  `not_nota4` float DEFAULT NULL,
  `not_nota5` float DEFAULT NULL,
  `not_nota6` float DEFAULT NULL,
  `not_nota7` float DEFAULT NULL,
  `not_nota8` float DEFAULT NULL,
  `not_nota9` float DEFAULT NULL,
  `not_nota10` float DEFAULT NULL,
  `not_nota11` float DEFAULT NULL,
  `not_nota12` float DEFAULT NULL,
  `not_promedio` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`not_id`, `matricula_id`, `semestre_id`, `clase_id`, `not_nota1`, `not_nota2`, `not_nota3`, `not_nota4`, `not_nota5`, `not_nota6`, `not_nota7`, `not_nota8`, `not_nota9`, `not_nota10`, `not_nota11`, `not_nota12`, `not_promedio`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 3.2, 4.1, 3.2, 2.3, 3.4, 6.5, 4.5, 4.4, 6.5, 2.3, 5.6, 5, 4.3, '2018-03-22 01:55:15', '2018-06-29 13:03:29'),
(2, 2, 1, 1, 6.5, 5.4, 3.4, 1, 6, 7, 5.4, 5, 4.5, 2, 7, 6, 4.9, '2018-03-22 01:55:15', '2018-06-29 13:03:29'),
(3, 1, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-03-26 06:16:18', '2018-03-26 06:16:18'),
(4, 2, 1, 2, 2, 3, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '2018-03-26 06:16:18', '2018-03-26 06:16:18'),
(5, 11, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-03-26 06:16:18', '2018-03-26 06:16:18'),
(8, 12, 1, 3, 3, 4, 4.5, 5, 4.3, 5.4, NULL, NULL, NULL, NULL, NULL, NULL, 4.4, '2018-03-27 02:17:02', '2018-03-27 02:17:02'),
(9, 1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-04-05 03:15:49', '2018-04-05 03:15:49'),
(10, 4, 2, 1, NULL, NULL, 5, 5, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4.3, '2018-04-05 03:15:49', '2018-06-22 18:37:35'),
(11, 10, 2, 1, NULL, NULL, 4, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3.3, '2018-04-05 03:15:49', '2018-06-22 18:37:35'),
(12, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-04-05 03:15:49', '2018-04-05 03:15:49'),
(13, 11, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-04-05 03:15:49', '2018-04-05 03:15:49'),
(14, 15, 2, 1, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, '2018-06-22 18:37:35', '2018-06-22 18:37:35'),
(15, 16, 3, 8, 3, 5.4, 3.4, 6, 6.7, 6.5, 3.4, 5.6, 7, 7, 6.7, 4.5, 5.4, '2018-06-27 05:06:36', '2018-06-27 05:06:36'),
(16, 17, 3, 8, 7, 7, 7, 7, 7, 7, NULL, NULL, NULL, NULL, NULL, NULL, 7, '2018-06-27 05:06:36', '2018-06-27 05:06:36'),
(17, 18, 3, 8, 5, 6, 7, 4, 5, 5.3, NULL, NULL, NULL, NULL, NULL, NULL, 5.4, '2018-06-27 05:06:37', '2018-06-27 05:06:37'),
(18, 19, 3, 8, 6.5, 4.7, 6.7, 5.8, 7, 4.3, 6.9, NULL, NULL, NULL, NULL, NULL, 6, '2018-06-27 05:06:37', '2018-06-27 05:06:37'),
(19, 20, 3, 8, 5.6, 7, 4.5, 6, 6.2, 5.5, 6.6, NULL, NULL, NULL, NULL, NULL, 5.9, '2018-06-27 05:06:37', '2018-06-27 05:06:37'),
(20, 16, 3, 9, 6, 5, 7, 4, 6, 4, 6, 3, 4.5, 6.8, NULL, NULL, 5.2, '2018-06-27 05:09:53', '2018-06-27 05:09:53'),
(21, 17, 3, 9, 5, 6, 7, 5.8, 6.9, 4, 5.3, 6, 5.7, 4, NULL, NULL, 5.6, '2018-06-27 05:09:53', '2018-06-27 05:09:53'),
(22, 18, 3, 9, 7, 6, 3.8, 5.2, 6.7, 5, 6, 4, 4.9, 6, NULL, NULL, 5.5, '2018-06-27 05:09:53', '2018-06-27 05:09:53'),
(23, 19, 3, 9, 3, 5, 4.5, 3.9, 7, 6, 5.6, 6, 6.4, 4, NULL, NULL, 5.1, '2018-06-27 05:09:53', '2018-06-27 05:09:53'),
(24, 20, 3, 9, 6.7, 5, 4, 6.5, 7, 6.9, 7, 4, 5, 3, NULL, NULL, 5.5, '2018-06-27 05:09:54', '2018-06-27 05:09:54'),
(25, 16, 3, 11, 5.6, 6.6, 7, 4.4, 5.3, 6.2, 5.1, 4.5, NULL, NULL, NULL, NULL, 5.6, '2018-06-27 05:11:29', '2018-06-27 05:11:29'),
(26, 17, 3, 11, 6, 5.4, 3.6, 5.6, 7, 6.8, 7, 5.9, NULL, NULL, NULL, NULL, 5.9, '2018-06-27 05:11:29', '2018-06-27 05:11:29'),
(27, 18, 3, 11, 4.6, 7, 5.6, 6.2, 6.1, 6.1, 7, 5, NULL, NULL, NULL, NULL, 6, '2018-06-27 05:11:30', '2018-06-27 05:11:30'),
(28, 19, 3, 11, 6.7, 5.5, 4.8, 3.7, 6, 7, 5.9, 6.1, NULL, NULL, NULL, NULL, 5.7, '2018-06-27 05:11:30', '2018-06-27 05:11:30'),
(29, 20, 3, 11, 5.6, 7, 6.2, 5.1, 4.9, 6, 5.2, 4.5, NULL, NULL, NULL, NULL, 5.6, '2018-06-27 05:11:30', '2018-06-27 05:11:30'),
(30, 16, 4, 8, 5, 4.6, 5.4, 3, 6.5, 7, 6.9, 5.6, 3.4, 5.6, NULL, NULL, 5.3, '2018-06-27 05:49:30', '2018-06-27 05:49:30'),
(31, 17, 4, 8, 5.6, 5.1, 7, 6, 6.6, 5.8, 5.9, 3.4, 6, 6.9, NULL, NULL, 5.8, '2018-06-27 05:49:30', '2018-06-27 05:49:30'),
(32, 18, 4, 8, 6, 5.6, 4.1, 7, 6.1, 5.3, 6.9, 2, 4.8, 7, NULL, NULL, 5.5, '2018-06-27 05:49:30', '2018-06-27 05:49:30'),
(33, 19, 4, 8, 6.7, 1, 4.3, 5.8, 3.7, 5, 7, 6.8, 5.9, 6.7, NULL, NULL, 5.3, '2018-06-27 05:49:30', '2018-06-27 05:49:30'),
(34, 20, 4, 8, 7, 6, 5.8, 6.9, 4.9, 7, 6.2, 5.6, 6.6, 5, NULL, NULL, 6.1, '2018-06-27 05:49:30', '2018-06-27 05:49:30'),
(35, 16, 4, 9, 6, 5, 4.6, 7, 6.1, 6.3, 6.2, NULL, NULL, NULL, NULL, NULL, 5.9, '2018-06-27 06:27:31', '2018-06-27 06:27:31'),
(36, 17, 4, 9, 7, 6.9, 5.8, 6, 6.3, 6.2, 7, NULL, NULL, NULL, NULL, NULL, 6.5, '2018-06-27 06:27:31', '2018-06-27 06:27:31'),
(37, 18, 4, 9, 6.1, 5.6, 7, 5.8, 6.8, 4.9, 4.2, NULL, NULL, NULL, NULL, NULL, 5.8, '2018-06-27 06:27:31', '2018-06-27 06:27:31'),
(38, 19, 4, 9, 6, 7, 5.6, 5.2, 4.9, 3, 4, NULL, NULL, NULL, NULL, NULL, 5.1, '2018-06-27 06:27:31', '2018-06-27 06:27:31'),
(39, 20, 4, 9, 4, 5.6, 7, 5.8, 4.9, 6, 6, NULL, NULL, NULL, NULL, NULL, 5.6, '2018-06-27 06:27:31', '2018-06-27 06:27:31'),
(40, 16, 4, 11, 4, 5, 3, 4, 5.6, 6, NULL, NULL, NULL, NULL, NULL, NULL, 4.6, '2018-06-27 06:36:45', '2018-06-27 06:36:45'),
(41, 17, 4, 11, 6, 7, 5, 4, 6, 4.5, NULL, NULL, NULL, NULL, NULL, NULL, 5.4, '2018-06-27 06:36:45', '2018-06-27 06:36:45'),
(42, 18, 4, 11, 7, 6, 4.6, 2.6, 5.4, 7, NULL, NULL, NULL, NULL, NULL, NULL, 5.4, '2018-06-27 06:36:45', '2018-06-27 06:36:45'),
(43, 19, 4, 11, 5, 6, 4, 4.5, 6.3, 5.1, NULL, NULL, NULL, NULL, NULL, NULL, 5.1, '2018-06-27 06:36:45', '2018-06-27 06:36:45'),
(44, 20, 4, 11, 5.8, 6.9, 3.5, 6, 7, 5.4, NULL, NULL, NULL, NULL, NULL, NULL, 5.8, '2018-06-27 06:36:45', '2018-06-27 06:36:45'),
(45, 24, 3, 12, 4, 6.5, 2.3, 4.5, 7, 6.4, 4, 6.6, 5.6, NULL, NULL, NULL, 5.2, '2018-06-29 08:44:27', '2018-06-29 08:44:27'),
(46, 25, 3, 12, 4.5, 6.2, 5.9, 4.7, 5, 6, 4.8, 7, 5.1, NULL, NULL, NULL, 5.5, '2018-06-29 08:44:27', '2018-06-29 08:44:27'),
(47, 26, 3, 12, 5.7, 5.6, 5, 6, 6.3, 5.8, 5.2, 6.1, 5, NULL, NULL, NULL, 5.6, '2018-06-29 08:44:27', '2018-06-29 08:44:27'),
(48, 28, 3, 12, 3, 6.3, 5.4, 5.8, 5.8, 6.7, 6.2, 5.9, 3, NULL, NULL, NULL, 5.3, '2018-06-29 08:44:27', '2018-06-29 08:44:27'),
(49, 22, 3, 12, 6.5, 7, 4.5, 6, 7, 5.9, 5.1, 6, 4.7, NULL, NULL, NULL, 5.9, '2018-06-29 08:44:27', '2018-06-29 08:44:27'),
(50, 24, 4, 12, 5, 7, 4, 6, 5.2, 4.5, 2, 6, 5, 7, NULL, NULL, 5.2, '2018-06-29 08:51:17', '2018-06-29 08:51:17'),
(51, 25, 4, 12, 7, 7, 6.5, 6.1, 6.2, 5.9, 6.4, 5.6, 5.5, 7, NULL, NULL, 6.3, '2018-06-29 08:51:17', '2018-06-29 08:51:17'),
(52, 26, 4, 12, 6.7, 3, 6.7, 5, 4.8, 5.2, 5.5, 6.3, 5.8, 5.9, NULL, NULL, 5.5, '2018-06-29 08:51:17', '2018-06-29 08:51:17'),
(53, 28, 4, 12, 5.1, 4.8, 7, 6.7, 6.1, 6.4, 4, 5.6, 6, 6, NULL, NULL, 5.8, '2018-06-29 08:51:17', '2018-06-29 08:51:17'),
(54, 22, 4, 12, 6, 4.5, 6.5, 4.5, 6, 6.1, 7, 4.7, 5.9, 7, NULL, NULL, 5.8, '2018-06-29 08:51:17', '2018-06-29 08:51:17'),
(55, 24, 3, 13, 5, 5, 5, 6, 6, 6, 5, 5, 5, 7, 7, NULL, 5.6, '2018-06-29 08:53:10', '2018-06-29 08:53:10'),
(56, 25, 3, 13, 4, 4, 3, 3, 5, 6, 5, 6, 7, 6, 5, NULL, 4.9, '2018-06-29 08:53:10', '2018-06-29 08:53:10'),
(57, 26, 3, 13, 5, 5, 5, 6, 6, 7, 7, 5, 6, 6, 4, NULL, 5.6, '2018-06-29 08:53:11', '2018-06-29 08:53:11'),
(58, 28, 3, 13, 2, 2, 3, 7, 7, 6, 5, 7, 6, 4, 5, NULL, 4.9, '2018-06-29 08:53:11', '2018-06-29 08:53:11'),
(59, 22, 3, 13, 6, 7, 6, 5, 7, 4, 6, 4, 6, 5, 3, NULL, 5.4, '2018-06-29 08:53:11', '2018-06-29 08:53:11'),
(60, 24, 4, 13, 1, 6, 7, 6, 5, 7, 3, 4, 7, 6, 6, 5, 5.3, '2018-06-29 08:54:30', '2018-06-29 08:54:30'),
(61, 25, 4, 13, 5, 6, 5, 4, 6, 4, 7, 4, 6, 5, 5, 6, 5.3, '2018-06-29 08:54:30', '2018-06-29 08:54:30'),
(62, 26, 4, 13, 5, 4, 6, 5, 5, 6, 7, 6, 7, 7, 5, 4, 5.6, '2018-06-29 08:54:30', '2018-06-29 08:54:30'),
(63, 28, 4, 13, 6, 7, 6, 5, 6, 6, 4, 7, 6, 6, 5, 3, 5.6, '2018-06-29 08:54:30', '2018-06-29 08:54:30'),
(64, 22, 4, 13, 7, 6, 6, 5, 6, 4, 5, 3, 5, 7, 6, 5, 5.4, '2018-06-29 08:54:30', '2018-06-29 08:54:30'),
(65, 24, 3, 15, 5, 6, 6, 6, 5, 4, 1, 1, 7, 7, 6, NULL, 4.9, '2018-06-29 08:55:52', '2018-06-29 08:55:52'),
(66, 25, 3, 15, 5, 5, 6, 7, 7, 4, 7, 6, 6, 5, 5, NULL, 5.7, '2018-06-29 08:55:52', '2018-06-29 08:55:52'),
(67, 26, 3, 15, 7, 7, 6, 6, 4, 5, 5, 6, 7, 4, 5, NULL, 5.6, '2018-06-29 08:55:52', '2018-06-29 08:55:52'),
(68, 28, 3, 15, 6, 6, 5, 4, 7, 6, 6, 7, 5, 6, 5, NULL, 5.7, '2018-06-29 08:55:52', '2018-06-29 08:55:52'),
(69, 22, 3, 15, 5, 6, 6, 7, 7, 4, 5, 5, 6, 5, 4, NULL, 5.5, '2018-06-29 08:55:52', '2018-06-29 08:55:52'),
(70, 27, 3, 17, 6, 6, 6, 5, 7, 4, 6, 3, 4, NULL, NULL, NULL, 5.2, '2018-06-29 08:57:47', '2018-06-29 08:57:47'),
(71, 29, 3, 17, 7, 6, 7, 5, 4, 5, 3, 5, 4, NULL, NULL, NULL, 5.1, '2018-06-29 08:57:47', '2018-06-29 08:57:47'),
(72, 30, 3, 17, 6, 4, 3, 4, 5, 4, 5, 6, 3, NULL, NULL, NULL, 4.4, '2018-06-29 08:57:47', '2018-06-29 08:57:47'),
(73, 31, 3, 17, 4, 4, 6, 5, 7, 6, 5, 6, 4, NULL, NULL, NULL, 5.2, '2018-06-29 08:57:47', '2018-06-29 08:57:47'),
(74, 32, 3, 17, 7, 6, 6, 4, 5, 4, 3, 6, 5, NULL, NULL, NULL, 5.1, '2018-06-29 08:57:47', '2018-06-29 08:57:47'),
(75, 27, 4, 17, 7, 6, 6, 6, 5, 5, 4, 5, 4, 7, NULL, NULL, 5.5, '2018-06-29 08:58:48', '2018-06-29 08:58:48'),
(76, 29, 4, 17, 5, 6, 5, 6, 7, 5, 4, 6, 2, 5, NULL, NULL, 5.1, '2018-06-29 08:58:48', '2018-06-29 08:58:48'),
(77, 30, 4, 17, 6, 4, 5, 4, 3, 5, 6, 5, 4, 7, NULL, NULL, 4.9, '2018-06-29 08:58:48', '2018-06-29 08:58:48'),
(78, 31, 4, 17, 5, 4, 4, 3, 6, 4, 7, 4, 5, 6, NULL, NULL, 4.8, '2018-06-29 08:58:48', '2018-06-29 08:58:48'),
(79, 32, 4, 17, 6, 6, 7, 5, 6, 5, 5, 4, 6, 5, NULL, NULL, 5.5, '2018-06-29 08:58:48', '2018-06-29 08:58:48'),
(80, 27, 3, 18, 7, 6, 6, 5, 6, 5, 4, 6, 4, 6, NULL, NULL, 5.5, '2018-06-29 09:01:07', '2018-06-29 09:01:07'),
(81, 29, 3, 18, 7, 6, 6, 5, 6, 5, 7, 6, 5, 6, NULL, NULL, 5.9, '2018-06-29 09:01:07', '2018-06-29 09:01:07'),
(82, 30, 3, 18, 6, 6, 7, 6, 7, 5, 6, 5, 4, 5, NULL, NULL, 5.7, '2018-06-29 09:01:07', '2018-06-29 09:01:07'),
(83, 31, 3, 18, 7, 6, 6, 3, 4, 2, 6, 6.7, 7, 5, NULL, NULL, 5.3, '2018-06-29 09:01:07', '2018-06-29 09:01:07'),
(84, 32, 3, 18, 6, 5, 5, 4, 5, 7, 5, 6, 5, 7, NULL, NULL, 5.5, '2018-06-29 09:01:07', '2018-06-29 09:01:07'),
(85, 27, 4, 18, 7, 6, 5, 4, 5, 3.4, 5, 5, 3.4, 6.7, NULL, NULL, 5, '2018-06-29 09:02:44', '2018-06-29 09:02:44'),
(86, 29, 4, 18, 6.7, 5, 6.4, 5, 3, 5.7, 6, 5.4, 6.9, 5.6, NULL, NULL, 5.6, '2018-06-29 09:02:44', '2018-06-29 09:02:44'),
(87, 30, 4, 18, 5.7, 6.7, 5.3, 6, 7, 6.2, 5.2, 6.3, 5, 6, NULL, NULL, 5.9, '2018-06-29 09:02:44', '2018-06-29 09:02:44'),
(88, 31, 4, 18, 5, 6, 6, 7, 4, 6, 5, 6, 4, 7, NULL, NULL, 5.6, '2018-06-29 09:02:44', '2018-06-29 09:02:44'),
(89, 32, 4, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-29 09:02:44', '2018-06-29 09:02:44'),
(90, 27, 3, 20, 7, 4, 5, 6.5, 4.7, 5, 6, 5.7, 6.9, 5.7, 6, 5.6, 5.7, '2018-06-29 09:05:06', '2018-06-29 09:05:06'),
(91, 29, 3, 20, 6.5, 7, 4.5, 7, 6, 5.8, 6.1, 5.9, 7, 5.2, 7, 4, 6, '2018-06-29 09:05:06', '2018-06-29 09:05:06'),
(92, 30, 3, 20, 6, 5.7, 6, 4.6, 7, 7, 6.3, 5, 2, 7, 6.5, 5.6, 5.7, '2018-06-29 09:05:07', '2018-06-29 09:05:07'),
(93, 31, 3, 20, 5.6, 5, 7, 4, 3, 2, 3, 6, 5, 4.6, 7, 6, 4.9, '2018-06-29 09:05:07', '2018-06-29 09:05:07'),
(94, 32, 3, 20, 1.1, 3, 6, 7, 5, 6.4, 7, 3.8, 6, 5, 7, 6, 5.3, '2018-06-29 09:05:07', '2018-06-29 09:05:07'),
(95, 27, 4, 20, 6, 5, 7, 4, 6, 4.3, 6, 7, 5, NULL, NULL, NULL, 5.6, '2018-06-29 09:06:29', '2018-06-29 09:06:29'),
(96, 29, 4, 20, 6, 5, 4, 5.3, 6, 4, 7, 5.6, 5, NULL, NULL, NULL, 5.3, '2018-06-29 09:06:29', '2018-06-29 09:06:29'),
(97, 30, 4, 20, 7, 4, 6, 5, 4, 6, 5, 4, 5, NULL, NULL, NULL, 5.1, '2018-06-29 09:06:29', '2018-06-29 09:06:29'),
(98, 31, 4, 20, 4.6, 5, 7, 5, 3, 5, 3.4, 3.7, 7, NULL, NULL, NULL, 4.9, '2018-06-29 09:06:29', '2018-06-29 09:06:29'),
(99, 32, 4, 20, 7, 6, 5, 3, 5.4, 7, 6.5, 3, 5, NULL, NULL, NULL, 5.3, '2018-06-29 09:06:29', '2018-06-29 09:06:29'),
(100, 33, 5, 21, 4, 6, 5, 6, 5, 4, 3.5, 3, 4, 4.5, 3, NULL, 4.4, '2018-06-29 10:02:54', '2018-06-29 10:02:54'),
(101, 34, 5, 21, 7, 6, 5, 4.4, 3, 6, 4, 5, 7, 6, 5, NULL, 5.3, '2018-06-29 10:02:54', '2018-06-29 10:02:54'),
(102, 33, 6, 21, 4.2, 5, 6, 4, 6, 5, 4, 6, 6, 7, NULL, NULL, 5.3, '2018-06-29 10:03:58', '2018-06-29 10:03:58'),
(103, 34, 6, 21, 6, 5, 7, 5, 4, 6, 7, 5, 7, 4, NULL, NULL, 5.6, '2018-06-29 10:03:58', '2018-06-29 10:03:58'),
(104, 33, 5, 22, 7, 6, 5, 7, 5, 4, 6, 4, 6, 7, 4, NULL, 5.5, '2018-06-29 10:04:24', '2018-06-29 10:04:24'),
(105, 34, 5, 22, 5, 3, 2, 5, 7, 5, 3, 6, 7, 5, 7, NULL, 5, '2018-06-29 10:04:24', '2018-06-29 10:04:24'),
(106, 33, 5, 24, 7, 6, 5, 7, 4, 5, 3, 6, 4, 5, 4, NULL, 5.1, '2018-06-29 10:05:07', '2018-06-29 10:05:07'),
(107, 34, 5, 24, 6, 5, 6.8, 6.5, 4, 2, 6.5, 3, 6.7, 7, 5, NULL, 5.3, '2018-06-29 10:05:07', '2018-06-29 10:05:07'),
(108, 33, 6, 24, 6, 5, 4.5, 3, 4, 6, 4, 5, 3, 5, 3, NULL, 4.4, '2018-06-29 10:05:39', '2018-06-29 10:05:39'),
(109, 34, 6, 24, 6, 4, 3, 6, 7, 5, 4, 5, 6, 3, 5, NULL, 4.9, '2018-06-29 10:05:39', '2018-06-29 10:05:39'),
(110, 33, 6, 22, 6, 5, 4, 5.6, 4, 5, 4, 3, 6, 3, 5, NULL, 4.6, '2018-06-29 10:06:54', '2018-06-29 10:06:54'),
(111, 34, 6, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-29 10:06:54', '2018-06-29 10:06:54'),
(112, 35, 7, 25, 5, 6, 7, 5, 5, 6, 4, 7, 6, 5, 7, NULL, 5.7, '2018-06-29 10:41:36', '2018-06-29 10:41:36'),
(113, 36, 7, 25, 7, 5, 6, 4, 6, 7, 6, 6.4, 6, 5, 4, NULL, 5.7, '2018-06-29 10:41:36', '2018-06-29 10:41:36'),
(114, 37, 7, 25, 6, 5, 4, 5, 4, 7, 5, 6, 5.4, 6.7, 7, NULL, 5.6, '2018-06-29 10:41:36', '2018-06-29 10:41:36'),
(115, 35, 8, 25, 7, 6, 6.7, 5, 5, 6, 4.5, 6.7, 3, 2, 5, NULL, 5.2, '2018-06-29 10:42:19', '2018-06-29 10:42:19'),
(116, 36, 8, 25, 6, 6.7, 5, 4, 5.6, 3, 3, 6.8, 7, 5, 4, NULL, 5.1, '2018-06-29 10:42:19', '2018-06-29 10:42:19'),
(117, 37, 8, 25, 4, 3, 6.7, 7, 5, 4, 6, 4, 6, 7, 4, NULL, 5.2, '2018-06-29 10:42:19', '2018-06-29 10:42:19'),
(118, 35, 7, 26, 6, 7, 5, 5, 7, 5, 4, 6, 4, 3.5, NULL, NULL, 5.3, '2018-06-29 10:43:12', '2018-06-29 10:43:12'),
(119, 36, 7, 26, 6, 5, 4, 6, 5.6, 3.5, 6.1, 5.6, 4.5, 6, NULL, NULL, 5.2, '2018-06-29 10:43:12', '2018-06-29 10:43:12'),
(120, 37, 7, 26, 5, 6, 4, 6, 6, 6, 4.4, 5.3, 5, 3, NULL, NULL, 5.1, '2018-06-29 10:43:12', '2018-06-29 10:43:12'),
(121, 35, 8, 26, 5, 7, 6, 6, 5, 4.6, 4, 4, 6, NULL, NULL, NULL, 5.3, '2018-06-29 10:43:51', '2018-06-29 10:43:51'),
(122, 36, 8, 26, 6, 5, 6, 4, 3.4, 5, 6, 5, 6, NULL, NULL, NULL, 5.2, '2018-06-29 10:43:51', '2018-06-29 10:43:51'),
(123, 37, 8, 26, 6, 5, 4, 6, 6, 5, 7, 6, 5, NULL, NULL, NULL, 5.6, '2018-06-29 10:43:51', '2018-06-29 10:43:51'),
(124, 13, 1, 28, 5, 4, 6, 4, 3, 5, 3.4, 5.4, 7, 6.5, NULL, NULL, 4.9, '2018-06-29 11:05:34', '2018-06-29 11:05:34'),
(125, 38, 1, 28, 6.7, 6.5, 5.3, 6.5, 4.3, 6.4, 7, 4, 6, 7, NULL, NULL, 6, '2018-06-29 11:05:34', '2018-06-29 11:05:34'),
(126, 39, 1, 28, 6, 5, 7, 6, 5.4, 7, 5, 6, 5, 3, NULL, NULL, 5.5, '2018-06-29 11:05:34', '2018-06-29 11:05:34'),
(127, 40, 1, 28, 7, 6, 5, 4, 7, 4, 5, 6, 5, 4, NULL, NULL, 5.3, '2018-06-29 11:05:34', '2018-06-29 11:05:34'),
(128, 13, 2, 28, 7, 6, 5, 7, 4, 6, 3.4, 1, 3, 2, NULL, NULL, 4.4, '2018-06-29 11:06:52', '2018-06-29 18:23:23'),
(129, 38, 2, 28, 7, 6, 5, 6.7, 5.4, 7, 6.5, 4, 5, 3, NULL, NULL, 5.6, '2018-06-29 11:06:52', '2018-06-29 18:23:24'),
(130, 39, 2, 28, 4, 3, 6, 4, 7, 6, 4, 5, 4, 6, NULL, NULL, 4.9, '2018-06-29 11:06:52', '2018-06-29 18:23:24'),
(131, 40, 2, 28, 7, 6, 5, 6, 4, 6, 3, 5, 5, 7, NULL, NULL, 5.4, '2018-06-29 11:06:52', '2018-06-29 18:23:24'),
(132, 13, 1, 30, 7, 6, 4, 6, 4, 7, 4, 5, 3, 4, 5, NULL, 5, '2018-06-29 11:07:31', '2018-06-29 11:07:31'),
(133, 38, 1, 30, 7, 6, 5, 6, 5, 3, 5, 4, 6, 5, 4, NULL, 5.1, '2018-06-29 11:07:31', '2018-06-29 11:07:31'),
(134, 39, 1, 30, 7, 5, 4, 5, 5, 3, 4, 4, 3, 5, 5, NULL, 4.5, '2018-06-29 11:07:32', '2018-06-29 11:07:32'),
(135, 40, 1, 30, 6, 5, 4, 6, 4, 4, 6, 4, 6, 6, 7, NULL, 5.3, '2018-06-29 11:07:32', '2018-06-29 11:07:32'),
(136, 13, 2, 30, 5, 6, 5, 4, 6, 5, 7, 6, 4, 6, 4.5, NULL, 5.3, '2018-06-29 11:08:33', '2018-06-29 11:08:33'),
(137, 38, 2, 30, 6, 5, 4, 7, 6, 5, 6, 4, 5, 3, 6, NULL, 5.2, '2018-06-29 11:08:33', '2018-06-29 11:08:33'),
(138, 39, 2, 30, 4, 6, 7, 5, 7, 7, 5, 4, 3, 5, 3, NULL, 5.1, '2018-06-29 11:08:33', '2018-06-29 11:08:33'),
(139, 40, 2, 30, 6, 5, 5, 7, 6, 6, 6, 6, 5, 3, 5, NULL, 5.5, '2018-06-29 11:08:33', '2018-06-29 11:08:33'),
(140, 13, 1, 31, 7, 6, 5, 6, 5, 3, 5, 3, 2, 5, 4, NULL, 4.6, '2018-06-29 11:09:22', '2018-06-29 11:09:22'),
(141, 38, 1, 31, 7, 6, 5, 6, 7, 5, 6, 4, 6, 3, 5, NULL, 5.5, '2018-06-29 11:09:23', '2018-06-29 11:09:23'),
(142, 39, 1, 31, 7, 6, 4, 3, 5, 4, 6, 6, 4, 6, 7, NULL, 5.3, '2018-06-29 11:09:23', '2018-06-29 11:09:23'),
(143, 40, 1, 31, 4, 5, 4, 6, 7, 5, 4, 5, 4, 3, 5, NULL, 4.7, '2018-06-29 11:09:23', '2018-06-29 11:09:23'),
(144, 13, 2, 31, 7, 6, 5, 4, 6, 5, 4, 5, 5, 3, 3, 5, 4.8, '2018-06-29 11:10:10', '2018-06-29 11:10:10'),
(145, 38, 2, 31, 7, 6, 5, 4, 6, 6, 5, 6, 4, 3, 6, 5, 5.3, '2018-06-29 11:10:10', '2018-06-29 11:10:10'),
(146, 39, 2, 31, 7, 6, 5, 6, 5, 4, 3, 6, 5, 6, 6, 5, 5.3, '2018-06-29 11:10:10', '2018-06-29 11:10:10'),
(147, 40, 2, 31, 6, 5, 7, 7, 5, 6, 7, 4, 6, 4, 6, 4, 5.6, '2018-06-29 11:10:10', '2018-06-29 11:10:10'),
(148, 15, 1, 1, 5, 6, 5, 4, 6, 5, 4, 5, 5, 4, 6, 7, 5.2, '2018-06-29 13:03:28', '2018-06-29 13:03:28'),
(149, 4, 1, 1, 5, 6, 4, 6, 4, 4, 3, 5.4, 2.3, 5.4, 6, 6, 4.8, '2018-06-29 13:03:29', '2018-06-29 13:03:29'),
(150, 10, 1, 1, 5, 4, 5, 3, 6.5, 3.4, 5, 7, 6, 4, 6, 5, 5, '2018-06-29 13:03:29', '2018-06-29 13:03:29'),
(151, 11, 1, 1, 6, 5, 4, 6.3, 6, 5, 6, 3.4, 6.5, 5.6, 5.7, 6.2, 5.5, '2018-06-29 13:03:29', '2018-06-29 13:03:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_compra`
--

CREATE TABLE `orden_compra` (
  `oc_id` int(10) UNSIGNED NOT NULL,
  `proveedor_id` int(10) UNSIGNED NOT NULL,
  `oc_numero` int(11) NOT NULL,
  `oc_fecha` date NOT NULL,
  `oc_costo` int(10) UNSIGNED NOT NULL,
  `oc_estado` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `orden_compra`
--

INSERT INTO `orden_compra` (`oc_id`, `proveedor_id`, `oc_numero`, `oc_fecha`, `oc_costo`, `oc_estado`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '2018-03-18', 26700, 0, '2018-03-18 20:16:48', '2018-05-18 23:42:49'),
(2, 7, 2, '2018-04-13', 16000, 0, '2018-04-17 18:47:14', '2018-04-17 18:47:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `padres`
--

CREATE TABLE `padres` (
  `pad_rut` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pad_nombres` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pad_apellido_pat` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pad_apellido_mat` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pad_fecha_nacimiento` date NOT NULL,
  `pad_contacto` int(10) UNSIGNED DEFAULT NULL,
  `pad_parentesco` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pad_domicilio` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pad_nivel_estudio` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pad_sit_laboral` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pad_profesion` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pad_renta` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `padres`
--

INSERT INTO `padres` (`pad_rut`, `pad_nombres`, `pad_apellido_pat`, `pad_apellido_mat`, `pad_fecha_nacimiento`, `pad_contacto`, `pad_parentesco`, `pad_domicilio`, `pad_nivel_estudio`, `pad_sit_laboral`, `pad_profesion`, `pad_renta`, `created_at`, `updated_at`) VALUES
('1.111.111-1', 'padre', 'padrepat', 'padremat', '1985-06-20', 0, 'Padre', 'domicilio1', 'nivel1', 'situacion 1', 'profesion1', 1000000, '2017-06-06 20:31:07', '2018-03-03 18:55:18'),
('1.111.111-2', 'madre', 'madrePat', 'madreMat', '1988-05-10', 0, 'Madre', 'domicilio1', 'nivel1', 'situacion1', 'profesion0', 0, '2017-06-06 20:31:07', '2018-03-03 19:10:41'),
('1.414.141-4', 'mad', 'madpat', 'madmat', '1990-05-13', 0, 'Madre', 'domicilio14', 'media completa', 'sit14', 'prof14', 100000, '2018-02-06 06:22:39', '2018-03-23 02:20:58'),
('11.455.234-2', 'Javier Antonio', 'Montolla', 'Castro', '1990-10-22', 0, 'Padre', 'calle xxx N° 123123 pobl. Laurie', 'media completa', 'trabajando', 'desarrollador de medios', 400000, '2018-03-02 05:47:20', '2018-03-23 02:22:21'),
('11.555.555-5', 'padre', 'padpat', 'padmat', '1989-06-06', 0, 'Padre', 'domicilio5', 'media completa', 'situacion 5', 'profesion 5', 1000000, '2017-11-16 22:07:40', '2018-03-23 02:19:16'),
('12.332.123-2', 'Gloria Andrea', 'Arévalo', 'Sepúlveda', '1988-02-24', NULL, 'Madre', 'calle xxx N° 123123 pobl. Laurie', 'básica completa', 'desempleada', NULL, 0, '2018-06-22 18:21:51', '2018-06-22 18:21:51'),
('12.483.212-3', 'Javier Antonio', 'Montolla', 'Castro', '1990-10-22', NULL, 'Padre', 'calle xxx N° 123123 pobl. Laurie', 'media completa', 'trabajando', 'desarrollador de medios', 400000, '2018-06-22 18:21:51', '2018-06-22 18:21:51'),
('14.111.321-4', 'Javiera Andrea', 'Castillo', 'Isla', '1980-06-14', NULL, 'Madre', 'Domicilio javiera', 'media completa', 'trabajador independiente', 'Contadora', 420000, '2018-06-29 08:31:39', '2018-06-29 08:31:39'),
('2.222.222-1', 'padre', 'patpadre', 'matpadre', '1990-02-06', 0, 'Padre', 'domicilio2', 'media completa', 'situacion', 'profesion', 2000000, '2017-06-17 14:26:14', '2018-06-22 03:34:22'),
('2.222.222-2', 'madre', 'patmadre', 'matmadre', '1989-08-09', 0, 'Madre', 'domicilio2', 'básica completa', 'trabajador por cuenta propia', 'profesion', 200000, '2017-06-17 14:26:14', '2018-06-22 03:35:50'),
('22.555.555-5', 'madre', 'madpat', 'madmat', '1987-02-04', 0, 'Madre', 'domicilio5', 'basica completa', 'situacion 5', 'profesion 5', 500000, '2017-11-16 22:07:40', '2018-03-23 02:19:16'),
('3.111.111-2', 'madre matilda', 'madrematipat', 'madrematimat', '1982-06-12', NULL, 'Madre', 'domicilio matilda 1', 'basico completo', 'situacion uno', 'profecion uno', 100000, '2018-06-24 06:44:50', '2018-06-24 06:44:50'),
('3.333.333-1', 'padre', 'patpadre', 'matpadre', '1987-12-03', 0, 'Padre', 'domicilio3', 'nivel3', 'situacion3', 'profesion', 3000000, '2017-06-17 18:44:50', '2018-03-23 02:20:07'),
('3.333.333-2', 'madre', 'patmadre', 'matmadre', '1984-04-12', 0, 'Madre', 'domicilio3', 'nivel3', 'laboral3', 'profesion3', 300000, '2017-06-17 18:44:50', '2018-03-23 02:20:07'),
('4.111.111-1', 'padre franuno', 'padfranunopat', 'padfranunomat', '1980-02-02', NULL, 'Padre', 'domicilio francisca uno', 'basico completa', 'trabajador independiente', 'profesion uno', 1000000, '2018-06-24 06:54:02', '2018-06-24 06:54:02'),
('4.111.111-2', 'madre franuno', 'madfranunopat', 'madfranunomat', '1985-04-04', NULL, 'Madre', 'domicilio francisca uno', 'media completa', 'trabajador', 'profesion uno', 1000000, '2018-06-24 06:54:02', '2018-06-24 06:54:02'),
('4.444.444-1', 'padre', 'patpadre', 'matpadre', '0000-00-00', 0, 'Padre', 'domicilio4', 'nivel4', 'laboral4', 'profesion4', 4000000, '2017-06-17 22:43:04', '2017-06-17 22:43:04'),
('4.444.444-2', 'madre', 'patmadr', 'matmadre', '0000-00-00', 0, 'Madre', 'domicilio4', 'nivel4', 'situacion4', 'profesion4', 400000, '2017-06-17 22:43:04', '2017-06-17 22:43:04'),
('5.111.111-1', 'padre felipeuno', 'padfelunopat', 'padfelipeunomat', '1985-05-13', NULL, 'Padre', 'domicilio felipe 1', 'media completa', 'trabajador independiente', 'profecion uno', 1500000, '2018-06-24 10:04:59', '2018-06-24 10:04:59'),
('7.543.531-2', 'Felipe Segundo', 'Araneda', 'Millanao', '1970-05-07', 0, 'Padre', 'Lautaro #123', 'Media Completa', 'trabajando', 'Soldador', 340000, '2018-02-20 02:02:04', '2018-03-02 20:27:07'),
('8.453.521-4', 'María del Carmen', 'Irribarra', 'Tobosque', '1987-07-14', 0, 'Madre', 'Lautaro #123', 'Media Completa', 'Desempleada', 'Ninguna', 0, '2018-02-20 02:02:04', '2018-03-02 20:27:07'),
('9.556.412-3', 'Gloria Andrea', 'Arévalo', 'Sepúlveda', '1988-02-24', 0, 'Madre', 'calle xxx N° 123123 pobl. Laurie', 'básica completa', 'desempleada', NULL, 0, '2018-03-02 05:47:20', '2018-03-23 02:22:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametro_cursos`
--

CREATE TABLE `parametro_cursos` (
  `pcur_id` int(10) UNSIGNED NOT NULL,
  `pcur_grado` int(11) NOT NULL,
  `pcur_letra` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `parametro_cursos`
--

INSERT INTO `parametro_cursos` (`pcur_id`, `pcur_grado`, `pcur_letra`, `created_at`, `updated_at`) VALUES
(1, 1, 'A', '2017-06-05 16:30:12', '2017-06-05 16:30:12'),
(2, 1, 'B', '2017-06-05 16:30:17', '2017-06-05 16:30:17'),
(3, 1, 'C', '2017-06-05 16:30:20', '2017-06-05 16:30:20'),
(4, 1, 'D', '2017-07-06 14:12:20', '2017-07-06 14:12:20'),
(5, 1, 'E', '2017-07-06 14:12:31', '2017-07-06 14:12:31'),
(6, 1, 'F', '2017-07-06 14:12:37', '2017-07-06 14:12:37'),
(7, 2, 'A', '2017-09-07 20:40:46', '2017-09-07 20:40:46'),
(8, 3, 'A', NULL, NULL),
(9, 4, 'A', NULL, NULL),
(10, 2, 'B', NULL, NULL),
(11, 3, 'B', NULL, NULL),
(12, 4, 'B', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo_academico`
--

CREATE TABLE `periodo_academico` (
  `pac_id` int(10) UNSIGNED NOT NULL,
  `liceo_id` int(10) UNSIGNED NOT NULL,
  `pac_ano` int(11) NOT NULL,
  `pac_fecha_inicio` date NOT NULL,
  `pac_fecha_termino` date NOT NULL,
  `pac_estado` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `periodo_academico`
--

INSERT INTO `periodo_academico` (`pac_id`, `liceo_id`, `pac_ano`, `pac_fecha_inicio`, `pac_fecha_termino`, `pac_estado`, `created_at`, `updated_at`) VALUES
(1, 1, 2017, '2017-03-01', '2017-12-10', 1, '2017-06-05 16:25:37', '2018-03-28 07:19:50'),
(2, 1, 2014, '2014-03-03', '2014-12-12', 2, NULL, '2018-06-29 09:31:53'),
(3, 1, 2015, '2015-03-02', '2015-12-21', 2, NULL, '2018-06-29 10:10:23'),
(5, 1, 2016, '2016-03-04', '2016-12-21', 2, NULL, '2018-06-29 10:44:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission_role`
--

CREATE TABLE `permission_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `pe_rut` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pe_nombres` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pe_apellido_pat` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pe_apellido_mat` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pe_contacto` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`pe_rut`, `pe_nombres`, `pe_apellido_pat`, `pe_apellido_mat`, `pe_contacto`, `created_at`, `updated_at`) VALUES
('1.111.111-2', 'madre', 'madrePat', 'madreMat', 0, '2017-06-06 20:31:07', '2017-06-06 20:31:07'),
('1.111.111-3', 'tia javier', 'tiajavipat', 'tiajavimat', 11111111, '2018-06-24 06:33:05', '2018-06-24 06:33:05'),
('1.231.212-4', 'asdasd', 'aasdq', 'asd', 123123, '2018-06-22 00:35:40', '2018-06-22 00:35:40'),
('1.414.141-4', 'mad', 'madpat', 'madmat', 111111, '2018-02-06 06:22:39', '2018-02-06 06:22:39'),
('11.555.555-5', 'padre', 'padpat', 'padmat', 55555555, '2017-11-16 22:07:40', '2017-11-16 22:07:40'),
('12.000.000-1', 'tio javierdos', 'Troncoso', 'Fernandez', NULL, '2018-06-28 21:03:35', '2018-06-28 21:03:35'),
('12.323.132-3', 'profesor prueba', 'pruebapat', 'pruebamat', 123412, '2018-06-22 00:29:58', '2018-06-22 00:29:58'),
('12.483.212-3', 'Javier Antonio', 'Montolla', 'Castro', 123321, '2018-06-22 18:21:51', '2018-06-22 18:21:51'),
('13.131.313-1', 'Diego Francisco', 'Ulloa', 'Mercado', 1233212, '2017-10-29 10:46:42', '2017-10-29 10:46:42'),
('14.111.321-4', 'Javiera Andrea', 'Castillo', 'Isla', 41123142, '2018-06-29 08:31:39', '2018-06-29 08:31:39'),
('14.141.414-4', 'prof', 'patprof', 'matprof', 123123, '2017-10-29 11:15:53', '2017-10-29 11:15:53'),
('17500232-4', 'Felipe Gonzalo', 'Carrasco', 'Almendra', 123123123, '2018-02-24 09:35:16', '2018-02-24 09:35:16'),
('18.500.343-4', 'Luis', 'Maliqueo', 'Araneda', 123123, '2017-06-17 18:44:50', '2018-05-13 20:05:11'),
('2.111.111-1', 'tio marcelouno', 'tiomarcelopat', 'tiomarcelomat', 11111111, '2018-06-24 06:37:55', '2018-06-24 06:37:55'),
('2.222.222-1', 'padre', 'patpadre', 'matpadre', 12121212, '2017-06-17 14:26:14', '2017-06-17 14:26:14'),
('2.222.222-2', 'madre', 'patmadre', 'matmadre', 12121212, '2017-06-17 14:26:14', '2017-06-17 14:26:14'),
('2.411.111-2', 'Maria del Carmen', 'Alarcón', 'Montoya', 24444444, '2018-06-29 08:18:35', '2018-06-29 08:18:35'),
('21.321.321-3', 'apoderado', 'apodpat', 'apodmat', 0, '2018-02-06 03:33:42', '2018-02-06 03:33:42'),
('22.555.555-5', 'madre', 'madpat', 'madmat', 555555555, '2017-11-16 22:07:40', '2017-11-16 22:07:40'),
('3.111.111-2', 'madre matilda', 'madrematipat', 'madrematimat', NULL, '2018-06-29 10:18:25', '2018-06-29 10:18:25'),
('3.111.111-3', 'Olga del Carmen', 'Ortiz', 'Arévalo', 23123123, '2018-06-28 21:10:49', '2018-06-28 21:10:49'),
('3.111.222-3', 'jefe utp', 'apellidopat', 'apellidomat', 231232312, '2018-05-13 19:20:38', '2018-05-13 19:20:38'),
('3.222.111-2', 'Ernesto Andrés de Jesus', 'Poblete', 'Barra', 222222, '2017-06-10 23:12:20', '2018-06-22 00:52:35'),
('3.333.333-4', 'tio', 'pattio', 'mattio', 33333333, '2017-06-17 18:44:50', '2017-06-17 18:44:50'),
('4.111.111-1', 'Mateo', 'Conejeros', 'Araya', 123456789, '2018-05-11 00:29:50', '2018-05-11 00:29:50'),
('4.111.111-3', 'tia franciscauno', 'tiafranunopat', 'tiafranunomat', 111111111, '2018-06-24 06:54:02', '2018-06-24 06:54:02'),
('4.444.444-1', 'padre', 'patpadre', 'matpadre', 44444444, '2017-06-17 22:43:04', '2017-06-17 22:43:04'),
('4.444.444-2', 'madre', 'patmadre', 'matmadre', 44444444, '2017-06-17 22:43:04', '2017-06-17 22:43:04'),
('5.111.111-1', 'padre felipeuno', 'padfelunopat', 'padfelipeunomat', NULL, '2018-06-24 10:04:59', '2018-06-24 10:04:59'),
('5.111.231-5', 'Olga del Carmen', 'Molina', 'Jara', 952003123, '2018-06-29 08:40:00', '2018-06-29 08:40:00'),
('55.555.555-5', 'profesor prueba', 'newPatProfesor', 'newMatProfesor', 1234444555, '2017-11-01 22:12:46', '2017-11-01 22:12:46'),
('7.171.717-1', 'secretaria', 'secretpat', 'secretmat', 12212312, '2018-05-09 02:31:12', '2018-05-09 02:31:12'),
('7.543.531-2', 'Felipe Segundo', 'Araneda', 'Millanao', 34234154, '2018-02-20 02:02:04', '2018-02-20 02:02:04'),
('7.796.311-1', 'Juana Andrea', 'Cuevas', 'Canales', 32123212, '2018-03-25 01:36:58', '2018-03-25 01:36:58'),
('9.556.412-3', 'Gloria Andrea', 'Arévalo', 'Sepúlveda', 97832134, '2018-03-02 05:47:20', '2018-03-02 05:47:20'),
('9.888.777-3', 'Braulio', 'Salas', 'Sanchez', 2312323123, '2018-05-10 20:33:31', '2018-05-10 20:33:31'),
('9999999-k', 'profesor2', '', '', 973212311, '2017-06-11 14:57:20', '2017-06-11 14:57:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `pers_id` int(10) UNSIGNED NOT NULL,
  `persona_rut` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institucion_id` int(10) UNSIGNED DEFAULT NULL,
  `cargo_id` int(10) UNSIGNED NOT NULL,
  `pers_estado` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`pers_id`, `persona_rut`, `institucion_id`, `cargo_id`, `pers_estado`, `created_at`, `updated_at`) VALUES
(1, '3.222.111-2', 10, 1, 1, '2017-06-10 23:12:20', '2018-06-22 00:59:03'),
(2, '9999999-k', 1, 1, 1, '2017-06-11 14:57:20', '2018-05-10 18:24:09'),
(3, '13.131.313-1', 1, 1, 1, '2017-10-29 10:46:42', '2018-05-10 18:24:14'),
(4, '14.141.414-4', 7, 1, 0, '2017-10-29 11:15:53', '2018-05-10 18:19:50'),
(5, '55.555.555-5', 7, 1, 0, '2017-11-01 22:12:46', '2018-05-10 18:21:53'),
(7, '17500232-4', 7, 1, 1, '2018-02-24 09:35:16', '2018-02-24 09:35:16'),
(8, '7.171.717-1', NULL, 4, 1, '2018-05-09 02:31:12', '2018-05-09 02:31:12'),
(10, '9.888.777-3', NULL, 5, 1, '2018-05-10 20:33:31', '2018-05-10 20:33:31'),
(11, '4.111.111-1', NULL, 3, 1, '2018-05-11 00:29:50', '2018-05-11 00:29:50'),
(12, '3.111.222-3', NULL, 2, 1, '2018-05-13 19:20:38', '2018-05-13 19:20:38'),
(13, '12.323.132-3', 7, 1, 1, '2018-06-22 00:29:58', '2018-06-22 00:29:58'),
(14, '1.231.212-4', 8, 1, 1, '2018-06-22 00:35:40', '2018-06-22 00:35:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_estudio`
--

CREATE TABLE `plan_estudio` (
  `pest_id` int(10) UNSIGNED NOT NULL,
  `pest_numero` int(11) NOT NULL,
  `pest_ano` int(11) NOT NULL,
  `pest_eval_num` int(11) NOT NULL,
  `pest_eval_ano` int(11) NOT NULL,
  `pest_ano_inicio` int(11) NOT NULL,
  `pest_ano_termino` int(11) DEFAULT NULL,
  `pest_estado` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `plan_estudio`
--

INSERT INTO `plan_estudio` (`pest_id`, `pest_numero`, `pest_ano`, `pest_eval_num`, `pest_eval_ano`, `pest_ano_inicio`, `pest_ano_termino`, `pest_estado`, `created_at`, `updated_at`) VALUES
(5, 120, 0, 0, 0, 2017, 2018, 0, '2017-11-06 09:56:17', '2018-02-27 21:43:37'),
(6, 1358, 17, 112, 19, 2018, NULL, 0, '2018-02-27 21:45:20', '2018-06-28 06:59:04'),
(8, 1324, 17, 186, 21, 2018, NULL, 1, '2018-03-14 02:58:48', '2018-03-14 02:58:48'),
(9, 1412, 2001, 123, 2003, 2018, NULL, 1, '2018-03-14 03:24:00', '2018-03-14 03:24:00'),
(10, 2000, 2000, 2000, 2000, 2018, NULL, 1, '2018-03-20 18:13:09', '2018-03-23 01:22:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_organiza`
--

CREATE TABLE `plan_organiza` (
  `id` int(10) UNSIGNED NOT NULL,
  `plan_id` int(10) UNSIGNED NOT NULL,
  `nivel_id` int(10) UNSIGNED NOT NULL,
  `asignatura_id` int(10) UNSIGNED NOT NULL,
  `porg_cant_horas` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `plan_organiza`
--

INSERT INTO `plan_organiza` (`id`, `plan_id`, `nivel_id`, `asignatura_id`, `porg_cant_horas`, `created_at`, `updated_at`) VALUES
(5, 5, 1, 1, 5, NULL, NULL),
(6, 5, 1, 2, 5, NULL, NULL),
(7, 5, 1, 4, 2, NULL, NULL),
(8, 5, 2, 1, 4, NULL, NULL),
(9, 5, 2, 2, 4, NULL, NULL),
(10, 5, 2, 4, 1, NULL, NULL),
(11, 5, 3, 1, 5, NULL, NULL),
(12, 5, 3, 3, 1, NULL, NULL),
(13, 5, 4, 3, 4, NULL, NULL),
(14, 5, 4, 4, 3, NULL, NULL),
(15, 6, 1, 1, 6, NULL, NULL),
(16, 6, 1, 2, 5, NULL, NULL),
(17, 6, 1, 3, 4, NULL, NULL),
(18, 6, 1, 4, 4, NULL, NULL),
(19, 6, 2, 1, 4, NULL, NULL),
(20, 6, 2, 2, 4, NULL, NULL),
(21, 6, 2, 4, 2, NULL, NULL),
(22, 6, 2, 3, 2, NULL, NULL),
(23, 6, 3, 1, 5, NULL, NULL),
(24, 6, 3, 4, 5, NULL, NULL),
(25, 6, 3, 2, 2, NULL, NULL),
(26, 6, 4, 1, 4, NULL, NULL),
(27, 6, 4, 2, 5, NULL, NULL),
(28, 6, 4, 4, 4, NULL, NULL),
(29, 8, 1, 2, 4, NULL, NULL),
(30, 8, 1, 1, 4, NULL, NULL),
(31, 8, 1, 3, 1, NULL, NULL),
(32, 8, 1, 4, 2, NULL, NULL),
(33, 8, 2, 1, 3, NULL, NULL),
(34, 8, 2, 2, 3, NULL, NULL),
(35, 8, 2, 3, 1, NULL, NULL),
(36, 8, 2, 4, 2, NULL, NULL),
(37, 9, 3, 1, 1, NULL, NULL),
(38, 9, 3, 2, 1, NULL, NULL),
(39, 9, 3, 3, 1, NULL, NULL),
(40, 9, 4, 1, 1, NULL, NULL),
(41, 9, 4, 3, 1, NULL, NULL),
(42, 9, 4, 4, 1, NULL, NULL),
(43, 9, 4, 2, 1, NULL, NULL),
(110, 10, 1, 4, 1, NULL, NULL),
(112, 10, 1, 9, 2, NULL, NULL),
(113, 10, 1, 3, 1, NULL, NULL),
(114, 10, 1, 8, 1, NULL, NULL),
(115, 10, 2, 1, 4, NULL, NULL),
(116, 10, 2, 2, 13, NULL, NULL),
(117, 10, 2, 8, 1, NULL, NULL),
(118, 10, 2, 9, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor_especializa`
--

CREATE TABLE `profesor_especializa` (
  `id` int(10) UNSIGNED NOT NULL,
  `profesor_id` int(10) UNSIGNED NOT NULL,
  `asignatura_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `profesor_especializa`
--

INSERT INTO `profesor_especializa` (`id`, `profesor_id`, `asignatura_id`, `created_at`, `updated_at`) VALUES
(1, 5, 1, NULL, NULL),
(2, 5, 2, NULL, NULL),
(4, 4, 4, NULL, NULL),
(5, 3, 1, NULL, NULL),
(6, 2, 2, NULL, NULL),
(7, 1, 3, NULL, NULL),
(8, 7, 1, NULL, NULL),
(9, 7, 2, NULL, NULL),
(10, 7, 3, NULL, NULL),
(11, 7, 4, NULL, NULL),
(12, 13, 1, NULL, NULL),
(13, 13, 2, NULL, NULL),
(14, 14, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `prov_id` int(10) UNSIGNED NOT NULL,
  `comuna_id` int(10) UNSIGNED NOT NULL,
  `prov_razon_social` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prov_direccion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prov_contacto` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`prov_id`, `comuna_id`, `prov_razon_social`, `prov_direccion`, `prov_contacto`, `created_at`, `updated_at`) VALUES
(3, 1, 'proveedor1', 'direccion proveedor 1', 1011010, '2017-12-17 08:19:50', '2017-12-17 08:19:50'),
(5, 1, '123123', '123123', 123123, '2017-12-17 08:21:51', '2017-12-17 08:21:51'),
(7, 1, 'proveedor2', 'direccion 2', 22222222, '2017-12-19 18:44:54', '2017-12-19 18:44:54'),
(12, 1, 'nuevo proveedor', 'nueva direccion', 100000, '2018-03-10 23:38:28', '2018-03-10 23:38:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibo`
--

CREATE TABLE `recibo` (
  `rec_id` int(10) UNSIGNED NOT NULL,
  `linea_id` int(10) UNSIGNED NOT NULL,
  `factura_id` int(10) UNSIGNED NOT NULL,
  `rec_cantidad` int(11) NOT NULL,
  `rec_costo` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `recibo`
--

INSERT INTO `recibo` (`rec_id`, `linea_id`, `factura_id`, `rec_cantidad`, `rec_costo`, `created_at`, `updated_at`) VALUES
(6, 1, 3, 3, 10000, '2018-03-28 07:52:54', '2018-03-28 07:52:54'),
(7, 2, 3, 2, 200, '2018-03-28 07:52:54', '2018-03-28 07:52:54'),
(8, 3, 3, 1, 0, '2018-03-28 07:52:54', '2018-03-28 07:52:54'),
(9, 4, 4, 3, 2000, '2018-04-17 18:48:20', '2018-04-17 18:48:20'),
(10, 5, 4, 2, 4000, '2018-04-17 18:48:20', '2018-04-17 18:48:20'),
(11, 6, 4, 3, 6000, '2018-04-17 18:48:20', '2018-04-17 18:48:20'),
(12, 1, 5, 4, 23, '2018-05-23 01:47:14', '2018-05-23 01:47:14'),
(13, 2, 5, 2, 32, '2018-05-23 01:47:14', '2018-05-23 01:47:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `region`
--

CREATE TABLE `region` (
  `re_id` int(10) UNSIGNED NOT NULL,
  `re_nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `region`
--

INSERT INTO `region` (`re_id`, `re_nombre`, `created_at`, `updated_at`) VALUES
(1, 'region1', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `special` enum('all-access','no-access') COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`, `special`) VALUES
(1, 'Administrador', '', NULL, NULL, NULL, NULL),
(2, 'Director', 'DIR', NULL, NULL, NULL, NULL),
(3, 'Jefe UTP', 'UTP', NULL, NULL, NULL, NULL),
(4, 'Inspector General', 'INSP', NULL, NULL, NULL, NULL),
(5, 'Secretaria', 'SEC', NULL, NULL, NULL, NULL),
(6, 'Profesor', 'PROF', NULL, NULL, NULL, NULL),
(7, 'Apoderado', 'APOD', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semestre`
--

CREATE TABLE `semestre` (
  `sem_id` int(10) UNSIGNED NOT NULL,
  `periodo_id` int(10) UNSIGNED NOT NULL,
  `sem_numero` int(11) NOT NULL,
  `sem_estado` tinyint(1) NOT NULL,
  `sem_fecha_inicio` date NOT NULL,
  `sem_fecha_termino` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `semestre`
--

INSERT INTO `semestre` (`sem_id`, `periodo_id`, `sem_numero`, `sem_estado`, `sem_fecha_inicio`, `sem_fecha_termino`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, '2017-03-06', '2017-07-14', '2017-10-04 07:38:40', '2018-05-28 09:43:33'),
(2, 1, 2, 1, '2017-07-31', '2017-12-27', '2017-10-04 07:39:31', '2018-06-29 11:43:09'),
(3, 2, 1, 2, '2014-03-03', '2014-07-11', '2018-06-24 06:19:32', '2018-06-27 05:45:40'),
(4, 2, 2, 2, '2014-07-28', '2014-12-12', '2018-06-24 06:20:25', '2018-06-29 09:28:25'),
(5, 3, 1, 2, '2015-03-02', '2015-07-10', '2018-06-29 09:44:52', '2018-06-29 10:03:18'),
(6, 3, 2, 2, '2915-07-25', '2015-12-21', '2018-06-29 09:45:47', '2018-06-29 10:10:16'),
(7, 5, 1, 2, '2016-03-04', '2016-07-15', '2018-06-29 10:24:57', '2018-06-29 10:34:22'),
(8, 5, 2, 2, '2016-07-22', '2016-12-21', '2018-06-29 10:34:08', '2018-06-29 10:44:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_articulo`
--

CREATE TABLE `tipo_articulo` (
  `tart_id` int(10) UNSIGNED NOT NULL,
  `tart_nombre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_articulo`
--

INSERT INTO `tipo_articulo` (`tart_id`, `tart_nombre`, `created_at`, `updated_at`) VALUES
(1, 'tipoA', NULL, NULL),
(2, 'tipoB', NULL, NULL),
(3, 'tipoC', NULL, NULL),
(4, 'tipoD', NULL, NULL),
(5, 'tipoE', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_ensayo`
--

CREATE TABLE `tipo_ensayo` (
  `ten_id` int(10) UNSIGNED NOT NULL,
  `ten_tipo` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ten_descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_ensayo`
--

INSERT INTO `tipo_ensayo` (`ten_id`, `ten_tipo`, `ten_descripcion`, `created_at`, `updated_at`) VALUES
(1, 'PSU', 'ensayos psu', NULL, NULL),
(2, 'SIMCE', 'ensayos simce', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_ensayos_tienen`
--

CREATE TABLE `tipo_ensayos_tienen` (
  `id` int(10) UNSIGNED NOT NULL,
  `materia_id` int(10) UNSIGNED NOT NULL,
  `tipo_ensayo_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_ensayos_tienen`
--

INSERT INTO `tipo_ensayos_tienen` (`id`, `materia_id`, `tipo_ensayo_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 7, 2, 1, NULL, NULL),
(2, 8, 2, 1, NULL, NULL),
(3, 9, 2, 1, NULL, NULL),
(4, 10, 2, 1, NULL, NULL),
(5, 11, 2, 1, NULL, NULL),
(6, 7, 1, 1, NULL, NULL),
(7, 8, 1, 1, NULL, NULL),
(8, 9, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('member','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'member',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `us_id` int(10) UNSIGNED NOT NULL,
  `persona_rut` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rol_id` int(10) UNSIGNED NOT NULL,
  `us_username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `us_email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `us_estado` tinyint(1) NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`us_id`, `persona_rut`, `rol_id`, `us_username`, `us_email`, `us_estado`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '18.500.343-4', 1, '18.500.343-4', 'apoderado3@mail.cl', 1, '$2y$10$V/g2Kk5.ws/MHs74dMfjjO3t7gayrKRhMkpqGPn/e/43awpR1zbHK', 'VJ1iQAYMXV2XSQnhoJuntqOBXWPYZNhSD8vLFqVH7n9NO97y52fWmx6ZatTP', '2017-07-06 11:11:08', '2018-02-28 00:00:38'),
(2, '3.222.111-2', 6, '3.222.111-2', 'profesor3@asddas.cl', 1, '$2y$10$TtPtJ7NjMfzrUDHicmq8eu5WBMZxSHz4S95GM8TjU7/fBP1oKDMea', 'aFfcMBnZb7HPdJ0CILMqetdRlHCIU5ACRrrSdOPWn6f2iPaJEaW5cpmaNGTj', '2018-03-24 16:27:33', '2018-05-10 18:18:00'),
(3, '1.111.111-2', 7, '1.111.111-2', 'apod1@mail.cl', 1, '$2y$10$uV5cNaJwuQ.vcpgJUPIm2eZLRcSEtZ9T1LrwwetHEI0ZzoKVvTiMK', 'jGD3MlHVvYAl3cYrWaQ3oTqLKA508GxioSHH9axw98X6ONfkzcn3E4ltKYHe', '2018-05-08 21:14:23', '2018-05-08 21:14:23'),
(4, '7.171.717-1', 5, '7.171.717-1', 'secretaria@mail.com', 1, '$2y$10$ASmXbtM4oLzx4x2STWhI1u20wh4Yhbkks02vWLseIOfrFQVsaQL46', 'kCpNPpUiIObsQJrRnEBTetFmssRIghbXMKMcZXAuFfL8Y1XdG0dVOBtX5nUg', '2018-05-09 02:31:12', '2018-05-09 02:31:12'),
(5, '9.888.777-3', 4, '9.888.777-3', 'inspector@mail.cl', 1, '$2y$10$yYYb3JgMiYpjF4Uagjm91uHOgsvnefYomuAxuxlaF.QuiISpiGeqm', 'fZF9VGXQ8cSZ2joO63xWMYwVE4Vqa6J81xKR8SgTkvQo3hufGr29JAraf5Sp', '2018-05-10 20:33:31', '2018-05-10 20:33:31'),
(6, '4.111.111-1', 2, '4.111.111-1', 'director@mail.cl', 1, '$2y$10$eM2bDrL2tchHkj7c7zUaROOWzT/YDlSCXmhVYcQ6Eo5yXzLphKiUK', NULL, '2018-05-11 00:29:50', '2018-05-11 00:29:50'),
(7, '3.111.222-3', 3, '3.111.222-3', 'jefeutp@mail.cl', 1, '$2y$10$jRjK6A1w4cPs0IhjRZYi4.tQAGqZvwzuiRD2pNMzgic4HEVRu5nXK', 'TR8AWUtiJTgeFZV0n09hjf4I1zj8m5ylN67sIRLDASZ8lOkcqcbQsDm9QSgH', '2018-05-13 19:20:38', '2018-05-13 19:20:38');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`al_rut`),
  ADD KEY `alumno_comuna_id_foreign` (`comuna_id`);

--
-- Indices de la tabla `alumno_asiste`
--
ALTER TABLE `alumno_asiste`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alumno_asiste_matricula_id_foreign` (`matricula_id`),
  ADD KEY `alumno_asiste_dia_clase_id_foreign` (`dia_clase_id`);

--
-- Indices de la tabla `alumno_esta`
--
ALTER TABLE `alumno_esta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alumno_esta_curso_id_foreign` (`curso_id`),
  ADD KEY `alumno_esta_matricula_id_foreign` (`matricula_id`);

--
-- Indices de la tabla `alumno_realiza`
--
ALTER TABLE `alumno_realiza`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alumno_realiza_matricula_id_foreign` (`matricula_id`),
  ADD KEY `alumno_realiza_ensayo_id_foreign` (`ensayo_id`);

--
-- Indices de la tabla `alumno_tiene`
--
ALTER TABLE `alumno_tiene`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alumno_tiene_padres_rut_foreign` (`padres_rut`),
  ADD KEY `alumno_tiene_matricula_id_foreign` (`matricula_id`);

--
-- Indices de la tabla `apoderado`
--
ALTER TABLE `apoderado`
  ADD PRIMARY KEY (`ap_id`),
  ADD KEY `apoderado_persona_rut_foreign` (`persona_rut`);

--
-- Indices de la tabla `apoderado_representa`
--
ALTER TABLE `apoderado_representa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `apoderado_representa_apoderado_id_foreign` (`apoderado_id`),
  ADD KEY `apoderado_representa_matricula_id_foreign` (`matricula_id`);

--
-- Indices de la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD PRIMARY KEY (`art_item`),
  ADD KEY `articulo_tipo_id_foreign` (`tipo_id`),
  ADD KEY `articulo_bodega_id_foreign` (`bodega_id`);

--
-- Indices de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`asig_id`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`asis_id`),
  ADD KEY `asistencia_cla_realizados_id_foreign` (`cla_realizados_id`),
  ADD KEY `asistencia_matricula_id_foreign` (`matricula_id`);

--
-- Indices de la tabla `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`aul_id`);

--
-- Indices de la tabla `bodega`
--
ALTER TABLE `bodega`
  ADD PRIMARY KEY (`bo_id`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`ca_id`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`ciu_id`),
  ADD KEY `ciudad_region_id_foreign` (`region_id`);

--
-- Indices de la tabla `clases`
--
ALTER TABLE `clases`
  ADD PRIMARY KEY (`cla_id`),
  ADD KEY `clases_asignatura_id_foreign` (`asignatura_id`),
  ADD KEY `clases_curso_id_foreign` (`curso_id`),
  ADD KEY `clases_profesor_id_foreign` (`profesor_id`);

--
-- Indices de la tabla `clases_realizadas`
--
ALTER TABLE `clases_realizadas`
  ADD PRIMARY KEY (`cr_id`),
  ADD KEY `clases_realizadas_clase_id_foreign` (`clase_id`),
  ADD KEY `clases_realizadas_dia_clase_id_foreign` (`dia_clase_id`);

--
-- Indices de la tabla `comuna`
--
ALTER TABLE `comuna`
  ADD PRIMARY KEY (`com_id`),
  ADD KEY `comuna_ciudad_id_foreign` (`ciudad_id`);

--
-- Indices de la tabla `conceptos`
--
ALTER TABLE `conceptos`
  ADD PRIMARY KEY (`con_id`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`cu_id`),
  ADD KEY `curso_periodo_id_foreign` (`periodo_id`),
  ADD KEY `curso_aula_id_foreign` (`aula_id`),
  ADD KEY `curso_parametro_id_foreign` (`parametro_id`),
  ADD KEY `curso_profesor_id_foreign` (`profesor_id`),
  ADD KEY `curso_plan_estudio_id_foreign` (`plan_estudio_id`);

--
-- Indices de la tabla `detalle_pauta`
--
ALTER TABLE `detalle_pauta`
  ADD PRIMARY KEY (`dp_id`),
  ADD KEY `detalle_pauta_grupopauta_id_foreign` (`grupopauta_id`);

--
-- Indices de la tabla `dias`
--
ALTER TABLE `dias`
  ADD PRIMARY KEY (`di_id`);

--
-- Indices de la tabla `dia_clase`
--
ALTER TABLE `dia_clase`
  ADD PRIMARY KEY (`dc_id`),
  ADD KEY `dia_clase_semestre_id_foreign` (`semestre_id`);

--
-- Indices de la tabla `educacion_hermanos`
--
ALTER TABLE `educacion_hermanos`
  ADD PRIMARY KEY (`edh_id`),
  ADD KEY `educacion_hermanos_matricula_id_foreign` (`matricula_id`);

--
-- Indices de la tabla `enfermedades`
--
ALTER TABLE `enfermedades`
  ADD PRIMARY KEY (`enf_id`),
  ADD KEY `enfermedades_matricula_id_foreign` (`matricula_id`);

--
-- Indices de la tabla `ensayo`
--
ALTER TABLE `ensayo`
  ADD PRIMARY KEY (`ens_id`),
  ADD KEY `ensayo_periodo_id_foreign` (`periodo_id`),
  ADD KEY `ensayo_tipo_id_foreign` (`tipo_id`),
  ADD KEY `ensayo_materia_id_foreign` (`materia_id`);

--
-- Indices de la tabla `establecimiento_anterior`
--
ALTER TABLE `establecimiento_anterior`
  ADD PRIMARY KEY (`eant_id`);

--
-- Indices de la tabla `eva_comportamiento`
--
ALTER TABLE `eva_comportamiento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eva_comportamiento_matricula_id_foreign` (`matricula_id`),
  ADD KEY `eva_comportamiento_detallepauta_id_foreign` (`detallepauta_id`),
  ADD KEY `eva_comportamiento_concepto_id_foreign` (`concepto_id`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`fac_id`),
  ADD KEY `factura_orden_id_foreign` (`orden_id`),
  ADD KEY `factura_responsable_id_foreign` (`responsable_id`);

--
-- Indices de la tabla `grupo_pauta`
--
ALTER TABLE `grupo_pauta`
  ADD PRIMARY KEY (`gp_id`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`hor_id`),
  ADD KEY `hora_id` (`hora_id`),
  ADD KEY `horario_clases_id_foreign` (`clases_id`),
  ADD KEY `dia_id` (`dia_id`);

--
-- Indices de la tabla `horas`
--
ALTER TABLE `horas`
  ADD PRIMARY KEY (`hors_id`),
  ADD KEY `horas_periodo_id_foreign` (`periodo_id`);

--
-- Indices de la tabla `horas_horario`
--
ALTER TABLE `horas_horario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `horas_horario_horas_id_foreign` (`horas_id`),
  ADD KEY `horas_horario_horario_id_foreign` (`horario_id`);

--
-- Indices de la tabla `institucion`
--
ALTER TABLE `institucion`
  ADD PRIMARY KEY (`inst_id`);

--
-- Indices de la tabla `liceo`
--
ALTER TABLE `liceo`
  ADD PRIMARY KEY (`lic_id`);

--
-- Indices de la tabla `linea_articulo`
--
ALTER TABLE `linea_articulo`
  ADD PRIMARY KEY (`lart_id`),
  ADD KEY `linea_articulo_ordencompra_id_foreign` (`ordencompra_id`),
  ADD KEY `linea_articulo_articulo_item_foreign` (`articulo_item`);

--
-- Indices de la tabla `materia_ensayos`
--
ALTER TABLE `materia_ensayos`
  ADD PRIMARY KEY (`mens_id`);

--
-- Indices de la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`mat_id`),
  ADD KEY `matricula_alumno_rut_foreign` (`alumno_rut`),
  ADD KEY `matricula_est_anterior_id_foreign` (`est_anterior_id`),
  ADD KEY `matricula_periodo_id_foreign` (`periodo_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nivel_cursos`
--
ALTER TABLE `nivel_cursos`
  ADD PRIMARY KEY (`nic_id`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`not_id`),
  ADD KEY `notas_matricula_id_foreign` (`matricula_id`),
  ADD KEY `notas_clase_id_foreign` (`clase_id`),
  ADD KEY `notas_semestre_id_foreign` (`semestre_id`);

--
-- Indices de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  ADD PRIMARY KEY (`oc_id`),
  ADD KEY `orden_compra_proveedor_id_foreign` (`proveedor_id`);

--
-- Indices de la tabla `padres`
--
ALTER TABLE `padres`
  ADD PRIMARY KEY (`pad_rut`);

--
-- Indices de la tabla `parametro_cursos`
--
ALTER TABLE `parametro_cursos`
  ADD PRIMARY KEY (`pcur_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `periodo_academico`
--
ALTER TABLE `periodo_academico`
  ADD PRIMARY KEY (`pac_id`),
  ADD KEY `periodo_academico_liceo_id_foreign` (`liceo_id`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_slug_unique` (`slug`);

--
-- Indices de la tabla `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_permission_id_index` (`permission_id`),
  ADD KEY `permission_role_role_id_index` (`role_id`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`pe_rut`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`pers_id`),
  ADD KEY `personal_persona_rut_foreign` (`persona_rut`),
  ADD KEY `personal_institucion_id_foreign` (`institucion_id`),
  ADD KEY `personal_cargo_id_foreign` (`cargo_id`);

--
-- Indices de la tabla `plan_estudio`
--
ALTER TABLE `plan_estudio`
  ADD PRIMARY KEY (`pest_id`);

--
-- Indices de la tabla `plan_organiza`
--
ALTER TABLE `plan_organiza`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plan_organiza_asignatura_id_foreign` (`asignatura_id`),
  ADD KEY `plan_organiza_nivel_id_foreign` (`nivel_id`),
  ADD KEY `plan_organiza_plan_id_foreign` (`plan_id`);

--
-- Indices de la tabla `profesor_especializa`
--
ALTER TABLE `profesor_especializa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profesor_especializa_asignatura_id_foreign` (`asignatura_id`),
  ADD KEY `profesor_especializa_profesor_id_foreign` (`profesor_id`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`prov_id`),
  ADD KEY `proveedor_comuna_id_foreign` (`comuna_id`);

--
-- Indices de la tabla `recibo`
--
ALTER TABLE `recibo`
  ADD PRIMARY KEY (`rec_id`),
  ADD KEY `recibo_linea_id_foreign` (`linea_id`),
  ADD KEY `recibo_factura_id_foreign` (`factura_id`);

--
-- Indices de la tabla `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`re_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indices de la tabla `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_role_id_index` (`role_id`),
  ADD KEY `role_user_user_id_index` (`user_id`);

--
-- Indices de la tabla `semestre`
--
ALTER TABLE `semestre`
  ADD PRIMARY KEY (`sem_id`),
  ADD KEY `semestre_periodo_id_foreign` (`periodo_id`);

--
-- Indices de la tabla `tipo_articulo`
--
ALTER TABLE `tipo_articulo`
  ADD PRIMARY KEY (`tart_id`);

--
-- Indices de la tabla `tipo_ensayo`
--
ALTER TABLE `tipo_ensayo`
  ADD PRIMARY KEY (`ten_id`);

--
-- Indices de la tabla `tipo_ensayos_tienen`
--
ALTER TABLE `tipo_ensayos_tienen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipo_ensayos_tienen_materia_id_foreign` (`materia_id`),
  ADD KEY `tipo_ensayos_tienen_tipo_ensayo_id_foreign` (`tipo_ensayo_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`us_id`),
  ADD UNIQUE KEY `usuario_us_email_unique` (`us_email`),
  ADD KEY `usuario_persona_rut_foreign` (`persona_rut`),
  ADD KEY `usuario_rol_id_foreign` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno_asiste`
--
ALTER TABLE `alumno_asiste`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=526;
--
-- AUTO_INCREMENT de la tabla `alumno_esta`
--
ALTER TABLE `alumno_esta`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT de la tabla `alumno_realiza`
--
ALTER TABLE `alumno_realiza`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT de la tabla `alumno_tiene`
--
ALTER TABLE `alumno_tiene`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT de la tabla `apoderado`
--
ALTER TABLE `apoderado`
  MODIFY `ap_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT de la tabla `apoderado_representa`
--
ALTER TABLE `apoderado_representa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  MODIFY `asig_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `asis_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=601;
--
-- AUTO_INCREMENT de la tabla `aulas`
--
ALTER TABLE `aulas`
  MODIFY `aul_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `bodega`
--
ALTER TABLE `bodega`
  MODIFY `bo_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `ca_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `ciu_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `clases`
--
ALTER TABLE `clases`
  MODIFY `cla_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT de la tabla `clases_realizadas`
--
ALTER TABLE `clases_realizadas`
  MODIFY `cr_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;
--
-- AUTO_INCREMENT de la tabla `comuna`
--
ALTER TABLE `comuna`
  MODIFY `com_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `conceptos`
--
ALTER TABLE `conceptos`
  MODIFY `con_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `cu_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `detalle_pauta`
--
ALTER TABLE `detalle_pauta`
  MODIFY `dp_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `dias`
--
ALTER TABLE `dias`
  MODIFY `di_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `dia_clase`
--
ALTER TABLE `dia_clase`
  MODIFY `dc_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;
--
-- AUTO_INCREMENT de la tabla `educacion_hermanos`
--
ALTER TABLE `educacion_hermanos`
  MODIFY `edh_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `enfermedades`
--
ALTER TABLE `enfermedades`
  MODIFY `enf_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `ensayo`
--
ALTER TABLE `ensayo`
  MODIFY `ens_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `establecimiento_anterior`
--
ALTER TABLE `establecimiento_anterior`
  MODIFY `eant_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `eva_comportamiento`
--
ALTER TABLE `eva_comportamiento`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `fac_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `grupo_pauta`
--
ALTER TABLE `grupo_pauta`
  MODIFY `gp_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `hor_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT de la tabla `horas`
--
ALTER TABLE `horas`
  MODIFY `hors_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `horas_horario`
--
ALTER TABLE `horas_horario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `institucion`
--
ALTER TABLE `institucion`
  MODIFY `inst_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `liceo`
--
ALTER TABLE `liceo`
  MODIFY `lic_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `linea_articulo`
--
ALTER TABLE `linea_articulo`
  MODIFY `lart_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `materia_ensayos`
--
ALTER TABLE `materia_ensayos`
  MODIFY `mens_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `matricula`
--
ALTER TABLE `matricula`
  MODIFY `mat_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT de la tabla `nivel_cursos`
--
ALTER TABLE `nivel_cursos`
  MODIFY `nic_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `not_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;
--
-- AUTO_INCREMENT de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  MODIFY `oc_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `parametro_cursos`
--
ALTER TABLE `parametro_cursos`
  MODIFY `pcur_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `periodo_academico`
--
ALTER TABLE `periodo_academico`
  MODIFY `pac_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `pers_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `plan_estudio`
--
ALTER TABLE `plan_estudio`
  MODIFY `pest_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `plan_organiza`
--
ALTER TABLE `plan_organiza`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;
--
-- AUTO_INCREMENT de la tabla `profesor_especializa`
--
ALTER TABLE `profesor_especializa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `prov_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `recibo`
--
ALTER TABLE `recibo`
  MODIFY `rec_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `region`
--
ALTER TABLE `region`
  MODIFY `re_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `semestre`
--
ALTER TABLE `semestre`
  MODIFY `sem_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `tipo_articulo`
--
ALTER TABLE `tipo_articulo`
  MODIFY `tart_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `tipo_ensayo`
--
ALTER TABLE `tipo_ensayo`
  MODIFY `ten_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tipo_ensayos_tienen`
--
ALTER TABLE `tipo_ensayos_tienen`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `us_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `alumno_comuna_id_foreign` FOREIGN KEY (`comuna_id`) REFERENCES `comuna` (`com_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `alumno_asiste`
--
ALTER TABLE `alumno_asiste`
  ADD CONSTRAINT `alumno_asiste_dia_clase_id_foreign` FOREIGN KEY (`dia_clase_id`) REFERENCES `dia_clase` (`dc_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `alumno_asiste_matricula_id_foreign` FOREIGN KEY (`matricula_id`) REFERENCES `matricula` (`mat_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `alumno_esta`
--
ALTER TABLE `alumno_esta`
  ADD CONSTRAINT `alumno_esta_curso_id_foreign` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`cu_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `alumno_esta_matricula_id_foreign` FOREIGN KEY (`matricula_id`) REFERENCES `matricula` (`mat_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `alumno_realiza`
--
ALTER TABLE `alumno_realiza`
  ADD CONSTRAINT `alumno_realiza_ensayo_id_foreign` FOREIGN KEY (`ensayo_id`) REFERENCES `ensayo` (`ens_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `alumno_realiza_matricula_id_foreign` FOREIGN KEY (`matricula_id`) REFERENCES `matricula` (`mat_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `alumno_tiene`
--
ALTER TABLE `alumno_tiene`
  ADD CONSTRAINT `alumno_tiene_matricula_id_foreign` FOREIGN KEY (`matricula_id`) REFERENCES `matricula` (`mat_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `alumno_tiene_padres_rut_foreign` FOREIGN KEY (`padres_rut`) REFERENCES `padres` (`pad_rut`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `apoderado`
--
ALTER TABLE `apoderado`
  ADD CONSTRAINT `apoderado_persona_rut_foreign` FOREIGN KEY (`persona_rut`) REFERENCES `persona` (`pe_rut`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `apoderado_representa`
--
ALTER TABLE `apoderado_representa`
  ADD CONSTRAINT `apoderado_representa_apoderado_id_foreign` FOREIGN KEY (`apoderado_id`) REFERENCES `apoderado` (`ap_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `apoderado_representa_matricula_id_foreign` FOREIGN KEY (`matricula_id`) REFERENCES `matricula` (`mat_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD CONSTRAINT `articulo_bodega_id_foreign` FOREIGN KEY (`bodega_id`) REFERENCES `bodega` (`bo_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `articulo_tipo_id_foreign` FOREIGN KEY (`tipo_id`) REFERENCES `tipo_articulo` (`tart_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `asistencia_cla_realizados_id_foreign` FOREIGN KEY (`cla_realizados_id`) REFERENCES `clases_realizadas` (`cr_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `asistencia_matricula_id_foreign` FOREIGN KEY (`matricula_id`) REFERENCES `matricula` (`mat_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD CONSTRAINT `ciudad_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `region` (`re_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `clases`
--
ALTER TABLE `clases`
  ADD CONSTRAINT `clases_asignatura_id_foreign` FOREIGN KEY (`asignatura_id`) REFERENCES `asignatura` (`asig_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `clases_curso_id_foreign` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`cu_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `clases_profesor_id_foreign` FOREIGN KEY (`profesor_id`) REFERENCES `personal` (`pers_id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `clases_realizadas`
--
ALTER TABLE `clases_realizadas`
  ADD CONSTRAINT `clases_realizadas_clase_id_foreign` FOREIGN KEY (`clase_id`) REFERENCES `clases` (`cla_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `clases_realizadas_dia_clase_id_foreign` FOREIGN KEY (`dia_clase_id`) REFERENCES `dia_clase` (`dc_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `comuna`
--
ALTER TABLE `comuna`
  ADD CONSTRAINT `comuna_ciudad_id_foreign` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudad` (`ciu_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `curso_aula_id_foreign` FOREIGN KEY (`aula_id`) REFERENCES `aulas` (`aul_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `curso_parametro_id_foreign` FOREIGN KEY (`parametro_id`) REFERENCES `parametro_cursos` (`pcur_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `curso_periodo_id_foreign` FOREIGN KEY (`periodo_id`) REFERENCES `periodo_academico` (`pac_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `curso_plan_estudio_id_foreign` FOREIGN KEY (`plan_estudio_id`) REFERENCES `plan_estudio` (`pest_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `curso_profesor_id_foreign` FOREIGN KEY (`profesor_id`) REFERENCES `personal` (`pers_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `detalle_pauta`
--
ALTER TABLE `detalle_pauta`
  ADD CONSTRAINT `detalle_pauta_grupopauta_id_foreign` FOREIGN KEY (`grupopauta_id`) REFERENCES `grupo_pauta` (`gp_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

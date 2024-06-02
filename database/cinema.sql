-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2024 at 01:28 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinema`
--

-- --------------------------------------------------------

--
-- Table structure for table `cine`
--

CREATE TABLE `cine` (
  `id` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `calle` varchar(30) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `tarifa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cine`
--

INSERT INTO `cine` (`id`, `nombre`, `calle`, `telefono`, `tarifa`) VALUES
(1, 'ABC el saler', 'Centro comercial el Saler', '39758403', 1),
(5, 'borrar', 'nose', '123314124', 4),
(10, 'AAAAAA', 'aaaaaaaaaa1', '111111111111', 3),
(12, 'testagfgfc', 'c test', '123456', 3);

-- --------------------------------------------------------

--
-- Table structure for table `clasificacion`
--

CREATE TABLE `clasificacion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clasificacion`
--

INSERT INTO `clasificacion` (`id`, `nombre`) VALUES
(1, 'T. menores'),
(2, 'No rec. menores 13 años');

-- --------------------------------------------------------

--
-- Table structure for table `genero`
--

CREATE TABLE `genero` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genero`
--

INSERT INTO `genero` (`id`, `nombre`) VALUES
(1, 'dibujos'),
(2, 'comedia'),
(3, 'drama');

-- --------------------------------------------------------

--
-- Table structure for table `pelicula`
--

CREATE TABLE `pelicula` (
  `id` int(11) NOT NULL,
  `titulo` varchar(30) NOT NULL,
  `director` varchar(30) NOT NULL,
  `clasificacion` int(11) NOT NULL,
  `protagonista` int(11) NOT NULL,
  `genero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelicula`
--

INSERT INTO `pelicula` (`id`, `titulo`, `director`, `clasificacion`, `protagonista`, `genero`) VALUES
(1, 'Carrington', 'Christopher Hampton', 1, 1, 3),
(2, 'Pocahontas', 'Mike Gabriel', 1, 3, 1),
(20, 'aaaaaaaaaaaaa', 'aaa', 1, 20, 1),
(22, 'sapasds', 'passaas', 1, 22, 1),
(24, 'dtdhthtf', 'jhgjgj', 1, 24, 2);

-- --------------------------------------------------------

--
-- Table structure for table `protagonista`
--

CREATE TABLE `protagonista` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `nombre2` varchar(30) DEFAULT NULL,
  `nombre3` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `protagonista`
--

INSERT INTO `protagonista` (`id`, `nombre`, `nombre2`, `nombre3`) VALUES
(1, 'Jonathan Pryce', 'Emma Thompson', ''),
(3, 'prueba', 'prueba', NULL),
(20, 'aaaa', 'bbbb', ''),
(22, 'saioasoas', 'ncccvn', ''),
(24, 'esfdgjh', 'kjhkhkb', '');

-- --------------------------------------------------------

--
-- Table structure for table `proyectar`
--

CREATE TABLE `proyectar` (
  `id_cine` int(11) NOT NULL,
  `id_pelicula` int(11) NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `proyectar`
--

INSERT INTO `proyectar` (`id_cine`, `id_pelicula`, `hora`) VALUES
(1, 1, '10:30:00'),
(1, 2, '16:30:30'),
(2, 2, '10:30:00'),
(10, 20, '23:12:00'),
(10, 22, '18:26:00'),
(12, 24, '07:38:00');

-- --------------------------------------------------------

--
-- Table structure for table `tarifa`
--

CREATE TABLE `tarifa` (
  `id` int(11) NOT NULL,
  `dia` varchar(25) NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tarifa`
--

INSERT INTO `tarifa` (`id`, `dia`, `precio`) VALUES
(1, 'día del espectador', 10),
(2, 'día del jubilado', 20),
(3, 'festivos y vísperas', 30),
(4, 'carnet de estudiante', 40);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contrasena` varchar(30) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `hint` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `contrasena`, `admin`, `hint`) VALUES
(2, 'admin@admin.com', 'admin', 1, 'admin'),
(4, 'test@test.com', 'test', 0, '\"hint test\"'),
(6, 'aaa@aaa.com', 'aaa', 0, 'aaa'),
(10, 'bbb@bbb.com', 'bbb', 0, 'escribe bbb'),
(11, 'ccc@ccc.com', 'ccc', 0, '3 c');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cine`
--
ALTER TABLE `cine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clasificacion`
--
ALTER TABLE `clasificacion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelicula`
--
ALTER TABLE `pelicula`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `protagonista`
--
ALTER TABLE `protagonista`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proyectar`
--
ALTER TABLE `proyectar`
  ADD PRIMARY KEY (`id_cine`,`id_pelicula`);

--
-- Indexes for table `tarifa`
--
ALTER TABLE `tarifa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cine`
--
ALTER TABLE `cine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `clasificacion`
--
ALTER TABLE `clasificacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `genero`
--
ALTER TABLE `genero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pelicula`
--
ALTER TABLE `pelicula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `protagonista`
--
ALTER TABLE `protagonista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tarifa`
--
ALTER TABLE `tarifa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

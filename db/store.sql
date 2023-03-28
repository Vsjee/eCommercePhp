-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2023 at 04:41 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `P_ID` int(11) NOT NULL,
  `P_NAME` varchar(50) NOT NULL,
  `P_PRICE` float NOT NULL,
  `P_DISCOUNT` int(11) NOT NULL,
  `P_AVAILABILITY` tinyint(1) NOT NULL,
  `P_URL` varchar(200) NOT NULL,
  `P_DESCRIPTION` varchar(300) NOT NULL,
  `P_CATEGORY` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`P_ID`, `P_NAME`, `P_PRICE`, `P_DISCOUNT`, `P_AVAILABILITY`, `P_URL`, `P_DESCRIPTION`, `P_CATEGORY`) VALUES
(1, 'terreneitor', 3333330, 0, 1, 'https://images3.memedroid.com/images/UPLOADED625/63c5fbc67a7d9.webp', 'terreneitor la maquina mas veloz de toda italia', 'toy'),
(2, 'iPhone 13', 5680000, 0, 1, 'https://cdn.shopify.com/s/files/1/0604/8373/1606/products/IMG-6206240_600x.jpg?v=1661520210', 'Compatibilidad de red: 2G/3G/4G/5G\r\nTipo y Versión de SW: iOS 16\r\nCapacidad memoria RAM: 4 GB\r\nCapacidad de memoria interna en GigaBytes (GB): 128, 256 y 512 GB', 'mobile'),
(3, 'AMD RYZEN 7 3700X', 1699000, 0, 1, 'https://www.pcware.com.co/wp-content/uploads/2020/10/ryzen1.webp', 'Creados para servir mayor poder a usuarios exigentes. Asegura tu triunfo con procesadores de alto desempeño. Mayor eficiencia con un performance de  memoria optimizado.', 'hardware'),
(4, 'IdeaPad 5 Gen 7 (14\" AMD)', 2850000, 0, 1, 'https://www.notebookcheck.com/fileadmin/Notebooks/News/_nc3/lenovo_laptop_ideapad_5_pro_gen_7_gallery_8_9.jpg', 'Laptop elegante de 14\" con procesadores móviles AMD Ryzen™\r\nTarjeta gráfica AMD Radeon™ integrada para un alto rendimiento sin problemas\r\nChasis delgado totalmente metálico (opcional) para ofrecer portabilidad y durabilidad', 'computer'),
(5, 'Samsung s23', 4500000, 0, 1, 'https://images.samsung.com/co/smartphones/galaxy-s23/buy/kv_group_PC_v2.jpg', 'Consigue todos los detalles\r\nCapture más detalles con una cámara gran angular de 50MP.3 La tecnología Detail Enhancer utiliza IA para mejorar la profundidad y definición para obtener fotos de una calidad sorprendentemente alta.', 'mobile'),
(6, 'Airpods (3.ª generación)', 999999, 0, 1, 'https://cdn.shopify.com/s/files/1/0604/8373/1606/products/Airpods_PDP_Image_Position-1__ESES_600x.jpg?v=1662986473', '\r\nLos AirPods (tercera generación) cuentan con audio espacial personalizado para que disfrutes un sonido envolvente, mayor duración de la batería y resistencia al agua y al sudor. Prepárate para una experiencia llena de magia.', 'hearphones'),
(7, 'Amazon Echo Dot 3', 200000, 0, 1, 'https://falabella.scene7.com/is/image/FalabellaCO/3808526_1?wid=1500&hei=1500&qlt=70', 'Tamaño empaque: 12 x 10 x 11.5 cm\r\nTamaño producto: 4.3 x 9.9 x 9.9 cm\r\nSonido 360\r\n4 Micrófonos incorporados con reconocimiento de voz de campo lejano, que permite usarlo en el modo manos libres', 'electronic'),
(8, 'megafono', 250000, 0, 1, 'https://images.unsplash.com/photo-1517816428104-797678c7cf0c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80', 'aparato con forma de cono utilizado para amplificar sonidos.', 'electronic'),
(9, 'Gafas 3d', 100000, 0, 1, 'https://http2.mlstatic.com/D_NQ_NP_966499-MCO31545311148_072019-O.webp', '-Visor de alta calidad, Alta definición Sensor de movimiento\r\n-Despierta tus sentidos siente el vació de una caída\r\n-Diseñado para personas que usan o no lentes\r\n-Lente graduable para mayor nitidez y cuidado de tus ojos', 'electronic'),
(10, 'Xiaomi Mi Smart Band 7', 182000, 0, 1, 'https://http2.mlstatic.com/D_NQ_NP_740669-MLA50416735265_062022-O.webp', 'Monitor de saturación de oxígeno en sangre\r\nEl nivel de oxígeno en sangre es un indicador muy importante para determinar el bienestar general. Podrás controlar este dato desde tu muñeca y evaluar tu condición física mientras realices tus actividades diarias o en sesiones de entrenamiento intenso.\r\n', 'electronic');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`P_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `P_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

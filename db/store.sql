-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2023 at 03:13 AM
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
-- Table structure for table `autochat`
--

CREATE TABLE `autochat` (
  `id` int(11) NOT NULL,
  `replies` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `queries` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `autochat`
--

INSERT INTO `autochat` (`id`, `replies`, `queries`) VALUES
(1, 'Hola, mucho gusto soy botyuda =D', 'Hola'),
(3, 'Esto es en lo que te puedo ayudar,\n                                                           1. Dudas sobre la compra\n                                                           2. Como eliminar cuenta de usuario\n                                                           3. Tiempo en que llega mi pedido?\n                                                           4. Cual es el limite de productos por compra?', 'Ayuda'),
(4, 'Estas son algunas dudas frecuentes sobre la compra, 1C. Hacen envios a las afueras de bogota?\r\n                                                           2C. Puedo hacer una devoulción?\r\n                                                           3C. Metodos de pago\r\n                                                           4C. Es seguro comprar?\r\n                                                           \r\n                                                          ', '1'),
(5, 'Para eliminar tu cuenta, por el momento no contamos con esa funcion, pero si puedes enviarnos un correo a techstore@techstore.com.co y te hariamos la eliminacion del sistema', '2'),
(6, 'De 3 a 7 dias habiles y si es un envio fuera de bogota seria de 7 a 15 dias habiles', '3'),
(7, 'El limite maximo es de 10 unidades por usuarios de cada producto', '4'),
(8, 'Por supuesto, a todos los rincones del pais, animate y compra!', '1C'),
(9, 'Tienes maximo 15 dias desde el dia de la compra , ten encuenta el producto tiene que estar en perfecto estado de caso contrario no sera aceptada!', '2C'),
(10, 'Manejamos, tarjetas de credito, PSE, mercado pago y efecty =D', '3C'),
(11, 'No tienes que preocuparte ya que el sistema que utilizamos ser llama \"mercado pago\" lider a nivel mundial de pagos en linea!', '4C');

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
  `P_CATEGORY` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `P_BUY_NOW` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`P_ID`, `P_NAME`, `P_PRICE`, `P_DISCOUNT`, `P_AVAILABILITY`, `P_URL`, `P_DESCRIPTION`, `P_CATEGORY`, `P_BUY_NOW`) VALUES
(1, 'terreneitor', 3333330, 0, 1, '', 'terreneitor la maquina mas veloz de toda italia', 'toy', 'https://mpago.li/18E1ZDS'),
(2, 'iPhone 13', 5680000, 10, 1, 'https://cdn.shopify.com/s/files/1/0604/8373/1606/products/IMG-6206240_600x.jpg?v=1661520210', 'Compatibilidad de red: 2G/3G/4G/5G\r\nTipo y Versión de SW: iOS 16\r\nCapacidad memoria RAM: 4 GB\r\nCapacidad de memoria interna en GigaBytes (GB): 128, 256 y 512 GB', 'mobile', 'https://mpago.li/2D54RqL'),
(3, 'AMD RYZEN 7 3700X', 1699000, 0, 1, 'https://www.pcware.com.co/wp-content/uploads/2020/10/ryzen1.webp', 'Creados para servir mayor poder a usuarios exigentes. Asegura tu triunfo con procesadores de alto desempeño. Mayor eficiencia con un performance de  memoria optimizado.', 'hardware', 'https://mpago.li/22jo2TZ'),
(4, 'IdeaPad 5 Gen 7 (14\" AMD)', 2850000, 0, 1, 'https://www.notebookcheck.com/fileadmin/Notebooks/News/_nc3/lenovo_laptop_ideapad_5_pro_gen_7_gallery_8_9.jpg', 'Laptop elegante de 14\" con procesadores móviles AMD Ryzen™\r\nTarjeta gráfica AMD Radeon™ integrada para un alto rendimiento sin problemas\r\nChasis delgado totalmente metálico (opcional) para ofrecer portabilidad y durabilidad', 'computer', 'https://mpago.li/2CQnYJZ'),
(5, 'Samsung s23', 4500000, 0, 1, 'https://images.samsung.com/co/smartphones/galaxy-s23/buy/kv_group_PC_v2.jpg', 'Consigue todos los detalles\r\nCapture más detalles con una cámara gran angular de 50MP.3 La tecnología Detail Enhancer utiliza IA para mejorar la profundidad y definición para obtener fotos de una calidad sorprendentemente alta.', 'mobile', 'https://mpago.li/1bUnwsJ'),
(6, 'Airpods (3.ª generación)', 999999, 0, 1, 'https://cdn.shopify.com/s/files/1/0604/8373/1606/products/Airpods_PDP_Image_Position-1__ESES_600x.jpg?v=1662986473', '\r\nLos AirPods (tercera generación) cuentan con audio espacial personalizado para que disfrutes un sonido envolvente, mayor duración de la batería y resistencia al agua y al sudor. Prepárate para una experiencia llena de magia.', 'hearphones', 'https://mpago.li/12FpDtA'),
(7, 'Amazon Echo Dot 3', 200000, 0, 1, 'https://falabella.scene7.com/is/image/FalabellaCO/3808526_1?wid=1500&hei=1500&qlt=70', 'Tamaño empaque: 12 x 10 x 11.5 cm\r\nTamaño producto: 4.3 x 9.9 x 9.9 cm\r\nSonido 360\r\n4 Micrófonos incorporados con reconocimiento de voz de campo lejano, que permite usarlo en el modo manos libres', 'electronic', 'https://mpago.li/1vhfhNC'),
(8, 'megafono', 250000, 0, 1, 'https://images.unsplash.com/photo-1517816428104-797678c7cf0c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80', 'aparato con forma de cono utilizado para amplificar sonidos.', 'electronic', 'https://mpago.li/2WiK6bW'),
(9, 'Gafas 3d', 100000, 0, 1, 'https://http2.mlstatic.com/D_NQ_NP_966499-MCO31545311148_072019-O.webp', '-Visor de alta calidad, Alta definición Sensor de movimiento\r\n-Despierta tus sentidos siente el vació de una caída\r\n-Diseñado para personas que usan o no lentes\r\n-Lente graduable para mayor nitidez y cuidado de tus ojos', 'electronic', 'https://mpago.li/2hzhkFF'),
(10, 'Xiaomi Mi Smart Band 7', 280000, 0, 1, 'https://http2.mlstatic.com/D_NQ_NP_740669-MLA50416735265_062022-O.webp', 'Monitor de saturación de oxígeno en sangre\r\nEl nivel de oxígeno en sangre es un indicador muy importante para determinar el bienestar general. Podrás controlar este dato desde tu muñeca y evaluar tu condición física mientras realices tus actividades diarias o en sesiones de entrenamiento intenso.\r\n', 'electronic', 'https://mpago.li/2vTRXij');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `U_ID` int(11) NOT NULL,
  `U_NAME` varchar(50) NOT NULL,
  `U_EMAIL` varchar(60) NOT NULL,
  `U_PASSWORD` varchar(20) NOT NULL,
  `P_TYPE` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`U_ID`, `U_NAME`, `U_EMAIL`, `U_PASSWORD`, `P_TYPE`) VALUES
(1, 'david', 'david@gmail.com', '123', 'user'),
(2, 'Felipe', 'felipe@gmail.com', '123', 'admin'),
(3, 'Frontend Developer', 'generic@gmail.com', '123', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autochat`
--
ALTER TABLE `autochat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`P_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`U_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `autochat`
--
ALTER TABLE `autochat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `P_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `U_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

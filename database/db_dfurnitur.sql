-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2024 at 04:17 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_dfurnitur`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_dokumentasi`
--

CREATE TABLE `tb_dokumentasi` (
  `id_dokumentasi` int(11) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `file_d` text NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `terjual` varchar(255) NOT NULL,
  `tinggi` varchar(11) NOT NULL,
  `panjang` varchar(11) NOT NULL,
  `lebar` varchar(11) NOT NULL,
  `bahan` varchar(255) NOT NULL,
  `stok` varchar(255) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_dokumentasi`
--

INSERT INTO `tb_dokumentasi` (`id_dokumentasi`, `thumbnail`, `file_d`, `nama_produk`, `terjual`, `tinggi`, `panjang`, `lebar`, `bahan`, `stok`, `harga`, `tanggal`, `deskripsi`, `views`) VALUES
(23, 'a2cce8b8e052e0d5363f74de27b5808e.jpg', 'chair12.glb', 'Kursi Putih', '3', '130', '60', '70', 'kayu dan kain pilhan no 1 di kelas nya', '47', '100.000', '2024-06-01', '-', 0),
(24, 'cda80d7020cdc909be4f5737d018bbbc.jpg', 'chair2.glb', 'kursi coklat', '2', '80', '50', '60', 'kayu jati dan kain pilihan', '28', '150.000', '2024-06-07', '-', 0),
(25, 'f937b8a022a5d0a8fae63215724435cf.jpg', 'chair3.glb', 'kursi merah plastik besi', '45', '125', '60', '70', 'besi alumunium dan plastik tahan banting', '0', '120.000', '2024-06-05', '-', 0),
(26, '13ad9a8ba82e242e6d075b2151725e9d.jpg', 'chair5.glb', 'kursi 5', '50', '120', '50', '60', 'kulit', '0', '500.000', '2024-06-20', 'Kursi Putih adalah pilihan sempurna untuk menghadirkan sentuhan elegan dan minimalis dalam ruang Anda. Didesain dengan kesederhanaan yang memikat, kursi ini menggabungkan keindahan estetika putih bersih dengan kenyamanan yang luar biasa.', 0),
(27, '820f867559eedbb658113096ec000b42.jpg', 'chair6.glb', 'kursi 6 kayu', '200', '130', '60', '60', 'kayu dan kain pilihan', '0', '60.000', '2024-05-28', '-', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_quote`
--

CREATE TABLE `tb_quote` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `quote` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_quote`
--

INSERT INTO `tb_quote` (`id`, `nama`, `pekerjaan`, `profile`, `quote`) VALUES
(1, 'Anggita', 'Founder of Ga tau', '83d56d1dd4544fd2fd9f5ad6931090d4.jpg', 'Rasa bahagia dan tak bahagia bukan berasal dari apa yang kamu miliki, bukan pula berasal dari siapa diri kamu, atau apa yang kamu kerjakan. Bahagia dan tak bahagia berasal dari pikiran kamu.');

-- --------------------------------------------------------

--
-- Table structure for table `tb_settings`
--

CREATE TABLE `tb_settings` (
  `id` int(11) NOT NULL,
  `judul_halaman` varchar(255) DEFAULT NULL,
  `text_sambutan` varchar(255) DEFAULT NULL,
  `desc_sambutan` text DEFAULT NULL,
  `sampul_website` varchar(255) DEFAULT NULL,
  `desc_web` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `phone` char(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_settings`
--

INSERT INTO `tb_settings` (`id`, `judul_halaman`, `text_sambutan`, `desc_sambutan`, `sampul_website`, `desc_web`, `alamat`, `phone`, `email`, `twitter`, `facebook`, `instagram`) VALUES
(1, 'D furniture', 'Welcome To D Furnitur', 'Tempat Jual beli kebutuhan Furnitur/Mebel', '22e0d21afa01848d98d0a78c6c228ed8.png', 'Menghadirkan kehangatan dan kenyamanan ke dalam setiap ruang. Kami berkomitmen untuk memberikan Anda produk berkualitas tinggi dengan desain elegan dan fungsional. Temukan koleksi furnitur eksklusif kami yang dirancang khusus untuk memenuhi kebutuhan dan ', 'BANDUNG', '62895346801530', 'rais.akbar3110@gmail.com', '#', '#', 'https://instagram.com/raisakbarrr');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id_users` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id_users`, `nama`, `email`, `password`, `role`) VALUES
(1, 'rais', 'rais@gmail.com', '$2y$10$TnNdbIitGkEP1r50KIBQF.KToYmu5RmL1vtD.1Hrwzf5zSwSzotA.', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_dokumentasi`
--
ALTER TABLE `tb_dokumentasi`
  ADD PRIMARY KEY (`id_dokumentasi`);

--
-- Indexes for table `tb_quote`
--
ALTER TABLE `tb_quote`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_settings`
--
ALTER TABLE `tb_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_dokumentasi`
--
ALTER TABLE `tb_dokumentasi`
  MODIFY `id_dokumentasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tb_quote`
--
ALTER TABLE `tb_quote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_settings`
--
ALTER TABLE `tb_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

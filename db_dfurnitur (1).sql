-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2024 at 12:15 PM
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
-- Table structure for table `tb_diskon`
--

CREATE TABLE `tb_diskon` (
  `id_diskon` int(11) NOT NULL,
  `jumlah_diskon` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_dokumentasi`
--

CREATE TABLE `tb_dokumentasi` (
  `id_dokumentasi` int(11) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `file_d` text NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `terjual` varchar(255) NOT NULL,
  `tinggi` varchar(11) NOT NULL,
  `panjang` varchar(11) NOT NULL,
  `lebar` varchar(11) NOT NULL,
  `bahan` varchar(255) NOT NULL,
  `stok` varchar(255) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `diskon` varchar(2) NOT NULL,
  `views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_dokumentasi`
--

INSERT INTO `tb_dokumentasi` (`id_dokumentasi`, `thumbnail`, `file_d`, `nama_produk`, `id_kategori`, `terjual`, `tinggi`, `panjang`, `lebar`, `bahan`, `stok`, `harga`, `tanggal`, `deskripsi`, `diskon`, `views`) VALUES
(23, 'a2cce8b8e052e0d5363f74de27b5808e.jpg', 'chair23.glb', 'Kursi Putih', 2, '100', '130', '60', '70', 'kayu dan kain pilhan no 1 di kelas nya', '400', '100000', '2024-06-01', '-', '', 0),
(24, 'cda80d7020cdc909be4f5737d018bbbc.jpg', 'chair2.glb', 'kursi coklat', 2, '160', '80', '50', '60', 'kayu jati dan kain pilihan', '340', '150000', '2024-06-07', '-', '', 0),
(25, 'f937b8a022a5d0a8fae63215724435cf.jpg', 'chair3.glb', 'kursi merah plastik besi', 3, '50', '125', '60', '70', 'besi alumunium dan plastik tahan banting', '450', '50000', '2024-06-05', '-', '', 0),
(26, '13ad9a8ba82e242e6d075b2151725e9d.jpg', 'chair5.glb', 'kursi 5', 3, '0', '120', '50', '60', 'kulit', '200', '500000', '2024-06-20', 'Kursi Putih adalah pilihan sempurna untuk menghadirkan sentuhan elegan dan minimalis dalam ruang Anda. Didesain dengan kesederhanaan yang memikat, kursi ini menggabungkan keindahan estetika putih bersih dengan kenyamanan yang luar biasa.', '', 0),
(27, '820f867559eedbb658113096ec000b42.jpg', 'chair6.glb', 'kursi 6 kayu', 2, '0', '130', '60', '60', 'kayu dan kain pilihan', '200', '60000', '2024-05-28', '-', '', 0),
(28, '97396dcff6caa85d35ed5fd04cb73472.jpg', 'chair4.glb', 'Kursi 4', 3, '0', '130', '60', '60', 'kain kualitas tinggi', '200', '150000', '2024-07-06', '-', '', 0),
(29, '941bc4b6312170f27f5847bbf8534aea.jpg', 'chair2.glb', 'PAKET 3 KURSI', 3, '0', '130', '60', '70', 'kayu dan kain pilhan no 1 di kelas nya', '200', '200000', '2024-07-05', 'Satu paket dapat 3 kursi dengan 3 warna', '', 0),
(30, 'a1bb11cc4300672fde3a8faff7b37301.jpg', 'chair1.glb', 'KURSI DAN MEJA KANTOR', 3, '0', '100', '100', '70', 'KAYU, DLL', '100', '1000000', '2024-07-07', 'INI ADALAH KURSI DAN MEJA KANTOR ', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_produk`
--

CREATE TABLE `tb_kategori_produk` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `deskripsi_kategori` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kategori_produk`
--

INSERT INTO `tb_kategori_produk` (`id_kategori`, `nama_kategori`, `deskripsi_kategori`) VALUES
(2, 'Lemari', 'all type lemari edit'),
(3, 'Kursi', 'all type kursi');

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
(3, 'Rais Akbar', 'Bintel Satpurat 806', '18fd02b6c37d64fd5803b63037427e1e.jpeg', 'bagus agar kita bisa melihat dulu produk sebelum kita beli'),
(4, 'Akbar Sidik', 'Mahasiswa', 'd8aff695d6719fb494e6b334f1390226.jpeg', 'sangat inovatif dalam melakukan penerapan ar di dalam marketplace ini');

-- --------------------------------------------------------

--
-- Table structure for table `tb_riwayatpenjualan`
--

CREATE TABLE `tb_riwayatpenjualan` (
  `id_penjualan` int(11) NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `id_dokumentasi` int(11) NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `no_wa` varchar(15) NOT NULL,
  `kuantitas` varchar(4) NOT NULL,
  `diskon` varchar(255) NOT NULL,
  `ongkos_kirim` varchar(255) NOT NULL,
  `total_harga` varchar(255) NOT NULL,
  `metode_pembayaran` varchar(255) NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `status_pembayaran` varchar(255) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `status_anggota` varchar(255) NOT NULL,
  `catatan` text NOT NULL,
  `nama_produk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_riwayatpenjualan`
--

INSERT INTO `tb_riwayatpenjualan` (`id_penjualan`, `nama_pelanggan`, `id_dokumentasi`, `alamat_pengiriman`, `no_wa`, `kuantitas`, `diskon`, `ongkos_kirim`, `total_harga`, `metode_pembayaran`, `bukti_pembayaran`, `status_pembayaran`, `tanggal_pembelian`, `status_anggota`, `catatan`, `nama_produk`) VALUES
(24, 'rais', 23, 'kp. bismilah', '0895346801530', '100', '5', '100000', '9500000', 'Offline Di Toko', '736d155b8244704909ff0e4dcec2d3161.jpg', 'Lunas', '2024-07-14', 'Tidak Terdaftar', 'akan di kirim hari ini', 'Kursi Putih'),
(25, 'akbar', 24, 'komplek', '0893335645', '150', '0', '0', '22500000', 'Offline Di Toko', '', 'Lunas', '2024-07-14', 'Terdaftar', 'sudah terkirim', 'kursi coklat'),
(26, 'sidik', 25, 'kp. kiw kiw', '08983945839', '50', '0', '0', '2500000', 'Offline Di Toko', '', 'Lunas', '2024-07-14', 'Terdaftar', 'belum di kirim', 'kursi merah plastik besi'),
(27, 'pembeli1', 24, '-', '097809708', '10', '0', '0', '1500000', 'Offline Di Toko', '941bc4b6312170f27f5847bbf8534aea1.jpg', 'Lunas', '2024-07-14', 'Terdaftar', '3343rwef', 'kursi coklat');

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
(1, 'D furnitur', 'Welcome To D Furnitur', 'Tempat Jual beli kebutuhan Furnitur', '22e0d21afa01848d98d0a78c6c228ed8.png', 'Menghadirkan kehangatan dan kenyamanan ke dalam setiap ruang. Kami berkomitmen untuk memberikan Anda produk berkualitas tinggi dengan desain elegan dan fungsional. Temukan koleksi furnitur eksklusif kami yang dirancang khusus untuk memenuhi kebutuhan dan ', 'BANDUNG', '62895346801530', 'rais.akbar3110@gmail.com', '#', '#', 'https://instagram.com/raisakbarrr');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id_users` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL,
  `tgl_daftar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id_users`, `nama`, `email`, `password`, `role`, `tgl_daftar`) VALUES
(1, 'admin', 'rais@gmail.com', '$2y$10$TnNdbIitGkEP1r50KIBQF.KToYmu5RmL1vtD.1Hrwzf5zSwSzotA.', 'admin', '0000-00-00'),
(2, 'pemilik', 'pemilik@gmail.com', 'pemilik', 'pemilik', '0000-00-00'),
(3, 'user', 'user@gmail.com', '$2y$10$TnNdbIitGkEP1r50KIBQF.KToYmu5RmL1vtD.1Hrwzf5zSwSzotA.', 'user', '2024-07-01'),
(4, 'user2', 'user2@gmail.com', '$2y$10$TnNdbIitGkEP1r50KIBQF.KToYmu5RmL1vtD.1Hrwzf5zSwSzotA.', 'user', '2024-07-07'),
(8, 'RAIS AKBAR SIDIK', 'rais.akbar3110@gmail.com', '$2y$10$vPg9bhp.EfydUJfsz7vW6.jlbI/pPGhU4VPNrtJdMB1jkH0wFFhWO', 'user', '2024-07-16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_diskon`
--
ALTER TABLE `tb_diskon`
  ADD PRIMARY KEY (`id_diskon`);

--
-- Indexes for table `tb_dokumentasi`
--
ALTER TABLE `tb_dokumentasi`
  ADD PRIMARY KEY (`id_dokumentasi`);

--
-- Indexes for table `tb_kategori_produk`
--
ALTER TABLE `tb_kategori_produk`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_quote`
--
ALTER TABLE `tb_quote`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_riwayatpenjualan`
--
ALTER TABLE `tb_riwayatpenjualan`
  ADD PRIMARY KEY (`id_penjualan`);

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
-- AUTO_INCREMENT for table `tb_diskon`
--
ALTER TABLE `tb_diskon`
  MODIFY `id_diskon` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_dokumentasi`
--
ALTER TABLE `tb_dokumentasi`
  MODIFY `id_dokumentasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tb_kategori_produk`
--
ALTER TABLE `tb_kategori_produk`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_quote`
--
ALTER TABLE `tb_quote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_riwayatpenjualan`
--
ALTER TABLE `tb_riwayatpenjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tb_settings`
--
ALTER TABLE `tb_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

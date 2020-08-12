-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2020 at 09:09 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `barang` varchar(245) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga_beli` int(11) DEFAULT NULL,
  `harga_jual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `barang`, `stok`, `harga_beli`, `harga_jual`) VALUES
(12, 'oli ', 5, 35000, 35000),
(13, 'fsfsf', 2, 10000, 50000),
(14, 'zanpakuto', 383, 30000, 500000);

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id` int(11) NOT NULL,
  `transaksi_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `merk`
--

CREATE TABLE `merk` (
  `id` int(11) NOT NULL,
  `merk` varchar(155) NOT NULL,
  `merk_motor` varchar(155) NOT NULL,
  `detail_merk` varchar(155) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `merk`
--

INSERT INTO `merk` (`id`, `merk`, `merk_motor`, `detail_merk`) VALUES
(1, 'honda', 'beat', 'beat Deluxe'),
(2, 'honda', 'beat', 'beat CBS'),
(3, 'honda', 'beat', 'beat CBS ISS'),
(4, 'honda', 'beat', 'beat Street'),
(5, 'honda', 'vario', '125 CBS'),
(6, 'honda', 'vario', '125 CBS-ISS'),
(7, 'honda', 'vario', '150 Exclusive'),
(8, 'honda', 'vario', '125 Exclusive Matte Black'),
(9, 'honda', 'vario', '125 Sporty Series'),
(10, 'honda', 'SH150i', 'SH150i'),
(11, 'honda', 'Scoopy', 'Scoopy Stylish'),
(12, 'honda', 'Scoopy', 'Scoopy Sporty'),
(13, 'honda', 'PCX', 'PCX 150 - CBS'),
(14, 'honda', 'PCX', 'PCX 150 - ABS'),
(15, 'honda', 'Forza', 'Forza'),
(16, 'honda', 'Genio', 'Genio CBS-ISS'),
(17, 'honda', 'Genio', 'Genio CBS'),
(18, 'honda', 'ADV 150', 'ADV 150 - CBS'),
(19, 'honda', 'ADV 150', 'ADV 150 - ABS'),
(20, 'honda', 'Supra X', 'ADV 150 - ABS'),
(21, 'honda', 'Supra GTR', 'Supra GTR 150 Sporty'),
(22, 'honda', 'Super Cub C125', 'Super Cub C125'),
(23, 'honda', 'Revo', 'Revo Fit'),
(24, 'honda', 'Revo', 'Revo X'),
(25, 'honda', 'CBR150R', 'CBR150R Matte Black STD'),
(26, 'honda', 'CBR150R', 'CBR150R Victory Black Red STD'),
(27, 'honda', 'CBR150R', 'CBR150R Victory Black Red ABS'),
(28, 'honda', 'CBR150R', 'CBR150R Dominator Matte Black STD'),
(29, 'honda', 'CBR150R', 'CBR150R Dominator Matte Black ABS'),
(30, 'honda', 'CBR150R', 'CBR150R Honda Racing Red STD'),
(31, 'honda', 'CBR150R', 'CBR150R Honda Racing Red ABS'),
(32, 'honda', 'CBR150R', 'CBR150R MotoGP Edition ABS'),
(33, 'honda', 'CBR250R', 'CBR250RR – ABS Bravery Mat Red'),
(34, 'honda', 'CBR250R', 'CBR250RR – ABS Mat Gunpowder Black Metallic'),
(35, 'honda', 'CBR250R', 'CBR250RR – ABS Honda Racing Red'),
(36, 'honda', 'CBR250R', 'CBR250RR – STD Black Freedom'),
(37, 'honda', 'CBR250R', 'CBR250RR – STD Bravery Mat Red'),
(38, 'honda', 'CBR250R', 'CBR250RR – STD Mat Gunpowder Black Metallic'),
(39, 'honda', 'CBR250R', 'CBR250RR – STD Honda Racing Red'),
(40, 'honda', 'Sonic 150R', 'Sonic 150R Activo Black'),
(41, 'honda', 'Sonic 150R', 'Sonic 150R Aggresso Matte Black'),
(42, 'honda', 'Sonic 150R', 'Sonic 150R Energetic Red'),
(43, 'honda', 'Sonic 150R', 'Sonic 150R Honda Racing Red'),
(44, 'honda', 'CB150 Verza', 'CB150 Verza Spoke'),
(45, 'honda', 'CB150 Verza', 'CB150 Verza CW'),
(46, 'honda', 'CB150R Street Fire', 'CB150R StreetFire – SE Honda Racing Red'),
(47, 'honda', 'CB150R Street Fire', 'CB150R StreetFire – SE Fury Mat Red'),
(48, 'honda', 'CB150R Street Fire', 'CB150R StreetFire – SE Raptor Mat Black'),
(49, 'honda', 'CB150R Street Fire', 'CB150R StreetFire - STD Razor White'),
(50, 'honda', 'CB150R Street Fire', 'CB150R StreetFire - STD Macho Black'),
(51, 'honda', 'CRF250RALLY', 'CRF250RALLY'),
(52, 'honda', 'CRF150L', 'CRF150L- Extreme Black'),
(53, 'honda', 'CRF150L', 'CRF150L- Extreme Red'),
(54, 'honda', 'CRF150L', 'CRF150L- New Extreme Grey'),
(55, 'yamaha', 'FREEGO', 'FREEGO'),
(56, 'yamaha', 'FREEGO', 'FREEGO S VERSION'),
(57, 'yamaha', 'FREEGO', 'FREEGO S VERSION ABS'),
(58, 'yamaha', 'mio', 'MIO S SMART & SOPHISTICATED'),
(59, 'yamaha', 'mio', 'MIO M3 125 AKS SSS'),
(60, 'yamaha', 'mio', 'MIO M3 125'),
(61, 'yamaha', 'mio', 'MIO Z'),
(62, 'yamaha', 'X-RIDE 125', 'X-RIDE 125'),
(63, 'yamaha', 'Fino', 'FINO PREMIUM TUBELESS & BAN LEBAR 125 BLUE CORE'),
(64, 'yamaha', 'Fino', 'FINO SPORTY TUBELESS & BAN LEBAR 125 BLUE CORE'),
(65, 'yamaha', 'Fino', 'FINO GRANDE TUBELESS & BAN LEBAR 125 BLUE CORE'),
(66, 'yamaha', 'Soul', 'SOUL GT AKS SSS'),
(67, 'yamaha', 'Soul', 'SOUL GT AKS'),
(68, 'yamaha', 'NMAX', 'NMAX 155 CONNECTED / ABS VERSION'),
(69, 'yamaha', 'NMAX', ' NMAX 155 STANDARD VERSION'),
(70, 'yamaha', 'NMAX', 'NMAX 155 ABS'),
(71, 'yamaha', 'NMAX', 'NMAX 155'),
(72, 'yamaha', 'XMAX', 'XMAX'),
(73, 'yamaha', 'LEXI', 'LEXI'),
(74, 'yamaha', 'LEXI', 'LEXI S - ABS'),
(75, 'yamaha', 'LEXI', 'LEXI - S'),
(76, 'yamaha', 'AEROX', 'AEROX 155 VVA S-VERSION'),
(77, 'yamaha', 'AEROX', 'AEROX 155 VVA R-VERSION'),
(78, 'yamaha', 'AEROX', 'AEROX 155 VVA'),
(79, 'yamaha', 'AEROX', 'AEROX 155VVA R-VERSION MONSTER ENERGY YAMAHA MOTOGP EDITION'),
(80, 'yamaha', 'AEROX', 'AEROX 155 VVA S DOXOU VERSION'),
(81, 'yamaha', 'AEROX', 'AEROX 155VVA R-VERSION MONSTER ENERGY YAMAHA MOTOGP EDITION'),
(82, 'yamaha', 'TMAX DX', 'TMAX DX'),
(83, 'yamaha', 'XSR 155', 'XSR 155'),
(84, 'yamaha', 'MT', 'MT-15'),
(85, 'yamaha', 'MT', 'MT-25'),
(86, 'yamaha', 'MT', 'MT09'),
(87, 'yamaha', 'MT', 'MT09 TRACER'),
(88, 'yamaha', 'VIXION', 'VIXION MONSTER ENERGY YAMAHA MOTOGP EDITION'),
(89, 'yamaha', 'VIXION', 'VIXION'),
(90, 'yamaha', 'VIXION', 'VIXION R'),
(91, 'yamaha', 'VIXION', 'VIXION MONSTER ENERGY YAMAHA MOTOGP EDITION'),
(92, 'yamaha', 'XABRE', 'XABRE'),
(93, 'yamaha', 'BYSON FI', 'BYSON FI'),
(94, 'yamaha', 'YZF', 'YZF R15 MONSTER ENERGY YAMAHA MOTOGP EDITION'),
(95, 'yamaha', 'YZF', 'YZF R15'),
(96, 'yamaha', 'YZF', 'NEW YZF R25'),
(97, 'yamaha', 'YZF', 'NEW YZF R25 - ABS'),
(98, 'yamaha', 'YZF', 'YZF R15 MONSTER ENERGY YAMAHA MOTOGP EDITION'),
(99, 'yamaha', 'WR 155 R', 'WR 155 R'),
(100, 'yamaha', 'MX', 'WR 155 R'),
(101, 'yamaha', 'MX', 'MX KING 150'),
(102, 'yamaha', 'MX', 'MX KING 150 DOXOU VERSION'),
(103, 'yamaha', 'MX', 'MX KING 150 MONSTER ENERGY YAMAHA MOTOGP EDITION'),
(104, 'yamaha', 'JUPITER', 'MX KING 150 MONSTER ENERGY YAMAHA MOTOGP EDITION'),
(105, 'yamaha', 'JUPITER', 'JUPITER MX 150'),
(106, 'yamaha', 'JUPITER', 'JUPITER Z1'),
(107, 'yamaha', 'R', 'R1M'),
(108, 'yamaha', 'R', 'R1'),
(109, 'yamaha', 'R', 'R6'),
(110, 'yamaha', 'R', 'WR250 R'),
(111, 'suzuki', 'GSX', 'SUZUKI GSX R150 KEYLESS IGNITION SYSTEM'),
(112, 'suzuki', 'GSX', 'SUZUKI GSX R150 SHUTTERED KEY'),
(113, 'suzuki', 'GSX', 'SUZUKI GSX R150 ABS'),
(114, 'suzuki', 'GSX', 'SUZUKI GSX S150 SHUTTER KEY'),
(115, 'suzuki', 'GSX', 'SUZUKI GSX 150 BANDIT STANDARD'),
(116, 'suzuki', 'GSX', 'SUZUKI GSX S150 SHUTTER KEY'),
(117, 'suzuki', 'Satria', 'SUZUKI SATRIA F150 STANDARD'),
(118, 'suzuki', 'Satria', 'SUZUKI SATRIA F150 BLACK PREDATOR'),
(119, 'suzuki', 'Satria', 'SUZUKI SATRIA F150 HIGH GRADE'),
(120, 'suzuki', 'Satria', 'SUZUKI SATRIA F150 MOTOGP'),
(121, 'suzuki', 'SMASH FI', 'SUZUKI SMASH FI SR'),
(122, 'suzuki', 'SMASH FI', 'SUZUKI SMASH FI R'),
(123, 'suzuki', 'Address', 'SUZUKI ADDRESS FI STANDARD'),
(124, 'suzuki', 'Address', 'SUZUKI ADDRESS FI PREDATOR'),
(125, 'suzuki', 'Address', 'SUZUKI ADDRESS PLAYFUL'),
(126, 'suzuki', 'NEX II', 'SUZUKI ADDRESS PLAYFUL'),
(127, 'suzuki', 'NEX II', 'SUZUKI NEX II ELEGANT STANDARD'),
(128, 'suzuki', 'NEX II', 'SUZUKI NEX II CROSS'),
(129, 'suzuki', 'NEX II', 'SUZUKI NEX II CROSS ACCESSORIES'),
(130, 'suzuki', 'NEX II', 'SUZUKI NEX II ELEGANT PREMIUM'),
(131, 'suzuki', 'NEX II', 'SUZUKI NEX II FANCY STANDARD');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` text NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(3, '2020-07-21-032017', 'App\\Database\\Migrations\\Merk', 'default', 'App', 1595304634, 1);

-- --------------------------------------------------------

--
-- Table structure for table `montir`
--

CREATE TABLE `montir` (
  `id` int(11) NOT NULL,
  `nama_montir` varchar(100) NOT NULL,
  `alamat_montir` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `montir`
--

INSERT INTO `montir` (`id`, `nama_montir`, `alamat_montir`) VALUES
(1, 'Isman', 'Kp.Cilolohan'),
(13, 'ryan yurida', 'cigorowong'),
(24, 'Kurosaki Ichigo', 'Tokyo');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `time` varchar(100) NOT NULL,
  `pelanggan` int(11) NOT NULL,
  `motor` int(11) NOT NULL,
  `kendala` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama_pelanggan` varchar(245) NOT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama_pelanggan`, `alamat`, `no_hp`) VALUES
(7, 'ipan badruzzaman', 'Kp.Cibalanarik', '090888909'),
(9, 'Fajar Salam', 'Kp.PasarSenen', '080809'),
(11, 'susan nuraeni', 'Kp.Rancakalong', '09877778'),
(14, 'Ryan Yurida', 'Kp.Cigorowong', '090900909'),
(18, 'Farhan Maulana', 'Kp.Cibaruyan', '07876878788');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `no_transaksi` varchar(245) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `pengeluaran_barang` varchar(255) DEFAULT NULL,
  `kendala` varchar(255) NOT NULL,
  `waktu_servis` varchar(100) NOT NULL,
  `total` int(100) DEFAULT NULL,
  `montir_id` int(11) NOT NULL,
  `merk_id` int(11) NOT NULL,
  `pelanggan_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `kasir_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `no_transaksi`, `tanggal`, `keterangan`, `pengeluaran_barang`, `kendala`, `waktu_servis`, `total`, `montir_id`, `merk_id`, `pelanggan_id`, `customer_id`, `kasir_id`) VALUES
(1, 'Transaksi ke 1', '2020-08-12', 'Motor di hancurkan', 'zanpakuto', 'Mesin mati', '13:38:41 - 13:40:56', 100000, 13, 52, 9, 1, 1),
(2, 'Transaksi ke 2', '2020-08-12', 'Motor di rusak', 'zanpakuto', 'Motor tidak bisa di hidupkan', '13:39:14 - 14:04:11', 100000, 1, 117, 7, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(245) NOT NULL,
  `role` enum('admin','customer','kasir') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `role`) VALUES
(1, 'Ipan Badruzzaman', 'admin', '$2y$10$Lew1T.WxS1KRmi4ldK/T7.0E0jDxdG405XY8v8iGE0CEQk2QU0gf2', 'admin'),
(2, 'Susan Nuraeni', 'susan', '$2y$10$qb2fm1LUXtrUn1BL39889es3ndAUvePaSAbLcYLG1D3Qs49DHzK3i', 'customer'),
(3, 'Farhan  Maulana', 'farhan', '$2y$10$5eX90gdfdag94g//iYGtP.1rewFu3jOOhuLICXjd.6CsmfGX9ToOi', 'kasir'),
(4, 'Fajar Salam', 'fajar', 'Fajar Salam', 'kasir'),
(5, 'Farhan Maulana', 'farhan', 'Farhan Maulana', 'customer'),
(6, 'fajar salamun', 'fajar', 'fajar salamun', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detail_transaksi_transaksi_idx` (`transaksi_id`),
  ADD KEY `fk_detail_transaksi_barang1_idx` (`barang_id`);

--
-- Indexes for table `merk`
--
ALTER TABLE `merk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `montir`
--
ALTER TABLE `montir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nota_UNIQUE` (`no_transaksi`),
  ADD KEY `fk_transaksi_pelanggan1_idx` (`pelanggan_id`),
  ADD KEY `merk_id` (`merk_id`),
  ADD KEY `montir_id` (`montir_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `kasir_id` (`kasir_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `merk`
--
ALTER TABLE `merk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `montir`
--
ALTER TABLE `montir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `fk_detail_transaksi_barang1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detail_transaksi_transaksi` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`),
  ADD CONSTRAINT `transaksi_ibfk_4` FOREIGN KEY (`montir_id`) REFERENCES `montir` (`id`),
  ADD CONSTRAINT `transaksi_ibfk_5` FOREIGN KEY (`customer_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `transaksi_ibfk_6` FOREIGN KEY (`kasir_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

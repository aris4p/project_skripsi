-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2021 at 11:52 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tester`
--

-- --------------------------------------------------------

--
-- Table structure for table `akuns`
--

CREATE TABLE `akuns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reff_akun` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_akun` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `akuns`
--

INSERT INTO `akuns` (`id`, `reff_akun`, `nama_akun`, `keterangan`, `created_at`, `updated_at`) VALUES
(2, '102', 'KAS', 'kas', '2021-11-23 13:25:24', '2021-11-26 12:17:50'),
(3, '201', 'Beban', 'Beban', '2021-11-27 11:03:37', '2021-11-27 11:03:37'),
(4, '301', 'Piutang', 'Piutang', '2021-11-27 11:53:56', '2021-11-27 11:53:56'),
(8, '101', 'Modal', 'Modal', '2021-12-05 06:58:36', '2021-12-05 06:58:36'),
(9, '401', 'Penjualan', 'Penjualan', '2021-12-05 07:04:47', '2021-12-07 08:52:55'),
(10, '601', 'Pembelian', 'Pembelian', '2021-12-05 12:23:45', '2021-12-05 12:23:45');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telepon` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` enum('Reguler','Visitor') COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Aktif','Tidak Aktif') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `nama`, `no_telepon`, `Email`, `jenis`, `alamat`, `kota`, `status`, `created_at`, `updated_at`) VALUES
(9, 'FRENGKI ROBYANTO', '08977777', 'frengki@gmail.com', 'Reguler', 'Jl. SUKASARI II no 11', 'Tangerang', 'Aktif', '2021-12-04 06:20:27', '2021-12-05 15:49:36'),
(10, 'APIC DEVANIO', '0899999', 'apicdevanio@gmail.com', 'Reguler', 'jl. permata no 50', 'Bogor', 'Aktif', '2021-12-04 06:22:19', '2021-12-05 15:49:21'),
(11, 'PT. HENMEI ABADI', '089976666', 'henmeiabadi@gmail.com', 'Reguler', 'Jl. Raya Curug , GG Vihar', 'Tangerang', 'Aktif', '2021-12-04 06:24:08', '2021-12-05 15:49:56'),
(12, 'RUDY HARTANTO', '089787987', 'rudyhartanto@gmail.com', 'Reguler', 'GG SIAGA PERTIWI - KUBU RAYA', 'Kalimantan Barat', 'Aktif', '2021-12-04 06:26:09', '2021-12-05 15:50:30'),
(13, 'PT. LIGNO SPECIALTY ADHESIVE', '089789678687', 'lignospeciality@gmail.com', 'Reguler', 'JL KARET IV- SEPATAN', 'Tangerang', 'Aktif', '2021-12-04 06:28:03', '2021-12-05 15:50:10');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jurnals`
--

CREATE TABLE `jurnals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `kode_id` bigint(20) UNSIGNED NOT NULL,
  `jenis` enum('debit','kredit') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` int(11) NOT NULL,
  `keterangan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jurnals`
--

INSERT INTO `jurnals` (`id`, `tanggal`, `kode_id`, `jenis`, `nominal`, `keterangan`, `created_at`, `updated_at`) VALUES
(26, '2021-11-01', 2, 'debit', 100000000, 'didapatkan dari modal awal', '2021-12-05 06:57:48', '2021-12-05 16:15:45'),
(27, '2021-11-01', 8, 'kredit', 100000000, 'Modal Perusahaan', '2021-12-05 06:59:20', '2021-12-07 08:35:01'),
(28, '2021-11-10', 4, 'debit', 65980650, 'menerima pendapatan', '2021-12-05 07:10:00', '2021-12-07 08:15:46'),
(29, '2021-11-10', 9, 'kredit', 65980650, 'menerima pendapatan', '2021-12-05 07:11:15', '2021-12-07 08:16:13'),
(30, '2021-11-15', 10, 'debit', 31672380, 'Pembelian Bahan Cat', '2021-12-05 12:25:22', '2021-12-07 08:31:31'),
(31, '2021-11-15', 2, 'kredit', 31672380, 'Pembelian Bahan Cat', '2021-12-05 12:26:07', '2021-12-07 08:32:01'),
(32, '2021-11-26', 3, 'debit', 12500000, 'Beban Gaji', '2021-12-05 13:03:19', '2021-12-07 08:14:05'),
(33, '2021-11-26', 2, 'kredit', 12500000, 'Membayar Gaji Pekerja', '2021-12-05 13:03:41', '2021-12-07 08:36:38'),
(34, '2021-11-26', 3, 'debit', 300000, 'Beban Kebersihan&Keamanan', '2021-12-07 08:24:03', '2021-12-07 08:24:03'),
(35, '2021-11-26', 2, 'kredit', 300000, 'membayar kebersihan dan keamanan', '2021-12-07 08:25:15', '2021-12-07 08:25:15'),
(36, '2021-11-22', 2, 'debit', 35000000, 'Penerimaan Piutang', '2021-12-07 08:39:39', '2021-12-07 08:39:39'),
(37, '2021-11-22', 4, 'kredit', 35000000, 'Penerimaan Piutang', '2021-12-07 08:40:16', '2021-12-07 08:40:16');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_04_17_053928_create_kategoris_table', 1),
(5, '2020_04_17_053941_create_transaksis_table', 1),
(7, '2021_11_22_201407_create_suppliers_table', 2),
(8, '2021_11_22_212051_create_customers_table', 3),
(9, '2021_11_23_200551_create_akuns_table', 4),
(11, '2021_11_23_220233_create_pembelians_table', 5),
(12, '2021_11_25_132811_create_pembelians_table', 6),
(13, '2021_11_27_152950_create_jurnals_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembelians`
--

CREATE TABLE `pembelians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `kode_transaksi` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `nominal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `metode` enum('cash','bank') COLLATE utf8mb4_unicode_ci NOT NULL,
  `Keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembelians`
--

INSERT INTO `pembelians` (`id`, `tanggal`, `kode_transaksi`, `supplier_id`, `nominal`, `metode`, `Keterangan`, `created_at`, `updated_at`) VALUES
(9, '2021-10-22', 'PB2021121000001', 13, '3520000', 'cash', 'Thinner Act', '2021-12-04 06:01:47', '2021-12-04 06:01:47'),
(10, '2021-11-11', 'PB2021121000002', 14, '8734880', 'cash', 'Nicekyd S170 HV', '2021-12-04 06:05:05', '2021-12-04 06:05:05'),
(11, '2021-11-05', 'PB2021121000003', 12, '2362500', 'cash', 'PTSA GRADE D EX ROYAL P Rp. 472.500 x 5', '2021-12-04 06:09:19', '2021-12-04 06:09:19'),
(12, '2021-11-17', 'PB2021121000004', 11, '13200000', 'cash', 'INAMINE Rp. 30.000', '2021-12-04 06:11:37', '2021-12-04 06:11:37'),
(13, '2021-11-23', 'PB2021121000005', 10, '7375000', 'cash', 'METHANOL', '2021-12-04 06:12:45', '2021-12-04 06:12:45');

-- --------------------------------------------------------

--
-- Table structure for table `penjualans`
--

CREATE TABLE `penjualans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `kode_transaksi` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nominal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `metode` enum('cash','bank') COLLATE utf8mb4_unicode_ci NOT NULL,
  `Keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penjualans`
--

INSERT INTO `penjualans` (`id`, `tanggal`, `kode_transaksi`, `customer_id`, `nominal`, `metode`, `Keterangan`, `created_at`, `updated_at`) VALUES
(20, '2021-11-02', 'PJ2021121000001', 13, '13223650', 'cash', 'NC LACQUER black Doff', '2021-12-04 06:30:17', '2021-12-04 06:30:17'),
(21, '2021-11-10', 'PJ2021121000002', 12, '29010000', 'cash', 'melamine', '2021-12-04 06:31:26', '2021-12-04 06:31:26'),
(22, '2021-11-15', 'PJ2021121000003', 11, '6132600', 'cash', 'Epoxy Primert Grey, NC LACQUER RED CHILI, THINNER HIGH GLOSS', '2021-12-04 06:33:21', '2021-12-04 06:33:21'),
(23, '2021-11-13', 'PJ2021121000004', 10, '10344400', 'cash', 'MELAMINE, NC LACQUER, SURFACESSOR', '2021-12-04 06:34:47', '2021-12-04 06:34:47'),
(24, '2021-11-03', 'PJ2021121000005', 9, '7270000', 'cash', 'MC LACQUER', '2021-12-04 06:36:25', '2021-12-04 06:36:25'),
(25, '2021-12-06', 'PJ2021121000006', 9, '1000000', 'bank', 'Cat', '2021-12-06 03:39:43', '2021-12-06 03:39:43');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telepon` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` enum('Reguler','Priority') COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Aktif','Nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `nama`, `no_telepon`, `Email`, `jenis`, `alamat`, `kota`, `status`, `created_at`, `updated_at`) VALUES
(10, 'PT. CAHAYA MAS INDOTAMA', '021-5504753', 'cahaymasindotama@gmail.com', 'Reguler', 'Jakarta Barat', 'Cengkareng', 'Aktif', '2021-12-04 05:46:33', '2021-12-05 06:52:53'),
(11, 'PT KANSAI PRAKARSA COATINGS', '021-5664687', 'kansai@gmail.com', 'Priority', 'Jakarta Pusat', 'Kebon Kelapa', 'Aktif', '2021-12-04 05:48:36', '2021-12-05 06:51:56'),
(12, 'PT. DCC INDONESIA', '021-5578227', 'dccindonesia@gmail.com', 'Reguler', 'KAB. TANGERANG', 'PEUSAR PANONGAN', 'Aktif', '2021-12-04 05:52:07', '2021-12-05 06:55:40'),
(13, 'PT. ANUGRAH MAKMUR GEMILANG', '02129020794', 'anugrahmakmur@gmail.com', 'Reguler', 'Banten', 'Tangerang', 'Aktif', '2021-12-04 05:54:55', '2021-12-05 06:52:35'),
(14, 'PT. DELTA PRIMA RODAMAS', '021-5667685', 'deltaprimarodamas@gmail.com', 'Priority', 'Jakarta', 'Jakarta Barat', 'Aktif', '2021-12-04 05:58:15', '2021-12-05 06:55:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('admin','bendahara','pimpinan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `level`, `foto`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Aris', 'admin@gmail.com', NULL, '$2y$10$k/khsRZUKYp4Y1xktQvtKOIdjep89QbHwpzHb7nOVMTcKnW5p25YO', 'admin', '1587447052_user1.jpg', NULL, '2020-04-16 15:42:15', '2021-11-06 00:37:15'),
(10, 'Andhre', 'andhre@gmail.com', NULL, '$2y$10$6F0UtZyubM9yHtCVHfXyEuM/inieh9zJydQOSc7CfyIHGA1leeOZG', 'bendahara', '1637595792_komponen sistem informasi.PNG', NULL, '2021-11-05 00:13:52', '2021-11-26 07:58:40'),
(13, 'Aris Anggara Putra', 'arisanggara72@gmail.com', NULL, '$2y$10$B91mA6syJtNUDNYfQH3XH.pLeVWlADIvP4NpDD9x8knFIse6avxlS', 'pimpinan', '', NULL, '2021-12-01 07:36:55', '2021-12-01 07:36:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akuns`
--
ALTER TABLE `akuns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurnals`
--
ALTER TABLE `jurnals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_akun` (`kode_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pembelians`
--
ALTER TABLE `pembelians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `penjualans`
--
ALTER TABLE `penjualans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_transaksi` (`kode_transaksi`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akuns`
--
ALTER TABLE `akuns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurnals`
--
ALTER TABLE `jurnals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pembelians`
--
ALTER TABLE `pembelians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `penjualans`
--
ALTER TABLE `penjualans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jurnals`
--
ALTER TABLE `jurnals`
  ADD CONSTRAINT `fk_jurnal` FOREIGN KEY (`kode_id`) REFERENCES `akuns` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembelians`
--
ALTER TABLE `pembelians`
  ADD CONSTRAINT `pembelians_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penjualans`
--
ALTER TABLE `penjualans`
  ADD CONSTRAINT `penjualans_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Okt 2020 pada 05.37
-- Versi server: 10.4.8-MariaDB
-- Versi PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sibumdes`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `category_product`
--

CREATE TABLE `category_product` (
  `category_id` int(1) NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `information` varchar(64) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `category_product`
--

INSERT INTO `category_product` (`category_id`, `name`, `information`, `is_active`) VALUES
(1, 'None', '', 1),
(2, 'Pupuk', '', 1),
(3, 'Makanan Ringan', '', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `md_product`
--

CREATE TABLE `md_product` (
  `id` int(3) NOT NULL,
  `product_code` varchar(32) DEFAULT NULL,
  `product_name` varchar(64) DEFAULT NULL,
  `category_id` int(1) DEFAULT NULL,
  `unit_id` int(1) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `product_type_id` int(1) DEFAULT NULL,
  `amount_of_goods` int(11) DEFAULT NULL,
  `product_information` text NOT NULL,
  `create_date` datetime DEFAULT NULL,
  `img_product` varchar(128) DEFAULT NULL,
  `is_sell` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `md_product`
--

INSERT INTO `md_product` (`id`, `product_code`, `product_name`, `category_id`, `unit_id`, `price`, `product_type_id`, `amount_of_goods`, `product_information`, `create_date`, `img_product`, `is_sell`) VALUES
(8, 'PKS_PO_001', 'Pupuk Organik', 2, 3, 25000, 1, 7, 'Pupuk Organik Kotoran Sapi', '2020-08-18 00:00:00', 'sample_produk_1.jpg', 1),
(9, 'PKS_PC_001', 'Pupuk Cair', 2, 2, 20000, 1, 10, '', '2020-08-19 00:00:00', 'sample_produk_2.jpg', 1),
(17, 'PKS_PC_002', 'PUPUK CAIR', 2, 2, 30000, 1, 10, 'Pupuk Cair dengan proses pengolahan yang berkualitas', '2020-09-21 09:18:16', 'PUPUK_CAIR.jpg', 1),
(18, 'PUKM_SMP_001', 'Sumpia', 3, 4, 15000, 2, 15, 'Sumpia Isi Udang', '2020-09-22 10:53:09', 'Sumpia.jpg', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `md_savings`
--

CREATE TABLE `md_savings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `amount_of_savings` int(11) DEFAULT 0,
  `create_date` datetime DEFAULT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `md_savings`
--

INSERT INTO `md_savings` (`id`, `user_id`, `name`, `amount_of_savings`, `create_date`, `is_active`) VALUES
(9, 3, 'ADMIN SIBUMDES', 10000, '2020-08-18 00:00:00', 1),
(10, 5, 'UMKM DESA CIBOGO', 0, '2020-08-26 00:00:00', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_inventory`
--

CREATE TABLE `product_inventory` (
  `id` int(11) NOT NULL,
  `product_id` int(3) DEFAULT NULL,
  `product_name` varchar(64) DEFAULT NULL,
  `amount_of_goods` int(11) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `product_inventory`
--

INSERT INTO `product_inventory` (`id`, `product_id`, `product_name`, `amount_of_goods`, `input_date`) VALUES
(14, 8, 'PUPUK ORGANIK', 7, '2020-08-25 00:00:00'),
(15, 9, 'PUPUK CAIR', 10, '2020-10-05 09:16:24'),
(16, 17, 'PUPUK CAIR', 10, '2020-10-05 09:16:36'),
(17, 18, 'SUMPIA', 10, '2020-10-05 09:16:46'),
(18, 18, 'SUMPIA', 5, '2020-10-05 09:18:57');

--
-- Trigger `product_inventory`
--
DELIMITER $$
CREATE TRIGGER `afterdelete_databarang` AFTER DELETE ON `product_inventory` FOR EACH ROW UPDATE md_product SET amount_of_goods = amount_of_goods-old.amount_of_goods
WHERE id = old.product_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_sales`
--

CREATE TABLE `product_sales` (
  `id` int(11) NOT NULL,
  `no_sales` varchar(64) DEFAULT NULL,
  `product_id` int(3) DEFAULT NULL,
  `customer_id` int(10) NOT NULL,
  `product_name` varchar(64) DEFAULT NULL,
  `amount_of_goods` int(11) DEFAULT NULL,
  `amount_of_price` int(11) DEFAULT NULL,
  `purchase_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `product_sales`
--

INSERT INTO `product_sales` (`id`, `no_sales`, `product_id`, `customer_id`, `product_name`, `amount_of_goods`, `amount_of_price`, `purchase_date`) VALUES
(3, '20201007224514', 8, 7, 'Pupuk Organik', 2, 50000, '2020-10-07 22:45:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_type`
--

CREATE TABLE `product_type` (
  `product_type_id` int(1) NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `information` varchar(64) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `product_type`
--

INSERT INTO `product_type` (`product_type_id`, `name`, `information`, `is_active`) VALUES
(1, 'Produk Kotoran Sapi', '', 1),
(2, 'UMKM', '', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `request_pickup_item`
--

CREATE TABLE `request_pickup_item` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `address` varchar(128) DEFAULT NULL,
  `phone_number` varchar(16) DEFAULT NULL,
  `request_status_id` int(11) DEFAULT NULL,
  `request_type_id` int(1) NOT NULL,
  `request_date` datetime DEFAULT NULL,
  `input_date` datetime NOT NULL,
  `approval_date` datetime NOT NULL,
  `information` varchar(256) NOT NULL DEFAULT 'Penjemputan Barang Belum Diapproval',
  `pickup_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `request_pickup_item`
--

INSERT INTO `request_pickup_item` (`id`, `user_id`, `name`, `address`, `phone_number`, `request_status_id`, `request_type_id`, `request_date`, `input_date`, `approval_date`, `information`, `pickup_date`) VALUES
(9, 3, 'ADMIN SIBUMDES', 'SANGGAR INDAH BANJARAN', '08985188755', 3, 2, '2020-09-08 09:00:00', '2020-09-07 10:35:09', '2020-09-07 10:38:10', 'Barang Sudah Kami Jemput', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `request_status`
--

CREATE TABLE `request_status` (
  `id` int(1) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `information` varchar(128) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `request_status`
--

INSERT INTO `request_status` (`id`, `name`, `information`, `is_active`) VALUES
(1, 'Request Berhasil Dibuat, Menunggu Approval Penjemputan Barang', '', 1),
(2, 'Barang Akan Dijemput', '', 1),
(3, 'Barang Sudah Dijemput', '', 1),
(4, 'Pending', '', 1),
(5, 'Barang Belum Bisa Dijemput', '', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `request_type`
--

CREATE TABLE `request_type` (
  `id` int(2) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `information` varchar(128) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `request_type`
--

INSERT INTO `request_type` (`id`, `name`, `information`, `is_active`) VALUES
(1, 'Request Penjemputan Barang UMKM', '', 1),
(2, 'Request Penjemputan Kotoran Sapi', '', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `request_withdraw_savings`
--

CREATE TABLE `request_withdraw_savings` (
  `id` int(11) NOT NULL,
  `md_savings_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `amount_of_savings` int(11) DEFAULT NULL,
  `request_status_id` int(1) DEFAULT NULL,
  `request_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `savings_data`
--

CREATE TABLE `savings_data` (
  `id` int(11) NOT NULL,
  `md_savings_id` int(11) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `amount_of_savings` int(11) DEFAULT NULL,
  `savings_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `savings_data`
--

INSERT INTO `savings_data` (`id`, `md_savings_id`, `name`, `amount_of_savings`, `savings_date`) VALUES
(2, 9, 'admin sibumdes', 10000, '2020-08-26 00:00:00'),
(3, 9, 'admin sibumdes', 0, '2020-09-06 11:14:42');

--
-- Trigger `savings_data`
--
DELIMITER $$
CREATE TRIGGER `afterdelete_datatabungan` AFTER DELETE ON `savings_data` FOR EACH ROW UPDATE md_savings SET amount_of_savings = amount_of_savings-old.amount_of_savings
WHERE id = old.md_savings_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `unit_of_goods`
--

CREATE TABLE `unit_of_goods` (
  `unit_id` int(1) NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `information` varchar(64) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `unit_of_goods`
--

INSERT INTO `unit_of_goods` (`unit_id`, `name`, `information`, `is_active`) VALUES
(1, 'None', '', 1),
(2, 'Liter', '', 1),
(3, 'Kilogram', '', 1),
(4, 'Bungkus', '', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `x_customers`
--

CREATE TABLE `x_customers` (
  `id` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(256) NOT NULL,
  `user_status_id` int(1) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `customer_contact` varchar(20) DEFAULT NULL,
  `customer_email` varchar(50) DEFAULT NULL,
  `customer_address` varchar(100) DEFAULT NULL,
  `urban_village` varchar(30) NOT NULL,
  `sub_district` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `is_valid` int(1) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `image` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `x_customers`
--

INSERT INTO `x_customers` (`id`, `username`, `password`, `user_status_id`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`, `urban_village`, `sub_district`, `city`, `postal_code`, `is_valid`, `create_date`, `image`) VALUES
(7, '', '', 1, 'Rizki Afriansyah Yahya', 'rizki@gmail.com', '085795587874', 'SANGGAR INDAH BANJARAN', 'Nagrak', 'Cangkuang', 'Bandung', '40377', NULL, '2020-10-07 22:45:13', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `x_users`
--

CREATE TABLE `x_users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `user_status_id` int(1) DEFAULT NULL,
  `user_role_id` int(1) DEFAULT NULL,
  `request_type_id` int(1) NOT NULL,
  `is_valid` int(1) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `phone_number` varchar(16) DEFAULT NULL,
  `address` varchar(128) DEFAULT NULL,
  `image` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `x_users`
--

INSERT INTO `x_users` (`id`, `username`, `password`, `name`, `user_status_id`, `user_role_id`, `request_type_id`, `is_valid`, `create_date`, `phone_number`, `address`, `image`) VALUES
(3, 'admin', '$2y$10$J/Zrpx0AMPNlFd1A6ed6Oe5gQGwYpu6GqQVEHOjmbWlWmdjGSeK1m', 'admin sibumdes', 1, 1, 2, 1, '2020-07-05 00:00:00', '08985188755', 'Sanggar Indah Banjaran', 'defaultprofilepicture.jpg'),
(4, 'warga', '$2y$10$QMmNIk69Vkkp7vmy4bheZOzsOJpnePqvHQJnb47/8bMkRFlKbN08.', 'warga desa cibogo', 1, 2, 2, 1, '2020-07-06 00:00:00', '08985188755', 'Sanggar Indah Banjaran', 'defaultprofilepicture.jpg'),
(5, 'umkm', '$2y$10$Jx6ocFi8sN3eAVsYPcvRlOYeKPn/9/oDnDTI85i71WA0K460tkgNm', 'umkm desa cibogo', 1, 3, 1, 1, '2020-07-06 00:00:00', '08985188755', 'Sanggar Indah Banjaran', 'defaultprofilepicture.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `x_user_access_menu`
--

CREATE TABLE `x_user_access_menu` (
  `id` int(11) NOT NULL,
  `user_role_id` int(1) DEFAULT NULL,
  `menu_id` int(1) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `x_user_access_menu`
--

INSERT INTO `x_user_access_menu` (`id`, `user_role_id`, `menu_id`, `is_active`) VALUES
(2, 1, 1, 1),
(3, 2, 2, 1),
(4, 3, 3, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `x_user_listmenu`
--

CREATE TABLE `x_user_listmenu` (
  `id` int(11) NOT NULL,
  `submenu_id` int(11) DEFAULT NULL,
  `title` varchar(64) DEFAULT NULL,
  `url` varchar(32) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `x_user_listmenu`
--

INSERT INTO `x_user_listmenu` (`id`, `submenu_id`, `title`, `url`, `is_active`) VALUES
(1, 1, 'Master Data Barang Produk Kotoran Sapi & UMKM', 'produkkotoransapi', 1),
(2, 1, 'Master Data Barang Produk UMKM', '', 0),
(3, 1, 'Master Data Tabungan', 'masterdatatabungan', 1),
(4, 2, 'Data Barang Produk Kotoran Sapi & UMKM', 'databarangprodukksapi', 1),
(5, 2, 'Data Barang UMKM', '', 0),
(6, 4, 'Penjualan Produk Kotoran Sapi & UMKM', '', 1),
(7, 4, 'Penjualan Produk UMKM', '', 0),
(8, 10, 'Request Penjemputan Barang', 'requestjemputbarang', 1),
(9, 10, 'Request Pengambilan Uang Tabungan', '', 1),
(10, 10, 'Approval Penjemputan Barang', 'approvalpenjemputanbarang', 1),
(11, 10, 'Approval Pengambilan Tabungan', '', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `x_user_menu`
--

CREATE TABLE `x_user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(32) DEFAULT NULL,
  `information` varchar(64) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `x_user_menu`
--

INSERT INTO `x_user_menu` (`id`, `menu`, `information`, `is_active`) VALUES
(1, 'ADMINISTRATOR', '', 1),
(2, 'WARGA DESA CIBOGO', '', 1),
(3, 'UMKM', '', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `x_user_roles`
--

CREATE TABLE `x_user_roles` (
  `user_role_id` int(1) NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `description` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `x_user_roles`
--

INSERT INTO `x_user_roles` (`user_role_id`, `name`, `description`) VALUES
(1, 'ADMINISTRATOR', ''),
(2, 'WARGA', ''),
(3, 'UMKM', ''),
(4, 'NOT SET', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `x_user_status`
--

CREATE TABLE `x_user_status` (
  `user_status_id` int(1) NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `description` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `x_user_status`
--

INSERT INTO `x_user_status` (`user_status_id`, `name`, `description`) VALUES
(1, 'ACTIVE', ''),
(2, 'INACTIVE', ''),
(3, 'SUSPEND', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `x_user_submenu`
--

CREATE TABLE `x_user_submenu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `title` varchar(64) DEFAULT NULL,
  `icon` varchar(32) DEFAULT NULL,
  `data_target` varchar(32) DEFAULT NULL,
  `url` varchar(32) DEFAULT NULL,
  `is_parent` int(1) NOT NULL,
  `is_active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `x_user_submenu`
--

INSERT INTO `x_user_submenu` (`id`, `menu_id`, `title`, `icon`, `data_target`, `url`, `is_parent`, `is_active`) VALUES
(1, 1, 'Master Data', 'fas fa-table', 'collapseMasterDaataBarang', '', 1, 1),
(2, 1, 'Data Barang', 'fas fa-book', 'collapseDataBarang', NULL, 1, 1),
(3, 1, 'Data Tabungan', 'fas fa-money-bill-wave', '', 'datatabungan', 0, 1),
(4, 1, 'Penjualan Produk', 'fas fa-shopping-cart', 'collapsePenjualanProduk', '', 1, 1),
(5, 1, 'Request Penjemputan Barang', 'fas fa-truck-pickup', NULL, '', 0, 0),
(6, 1, 'Request Pengambilan Uang Tabungan', 'fas fa-hand-holding-usd', '', '', 0, 0),
(7, 2, 'Request Penjemputan Barang', 'fas fa-truck-pickup', '', '', 0, 1),
(8, 3, 'Request Penjemputan Barang', 'fas fa-truck-pickup', '', '', 0, 1),
(9, 2, 'Request Pengambilan Uang Tabungan', 'fas fa-hand-holding-usd', '', '', 0, 1),
(10, 1, 'Request Warga&UMKM', 'far fa-calendar-check', 'collapseRequest', '', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`category_id`);

--
-- Indeks untuk tabel `md_product`
--
ALTER TABLE `md_product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`product_code`),
  ADD UNIQUE KEY `product_code_2` (`product_code`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `unit_id` (`unit_id`),
  ADD KEY `product_type_id` (`product_type_id`);

--
-- Indeks untuk tabel `md_savings`
--
ALTER TABLE `md_savings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `product_inventory`
--
ALTER TABLE `product_inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeks untuk tabel `product_sales`
--
ALTER TABLE `product_sales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_sales` (`no_sales`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indeks untuk tabel `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`product_type_id`);

--
-- Indeks untuk tabel `request_pickup_item`
--
ALTER TABLE `request_pickup_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `request_status_id` (`request_status_id`),
  ADD KEY `FK_RequestPickupItem` (`request_type_id`);

--
-- Indeks untuk tabel `request_status`
--
ALTER TABLE `request_status`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `request_type`
--
ALTER TABLE `request_type`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `request_withdraw_savings`
--
ALTER TABLE `request_withdraw_savings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `md_savings_id` (`md_savings_id`),
  ADD KEY `request_status_id` (`request_status_id`);

--
-- Indeks untuk tabel `savings_data`
--
ALTER TABLE `savings_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `md_savings_id` (`md_savings_id`);

--
-- Indeks untuk tabel `unit_of_goods`
--
ALTER TABLE `unit_of_goods`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indeks untuk tabel `x_customers`
--
ALTER TABLE `x_customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_status_id` (`user_status_id`);

--
-- Indeks untuk tabel `x_users`
--
ALTER TABLE `x_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `user_status_id` (`user_status_id`),
  ADD KEY `user_role_id` (`user_role_id`),
  ADD KEY `FK_RequestTypeID` (`request_type_id`);

--
-- Indeks untuk tabel `x_user_access_menu`
--
ALTER TABLE `x_user_access_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indeks untuk tabel `x_user_listmenu`
--
ALTER TABLE `x_user_listmenu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `submenu_id` (`submenu_id`);

--
-- Indeks untuk tabel `x_user_menu`
--
ALTER TABLE `x_user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `x_user_roles`
--
ALTER TABLE `x_user_roles`
  ADD PRIMARY KEY (`user_role_id`);

--
-- Indeks untuk tabel `x_user_status`
--
ALTER TABLE `x_user_status`
  ADD PRIMARY KEY (`user_status_id`);

--
-- Indeks untuk tabel `x_user_submenu`
--
ALTER TABLE `x_user_submenu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `category_product`
--
ALTER TABLE `category_product`
  MODIFY `category_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `md_product`
--
ALTER TABLE `md_product`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `md_savings`
--
ALTER TABLE `md_savings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `product_inventory`
--
ALTER TABLE `product_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `product_sales`
--
ALTER TABLE `product_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `product_type`
--
ALTER TABLE `product_type`
  MODIFY `product_type_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `request_pickup_item`
--
ALTER TABLE `request_pickup_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `request_status`
--
ALTER TABLE `request_status`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `request_type`
--
ALTER TABLE `request_type`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `request_withdraw_savings`
--
ALTER TABLE `request_withdraw_savings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `savings_data`
--
ALTER TABLE `savings_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `unit_of_goods`
--
ALTER TABLE `unit_of_goods`
  MODIFY `unit_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `x_customers`
--
ALTER TABLE `x_customers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `x_users`
--
ALTER TABLE `x_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `x_user_access_menu`
--
ALTER TABLE `x_user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `x_user_listmenu`
--
ALTER TABLE `x_user_listmenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `x_user_menu`
--
ALTER TABLE `x_user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `x_user_roles`
--
ALTER TABLE `x_user_roles`
  MODIFY `user_role_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `x_user_status`
--
ALTER TABLE `x_user_status`
  MODIFY `user_status_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `x_user_submenu`
--
ALTER TABLE `x_user_submenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `md_product`
--
ALTER TABLE `md_product`
  ADD CONSTRAINT `md_product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category_product` (`category_id`),
  ADD CONSTRAINT `md_product_ibfk_2` FOREIGN KEY (`unit_id`) REFERENCES `unit_of_goods` (`unit_id`),
  ADD CONSTRAINT `md_product_ibfk_3` FOREIGN KEY (`product_type_id`) REFERENCES `product_type` (`product_type_id`);

--
-- Ketidakleluasaan untuk tabel `md_savings`
--
ALTER TABLE `md_savings`
  ADD CONSTRAINT `md_savings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `x_users` (`id`);

--
-- Ketidakleluasaan untuk tabel `product_inventory`
--
ALTER TABLE `product_inventory`
  ADD CONSTRAINT `product_inventory_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `md_product` (`id`);

--
-- Ketidakleluasaan untuk tabel `product_sales`
--
ALTER TABLE `product_sales`
  ADD CONSTRAINT `product_sales_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `md_product` (`id`),
  ADD CONSTRAINT `product_sales_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `x_customers` (`id`);

--
-- Ketidakleluasaan untuk tabel `request_pickup_item`
--
ALTER TABLE `request_pickup_item`
  ADD CONSTRAINT `FK_RequestPickupItem` FOREIGN KEY (`request_type_id`) REFERENCES `request_type` (`id`),
  ADD CONSTRAINT `request_pickup_item_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `x_users` (`id`),
  ADD CONSTRAINT `request_pickup_item_ibfk_2` FOREIGN KEY (`request_status_id`) REFERENCES `request_status` (`id`);

--
-- Ketidakleluasaan untuk tabel `request_withdraw_savings`
--
ALTER TABLE `request_withdraw_savings`
  ADD CONSTRAINT `request_withdraw_savings_ibfk_1` FOREIGN KEY (`md_savings_id`) REFERENCES `md_savings` (`id`),
  ADD CONSTRAINT `request_withdraw_savings_ibfk_2` FOREIGN KEY (`request_status_id`) REFERENCES `request_status` (`id`);

--
-- Ketidakleluasaan untuk tabel `savings_data`
--
ALTER TABLE `savings_data`
  ADD CONSTRAINT `savings_data_ibfk_1` FOREIGN KEY (`md_savings_id`) REFERENCES `md_savings` (`id`);

--
-- Ketidakleluasaan untuk tabel `x_customers`
--
ALTER TABLE `x_customers`
  ADD CONSTRAINT `fk_user_status_id` FOREIGN KEY (`user_status_id`) REFERENCES `x_user_status` (`user_status_id`);

--
-- Ketidakleluasaan untuk tabel `x_users`
--
ALTER TABLE `x_users`
  ADD CONSTRAINT `FK_RequestTypeID` FOREIGN KEY (`request_type_id`) REFERENCES `request_type` (`id`),
  ADD CONSTRAINT `x_users_ibfk_1` FOREIGN KEY (`user_status_id`) REFERENCES `x_user_status` (`user_status_id`),
  ADD CONSTRAINT `x_users_ibfk_2` FOREIGN KEY (`user_role_id`) REFERENCES `x_user_roles` (`user_role_id`);

--
-- Ketidakleluasaan untuk tabel `x_user_access_menu`
--
ALTER TABLE `x_user_access_menu`
  ADD CONSTRAINT `x_user_access_menu_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `x_user_menu` (`id`);

--
-- Ketidakleluasaan untuk tabel `x_user_listmenu`
--
ALTER TABLE `x_user_listmenu`
  ADD CONSTRAINT `x_user_listmenu_ibfk_1` FOREIGN KEY (`submenu_id`) REFERENCES `x_user_submenu` (`id`);

--
-- Ketidakleluasaan untuk tabel `x_user_submenu`
--
ALTER TABLE `x_user_submenu`
  ADD CONSTRAINT `x_user_submenu_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `x_user_menu` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

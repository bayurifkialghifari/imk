-- Adminer 4.8.1 MySQL 8.0.27 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `bahan`;
CREATE TABLE `bahan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `stok` float NOT NULL,
  `harga` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

INSERT INTO `bahan` (`id`, `nama`, `stok`, `harga`) VALUES
(1,	'Tepung',	200,	10000),
(2,	'Beras',	50,	5000),
(3,	'Air',	10000,	100);

DROP TABLE IF EXISTS `detail_pesanan`;
CREATE TABLE `detail_pesanan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pesanan` int NOT NULL,
  `id_menu` int NOT NULL,
  `qty` int NOT NULL,
  `total` int NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Belum Siap',
  `created_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

INSERT INTO `detail_pesanan` (`id`, `id_pesanan`, `id_menu`, `qty`, `total`, `status`, `created_at`) VALUES
(6,	1,	3,	1,	10000,	'Sudah Siap',	'0000-00-00 00:00:00'),
(7,	7,	3,	1,	10000,	'Sudah Siap',	'2022-08-08 10:32:40'),
(8,	7,	2,	2,	2000,	'Sudah Siap',	'2022-08-08 10:32:43');

DROP TABLE IF EXISTS `meja`;
CREATE TABLE `meja` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nomor` varchar(50) NOT NULL,
  `jumlah_kursi` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

INSERT INTO `meja` (`id`, `nomor`, `jumlah_kursi`) VALUES
(1,	'A-01',	5),
(2,	'A-02',	5);

DROP TABLE IF EXISTS `meja_pelanggan`;
CREATE TABLE `meja_pelanggan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_meja` int NOT NULL,
  `id_pelanggan` int NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

INSERT INTO `meja_pelanggan` (`id`, `id_meja`, `id_pelanggan`, `status`) VALUES
(4,	1,	7,	'Active'),
(5,	2,	8,	'Not Active');

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_tipe` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `gambar` varchar(150)  NOT NULL,
  `keterangan` text NOT NULL,
  `harga` int NOT NULL DEFAULT '0',
  `stok` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

INSERT INTO `menu` (`id`, `id_tipe`, `nama`, `gambar`, `keterangan`, `harga`, `stok`) VALUES
(2,	2,	'Es Batu',	'1659864013relational.png',	'Baguss',	1000,	98),
(3,	1,	'Nasi Goreng',	'1659897042download (1).png',	'Nasi terenak sedunia',	10000,	3);

DROP TABLE IF EXISTS `pelanggan`;
CREATE TABLE `pelanggan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `atas_nama` varchar(50) NOT NULL,
  `jumlah` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

INSERT INTO `pelanggan` (`id`, `atas_nama`, `jumlah`) VALUES
(7,	'Mapud',	3),
(8,	'Nice',	3);

DROP TABLE IF EXISTS `pembayaran`;
CREATE TABLE `pembayaran` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pesanan` int NOT NULL,
  `id_user` int NOT NULL,
  `total` int NOT NULL,
  `status` varchar(50) NOT NULL,
  `bukti` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

INSERT INTO `pembayaran` (`id`, `id_pesanan`, `id_user`, `total`, `status`, `bukti`, `created_at`) VALUES
(3,	7,	1,	12000,	'Dibayar',	'',	'2022-08-08 04:16:27');

DROP TABLE IF EXISTS `pesanan`;
CREATE TABLE `pesanan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_meja_pelanggan` int NOT NULL,
  `id_user` int NOT NULL,
  `created_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

INSERT INTO `pesanan` (`id`, `id_meja_pelanggan`, `id_user`, `created_at`) VALUES
(1,	4,	1,	'2022-08-08 09:59:50'),
(7,	5,	1,	'2022-08-08 09:59:53');

DROP TABLE IF EXISTS `resep`;
CREATE TABLE `resep` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_menu` int NOT NULL,
  `id_bahan` int NOT NULL,
  `jumlah` float NOT NULL,
  `satuan` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

INSERT INTO `resep` (`id`, `id_menu`, `id_bahan`, `jumlah`, `satuan`) VALUES
(3,	2,	3,	10,	'KG'),
(4,	2,	1,	10,	'KG'),
(5,	2,	2,	10,	'KG'),
(6,	3,	2,	10,	'KG');

DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

INSERT INTO `role` (`id`, `nama`, `status`) VALUES
(1,	'Admin',	'Active'),
(2,	'Pelayan',	'Active'),
(3,	'Koki',	'Active'),
(4,	'Kasir',	'Active');

DROP TABLE IF EXISTS `tipe`;
CREATE TABLE `tipe` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

INSERT INTO `tipe` (`id`, `nama`) VALUES
(1,	'Makanan'),
(2,	'Minuman');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role_id` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

INSERT INTO `user` (`id`, `role_id`, `nama`, `email`, `password`) VALUES
(1,	1,	'Admin',	'admin@admin.com',	'$2a$10$INKwaFg7UIy9mawq8C0KSO8PXF9XuRdn5uYgsipi.CAIfCexnYNxC'),
(2,	2,	'Pelayan',	'pelayan@pelayan.com',	'$2y$10$jZ3SdU63EgU5X9.PZeS0meS.Xg5XU7Zlt6S8X1MGgeeS/vUOgBDNu'),
(3,	3,	'Koki',	'koki@koki.com',	'$2y$10$yHJldeugvkIDLdZUJw7.k.ZNMJlkscJZ.pWJUruD4Dgh5GuSJyQuS'),
(4,	4,	'Kasir',	'kasir@kasir.com',	'$2y$10$G2A5iT5fZ1lsFT7Q/J/atOqvwgHb3jNMf65DvQwKoIBODhnxzg.22');

-- 2022-08-08 13:40:28

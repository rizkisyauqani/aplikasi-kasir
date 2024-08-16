-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 20, 2019 at 08:07 AM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `project_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL,
  `invoice_nomor` int(11) NOT NULL,
  `invoice_tanggal` date NOT NULL,
  `invoice_pelanggan` varchar(255) NOT NULL,
  `invoice_kasir` int(11) NOT NULL,
  `invoice_sub_total` int(11) NOT NULL,
  `invoice_diskon` int(11) NOT NULL,
  `invoice_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `invoice_nomor`, `invoice_tanggal`, `invoice_pelanggan`, `invoice_kasir`, `invoice_sub_total`, `invoice_diskon`, `invoice_total`) VALUES
(1, 19111200, '2019-11-11', 'Jhony', 1, 18000, 0, 18000),
(2, 19111201, '2019-11-11', 'Samsul Bahri', 1, 25000, 0, 25000),
(3, 19111202, '2019-11-11', 'Diki', 1, 38000, 0, 38000),
(4, 19111203, '2019-11-10', 'Zahra', 1, 238000, 0, 238000),
(5, 19111204, '2019-11-10', 'Sulaiman', 1, 7000, 0, 7000),
(6, 19111205, '2019-11-10', 'Suyono', 1, 15000, 0, 15000),
(7, 19111206, '2019-11-12', 'Ahmad', 3, 76000, 0, 76000),
(8, 19111207, '2019-11-12', 'Donno', 3, 59000, 0, 59000),
(9, 19111508, '2019-11-15', 'Yahya', 1, 25000, 0, 25000),
(10, 19111509, '2019-11-15', 'Burni', 1, 5000, 0, 5000),
(11, 19111510, '2019-11-15', 'Bahnana', 1, 74000, 0, 74000),
(12, 19111911, '2019-11-19', 'sulaiman', 1, 26000, 0, 26000);

-- --------------------------------------------------------

--
-- Table structure for table `kasir`
--

CREATE TABLE `kasir` (
  `kasir_id` int(11) NOT NULL,
  `kasir_nama` varchar(255) NOT NULL,
  `kasir_username` varchar(255) NOT NULL,
  `kasir_password` varchar(255) NOT NULL,
  `kasir_foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kasir`
--

INSERT INTO `kasir` (`kasir_id`, `kasir_nama`, `kasir_username`, `kasir_password`, `kasir_foto`) VALUES
(1, 'Cahyana Ningsih', 'kasir1', '29c748d4d8f4bd5cbc0f3f60cb7ed3d0', ''),
(3, 'Sujono Markuti', 'kasir2', '8c86013d8ba23d9b5ade4d6463f81c45', '');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `kategori`) VALUES
(1, 'Lainnya'),
(3, 'Sembako'),
(4, 'Minyak Goreng'),
(5, 'Beras'),
(6, 'Susu Bubuk'),
(8, 'Susu Kaleng'),
(9, 'Mie Instan'),
(10, 'Roti'),
(11, 'Es Krim'),
(12, 'Peralatan Masak'),
(13, 'Peralatan Makan'),
(14, 'Kosmetik'),
(12346, 'Sabun Cuci'),
(12347, 'Sabun Mandi'),
(12348, 'Shampo'),
(12350, 'Pasta Gigi');

-- --------------------------------------------------------

--
-- Table structure for table `pimpinan`
--

CREATE TABLE `pimpinan` (
  `pimpinan_id` int(11) NOT NULL,
  `pimpinan_nama` varchar(255) NOT NULL,
  `pimpinan_username` varchar(255) NOT NULL,
  `pimpinan_password` varchar(255) NOT NULL,
  `pimpinan_foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pimpinan`
--

INSERT INTO `pimpinan` (`pimpinan_id`, `pimpinan_nama`, `pimpinan_username`, `pimpinan_password`, `pimpinan_foto`) VALUES
(1, 'Appimpinan Pattaya', 'pimpinan1', 'a1475279de60efc1b418fa651f695384', '');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `produk_id` int(11) NOT NULL,
  `produk_kode` varchar(255) NOT NULL,
  `produk_nama` varchar(255) NOT NULL,
  `produk_satuan` varchar(20) NOT NULL,
  `produk_kategori` int(11) NOT NULL,
  `produk_stok` int(11) NOT NULL,
  `produk_harga_modal` int(11) NOT NULL,
  `produk_harga_jual` int(11) NOT NULL,
  `produk_keterangan` text NOT NULL,
  `produk_foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`produk_id`, `produk_kode`, `produk_nama`, `produk_satuan`, `produk_kategori`, `produk_stok`, `produk_harga_modal`, `produk_harga_jual`, `produk_keterangan`, `produk_foto`) VALUES
(6, 'PROD000', 'Es Krip Cornetto', 'Bh', 11, 20, 4500, 5000, 'es wall', ''),
(7, 'PROD001', 'Lipstik Wardah Pink', 'Bh', 14, 30, 15000, 18000, '', ''),
(8, 'PROD002', 'Minyak Bimoli', 'Kg', 4, 50, 54000, 58000, '', ''),
(9, 'PROD003', 'Susu Dancow Coklat 1kg', 'Kg', 6, 39, 51000, 53000, '', ''),
(10, 'PROD004', 'Susu Dancow Vanila 1Kg', 'Kg', 6, 20, 52000, 54000, '', ''),
(11, 'PROD005', 'Susu Kaleng  Tiga Sapi', 'Klg', 8, 98, 15000, 17000, '', ''),
(12, 'PROD006', 'Susu Boneto 500gram', 'Ktk', 6, 97, 30000, 32000, '', ''),
(13, 'PROD007', 'Mie Sedap', 'Bh', 9, 187, 1500, 2000, '', ''),
(14, 'PROD008', 'Mie Soto Medan', 'Bh', 9, 95, 1500, 2000, '', ''),
(15, 'PROD009', 'Beras Sehat ', 'Sak', 5, 29, 140000, 150000, '', ''),
(16, 'PROD010', 'Shampo Sunsilk Botol', 'Btl', 12348, 46, 7000, 8000, '', ''),
(17, 'PROD011', 'Sabun LUX Anggur', 'Bh', 12347, 32, 4000, 5000, '', ''),
(18, 'PROD012', 'Sabun Lifeboy', 'Bh', 12347, 65, 3500, 5000, '', ''),
(20, 'PROD013', 'Pasta Gigi Pepsodent Expert', 'Bh', 12350, 2, 4000, 5000, '', '1811547636_Pepsodent.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `transaksi_id` int(11) NOT NULL,
  `transaksi_invoice` int(11) NOT NULL,
  `transaksi_produk` int(11) NOT NULL,
  `transaksi_harga` int(11) NOT NULL,
  `transaksi_jumlah` int(11) NOT NULL,
  `transaksi_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`transaksi_id`, `transaksi_invoice`, `transaksi_produk`, `transaksi_harga`, `transaksi_jumlah`, `transaksi_total`) VALUES
(1, 1, 18, 5000, 2, 10000),
(2, 1, 16, 8000, 1, 8000),
(3, 2, 18, 5000, 1, 5000),
(4, 2, 17, 5000, 2, 10000),
(5, 2, 13, 2000, 5, 10000),
(8, 3, 13, 2000, 3, 6000),
(9, 3, 12, 32000, 1, 32000),
(10, 4, 18, 5000, 2, 10000),
(11, 4, 15, 150000, 1, 150000),
(12, 4, 11, 17000, 1, 17000),
(13, 4, 9, 53000, 1, 53000),
(14, 4, 16, 8000, 1, 8000),
(21, 5, 17, 5000, 1, 5000),
(22, 5, 14, 2000, 1, 2000),
(23, 6, 17, 5000, 3, 15000),
(24, 7, 18, 5000, 8, 40000),
(25, 7, 14, 2000, 2, 4000),
(26, 7, 12, 32000, 1, 32000),
(27, 8, 13, 2000, 5, 10000),
(28, 8, 12, 32000, 1, 32000),
(29, 8, 11, 17000, 1, 17000),
(30, 9, 20, 5000, 3, 15000),
(31, 9, 17, 5000, 2, 10000),
(32, 10, 20, 5000, 1, 5000),
(33, 11, 20, 5000, 14, 70000),
(34, 11, 14, 2000, 2, 4000),
(35, 12, 18, 5000, 2, 10000),
(36, 12, 16, 8000, 2, 16000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_nama` varchar(100) NOT NULL,
  `user_username` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_nama`, `user_username`, `user_password`, `user_foto`) VALUES
(1, 'Adminatun Jhony', 'admin', '21232f297a57a5a743894a0e4a801fc3', '482937136_avatar.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `kasir`
--
ALTER TABLE `kasir`
  ADD PRIMARY KEY (`kasir_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `pimpinan`
--
ALTER TABLE `pimpinan`
  ADD PRIMARY KEY (`pimpinan_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`produk_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`transaksi_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kasir`
--
ALTER TABLE `kasir`
  MODIFY `kasir_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12353;

--
-- AUTO_INCREMENT for table `pimpinan`
--
ALTER TABLE `pimpinan`
  MODIFY `pimpinan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `produk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

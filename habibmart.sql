-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2021 at 06:14 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `habibmart`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_toko`
--

CREATE TABLE `data_toko` (
  `kd_data_toko` varchar(5) NOT NULL,
  `alamat` text NOT NULL,
  `no_whatsapp` varchar(16) NOT NULL,
  `no_telepon` varchar(16) NOT NULL,
  `email` varchar(30) NOT NULL,
  `facebook` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_toko`
--

INSERT INTO `data_toko` (`kd_data_toko`, `alamat`, `no_whatsapp`, `no_telepon`, `email`, `facebook`) VALUES
('DT001', 'Jl. Tambak Sari, Bodorejo, Kec. Merakurak, Kab. Tuban', '0899271662721', '0899271662721', 'HabibMart@gmail.com', 'HabibMart_FB');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `no_pembelian` varchar(10) NOT NULL,
  `kd_produk` varchar(5) NOT NULL,
  `kd_supplier` varchar(5) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`no_pembelian`, `kd_produk`, `kd_supplier`, `harga`, `jumlah`, `subtotal`) VALUES
('PB00000001', 'H0006', 'SP001', 60000, 4, 240000),
('PB00000002', 'H0001', 'SP001', 37000, 1, 37000);

--
-- Triggers `detail_pembelian`
--
DELIMITER $$
CREATE TRIGGER `penyempurnaan_drop_tmp_pembelian` AFTER INSERT ON `detail_pembelian` FOR EACH ROW begin
	update produk set stok=stok+new.jumlah where kd_produk=new.kd_produk;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `no_penjualan` varchar(10) NOT NULL,
  `kd_produk` varchar(5) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`no_penjualan`, `kd_produk`, `harga`, `jumlah`, `subtotal`) VALUES
('PJ00000001', 'H0003', 40000, 5, 200000),
('PJ00000002', 'H0004', 70000, 5, 350000),
('PJ00000003', 'H0006', 70000, 7, 490000),
('PJ00000003', 'H0007', 90000, 8, 720000),
('PJ00000004', 'H0001', 50000, 1, 50000);

--
-- Triggers `detail_penjualan`
--
DELIMITER $$
CREATE TRIGGER `penyempuranaan_drop_tmp_penjualan` AFTER INSERT ON `detail_penjualan` FOR EACH ROW begin
	update produk set stok=stok-new.jumlah where kd_produk=new.kd_produk;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `kd_data_toko` varchar(6) NOT NULL,
  `foto1` varchar(50) NOT NULL,
  `foto2` varchar(50) NOT NULL,
  `foto3` varchar(50) NOT NULL,
  `foto4` varchar(50) NOT NULL,
  `foto5` varchar(50) NOT NULL,
  `foto6` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`kd_data_toko`, `foto1`, `foto2`, `foto3`, `foto4`, `foto5`, `foto6`) VALUES
('DT001', 'gallery-1.jpg', 'gallery-2.jpg', 'gallery-3.jpg', 'gallery-4.jpg', '5__Blogs.PNG', 'gallery-6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `no_pembelian` char(10) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `total` int(11) NOT NULL,
  `uang_bayar` int(12) NOT NULL,
  `kd_petugas` char(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`no_pembelian`, `tgl_pembelian`, `total`, `uang_bayar`, `kd_petugas`) VALUES
('PB00000002', '2020-10-08', 37000, 37000, 'PT001'),
('PB00000001', '2020-10-07', 240000, 240000, 'PT001');

--
-- Triggers `pembelian`
--
DELIMITER $$
CREATE TRIGGER `copy_from_tmp_pembelian` AFTER INSERT ON `pembelian` FOR EACH ROW begin
	insert into detail_pembelian select * from tmp_detail_pembelian where no_pembelian = new.no_pembelian;
    delete from tmp_detail_pembelian where no_pembelian = new.no_pembelian;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `delete_with_detail_pembelian` AFTER DELETE ON `pembelian` FOR EACH ROW begin
	delete from detail_pembelian where no_pembelian=old.no_pembelian;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `no_penjualan` char(10) NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `total` int(11) NOT NULL,
  `uang_bayar` int(12) NOT NULL,
  `kd_petugas` char(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`no_penjualan`, `tgl_penjualan`, `total`, `uang_bayar`, `kd_petugas`) VALUES
('PJ00000004', '2020-10-14', 50000, 50000, 'PT001'),
('PJ00000003', '2020-10-08', 1210000, 1210000, 'PT001'),
('PJ00000002', '2020-10-08', 350000, 350000, 'PT001'),
('PJ00000001', '2020-10-08', 200000, 200000, 'PT001');

--
-- Triggers `penjualan`
--
DELIMITER $$
CREATE TRIGGER `copy_from_tmp` AFTER INSERT ON `penjualan` FOR EACH ROW begin
	insert into detail_penjualan select * from tmp_detail_penjualan where no_penjualan = new.no_penjualan;
    delete from tmp_detail_penjualan where no_penjualan = new.no_penjualan;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `delete_with_detail` AFTER DELETE ON `penjualan` FOR EACH ROW begin
	delete from detail_penjualan where no_penjualan=old.no_penjualan;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `kd_petugas` char(5) NOT NULL,
  `nik` char(16) NOT NULL,
  `nm_petugas` varchar(50) NOT NULL,
  `gender` char(9) NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(20) NOT NULL DEFAULT 'Kasir'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`kd_petugas`, `nik`, `nm_petugas`, `gender`, `alamat`, `no_telepon`, `username`, `password`, `level`) VALUES
('PT001', '3514231712980002', 'Galih Aditya', 'Laki-Laki', 'Desa Kemantren rejo, RT 02, RW 01, Rejoso, Pasuruan', '081192345111', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator'),
('PT002', '3514231812980002', 'Fitria Handayani', 'Perempuan', 'Jl Diponegoro, no 21, Pasuruan Jatim', '081192244563', 'fitria', 'ee11cbb19052e40b07aac0ca060c23ee', 'Petugas');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `kd_produk` char(5) NOT NULL,
  `nm_produk` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `harga_modal` int(10) NOT NULL,
  `harga_jual` int(10) NOT NULL,
  `stok` int(10) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`kd_produk`, `nm_produk`, `gambar`, `harga_modal`, `harga_jual`, `stok`, `keterangan`) VALUES
('H0001', 'Akar Zaitun', 'H0001.png', 37000, 50000, 70, 'Obat Diabetes'),
('H0002', 'Habatusauda', '', 85000, 100000, 70, 'untuk kesehatans'),
('H0003', 'Air Zam Zam 1 Liter ', '', 26000, 40000, 5, 'air zam zam'),
('H0004', 'Alat Bekam 12 Cup', '', 58000, 70000, 5, 'alat bekam'),
('H0005', 'Bio Skin Car', '', 10000, 15000, 40, 'Skin car'),
('H0006', 'Bio Xamthone', '', 60000, 70000, 3, 'xamtone'),
('H0007', 'Buah Merah Papua (BMW) ', '', 55000, 90000, 2, 'buah merah'),
('H0008', 'Cabe Jawa HIU', '', 27000, 45000, 5, 'cabe jawa'),
('H0009', 'Cream Jerawat Anisa Dark Spot', '', 55000, 85000, 5, 'untuk jerawat'),
('H0010', 'Daun Sirsak HIU', '', 27000, 45000, 14, 'daun sirsak'),
('H0011', 'Diabetas Binasyifa', '', 27500, 50000, 17, 'obat diabetes'),
('H0012', 'Etawa Emas Original', '', 25000, 45000, 19, 'susu etawa'),
('H0013', 'FOREDI ', '', 165000, 200000, 6, 'obat kuat pria'),
('H0014', 'Gamat HIU', '', 45000, 75000, 9, 'gamat'),
('H0015', 'Gemuk Badan Binasyifa', '', 22000, 40000, 16, 'herbal gemuk badan'),
('H0016', 'Habasyi Oil 210 Kps', '', 50000, 89000, 18, 'Habatusauda'),
('H0017', 'Habasyi Oil 75 Kps', '', 24000, 42500, 19, 'habatusauda'),
('H0018', 'Habasyi Plus 120 Kapsul', '', 20000, 26500, 17, 'habatusauda plus mnyak zaitun'),
('H0019', 'Habasyi Plus 200 Kapsul', '', 30500, 42000, 19, 'habatusauda plus mnyak zaitun'),
('H0020', 'Herba Sambung Nyowo HIU', '', 27500, 45000, 10, 'sambung nyowo'),
('H0021', 'Herbal Oil Sambung Nyowo', '', 50000, 75000, 19, 'sambung nyowo'),
('H0022', 'Honey Moon', '', 39500, 70000, 18, 'rapet wanita'),
('H0023', 'Injoy Reflexology Sandal', '', 90000, 150000, 10, 'sandal refleksi'),
('H0024', 'Jadied Lambung', '', 15000, 25000, 10, 'untuk lambung'),
('H0025', 'Joss X HIU', '', 27000, 45000, 10, 'keperkasaan pria'),
('H0026', 'Joss V HIU', '', 27000, 45000, 10, 'keperkasaan wanita'),
('H0027', 'Kapsul Jati Belanda', '', 27000, 40000, 10, 'jati belanda'),
('H0028', 'Keladi Tikus Toga Nusantara', '', 29000, 55000, 10, 'tikus'),
('H0029', 'Klorofil K-Link', '', 67000, 150000, 10, 'k-link'),
('H0030', 'Koyo Anti Nyamuk', '', 8000, 15000, 50, 'anti nyamuk'),
('H0031', 'Lamandel ', '', 20500, 35000, 20, 'obat amandel'),
('H0032', 'Madu Batuk Al Wadey', '', 18000, 26000, 8, 'obat batuk'),
('H0033', 'Madu Mesir', '', 47000, 75000, 10, 'madu murni'),
('H0034', 'Madu Sambung Nyowo 100 ML', '', 24000, 35000, 10, 'sambung nyowo'),
('H0035', 'Madu Sambung Asmoro 100 ML', '', 24000, 35000, 10, 'sambung asmoro'),
('H0036', 'Bodrex Flu dan Batuk PE', '', 80000, 90000, 10, 'Bodrek cocok dimakan dengan nasi goreng');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `kd_supplier` varchar(5) NOT NULL,
  `nm_supplier` varchar(40) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telepon` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`kd_supplier`, `nm_supplier`, `alamat`, `no_telepon`) VALUES
('SP001', 'CV. Intan Sanjaya', 'Jl. Permata Indah, Merakurak, Tuban', '082172727'),
('SP002', 'IDX Margotani', 'Jl. Pantura no. 21, Tuban', '027262277');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_detail_pembelian`
--

CREATE TABLE `tmp_detail_pembelian` (
  `no_pembelian` varchar(10) NOT NULL,
  `kd_produk` varchar(5) NOT NULL,
  `kd_supplier` varchar(5) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `tmp_detail_pembelian`
--
DELIMITER $$
CREATE TRIGGER `batal_produk_beli` AFTER DELETE ON `tmp_detail_pembelian` FOR EACH ROW begin
update produk set stok=stok-old.jumlah where kd_produk=old.kd_produk;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tambah_stok` BEFORE INSERT ON `tmp_detail_pembelian` FOR EACH ROW begin
update produk set stok = stok + new.jumlah where kd_produk=new.kd_produk;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tmp_detail_penjualan`
--

CREATE TABLE `tmp_detail_penjualan` (
  `no_penjualan` varchar(10) NOT NULL,
  `kd_produk` varchar(5) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `tmp_detail_penjualan`
--
DELIMITER $$
CREATE TRIGGER `batal_produk_penjualan` AFTER DELETE ON `tmp_detail_penjualan` FOR EACH ROW begin
	update produk set stok=stok+old.jumlah where kd_produk=old.kd_produk;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `kurang_stok` BEFORE INSERT ON `tmp_detail_penjualan` FOR EACH ROW begin
	update produk set stok=stok-new.jumlah where kd_produk=new.kd_produk;
end
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_toko`
--
ALTER TABLE `data_toko`
  ADD PRIMARY KEY (`kd_data_toko`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD UNIQUE KEY `kd_data_toko` (`kd_data_toko`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`no_pembelian`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`no_penjualan`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`kd_petugas`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`kd_produk`) USING BTREE;

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`kd_supplier`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

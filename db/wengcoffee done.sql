/*
SQLyog Ultimate v10.42 
MySQL - 5.5.5-10.4.32-MariaDB : Database - wengcoffee
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`wengcoffee` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;

USE `wengcoffee`;

/*Table structure for table `bank` */

DROP TABLE IF EXISTS `bank`;

CREATE TABLE `bank` (
  `idbank` char(10) NOT NULL,
  `namabank` varchar(50) DEFAULT NULL,
  `atasnama` varchar(50) DEFAULT NULL,
  `norekening` varchar(20) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') DEFAULT NULL,
  PRIMARY KEY (`idbank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `bank` */

insert  into `bank`(`idbank`,`namabank`,`atasnama`,`norekening`,`keterangan`,`foto`,`statusaktif`) values ('BNK-000002','QRIS','Weng Coffee','006753624','-','qris.jpg','Aktif');

/*Table structure for table `barang` */

DROP TABLE IF EXISTS `barang`;

CREATE TABLE `barang` (
  `idbarang` char(10) NOT NULL,
  `namabarang` varchar(50) DEFAULT NULL,
  `idjenis` char(10) DEFAULT NULL,
  `satuan` varchar(20) DEFAULT NULL,
  `harga` decimal(18,0) DEFAULT NULL,
  `stok` decimal(18,0) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') DEFAULT NULL,
  `idkategori` char(10) DEFAULT NULL,
  PRIMARY KEY (`idbarang`),
  KEY `idjenis` (`idjenis`),
  KEY `idkategori` (`idkategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `barang` */

insert  into `barang`(`idbarang`,`namabarang`,`idjenis`,`satuan`,`harga`,`stok`,`foto`,`statusaktif`,`idkategori`) values ('BRG-000001','Wiskas C','JNS-000001','Pcs',4500,14,'download1.jpg','Aktif','KTG-000001'),('BRG-000002','Wiskas D','JNS-000001','pcs',60000,100,'download.jpg','Aktif','KTG-000001'),('BRG-000003','Kopi Bubuk','JNS-000001','Kg',120000,10,'','Aktif','KTG-000004'),('BRG-000004','Susu','JNS-000002','Kaleng',22000,50,'','Aktif','KTG-000004');

/*Table structure for table `barangkeluar` */

DROP TABLE IF EXISTS `barangkeluar`;

CREATE TABLE `barangkeluar` (
  `idbarangkeluar` char(10) NOT NULL,
  `tglbarangkeluar` date DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `tglinsert` datetime DEFAULT NULL,
  `tglupdate` datetime DEFAULT NULL,
  `idpengguna` char(10) DEFAULT NULL,
  PRIMARY KEY (`idbarangkeluar`),
  KEY `idpengguna` (`idpengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `barangkeluar` */

insert  into `barangkeluar`(`idbarangkeluar`,`tglbarangkeluar`,`keterangan`,`tglinsert`,`tglupdate`,`idpengguna`) values ('2208020001','2022-08-02','-','2022-08-02 21:30:09','2022-08-02 21:30:09','0000000000'),('2408120001','2024-08-12','-','2024-08-12 01:41:30','2024-08-12 01:41:30','PGN-000003'),('2408120002','2024-08-12','order dari penjualan untuk bulan ini','2024-08-12 01:42:46','2024-08-12 01:42:46','PGN-000003');

/*Table structure for table `barangkeluar_detail` */

DROP TABLE IF EXISTS `barangkeluar_detail`;

CREATE TABLE `barangkeluar_detail` (
  `idbarangkeluar` char(10) DEFAULT NULL,
  `idbarang` char(10) DEFAULT NULL,
  `qty` decimal(18,2) DEFAULT NULL,
  `harga` decimal(18,0) DEFAULT NULL,
  `totalharga` decimal(18,0) DEFAULT NULL,
  UNIQUE KEY `idbarangkeluar` (`idbarangkeluar`,`idbarang`),
  KEY `idbarang` (`idbarang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `barangkeluar_detail` */

insert  into `barangkeluar_detail`(`idbarangkeluar`,`idbarang`,`qty`,`harga`,`totalharga`) values ('2208020001','BRG-000001',5.00,4500,22500),('2208020001','BRG-000002',6.00,60000,360000),('2408120001','BRG-000003',5.00,120000,600000),('2408120002','BRG-000003',5.00,120000,600000);

/*Table structure for table `barangmasuk` */

DROP TABLE IF EXISTS `barangmasuk`;

CREATE TABLE `barangmasuk` (
  `idbarangmasuk` char(10) NOT NULL,
  `tglbarangmasuk` date DEFAULT NULL,
  `nostruk` varchar(20) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `idsupplier` char(10) DEFAULT NULL,
  `idpengguna` char(10) DEFAULT NULL,
  `tglinsert` datetime DEFAULT NULL,
  `tglupdate` datetime DEFAULT NULL,
  PRIMARY KEY (`idbarangmasuk`),
  KEY `idpengguna` (`idpengguna`),
  KEY `idsupplier` (`idsupplier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `barangmasuk` */

insert  into `barangmasuk`(`idbarangmasuk`,`tglbarangmasuk`,`nostruk`,`keterangan`,`foto`,`idsupplier`,`idpengguna`,`tglinsert`,`tglupdate`) values ('2208020001','2022-08-02','-','-','download2.jpg','SPL-000001','0000000000','2022-08-02 21:26:10','2022-08-02 21:27:12'),('2208020002','2022-08-02','-','-',NULL,'SPL-000002','0000000000','2022-08-02 22:01:26','2022-08-02 22:01:26'),('2408120001','2024-08-12','000','-','makanan_weng1.jpg','SPL-000001','PGN-000003','2024-08-12 01:41:04','2024-08-12 01:41:04'),('2408120002','2024-08-12','-','-','makanan_weng2.jpg','SPL-000001','PGN-000003','2024-08-12 01:42:14','2024-08-12 01:42:14');

/*Table structure for table `barangmasuk_detail` */

DROP TABLE IF EXISTS `barangmasuk_detail`;

CREATE TABLE `barangmasuk_detail` (
  `idbarangmasuk` char(10) DEFAULT NULL,
  `idbarang` char(10) DEFAULT NULL,
  `qty` decimal(18,0) DEFAULT NULL,
  `harga` decimal(18,0) DEFAULT NULL,
  `totalharga` decimal(18,0) DEFAULT NULL,
  UNIQUE KEY `idpembelian` (`idbarangmasuk`,`idbarang`),
  KEY `idproduk` (`idbarang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `barangmasuk_detail` */

insert  into `barangmasuk_detail`(`idbarangmasuk`,`idbarang`,`qty`,`harga`,`totalharga`) values ('2408120001','BRG-000003',10,120000,1200000),('2408120002','BRG-000004',2,22000,44000),('2408120002','BRG-000003',10,120000,1200000);

/*Table structure for table `desa` */

DROP TABLE IF EXISTS `desa`;

CREATE TABLE `desa` (
  `iddesa` char(10) NOT NULL,
  `idkecamatan` char(10) DEFAULT NULL,
  `namadesa` varchar(50) DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') DEFAULT NULL,
  PRIMARY KEY (`iddesa`),
  KEY `idkecamatan` (`idkecamatan`),
  CONSTRAINT `desa_ibfk_1` FOREIGN KEY (`idkecamatan`) REFERENCES `kecamatan` (`idkecamatan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `desa` */

insert  into `desa`(`iddesa`,`idkecamatan`,`namadesa`,`statusaktif`) values ('DES-000004','KEC-000004','Dema','Aktif'),('DES-000005','KEC-000004','Pak Bulu','Aktif'),('DES-000006','KEC-000004','Anjungan dalam','Aktif'),('DES-000007','KEC-000004','Kepayang','Aktif'),('DES-000008','KEC-000002','Simpang Kasturi','Aktif'),('DES-000009','KEC-000002','Sebadu','Aktif'),('DES-000010','KEC-000002','Kayu Tanam','Aktif'),('DES-000011','KEC-000002','Salatiga','Aktif'),('DES-000012','KEC-000001','Pak laheng','Aktif'),('DES-000013','KEC-000001','Kecurit','Aktif'),('DES-000014','KEC-000001','Terap','Aktif'),('DES-000015','KEC-000001','Sepang','Aktif');

/*Table structure for table `ekspedisi` */

DROP TABLE IF EXISTS `ekspedisi`;

CREATE TABLE `ekspedisi` (
  `idekspedisi` char(10) NOT NULL,
  `namaekspedisi` varchar(50) DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  `link` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') DEFAULT NULL,
  PRIMARY KEY (`idekspedisi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `ekspedisi` */

insert  into `ekspedisi`(`idekspedisi`,`namaekspedisi`,`keterangan`,`link`,`foto`,`statusaktif`) values ('EKS-000001','JNT','Ekspedisi JNT','www.jnt.com','Logo_JT_Merah_Square.jpg','Aktif');

/*Table structure for table `jadwal` */

DROP TABLE IF EXISTS `jadwal`;

CREATE TABLE `jadwal` (
  `idjadwal` char(10) NOT NULL,
  `namajadwal` varchar(50) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat') DEFAULT NULL,
  `jamawal` varchar(20) DEFAULT NULL,
  `jamakhir` varchar(20) DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') DEFAULT NULL,
  `idpengguna` char(10) DEFAULT NULL,
  `kuota` int(11) DEFAULT NULL,
  PRIMARY KEY (`idjadwal`),
  KEY `idpengguna` (`idpengguna`),
  CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `jadwal` */

insert  into `jadwal`(`idjadwal`,`namajadwal`,`keterangan`,`hari`,`jamawal`,`jamakhir`,`statusaktif`,`idpengguna`,`kuota`) values ('JWD-000001','Hari Senin','-','Senin','08:00','09:00','Aktif','PGN-000001',5),('JWD-000002','Hari Senin','-','Senin','09:00','10:00','Aktif','PGN-000001',5),('JWD-000003','Hari Senin','-','Senin','10:00','11:00','Aktif','PGN-000001',5),('JWD-000004','Hari Senin','-','Senin','13:00','14:00','Aktif','PGN-000001',5),('JWD-000005','Hari Senin','-','Senin','14:00','15:00','Aktif','PGN-000001',5),('JWD-000006','Hari Selasa','-','Selasa','08:00','09:00','Aktif','PGN-000001',5),('JWD-000007','Hari Selasa','-','Selasa','09:00','10:00','Aktif','PGN-000001',5),('JWD-000008','Hari Selasa','-','Selasa','10:00','11:00','Aktif','PGN-000001',5),('JWD-000009','Hari Selasa','-','Selasa','13:00','14:00','Aktif','PGN-000001',5),('JWD-000010','Hari Selasa','-','Selasa','14:00','15:00','Aktif','PGN-000001',5),('JWD-000011','Hari Rabu','-','Rabu','08:00','09:00','Aktif','PGN-000001',5),('JWD-000012','Hari Rabu','-','Rabu','09:00','10:00','Aktif','PGN-000001',5),('JWD-000013','Hari Rabu','-','Rabu','10:00','11:00','Aktif','PGN-000001',5),('JWD-000014','Hari Rabu','-','Rabu','13:00','14:00','Aktif','PGN-000001',5),('JWD-000015','Hari Rabu','-','Rabu','14:00','15:00','Aktif','PGN-000001',5),('JWD-000016','Hari Kamis','-','Kamis','08:00','09:00','Aktif','PGN-000001',5),('JWD-000017','Hari kamis','-','Kamis','09:00','10:00','Aktif','PGN-000001',5),('JWD-000018','Hari Kamis','-','Kamis','10:00','11:00','Aktif','PGN-000001',5),('JWD-000019','Hari Kamis','-','Kamis','13:00','14:00','Aktif','PGN-000001',5),('JWD-000020','Hari Kamis','-','Kamis','14:00','15:00','Aktif','PGN-000001',5),('JWD-000021','Hari Jumat','-','Jumat','08:00','09:00','Aktif','PGN-000001',5),('JWD-000022','Hari Jumat','-','Jumat','09:00','10:00','Aktif','PGN-000001',5),('JWD-000023','Hari Jumat','-','Jumat','10:00','11:00','Aktif','PGN-000001',5),('JWD-000024','Hari Jumat','-','Jumat','13:00','14:00','Aktif','PGN-000001',5),('JWD-000025','Hari Jumat','-','Jumat','14:00','15:00','Aktif','PGN-000001',5);

/*Table structure for table `jadwalboking` */

DROP TABLE IF EXISTS `jadwalboking`;

CREATE TABLE `jadwalboking` (
  `idjadwalboking` char(10) NOT NULL,
  `tgljadwalboking` date DEFAULT NULL,
  `idjadwal` char(10) DEFAULT NULL,
  `idpelanggan` char(10) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status` enum('Menunggu','Sudah Selesai','Ditolak') DEFAULT NULL,
  PRIMARY KEY (`idjadwalboking`),
  KEY `idjadwal` (`idjadwal`),
  KEY `idpelanggan` (`idpelanggan`),
  CONSTRAINT `jadwalboking_ibfk_1` FOREIGN KEY (`idjadwal`) REFERENCES `jadwal` (`idjadwal`),
  CONSTRAINT `jadwalboking_ibfk_2` FOREIGN KEY (`idpelanggan`) REFERENCES `pelanggan` (`idpelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `jadwalboking` */

/*Table structure for table `jenis` */

DROP TABLE IF EXISTS `jenis`;

CREATE TABLE `jenis` (
  `idjenis` char(10) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idjenis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `jenis` */

insert  into `jenis`(`idjenis`,`nama`,`keterangan`) values ('JNS-000001','Kopi','-'),('JNS-000002','Susu','-');

/*Table structure for table `kabupaten` */

DROP TABLE IF EXISTS `kabupaten`;

CREATE TABLE `kabupaten` (
  `idkabupaten` char(10) NOT NULL,
  `namakabupaten` varchar(50) DEFAULT NULL,
  `tarifkabupaten` decimal(18,0) DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') DEFAULT NULL,
  PRIMARY KEY (`idkabupaten`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `kabupaten` */

insert  into `kabupaten`(`idkabupaten`,`namakabupaten`,`tarifkabupaten`,`statusaktif`) values ('KAB-000001','MEMPAWAH',25000,'Aktif'),('KAB-000002','SINGKAWANG',40000,'Aktif'),('KAB-000003','LANDAK',40000,'Aktif');

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `idkategori` char(10) NOT NULL,
  `namakategori` varchar(50) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') DEFAULT NULL,
  `urisegment` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idkategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `kategori` */

insert  into `kategori`(`idkategori`,`namakategori`,`keterangan`,`foto`,`statusaktif`,`urisegment`) values ('KTG-000002','MINUMAN','-','minuman.jpg','Aktif','minuman'),('KTG-000003','MAKANAN','-','makanan.jpg','Aktif','makanan'),('KTG-000004','BAHAN BAKU','-','','Aktif','bahan-baku');

/*Table structure for table `kecamatan` */

DROP TABLE IF EXISTS `kecamatan`;

CREATE TABLE `kecamatan` (
  `idkecamatan` char(10) NOT NULL,
  `idkabupaten` char(10) DEFAULT NULL,
  `namakecamatan` varchar(50) DEFAULT NULL,
  `tarifkecamatan` decimal(18,0) DEFAULT NULL,
  `totaltarif` decimal(18,0) DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') DEFAULT NULL,
  PRIMARY KEY (`idkecamatan`),
  KEY `idkabupaten` (`idkabupaten`),
  CONSTRAINT `kecamatan_ibfk_1` FOREIGN KEY (`idkabupaten`) REFERENCES `kabupaten` (`idkabupaten`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `kecamatan` */

insert  into `kecamatan`(`idkecamatan`,`idkabupaten`,`namakecamatan`,`tarifkecamatan`,`totaltarif`,`statusaktif`) values ('KEC-000001','KAB-000001','toho',15000,40000,'Aktif'),('KEC-000002','KAB-000003','Mandor',15000,55000,'Aktif'),('KEC-000003','KAB-000002','singkawang barat',15000,55000,'Aktif'),('KEC-000004','KAB-000001','Anjongan',10000,35000,'Aktif');

/*Table structure for table `pelanggan` */

DROP TABLE IF EXISTS `pelanggan`;

CREATE TABLE `pelanggan` (
  `idpelanggan` char(10) NOT NULL,
  `namapelanggan` varchar(50) DEFAULT NULL,
  `notelp` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `negara` varchar(50) DEFAULT NULL,
  `provinsi` varchar(50) DEFAULT NULL,
  `kabupaten` varchar(50) DEFAULT NULL,
  `kecamatan` varchar(50) DEFAULT NULL,
  `kelurahan` varchar(50) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `kodepos` varchar(10) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') DEFAULT NULL,
  PRIMARY KEY (`idpelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pelanggan` */

insert  into `pelanggan`(`idpelanggan`,`namapelanggan`,`notelp`,`email`,`negara`,`provinsi`,`kabupaten`,`kecamatan`,`kelurahan`,`alamat`,`kodepos`,`username`,`password`,`foto`,`statusaktif`) values ('PLG-000001','Doni Setiawal','085654343214','doni@gmail.com','Indonesia','Kalimantan Barat','Kota Pontianak','Pontianak Timur','Dalam Bugis','Jalan Tanjung Raya 1','785645','doni','2da9cd653f63c010b6d6c5a5ad73fe32','downloadtest4.png','Aktif');

/*Table structure for table `pembayaran` */

DROP TABLE IF EXISTS `pembayaran`;

CREATE TABLE `pembayaran` (
  `idpembayaran` char(10) NOT NULL,
  `tglpembayaran` datetime DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `idpemesanan` char(10) DEFAULT NULL,
  `metodepembayaran` enum('COD','Via Bank','Tunai') DEFAULT NULL,
  `idbank` char(10) DEFAULT NULL,
  `fotobuktipembayaran` varchar(255) DEFAULT NULL,
  `jumlahpembayaran` decimal(18,0) DEFAULT NULL,
  `statuskonfirmasi` enum('Dikonfirmasi','Ditolak','Menunggu') DEFAULT NULL,
  `tglkonfirmasi` datetime DEFAULT NULL,
  `idkonfirmasi` char(10) DEFAULT NULL,
  PRIMARY KEY (`idpembayaran`),
  KEY `idpemesanan` (`idpemesanan`),
  CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`idpemesanan`) REFERENCES `pemesanan` (`idpemesanan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pembayaran` */

insert  into `pembayaran`(`idpembayaran`,`tglpembayaran`,`keterangan`,`idpemesanan`,`metodepembayaran`,`idbank`,`fotobuktipembayaran`,`jumlahpembayaran`,`statuskonfirmasi`,`tglkonfirmasi`,`idkonfirmasi`) values ('2408110001','2024-08-11 15:02:30','','2408110001','Via Bank','BNK-000002','downloadtest6.png',410000,'Dikonfirmasi','2024-08-11 15:04:19',NULL);

/*Table structure for table `pembelian` */

DROP TABLE IF EXISTS `pembelian`;

CREATE TABLE `pembelian` (
  `idpembelian` char(10) NOT NULL,
  `tglpembelian` date DEFAULT NULL,
  `nostruk` varchar(50) DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `idsupplier` char(10) DEFAULT NULL,
  `idpengguna` char(10) DEFAULT NULL,
  `tglinsert` datetime DEFAULT NULL,
  `tglupdate` datetime DEFAULT NULL,
  `idpengadaan` char(10) DEFAULT NULL,
  PRIMARY KEY (`idpembelian`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pembelian` */

insert  into `pembelian`(`idpembelian`,`tglpembelian`,`nostruk`,`keterangan`,`foto`,`idsupplier`,`idpengguna`,`tglinsert`,`tglupdate`,`idpengadaan`) values ('2408110001','2024-08-11','-','-','downloadtest7.png','SPL-000001','PGN-000003','2024-08-11 15:11:36','2024-08-11 15:11:36',NULL);

/*Table structure for table `pembelian_detil` */

DROP TABLE IF EXISTS `pembelian_detil`;

CREATE TABLE `pembelian_detil` (
  `idpembelian` char(10) DEFAULT NULL,
  `idproduk` char(10) DEFAULT NULL,
  `qty` decimal(18,0) DEFAULT NULL,
  `harga` decimal(18,0) DEFAULT NULL,
  `totalharga` decimal(18,0) DEFAULT NULL,
  UNIQUE KEY `idpembelian` (`idpembelian`,`idproduk`),
  KEY `idproduk` (`idproduk`),
  CONSTRAINT `pembelian_detil_ibfk_1` FOREIGN KEY (`idpembelian`) REFERENCES `pembelian` (`idpembelian`),
  CONSTRAINT `pembelian_detil_ibfk_2` FOREIGN KEY (`idproduk`) REFERENCES `produk` (`idproduk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pembelian_detil` */

insert  into `pembelian_detil`(`idpembelian`,`idproduk`,`qty`,`harga`,`totalharga`) values ('2408110001','PRD-000001',1,200000,200000);

/*Table structure for table `pemesanan` */

DROP TABLE IF EXISTS `pemesanan`;

CREATE TABLE `pemesanan` (
  `idpemesanan` char(10) NOT NULL,
  `tglpemesanan` datetime DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `idpelanggan` char(10) DEFAULT NULL,
  `negara` varchar(50) DEFAULT NULL,
  `provinsi` varchar(50) DEFAULT NULL,
  `kabupaten` varchar(50) DEFAULT NULL,
  `kecamatan` varchar(50) DEFAULT NULL,
  `kelurahan` varchar(50) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `kodepos` varchar(10) DEFAULT NULL,
  `totalpembayaran` decimal(18,0) DEFAULT NULL,
  `statuslunas` enum('Belum Lunas','Sudah Lunas') DEFAULT NULL,
  `idkonfirmasi` char(10) DEFAULT NULL,
  `tglkonfirmasi` datetime DEFAULT NULL,
  `statuskonfirmasi` enum('Dikonfirmasi','Ditolak','Menunggu') DEFAULT NULL,
  `informasipemesanan` varchar(255) DEFAULT NULL,
  `qrcode` char(14) DEFAULT NULL,
  `iddesa` char(10) DEFAULT NULL,
  `idekspedisi` char(10) DEFAULT NULL,
  `noresi` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idpemesanan`),
  KEY `idpelanggan` (`idpelanggan`),
  CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`idpelanggan`) REFERENCES `pelanggan` (`idpelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pemesanan` */

insert  into `pemesanan`(`idpemesanan`,`tglpemesanan`,`keterangan`,`idpelanggan`,`negara`,`provinsi`,`kabupaten`,`kecamatan`,`kelurahan`,`alamat`,`kodepos`,`totalpembayaran`,`statuslunas`,`idkonfirmasi`,`tglkonfirmasi`,`statuskonfirmasi`,`informasipemesanan`,`qrcode`,`iddesa`,`idekspedisi`,`noresi`) values ('2408110001','2024-08-11 15:02:30','-','PLG-000001','Indonesia','Kalimantan Barang','MEMPAWAH','toho','Kecurit','-','-',410000,'Sudah Lunas',NULL,'2024-08-11 15:04:19','Dikonfirmasi',NULL,'IVC-2408110001','DES-000013','EKS-000002',NULL);

/*Table structure for table `pemesanandetil` */

DROP TABLE IF EXISTS `pemesanandetil`;

CREATE TABLE `pemesanandetil` (
  `idpemesanan` char(10) DEFAULT NULL,
  `idproduk` char(10) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `hargamodal` decimal(18,0) DEFAULT NULL,
  `hargajual` decimal(18,0) DEFAULT NULL,
  `totalharga` decimal(18,0) DEFAULT NULL,
  UNIQUE KEY `idpemesanan` (`idpemesanan`,`idproduk`),
  KEY `idproduk` (`idproduk`),
  CONSTRAINT `pemesanandetil_ibfk_1` FOREIGN KEY (`idpemesanan`) REFERENCES `pemesanan` (`idpemesanan`),
  CONSTRAINT `pemesanandetil_ibfk_2` FOREIGN KEY (`idproduk`) REFERENCES `produk` (`idproduk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pemesanandetil` */

insert  into `pemesanandetil`(`idpemesanan`,`idproduk`,`qty`,`hargamodal`,`hargajual`,`totalharga`) values ('2408110001','PRD-000002',1,250000,370000,370000);

/*Table structure for table `pengadaan` */

DROP TABLE IF EXISTS `pengadaan`;

CREATE TABLE `pengadaan` (
  `idpengadaan` char(10) NOT NULL,
  `tglpengadaan` date DEFAULT NULL,
  `idsupplier` char(10) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `tglinsert` datetime DEFAULT NULL,
  `tglupdate` datetime DEFAULT NULL,
  `idpengguna` char(10) DEFAULT NULL,
  `statuskonfirmasi` enum('Dikonfirmasi','Ditolak','Menunggu') DEFAULT NULL,
  `tglkonfirmasi` datetime DEFAULT NULL,
  `idkonfirmasi` char(10) DEFAULT NULL,
  PRIMARY KEY (`idpengadaan`),
  KEY `idpengguna` (`idpengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pengadaan` */

/*Table structure for table `pengadaan_detil` */

DROP TABLE IF EXISTS `pengadaan_detil`;

CREATE TABLE `pengadaan_detil` (
  `idpengadaan` char(10) DEFAULT NULL,
  `idproduk` char(10) DEFAULT NULL,
  `qty` decimal(18,0) DEFAULT NULL,
  `harga` decimal(18,0) DEFAULT NULL,
  `totalharga` decimal(18,0) DEFAULT NULL,
  UNIQUE KEY `idpengadaan` (`idpengadaan`,`idproduk`),
  KEY `idproduk` (`idproduk`),
  CONSTRAINT `pengadaan_detil_ibfk_1` FOREIGN KEY (`idpengadaan`) REFERENCES `pengadaan` (`idpengadaan`),
  CONSTRAINT `pengadaan_detil_ibfk_2` FOREIGN KEY (`idproduk`) REFERENCES `produk` (`idproduk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pengadaan_detil` */

/*Table structure for table `pengguna` */

DROP TABLE IF EXISTS `pengguna`;

CREATE TABLE `pengguna` (
  `idpengguna` char(10) NOT NULL,
  `namapengguna` varchar(50) DEFAULT NULL,
  `notelp` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `level` enum('Manajer','Pelayan','Kasir','Koki','Gudang','Peracik') DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `statusaktif` enum('Aktif') DEFAULT NULL,
  PRIMARY KEY (`idpengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pengguna` */

insert  into `pengguna`(`idpengguna`,`namapengguna`,`notelp`,`email`,`alamat`,`username`,`password`,`level`,`foto`,`statusaktif`) values ('PGN-000001','Yanto M','0856543452435','yanto@gmail.com','Jalan Tanjung Raya','manajer','69b731ea8f289cf16a192ce78a37b4f0','Manajer','icon.jpg','Aktif'),('PGN-000002','Doni Setiawan','085654342334','doni@gmail.com','Jalan Tanjung Raya','pelayan','511cc40443f2a1ab03ab373b77d28091','Pelayan','icon1.jpg','Aktif'),('PGN-000003','Madan Saputra','0856534542324','madan@gmail.com','Jalan Tanjungh Rawat','gudang','202446dd1d6028084426867365b0c7a1','Gudang','icon2.jpg','Aktif'),('PGN-000004','Ari Susanto','08525400932','arisusanto@gmail.com','Jalan Tanjung Raya','kasir','c7911af3adbd12a035b289556d96470a','Kasir','icon3.jpg','Aktif'),('PGN-000005','David Kurniawan','085657788736','david@gmail.com','Jalan Tanjung Raya','koki','c38be0f1f87d0e77a0cd2fe6941253eb','Koki','icon4.jpg','Aktif'),('PGN-000006','Danos Kultus','086765636455','danos@gmail.com','Jalan Tanjung Raya','peracik','132ac2312f9250a1d152dd944ed3104a','Peracik','icon5.jpg','Aktif');

/*Table structure for table `penjualan` */

DROP TABLE IF EXISTS `penjualan`;

CREATE TABLE `penjualan` (
  `idpenjualan` char(10) NOT NULL,
  `tglpenjualan` datetime DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `diskon` decimal(18,0) DEFAULT NULL,
  `grandtotal` decimal(18,0) DEFAULT NULL,
  `tglinsert` datetime DEFAULT NULL,
  `tglupdate` datetime DEFAULT NULL,
  `idpengguna` char(10) DEFAULT NULL,
  `qrcode` char(14) DEFAULT NULL,
  `idjadwalboking` char(10) DEFAULT NULL,
  `idpelanggan` char(10) DEFAULT NULL,
  `carapembayaran` enum('Tunai','Non Tunai') DEFAULT NULL,
  `statuspemesanan` enum('Sedang Proses','Sudah Selesai') DEFAULT NULL,
  `statuspembayaran` enum('Belum Bayar','Sudah Bayar') DEFAULT NULL,
  `idkoki` char(10) DEFAULT NULL,
  `idkasir` char(10) DEFAULT NULL,
  PRIMARY KEY (`idpenjualan`),
  UNIQUE KEY `qrcode` (`qrcode`),
  KEY `idpengguna` (`idpengguna`),
  KEY `idpelanggan` (`idpelanggan`),
  CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`),
  CONSTRAINT `penjualan_ibfk_2` FOREIGN KEY (`idpelanggan`) REFERENCES `pelanggan` (`idpelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `penjualan` */

insert  into `penjualan`(`idpenjualan`,`tglpenjualan`,`keterangan`,`diskon`,`grandtotal`,`tglinsert`,`tglupdate`,`idpengguna`,`qrcode`,`idjadwalboking`,`idpelanggan`,`carapembayaran`,`statuspemesanan`,`statuspembayaran`,`idkoki`,`idkasir`) values ('2408110001','2024-08-11 22:30:29','Meja 2',0,125000,'2024-08-11 22:30:29','2024-08-11 22:30:29','PGN-000002','IVC-2408110001','',NULL,'Tunai','Sudah Selesai','Belum Bayar','PGN-000005',NULL),('2408110002','2024-08-11 23:25:05','Meja 5',0,50000,'2024-08-11 23:25:05','2024-08-11 23:25:05','PGN-000002','IVC-2408110002','',NULL,'Tunai','Sudah Selesai','Sudah Bayar','PGN-000005','PGN-000004'),('2408110003','2024-08-11 23:29:17','',0,25000,'2024-08-11 23:29:17','2024-08-11 23:29:17','PGN-000002','IVC-2408110003','',NULL,'Tunai','Sedang Proses','Sudah Bayar',NULL,'PGN-000004');

/*Table structure for table `penjualandetil` */

DROP TABLE IF EXISTS `penjualandetil`;

CREATE TABLE `penjualandetil` (
  `idpenjualan` char(10) DEFAULT NULL,
  `idproduk` char(10) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `hargamodal` decimal(18,0) DEFAULT NULL,
  `hargajual` decimal(18,0) DEFAULT NULL,
  `diskon` decimal(18,0) DEFAULT NULL,
  `totalharga` decimal(18,0) DEFAULT NULL,
  UNIQUE KEY `idpenjualan` (`idpenjualan`,`idproduk`),
  KEY `idproduk` (`idproduk`),
  CONSTRAINT `penjualandetil_ibfk_1` FOREIGN KEY (`idpenjualan`) REFERENCES `penjualan` (`idpenjualan`),
  CONSTRAINT `penjualandetil_ibfk_2` FOREIGN KEY (`idproduk`) REFERENCES `produk` (`idproduk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `penjualandetil` */

insert  into `penjualandetil`(`idpenjualan`,`idproduk`,`qty`,`hargamodal`,`hargajual`,`diskon`,`totalharga`) values ('2408110001','PRD-000001',5,23000,25000,0,125000),('2408110002','PRD-000001',2,23000,25000,0,50000),('2408110003','PRD-000001',1,23000,25000,0,25000);

/*Table structure for table `penjualandetilservice` */

DROP TABLE IF EXISTS `penjualandetilservice`;

CREATE TABLE `penjualandetilservice` (
  `idpenjualan` char(10) DEFAULT NULL,
  `idtarif` char(10) DEFAULT NULL,
  `harga` decimal(18,0) DEFAULT NULL,
  UNIQUE KEY `idpenjualan` (`idpenjualan`,`idtarif`),
  KEY `idtarif` (`idtarif`),
  CONSTRAINT `penjualandetilservice_ibfk_1` FOREIGN KEY (`idpenjualan`) REFERENCES `penjualan` (`idpenjualan`),
  CONSTRAINT `penjualandetilservice_ibfk_2` FOREIGN KEY (`idtarif`) REFERENCES `tarif` (`idtarif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `penjualandetilservice` */

/*Table structure for table `perencanaan` */

DROP TABLE IF EXISTS `perencanaan`;

CREATE TABLE `perencanaan` (
  `idperencanaan` char(10) NOT NULL,
  `tglperencanaan` date DEFAULT NULL,
  `jenis` enum('Promosi','Kerja Sama Dengan Distributor','Kerja Sama Denga Pelanggan') DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `tujuan` varchar(100) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `tglinsert` datetime DEFAULT NULL,
  `tglupdate` datetime DEFAULT NULL,
  `idpengguna` char(10) DEFAULT NULL,
  PRIMARY KEY (`idperencanaan`),
  KEY `idpengguna` (`idpengguna`),
  CONSTRAINT `perencanaan_ibfk_1` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `perencanaan` */

insert  into `perencanaan`(`idperencanaan`,`tglperencanaan`,`jenis`,`nama`,`tujuan`,`keterangan`,`foto`,`tglinsert`,`tglupdate`,`idpengguna`) values ('2306060001','2023-06-06','Promosi','Inovasi dan Kualitas :  Promosi Barang Bengkel untuk Meningkatkan Pengalaman Berkendara Anda','Promosi Barang Agar Lebih Dikenal Pelanggan','<p>Bengkel kami saat ini sedang mengadakan sebuah promosi menarik untuk semua pelanggan setia dan calon pelanggan. Kami menyediakan berbagai macam barang berkualitas tinggi yang dapat membantu memperbaiki dan meningkatkan kinerja kendaraan Anda.</p>\r\n\r\n<p>Promosi barang di bengkel kami meliputi:</p>\r\n\r\n<ol>\r\n	<li>\r\n	<p>Suku Cadang Berkualitas Tinggi: Kami menawarkan beragam suku cadang asli dan suku cadang pengganti berkualitas tinggi untuk kendaraan Anda. Suku cadang yang kami sediakan meliputi komponen mesin, sistem kelistrikan, sistem rem, sistem suspensi, dan masih banyak lagi. Semua suku cadang yang kami tawarkan dipilih dengan teliti untuk memastikan keandalan dan kinerja terbaik bagi kendaraan Anda.</p>\r\n	</li>\r\n	<li>\r\n	<p>Oli dan Cairan Kendaraan: Kami menyediakan berbagai macam oli mesin, oli rem, cairan pendingin, dan cairan lainnya yang penting untuk menjaga performa dan keandalan kendaraan Anda. Oli yang kami tawarkan bermerek terkenal dan dirancang khusus untuk memberikan perlindungan optimal dan meningkatkan efisiensi kendaraan Anda.</p>\r\n	</li>\r\n	<li>\r\n	<p>Aksesoris Kendaraan: Selain suku cadang, kami juga menyediakan berbagai aksesoris untuk kendaraan Anda. Ini termasuk karpet lantai, wiper, cover jok, kaca film, dan masih banyak lagi. Aksesoris ini tidak hanya memberikan kenyamanan tambahan, tetapi juga meningkatkan penampilan kendaraan Anda.</p>\r\n	</li>\r\n	<li>\r\n	<p>Ban dan Velg: Kami menawarkan berbagai pilihan ban mobil dan velg berkualitas tinggi yang sesuai dengan kebutuhan dan gaya Anda. Dengan ban yang tepat, Anda dapat meningkatkan traksi, kestabilan, dan keselamatan saat berkendara. Velg yang kami tawarkan juga hadir dalam berbagai desain dan ukuran untuk menambahkan sentuhan personal pada kendaraan Anda.</p>\r\n	</li>\r\n</ol>\r\n\r\n<p>Kami sangat memahami betapa pentingnya menjaga kendaraan Anda dalam kondisi terbaik. Oleh karena itu, promosi barang di bengkel kami ini dirancang untuk memberikan Anda kesempatan untuk memperoleh produk berkualitas tinggi dengan harga yang kompetitif. Kunjungi bengkel kami sekarang untuk memanfaatkan promosi ini dan dapatkan barang-barang terbaik untuk kendaraan Anda.</p>\r\n','pengertian_promosi.jpg','2023-06-06 22:03:07','2023-06-06 22:03:07','PGN-000002');

/*Table structure for table `perencanaansurat` */

DROP TABLE IF EXISTS `perencanaansurat`;

CREATE TABLE `perencanaansurat` (
  `idperencanaansurat` char(10) NOT NULL,
  `idperencanaan` char(10) DEFAULT NULL,
  `tglperencanaansurat` date DEFAULT NULL,
  `namaperusahaan` varchar(100) DEFAULT NULL,
  `perihal` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `kodepos` varchar(10) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `tglinsert` datetime DEFAULT NULL,
  `tglupdate` datetime DEFAULT NULL,
  `idpengguna` char(10) DEFAULT NULL,
  PRIMARY KEY (`idperencanaansurat`),
  KEY `idpengguna` (`idpengguna`),
  KEY `idperencanaan` (`idperencanaan`),
  CONSTRAINT `perencanaansurat_ibfk_1` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`),
  CONSTRAINT `perencanaansurat_ibfk_2` FOREIGN KEY (`idperencanaan`) REFERENCES `perencanaan` (`idperencanaan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `perencanaansurat` */

insert  into `perencanaansurat`(`idperencanaansurat`,`idperencanaan`,`tglperencanaansurat`,`namaperusahaan`,`perihal`,`alamat`,`kota`,`kodepos`,`keterangan`,`tglinsert`,`tglupdate`,`idpengguna`) values ('2306070001','2306060001','2023-06-07','PT. MITRA TECH KALINGGAN','Penawaran Poduk','Jalan Ahmad Yani 2','Pontianak','675326','<p>Kepada Yth.,</p>\r\n\r\n<p>Bapak/Ibu [Nama Penerima Surat],</p>\r\n\r\n<p>Kami dari [Nama Perusahaan Anda] ingin mengucapkan salam hangat dan mengucapkan terima kasih atas minat dan kepercayaan Anda terhadap produk dan layanan kami.</p>\r\n\r\n<p>Melalui surat ini, kami dengan senang hati ingin menawarkan produk-produk berkualitas yang kami sediakan kepada PT. KALINGGA MITRA TECH. Sebagai perusahaan yang berdedikasi dalam menyediakan solusi teknologi terkini, kami yakin bahwa produk kami dapat memberikan manfaat dan kontribusi yang berarti bagi PT. KALINGGA MITRA TECH.</p>\r\n\r\n<p>Berikut adalah gambaran singkat tentang produk-produk yang kami tawarkan:</p>\r\n\r\n<ol>\r\n	<li>\r\n	<p>[Nama Produk 1]:</p>\r\n\r\n	<ul>\r\n		<li>Deskripsi: [Jelaskan produk secara singkat dan tampilkan keunggulannya]</li>\r\n		<li>Harga: [Tuliskan harga produk dan syarat pembayaran yang berlaku]</li>\r\n	</ul>\r\n	</li>\r\n</ol>\r\n\r\n<p>Kami juga menyediakan layanan purna jual yang komprehensif, termasuk dukungan teknis dan pemeliharaan produk. Tim kami yang berpengalaman akan selalu siap membantu PT. KALINGGA MITRA TECH dalam segala hal terkait produk kami.</p>\r\n\r\n<p>Kami ingin menekankan bahwa kami selalu berkomitmen untuk memberikan kualitas terbaik kepada pelanggan kami. Produk-produk kami telah melewati uji kualitas yang ketat untuk memastikan keandalan dan kepuasan pelanggan.</p>\r\n\r\n<p>Kami mengundang PT. KALINGGA MITRA TECH untuk melakukan diskusi lebih lanjut mengenai produk-produk kami. Kami sangat berharap dapat menjadi mitra yang berharga bagi PT. KALINGGA MITRA TECH dalam menjalankan operasional bisnis yang lebih efisien dan sukses.</p>\r\n\r\n<p>Mohon untuk memberikan tanggapan Anda terkait penawaran ini. Jika Bapak/Ibu memiliki pertanyaan atau membutuhkan informasi tambahan, jangan ragu untuk menghubungi kami di [nomor telepon] atau melalui email kami di [alamat email].</p>\r\n\r\n<p>Terima kasih atas perhatian Bapak/Ibu dan kami berharap dapat menjalin kerjasama yang baik dan saling menguntungkan.</p>\r\n','2023-06-07 15:19:51','2023-06-07 15:43:30','PGN-000002');

/*Table structure for table `produk` */

DROP TABLE IF EXISTS `produk`;

CREATE TABLE `produk` (
  `idproduk` char(10) NOT NULL,
  `idkategori` char(10) DEFAULT NULL,
  `namaproduk` varchar(50) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `stok` decimal(18,0) DEFAULT NULL,
  `stokminimum` decimal(18,0) DEFAULT NULL,
  `hargabeli` decimal(18,0) DEFAULT NULL,
  `hargajual` decimal(18,0) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') DEFAULT NULL,
  `qrcode` char(20) DEFAULT NULL,
  `urisegment` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idproduk`),
  UNIQUE KEY `qrcode` (`qrcode`),
  KEY `idkategori` (`idkategori`),
  CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`idkategori`) REFERENCES `kategori` (`idkategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `produk` */

insert  into `produk`(`idproduk`,`idkategori`,`namaproduk`,`keterangan`,`satuan`,`stok`,`stokminimum`,`hargabeli`,`hargajual`,`foto`,`statusaktif`,`qrcode`,`urisegment`) values ('PRD-000001','KTG-000002','Coffee Latte','<p>Coffee latte, atau sering disebut hanya &quot;latte,&quot; adalah minuman kopi yang terdiri dari espresso dan susu panas yang telah dikukus. Biasanya, latte dibuat dengan satu atau lebih shot espresso yang dicampur dengan susu panas dan sedikit busa susu di atasnya. Rasanya lebih lembut dibandingkan dengan kopi hitam atau cappuccino karena perbandingan susu yang lebih banyak.</p>\r\n\r\n<p>Latte bisa disajikan dalam berbagai varian rasa dengan tambahan sirup atau rempah-rempah, seperti vanila, caramel, atau hazelnut. Latte juga sering dihias dengan latte art, yaitu gambar atau pola yang dibuat di permukaan busa susu dengan menggunakan teknik tertentu.</p>\r\n','Cup',33,10,23000,25000,'minuman_weng.png','Aktif','KTG-000003PRD-000001','coffee-latte'),('PRD-000002','KTG-000003','Snack','<p>Snack adalah makanan ringan yang biasanya dikonsumsi di antara waktu makan utama. Snack bisa bervariasi dari yang sehat hingga yang lebih manis atau gurih. Beberapa contoh snack yang populer meliputi:</p>\r\n\r\n<ol>\r\n	<li><strong>Buah-buahan</strong>: Seperti apel, pisang, atau buah beri.</li>\r\n	<li><strong>Kacang-kacangan</strong>: Seperti almond, kenari, atau kacang tanah.</li>\r\n	<li><strong>Keripik dan Pretzel</strong>: Seperti keripik kentang, pretzel, atau keripik tortilla.</li>\r\n	<li><strong>Yogurt</strong>: Dengan atau tanpa tambahan buah atau granola.</li>\r\n	<li><strong>Biskuit dan Kue</strong>: Seperti biskuit gandum atau cookies.</li>\r\n	<li><strong>Sayuran</strong>: Seperti wortel atau seledri yang bisa dicelupkan dalam hummus.</li>\r\n	<li><strong>Keju</strong>: Seperti potongan keju cheddar atau mozzarella.</li>\r\n</ol>\r\n\r\n<p>Snack bisa disesuaikan dengan selera dan kebutuhan diet masing-masing orang, dan sering kali menjadi cara yang praktis untuk mengisi waktu atau menambah energi antara makan besar.</p>\r\n','porsi',29,10,25000,30000,'makanan_weng.jpg','Aktif','KTG-000003PRD-000002','snack');

/*Table structure for table `profil` */

DROP TABLE IF EXISTS `profil`;

CREATE TABLE `profil` (
  `id` int(1) NOT NULL,
  `namaperusahaan` varchar(50) DEFAULT NULL,
  `tentangkami` text DEFAULT NULL,
  `logoperusahaan` varchar(255) DEFAULT NULL,
  `fotoperusahaan` varchar(255) DEFAULT NULL,
  `tglupdate` datetime DEFAULT NULL,
  `idpengguna` char(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idpengguna` (`idpengguna`),
  CONSTRAINT `profil_ibfk_1` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `profil` */

insert  into `profil`(`id`,`namaperusahaan`,`tentangkami`,`logoperusahaan`,`fotoperusahaan`,`tglupdate`,`idpengguna`) values (1,'WENG COFFEE','<p>Weng Coffee adalah sebuah perusahaan kopi yang berbasis di Indonesia. Mereka dikenal karena mengolah kopi dengan standar kualitas tinggi dan mengutamakan keberlanjutan. Produk mereka sering kali melibatkan metode pemrosesan kopi yang inovatif untuk menghasilkan cita rasa yang khas.</p>\r\n','wengcoffee.jpg','wengcoffee1.jpg','2024-08-11 20:49:15','PGN-000003');

/*Table structure for table `profil_blog` */

DROP TABLE IF EXISTS `profil_blog`;

CREATE TABLE `profil_blog` (
  `idblog` char(10) NOT NULL,
  `tglblog` datetime DEFAULT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `konten` text DEFAULT NULL,
  `urlblog` varchar(255) DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') DEFAULT NULL,
  `tglinsert` datetime DEFAULT NULL,
  `tglupdate` datetime DEFAULT NULL,
  `idpengguna` char(10) DEFAULT NULL,
  `urisegment` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idblog`),
  KEY `idpengguna` (`idpengguna`),
  CONSTRAINT `profil_blog_ibfk_1` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `profil_blog` */

/*Table structure for table `profil_galeri` */

DROP TABLE IF EXISTS `profil_galeri`;

CREATE TABLE `profil_galeri` (
  `idgaleri` char(10) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `tglinsert` datetime DEFAULT NULL,
  `tglupdate` datetime DEFAULT NULL,
  `idpengguna` char(10) DEFAULT NULL,
  PRIMARY KEY (`idgaleri`),
  KEY `idpengguna` (`idpengguna`),
  CONSTRAINT `profil_galeri_ibfk_1` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `profil_galeri` */

insert  into `profil_galeri`(`idgaleri`,`foto`,`keterangan`,`tglinsert`,`tglupdate`,`idpengguna`) values ('2206270001','wengcoffee3.jpg','WENG COFFEE','2022-06-27 14:12:52','2024-08-11 20:51:27','PGN-000003');

/*Table structure for table `profil_kontakkami` */

DROP TABLE IF EXISTS `profil_kontakkami`;

CREATE TABLE `profil_kontakkami` (
  `id` int(1) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `notelp` varchar(20) DEFAULT NULL,
  `nowa` varchar(20) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `iframegoogle` text DEFAULT NULL,
  `tglupdate` datetime DEFAULT NULL,
  `idpengguna` char(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idpengguna` (`idpengguna`),
  CONSTRAINT `profil_kontakkami_ibfk_1` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `profil_kontakkami` */

insert  into `profil_kontakkami`(`id`,`email`,`notelp`,`nowa`,`alamat`,`iframegoogle`,`tglupdate`,`idpengguna`) values (1,'wengcoffee@gmail.com','0561 8181867','0561 8181867',' Jl. Reformasi, Bansir Darat, Kec. Pontianak Tenggara, Kota Pontianak, Kalimantan Barat\r\nKalimantan Barat','<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.8158878324884!2d109.3350808758215!3d-0.06326863551400197!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e1d59e7f764bdcf%3A0xe6368e6ed921b256!2sWeng%20Coffee%20Reformasi!5e0!3m2!1sen!2sid!4v1723384230653!5m2!1sen!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>','2024-08-11 20:50:39','PGN-000003');

/*Table structure for table `profil_layanan` */

DROP TABLE IF EXISTS `profil_layanan`;

CREATE TABLE `profil_layanan` (
  `idlayanan` char(10) NOT NULL,
  `judullayanan` varchar(50) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `icon` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') DEFAULT NULL,
  `tglinsert` datetime DEFAULT NULL,
  `tglupdate` datetime DEFAULT NULL,
  `idpengguna` char(10) DEFAULT NULL,
  PRIMARY KEY (`idlayanan`),
  KEY `idpengguna` (`idpengguna`),
  CONSTRAINT `profil_layanan_ibfk_1` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `profil_layanan` */

/*Table structure for table `profil_slider` */

DROP TABLE IF EXISTS `profil_slider`;

CREATE TABLE `profil_slider` (
  `idslider` char(10) NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') DEFAULT NULL,
  `tglinsert` datetime DEFAULT NULL,
  `tglupdate` datetime DEFAULT NULL,
  `idpengguna` char(10) DEFAULT NULL,
  PRIMARY KEY (`idslider`),
  KEY `idpengguna` (`idpengguna`),
  CONSTRAINT `profil_slider_ibfk_1` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `profil_slider` */

insert  into `profil_slider`(`idslider`,`judul`,`keterangan`,`foto`,`url`,`statusaktif`,`tglinsert`,`tglupdate`,`idpengguna`) values ('2206270001','WENG COFFEE',' Jl. Reformasi, Bansir Darat, Kec. Pontianak Tenggara, Kota Pontianak, Kalimantan Barat','wengcoffee2.jpg','','Aktif','2024-08-11 20:51:04','2024-08-11 20:51:04','PGN-000003');

/*Table structure for table `profil_sosialmedia` */

DROP TABLE IF EXISTS `profil_sosialmedia`;

CREATE TABLE `profil_sosialmedia` (
  `idsosialmedia` char(10) NOT NULL,
  `nama_sosialmedia` varchar(50) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `tglinsert` datetime DEFAULT NULL,
  `tglupdate` datetime DEFAULT NULL,
  `idpengguna` char(10) DEFAULT NULL,
  PRIMARY KEY (`idsosialmedia`),
  KEY `idpengguna` (`idpengguna`),
  CONSTRAINT `profil_sosialmedia_ibfk_1` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `profil_sosialmedia` */

insert  into `profil_sosialmedia`(`idsosialmedia`,`nama_sosialmedia`,`foto`,`url`,`tglinsert`,`tglupdate`,`idpengguna`) values ('SMD-000001','Instagram','580b57fcd9996e24bc43c521.png','https://www.instagram.com','2022-06-27 14:11:41','2022-06-27 14:11:41','PGN-000001'),('SMD-000002','Facebook','800px-Facebook_logo_(square).png','https://www.facebook.com/','2022-06-27 14:12:14','2022-06-27 14:12:14','PGN-000001');

/*Table structure for table `profil_testimoni` */

DROP TABLE IF EXISTS `profil_testimoni`;

CREATE TABLE `profil_testimoni` (
  `idtestimoni` char(10) NOT NULL,
  `tgltestimoni` date DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `tglinsert` datetime DEFAULT NULL,
  `tglupdate` datetime DEFAULT NULL,
  `idpengguna` char(10) DEFAULT NULL,
  PRIMARY KEY (`idtestimoni`),
  KEY `idpengguna` (`idpengguna`),
  CONSTRAINT `profil_testimoni_ibfk_1` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `profil_testimoni` */

/*Table structure for table `profil_video` */

DROP TABLE IF EXISTS `profil_video`;

CREATE TABLE `profil_video` (
  `idvideo` char(10) NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `urisegment` varchar(100) DEFAULT NULL,
  `tglinsert` datetime DEFAULT NULL,
  `tglupdate` datetime DEFAULT NULL,
  `idpengguna` char(10) DEFAULT NULL,
  PRIMARY KEY (`idvideo`),
  KEY `idpengguna` (`idpengguna`),
  CONSTRAINT `profil_video_ibfk_1` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `profil_video` */

/*Table structure for table `returpenjualan` */

DROP TABLE IF EXISTS `returpenjualan`;

CREATE TABLE `returpenjualan` (
  `idreturpenjualan` char(10) NOT NULL,
  `tglreturpenjualan` datetime DEFAULT NULL,
  `idpenjualan` char(10) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `tglinsert` datetime DEFAULT NULL,
  `tglupdate` datetime DEFAULT NULL,
  `idpengguna` char(10) DEFAULT NULL,
  PRIMARY KEY (`idreturpenjualan`),
  KEY `idpenjualan` (`idpenjualan`),
  KEY `idpengguna` (`idpengguna`),
  CONSTRAINT `returpenjualan_ibfk_1` FOREIGN KEY (`idpenjualan`) REFERENCES `penjualan` (`idpenjualan`),
  CONSTRAINT `returpenjualan_ibfk_2` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `returpenjualan` */

/*Table structure for table `returpenjualan_detil` */

DROP TABLE IF EXISTS `returpenjualan_detil`;

CREATE TABLE `returpenjualan_detil` (
  `idreturpenjualan` char(10) DEFAULT NULL,
  `idproduk` char(10) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga` decimal(18,0) DEFAULT NULL,
  `totalharga` decimal(18,0) DEFAULT NULL,
  UNIQUE KEY `idreturpenjualan` (`idreturpenjualan`,`idproduk`),
  KEY `idproduk` (`idproduk`),
  CONSTRAINT `returpenjualan_detil_ibfk_1` FOREIGN KEY (`idreturpenjualan`) REFERENCES `returpenjualan` (`idreturpenjualan`),
  CONSTRAINT `returpenjualan_detil_ibfk_2` FOREIGN KEY (`idproduk`) REFERENCES `produk` (`idproduk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `returpenjualan_detil` */

/*Table structure for table `supplier` */

DROP TABLE IF EXISTS `supplier`;

CREATE TABLE `supplier` (
  `idsupplier` char(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `namasupplier` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `notelp` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`idsupplier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `supplier` */

insert  into `supplier`(`idsupplier`,`namasupplier`,`notelp`,`email`,`alamat`,`foto`,`statusaktif`) values ('SPL-000001','PT. Merak','0825144536244','ptmerak@gmail.com','Jalan Merak','','Aktif');

/*Table structure for table `tarif` */

DROP TABLE IF EXISTS `tarif`;

CREATE TABLE `tarif` (
  `idtarif` char(10) NOT NULL,
  `namatarif` varchar(50) DEFAULT NULL,
  `tarif` decimal(18,0) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') DEFAULT NULL,
  PRIMARY KEY (`idtarif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tarif` */

insert  into `tarif`(`idtarif`,`namatarif`,`tarif`,`keterangan`,`statusaktif`) values ('TRF-000001','Service Motor',20000,'Service motor merujuk pada serangkaian tindakan perawatan dan perbaikan yang dilakukan pada sepeda motor. Ini termasuk berbagai jenis pelayanan yang dirancang untuk memastikan sepeda motor beroperasi dengan optimal, memperpanjang umur pakai, dan menjaga keamanan serta kinerja sepeda motor.\r\n\r\nService motor biasanya dilakukan oleh mekanik terlatih di bengkel atau pusat layanan resmi sepeda motor','Aktif'),('TRF-000002','Servis Bongkar Mesin',70000,'Servis bongkar mesin pada motor merujuk pada tindakan perawatan atau perbaikan yang melibatkan pembongkaran mesin sepeda motor untuk melakukan pemeriksaan, perawatan, atau perbaikan mendalam pada komponen-komponen mesin. Servis ini biasanya dilakukan ketika terdapat masalah serius pada mesin yang tidak dapat diatasi dengan servis biasa atau jika memerlukan penggantian atau perbaikan komponen yang terletak di dalam mesin.','Aktif');

/* Trigger structure for table `pembayaran` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `pembayaran_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `pembayaran_insert` AFTER INSERT ON `pembayaran` FOR EACH ROW BEGIN
	CALL sp_pembayaran(new.idpemesanan, new.idkonfirmasi);
    END */$$


DELIMITER ;

/* Trigger structure for table `pembayaran` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `pembayaran_update` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `pembayaran_update` AFTER UPDATE ON `pembayaran` FOR EACH ROW BEGIN
	CALL sp_pembayaran(new.idpemesanan, new.idkonfirmasi);
    END */$$


DELIMITER ;

/* Trigger structure for table `pembayaran` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `pembayaran_delete` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `pembayaran_delete` AFTER DELETE ON `pembayaran` FOR EACH ROW BEGIN
	CALL sp_pembayaran(old.idpemesanan, old.idkonfirmasi);
    END */$$


DELIMITER ;

/* Trigger structure for table `pembelian` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `pembelian_delete` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `pembelian_delete` BEFORE DELETE ON `pembelian` FOR EACH ROW BEGIN
	DECLARE _idpengadaan CHAR(10) DEFAULT NULL;
	SET _idpengadaan = old.idpengadaan;
	
	if _idpengadaan IS NOT NULL THEN
		UPDATE pengadaan SET statuskonfirmasi='Ditolak' WHERE idpengadaan=_idpengadaan;
	END IF;
    END */$$


DELIMITER ;

/* Trigger structure for table `pembelian_detil` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `pembelian_detil_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `pembelian_detil_insert` AFTER INSERT ON `pembelian_detil` FOR EACH ROW BEGIN
	UPDATE produk SET produk.stok = produk.stok + new.qty WHERE produk.idproduk=new.idproduk;
    END */$$


DELIMITER ;

/* Trigger structure for table `pembelian_detil` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `pembelian_detil_delete` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `pembelian_detil_delete` BEFORE DELETE ON `pembelian_detil` FOR EACH ROW BEGIN
	UPDATE produk SET produk.stok = produk.stok - old.qty WHERE produk.idproduk=old.idproduk;
    END */$$


DELIMITER ;

/* Trigger structure for table `pemesanandetil` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `pemesanandetil_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `pemesanandetil_insert` AFTER INSERT ON `pemesanandetil` FOR EACH ROW BEGIN
	UPDATE produk SET produk.stok = produk.stok - new.qty WHERE produk.idproduk=new.idproduk;
    END */$$


DELIMITER ;

/* Trigger structure for table `pemesanandetil` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `pemesanandetil_delete` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `pemesanandetil_delete` BEFORE DELETE ON `pemesanandetil` FOR EACH ROW BEGIN
	UPDATE produk SET produk.stok = produk.stok + old.qty WHERE produk.idproduk=old.idproduk;
    END */$$


DELIMITER ;

/* Trigger structure for table `penjualandetil` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `penjualandetil_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `penjualandetil_insert` AFTER INSERT ON `penjualandetil` FOR EACH ROW BEGIN
	UPDATE produk SET produk.stok = produk.stok - new.qty WHERE produk.idproduk=new.idproduk;
    END */$$


DELIMITER ;

/* Trigger structure for table `penjualandetil` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `penjualandetil_update` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `penjualandetil_update` AFTER UPDATE ON `penjualandetil` FOR EACH ROW BEGIN
	UPDATE produk SET produk.stok = produk.stok + old.qty - new.qty WHERE produk.idproduk=new.idproduk;
    END */$$


DELIMITER ;

/* Trigger structure for table `penjualandetil` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `penjualandetil_delete` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `penjualandetil_delete` BEFORE DELETE ON `penjualandetil` FOR EACH ROW BEGIN
	UPDATE produk SET produk.stok = produk.stok + old.qty WHERE produk.idproduk=old.idproduk;
    END */$$


DELIMITER ;

/* Trigger structure for table `returpenjualan_detil` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `returpenjualan_detil_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `returpenjualan_detil_insert` AFTER INSERT ON `returpenjualan_detil` FOR EACH ROW BEGIN
	DECLARE _idpenjualan CHAR(10) DEFAULT NULL;
	SELECT returpenjualan.idpenjualan 
	FROM returpenjualan WHERE returpenjualan.idreturpenjualan=new.idreturpenjualan
	INTO _idpenjualan;
	
	UPDATE penjualandetil SET qty=qty-new.qty, totalharga=((qty-new.qty) * hargajual - diskon)  WHERE idpenjualan=_idpenjualan AND idproduk=new.idproduk;
	
    END */$$


DELIMITER ;

/* Trigger structure for table `returpenjualan_detil` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `returpenjualan_detil_delete` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `returpenjualan_detil_delete` BEFORE DELETE ON `returpenjualan_detil` FOR EACH ROW BEGIN
	DECLARE _idpenjualan CHAR(10) DEFAULT NULL;
	SELECT returpenjualan.idpenjualan 
	FROM returpenjualan WHERE returpenjualan.idreturpenjualan=old.idreturpenjualan
	INTO _idpenjualan;
	UPDATE penjualandetil SET qty=qty+old.qty, totalharga=((qty+old.qty) * hargajual - diskon) WHERE idpenjualan=_idpenjualan AND idproduk=old.idproduk;
	
    END */$$


DELIMITER ;

/* Function  structure for function  `f_idbank_create` */

/*!50003 DROP FUNCTION IF EXISTS `f_idbank_create` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `f_idbank_create`() RETURNS char(10) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
BEGIN
	
	DECLARE _cNosekarang VARCHAR(20);
	DECLARE _nNoSelanjutnya INT;
	DECLARE _kodeSekarang CHAR(7);
	
	
	SELECT MAX(RIGHT(idbank,6)) INTO _cNosekarang FROM bank;
	SET _cNosekarang = IF(ISNULL(_cNosekarang),0,_cNosekarang);
	SET _nNoSelanjutnya = CONVERT(_cNosekarang, INT) + 1;
	
	IF _nNoSelanjutnya > 0 AND _nNoSelanjutnya < 10 THEN
		SET _kodesekarang = CONCAT('-00000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 10 AND _nNoSelanjutnya < 100 THEN
		SET _kodesekarang = CONCAT('-0000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 100 AND _nNoSelanjutnya < 1000 THEN
		SET _kodesekarang = CONCAT('-000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 1000 AND _nNoSelanjutnya < 10000 THEN
		SET _kodesekarang = CONCAT('-00',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 10000 AND _nNoSelanjutnya < 100000 THEN
		SET _kodesekarang = CONCAT('-0',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 100000 AND _nNoSelanjutnya < 1000000 THEN
		SET _kodesekarang = CONCAT('-',_nNoSelanjutnya);
	END IF;
	
	
	RETURN CONCAT('BNK', _kodeSekarang);
    END */$$
DELIMITER ;

/* Function  structure for function  `f_idbarangkeluar_create` */

/*!50003 DROP FUNCTION IF EXISTS `f_idbarangkeluar_create` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `f_idbarangkeluar_create`(_tgl DATE) RETURNS char(10) CHARSET latin1 COLLATE latin1_swedish_ci
BEGIN
	DECLARE cNosekarang CHAR(4);
	DECLARE nlen INT;
	DECLARE nNoselanjutnya INT;
	DECLARE cNoselanjutnya CHAR(4);
	DECLARE jumlah_digit INT;
	DECLARE cTgl CHAR(6);
	
	SET jumlah_digit = '4';
	SET cTgl = DATE_FORMAT(_tgl, '%y%m%d');
	
	SELECT MAX(RIGHT(RTRIM(idbarangkeluar),jumlah_digit)) FROM barangkeluar WHERE DATE_FORMAT(tglinsert, '%Y-%m-%d') = _tgl  INTO cNosekarang;	
	SET cNosekarang = IF(ISNULL(cNosekarang),0,cNosekarang);
	
	SET nNoselanjutnya = CONVERT(cNosekarang,INT)+1;
	SET cNoselanjutnya = RTRIM(CONVERT(nNoselanjutnya,CHAR));
	SET nlen = LENGTH(cNoselanjutnya);
	
	WHILE nlen+1 <= jumlah_digit DO		
		SET cNoselanjutnya= CONCAT('0',cNoselanjutnya);
		SET nlen=nlen+1;
	END WHILE;	
	
	RETURN CONCAT(cTgl, cNoselanjutnya);
    END */$$
DELIMITER ;

/* Function  structure for function  `f_idbarangmasuk_create` */

/*!50003 DROP FUNCTION IF EXISTS `f_idbarangmasuk_create` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `f_idbarangmasuk_create`(_tgl DATE) RETURNS char(10) CHARSET latin1 COLLATE latin1_swedish_ci
BEGIN
	DECLARE cNosekarang CHAR(4);
	DECLARE nlen INT;
	DECLARE nNoselanjutnya INT;
	DECLARE cNoselanjutnya CHAR(4);
	DECLARE jumlah_digit INT;
	DECLARE cTgl CHAR(6);
	
	SET jumlah_digit = '4';
	SET cTgl = DATE_FORMAT(_tgl, '%y%m%d');
	
	SELECT MAX(RIGHT(RTRIM(idbarangmasuk),jumlah_digit)) FROM barangmasuk WHERE DATE_FORMAT(tglinsert, '%Y-%m-%d') = _tgl  INTO cNosekarang;	
	SET cNosekarang = IF(ISNULL(cNosekarang),0,cNosekarang);
	
	SET nNoselanjutnya = CONVERT(cNosekarang,INT)+1;
	SET cNoselanjutnya = RTRIM(CONVERT(nNoselanjutnya,CHAR));
	SET nlen = LENGTH(cNoselanjutnya);
	
	WHILE nlen+1 <= jumlah_digit DO		
		SET cNoselanjutnya= CONCAT('0',cNoselanjutnya);
		SET nlen=nlen+1;
	END WHILE;	
	
	RETURN CONCAT(cTgl, cNoselanjutnya);
    END */$$
DELIMITER ;

/* Function  structure for function  `f_idbarang_create` */

/*!50003 DROP FUNCTION IF EXISTS `f_idbarang_create` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `f_idbarang_create`() RETURNS char(10) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
BEGIN
	
	DECLARE _cNosekarang VARCHAR(20);
	DECLARE _nNoSelanjutnya INT;
	DECLARE _kodeSekarang CHAR(7);
	
	
	SELECT MAX(RIGHT(idbarang,6)) INTO _cNosekarang FROM barang;
	SET _cNosekarang = IF(ISNULL(_cNosekarang),0,_cNosekarang);
	SET _nNoSelanjutnya = CONVERT(_cNosekarang, INT) + 1;
	
	IF _nNoSelanjutnya > 0 AND _nNoSelanjutnya < 10 THEN
		SET _kodesekarang = CONCAT('-00000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 10 AND _nNoSelanjutnya < 100 THEN
		SET _kodesekarang = CONCAT('-0000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 100 AND _nNoSelanjutnya < 1000 THEN
		SET _kodesekarang = CONCAT('-000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 1000 AND _nNoSelanjutnya < 10000 THEN
		SET _kodesekarang = CONCAT('-00',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 10000 AND _nNoSelanjutnya < 100000 THEN
		SET _kodesekarang = CONCAT('-0',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 100000 AND _nNoSelanjutnya < 1000000 THEN
		SET _kodesekarang = CONCAT('-',_nNoSelanjutnya);
	END IF;
	
	
	RETURN CONCAT('BRG', _kodeSekarang);
    END */$$
DELIMITER ;

/* Function  structure for function  `f_idblog_create` */

/*!50003 DROP FUNCTION IF EXISTS `f_idblog_create` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `f_idblog_create`(`_tgl` DATE) RETURNS char(10) CHARSET latin1 COLLATE latin1_swedish_ci
BEGIN
	DECLARE cNosekarang CHAR(4);
	DECLARE nlen INT;
	DECLARE nNoselanjutnya INT;
	DECLARE cNoselanjutnya CHAR(4);
	DECLARE jumlah_digit INT;
	DECLARE cTgl CHAR(6);
	
	SET jumlah_digit = '4';
	SET cTgl = DATE_FORMAT(_tgl, '%y%m%d');
	
	SELECT MAX(RIGHT(RTRIM(idblog),jumlah_digit)) FROM profil_blog WHERE DATE_FORMAT(tglblog, '%Y-%m-%d') = _tgl  INTO cNosekarang;	
	SET cNosekarang = IF(ISNULL(cNosekarang),0,cNosekarang);
	
	SET nNoselanjutnya = CONVERT(cNosekarang,INT)+1;
	SET cNoselanjutnya = RTRIM(CONVERT(nNoselanjutnya,CHAR));
	SET nlen = LENGTH(cNoselanjutnya);
	
	WHILE nlen+1 <= jumlah_digit DO		
		SET cNoselanjutnya= CONCAT('0',cNoselanjutnya);
		SET nlen=nlen+1;
	END WHILE;	
	
	RETURN CONCAT(cTgl, cNoselanjutnya);
    END */$$
DELIMITER ;

/* Function  structure for function  `f_iddesa_create` */

/*!50003 DROP FUNCTION IF EXISTS `f_iddesa_create` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `f_iddesa_create`() RETURNS char(10) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
BEGIN
	
	DECLARE _cNosekarang VARCHAR(20);
	DECLARE _nNoSelanjutnya INT;
	DECLARE _kodeSekarang CHAR(7);
	
	
	SELECT MAX(RIGHT(iddesa,6)) INTO _cNosekarang FROM desa;
	SET _cNosekarang = IF(ISNULL(_cNosekarang),0,_cNosekarang);
	SET _nNoSelanjutnya = CONVERT(_cNosekarang, INT) + 1;
	
	IF _nNoSelanjutnya > 0 AND _nNoSelanjutnya < 10 THEN
		SET _kodesekarang = CONCAT('-00000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 10 AND _nNoSelanjutnya < 100 THEN
		SET _kodesekarang = CONCAT('-0000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 100 AND _nNoSelanjutnya < 1000 THEN
		SET _kodesekarang = CONCAT('-000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 1000 AND _nNoSelanjutnya < 10000 THEN
		SET _kodesekarang = CONCAT('-00',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 10000 AND _nNoSelanjutnya < 100000 THEN
		SET _kodesekarang = CONCAT('-0',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 100000 AND _nNoSelanjutnya < 1000000 THEN
		SET _kodesekarang = CONCAT('-',_nNoSelanjutnya);
	END IF;
	
	
	RETURN CONCAT('DES', _kodeSekarang);
    END */$$
DELIMITER ;

/* Function  structure for function  `f_idekspedisi_create` */

/*!50003 DROP FUNCTION IF EXISTS `f_idekspedisi_create` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `f_idekspedisi_create`() RETURNS char(10) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
BEGIN
	
	DECLARE _cNosekarang VARCHAR(20);
	DECLARE _nNoSelanjutnya INT;
	DECLARE _kodeSekarang CHAR(7);
	
	
	SELECT MAX(RIGHT(idekspedisi,6)) INTO _cNosekarang FROM ekspedisi;
	SET _cNosekarang = IF(ISNULL(_cNosekarang),0,_cNosekarang);
	SET _nNoSelanjutnya = CONVERT(_cNosekarang, INT) + 1;
	
	IF _nNoSelanjutnya > 0 AND _nNoSelanjutnya < 10 THEN
		SET _kodesekarang = CONCAT('-00000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 10 AND _nNoSelanjutnya < 100 THEN
		SET _kodesekarang = CONCAT('-0000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 100 AND _nNoSelanjutnya < 1000 THEN
		SET _kodesekarang = CONCAT('-000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 1000 AND _nNoSelanjutnya < 10000 THEN
		SET _kodesekarang = CONCAT('-00',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 10000 AND _nNoSelanjutnya < 100000 THEN
		SET _kodesekarang = CONCAT('-0',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 100000 AND _nNoSelanjutnya < 1000000 THEN
		SET _kodesekarang = CONCAT('-',_nNoSelanjutnya);
	END IF;
	
	
	RETURN CONCAT('EKS', _kodeSekarang);
    END */$$
DELIMITER ;

/* Function  structure for function  `f_idgaleri_create` */

/*!50003 DROP FUNCTION IF EXISTS `f_idgaleri_create` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `f_idgaleri_create`(`_tgl` DATE) RETURNS char(10) CHARSET latin1 COLLATE latin1_swedish_ci
BEGIN
	DECLARE cNosekarang CHAR(4);
	DECLARE nlen INT;
	DECLARE nNoselanjutnya INT;
	DECLARE cNoselanjutnya CHAR(4);
	DECLARE jumlah_digit INT;
	DECLARE cTgl CHAR(6);
	
	SET jumlah_digit = '4';
	SET cTgl = DATE_FORMAT(_tgl, '%y%m%d');
	
	SELECT MAX(RIGHT(RTRIM(idgaleri),jumlah_digit)) FROM profil_galeri WHERE DATE_FORMAT(tglinsert, '%Y-%m-%d') = _tgl  INTO cNosekarang;	
	SET cNosekarang = IF(ISNULL(cNosekarang),0,cNosekarang);
	
	SET nNoselanjutnya = CONVERT(cNosekarang,INT)+1;
	SET cNoselanjutnya = RTRIM(CONVERT(nNoselanjutnya,CHAR));
	SET nlen = LENGTH(cNoselanjutnya);
	
	WHILE nlen+1 <= jumlah_digit DO		
		SET cNoselanjutnya= CONCAT('0',cNoselanjutnya);
		SET nlen=nlen+1;
	END WHILE;	
	
	RETURN CONCAT(cTgl, cNoselanjutnya);
    END */$$
DELIMITER ;

/* Function  structure for function  `f_idjadwalboking_create` */

/*!50003 DROP FUNCTION IF EXISTS `f_idjadwalboking_create` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `f_idjadwalboking_create`(`_tgl` DATE) RETURNS char(10) CHARSET latin1 COLLATE latin1_swedish_ci
BEGIN
	DECLARE cNosekarang CHAR(4);
	DECLARE nlen INT;
	DECLARE nNoselanjutnya INT;
	DECLARE cNoselanjutnya CHAR(4);
	DECLARE jumlah_digit INT;
	DECLARE cTgl CHAR(6);
	
	SET jumlah_digit = '4';
	SET cTgl = DATE_FORMAT(_tgl, '%y%m%d');
	
	SELECT MAX(RIGHT(RTRIM(idjadwalboking),jumlah_digit)) FROM jadwalboking WHERE DATE_FORMAT(tgljadwalboking, '%Y-%m-%d') = _tgl  INTO cNosekarang;	
	SET cNosekarang = IF(ISNULL(cNosekarang),0,cNosekarang);
	
	SET nNoselanjutnya = CONVERT(cNosekarang,INT)+1;
	SET cNoselanjutnya = RTRIM(CONVERT(nNoselanjutnya,CHAR));
	SET nlen = LENGTH(cNoselanjutnya);
	
	WHILE nlen+1 <= jumlah_digit DO		
		SET cNoselanjutnya= CONCAT('0',cNoselanjutnya);
		SET nlen=nlen+1;
	END WHILE;	
	
	RETURN CONCAT(cTgl, cNoselanjutnya);
    END */$$
DELIMITER ;

/* Function  structure for function  `f_idjadwal_create` */

/*!50003 DROP FUNCTION IF EXISTS `f_idjadwal_create` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `f_idjadwal_create`() RETURNS char(10) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
BEGIN
	
	DECLARE _cNosekarang VARCHAR(20);
	DECLARE _nNoSelanjutnya INT;
	DECLARE _kodeSekarang CHAR(7);
	
	
	SELECT MAX(RIGHT(idjadwal,6)) INTO _cNosekarang FROM jadwal;
	SET _cNosekarang = IF(ISNULL(_cNosekarang),0,_cNosekarang);
	SET _nNoSelanjutnya = CONVERT(_cNosekarang, INT) + 1;
	
	IF _nNoSelanjutnya > 0 AND _nNoSelanjutnya < 10 THEN
		SET _kodesekarang = CONCAT('-00000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 10 AND _nNoSelanjutnya < 100 THEN
		SET _kodesekarang = CONCAT('-0000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 100 AND _nNoSelanjutnya < 1000 THEN
		SET _kodesekarang = CONCAT('-000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 1000 AND _nNoSelanjutnya < 10000 THEN
		SET _kodesekarang = CONCAT('-00',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 10000 AND _nNoSelanjutnya < 100000 THEN
		SET _kodesekarang = CONCAT('-0',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 100000 AND _nNoSelanjutnya < 1000000 THEN
		SET _kodesekarang = CONCAT('-',_nNoSelanjutnya);
	END IF;
	
	
	RETURN CONCAT('JWD', _kodeSekarang);
    END */$$
DELIMITER ;

/* Function  structure for function  `f_idjenis_create` */

/*!50003 DROP FUNCTION IF EXISTS `f_idjenis_create` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `f_idjenis_create`() RETURNS char(10) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
BEGIN
	
	DECLARE _cNosekarang VARCHAR(20);
	DECLARE _nNoSelanjutnya INT;
	DECLARE _kodeSekarang CHAR(7);
	
	
	SELECT MAX(RIGHT(idjenis,6)) INTO _cNosekarang FROM jenis;
	SET _cNosekarang = IF(ISNULL(_cNosekarang),0,_cNosekarang);
	SET _nNoSelanjutnya = CONVERT(_cNosekarang, INT) + 1;
	
	IF _nNoSelanjutnya > 0 AND _nNoSelanjutnya < 10 THEN
		SET _kodesekarang = CONCAT('-00000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 10 AND _nNoSelanjutnya < 100 THEN
		SET _kodesekarang = CONCAT('-0000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 100 AND _nNoSelanjutnya < 1000 THEN
		SET _kodesekarang = CONCAT('-000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 1000 AND _nNoSelanjutnya < 10000 THEN
		SET _kodesekarang = CONCAT('-00',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 10000 AND _nNoSelanjutnya < 100000 THEN
		SET _kodesekarang = CONCAT('-0',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 100000 AND _nNoSelanjutnya < 1000000 THEN
		SET _kodesekarang = CONCAT('-',_nNoSelanjutnya);
	END IF;
	
	
	RETURN CONCAT('JNS', _kodeSekarang);
    END */$$
DELIMITER ;

/* Function  structure for function  `f_idkabupaten_create` */

/*!50003 DROP FUNCTION IF EXISTS `f_idkabupaten_create` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `f_idkabupaten_create`() RETURNS char(10) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
BEGIN
	
	DECLARE _cNosekarang VARCHAR(20);
	DECLARE _nNoSelanjutnya INT;
	DECLARE _kodeSekarang CHAR(7);
	
	
	SELECT MAX(RIGHT(idkabupaten,6)) INTO _cNosekarang FROM kabupaten;
	SET _cNosekarang = IF(ISNULL(_cNosekarang),0,_cNosekarang);
	SET _nNoSelanjutnya = CONVERT(_cNosekarang, INT) + 1;
	
	IF _nNoSelanjutnya > 0 AND _nNoSelanjutnya < 10 THEN
		SET _kodesekarang = CONCAT('-00000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 10 AND _nNoSelanjutnya < 100 THEN
		SET _kodesekarang = CONCAT('-0000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 100 AND _nNoSelanjutnya < 1000 THEN
		SET _kodesekarang = CONCAT('-000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 1000 AND _nNoSelanjutnya < 10000 THEN
		SET _kodesekarang = CONCAT('-00',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 10000 AND _nNoSelanjutnya < 100000 THEN
		SET _kodesekarang = CONCAT('-0',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 100000 AND _nNoSelanjutnya < 1000000 THEN
		SET _kodesekarang = CONCAT('-',_nNoSelanjutnya);
	END IF;
	
	
	RETURN CONCAT('KAB', _kodeSekarang);
    END */$$
DELIMITER ;

/* Function  structure for function  `f_idkategori_create` */

/*!50003 DROP FUNCTION IF EXISTS `f_idkategori_create` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `f_idkategori_create`() RETURNS char(10) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
BEGIN
	
	DECLARE _cNosekarang VARCHAR(20);
	DECLARE _nNoSelanjutnya INT;
	DECLARE _kodeSekarang CHAR(7);
	
	
	SELECT MAX(RIGHT(idkategori,6)) INTO _cNosekarang FROM kategori;
	SET _cNosekarang = IF(ISNULL(_cNosekarang),0,_cNosekarang);
	SET _nNoSelanjutnya = CONVERT(_cNosekarang, INT) + 1;
	
	IF _nNoSelanjutnya > 0 AND _nNoSelanjutnya < 10 THEN
		SET _kodesekarang = CONCAT('-00000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 10 AND _nNoSelanjutnya < 100 THEN
		SET _kodesekarang = CONCAT('-0000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 100 AND _nNoSelanjutnya < 1000 THEN
		SET _kodesekarang = CONCAT('-000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 1000 AND _nNoSelanjutnya < 10000 THEN
		SET _kodesekarang = CONCAT('-00',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 10000 AND _nNoSelanjutnya < 100000 THEN
		SET _kodesekarang = CONCAT('-0',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 100000 AND _nNoSelanjutnya < 1000000 THEN
		SET _kodesekarang = CONCAT('-',_nNoSelanjutnya);
	END IF;
	
	
	RETURN CONCAT('KTG', _kodeSekarang);
    END */$$
DELIMITER ;

/* Function  structure for function  `f_idkecamatan_create` */

/*!50003 DROP FUNCTION IF EXISTS `f_idkecamatan_create` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `f_idkecamatan_create`() RETURNS char(10) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
BEGIN
	
	DECLARE _cNosekarang VARCHAR(20);
	DECLARE _nNoSelanjutnya INT;
	DECLARE _kodeSekarang CHAR(7);
	
	
	SELECT MAX(RIGHT(idkecamatan,6)) INTO _cNosekarang FROM kecamatan;
	SET _cNosekarang = IF(ISNULL(_cNosekarang),0,_cNosekarang);
	SET _nNoSelanjutnya = CONVERT(_cNosekarang, INT) + 1;
	
	IF _nNoSelanjutnya > 0 AND _nNoSelanjutnya < 10 THEN
		SET _kodesekarang = CONCAT('-00000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 10 AND _nNoSelanjutnya < 100 THEN
		SET _kodesekarang = CONCAT('-0000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 100 AND _nNoSelanjutnya < 1000 THEN
		SET _kodesekarang = CONCAT('-000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 1000 AND _nNoSelanjutnya < 10000 THEN
		SET _kodesekarang = CONCAT('-00',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 10000 AND _nNoSelanjutnya < 100000 THEN
		SET _kodesekarang = CONCAT('-0',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 100000 AND _nNoSelanjutnya < 1000000 THEN
		SET _kodesekarang = CONCAT('-',_nNoSelanjutnya);
	END IF;
	
	
	RETURN CONCAT('KEC', _kodeSekarang);
    END */$$
DELIMITER ;

/* Function  structure for function  `f_idlayanan_create` */

/*!50003 DROP FUNCTION IF EXISTS `f_idlayanan_create` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `f_idlayanan_create`() RETURNS char(10) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
BEGIN
	
	DECLARE _cNosekarang VARCHAR(20);
	DECLARE _nNoSelanjutnya INT;
	DECLARE _kodeSekarang CHAR(7);
	
	
	SELECT MAX(RIGHT(idlayanan,6)) INTO _cNosekarang FROM profil_layanan;
	SET _cNosekarang = IF(ISNULL(_cNosekarang),0,_cNosekarang);
	SET _nNoSelanjutnya = CONVERT(_cNosekarang, INT) + 1;
	
	IF _nNoSelanjutnya > 0 AND _nNoSelanjutnya < 10 THEN
		SET _kodesekarang = CONCAT('-00000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 10 AND _nNoSelanjutnya < 100 THEN
		SET _kodesekarang = CONCAT('-0000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 100 AND _nNoSelanjutnya < 1000 THEN
		SET _kodesekarang = CONCAT('-000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 1000 AND _nNoSelanjutnya < 10000 THEN
		SET _kodesekarang = CONCAT('-00',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 10000 AND _nNoSelanjutnya < 100000 THEN
		SET _kodesekarang = CONCAT('-0',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 100000 AND _nNoSelanjutnya < 1000000 THEN
		SET _kodesekarang = CONCAT('-',_nNoSelanjutnya);
	END IF;
	
	
	RETURN CONCAT('LYN', _kodeSekarang);
    END */$$
DELIMITER ;

/* Function  structure for function  `f_idpelanggan_create` */

/*!50003 DROP FUNCTION IF EXISTS `f_idpelanggan_create` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `f_idpelanggan_create`() RETURNS char(10) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
BEGIN
	
	DECLARE _cNosekarang VARCHAR(20);
	DECLARE _nNoSelanjutnya INT;
	DECLARE _kodeSekarang CHAR(7);
	
	
	SELECT MAX(RIGHT(idpelanggan,6)) INTO _cNosekarang FROM pelanggan;
	SET _cNosekarang = IF(ISNULL(_cNosekarang),0,_cNosekarang);
	SET _nNoSelanjutnya = CONVERT(_cNosekarang, INT) + 1;
	
	IF _nNoSelanjutnya > 0 AND _nNoSelanjutnya < 10 THEN
		SET _kodesekarang = CONCAT('-00000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 10 AND _nNoSelanjutnya < 100 THEN
		SET _kodesekarang = CONCAT('-0000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 100 AND _nNoSelanjutnya < 1000 THEN
		SET _kodesekarang = CONCAT('-000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 1000 AND _nNoSelanjutnya < 10000 THEN
		SET _kodesekarang = CONCAT('-00',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 10000 AND _nNoSelanjutnya < 100000 THEN
		SET _kodesekarang = CONCAT('-0',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 100000 AND _nNoSelanjutnya < 1000000 THEN
		SET _kodesekarang = CONCAT('-',_nNoSelanjutnya);
	END IF;
	
	
	RETURN CONCAT('PLG', _kodeSekarang);
    END */$$
DELIMITER ;

/* Function  structure for function  `f_idpembayaran_create` */

/*!50003 DROP FUNCTION IF EXISTS `f_idpembayaran_create` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `f_idpembayaran_create`(`_tgl` DATE) RETURNS char(10) CHARSET latin1 COLLATE latin1_swedish_ci
BEGIN
	DECLARE cNosekarang CHAR(4);
	DECLARE nlen INT;
	DECLARE nNoselanjutnya INT;
	DECLARE cNoselanjutnya CHAR(4);
	DECLARE jumlah_digit INT;
	DECLARE cTgl CHAR(6);
	
	SET jumlah_digit = '4';
	SET cTgl = DATE_FORMAT(_tgl, '%y%m%d');
	
	SELECT MAX(RIGHT(RTRIM(idpembayaran),jumlah_digit)) FROM pembayaran WHERE DATE_FORMAT(tglpembayaran, '%Y-%m-%d') = _tgl  INTO cNosekarang;	
	SET cNosekarang = IF(ISNULL(cNosekarang),0,cNosekarang);
	
	SET nNoselanjutnya = CONVERT(cNosekarang,INT)+1;
	SET cNoselanjutnya = RTRIM(CONVERT(nNoselanjutnya,CHAR));
	SET nlen = LENGTH(cNoselanjutnya);
	
	WHILE nlen+1 <= jumlah_digit DO		
		SET cNoselanjutnya= CONCAT('0',cNoselanjutnya);
		SET nlen=nlen+1;
	END WHILE;	
	
	RETURN CONCAT(cTgl, cNoselanjutnya);
    END */$$
DELIMITER ;

/* Function  structure for function  `f_idpembelian_create` */

/*!50003 DROP FUNCTION IF EXISTS `f_idpembelian_create` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `f_idpembelian_create`(`_tgl` DATE) RETURNS char(10) CHARSET latin1 COLLATE latin1_swedish_ci
BEGIN
	DECLARE cNosekarang CHAR(4);
	DECLARE nlen INT;
	DECLARE nNoselanjutnya INT;
	DECLARE cNoselanjutnya CHAR(4);
	DECLARE jumlah_digit INT;
	DECLARE cTgl CHAR(6);
	
	SET jumlah_digit = '4';
	SET cTgl = DATE_FORMAT(_tgl, '%y%m%d');
	
	SELECT MAX(RIGHT(RTRIM(idpembelian),jumlah_digit)) FROM pembelian WHERE DATE_FORMAT(tglinsert, '%Y-%m-%d') = _tgl  INTO cNosekarang;	
	SET cNosekarang = IF(ISNULL(cNosekarang),0,cNosekarang);
	
	SET nNoselanjutnya = CONVERT(cNosekarang,INT)+1;
	SET cNoselanjutnya = RTRIM(CONVERT(nNoselanjutnya,CHAR));
	SET nlen = LENGTH(cNoselanjutnya);
	
	WHILE nlen+1 <= jumlah_digit DO		
		SET cNoselanjutnya= CONCAT('0',cNoselanjutnya);
		SET nlen=nlen+1;
	END WHILE;	
	
	RETURN CONCAT(cTgl, cNoselanjutnya);
    END */$$
DELIMITER ;

/* Function  structure for function  `f_idpemesanan_create` */

/*!50003 DROP FUNCTION IF EXISTS `f_idpemesanan_create` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `f_idpemesanan_create`(`_tgl` DATE) RETURNS char(10) CHARSET latin1 COLLATE latin1_swedish_ci
BEGIN
	DECLARE cNosekarang CHAR(4);
	DECLARE nlen INT;
	DECLARE nNoselanjutnya INT;
	DECLARE cNoselanjutnya CHAR(4);
	DECLARE jumlah_digit INT;
	DECLARE cTgl CHAR(6);
	
	SET jumlah_digit = '4';
	SET cTgl = DATE_FORMAT(_tgl, '%y%m%d');
	
	SELECT MAX(RIGHT(RTRIM(idpemesanan),jumlah_digit)) FROM pemesanan WHERE DATE_FORMAT(tglpemesanan, '%Y-%m-%d') = _tgl  INTO cNosekarang;	
	SET cNosekarang = IF(ISNULL(cNosekarang),0,cNosekarang);
	
	SET nNoselanjutnya = CONVERT(cNosekarang,INT)+1;
	SET cNoselanjutnya = RTRIM(CONVERT(nNoselanjutnya,CHAR));
	SET nlen = LENGTH(cNoselanjutnya);
	
	WHILE nlen+1 <= jumlah_digit DO		
		SET cNoselanjutnya= CONCAT('0',cNoselanjutnya);
		SET nlen=nlen+1;
	END WHILE;	
	
	RETURN CONCAT(cTgl, cNoselanjutnya);
    END */$$
DELIMITER ;

/* Function  structure for function  `f_idpengadaan_create` */

/*!50003 DROP FUNCTION IF EXISTS `f_idpengadaan_create` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `f_idpengadaan_create`(`_tgl` DATE) RETURNS char(10) CHARSET latin1 COLLATE latin1_swedish_ci
BEGIN
	DECLARE cNosekarang CHAR(4);
	DECLARE nlen INT;
	DECLARE nNoselanjutnya INT;
	DECLARE cNoselanjutnya CHAR(4);
	DECLARE jumlah_digit INT;
	DECLARE cTgl CHAR(6);
	
	SET jumlah_digit = '4';
	SET cTgl = DATE_FORMAT(_tgl, '%y%m%d');
	
	SELECT MAX(RIGHT(RTRIM(`idpengadaan`),jumlah_digit)) FROM pengadaan WHERE DATE_FORMAT(tglinsert, '%Y-%m-%d') = _tgl  INTO cNosekarang;	
	SET cNosekarang = IF(ISNULL(cNosekarang),0,cNosekarang);
	
	SET nNoselanjutnya = CONVERT(cNosekarang,INT)+1;
	SET cNoselanjutnya = RTRIM(CONVERT(nNoselanjutnya,CHAR));
	SET nlen = LENGTH(cNoselanjutnya);
	
	WHILE nlen+1 <= jumlah_digit DO		
		SET cNoselanjutnya= CONCAT('0',cNoselanjutnya);
		SET nlen=nlen+1;
	END WHILE;	
	
	RETURN CONCAT(cTgl, cNoselanjutnya);
    END */$$
DELIMITER ;

/* Function  structure for function  `f_idpengguna_create` */

/*!50003 DROP FUNCTION IF EXISTS `f_idpengguna_create` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `f_idpengguna_create`() RETURNS char(10) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
BEGIN
	
	DECLARE _cNosekarang VARCHAR(20);
	DECLARE _nNoSelanjutnya INT;
	DECLARE _kodeSekarang CHAR(7);
	
	
	SELECT MAX(RIGHT(idpengguna,6)) INTO _cNosekarang FROM pengguna;
	SET _cNosekarang = IF(ISNULL(_cNosekarang),0,_cNosekarang);
	SET _nNoSelanjutnya = CONVERT(_cNosekarang, INT) + 1;
	
	IF _nNoSelanjutnya > 0 AND _nNoSelanjutnya < 10 THEN
		SET _kodesekarang = CONCAT('-00000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 10 AND _nNoSelanjutnya < 100 THEN
		SET _kodesekarang = CONCAT('-0000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 100 AND _nNoSelanjutnya < 1000 THEN
		SET _kodesekarang = CONCAT('-000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 1000 AND _nNoSelanjutnya < 10000 THEN
		SET _kodesekarang = CONCAT('-00',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 10000 AND _nNoSelanjutnya < 100000 THEN
		SET _kodesekarang = CONCAT('-0',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 100000 AND _nNoSelanjutnya < 1000000 THEN
		SET _kodesekarang = CONCAT('-',_nNoSelanjutnya);
	END IF;
	
	
	RETURN CONCAT('PGN', _kodeSekarang);
    END */$$
DELIMITER ;

/* Function  structure for function  `f_idpenjualan_create` */

/*!50003 DROP FUNCTION IF EXISTS `f_idpenjualan_create` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `f_idpenjualan_create`(`_tgl` DATE) RETURNS char(10) CHARSET latin1 COLLATE latin1_swedish_ci
BEGIN
	DECLARE cNosekarang CHAR(4);
	DECLARE nlen INT;
	DECLARE nNoselanjutnya INT;
	DECLARE cNoselanjutnya CHAR(4);
	DECLARE jumlah_digit INT;
	DECLARE cTgl CHAR(6);
	
	SET jumlah_digit = '4';
	SET cTgl = DATE_FORMAT(_tgl, '%y%m%d');
	
	SELECT MAX(RIGHT(RTRIM(idpenjualan),jumlah_digit)) FROM penjualan WHERE DATE_FORMAT(tglpenjualan, '%Y-%m-%d') = _tgl  INTO cNosekarang;	
	SET cNosekarang = IF(ISNULL(cNosekarang),0,cNosekarang);
	
	SET nNoselanjutnya = CONVERT(cNosekarang,INT)+1;
	SET cNoselanjutnya = RTRIM(CONVERT(nNoselanjutnya,CHAR));
	SET nlen = LENGTH(cNoselanjutnya);
	
	WHILE nlen+1 <= jumlah_digit DO		
		SET cNoselanjutnya= CONCAT('0',cNoselanjutnya);
		SET nlen=nlen+1;
	END WHILE;	
	
	RETURN CONCAT(cTgl, cNoselanjutnya);
    END */$$
DELIMITER ;

/* Function  structure for function  `f_idperencanaansurat_create` */

/*!50003 DROP FUNCTION IF EXISTS `f_idperencanaansurat_create` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `f_idperencanaansurat_create`(`_tgl` DATE) RETURNS char(10) CHARSET latin1 COLLATE latin1_swedish_ci
BEGIN
	DECLARE cNosekarang CHAR(4);
	DECLARE nlen INT;
	DECLARE nNoselanjutnya INT;
	DECLARE cNoselanjutnya CHAR(4);
	DECLARE jumlah_digit INT;
	DECLARE cTgl CHAR(6);
	
	SET jumlah_digit = '4';
	SET cTgl = DATE_FORMAT(_tgl, '%y%m%d');
	
	SELECT MAX(RIGHT(RTRIM(idperencanaansurat),jumlah_digit)) FROM perencanaansurat WHERE DATE_FORMAT(tglinsert, '%Y-%m-%d') = _tgl  INTO cNosekarang;	
	SET cNosekarang = IF(ISNULL(cNosekarang),0,cNosekarang);
	
	SET nNoselanjutnya = CONVERT(cNosekarang,INT)+1;
	SET cNoselanjutnya = RTRIM(CONVERT(nNoselanjutnya,CHAR));
	SET nlen = LENGTH(cNoselanjutnya);
	
	WHILE nlen+1 <= jumlah_digit DO		
		SET cNoselanjutnya= CONCAT('0',cNoselanjutnya);
		SET nlen=nlen+1;
	END WHILE;	
	
	RETURN CONCAT(cTgl, cNoselanjutnya);
    END */$$
DELIMITER ;

/* Function  structure for function  `f_idperencanaan_create` */

/*!50003 DROP FUNCTION IF EXISTS `f_idperencanaan_create` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `f_idperencanaan_create`(`_tgl` DATE) RETURNS char(10) CHARSET latin1 COLLATE latin1_swedish_ci
BEGIN
	DECLARE cNosekarang CHAR(4);
	DECLARE nlen INT;
	DECLARE nNoselanjutnya INT;
	DECLARE cNoselanjutnya CHAR(4);
	DECLARE jumlah_digit INT;
	DECLARE cTgl CHAR(6);
	
	SET jumlah_digit = '4';
	SET cTgl = DATE_FORMAT(_tgl, '%y%m%d');
	
	SELECT MAX(RIGHT(RTRIM(idperencanaan),jumlah_digit)) FROM perencanaan WHERE DATE_FORMAT(tglinsert, '%Y-%m-%d') = _tgl  INTO cNosekarang;	
	SET cNosekarang = IF(ISNULL(cNosekarang),0,cNosekarang);
	
	SET nNoselanjutnya = CONVERT(cNosekarang,INT)+1;
	SET cNoselanjutnya = RTRIM(CONVERT(nNoselanjutnya,CHAR));
	SET nlen = LENGTH(cNoselanjutnya);
	
	WHILE nlen+1 <= jumlah_digit DO		
		SET cNoselanjutnya= CONCAT('0',cNoselanjutnya);
		SET nlen=nlen+1;
	END WHILE;	
	
	RETURN CONCAT(cTgl, cNoselanjutnya);
    END */$$
DELIMITER ;

/* Function  structure for function  `f_idproduk_create` */

/*!50003 DROP FUNCTION IF EXISTS `f_idproduk_create` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `f_idproduk_create`() RETURNS char(10) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
BEGIN
	
	DECLARE _cNosekarang VARCHAR(20);
	DECLARE _nNoSelanjutnya INT;
	DECLARE _kodeSekarang CHAR(7);
	
	
	SELECT MAX(RIGHT(idproduk,6)) INTO _cNosekarang FROM produk;
	SET _cNosekarang = IF(ISNULL(_cNosekarang),0,_cNosekarang);
	SET _nNoSelanjutnya = CONVERT(_cNosekarang, INT) + 1;
	
	IF _nNoSelanjutnya > 0 AND _nNoSelanjutnya < 10 THEN
		SET _kodesekarang = CONCAT('-00000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 10 AND _nNoSelanjutnya < 100 THEN
		SET _kodesekarang = CONCAT('-0000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 100 AND _nNoSelanjutnya < 1000 THEN
		SET _kodesekarang = CONCAT('-000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 1000 AND _nNoSelanjutnya < 10000 THEN
		SET _kodesekarang = CONCAT('-00',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 10000 AND _nNoSelanjutnya < 100000 THEN
		SET _kodesekarang = CONCAT('-0',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 100000 AND _nNoSelanjutnya < 1000000 THEN
		SET _kodesekarang = CONCAT('-',_nNoSelanjutnya);
	END IF;
	
	
	RETURN CONCAT('PRD', _kodeSekarang);
    END */$$
DELIMITER ;

/* Function  structure for function  `f_idreturpenjualan_create` */

/*!50003 DROP FUNCTION IF EXISTS `f_idreturpenjualan_create` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `f_idreturpenjualan_create`(`_tgl` DATE) RETURNS char(10) CHARSET latin1 COLLATE latin1_swedish_ci
BEGIN
	DECLARE cNosekarang CHAR(4);
	DECLARE nlen INT;
	DECLARE nNoselanjutnya INT;
	DECLARE cNoselanjutnya CHAR(4);
	DECLARE jumlah_digit INT;
	DECLARE cTgl CHAR(6);
	
	SET jumlah_digit = '4';
	SET cTgl = DATE_FORMAT(_tgl, '%y%m%d');
	
	SELECT MAX(RIGHT(RTRIM(idreturpenjualan),jumlah_digit)) FROM returpenjualan WHERE DATE_FORMAT(tglreturpenjualan, '%Y-%m-%d') = _tgl  INTO cNosekarang;	
	SET cNosekarang = IF(ISNULL(cNosekarang),0,cNosekarang);
	
	SET nNoselanjutnya = CONVERT(cNosekarang,INT)+1;
	SET cNoselanjutnya = RTRIM(CONVERT(nNoselanjutnya,CHAR));
	SET nlen = LENGTH(cNoselanjutnya);
	
	WHILE nlen+1 <= jumlah_digit DO		
		SET cNoselanjutnya= CONCAT('0',cNoselanjutnya);
		SET nlen=nlen+1;
	END WHILE;	
	
	RETURN CONCAT(cTgl, cNoselanjutnya);
    END */$$
DELIMITER ;

/* Function  structure for function  `f_idslider_create` */

/*!50003 DROP FUNCTION IF EXISTS `f_idslider_create` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `f_idslider_create`(`_tgl` DATE) RETURNS char(10) CHARSET latin1 COLLATE latin1_swedish_ci
BEGIN
	DECLARE cNosekarang CHAR(4);
	DECLARE nlen INT;
	DECLARE nNoselanjutnya INT;
	DECLARE cNoselanjutnya CHAR(4);
	DECLARE jumlah_digit INT;
	DECLARE cTgl CHAR(6);
	
	SET jumlah_digit = '4';
	SET cTgl = DATE_FORMAT(_tgl, '%y%m%d');
	
	SELECT MAX(RIGHT(RTRIM(idslider),jumlah_digit)) FROM profil_slider WHERE DATE_FORMAT(tglinsert, '%Y-%m-%d') = _tgl  INTO cNosekarang;	
	SET cNosekarang = IF(ISNULL(cNosekarang),0,cNosekarang);
	
	SET nNoselanjutnya = CONVERT(cNosekarang,INT)+1;
	SET cNoselanjutnya = RTRIM(CONVERT(nNoselanjutnya,CHAR));
	SET nlen = LENGTH(cNoselanjutnya);
	
	WHILE nlen+1 <= jumlah_digit DO		
		SET cNoselanjutnya= CONCAT('0',cNoselanjutnya);
		SET nlen=nlen+1;
	END WHILE;	
	
	RETURN CONCAT(cTgl, cNoselanjutnya);
    END */$$
DELIMITER ;

/* Function  structure for function  `f_idsosialmedia_create` */

/*!50003 DROP FUNCTION IF EXISTS `f_idsosialmedia_create` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `f_idsosialmedia_create`() RETURNS char(10) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
BEGIN
	
	DECLARE _cNosekarang VARCHAR(20);
	DECLARE _nNoSelanjutnya INT;
	DECLARE _kodeSekarang CHAR(7);
	
	
	SELECT MAX(RIGHT(idsosialmedia,6)) INTO _cNosekarang FROM profil_sosialmedia;
	SET _cNosekarang = IF(ISNULL(_cNosekarang),0,_cNosekarang);
	SET _nNoSelanjutnya = CONVERT(_cNosekarang, INT) + 1;
	
	IF _nNoSelanjutnya > 0 AND _nNoSelanjutnya < 10 THEN
		SET _kodesekarang = CONCAT('-00000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 10 AND _nNoSelanjutnya < 100 THEN
		SET _kodesekarang = CONCAT('-0000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 100 AND _nNoSelanjutnya < 1000 THEN
		SET _kodesekarang = CONCAT('-000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 1000 AND _nNoSelanjutnya < 10000 THEN
		SET _kodesekarang = CONCAT('-00',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 10000 AND _nNoSelanjutnya < 100000 THEN
		SET _kodesekarang = CONCAT('-0',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 100000 AND _nNoSelanjutnya < 1000000 THEN
		SET _kodesekarang = CONCAT('-',_nNoSelanjutnya);
	END IF;
	
	
	RETURN CONCAT('SMD', _kodeSekarang);
    END */$$
DELIMITER ;

/* Function  structure for function  `f_idsupplier_create` */

/*!50003 DROP FUNCTION IF EXISTS `f_idsupplier_create` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `f_idsupplier_create`() RETURNS char(10) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
BEGIN
	
	DECLARE _cNosekarang VARCHAR(20);
	DECLARE _nNoSelanjutnya INT;
	DECLARE _kodeSekarang CHAR(7);
	
	
	SELECT MAX(RIGHT(idsupplier,6)) INTO _cNosekarang FROM supplier;
	SET _cNosekarang = IF(ISNULL(_cNosekarang),0,_cNosekarang);
	SET _nNoSelanjutnya = CONVERT(_cNosekarang, INT) + 1;
	
	IF _nNoSelanjutnya > 0 AND _nNoSelanjutnya < 10 THEN
		SET _kodesekarang = CONCAT('-00000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 10 AND _nNoSelanjutnya < 100 THEN
		SET _kodesekarang = CONCAT('-0000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 100 AND _nNoSelanjutnya < 1000 THEN
		SET _kodesekarang = CONCAT('-000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 1000 AND _nNoSelanjutnya < 10000 THEN
		SET _kodesekarang = CONCAT('-00',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 10000 AND _nNoSelanjutnya < 100000 THEN
		SET _kodesekarang = CONCAT('-0',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 100000 AND _nNoSelanjutnya < 1000000 THEN
		SET _kodesekarang = CONCAT('-',_nNoSelanjutnya);
	END IF;
	
	
	RETURN CONCAT('SPL', _kodeSekarang);
    END */$$
DELIMITER ;

/* Function  structure for function  `f_idtarif_create` */

/*!50003 DROP FUNCTION IF EXISTS `f_idtarif_create` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `f_idtarif_create`() RETURNS char(10) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
BEGIN
	
	DECLARE _cNosekarang VARCHAR(20);
	DECLARE _nNoSelanjutnya INT;
	DECLARE _kodeSekarang CHAR(7);
	
	
	SELECT MAX(RIGHT(idtarif,6)) INTO _cNosekarang FROM tarif;
	SET _cNosekarang = IF(ISNULL(_cNosekarang),0,_cNosekarang);
	SET _nNoSelanjutnya = CONVERT(_cNosekarang, INT) + 1;
	
	IF _nNoSelanjutnya > 0 AND _nNoSelanjutnya < 10 THEN
		SET _kodesekarang = CONCAT('-00000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 10 AND _nNoSelanjutnya < 100 THEN
		SET _kodesekarang = CONCAT('-0000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 100 AND _nNoSelanjutnya < 1000 THEN
		SET _kodesekarang = CONCAT('-000',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 1000 AND _nNoSelanjutnya < 10000 THEN
		SET _kodesekarang = CONCAT('-00',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 10000 AND _nNoSelanjutnya < 100000 THEN
		SET _kodesekarang = CONCAT('-0',_nNoSelanjutnya);
	ELSEIF _nNoSelanjutnya >= 100000 AND _nNoSelanjutnya < 1000000 THEN
		SET _kodesekarang = CONCAT('-',_nNoSelanjutnya);
	END IF;
	
	
	RETURN CONCAT('TRF', _kodeSekarang);
    END */$$
DELIMITER ;

/* Function  structure for function  `f_idtestimoni_create` */

/*!50003 DROP FUNCTION IF EXISTS `f_idtestimoni_create` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `f_idtestimoni_create`(`_tgl` DATE) RETURNS char(10) CHARSET latin1 COLLATE latin1_swedish_ci
BEGIN
	DECLARE cNosekarang CHAR(4);
	DECLARE nlen INT;
	DECLARE nNoselanjutnya INT;
	DECLARE cNoselanjutnya CHAR(4);
	DECLARE jumlah_digit INT;
	DECLARE cTgl CHAR(6);
	
	SET jumlah_digit = '4';
	SET cTgl = DATE_FORMAT(_tgl, '%y%m%d');
	
	SELECT MAX(RIGHT(RTRIM(idtestimoni),jumlah_digit)) FROM profil_testimoni WHERE DATE_FORMAT(tglinsert, '%Y-%m-%d') = _tgl  INTO cNosekarang;	
	SET cNosekarang = IF(ISNULL(cNosekarang),0,cNosekarang);
	
	SET nNoselanjutnya = CONVERT(cNosekarang,INT)+1;
	SET cNoselanjutnya = RTRIM(CONVERT(nNoselanjutnya,CHAR));
	SET nlen = LENGTH(cNoselanjutnya);
	
	WHILE nlen+1 <= jumlah_digit DO		
		SET cNoselanjutnya= CONCAT('0',cNoselanjutnya);
		SET nlen=nlen+1;
	END WHILE;	
	
	RETURN CONCAT(cTgl, cNoselanjutnya);
    END */$$
DELIMITER ;

/* Function  structure for function  `f_idvideo_create` */

/*!50003 DROP FUNCTION IF EXISTS `f_idvideo_create` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `f_idvideo_create`(`_tgl` DATE) RETURNS char(10) CHARSET latin1 COLLATE latin1_swedish_ci
BEGIN
	DECLARE cNosekarang CHAR(4);
	DECLARE nlen INT;
	DECLARE nNoselanjutnya INT;
	DECLARE cNoselanjutnya CHAR(4);
	DECLARE jumlah_digit INT;
	DECLARE cTgl CHAR(6);
	
	SET jumlah_digit = '4';
	SET cTgl = DATE_FORMAT(_tgl, '%y%m%d');
	
	SELECT MAX(RIGHT(RTRIM(idvideo),jumlah_digit)) FROM profil_video WHERE DATE_FORMAT(tglinsert, '%Y-%m-%d') = _tgl  INTO cNosekarang;	
	SET cNosekarang = IF(ISNULL(cNosekarang),0,cNosekarang);
	
	SET nNoselanjutnya = CONVERT(cNosekarang,INT)+1;
	SET cNoselanjutnya = RTRIM(CONVERT(nNoselanjutnya,CHAR));
	SET nlen = LENGTH(cNoselanjutnya);
	
	WHILE nlen+1 <= jumlah_digit DO		
		SET cNoselanjutnya= CONCAT('0',cNoselanjutnya);
		SET nlen=nlen+1;
	END WHILE;	
	
	RETURN CONCAT(cTgl, cNoselanjutnya);
    END */$$
DELIMITER ;

/* Function  structure for function  `f_pendapatan` */

/*!50003 DROP FUNCTION IF EXISTS `f_pendapatan` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `f_pendapatan`(`f_bulan` INT(11), `f_tahun` INT(11), `f_filter` VARCHAR(20)) RETURNS decimal(18,0)
BEGIN
	DECLARE d_output DECIMAL(18,0) DEFAULT 0;
	IF f_filter = 'Pendapatan Kotor' THEN
		SELECT (IFNULL(SUM(totalharga), 0) - IFNULL(diskon, 0)) AS totalharga FROM v_penjualandetil_global
		WHERE MONTH(tanggal)=f_bulan AND YEAR(tanggal)=f_tahun
		INTO d_output;
	ELSEIF f_filter = 'Pengeluaran Modal' THEN
		SELECT (IFNULL(SUM(qty * hargamodal), 0) - IFNULL(diskon, 0)) AS totalharga FROM v_penjualandetil_global
		WHERE MONTH(tanggal)=f_bulan AND YEAR(tanggal)=f_tahun
		INTO d_output;
	ELSEIF f_filter = 'Pendapatan Bersih' THEN
		SELECT (IFNULL(SUM(qty * hargajual), 0) - IFNULL(SUM(qty * hargamodal), 0) - IFNULL(diskon, 0)) AS totalharga FROM v_penjualandetil_global
		WHERE MONTH(tanggal)=f_bulan AND YEAR(tanggal)=f_tahun
		INTO d_output;
	ELSEIF f_filter = 'Pengeluaran Diskon' THEN
		SELECT IFNULL(SUM(diskon), 0) AS totalharga FROM v_penjualandetil_global
		WHERE MONTH(tanggal)=f_bulan AND YEAR(tanggal)=f_tahun
		INTO d_output;
	ELSE
		SET d_output = 0;
	END IF;
	RETURN d_output;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_grafik_bulanan` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_grafik_bulanan` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_grafik_bulanan`(`f_tahun` INT(4), `f_filter` VARCHAR(20))
BEGIN
	IF f_filter = 'Pendapatan Kotor' THEN
		
		SELECT 
			IFNULL(SUM(CASE WHEN MONTH(tanggal)='01' THEN totalharga ELSE 0 END), 0) AS januari,
			IFNULL(SUM(CASE WHEN MONTH(tanggal)='02' THEN totalharga ELSE 0 END), 0) AS februari,
			IFNULL(SUM(CASE WHEN MONTH(tanggal)='03' THEN totalharga ELSE 0 END), 0) AS maret,
			IFNULL(SUM(CASE WHEN MONTH(tanggal)='04' THEN totalharga ELSE 0 END), 0) AS april,
			IFNULL(SUM(CASE WHEN MONTH(tanggal)='05' THEN totalharga ELSE 0 END), 0) AS mei,
			IFNULL(SUM(CASE WHEN MONTH(tanggal)='06' THEN totalharga ELSE 0 END), 0) AS juni,
			IFNULL(SUM(CASE WHEN MONTH(tanggal)='07' THEN totalharga ELSE 0 END), 0) AS juli,
			IFNULL(SUM(CASE WHEN MONTH(tanggal)='08' THEN totalharga ELSE 0 END), 0) AS agustus,
			IFNULL(SUM(CASE WHEN MONTH(tanggal)='09' THEN totalharga ELSE 0 END), 0) AS september,
			IFNULL(SUM(CASE WHEN MONTH(tanggal)='10' THEN totalharga ELSE 0 END), 0) AS oktober,
			IFNULL(SUM(CASE WHEN MONTH(tanggal)='11' THEN totalharga ELSE 0 END), 0) AS november,
			IFNULL(SUM(CASE WHEN MONTH(tanggal)='12' THEN totalharga ELSE 0 END), 0) AS desember 		
		FROM v_penjualandetil_global
		WHERE YEAR(tanggal)=f_tahun;
	ELSEIF f_filter = 'Pengeluaran Modal' THEN  
		
		SELECT 
			IFNULL(SUM(CASE WHEN MONTH(tanggal)='01' THEN qty * hargamodal ELSE 0 END), 0) AS januari,
			IFNULL(SUM(CASE WHEN MONTH(tanggal)='02' THEN qty * hargamodal ELSE 0 END), 0) AS februari,
			IFNULL(SUM(CASE WHEN MONTH(tanggal)='03' THEN qty * hargamodal ELSE 0 END), 0) AS maret,
			IFNULL(SUM(CASE WHEN MONTH(tanggal)='04' THEN qty * hargamodal ELSE 0 END), 0) AS april,
			IFNULL(SUM(CASE WHEN MONTH(tanggal)='05' THEN qty * hargamodal ELSE 0 END), 0) AS mei,
			IFNULL(SUM(CASE WHEN MONTH(tanggal)='06' THEN qty * hargamodal ELSE 0 END), 0) AS juni,
			IFNULL(SUM(CASE WHEN MONTH(tanggal)='07' THEN qty * hargamodal ELSE 0 END), 0) AS juli,
			IFNULL(SUM(CASE WHEN MONTH(tanggal)='08' THEN qty * hargamodal ELSE 0 END), 0) AS agustus,
			IFNULL(SUM(CASE WHEN MONTH(tanggal)='09' THEN qty * hargamodal ELSE 0 END), 0) AS september,
			IFNULL(SUM(CASE WHEN MONTH(tanggal)='10' THEN qty * hargamodal ELSE 0 END), 0) AS oktober,
			IFNULL(SUM(CASE WHEN MONTH(tanggal)='11' THEN qty * hargamodal ELSE 0 END), 0) AS november,
			IFNULL(SUM(CASE WHEN MONTH(tanggal)='12' THEN qty * hargamodal ELSE 0 END), 0) AS desember 		
		FROM v_penjualandetil_global
		WHERE YEAR(tanggal)=f_tahun;
	ELSEIF f_filter = 'Pendapatan Bersih' THEN  
	
		SELECT 
			IFNULL(SUM(CASE WHEN MONTH(tanggal)='01' THEN (qty * hargajual) - (qty * hargamodal) ELSE 0 END), 0) AS januari,
			IFNULL(SUM(CASE WHEN MONTH(tanggal)='02' THEN (qty * hargajual) - (qty * hargamodal) ELSE 0 END), 0) AS februari,
			IFNULL(SUM(CASE WHEN MONTH(tanggal)='03' THEN (qty * hargajual) - (qty * hargamodal) ELSE 0 END), 0) AS maret,
			IFNULL(SUM(CASE WHEN MONTH(tanggal)='04' THEN (qty * hargajual) - (qty * hargamodal) ELSE 0 END), 0) AS april,
			IFNULL(SUM(CASE WHEN MONTH(tanggal)='05' THEN (qty * hargajual) - (qty * hargamodal) ELSE 0 END), 0) AS mei,
			IFNULL(SUM(CASE WHEN MONTH(tanggal)='06' THEN (qty * hargajual) - (qty * hargamodal) ELSE 0 END), 0) AS juni,
			IFNULL(SUM(CASE WHEN MONTH(tanggal)='07' THEN (qty * hargajual) - (qty * hargamodal) ELSE 0 END), 0) AS juli,
			IFNULL(SUM(CASE WHEN MONTH(tanggal)='08' THEN (qty * hargajual) - (qty * hargamodal) ELSE 0 END), 0) AS agustus,
			IFNULL(SUM(CASE WHEN MONTH(tanggal)='09' THEN (qty * hargajual) - (qty * hargamodal) ELSE 0 END), 0) AS september,
			IFNULL(SUM(CASE WHEN MONTH(tanggal)='10' THEN (qty * hargajual) - (qty * hargamodal) ELSE 0 END), 0) AS oktober,
			IFNULL(SUM(CASE WHEN MONTH(tanggal)='11' THEN (qty * hargajual) - (qty * hargamodal) ELSE 0 END), 0) AS november,
			IFNULL(SUM(CASE WHEN MONTH(tanggal)='12' THEN (qty * hargajual) - (qty * hargamodal) ELSE 0 END), 0) AS desember 		
		FROM v_penjualandetil_global
		WHERE YEAR(tanggal)=f_tahun;	
	
	END IF;
	
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_pembayaran` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_pembayaran` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_pembayaran`(`f_idpemesanan` CHAR(10), `f_idkonfirmasi` CHAR(10))
BEGIN
	DECLARE d_totalharga DECIMAL(18,0) DEFAULT 0;
	DECLARE d_totalpembayaran DECIMAL(18,0) DEFAULT 0;
	
	SELECT IFNULL(v_pemesanan.totalharga, 0) AS totalharga 
	FROM v_pemesanan 
	WHERE v_pemesanan.idpemesanan=f_idpemesanan 
	INTO d_totalharga;
	
	SELECT IFNULL(SUM(pembayaran.jumlahpembayaran), 0) AS totalpembayaran FROM pembayaran 
	WHERE pembayaran.statuskonfirmasi='Dikonfirmasi' AND pembayaran.idpemesanan=f_idpemesanan
	INTO d_totalpembayaran;
	
	UPDATE pemesanan SET totalpembayaran=d_totalpembayaran WHERE idpemesanan=f_idpemesanan;
	
	IF d_totalharga <= d_totalpembayaran THEN
		UPDATE pemesanan SET 
			statuslunas='Sudah Lunas', 
			idkonfirmasi=f_idkonfirmasi, 
			tglkonfirmasi=NOW(), 
			statuskonfirmasi='Dikonfirmasi' 
		WHERE idpemesanan=f_idpemesanan;
	ELSE
		UPDATE pemesanan SET 
			statuslunas='Belum Lunas', 
			idkonfirmasi=NULL, 
			tglkonfirmasi=NULL, 
			statuskonfirmasi='Menunggu' 
		WHERE idpemesanan=f_idpemesanan;
	END IF;
	
    END */$$
DELIMITER ;

/*Table structure for table `v_barang` */

DROP TABLE IF EXISTS `v_barang`;

/*!50001 DROP VIEW IF EXISTS `v_barang` */;
/*!50001 DROP TABLE IF EXISTS `v_barang` */;

/*!50001 CREATE TABLE  `v_barang`(
 `idbarang` char(10) ,
 `namabarang` varchar(50) ,
 `idjenis` char(10) ,
 `nama` varchar(50) ,
 `satuan` varchar(20) ,
 `harga` decimal(18,0) ,
 `stok` decimal(18,0) ,
 `foto` varchar(255) ,
 `statusaktif` enum('Aktif','Tidak Aktif') ,
 `idkategori` char(10) ,
 `namakategori` varchar(50) 
)*/;

/*Table structure for table `v_barangkeluar` */

DROP TABLE IF EXISTS `v_barangkeluar`;

/*!50001 DROP VIEW IF EXISTS `v_barangkeluar` */;
/*!50001 DROP TABLE IF EXISTS `v_barangkeluar` */;

/*!50001 CREATE TABLE  `v_barangkeluar`(
 `idbarangkeluar` char(10) ,
 `tglbarangkeluar` date ,
 `keterangan` varchar(255) ,
 `totalharga` decimal(40,0) ,
 `tglinsert` datetime ,
 `tglupdate` datetime ,
 `idpengguna` char(10) ,
 `namapengguna` varchar(50) 
)*/;

/*Table structure for table `v_barangkeluar_detail` */

DROP TABLE IF EXISTS `v_barangkeluar_detail`;

/*!50001 DROP VIEW IF EXISTS `v_barangkeluar_detail` */;
/*!50001 DROP TABLE IF EXISTS `v_barangkeluar_detail` */;

/*!50001 CREATE TABLE  `v_barangkeluar_detail`(
 `idbarangkeluar` char(10) ,
 `tglbarangkeluar` date ,
 `idbarang` char(10) ,
 `namabarang` varchar(50) ,
 `satuan` varchar(20) ,
 `stok` decimal(18,0) ,
 `idjenis` char(10) ,
 `namajenis` varchar(50) ,
 `qty` decimal(18,2) ,
 `harga` decimal(18,0) ,
 `totalharga` decimal(18,0) 
)*/;

/*Table structure for table `v_barangmasuk` */

DROP TABLE IF EXISTS `v_barangmasuk`;

/*!50001 DROP VIEW IF EXISTS `v_barangmasuk` */;
/*!50001 DROP TABLE IF EXISTS `v_barangmasuk` */;

/*!50001 CREATE TABLE  `v_barangmasuk`(
 `idbarangmasuk` char(10) ,
 `tglbarangmasuk` date ,
 `nostruk` varchar(20) ,
 `keterangan` varchar(255) ,
 `foto` varchar(255) ,
 `idsupplier` char(10) ,
 `namasupplier` varchar(100) ,
 `totalharga` decimal(40,0) ,
 `idpengguna` char(10) ,
 `namapengguna` varchar(50) ,
 `tglinsert` datetime ,
 `tglupdate` datetime 
)*/;

/*Table structure for table `v_barangmasuk_detail` */

DROP TABLE IF EXISTS `v_barangmasuk_detail`;

/*!50001 DROP VIEW IF EXISTS `v_barangmasuk_detail` */;
/*!50001 DROP TABLE IF EXISTS `v_barangmasuk_detail` */;

/*!50001 CREATE TABLE  `v_barangmasuk_detail`(
 `idbarangmasuk` char(10) ,
 `tglbarangmasuk` date ,
 `nostruk` varchar(20) ,
 `idbarang` char(10) ,
 `namabarang` varchar(50) ,
 `satuan` varchar(20) ,
 `stok` decimal(18,0) ,
 `idjenis` char(10) ,
 `namajenis` varchar(50) ,
 `idkategori` char(10) ,
 `namakategori` varchar(50) ,
 `qty` decimal(18,0) ,
 `harga` decimal(18,0) ,
 `totalharga` decimal(18,0) 
)*/;

/*Table structure for table `v_desa` */

DROP TABLE IF EXISTS `v_desa`;

/*!50001 DROP VIEW IF EXISTS `v_desa` */;
/*!50001 DROP TABLE IF EXISTS `v_desa` */;

/*!50001 CREATE TABLE  `v_desa`(
 `iddesa` char(10) ,
 `idkabupaten` char(10) ,
 `namakabupaten` varchar(50) ,
 `idkecamatan` char(10) ,
 `namakecamatan` varchar(50) ,
 `namadesa` varchar(50) ,
 `totaltarif` decimal(18,0) ,
 `statusaktif` enum('Aktif','Tidak Aktif') 
)*/;

/*Table structure for table `v_jadwal` */

DROP TABLE IF EXISTS `v_jadwal`;

/*!50001 DROP VIEW IF EXISTS `v_jadwal` */;
/*!50001 DROP TABLE IF EXISTS `v_jadwal` */;

/*!50001 CREATE TABLE  `v_jadwal`(
 `idjadwal` char(10) ,
 `namajadwal` varchar(50) ,
 `keterangan` varchar(255) ,
 `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat') ,
 `jamawal` varchar(20) ,
 `jamakhir` varchar(20) ,
 `statusaktif` enum('Aktif','Tidak Aktif') ,
 `kuota` int(11) ,
 `idpengguna` char(10) ,
 `namapengguna` varchar(50) 
)*/;

/*Table structure for table `v_jadwalboking` */

DROP TABLE IF EXISTS `v_jadwalboking`;

/*!50001 DROP VIEW IF EXISTS `v_jadwalboking` */;
/*!50001 DROP TABLE IF EXISTS `v_jadwalboking` */;

/*!50001 CREATE TABLE  `v_jadwalboking`(
 `idjadwalboking` char(10) ,
 `tgljadwalboking` date ,
 `idjadwal` char(10) ,
 `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat') ,
 `jamawal` varchar(20) ,
 `jamakhir` varchar(20) ,
 `idpelanggan` char(10) ,
 `namapelanggan` varchar(50) ,
 `keterangan` text ,
 `status` enum('Menunggu','Sudah Selesai','Ditolak') 
)*/;

/*Table structure for table `v_kecamatan` */

DROP TABLE IF EXISTS `v_kecamatan`;

/*!50001 DROP VIEW IF EXISTS `v_kecamatan` */;
/*!50001 DROP TABLE IF EXISTS `v_kecamatan` */;

/*!50001 CREATE TABLE  `v_kecamatan`(
 `idkecamatan` char(10) ,
 `idkabupaten` char(10) ,
 `namakabupaten` varchar(50) ,
 `tarifkabupaten` decimal(18,0) ,
 `namakecamatan` varchar(50) ,
 `tarifkecamatan` decimal(18,0) ,
 `totaltarif` decimal(18,0) ,
 `statusaktif` enum('Aktif','Tidak Aktif') 
)*/;

/*Table structure for table `v_pembayaran` */

DROP TABLE IF EXISTS `v_pembayaran`;

/*!50001 DROP VIEW IF EXISTS `v_pembayaran` */;
/*!50001 DROP TABLE IF EXISTS `v_pembayaran` */;

/*!50001 CREATE TABLE  `v_pembayaran`(
 `idpembayaran` char(10) ,
 `tglpembayaran` datetime ,
 `keterangan` varchar(255) ,
 `idpemesanan` char(10) ,
 `tglpemesanan` datetime ,
 `idpelanggan` char(10) ,
 `namapelanggan` varchar(50) ,
 `notelp` varchar(20) ,
 `email` varchar(50) ,
 `totalharga` decimal(40,0) ,
 `statuslunas` enum('Belum Lunas','Sudah Lunas') ,
 `metodepembayaran` enum('COD','Via Bank','Tunai') ,
 `idbank` char(10) ,
 `namabank` varchar(50) ,
 `atasnama` varchar(50) ,
 `norekening` varchar(20) ,
 `fotobank` varchar(255) ,
 `fotobuktipembayaran` varchar(255) ,
 `jumlahpembayaran` decimal(18,0) ,
 `statuskonfirmasi` enum('Dikonfirmasi','Ditolak','Menunggu') ,
 `tglkonfirmasi` datetime ,
 `idkonfirmasi` char(10) ,
 `namapengguna` varchar(50) 
)*/;

/*Table structure for table `v_pembelian` */

DROP TABLE IF EXISTS `v_pembelian`;

/*!50001 DROP VIEW IF EXISTS `v_pembelian` */;
/*!50001 DROP TABLE IF EXISTS `v_pembelian` */;

/*!50001 CREATE TABLE  `v_pembelian`(
 `idpembelian` char(10) ,
 `tglpembelian` date ,
 `nostruk` varchar(50) ,
 `keterangan` varchar(200) ,
 `foto` varchar(255) ,
 `idsupplier` char(10) ,
 `namasupplier` varchar(100) ,
 `totalharga` decimal(40,0) ,
 `idpengguna` char(10) ,
 `namapengguna` varchar(50) ,
 `tglinsert` datetime ,
 `tglupdate` datetime ,
 `idpengadaan` char(10) ,
 `tglpengadaan` date 
)*/;

/*Table structure for table `v_pembelian_detil` */

DROP TABLE IF EXISTS `v_pembelian_detil`;

/*!50001 DROP VIEW IF EXISTS `v_pembelian_detil` */;
/*!50001 DROP TABLE IF EXISTS `v_pembelian_detil` */;

/*!50001 CREATE TABLE  `v_pembelian_detil`(
 `idpembelian` char(10) ,
 `tglpembelian` date ,
 `nostruk` varchar(50) ,
 `idproduk` char(10) ,
 `namaproduk` varchar(50) ,
 `satuan` varchar(50) ,
 `stok` decimal(18,0) ,
 `idkategori` char(10) ,
 `namakategori` varchar(50) ,
 `qty` decimal(18,0) ,
 `harga` decimal(18,0) ,
 `totalharga` decimal(18,0) 
)*/;

/*Table structure for table `v_pemesanan` */

DROP TABLE IF EXISTS `v_pemesanan`;

/*!50001 DROP VIEW IF EXISTS `v_pemesanan` */;
/*!50001 DROP TABLE IF EXISTS `v_pemesanan` */;

/*!50001 CREATE TABLE  `v_pemesanan`(
 `idpemesanan` char(10) ,
 `tglpemesanan` datetime ,
 `keterangan` varchar(255) ,
 `idpelanggan` char(10) ,
 `namapelanggan` varchar(50) ,
 `notelp` varchar(20) ,
 `email` varchar(50) ,
 `foto` varchar(255) ,
 `negara` varchar(50) ,
 `provinsi` varchar(50) ,
 `kabupaten` varchar(50) ,
 `kecamatan` varchar(50) ,
 `kelurahan` varchar(50) ,
 `alamat` varchar(200) ,
 `kodepos` varchar(10) ,
 `totalharga` decimal(40,0) ,
 `totalpembayaran` decimal(18,0) ,
 `statuslunas` enum('Belum Lunas','Sudah Lunas') ,
 `qrcode` char(14) ,
 `idkonfirmasi` char(10) ,
 `namapengguna` varchar(50) ,
 `tglkonfirmasi` datetime ,
 `statuskonfirmasi` enum('Dikonfirmasi','Ditolak','Menunggu') ,
 `informasipemesanan` varchar(255) ,
 `iddesa` char(10) ,
 `totaltarif` decimal(18,0) ,
 `idekspedisi` char(10) ,
 `namaekspedisi` varchar(50) ,
 `noresi` varchar(30) 
)*/;

/*Table structure for table `v_pemesanandetil` */

DROP TABLE IF EXISTS `v_pemesanandetil`;

/*!50001 DROP VIEW IF EXISTS `v_pemesanandetil` */;
/*!50001 DROP TABLE IF EXISTS `v_pemesanandetil` */;

/*!50001 CREATE TABLE  `v_pemesanandetil`(
 `idpemesanan` char(10) ,
 `tglpemesanan` datetime ,
 `idproduk` char(10) ,
 `idkategori` char(10) ,
 `namakategori` varchar(50) ,
 `foto` varchar(255) ,
 `namaproduk` varchar(50) ,
 `satuan` varchar(50) ,
 `qty` int(11) ,
 `hargamodal` decimal(18,0) ,
 `hargajual` decimal(18,0) ,
 `totalharga` decimal(18,0) ,
 `statuskonfirmasi` enum('Dikonfirmasi','Ditolak','Menunggu') ,
 `statuslunas` enum('Belum Lunas','Sudah Lunas') 
)*/;

/*Table structure for table `v_pengadaan` */

DROP TABLE IF EXISTS `v_pengadaan`;

/*!50001 DROP VIEW IF EXISTS `v_pengadaan` */;
/*!50001 DROP TABLE IF EXISTS `v_pengadaan` */;

/*!50001 CREATE TABLE  `v_pengadaan`(
 `idpengadaan` char(10) ,
 `tglpengadaan` date ,
 `idsupplier` char(10) ,
 `namasupplier` varchar(100) ,
 `keterangan` text ,
 `totalharga` decimal(40,0) ,
 `tglinsert` datetime ,
 `tglupdate` datetime ,
 `idpengguna` char(10) ,
 `namapengguna` varchar(50) ,
 `statuskonfirmasi` enum('Dikonfirmasi','Ditolak','Menunggu') ,
 `tglkonfirmasi` datetime ,
 `idkonfirmasi` char(10) ,
 `namakonfirmasi` varchar(50) 
)*/;

/*Table structure for table `v_pengadaan_detil` */

DROP TABLE IF EXISTS `v_pengadaan_detil`;

/*!50001 DROP VIEW IF EXISTS `v_pengadaan_detil` */;
/*!50001 DROP TABLE IF EXISTS `v_pengadaan_detil` */;

/*!50001 CREATE TABLE  `v_pengadaan_detil`(
 `idpengadaan` char(10) ,
 `tglpengadaan` date ,
 `idproduk` char(10) ,
 `namaproduk` varchar(50) ,
 `satuan` varchar(50) ,
 `stok` decimal(18,0) ,
 `idkategori` char(10) ,
 `namakategori` varchar(50) ,
 `qty` decimal(18,0) ,
 `harga` decimal(18,0) ,
 `totalharga` decimal(18,0) 
)*/;

/*Table structure for table `v_penjualan` */

DROP TABLE IF EXISTS `v_penjualan`;

/*!50001 DROP VIEW IF EXISTS `v_penjualan` */;
/*!50001 DROP TABLE IF EXISTS `v_penjualan` */;

/*!50001 CREATE TABLE  `v_penjualan`(
 `idpenjualan` char(10) ,
 `tglpenjualan` datetime ,
 `keterangan` varchar(255) ,
 `idpelanggan` char(10) ,
 `namapelanggan` varchar(50) ,
 `notelp` varchar(20) ,
 `email` varchar(50) ,
 `alamat` varchar(200) ,
 `kodepos` varchar(10) ,
 `foto` varchar(255) ,
 `totalharga` decimal(40,0) ,
 `totalhargaservice` decimal(40,0) ,
 `diskon` decimal(18,0) ,
 `grandtotal` decimal(18,0) ,
 `qrcode` char(14) ,
 `tglinsert` datetime ,
 `tglupdate` datetime ,
 `idpengguna` char(10) ,
 `namapengguna` varchar(50) ,
 `carapembayaran` enum('Tunai','Non Tunai') ,
 `statuspemesanan` enum('Sedang Proses','Sudah Selesai') ,
 `statuspembayaran` enum('Belum Bayar','Sudah Bayar') ,
 `idkoki` char(10) ,
 `idkasir` char(10) 
)*/;

/*Table structure for table `v_penjualandetil` */

DROP TABLE IF EXISTS `v_penjualandetil`;

/*!50001 DROP VIEW IF EXISTS `v_penjualandetil` */;
/*!50001 DROP TABLE IF EXISTS `v_penjualandetil` */;

/*!50001 CREATE TABLE  `v_penjualandetil`(
 `idpenjualan` char(10) ,
 `tglpenjualan` datetime ,
 `idproduk` char(10) ,
 `qrcode` char(20) ,
 `idkategori` char(10) ,
 `namakategori` varchar(50) ,
 `namaproduk` varchar(50) ,
 `satuan` varchar(50) ,
 `qty` int(11) ,
 `qtyretur` decimal(32,0) ,
 `hargamodal` decimal(18,0) ,
 `hargajual` decimal(18,0) ,
 `diskon` decimal(18,0) ,
 `totalharga` decimal(18,0) ,
 `foto` varchar(255) 
)*/;

/*Table structure for table `v_penjualandetilservice` */

DROP TABLE IF EXISTS `v_penjualandetilservice`;

/*!50001 DROP VIEW IF EXISTS `v_penjualandetilservice` */;
/*!50001 DROP TABLE IF EXISTS `v_penjualandetilservice` */;

/*!50001 CREATE TABLE  `v_penjualandetilservice`(
 `idpenjualan` char(10) ,
 `tglpenjualan` datetime ,
 `idtarif` char(10) ,
 `namatarif` varchar(50) ,
 `harga` decimal(18,0) 
)*/;

/*Table structure for table `v_penjualandetil_global` */

DROP TABLE IF EXISTS `v_penjualandetil_global`;

/*!50001 DROP VIEW IF EXISTS `v_penjualandetil_global` */;
/*!50001 DROP TABLE IF EXISTS `v_penjualandetil_global` */;

/*!50001 CREATE TABLE  `v_penjualandetil_global`(
 `id` varchar(13) ,
 `status` varchar(9) ,
 `tanggal` datetime ,
 `idproduk` char(10) ,
 `idkategori` char(10) ,
 `namakategori` varchar(50) ,
 `namaproduk` varchar(50) ,
 `satuan` varchar(50) ,
 `qty` int(11) ,
 `hargamodal` decimal(18,0) ,
 `hargajual` decimal(18,0) ,
 `diskon` decimal(18,0) ,
 `totalharga` decimal(18,0) ,
 `foto` varchar(255) 
)*/;

/*Table structure for table `v_penjualan_global` */

DROP TABLE IF EXISTS `v_penjualan_global`;

/*!50001 DROP VIEW IF EXISTS `v_penjualan_global` */;
/*!50001 DROP TABLE IF EXISTS `v_penjualan_global` */;

/*!50001 CREATE TABLE  `v_penjualan_global`(
 `id` varchar(13) ,
 `status` varchar(9) ,
 `tanggal` datetime ,
 `totalharga_modal` decimal(50,0) ,
 `totalharga_jual` decimal(50,0) ,
 `totalharga_bersih` decimal(51,0) ,
 `totalharga_diskon` decimal(40,0) ,
 `totalharga` decimal(40,0) 
)*/;

/*Table structure for table `v_perencanaan` */

DROP TABLE IF EXISTS `v_perencanaan`;

/*!50001 DROP VIEW IF EXISTS `v_perencanaan` */;
/*!50001 DROP TABLE IF EXISTS `v_perencanaan` */;

/*!50001 CREATE TABLE  `v_perencanaan`(
 `idperencanaan` char(10) ,
 `tglperencanaan` date ,
 `jenis` enum('Promosi','Kerja Sama Dengan Distributor','Kerja Sama Denga Pelanggan') ,
 `nama` varchar(100) ,
 `tujuan` varchar(100) ,
 `keterangan` text ,
 `foto` varchar(255) ,
 `tglinsert` datetime ,
 `tglupdate` datetime ,
 `idpengguna` char(10) ,
 `namapengguna` varchar(50) ,
 `statusperencanaan` varchar(15) 
)*/;

/*Table structure for table `v_perencanaansurat` */

DROP TABLE IF EXISTS `v_perencanaansurat`;

/*!50001 DROP VIEW IF EXISTS `v_perencanaansurat` */;
/*!50001 DROP TABLE IF EXISTS `v_perencanaansurat` */;

/*!50001 CREATE TABLE  `v_perencanaansurat`(
 `idperencanaansurat` char(10) ,
 `idperencanaan` char(10) ,
 `tglperencanaan` date ,
 `jenis` enum('Promosi','Kerja Sama Dengan Distributor','Kerja Sama Denga Pelanggan') ,
 `nama` varchar(100) ,
 `tujuan` varchar(100) ,
 `keteranganperencanaan` text ,
 `foto` varchar(255) ,
 `namapimpinan` varchar(50) ,
 `levelpimpinan` varchar(7) ,
 `tglperencanaansurat` date ,
 `namaperusahaan` varchar(100) ,
 `perihal` varchar(100) ,
 `alamat` text ,
 `kota` varchar(50) ,
 `kodepos` varchar(10) ,
 `keterangan` text ,
 `tglinsert` datetime ,
 `tglupdate` datetime ,
 `idpengguna` char(10) ,
 `namapengguna` varchar(50) 
)*/;

/*Table structure for table `v_produk` */

DROP TABLE IF EXISTS `v_produk`;

/*!50001 DROP VIEW IF EXISTS `v_produk` */;
/*!50001 DROP TABLE IF EXISTS `v_produk` */;

/*!50001 CREATE TABLE  `v_produk`(
 `idproduk` char(10) ,
 `idkategori` char(10) ,
 `namakategori` varchar(50) ,
 `urisegment_kategori` varchar(50) ,
 `namaproduk` varchar(50) ,
 `keterangan` text ,
 `stok` decimal(18,0) ,
 `stokminimum` decimal(18,0) ,
 `satuan` varchar(50) ,
 `hargabeli` decimal(18,0) ,
 `hargajual` decimal(18,0) ,
 `foto` varchar(255) ,
 `statusaktif` enum('Aktif','Tidak Aktif') ,
 `qrcode` char(20) ,
 `urisegment` varchar(50) 
)*/;

/*Table structure for table `v_profil` */

DROP TABLE IF EXISTS `v_profil`;

/*!50001 DROP VIEW IF EXISTS `v_profil` */;
/*!50001 DROP TABLE IF EXISTS `v_profil` */;

/*!50001 CREATE TABLE  `v_profil`(
 `id` int(1) ,
 `namaperusahaan` varchar(50) ,
 `tentangkami` text ,
 `logoperusahaan` varchar(255) ,
 `fotoperusahaan` varchar(255) ,
 `tglupdate` datetime ,
 `idpengguna` char(10) ,
 `namapengguna` varchar(50) 
)*/;

/*Table structure for table `v_profil_blog` */

DROP TABLE IF EXISTS `v_profil_blog`;

/*!50001 DROP VIEW IF EXISTS `v_profil_blog` */;
/*!50001 DROP TABLE IF EXISTS `v_profil_blog` */;

/*!50001 CREATE TABLE  `v_profil_blog`(
 `idblog` char(10) ,
 `tglblog` datetime ,
 `judul` varchar(100) ,
 `foto` varchar(255) ,
 `konten` text ,
 `urlblog` varchar(255) ,
 `statusaktif` enum('Aktif','Tidak Aktif') ,
 `tglinsert` datetime ,
 `tglupdate` datetime ,
 `idpengguna` char(10) ,
 `namapengguna` varchar(50) ,
 `urisegment` varchar(100) 
)*/;

/*Table structure for table `v_profil_galeri` */

DROP TABLE IF EXISTS `v_profil_galeri`;

/*!50001 DROP VIEW IF EXISTS `v_profil_galeri` */;
/*!50001 DROP TABLE IF EXISTS `v_profil_galeri` */;

/*!50001 CREATE TABLE  `v_profil_galeri`(
 `idgaleri` char(10) ,
 `foto` varchar(255) ,
 `keterangan` text ,
 `tglinsert` datetime ,
 `tglupdate` datetime ,
 `idpengguna` char(10) ,
 `namapengguna` varchar(50) 
)*/;

/*Table structure for table `v_profil_kontakkami` */

DROP TABLE IF EXISTS `v_profil_kontakkami`;

/*!50001 DROP VIEW IF EXISTS `v_profil_kontakkami` */;
/*!50001 DROP TABLE IF EXISTS `v_profil_kontakkami` */;

/*!50001 CREATE TABLE  `v_profil_kontakkami`(
 `id` int(1) ,
 `email` varchar(50) ,
 `notelp` varchar(20) ,
 `nowa` varchar(20) ,
 `alamat` varchar(255) ,
 `iframegoogle` text ,
 `tglupdate` datetime ,
 `idpengguna` char(10) ,
 `namapengguna` varchar(50) 
)*/;

/*Table structure for table `v_profil_layanan` */

DROP TABLE IF EXISTS `v_profil_layanan`;

/*!50001 DROP VIEW IF EXISTS `v_profil_layanan` */;
/*!50001 DROP TABLE IF EXISTS `v_profil_layanan` */;

/*!50001 CREATE TABLE  `v_profil_layanan`(
 `idlayanan` char(10) ,
 `judullayanan` varchar(50) ,
 `keterangan` text ,
 `icon` text ,
 `foto` varchar(255) ,
 `statusaktif` enum('Aktif','Tidak Aktif') ,
 `tglinsert` datetime ,
 `tglupdate` datetime ,
 `idpengguna` char(10) ,
 `namapengguna` varchar(50) 
)*/;

/*Table structure for table `v_profil_slider` */

DROP TABLE IF EXISTS `v_profil_slider`;

/*!50001 DROP VIEW IF EXISTS `v_profil_slider` */;
/*!50001 DROP TABLE IF EXISTS `v_profil_slider` */;

/*!50001 CREATE TABLE  `v_profil_slider`(
 `idslider` char(10) ,
 `judul` varchar(100) ,
 `keterangan` varchar(255) ,
 `foto` varchar(255) ,
 `url` text ,
 `statusaktif` enum('Aktif','Tidak Aktif') ,
 `tglinsert` datetime ,
 `tglupdate` datetime ,
 `idpengguna` char(10) ,
 `namapengguna` varchar(50) 
)*/;

/*Table structure for table `v_profil_sosialmedia` */

DROP TABLE IF EXISTS `v_profil_sosialmedia`;

/*!50001 DROP VIEW IF EXISTS `v_profil_sosialmedia` */;
/*!50001 DROP TABLE IF EXISTS `v_profil_sosialmedia` */;

/*!50001 CREATE TABLE  `v_profil_sosialmedia`(
 `idsosialmedia` char(10) ,
 `nama_sosialmedia` varchar(50) ,
 `foto` varchar(255) ,
 `url` text ,
 `tglinsert` datetime ,
 `tglupdate` datetime ,
 `idpengguna` char(10) ,
 `namapengguna` varchar(50) 
)*/;

/*Table structure for table `v_profil_testimoni` */

DROP TABLE IF EXISTS `v_profil_testimoni`;

/*!50001 DROP VIEW IF EXISTS `v_profil_testimoni` */;
/*!50001 DROP TABLE IF EXISTS `v_profil_testimoni` */;

/*!50001 CREATE TABLE  `v_profil_testimoni`(
 `idtestimoni` char(10) ,
 `tgltestimoni` date ,
 `keterangan` varchar(255) ,
 `foto` varchar(255) ,
 `tglinsert` datetime ,
 `tglupdate` datetime ,
 `idpengguna` char(10) ,
 `namapengguna` varchar(50) 
)*/;

/*Table structure for table `v_profil_video` */

DROP TABLE IF EXISTS `v_profil_video`;

/*!50001 DROP VIEW IF EXISTS `v_profil_video` */;
/*!50001 DROP TABLE IF EXISTS `v_profil_video` */;

/*!50001 CREATE TABLE  `v_profil_video`(
 `idvideo` char(10) ,
 `judul` varchar(100) ,
 `file` varchar(255) ,
 `keterangan` text ,
 `urisegment` varchar(100) ,
 `tglinsert` datetime ,
 `tglupdate` datetime ,
 `idpengguna` char(10) ,
 `namapengguna` varchar(50) 
)*/;

/*Table structure for table `v_returpenjualan` */

DROP TABLE IF EXISTS `v_returpenjualan`;

/*!50001 DROP VIEW IF EXISTS `v_returpenjualan` */;
/*!50001 DROP TABLE IF EXISTS `v_returpenjualan` */;

/*!50001 CREATE TABLE  `v_returpenjualan`(
 `idreturpenjualan` char(10) ,
 `tglreturpenjualan` datetime ,
 `idpenjualan` char(10) ,
 `tglpenjualan` datetime ,
 `keterangan` text ,
 `totalharga` decimal(40,0) ,
 `tglinsert` datetime ,
 `tglupdate` datetime ,
 `idpengguna` char(10) ,
 `namapengguna` varchar(50) 
)*/;

/*Table structure for table `v_returpenjualan_detil` */

DROP TABLE IF EXISTS `v_returpenjualan_detil`;

/*!50001 DROP VIEW IF EXISTS `v_returpenjualan_detil` */;
/*!50001 DROP TABLE IF EXISTS `v_returpenjualan_detil` */;

/*!50001 CREATE TABLE  `v_returpenjualan_detil`(
 `idreturpenjualan` char(10) ,
 `tglreturpenjualan` datetime ,
 `idpenjualan` char(10) ,
 `idproduk` char(10) ,
 `namaproduk` varchar(50) ,
 `satuan` varchar(50) ,
 `stok` decimal(18,0) ,
 `idkategori` char(10) ,
 `namakategori` varchar(50) ,
 `qty` int(11) ,
 `harga` decimal(18,0) ,
 `totalharga` decimal(18,0) 
)*/;

/*View structure for view v_barang */

/*!50001 DROP TABLE IF EXISTS `v_barang` */;
/*!50001 DROP VIEW IF EXISTS `v_barang` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_barang` AS select `barang`.`idbarang` AS `idbarang`,`barang`.`namabarang` AS `namabarang`,`barang`.`idjenis` AS `idjenis`,`jenis`.`nama` AS `nama`,`barang`.`satuan` AS `satuan`,`barang`.`harga` AS `harga`,`barang`.`stok` AS `stok`,`barang`.`foto` AS `foto`,`barang`.`statusaktif` AS `statusaktif`,`barang`.`idkategori` AS `idkategori`,`kategori`.`namakategori` AS `namakategori` from ((`barang` join `kategori` on(`barang`.`idkategori` = `kategori`.`idkategori`)) join `jenis` on(`barang`.`idjenis` = `jenis`.`idjenis`)) */;

/*View structure for view v_barangkeluar */

/*!50001 DROP TABLE IF EXISTS `v_barangkeluar` */;
/*!50001 DROP VIEW IF EXISTS `v_barangkeluar` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_barangkeluar` AS select `barangkeluar`.`idbarangkeluar` AS `idbarangkeluar`,`barangkeluar`.`tglbarangkeluar` AS `tglbarangkeluar`,`barangkeluar`.`keterangan` AS `keterangan`,(select sum(`barangkeluar_detail`.`totalharga`) from `barangkeluar_detail` where `barangkeluar_detail`.`idbarangkeluar` = `barangkeluar`.`idbarangkeluar`) AS `totalharga`,`barangkeluar`.`tglinsert` AS `tglinsert`,`barangkeluar`.`tglupdate` AS `tglupdate`,`barangkeluar`.`idpengguna` AS `idpengguna`,`pengguna`.`namapengguna` AS `namapengguna` from (`barangkeluar` join `pengguna` on(`barangkeluar`.`idpengguna` = `pengguna`.`idpengguna`)) */;

/*View structure for view v_barangkeluar_detail */

/*!50001 DROP TABLE IF EXISTS `v_barangkeluar_detail` */;
/*!50001 DROP VIEW IF EXISTS `v_barangkeluar_detail` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_barangkeluar_detail` AS select `barangkeluar_detail`.`idbarangkeluar` AS `idbarangkeluar`,`barangkeluar`.`tglbarangkeluar` AS `tglbarangkeluar`,`barangkeluar_detail`.`idbarang` AS `idbarang`,`barang`.`namabarang` AS `namabarang`,`barang`.`satuan` AS `satuan`,`barang`.`stok` AS `stok`,`barang`.`idjenis` AS `idjenis`,`jenis`.`nama` AS `namajenis`,`barangkeluar_detail`.`qty` AS `qty`,`barangkeluar_detail`.`harga` AS `harga`,`barangkeluar_detail`.`totalharga` AS `totalharga` from (((`barangkeluar_detail` join `barangkeluar` on(`barangkeluar_detail`.`idbarangkeluar` = `barangkeluar`.`idbarangkeluar`)) join `barang` on(`barang`.`idbarang` = `barangkeluar_detail`.`idbarang`)) join `jenis` on(`barang`.`idjenis` = `jenis`.`idjenis`)) */;

/*View structure for view v_barangmasuk */

/*!50001 DROP TABLE IF EXISTS `v_barangmasuk` */;
/*!50001 DROP VIEW IF EXISTS `v_barangmasuk` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_barangmasuk` AS select `barangmasuk`.`idbarangmasuk` AS `idbarangmasuk`,`barangmasuk`.`tglbarangmasuk` AS `tglbarangmasuk`,`barangmasuk`.`nostruk` AS `nostruk`,`barangmasuk`.`keterangan` AS `keterangan`,`barangmasuk`.`foto` AS `foto`,`barangmasuk`.`idsupplier` AS `idsupplier`,`supplier`.`namasupplier` AS `namasupplier`,(select sum(`barangmasuk_detail`.`totalharga`) from `barangmasuk_detail` where `barangmasuk_detail`.`idbarangmasuk` = `barangmasuk`.`idbarangmasuk`) AS `totalharga`,`barangmasuk`.`idpengguna` AS `idpengguna`,`pengguna`.`namapengguna` AS `namapengguna`,`barangmasuk`.`tglinsert` AS `tglinsert`,`barangmasuk`.`tglupdate` AS `tglupdate` from ((`barangmasuk` join `pengguna` on(`barangmasuk`.`idpengguna` = `pengguna`.`idpengguna`)) join `supplier` on(`barangmasuk`.`idsupplier` = `supplier`.`idsupplier`)) */;

/*View structure for view v_barangmasuk_detail */

/*!50001 DROP TABLE IF EXISTS `v_barangmasuk_detail` */;
/*!50001 DROP VIEW IF EXISTS `v_barangmasuk_detail` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_barangmasuk_detail` AS select `barangmasuk_detail`.`idbarangmasuk` AS `idbarangmasuk`,`barangmasuk`.`tglbarangmasuk` AS `tglbarangmasuk`,`barangmasuk`.`nostruk` AS `nostruk`,`barangmasuk_detail`.`idbarang` AS `idbarang`,`barang`.`namabarang` AS `namabarang`,`barang`.`satuan` AS `satuan`,`barang`.`stok` AS `stok`,`barang`.`idjenis` AS `idjenis`,`jenis`.`nama` AS `namajenis`,`barang`.`idkategori` AS `idkategori`,`kategori`.`namakategori` AS `namakategori`,`barangmasuk_detail`.`qty` AS `qty`,`barangmasuk_detail`.`harga` AS `harga`,`barangmasuk_detail`.`totalharga` AS `totalharga` from ((((`barangmasuk_detail` join `barangmasuk` on(`barangmasuk_detail`.`idbarangmasuk` = `barangmasuk`.`idbarangmasuk`)) join `barang` on(`barangmasuk_detail`.`idbarang` = `barang`.`idbarang`)) join `jenis` on(`barang`.`idjenis` = `jenis`.`idjenis`)) join `kategori` on(`barang`.`idkategori` = `kategori`.`idkategori`)) */;

/*View structure for view v_desa */

/*!50001 DROP TABLE IF EXISTS `v_desa` */;
/*!50001 DROP VIEW IF EXISTS `v_desa` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_desa` AS select `desa`.`iddesa` AS `iddesa`,`kabupaten`.`idkabupaten` AS `idkabupaten`,`kabupaten`.`namakabupaten` AS `namakabupaten`,`kecamatan`.`idkecamatan` AS `idkecamatan`,`kecamatan`.`namakecamatan` AS `namakecamatan`,`desa`.`namadesa` AS `namadesa`,`kecamatan`.`totaltarif` AS `totaltarif`,`desa`.`statusaktif` AS `statusaktif` from ((`desa` join `kecamatan` on(`desa`.`idkecamatan` = `kecamatan`.`idkecamatan`)) join `kabupaten` on(`kecamatan`.`idkabupaten` = `kabupaten`.`idkabupaten`)) */;

/*View structure for view v_jadwal */

/*!50001 DROP TABLE IF EXISTS `v_jadwal` */;
/*!50001 DROP VIEW IF EXISTS `v_jadwal` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_jadwal` AS select `jadwal`.`idjadwal` AS `idjadwal`,`jadwal`.`namajadwal` AS `namajadwal`,`jadwal`.`keterangan` AS `keterangan`,`jadwal`.`hari` AS `hari`,`jadwal`.`jamawal` AS `jamawal`,`jadwal`.`jamakhir` AS `jamakhir`,`jadwal`.`statusaktif` AS `statusaktif`,`jadwal`.`kuota` AS `kuota`,`jadwal`.`idpengguna` AS `idpengguna`,`pengguna`.`namapengguna` AS `namapengguna` from (`jadwal` join `pengguna` on(`jadwal`.`idpengguna` = `pengguna`.`idpengguna`)) */;

/*View structure for view v_jadwalboking */

/*!50001 DROP TABLE IF EXISTS `v_jadwalboking` */;
/*!50001 DROP VIEW IF EXISTS `v_jadwalboking` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_jadwalboking` AS select `jadwalboking`.`idjadwalboking` AS `idjadwalboking`,`jadwalboking`.`tgljadwalboking` AS `tgljadwalboking`,`jadwalboking`.`idjadwal` AS `idjadwal`,`jadwal`.`hari` AS `hari`,`jadwal`.`jamawal` AS `jamawal`,`jadwal`.`jamakhir` AS `jamakhir`,`jadwalboking`.`idpelanggan` AS `idpelanggan`,`pelanggan`.`namapelanggan` AS `namapelanggan`,`jadwalboking`.`keterangan` AS `keterangan`,`jadwalboking`.`status` AS `status` from ((`jadwalboking` join `jadwal` on(`jadwalboking`.`idjadwal` = `jadwal`.`idjadwal`)) join `pelanggan` on(`jadwalboking`.`idpelanggan` = `pelanggan`.`idpelanggan`)) */;

/*View structure for view v_kecamatan */

/*!50001 DROP TABLE IF EXISTS `v_kecamatan` */;
/*!50001 DROP VIEW IF EXISTS `v_kecamatan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_kecamatan` AS select `kecamatan`.`idkecamatan` AS `idkecamatan`,`kecamatan`.`idkabupaten` AS `idkabupaten`,`kabupaten`.`namakabupaten` AS `namakabupaten`,`kabupaten`.`tarifkabupaten` AS `tarifkabupaten`,`kecamatan`.`namakecamatan` AS `namakecamatan`,`kecamatan`.`tarifkecamatan` AS `tarifkecamatan`,`kecamatan`.`totaltarif` AS `totaltarif`,`kecamatan`.`statusaktif` AS `statusaktif` from (`kecamatan` join `kabupaten` on(`kecamatan`.`idkabupaten` = `kabupaten`.`idkabupaten`)) */;

/*View structure for view v_pembayaran */

/*!50001 DROP TABLE IF EXISTS `v_pembayaran` */;
/*!50001 DROP VIEW IF EXISTS `v_pembayaran` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pembayaran` AS select `pembayaran`.`idpembayaran` AS `idpembayaran`,`pembayaran`.`tglpembayaran` AS `tglpembayaran`,`pembayaran`.`keterangan` AS `keterangan`,`pembayaran`.`idpemesanan` AS `idpemesanan`,`v_pemesanan`.`tglpemesanan` AS `tglpemesanan`,`v_pemesanan`.`idpelanggan` AS `idpelanggan`,`v_pemesanan`.`namapelanggan` AS `namapelanggan`,`v_pemesanan`.`notelp` AS `notelp`,`v_pemesanan`.`email` AS `email`,`v_pemesanan`.`totalharga` AS `totalharga`,`v_pemesanan`.`statuslunas` AS `statuslunas`,`pembayaran`.`metodepembayaran` AS `metodepembayaran`,`pembayaran`.`idbank` AS `idbank`,`bank`.`namabank` AS `namabank`,`bank`.`atasnama` AS `atasnama`,`bank`.`norekening` AS `norekening`,`bank`.`foto` AS `fotobank`,`pembayaran`.`fotobuktipembayaran` AS `fotobuktipembayaran`,`pembayaran`.`jumlahpembayaran` AS `jumlahpembayaran`,`pembayaran`.`statuskonfirmasi` AS `statuskonfirmasi`,`pembayaran`.`tglkonfirmasi` AS `tglkonfirmasi`,`pembayaran`.`idkonfirmasi` AS `idkonfirmasi`,`pengguna`.`namapengguna` AS `namapengguna` from (((`pembayaran` join `v_pemesanan` on(`pembayaran`.`idpemesanan` = `v_pemesanan`.`idpemesanan`)) left join `bank` on(`bank`.`idbank` = `pembayaran`.`idbank`)) left join `pengguna` on(`pengguna`.`idpengguna` = `pembayaran`.`idkonfirmasi`)) */;

/*View structure for view v_pembelian */

/*!50001 DROP TABLE IF EXISTS `v_pembelian` */;
/*!50001 DROP VIEW IF EXISTS `v_pembelian` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pembelian` AS (select `pembelian`.`idpembelian` AS `idpembelian`,`pembelian`.`tglpembelian` AS `tglpembelian`,`pembelian`.`nostruk` AS `nostruk`,`pembelian`.`keterangan` AS `keterangan`,`pembelian`.`foto` AS `foto`,`pembelian`.`idsupplier` AS `idsupplier`,`supplier`.`namasupplier` AS `namasupplier`,(select sum(`pembelian_detil`.`totalharga`) from `pembelian_detil` where `pembelian_detil`.`idpembelian` = `pembelian`.`idpembelian`) AS `totalharga`,`pembelian`.`idpengguna` AS `idpengguna`,`pengguna`.`namapengguna` AS `namapengguna`,`pembelian`.`tglinsert` AS `tglinsert`,`pembelian`.`tglupdate` AS `tglupdate`,`pembelian`.`idpengadaan` AS `idpengadaan`,`pengadaan`.`tglpengadaan` AS `tglpengadaan` from (((`pembelian` join `pengguna` on(`pembelian`.`idpengguna` = `pengguna`.`idpengguna`)) join `supplier` on(`pembelian`.`idsupplier` = `supplier`.`idsupplier`)) left join `pengadaan` on(`pembelian`.`idpengadaan` = `pengadaan`.`idpengadaan`))) */;

/*View structure for view v_pembelian_detil */

/*!50001 DROP TABLE IF EXISTS `v_pembelian_detil` */;
/*!50001 DROP VIEW IF EXISTS `v_pembelian_detil` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pembelian_detil` AS (select `pembelian_detil`.`idpembelian` AS `idpembelian`,`pembelian`.`tglpembelian` AS `tglpembelian`,`pembelian`.`nostruk` AS `nostruk`,`pembelian_detil`.`idproduk` AS `idproduk`,`produk`.`namaproduk` AS `namaproduk`,`produk`.`satuan` AS `satuan`,`produk`.`stok` AS `stok`,`produk`.`idkategori` AS `idkategori`,`kategori`.`namakategori` AS `namakategori`,`pembelian_detil`.`qty` AS `qty`,`pembelian_detil`.`harga` AS `harga`,`pembelian_detil`.`totalharga` AS `totalharga` from (((`pembelian_detil` join `pembelian` on(`pembelian_detil`.`idpembelian` = `pembelian`.`idpembelian`)) join `produk` on(`pembelian_detil`.`idproduk` = `produk`.`idproduk`)) join `kategori` on(`produk`.`idkategori` = `kategori`.`idkategori`))) */;

/*View structure for view v_pemesanan */

/*!50001 DROP TABLE IF EXISTS `v_pemesanan` */;
/*!50001 DROP VIEW IF EXISTS `v_pemesanan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pemesanan` AS select `pemesanan`.`idpemesanan` AS `idpemesanan`,`pemesanan`.`tglpemesanan` AS `tglpemesanan`,`pemesanan`.`keterangan` AS `keterangan`,`pemesanan`.`idpelanggan` AS `idpelanggan`,`pelanggan`.`namapelanggan` AS `namapelanggan`,`pelanggan`.`notelp` AS `notelp`,`pelanggan`.`email` AS `email`,`pelanggan`.`foto` AS `foto`,`pemesanan`.`negara` AS `negara`,`pemesanan`.`provinsi` AS `provinsi`,`pemesanan`.`kabupaten` AS `kabupaten`,`pemesanan`.`kecamatan` AS `kecamatan`,`pemesanan`.`kelurahan` AS `kelurahan`,`pemesanan`.`alamat` AS `alamat`,`pemesanan`.`kodepos` AS `kodepos`,(select ifnull(sum(`pemesanandetil`.`totalharga`),0) from `pemesanandetil` where `pemesanandetil`.`idpemesanan` = `pemesanan`.`idpemesanan`) AS `totalharga`,`pemesanan`.`totalpembayaran` AS `totalpembayaran`,`pemesanan`.`statuslunas` AS `statuslunas`,`pemesanan`.`qrcode` AS `qrcode`,`pemesanan`.`idkonfirmasi` AS `idkonfirmasi`,`pengguna`.`namapengguna` AS `namapengguna`,`pemesanan`.`tglkonfirmasi` AS `tglkonfirmasi`,`pemesanan`.`statuskonfirmasi` AS `statuskonfirmasi`,`pemesanan`.`informasipemesanan` AS `informasipemesanan`,`pemesanan`.`iddesa` AS `iddesa`,`v_desa`.`totaltarif` AS `totaltarif`,`pemesanan`.`idekspedisi` AS `idekspedisi`,`ekspedisi`.`namaekspedisi` AS `namaekspedisi`,`pemesanan`.`noresi` AS `noresi` from ((((`pemesanan` join `pelanggan` on(`pemesanan`.`idpelanggan` = `pelanggan`.`idpelanggan`)) left join `pengguna` on(`pengguna`.`idpengguna` = `pemesanan`.`idkonfirmasi`)) left join `v_desa` on(`pemesanan`.`iddesa` = `v_desa`.`iddesa`)) left join `ekspedisi` on(`pemesanan`.`idekspedisi` = `ekspedisi`.`idekspedisi`)) */;

/*View structure for view v_pemesanandetil */

/*!50001 DROP TABLE IF EXISTS `v_pemesanandetil` */;
/*!50001 DROP VIEW IF EXISTS `v_pemesanandetil` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pemesanandetil` AS select `pemesanandetil`.`idpemesanan` AS `idpemesanan`,`pemesanan`.`tglpemesanan` AS `tglpemesanan`,`pemesanandetil`.`idproduk` AS `idproduk`,`produk`.`idkategori` AS `idkategori`,`kategori`.`namakategori` AS `namakategori`,`produk`.`foto` AS `foto`,`produk`.`namaproduk` AS `namaproduk`,`produk`.`satuan` AS `satuan`,`pemesanandetil`.`qty` AS `qty`,`pemesanandetil`.`hargamodal` AS `hargamodal`,`pemesanandetil`.`hargajual` AS `hargajual`,`pemesanandetil`.`totalharga` AS `totalharga`,`pemesanan`.`statuskonfirmasi` AS `statuskonfirmasi`,`pemesanan`.`statuslunas` AS `statuslunas` from (((`pemesanandetil` join `pemesanan` on(`pemesanandetil`.`idpemesanan` = `pemesanan`.`idpemesanan`)) join `produk` on(`pemesanandetil`.`idproduk` = `produk`.`idproduk`)) join `kategori` on(`produk`.`idkategori` = `kategori`.`idkategori`)) */;

/*View structure for view v_pengadaan */

/*!50001 DROP TABLE IF EXISTS `v_pengadaan` */;
/*!50001 DROP VIEW IF EXISTS `v_pengadaan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pengadaan` AS select `pengadaan`.`idpengadaan` AS `idpengadaan`,`pengadaan`.`tglpengadaan` AS `tglpengadaan`,`pengadaan`.`idsupplier` AS `idsupplier`,`supplier`.`namasupplier` AS `namasupplier`,`pengadaan`.`keterangan` AS `keterangan`,(select ifnull(sum(`pengadaan_detil`.`totalharga`),0) AS `totalharga` from `pengadaan_detil` where `pengadaan_detil`.`idpengadaan` = `pengadaan`.`idpengadaan`) AS `totalharga`,`pengadaan`.`tglinsert` AS `tglinsert`,`pengadaan`.`tglupdate` AS `tglupdate`,`pengadaan`.`idpengguna` AS `idpengguna`,`pengguna`.`namapengguna` AS `namapengguna`,`pengadaan`.`statuskonfirmasi` AS `statuskonfirmasi`,`pengadaan`.`tglkonfirmasi` AS `tglkonfirmasi`,`pengadaan`.`idkonfirmasi` AS `idkonfirmasi`,`pengguna_1`.`namapengguna` AS `namakonfirmasi` from (((`supplier` join `pengadaan` on(`supplier`.`idsupplier` = `pengadaan`.`idsupplier`)) join `pengguna` on(`pengadaan`.`idpengguna` = `pengguna`.`idpengguna`)) left join `pengguna` `pengguna_1` on(`pengadaan`.`idkonfirmasi` = `pengguna_1`.`idpengguna`)) */;

/*View structure for view v_pengadaan_detil */

/*!50001 DROP TABLE IF EXISTS `v_pengadaan_detil` */;
/*!50001 DROP VIEW IF EXISTS `v_pengadaan_detil` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pengadaan_detil` AS select `pengadaan_detil`.`idpengadaan` AS `idpengadaan`,`pengadaan`.`tglpengadaan` AS `tglpengadaan`,`pengadaan_detil`.`idproduk` AS `idproduk`,`produk`.`namaproduk` AS `namaproduk`,`produk`.`satuan` AS `satuan`,`produk`.`stok` AS `stok`,`produk`.`idkategori` AS `idkategori`,`kategori`.`namakategori` AS `namakategori`,`pengadaan_detil`.`qty` AS `qty`,`pengadaan_detil`.`harga` AS `harga`,`pengadaan_detil`.`totalharga` AS `totalharga` from (((`pengadaan_detil` join `produk` on(`pengadaan_detil`.`idproduk` = `produk`.`idproduk`)) join `kategori` on(`produk`.`idkategori` = `kategori`.`idkategori`)) join `pengadaan` on(`pengadaan_detil`.`idpengadaan` = `pengadaan`.`idpengadaan`)) */;

/*View structure for view v_penjualan */

/*!50001 DROP TABLE IF EXISTS `v_penjualan` */;
/*!50001 DROP VIEW IF EXISTS `v_penjualan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_penjualan` AS select `z`.`idpenjualan` AS `idpenjualan`,`z`.`tglpenjualan` AS `tglpenjualan`,`z`.`keterangan` AS `keterangan`,`z`.`idpelanggan` AS `idpelanggan`,`z`.`namapelanggan` AS `namapelanggan`,`z`.`notelp` AS `notelp`,`z`.`email` AS `email`,`z`.`alamat` AS `alamat`,`z`.`kodepos` AS `kodepos`,`z`.`foto` AS `foto`,`z`.`totalharga` AS `totalharga`,`z`.`totalhargaservice` AS `totalhargaservice`,`z`.`diskon` AS `diskon`,`z`.`grandtotal` AS `grandtotal`,`z`.`qrcode` AS `qrcode`,`z`.`tglinsert` AS `tglinsert`,`z`.`tglupdate` AS `tglupdate`,`z`.`idpengguna` AS `idpengguna`,`z`.`namapengguna` AS `namapengguna`,`z`.`carapembayaran` AS `carapembayaran`,`z`.`statuspemesanan` AS `statuspemesanan`,`z`.`statuspembayaran` AS `statuspembayaran`,`z`.`idkoki` AS `idkoki`,`z`.`idkasir` AS `idkasir` from (select `penjualan`.`idpenjualan` AS `idpenjualan`,`penjualan`.`tglpenjualan` AS `tglpenjualan`,`penjualan`.`keterangan` AS `keterangan`,`penjualan`.`idpelanggan` AS `idpelanggan`,`pelanggan`.`namapelanggan` AS `namapelanggan`,`pelanggan`.`notelp` AS `notelp`,`pelanggan`.`email` AS `email`,`pelanggan`.`alamat` AS `alamat`,`pelanggan`.`kodepos` AS `kodepos`,`pelanggan`.`foto` AS `foto`,(select ifnull(sum(`penjualandetil`.`totalharga`),0) AS `totalharga` from `penjualandetil` where `penjualandetil`.`idpenjualan` = `penjualan`.`idpenjualan`) AS `totalharga`,(select ifnull(sum(`penjualandetilservice`.`harga`),0) AS `totalharga` from `penjualandetilservice` where `penjualandetilservice`.`idpenjualan` = `penjualan`.`idpenjualan`) AS `totalhargaservice`,`penjualan`.`diskon` AS `diskon`,`penjualan`.`grandtotal` AS `grandtotal`,`penjualan`.`qrcode` AS `qrcode`,`penjualan`.`tglinsert` AS `tglinsert`,`penjualan`.`tglupdate` AS `tglupdate`,`penjualan`.`idpengguna` AS `idpengguna`,`pengguna`.`namapengguna` AS `namapengguna`,`penjualan`.`carapembayaran` AS `carapembayaran`,`penjualan`.`statuspemesanan` AS `statuspemesanan`,`penjualan`.`statuspembayaran` AS `statuspembayaran`,`penjualan`.`idkoki` AS `idkoki`,`penjualan`.`idkasir` AS `idkasir` from ((`penjualan` join `pengguna` on(`penjualan`.`idpengguna` = `pengguna`.`idpengguna`)) left join `pelanggan` on(`penjualan`.`idpelanggan` = `pelanggan`.`idpelanggan`))) `z` */;

/*View structure for view v_penjualandetil */

/*!50001 DROP TABLE IF EXISTS `v_penjualandetil` */;
/*!50001 DROP VIEW IF EXISTS `v_penjualandetil` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_penjualandetil` AS select `penjualandetil`.`idpenjualan` AS `idpenjualan`,`penjualan`.`tglpenjualan` AS `tglpenjualan`,`penjualandetil`.`idproduk` AS `idproduk`,`produk`.`qrcode` AS `qrcode`,`produk`.`idkategori` AS `idkategori`,`kategori`.`namakategori` AS `namakategori`,`produk`.`namaproduk` AS `namaproduk`,`produk`.`satuan` AS `satuan`,`penjualandetil`.`qty` AS `qty`,(select ifnull(sum(`v_returpenjualan_detil`.`qty`),0) AS `totalqty` from `v_returpenjualan_detil` where `v_returpenjualan_detil`.`idpenjualan` = `penjualandetil`.`idpenjualan` and `v_returpenjualan_detil`.`idproduk` = `penjualandetil`.`idproduk`) AS `qtyretur`,`penjualandetil`.`hargamodal` AS `hargamodal`,`penjualandetil`.`hargajual` AS `hargajual`,`penjualandetil`.`diskon` AS `diskon`,`penjualandetil`.`totalharga` AS `totalharga`,`produk`.`foto` AS `foto` from (((`penjualandetil` join `penjualan` on(`penjualandetil`.`idpenjualan` = `penjualan`.`idpenjualan`)) join `produk` on(`penjualandetil`.`idproduk` = `produk`.`idproduk`)) join `kategori` on(`produk`.`idkategori` = `kategori`.`idkategori`)) */;

/*View structure for view v_penjualandetilservice */

/*!50001 DROP TABLE IF EXISTS `v_penjualandetilservice` */;
/*!50001 DROP VIEW IF EXISTS `v_penjualandetilservice` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_penjualandetilservice` AS select `penjualandetilservice`.`idpenjualan` AS `idpenjualan`,`penjualan`.`tglpenjualan` AS `tglpenjualan`,`penjualandetilservice`.`idtarif` AS `idtarif`,`tarif`.`namatarif` AS `namatarif`,`penjualandetilservice`.`harga` AS `harga` from ((`penjualandetilservice` join `tarif` on(`penjualandetilservice`.`idtarif` = `tarif`.`idtarif`)) join `penjualan` on(`penjualandetilservice`.`idpenjualan` = `penjualan`.`idpenjualan`)) */;

/*View structure for view v_penjualandetil_global */

/*!50001 DROP TABLE IF EXISTS `v_penjualandetil_global` */;
/*!50001 DROP VIEW IF EXISTS `v_penjualandetil_global` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_penjualandetil_global` AS select concat('PM-',`v_pemesanandetil`.`idpemesanan`) AS `id`,'Pemesanan' AS `status`,`v_pemesanandetil`.`tglpemesanan` AS `tanggal`,`v_pemesanandetil`.`idproduk` AS `idproduk`,`v_pemesanandetil`.`idkategori` AS `idkategori`,`v_pemesanandetil`.`namakategori` AS `namakategori`,`v_pemesanandetil`.`namaproduk` AS `namaproduk`,`v_pemesanandetil`.`satuan` AS `satuan`,`v_pemesanandetil`.`qty` AS `qty`,`v_pemesanandetil`.`hargamodal` AS `hargamodal`,`v_pemesanandetil`.`hargajual` AS `hargajual`,0 AS `diskon`,`v_pemesanandetil`.`totalharga` AS `totalharga`,`v_pemesanandetil`.`foto` AS `foto` from `v_pemesanandetil` where `v_pemesanandetil`.`statuskonfirmasi` = 'Dikonfirmasi' and `v_pemesanandetil`.`statuslunas` = 'Sudah Lunas' union all select concat('PL-',`v_penjualandetil`.`idpenjualan`) AS `id`,'Penjualan' AS `status`,`v_penjualandetil`.`tglpenjualan` AS `tglpenjualan`,`v_penjualandetil`.`idproduk` AS `idproduk`,`v_penjualandetil`.`idkategori` AS `idkategori`,`v_penjualandetil`.`namakategori` AS `namakategori`,`v_penjualandetil`.`namaproduk` AS `namaproduk`,`v_penjualandetil`.`satuan` AS `satuan`,`v_penjualandetil`.`qty` AS `qty`,`v_penjualandetil`.`hargamodal` AS `hargamodal`,`v_penjualandetil`.`hargajual` AS `hargajual`,`v_penjualandetil`.`diskon` AS `diskon`,`v_penjualandetil`.`totalharga` AS `totalharga`,`v_penjualandetil`.`foto` AS `foto` from `v_penjualandetil` where `v_penjualandetil`.`qty` > 0 */;

/*View structure for view v_penjualan_global */

/*!50001 DROP TABLE IF EXISTS `v_penjualan_global` */;
/*!50001 DROP VIEW IF EXISTS `v_penjualan_global` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_penjualan_global` AS (select `v_penjualandetil_global`.`id` AS `id`,`v_penjualandetil_global`.`status` AS `status`,`v_penjualandetil_global`.`tanggal` AS `tanggal`,sum(`v_penjualandetil_global`.`qty` * `v_penjualandetil_global`.`hargamodal`) AS `totalharga_modal`,sum(`v_penjualandetil_global`.`qty` * `v_penjualandetil_global`.`hargajual`) AS `totalharga_jual`,sum(`v_penjualandetil_global`.`qty` * `v_penjualandetil_global`.`hargajual`) - sum(`v_penjualandetil_global`.`qty` * `v_penjualandetil_global`.`hargamodal`) AS `totalharga_bersih`,sum(`v_penjualandetil_global`.`diskon`) AS `totalharga_diskon`,sum(`v_penjualandetil_global`.`totalharga`) AS `totalharga` from `v_penjualandetil_global` group by `v_penjualandetil_global`.`id`,`v_penjualandetil_global`.`status`,`v_penjualandetil_global`.`tanggal` order by `v_penjualandetil_global`.`tanggal`) */;

/*View structure for view v_perencanaan */

/*!50001 DROP TABLE IF EXISTS `v_perencanaan` */;
/*!50001 DROP VIEW IF EXISTS `v_perencanaan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_perencanaan` AS select `perencanaan`.`idperencanaan` AS `idperencanaan`,`perencanaan`.`tglperencanaan` AS `tglperencanaan`,`perencanaan`.`jenis` AS `jenis`,`perencanaan`.`nama` AS `nama`,`perencanaan`.`tujuan` AS `tujuan`,`perencanaan`.`keterangan` AS `keterangan`,`perencanaan`.`foto` AS `foto`,`perencanaan`.`tglinsert` AS `tglinsert`,`perencanaan`.`tglupdate` AS `tglupdate`,`perencanaan`.`idpengguna` AS `idpengguna`,`pengguna`.`namapengguna` AS `namapengguna`,case when (select ifnull(count(0),0) AS `total` from `perencanaansurat` where `perencanaansurat`.`idperencanaan` = `perencanaan`.`idperencanaan`) > 0 then 'Sudah Diproses' else 'Sedang Diproses' end AS `statusperencanaan` from (`perencanaan` join `pengguna` on(`perencanaan`.`idpengguna` = `pengguna`.`idpengguna`)) */;

/*View structure for view v_perencanaansurat */

/*!50001 DROP TABLE IF EXISTS `v_perencanaansurat` */;
/*!50001 DROP VIEW IF EXISTS `v_perencanaansurat` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_perencanaansurat` AS select `perencanaansurat`.`idperencanaansurat` AS `idperencanaansurat`,`perencanaansurat`.`idperencanaan` AS `idperencanaan`,`perencanaan`.`tglperencanaan` AS `tglperencanaan`,`perencanaan`.`jenis` AS `jenis`,`perencanaan`.`nama` AS `nama`,`perencanaan`.`tujuan` AS `tujuan`,`perencanaan`.`keterangan` AS `keteranganperencanaan`,`perencanaan`.`foto` AS `foto`,(select `pengguna`.`namapengguna` from `pengguna` where `pengguna`.`idpengguna` = `perencanaan`.`idpengguna`) AS `namapimpinan`,(select `pengguna`.`level` from `pengguna` where `pengguna`.`idpengguna` = `perencanaan`.`idpengguna`) AS `levelpimpinan`,`perencanaansurat`.`tglperencanaansurat` AS `tglperencanaansurat`,`perencanaansurat`.`namaperusahaan` AS `namaperusahaan`,`perencanaansurat`.`perihal` AS `perihal`,`perencanaansurat`.`alamat` AS `alamat`,`perencanaansurat`.`kota` AS `kota`,`perencanaansurat`.`kodepos` AS `kodepos`,`perencanaansurat`.`keterangan` AS `keterangan`,`perencanaansurat`.`tglinsert` AS `tglinsert`,`perencanaansurat`.`tglupdate` AS `tglupdate`,`perencanaansurat`.`idpengguna` AS `idpengguna`,`pengguna`.`namapengguna` AS `namapengguna` from ((`perencanaansurat` join `perencanaan` on(`perencanaansurat`.`idperencanaan` = `perencanaan`.`idperencanaan`)) join `pengguna` on(`perencanaansurat`.`idpengguna` = `pengguna`.`idpengguna`)) */;

/*View structure for view v_produk */

/*!50001 DROP TABLE IF EXISTS `v_produk` */;
/*!50001 DROP VIEW IF EXISTS `v_produk` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_produk` AS select `produk`.`idproduk` AS `idproduk`,`produk`.`idkategori` AS `idkategori`,`kategori`.`namakategori` AS `namakategori`,`kategori`.`urisegment` AS `urisegment_kategori`,`produk`.`namaproduk` AS `namaproduk`,`produk`.`keterangan` AS `keterangan`,`produk`.`stok` AS `stok`,`produk`.`stokminimum` AS `stokminimum`,`produk`.`satuan` AS `satuan`,`produk`.`hargabeli` AS `hargabeli`,`produk`.`hargajual` AS `hargajual`,`produk`.`foto` AS `foto`,`produk`.`statusaktif` AS `statusaktif`,`produk`.`qrcode` AS `qrcode`,`produk`.`urisegment` AS `urisegment` from (`produk` join `kategori` on(`produk`.`idkategori` = `kategori`.`idkategori`)) */;

/*View structure for view v_profil */

/*!50001 DROP TABLE IF EXISTS `v_profil` */;
/*!50001 DROP VIEW IF EXISTS `v_profil` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_profil` AS select `profil`.`id` AS `id`,`profil`.`namaperusahaan` AS `namaperusahaan`,`profil`.`tentangkami` AS `tentangkami`,`profil`.`logoperusahaan` AS `logoperusahaan`,`profil`.`fotoperusahaan` AS `fotoperusahaan`,`profil`.`tglupdate` AS `tglupdate`,`profil`.`idpengguna` AS `idpengguna`,`pengguna`.`namapengguna` AS `namapengguna` from (`profil` join `pengguna` on(`profil`.`idpengguna` = `pengguna`.`idpengguna`)) */;

/*View structure for view v_profil_blog */

/*!50001 DROP TABLE IF EXISTS `v_profil_blog` */;
/*!50001 DROP VIEW IF EXISTS `v_profil_blog` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_profil_blog` AS select `profil_blog`.`idblog` AS `idblog`,`profil_blog`.`tglblog` AS `tglblog`,`profil_blog`.`judul` AS `judul`,`profil_blog`.`foto` AS `foto`,`profil_blog`.`konten` AS `konten`,`profil_blog`.`urlblog` AS `urlblog`,`profil_blog`.`statusaktif` AS `statusaktif`,`profil_blog`.`tglinsert` AS `tglinsert`,`profil_blog`.`tglupdate` AS `tglupdate`,`profil_blog`.`idpengguna` AS `idpengguna`,`pengguna`.`namapengguna` AS `namapengguna`,`profil_blog`.`urisegment` AS `urisegment` from (`profil_blog` join `pengguna` on(`profil_blog`.`idpengguna` = `pengguna`.`idpengguna`)) */;

/*View structure for view v_profil_galeri */

/*!50001 DROP TABLE IF EXISTS `v_profil_galeri` */;
/*!50001 DROP VIEW IF EXISTS `v_profil_galeri` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_profil_galeri` AS select `profil_galeri`.`idgaleri` AS `idgaleri`,`profil_galeri`.`foto` AS `foto`,`profil_galeri`.`keterangan` AS `keterangan`,`profil_galeri`.`tglinsert` AS `tglinsert`,`profil_galeri`.`tglupdate` AS `tglupdate`,`profil_galeri`.`idpengguna` AS `idpengguna`,`pengguna`.`namapengguna` AS `namapengguna` from (`profil_galeri` join `pengguna` on(`profil_galeri`.`idpengguna` = `pengguna`.`idpengguna`)) */;

/*View structure for view v_profil_kontakkami */

/*!50001 DROP TABLE IF EXISTS `v_profil_kontakkami` */;
/*!50001 DROP VIEW IF EXISTS `v_profil_kontakkami` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_profil_kontakkami` AS select `profil_kontakkami`.`id` AS `id`,`profil_kontakkami`.`email` AS `email`,`profil_kontakkami`.`notelp` AS `notelp`,`profil_kontakkami`.`nowa` AS `nowa`,`profil_kontakkami`.`alamat` AS `alamat`,`profil_kontakkami`.`iframegoogle` AS `iframegoogle`,`profil_kontakkami`.`tglupdate` AS `tglupdate`,`profil_kontakkami`.`idpengguna` AS `idpengguna`,`pengguna`.`namapengguna` AS `namapengguna` from (`profil_kontakkami` join `pengguna` on(`profil_kontakkami`.`idpengguna` = `pengguna`.`idpengguna`)) */;

/*View structure for view v_profil_layanan */

/*!50001 DROP TABLE IF EXISTS `v_profil_layanan` */;
/*!50001 DROP VIEW IF EXISTS `v_profil_layanan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_profil_layanan` AS select `profil_layanan`.`idlayanan` AS `idlayanan`,`profil_layanan`.`judullayanan` AS `judullayanan`,`profil_layanan`.`keterangan` AS `keterangan`,`profil_layanan`.`icon` AS `icon`,`profil_layanan`.`foto` AS `foto`,`profil_layanan`.`statusaktif` AS `statusaktif`,`profil_layanan`.`tglinsert` AS `tglinsert`,`profil_layanan`.`tglupdate` AS `tglupdate`,`profil_layanan`.`idpengguna` AS `idpengguna`,`pengguna`.`namapengguna` AS `namapengguna` from (`profil_layanan` join `pengguna` on(`profil_layanan`.`idpengguna` = `pengguna`.`idpengguna`)) */;

/*View structure for view v_profil_slider */

/*!50001 DROP TABLE IF EXISTS `v_profil_slider` */;
/*!50001 DROP VIEW IF EXISTS `v_profil_slider` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_profil_slider` AS select `profil_slider`.`idslider` AS `idslider`,`profil_slider`.`judul` AS `judul`,`profil_slider`.`keterangan` AS `keterangan`,`profil_slider`.`foto` AS `foto`,`profil_slider`.`url` AS `url`,`profil_slider`.`statusaktif` AS `statusaktif`,`profil_slider`.`tglinsert` AS `tglinsert`,`profil_slider`.`tglupdate` AS `tglupdate`,`profil_slider`.`idpengguna` AS `idpengguna`,`pengguna`.`namapengguna` AS `namapengguna` from (`profil_slider` join `pengguna` on(`profil_slider`.`idpengguna` = `pengguna`.`idpengguna`)) */;

/*View structure for view v_profil_sosialmedia */

/*!50001 DROP TABLE IF EXISTS `v_profil_sosialmedia` */;
/*!50001 DROP VIEW IF EXISTS `v_profil_sosialmedia` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_profil_sosialmedia` AS select `profil_sosialmedia`.`idsosialmedia` AS `idsosialmedia`,`profil_sosialmedia`.`nama_sosialmedia` AS `nama_sosialmedia`,`profil_sosialmedia`.`foto` AS `foto`,`profil_sosialmedia`.`url` AS `url`,`profil_sosialmedia`.`tglinsert` AS `tglinsert`,`profil_sosialmedia`.`tglupdate` AS `tglupdate`,`profil_sosialmedia`.`idpengguna` AS `idpengguna`,`pengguna`.`namapengguna` AS `namapengguna` from (`profil_sosialmedia` join `pengguna` on(`profil_sosialmedia`.`idpengguna` = `pengguna`.`idpengguna`)) */;

/*View structure for view v_profil_testimoni */

/*!50001 DROP TABLE IF EXISTS `v_profil_testimoni` */;
/*!50001 DROP VIEW IF EXISTS `v_profil_testimoni` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_profil_testimoni` AS select `profil_testimoni`.`idtestimoni` AS `idtestimoni`,`profil_testimoni`.`tgltestimoni` AS `tgltestimoni`,`profil_testimoni`.`keterangan` AS `keterangan`,`profil_testimoni`.`foto` AS `foto`,`profil_testimoni`.`tglinsert` AS `tglinsert`,`profil_testimoni`.`tglupdate` AS `tglupdate`,`profil_testimoni`.`idpengguna` AS `idpengguna`,`pengguna`.`namapengguna` AS `namapengguna` from (`profil_testimoni` join `pengguna` on(`profil_testimoni`.`idpengguna` = `pengguna`.`idpengguna`)) */;

/*View structure for view v_profil_video */

/*!50001 DROP TABLE IF EXISTS `v_profil_video` */;
/*!50001 DROP VIEW IF EXISTS `v_profil_video` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_profil_video` AS select `profil_video`.`idvideo` AS `idvideo`,`profil_video`.`judul` AS `judul`,`profil_video`.`file` AS `file`,`profil_video`.`keterangan` AS `keterangan`,`profil_video`.`urisegment` AS `urisegment`,`profil_video`.`tglinsert` AS `tglinsert`,`profil_video`.`tglupdate` AS `tglupdate`,`profil_video`.`idpengguna` AS `idpengguna`,`pengguna`.`namapengguna` AS `namapengguna` from (`profil_video` join `pengguna` on(`profil_video`.`idpengguna` = `pengguna`.`idpengguna`)) */;

/*View structure for view v_returpenjualan */

/*!50001 DROP TABLE IF EXISTS `v_returpenjualan` */;
/*!50001 DROP VIEW IF EXISTS `v_returpenjualan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_returpenjualan` AS select `returpenjualan`.`idreturpenjualan` AS `idreturpenjualan`,`returpenjualan`.`tglreturpenjualan` AS `tglreturpenjualan`,`returpenjualan`.`idpenjualan` AS `idpenjualan`,`penjualan`.`tglpenjualan` AS `tglpenjualan`,`returpenjualan`.`keterangan` AS `keterangan`,(select ifnull(sum(`returpenjualan_detil`.`totalharga`),0) AS `total` from `returpenjualan_detil` where `returpenjualan_detil`.`idreturpenjualan` = `returpenjualan`.`idreturpenjualan`) AS `totalharga`,`returpenjualan`.`tglinsert` AS `tglinsert`,`returpenjualan`.`tglupdate` AS `tglupdate`,`returpenjualan`.`idpengguna` AS `idpengguna`,`pengguna`.`namapengguna` AS `namapengguna` from ((`returpenjualan` join `pengguna` on(`returpenjualan`.`idpengguna` = `pengguna`.`idpengguna`)) join `penjualan` on(`returpenjualan`.`idpenjualan` = `penjualan`.`idpenjualan`)) */;

/*View structure for view v_returpenjualan_detil */

/*!50001 DROP TABLE IF EXISTS `v_returpenjualan_detil` */;
/*!50001 DROP VIEW IF EXISTS `v_returpenjualan_detil` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_returpenjualan_detil` AS select `returpenjualan_detil`.`idreturpenjualan` AS `idreturpenjualan`,`returpenjualan`.`tglreturpenjualan` AS `tglreturpenjualan`,`returpenjualan`.`idpenjualan` AS `idpenjualan`,`returpenjualan_detil`.`idproduk` AS `idproduk`,`produk`.`namaproduk` AS `namaproduk`,`produk`.`satuan` AS `satuan`,`produk`.`stok` AS `stok`,`produk`.`idkategori` AS `idkategori`,`kategori`.`namakategori` AS `namakategori`,`returpenjualan_detil`.`qty` AS `qty`,`returpenjualan_detil`.`harga` AS `harga`,`returpenjualan_detil`.`totalharga` AS `totalharga` from (((`returpenjualan_detil` join `returpenjualan` on(`returpenjualan_detil`.`idreturpenjualan` = `returpenjualan`.`idreturpenjualan`)) join `produk` on(`returpenjualan_detil`.`idproduk` = `produk`.`idproduk`)) join `kategori` on(`produk`.`idkategori` = `kategori`.`idkategori`)) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

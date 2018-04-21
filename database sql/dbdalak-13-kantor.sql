/*
MySQL Data Transfer
Source Host: localhost
Source Database: dbdalak
Target Host: localhost
Target Database: dbdalak
Date: 09/04/2018 16:40:32
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for tb_file_arsip
-- ----------------------------
DROP TABLE IF EXISTS `tb_file_arsip`;
CREATE TABLE `tb_file_arsip` (
  `arsip_id` int(11) NOT NULL AUTO_INCREMENT,
  `prs_id` varchar(20) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `nama_arsip` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`arsip_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tb_file_fotomonitoring
-- ----------------------------
DROP TABLE IF EXISTS `tb_file_fotomonitoring`;
CREATE TABLE `tb_file_fotomonitoring` (
  `id_file` int(11) NOT NULL AUTO_INCREMENT,
  `monit_id` varchar(20) DEFAULT NULL,
  `nama_file` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_file`)
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tb_groupuser
-- ----------------------------
DROP TABLE IF EXISTS `tb_groupuser`;
CREATE TABLE `tb_groupuser` (
  `groupuser_id` varchar(10) NOT NULL DEFAULT '',
  `groupuser` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`groupuser_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for tb_jadwal
-- ----------------------------
DROP TABLE IF EXISTS `tb_jadwal`;
CREATE TABLE `tb_jadwal` (
  `jadwal_id` varchar(20) NOT NULL DEFAULT '',
  `jadwal_tgl` date DEFAULT NULL,
  `jenismonitoring_id` varchar(10) DEFAULT NULL,
  `prs_id` varchar(10) DEFAULT NULL,
  `update_tgl` date DEFAULT NULL,
  `update_user` varchar(20) DEFAULT NULL,
  `iscancel` tinyint(1) DEFAULT '0',
  `catatanbatal` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`jadwal_id`),
  KEY `jadwal_prs` (`prs_id`),
  CONSTRAINT `jadwal_prs` FOREIGN KEY (`prs_id`) REFERENCES `tb_perusahaan` (`prs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for tb_jalan
-- ----------------------------
DROP TABLE IF EXISTS `tb_jalan`;
CREATE TABLE `tb_jalan` (
  `jalan_id` varchar(20) NOT NULL COMMENT 'ID Jalan',
  `namajalan` varchar(100) DEFAULT NULL COMMENT 'Nama Jalan',
  PRIMARY KEY (`jalan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tb_jenis_monitoring
-- ----------------------------
DROP TABLE IF EXISTS `tb_jenis_monitoring`;
CREATE TABLE `tb_jenis_monitoring` (
  `jenismonitoring_id` varchar(10) NOT NULL DEFAULT '',
  `jenismonitoring` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`jenismonitoring_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tb_kategory
-- ----------------------------
DROP TABLE IF EXISTS `tb_kategory`;
CREATE TABLE `tb_kategory` (
  `kategory_id` varchar(10) NOT NULL COMMENT 'Kategory ID',
  `kategory` varchar(50) DEFAULT NULL COMMENT 'Kategory',
  PRIMARY KEY (`kategory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tb_kecamatan
-- ----------------------------
DROP TABLE IF EXISTS `tb_kecamatan`;
CREATE TABLE `tb_kecamatan` (
  `kecamatan_id` varchar(4) NOT NULL,
  `kecamatan` varchar(40) NOT NULL,
  PRIMARY KEY (`kecamatan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for tb_kelurahan
-- ----------------------------
DROP TABLE IF EXISTS `tb_kelurahan`;
CREATE TABLE `tb_kelurahan` (
  `kelurahan_id` varchar(4) NOT NULL,
  `kecamatan_id` varchar(4) NOT NULL,
  `kelurahan` varchar(40) NOT NULL,
  PRIMARY KEY (`kelurahan_id`),
  KEY `kec_ind` (`kecamatan_id`),
  CONSTRAINT `kelurahan_camat` FOREIGN KEY (`kecamatan_id`) REFERENCES `tb_kecamatan` (`kecamatan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Table structure for tb_key_api
-- ----------------------------
DROP TABLE IF EXISTS `tb_key_api`;
CREATE TABLE `tb_key_api` (
  `google_key_api` varchar(50) NOT NULL,
  PRIMARY KEY (`google_key_api`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tb_klasifikasi_masalah
-- ----------------------------
DROP TABLE IF EXISTS `tb_klasifikasi_masalah`;
CREATE TABLE `tb_klasifikasi_masalah` (
  `klasmasalah_id` varchar(10) NOT NULL DEFAULT '' COMMENT 'Klas ID',
  `klasmasalah` varchar(50) DEFAULT NULL COMMENT 'Klasifikasi Masalah',
  PRIMARY KEY (`klasmasalah_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for tb_melengkapi_berkas
-- ----------------------------
DROP TABLE IF EXISTS `tb_melengkapi_berkas`;
CREATE TABLE `tb_melengkapi_berkas` (
  `melengkapi_id` varchar(20) NOT NULL DEFAULT '',
  `prs_id` varchar(10) DEFAULT NULL,
  `melengkapi_tgl` date DEFAULT NULL,
  `catatan` text,
  `update_tgl` date DEFAULT NULL,
  `update_user` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`melengkapi_id`),
  KEY `lengkap_prs` (`prs_id`),
  CONSTRAINT `lengkap_prs` FOREIGN KEY (`prs_id`) REFERENCES `tb_perusahaan` (`prs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for tb_monitoring
-- ----------------------------
DROP TABLE IF EXISTS `tb_monitoring`;
CREATE TABLE `tb_monitoring` (
  `monit_id` varchar(20) NOT NULL,
  `monit_userupdate` varchar(20) DEFAULT NULL,
  `monit_tglupdate` date DEFAULT NULL,
  `jadwal_id` varchar(20) DEFAULT NULL,
  `klasmasalah_id` varchar(5) DEFAULT NULL,
  `kategory_id` varchar(10) DEFAULT NULL,
  `targetwaktu` date DEFAULT NULL,
  `catatanlapangan` text,
  PRIMARY KEY (`monit_id`),
  KEY `monit_jadwal` (`jadwal_id`),
  KEY `monit_masalah` (`klasmasalah_id`),
  KEY `monit_kategory` (`kategory_id`),
  CONSTRAINT `monit_jadwal` FOREIGN KEY (`jadwal_id`) REFERENCES `tb_jadwal` (`jadwal_id`),
  CONSTRAINT `monit_kategory` FOREIGN KEY (`kategory_id`) REFERENCES `tb_kategory` (`kategory_id`),
  CONSTRAINT `monit_masalah` FOREIGN KEY (`klasmasalah_id`) REFERENCES `tb_klasifikasi_masalah` (`klasmasalah_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tb_perusahaan
-- ----------------------------
DROP TABLE IF EXISTS `tb_perusahaan`;
CREATE TABLE `tb_perusahaan` (
  `prs_id` varchar(10) NOT NULL COMMENT 'ID Perusahaan',
  `prs_nama` varchar(50) DEFAULT NULL COMMENT 'Nama Perusahaan',
  `prs_lokasidet` varchar(100) DEFAULT NULL COMMENT 'Lokasi Detail',
  `jalan_id` varchar(20) DEFAULT NULL COMMENT 'ID Jalan',
  `kategory_id` varchar(10) DEFAULT NULL COMMENT 'Kategory ID',
  `prs_bidangusaha` varchar(50) DEFAULT NULL COMMENT 'Bidang Usaha',
  `prs_telpkantor` varchar(20) DEFAULT NULL COMMENT 'Telp Kantor',
  `prs_telpcontact` varchar(20) DEFAULT NULL COMMENT 'Nomor HP',
  `prs_namacontact` varchar(50) DEFAULT NULL COMMENT 'Nama Kontak',
  `prs_email` varchar(50) DEFAULT NULL COMMENT 'Email',
  `prs_map_latitude` float(10,6) DEFAULT NULL COMMENT 'Koordinat Lat',
  `prs_map_longitude` float(10,6) DEFAULT NULL COMMENT 'Koordinat Long',
  `prs_noakta` varchar(30) DEFAULT NULL COMMENT 'Nomor Akta',
  `prs_tglakta` date DEFAULT NULL COMMENT 'Tgl Akta',
  `prs_noHAM` varchar(20) DEFAULT NULL COMMENT 'Nomor HAM',
  `prs_tglHAM` date DEFAULT NULL COMMENT 'Tgl. HAM',
  `kelurahan_id` varchar(10) DEFAULT NULL COMMENT 'Kelurahan ID',
  `prs_adaNPWP` tinyint(4) DEFAULT '0' COMMENT 'Ada NPWP',
  `prs_adaSHM` tinyint(4) DEFAULT '0' COMMENT 'Ada SHM',
  `prs_adasewatanah` tinyint(4) DEFAULT '0' COMMENT 'Ada Sewa Tanah',
  `prs_nodaftarPMA` varchar(30) DEFAULT NULL COMMENT 'Nomor Pendaftaran PMA',
  `prs_adaIMB` tinyint(4) DEFAULT '0' COMMENT 'Ada IMB',
  `prs_adasewagedung` tinyint(4) DEFAULT '0' COMMENT 'Ada Sewa Gedung',
  `prs_noSITU` varchar(30) DEFAULT NULL COMMENT 'Nomor SITU',
  `prs_noHO` varchar(30) DEFAULT NULL COMMENT 'Nomor HO',
  `prs_adaUKLUPL` tinyint(4) DEFAULT '0' COMMENT 'Ada UKL-UPL',
  `prs_noTDP` varchar(30) DEFAULT NULL COMMENT 'Nomor TDP',
  `prs_adaLKPM` tinyint(4) DEFAULT '0' COMMENT 'Ada LKPM',
  `prs_adaKITAS` tinyint(4) DEFAULT '0' COMMENT 'Ada KITAS',
  `prs_noIPPMA` varchar(30) DEFAULT NULL COMMENT 'Nomor IPPMA',
  `prs_noIPPRB` varchar(30) DEFAULT NULL COMMENT 'Nomor IPPRB',
  `prs_noIPPRLS` varchar(30) DEFAULT NULL COMMENT 'Nomor IPPRLS',
  `prs_tahunberlakuIPPMA` varchar(5) DEFAULT NULL COMMENT 'Tahun Berlaku IPPMA',
  `prs_noIjinUsaha` varchar(30) DEFAULT NULL COMMENT 'Nomor Ijin Usaha',
  `prs_nilaiInvestasiUSD` double DEFAULT '0' COMMENT 'Investasi USD',
  `prs_nilaiInvestasiRP` double DEFAULT '0' COMMENT 'Investasi RP',
  `prs_jumlahWNA_laki` smallint(6) DEFAULT '0' COMMENT 'Jumlah WNA Laki',
  `prs_jumlahWNA_perempuan` smallint(6) DEFAULT '0' COMMENT 'Jumlah WNA Perempuan',
  `prs_jumlahWNI_laki` smallint(6) DEFAULT '0' COMMENT 'Jumlah WNI Laki',
  `prs_jumlahWNI_perempuan` smallint(6) DEFAULT '0' COMMENT 'Jumlah WNI Perempuan',
  `arsip_nokotak` varchar(10) DEFAULT NULL COMMENT 'Nomor Kotak',
  `LKPM_terakhir` varchar(255) DEFAULT NULL COMMENT 'LKPM Terakhir',
  `sudah_PM` tinyint(4) DEFAULT '0' COMMENT 'Sudah Pemantauan',
  `sudah_PB` tinyint(4) DEFAULT '0' COMMENT 'Sudah Pembinaan',
  `sudah_PS` tinyint(4) DEFAULT '0' COMMENT 'Sudah Pengawasan',
  `klasmasalah_id` varchar(5) DEFAULT NULL COMMENT 'Klasifikasi Masalah',
  `sudahmelengkapiberkas` tinyint(4) DEFAULT '0' COMMENT 'Sudah Melengkapi',
  `tgl_melengkapi` date DEFAULT NULL COMMENT 'Tgl Melengkapi',
  `aktif_id` tinyint(4) DEFAULT '1' COMMENT 'Status Aktif',
  PRIMARY KEY (`prs_id`),
  KEY `prs_jalan` (`jalan_id`),
  KEY `prs_kategory` (`kategory_id`),
  KEY `prs_kelurahan` (`kelurahan_id`),
  CONSTRAINT `prs_jalan` FOREIGN KEY (`jalan_id`) REFERENCES `tb_jalan` (`jalan_id`),
  CONSTRAINT `prs_kategory` FOREIGN KEY (`kategory_id`) REFERENCES `tb_kategory` (`kategory_id`),
  CONSTRAINT `prs_kelurahan` FOREIGN KEY (`kelurahan_id`) REFERENCES `tb_kelurahan` (`kelurahan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tb_sent_email
-- ----------------------------
DROP TABLE IF EXISTS `tb_sent_email`;
CREATE TABLE `tb_sent_email` (
  `sent_id` int(11) NOT NULL AUTO_INCREMENT,
  `prs_id` varchar(20) DEFAULT NULL,
  `tgl_email` date DEFAULT NULL,
  `time_email` time DEFAULT NULL,
  `pesan` text,
  `pengirim` varchar(30) DEFAULT NULL,
  `tujuan` varchar(30) DEFAULT NULL,
  `update_tgl` date DEFAULT NULL,
  `update_user` varchar(20) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`sent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tb_status_aktif
-- ----------------------------
DROP TABLE IF EXISTS `tb_status_aktif`;
CREATE TABLE `tb_status_aktif` (
  `aktif_id` tinyint(4) NOT NULL,
  `statusaktif` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`aktif_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tb_template_email
-- ----------------------------
DROP TABLE IF EXISTS `tb_template_email`;
CREATE TABLE `tb_template_email` (
  `template_id` smallint(10) NOT NULL AUTO_INCREMENT,
  `template_nama` varchar(50) DEFAULT NULL,
  `template_content` text,
  PRIMARY KEY (`template_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tb_user
-- ----------------------------
DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user` (
  `userid` varchar(20) NOT NULL DEFAULT '',
  `usernama` varchar(60) DEFAULT NULL,
  `password` varchar(35) DEFAULT NULL,
  `groupuser_id` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for tbmarker
-- ----------------------------
DROP TABLE IF EXISTS `tbmarker`;
CREATE TABLE `tbmarker` (
  `id` varchar(10) NOT NULL DEFAULT '',
  `namausaha` varchar(50) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `latitude` float(10,6) DEFAULT NULL,
  `longitude` float(10,6) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `tb_file_arsip` VALUES ('3', 'PS.0001', 'File Surat', 'PS-0001-arsip-File Surat.docx');
INSERT INTO `tb_file_arsip` VALUES ('4', 'PS.0003', 'NPWP', 'PS-0003-arsip-NPWP.pdf');
INSERT INTO `tb_file_arsip` VALUES ('5', 'PS.0003', 'Perjanjian Sewa', 'PS-0003-arsip-Perjanjian Sewa.pdf');
INSERT INTO `tb_file_arsip` VALUES ('7', 'PS.0005', 'Daftar Hadir', 'PS-0005-arsip-Daftar Hadir.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('34', 'PM.180003', 'PS-0002-PM-1.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('45', 'PB.180002', 'PS-0003-PB-1.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('46', 'PS.180003', 'PS-0002-PS-1.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('77', 'PM.180001', 'PS-0136-PM-4.png');
INSERT INTO `tb_file_fotomonitoring` VALUES ('42', 'PM.180003', 'PS-0002-PM-4.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('43', 'PM.180003', 'PS-0002-PM-5.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('44', 'PM.180003', 'PS-0002-PM-6.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('47', 'PS.180002', 'PS-0003-PS-1.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('48', 'PS.180002', 'PS-0003-PS-2.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('49', 'MP.180002', 'PS-0003-MP-1.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('50', 'MP.180002', 'PS-0003-MP-2.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('51', 'PM.180004', 'PS-0005-PM-1.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('52', 'PM.180004', 'PS-0005-PM-2.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('53', 'PM.180005', 'PS-0006-PM-1.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('54', 'PM.180005', 'PS-0006-PM-2.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('55', 'PM.180005', 'PS-0006-PM-3.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('56', 'PM.180005', 'PS-0006-PM-4.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('57', 'PM.180005', 'PS-0006-PM-5.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('58', 'PM.180006', 'PS-0007-PM-1.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('59', 'PM.180006', 'PS-0007-PM-2.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('60', 'PM.180006', 'PS-0007-PM-3.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('61', 'PM.180006', 'PS-0007-PM-4.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('62', 'PM.180006', 'PS-0007-PM-5.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('63', 'PM.180007', 'PS-0008-PM-1.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('64', 'PM.180007', 'PS-0008-PM-2.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('67', 'PB.180004', 'PS-0011-PB-1.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('68', 'PB.180004', 'PS-0011-PB-2.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('69', 'PB.180005', 'PS-0012-PB-1.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('70', 'PB.180005', 'PS-0012-PB-2.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('71', 'PB.180006', 'PS-0013-PB-1.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('72', 'PB.180006', 'PS-0013-PB-2.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('73', 'PB.180006', 'PS-0013-PB-3.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('74', 'PB.180006', 'PS-0013-PB-4.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('75', 'PM.180008', 'PS-0010-PM-1.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('76', 'PM.180009', 'PS-0009-PM-1.png');
INSERT INTO `tb_groupuser` VALUES ('admin', 'Administrator');
INSERT INTO `tb_groupuser` VALUES ('bina', 'Seksi Pembinaan');
INSERT INTO `tb_groupuser` VALUES ('pantau', 'Seksi Pemantauan');
INSERT INTO `tb_jadwal` VALUES ('JD.180001', '2018-02-12', 'PM', 'PS.0136', '2018-04-06', 'Budi', '0', null);
INSERT INTO `tb_jalan` VALUES ('JL.0001', 'Jl. Gunung Agung');
INSERT INTO `tb_jalan` VALUES ('JL.0002', 'Jl. Gunung Tangkuban Perahu');
INSERT INTO `tb_jalan` VALUES ('JL.0005', 'Jl. Gunung Sangiang');
INSERT INTO `tb_jalan` VALUES ('JL.0007', 'Jl. Gunung Rinjani');
INSERT INTO `tb_jalan` VALUES ('JL.0008', 'Jl. Gunung Batu Karu');
INSERT INTO `tb_jalan` VALUES ('JL.0009', 'Jl. Gunung Batu Karu I');
INSERT INTO `tb_jalan` VALUES ('JL.0010', 'Jl. Gunung Welirang');
INSERT INTO `tb_jalan` VALUES ('JL.0011', 'Jl. Gunung Karakatau');
INSERT INTO `tb_jalan` VALUES ('JL.0012', 'Jl. Gunung Karakatau I');
INSERT INTO `tb_jalan` VALUES ('JL.0013', 'Jl. Gunung Karang');
INSERT INTO `tb_jalan` VALUES ('JL.0014', 'Jl. Gunung Lawu');
INSERT INTO `tb_jalan` VALUES ('JL.0015', 'Jl. Gunung Tambora');
INSERT INTO `tb_jalan` VALUES ('JL.0016', 'Jl. Gunung Penulisan');
INSERT INTO `tb_jalan` VALUES ('JL.0017', 'Jl. Gunung Batur');
INSERT INTO `tb_jalan` VALUES ('JL.0018', 'Jl. Gunung Merapi');
INSERT INTO `tb_jalan` VALUES ('JL.0019', 'Jl. Gunung Merbabu');
INSERT INTO `tb_jalan` VALUES ('JL.0020', 'Jl. Gunung Semeru');
INSERT INTO `tb_jalan` VALUES ('JL.0021', 'Jl. Buana Kubu');
INSERT INTO `tb_jalan` VALUES ('JL.0022', 'Jl. Peti Tenget');
INSERT INTO `tb_jalan` VALUES ('JL.0023', 'Jl. Imam Bonjol');
INSERT INTO `tb_jalan` VALUES ('JL.0024', 'Jl. Setia Budi');
INSERT INTO `tb_jalan` VALUES ('JL.0026', 'Jl. Gambuh');
INSERT INTO `tb_jalan` VALUES ('JL.0027', 'Jl. Kumba Karna');
INSERT INTO `tb_jalan` VALUES ('JL.0028', 'Jl. Tantri');
INSERT INTO `tb_jalan` VALUES ('JL.0029', 'Jl. Wibisana');
INSERT INTO `tb_jalan` VALUES ('JL.0030', 'Jl. Cokroaminoto');
INSERT INTO `tb_jalan` VALUES ('JL.0031', 'Jl. Ken Dedes');
INSERT INTO `tb_jalan` VALUES ('JL.0032', 'Jl. Kertanegara');
INSERT INTO `tb_jalan` VALUES ('JL.0033', 'Jl. Warmadewa');
INSERT INTO `tb_jalan` VALUES ('JL.0034', 'Jl. Ken Arok');
INSERT INTO `tb_jalan` VALUES ('JL.0035', 'Jl. Tunggul Ametung');
INSERT INTO `tb_jalan` VALUES ('JL.0036', 'Jl. Lembu Sura');
INSERT INTO `tb_jalan` VALUES ('JL.0037', 'Jl. Achmad Yani');
INSERT INTO `tb_jalan` VALUES ('JL.0038', 'Jl. Kebo Iwa');
INSERT INTO `tb_jalan` VALUES ('JL.0039', 'Jl. Asta Sura');
INSERT INTO `tb_jalan` VALUES ('JL.0040', 'Jl. Tanjung Tutur');
INSERT INTO `tb_jalan` VALUES ('JL.0041', 'Jl. Gajah Sura');
INSERT INTO `tb_jalan` VALUES ('JL.0042', 'Jl. Anta Sura');
INSERT INTO `tb_jalan` VALUES ('JL.0043', 'Jl. Gatot Subroto Barat');
INSERT INTO `tb_jalan` VALUES ('JL.0044', 'Jl. Maruti');
INSERT INTO `tb_jalan` VALUES ('JL.0045', 'Jl. Padma');
INSERT INTO `tb_jalan` VALUES ('JL.0046', 'Jl. Sutomo');
INSERT INTO `tb_jalan` VALUES ('JL.0047', 'Jl. Gajah Mada');
INSERT INTO `tb_jalan` VALUES ('JL.0048', 'Jl. Kartini');
INSERT INTO `tb_jalan` VALUES ('JL.0049', 'Jl. Nakula');
INSERT INTO `tb_jalan` VALUES ('JL.0050', 'Jl. Abimanyu');
INSERT INTO `tb_jalan` VALUES ('JL.0051', 'Jl. Veteran');
INSERT INTO `tb_jalan` VALUES ('JL.0052', 'Jl. Yudistira');
INSERT INTO `tb_jalan` VALUES ('JL.0053', 'Jl. Warkudara');
INSERT INTO `tb_jalan` VALUES ('JL.0054', 'Jl. Karna');
INSERT INTO `tb_jalan` VALUES ('JL.0055', 'Jl. Kresna');
INSERT INTO `tb_jalan` VALUES ('JL.0056', 'Jl. Nangka');
INSERT INTO `tb_jalan` VALUES ('JL.0057', 'Jl. Arjuna');
INSERT INTO `tb_jalan` VALUES ('JL.0058', 'Jl. Gunung Raung');
INSERT INTO `tb_jalan` VALUES ('JL.0059', 'Jl. Sumatra');
INSERT INTO `tb_jalan` VALUES ('JL.0060', 'Jl. Sulawesi');
INSERT INTO `tb_jalan` VALUES ('JL.0061', 'Jl. Gunung Kawi');
INSERT INTO `tb_jalan` VALUES ('JL.0062', 'Jl. Singasari');
INSERT INTO `tb_jalan` VALUES ('JL.0063', 'Jl. Gunung Kidul');
INSERT INTO `tb_jalan` VALUES ('JL.0064', 'Jl. Beliton');
INSERT INTO `tb_jalan` VALUES ('JL.0065', 'Jl. Mandalawangi');
INSERT INTO `tb_jalan` VALUES ('JL.0066', 'Jl. Sahadewa');
INSERT INTO `tb_jalan` VALUES ('JL.0067', 'Jl. Hasanudin');
INSERT INTO `tb_jalan` VALUES ('JL.0068', 'Jl. Bukit Tunggal');
INSERT INTO `tb_jalan` VALUES ('JL.0069', 'Jl. Patih Jelantik');
INSERT INTO `tb_jalan` VALUES ('JL.0070', 'Jl. Diponogoro');
INSERT INTO `tb_jalan` VALUES ('JL.0071', 'Jl. Nusa Kambangan');
INSERT INTO `tb_jalan` VALUES ('JL.0072', 'Jl. Buru');
INSERT INTO `tb_jalan` VALUES ('JL.0073', 'Jl. Pulau Salawati');
INSERT INTO `tb_jalan` VALUES ('JL.0074', 'Jl. Pulau Batam');
INSERT INTO `tb_jalan` VALUES ('JL.0075', 'Jl. Pulau Maluku');
INSERT INTO `tb_jalan` VALUES ('JL.0076', 'Jl. Pulau Roon');
INSERT INTO `tb_jalan` VALUES ('JL.0077', 'Jl. Thamrin');
INSERT INTO `tb_jalan` VALUES ('JL.0078', 'Jl. Wahidin');
INSERT INTO `tb_jalan` VALUES ('JL.0079', 'Jl. Pulau Yapen');
INSERT INTO `tb_jalan` VALUES ('JL.0080', 'Jl. Pulau Misol');
INSERT INTO `tb_jalan` VALUES ('JL.0081', 'Jl. Teuku Umar');
INSERT INTO `tb_jalan` VALUES ('JL.0082', 'Jl. Pulau Tarakan');
INSERT INTO `tb_jalan` VALUES ('JL.0083', 'Jl. Pulau Flores');
INSERT INTO `tb_jalan` VALUES ('JL.0084', 'Jl. Pulau Rembulan');
INSERT INTO `tb_jalan` VALUES ('JL.0085', 'Jl. Pulau Bawean');
INSERT INTO `tb_jalan` VALUES ('JL.0086', 'Jl. Pulau Alor');
INSERT INTO `tb_jalan` VALUES ('JL.0087', 'Jl. Pulau Nusa Lembongan');
INSERT INTO `tb_jalan` VALUES ('JL.0088', 'Jl. Nusa Barung');
INSERT INTO `tb_jalan` VALUES ('JL.0089', 'Jl. Pulau Seribu');
INSERT INTO `tb_jalan` VALUES ('JL.0090', 'Jl. Pulau Ambon');
INSERT INTO `tb_jalan` VALUES ('JL.0091', 'Jl. Pulau Selayar');
INSERT INTO `tb_jalan` VALUES ('JL.0092', 'Jl. Pulau Sebatik');
INSERT INTO `tb_jalan` VALUES ('JL.0093', 'Jl. Pulau Seram');
INSERT INTO `tb_jalan` VALUES ('JL.0094', 'Jl. Nusa Ceningan');
INSERT INTO `tb_jalan` VALUES ('JL.0095', 'Jl. Pulau Morotal');
INSERT INTO `tb_jalan` VALUES ('JL.0096', 'Jl. Satelit');
INSERT INTO `tb_jalan` VALUES ('JL.0097', 'Jl. Saturnus');
INSERT INTO `tb_jalan` VALUES ('JL.0098', 'Jl. Pulau Bacan');
INSERT INTO `tb_jalan` VALUES ('JL.0099', 'Jl. Pulau Sula');
INSERT INTO `tb_jalan` VALUES ('JL.0100', 'Jl. Pulau Kae');
INSERT INTO `tb_jalan` VALUES ('JL.0101', 'Jl. Pulau Menjangan');
INSERT INTO `tb_jalan` VALUES ('JL.0102', 'Jl. Nusa Penida');
INSERT INTO `tb_jalan` VALUES ('JL.0103', 'Jl. Pulau Serangan');
INSERT INTO `tb_jalan` VALUES ('JL.0104', 'Jl. Pulau Timor');
INSERT INTO `tb_jalan` VALUES ('JL.0105', 'Jl. Nusa Tenggara');
INSERT INTO `tb_jalan` VALUES ('JL.0106', 'Jl. Pulau Lombok');
INSERT INTO `tb_jalan` VALUES ('JL.0107', 'Jl. Pulau Bali');
INSERT INTO `tb_jalan` VALUES ('JL.0108', 'Jl. Pulau Nias');
INSERT INTO `tb_jalan` VALUES ('JL.0109', 'Jl. Pulau Tanimbar');
INSERT INTO `tb_jalan` VALUES ('JL.0110', 'Jl. Pulau Solor');
INSERT INTO `tb_jalan` VALUES ('JL.0111', 'Jl. Pulau Halmahera');
INSERT INTO `tb_jalan` VALUES ('JL.0112', 'Jl. Serma Made Tugir');
INSERT INTO `tb_jalan` VALUES ('JL.0113', 'Jl. Serma Kawi');
INSERT INTO `tb_jalan` VALUES ('JL.0114', 'Jl. Serma Made Pil');
INSERT INTO `tb_jalan` VALUES ('JL.0115', 'Jl. Serma Katos');
INSERT INTO `tb_jalan` VALUES ('JL.0116', 'Jl. Serma Mendra');
INSERT INTO `tb_jalan` VALUES ('JL.0117', 'Jl. Serma Tirta');
INSERT INTO `tb_jalan` VALUES ('JL.0118', 'Jl. Serma Durna');
INSERT INTO `tb_jalan` VALUES ('JL.0119', 'Jl. Serma Repot');
INSERT INTO `tb_jalan` VALUES ('JL.0120', 'Jl. Pulau Buton');
INSERT INTO `tb_jalan` VALUES ('JL.0121', 'Jl. Pulau Riau');
INSERT INTO `tb_jalan` VALUES ('JL.0122', 'Jl. Serma Made Oka');
INSERT INTO `tb_jalan` VALUES ('JL.0123', 'Jl. Pulau Kawe');
INSERT INTO `tb_jalan` VALUES ('JL.0124', 'Jl. Pulau Sayang');
INSERT INTO `tb_jalan` VALUES ('JL.0125', 'Jl. Pulau Adi');
INSERT INTO `tb_jalan` VALUES ('JL.0126', 'Jl. Pulau Ayu');
INSERT INTO `tb_jalan` VALUES ('JL.0127', 'Jl. Pulau Batanta');
INSERT INTO `tb_jalan` VALUES ('JL.0128', 'Jl. Pulau Pinang');
INSERT INTO `tb_jalan` VALUES ('JL.0129', 'Jl. Waturenggong');
INSERT INTO `tb_jalan` VALUES ('JL.0130', 'Jl. Dewi Sartika');
INSERT INTO `tb_jalan` VALUES ('JL.0131', 'Jl. Yos Sudarso');
INSERT INTO `tb_jalan` VALUES ('JL.0132', 'Jl. Majapahit');
INSERT INTO `tb_jalan` VALUES ('JL.0133', 'Jl. Letda Reta');
INSERT INTO `tb_jalan` VALUES ('JL.0134', 'Jl. Letda Ngurah Putra');
INSERT INTO `tb_jalan` VALUES ('JL.0135', 'Jl. Letda Winda');
INSERT INTO `tb_jalan` VALUES ('JL.0136', 'Jl. Letda Jaya');
INSERT INTO `tb_jalan` VALUES ('JL.0137', 'Jl. Letda Jaya');
INSERT INTO `tb_jalan` VALUES ('JL.0138', 'Jl. Letda Suci');
INSERT INTO `tb_jalan` VALUES ('JL.0139', 'Jl. Letda Made Putra');
INSERT INTO `tb_jalan` VALUES ('JL.0140', 'Jl. Kapten Regug');
INSERT INTO `tb_jalan` VALUES ('JL.0141', 'Jl. Kapten Mudita');
INSERT INTO `tb_jalan` VALUES ('JL.0142', 'Jl. Kapten Sujana');
INSERT INTO `tb_jalan` VALUES ('JL.0143', 'Jl. Kapten Agung');
INSERT INTO `tb_jalan` VALUES ('JL.0144', 'Jl. Kapten Japa');
INSERT INTO `tb_jalan` VALUES ('JL.0145', 'Jl. Mayor Wisnu');
INSERT INTO `tb_jalan` VALUES ('JL.0146', 'Jl. Debes');
INSERT INTO `tb_jalan` VALUES ('JL.0147', 'Jl. Sugianyar');
INSERT INTO `tb_jalan` VALUES ('JL.0148', 'Jl. Patimura');
INSERT INTO `tb_jalan` VALUES ('JL.0149', 'Jl. Supratman');
INSERT INTO `tb_jalan` VALUES ('JL.0150', 'Jl. Surapati');
INSERT INTO `tb_jalan` VALUES ('JL.0151', 'Jl. Hayam Wuruk');
INSERT INTO `tb_jalan` VALUES ('JL.0152', 'Jl. Ngurah Rai');
INSERT INTO `tb_jalan` VALUES ('JL.0153', 'Jl. Gatot Subroto Timur');
INSERT INTO `tb_jalan` VALUES ('JL.0154', 'Jl. Nusa Indah');
INSERT INTO `tb_jalan` VALUES ('JL.0155', 'Jl. Kamboja');
INSERT INTO `tb_jalan` VALUES ('JL.0156', 'Jl. Melati');
INSERT INTO `tb_jalan` VALUES ('JL.0157', 'Jl. Durian');
INSERT INTO `tb_jalan` VALUES ('JL.0158', 'Jl. Kaliasem');
INSERT INTO `tb_jalan` VALUES ('JL.0159', 'Jl. Belimbing');
INSERT INTO `tb_jalan` VALUES ('JL.0160', 'Jl. Kecubung');
INSERT INTO `tb_jalan` VALUES ('JL.0161', 'Jl. Suli');
INSERT INTO `tb_jalan` VALUES ('JL.0162', 'Jl. Kepundung');
INSERT INTO `tb_jalan` VALUES ('JL.0163', 'Jl. Rambutan');
INSERT INTO `tb_jalan` VALUES ('JL.0164', 'Jl. Wani');
INSERT INTO `tb_jalan` VALUES ('JL.0165', 'Jl. Nenas');
INSERT INTO `tb_jalan` VALUES ('JL.0166', 'Jl. Ceruring');
INSERT INTO `tb_jalan` VALUES ('JL.0167', 'Jl. Kedondong');
INSERT INTO `tb_jalan` VALUES ('JL.0168', 'Jl. Banteng');
INSERT INTO `tb_jalan` VALUES ('JL.0169', 'Jl. Setiaki');
INSERT INTO `tb_jalan` VALUES ('JL.0170', 'Jl. Salya');
INSERT INTO `tb_jalan` VALUES ('JL.0171', 'Jl. Kunti');
INSERT INTO `tb_jalan` VALUES ('JL.0172', 'Jl. Widura');
INSERT INTO `tb_jalan` VALUES ('JL.0173', 'Jl. Sri Kaya');
INSERT INTO `tb_jalan` VALUES ('JL.0174', 'Jl. Teratai');
INSERT INTO `tb_jalan` VALUES ('JL.0175', 'Jl. Kenanga');
INSERT INTO `tb_jalan` VALUES ('JL.0176', 'Jl. Kemuda');
INSERT INTO `tb_jalan` VALUES ('JL.0177', 'Jl. Jempiring');
INSERT INTO `tb_jalan` VALUES ('JL.0178', 'Jl. Mawar');
INSERT INTO `tb_jalan` VALUES ('JL.0179', 'Jl. Menuh');
INSERT INTO `tb_jalan` VALUES ('JL.0180', 'Jl. Anyelir');
INSERT INTO `tb_jalan` VALUES ('JL.0181', 'Jl. Katrangan');
INSERT INTO `tb_jalan` VALUES ('JL.0182', 'Jl. Pucuk');
INSERT INTO `tb_jalan` VALUES ('JL.0183', 'Jl. Kenyeri');
INSERT INTO `tb_jalan` VALUES ('JL.0184', 'Jl. Seruni');
INSERT INTO `tb_jalan` VALUES ('JL.0185', 'Jl. Dahlia');
INSERT INTO `tb_jalan` VALUES ('JL.0186', 'Jl. Trijata');
INSERT INTO `tb_jalan` VALUES ('JL.0187', 'Jl. Tunjung');
INSERT INTO `tb_jalan` VALUES ('JL.0188', 'Jl. Angsoka');
INSERT INTO `tb_jalan` VALUES ('JL.0189', 'Jl. Rampai');
INSERT INTO `tb_jalan` VALUES ('JL.0190', 'Jl. Jepun');
INSERT INTO `tb_jalan` VALUES ('JL.0191', 'Jl. Gadung');
INSERT INTO `tb_jalan` VALUES ('JL.0192', 'Jl. Plawa');
INSERT INTO `tb_jalan` VALUES ('JL.0193', 'Jl. Anggrek');
INSERT INTO `tb_jalan` VALUES ('JL.0194', 'Jl. Pudak');
INSERT INTO `tb_jalan` VALUES ('JL.0195', 'Jl. Pacar');
INSERT INTO `tb_jalan` VALUES ('JL.0196', 'Jl. Leli');
INSERT INTO `tb_jalan` VALUES ('JL.0197', 'Jl. Kemuning');
INSERT INTO `tb_jalan` VALUES ('JL.0198', 'Jl. Subita');
INSERT INTO `tb_jalan` VALUES ('JL.0199', 'Jl. Turi');
INSERT INTO `tb_jalan` VALUES ('JL.0200', 'Jl. Noja');
INSERT INTO `tb_jalan` VALUES ('JL.0201', 'Jl. Waribang');
INSERT INTO `tb_jalan` VALUES ('JL.0202', 'Jl. Merak');
INSERT INTO `tb_jalan` VALUES ('JL.0203', 'Jl. Tohpati-Tangtu');
INSERT INTO `tb_jalan` VALUES ('JL.0204', 'Jl. Laplap-Poh Manis-Jaga Pati');
INSERT INTO `tb_jalan` VALUES ('JL.0205', 'Jl. Surabi');
INSERT INTO `tb_jalan` VALUES ('JL.0206', 'Jl. Sri Gading');
INSERT INTO `tb_jalan` VALUES ('JL.0207', 'Jl. Padma');
INSERT INTO `tb_jalan` VALUES ('JL.0208', 'Jl. Sokasati');
INSERT INTO `tb_jalan` VALUES ('JL.0209', 'Jl. Sulatri');
INSERT INTO `tb_jalan` VALUES ('JL.0210', 'Jl. Trengguli');
INSERT INTO `tb_jalan` VALUES ('JL.0211', 'Jl. Seroja');
INSERT INTO `tb_jalan` VALUES ('JL.0212', 'Jl. Cempaka');
INSERT INTO `tb_jalan` VALUES ('JL.0213', 'Jl. Narakusuma');
INSERT INTO `tb_jalan` VALUES ('JL.0214', 'Jl. Ratna');
INSERT INTO `tb_jalan` VALUES ('JL.0215', 'Jl. Hangtuah');
INSERT INTO `tb_jalan` VALUES ('JL.0216', 'Jl. By Pass Ngurah Rai');
INSERT INTO `tb_jalan` VALUES ('JL.0217', 'Jl. Gunung Sari');
INSERT INTO `tb_jalan` VALUES ('JL.0218', 'Jl. Intaran');
INSERT INTO `tb_jalan` VALUES ('JL.0219', 'Jl. Kejang Sari');
INSERT INTO `tb_jalan` VALUES ('JL.0220', 'Jl. Delod Peken');
INSERT INTO `tb_jalan` VALUES ('JL.0221', 'Jl. Sekuta');
INSERT INTO `tb_jalan` VALUES ('JL.0222', 'Jl. Raya Puputan');
INSERT INTO `tb_jalan` VALUES ('JL.0223', 'Jl. Gurita');
INSERT INTO `tb_jalan` VALUES ('JL.0224', 'Jl. Suwung Kangin');
INSERT INTO `tb_jalan` VALUES ('JL.0225', 'Jl. Suwung Batan Kendal');
INSERT INTO `tb_jalan` VALUES ('JL.0226', 'Jl. Dukuh Sari');
INSERT INTO `tb_jalan` VALUES ('JL.0227', 'Jl. Merta Sari');
INSERT INTO `tb_jalan` VALUES ('JL.0228', 'Jl. Pemuda');
INSERT INTO `tb_jalan` VALUES ('JL.0229', 'Jl. Kerta Sari');
INSERT INTO `tb_jalan` VALUES ('JL.0230', 'Jl. Dewata');
INSERT INTO `tb_jalan` VALUES ('JL.0231', 'Jl. Sidakarya');
INSERT INTO `tb_jalan` VALUES ('JL.0232', 'Jl. Pendidikan');
INSERT INTO `tb_jalan` VALUES ('JL.0233', 'Jl. Kerta Usada');
INSERT INTO `tb_jalan` VALUES ('JL.0234', 'Jl. Raya Kerta Petasikan');
INSERT INTO `tb_jalan` VALUES ('JL.0235', 'Jl. Tandakan');
INSERT INTO `tb_jalan` VALUES ('JL.0236', 'Jl. Pantai Sindhu Sanur');
INSERT INTO `tb_jalan` VALUES ('JL.0237', 'Jl. Pungutan');
INSERT INTO `tb_jalan` VALUES ('JL.0238', 'Jl. Bumi Ayu');
INSERT INTO `tb_jalan` VALUES ('JL.0239', 'Jl. Batu Karang');
INSERT INTO `tb_jalan` VALUES ('JL.0240', 'Jl. Kesuma Sari');
INSERT INTO `tb_jalan` VALUES ('JL.0241', 'Jl. Cemara');
INSERT INTO `tb_jalan` VALUES ('JL.0242', 'Jl. Bet Ngandang');
INSERT INTO `tb_jalan` VALUES ('JL.0243', 'Jl. Sudamala');
INSERT INTO `tb_jalan` VALUES ('JL.0244', 'Jl. Tirta Nadi Sanur');
INSERT INTO `tb_jalan` VALUES ('JL.0245', 'Jl. Ciung Wanara');
INSERT INTO `tb_jalan` VALUES ('JL.0246', 'Jl. Danau Tondano');
INSERT INTO `tb_jalan` VALUES ('JL.0247', 'Jl. Danau Buyan');
INSERT INTO `tb_jalan` VALUES ('JL.0248', 'Jl. Danau Beratan');
INSERT INTO `tb_jalan` VALUES ('JL.0249', 'Jl. Danau Kerinci');
INSERT INTO `tb_jalan` VALUES ('JL.0250', 'Jl. Danau Toba');
INSERT INTO `tb_jalan` VALUES ('JL.0251', 'Jl. Danau Tamblingan');
INSERT INTO `tb_jalan` VALUES ('JL.0252', 'Jl. Danau Poso');
INSERT INTO `tb_jalan` VALUES ('JL.0253', 'Jl. Tukad Balian');
INSERT INTO `tb_jalan` VALUES ('JL.0254', 'Jl. Tukad Bilok');
INSERT INTO `tb_jalan` VALUES ('JL.0255', 'Jl. Tukad Irawadi');
INSERT INTO `tb_jalan` VALUES ('JL.0256', 'Jl. Tukad Melangit');
INSERT INTO `tb_jalan` VALUES ('JL.0257', 'Jl. Tukad Banyusan');
INSERT INTO `tb_jalan` VALUES ('JL.0258', 'Jl. Tukad Yeh Biu');
INSERT INTO `tb_jalan` VALUES ('JL.0259', 'Jl. Tukad Yeh Aya');
INSERT INTO `tb_jalan` VALUES ('JL.0260', 'Jl. Tukad Yeh Penet');
INSERT INTO `tb_jalan` VALUES ('JL.0261', 'Jl. Tukad Banyu Asri');
INSERT INTO `tb_jalan` VALUES ('JL.0262', 'Jl. Tukad Unda');
INSERT INTO `tb_jalan` VALUES ('JL.0263', 'Jl. Tukad Yeh Ayung');
INSERT INTO `tb_jalan` VALUES ('JL.0264', 'Jl. Tukad Pakerisan');
INSERT INTO `tb_jalan` VALUES ('JL.0265', 'Jl. Pulau Saelus');
INSERT INTO `tb_jalan` VALUES ('JL.0266', 'Jl. Pulau Singkep');
INSERT INTO `tb_jalan` VALUES ('JL.0267', 'Jl. Pulau Moyo');
INSERT INTO `tb_jalan` VALUES ('JL.0268', 'Jl. Pulau Belitung');
INSERT INTO `tb_jalan` VALUES ('JL.0269', 'Jl. Pulau Bungu');
INSERT INTO `tb_jalan` VALUES ('JL.0270', 'Jl. Pulau Enggano');
INSERT INTO `tb_jalan` VALUES ('JL.0271', 'Jl. Pulau Bangka');
INSERT INTO `tb_jalan` VALUES ('JL.0272', 'Jl. Pulau Ceningan Sari');
INSERT INTO `tb_jalan` VALUES ('JL.0273', 'Jl. Pulau Roti');
INSERT INTO `tb_jalan` VALUES ('JL.0274', 'Jl. By Pass Prof. Dr. Ida Bagus Mantra');
INSERT INTO `tb_jalan` VALUES ('JL.0275', 'Jl. Raya Sesetan');
INSERT INTO `tb_jalan` VALUES ('JL.0276', 'Jl. Udayana');
INSERT INTO `tb_jalan` VALUES ('JL.0277', 'Jl. Mayjen Sutoyo');
INSERT INTO `tb_jalan` VALUES ('JL.0278', 'Jl. Rijasa');
INSERT INTO `tb_jalan` VALUES ('JL.0279', 'Jl. Kemoning');
INSERT INTO `tb_jalan` VALUES ('JL.0280', 'Jl. Investama');
INSERT INTO `tb_jalan` VALUES ('JL.0281', 'Jl. Pidada');
INSERT INTO `tb_jalan` VALUES ('JL.0282', 'Jl. Letda Tantular');
INSERT INTO `tb_jalan` VALUES ('JL.0283', 'Jl. Cok Tresna');
INSERT INTO `tb_jalan` VALUES ('JL.0284', 'Jl. Buluh Indah');
INSERT INTO `tb_jalan` VALUES ('JL.0285', 'Jl. Kargo Permai');
INSERT INTO `tb_jalan` VALUES ('JL.0286', 'Jl. Sudirman');
INSERT INTO `tb_jalan` VALUES ('JL.0287', 'Jl. Moh. Yamin');
INSERT INTO `tb_jalan` VALUES ('JL.0288', 'Jl. Merdeka');
INSERT INTO `tb_jalan` VALUES ('JL.0289', 'Jl. Mahendradata');
INSERT INTO `tb_jalan` VALUES ('JL.0290', 'Jl. Tukad Badung');
INSERT INTO `tb_jalan` VALUES ('JL.0291', 'Jl. Tukad Barito');
INSERT INTO `tb_jalan` VALUES ('JL.0292', 'Jl. Tukad Batanghari');
INSERT INTO `tb_jalan` VALUES ('JL.0293', 'Jl. Tukad Yeh Gangga');
INSERT INTO `tb_jalan` VALUES ('JL.0294', 'Jl. Sunset Road');
INSERT INTO `tb_jalan` VALUES ('JL.0295', 'Jl. Gatot Kaca');
INSERT INTO `tb_jalan` VALUES ('JL.0296', 'Jl. Bisma');
INSERT INTO `tb_jalan` VALUES ('JL.0297', 'Jl. Rama');
INSERT INTO `tb_jalan` VALUES ('JL.0298', 'Jl. Ternate');
INSERT INTO `tb_jalan` VALUES ('JL.0299', 'Jl. Letda Kajeng');
INSERT INTO `tb_jalan` VALUES ('JL.0300', 'Jl. MT. Haryono');
INSERT INTO `tb_jalan` VALUES ('JL.0301', 'Jl. Gunung Wilis');
INSERT INTO `tb_jalan` VALUES ('JL.0302', 'Jl. Gunung Kedung');
INSERT INTO `tb_jalan` VALUES ('JL.0303', 'Jl. Meduri');
INSERT INTO `tb_jalan` VALUES ('JL.0304', 'Jl. Baru');
INSERT INTO `tb_jalan` VALUES ('JL.0305', 'Jl. Tanjung Sari');
INSERT INTO `tb_jalan` VALUES ('JL.0306', 'Jl. Pulau Komodo');
INSERT INTO `tb_jalan` VALUES ('JL.0307', 'Jl. Gunung Soputan');
INSERT INTO `tb_jalan` VALUES ('JL.0308', 'Jl. Badak Agung');
INSERT INTO `tb_jalan` VALUES ('JL.0309', 'Jl. Tantular Barat');
INSERT INTO `tb_jalan` VALUES ('JL.0310', 'Jl. Gunung Salak');
INSERT INTO `tb_jalan` VALUES ('JL.0311', 'Jl. Ikan Tuna');
INSERT INTO `tb_jalan` VALUES ('JL.0312', 'Jl. Tukad Punggawa');
INSERT INTO `tb_jalan` VALUES ('JL.0313', 'Jl. Tukad Pancoran');
INSERT INTO `tb_jalan` VALUES ('JL.0314', 'Jl. Tukad Citarum');
INSERT INTO `tb_jalan` VALUES ('JL.0315', 'Jl. Karang Sari');
INSERT INTO `tb_jalan` VALUES ('JL.0316', 'Jl. Tirta Ening');
INSERT INTO `tb_jalan` VALUES ('JL.0317', 'Jl. Kerta Dalam');
INSERT INTO `tb_jalan` VALUES ('JL.0318', 'Jl. Kesari');
INSERT INTO `tb_jalan` VALUES ('JL.0319', 'Jl. Tukad Yeh Sungi');
INSERT INTO `tb_jalan` VALUES ('JL.0320', 'Jl. Padang Galak');
INSERT INTO `tb_jalan` VALUES ('JL.0321', 'Jl. Batu Sari');
INSERT INTO `tb_jalan` VALUES ('JL.0322', 'Jl. Sekar Tunjung');
INSERT INTO `tb_jalan` VALUES ('JL.0323', 'Jl. Cargo Indah');
INSERT INTO `tb_jalan` VALUES ('JL.0324', 'Jl. Kargo Taman');
INSERT INTO `tb_jalan` VALUES ('JL.0325', 'Jl. Gunung Andakasa');
INSERT INTO `tb_jalan` VALUES ('JL.0326', 'Jl. TPA Suwung');
INSERT INTO `tb_jalan` VALUES ('JL.0327', 'Jl. Tambak Sari');
INSERT INTO `tb_jalan` VALUES ('JL.0328', 'Jl. Pelabuhan Benoa');
INSERT INTO `tb_jalan` VALUES ('JL.0329', 'Jl. Tukad Banyusari');
INSERT INTO `tb_jalan` VALUES ('JL.0330', 'Jl. Pulau Galang');
INSERT INTO `tb_jalan` VALUES ('JL.0331', 'Jl. Palapa');
INSERT INTO `tb_jalan` VALUES ('JL.0332', 'Jl. Batur Sari');
INSERT INTO `tb_jalan` VALUES ('JL.0333', 'Jl. Pulau Yoni');
INSERT INTO `tb_jalan` VALUES ('JL.0334', 'Jl. Wr. Supratman');
INSERT INTO `tb_jalan` VALUES ('JL.0335', 'Jl. Sedap Malam');
INSERT INTO `tb_jalan` VALUES ('JL.0336', 'Jl. I Gusti Ngurah Rai');
INSERT INTO `tb_jalan` VALUES ('JL.0337', 'Jl. Duyung');
INSERT INTO `tb_jalan` VALUES ('JL.0338', 'Jl. Simpang Serangan');
INSERT INTO `tb_jalan` VALUES ('JL.0339', 'Jl. Telaga Waja');
INSERT INTO `tb_jalan` VALUES ('JL.0340', 'Jl. Wisata Tirta');
INSERT INTO `tb_jalan` VALUES ('JL.0341', 'Jl. Guruta Utama');
INSERT INTO `tb_jalan` VALUES ('JL.0342', 'Jl. Raya Pemogan');
INSERT INTO `tb_jalan` VALUES ('JL.0343', 'Jl. Padang Sulasih');
INSERT INTO `tb_jalan` VALUES ('JL.0344', 'Jl. Pemamoran');
INSERT INTO `tb_jalan` VALUES ('JL.0345', 'Jl. Buana Raya');
INSERT INTO `tb_jalan` VALUES ('JL.0346', 'Jl. Pura Demak');
INSERT INTO `tb_jalan` VALUES ('JL.0347', 'Jl. Akasia');
INSERT INTO `tb_jalan` VALUES ('JL.0348', 'Jl. Sunia Negara');
INSERT INTO `tb_jalan` VALUES ('JL.0349', 'Jl. Cargo');
INSERT INTO `tb_jalan` VALUES ('JL.0350', 'Jl. Kutat Lestari');
INSERT INTO `tb_jalan` VALUES ('JL.0351', 'Jl. Tegal Wangi');
INSERT INTO `tb_jalan` VALUES ('JL.0352', 'Jl. Kebudayaan');
INSERT INTO `tb_jalan` VALUES ('JL.0353', 'Jl. Suka Merta');
INSERT INTO `tb_jalan` VALUES ('JL.0354', 'Jl. Perum Glogor Indah');
INSERT INTO `tb_jenis_monitoring` VALUES ('PM', 'Pemantauan');
INSERT INTO `tb_jenis_monitoring` VALUES ('PB', 'Pembinaan');
INSERT INTO `tb_jenis_monitoring` VALUES ('PS', 'Pengawasan');
INSERT INTO `tb_kategory` VALUES ('K.01', 'Konstruksi');
INSERT INTO `tb_kategory` VALUES ('K.02', 'Produksi');
INSERT INTO `tb_kecamatan` VALUES ('DB', 'Denpasar Barat');
INSERT INTO `tb_kecamatan` VALUES ('DS', 'Denpasar Selatan');
INSERT INTO `tb_kecamatan` VALUES ('DT', 'Denpasar Timur');
INSERT INTO `tb_kecamatan` VALUES ('DU', 'Denpasar Utara');
INSERT INTO `tb_kelurahan` VALUES ('KB01', 'DB', 'Padang Sambian');
INSERT INTO `tb_kelurahan` VALUES ('KB02', 'DB', 'Pemecutan');
INSERT INTO `tb_kelurahan` VALUES ('KB03', 'DB', 'Dauh Puri');
INSERT INTO `tb_kelurahan` VALUES ('KB04', 'DB', 'Pemecutan Klod');
INSERT INTO `tb_kelurahan` VALUES ('KB05', 'DB', 'Padangsambian Kaja');
INSERT INTO `tb_kelurahan` VALUES ('KB06', 'DB', 'Padangsambian Klod');
INSERT INTO `tb_kelurahan` VALUES ('KB07', 'DB', 'Dauh Puri Kangin');
INSERT INTO `tb_kelurahan` VALUES ('KB08', 'DB', 'Dauh Puri Kauh');
INSERT INTO `tb_kelurahan` VALUES ('KB09', 'DB', 'Dauh Puri Klod');
INSERT INTO `tb_kelurahan` VALUES ('KB10', 'DB', 'Tegal Kerta');
INSERT INTO `tb_kelurahan` VALUES ('KB11', 'DB', 'Tegal Harum');
INSERT INTO `tb_kelurahan` VALUES ('KS01', 'DS', 'Serangan');
INSERT INTO `tb_kelurahan` VALUES ('KS02', 'DS', 'Pedungan');
INSERT INTO `tb_kelurahan` VALUES ('KS03', 'DS', 'Sesetan');
INSERT INTO `tb_kelurahan` VALUES ('KS04', 'DS', 'Panjer');
INSERT INTO `tb_kelurahan` VALUES ('KS05', 'DS', 'Renon');
INSERT INTO `tb_kelurahan` VALUES ('KS06', 'DS', 'Sanur');
INSERT INTO `tb_kelurahan` VALUES ('KS07', 'DS', 'Sidakarya');
INSERT INTO `tb_kelurahan` VALUES ('KS08', 'DS', 'Pemogan');
INSERT INTO `tb_kelurahan` VALUES ('KS09', 'DS', 'Sanur Kaja');
INSERT INTO `tb_kelurahan` VALUES ('KS10', 'DS', 'Sanur Kauh');
INSERT INTO `tb_kelurahan` VALUES ('KT01', 'DT', 'Dangin Puri');
INSERT INTO `tb_kelurahan` VALUES ('KT02', 'DT', 'Sumerta');
INSERT INTO `tb_kelurahan` VALUES ('KT03', 'DT', 'Kesiman');
INSERT INTO `tb_kelurahan` VALUES ('KT04', 'DT', 'Penatih');
INSERT INTO `tb_kelurahan` VALUES ('KT05', 'DT', 'Penatih Dangin Puri');
INSERT INTO `tb_kelurahan` VALUES ('KT06', 'DT', 'Dangin Puri Klod');
INSERT INTO `tb_kelurahan` VALUES ('KT07', 'DT', 'Sumerta Kauh');
INSERT INTO `tb_kelurahan` VALUES ('KT08', 'DT', 'Sumerta Kaja');
INSERT INTO `tb_kelurahan` VALUES ('KT09', 'DT', 'Sumerta Klod ');
INSERT INTO `tb_kelurahan` VALUES ('KT10', 'DT', 'Kesiman Kertalangu');
INSERT INTO `tb_kelurahan` VALUES ('KT11', 'DT', 'Kesiman Petilan');
INSERT INTO `tb_kelurahan` VALUES ('KU01', 'DU', 'Ubung ');
INSERT INTO `tb_kelurahan` VALUES ('KU02', 'DU', 'Peguyangan ');
INSERT INTO `tb_kelurahan` VALUES ('KU03', 'DU', 'Tonja ');
INSERT INTO `tb_kelurahan` VALUES ('KU04', 'DU', 'Pemecutan Kaja');
INSERT INTO `tb_kelurahan` VALUES ('KU05', 'DU', 'Dauh Puri Kaja');
INSERT INTO `tb_kelurahan` VALUES ('KU06', 'DU', 'Ubung Kaja ');
INSERT INTO `tb_kelurahan` VALUES ('KU07', 'DU', 'Peguyangan Kaja');
INSERT INTO `tb_kelurahan` VALUES ('KU08', 'DU', 'Peguyangan Kangin');
INSERT INTO `tb_kelurahan` VALUES ('KU09', 'DU', 'Dangin Puri Kauh');
INSERT INTO `tb_kelurahan` VALUES ('KU10', 'DU', 'Dangin Puri Kaja');
INSERT INTO `tb_kelurahan` VALUES ('KU11', 'DU', 'Dangin Puri Kangin');
INSERT INTO `tb_key_api` VALUES ('AIzaSyD5NglcogBq9Fymt7pLlkUlYNjl_ahu2E0');
INSERT INTO `tb_klasifikasi_masalah` VALUES ('KM.01', 'Tidak Bermasalah');
INSERT INTO `tb_klasifikasi_masalah` VALUES ('KM.02', 'Belum Memiliki Ijin Daerah (IMB, SITU)');
INSERT INTO `tb_klasifikasi_masalah` VALUES ('KM.03', 'Pindah Alamat');
INSERT INTO `tb_klasifikasi_masalah` VALUES ('KM.04', 'Lokasi Tidak ditemukan');
INSERT INTO `tb_monitoring` VALUES ('PM.180001', 'Budi', '2018-04-06', 'JD.180001', 'KM.01', 'K.02', null, 'Ijin-ijin sudah lengkap');
INSERT INTO `tb_perusahaan` VALUES ('PS.0001', 'PT. Navigatoria Indonesia', 'Perum Istana Regency Blok L-6, Lingkungan Banjar Pesanggaran', 'JL.0275', 'K.01', 'Kegiatan Hiburan dan Rekreasi Lainnya Ytdl', '', '', '', '', '0.000000', '0.000000', '105.', '2008-08-29', 'AHU-69041.AH.01.02.T', null, 'KS02', '1', '1', '1', '', '1', '1', '11/984/9488/DS/BPPTSP&PM/2015', '12/984/9490/DS/BPPTSP&PM/2015', '1', '22.09.1.79.00740', '1', '1', '', '', '', '', '239/T/PARIWISATA/2005', '60', '0', '0', '1', '31', '0', null, 'Januari-Juni 2016', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0002', 'PT. Tulip Bali Management', 'No. 46 ', 'JL.0237', 'K.01', 'Real Estate', '', '', '', '', '0.000000', '0.000000', '1.', '2015-02-04', '', null, 'KS06', '1', '1', '1', '', '1', '1', '11/993/9532/DS/BPPTSP&PM/2015', '12/993/9533/DS/BPPTSP&PM/2015', '1', '22.09.1.68.00744', '1', '1', '213/1/IP/PMA/2015', '', '', '', '', '400000', '0', '1', '0', '6', '0', null, 'Januari-Maret 2016                \r\nJuli-September 2016       \r\nOktober-Desember 2016     \r\nApril-Juni 2017', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0003', 'PT. Daya Gapura Bali', 'No. 10B ', 'JL.0227', 'K.01', 'Jasa Profesional, Ilmiah dan Teknis Lainnya Ytdl', '', '', '', '', '0.000000', '0.000000', '12.', '2002-02-20', 'C-14287 HT.01.01.TH.', null, 'KS10', '1', '1', '1', '', '1', '1', '11b/697/3551/DS/BPPTSP&PM/2014', '12b/697/3552/DS/BPPTSP&PM/2014', '1', '22.09.1.70.00446', '1', '1', '', '1730/1/IP-PB/PMA/2014', '', '', '863/T/PERDAGANGAN/PARIWISATA/2', '225000', '0', '1', '0', '15', '0', null, 'Januari-Juni 2016', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0004', 'PT. Ngan Lok International Indonesia', 'Komplek Ruko Sanur Raya No. 12-13', 'JL.0216', 'K.01', 'Perdagangan Besar ', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS06', null, null, null, '', null, null, '', '', null, '', '1', null, '987/1/IP/PMA/2014', '', '', '', '', '300000', '0', '0', '0', '7', '0', null, 'Juli-September 2015 \r\nOktober-Desember 2015 \r\nJanuari-Maret 2016               \r\nApril-Juni 2016                                  \r\nJuli-September 2016 \r\nOktober-Desember 2016', '0', '0', '0', 'KM.04', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0005', 'PT. Samudera Ekspedisi Aman', 'No. 51 B, Pertokoan Laghawa Hotel', 'JL.0251', 'K.01', 'Wisata Tirta', '', '', '', '', '0.000000', '0.000000', '08.', '2016-10-31', 'AHU-AH.01.03-0094599', null, 'KS06', '1', '1', '1', '', '1', '1', '11/7/34/DS/DISPER/2012', '12/6/35/DS/DISPER/2012', '1', '22.09.1.92.00002', '1', null, '', '15,12 Juni 2017', '', '', '356/1/IU/I/PMA/PARIWISATA/2012', '0', '1110000', '0', '0', '42', '0', null, 'Januari-Juni 2016                      \r\nJuli-Desember 2016', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0006', 'PT. Piayu Samudera Loka', 'Lingkungan Ponjok', 'JL.0312', 'K.01', 'Rekreasi Hiburan Umun', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS01', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, '', '0', '0', '0', 'KM.02', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0007', 'PT. Word Resort Center', 'No. 1D, Lingkungan pesanggaran', 'JL.0297', 'K.01', 'Biro Perjalanan Wisata', '', '', '', '', '0.000000', '0.000000', '149', '2013-02-27', 'AHU-08714.AH.01.01.T', null, 'KS02', '1', null, '1', '', '1', null, '11/11/22/DS/BPPTSP&PM/2016', '12/11/23/DS/BPPTSP&PM/2016', null, '22.09.1.79.00004', null, '1', '', '', '', '', '264/1/IU/I/PMA/PARIWISATA/2013', '250000', '0', '0', '0', '7', '0', null, '', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0008', 'PT. Pet Norton Consulting International', 'Perum Tiying Gading No. 18', 'JL.0313', 'K.01', 'Jasa Profesional, Ilmiah dan Teknis Lainnya Ytdl', '', '', '', '', '0.000000', '0.000000', '4.', '2007-02-05', 'W7.04756 HT 01.01. t', null, 'KS04', '1', '1', '1', '', '1', '1', '11/300/1734/DS/BPPTSP&PM/2014', '12/300/1736/DS/BPPTSP&PM/2014', null, '22.09.1.70.00129', '1', '1', '111/1/pma/2007', '4,05/02/2007', '', '', '645/ 23 juni 2008', '550000', '0', '0', '0', '9', '0', null, 'Juli-Desember 2015             \r\nJanuari-Juni 2016', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0009', 'PT. Time Door Indonesia', 'Gang D, No. 999', 'JL.0314', 'K.01', 'Penerbitan Piranti lunak, kegiatan konsultasi komp', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS05', '1', '1', '1', '', '1', '1', '', '', '1', '', '1', '1', '', '', '', '2020', '', '1200000', '0', '1', '0', '30', '0', null, '', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0010', 'PT. Flores International', 'No. 55', 'JL.0227', 'K.01', 'Perdagangan Besar ( Ekspor dan Impor )', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS06', '1', null, null, null, '1', '1', null, null, '1', null, '1', null, null, null, null, null, null, '100000', '0', '1', '0', '6', '0', null, 'Januari-Juni 2016', '0', '0', '0', 'KM.02', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0011', 'PT. Destination Asia', 'No. 360', 'JL.0216', 'K.01', 'Jasa Perjalanan Wisata', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS06', '1', '1', '1', '', '1', '1', '', '', '1', '', null, '1', '', '', '', '2018', '', '0', '11000000', '5', '0', '65', '0', null, '', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0012', 'PT. Klin', 'Komplek Pertokoan Sedana, Teras Dewata Ruko No. 4', 'JL.0307', 'K.01', 'Pengelolaan dan Pembuangan Sampah yang tidak Berba', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KB04', '1', '1', null, '', '1', null, '', '', '1', '', '1', null, '2920/1/IP/PMA/2017', 'C-96,HT,03,02,thn 2014', '', '', '', '300000', '0', '2', '0', '6', '0', null, 'Oktober-Desember 2017', '0', '0', '0', 'KM.02', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0013', 'PT. Bali Affordable Lifestyle International', 'Lingkungan Semawang', 'JL.0315', 'K.01', 'Jasa Konsultasi Manajemen di bidang properti dan r', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS06', '1', '1', '1', '', null, null, '', '', null, '', '1', null, '', '1739/1/ip-pb/pma/2016', '', '', '', '200000', '0', '0', '0', '0', '0', null, 'Januari-Juni 2017', '0', '0', '0', 'KM.02', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0014', 'PT. Catalyze', 'No. 74, Six Point Building', 'JL.0247', 'K.01', 'Jasa Konsultasi Bisnis dan Manjemen', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS06', '1', '1', null, null, '1', '1', null, null, '1', null, '1', '1', null, null, null, null, null, '250000', '0', '1', '0', '6', '0', null, 'Juli-Desember 2015         \r\nJanuari-Juni 2016', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0015', 'PT. Gilontas Indonesia', 'Pelabuhan Benoa', 'JL.0311', 'K.01', 'Industri Pembekuan Ikan', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS02', null, null, null, '', '1', null, '', '', '1', '', '1', null, '', '', '', '', '', '5000000', '0', '6', '0', '91', '0', null, 'Juli-Desember 2016                      Januari-Juni 2017', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0016', 'PT. Pinisi Duta Bahari', 'No. 377', 'JL.0216', 'K.01', 'Jasa Rekreasi (Wisata Laut)', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS10', '1', '1', '1', null, '1', '1', null, null, '1', null, '1', null, null, null, null, null, null, '0', '14075977834', '4', '0', '33', '0', null, 'Juli-Desember 2015         \r\nJanuari-Juni 2016', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0017', 'PT. Dwi Mitra Nusantara', 'No. 46, Sanur Paradize Plaza Hotel & Suites ', 'JL.0215', 'K.01', 'Jasa Akomodasi (hotel)', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS06', '1', '1', null, null, '1', null, null, null, '1', null, '1', '1', null, null, null, null, null, '0', '249766370788', '1', '0', '368', '0', null, 'Januari-Juni 2016                      \r\nJuli-Desember 2016', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0018', 'PT. Acr Engineering Indonesia', 'No. 46 Desa Sindu Kelod', 'JL.0237', 'K.01', 'Instalasi Minyak dan Gas', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS06', '1', null, null, '', null, null, '', '', null, '', null, null, '944/1/IP-PB/PMA/2017', '', '', 'Th. 2', '', '0', '40000000000', '0', '0', '10', '0', null, '', '0', '0', '0', 'KM.04', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0019', 'PT. Invory International', 'Ruko Sanur No. 4', 'JL.0216', 'K.01', 'Jasa Konsultasi Bisnis dan Manjemen', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS09', '1', '1', null, '', '1', '1', '', '', null, '', '1', '1', '', '', '', '2014', '', '100000', '0', '1', '0', '7', '0', null, 'Oktober-Desember 2014  \r\nJanuari Maret 2015          \r\nApril-Juni 2015                           \r\nJuli-September 2015 \r\nOktober-Desember 2015                         \r\nJanuari-Maret 2016           \r\nApril-Juni 2016', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0020', 'PT. Bali Chili Travel', 'No. 47, Lingkungan Sindu Kaja', 'JL.0251', 'K.01', 'Jasa Biro Perjalanan Wisata', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS06', '1', null, null, '', '1', '1', '', '', '1', '', '1', '1', '', '', '', '2018', '', '0', '12000000000', '1', '0', '3', '0', null, 'Januari-juni 2017', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0021', 'PT. Buffalo Tours Indonesia', 'No. 9x', 'JL.0316', 'K.01', 'Jasa Biro Perjalanan Wisata', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS10', '1', '1', null, null, '1', null, null, null, null, null, '1', '1', null, null, null, null, null, '0', '43566391278', '4', '0', '25', '0', null, 'Juli-desember 2017', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0022', 'PT. Caputra Bumi Bahari', 'No. 96', 'JL.0317', 'K.01', 'Wisata Tirta', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS07', '1', null, '1', null, '1', '1', null, null, null, null, '1', null, null, null, null, null, null, '0', '36600000000', '10', '0', '25', '0', null, 'Juli-desember 2015', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0023', 'PT. Laut Salito', 'No. 30 B', 'JL.0318', 'K.01', 'Wisata Tirta dan Wisata Petualang Alam', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS06', null, null, null, '', '1', '1', '', '', '1', '', '1', '1', '1329/1/pma/2005', '', '', '', '', '250000', '0', '1', '0', '17', '0', null, 'Juli-Desember 2015          \r\nJanuari-Juni 2016                       \r\nJuli-Desember 2016', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0024', 'Technical Service, LLC', 'Istana Regensi Blok S No. 6', 'JL.0216', 'K.01', 'Procurement and Related Service', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS02', '1', null, '1', null, '1', null, null, null, null, null, '1', null, null, null, null, null, null, '0', '0', '5', '0', '26', '0', null, 'Periode 31 Desember 2015     \r\nPeriode 30 Desember 2016  ', '0', '0', '0', 'KM.02', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0025', 'PT. Unlimited Designs', 'No. 22 Lantai I', 'JL.0252', 'K.01', 'Jasa Perdagangan Ekspor', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS06', '1', null, '1', null, null, '1', null, null, null, null, '1', '1', null, null, null, null, null, '1225383', '0', '2', '0', '0', '0', null, 'Januari-Juni 2016                 \r\nJuli-Desember 2016', '0', '0', '0', 'KM.02', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0026', 'PT. Ligerindo Direct Selling', 'No. 245', 'JL.0216', 'K.01', 'Bidang Usaha Perdagangan Besar dan Penjualan Langs', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS06', null, null, null, '', null, null, '', '', null, '', null, null, '2822/1/IP/PMA/2015', '', '', '2018', '', '866667', '0', '0', '0', '24', '0', null, '', '0', '0', '0', 'KM.04', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0027', 'PT. Bali Galateya', 'No. 26', 'JL.0216', 'K.01', 'Konsultasi Manajement Lainnya', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS06', '1', '1', '1', '', '1', '1', '', '', '1', '', '1', '1', '1337/1/IP-PB/PMA/2015', '', '', '', '', '1200000', '0', '0', '0', '7', '0', null, 'April-Juni 2016                  \r\nOktober-Desember 2016', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0028', 'PT. Berlian Bagus Sukses', 'No. 72', 'JL.0216', 'K.01', 'Departement Store', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KT10', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '250000', '0', '0', '0', '0', '0', null, '', '0', '0', '0', 'KM.04', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0030', 'PT. Bali Nami Tour & Travel', 'Taman Mutiara No. A 14', 'JL.0023', 'K.01', 'Jasa Konsultasi Pariwisata', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KB04', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, '', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0031', 'PT. Mdf Pasific Indonesia', 'No. 379', 'JL.0216', 'K.01', 'Kegiatan Konsultasi manajement', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS10', '1', null, null, '', '1', '1', '', '', '1', '', '1', '1', '', '', '', '2020', '', '800000', '0', '1', '0', '11', '0', null, 'Januari-Maret 2017', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0033', 'PT. Batuan Gallery', 'No. 278', 'JL.0216', 'K.01', 'Galeri Seni', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS06', '1', null, null, null, null, null, null, null, null, null, '1', '1', null, null, null, null, null, '0', '1384124150', '1', '0', '11', '0', null, 'Januari-Juni 2016', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0034', 'PT. Diwangkara Holiday Villa Bali', 'No. 84 Pantai sanur Lingkungan banjar Dusun Anggarakasih', 'JL.0215', 'K.01', 'Jasa Konsultasi Bisnis', '', '', '', '', '0.000000', '0.000000', '', null, 'AHU-37698,40 10,2014', null, 'KS09', '1', '1', '1', '', null, null, '', '', null, '', '1', null, '1081/1/IP-PB PMA/2016', '', '', '', '', '1200000', '0', '0', '0', '7', '0', null, 'Januari-Juni 2016', '0', '0', '0', 'KM.03', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0035', 'PT. Ocean Love Studio Wedding Service ', 'No. 40 X', 'JL.0319', 'K.01', 'Even Organizer', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS05', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, '', '0', '0', '0', 'KM.03', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0036', 'PT. Southeast Asia Business Advisory', 'No. 107', 'JL.0216', 'K.01', 'Konsultasi Manajement Lainnya', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS09', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '1000000', '0', '0', '0', '14', '0', null, '', '0', '0', '0', 'KM.04', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0037', 'PT. Graha Sarana Duta', 'No. 33', 'JL.0222', 'K.01', 'Jasa Makanan dan Minuman', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS05', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, '', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0038', 'PT. Mozaic ', 'No. 140', 'JL.0251', 'K.01', 'Jasa Makanan dan Minuman', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS06', null, null, null, '', null, null, '11/987/4854/DS/BPPTSP&PM/2016', '12/987/4855/DS/BPPTSP&PM/2016', null, '22,09,1,56,00641', null, null, '158/1/IP-PL/PMA/2016', '', '', '', '', '0', '0', '0', '0', '0', '0', null, '', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0039', 'PT. Sino Pacific Properties', 'No. 51A, Banjar Semawang', 'JL.0252', null, null, '', '', '', '', null, null, null, null, null, null, 'KS06', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0040', 'PT. Wynncor Bali (Bali Hyatt Hotel)', 'No. 89', 'JL.0251', 'K.01', 'Jasa Akomodasi (hotel)', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS06', '1', '1', null, null, '1', null, null, null, '1', null, null, '1', null, null, null, null, null, '8000000', '0', '0', '0', '400', '0', null, '', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0041', 'PT. Cahaya Bangkit Bersinar', 'No. 33 Blok II', 'JL.0216', null, null, '', '', '', '', null, null, null, null, null, null, 'KS09', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0042', 'PT. Healthylife International Indonesia', 'Perkantoran Sunset Point HS10', 'JL.0216', 'K.01', 'Perdagangan Besar', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS10', null, null, null, '', null, null, '', '', null, '', null, null, '2122/1/IP/PMA/2015', '', '', '', '', '1200000', '0', '0', '0', '15', '0', null, '', '0', '0', '0', 'KM.04', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0043', 'PT. Hatindo Makmur ', 'III No. 2 Pelabuhan Benoa', 'JL.0311', null, null, '', '', '', '', null, null, null, null, null, null, 'KS02', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0045', 'PT. Hotel Batara Bali Indonesia ', ' ', 'JL.0320', null, null, '', '', '', '', null, null, null, null, null, null, 'KS09', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0046', 'PT. Appkey', 'III No. 3', 'JL.0321', 'K.01', 'Jasa Pemrograman Komputer, Jasa Konsultasi Kompute', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KT06', '1', '1', '1', null, '1', '1', null, null, '1', null, '1', '1', null, null, null, null, null, '1200000', '0', '1', '0', '6', '0', null, 'Januari-Juni 2016', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0047', 'PT. Nxst Architects Planners', 'VI No. 4', 'JL.0228', null, null, '', '', '', '', null, null, null, null, null, null, 'KS05', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0048', 'PT. STS Bali', 'No. 6A', 'JL.0322', 'K.01', 'Perdagangan Besar', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KT10', '1', null, '1', null, '1', '1', null, null, null, null, '1', '1', null, null, null, null, null, '2000000', '0', '0', '0', '15', '0', null, 'Januari-Juni 2017                               \r\nJuli-Desember 2017', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0049', 'PT. Wood Group Asia', 'No. 26 A, Lantai II', 'JL.0216', 'K.01', 'Real Estate yang dimiliki Sendiri Atau disewa', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KT10', null, null, null, '', null, null, '', '', null, '', '1', null, '', '', '', '2017', '', '3800000', '0', '0', '0', '17', '0', null, 'Oktober-Desember 2016', '0', '0', '0', 'KM.04', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0050', 'PT. Real Dream Bali', 'No. 88', 'JL.0153', 'K.01', 'Perdagangan Besar', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KT04', '1', '1', '1', '', '1', '1', '', '', '1', '', '1', '1', '542/1/ip-pb/pma/2015', '2576/1/ip-pb/pma/2016', '', '2018', '', '1000000', '0', '0', '0', '10', '0', null, 'Oktober-Desember 2016', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0051', 'PT. One Island Korpora', 'No. 20 A, Br. Kedaton', 'JL.0320', 'K.01', 'Real Estate yang dimiliki Sendiri Atau disewa', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KT11', null, null, null, '', null, null, '', '', null, '', null, null, '528/1/IP-PB/PMA/2016', '', '', '', '', '0', '0', '0', '0', '0', '0', null, '', '0', '0', '0', 'KM.04', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0052', 'PT. Ida', 'No. 20 A, Br. Kedaton', 'JL.0320', 'K.01', 'Real Estate yang dimiliki Sendiri Atau disewa', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KT11', null, null, null, null, null, null, null, null, null, null, '1', null, null, null, null, null, null, '250000', '0', '1', '0', '7', '0', null, 'Juli-Desember 2015', '0', '0', '0', 'KM.04', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0054', 'PT. East Indo Fair Traiding', 'No. 20 A, Br. Kedaton', 'JL.0320', 'K.01', 'Perdagangan Besar', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KT11', '1', null, '1', null, null, '1', null, null, null, null, '1', '1', null, null, null, null, null, '0', '46969042877', '2', '0', '30', '0', null, 'Januari-Juni 2016', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0055', 'PT. West Indies Trading', 'III No. 122', 'JL.0312', null, null, '', '', '', '', null, null, null, null, null, null, 'KS01', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0056', 'PT. Bali Baci', '1/2', 'JL.0323', 'K.01', 'Perdagangan Besar dan Konsultasi Manajemen Lainnya', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KU01', '1', null, '1', null, '1', '1', null, null, null, null, '1', '1', null, null, null, null, null, '500000', '0', '0', '0', '15', '0', null, 'Juli-Desember 2016', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0057', 'PT. Silolona Sojourns ', 'No. 8. Br. Blanjong', 'JL.0227', null, null, '', '', '', '', null, null, null, null, null, null, 'KS10', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0058', 'PT. Pomodoro Indonesia', 'No. 371', 'JL.0043', 'K.01', 'Restoran', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KU01', '1', null, null, null, null, '1', null, null, '1', null, null, '1', null, null, null, null, null, '350000', '0', '0', '0', '28', '0', null, '', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0059', 'PT. Indonesia Smart Art', 'II No. 12', 'JL.0324', 'K.01', 'Galeri Seni', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KU06', '1', null, null, null, '1', '1', null, null, '1', null, '1', '1', null, null, null, null, null, '250000', '0', '0', '0', '10', '0', null, 'Juli-Desember 2016', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0060', 'PT. Ekumenik Bukit Bali', 'No. 888', 'JL.0043', 'K.01', 'Perdagangan Besar', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KU04', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '1200000', '0', '0', '0', '15', '0', null, '', '0', '0', '0', 'KM.04', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0061', 'PT. Samantha Sung Bali', 'Gg. Indus No. 71 A', 'JL.0001', 'K.01', 'Industri Pakaian Jadi dari Rekstil', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KU04', '1', null, null, null, '1', '1', null, null, '1', null, null, '1', null, null, null, null, null, '0', '0', '1', '0', '44', '0', null, '', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0062', 'PT. Inducomp Dewata', 'No. 52, Dusun belong gede', 'JL.0024', 'K.01', 'Industri Motor Listrik, Generator dan Transformato', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KU04', '1', null, null, null, '1', null, null, null, '1', null, '1', '1', null, null, null, null, null, '0', '4000000000', '0', '0', '219', '0', null, 'Januari -Juni 2017               \r\nJuli-Desember 2017', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0063', 'PT. By Lin Bali', 'Gg. Tegal mawar Br. Tegalbuah', 'JL.0002', 'K.01', 'Perdagangan Besar', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KB01', '1', '1', null, null, '1', null, null, null, '1', null, null, '1', null, null, null, null, null, '1200000', '0', '0', '0', '25', '0', null, '', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0064', 'PT. Republik Soap Bali', 'Gg. Tegal mawar Br. Tegalbuah', 'JL.0002', 'K.01', 'Industri sabun dan bahan pembersih keperluan rumah', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KB01', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, '', '0', '0', '0', 'KM.04', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0065', 'PT. Benteng Connect International', 'No. 80, Dusun tegalbuah', 'JL.0002', 'K.01', 'Penyelenggara pertemuan, perjalanan insentif, konf', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KB01', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, '', '0', '0', '0', 'KM.04', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0066', 'PT. Bali Moon', 'No. 64', 'JL.0216', 'K.01', 'Minuman Mengandung Alkohol Golongan C', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KT10', '1', '1', '1', null, '1', '1', null, null, '1', null, null, '1', null, null, null, null, null, '0', '12000000000', '0', '0', '28', '0', null, '', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0067', 'PT. Take Off', 'No. 18 A', 'JL.0049', 'K.01', 'Wisata Tirta', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KB04', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, '', '0', '0', '0', 'KM.04', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0068', 'PT. Lorenz Marble', 'Selatan', 'JL.0289', 'K.01', 'Perdagangan Besar ', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KB01', '1', null, '1', '', '1', '1', '', '', null, '', '1', '1', '', '', '', '2018', '', '1000000', '0', '0', '0', '0', '0', null, 'Juli-Desember 2016', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0069', 'PT. San Juan Ventures Bali', 'No. 758', 'JL.0289', 'K.01', 'Perdagangan Ekspor dan Impor', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KB10', '1', '1', '1', '', '1', '1', '', '', '1', '', '1', null, '', '', '', '2018', '', '0', '2300000000', '1', '0', '13', '0', null, 'Januari-Juni 2015', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0070', 'PT. Tirta Investama', 'No. 117', 'JL.0289', 'K.01', 'Distributor Air Minum Dalam Kemasan', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KB01', '1', null, null, null, '1', null, null, null, '1', null, null, null, null, null, null, null, null, '0', '822700000000', '0', '0', '32', '0', null, '', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0071', 'PT. Kapit Mas', 'No. 10', 'JL.0038', 'K.01', 'Industri Perhiasan', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KB01', '1', null, '1', null, '1', null, null, null, '1', null, '1', '1', null, null, null, null, null, '298000', '0', '3', '0', '212', '0', null, 'Juli-Desember 2016', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0072', 'PT. Dreamcatchers', 'Gg. Asm VI No. 6', 'JL.0021', 'K.01', 'Kegiatan Konsultasi Manajemen lainnya', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KB11', null, null, null, null, null, null, null, null, null, null, '1', null, null, null, null, null, null, '1250000', '0', '0', '0', '0', '0', null, 'Juli-Desember 2016', '0', '0', '0', 'KM.04', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0073', 'PT. Siobhan & Fionnuala', 'Tegal Dukuh 2 Penamparan', 'JL.0325', 'K.01', 'Industri Pakaian Jadi (Konveksi) Dari Tekstil', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KB01', '1', null, '1', '', '1', '1', '', '', '1', '', '1', '1', '', '', '', '2016', '', '1200000', '0', '0', '0', '0', '0', null, 'Juli-Desember 2016', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0074', 'PT. United Indobali', 'No. 537', 'JL.0023', 'K.01', 'Perdagangan Besar', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KB04', '1', '1', '1', null, '1', '1', null, null, '1', null, '1', '1', null, null, null, null, null, '0', '36000000000', '2', '0', '22', '0', null, 'Oktober-Desember 2015', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0075', 'PT. Earl Wedding Photo', 'Rukan Taman Mutiara Blok B3, Br. Margaya', 'JL.0023', 'K.01', 'Jasa Impresariat Bidang Seni', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KB04', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, '', '0', '0', '0', 'KM.04', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0076', 'PT. Edo', 'Komp. Pertokoan Sedana Teras Dewata No. 4', 'JL.0307', 'K.01', 'Perdagangan Besar dan Jasa Pelayanan Purna Jual', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KB04', null, null, null, null, null, null, null, null, null, null, '1', null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, 'Juli-Desember 2017', '0', '0', '0', 'KM.03', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0077', 'PT. Matahari Department Store Tbk.', 'No. 4G Duta Plaza', 'JL.0130', 'K.01', 'Perdagangan Eceran berbagai macam barang yang utam', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KB09', '1', null, null, null, '1', null, null, null, '1', null, '1', null, null, null, null, null, null, '0', '27965247945', '0', '0', '121', '0', null, 'April-Juni 2016', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0078', 'PT. Tour East Indonesia', 'No. 15 X, Dusun Br. Ambengan', 'JL.0267', 'K.01', 'Jasa Biro Perjalanan Wisata', '', '', '', '', '0.000000', '0.000000', '39.', '2017-01-24', '235/1/IP-PB/PMA/2017', null, 'KS02', '1', '1', '1', '', '1', '1', '11/581/2954/DS/DPMPTSP/2017', '12/432/2953/DS/DPMPTSP/2017', null, '22,09,1,79,00270', '1', null, '235/1/IP-PB/PMA/2017', '235/1/IP-PB/PMA/2017', '', '', '127/1/IU/PMA/2017', '250000', '0', '1', '0', '68', '0', null, 'Juli-Desember 2017', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0079', 'PT. Madisia Andaru Indonesia', '101', 'JL.0070', 'K.01', 'Real Estate yang dimiliki Sendiri Atau disewa dan ', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KB03', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, '', '0', '0', '0', 'KM.04', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0080', 'PT. Camelina Asia', 'No. 4X, Babakan Sari', 'JL.0222', 'K.01', 'Perdagangan Besar', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KT09', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, '', '0', '0', '0', 'KM.04', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0081', 'PT. Saudara Dua Bangsa', 'No. 110 B', 'JL.0153', 'K.01', 'Perdagangan Ekspor dan Impor', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KT04', null, null, null, null, null, null, null, null, null, null, '1', null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, 'Juli-Desember 2016', '0', '0', '0', 'KM.04', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0082', 'PT. Black Manta Bali', 'No. 11X, Dusun Br. Kedaton', 'JL.0201', null, 'Wisata Selam', '', '', '', '', null, null, '', null, '', null, 'KT11', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, '', '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0083', 'PT. Bali Renewable Energy Indonesia', ' ', 'JL.0326', 'K.01', 'Pengelolaan dan Pembuangan Sampah Tidak Berbahaya', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS03', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, '', '0', '0', '0', 'KM.04', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0084', 'PT. Tal Ausindo Logistics', 'No. 59', 'JL.0252', 'K.01', 'Jasa Pengurusan Transportasi', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS10', null, null, '1', '', '1', '1', '', '', null, '', '1', null, '197/1/IP/PMA/2016', '', '', '2019', '', '0', '140000000000', '0', '0', '8', '0', null, 'Januari -maret 2016, April - Juni 2016, Juli - September 2016, Oktober - Desember 2016', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0085', 'PT. Resort Bali Hospitality', 'IV', 'JL.0327', 'K.01', 'Real Estate yang dimiliki sendiri atau disewa', '', '', '', '', '0.000000', '0.000000', '20.', '2016-03-28', 'AHU-0018292.AH.01.01', null, 'KS10', '1', null, null, '', '1', null, '11/1425/7031/DS/BPPTSP&PM/2016', '12/1425/7032/DS/BPPTSP&PM/2016', '1', '22.09.1.68.00846', '1', null, '165/1/IP/PMA/2016', '897/1/IP-PB/PMA/2017', '', '2019', '387/1/IU/PMA/2017', '450000', '0', '0', '0', '5', '0', null, 'Januari-Juni 2017', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0086', 'PT. Wellness Cruise', ' ', 'JL.0328', 'K.01', 'Wisata Tirta', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS02', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, '', '0', '0', '0', 'KM.04', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0087', 'PT. Pan Pacific Vacation Group', 'No. 7', 'JL.0244', 'K.01', 'Wisata Tirta', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS10', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, '', '0', '0', '0', 'KM.04', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0089', 'PT. Bali Sukses Trading', 'No. 95', 'JL.0329', 'K.01', 'Perdagangan Besar', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS03', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, '', '0', '0', '0', 'KM.04', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0090', 'PT. Sanur Property Developments', 'gang I No. 27', 'JL.0243', 'K.01', 'Real Estate yang dimiliki sendiri atau disewa', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS06', '1', null, '1', '', null, null, '', '', null, '', '1', '1', '1139/1/IP/PMA/2016', '1586/1/IP-PB/PMA/2017', '', '2019', '', '0', '15067095924', '0', '0', '12', '0', null, 'April-Juni 2017', '0', '0', '0', 'KM.02', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0091', 'PT. Jiwa Dimangkok Bali', 'No. 180', 'JL.0251', 'K.01', 'Jasa Makanan dan Minuman', '', '', '', '', '0.000000', '0.000000', '15.', '2014-10-15', 'AHU-0940486.AH.01.02', null, 'KS06', '1', null, null, '', '1', null, '', '', '1', '', null, '1', '1495/1/IP/PMA/2016', '', '', '2019', '', '0', '15000000000', '0', '0', '25', '0', null, '', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0092', 'PT. Bali Drone Production', 'II, Gg. Cendana,', 'JL.0244', 'K.01', 'Aktivitas Produksi Film, Video dan program televis', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS06', null, null, null, '', null, null, '', '', null, '', null, null, '1905/1/ip/pma/2016', '', '', '', '', '0', '0', '0', '0', '0', '0', null, '', '0', '0', '0', 'KM.04', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0093', 'PT. Barb Sport Bar', 'No. 108', 'JL.0251', 'K.01', 'Jasa Makanan dan Minuman', '', '', '', '', '0.000000', '0.000000', '24.', '2016-06-23', 'AHU-0033931.AH.01.01', null, 'KS06', '1', '1', '1', '', '1', null, '11/702/4420/DS/DPMPTSP/2017', '12/522/4419/DS/DPMPTSP/2017', '1', '22,09,1,56,00856', null, null, '1588/1/IP/PMA/2016', '', '', '2019', '', '1000000', '0', '0', '0', '35', '0', null, '', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0094', 'PT. Gaya Sejati Abadi', 'No. 100, Lingk. Pesanggaran', 'JL.0216', 'K.01', 'SPA (Sante Par Aqua)', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS02', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, '', '0', '0', '0', 'KM.04', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0095', 'PT. Nano Energi Gemilang', 'No. 315', 'JL.0330', 'K.01', 'Perdagangan Besar', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS08', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, '', '0', '0', '0', 'KM.02', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0096', 'PT. Leather Asia Bali', 'No. 888', 'JL.0216', 'K.01', 'Perdagangan Besar', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS06', null, null, null, '', null, null, '', '', null, '', null, null, '2766/1/IP/PMA/2016', '61,20/10/2016', '', '2019', '', '1000000', '0', '0', '0', '8', '0', null, '', '0', '0', '0', 'KM.02', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0097', 'PT. Into Success Jaya', 'No. 20 Lingkungan Br. Taman Sari', 'JL.0331', 'K.01', 'Perdagangan Besar', '', '', '', '', '0.000000', '0.000000', '77.', '2015-11-30', 'AHU,00007,22,AH,01,0', null, 'KS03', '1', null, '1', '', '1', '1', '11/348/1613/DS/DPMPTSP/2017', '', '1', '22,09,1,46,00159', '1', '1', '1691/1/IP-PB/PMA/2016', '77,30 november 2017', '', '', '1584/1/IU/PMA/2017', '800000', '0', '0', '0', '10', '0', null, '', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0098', 'PT. Kauffman Solutions INC', 'Gg. SSK No. 3', 'JL.0332', 'K.01', 'Aktivitas Perancangan Khusus', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS06', '1', '1', '1', '', '1', '1', '11/912/5366/DS/DPMPTSP/2017', '', null, '22,09,1,74,00946', null, '1', '3414/1/IP/PMA/2016', '3414/1/IP/PMA/2016', '2019', '', '', '800000', '0', '0', '0', '5', '0', null, '', '0', '0', '0', 'KM.02', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0099', 'PT. Juicy and Crispy', 'I No. 5, Belanjong', 'JL.0244', 'K.01', 'Jasa Makanan dan Minuman', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS10', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, '', '0', '0', '0', 'KM.04', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0100', 'PT. Collins Higgins Consulting Indonesia', ' No. 1XX, Dusun Betngandang', 'JL.0242', null, null, '', '', '', '', null, null, null, null, null, null, 'KS10', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0101', 'PT. Angeliques Yoga Studio', ' ', 'JL.0227', null, null, '', '', '', '', null, null, null, null, null, null, 'KS06', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0102', 'PT. Bali Turtle Island Development', 'Simpang Serangan No. 1', 'JL.0216', null, null, '', '', '', '', null, null, null, null, null, null, 'KS01', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0103', 'PT. Cipta Cahaya Bersinar', 'No. 33/Blok II', 'JL.0216', null, null, '', '', '', '', null, null, null, null, null, null, 'KS09', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0104', 'PT. Compressed Air Technologies', 'No. 352', 'JL.0216', null, null, '', '', '', '', null, null, null, null, null, null, 'KS06', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0105', 'PT. Salty Skin Fashion', 'Perum Graha Yoni Selaras No. 10', 'JL.0333', null, null, '', '', '', '', null, null, null, null, null, null, 'KS08', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0106', 'PT. Inti Bali Prioritas', '9X Graha Dewata Asih No. 5', 'JL.0216', 'K.01', 'Perdagangan Besar', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS06', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, '', '0', '0', '0', 'KM.03', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0107', 'PT. FOUR KING CRUISES', '455A', 'JL.0253', 'K.01', 'Jasa Transportasi Wisata dan Wisata Tirta', '', '', '', '', '0.000000', '0.000000', '28.', '2016-10-28', 'AHU,0050459 AH,01,01', null, 'KS07', '1', '1', null, '', '1', null, '11/641/3923/DS/DPMPTSP/2017', '12/484/3902/DS/DPMPTSP/2017', null, '', null, '1', '2167/1/IP/PMA/2016', '', '', '', '', '0', '20200000000', '0', '0', '29', '0', null, '', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0109', 'PT. Bali Mega Energy', 'TPA Regional sarbagita Suwung', 'JL.0216', null, null, '', '', '', '', null, null, null, null, null, null, 'KS03', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0110', 'PT. Chantara Wellness Bali', 'No. 104', 'JL.0252', 'K.01', 'Aktivitas SPA (Sante Par Aqua)', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS06', '1', null, '1', '', '1', '1', '11/1118/5465/DS/BPPTSP&PM/2016', '12/1118/5466/DS/BPPTSP&PM/2016', null, '22,09,1,96,00695', '1', null, '1070/1/IP/PMA/2017', '01,07/01/2016', '', '', '', '0', '12000000000', '0', '0', '15', '0', null, 'Januari-Maret 2017, April-Juni 2016, Juli-September 2016,Oktober - Desember 2017', '0', '0', '0', 'KM.02', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0111', 'PT. Somia Customer Experience', 'No. 45 X, Br. Sakah', 'JL.0216', null, null, '', '', '', '', null, null, null, null, null, null, 'KS08', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0112', 'PT. Indonesia Spearfishing Carter', 'No. 306', 'JL.0334', 'K.01', 'Wisata Tirta', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KT10', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, '', '0', '0', '0', 'KM.04', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0113', 'PT. New Nordic Indonesia', 'No. 10', 'JL.0243', null, null, '', '', '', '', null, null, null, null, null, null, 'KS06', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0114', 'PT. Southeast Partnership Indonesia', 'Br. Yangbatu Kangin', 'JL.0283', 'K.01', 'Aktivitas Konsultasi Manajemen Lainnya', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KT06', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, '', '0', '0', '0', 'KM.04', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0115', 'PT. Eco Lifestyle', 'No. 116-118, Dusun Peken', 'JL.0259', null, null, '', '', '', '', null, null, null, null, null, null, 'KS05', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0116', 'PT. Loudwater Management Consultans', ' ', 'JL.0335', 'K.01', 'Real Estate yang dimiliki Sendiri Atau disewa', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KT03', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, '', '0', '0', '0', 'KM.04', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0117', 'PT. Bali Pertiwi Travel Factory', 'Perum Istana Regency, Blok L.15 Lingkungan Pesanggaran', 'JL.0216', null, null, '', '', '', '', null, null, null, null, null, null, 'KS02', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0118', 'PT. Destination Domestic Asia', 'No. 79', 'JL.0313', null, null, '', '', '', '', null, null, null, null, null, null, 'KS04', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0119', 'PT. Ezee Technosys Pvt, Ltd.', 'No. 505 Galeri Ikat Building Blok B.303', 'JL.0216', 'K.01', 'Software', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS08', null, null, null, '', null, null, '', '', null, '', null, null, '132/1/KPPA/2016', '', '', '', '', '0', '0', '0', '0', '0', '0', null, '', '0', '0', '0', 'KM.04', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0120', 'PT. Intisamudera Citra Perkasa', 'III No. 1, Pelabuhan Benoa', 'JL.0311', null, null, '', '', '', '', null, null, null, null, null, null, 'KS02', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0121', 'PT. Sanur Indah ', 'No 19', 'JL.0238', 'K.01', 'Property', '', '', '', '', '0.000000', '0.000000', '21.', '2016-02-27', 'AHU-0004375.AH.01.02', null, 'KS06', '1', null, '1', '', '1', '1', '', '', null, '', null, '1', '629/1/IP-PB/PMA/2016', '629/1/IP-PB/PMA/2016', '', '', '76/T/Perdangangan/2003', '300000', '0', '2', '0', '3', '0', null, '', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0122', 'PT. Active Waters', 'No. 14 B', 'JL.0247', null, null, '', '', '', '', null, null, null, null, null, null, 'KS06', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0123', 'PT. Sunrise Yang Indonesia', ' ', 'JL.0336', null, null, '', '', '', '', null, null, null, null, null, null, 'KS03', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0124', 'Juno Creative Pty Ltd', 'No. 245', 'JL.0216', null, null, '', '', '', '', null, null, null, null, null, null, 'KS06', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0125', 'PT. Bali Wood Organik', 'IV Blok H No. 7', 'JL.0331', null, null, '', '', '', '', null, null, null, null, null, null, 'KS03', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0126', 'PT. Mega Blue Rock ', 'No 214', 'JL.0216', 'K.01', 'Wisata Selam', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS09', null, null, null, '', null, null, '', '', null, '', null, null, '4761/1/IP-PB/PMA/2016', '', '', '4671/', '', '0', '0', '0', '0', '0', '0', null, '', '0', '0', '0', 'KM.02', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0127', 'PT. Royal Resort Internasional', 'No 61 Suwung Kauh', 'JL.0216', 'K.01', 'Manajemen Hotel', '', '', '', '', '0.000000', '0.000000', '11.', '2011-09-07', 'AHU.59092.AH.01.01.T', null, 'KS08', '1', null, '1', '', '1', null, '11b/1369/6770/DS/BPPTSP&PM/201', '12b/1369/6771/DS/BPPTSP&PM/201', '1', '22.09.1.70.00820', '1', '1', '', '789/1/IP-PB/PMA/2013', '', '', '895/1/IU/I/PMA/PARIWISATA/2012', '400000', '0', '10', '0', '205', '0', null, 'Januari-Juni 2017', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0128', 'PT. Klassys It', 'Unit J Br Kajeng', 'JL.0216', 'K.01', 'Programer Computer ', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS08', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, '', '0', '0', '0', 'KM.04', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0129', 'PT. Utz B.V ( The Sanur Pace )', 'No 16 Lingkungan Pasekuta', 'JL.0212', 'K.01', 'Jasa Sertifikasi', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS06', null, null, null, '', null, null, '', '', null, '', null, null, '', '', '', '', 'No. 238/1/IUP3A-T/P-1/Nas/2016', '0', '0', '0', '0', '0', '0', null, '', '0', '0', '0', 'KM.04', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0130', 'PT. Alas Kusuma Jaya ', 'No. 109', 'JL.0251', 'K.01', 'Jasa Makanan Dan Minuman ', '', '', '', '', '0.000000', '0.000000', '', null, 'AHU-0038293.AH.01.01', null, 'KS06', '1', null, null, '', '1', null, '', '', null, '', null, '1', '2244/1/IIP/PMA/2016', '', '', '2019', '', '1200000', '0', '2', '0', '7', '0', null, '', '0', '0', '0', 'KM.02', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0131', 'PT. It Simply Flows', 'No 03', 'JL.0337', 'K.01', 'Konsultasi Manajemen Lainnya', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS06', '1', null, '1', '', '1', '1', '11/1261/10831/DS/BPPTSP&PM/201', '12/1261/10832/DS/DPMPTSP/2015', '1', '22,09,1,7070,00861', null, '1', '3263/1/IP-PB/PMA/2016', '3263/1/IP-PB/PMA/2016', '', '', '579/1/IU/PMA/2017', '1253000', '0', '0', '0', '5', '0', null, '', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0132', 'PT. Three Brothers Sanur', 'I No 100x', 'JL.0223', 'K.01', 'Wisata Tirta', '', '', '', '', '0.000000', '0.000000', '13.', '2016-11-02', 'AHU-0048938.AH.01.01', null, 'KS03', '1', null, '1', '', '1', '1', '11/271/1212/DS/DPMPTSP/2017', '12/194/1213/DS/DPMPTSP/2017', '1', '22.09.1.93.00127', null, null, '2961/1/IP/PMA/2016', '441/1/IP-PB/PMA/2016', '', '', '', '1200000', '0', '0', '0', '10', '0', null, '', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0133', 'PT. Sirius ', ' ', 'JL.0236', 'K.01', 'Hotel Melati', '', '', '', '', '0.000000', '0.000000', '47', '2010-06-25', 'AHU-42889.AH.01.01.T', null, 'KS06', '1', '1', '1', '', '1', '1', '11b/542/2632/DS/BPPTSP&PM/2016', '12b/542/2633/DS/BPPTSP&PM/2016', '1', '22.09.1.55.00439', null, '1', '399/1/IP/PMA/2016', '47, 25 juni 2017', '', '2019', '343/1/IU/PMA/2016', '975000', '0', '0', '0', '25', '0', null, '', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0134', 'PT. Rivulet', 'No 1 Suwung', 'JL.0338', 'K.01', 'Real Estate yang dimiliki Sendiri Atau disewa', '', '', '', '', '0.000000', '0.000000', '20.', '2014-02-27', 'AHU-13765.AH.01.01.T', null, 'KS03', '1', null, '1', '', '1', '1', '11/621/3248/DS/BPPTSP&PM/2014', '11/621/3248/DS/BPPTSP&PM/2014', null, '22.09.1.68.00412', '1', '1', '500/1/IP/PMA/2014', '', '', '2017', '', '2940000', '0', '0', '0', '25', '0', null, 'Juli-September 2017', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0135', 'Akvo Pte, Ltd ', 'No 28, Peken', 'JL.0339', 'K.01', 'KPPA', '', '', '', '', '0.000000', '0.000000', '', '2015-01-21', '', null, 'KS05', '1', null, null, '', '1', '1', '11/76/343/DS/DPMPTSP/2017', '12/49/344/DS/DPMPTSP/2017', '1', '22.09.6.62.00001', null, '1', '', '183/1/KPPA-PB/2016', '', '', '', '0', '0', '0', '0', '3', '0', null, '', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0136', 'PT. Taman Kartika Bahari ', 'XXI / IA No 12', 'JL.0290', 'K.02', 'Wisata Tirta', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS05', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, '', '1', '0', '0', 'KM.04', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0137', 'PT. Exotic Yacht Charter Bali', '106', 'JL.0312', 'K.01', 'Wisata Tirta', '', '', '', '', '0.000000', '0.000000', '11.', '2016-02-03', 'AHU-31765.AH.01.02.T', null, 'KS01', '1', null, '1', '', '1', null, '11b/121/467/DS/BPPTSP&PM/2016', '12b/121/468/DS/BPPTSP&PM/2016', '1', '22.09.1.93.00050', '1', '1', '', '911/1/IP-PB/PMA/2016', '', '', '147/1/IU/I/PMA/PARIWISATA/2011', '2150000', '0', '0', '0', '13', '0', null, 'Juli-Desember 2016', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0138', 'PT. Island Explorer Cruises', 'I No 2, Pelabuhan Benoa Lingkungan Pesanggaran', 'JL.0340', 'K.01', 'Wisata Tirta', '', '', '', '', '0.000000', '0.000000', '23', '1996-10-15', 'AHU-79703.AH.01.02.T', null, 'KS02', '1', null, null, '', '1', null, '', '', '1', '', null, null, '', '2925/1/IP-PB/PMA/2016', '137/II/PMA/1999', '', '255/T/PARSENIBUD/1998', '700000', '0', '0', '0', '80', '0', null, '', '0', '0', '0', 'KM.03', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0139', 'PT. The Lighthouse Consultancy', 'Pertokoan Niaga 5/6', 'JL.0216', 'K.01', 'Konsultasi Manajemen Lainnya', '', '', '', '', '0.000000', '0.000000', '08.', '2016-09-16', 'AHU-0020237.AH.01.02', null, 'KS06', '1', null, null, '02522/1/PPM/PMA/2010   ', '1', null, '11/261/1164/DS/DPMPTSP/2017', '', '1', '22.09.1.70.00121', '1', '1', '', '2695/1/IP-PB/PMA/2017', '', '', '186/1/IU/I/PMA/PERDAGANGAN/201', '100000', '0', '3', '0', '10', '0', null, 'Juli-Desember 2016', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0140', 'PT. Island Management', 'II No. 5A/30', 'JL.0245', 'K.01', 'Kegiatan Konsultasi Manajemen', '', '', '', '', '0.000000', '0.000000', '30.', '2013-04-30', '', null, 'KT02', '1', null, '1', '949/1/PPM/I/PMA/2013', '1', '1', '11/1318/6504/DS/BPPTSP&PM/2016', '12/1318/6505/DS/BPPTSP&PM/2016', '1', '22.09.1.70.00793', '1', '1', '', '2664/1/IP_PB/PMA/2016', '', '', '284/1/IU/PMA/2014', '0', '0', '2', '0', '1', '0', null, 'Januari-Juli 2017', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0141', 'PT. Diving 4 Images', 'No. 47 Sanur, Lingkungan Taman', 'JL.0247', 'K.01', 'Jasa Rekreasi (Wisata Tirta)', '', '', '', '', '0.000000', '0.000000', '19.', '2016-08-08', 'AHU-AH.01.03-0081941', null, 'KS06', '1', null, '1', '', '1', null, '11/113/481/DS/DPMPTSP/2017', '12/76/482/DS/DPMPTSP/2017', '1', '22.09.1.93.00051', '1', '1', '', '3053/1/IP_PB/PMA/2016', '', '', '116/T/PARIWISATA/2005', '100000', '0', '3', '0', '10', '0', null, 'Januari-Juni 2017', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0142', 'PT. Bali Scuba', '40, Dusun Belanjong', 'JL.0252', 'K.01', 'Wisata Tirta', '', '', '', '', '0.000000', '0.000000', '5', '2013-02-01', 'AHU-AH.01.03-0084675', '2016-09-29', 'KS10', '1', null, '1', '', '1', null, '', '', null, '', null, '1', '', '3270/1/IP-PB/PMA/2016', '', '', '', '100000', '0', '7', '0', '28', '0', null, '', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0143', 'PT. Inner Seas Adventures', '1 No. 38X', 'JL.0223', 'K.01', 'Wisata Tirta', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS02', null, null, null, '', null, null, '', '', null, '', null, null, '', '', '', '', '235/1/IU/PMA/2017', '0', '0', '0', '0', '0', '0', null, '', '0', '0', '0', 'KM.04', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0144', 'PT. Daewon Trading Dewata', 'No. 22, Dusun Lingkungan Karya Dharma', 'JL.0341', 'K.01', 'Perdagangan Besar', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS03', null, null, null, '', null, null, '', '', null, '', null, null, '', '2302/1/IP-PB/PMA/2016', '', '', '', '0', '0', '0', '0', '0', '0', null, '', '0', '0', '0', 'KM.04', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0145', 'PT. Puncak Bali Dewata', 'No. 9', 'JL.0288', 'K.01', 'Biro Perjalanan Wisata', '', '', '', '', '0.000000', '0.000000', '03', '2016-08-09', 'AHU-45595.AH.01.02.T', null, 'KT09', '1', null, null, '', '1', '1', '11b/1413/6929/DT/BPPTSP&PM/201', '12b/1413/6930/DT/BPPTSP&PM/201', '1', '22.09.1.79.00842', '1', '1', '', '4299/1/IP_PB/PMA/2016', '', '', '404/T/PARSENIBUD/1998', '0', '250000000', '2', '0', '1', '0', null, 'Januari-Juni 2017', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0146', 'PT. Gedesign Pte. Ltd.', 'No. 167, Desa Suwung Kangin', 'JL.0227', 'K.01', 'Interior Design Services', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS07', '1', '1', null, '', '1', null, '11/1339/6596/DB/BPPTSP&PM/2016', '12/1339/6597/DB/BPPTSP&PM/2016', '1', '22.09.1.74.00806', null, '1', '', '', '', '', '74/1/KPPA/2016', '0', '0', '2', '0', '2', '0', null, '', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0147', 'PT. Indonusa Segara Marine', '(Zona Marina), Lingkungan Pesanggaran', 'JL.0328', 'K.01', 'Wisata Tirta', '', '', '', '', '0.000000', '0.000000', '', null, 'AHU-AH.01.03-0133177', null, 'KS02', '1', null, null, '', '1', null, '11b/896/4363/DS/BPPTSP&PM/2014', '12b/896/4364/DS/BPPTSP&PM/2014', '1', '22.09.1.93.00523', '1', '1', '1051/1/IP/PMA/2017', '', '', '2020', '', '0', '10800000000', '0', '0', '26', '0', null, 'Oktober-Desember 2015', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0148', 'PT. Next Generation Investment', 'Gg. Permata Jaya No. 12', 'JL.0342', 'K.01', 'Perdagangan Besar', '', '', '', '', '0.000000', '0.000000', '', null, 'AHU, 0005072,AH,01,0', null, 'KS08', '1', null, null, '', null, null, '', '', null, '', null, null, '', '', '', '', '77/1/IU/PMA/2017', '2000000', '0', '0', '0', '0', '0', null, '', '0', '0', '0', 'KM.04', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0149', 'PT. Romarko Business Solutions', ' ', 'JL.0329', 'K.01', 'Perdagangan Besar dan Kegiatan Konsultasi Manajeme', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS03', null, null, null, '', null, null, '', '', null, '', null, null, '', ' 189/I/IU-PB/PMA/2017', '', '', '', '0', '0', '0', '0', '0', '0', null, '', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0150', 'PT. Fuji Home Japan', ' ', 'JL.0292', 'K.01', 'Real Estate yang dimiliki Sendiri Atau disewa', '', '', '', '', '0.000000', '0.000000', '09', '2015-01-14', 'AHU-0000710.AH.01.02', null, 'KS04', '1', '1', '1', '', '1', null, '11/187/812/DS/DPMPTSP/2017', '', '1', '22.09.1.68.00084', '1', '1', '3509/1/IP/PMA/2014', '1580/1/IP-PB/PMA/2017', '', '2017', '', '0', '12000000000', '0', '0', '6', '0', null, '', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0151', 'PT. Aqualine', 'No. 53 Banjar Abasan Dusun Tegalbuah', 'JL.0310', 'K.01', 'Perdagangan Besar dan Jasa', '', '', '', '', '0.000000', '0.000000', '41.', '2011-09-23', 'AHU-0003677.AH.01.02', null, 'KB06', '1', null, '1', '2481/1/PPM/I/PMA/2011', '1', null, '11/698/3522/DB/BPPTSP&PM/2016', '12/698/3523/DB/BPPTSP&PM/2016', '1', '22.09.1.46.00510', null, '1', '', '760/1/IP-PB/PMA/2015', '42/1/IP-PL/PMA/2015', '2019', '983/1/IU/I/PMA/PERDAGANGAN/201', '1000000', '0', '1', '0', '16', '0', null, '', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0152', 'PT. Gelato Sinar Dewata ', 'No 5, Pertokoan Nakula Megah Blok H', 'JL.0049', 'K.01', 'Bidang Usaha Restoran', '', '', '', '', '0.000000', '0.000000', '03.', '2016-09-02', 'AHU-0017075.AH.01.02', null, 'KB04', '1', null, '1', '', '1', '1', '', '', '1', '', null, '1', '2959/1/IP-PB/PMA/2016', '', '', '', '', '0', '0', '0', '0', '0', '0', null, '', '0', '0', '0', 'KM.02', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0153', 'PT. Danmar Explorindo', 'No. 8 Lingkungan Buana Desa', 'JL.0343', 'K.01', 'Jasa Pertambangan Minyak Bumi Dan Gas Alam ', '', '', '', '', '0.000000', '0.000000', '28', '2000-10-09', 'AHU-AH.01.03-0966033', null, 'KB01', '1', '1', null, '', '1', '1', '11/84/378/DB/DPMPTSP/2017', '12/58/377/DB/DPMPTSP/2017', null, '22.09.1.09.00032', '1', '1', '', '4791/1/IP-PB/PMA/2016', '', '', '', '127000', '0', '0', '0', '0', '0', null, 'Januari-Juni 2017', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0154', 'PT. Living Stone ', 'Gang Cemara A No 4', 'JL.0267', 'K.01', 'Perdagangan Besar', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS02', null, null, null, '', null, null, '', '', null, '', null, null, '2787/1/IP/PMA/2015', '', '', '', '', '0', '0', '0', '0', '0', '0', null, '', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0155', 'PT. Aman Samudera Bali', 'No. 30, Desa Lingkungan Br. Dukuh Pesirahan', 'JL.0267', 'K.01', 'Wisata Tirta', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS02', null, '1', '1', '', '1', '1', '11b/1340/11189/DS/BPPTSP&PM/20', '12b/1340/11190/DS/BPPTSP&PM/20', null, '22.09.1.93.0089', null, '1', '', '2989/1/IP-PB/PMA/2015', '', '', '', '0', '0', '0', '0', '0', '0', null, 'januari-juni 2017, Juli-desember 2017', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0156', 'PT. Indonesia Yu Zhen Tranding', 'No 25', 'JL.0082', 'K.01', 'Perdagangan Ekspor dan impor', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KB09', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, '', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0157', 'DFS Singapore (PTE) Limited', ' ', 'JL.0216', null, null, '', '', '', '', null, null, null, null, null, null, 'KS08', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0158', 'PT. Amanaska', 'No. 12, Lingkungan Taman', 'JL.0344', null, null, '', '', '', '', null, null, null, null, null, null, 'KS06', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0159', 'PT. TRC Global Group', ' Galeri Seni Ikat Plasa No. 505', 'JL.0216', null, null, '', '', '', '', null, null, null, null, null, null, 'KS08', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0160', 'PT. Feed Your Soul', 'II, No. 20B', 'JL.0318', null, null, '', '', '', '', null, null, null, null, null, null, 'KS06', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0161', 'PT. Joe\'S Gone Diving', '44 A', 'JL.0216', null, null, '', '', '', '', null, null, null, null, null, null, 'KS06', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0162', 'PT. Royal Bismarck Forest', 'V No. 3A', 'JL.0291', null, null, '', '', '', '', null, null, null, null, null, null, 'KS05', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0167', 'PT. Fuzen Decor Bali', 'No. 444, Dusun Betngandang', 'JL.0216', null, null, '', '', '', '', null, null, null, null, null, null, 'KS10', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0168', 'PT. Hoo Holdings', 'Gang XI No. 1', 'JL.0070', null, null, '', '', '', '', null, null, null, null, null, null, 'KB09', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0169', 'PT. Tie Shen Trenchiess', 'No. 25', 'JL.0082', null, null, '', '', '', '', null, null, null, null, null, null, 'KB09', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0170', 'PT. Informatics Full Service', 'No. 27', 'JL.0306', null, null, '', '', '', '', null, null, null, null, null, null, 'KB09', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0171', 'Tradefirst Limited', 'No. 220', 'JL.0310', null, null, '', '', '', '', null, null, null, null, null, null, 'KB06', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0172', 'PT. Matahari Graha Fantasi', 'Level 21 Mall Denpasar Bali, Lantai 1 Unit FF.24', 'JL.0081', null, null, '', '', '', '', null, null, null, null, null, null, 'KB09', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0173', 'PT. Indico Natural Living', ' No. 313', 'JL.0002', null, null, '', '', '', '', null, null, null, null, null, null, 'KB01', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0174', 'PT. Elios Trading International', 'No. 2B', 'JL.0345', null, null, '', '', '', '', null, null, null, null, null, null, 'KB01', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0175', 'PT. Gelato Republic Bali', ' ', 'JL.0081', null, null, '', '', '', '', null, null, null, null, null, null, 'KB06', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0176', 'PT. Tirnanog Surf Quest', 'No. 177', 'JL.0081', null, null, '', '', '', '', null, null, null, null, null, null, 'KB08', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0177', 'PT. Bali Design Villas', ' ', 'JL.0023', null, null, '', '', '', '', null, null, null, null, null, null, 'KB04', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0178', 'PT. Italian Food Connection', 'No. 12', 'JL.0310', null, null, '', '', '', '', null, null, null, null, null, null, 'KB06', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0179', 'PT. Bali Comfort International', 'No. 69', 'JL.0067', null, null, '', '', '', '', null, null, null, null, null, null, 'KB02', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0180', 'PT. Yukti Karya Sayojya', 'Kompel Imam Bonjol Square 555 B, Blok AA 10', 'JL.0023', null, null, '', '', '', '', null, null, null, null, null, null, 'KB04', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0181', 'PT. Susila Export Bali', ' ', 'JL.0127', null, null, '', '', '', '', null, null, null, null, null, null, 'KB09', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0182', 'PT. Exertainment Indonesia', 'Lipo Plaza Sunset', 'JL.0294', null, null, '', '', '', '', null, null, null, null, null, null, 'KS08', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0183', 'PT. Samsung Electronics Indonesia', 'No. 57 Mekar Buana', 'JL.0289', null, null, '', '', '', '', null, null, null, null, null, null, 'KB01', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0184', 'PT. Facific Island Factory', 'No. 38', 'JL.0310', null, null, '', '', '', '', null, null, null, null, null, null, 'KB06', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0185', 'PT. Bali Animation Studio', 'IV No. 18 Lantai II', 'JL.0346', null, null, '', '', '', '', null, null, null, null, null, null, 'KB04', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0186', 'PT. Star Villas Bali', 'Ibis Style Business Complex Unit 3-4, No. 177', 'JL.0081', null, null, '', '', '', '', null, null, null, null, null, null, 'KB09', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0187', 'PT. Nusantara Sejahtera Raya', 'Level 21, Mall Level 21 Lantai 4, No.1', 'JL.0081', null, null, '', '', '', '', null, null, null, null, null, null, 'KB09', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0188', 'Bahia Ingatlanfejleszto Es Tanacsado Korlatolt Fel', 'No. 1', 'JL.0117', null, null, '', '', '', '', null, null, null, null, null, null, 'KB09', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0189', 'PT. Asia Fortune Food', ' ', 'JL.0023', null, null, '', '', '', '', null, null, null, null, null, null, 'KB04', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0190', 'PT. The Steak On The Stone Company Limited', 'Ibis Style Business Complex Unit 3-4, No. 177', 'JL.0081', null, null, '', '', '', '', null, null, null, null, null, null, 'KB09', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0191', 'PT. White Rabbit Consultans Pte. Ltd.', 'No. 177, Lingk. Bumi Werdhi', 'JL.0081', null, null, '', '', '', '', null, null, null, null, null, null, 'KB08', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0192', 'PT. Dion Putra Bintang', ' ', 'JL.0283', null, null, '', '', '', '', null, null, null, null, null, null, 'KT09', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0193', 'PT. Rijamo Flores Tourismus Services', 'VIII No. 9 Denpasar, Lingkungan Buaji Sari', 'JL.0347', null, null, '', '', '', '', null, null, null, null, null, null, 'KT02', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0194', 'PT. Saham Bagus Ink', 'No. 11X', 'JL.0201', null, null, '', '', '', '', null, null, null, null, null, null, 'KT11', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0195', 'PT. Far East Leaf Indonesia', ' XIII/IB, Br/Link. Badak Sari, Dusun Badak Sari', 'JL.0308', null, null, '', '', '', '', null, null, null, null, null, null, 'KT09', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0196', 'PT. STC Indonesia', 'No. 65', 'JL.0214', null, null, '', '', '', '', null, null, null, null, null, null, 'KU03', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0197', 'PT. Restu Dewata', 'DD No. 6 Banjar tengah Renon', 'JL.0314', null, null, '', '', '', '', null, null, null, null, null, null, 'KS05', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0198', 'PT. Bandar Nelayan', 'IV No. 8', 'JL.0311', null, null, '', '', '', '', null, null, null, null, null, null, 'KS02', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0199', 'PT. Asindo Minasegara', 'No. 36', 'JL.0348', null, null, '', '', '', '', null, null, null, null, null, null, 'KS08', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0200', 'PT. Dream Time', 'No. 76', 'JL.0002', null, null, '', '', '', '', null, null, null, null, null, null, 'KB06', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0201', 'PT. Seaquest Adventure', 'XVI No. 118X Lingkungan Br. Anyar', 'JL.0347', null, null, '', '', '', '', null, null, null, null, null, null, 'KT09', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0202', 'PT. Informatics All Service', 'No. 1A', 'JL.0100', null, null, '', '', '', '', null, null, null, null, null, null, 'KB09', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0203', 'PT. Unique Travel Adventures', 'No. 122 Br. Serangan', 'JL.0312', null, null, '', '', '', '', null, null, null, null, null, null, 'KS01', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0204', 'PT. Smart Freen Telecom Tbk', 'No. 226 A, Br. Sumuh', 'JL.0081', null, null, '', '', '', '', null, null, null, null, null, null, 'KB08', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0205', 'PT. Gili Breizh Divers', 'No. 70 X', 'JL.0216', null, null, '', '', '', '', null, null, null, null, null, null, 'KS09', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0206', 'PT. Vitta Universal Group', 'Gg. Tirtasari No. 9/11', 'JL.0267', null, null, '', '', '', '', null, null, null, null, null, null, 'KS02', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0207', 'PT. Vivo Bali Indonesia', 'Graha Mahkota A-9 RT000 RW010', 'JL.0081', null, null, '', '', '', '', null, null, null, null, null, null, 'KB09', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0208', 'PT. Rajawali Asia Bali', 'No. 299', 'JL.0349', null, null, '', '', '', '', null, null, null, null, null, null, 'KU06', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0209', 'PT. Mulia Usaha Bali', ' ', 'JL.0320', null, null, '', '', '', '', null, null, null, null, null, null, 'KT11', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0210', 'PT. Bali Shanti Cruises', 'No. 245', 'JL.0216', null, null, '', '', '', '', null, null, null, null, null, null, 'KS06', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0211', 'PT. Biru-Biru International', 'Ibis Style Business complek Unit 3-4, No.177', 'JL.0081', null, null, '', '', '', '', null, null, null, null, null, null, 'KB08', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0212', 'PT. Indonesia Adventure Cruises', ' No. 96 E', 'JL.0152', null, null, '', '', '', '', null, null, null, null, null, null, 'KS06', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0213', 'PT. Bluewater Safaris', 'IVA Dusun Badak Sari', 'JL.0308', 'K.01', 'Jasa Wisata Tirta A.L Fishing, Diving, Snorkeling,', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KT09', '1', '1', '1', null, null, null, null, null, null, null, '1', '1', null, null, null, null, null, '100000', '0', '2', '0', '12', '0', null, 'Januari-Juni 2017', '0', '0', '0', 'KM.02', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0214', 'PT. Citra Consultant Indonesia', ' ', 'JL.0350', null, null, '', '', '', '', null, null, null, null, null, null, 'KS10', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0215', 'PT. Mitchell John Marina', 'No 5', 'JL.0315', null, null, '', '', '', '', null, null, null, null, null, null, 'KS06', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0216', 'PT. Wood Group Asia', 'No 287', 'JL.0216', null, null, '', '', '', '', null, null, null, null, null, null, 'KS06', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0217', 'Samudra Dua Bangsa ', ' ', 'JL.0227', null, null, '', '', '', '', null, null, null, null, null, null, 'KS06', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0218', 'PT. Pacific Island Factory ', 'No 38', 'JL.0310', null, null, '', '', '', '', null, null, null, null, null, null, 'KB06', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0219', 'PT. Banteng Connect Internasional ', 'No 80 Dusun Tegal Buah', 'JL.0002', null, null, '', '', '', '', null, null, null, null, null, null, 'KB06', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0220', 'PT. Hamatomo Trading Indonesia', 'Gang Swastiastu No 11', 'JL.0351', null, null, '', '', '', '', null, null, null, null, null, null, 'KS03', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0221', 'PT. Cut Make Trim', 'No. 51 A, Banjar Semawang', 'JL.0252', null, null, '', '', '', '', null, null, null, null, null, null, 'KS06', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0223', 'PT. Bali Impression Culture Companies', 'Gedung BJB corner, Banjar Belanjong Sanur, Persimpangan Tirtanadi No. 50XX', 'JL.0244', null, null, '', '', '', '', null, null, null, null, null, null, 'KS06', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0224', 'PT. Mae Graha Bagus Manajemen', 'Bali Operasional Office, No. 439', 'JL.0216', null, null, '', '', '', '', null, null, null, null, null, null, 'KS03', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0225', 'PT. Garland Profesional Services', ' No. 245', 'JL.0216', null, null, '', '', '', '', null, null, null, null, null, null, 'KS06', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0226', 'PT. Strange But Cool', 'Rumah Sanur Office Building, No. ', 'JL.0252', null, null, '', '', '', '', null, null, null, null, null, null, 'KS10', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0227', 'PT. Global Inovatif International Trading', 'No. 21, Dusun Betngandang', 'JL.0216', null, null, '', '', '', '', null, null, null, null, null, null, 'KS10', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0228', 'PT. Discover Bali Tours', ' No. 51', 'JL.0252', null, null, '', '', '', '', null, null, null, null, null, null, 'KS06', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0229', 'PT. Indonesia Liveaboards', ' No. 53, Lingk. Batu Jimbar', 'JL.0251', null, null, '', '', '', '', null, null, null, null, null, null, 'KS06', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0230', 'PT. Cakra Alam Damai', 'No. 505, Dusun Br. Kajeng, Galeri Ikat Lt. 3', 'JL.0216', null, null, '', '', '', '', null, null, null, null, null, null, 'KS08', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0231', 'PT. Atlantis International', 'No. 96 E, Lingk. Semawang', 'JL.0216', null, null, '', '', '', '', null, null, null, null, null, null, 'KS06', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0232', 'PT. Rainforest Alliance', 'No. 88 Yang Batu Kauh', 'JL.0309', null, null, '', '', '', '', null, null, null, null, null, null, 'KT06', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0233', 'PT. Sumber Bumi Seraya', 'Utara No. 79', 'JL.0310', null, null, '', '', '', '', null, null, null, null, null, null, 'KB01', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0234', 'PT. Milleperle South Pasific', ' III No. 122', 'JL.0312', null, null, '', '', '', '', null, null, null, null, null, null, 'KS01', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0235', 'PT. Ecolodgies Indonesia', ' Gg. II No. 1, Dusun Tengah', 'JL.0352', null, null, '', '', '', '', null, null, null, null, null, null, 'KS07', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0236', 'Firma Udayana', 'No. 58 A', 'JL.0246', null, null, '', '', '', '', null, null, null, null, null, null, 'KS06', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0237', 'PT. Dream Asia Pacific', 'No. 37', 'JL.0251', null, null, '', '', '', '', null, null, null, null, null, null, 'KS06', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0238', 'PT. Bali Es', 'No. 29 Br. Sakah', 'JL.0348', null, null, '', '', '', '', null, null, null, null, null, null, 'KS08', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0239', 'PT. Indo Laut', ' No. 257', 'JL.0216', null, null, '', '', '', '', null, null, null, null, null, null, 'KS06', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0240', 'PT. Spencer Indonesia International', 'No. 445', 'JL.0216', null, null, '', '', '', '', null, null, null, null, null, null, 'KS03', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0241', 'PT. Bali Secrets', ' No. 47', 'JL.0247', null, null, '', '', '', '', null, null, null, null, null, null, 'KS06', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0242', 'PT. Spirit Tour', 'No. 6', 'JL.0327', null, null, '', '', '', '', null, null, null, null, null, null, 'KS10', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0243', 'PT. Seafood Inspection Laboratory', 'Istana Regency Block L2', 'JL.0216', null, null, '', '', '', '', null, null, null, null, null, null, 'KS02', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0244', 'PT. Canning Indonesia Products', 'No. 101', 'JL.0070', null, null, '', '', '', '', null, null, null, null, null, null, 'KB03', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0245', 'PT. Ocean Realm Bali', ' ', 'JL.0353', null, null, '', '', '', '', null, null, null, null, null, null, 'KS10', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, null, '0', '0', '0', null, '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0246', 'PT. Nexus Trading Asia', 'III/7', 'JL.0354', 'K.01', '', '', '', '', '', '0.000000', '0.000000', '', null, '', null, 'KS08', '1', null, null, null, '1', null, null, null, null, null, '1', null, null, null, null, null, null, '20000', '0', '0', '0', '2', '0', null, 'Januari-Maret 2016              \r\nApril-Juni 2016                            \r\nJuli-September 2016           \r\nJuli-Desember 2016', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_status_aktif` VALUES ('0', 'Non Aktif');
INSERT INTO `tb_status_aktif` VALUES ('1', 'Aktif');
INSERT INTO `tb_template_email` VALUES ('4', 'Email LKPM Konstruksi Jul-Sept', '<p>Kepada Yth.</p><p>Bapak/Ibu Pimpinan Perusahaan \r\n{nama_perusahaan}&nbsp;</p><p>alamat di</p><p>{alamat_perusahaan}</p><p><br></p><p>Berdasarkan data yang kami dapatkan bahwa perusahaan bapak/ibu masuk dalam kategori konstruksi. Untuk itu mohon agar melaporkan Laporan LKPM Periode Juli-September {tahun_sekarang} melalui alamat : <a target=\"_blank\" rel=\"nofollow\" href=\"https://lkpmonline.bkpm.go.id\">https://lkpmonline.bkpm.go.id</a><br></p><p> Abaikan email ini apabila sudah melaporkan laporan LKPM periode \r\nJuli-September {tahun_sekarang}. Atas perhatian dan kerjasamanya kami ucapkan terima kasih.</p><p>DPMPTSP Kota Denpasar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Bidang Dalak<br></p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p>');
INSERT INTO `tb_template_email` VALUES ('5', 'Email LKPM Konstruksi Jan-Maret', '<p>\r\n</p><p>Kepada Yth.</p><p>Bapak/Ibu Pimpinan Perusahaan \r\n{nama_perusahaan} </p><p>alamat di</p><p>{alamat_perusahaan}</p><p><br></p><p>Berdasarkan data yang kami dapatkan bahwa perusahaan bapak/ibu masuk dalam kategori konstruksi. Untuk itu mohon agar melaporkan Laporan LKPM Periode Januari-Maret {tahun_sekarang} melalui alamat : <a target=\"_blank\" rel=\"nofollow\" href=\"https://lkpmonline.bkpm.go.id\">https://lkpmonline.bkpm.go.id</a><a target=\"_blank\" rel=\"nofollow\" href=\"http://lkpmonline.com\"></a></p><p> Abaikan email ini apabila sudah melaporkan laporan LKPM periode Januari-Maret {tahun_sekarang}. Atas perhatian dan kerjasamanya kami ucapkan terima kasih.</p><p>DPMPTSP Kota Denpasar &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  Bidang Dalak<br></p><p></p>\r\n\r\n<br><p></p>');
INSERT INTO `tb_template_email` VALUES ('6', 'Email LKPM Produksi Jan-juni', '<p>\r\n</p><p>Kepada Yth.</p><p>Bapak/Ibu Pimpinan Perusahaan \r\n{nama_perusahaan} </p><p>alamat di</p><p>{alamat_perusahaan}</p><p><br></p><p>Berdasarkan data yang kami dapatkan bahwa perusahaan bapak/ibu masuk dalam kategori Produksi. Untuk itu mohon agar melaporkan Laporan LKPM Periode Januari-Juni {tahun_sekarang} melalui alamat :&nbsp;<a target=\"_blank\" rel=\"nofollow\" href=\"https://lkpmonline.bkpm.go.id\">https://lkpmonline.bkpm.go.id</a></p><p> Abaikan email ini apabila sudah melaporkan laporan LKPM periode \r\nJanuari-Juni \r\n\r\n{tahun_sekarang}. Atas perhatian dan kerjasamanya kami ucapkan terima kasih.</p><p>Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu (DPMPTSP) Kota Denpasar &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Bidang Dalak<br></p><p></p>\r\n\r\n\r\n\r\n<br><p></p>');
INSERT INTO `tb_template_email` VALUES ('7', 'Blank Template', '');
INSERT INTO `tb_user` VALUES ('artha', 'artha', 'f0975651f100c3dce5139e954fa4c010', 'admin');
INSERT INTO `tb_user` VALUES ('budi', 'Budi Santoso', '766cc4dd4d5005652e8514e3513683f8', 'admin');
INSERT INTO `tb_user` VALUES ('dalak', 'dalak', '34daa08a384142a359e9d86102c759f1', 'admin');
INSERT INTO `tb_user` VALUES ('gus_alit', 'gus alit', 'e10adc3949ba59abbe56e057f20f883e', 'pantau');
INSERT INTO `tb_user` VALUES ('ngurah', 'Ngurah budiartha', '00dfc53ee86af02e742515cdcf075ed3', 'admin');
INSERT INTO `tb_user` VALUES ('satria', 'satria', '477054c78baea7a1242f79d898a2ca46', 'admin');
INSERT INTO `tbmarker` VALUES ('1', 'PT. ABC aja deh', 'jl. majapahit, denpasar', '-8.569208', '115.177795', 'PT');
INSERT INTO `tbmarker` VALUES ('2', 'PT. winda savitri', 'jl. karanganyar, badung', '-8.580704', '115.186386', 'CV');
INSERT INTO `tbmarker` VALUES ('3', 'PT. BBB moding', 'jl. dauh tukad', '-8.582389', '115.180779', 'PT');

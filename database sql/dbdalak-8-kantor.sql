/*
MySQL Data Transfer
Source Host: localhost
Source Database: dbdalak
Target Host: localhost
Target Database: dbdalak
Date: 08/03/2018 16:48:35
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tb_file_fotomonitoring
-- ----------------------------
DROP TABLE IF EXISTS `tb_file_fotomonitoring`;
CREATE TABLE `tb_file_fotomonitoring` (
  `id_file` int(11) NOT NULL AUTO_INCREMENT,
  `monit_id` varchar(20) DEFAULT NULL,
  `nama_file` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_file`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`jadwal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for tb_jalan
-- ----------------------------
DROP TABLE IF EXISTS `tb_jalan`;
CREATE TABLE `tb_jalan` (
  `jalan_id` varchar(20) NOT NULL,
  `namajalan` varchar(100) DEFAULT NULL,
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
  `kategory_id` varchar(10) NOT NULL,
  `kategory` varchar(50) DEFAULT NULL,
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
  `klasmasalah_id` varchar(10) NOT NULL DEFAULT '',
  `klasmasalah` varchar(50) DEFAULT NULL,
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
  `prs_id` varchar(10) NOT NULL,
  `prs_nama` varchar(50) DEFAULT NULL,
  `prs_lokasidet` varchar(100) DEFAULT NULL,
  `jalan_id` varchar(20) DEFAULT NULL,
  `kategory_id` varchar(10) DEFAULT NULL,
  `prs_bidangusaha` varchar(50) DEFAULT NULL,
  `prs_telpkantor` varchar(20) DEFAULT NULL,
  `prs_telpcontact` varchar(20) DEFAULT NULL,
  `prs_namacontact` varchar(50) DEFAULT NULL,
  `prs_email` varchar(50) DEFAULT NULL,
  `prs_map_latitude` float(10,6) DEFAULT NULL,
  `prs_map_longitude` float(10,6) DEFAULT NULL,
  `prs_noakta` varchar(30) DEFAULT NULL,
  `prs_tglakta` date DEFAULT NULL,
  `prs_noHAM` varchar(20) DEFAULT NULL,
  `prs_tglHAM` date DEFAULT NULL,
  `kelurahan_id` varchar(10) DEFAULT NULL,
  `prs_adaNPWP` tinyint(4) DEFAULT '0',
  `prs_adaSHM` tinyint(4) DEFAULT '0',
  `prs_adasewatanah` tinyint(4) DEFAULT '0',
  `prs_nodaftarPMA` varchar(30) DEFAULT NULL,
  `prs_adaIMB` tinyint(4) DEFAULT '0',
  `prs_adasewagedung` tinyint(4) DEFAULT '0',
  `prs_noSITU` varchar(30) DEFAULT NULL,
  `prs_noHO` varchar(30) DEFAULT NULL,
  `prs_adaUKLUPL` tinyint(4) DEFAULT '0',
  `prs_noTDP` varchar(30) DEFAULT NULL,
  `prs_adaLKPM` tinyint(4) DEFAULT '0',
  `prs_adaKITAS` tinyint(4) DEFAULT '0',
  `prs_noIPPMA` varchar(30) DEFAULT NULL,
  `prs_noIPPRB` varchar(30) DEFAULT NULL,
  `prs_noIPPRLS` varchar(30) DEFAULT NULL,
  `prs_tahunberlakuIPPMA` varchar(5) DEFAULT NULL,
  `prs_noIjinUsaha` varchar(30) DEFAULT NULL,
  `prs_nilaiInvestasiUSD` double DEFAULT '0',
  `prs_nilaiInvestasiRP` double DEFAULT '0',
  `prs_jumlahWNA_laki` smallint(6) DEFAULT '0',
  `prs_jumlahWNA_perempuan` smallint(6) DEFAULT '0',
  `prs_jumlahWNI_laki` smallint(6) DEFAULT '0',
  `prs_jumlahWNI_perempuan` smallint(6) DEFAULT '0',
  `klasmasalah_id` varchar(5) DEFAULT NULL,
  `sudahmelengkapiberkas` tinyint(4) DEFAULT '0',
  `tgl_melengkapi` date DEFAULT NULL,
  `aktif_id` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`prs_id`),
  KEY `prs_jalan` (`jalan_id`),
  KEY `prs_kategory` (`kategory_id`),
  CONSTRAINT `prs_jalan` FOREIGN KEY (`jalan_id`) REFERENCES `tb_jalan` (`jalan_id`),
  CONSTRAINT `prs_kategory` FOREIGN KEY (`kategory_id`) REFERENCES `tb_kategory` (`kategory_id`)
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
INSERT INTO `tb_file_arsip` VALUES ('1', 'PS.0001', 'coba', 'PS-0001-.jpg');
INSERT INTO `tb_file_arsip` VALUES ('2', 'PS.0001', 'seee', 'PS-0001-seee.jpg');
INSERT INTO `tb_file_arsip` VALUES ('3', 'PS.0001', 'File Surat', 'PS-0001-arsip-File Surat.docx');
INSERT INTO `tb_file_arsip` VALUES ('4', 'PS.0003', 'NPWP', 'PS-0003-arsip-NPWP.pdf');
INSERT INTO `tb_file_arsip` VALUES ('5', 'PS.0003', 'Perjanjian Sewa', 'PS-0003-arsip-Perjanjian Sewa.pdf');
INSERT INTO `tb_file_fotomonitoring` VALUES ('34', 'PM.180003', 'PS-0002-PM-1.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('45', 'PB.180002', 'PS-0003-PB-1.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('46', 'PS.180003', 'PS-0002-PS-1.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('37', 'PM.180001', 'PS-0001-PM-1.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('38', 'PM.180001', 'PS-0001-PM-2.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('39', 'PM.180001', 'PS-0001-PM-3.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('40', 'PB.180003', 'PS-0001-PB-1.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('41', 'PB.180003', 'PS-0001-PB-2.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('42', 'PM.180003', 'PS-0002-PM-4.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('43', 'PM.180003', 'PS-0002-PM-5.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('44', 'PM.180003', 'PS-0002-PM-6.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('47', 'PS.180002', 'PS-0003-PS-1.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('48', 'PS.180002', 'PS-0003-PS-2.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('49', 'MP.180002', 'PS-0003-MP-1.jpg');
INSERT INTO `tb_file_fotomonitoring` VALUES ('50', 'MP.180002', 'PS-0003-MP-2.jpg');
INSERT INTO `tb_groupuser` VALUES ('admin', 'Administrator');
INSERT INTO `tb_groupuser` VALUES ('bina', 'Seksi Pembinaan');
INSERT INTO `tb_groupuser` VALUES ('pantau', 'Seksi Pemantauan');
INSERT INTO `tb_jadwal` VALUES ('JD.180001', '2018-02-21', 'PM', 'PS.0001', '2018-02-22', 'ngurah', '0', null);
INSERT INTO `tb_jadwal` VALUES ('JD.180002', '2018-02-23', 'PS', 'PS.0002', '2018-02-22', 'ngurah', '0', null);
INSERT INTO `tb_jadwal` VALUES ('JD.180003', '2018-02-22', 'PB', 'PS.0004', '2018-02-22', 'ngurah', '0', null);
INSERT INTO `tb_jadwal` VALUES ('JD.180004', '2018-02-22', 'PM', 'PS.0002', '2018-02-22', 'ngurah', '0', null);
INSERT INTO `tb_jadwal` VALUES ('JD.180005', '2018-03-02', 'PB', 'PS.0003', '2018-03-02', 'ngurah', '0', null);
INSERT INTO `tb_jadwal` VALUES ('JD.180006', '2018-03-02', 'PB', 'PS.0001', '2018-03-02', 'ngurah', '0', null);
INSERT INTO `tb_jadwal` VALUES ('JD.180007', '2018-03-03', 'PS', 'PS.0002', '2018-03-02', 'ngurah', '0', null);
INSERT INTO `tb_jadwal` VALUES ('JD.180008', '2018-03-03', 'PS', 'PS.0003', '2018-03-02', 'ngurah', '0', null);
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
INSERT INTO `tb_jalan` VALUES ('JL.0025', 'Jl. Sri Rama');
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
INSERT INTO `tb_jenis_monitoring` VALUES ('PM', 'Pemantauan');
INSERT INTO `tb_jenis_monitoring` VALUES ('PB', 'Pembinaan');
INSERT INTO `tb_jenis_monitoring` VALUES ('PS', 'Pengawasan');
INSERT INTO `tb_kategory` VALUES ('K.01', 'Konstruksi');
INSERT INTO `tb_kategory` VALUES ('K.02', 'Operasional');
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
INSERT INTO `tb_klasifikasi_masalah` VALUES ('KM.01', 'Perusahaan Tidak Bermasalah');
INSERT INTO `tb_klasifikasi_masalah` VALUES ('KM.02', 'Belum Mendapatkan Ijin');
INSERT INTO `tb_klasifikasi_masalah` VALUES ('KM.03', 'Perusahaan Tidak Beroperasi');
INSERT INTO `tb_klasifikasi_masalah` VALUES ('KM.04', 'Lokasi Perusahaan Tidak ditemukan');
INSERT INTO `tb_melengkapi_berkas` VALUES ('MP.180001', 'PS.0002', '2018-03-08', ' sudah melengkapi ijin\r\n', '2018-03-08', 'ngurah');
INSERT INTO `tb_melengkapi_berkas` VALUES ('MP.180002', 'PS.0003', '2018-03-08', ' sss', '2018-03-08', 'ngurah');
INSERT INTO `tb_monitoring` VALUES ('PB.180002', 'dalak', '2018-03-06', 'JD.180005', 'KM.02', 'K.02', '2018-04-05', 'sudah dibina dengan baik sekali');
INSERT INTO `tb_monitoring` VALUES ('PB.180003', 'dalak', '2018-03-06', 'JD.180006', 'KM.01', 'K.02', '2018-04-28', 'belum lengkap');
INSERT INTO `tb_monitoring` VALUES ('PM.180001', 'ngurah', '2018-03-05', 'JD.180001', 'KM.02', 'K.02', null, 'oke');
INSERT INTO `tb_monitoring` VALUES ('PM.180003', 'ngurah', '2018-03-05', 'JD.180004', 'KM.02', 'K.02', null, 'tes');
INSERT INTO `tb_monitoring` VALUES ('PS.180002', 'dalak', '2018-03-06', 'JD.180008', 'KM.02', 'K.02', null, 'erererere');
INSERT INTO `tb_monitoring` VALUES ('PS.180003', 'dalak', '2018-03-06', 'JD.180002', 'KM.02', 'K.02', null, 'ft');
INSERT INTO `tb_perusahaan` VALUES ('PS.0001', 'PT. Amanaska', 'No. 6', 'JL.0001', 'K.02', 'ekspor impor sepatu dan tas', '0361-45585', '08124653231', 'ngurah', '', '-8.704390', '115.257599', '', null, '', null, 'KB04', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', 'KM.01', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0002', 'PT. Sanur Indah', 'No. XX', 'JL.0005', 'K.02', null, '0361-554666', '0813346525', 'adi', 'adi@yahoo.com', null, null, null, null, null, null, 'KB06', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', 'KM.02', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0003', 'PT. Angin Ribut', 'no. 88x', 'JL.0007', 'K.02', null, '0361-654646', '0812232158', 'wira', 'wira@yahoo.com', null, null, null, null, null, null, 'KB05', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', 'KM.02', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0004', 'PT.CCC', 'ada', 'JL.0002', null, null, 'sds', '', '', '', null, null, null, null, null, null, 'KB03', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, '0', null, '0');
INSERT INTO `tb_status_aktif` VALUES ('0', 'Non Aktif');
INSERT INTO `tb_status_aktif` VALUES ('1', 'Aktif');
INSERT INTO `tb_user` VALUES ('aaa', 'reksa', '47bce5c74f589f4867dbd57e9ca9f808', 'bina');
INSERT INTO `tb_user` VALUES ('dalak', 'dalak', '34daa08a384142a359e9d86102c759f1', 'admin');
INSERT INTO `tb_user` VALUES ('ngurah', 'Ngurah budiartha', '00dfc53ee86af02e742515cdcf075ed3', 'admin');
INSERT INTO `tbmarker` VALUES ('1', 'PT. ABC aja deh', 'jl. majapahit, denpasar', '-8.569208', '115.177795', 'PT');
INSERT INTO `tbmarker` VALUES ('2', 'PT. winda savitri', 'jl. karanganyar, badung', '-8.580704', '115.186386', 'CV');
INSERT INTO `tbmarker` VALUES ('3', 'PT. BBB moding', 'jl. dauh tukad', '-8.582389', '115.180779', 'PT');

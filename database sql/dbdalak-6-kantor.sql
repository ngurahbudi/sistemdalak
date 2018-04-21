/*
MySQL Data Transfer
Source Host: localhost
Source Database: dbdalak
Target Host: localhost
Target Database: dbdalak
Date: 02/03/2018 13:19:59
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for tb_file_arsip
-- ----------------------------
DROP TABLE IF EXISTS `tb_file_arsip`;
CREATE TABLE `tb_file_arsip` (
  `arsip_id` int(11) NOT NULL AUTO_INCREMENT,
  `keterangan` varchar(50) DEFAULT NULL,
  `lokasi_file` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`arsip_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tb_file_fotomonitoring
-- ----------------------------
DROP TABLE IF EXISTS `tb_file_fotomonitoring`;
CREATE TABLE `tb_file_fotomonitoring` (
  `id_foto` int(11) NOT NULL AUTO_INCREMENT,
  `monit_id` varchar(255) DEFAULT NULL,
  `lokasi_filefoto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_foto`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tb_groupuser
-- ----------------------------
DROP TABLE IF EXISTS `tb_groupuser`;
CREATE TABLE `tb_groupuser` (
  `groupuser_id` varchar(10) NOT NULL DEFAULT '',
  `groupuser` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`groupuser_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tb_kelurahan
-- ----------------------------
DROP TABLE IF EXISTS `tb_kelurahan`;
CREATE TABLE `tb_kelurahan` (
  `kelurahan_id` varchar(4) NOT NULL,
  `kecamatan_id` varchar(4) NOT NULL,
  `kelurahan` varchar(40) NOT NULL,
  PRIMARY KEY (`kelurahan_id`),
  KEY `kec_ind` (`kecamatan_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tb_klasifikasi_masalah
-- ----------------------------
DROP TABLE IF EXISTS `tb_klasifikasi_masalah`;
CREATE TABLE `tb_klasifikasi_masalah` (
  `klasmasalah_id` varchar(10) NOT NULL DEFAULT '',
  `klasmasalah` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`klasmasalah_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tb_melengkapi_berkas
-- ----------------------------
DROP TABLE IF EXISTS `tb_melengkapi_berkas`;
CREATE TABLE `tb_melengkapi_berkas` (
  `melengkapi_id` varchar(20) NOT NULL DEFAULT '',
  `prs_id` varchar(10) DEFAULT NULL,
  `melengkapi_tgl` date DEFAULT NULL,
  `catatan` text,
  `tglinput` date DEFAULT NULL,
  `userinput` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`melengkapi_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`monit_id`)
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
  PRIMARY KEY (`prs_id`)
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
INSERT INTO `tb_groupuser` VALUES ('admin', 'Administrator');
INSERT INTO `tb_groupuser` VALUES ('pantau', 'Seksi Pemantauan');
INSERT INTO `tb_groupuser` VALUES ('bina', 'Seksi Pembinaan');
INSERT INTO `tb_jadwal` VALUES ('JD.180001', '2018-02-21', 'PM', 'PS.0001', '2018-02-22', 'ngurah', '0', null);
INSERT INTO `tb_jadwal` VALUES ('JD.180002', '2018-02-23', 'PS', 'PS.0002', '2018-02-22', 'ngurah', '0', null);
INSERT INTO `tb_jadwal` VALUES ('JD.180003', '2018-02-22', 'PB', 'PS.0004', '2018-02-22', 'ngurah', '0', null);
INSERT INTO `tb_jadwal` VALUES ('JD.180004', '2018-02-22', 'PM', 'PS.0002', '2018-02-22', 'ngurah', '0', null);
INSERT INTO `tb_jadwal` VALUES ('JD.180005', '2018-03-02', 'PB', 'PS.0003', '2018-03-02', 'ngurah', '0', null);
INSERT INTO `tb_jadwal` VALUES ('JD.180006', '2018-03-02', 'PB', 'PS.0001', '2018-03-02', 'ngurah', '0', null);
INSERT INTO `tb_jadwal` VALUES ('JD.180007', '2018-03-03', 'PS', 'PS.0002', '2018-03-02', 'ngurah', '0', null);
INSERT INTO `tb_jadwal` VALUES ('JD.180008', '2018-03-03', 'PS', 'PS.0003', '2018-03-02', 'ngurah', '0', null);
INSERT INTO `tb_jalan` VALUES ('JL.0001', 'Jl. Teuku Umar');
INSERT INTO `tb_jalan` VALUES ('JL.0002', 'Jl. Udayana');
INSERT INTO `tb_jalan` VALUES ('JL.0003', 'Jl. Bumi Ayu');
INSERT INTO `tb_jalan` VALUES ('JL.0004', 'Jl. By Pass Ngurah Rai');
INSERT INTO `tb_jalan` VALUES ('JL.0005', 'Jl. Pemamoran');
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
INSERT INTO `tb_klasifikasi_masalah` VALUES ('KM.01', 'Perusahaan Tidak Bermasalah');
INSERT INTO `tb_klasifikasi_masalah` VALUES ('KM.02', 'Belum Mendapatkan Ijin');
INSERT INTO `tb_klasifikasi_masalah` VALUES ('KM.03', 'Perusahaan Tidak Beroperasi');
INSERT INTO `tb_klasifikasi_masalah` VALUES ('KM.04', 'Lokasi Perusahaan Tidak ditemukan');
INSERT INTO `tb_monitoring` VALUES ('PB.180002', 'ngurah', '2018-03-02', 'JD.180005', 'KM.01', 'K.02', '2018-04-05', 'sudah dibina dengan baik sekali');
INSERT INTO `tb_monitoring` VALUES ('PB.180003', 'ngurah', '2018-03-02', 'JD.180006', 'KM.02', 'K.02', '2018-04-28', 'belum lengkap');
INSERT INTO `tb_monitoring` VALUES ('PM.180001', 'ngurah', '2018-03-01', 'JD.180001', 'KM.01', 'K.02', null, 'oke');
INSERT INTO `tb_monitoring` VALUES ('PS.180002', 'ngurah', '2018-03-02', 'JD.180008', 'KM.01', 'K.02', null, 'ok');
INSERT INTO `tb_perusahaan` VALUES ('PS.0001', 'PT. Amanaska', 'No. 6', 'JL.0001', 'K.02', 'ekspor impor sepatu dan tas', '0361-45585', '08124653231', 'ngurah', 'ngurah@yahoo.com', '-8.704390', '115.257599', '', null, '', null, 'KB04', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', 'KM.02', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0002', 'PT. Sanur Indah', 'No. XX', 'JL.0005', 'K.02', null, '0361-554666', '0813346525', 'adi', 'adi@yahoo.com', null, null, null, null, null, null, 'KB06', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', 'KM.02', '0', null, '1');
INSERT INTO `tb_perusahaan` VALUES ('PS.0003', 'PT. Angin Ribut', 'no. 88x', 'JL.0003', 'K.02', null, '0361-654646', '0812232158', 'wira', 'wira@yahoo.com', null, null, null, null, null, null, 'KB05', '0', '0', '0', null, '0', '0', null, null, '0', null, '0', '0', null, null, null, null, null, '0', '0', '0', '0', '0', '0', 'KM.02', '0', null, '1');
INSERT INTO `tb_user` VALUES ('ngurah', 'Ngurah budiartha', '00dfc53ee86af02e742515cdcf075ed3', 'admin');
INSERT INTO `tb_user` VALUES ('aaa', 'reksa', '47bce5c74f589f4867dbd57e9ca9f808', 'bina');
INSERT INTO `tb_user` VALUES ('dalak', 'dalak', '34daa08a384142a359e9d86102c759f1', 'admin');
INSERT INTO `tbmarker` VALUES ('1', 'PT. ABC aja deh', 'jl. majapahit, denpasar', '-8.569208', '115.177795', 'PT');
INSERT INTO `tbmarker` VALUES ('2', 'PT. winda savitri', 'jl. karanganyar, badung', '-8.580704', '115.186386', 'CV');
INSERT INTO `tbmarker` VALUES ('3', 'PT. BBB moding', 'jl. dauh tukad', '-8.582389', '115.180779', 'PT');

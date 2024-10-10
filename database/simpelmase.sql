-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2024 at 12:02 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simpelmase`
--

-- --------------------------------------------------------

--
-- Table structure for table `aset`
--

CREATE TABLE `aset` (
  `id_aset` bigint(20) UNSIGNED NOT NULL,
  `id_kependudukan` bigint(20) UNSIGNED NOT NULL,
  `kategori` enum('aset bergerak','aset tidak bergerak') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` enum('tanah','bangunan','kendaraan','lainnya') COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `luas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kependudukan`
--

CREATE TABLE `kependudukan` (
  `id_kependudukan` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_kk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` enum('islam','kristen','katolik','hindu','buddha','khonghucu') COLLATE utf8mb4_unicode_ci NOT NULL,
  `hubungan_keluarga` enum('kepala keluarga','istri','anak','famili-lain','orang-tua','mertua','menantu','cucu','lainnya') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_perkawinan` enum('belum kawin','kawin','cerai hidup','cerai mati') COLLATE utf8mb4_unicode_ci NOT NULL,
  `pendidikan` enum('tidak/belum sekolah','belum tamat sd/sederajat','tamat sd/sederajat','sltp/sederajat','slta/sederajat','diploma i/ii','akademi/diploma 3/sarjana muda','diploma iv/strata i','strata ii','strata iii') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_ibu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_ayah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rw` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelurahan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gaji` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `ktp` enum('belum diketahui','memiliki KTP','belum memiliki KTP') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum diketahui',
  `foto_rumah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kependudukan`
--

INSERT INTO `kependudukan` (`id_kependudukan`, `nik`, `no_kk`, `nama`, `jenis_kelamin`, `tanggal_lahir`, `tempat_lahir`, `agama`, `hubungan_keluarga`, `status_perkawinan`, `pendidikan`, `nama_ibu`, `nama_ayah`, `pekerjaan`, `alamat`, `rt`, `rw`, `kelurahan`, `kecamatan`, `gaji`, `ktp`, `foto_rumah`, `is_active`) VALUES
(1, '3513206002020009', '3513201011054651', 'Mohammad Yusuf', 'laki-laki', '2002-08-12', 'probolinggo', 'islam', 'anak', 'belum kawin', 'sltp/sederajat', 'siti', 'budi', 'petani', 'dusun bataan', '1', '1', 'sumberkledung', 'tegalsiwalan', '-', 'belum diketahui', NULL, 1),
(2, '3513206002020992', '3513201011054221', 'muhammad anam', 'laki-laki', '2002-08-12', 'probolinggo', 'islam', 'anak', 'belum kawin', 'sltp/sederajat', 'siti', 'budi', 'petani', 'dusun bataan', '1', '1', 'sumberkledung', 'tegalsiwalan', '-', 'belum diketahui', NULL, 1),
(3, '3508125311960002', '3513200207070032', 'samsul', 'laki-laki', '2002-08-12', 'probolinggo', 'islam', 'anak', 'belum kawin', 'sltp/sederajat', 'siti', 'budi', 'petani', 'dusun bataan', '1', '1', 'sumberkledung', 'tegalsiwalan', '-', 'belum diketahui', NULL, 1),
(4, '3302086910970001', '3513200207070032', 'titik', 'perempuan', '2002-08-12', 'probolinggo', 'islam', 'anak', 'belum kawin', 'sltp/sederajat', 'siti', 'budi', 'petani', 'dusun bataan', '1', '1', 'sumberkledung', 'tegalsiwalan', '-', 'belum diketahui', NULL, 1);

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
(1, 'simpelmase', 1);

-- --------------------------------------------------------

--
-- Table structure for table `no_surat`
--

CREATE TABLE `no_surat` (
  `id_nosurat` bigint(20) UNSIGNED NOT NULL,
  `nama_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `no_surat`
--

INSERT INTO `no_surat` (`id_nosurat`, `nama_surat`, `no_surat`) VALUES
(1, 'surat keterangan dispensasi', '{no}/426.420.10/{year}'),
(2, 'surat keterangan domisili', '{no}/426.420.10/{year}'),
(3, 'surat keterangan usaha', '470/{no}/426.420.10/{bulan_romawi}/{tahun}'),
(4, 'surat keterangan kehilangan', '470/{no}/426.419.3/{tahun}'),
(5, 'surat keterangan kematian', '{no}/426.420.10/{bulan_romawi}/{tahun}'),
(6, 'surat keterangan kelahiran', '474.1/{no}/426.420.10/{bulan_romawi}/{tahun}'),
(7, 'surat keterangan domisili', '{no}/426.420.10/{bulan_romawi}/{tahun}'),
(8, 'surat keterangan beda identitas', '716/{no}/426.420.10/{bulan_romawi}/{tahun}');

-- --------------------------------------------------------

--
-- Table structure for table `pkh`
--

CREATE TABLE `pkh` (
  `id_pkh` bigint(20) UNSIGNED NOT NULL,
  `id_kependudukan` bigint(20) UNSIGNED NOT NULL,
  `status` enum('aktif','tidak aktif') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pkh`
--

INSERT INTO `pkh` (`id_pkh`, `id_kependudukan`, `status`, `tanggal`, `nominal`) VALUES
(1, 1, 'aktif', '2024-05-01', '2000000'),
(2, 2, 'aktif', '2024-05-01', '2000000');

-- --------------------------------------------------------

--
-- Table structure for table `sk_beda_identitas`
--

CREATE TABLE `sk_beda_identitas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `nama_masalah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tertera` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_surat_kartu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_ktp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_kartu_pajak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_kartu_vaksin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pas_foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `validasi_sekdes` enum('proses','ditolak','disetujui') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'proses',
  `validasi_kades` enum('proses','ditolak','disetujui') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'proses',
  `status_print` enum('mandiri','kantor desa') COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifikasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_surat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sk_domisili`
--

CREATE TABLE `sk_domisili` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_kependudukan` bigint(20) UNSIGNED NOT NULL,
  `no_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `keperluan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_ktp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_kartu_pajak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `foto_kartu_vaksin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `pas_foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `validasi_sekdes` enum('proses','ditolak','disetujui') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'proses',
  `validasi_kades` enum('proses','ditolak','disetujui') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'proses',
  `status_print` enum('mandiri','kantor desa') COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifikasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_surat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sk_kehilangan`
--

CREATE TABLE `sk_kehilangan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_kependudukan` bigint(20) UNSIGNED NOT NULL,
  `no_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `kehilangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hari` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_ktp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pas_foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `foto_kartu_pajak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `foto_kartu_vaksin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `validasi_sekdes` enum('proses','ditolak','disetujui') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'proses',
  `validasi_kades` enum('proses','ditolak','disetujui') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'proses',
  `status_print` enum('mandiri','kantor desa') COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifikasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_surat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sk_kelahiran`
--

CREATE TABLE `sk_kelahiran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_kependudukan` bigint(20) UNSIGNED NOT NULL,
  `no_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `nik_ayah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik_ibu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_bayi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `hari_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_kk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_buku_nikah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_ktp_ayah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_ktp_ibu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `validasi_sekdes` enum('proses','ditolak','disetujui') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'proses',
  `validasi_kades` enum('proses','ditolak','disetujui') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'proses',
  `status_print` enum('mandiri','kantor desa') COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifikasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_surat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sk_kematian`
--

CREATE TABLE `sk_kematian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_kependudukan` bigint(20) UNSIGNED NOT NULL,
  `no_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `nik_jenazah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_jenazah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hari_meninggal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_meninggal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penyebab_meninggal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_meninggal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_ktp_pelapor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_kk_jenazah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_ktp_jenazah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_akte_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `validasi_sekdes` enum('proses','ditolak','disetujui') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'proses',
  `validasi_kades` enum('proses','ditolak','disetujui') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'proses',
  `status_print` enum('mandiri','kantor desa') COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifikasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_surat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sk_usaha`
--

CREATE TABLE `sk_usaha` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_kependudukan` bigint(20) UNSIGNED NOT NULL,
  `no_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `nama_usaha` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keperluan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_ktp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_kartu_pajak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pas_foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `foto_kartu_vaksin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `validasi_sekdes` enum('proses','ditolak','disetujui') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'proses',
  `validasi_kades` enum('proses','ditolak','disetujui') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'proses',
  `status_print` enum('mandiri','kantor desa') COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifikasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_surat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sk_usaha`
--

INSERT INTO `sk_usaha` (`id`, `id_kependudukan`, `no_surat`, `tanggal_pengajuan`, `nama_usaha`, `keperluan`, `foto_ktp`, `foto_kartu_pajak`, `pas_foto`, `foto_kartu_vaksin`, `validasi_sekdes`, `validasi_kades`, `status_print`, `notifikasi`, `file_surat`) VALUES
(1, 3, '001/426.420.10/2024', '2024-08-12', 'toko pupuk', 'membuka usaha toko pupuk', 'ktp-1.png', 'pajak-1.png', '', '', 'disetujui', 'disetujui', 'mandiri', NULL, 'sk_usaha-1.docx'),
(2, 3, '002/426.420.10/2024', '2024-08-13', 'bengkel', 'membuka usaha bengkel', 'ktp-1.png', 'pajak-1.png', '', '', 'proses', 'proses', 'kantor desa', NULL, NULL),
(3, 3, '003/426.420.10/2024', '2024-08-14', 'mebel', 'membuka usaha mebel', 'ktp-1.png', 'pajak-1.png', '', '', 'proses', 'disetujui', 'mandiri', NULL, NULL),
(4, 3, '004/426.420.10/2024', '2024-08-15', 'toko obat', 'membuka usaha toko obat', 'ktp-1.png', 'pajak-1.png', '', '', 'proses', 'ditolak', 'mandiri', 'Foto yang anda masukan kurang jelas', NULL),
(5, 3, '005/426.420.10/2024', '2024-08-16', 'toko bangunan', 'membuka usaha toko bangunan', 'ktp-1.png', 'pajak-1.png', '', '', 'ditolak', 'disetujui', 'mandiri', 'Nama usaha yang anda masukan kurang jelas', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_kependudukan` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('kepala desa','sekretaris desa','penduduk') COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_new_user` tinyint(1) NOT NULL DEFAULT 1,
  `expired_password` date NOT NULL DEFAULT (curdate() + interval 1 year)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_kependudukan`, `username`, `password`, `role`, `is_new_user`, `expired_password`) VALUES
(1, 1, 'yusuf', '$2y$10$1SdmitYq1l7dFVED5MLsleLo2dFMDjDuUPfcKhMEebZ2PNR2WDkdG', 'sekretaris desa', 0, '2025-10-02'),
(2, 2, 'anam', '', 'kepala desa', 0, '2025-10-02'),
(3, 3, 'samsul', '$2y$10$IBPTXQKMUtwL/XWqIe9r4eyjzueTllnr3E.ce1NoyjqyEjApg/mtu', 'penduduk', 0, '2025-10-02'),
(4, 4, 'titik', '$2y$10$tqP1yZQIPbD1K3D9R4O.AOQnhWvLAO.XIBbfS7kp9SaZLDWDMoeTW', 'penduduk', 0, '2025-10-02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aset`
--
ALTER TABLE `aset`
  ADD PRIMARY KEY (`id_aset`),
  ADD KEY `aset_id_kependudukan_foreign` (`id_kependudukan`);

--
-- Indexes for table `kependudukan`
--
ALTER TABLE `kependudukan`
  ADD PRIMARY KEY (`id_kependudukan`),
  ADD UNIQUE KEY `kependudukan_nik_unique` (`nik`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `no_surat`
--
ALTER TABLE `no_surat`
  ADD PRIMARY KEY (`id_nosurat`);

--
-- Indexes for table `pkh`
--
ALTER TABLE `pkh`
  ADD PRIMARY KEY (`id_pkh`),
  ADD KEY `pkh_id_kependudukan_foreign` (`id_kependudukan`);

--
-- Indexes for table `sk_beda_identitas`
--
ALTER TABLE `sk_beda_identitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sk_domisili`
--
ALTER TABLE `sk_domisili`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sk_domisili_id_kependudukan_foreign` (`id_kependudukan`);

--
-- Indexes for table `sk_kehilangan`
--
ALTER TABLE `sk_kehilangan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sk_kehilangan_id_kependudukan_foreign` (`id_kependudukan`);

--
-- Indexes for table `sk_kelahiran`
--
ALTER TABLE `sk_kelahiran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sk_kelahiran_id_kependudukan_foreign` (`id_kependudukan`);

--
-- Indexes for table `sk_kematian`
--
ALTER TABLE `sk_kematian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sk_kematian_id_kependudukan_foreign` (`id_kependudukan`);

--
-- Indexes for table `sk_usaha`
--
ALTER TABLE `sk_usaha`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sk_usaha_id_kependudukan_foreign` (`id_kependudukan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `user_username_unique` (`username`),
  ADD KEY `user_id_kependudukan_foreign` (`id_kependudukan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aset`
--
ALTER TABLE `aset`
  MODIFY `id_aset` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kependudukan`
--
ALTER TABLE `kependudukan`
  MODIFY `id_kependudukan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `no_surat`
--
ALTER TABLE `no_surat`
  MODIFY `id_nosurat` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pkh`
--
ALTER TABLE `pkh`
  MODIFY `id_pkh` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sk_beda_identitas`
--
ALTER TABLE `sk_beda_identitas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sk_domisili`
--
ALTER TABLE `sk_domisili`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sk_kehilangan`
--
ALTER TABLE `sk_kehilangan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sk_kelahiran`
--
ALTER TABLE `sk_kelahiran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sk_kematian`
--
ALTER TABLE `sk_kematian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sk_usaha`
--
ALTER TABLE `sk_usaha`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aset`
--
ALTER TABLE `aset`
  ADD CONSTRAINT `aset_id_kependudukan_foreign` FOREIGN KEY (`id_kependudukan`) REFERENCES `kependudukan` (`id_kependudukan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pkh`
--
ALTER TABLE `pkh`
  ADD CONSTRAINT `pkh_id_kependudukan_foreign` FOREIGN KEY (`id_kependudukan`) REFERENCES `kependudukan` (`id_kependudukan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sk_domisili`
--
ALTER TABLE `sk_domisili`
  ADD CONSTRAINT `sk_domisili_id_kependudukan_foreign` FOREIGN KEY (`id_kependudukan`) REFERENCES `kependudukan` (`id_kependudukan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sk_kehilangan`
--
ALTER TABLE `sk_kehilangan`
  ADD CONSTRAINT `sk_kehilangan_id_kependudukan_foreign` FOREIGN KEY (`id_kependudukan`) REFERENCES `kependudukan` (`id_kependudukan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sk_kelahiran`
--
ALTER TABLE `sk_kelahiran`
  ADD CONSTRAINT `sk_kelahiran_id_kependudukan_foreign` FOREIGN KEY (`id_kependudukan`) REFERENCES `kependudukan` (`id_kependudukan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sk_kematian`
--
ALTER TABLE `sk_kematian`
  ADD CONSTRAINT `sk_kematian_id_kependudukan_foreign` FOREIGN KEY (`id_kependudukan`) REFERENCES `kependudukan` (`id_kependudukan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sk_usaha`
--
ALTER TABLE `sk_usaha`
  ADD CONSTRAINT `sk_usaha_id_kependudukan_foreign` FOREIGN KEY (`id_kependudukan`) REFERENCES `kependudukan` (`id_kependudukan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_id_kependudukan_foreign` FOREIGN KEY (`id_kependudukan`) REFERENCES `kependudukan` (`id_kependudukan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Sep 2019 pada 01.42
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_koperasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` text,
  `create_on` int(11) DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `update_on` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `company`
--

INSERT INTO `company` (`id`, `name`, `address`, `create_on`, `create_by`, `update_on`, `update_by`) VALUES
(3, 'Kelas VII', 'Lantai 1', 2018, 8, NULL, NULL),
(4, 'Kelas VIII', 'Lantai 2', 2018, 8, 2018, 8),
(5, 'Kelas IX', 'Lantai 3', 2018, 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `deposit`
--

CREATE TABLE `deposit` (
  `id` int(11) NOT NULL,
  `memberid` int(11) NOT NULL,
  `no_trans` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `pokok` decimal(20,2) NOT NULL DEFAULT '0.00',
  `wajib` decimal(20,2) NOT NULL DEFAULT '0.00',
  `sukarela` decimal(20,2) NOT NULL DEFAULT '0.00',
  `create_on` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `update_on` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `deposit`
--

INSERT INTO `deposit` (`id`, `memberid`, `no_trans`, `date`, `pokok`, `wajib`, `sukarela`, `create_on`, `create_by`, `update_on`, `update_by`) VALUES
(23, 8, 'SN000003', '2018-09-12', '5000.00', '50000.00', '7000000.00', '2018-09-12 08:05:37', 8, NULL, NULL),
(26, 8, 'SN000006', '2018-09-29', '5000.00', '50000.00', '9600000.00', '2018-09-13 14:25:21', 8, NULL, NULL),
(27, 10, 'SN000007', '2018-09-20', '2000.00', '50000.00', '500000.00', '2018-09-20 11:50:20', 8, NULL, NULL),
(28, 10, 'SN000008', '2018-11-01', '2000.00', '50000.00', '400000.00', '2018-09-25 09:27:10', 8, NULL, NULL),
(29, 12, 'SN000009', '2019-08-14', '20000.00', '50000.00', '7500000.00', '2019-08-14 05:56:57', 8, NULL, NULL),
(30, 14, 'SN000010', '2019-08-26', '30000.00', '50000.00', '400000.00', '2019-08-26 13:34:44', 8, NULL, NULL),
(31, 11, 'SN000011', '2019-09-17', '2000.00', '50000.00', '500000.00', '2019-09-16 23:28:58', 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `gender` enum('Laki-laki','Perempuan') NOT NULL DEFAULT 'Laki-laki',
  `position` varchar(100) DEFAULT NULL,
  `address` text,
  `hp` varchar(20) DEFAULT '',
  `birthplace` varchar(100) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `create_on` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `update_on` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `employee`
--

INSERT INTO `employee` (`id`, `name`, `email`, `gender`, `position`, `address`, `hp`, `birthplace`, `birthdate`, `photo`, `create_on`, `create_by`, `update_on`, `update_by`) VALUES
(4, 'Dini Islamiani Lestari', 'diniislamianilestari18@gmail.com', 'Perempuan', 'Bendahara', 'Cihampelas, Bandung Barat', '081320458400', 'Bandung', '1997-06-18', NULL, '2015-09-02 00:51:55', 1, '2018-09-08 08:12:00', 8),
(5, 'Ichsani Nur Islami', 'ichsaninurislamidodot@gmail.com', 'Perempuan', 'Ketua Koperasi', 'cihampelas', '081322111655', 'Bandung', '2003-02-14', NULL, '2018-09-08 07:00:03', 8, NULL, NULL),
(6, 'Apriansyah', 'apriansyah@gmail.com', 'Laki-laki', 'Kepala Sekolah', 'Cianjur', '081224576839', 'Cianjur', '1994-04-30', NULL, '2018-09-08 07:05:05', 8, NULL, NULL),
(7, 'aab', '', 'Laki-laki', 'anggota', '', '', '', NULL, NULL, '2019-09-08 15:33:52', 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `installment`
--

CREATE TABLE `installment` (
  `id` int(11) NOT NULL,
  `loanid` int(11) NOT NULL,
  `no_trans` varchar(20) NOT NULL,
  `transaction` int(2) NOT NULL DEFAULT '1' COMMENT 'angsuran ke ....',
  `date` date NOT NULL,
  `amount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `create_on` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `update_on` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `installment`
--

INSERT INTO `installment` (`id`, `loanid`, `no_trans`, `transaction`, `date`, `amount`, `create_on`, `create_by`, `update_on`, `update_by`) VALUES
(27, 17, 'AN000007', 1, '2019-08-16', '2004000.00', '2019-08-14 05:58:12', 8, NULL, NULL),
(28, 17, 'AN000008', 2, '2019-09-17', '2004000.00', '2019-09-17 00:45:03', 8, NULL, NULL),
(29, 20, 'AN000009', 1, '2019-08-27', '350140.00', '2019-09-17 00:45:16', 8, NULL, NULL),
(30, 20, 'AN000010', 2, '2019-09-10', '350140.00', '2019-09-17 00:45:25', 8, NULL, NULL),
(31, 22, 'AN000011', 1, '2019-09-05', '291.72', '2019-09-17 05:39:51', 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `loan`
--

CREATE TABLE `loan` (
  `id` int(11) NOT NULL,
  `memberid` int(11) NOT NULL,
  `no_loan` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `amount` decimal(20,2) NOT NULL DEFAULT '0.00',
  `bunga` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT 'persen dlm bulan (0.83/bulan)',
  `lama_angsuran` int(4) NOT NULL DEFAULT '1' COMMENT 'dalam bulan',
  `perbulan` decimal(20,2) NOT NULL DEFAULT '0.00',
  `flag` enum('Tahun','Bulan') NOT NULL DEFAULT 'Bulan',
  `status` varchar(1) NOT NULL DEFAULT '0' COMMENT '1=Lunas,0=Belum Lunas',
  `create_on` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `update_on` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `loan`
--

INSERT INTO `loan` (`id`, `memberid`, `no_loan`, `date`, `amount`, `bunga`, `lama_angsuran`, `perbulan`, `flag`, `status`, `create_on`, `create_by`, `update_on`, `update_by`) VALUES
(17, 12, 'PN000004', '2019-08-15', '20000000.00', '0.02', 10, '2004000.00', 'Bulan', '0', '2019-08-14 05:57:37', 8, NULL, NULL),
(18, 10, 'PN000005', '2019-08-14', '5000000.00', '0.02', 5, '1001000.00', 'Bulan', '0', '2019-08-14 11:25:22', 8, '2019-08-14 11:30:37', 8),
(20, 13, 'PN000006', '2019-08-15', '700000.00', '0.02', 2, '350140.00', 'Bulan', '1', '2019-08-15 15:39:52', 8, '2019-09-17 00:45:25', 8),
(21, 11, 'PN000007', '0000-00-00', '900.00', '0.02', 24, '37.51', 'Bulan', '0', '2019-09-17 01:25:39', 8, '2019-09-17 01:25:57', 8),
(22, 11, 'PN000008', '0000-00-00', '7000.00', '0.02', 24, '291.72', 'Bulan', '0', '2019-09-17 01:26:18', 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `no_member` varchar(20) NOT NULL,
  `nik` int(20) NOT NULL,
  `npwp` int(20) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `name` varchar(150) NOT NULL,
  `gender` enum('Laki-laki','Perempuan') NOT NULL DEFAULT 'Laki-laki',
  `birthplace` varchar(100) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `relationship` enum('Sendiri','Menikah') NOT NULL DEFAULT 'Sendiri',
  `partner` varchar(150) DEFAULT NULL COMMENT 'nama suami/istri',
  `heir` varchar(150) DEFAULT NULL COMMENT 'ahli waris',
  `address` text COMMENT 'sesuai ktp',
  `current_address` text,
  `phone` int(20) DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `companyid` int(11) DEFAULT '1',
  `join_date` date DEFAULT NULL COMMENT 'join date dgn perusahaan',
  `position` varchar(100) DEFAULT NULL,
  `create_on` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `update_on` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`id`, `no_member`, `nik`, `npwp`, `photo`, `name`, `gender`, `birthplace`, `birthdate`, `relationship`, `partner`, `heir`, `address`, `current_address`, `phone`, `hp`, `companyid`, `join_date`, `position`, `create_on`, `create_by`, `update_on`, `update_by`) VALUES
(8, '180002', 0, 0, '', 'umainah Ainul Mardiah', 'Perempuan', 'Bandung', '1997-07-11', 'Sendiri', '', 'Fatimah', 'Cianjur', 'Cihampelas KBB ', 2147483647, '022249458', 5, '2011-02-01', 'guru agama', '2018-09-12 06:55:56', 8, NULL, NULL),
(9, '180003', 0, 0, '', 'abdul', 'Laki-laki', 'Bandung', '1964-09-17', 'Sendiri', '', 'dgg', 'mjkll', 'ujk', 22, '899', 4, '2018-09-14', 'guru indonesia', '2018-09-14 11:38:41', 8, '2018-09-14 11:38:41', 8),
(10, '180004', 0, 0, '', 'ibnu', 'Laki-laki', 'Tasikmalaya', '1991-04-03', '', '', 'Fatimah', 'cihampelas ', 'bandung', 2213874, '08133', 5, '2018-07-05', 'guru ipa', '2018-09-20 11:48:52', 8, NULL, NULL),
(11, '180005', 2147483647, 337468910, 'avatar-kartun-muslim-7_09242018124036.jpg', 'umay', 'Perempuan', 'Bandung', '2018-07-11', '', '', 'Fatimah', 'cihampelas', 'cihampelas', 2213874, '081322111655', 5, '2018-09-01', 'guru inggris', '2018-09-24 12:40:36', 8, NULL, NULL),
(12, '190001', 0, 0, '', 'aaa', 'Laki-laki', 'Bandung', '1997-05-14', '', 'rr', 'fff', 'sdwer', 'erqed', 22700, '245788', 5, '2019-08-14', 'guru kimia', '2019-08-14 05:44:18', 8, NULL, NULL),
(13, '190002', 0, 0, '', 'bbbb', 'Perempuan', 'Bandung', '1993-09-23', '', '-', 'sdd', 'bandung', 'bandung', 345789, '223578989', 5, '2019-08-14', 'guru indonesia', '2019-08-15 15:35:45', 8, NULL, NULL),
(14, '190003', 0, 0, '', 'fajar', 'Laki-laki', 'Bandung', '2020-08-26', '', '', '', 'sarijadi', 'sariasih', 0, '09837418193', 5, '2020-08-01', 'guru inggris', '2019-08-26 13:24:52', 8, NULL, NULL),
(15, '190004', 0, 0, '', 'sidang TA', 'Laki-laki', 'Tasikmalaya', '1986-08-01', '', '', '', 'citapen', 'bandung', 123456789, '081432765300', 3, '2019-08-26', 'guru inggris', '2019-08-26 13:41:05', 8, NULL, NULL),
(16, '190005', 0, 0, '', 'tiga', 'Laki-laki', 'Tasikmalaya', '2019-08-27', '', '', '', '', '', 0, 'lima', 4, '2019-08-27', 'Supervisor', '2019-08-27 07:18:31', 8, NULL, NULL),
(17, '190006', 0, 0, '', 'ccc', 'Laki-laki', 'Bandung', '2019-09-08', '', '', '', '', '', 0, '', 5, NULL, '', '2019-09-08 14:23:46', 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `member_deposit`
--

CREATE TABLE `member_deposit` (
  `id` int(11) NOT NULL,
  `memberid` int(11) NOT NULL,
  `date` date NOT NULL COMMENT 'tanggal efektif',
  `pokok` decimal(20,2) NOT NULL DEFAULT '0.00',
  `wajib` decimal(20,2) NOT NULL DEFAULT '0.00',
  `sukarela` decimal(20,2) NOT NULL DEFAULT '0.00',
  `create_on` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `update_on` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `member_deposit`
--

INSERT INTO `member_deposit` (`id`, `memberid`, `date`, `pokok`, `wajib`, `sukarela`, `create_on`, `create_by`, `update_on`, `update_by`) VALUES
(10, 8, '2019-09-14', '50000.00', '25000.00', '45000.00', '2018-09-12 06:55:56', 8, '2019-09-17 06:22:44', 8),
(11, 9, '2019-09-15', '0.00', '0.00', '800000.00', '2018-09-14 11:37:41', 8, '2019-09-17 06:22:56', 8),
(12, 10, '2017-09-01', '2000.00', '50000.00', '50000.00', '2018-09-20 11:48:52', 8, NULL, NULL),
(13, 11, '2018-09-24', '2000.00', '50000.00', '500000.00', '2018-09-24 12:40:36', 8, NULL, NULL),
(14, 12, '2019-08-14', '20000.00', '50000.00', '7000000.00', '2019-08-14 05:44:18', 8, NULL, NULL),
(15, 13, '2019-08-15', '30000.00', '50000.00', '100000.00', '2019-08-15 15:35:45', 8, '2019-08-15 15:39:06', 8),
(16, 14, '2019-08-26', '50000.00', '50000.00', '4500000.00', '2019-08-26 13:24:52', 8, NULL, NULL),
(17, 15, '2019-08-26', '40000.00', '50000.00', '1500000.00', '2019-08-26 13:41:05', 8, NULL, NULL),
(18, 16, '2019-08-26', '25000.00', '50000.00', '4500000.00', '2019-08-27 07:18:31', 8, NULL, NULL),
(19, 17, '2019-09-08', '50000.00', '25000.00', '500000.00', '2019-09-08 14:23:46', 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id` int(1) NOT NULL,
  `description` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id`, `description`) VALUES
(1, 'Superadmin'),
(2, 'Admin'),
(3, 'User'),
(4, 'Anggota');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `roleid` int(1) NOT NULL,
  `employeeid` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `roleid`, `employeeid`, `username`, `password`) VALUES
(8, 1, 4, 'superadmin', 'fjl8rAOL/yAgq1zhJDKMJDJteKttXAEbh+erp9Tko3RVhC+bLcRshULxxcz4ha6TgjPAaiHtBcPUcdzIY0qZPQ=='),
(9, 3, 5, 'ichsani', 'HRwUQkqgO1Om6BLnABAUt/ziqwI+4jfv9na7L/rz5mkZPyCheCAoyFDnSiUcJt+lyxPRpO4KLJyyUVJ63BcSlg=='),
(10, 3, 6, 'apriansyah', '5gSc6ZMHQ3pu0JqPSXgc38TKM6qGSz8Wvl1D10Jc7pGnbJCj5YLwsW4rd5pRLwJoxKOyTcwqcGBuoObVCFI/3g==');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_member`
--

CREATE TABLE `user_member` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `roleid` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_member`
--

INSERT INTO `user_member` (`id`, `member_id`, `roleid`, `username`, `password`) VALUES
(1, 11, 4, 'mayo', 'YBBljQ1SWiFV9I13SlK3g8p3gMe9JYynkwMbF2CnHf5xT3+mHTc47q9PZ2V37dA49adjAf/fwAhNNf0Z65U6Ug==');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `memberid` (`memberid`);

--
-- Indeks untuk tabel `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `installment`
--
ALTER TABLE `installment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loanid` (`loanid`);

--
-- Indeks untuk tabel `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `memberid` (`memberid`);

--
-- Indeks untuk tabel `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`),
  ADD KEY `companyid` (`companyid`);

--
-- Indeks untuk tabel `member_deposit`
--
ALTER TABLE `member_deposit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `memberid` (`memberid`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roleid` (`roleid`),
  ADD KEY `employeeid` (`employeeid`);

--
-- Indeks untuk tabel `user_member`
--
ALTER TABLE `user_member`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `role_id` (`roleid`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `deposit`
--
ALTER TABLE `deposit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `installment`
--
ALTER TABLE `installment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `loan`
--
ALTER TABLE `loan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `member_deposit`
--
ALTER TABLE `member_deposit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `user_member`
--
ALTER TABLE `user_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `deposit`
--
ALTER TABLE `deposit`
  ADD CONSTRAINT `deposit_ibfk_1` FOREIGN KEY (`memberid`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `installment`
--
ALTER TABLE `installment`
  ADD CONSTRAINT `installment_ibfk_1` FOREIGN KEY (`loanid`) REFERENCES `loan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `loan`
--
ALTER TABLE `loan`
  ADD CONSTRAINT `loan_ibfk_1` FOREIGN KEY (`memberid`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`companyid`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `member_deposit`
--
ALTER TABLE `member_deposit`
  ADD CONSTRAINT `member_deposit_ibfk_1` FOREIGN KEY (`memberid`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`roleid`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`employeeid`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

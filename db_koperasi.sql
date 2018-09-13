-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2017 at 01:56 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `company`
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
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `address`, `create_on`, `create_by`, `update_on`, `update_by`) VALUES
(1, 'PT. Duta Alam Semesta', 'Tangerang', NULL, NULL, NULL, NULL),
(2, 'PT. Arca International', 'Jakarta Barat', 2015, 8, 2015, 8);

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
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
-- Dumping data for table `deposit`
--

INSERT INTO `deposit` (`id`, `memberid`, `no_trans`, `date`, `pokok`, `wajib`, `sukarela`, `create_on`, `create_by`, `update_on`, `update_by`) VALUES
(4, 4, 'SN000001', '2015-01-05', '50000.00', '50000.00', '150000.00', '2015-09-02 00:55:48', 8, '2015-09-02 23:19:45', 8),
(5, 4, 'SN000002', '2015-02-02', '0.00', '50000.00', '150000.00', '2015-09-02 00:56:12', 8, NULL, NULL),
(6, 4, 'SN000003', '2015-03-16', '0.00', '50000.00', '150000.00', '2015-09-02 00:56:31', 8, NULL, NULL),
(7, 4, 'SN000004', '2015-04-27', '0.00', '50000.00', '150000.00', '2015-09-02 00:56:48', 8, NULL, NULL),
(8, 4, 'SN000005', '2015-05-13', '0.00', '50000.00', '150000.00', '2015-09-02 00:57:19', 8, NULL, NULL),
(9, 4, 'SN000006', '2015-06-11', '0.00', '50000.00', '150000.00', '2015-09-02 00:57:31', 8, NULL, NULL),
(10, 4, 'SN000007', '2015-07-21', '0.00', '50000.00', '150000.00', '2015-09-02 00:57:43', 8, NULL, NULL),
(11, 4, 'SN000008', '2015-08-12', '0.00', '50000.00', '150000.00', '2015-09-02 00:57:58', 8, NULL, NULL),
(12, 4, 'SN000009', '2015-09-02', '0.00', '50000.00', '150000.00', '2015-09-02 00:58:06', 8, NULL, NULL),
(13, 5, 'SN000010', '2015-01-13', '50000.00', '50000.00', '90000.00', '2015-09-02 01:12:05', 8, NULL, NULL),
(14, 5, 'SN000011', '2015-02-11', '0.00', '50000.00', '90000.00', '2015-09-02 01:12:25', 8, NULL, NULL),
(15, 4, 'SN000012', '2015-03-11', '0.00', '50000.00', '150000.00', '2015-09-02 01:12:35', 8, NULL, NULL),
(16, 5, 'SN000013', '2015-04-13', '0.00', '50000.00', '90000.00', '2015-09-02 01:12:50', 8, NULL, NULL),
(17, 5, 'SN000014', '2015-05-12', '0.00', '50000.00', '90000.00', '2015-09-02 01:13:01', 8, NULL, NULL),
(18, 5, 'SN000015', '2015-06-01', '0.00', '50000.00', '90000.00', '2015-09-02 01:13:12', 8, NULL, NULL),
(19, 5, 'SN000016', '2015-07-15', '0.00', '50000.00', '90000.00', '2015-09-02 01:13:28', 8, NULL, NULL),
(20, 5, 'SN000017', '2015-08-01', '50000.00', '50000.00', '90000.00', '2015-09-02 01:13:40', 8, '2015-09-02 20:47:47', 8);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
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
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `email`, `gender`, `position`, `address`, `hp`, `birthplace`, `birthdate`, `photo`, `create_on`, `create_by`, `update_on`, `update_by`) VALUES
(4, 'Hadi Firmansyah', 'hadi@duta-software.com', 'Laki-laki', 'Supervisor', 'Tangerang', '085774462015', 'Tangerang', '1986-04-15', NULL, '2015-09-02 00:51:55', 1, NULL, NULL),
(5, 'Salwa Salsabila Putri', '', 'Perempuan', 'HRD', '', '', '', NULL, NULL, '2015-09-03 00:35:15', 8, '2015-09-03 00:35:59', 8),
(6, 'Asep Setiawan', '', 'Laki-laki', 'Anggota', '', '', 'serang', '1998-09-01', NULL, '2015-09-03 00:42:29', 8, '2017-01-23 15:01:15', 8),
(7, 'Rani Putri Febrianti', 'rani@gmail.com', 'Perempuan', 'Anggota', 'Bogor Raya', '0219987283', 'Bogor', '1990-06-13', 'chrysanthemum_01232017141326.jpg', '2017-01-23 14:13:26', 8, '2017-01-23 15:07:08', 8),
(8, 'Ujang', '', 'Laki-laki', 'Anggota', '', '', '', NULL, NULL, '2017-01-24 00:08:55', 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `installment`
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
-- Dumping data for table `installment`
--

INSERT INTO `installment` (`id`, `loanid`, `no_trans`, `transaction`, `date`, `amount`, `create_on`, `create_by`, `update_on`, `update_by`) VALUES
(4, 8, 'AN000001', 1, '2015-08-11', '916666.67', '2015-09-02 00:59:30', 8, NULL, NULL),
(5, 8, 'AN000002', 2, '2015-09-02', '916666.67', '2015-09-02 00:59:50', 8, NULL, NULL),
(6, 9, 'AN000003', 1, '2015-06-16', '458166.67', '2015-09-02 01:14:59', 8, NULL, NULL),
(7, 9, 'AN000004', 2, '2015-07-14', '458166.67', '2015-09-02 01:15:11', 8, NULL, NULL),
(8, 9, 'AN000005', 3, '2015-08-12', '458166.67', '2015-09-02 01:15:22', 8, NULL, NULL),
(9, 9, 'AN000006', 4, '2015-09-02', '458166.67', '2015-09-02 22:15:59', 8, NULL, NULL),
(10, 9, 'AN000007', 5, '2015-10-15', '458166.67', '2015-09-02 22:16:09', 8, NULL, NULL),
(11, 9, 'AN000008', 6, '2015-11-25', '458166.67', '2015-09-02 22:16:22', 8, NULL, NULL),
(12, 9, 'AN000009', 7, '2015-12-24', '458166.67', '2015-09-02 22:16:34', 8, NULL, NULL),
(13, 9, 'AN000010', 8, '2016-01-01', '458166.67', '2015-09-02 22:17:01', 8, NULL, NULL),
(14, 9, 'AN000011', 9, '2016-02-13', '458166.67', '2015-09-02 22:17:15', 8, NULL, NULL),
(15, 9, 'AN000012', 10, '2016-03-09', '458166.67', '2015-09-02 22:17:48', 8, NULL, NULL),
(16, 9, 'AN000013', 11, '2016-04-14', '458166.67', '2015-09-02 22:18:07', 8, NULL, NULL),
(17, 9, 'AN000014', 12, '2016-05-04', '458166.67', '2015-09-02 22:18:45', 8, '2015-09-02 23:44:02', 8);

-- --------------------------------------------------------

--
-- Table structure for table `loan`
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
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`id`, `memberid`, `no_loan`, `date`, `amount`, `bunga`, `lama_angsuran`, `perbulan`, `flag`, `status`, `create_on`, `create_by`, `update_on`, `update_by`) VALUES
(8, 4, 'PN000001', '2015-07-22', '10000000.00', '10.00', 1, '916666.67', 'Tahun', '0', '2015-09-02 00:59:00', 8, NULL, NULL),
(9, 5, 'PN000002', '2015-05-14', '5000000.00', '0.83', 12, '458166.67', 'Bulan', '1', '2015-09-02 01:14:16', 8, '2015-09-02 23:44:02', 8);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `no_member` varchar(20) NOT NULL,
  `name` varchar(150) NOT NULL,
  `gender` enum('Laki-laki','Perempuan') NOT NULL DEFAULT 'Laki-laki',
  `birthplace` varchar(100) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `relationship` enum('Sendiri','Menikah') NOT NULL DEFAULT 'Sendiri',
  `partner` varchar(150) DEFAULT NULL COMMENT 'nama suami/istri',
  `heir` varchar(150) DEFAULT NULL COMMENT 'ahli waris',
  `address` text COMMENT 'sesuai ktp',
  `current_address` text,
  `phone` varchar(20) DEFAULT NULL,
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
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `no_member`, `name`, `gender`, `birthplace`, `birthdate`, `relationship`, `partner`, `heir`, `address`, `current_address`, `phone`, `hp`, `companyid`, `join_date`, `position`, `create_on`, `create_by`, `update_on`, `update_by`) VALUES
(4, '150001', 'Rani Putri Febrianti', 'Perempuan', 'Bogor', '1990-06-13', 'Menikah', 'Bachrul Ulum', 'Saiful', 'Bogor Raya', 'Bogor Raya', '0219987283', '6283897814683', 2, '2012-07-16', 'Marketing', '2015-09-03 00:25:51', 8, '2015-09-03 00:25:51', 8),
(5, '150002', 'Asep Setiawan', 'Laki-laki', 'Serang', '1988-09-01', 'Sendiri', '', '', '', '', '', '', 1, NULL, '', '2015-09-03 00:08:41', 8, '2015-09-03 00:08:41', 8),
(6, '170001', 'Ujang', 'Laki-laki', '', NULL, 'Sendiri', '', '', '', '', '', '', 2, NULL, '', '2017-01-24 00:08:21', 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `member_deposit`
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
-- Dumping data for table `member_deposit`
--

INSERT INTO `member_deposit` (`id`, `memberid`, `date`, `pokok`, `wajib`, `sukarela`, `create_on`, `create_by`, `update_on`, `update_by`) VALUES
(6, 4, '2015-01-05', '50000.00', '50000.00', '150000.00', '2015-09-02 00:55:18', 8, NULL, NULL),
(7, 5, '2015-01-12', '50000.00', '50000.00', '90000.00', '2015-09-02 01:11:18', 8, NULL, NULL),
(8, 6, '2017-01-11', '100000.00', '100000.00', '50000.00', '2017-01-24 00:08:22', 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(1) NOT NULL,
  `description` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `description`) VALUES
(1, 'Superadmin'),
(2, 'Admin'),
(3, 'User'),
(4, 'Anggota');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `roleid` int(1) NOT NULL,
  `employeeid` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `roleid`, `employeeid`, `username`, `password`) VALUES
(8, 1, 4, 'superadmin', 'fjl8rAOL/yAgq1zhJDKMJDJteKttXAEbh+erp9Tko3RVhC+bLcRshULxxcz4ha6TgjPAaiHtBcPUcdzIY0qZPQ=='),
(9, 2, 5, 'salwa', 'uQvhEQOyirmk5spu7EGeZf0P7V/8U5wEmvEphCvDxQVEnTsY6eSDlAxWwwx8iVFLq8kkNtlMj2xQNAk6mwsI+w=='),
(10, 3, 6, 'Asep', 'Anqi/gbPCOnJuy6qGlWQ9J1rlQr1fqASVfSzvZAlfbL4veiChQLFIr2bf+Drxzowg8CvDT4tk0dTbaVGNo9w2Q=='),
(11, 3, 7, 'Rani', 'wod2784FpMMYmBHrcls7HXwYiJzdVFyMxHK3nwfLSHxD4hYNYnWl/4lTWiRVXge0YzMdyZNSrsJ3EmAx40ZQLA=='),
(12, 3, 8, 'Ujang', 'qNixyhUA8LeinlBaHctMZylSSx5tt7CoFl9+tfuiYuzbcGQVton88wlzdyMgarTPRY15FR6jYPXuA7o24eYrAw==');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `memberid` (`memberid`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `installment`
--
ALTER TABLE `installment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loanid` (`loanid`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `memberid` (`memberid`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`),
  ADD KEY `companyid` (`companyid`);

--
-- Indexes for table `member_deposit`
--
ALTER TABLE `member_deposit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `memberid` (`memberid`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roleid` (`roleid`),
  ADD KEY `employeeid` (`employeeid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `installment`
--
ALTER TABLE `installment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `member_deposit`
--
ALTER TABLE `member_deposit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `deposit`
--
ALTER TABLE `deposit`
  ADD CONSTRAINT `deposit_ibfk_1` FOREIGN KEY (`memberid`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `installment`
--
ALTER TABLE `installment`
  ADD CONSTRAINT `installment_ibfk_1` FOREIGN KEY (`loanid`) REFERENCES `loan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `loan`
--
ALTER TABLE `loan`
  ADD CONSTRAINT `loan_ibfk_1` FOREIGN KEY (`memberid`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`companyid`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `member_deposit`
--
ALTER TABLE `member_deposit`
  ADD CONSTRAINT `member_deposit_ibfk_1` FOREIGN KEY (`memberid`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`roleid`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`employeeid`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

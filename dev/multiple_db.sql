-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2020 at 02:48 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `multiple_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `user_group` enum('1','2') NOT NULL DEFAULT '2' COMMENT '1=Super admin,2= Admin',
  `username` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email_address` varchar(255) CHARACTER SET utf8 NOT NULL,
  `full_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `mobile_no` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') CHARACTER SET utf8 NOT NULL DEFAULT 'Active',
  `online` enum('0','1') NOT NULL DEFAULT '0',
  `b_status` enum('0','1') DEFAULT '0' COMMENT '0=Inactive,1=active',
  `block_status` enum('Unblock','Block') NOT NULL DEFAULT 'Unblock',
  `block_date` date DEFAULT NULL,
  `registered_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `last_active_time` varchar(255) DEFAULT NULL,
  `date_added` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `parent_id`, `user_group`, `username`, `password`, `email_address`, `full_name`, `mobile_no`, `status`, `online`, `b_status`, `block_status`, `block_date`, `registered_date`, `end_date`, `last_active_time`, `date_added`) VALUES
(1, NULL, '1', 'super-admin', 'e10adc3949ba59abbe56e057f20f883e', 'superadmin@gmail.com', 'super Admin', '', 'Active', '1', '0', 'Block', '2017-11-06', 'MDUtMDgtMjAxOCAyMTowNDoyMg==', 'MjAtMDgtMjAxOCAyMjozMDo0Ng==', '1537774502', '2011-08-29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_db_connection`
--

CREATE TABLE `tbl_db_connection` (
  `id` bigint(20) NOT NULL,
  `admin_type` enum('Super-admin','Admin') NOT NULL DEFAULT 'Admin',
  `pin` varchar(100) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `hostname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `db_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `admin_id` int(11) NOT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_db_connection`
--

INSERT INTO `tbl_db_connection` (`id`, `admin_type`, `pin`, `project_name`, `hostname`, `username`, `db_name`, `password`, `status`, `admin_id`, `create_at`, `update_at`) VALUES
(1, 'Admin', '1234', 'Cis Traking', 'localhost', 'root', 'cis_tracking', '', 'Active', 1, '2020-02-19 00:00:00', '2020-02-19 16:53:59'),
(3, 'Super-admin', 'super7501', 'Manage Databases', 'localhost', 'root', 'multiple_db', '', 'Active', 1, '2020-02-19 00:00:00', '2020-02-19 19:08:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_db_connection`
--
ALTER TABLE `tbl_db_connection`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pin` (`pin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_db_connection`
--
ALTER TABLE `tbl_db_connection`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

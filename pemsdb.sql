-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2020 at 12:01 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pemsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblaccounts`
--

CREATE TABLE `tblaccounts` (
  `ACCOUNT_ID` int(11) NOT NULL,
  `ACCOUNT_NAME` varchar(255) NOT NULL,
  `ACCOUNT_USERNAME` varchar(255) NOT NULL,
  `ACCOUNT_PASSWORD` text NOT NULL,
  `ACCOUNT_TYPE` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblaccounts`
--

INSERT INTO `tblaccounts` (`ACCOUNT_ID`, `ACCOUNT_NAME`, `ACCOUNT_USERNAME`, `ACCOUNT_PASSWORD`, `ACCOUNT_TYPE`) VALUES
(1, 'JONGILL CONSTRUCTION', 'jongill@gmail.com', '5c2dd944dde9e08881bef0894fe7b22a5c9c4b06', 'Administrator'),
(2, 'tester', 'test@yahoo.com', '5c2dd944dde9e08881bef0894fe7b22a5c9c4b06', 'Employee'),
(4, 'HATCH ENTIERRO VILLANUEVA', 'hatch@yahoo.com', '5c2dd944dde9e08881bef0894fe7b22a5c9c4b06', 'Employee'),
(5, 'poger', 'poger@gmail.com', '22da9927892f6ac3402d1286df54d0ecebff4eb6', 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `tblareas`
--

CREATE TABLE `tblareas` (
  `AREAID` int(11) NOT NULL,
  `PROJECTID` int(11) NOT NULL,
  `LOT_NO` varchar(100) NOT NULL,
  `BLOCK_NO` varchar(100) NOT NULL,
  `TOTAL_EXPENSES` double(20,2) NOT NULL,
  `TOTAL_CASH_ADVANCE` double(20,2) NOT NULL,
  `CASH_ADVANCE_DETAILS` text NOT NULL,
  `CREATED_AT` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblareas`
--

INSERT INTO `tblareas` (`AREAID`, `PROJECTID`, `LOT_NO`, `BLOCK_NO`, `TOTAL_EXPENSES`, `TOTAL_CASH_ADVANCE`, `CASH_ADVANCE_DETAILS`, `CREATED_AT`) VALUES
(1, 2, '4', '4', 400.00, 451.00, 'bigas', '2020-08-31 06:33:05'),
(2, 2, '4', '4', 1403.00, 0.00, '', '2020-08-31 08:24:59'),
(3, 2, '3', '2', 0.00, 0.00, '', '2020-08-31 08:36:15'),
(4, 2, '11', '10', 6.00, 0.00, '', '2020-08-31 08:42:09'),
(5, 2, '4', '4', 0.00, 0.00, '', '2020-08-31 09:13:30'),
(6, 2, '12', '12', 32.00, 0.00, '', '2020-08-31 09:15:42');

-- --------------------------------------------------------

--
-- Table structure for table `tblarea_expenses`
--

CREATE TABLE `tblarea_expenses` (
  `AREAEXPENSEID` int(11) NOT NULL,
  `AREAID` int(11) NOT NULL,
  `CATEGORY` text NOT NULL,
  `SCOPE_OF_WORK` text NOT NULL,
  `PCS` int(11) NOT NULL,
  `AMOUNT` decimal(20,2) NOT NULL,
  `TOTAL_AMOUNT` decimal(20,2) NOT NULL,
  `CREATED_AT` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblarea_expenses`
--

INSERT INTO `tblarea_expenses` (`AREAEXPENSEID`, `AREAID`, `CATEGORY`, `SCOPE_OF_WORK`, `PCS`, `AMOUNT`, `TOTAL_AMOUNT`, `CREATED_AT`) VALUES
(1, 76, 'FLOORING & SLAB', 'roy besilos', 1, '1000.00', '1000.00', '2020-08-05 01:24:33'),
(2, 76, 'SEPTIC TANK', 'charry raya', 1, '2000.00', '2000.00', '2020-08-05 01:24:33'),
(3, 76, 'SANITARY PIPES INSTALLATION', 'SONNY ', 1, '2500.00', '2500.00', '2020-08-05 01:24:33'),
(4, 77, 'installation of doors', 'charry raya', 1, '1000.00', '1000.00', '2020-08-05 01:29:48'),
(5, 78, 'EXCAVATION (LILCA)', 'roy', 2, '1000.00', '2000.00', '2020-08-05 01:31:16'),
(6, 79, 'EXCAVATION (LILCA)', 'KUYA JR', 25, '200.00', '5000.00', '2020-08-05 01:38:51'),
(7, 80, 'SEPTIC TANK', 'ROY', 2, '1000.00', '2000.00', '2020-08-05 01:41:20'),
(8, 81, 'STEEL FABRICATION & INSTALLATION', 'charry raya', 2, '200.00', '400.00', '2020-08-05 02:19:47'),
(9, 1, 'cat 1', 'ken', 2, '200.00', '400.00', '2020-08-31 06:33:05'),
(10, 2, 'cat 1', 'ken', 2, '412.00', '824.00', '2020-08-31 08:24:59'),
(11, 2, 'cat 1', 'ken', 1, '3.00', '3.00', '2020-08-31 08:24:59'),
(12, 2, 'cat 1', 'ken', 24, '24.00', '576.00', '2020-08-31 08:24:59'),
(13, 3, 'cat 1', 'ken', 2, '412.00', '0.00', '2020-08-31 08:36:16'),
(14, 4, 'cat 1', 'ken', 2, '3.00', '6.00', '2020-08-31 08:42:10'),
(15, 5, 'cat 1', 'kenji', 2, '2.00', '4.00', '2020-08-31 09:13:30'),
(16, 5, 'cat 1', 'kenji', 2, '2.00', '4.00', '2020-08-31 09:13:30'),
(17, 6, 'cat 1', 'tito', 4, '4.00', '16.00', '2020-08-31 09:15:42'),
(18, 6, 'cat 1', 'tito', 4, '4.00', '16.00', '2020-08-31 09:15:42');

-- --------------------------------------------------------

--
-- Table structure for table `tblcommonmaster`
--

CREATE TABLE `tblcommonmaster` (
  `COMMON_ID` int(11) NOT NULL,
  `COMMONCODE` varchar(30) NOT NULL,
  `CATEGORY` varchar(30) NOT NULL,
  `LISTNAME` varchar(30) NOT NULL,
  `IS_DEFAULT` varchar(3) NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblconstants`
--

CREATE TABLE `tblconstants` (
  `CONSTANTID` int(11) NOT NULL,
  `CATTYPE` varchar(255) NOT NULL,
  `VALUE` varchar(255) NOT NULL,
  `SUBBVALUE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblconstants`
--

INSERT INTO `tblconstants` (`CONSTANTID`, `CATTYPE`, `VALUE`, `SUBBVALUE`) VALUES
(1, 'Category', 'cat 1', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblexpenses`
--

CREATE TABLE `tblexpenses` (
  `EXPID` int(11) NOT NULL,
  `PROJECTID` int(11) NOT NULL,
  `EXPTYPE` varchar(30) NOT NULL,
  `EXPITEM` varchar(50) NOT NULL,
  `SUPPLIER` varchar(50) NOT NULL,
  `DATEGIVEN` date NOT NULL,
  `DATEADDED` date NOT NULL,
  `EXPENSES` decimal(12,2) NOT NULL,
  `REQUESTEDBY` varchar(30) NOT NULL,
  `ENCODER` varchar(30) NOT NULL,
  `EMPID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblproject`
--

CREATE TABLE `tblproject` (
  `PROJECTID` int(11) NOT NULL,
  `PROJECTNAME` varchar(50) NOT NULL,
  `STARTDATE` date NOT NULL,
  `ENDDATE` date NOT NULL,
  `PROJECTCOST` decimal(13,2) NOT NULL,
  `PROJECTSTATUS` varchar(10) NOT NULL,
  `PROJECTEXPENSES` decimal(13,2) NOT NULL,
  `PROJECTCASHADVANCE` double(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblproject`
--

INSERT INTO `tblproject` (`PROJECTID`, `PROJECTNAME`, `STARTDATE`, `ENDDATE`, `PROJECTCOST`, `PROJECTSTATUS`, `PROJECTEXPENSES`, `PROJECTCASHADVANCE`) VALUES
(1, 'payroll', '2020-01-01', '2020-01-01', '1500.00', 'ONGOING', '0.00', 0.00),
(2, 'Moa', '2020-08-22', '2020-08-20', '8000000.00', 'ONGOING', '1841.00', 451.00);

-- --------------------------------------------------------

--
-- Table structure for table `tblsupplier`
--

CREATE TABLE `tblsupplier` (
  `SUPID` int(11) NOT NULL,
  `SUPCODE` varchar(30) NOT NULL,
  `SUPNAME` text NOT NULL,
  `SUPTIN` varchar(30) NOT NULL,
  `SUPADD` text NOT NULL,
  `SUPCONTACT` varchar(30) NOT NULL,
  `SUPREMARKS` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsupplier`
--

INSERT INTO `tblsupplier` (`SUPID`, `SUPCODE`, `SUPNAME`, `SUPTIN`, `SUPADD`, `SUPCONTACT`, `SUPREMARKS`) VALUES
(1, 'S13183229', 'HARDWARE', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_areacashadv`
--

CREATE TABLE `tbl_areacashadv` (
  `col_id` int(11) NOT NULL,
  `col_cashadv_id` int(11) DEFAULT NULL,
  `col_amount` float DEFAULT NULL,
  `SCOPE_OF_WORK` varchar(255) NOT NULL,
  `col_createdat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_areacashadv`
--

INSERT INTO `tbl_areacashadv` (`col_id`, `col_cashadv_id`, `col_amount`, `SCOPE_OF_WORK`, `col_createdat`) VALUES
(1, 2, 3333, 'ken', '2020-08-30 16:00:00'),
(2, 1, 444, 'ken', '2020-08-30 16:00:00'),
(3, 2, 3333, 'ken', '2020-08-30 16:00:00'),
(4, 1, 2, 'ken', '2020-08-30 16:00:00'),
(5, 1, 255, 'kenji', '2020-08-31 09:13:30'),
(6, 1, 255, 'kenji', '2020-08-31 09:13:31'),
(7, 2, 255, 'kenji', '2020-08-31 09:13:31'),
(8, 2, 255, 'kenji', '2020-08-31 09:13:31'),
(9, 1, 22, 'tito', '2020-08-31 09:15:42'),
(10, 1, 22, 'tito', '2020-08-31 09:15:42'),
(11, 1, 22, 'tito', '2020-08-31 09:15:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cashadv`
--

CREATE TABLE `tbl_cashadv` (
  `col_id` int(11) NOT NULL,
  `col_cat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cashadv`
--

INSERT INTO `tbl_cashadv` (`col_id`, `col_cat`) VALUES
(1, 'wewewewwwew'),
(2, 'aaaaa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblaccounts`
--
ALTER TABLE `tblaccounts`
  ADD PRIMARY KEY (`ACCOUNT_ID`);

--
-- Indexes for table `tblareas`
--
ALTER TABLE `tblareas`
  ADD PRIMARY KEY (`AREAID`);

--
-- Indexes for table `tblarea_expenses`
--
ALTER TABLE `tblarea_expenses`
  ADD PRIMARY KEY (`AREAEXPENSEID`);

--
-- Indexes for table `tblcommonmaster`
--
ALTER TABLE `tblcommonmaster`
  ADD PRIMARY KEY (`COMMON_ID`);

--
-- Indexes for table `tblconstants`
--
ALTER TABLE `tblconstants`
  ADD PRIMARY KEY (`CONSTANTID`);

--
-- Indexes for table `tblexpenses`
--
ALTER TABLE `tblexpenses`
  ADD PRIMARY KEY (`EXPID`);

--
-- Indexes for table `tblproject`
--
ALTER TABLE `tblproject`
  ADD PRIMARY KEY (`PROJECTID`);

--
-- Indexes for table `tblsupplier`
--
ALTER TABLE `tblsupplier`
  ADD PRIMARY KEY (`SUPID`);

--
-- Indexes for table `tbl_areacashadv`
--
ALTER TABLE `tbl_areacashadv`
  ADD PRIMARY KEY (`col_id`),
  ADD UNIQUE KEY `AREAID` (`col_id`);

--
-- Indexes for table `tbl_cashadv`
--
ALTER TABLE `tbl_cashadv`
  ADD PRIMARY KEY (`col_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblaccounts`
--
ALTER TABLE `tblaccounts`
  MODIFY `ACCOUNT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblareas`
--
ALTER TABLE `tblareas`
  MODIFY `AREAID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblarea_expenses`
--
ALTER TABLE `tblarea_expenses`
  MODIFY `AREAEXPENSEID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tblcommonmaster`
--
ALTER TABLE `tblcommonmaster`
  MODIFY `COMMON_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblconstants`
--
ALTER TABLE `tblconstants`
  MODIFY `CONSTANTID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblexpenses`
--
ALTER TABLE `tblexpenses`
  MODIFY `EXPID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblproject`
--
ALTER TABLE `tblproject`
  MODIFY `PROJECTID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblsupplier`
--
ALTER TABLE `tblsupplier`
  MODIFY `SUPID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_areacashadv`
--
ALTER TABLE `tbl_areacashadv`
  MODIFY `col_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_cashadv`
--
ALTER TABLE `tbl_cashadv`
  MODIFY `col_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

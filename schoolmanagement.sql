-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2024 at 07:44 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schoolmanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `clientlist`
--

CREATE TABLE `clientlist` (
  `cid` int(11) NOT NULL,
  `clientName` varchar(255) NOT NULL,
  `companyName` varchar(255) NOT NULL,
  `clientGst` varchar(255) NOT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `panNumber` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clientlist`
--

INSERT INTO `clientlist` (`cid`, `clientName`, `companyName`, `clientGst`, `phoneNumber`, `email`, `panNumber`, `Address`, `status`, `date`) VALUES
(1, 'Asharaf Shaikh', 'BEEZAASAN EXPLOTECH PVT. LTD', '24AAFCB7089L2Z7', '8758077357', 'safety@beezaasan.in', 'AAFCB7089L', 'Survey No. 807/P/1, 808, 810, 811, 812, 820 & 822. Vill. Bhanthala, Felsani, TaBalasinor, Dist- Mahisagar (Kheda) Pincode 388255. Gujarat.', 0, '2024-12-21 23:03:44');

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `id` int(11) NOT NULL,
  `clientname` text NOT NULL,
  `number` varchar(255) NOT NULL,
  `enquerydetails` varchar(255) NOT NULL,
  `assign` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `createdate` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `followupdate` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`id`, `clientname`, `number`, `enquerydetails`, `assign`, `status`, `createdate`, `note`, `followupdate`, `date`) VALUES
(3, 'Parmesh singh ', '9924468983', 'need to follow and friday ', '2', 1, '2024-12-20', 'Need to talk', '2024-12-21', '2024-11-26 17:42:30'),
(17, 'Yash Sharma ', '8527599841', 'Website ', '4', 1, '2024-12-12', 'Need To Call Today ', '2024-12-13', '2024-12-13 10:52:51'),
(19, 'Krishna Corporation Kaliraman ', '9824999928', 'Website Development ', '4', 1, '2024-12-12', 'Today for Confirmation ', '2024-12-13', '2024-12-13 11:09:36'),
(20, 'Rakhi Homeopathy ', '7573028041', 'New Website ', '4', 1, '2024-12-12', 'Visit Today ', '2024-12-13', '2024-12-13 11:12:43'),
(22, ' Pradip Panchal ', '8866676849', 'Website', '4', 1, '2024-12-12', 'Visit his Office for Remaip Website ', '', '2024-12-13 11:25:39'),
(23, 'Chaitrali ', '9099927613', 'Course', 'Select User', 1, '2024-12-13', 'Need to ask for Visit Office for Course ', '', '2024-12-13 11:33:39');

-- --------------------------------------------------------

--
-- Table structure for table `productlist`
--

CREATE TABLE `productlist` (
  `product_id` int(11) NOT NULL,
  `ProductGenID` varchar(255) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `hsnSACNumber` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `productRate` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `gstamount` int(255) NOT NULL,
  `status` int(11) NOT NULL,
  `modifyDate` varchar(255) NOT NULL,
  `CreateDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productlist`
--

INSERT INTO `productlist` (`product_id`, `ProductGenID`, `productName`, `hsnSACNumber`, `unit`, `productRate`, `note`, `gstamount`, `status`, `modifyDate`, `CreateDate`) VALUES
(1, '', 'Form 37 - Noise ( Minimum 5 Spot )', '998349', 'PER SPOT ', '500.00', 'Done', 90, 0, '', '2024-12-20 23:45:01'),
(2, '', 'Form 37 - illumination ( Minimum 5 Spot )', '998349', 'PER SPOT', '500.00', 'Done', 90, 0, '', '2024-12-21 14:55:06');

-- --------------------------------------------------------

--
-- Table structure for table `quotationlist`
--

CREATE TABLE `quotationlist` (
  `quotation_id` int(11) NOT NULL,
  `quotation_gen_id` varchar(255) NOT NULL,
  `Clientid` varchar(255) NOT NULL,
  `Subject` varchar(255) NOT NULL,
  `Reference` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `cdate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quotationlist`
--

INSERT INTO `quotationlist` (`quotation_id`, `quotation_gen_id`, `Clientid`, `Subject`, `Reference`, `status`, `cdate`) VALUES
(1, '105101', '1', 'Quotation for Form 37', 'With reference to above subject, we thank you very much for your valued inquiry and are pleased to quote our most competitive rate for above subject', 0, '2024-12-22 00:20:30');

-- --------------------------------------------------------

--
-- Table structure for table `quotationlistproduct`
--

CREATE TABLE `quotationlistproduct` (
  `quotation_prodcut_id` int(11) NOT NULL,
  `quotation_id` varchar(255) NOT NULL,
  `prodcut_id` varchar(255) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quotationlistproduct`
--

INSERT INTO `quotationlistproduct` (`quotation_prodcut_id`, `quotation_id`, `prodcut_id`, `product_price`, `quantity`, `description`, `status`, `date`) VALUES
(1, '1', '1', '500', '5', ' Minimum 5 Spot', 0, '2024-12-22 14:49:24'),
(2, '1', '2', '500', '5', ' Minimum 5 Spot', 0, '2024-12-22 14:49:06');

-- --------------------------------------------------------

--
-- Table structure for table `quotationlisttc`
--

CREATE TABLE `quotationlisttc` (
  `QuotationListtcid` int(11) NOT NULL,
  `quotation_id` varchar(255) NOT NULL,
  `tc_id` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `tcdate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quotationlisttc`
--

INSERT INTO `quotationlisttc` (`QuotationListtcid`, `quotation_id`, `tc_id`, `status`, `tcdate`) VALUES
(1, '1', '1', 0, '2024-12-22 00:20:30');

-- --------------------------------------------------------

--
-- Table structure for table `termsandconditionlist`
--

CREATE TABLE `termsandconditionlist` (
  `tc_id` int(11) NOT NULL,
  `termANDcondition` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `termsandconditionlist`
--

INSERT INTO `termsandconditionlist` (`tc_id`, `termANDcondition`, `status`, `date`) VALUES
(1, 'Work will be started in between 3-4 working days after getting LOI or Order from your side.', 0, '2024-12-21 00:15:10');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `pass`, `status`, `date`) VALUES
(1, 'Ram Sir', 'admin@php.com', '123456', 'Admin', '2024-11-23 22:49:03'),
(3, 'ram', 'ram@mail.com', '12345', 'User', '2024-11-27 11:24:34'),
(4, 'Karishma ', 'karishma@nail.com', '123', 'User', '2024-12-11 23:15:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientlist`
--
ALTER TABLE `clientlist`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productlist`
--
ALTER TABLE `productlist`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `quotationlist`
--
ALTER TABLE `quotationlist`
  ADD PRIMARY KEY (`quotation_id`);

--
-- Indexes for table `quotationlistproduct`
--
ALTER TABLE `quotationlistproduct`
  ADD PRIMARY KEY (`quotation_prodcut_id`);

--
-- Indexes for table `quotationlisttc`
--
ALTER TABLE `quotationlisttc`
  ADD PRIMARY KEY (`QuotationListtcid`);

--
-- Indexes for table `termsandconditionlist`
--
ALTER TABLE `termsandconditionlist`
  ADD PRIMARY KEY (`tc_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientlist`
--
ALTER TABLE `clientlist`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `productlist`
--
ALTER TABLE `productlist`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quotationlist`
--
ALTER TABLE `quotationlist`
  MODIFY `quotation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `quotationlistproduct`
--
ALTER TABLE `quotationlistproduct`
  MODIFY `quotation_prodcut_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quotationlisttc`
--
ALTER TABLE `quotationlisttc`
  MODIFY `QuotationListtcid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `termsandconditionlist`
--
ALTER TABLE `termsandconditionlist`
  MODIFY `tc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

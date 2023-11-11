-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2023 at 10:53 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fueldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `dailydip`
--

CREATE TABLE `dailydip` (
  `iddailydip` int(11) NOT NULL,
  `checkdate` date DEFAULT NULL,
  `petrol` int(11) DEFAULT NULL,
  `diesel` int(11) DEFAULT NULL,
  `superdiesel` int(11) DEFAULT NULL,
  `superpetrol` int(11) DEFAULT NULL,
  `fillingstation_idfillingstation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `iddocuments` int(11) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `filename` varchar(450) DEFAULT NULL,
  `uploaddate` date DEFAULT NULL,
  `isapproved` tinyint(4) DEFAULT NULL,
  `fillingstation_idfillingstation` int(11) NOT NULL,
  `approvedby` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `idemployee` int(11) NOT NULL,
  `epf` varchar(45) DEFAULT NULL,
  `isactive` tinyint(4) DEFAULT NULL,
  `isavailable` tinyint(4) DEFAULT NULL,
  `employeetype_idemployeetype` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`idemployee`, `epf`, `isactive`, `isavailable`, `employeetype_idemployeetype`, `userid`) VALUES
(2, '666', 1, 1, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `employeetype`
--

CREATE TABLE `employeetype` (
  `idemployeetype` int(11) NOT NULL,
  `employeetype` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `employeetype`
--

INSERT INTO `employeetype` (`idemployeetype`, `employeetype`) VALUES
(1, 'noone');

-- --------------------------------------------------------

--
-- Table structure for table `fillingstation`
--

CREATE TABLE `fillingstation` (
  `idfillingstation` int(11) NOT NULL,
  `fillingstation_name` varchar(45) DEFAULT NULL,
  `fillingstation_address` varchar(450) DEFAULT NULL,
  `numberoffueldespencers` int(11) DEFAULT NULL,
  `capacityofpetroltank` int(11) DEFAULT NULL,
  `capacityofdieseltank` int(11) DEFAULT NULL,
  `capacityofsuperpetrol` int(11) DEFAULT NULL,
  `capacityofsuperdiesel` int(11) DEFAULT NULL,
  `district` varchar(45) DEFAULT NULL,
  `Users_idUsers` int(11) NOT NULL,
  `isapproved` tinyint(4) DEFAULT NULL,
  `approvedby` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `fillingstation`
--

INSERT INTO `fillingstation` (`idfillingstation`, `fillingstation_name`, `fillingstation_address`, `numberoffueldespencers`, `capacityofpetroltank`, `capacityofdieseltank`, `capacityofsuperpetrol`, `capacityofsuperdiesel`, `district`, `Users_idUsers`, `isapproved`, `approvedby`) VALUES
(1, 'Maharagama Filling Station', '321 Railway Avenue', 2, 0, 0, 0, 0, 'Western Province', 2, 0, 'none'),
(2, 'Maharagama Filling Station', '321 Railway Avenue', 3, 6600, 6600, 6600, 6600, 'Western Province', 3, 0, 'none');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `idLocation` int(11) NOT NULL,
  `locationname` varchar(45) DEFAULT NULL,
  `location_is_active` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`idLocation`, `locationname`, `location_is_active`) VALUES
(1, 'Mahargama', '1');

-- --------------------------------------------------------

--
-- Table structure for table `loginlog`
--

CREATE TABLE `loginlog` (
  `idloginlog` int(11) NOT NULL,
  `logindate` datetime DEFAULT NULL,
  `Users_idUsers` int(11) NOT NULL,
  `otpcode` varchar(45) DEFAULT NULL,
  `iscorrect` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `materialprice`
--

CREATE TABLE `materialprice` (
  `idmaterialprice` int(11) NOT NULL,
  `materialtype` varchar(45) DEFAULT NULL,
  `materialprice` int(11) DEFAULT NULL,
  `material_is_active` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `materialprice`
--

INSERT INTO `materialprice` (`idmaterialprice`, `materialtype`, `materialprice`, `material_is_active`) VALUES
(1, 'Petrol', 250, '1');

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `idorderitems` int(11) NOT NULL,
  `itemname` varchar(45) DEFAULT NULL,
  `qty` double DEFAULT NULL,
  `itemamount` double DEFAULT NULL,
  `orders_idorders` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `idorders` int(11) NOT NULL,
  `orderdate` datetime DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `tax` double DEFAULT NULL,
  `isapproved` tinyint(4) DEFAULT NULL,
  `fillingstation_idfillingstation` int(11) NOT NULL,
  `approvedby` varchar(45) DEFAULT NULL,
  `vehicle_idvehicle` int(11) NOT NULL,
  `employee_idemployee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paymentmethod`
--

CREATE TABLE `paymentmethod` (
  `idpaymentmethod` int(11) NOT NULL,
  `method_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `idpayments` int(11) NOT NULL,
  `paymentdate` datetime DEFAULT NULL,
  `isreceived` tinyint(4) DEFAULT NULL,
  `paymentmethod_idpaymentmethod` int(11) NOT NULL,
  `amount` double DEFAULT NULL,
  `orders_idorders` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idUsers` int(11) NOT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `password` varchar(300) DEFAULT NULL,
  `isadmin` tinyint(4) DEFAULT NULL,
  `isdealer` tinyint(4) DEFAULT NULL,
  `isdriver` tinyint(4) DEFAULT NULL,
  `phonenumber` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUsers`, `firstname`, `lastname`, `email`, `password`, `isadmin`, `isdealer`, `isdriver`, `phonenumber`) VALUES
(1, 'thilina', 'abeysinghe', 'thilina@gmail.com', 'sameera', 1, 1, 1, '076666666'),
(2, 'Thilina', 'Abeysinghe', 'recurzivewebdesign@gmail.com', 'sameera', 0, 1, 0, '779798118'),
(3, 'Thilina', 'Abeysinghe', 'admin', 'sameera', 0, 1, 0, '779798118'),
(4, 'Thilina', 'Abeysinghe', 'tsa@gmail.com', 'abey', 0, 0, 0, '717611448'),
(5, 'Thilina', 'Abeysinghe', 'tsa@gmail.com', 'sameera', 0, 0, 0, '779798118'),
(6, NULL, NULL, NULL, NULL, 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `idvehicle` int(11) NOT NULL,
  `vehicle_number` varchar(45) DEFAULT NULL,
  `vehicle_chasis_number` varchar(45) DEFAULT NULL,
  `vehicle_yom` datetime DEFAULT NULL,
  `vehicle_no_of_passengers` int(11) DEFAULT NULL,
  `vehicle_weight` int(11) DEFAULT NULL,
  `vehicle_is_available` varchar(45) DEFAULT NULL,
  `vehicle_is_active` varchar(45) DEFAULT NULL,
  `vehicle_type_idvehicle_type` int(11) NOT NULL,
  `Location_idLocation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`idvehicle`, `vehicle_number`, `vehicle_chasis_number`, `vehicle_yom`, `vehicle_no_of_passengers`, `vehicle_weight`, `vehicle_is_available`, `vehicle_is_active`, `vehicle_type_idvehicle_type`, `Location_idLocation`) VALUES
(1, '25558', '588', '2021-06-18 00:00:00', 2, 25, '1', '1', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_calibration_certificate`
--

CREATE TABLE `vehicle_calibration_certificate` (
  `idvehicle_calibration_certificate` int(11) NOT NULL,
  `vehicle_calibration_certificate_name` varchar(45) DEFAULT NULL,
  `vehicle_calibration_certificate_issue_date` datetime DEFAULT NULL,
  `vehicle_calibration_certificate_expiry_date` datetime DEFAULT NULL,
  `vehicle_calibration_certificate_is_active` varchar(45) DEFAULT NULL,
  `vehicle_idvehicle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `vehicle_calibration_certificate`
--

INSERT INTO `vehicle_calibration_certificate` (`idvehicle_calibration_certificate`, `vehicle_calibration_certificate_name`, `vehicle_calibration_certificate_issue_date`, `vehicle_calibration_certificate_expiry_date`, `vehicle_calibration_certificate_is_active`, `vehicle_idvehicle`) VALUES
(1, 'ISO124', '2023-10-18 00:00:00', '2023-10-18 00:00:00', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_revenue_license`
--

CREATE TABLE `vehicle_revenue_license` (
  `idvehicle_revenue_license` int(11) NOT NULL,
  `vehicle_revenue_license_name` varchar(45) DEFAULT NULL,
  `vehicle_revenue_license_issue_date` datetime DEFAULT NULL,
  `vehicle_revenue_license_expiry_date` datetime DEFAULT NULL,
  `vehicle_revenue_license_is_active` varchar(45) DEFAULT NULL,
  `vehicle_idvehicle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `vehicle_revenue_license`
--

INSERT INTO `vehicle_revenue_license` (`idvehicle_revenue_license`, `vehicle_revenue_license_name`, `vehicle_revenue_license_issue_date`, `vehicle_revenue_license_expiry_date`, `vehicle_revenue_license_is_active`, `vehicle_idvehicle`) VALUES
(2, '111d', '2023-10-18 00:00:00', '2023-10-18 00:00:00', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_type`
--

CREATE TABLE `vehicle_type` (
  `idvehicle_type` int(11) NOT NULL,
  `vehicle_capacity` int(11) DEFAULT NULL,
  `vehicle_type` varchar(45) DEFAULT NULL,
  `vehicle_type_is_active` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `vehicle_type`
--

INSERT INTO `vehicle_type` (`idvehicle_type`, `vehicle_capacity`, `vehicle_type`, `vehicle_type_is_active`) VALUES
(1, 555, 'cool', '1'),
(2, 60000, 'Bouser', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dailydip`
--
ALTER TABLE `dailydip`
  ADD PRIMARY KEY (`iddailydip`),
  ADD KEY `fk_dailydip_fillingstation` (`fillingstation_idfillingstation`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`iddocuments`),
  ADD KEY `fk_documents_fillingstation1` (`fillingstation_idfillingstation`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`idemployee`),
  ADD UNIQUE KEY `userid` (`userid`),
  ADD KEY `fk_employee_employeetype1` (`employeetype_idemployeetype`);

--
-- Indexes for table `employeetype`
--
ALTER TABLE `employeetype`
  ADD PRIMARY KEY (`idemployeetype`);

--
-- Indexes for table `fillingstation`
--
ALTER TABLE `fillingstation`
  ADD PRIMARY KEY (`idfillingstation`),
  ADD KEY `fk_fillingstation_Users1` (`Users_idUsers`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`idLocation`);

--
-- Indexes for table `loginlog`
--
ALTER TABLE `loginlog`
  ADD PRIMARY KEY (`idloginlog`),
  ADD KEY `fk_loginlog_Users1` (`Users_idUsers`);

--
-- Indexes for table `materialprice`
--
ALTER TABLE `materialprice`
  ADD PRIMARY KEY (`idmaterialprice`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`idorderitems`),
  ADD KEY `fk_orderitems_orders1` (`orders_idorders`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`idorders`),
  ADD KEY `fk_orders_fillingstation1` (`fillingstation_idfillingstation`),
  ADD KEY `fk_orders_vehicle1` (`vehicle_idvehicle`),
  ADD KEY `fk_orders_employee1` (`employee_idemployee`);

--
-- Indexes for table `paymentmethod`
--
ALTER TABLE `paymentmethod`
  ADD PRIMARY KEY (`idpaymentmethod`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`idpayments`),
  ADD KEY `fk_payments_paymentmethod1` (`paymentmethod_idpaymentmethod`),
  ADD KEY `fk_payments_orders1` (`orders_idorders`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUsers`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`idvehicle`),
  ADD KEY `fk_vehicle_vehicle_type1` (`vehicle_type_idvehicle_type`),
  ADD KEY `fk_vehicle_Location1` (`Location_idLocation`);

--
-- Indexes for table `vehicle_calibration_certificate`
--
ALTER TABLE `vehicle_calibration_certificate`
  ADD PRIMARY KEY (`idvehicle_calibration_certificate`),
  ADD KEY `fk_vehicle_calibration_certificate_vehicle1` (`vehicle_idvehicle`);

--
-- Indexes for table `vehicle_revenue_license`
--
ALTER TABLE `vehicle_revenue_license`
  ADD PRIMARY KEY (`idvehicle_revenue_license`),
  ADD KEY `fk_vehicle_revenue_license_vehicle1` (`vehicle_idvehicle`);

--
-- Indexes for table `vehicle_type`
--
ALTER TABLE `vehicle_type`
  ADD PRIMARY KEY (`idvehicle_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dailydip`
--
ALTER TABLE `dailydip`
  MODIFY `iddailydip` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `iddocuments` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `idemployee` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employeetype`
--
ALTER TABLE `employeetype`
  MODIFY `idemployeetype` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fillingstation`
--
ALTER TABLE `fillingstation`
  MODIFY `idfillingstation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `idLocation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `loginlog`
--
ALTER TABLE `loginlog`
  MODIFY `idloginlog` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `materialprice`
--
ALTER TABLE `materialprice`
  MODIFY `idmaterialprice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `idorderitems` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `idorders` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paymentmethod`
--
ALTER TABLE `paymentmethod`
  MODIFY `idpaymentmethod` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `idpayments` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idUsers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `idvehicle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vehicle_calibration_certificate`
--
ALTER TABLE `vehicle_calibration_certificate`
  MODIFY `idvehicle_calibration_certificate` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vehicle_revenue_license`
--
ALTER TABLE `vehicle_revenue_license`
  MODIFY `idvehicle_revenue_license` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vehicle_type`
--
ALTER TABLE `vehicle_type`
  MODIFY `idvehicle_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dailydip`
--
ALTER TABLE `dailydip`
  ADD CONSTRAINT `fk_dailydip_fillingstation` FOREIGN KEY (`fillingstation_idfillingstation`) REFERENCES `fillingstation` (`idfillingstation`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `fk_documents_fillingstation1` FOREIGN KEY (`fillingstation_idfillingstation`) REFERENCES `fillingstation` (`idfillingstation`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `fk_employee_employeetype1` FOREIGN KEY (`employeetype_idemployeetype`) REFERENCES `employeetype` (`idemployeetype`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `users_idusersfk` FOREIGN KEY (`userid`) REFERENCES `users` (`idUsers`);

--
-- Constraints for table `fillingstation`
--
ALTER TABLE `fillingstation`
  ADD CONSTRAINT `fk_fillingstation_Users1` FOREIGN KEY (`Users_idUsers`) REFERENCES `users` (`idUsers`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `loginlog`
--
ALTER TABLE `loginlog`
  ADD CONSTRAINT `fk_loginlog_Users1` FOREIGN KEY (`Users_idUsers`) REFERENCES `users` (`idUsers`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `fk_orderitems_orders1` FOREIGN KEY (`orders_idorders`) REFERENCES `orders` (`idorders`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_employee1` FOREIGN KEY (`employee_idemployee`) REFERENCES `employee` (`idemployee`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_orders_fillingstation1` FOREIGN KEY (`fillingstation_idfillingstation`) REFERENCES `fillingstation` (`idfillingstation`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_orders_vehicle1` FOREIGN KEY (`vehicle_idvehicle`) REFERENCES `vehicle` (`idvehicle`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_payments_orders1` FOREIGN KEY (`orders_idorders`) REFERENCES `orders` (`idorders`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_payments_paymentmethod1` FOREIGN KEY (`paymentmethod_idpaymentmethod`) REFERENCES `paymentmethod` (`idpaymentmethod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `fk_vehicle_Location1` FOREIGN KEY (`Location_idLocation`) REFERENCES `location` (`idLocation`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_vehicle_vehicle_type1` FOREIGN KEY (`vehicle_type_idvehicle_type`) REFERENCES `vehicle_type` (`idvehicle_type`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `vehicle_calibration_certificate`
--
ALTER TABLE `vehicle_calibration_certificate`
  ADD CONSTRAINT `fk_vehicle_calibration_certificate_vehicle1` FOREIGN KEY (`vehicle_idvehicle`) REFERENCES `vehicle` (`idvehicle`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `vehicle_revenue_license`
--
ALTER TABLE `vehicle_revenue_license`
  ADD CONSTRAINT `fk_vehicle_revenue_license_vehicle1` FOREIGN KEY (`vehicle_idvehicle`) REFERENCES `vehicle` (`idvehicle`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

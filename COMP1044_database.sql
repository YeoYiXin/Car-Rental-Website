-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2023 at 01:05 PM
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
-- Database: `comp1044_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `Booking_ID` varchar(10) NOT NULL,
  `Car_ID` varchar(10) NOT NULL,
  `Customer_ID` varchar(10) NOT NULL,
  `Staff_ID` varchar(10) NOT NULL,
  `Start_Date` date NOT NULL,
  `End_Date` date NOT NULL,
  `Time_Booked` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`Booking_ID`, `Car_ID`, `Customer_ID`, `Staff_ID`, `Start_Date`, `End_Date`, `Time_Booked`) VALUES
('BO001', 'CL55R', 'CU001', 'ST003', '2023-04-20', '2023-04-21', '23:30:40'),
('BO002', 'LU75X', 'CU002', 'ST002', '2023-04-18', '2023-04-19', '23:30:40'),
('BO003', 'SP65T', 'CU001', 'ST003', '2023-04-10', '2023-04-12', '23:30:40');

--
-- Triggers `booking`
--
DELIMITER $$
CREATE TRIGGER `set_booking_id` BEFORE INSERT ON `booking` FOR EACH ROW BEGIN
  SET NEW.Booking_ID = CONCAT('BO', LPAD((SELECT COUNT(*) FROM booking) + 1, 3, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `Car_ID` varchar(10) NOT NULL,
  `Plate_No` varchar(200) NOT NULL,
  `Model` varchar(200) NOT NULL,
  `Price` int(11) NOT NULL,
  `Type` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`Car_ID`, `Plate_No`, `Model`, `Price`, `Type`) VALUES
('CL55R', 'SYW1', 'Jaguar MK 2 (White)', 2200, 'Classics Car'),
('CL56R', 'SYW2', 'Rolls Royce Silver Spirit Limousine (Georgian Silver)', 3200, 'Classics Car'),
('CL57R', 'SYW3', 'MG TD (Red)', 2500, 'Classics Car'),
('LU75X', 'JNL1', 'Rolls Royce Phantom (Blue)', 9800, 'Luxurious'),
('LU76X', 'JNL2', 'Bentley Continental Flying Spur (White)', 4800, 'Luxurious'),
('LU77X', 'JNL3', 'Mercedes Benz CLS 350 (Silver)', 1350, 'Luxurious'),
('LU78X', 'JNL4', 'Jaguar S Type (Champagne)', 1350, 'Luxurious'),
('SP65T', 'VKD1', 'Ferrari F430 Scuderia (Red)', 6000, 'Sports Car'),
('SP66T', 'VKD2', 'Lamborghini Murcielago LP640 (Matte Black)', 7000, 'Sports Car'),
('SP67T', 'VKD3', 'Porsche Boxster (White)', 2800, 'Sports Car'),
('SP68T', 'VKD4', 'Lexus SC430 (Black)', 1600, 'Sports Car');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Customer_ID` varchar(10) NOT NULL,
  `First_Name` varchar(255) DEFAULT NULL,
  `Last_Name` varchar(255) DEFAULT NULL,
  `Date_of_Birth` date NOT NULL,
  `Address` varchar(200) NOT NULL,
  `PO_Box` int(11) NOT NULL,
  `ID_Number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Customer_ID`, `First_Name`, `Last_Name`, `Date_of_Birth`, `Address`, `PO_Box`, `ID_Number`) VALUES
('CU001', 'Jaya', 'Done', '2000-12-03', 'Jalan Broga, Semenyih, Selangor, Malaysia', 54000, 123456789),
('CU002', 'Red', 'Done', '2000-11-03', 'Jalan Lain, Cheras, Selangor, Malaysia', 54000, 123546789),
('CU003', 'John', 'Done', '2000-12-03', 'Jalan Broga, Semenyih, Selangor, Malaysia', 54000, 123450989),
('CU004', 'Ahmed', 'Najjar', '2005-06-17', 'Semenyih, Selangor', 1324, 132412),
('CU005', 'Elvis', 'Simiyu', '1989-05-20', 'Semenyih, Selangor', 43500, 20409666);

--
-- Triggers `customer`
--
DELIMITER $$
CREATE TRIGGER `set_customer_id` BEFORE INSERT ON `customer` FOR EACH ROW BEGIN
  SET NEW.Customer_ID = CONCAT('CU', LPAD((SELECT COUNT(*) FROM customer) + 1, 3, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Payment_ID` varchar(10) NOT NULL,
  `Customer_ID` varchar(10) NOT NULL,
  `Booking_ID` varchar(10) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Status` enum('Paid','Not paid') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`Payment_ID`, `Customer_ID`, `Booking_ID`, `Amount`, `Status`) VALUES
('PA001', 'CU001', 'BO001', 2200, 'Paid');

--
-- Triggers `payment`
--
DELIMITER $$
CREATE TRIGGER `set_payment_id` BEFORE INSERT ON `payment` FOR EACH ROW BEGIN
  SET NEW.Payment_ID = CONCAT('PA', LPAD((SELECT COUNT(*) FROM payment) + 1, 3, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `Staff_ID` varchar(10) NOT NULL,
  `First_Name` varchar(50) NOT NULL,
  `Last_Name` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`Staff_ID`, `First_Name`, `Last_Name`, `Username`, `Password`) VALUES
('ST001', 'Masud Abas', 'Sheikh', 'user123', '26b3e9d7e3e4971418600eac61e9a985'),
('ST002', 'Yi Xin', 'Yeo', 'user234', '4e0090e7fb3073090adea6927b1e35b4'),
('ST003', 'En Xuan', 'Lim', 'user23', '5ef7e1785bc25f443a9f6c5c5fdf48f7'),
('ST004', 'Simiyu', 'Elvis Musungu', 'user3', 'b2270eb890a888a384f48746ae1f70ed');

--
-- Triggers `staff`
--
DELIMITER $$
CREATE TRIGGER `set_staff_id` BEFORE INSERT ON `staff` FOR EACH ROW BEGIN
  SET NEW.Staff_ID = CONCAT('ST', LPAD((SELECT COUNT(*) FROM staff) + 1, 3, '0'));
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`Booking_ID`),
  ADD KEY `fk_car` (`Car_ID`),
  ADD KEY `fk_customer` (`Customer_ID`),
  ADD KEY `fk_staff` (`Staff_ID`);

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`Car_ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Customer_ID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Payment_ID`),
  ADD KEY `fk_booking_payment` (`Booking_ID`),
  ADD KEY `fk_customer_payment` (`Customer_ID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`Staff_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_car` FOREIGN KEY (`Car_ID`) REFERENCES `car` (`Car_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_customer` FOREIGN KEY (`Customer_ID`) REFERENCES `customer` (`Customer_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_staff` FOREIGN KEY (`Staff_ID`) REFERENCES `staff` (`Staff_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_booking_payment` FOREIGN KEY (`Booking_ID`) REFERENCES `booking` (`Booking_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_customer_payment` FOREIGN KEY (`Customer_ID`) REFERENCES `customer` (`Customer_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

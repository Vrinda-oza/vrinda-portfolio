-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2025 at 07:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eventopia1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(20) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `contact_number`, `password`) VALUES
(1, 'Admin', 'admin@gmail.com', '9748578152', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `event_manager_id` int(5) NOT NULL,
  `vs_id` int(5) NOT NULL,
  `event_id` int(5) NOT NULL,
  `event_address` varchar(30) NOT NULL,
  `city_id` int(5) NOT NULL,
  `event_date` date NOT NULL,
  `advance_payment` int(5) DEFAULT 2500,
  `event_time` time NOT NULL,
  `payment_date` date DEFAULT curdate(),
  `payment_time` time DEFAULT curtime(),
  `actual_payment` int(5) DEFAULT NULL,
  `status` enum('pending','cancelled','approved') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `user_id`, `event_manager_id`, `vs_id`, `event_id`, `event_address`, `city_id`, `event_date`, `advance_payment`, `event_time`, `payment_date`, `payment_time`, `actual_payment`, `status`) VALUES
(12, 7, 3, 4, 4, 'ABC square, SG Highway', 1, '2025-05-30', 6750, '16:48:00', '2025-05-01', '13:46:25', 27000, 'approved'),
(13, 21, 3, 4, 4, 'Radhe farm house', 1, '2025-05-30', 13000, '20:00:00', '2025-05-01', '14:08:45', 52000, 'cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `bookingdetails`
--

CREATE TABLE `bookingdetails` (
  `booking_id` int(11) DEFAULT NULL,
  `vs_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookingdetails`
--

INSERT INTO `bookingdetails` (`booking_id`, `vs_id`) VALUES
(12, 4),
(12, 7),
(13, 4),
(13, 5),
(13, 10);

-- --------------------------------------------------------

--
-- Table structure for table `citymaster`
--

CREATE TABLE `citymaster` (
  `city_id` int(5) NOT NULL,
  `city_name` varchar(30) NOT NULL,
  `state_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `citymaster`
--

INSERT INTO `citymaster` (`city_id`, `city_name`, `state_id`) VALUES
(1, 'Ahmedabad', 7),
(2, 'Gandhinagar', 7),
(3, 'Junagadh', 7),
(4, 'Jamnagar', 7),
(5, 'Bhavnagar ', 7),
(6, 'Rajkot ', 7),
(7, 'Surat', 7),
(8, 'Vadodara', 7),
(9, '​Jaipur', 21),
(10, 'Jodhpur ', 21),
(11, 'Kota', 21),
(12, 'Ajmer', 21),
(13, 'Udaipur', 21),
(14, 'Bharatpur', 21),
(15, 'Bikaner', 21),
(16, 'Bangalore', 11),
(17, 'Chennai', 23),
(18, 'Mumbai', 14),
(19, 'Delhi', 33);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `event_id` int(5) NOT NULL,
  `event_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `event_name`) VALUES
(1, 'Wedding '),
(2, 'Ring Ceremony'),
(3, 'Reception'),
(4, ' Birthday Celebration'),
(5, 'Anniversary Celebration'),
(6, 'Corporate celebration'),
(7, 'Team-building events'),
(8, 'Annual meetings'),
(9, 'High school graduation'),
(10, 'College/University graduation'),
(11, 'Baby Showers'),
(12, 'Christmas Celebration'),
(13, 'New Year\'s Eve '),
(14, 'Family Reunions'),
(15, 'Community Events'),
(16, 'Workshops and Seminars'),
(17, 'Thanks Giving'),
(18, 'Farewell '),
(19, 'Charity Event'),
(20, 'Concert'),
(21, 'Government '),
(22, 'Halloween Celebration');

-- --------------------------------------------------------

--
-- Table structure for table `eventmanager`
--

CREATE TABLE `eventmanager` (
  `event_manager_id` int(5) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `city_id` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eventmanager`
--

INSERT INTO `eventmanager` (`event_manager_id`, `email`, `name`, `contact_number`, `password`, `city_id`) VALUES
(1, 'vrinda123@gmai.com', 'Vrinda Oza', '7874765836', 'vrinda@123', 2),
(2, 'bnsrimistri@gmail.com', 'Bansari Mistri', '8799078523', 'bnsri@205', 7),
(3, 'ashish@gmail.com', 'Ashishbhai Patel', '7684251366', 'ashish123', 1),
(4, 'rahul123@gmail.com', 'Rahul ', '5874698561', 'rahul123', 10),
(5, 'nehal@gmail.com', 'Nehal', '69457421583', 'nehal123', 9),
(6, 'mumbai@gmail.com', 'Krunal ', '8749561852', 'mumbai123', 18),
(8, 'em@gmail.com', 'New Eventmanager', '7489561596', 'em123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `image_id` int(5) NOT NULL,
  `image_path` varchar(100) NOT NULL,
  `caption` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`image_id`, `image_path`, `caption`) VALUES
(1, 'assets/images/1.jpg', 'Wedding'),
(2, 'assets/images/2.jpg', 'Firework'),
(3, 'assets/images/3.jpg', 'DJ'),
(4, 'assets/images/4.jpg', 'Photography & Videography'),
(5, 'assets/images/13.jfif', 'Haldi Decor'),
(6, 'assets/images/14.jfif', 'Haldi Decor'),
(7, 'assets/images/15.jfif', 'Mehendi Decor'),
(8, 'assets/images/16.jfif', 'Decoration'),
(9, 'assets/images/17.jfif', 'Marriage'),
(10, 'assets/images/18.jfif', 'Marriage'),
(11, 'assets/images/19.jfif', 'Decoration'),
(12, 'assets/images/20.jfif', 'Traditional Decor'),
(13, 'assets/images/25.jfif', 'Light Decor'),
(14, 'assets/images/26.jfif', 'Flower Decor'),
(15, 'assets/images/28.jfif', 'Venue'),
(16, 'assets/images/29.jfif', 'Venue Decor');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `review_text` varchar(255) NOT NULL,
  `rating` int(1) NOT NULL CHECK (`rating` between 1 and 5),
  `review_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `review_text`, `rating`, `review_date`) VALUES
(3, 7, 'Excellent', 5, '2025-05-01'),
(4, 21, 'Good Experience   :D', 4, '2025-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `service_id` int(5) NOT NULL,
  `service_name` varchar(30) NOT NULL,
  `amount` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `service_name`, `amount`) VALUES
(1, 'Catering', 15000),
(2, 'DJ ', 12000),
(3, 'Photography & Videography', 20000),
(4, 'Entertainment', 5000),
(5, 'Transport Services', 10000),
(6, 'Venue ', 10000),
(7, 'Decoration', 500);

-- --------------------------------------------------------

--
-- Table structure for table `statemaster`
--

CREATE TABLE `statemaster` (
  `state_id` int(5) NOT NULL,
  `state_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `statemaster`
--

INSERT INTO `statemaster` (`state_id`, `state_name`) VALUES
(1, 'Andhra Pradesh'),
(2, 'Arunachal Pradesh'),
(3, 'Assam'),
(4, 'Bihar'),
(5, 'Chhattisgarh'),
(6, 'Goa'),
(7, 'Gujarat'),
(8, 'Haryana'),
(9, 'Himachal Pradesh'),
(10, 'Jharkhand'),
(11, 'Karnataka'),
(12, 'Kerala'),
(13, 'Madhya Pradesh'),
(14, 'Maharashtra'),
(15, 'Manipur'),
(16, 'Meghalaya'),
(17, 'Mizoram'),
(18, 'Nagaland'),
(19, 'Odisha'),
(20, 'Punjab'),
(21, 'Rajasthan'),
(22, 'Sikkim'),
(23, 'Tamil Nadu'),
(24, 'Telangana'),
(25, 'Tripura'),
(26, 'Uttar Pradesh'),
(27, 'Uttarakhand'),
(28, 'West Bengal'),
(29, 'Andaman and Nicobar Islands'),
(30, 'Chandigarh'),
(31, 'Dadra and Nagar Haveli and Dam'),
(32, 'Lakshadweep'),
(33, 'Delhi'),
(34, 'Puducherry');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(15) NOT NULL,
  `contact_number` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `password`, `contact_number`) VALUES
(1, 'Raj Patel', 'raj.patel@gmail.com', 'raj123', '9876543210'),
(2, 'Aisha Khan', 'aisha.khan@yahoo.com', 'aisha123', '9123456780'),
(3, 'Rohit Sharma', 'rohit.sharma@gmail.com', 'rohit123', '8987654321'),
(4, 'Meera Desai', 'meera.desai@gmail.com', 'meera123', '9812345678'),
(5, 'Kunal Joshi', 'kunal.joshi@gmail.com', 'kunal123', '9898989898'),
(6, 'Sneha Rao', 'sneha.rao@hotmail.com', 'sneha123', '9000001122'),
(7, 'Vikram Mehta', 'vikram.mehta@rediffmail.com', 'vikram123', '9345678901'),
(8, 'Pooja Shah', 'pooja.shah@gmail.com', 'pooja123', '9876501234'),
(9, 'Ankit Trivedi', 'ankit.trivedi@outlook.com', 'ankit123', '9810198101'),
(10, 'Neha Kapoor', 'neha.kapoor@gmail.com', 'neha123', '9823456712'),
(11, 'Alok Verma', 'alok.verma@yahoo.com', 'alok123', '9797979797'),
(12, 'Simran Kaur', 'simran.kaur@gmail.com', 'simran123', '8989898989'),
(13, 'Farhan Ali', 'farhan.ali@gmail.com', 'farhan123', '9845098450'),
(14, 'Dhruv Bhatt', 'dhruv.bhatt@gmail.com', 'dhruv123', '9876712345'),
(15, 'Isha Modi', 'isha.modi@gmail.com', 'isha123', '9900112233'),
(16, 'Manav Desai', 'manav.desai@gmail.com', 'manav123', '9818811881'),
(17, 'Kritika Jain', 'kritika.jain@gmail.com', 'kritika123', '9933221122'),
(18, 'Ramesh Iyer', 'ramesh.iyer@gmail.com', 'ramesh123', '9777799999'),
(19, 'Divya Agarwal', 'divya.agarwal@gmail.com', 'divya123', '9898123456'),
(20, 'Aman Solanki', 'aman.solanki@gmail.com', 'aman123', '9009988776'),
(21, 'Suhani Patel', 'newuser@gmail.com', 'newuser123', '9684751659');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendor_id` int(5) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `shop_name` varchar(30) NOT NULL,
  `shop_address` varchar(30) NOT NULL,
  `shop_contact_number` varchar(15) NOT NULL,
  `city_id` int(5) NOT NULL,
  `service_id` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_id`, `email`, `password`, `name`, `shop_name`, `shop_address`, `shop_contact_number`, `city_id`, `service_id`) VALUES
(1, 'bangalore@gmail.com', 'bangalor123', 'Bangalore Catering Experts', 'Garden City Catering', 'Bangalore Catering Experts', '9857486215', 16, 1),
(2, 'chennai@gmail.com', 'chennai123', 'Chennai Gourmet Catering', 'South Spices catering', '14,Bazar', '9475841256', 17, 1),
(3, 'mumbai@gmail.com', 'mumbai123', 'Mumbai Catering Solutions', 'Taste of Mumbai Catering', '123, Marine Drive, 2nd floor', '6587498562', 18, 1),
(4, 'vibrant@gmail.com', 'vibrant123', 'DJ Dhruv Ahmedabad', 'Vibrant Beats', '5,Law Garden Road', '9978215967', 1, 2),
(5, 'moments@gmail.com', 'moments123', 'Moments Studio', 'Moments Studio Photography', '22,CG Road Navrangpura', '745841296', 1, 3),
(6, 'shutter@gmail.com', 'shutter123', 'Shutter Vibe ', 'Shutter Vibe Studios', '234,Andheri West', '9475812456', 18, 3),
(7, 'transport@gmail.com', 'transport123', 'Ahmedabad Event Transport', 'Vibrant Wheels', '50, SG Highway', '6475812459', 1, 5),
(9, 'entertainment@gmail.com', 'gandhinagar12', 'Gandhinagar Entertainment Club', 'The Royal entertainment', 'sector-21', '9678451658', 2, 4),
(10, 'Atithi@gmail.com', 'atithi123', 'Atithi Dining Hall', 'Gujarati Restaurant', 'opposite Shraddha Petrol Pump ', '7485961452', 1, 1),
(15, 'newvendor@gmail.com', 'new123', 'New Vendor', 'Shop Name', 'Vendor Address', '9754816259', 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `vendorservicedetails`
--

CREATE TABLE `vendorservicedetails` (
  `vs_id` int(5) NOT NULL,
  `vendor_id` int(5) NOT NULL,
  `service_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendorservicedetails`
--

INSERT INTO `vendorservicedetails` (`vs_id`, `vendor_id`, `service_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 2),
(5, 5, 3),
(6, 6, 3),
(7, 7, 5),
(9, 9, 4),
(10, 10, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `fk_event_manager_id` (`event_manager_id`),
  ADD KEY `fk_vs_id` (`vs_id`),
  ADD KEY `fk_event_id` (`event_id`),
  ADD KEY `fk_new_city_id` (`city_id`);

--
-- Indexes for table `bookingdetails`
--
ALTER TABLE `bookingdetails`
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `vs_id` (`vs_id`);

--
-- Indexes for table `citymaster`
--
ALTER TABLE `citymaster`
  ADD PRIMARY KEY (`city_id`),
  ADD KEY `fk_state_id` (`state_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `eventmanager`
--
ALTER TABLE `eventmanager`
  ADD PRIMARY KEY (`event_manager_id`),
  ADD KEY `fk_city_id` (`city_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `statemaster`
--
ALTER TABLE `statemaster`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendor_id`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `fk_service` (`service_id`);

--
-- Indexes for table `vendorservicedetails`
--
ALTER TABLE `vendorservicedetails`
  ADD PRIMARY KEY (`vs_id`),
  ADD KEY `fk_service_id` (`service_id`),
  ADD KEY `fk_vendor_id` (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `citymaster`
--
ALTER TABLE `citymaster`
  MODIFY `city_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `eventmanager`
--
ALTER TABLE `eventmanager`
  MODIFY `event_manager_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `image_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `statemaster`
--
ALTER TABLE `statemaster`
  MODIFY `state_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendor_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `vendorservicedetails`
--
ALTER TABLE `vendorservicedetails`
  MODIFY `vs_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_event_id` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_event_manager_id` FOREIGN KEY (`event_manager_id`) REFERENCES `eventmanager` (`event_manager_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_new_city_id` FOREIGN KEY (`city_id`) REFERENCES `citymaster` (`city_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_vs_id` FOREIGN KEY (`vs_id`) REFERENCES `vendorservicedetails` (`vs_id`) ON DELETE CASCADE;

--
-- Constraints for table `bookingdetails`
--
ALTER TABLE `bookingdetails`
  ADD CONSTRAINT `bookingdetails_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`booking_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookingdetails_ibfk_2` FOREIGN KEY (`vs_id`) REFERENCES `vendorservicedetails` (`vs_id`) ON DELETE CASCADE;

--
-- Constraints for table `citymaster`
--
ALTER TABLE `citymaster`
  ADD CONSTRAINT `citymaster_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `statemaster` (`state_id`),
  ADD CONSTRAINT `fk_state_id` FOREIGN KEY (`state_id`) REFERENCES `statemaster` (`state_id`) ON DELETE CASCADE;

--
-- Constraints for table `eventmanager`
--
ALTER TABLE `eventmanager`
  ADD CONSTRAINT `fk_city` FOREIGN KEY (`city_id`) REFERENCES `citymaster` (`city_id`),
  ADD CONSTRAINT `fk_city_id` FOREIGN KEY (`city_id`) REFERENCES `citymaster` (`city_id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `vendor`
--
ALTER TABLE `vendor`
  ADD CONSTRAINT `fk_service` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vendor_ibfk_2` FOREIGN KEY (`city_id`) REFERENCES `citymaster` (`city_id`);

--
-- Constraints for table `vendorservicedetails`
--
ALTER TABLE `vendorservicedetails`
  ADD CONSTRAINT `fk_service_id` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_vendor_id` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`vendor_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vendorservicedetails_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`vendor_id`),
  ADD CONSTRAINT `vendorservicedetails_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

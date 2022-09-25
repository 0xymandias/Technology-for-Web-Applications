

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bookNum` int(11) NOT NULL,
  `patientName` varchar(16) NOT NULL,
  `clinicID` int(11) NOT NULL,
  `bookDate` date NOT NULL,
  `bookTime` time NOT NULL,
  `bookService` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bookinglist`
--

CREATE TABLE `bookinglist` (
  `bookingID` int(11) NOT NULL,
  `clinicID` int(11) NOT NULL,
  `patientID` int(11) NOT NULL,
  `listDate` date NOT NULL,
  `listTime` time NOT NULL,
  `serviceType` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `clinic`
--

CREATE TABLE `clinic` (
  `clinicID` int(11) NOT NULL,
  `clinicName` varchar(32) NOT NULL,
  `clinicSuburb` varchar(32) NOT NULL,
  `clinicAddress` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clinic`
--

INSERT INTO `clinic` (`clinicID`, `clinicName`, `clinicSuburb`, `clinicAddress`) VALUES
(1, 'health first', 'Eastwood', '100 Center St, Eastwood'),
(2, 'health point', 'North Shore', '200 Beach Road, North Sydney'),
(3, 'Green clinic', 'Eastwood', '101 First Av, Eastwood'),
(4, 'Bright health care', 'Eastwood', '2 Second Av, Eastwood'),
(5, 'Quick recovery', 'North Shore', '3 Miller St, North Sydney'),
(6, 'Lightweight Nutrition', 'North Shore', '200 Spring Ln, North Sydney'),
(7, 'Fast recovery', 'Parramatta', '30 Church St, Parramatta'),
(8, 'Pain Ease', 'Campelltown', '119 Victoria Rd, Campelltown'),
(9, 'Relief Clinic', 'Penrith', '200 Green Ct, Penrith'),
(10, 'Shining smile', 'Sydney', '100 George St, Sydney'),
(11, 'Wonder ward', 'Sydney', '333 Central Sq, Sydney'),
(12, 'MediReco', 'Parramatta', '200 George St, Parramatta'),
(13, 'Pain Ease', 'Parramatta', '123 Ben Ct, Parramatta'),
(14, 'Green clinic', 'Chatswood', '23 Church St, Chatswood'),
(15, 'health point', 'Parramatta', '200 Hunter St, Parramatta');

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `patient` (
  `patientID` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patientship`
--

INSERT INTO `patient` (`patientID`, `username`, `password`) VALUES
(100, 'robin', '310e8f5151aa843b2033ec301af80edbe02ad82e010bcb166ea035432301f989'),
(111, 'helloworld', '9c5dbad45aea2f7bdba6d0fbd339106bf1edce770926dde56ba7ed01358f5bf6'),
(200, 'twaproject', '5443b96832b0154189c49ccdab040081590c488060b719f9f70508b39d3bc725'),
(300, 'deeJones', '81c16d337a1b73144ebf20b45661f2b02aa0b22e886a978d6b2ec929cdaaee9e'),
(400, 'mlexus', '1a93227f8fcb139feee4bf104021567f71901e41417e48d433fde543007a9ce1'),
(500, 'shamat', '50a3a88e966c37bb9852edbe37e3d2cc4357c0e9b5561df0bcc89e5c1a436599'),
(600, 'johnnychang', '4f4765a2761dee6d758bc27320e8d6af3756202758a91ede129dca3a614d5e48'),
(700, 'howardc', '11f713246157fb9e03e8f13ac19e31a51727a01da074c02069479f31355d935a'),
(800, 'dummy', 'cf1f5d7014987b26bd11176b98896729d5a18ddd7c75fb45b50ec6262d0e1001'),
(900, 'legalvice', '4f8ea3f9e983d398da884aa18da9c55be469fbb5b29fddf3fa373214c0cb94a2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bookNum`),
  ADD KEY `clinicID` (`clinicID`);

--
-- Indexes for table `bookinglist`
--
ALTER TABLE `bookinglist`
  ADD PRIMARY KEY (`bookingID`),
  ADD KEY `clinicID` (`clinicID`,`patientID`),
  ADD KEY `patientID` (`patientID`);

--
-- Indexes for table `clinic`
--
ALTER TABLE `clinic`
  ADD PRIMARY KEY (`clinicID`),
  ADD KEY `clinicID` (`clinicID`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patientID`),
  ADD KEY `patientID` (`patientID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `bookNum` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookinglist`
--
ALTER TABLE `bookinglist`
  MODIFY `bookingID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`clinicID`) REFERENCES `clinic` (`clinicID`);

--
-- Constraints for table `bookinglist`
--
ALTER TABLE `bookinglist`
  ADD CONSTRAINT `bookinglist_ibfk_1` FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`),
  ADD CONSTRAINT `bookinglist_ibfk_2` FOREIGN KEY (`clinicID`) REFERENCES `clinic` (`clinicID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2017 at 04:43 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `b_c`
--

CREATE TABLE `b_c` (
  `id` int(11) NOT NULL,
  `r_id` varchar(450) DEFAULT NULL,
  `cheque_no` varchar(450) DEFAULT NULL,
  `banker` varchar(450) DEFAULT NULL,
  `in_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `b_c`
--

INSERT INTO `b_c` (`id`, `r_id`, `cheque_no`, `banker`, `in_date`) VALUES
(1, '2', 'BANKIN', 'Alliance Bank', '2016-10-05 02:30:22'),
(2, '3', '0123456789', 'Affin Bank Berhad', '2016-11-18 08:18:47'),
(3, '5', 'BANKIN', 'HSBC Bank Malaysia Berhad', '2017-01-13 09:30:46'),
(4, '6', '65432erty7u8i9', 'Citibank Berhad', '2017-01-19 09:50:04');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `c_desc` varchar(450) DEFAULT NULL,
  `c_amount` varchar(450) DEFAULT NULL,
  `c_tuition_fee` varchar(450) DEFAULT NULL,
  `c_ptpk` varchar(450) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `c_desc`, `c_amount`, `c_tuition_fee`, `c_ptpk`) VALUES
(2, 'Tuition Fee', '99', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `family`
--

CREATE TABLE `family` (
  `f_id` int(11) NOT NULL,
  `s_id` varchar(450) NOT NULL,
  `relationship` varchar(450) NOT NULL,
  `Name` varchar(450) NOT NULL,
  `Age` varchar(450) NOT NULL,
  `Occupation` varchar(450) NOT NULL,
  `Qualification` varchar(450) NOT NULL,
  `Mobile_No` varchar(450) NOT NULL,
  `status` varchar(450) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `family`
--

INSERT INTO `family` (`f_id`, `s_id`, `relationship`, `Name`, `Age`, `Occupation`, `Qualification`, `Mobile_No`, `status`) VALUES
(1, '2', 'Brother', 'hi', 'hi', 'hi', 'hi', 'hi', 'ACTIVE'),
(2, '1', 'Father', '', '', '33', '', '', 'DELETE'),
(3, '2', 'Sister', 'ah baba', 'ah baba', 'ah baba', 'ah baba', 'ah baba', 'ACTIVE'),
(4, '1', 'Brother', 'Hydra', '34', '11', 'Hydra', '019-333893', 'ACTIVE'),
(5, '6', 'Mother', 'cuter', '89', 'worker', 'AD', '019-2333333', 'ACTIVE'),
(6, '6', 'Sister', 'a', 'a', 'a', 'a', 'a', 'ACTIVE'),
(7, '6', 'Mother', 'shaqiri', '18', 'housemaid', 'A', '23451', 'DELETE');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `l_username` varchar(450) DEFAULT NULL,
  `l_password` varchar(450) DEFAULT NULL,
  `level` varchar(450) DEFAULT NULL,
  `l_name` varchar(450) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `l_username`, `l_password`, `level`, `l_name`) VALUES
(1, 'admin', 'admin', 'admin', 'Wei');

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `id` int(11) NOT NULL,
  `r_no` varchar(450) DEFAULT NULL,
  `r_date` date DEFAULT NULL,
  `s_name` varchar(450) DEFAULT NULL,
  `s_ic` varchar(450) DEFAULT NULL,
  `pay_mtd` varchar(450) DEFAULT NULL,
  `tuition_fee` varchar(450) DEFAULT NULL,
  `ptpk` varchar(450) DEFAULT NULL,
  `r_status` varchar(450) DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `createby` varchar(450) DEFAULT NULL,
  `updatedate` datetime DEFAULT NULL,
  `updateby` varchar(450) DEFAULT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `receipt`
--

INSERT INTO `receipt` (`id`, `r_no`, `r_date`, `s_name`, `s_ic`, `pay_mtd`, `tuition_fee`, `ptpk`, `r_status`, `createdate`, `createby`, `updatedate`, `updateby`, `description`) VALUES
(1, '10001', '0000-00-00', '', '', 'cash', 'NO', 'NO', 'ACTIVE', '2017-02-14 08:54:15', '1', NULL, NULL, 'Tuition Fee'),
(2, '10002', '0000-00-00', '', '', 'cash', 'NO', 'NO', 'ACTIVE', '2017-02-14 08:57:21', '1', NULL, NULL, 'Tuition Fee'),
(3, '10003', '2017-02-15', 'Kings', '90345093999', 'cash', 'YES', 'YES', 'ACTIVE', '2017-02-15 08:26:17', '1', NULL, NULL, 'Tuition Fee'),
(4, '10004', '2017-02-16', 'Cheung Kee Ting', '90345093942', 'cash', 'YES', 'YES', 'ACTIVE', '2017-02-15 08:28:29', '1', NULL, NULL, 'Tuition Fee'),
(5, '10005', '0000-00-00', '', '', 'cash', 'NO', 'NO', 'ACTIVE', '2017-02-15 16:50:42', '1', NULL, NULL, 'Tuition Fee'),
(6, '10006', '0000-00-00', '', '', 'cash', 'NO', 'NO', 'ACTIVE', '2017-02-15 16:51:12', '1', NULL, NULL, 'Tuition Fee'),
(7, '10007', '2017-02-16', 'Ong Eng Wei', '950724075323', 'cash', 'NO', 'NO', 'ACTIVE', '2017-02-16 08:41:05', '1', NULL, NULL, 'JPK'),
(8, '10008', '2017-02-16', 'Ong Eng Wei', '950724075323', 'cash', 'NO', 'NO', 'ACTIVE', '2017-02-16 08:41:23', '1', NULL, NULL, 'JPK'),
(9, '10009', '2017-02-15', 'Ong Eng Wei', '950724075323', 'cash', 'NO', 'NO', 'ACTIVE', '2017-02-16 08:42:24', '1', NULL, NULL, 'Tuition Fee'),
(10, '10010', '0000-00-00', '', '', 'cash', 'NO', 'NO', 'ACTIVE', '2017-02-16 08:44:58', '1', NULL, NULL, 'Tuition Fee'),
(11, '10011', '2017-02-16', 'Ong Eng Wei', '950724075323', 'cash', 'NO', 'NO', 'ACTIVE', '2017-02-16 08:45:30', '1', NULL, NULL, 'Tuition Fee'),
(12, '10012', '0000-00-00', '', '', 'cash', 'NO', 'NO', 'ACTIVE', '2017-03-03 16:19:52', '1', NULL, NULL, 'Tuition Fee');

-- --------------------------------------------------------

--
-- Table structure for table `receipt_detail`
--

CREATE TABLE `receipt_detail` (
  `id` int(11) NOT NULL,
  `r_id` varchar(450) DEFAULT NULL,
  `rp_desc` varchar(450) DEFAULT NULL,
  `rp_amount` varchar(450) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `receipt_detail`
--

INSERT INTO `receipt_detail` (`id`, `r_id`, `rp_desc`, `rp_amount`) VALUES
(1, '1', 'Tuition Fee (September)', '750'),
(2, '2', 'test', '100'),
(3, '1', 'test', '300.99'),
(4, '3', 'test', '100'),
(5, '3', 'test1', '99'),
(6, '3', 'test1', '99'),
(7, '3', 'test1', '99'),
(8, '3', 'test1', '99'),
(9, '3', 'test1', '99'),
(10, '3', 'test1', '99'),
(11, '3', 'test1', '99'),
(12, '3', 'test1', '99'),
(13, '3', 'test1', '99'),
(14, '3', 'test1', '99'),
(15, '3', 'test1', '99'),
(16, '3', 'test1', '99'),
(17, '3', 'test1', '99'),
(18, '3', 'test1', '99'),
(19, '3', 'test1', '99'),
(20, '3', 'test1', '99'),
(21, '3', 'test1', '99'),
(22, '3', 'test1', '99'),
(23, '3', 'test1', '99'),
(24, '3', 'test1', '99'),
(25, '4', 'hhh', '66'),
(26, '5', 'hostel fee', '200'),
(27, '6', 'hostel fee', '500.80'),
(28, '7', 'Exam Fee', '123'),
(29, '7', 'Insurance', '11'),
(30, '8', 'Tuition Fee', '500.80'),
(31, '27', 'Enrollment Fee', '21'),
(32, '27', 'Exam Fee', '500.80'),
(33, '27', 'Exam Fee', '90'),
(34, '7', 'Insurance', '21'),
(35, '7', 'Security Deposit', '11'),
(36, '7', 'Insurance', '33'),
(37, '3', 'Exam Fee', '32'),
(38, '3', 'JPK', '45'),
(39, '9', 'Tuition Fee', '34'),
(40, '10', 'Hostel Fee', '500.80'),
(41, '1', 'Tuition Fee', '21');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `id` int(255) NOT NULL,
  `s_id` varchar(255) NOT NULL,
  `syllabus` varchar(255) NOT NULL,
  `result` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`id`, `s_id`, `syllabus`, `result`) VALUES
(3, '2', 'BI', 'B'),
(4, '2', 'BIO', 'C'),
(5, '2', 'BAHASA MELAYU', 'A'),
(6, '2', 'PENDIDIKAN MORAL/MORAL EDUCATION', 'B'),
(7, '<br /><b>Notice</b>:  Undefined index: id in <b>C:xampphtdocsstudent_registrationqualification.php</b> on line <b>117</b><br />', 'PENDIDIKAN MORAL/MORAL EDUCATION', 'A'),
(8, '2', 'EKONOMI ASAS/BASIC ECONOMICS', 'B-'),
(9, '6', 'BIOLOGY', 'A'),
(10, '6', 'PENDIDIKAN ISLAM/ISLAMIC STUDIES', 'B'),
(11, '6', 'MATEMATIK', 'E');

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `id` int(255) NOT NULL,
  `s_id` varchar(255) NOT NULL,
  `name_school` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `status` varchar(455) NOT NULL,
  `former` varchar(450) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`id`, `s_id`, `name_school`, `location`, `qualification`, `year`, `status`, `former`) VALUES
(1, '2', 'perai', '10,perai,butterworth,pulau pinang', '22', '2019', 'ACTIVE', ''),
(2, '2', 'perai', '10,perai,butterworth,pulau pinang', '22', '2019', 'DELETE', ''),
(3, '2', 'r', 'r', 'r', 'r', 'DELETE', ''),
(4, '2', 'vivi', 'lol', 'rty', '1234', 'DELETE', ''),
(10, '6', 'sc', 'sc', 'sc', 'sc', 'DELETE', ''),
(11, '6', 'sc', 'sc', 'sc', 'sc', 'DELETE', ''),
(12, '6', 'sc', 'sc', 'sc', 'sc', 'DELETE', ''),
(13, '6', 'sc', 'sc', 'sc', 'sc', 'DELETE', ''),
(14, '6', 'aaa', 'aaa', 'aaa', 'aaa', 'DELETE', ''),
(15, '6', 'aaa', 'aaa', 'aaa', 'aaa', 'DELETE', ''),
(16, '6', 'as', 'sss', 'ss', 'ss', 'DELETE', ''),
(17, '6', 's', 's', 'a', '123', 'DELETE', ''),
(18, '17', 'aaaa', 'asd', 's', 's', 'ACTIVE', ''),
(19, '17', 's', 'a', 'asd', 'a', 'DELETE', ''),
(20, '6', 'as', 'asd', 'asd', 'a', 'DELETE', ''),
(21, '6', 'sc', 'a', 'a', '123', 'DELETE', ''),
(22, '6', 'shaqiri', 'Butterworth', 'asd', '098', 'ACTIVE', 'COLLEGE'),
(23, '6', 'St.Mark', 'mak mandin', 'A', '2012', 'ACTIVE', 'SECONDARY'),
(24, '6', '1', '2', '3', '4', 'DELETE', 'SECONDARY SCHOOL'),
(25, '6', '1', '2', '3', '4', 'DELETE', 'COLLEGE'),
(26, '6', '', 'Butterworth', 'A', '2123', 'DELETE', 'OTHERS'),
(27, '6', '', 'Butterworth', 'A', '2123', 'DELETE', 'COLLEGE'),
(28, '6', 'cyka', 'Butterworth', 'A', '11111', 'ACTIVE', 'SECONDARY'),
(29, '28', 'as', 'asd', 'a', '2123', 'ACTIVE', 'SECONDARY SCHOOL');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `s_id` varchar(450) DEFAULT NULL,
  `s_name` varchar(450) DEFAULT NULL,
  `s_email` varchar(450) DEFAULT NULL,
  `ic` varchar(450) DEFAULT NULL,
  `nationality` varchar(450) DEFAULT NULL,
  `race` varchar(450) DEFAULT NULL,
  `r_address` varchar(450) DEFAULT NULL,
  `r_postcode` varchar(450) DEFAULT NULL,
  `r_state` varchar(450) DEFAULT NULL,
  `c_address` varchar(450) DEFAULT NULL,
  `c_postcode` varchar(450) DEFAULT NULL,
  `c_state` varchar(450) DEFAULT NULL,
  `chinese_name` varchar(450) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `h_contact` varchar(450) DEFAULT NULL,
  `hp_contact` varchar(450) DEFAULT NULL,
  `guardian` varchar(450) DEFAULT NULL,
  `school` varchar(450) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `age` varchar(450) DEFAULT NULL,
  `gender` varchar(450) DEFAULT NULL,
  `m_status` varchar(450) DEFAULT NULL,
  `religion` varchar(450) DEFAULT NULL,
  `s_desc` varchar(450) DEFAULT NULL,
  `tuition_fee` varchar(450) DEFAULT NULL,
  `p_method` varchar(450) DEFAULT NULL,
  `cost_per_month` varchar(450) DEFAULT NULL,
  `p_month` varchar(450) DEFAULT NULL,
  `date_join` date DEFAULT NULL,
  `course` varchar(450) DEFAULT NULL,
  `photo` varchar(450) DEFAULT NULL,
  `s_status` varchar(450) DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `createby` varchar(450) DEFAULT NULL,
  `updatedate` datetime DEFAULT NULL,
  `updateby` varchar(450) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `s_id`, `s_name`, `s_email`, `ic`, `nationality`, `race`, `r_address`, `r_postcode`, `r_state`, `c_address`, `c_postcode`, `c_state`, `chinese_name`, `h_contact`, `hp_contact`, `guardian`, `school`, `birthday`, `age`, `gender`, `m_status`, `religion`, `s_desc`, `tuition_fee`, `p_method`, `cost_per_month`, `p_month`, `date_join`, `course`, `photo`, `s_status`, `createdate`, `createby`, `updatedate`, `updateby`) VALUES
(1, 'B.PRO 5323', 'Ong Eng Wei', 'test@gmail.com', '950724075323', 'Malaysia1', 'Chinese', '21 Lorong Jaya 2, Taman Impian Jaya', '14000', 'Penang', '-', '-', '-', '王永伟', '-', '-', '-', '-', '2016-10-11', '21', 'Male', 'Single', 'Buddhism', 'NONE', '22500', 'cash', '750', '30', '2016-10-11', 'Programming', 'img/P20161011083642.jpg', 'ACTIVE', NULL, NULL, NULL, NULL),
(2, 'B.PRO 5444', 'Cheung Kee Ting', 'w@gmail.com', '90345093942', 'Indonesia', 'Indian', '29, Resident Kila, Taman Jaya', '3465', 'Sabah', '45 Lorong Tangka,Taman Darulsalam Jaya', 'a', 'Perlis', '代永', 'w', 'w', 'w', 'w', '1899-12-06', '1', 'Female', 'Married', 'Daoism', '2wedsd', '23', 'ptpk', '2', '1', '2016-12-16', 'Multimedia', 'img/P20161213092345.jpg', 'ACTIVE', NULL, NULL, NULL, NULL),
(6, 'B.Pro 4567 ', 'Kings', 'gvta0207@yahoo.com.my', '90345093999', 'Malaysia', 'Chinese', 'pulau tikus', '12443', 'Pahang', '10,lorong ampian 2, taman cenderong ', '13900', 'Negeri Sembilan', '文方', '0129-33932222', '019-38477890', 'w', 'w', '2016-12-09', '19', 'Female', 'Married', 'Christianity', '2wedsd', '23422', 'ptpk', '888', '345', '2016-12-17', 'IT Networking', 'img/P20161215162556.jpg', 'ACTIVE', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `b_c`
--
ALTER TABLE `b_c`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `family`
--
ALTER TABLE `family`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipt_detail`
--
ALTER TABLE `receipt_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `b_c`
--
ALTER TABLE `b_c`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `family`
--
ALTER TABLE `family`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `receipt_detail`
--
ALTER TABLE `receipt_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

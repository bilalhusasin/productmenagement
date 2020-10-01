-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2019 at 05:54 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_with_content`
--

-- --------------------------------------------------------

--
-- Table structure for table `teachers_info`
--

CREATE TABLE `teachers_info` (
  `id` int(11) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `farther_name` varchar(150) NOT NULL,
  `mother_name` varchar(150) NOT NULL,
  `birth_date` varchar(150) NOT NULL,
  `sex` varchar(30) NOT NULL,
  `married` varchar(255) NOT NULL,
  `divorced` varchar(255) NOT NULL,
  `widow_widower` varchar(255) NOT NULL,
  `spouse_name` varchar(255) NOT NULL,
  `spouse_qualification` varchar(255) NOT NULL,
  `spouse_profession` varchar(255) NOT NULL,
  `number_of_children` varchar(255) NOT NULL,
  `elder_child_age` varchar(255) NOT NULL,
  `young_child_age` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `religion` varchar(255) NOT NULL,
  `sect` varchar(255) NOT NULL,
  `place_of_birth` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `present_address` varchar(300) NOT NULL,
  `permanent_address` varchar(300) NOT NULL,
  `work_place` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `subject_teach` varchar(150) NOT NULL,
  `classes_teach` varchar(255) NOT NULL,
  `position_applied_for` varchar(150) NOT NULL,
  `working_hour` varchar(50) NOT NULL,
  `applied_before` varchar(255) NOT NULL,
  `educational_qualification_1` varchar(500) NOT NULL,
  `educational_qualification_2` varchar(500) NOT NULL,
  `educational_qualification_3` varchar(500) NOT NULL,
  `educational_qualification_4` varchar(500) NOT NULL,
  `educational_qualification_5` varchar(500) NOT NULL,
  `extra_activity` varchar(255) NOT NULL,
  `teacher_qualification_1` varchar(255) NOT NULL,
  `teacher_qualification_2` varchar(255) NOT NULL,
  `teacher_qualification_3` varchar(255) NOT NULL,
  `msword` varchar(255) NOT NULL,
  `msexcel` varchar(255) NOT NULL,
  `power_point` varchar(255) NOT NULL,
  `internet` varchar(255) NOT NULL,
  `course_1` varchar(255) NOT NULL,
  `course_2` varchar(255) NOT NULL,
  `course_3` varchar(255) NOT NULL,
  `institute_served_1` varchar(255) NOT NULL,
  `institute_served_2` varchar(255) NOT NULL,
  `institute_served_3` varchar(255) NOT NULL,
  `activity_1` varchar(255) NOT NULL,
  `activity_2` varchar(255) NOT NULL,
  `activity_3` varchar(255) NOT NULL,
  `administrative_service_1` varchar(255) NOT NULL,
  `administrative_service_2` varchar(255) NOT NULL,
  `administrative_service_3` varchar(255) NOT NULL,
  `organization_name_1` varchar(255) NOT NULL,
  `organization_name_2` varchar(255) NOT NULL,
  `organization_name_3` varchar(255) NOT NULL,
  `recommendation` varchar(255) NOT NULL,
  `teachers_degree` varchar(255) NOT NULL,
  `teachers_cnic` varchar(255) NOT NULL,
  `teachers_eoib` varchar(255) NOT NULL,
  `teachers_photo` varchar(200) NOT NULL,
  `cv` varchar(30) NOT NULL,
  `educational_certificat` varchar(30) NOT NULL,
  `exprieance_certificatte` varchar(30) NOT NULL,
  `files_info` varchar(500) NOT NULL,
  `index_no` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers_info`
--

INSERT INTO `teachers_info` (`id`, `user_id`, `fullname`, `farther_name`, `mother_name`, `birth_date`, `sex`, `married`, `divorced`, `widow_widower`, `spouse_name`, `spouse_qualification`, `spouse_profession`, `number_of_children`, `elder_child_age`, `young_child_age`, `nationality`, `religion`, `sect`, `place_of_birth`, `country`, `present_address`, `permanent_address`, `work_place`, `phone`, `subject_teach`, `classes_teach`, `position_applied_for`, `working_hour`, `applied_before`, `educational_qualification_1`, `educational_qualification_2`, `educational_qualification_3`, `educational_qualification_4`, `educational_qualification_5`, `extra_activity`, `teacher_qualification_1`, `teacher_qualification_2`, `teacher_qualification_3`, `msword`, `msexcel`, `power_point`, `internet`, `course_1`, `course_2`, `course_3`, `institute_served_1`, `institute_served_2`, `institute_served_3`, `activity_1`, `activity_2`, `activity_3`, `administrative_service_1`, `administrative_service_2`, `administrative_service_3`, `organization_name_1`, `organization_name_2`, `organization_name_3`, `recommendation`, `teachers_degree`, `teachers_cnic`, `teachers_eoib`, `teachers_photo`, `cv`, `educational_certificat`, `exprieance_certificatte`, `files_info`, `index_no`) VALUES
(1, '8', 'Willie B. Quint', 'Kevin A. Robledo', 'Mary T. McQuay', '12/05/1956', 'Male', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '3133 Pointe Lane\\r\\nHollywood, FL 33020', '3133 Pointe Lane\\r\\nHollywood, FL 33020', '', '+8801245852315', 'English', '', 'Assistant Headmaster', 'Full time', '', 'SSC,Test School,A+,1978', 'HSC,Test College,A+,1980', 'Graduation ( Test ),Test University,A,1984', 'Masters Degree,Test University,A,1986', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'ac197cff181d9c58027800912c3e0855.png', 'submited', 'submited', 'submited', 'Teacher 2016', '12004'),
(2, '9', 'Fredrick V. Keyes', 'Anthony T. Andrews', 'Mary J. Dahl', '20/12/1970', 'Male', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '712 Beechwood Drive\\r\\nChurchville, MD 21028 ', '712 Beechwood Drive\\r\\nChurchville, MD 21028 ', '', '+8801245852315', 'Mathematics', '', 'Senior Teacher', 'Full time', '', 'SSC,Test School,A+,1988', 'HSC,Test College,A,1990', 'Graduation ( Test ),Test University,A,1994', 'Masters Degree,Test University,A,1996', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0f8649af98ca9c0e85957db7e9778191.png', 'submited', 'submited', 'submited', 'Teacher 2016', '12006'),
(3, '10', 'mumar abboud', 'Hadi Shakir Essa', 'Yamha Dhakiyah Mikhail', '11/11/1980', 'Male', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '71 City Walls Rd\\\\\\\\r\\\\\\\\nCLOCK FACE\\\\\\\\r\\\\\\\\nWA9 6BG', '71 City Walls Rd\\\\\\\\r\\\\\\\\nCLOCK FACE\\\\\\\\r\\\\\\\\nWA9 6BG', '', '+8801245852315', 'Bangla ', '', 'Teacher', 'Full time', '', 'SSC,Test School,A+,1998', 'HSC,Test College,A,2000', 'Graduation ( Test ),Test University,A,2004', 'Masters Degree,Test University,B,2006', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '3566d34fc7ce565ba8841d0eaf537b28.png', 'submited', 'submited', 'submited', 'Teacher 2016', '12051'),
(4, '11', 'Inayah Asfour', 'Fatin Husayn', 'Rukan Habeeba', '12/12/1980', 'Female', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '31 Clasper Way\\r\\nHEST BANK\\r\\nLA2 2HF ', '31 Clasper Way\\r\\nHEST BANK\\r\\nLA2 2HF ', '', '+8801245852315', 'Science', '', 'Teacher', 'Full time', '', 'SSC,Test School,A+,1998', 'HSC,Test College,A+,2000', 'Graduation ( Test ),Test University,A,2004', 'Masters Degree,Test University,A,2006', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'f342f5b3412a5c4be681878ff0462e09.png', 'submited', 'submited', 'submited', 'Teacher 2016', '12056'),
(5, '68', 'bilal hussain', 'Muhammad Saeed', 'ammi g', '01/01/2019', 'Male', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'swl', 'swl', '', '+9230048341598', 'english', '', 'Teacher', 'Full time', '', 'bscs,bzu,pass,2018', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '3d6615302bb7cd022e53abf24c6904e5.jpg', 'submited', 'submited', 'submited', 'yes', '111'),
(6, '70', 'Mani', 'khalid', '', '12/17/2019', 'Male', 'no', 'no', 'no', 'non', 'no', 'no', 'no', 'no', 'no', 'Pakistan', 'islam', 'Suni', 'Lahore', 'Pakistan', 'modeltown', 'modeltown', 'bftech', '923016447399', 'Math,Phy Comp', 'all', 'Teacher', 'Full time', 'No', 'ssc,govt,math,1st,12/24/2019,R', '', '', '', '', 'none', 'm.ed,12/10/2019,none,open uni,1st', '', '', 'msword', 'msexcel', 'power\\_point', 'internet', 'none,12/10/2019,12/24/2019,none', '', '', 'adfdsf,12/02/2019,12/09/2019,all,all', '', '', 'none', 'none', 'none', 'none,12/02/2019,12/02/2019,none', '', '', 'none,none,none', '', '', 'jkhaisdfowjefoijsdf', 'd3e67316836c3d7a8a44cbe43c7880e1.jpg', 'd3e67316836c3d7a8a44cbe43c7880e1.jpg', 'd3e67316836c3d7a8a44cbe43c7880e1.jpg', 'd3e67316836c3d7a8a44cbe43c7880e1.jpg', 'submited', 'submited', 'submited', 'teacher 020', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `teachers_info`
--
ALTER TABLE `teachers_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `teachers_info`
--
ALTER TABLE `teachers_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

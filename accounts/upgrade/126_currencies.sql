-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 29, 2016 at 01:12 PM
-- Server version: 5.7.12-0ubuntu1.1
-- PHP Version: 5.6.23-1+deb.sury.org~xenial+2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cc_pos_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `shortname` varchar(20) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `symbol` varchar(10) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `shortname`, `fullname`, `symbol`, `status`, `created_at`, `created_by`, `modified_at`, `modified_by`) VALUES
(1, 'USD', 'United States', '$', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(2, 'EUR', 'Euro', '€', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(3, 'GBP', 'United Kingdom', '£', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(4, 'AUD', 'Australia', '$', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(5, 'CNY', 'China', '¥', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(6, 'DKK', 'Denmark', 'kr', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(7, 'HKD', 'Hong Kong', '$', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(8, 'INR', 'India', '₹', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(9, 'JPY', 'Japan', '¥', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(10, 'KRW', 'South Korea', '₩', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(11, 'NZD', 'New Zealand', '$', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(12, 'NOK', 'Norway', 'kr', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(13, 'RUB', 'Russia', 'руб', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(14, 'SGD', 'Singapore', '$', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(15, 'ZAR', 'South Africa', 'S', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(16, 'SEK', 'Sweden', 'kr', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(17, 'CHF', 'Switzerland', 'CHF', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(18, 'TWD', 'Taiwan', 'NT$', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(19, 'THB', 'Thailand', '฿', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(20, 'TRL', 'Turkey', '₤', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(21, 'BRL', 'Brazil', 'R$', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(22, 'ALL', 'Albania', 'Lek', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(24, 'ARS', 'Argentina', '$', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(25, 'AWG', 'Aruba', 'ƒ', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(26, 'AZN', 'Azerbaijan', 'ман', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(27, 'BSD', 'Bahamas', '$', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(28, 'BBD', 'Barbados', '$', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(29, 'BYR', 'Belarus', 'p.', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(30, 'BZD', 'Belize', 'BZ$', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(31, 'BMD', 'Bermuda', '$', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(32, 'BOB', 'Bolivia', '$b', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(33, 'BAM', 'Bosnia and Herzegovina', 'KM', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(34, 'BWP', 'Botswana', 'P', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(35, 'BGN', 'Bulgaria', 'лв', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(36, 'BND', 'Brunei', '$', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(37, 'KHR', 'Cambodia', '៛', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(38, 'CAD', 'Canada', '$', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(39, 'KYD', 'Cayman', '$', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(40, 'CLP', 'Chile', '$', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(41, 'COP', 'Colombia', '$', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(42, 'CRC', 'Costa Rica', '₡', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(43, 'HRK', 'Croatia', 'kn', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(44, 'CUP', 'Cuba', '₱', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(45, 'CZK', 'Czech Republic', 'Kč', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(46, 'DOP', 'Dominican Republic', 'RD$', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(47, 'XCD', 'East Caribbean', '$', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(48, 'EGP', 'Egypt', '£', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(49, 'SVC', 'El Salvador', '$', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(50, 'EEK', 'Estonia', 'kr', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(51, 'FKP', 'Falkland Islands', '£', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(52, 'FJD', 'Fiji', '$', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(53, 'GHC', 'Ghana', '¢', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(54, 'GIP', 'Gibraltar', '£', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(55, 'GTQ', 'Guatemala', 'Q', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(56, 'GGP', 'Guernsey', '£', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(57, 'GYD', 'Guyana', '$', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(58, 'HNL', 'Honduras', 'L', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(59, 'HUF', 'Hungary', 'Ft', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(60, 'ISK', 'Iceland', 'kr', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(61, 'IDR', 'Indonesia', 'Rp', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(62, 'IRR', 'Iran', '﷼', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(63, 'IMP', 'Isle Of Man', '£', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(64, 'ILS', 'Israel', '₪', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(65, 'JMD', 'Jamaica', '$', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(66, 'JEP', 'Jersey', '£', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(67, 'KZT', 'Kazakhstan', 'лв', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(68, 'KPW', 'North Korea', '₩', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(69, 'KGS', 'Kyrgyzstan', 'лв', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(70, 'LAK', 'Laos', '₭', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(71, 'LVL', 'Latvia', 'Ls', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(72, 'LBP', 'Lebanon', '£', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(73, 'LRD', 'Liberia', '$', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(74, 'LTL', 'Lithuania', 'Lt', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(75, 'MKD', 'Macedonia', 'ден', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(76, 'MYR', 'Malaysia', 'RM', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(77, 'MUR', 'Mauritius', 'Rs', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(78, 'MXN', 'Mexico', '$', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(79, 'MNT', 'Mongolia', '₮', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(80, 'MZN', 'Mozambique', 'MT', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(81, 'NAD', 'Namibia', '$', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(82, 'NPR', 'Nepal', '₨', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(83, 'ANG', 'Netherlands', 'ƒ', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(84, 'NIO', 'Nicaragua', 'C$', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(85, 'NGN', 'Nigeria', '₦', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(86, 'OMR', 'Oman', '﷼', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(87, 'PKR', 'Pakistan', '₨', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(88, 'PAB', 'Panama', 'B/.', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(89, 'PYG', 'Paraguay', 'Gs', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(90, 'PEN', 'Peru', 'S/.', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(91, 'PHP', 'Philippines', '₱', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(92, 'PLN', 'Poland', 'zł', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(93, 'QAR', 'Qatar', '﷼', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(94, 'RON', 'Romania', 'lei', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(95, 'SHP', 'Saint Helena', '£', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(96, 'SAR', 'Saudi Arabia', '﷼', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(97, 'RSD', 'Serbia', 'Дин.', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(98, 'SCR', 'Seychelles', '₨', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(99, 'SBD', 'Solomon Islands', '$', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(100, 'SOS', 'Somalia', 'S', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(101, 'LKR', 'Sri Lanka', '₨', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(102, 'SRD', 'Suriname', '$', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(103, 'SYP', 'Syria', '£', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(104, 'TTD', 'Trinidad and Tobago', 'TT$', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(105, 'TVD', 'Tuvalu', '$', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(106, 'UAH', 'Ukraine', '₴', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(107, 'UYU', 'Uruguay', '$U', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(108, 'UZS', 'Uzbekistan', 'лв', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(109, 'VEF', 'Venezuela', 'Bs', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(110, 'VND', 'Vietnam', '₫', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(111, 'YER', 'Yemen', '﷼', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(112, 'ZWD', 'Zimbabwe', 'Z$', 'Active', '0000-00-00 00:00:00', 0, NULL, NULL),
(113, 'BDT', 'Bangladesh', '৳', 'Active', '2016-06-01 18:01:29', 6, '2016-06-01 18:05:57', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `currency_shortname` (`shortname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

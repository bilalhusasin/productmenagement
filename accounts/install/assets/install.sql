-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 16, 2018 at 08:10 AM
-- Server version: 5.7.24-0ubuntu0.18.04.1
-- PHP Version: 7.0.32-4+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dp_pos_ci`
--

-- --------------------------------------------------------

--
-- Table structure for table `ac_charts`
--

CREATE TABLE `ac_charts` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `code` varchar(25) NOT NULL,
  `name` text NOT NULL,
  `memo` text,
  `opening` double DEFAULT NULL,
  `edate` date DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `link_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ac_charts`
--

INSERT INTO `ac_charts` (`id`, `company_id`, `parent_id`, `code`, `name`, `memo`, `opening`, `edate`, `status`, `link_id`, `created_at`, `created_by`, `modified_at`, `modified_by`) VALUES
(1, 1, 0, '10', 'Assets', 'Assets', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(2, 1, 0, '20', 'Liabilities', 'Liabilities', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(3, 1, 0, '30', 'Equity', 'Equity', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(4, 1, 0, '40', 'Income', 'Income', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(5, 1, 0, '50', 'Expense', 'Expense', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(6, 1, 0, '60', 'Cost of Goods or Services Sold', 'Cost of Goods or Services Sold', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(7, 1, 1, '10.10', 'Current Assets', 'Current Assets', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(8, 1, 1, '10.20', 'None Current Assets', 'None Current Assets', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(9, 1, 2, '20.10', 'Current Liabilities', 'Current Liabilities', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(10, 1, 2, '20.20', 'None Current Liabilities', 'None Current Liabilities', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(11, 1, 3, '30.10', 'Partners\' or Owners\' Capital', 'Partners\' or Owners\' Capital', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(12, 1, 3, '30.20', 'Stockholders\' Capital', 'Stockholders\' Capital', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(13, 1, 3, '30.30', 'Retained Earnings & Other Income', 'Retained Earnings & Other Income', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(14, 1, 4, '40.10', 'Sales or Service Revenues', 'Sales or Service Revenues', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(15, 1, 5, '50.10', 'Operating Expenses', 'Operating Expenses', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(16, 1, 5, '50.20', 'Other Expenses', 'Other Expenses', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(17, 1, 5, '50.30', 'Purchase', '', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(18, 1, 7, '10.10.10', 'Cash and Cash Equivalent', 'Cash and Cash Equivalent', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(19, 1, 7, '10.10.20', 'Receivables', 'Receivables', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(20, 1, 7, '10.10.30', 'Inventories', 'Inventories', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(21, 1, 7, '10.10.40', 'Prepaid Expenses and Deposits', 'Prepaid Expenses and Deposits', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(22, 1, 8, '10.20.10', 'Long-Term Investments', 'Long-Term Investments', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(23, 1, 8, '10.20.20', 'Properties , Plant and Equipment', 'Properties , Plant and Equipment', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(24, 1, 8, '10.20.30', 'Intangible Assets', 'Intangible Assets', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(25, 1, 8, '10.20.40', 'Other Assets', 'Other Assets', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(26, 1, 18, '10.10.10.10', 'Bank Account', 'Bank Account', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(27, 1, 18, '10.10.10.20', 'Cash', 'Cash', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(28, 1, 18, '10.10.10.30', 'Petty Cash', 'Petty Cash', -10000, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(29, 1, 20, '10.10.30.10', 'Finished Goods', 'Finished Goods', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(30, 1, 24, '10.20.30.10', 'Goodwill of Acquired Businesses', 'Goodwill of Acquired Businesses', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(31, 1, 24, '10.20.30.20', 'Patents', 'Patents', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(32, 1, 24, '10.20.30.30', 'Trademarks', 'Trademarks', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(33, 1, 9, '20.10.10', 'Accounts Payable', 'Accounts Payable', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(34, 1, 9, '20.10.20', 'Notes Payble', 'Notes Payble', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(35, 1, 10, '20.20.10', 'Long-term Loans , Notes and Bonds Payable', 'Long-term Loans , Notes and Bonds Payable', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(36, 1, 14, '40.10.10', 'Sales', 'Sales', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(37, 1, 15, '50.10.10', 'Selling Expenses', 'Selling Expenses', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(38, 1, 15, '50.10.20', 'General and Administrative Expenses', 'General and Administrative Expenses', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(39, 1, 38, '50.10.20.10', 'Office Salaries', 'Office Salaries', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(40, 1, 38, '50.10.20.20', 'Utilities Expenses', 'Utilities Expenses', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(41, 1, 17, '50.30.10', 'Finished Goods', '', 0, '0000-00-00', 'Active', 0, '2018-11-15 00:00:00', 1, NULL, NULL),
(42, 1, 9, '20.10.30', 'Sales Tax Payable', '', 0, '0000-00-00', 'Active', 0, '2018-10-09 00:00:00', 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ac_default_charts`
--

CREATE TABLE `ac_default_charts` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `code` varchar(25) NOT NULL,
  `name` text NOT NULL,
  `memo` text,
  `status` enum('Active','Inactive') NOT NULL,
  `type` varchar(25) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ac_default_charts`
--

INSERT INTO `ac_default_charts` (`id`, `parent_id`, `code`, `name`, `memo`, `status`, `type`, `created_at`, `created_by`, `modified_at`, `modified_by`) VALUES
(1, 0, '10', 'Assets', 'Assets', 'Active', '', '2018-11-15 00:00:00', 1, NULL, NULL),
(2, 1, '10.10', 'Current Assets', 'Current Assets', 'Active', '', '2018-11-15 00:00:00', 1, NULL, NULL),
(3, 2, '10.10.10', 'Cash and Cash Equivalent', 'Cash and Cash Equivalent', 'Active', '', '2018-11-15 00:00:00', 1, NULL, NULL),
(4, 3, '10.10.10.10', 'Bank Account', 'Bank Account', 'Active', 'Bank', '2018-11-15 00:00:00', 1, NULL, NULL),
(5, 3, '10.10.10.20', 'Cash', 'Cash', 'Active', 'Cash', '2018-11-15 00:00:00', 1, NULL, NULL),
(6, 3, '10.10.10.30', 'Petty Cash', 'Petty Cash', 'Active', '', '2018-11-15 00:00:00', 1, NULL, NULL),
(7, 2, '10.10.20', 'Receivables', 'Receivables', 'Active', 'Receivable', '2018-11-15 00:00:00', 1, NULL, NULL),
(8, 2, '10.10.30', 'Inventories', 'Inventories', 'Active', '', '2018-11-15 00:00:00', 1, NULL, NULL),
(9, 8, '10.10.30.10', 'Finished Goods', 'Finished Goods', 'Active', 'Inventory', '2018-11-15 00:00:00', 1, NULL, NULL),
(10, 2, '10.10.40', 'Prepaid Expenses and Deposits', 'Prepaid Expenses and Deposits', 'Active', '', '2018-11-15 00:00:00', 1, NULL, NULL),
(11, 1, '10.20', 'None Current Assets', 'None Current Assets', 'Active', '', '2018-11-15 00:00:00', 1, NULL, NULL),
(12, 11, '10.20.10', 'Long-Term Investments', 'Long-Term Investments', 'Active', '', '2018-11-15 00:00:00', 1, NULL, NULL),
(13, 11, '10.20.20', 'Properties , Plant and Equipment', 'Properties , Plant and Equipment', 'Active', '', '2018-11-15 00:00:00', 1, NULL, NULL),
(14, 11, '10.20.30', 'Intangible Assets', 'Intangible Assets', 'Active', '', '2018-11-15 00:00:00', 1, NULL, NULL),
(15, 14, '10.20.30.10', 'Goodwill of Acquired Businesses', 'Goodwill of Acquired Businesses', 'Active', '', '2018-11-15 00:00:00', 1, NULL, NULL),
(16, 14, '10.20.30.20', 'Patents', 'Patents', 'Active', '', '2018-11-15 00:00:00', 1, NULL, NULL),
(17, 14, '10.20.30.30', 'Trademarks', 'Trademarks', 'Active', '', '2018-11-15 00:00:00', 1, NULL, NULL),
(18, 11, '10.20.40', 'Other Assets', 'Other Assets', 'Active', '', '2018-11-15 00:00:00', 1, NULL, NULL),
(19, 0, '20', 'Liabilities', 'Liabilities', 'Active', '', '2018-11-15 00:00:00', 1, NULL, NULL),
(20, 19, '20.10', 'Current Liabilities', 'Current Liabilities', 'Active', '', '2018-11-15 00:00:00', 1, NULL, NULL),
(21, 20, '20.10.10', 'Accounts Payable', 'Accounts Payable', 'Active', 'Payable', '2018-11-15 00:00:00', 1, NULL, NULL),
(22, 20, '20.10.20', 'Notes Payble', 'Notes Payble', 'Active', '', '2018-11-15 00:00:00', 1, NULL, NULL),
(23, 20, '20.10.30', 'Sales Tax Payable', 'Sales Tax Payable', 'Active', 'TAX', '2018-11-15 00:00:00', 1, NULL, NULL),
(24, 19, '20.20', 'None Current Liabilities', 'None Current Liabilities', 'Active', '', '2018-11-15 00:00:00', 1, NULL, NULL),
(25, 24, '20.20.10', 'Long-term Loans , Notes and Bonds Payable', 'Long-term Loans , Notes and Bonds Payable', 'Active', '', '2018-11-15 00:00:00', 1, NULL, NULL),
(26, 0, '30', 'Equity', 'Equity', 'Active', '', '2018-11-15 00:00:00', 1, NULL, NULL),
(27, 26, '30.10', 'Partners\' or Owners\' Capital', 'Partners\' or Owners\' Capital', 'Active', '', '2018-11-15 00:00:00', 1, NULL, NULL),
(28, 26, '30.20', 'Stockholders\' Capital', 'Stockholders\' Capital', 'Active', '', '2018-11-15 00:00:00', 1, NULL, NULL),
(29, 26, '30.30', 'Retained Earnings & Other Income', 'Retained Earnings & Other Income', 'Active', '', '2018-11-15 00:00:00', 1, NULL, NULL),
(30, 0, '40', 'Income', 'Income', 'Active', '', '2018-11-15 00:00:00', 1, NULL, NULL),
(31, 30, '40.10', 'Sales or Service Revenues', 'Sales or Service Revenues', 'Active', '', '2018-11-15 00:00:00', 1, NULL, NULL),
(32, 31, '40.10.10', 'Sales', 'Sales', 'Active', 'Sales', '2018-11-15 10:49:14', 1, '2018-11-15 00:00:00', 1),
(33, 0, '50', 'Expense', 'Expense', 'Active', '', '2018-11-15 00:00:00', 1, NULL, NULL),
(34, 33, '50.10', 'Operating Expenses', 'Operating Expenses', 'Active', '', '2018-11-15 00:00:00', 1, NULL, NULL),
(35, 34, '50.10.10', 'Selling Expenses', 'Selling Expenses', 'Active', '', '2018-11-15 00:00:00', 1, NULL, NULL),
(36, 34, '50.10.20', 'General and Administrative Expenses', 'General and Administrative Expenses', 'Active', '', '2018-11-15 00:00:00', 1, NULL, NULL),
(37, 36, '50.10.20.10', 'Office Salaries', 'Office Salaries', 'Active', '', '2018-11-15 00:00:00', 1, NULL, NULL),
(38, 36, '50.10.20.20', 'Utilities Expenses', 'Utilities Expenses', 'Active', '', '2018-11-15 00:00:00', 1, NULL, NULL),
(39, 33, '50.20', 'Other Expenses', 'Other Expenses', 'Active', '', '2018-11-15 00:00:00', 1, NULL, NULL),
(40, 33, '50.30', 'Purchase', '', 'Active', 'Purchase', '2014-09-24 00:00:00', 1, NULL, NULL),
(41, 40, '50.30.10', 'Finished Goods', '', 'Active', '', '2014-09-24 00:00:00', 1, NULL, NULL),
(42, 0, '60', 'Cost of Goods or Services Sold', 'Cost of Goods or Services Sold', 'Active', 'COGS', '2018-11-15 00:00:00', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ac_journal_details`
--

CREATE TABLE `ac_journal_details` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `journal_no` int(11) NOT NULL,
  `chart_id` int(11) NOT NULL,
  `debit` double DEFAULT NULL,
  `credit` double DEFAULT NULL,
  `memo` text,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ac_journal_master`
--

CREATE TABLE `ac_journal_master` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `journal_no` int(11) NOT NULL,
  `journal_date` date NOT NULL,
  `memo` text,
  `doc_type` varchar(50) DEFAULT NULL,
  `doc_no` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ac_money_receipts`
--

CREATE TABLE `ac_money_receipts` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `mr_no` varchar(20) NOT NULL,
  `mr_date` date NOT NULL,
  `next_date` date DEFAULT NULL,
  `amount` double NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `memo` text,
  `doc_type` varchar(50) DEFAULT NULL,
  `doc_no` varchar(50) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ac_payment_receipts`
--

CREATE TABLE `ac_payment_receipts` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `payment_no` varchar(20) NOT NULL,
  `payment_date` date NOT NULL,
  `next_date` date DEFAULT NULL,
  `amount` double NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `memo` text,
  `doc_type` varchar(50) DEFAULT NULL,
  `doc_no` varchar(50) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(150) NOT NULL,
  `address` text,
  `area` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `mobile_no` varchar(50) DEFAULT NULL,
  `currency_id` int(11) NOT NULL,
  `currency_symbol_position` enum('Before','After') NOT NULL,
  `logo` varchar(20) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `code`, `name`, `address`, `area`, `city`, `zip`, `country`, `phone`, `email`, `url`, `contact_person`, `mobile_no`, `currency_id`, `currency_symbol_position`, `logo`, `status`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(1, '', 'Your Company', 'Address', '', '', '', '', '', '', '', 'Mr. Admin', '', 1, 'Before', '', 'Inactive', '2018-11-15 00:00:00', 1, NULL, NULL);

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
(1, 'USD', 'United States', '$', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(2, 'EUR', 'Euro', '€', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(3, 'GBP', 'United Kingdom', '£', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(4, 'AUD', 'Australia', '$', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(5, 'CNY', 'China', '¥', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(6, 'DKK', 'Denmark', 'kr', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(7, 'HKD', 'Hong Kong', '$', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(8, 'INR', 'India', '₹', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(9, 'JPY', 'Japan', '¥', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(10, 'KRW', 'South Korea', '₩', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(11, 'NZD', 'New Zealand', '$', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(12, 'NOK', 'Norway', 'kr', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(13, 'RUB', 'Russia', 'руб', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(14, 'SGD', 'Singapore', '$', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(15, 'ZAR', 'South Africa', 'S', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(16, 'SEK', 'Sweden', 'kr', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(17, 'CHF', 'Switzerland', 'CHF', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(18, 'TWD', 'Taiwan', 'NT$', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(19, 'THB', 'Thailand', '฿', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(20, 'TRL', 'Turkey', '₤', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(21, 'BRL', 'Brazil', 'R$', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(22, 'ALL', 'Albania', 'Lek', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(23, 'AFN', 'Afghanistan', '؋', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(24, 'ARS', 'Argentina', '$', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(25, 'AWG', 'Aruba', 'ƒ', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(26, 'AZN', 'Azerbaijan', 'ман', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(27, 'BSD', 'Bahamas', '$', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(28, 'BBD', 'Barbados', '$', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(29, 'BYR', 'Belarus', 'p.', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(30, 'BZD', 'Belize', 'BZ$', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(31, 'BMD', 'Bermuda', '$', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(32, 'BOB', 'Bolivia', '$b', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(33, 'BAM', 'Bosnia and Herzegovina', 'KM', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(34, 'BWP', 'Botswana', 'P', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(35, 'BGN', 'Bulgaria', 'лв', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(36, 'BND', 'Brunei', '$', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(37, 'KHR', 'Cambodia', '៛', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(38, 'CAD', 'Canada', '$', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(39, 'KYD', 'Cayman', '$', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(40, 'CLP', 'Chile', '$', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(41, 'COP', 'Colombia', '$', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(42, 'CRC', 'Costa Rica', '₡', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(43, 'HRK', 'Croatia', 'kn', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(44, 'CUP', 'Cuba', '₱', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(45, 'CZK', 'Czech Republic', 'Kč', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(46, 'DOP', 'Dominican Republic', 'RD$', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(47, 'XCD', 'East Caribbean', '$', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(48, 'EGP', 'Egypt', '£', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(49, 'SVC', 'El Salvador', '$', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(50, 'EEK', 'Estonia', 'kr', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(51, 'FKP', 'Falkland Islands', '£', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(52, 'FJD', 'Fiji', '$', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(53, 'GHC', 'Ghana', '¢', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(54, 'GIP', 'Gibraltar', '£', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(55, 'GTQ', 'Guatemala', 'Q', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(56, 'GGP', 'Guernsey', '£', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(57, 'GYD', 'Guyana', '$', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(58, 'HNL', 'Honduras', 'L', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(59, 'HUF', 'Hungary', 'Ft', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(60, 'ISK', 'Iceland', 'kr', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(61, 'IDR', 'Indonesia', 'Rp', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(62, 'IRR', 'Iran', '﷼', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(63, 'IMP', 'Isle Of Man', '£', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(64, 'ILS', 'Israel', '₪', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(65, 'JMD', 'Jamaica', '$', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(66, 'JEP', 'Jersey', '£', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(67, 'KZT', 'Kazakhstan', 'лв', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(68, 'KPW', 'North Korea', '₩', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(69, 'KGS', 'Kyrgyzstan', 'лв', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(70, 'LAK', 'Laos', '₭', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(71, 'LVL', 'Latvia', 'Ls', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(72, 'LBP', 'Lebanon', '£', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(73, 'LRD', 'Liberia', '$', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(74, 'LTL', 'Lithuania', 'Lt', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(75, 'MKD', 'Macedonia', 'ден', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(76, 'MYR', 'Malaysia', 'RM', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(77, 'MUR', 'Mauritius', 'Rs', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(78, 'MXN', 'Mexico', '$', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(79, 'MNT', 'Mongolia', '₮', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(80, 'MZN', 'Mozambique', 'MT', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(81, 'NAD', 'Namibia', '$', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(82, 'NPR', 'Nepal', '₨', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(83, 'ANG', 'Netherlands', 'ƒ', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(84, 'NIO', 'Nicaragua', 'C$', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(85, 'NGN', 'Nigeria', '₦', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(86, 'OMR', 'Oman', '﷼', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(87, 'PKR', 'Pakistan', '₨', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(88, 'PAB', 'Panama', 'B/.', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(89, 'PYG', 'Paraguay', 'Gs', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(90, 'PEN', 'Peru', 'S/.', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(91, 'PHP', 'Philippines', '₱', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(92, 'PLN', 'Poland', 'zł', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(93, 'QAR', 'Qatar', '﷼', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(94, 'RON', 'Romania', 'lei', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(95, 'SHP', 'Saint Helena', '£', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(96, 'SAR', 'Saudi Arabia', '﷼', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(97, 'RSD', 'Serbia', 'Дин.', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(98, 'SCR', 'Seychelles', '₨', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(99, 'SBD', 'Solomon Islands', '$', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(100, 'SOS', 'Somalia', 'S', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(101, 'LKR', 'Sri Lanka', '₨', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(102, 'SRD', 'Suriname', '$', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(103, 'SYP', 'Syria', '£', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(104, 'TTD', 'Trinidad and Tobago', 'TT$', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(105, 'TVD', 'Tuvalu', '$', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(106, 'UAH', 'Ukraine', '₴', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(107, 'UYU', 'Uruguay', '$U', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(108, 'UZS', 'Uzbekistan', 'лв', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(109, 'VEF', 'Venezuela', 'Bs', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(110, 'VND', 'Vietnam', '₫', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(111, 'YER', 'Yemen', '﷼', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(112, 'ZWD', 'Zimbabwe', 'Z$', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL),
(113, 'BDT', 'Bangladesh', '৳', 'Active', '2018-11-15 00:00:00', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `ac_id` int(11) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `address` blob,
  `city` varchar(50) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `web` varchar(100) DEFAULT NULL,
  `notes` text,
  `status` enum('Active','Inactive') NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `emps`
--

CREATE TABLE `emps` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `mother_name` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `voter_id` varchar(32) DEFAULT NULL,
  `joining` date DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `designation` varchar(50) NOT NULL,
  `present_address` text,
  `permanent_address` text,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `picture` varchar(20) DEFAULT NULL,
  `notes` text,
  `status` enum('Active','Inactive','Terminate') DEFAULT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` text NOT NULL,
  `description` text,
  `min_sale_price` double NOT NULL,
  `avco_price` double DEFAULT NULL,
  `re_order` int(11) DEFAULT NULL,
  `picture` varchar(50) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `purchase_no` varchar(50) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` double NOT NULL,
  `purchase_price` double NOT NULL,
  `vat_percent` double DEFAULT NULL,
  `vat_amount` double DEFAULT NULL,
  `total_price` double NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_master`
--

CREATE TABLE `purchase_master` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `purchase_no` varchar(50) NOT NULL,
  `purchase_date` date NOT NULL,
  `notes` text,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_return_details`
--

CREATE TABLE `purchase_return_details` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `purchase_return_no` varchar(50) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` double NOT NULL,
  `purchase_price` double NOT NULL,
  `vat_percent` double DEFAULT NULL,
  `vat_amount` double DEFAULT NULL,
  `total_price` double NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_return_master`
--

CREATE TABLE `purchase_return_master` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `purchase_return_no` varchar(50) NOT NULL,
  `purchase_return_date` date NOT NULL,
  `notes` text,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sales_details`
--

CREATE TABLE `sales_details` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `sales_no` int(11) NOT NULL,
  `sales_date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `sale_price` double NOT NULL,
  `quantity` double NOT NULL,
  `price_total` double NOT NULL,
  `cogs_total` double NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sales_master`
--

CREATE TABLE `sales_master` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `sales_no` int(11) NOT NULL,
  `sales_date` date NOT NULL,
  `customer_id` int(11) NOT NULL,
  `tax_percent` double DEFAULT NULL,
  `tax_amount` double DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  `notes` text,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sales_return_details`
--

CREATE TABLE `sales_return_details` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `sales_return_no` int(11) NOT NULL,
  `sales_return_date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `sale_price` double NOT NULL,
  `vat_percent` double DEFAULT NULL,
  `vat_amount` double DEFAULT NULL,
  `quantity` double NOT NULL,
  `price_total` double NOT NULL,
  `cogs_total` double DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sales_return_master`
--

CREATE TABLE `sales_return_master` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `sales_return_no` int(11) NOT NULL,
  `sales_return_date` date NOT NULL,
  `customer_id` int(11) NOT NULL,
  `tax_percent` double DEFAULT NULL,
  `tax_amount` double DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  `notes` text,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `ac_receivable` int(11) NOT NULL,
  `ac_payable` int(11) NOT NULL,
  `ac_cash` int(11) NOT NULL,
  `ac_bank` int(11) NOT NULL,
  `ac_sales` int(11) NOT NULL,
  `ac_purchase` int(11) NOT NULL,
  `ac_inventory` int(11) NOT NULL,
  `ac_cogs` int(11) NOT NULL,
  `ac_tax` int(11) DEFAULT NULL,
  `tax_rate` double DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `company_id`, `ac_receivable`, `ac_payable`, `ac_cash`, `ac_bank`, `ac_sales`, `ac_purchase`, `ac_inventory`, `ac_cogs`, `ac_tax`, `tax_rate`, `created_at`, `created_by`, `modified_at`, `modified_by`) VALUES
(1, 1, 19, 33, 27, 26, 36, 19, 29, 6, 42, 15, '2018-11-15 00:00:00', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `ac_id` int(11) NOT NULL,
  `code` varchar(20) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `address` text,
  `city` varchar(50) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `phone_no` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `web` varchar(100) DEFAULT NULL,
  `notes` text,
  `status` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` enum('Admin','Power User','User') NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `code` varchar(32) DEFAULT NULL,
  `picture` varchar(50) DEFAULT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `company_id`, `email`, `password`, `name`, `type`, `status`, `code`, `picture`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(1, 1, 'admin@admin.com', 'f865b53623b121fd', 'Mr. Admin', 'Admin', 'Active', '66af608035473049171828825505c433', '', '2018-11-15 00:00:00', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_privileges`
--

CREATE TABLE `user_privileges` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `ref_user` int(11) NOT NULL,
  `inventory_menu` int(11) DEFAULT NULL,
  `sales` int(11) DEFAULT NULL,
  `sales_return` int(11) DEFAULT NULL,
  `purchase` int(11) DEFAULT NULL,
  `purchase_return` int(11) DEFAULT NULL,
  `supplier` int(11) DEFAULT NULL,
  `item` int(11) DEFAULT NULL,
  `customer` int(11) DEFAULT NULL,
  `hr_menu` int(11) DEFAULT NULL,
  `employee` int(11) DEFAULT NULL,
  `accounts_menu` int(11) DEFAULT NULL,
  `journal` int(11) DEFAULT NULL,
  `ac_head` int(11) DEFAULT NULL,
  `money_receipt` int(11) DEFAULT NULL,
  `payment_receipt` int(11) DEFAULT NULL,
  `report_menu` int(11) DEFAULT NULL,
  `purchase_report` int(11) DEFAULT NULL,
  `purchase_return_report` int(11) DEFAULT NULL,
  `sales_report` int(11) DEFAULT NULL,
  `sales_return_report` int(11) DEFAULT NULL,
  `inventory_report` int(11) DEFAULT NULL,
  `ledger_report` int(11) DEFAULT NULL,
  `trial_balance_report` int(11) DEFAULT NULL,
  `balance_sheet_report` int(11) DEFAULT NULL,
  `income_statement_report` int(11) DEFAULT NULL,
  `bills_receivable_report` int(11) DEFAULT NULL,
  `bills_payable_report` int(11) DEFAULT NULL,
  `cash_book_report` int(11) DEFAULT NULL,
  `bank_book_report` int(11) DEFAULT NULL,
  `settings_menu` int(11) DEFAULT NULL,
  `basic_settings` int(11) DEFAULT NULL,
  `currency_settings` int(11) DEFAULT NULL,
  `company_settings` int(11) DEFAULT NULL,
  `default_ac_head_settings` int(11) DEFAULT NULL,
  `user_menu` int(11) DEFAULT NULL,
  `user_section` int(11) DEFAULT NULL,
  `user_permission` int(11) DEFAULT NULL,
  `user_edit` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_privileges`
--

INSERT INTO `user_privileges` (`id`, `company_id`, `ref_user`, `inventory_menu`, `sales`, `sales_return`, `purchase`, `purchase_return`, `supplier`, `item`, `customer`, `hr_menu`, `employee`, `accounts_menu`, `journal`, `ac_head`, `money_receipt`, `payment_receipt`, `report_menu`, `purchase_report`, `purchase_return_report`, `sales_report`, `sales_return_report`, `inventory_report`, `ledger_report`, `trial_balance_report`, `balance_sheet_report`, `income_statement_report`, `bills_receivable_report`, `bills_payable_report`, `cash_book_report`, `bank_book_report`, `settings_menu`, `basic_settings`, `currency_settings`, `company_settings`, `default_ac_head_settings`, `user_menu`, `user_section`, `user_permission`, `user_edit`, `user_delete`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2018-11-15 00:00:00', 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ac_charts`
--
ALTER TABLE `ac_charts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ac_default_charts`
--
ALTER TABLE `ac_default_charts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ac_journal_details`
--
ALTER TABLE `ac_journal_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ac_journal_master`
--
ALTER TABLE `ac_journal_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ac_money_receipts`
--
ALTER TABLE `ac_money_receipts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ac_payment_receipts`
--
ALTER TABLE `ac_payment_receipts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`),
  ADD KEY `id_3` (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `currency_shortname` (`shortname`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emps`
--
ALTER TABLE `emps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_master`
--
ALTER TABLE `purchase_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_return_details`
--
ALTER TABLE `purchase_return_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_return_master`
--
ALTER TABLE `purchase_return_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_details`
--
ALTER TABLE `sales_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_master`
--
ALTER TABLE `sales_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_return_details`
--
ALTER TABLE `sales_return_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_return_master`
--
ALTER TABLE `sales_return_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_privileges`
--
ALTER TABLE `user_privileges`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ac_charts`
--
ALTER TABLE `ac_charts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `ac_default_charts`
--
ALTER TABLE `ac_default_charts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `ac_journal_details`
--
ALTER TABLE `ac_journal_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ac_journal_master`
--
ALTER TABLE `ac_journal_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ac_money_receipts`
--
ALTER TABLE `ac_money_receipts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ac_payment_receipts`
--
ALTER TABLE `ac_payment_receipts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emps`
--
ALTER TABLE `emps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `purchase_master`
--
ALTER TABLE `purchase_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `purchase_return_details`
--
ALTER TABLE `purchase_return_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `purchase_return_master`
--
ALTER TABLE `purchase_return_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sales_details`
--
ALTER TABLE `sales_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sales_master`
--
ALTER TABLE `sales_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sales_return_details`
--
ALTER TABLE `sales_return_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sales_return_master`
--
ALTER TABLE `sales_return_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_privileges`
--
ALTER TABLE `user_privileges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

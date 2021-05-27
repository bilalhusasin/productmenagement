-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2021 at 11:33 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `product_curd`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_products`
--

CREATE TABLE `add_products` (
  `id` int(11) NOT NULL,
  `cate_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_size` varchar(255) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_discription` varchar(255) NOT NULL,
  `status` varchar(15) NOT NULL,
  `created_by` int(11) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `add_products`
--

INSERT INTO `add_products` (`id`, `cate_id`, `product_name`, `product_size`, `product_price`, `product_discription`, `status`, `created_by`, `last_update`) VALUES
(1, 1, 'Pepsi ', 'large', 100, '  cold drink', 'Active', 1, '2021-05-27 15:09:56'),
(2, 1, 'Coca cola', 'large', 100, '  cold drink', 'Active', 1, '2021-05-27 15:10:45'),
(3, 2, 'pure minreral water', 'large', 50, '  water', 'Active', 1, '2021-05-27 15:11:33'),
(4, 2, 'pure minreral water', '19 Litre ', 600, '  water', 'Active', 1, '2021-05-27 15:12:33');

-- --------------------------------------------------------

--
-- Table structure for table `add_product_category`
--

CREATE TABLE `add_product_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_discription` varchar(255) NOT NULL,
  `status` varchar(15) NOT NULL,
  `created_by` int(11) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `add_product_category`
--

INSERT INTO `add_product_category` (`id`, `category_name`, `company_name`, `company_discription`, `status`, `created_by`, `last_update`) VALUES
(1, 'Cold Drink', 'PepsiCo', '  Pepsi', 'Active', 1, '2021-05-27 15:08:01'),
(2, 'Mineral Water', 'Pure Water', '  water company', 'Active', 1, '2021-05-27 15:09:03');

-- --------------------------------------------------------

--
-- Table structure for table `configuration`
--

CREATE TABLE `configuration` (
  `id` int(11) NOT NULL,
  `logo` varchar(150) NOT NULL,
  `time_zone` varchar(150) NOT NULL,
  `school_name` varchar(150) NOT NULL,
  `starting_year` varchar(50) NOT NULL,
  `headmaster_name` varchar(150) NOT NULL,
  `address` varchar(150) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `currenct` varchar(50) NOT NULL,
  `country` varchar(150) NOT NULL,
  `language` text NOT NULL,
  `msg_apai_email` varchar(100) NOT NULL,
  `msg_hash_number` varchar(100) NOT NULL,
  `msg_sender_title` varchar(100) NOT NULL,
  `countryPhonCode` varchar(5) NOT NULL,
  `t_a_s_p` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `configuration`
--

INSERT INTO `configuration` (`id`, `logo`, `time_zone`, `school_name`, `starting_year`, `headmaster_name`, `address`, `phone`, `email`, `currenct`, `country`, `language`, `msg_apai_email`, `msg_hash_number`, `msg_sender_title`, `countryPhonCode`, `t_a_s_p`) VALUES
(9, '', 'UP5', 'The Punjab School Canal Gardens Gulshan-e-Habib Campus', '01/01/2018', 'Prof. Arif Javaid', '287/B, Block E, Canal Gardens, Near Bahria Town, Lahore.', '924235343632', 'info@thepunjabschoolcg.com', 'fa fa-money', 'Pakistan', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(25) NOT NULL,
  `id_sub_title` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` varchar(15) NOT NULL,
  `created_by` int(11) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `id_sub_title`, `description`, `status`, `created_by`, `last_update`) VALUES
(1, 'admin', 'ADM', 'Administrator', 'Active', 0, '2020-10-05 09:17:19'),
(13, 'supper admin', 'SPA', 'admin', 'Active', 1, '2021-05-27 21:10:15');

-- --------------------------------------------------------

--
-- Table structure for table `group_based_access`
--

CREATE TABLE `group_based_access` (
  `id` int(11) NOT NULL,
  `group_id` int(1) NOT NULL,
  `das_top_info` int(1) NOT NULL,
  `das_grab_chart` int(1) NOT NULL,
  `das_class_info` int(1) NOT NULL,
  `das_message` int(1) NOT NULL,
  `das_employ_attend` int(1) NOT NULL,
  `das_notice` int(1) NOT NULL,
  `das_calender` int(1) NOT NULL,
  `admission` int(1) NOT NULL,
  `all_student_info` int(1) NOT NULL,
  `stud_edit_delete` int(1) NOT NULL,
  `stu_own_info` int(1) NOT NULL,
  `teacher_info` int(1) NOT NULL,
  `add_teacher` int(1) NOT NULL,
  `teacher_details` int(1) NOT NULL,
  `teacher_edit_delete` int(1) NOT NULL,
  `all_parents_info` int(1) NOT NULL,
  `own_parents_info` int(1) NOT NULL,
  `make_parents_id` int(1) NOT NULL,
  `parents_edit_dlete` int(1) NOT NULL,
  `add_group` int(1) NOT NULL,
  `group_list` int(1) NOT NULL,
  `add_employee` int(1) NOT NULL,
  `employee_list` int(1) NOT NULL,
  `employ_attendance` int(1) NOT NULL,
  `empl_atte_view` int(1) NOT NULL,
  `add_new_class` int(1) NOT NULL,
  `all_class_info` int(1) NOT NULL,
  `class_details` int(1) NOT NULL,
  `class_delete` int(1) NOT NULL,
  `class_promotion` int(1) NOT NULL,
  `add_class_routine` int(1) NOT NULL,
  `own_class_routine` int(1) NOT NULL,
  `all_class_routine` int(1) NOT NULL,
  `rutin_edit_delete` int(1) NOT NULL,
  `attendance_preview` int(1) NOT NULL,
  `take_studence_atten` int(1) NOT NULL,
  `edit_student_atten` int(1) NOT NULL,
  `add_subject` int(1) NOT NULL,
  `all_subject` int(1) NOT NULL,
  `assin_optio_sub` int(1) NOT NULL,
  `make_suggestion` int(1) NOT NULL,
  `all_suggestion` int(1) NOT NULL,
  `own_suggestion` int(1) NOT NULL,
  `add_exam_gread` int(1) NOT NULL,
  `exam_gread` int(1) NOT NULL,
  `gread_edit_dele` int(1) NOT NULL,
  `add_exam_routin` int(1) NOT NULL,
  `all_exam_routine` int(1) NOT NULL,
  `dateSheet` int(1) NOT NULL,
  `assets` int(1) NOT NULL,
  `own_exam_routine` int(1) NOT NULL,
  `exam_attend_preview` int(1) NOT NULL,
  `approve_result` int(1) NOT NULL,
  `view_result` int(1) NOT NULL,
  `all_mark_sheet` int(1) NOT NULL,
  `combine_mark_sheet` int(1) NOT NULL,
  `own_mark_sheet` int(1) NOT NULL,
  `take_exam_attend` int(1) NOT NULL,
  `change_exam_attendance` int(1) NOT NULL,
  `make_result` int(1) NOT NULL,
  `add_category` int(1) NOT NULL,
  `all_category` int(1) NOT NULL,
  `edit_delete_category` int(1) NOT NULL,
  `add_books` int(1) NOT NULL,
  `all_books` int(1) NOT NULL,
  `edit_delete_books` int(1) NOT NULL,
  `add_library_mem` int(1) NOT NULL,
  `memb_list` int(1) NOT NULL,
  `issu_return` int(1) NOT NULL,
  `add_dormitories` int(1) NOT NULL,
  `add_set_dormi` int(1) NOT NULL,
  `set_member_bed` int(1) NOT NULL,
  `dormi_report` int(1) NOT NULL,
  `student_reports` int(1) NOT NULL,
  `add_transport` int(1) NOT NULL,
  `all_transport` int(1) NOT NULL,
  `transport_edit_dele` int(1) NOT NULL,
  `add_account_title` int(1) NOT NULL,
  `edit_dele_acco` int(1) NOT NULL,
  `trensection` int(1) NOT NULL,
  `fee_collection` int(1) NOT NULL,
  `all_slips` int(1) NOT NULL,
  `own_slip` int(1) NOT NULL,
  `slip_edit_delete` int(1) NOT NULL,
  `pay_salary` int(1) NOT NULL,
  `creat_notice` int(1) NOT NULL,
  `send_message` int(1) NOT NULL,
  `vendor` int(1) NOT NULL,
  `delet_vendor` int(1) NOT NULL,
  `add_inv_cat` int(1) NOT NULL,
  `inve_item` int(1) NOT NULL,
  `delete_inve_ite` int(1) NOT NULL,
  `delete_inv_cat` int(1) NOT NULL,
  `inve_issu` int(1) NOT NULL,
  `add_event` int(1) NOT NULL,
  `calender` int(1) NOT NULL,
  `delete_inven_issu` int(1) NOT NULL,
  `check_leav_appli` int(1) NOT NULL,
  `setting_accounts` int(1) NOT NULL,
  `other_setting` int(1) NOT NULL,
  `front_setings` int(1) NOT NULL,
  `set_optional` int(1) NOT NULL,
  `setting_manage_user` int(1) NOT NULL,
  `registration` int(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_based_access`
--

INSERT INTO `group_based_access` (`id`, `group_id`, `das_top_info`, `das_grab_chart`, `das_class_info`, `das_message`, `das_employ_attend`, `das_notice`, `das_calender`, `admission`, `all_student_info`, `stud_edit_delete`, `stu_own_info`, `teacher_info`, `add_teacher`, `teacher_details`, `teacher_edit_delete`, `all_parents_info`, `own_parents_info`, `make_parents_id`, `parents_edit_dlete`, `add_group`, `group_list`, `add_employee`, `employee_list`, `employ_attendance`, `empl_atte_view`, `add_new_class`, `all_class_info`, `class_details`, `class_delete`, `class_promotion`, `add_class_routine`, `own_class_routine`, `all_class_routine`, `rutin_edit_delete`, `attendance_preview`, `take_studence_atten`, `edit_student_atten`, `add_subject`, `all_subject`, `assin_optio_sub`, `make_suggestion`, `all_suggestion`, `own_suggestion`, `add_exam_gread`, `exam_gread`, `gread_edit_dele`, `add_exam_routin`, `all_exam_routine`, `dateSheet`, `assets`, `own_exam_routine`, `exam_attend_preview`, `approve_result`, `view_result`, `all_mark_sheet`, `combine_mark_sheet`, `own_mark_sheet`, `take_exam_attend`, `change_exam_attendance`, `make_result`, `add_category`, `all_category`, `edit_delete_category`, `add_books`, `all_books`, `edit_delete_books`, `add_library_mem`, `memb_list`, `issu_return`, `add_dormitories`, `add_set_dormi`, `set_member_bed`, `dormi_report`, `student_reports`, `add_transport`, `all_transport`, `transport_edit_dele`, `add_account_title`, `edit_dele_acco`, `trensection`, `fee_collection`, `all_slips`, `own_slip`, `slip_edit_delete`, `pay_salary`, `creat_notice`, `send_message`, `vendor`, `delet_vendor`, `add_inv_cat`, `inve_item`, `delete_inve_ite`, `delete_inv_cat`, `inve_issu`, `add_event`, `calender`, `delete_inven_issu`, `check_leav_appli`, `setting_accounts`, `other_setting`, `front_setings`, `set_optional`, `setting_manage_user`, `registration`, `created_by`, `last_update`) VALUES
(1, 6, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 1, 1, 1, 0, 1, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 1, 0, 0, 0, 1, 214, '2020-10-07 10:53:25'),
(2, 12, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, '2021-02-10 07:11:36');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `employ_id` varchar(255) NOT NULL,
  `emp_roll` int(50) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `farther_name` varchar(50) NOT NULL,
  `files_info` varchar(30) NOT NULL,
  `dempass` varchar(255) NOT NULL,
  `status` varchar(15) NOT NULL,
  `status_reason` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`id`, `user_id`, `group_id`, `employ_id`, `emp_roll`, `first_name`, `last_name`, `full_name`, `farther_name`, `files_info`, `dempass`, `status`, `status_reason`) VALUES
(116, 243, 13, 'SPA-202113001', 1, 'product', '', 'product', '', '', 'product', '', ''),
(117, 244, 13, 'SPA-202113002', 2, 'admin bilal', '', 'admin bilal', '', '', 'adminbilal', '', ''),
(118, 245, 1, 'ADM-20211001', 1, 'admin', '', 'admin', '', '', 'adminadmin', '', ''),
(119, 246, 13, 'SPA-202113003', 3, 'adminadmin', '', 'adminadmin', '', '', 'adminadmin', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `place_birth` varchar(250) NOT NULL,
  `nationality` varchar(250) NOT NULL,
  `religion` varchar(250) NOT NULL,
  `sect` varchar(250) NOT NULL,
  `previous_detail_school` varchar(250) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `profile_image` varchar(100) NOT NULL,
  `user_status` text NOT NULL,
  `leave_status` varchar(15) NOT NULL,
  `leave_start` int(11) NOT NULL,
  `leave_end` int(11) NOT NULL,
  `salary` int(1) NOT NULL,
  `status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `place_birth`, `nationality`, `religion`, `sect`, `previous_detail_school`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `phone`, `profile_image`, `user_status`, `leave_status`, `leave_start`, `leave_end`, `salary`, `status`) VALUES
(243, '::1', 'product', '', '', '', '', '', '$2y$08$TsbgZA4kLutpkOYv44MgF.BFjo1zgl/J3bF3VnwEwPY9wd0VywXjO', NULL, 'product@product.com', NULL, NULL, NULL, NULL, 1622149977, 1622149977, 1, 'product', NULL, NULL, '', '', '', 0, 0, 0, ''),
(244, '::1', 'admin bilal', '', '', '', '', '', '$2y$08$j2vnaJfvkBMJ/FO14dkgiuaxDzFIpaHeSMbhDR6ba9cZtk5RW5W/S', NULL, 'adminbilal@gmail.com', NULL, NULL, NULL, NULL, 1622150040, 1622150090, 1, 'admin bilal', NULL, NULL, '', '', '', 0, 0, 0, ''),
(245, '::1', 'admin', '', '', '', '', '', '$2y$08$Aoi5eoo13YXNbosZLAHZDuvAFFlEPA0KnpV4fhWYsbpD.0M4RTmqW', NULL, 'admin@admin.com', NULL, NULL, NULL, NULL, 1622150325, 1622150325, 1, 'admin', NULL, NULL, '', '', '', 0, 0, 0, ''),
(246, '::1', 'adminadmin', '', '', '', '', '', '$2y$08$yVEdeV6Ix6yhQf/u0RAliefGE2h4dBIjxVEIVzqFmFqaX5BvSbE/u', NULL, 'adminadmin@admin.com', NULL, NULL, NULL, NULL, 1622150530, 1622150530, 1, 'adminadmin', NULL, NULL, '', '', '', 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(236, 243, 13),
(237, 244, 13),
(238, 245, 1),
(239, 246, 13);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_products`
--
ALTER TABLE `add_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `add_product_category`
--
ALTER TABLE `add_product_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configuration`
--
ALTER TABLE `configuration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_based_access`
--
ALTER TABLE `group_based_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_products`
--
ALTER TABLE `add_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `add_product_category`
--
ALTER TABLE `add_product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `configuration`
--
ALTER TABLE `configuration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `group_based_access`
--
ALTER TABLE `group_based_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

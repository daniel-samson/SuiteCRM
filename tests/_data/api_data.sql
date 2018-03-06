-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: mariadb
-- Generation Time: Feb 23, 2018 at 12:31 PM
-- Server version: 10.2.10-MariaDB-10.2.10+maria~jessie
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `suitecrm-github-develop`
--

-- --------------------------------------------------------
--
-- Dumping data for table `oauth2clients`
--

INSERT INTO `oauth2clients` (`id`, `name`, `date_entered`, `date_modified`, `modified_user_id`, `created_by`, `description`, `deleted`, `secret`, `redirect_url`, `is_confidential`, `allowed_grant_type`, `duration_value`, `duration_amount`, `duration_unit`, `assigned_user_id`) VALUES
('API-4c59-f678-cecc-6594-5a8d9c704473', 'Password Grant API Client', '2018-02-21 16:20:43', '2018-02-21 16:20:43', '1', '1', NULL, 0, '$1$LWHSyJNo$Dg3KssRJcfw85uRJcF/py.', 'https://test.com', 1, 'password', 8640000, 1, 'day', NULL),
('API-6d34-6c4c-59be-9fb5-5a8d9cda918f', 'Implicit API Client', '2018-02-21 16:22:07', '2018-02-21 16:22:17', '1', '1', NULL, 0, '$1$LWHSyJNo$Dg3KssRJcfw85uRJcF/py.', 'https://test.com', 1, 'implicit', 8640000, 1, 'day', NULL),
('API-b95b-19cd-0229-a3ed-5a8d9cc0d3eb', 'Authorization Code API Client', '2018-02-21 16:22:46', '2018-02-21 16:22:46', '1', '1', NULL, 0, '$1$LWHSyJNo$Dg3KssRJcfw85uRJcF/py.', 'https://test.com', 1, 'authorization_code', 8640000, 1, 'day', NULL),
('API-ea74-c352-badd-c2be-5a8d9c9d4351', 'Client Credentials API Client', '2018-02-21 16:21:42', '2018-02-22 17:03:17', '1', '1', NULL, 0, '$1$LWHSyJNo$Dg3KssRJcfw85uRJcF/py.', 'https://test.com', 1, 'client_credentials', 1, 1, 'day', '1');

--
-- Indexes for dumped tables
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
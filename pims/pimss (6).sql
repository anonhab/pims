-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 11, 2025 at 11:28 AM
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
-- Database: `pimss`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `user_image` text DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `prison_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`user_id`, `username`, `password`, `role_id`, `first_name`, `last_name`, `email`, `user_image`, `phone_number`, `dob`, `gender`, `address`, `created_at`, `updated_at`, `prison_id`) VALUES
(12, 'bossSDA@gmail.com', '$2y$12$IHpvu1veh.d1a9xf2hLuf.PHqniVySJmKWv9Oq4qn4tWjfxOlFMxS', 3, 'Habtamu', 'Gashu', 'central@gmail.com', 'user_images/9CIWNZ3mDQ9Ayfof2HOi8bUPHtQ8tYB8lgPYps9X.png', '09433923328', '2025-02-26', 'male', 'Dire Dawa', '2025-03-09 19:26:03', '2025-03-31 03:02:29', 4),
(14, 'bobnss@gmail.com', '$2y$12$5CftZfA5GaNTU1JeSI/AN.ZNVqIK41wdcN72MP1BozrnE2N4SEZoy', 2, 'Habtamu', 'Gashu', 'Habtsha2p021@gmail.com', 'user_images/dd3GW1Dvdwd14JKJfqzMrOOApNHOkkMNuFakujcj.png', '0909029295', '2025-03-05', 'male', 'Bahir Dar, Amhara-Mirab Gojam', '2025-03-10 01:24:14', '2025-04-01 01:29:51', 20),
(16, 'boss@gmail.com', '$2y$12$tI7pMs.wgJn0hlrQxaZXeuMosS0OkkbRXMMIxE0d3gskOcXpu1by2', 2, 'Habtamu', 'Gashu', 'boss@gmail.com', 'user_images/3zpDUXsETUxSecgTbxGG1vVi4Qm1XMBVz4YZmgpD.png', '0909029295', '2025-03-05', 'male', 'Bahir dar\r\nBahir dar,Ethiopia', '2025-03-11 01:56:42', '2025-03-23 02:46:10', 10),
(20, 'test@gmail.com', '$2y$12$F7wJwT5zz5DVq2xKeDmyiuHewOjR5fH4ykZoVdcdNRKiXQJT3Wks2', 1, 'Habtamu', 'Gashu', 'Habtshatest2021@gmail.com', 'user_images/1xUI9yx11PaXdWJkZZPg9LDU2zBiAl9EohKkQR01.png', '0909029295', '2025-03-19', 'male', 'Bahir Dar, Amhara-Mirab Gojam', '2025-03-14 02:13:46', '2025-03-14 02:13:46', 5),
(22, 'lol@gmail.com', '$2y$12$cgkTSCEIVLgLN4LJutex4u37LroOW8kjLrV3N3tNPPAHzUKfqQtxG', 2, 'Habtamu', 'Gashu', 'lol@gmail.com', 'user_images/E5sREAK4A6DUQmnS8X6jWoi7GNcbFHa6I0Q7TsXP.png', '0909029295', '2025-03-05', 'male', 'Bahir Dar, Amhara-Mirab Gojam', '2025-03-14 03:12:58', '2025-03-22 06:55:17', 10),
(23, 'lol1@gmail.com', '$2y$12$f8sjKj//5g7r/SIaWX3Bsu0psAMdSJUpDO1bqxU7.rgeTWZdjmNGm', 1, 'Habtamu', 'Gashu', 'lols1@gmail.com', 'user_images/nQEcl5KF8xBSBncImpqeWNYiAkNTDop1Mbo7mCcC.png', '0909029295', '2025-03-29', 'male', 'Addis Ababa, Bole', '2025-03-14 03:37:02', '2025-04-01 01:30:32', 3),
(25, 'boss1@gmail.com', '$2y$12$gPw9CfXxmS031K2gbu0yn.gx1FjlKrhWc2fyD/AUWSOSlz1VLNsk6', 2, 'Habtamu', 'Gashu', 'boss1@gmail.com', 'user_images/z8xWEKZcpvbhohi5CRutEn72LVXiAZhJxYybwt5o.jpg', '0909029295', '2025-03-18', 'male', 'Ethiopia , Amhara Bahir Dar, Amhara-Mirab Gojam', '2025-03-17 03:32:04', '2025-03-30 21:41:15', 7),
(35, 'centraddl@gmail.com', '$2y$12$8y9BWQ39rUYSw4zpoKTGSuz/AVN8chouFKjl0TMaCu2s90j.1HtYW', 1, 'Habtamu', 'Gashu', 'systemmm@gmail.com', 'user_images/FhofqLufhMNCb2WHkmI7iH1EgvgvDBpAfxhrYrq1.jpg', '0909029295', '2025-03-19', 'male', 'Bahir Dar, Amhara-Mirab Gojam', '2025-03-18 05:35:53', '2025-03-30 21:49:08', 5),
(37, 'centsdsdsd@gmail.com', '$2y$12$by/8H4.bFyBxe07qXraCf.Ehk1Qtubm2goGyVdMjvHh7TQeQ978La', 1, 'demlew', 'Gashu', 'kembatain@gmail.com', 'user_images/W3iMw3ZwhhFRUz0GvGAVxtXgOhtGIxh1oOCWlbi8.jpg', '0909029295', '2025-03-13', 'male', 'Ethiopia , Amhara Bahir Dar, Amhara-Mirab Gojam', '2025-03-18 05:46:40', '2025-03-31 14:19:35', 5),
(38, 'worabe@gmail.com', '$2y$12$vo82.5Z5Ko9coM.6i2pcp.YcGqgNR3hqT17mowHao3Yo4kuWdyN/q', 1, 'Habtamu', 'Gashu', 'worabe@gmail.com', 'user_images/UZ3Pf5OBDrvz6THLEwzpEPmmCvpyN2LrItDNSyck.jpg', '0909029295', '2025-03-05', 'male', 'Gonder', '2025-03-18 14:22:19', '2025-03-18 14:22:19', 6),
(40, 'worabe@gm.com', '$2y$12$YoFLSazec8QGcZksLGycMunEjqPl41qYKpFoA8xQLG0ureWn1LT7.', NULL, 'Habtamu', 'Gashu', 'worabeins@gmail.com', 'user_images/dBaIkBS3uXEDauEI7rjzhO3aCDgS76br3p6xiSt5.jpg', '0909029295', '2025-03-05', 'male', 'Bahir dar\r\nBahir dar,Ethiopia', '2025-03-18 14:24:20', '2025-03-22 06:38:26', 11),
(41, 'Habtdddd', '$2y$12$Fg2IsCfazxIyjMN0k5S1KeA05QKXg94oJ45u2jCmvwO1xo2fI7oES', 1, 'Habtamu', 'Gashu', 'sy@gmail.com', 'user_images/16njaoR8OQyoNIvMwKosu3grBn6SR0KofLNhbqcW.png', '0909029295', '2025-03-19', 'male', 'Addis Ababa, Bole', '2025-03-18 15:18:55', '2025-03-18 15:18:55', 3),
(42, 'siltein@gmail.com', '$2y$12$4KuzwvCnAAANCIXSUZAgjez29WsJc7UN9BCbJN1V7Eyn3c8GiNNWS', 8, 'Habtamu', 'Gashu', 'policesilteI@gmail.com', 'user_images/qRZuTOOjhpKmbkum0w6nK0iZzI55jxO0q9pSjVJT.png', '0909029295', '2025-03-26', 'male', 'Bahir dar\r\nBahir dar,Ethiopia', '2025-03-18 17:46:57', '2025-03-18 17:46:57', 11),
(43, 'worabepolice@gmail.com', '$2y$12$cv/J4YJ5NPgiHUzKYrNAmeBbz1vYrpwypCAPL3EEWeDK53D0Pcr5S', NULL, 'ato belete', 'Gashu', 'worabepolice@gmail.com', 'user_images/DCJg9bnaNxm9zEqNp1jj9X28aTwqBub8ur9ptM89.jpg', '0909029295', '2025-03-19', 'male', 'Bahir dar\r\nBahir dar,Ethiopia', '2025-03-18 18:55:00', '2025-03-22 06:37:27', 6),
(50, 'systemmm@gmail.com', '$2y$12$b38ZswU8ANFAEgH4p7NTZuKb1O4sMkBhbT8cSH2Rt/wuhw.4euL1C', 3, 'Habtamu', 'Gashu', 'Habtshaxx@gmail.com', 'user_images/msesHXoWgm9h3XgEFffALI48GaGWij6uZyROx1GO.jpg', '0909029295', '2025-03-06', 'male', 'Ethiopia , Amhara Bahir Dar, Amhara-Mirab Gojam', '2025-03-30 21:48:23', '2025-03-30 22:23:08', 5),
(51, 'central@gmail.com', '$2y$12$cOF4CjekXagW.ukYjXb.6urD3zD6efSt/9bugfgUHsWOoP.4rWdQC', 1, 'Habtamu', 'Gashu', 'Habtsha2021zz@gmail.com', 'user_images/8C2VnRFEJWwNVtKYQQs9I7IS4wH0Ko1oPCpbdJs9.png', '0909029295', '2025-03-15', 'male', 'Addis Ababa, Bole', '2025-03-30 22:57:39', '2025-03-30 22:57:39', 18),
(52, 'centrabhal@gmail.com', '$2y$12$l6rwiwi4UJEwtG5bPk71EegG7N.ipfYpDmtW9XX04e5hmFbg/Y1cu', 1, 'Habtamu', 'Gashu', 'Habtshssa2021@gmail.com', 'user_images/iHrWORaaetu94Y2gHTLSdaocGANmAphEms2OHqsh.png', '0909029295', '2025-03-10', 'male', 'Dire Dawa', '2025-03-30 23:06:33', '2025-03-30 23:06:33', 22),
(53, 'centralllll@gmail.com', '$2y$12$7eaTiOOxYRxa7EhMYkLSLeU/XsIUQpTM97ShRxrZlTbgtCwvcQ8iG', 1, 'Habtamu', 'Gashu', 'Habtsssha2021@gmail.com', 'user_images/GhmFDfAwxNCh64vJT7NLd4T9qoBPCdBW4NLbvEVm.png', '0909029295', '2025-03-14', 'male', 'Addis Ababa, Bole', '2025-03-30 23:10:04', '2025-03-30 23:10:04', 6),
(61, 'cefgfhgfhfntral@gmail.com', '$2y$12$Oh5ERTxgnO7un5JxGFwEruYR0IApOVHuTzQEVFwJP0rr4eEOhcbt.', 1, 'Habtamu', 'Gashu', 'syssss@gmail.com', 'user_images/cVeVFyE4oeBhJFgeDr4GisUMXsrU1eHovtrH4WqZ.jpg', '0909029295', '2025-03-29', 'male', 'Addis Ababa, Bole', '2025-03-31 20:20:02', '2025-03-31 20:20:38', 20),
(62, 'sdfasdf@gmail.com', '$2y$12$3Z6GcfOJgWqAQToIRjl4KOCgCNBp866NZyomroR6.bslK10OAhOG2', 1, 'Habtamu', 'Gashu', 'Habtsha2021@gmail.com', 'user_images/OqCXL7njmU8GhkeswczPZ9icKYAhT8xlqZpJW146.png', '0909029295', '2025-03-11', 'male', 'Addis Ababa, Bole', '2025-03-31 20:23:20', '2025-03-31 20:23:20', 19),
(63, 'worabdde@gmail.com', '$2y$12$lW7IkICb.pvKUbYs4kpnPOZIjYu9NlQENV/3PfOEyy5dBdFmq9z9.', 2, 'Habtamu', 'Gashu', 'worabeinspector@gmail.com', 'user_images/vghnBWAQcp5z2hDXfbpDSBg4FL1F4p9qfyY2FVs3.jpg', '0909029295', '2025-03-26', 'male', 'Bahir dar\r\nBahir dar,Ethiopia', '2025-03-31 20:29:59', '2025-03-31 20:30:28', 6),
(64, 'kembatains@gmail.com', '$2y$12$HbJWX5DrY3mEVlLL/NjtXeJTaNnVVqMDZ4HcWBj3X1lueVxnJH9z.', 2, 'Habtamu', 'Gashu', 'kembatains@gmail.com', 'user_images/o26CcNIDVbkwNLCF1jC3qu0IIzXsMwrQvuAGykug.jpg', '0909029295', '2025-03-12', 'male', 'Bahir dar\r\nBahir dar,Ethiopia', '2025-04-01 01:40:07', '2025-04-01 01:40:07', 5),
(65, 'wolkite@gmail.com', '$2y$12$8meOqFzPEz1.iRSaDZOzH.f0vV0954QldaKx1H5ADuegh4MvkCHAm', 1, 'wolkite', 'Gashu', 'wolkite@gmail.com', 'user_images/vRFvzL5ZTUn5iOvYVlAAx9G4gmHqsMJzTlgBFDby.jpg', '0909029295', '2025-04-17', 'male', 'Addis Ababa, Bole', '2025-04-01 15:47:43', '2025-04-01 15:47:43', 1),
(68, 'policeoficer@gmail.com', '$2y$12$gN4X.Va8WxLAIIzyUNrhqOg0mhvW9WxLGO9MjnXlJEfQ.UNX.03za', 8, 'abushi', 'Gashu', 'abush@gmail.com', 'user_images/lsm4LbsBMBE7zmU0yzhPmlomUtTvcFGZgSFudO7O.jpg', '0909029295', '2025-04-17', 'male', 'Bahir dar\r\nBahir dar,Ethiopia', '2025-04-03 22:03:38', '2025-04-03 22:03:38', 5),
(69, 'systemSSSSmm@gmail.com', '$2y$12$dei8dFyl2yDkQ/OnIS/bwO6Z/aA1pkndabg4YtX4uIP0qmV6QmD1a', 5, 'Habtamu', 'Gashu', 'Habtsha202SSSS1@gmail.com', 'user_images/YSxTn75RTo0KsWmLJz12bfyI8olpopPbvDONx8a2.jpg', '0909029295', '2025-04-09', 'female', 'Ethiopia , Amhara Bahir Dar, Amhara-Mirab Gojam', '2025-04-04 17:35:37', '2025-04-04 17:35:37', 5),
(70, 'sysgurage@gmail.com', '$2y$12$P0tJW48W4Yvrj8dy2CR2Ze88dOcYEP6jZ5q.VTIdZw6QMe7CSvHG2', 1, 'Randy', 'Bartoletti', 'your.email+fakedata93660@gmail.com', 'user_images/zgfjKAUquBa7aMapDzTSyzmVuwgP7J2GyIbeK6E1.jpg', '766-369-0337', '2025-04-11', 'female', 'Bahir Dar, Amhara-Mirab Gojam', '2025-04-04 20:27:29', '2025-04-04 20:27:52', 2),
(71, 'displine@gmail.com', '$2y$12$6UqFp.iaxbHdwZyjSuntOOY10t6u1BJKpN3Jt8d0p9A2Z436jzErO', 11, 'Chadrick', 'Hodkiewicz', 'your.email+fakedata54427@gmail.com', 'user_images/jyAVWE5oTXquKodoFsl1JqWEsuGoyjBn0xZSAC23.png', '490-310-8342', '2024-10-18', 'female', '589 Janae Ferry', '2025-04-04 20:48:13', '2025-04-04 20:48:13', 5),
(72, 'securityyoff@gmail.com', '$2y$12$CuDI9EsNHQ6oE.Kl2PTY0e2a6vgmUBlHRkv48aoipi7t.2mFqw2au', 10, 'Carter', 'Smith', 'kafogawa@mailinator.com', 'user_images/MPJjz3OfiUgbJMH5LY6oqOyfY7BGmCWX9989V8b3.png', '+1 (566) 758-1614', '2005-03-19', 'female', 'Numquam duis nostrud', '2025-04-04 21:04:53', '2025-04-04 21:04:53', 5),
(73, 'medicalforkem@gmail.com', '$2y$12$kaK9e2fReQ51DAqqiCbmuuZeBXx9gTdwkI2U7/D/PmgLvRvhdlQyi', 9, 'Yuri', 'Logan', 'nafebybi@mailinator.com', 'user_images/rjJiUtfjBP1fLG9wJX0cpW6xtUg4Rt5d5Zd3GIbf.jpg', '+1 (461) 548-2899', '2000-04-30', 'male', 'Voluptatem aspernat', '2025-04-04 21:16:54', '2025-04-04 21:16:54', 5),
(74, 'tr@gmail.com', '$2y$12$miJ68fPKhS7LLZP2ZKthSuxb3ip8TQi1.Hmljq.PDiJ0DM9gju64W', 6, 'Ronan', 'Briggs', 'meguk@mailinator.com', 'user_images/pV4F6LAXd1ppXrvQ6icYSynlMtL6kjsca6YiNuDI.jpg', '+1 (128) 264-6554', '1986-11-06', 'male', 'Dolor et eum est re', '2025-04-04 21:20:34', '2025-04-04 21:31:15', 5),
(75, 'Angelita Corwin', '$2y$12$hjkbh3HLpjK0fWEnigiO1.ifF5WbkCTR7SW237AEjpjHk.ygR04QK', 8, 'Rogelio', 'Hansen', 'your.email+fakedata33587@gmail.com', 'user_images/naR0KGnKVHjHvqtPSKmJjPDHNmxckbZw6aPud60H.jpg', '995-867-0637', '2025-09-28', 'male', '888 Rubye Ramp', '2025-04-06 20:00:23', '2025-04-06 20:00:23', 5),
(76, 'facirewyn', '$2y$12$akCSTUVe.uk9rXqhqgSgGuubzeeVYaRFo8ZxRc.7AGMl8RQMbzklW', 8, 'Elaine', 'Oneill', 'giwarexy@mailinator.com', 'user_images/kklHWy7DCtgLMLmI6O5dLuzzVBgcwyCexfNWcw2C.jpg', '+1 (775) 637-2108', '1993-12-20', 'male', 'Dignissimos dolor do', '2025-04-06 20:09:51', '2025-04-06 20:09:51', 6),
(77, 'lol', '$2y$12$vo82.5Z5Ko9coM.6i2pcp.YcGqgNR3hqT17mowHao3Yo4kuWdyN/q', 4, 'SOME ONE', 'SOME', 'hab@gmail.com', NULL, '121221212', '2025-04-03', 'male', 'dasdsfasdf', '2025-04-07 00:17:52', '2025-04-07 00:17:52', 20);

-- --------------------------------------------------------

--
-- Table structure for table `backups`
--

CREATE TABLE `backups` (
  `id` int(11) NOT NULL,
  `initiated_by` int(11) DEFAULT NULL,
  `backup_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `backup_status` enum('in_progress','completed','failed') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certification_records`
--

CREATE TABLE `certification_records` (
  `id` int(11) NOT NULL,
  `prisoner_id` int(11) DEFAULT NULL,
  `issued_by` int(11) DEFAULT NULL,
  `certification_type` enum('job_completion','training_program_completion') DEFAULT NULL,
  `certification_details` text DEFAULT NULL,
  `issued_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('issued','revoked') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_assignments`
--

CREATE TABLE `job_assignments` (
  `id` int(11) NOT NULL,
  `prisoner_id` int(11) DEFAULT NULL,
  `assigned_by` int(11) DEFAULT NULL,
  `job_title` varchar(100) DEFAULT NULL,
  `job_description` text DEFAULT NULL,
  `assigned_date` date DEFAULT NULL,
  `status` enum('active','completed','terminated') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_assignments`
--

INSERT INTO `job_assignments` (`id`, `prisoner_id`, `assigned_by`, `job_title`, `job_description`, `assigned_date`, `status`, `created_at`, `updated_at`) VALUES
(127, 336, 74, 'Maintenance Worker', 'mmm', '2025-05-08', 'active', '2025-04-05 04:18:11', '2025-04-05 04:18:11'),
(128, 351, 68, 'Cook', 'jg', '2025-04-15', 'active', '2025-04-06 21:31:26', '2025-04-06 21:31:26'),
(129, 2, NULL, 'Maintenance Worker', 'ggg', '2025-04-24', 'active', '2025-04-07 16:36:22', '2025-04-07 16:36:22'),
(130, 3, NULL, 'Cook', 'gg', '2025-04-23', 'active', '2025-04-07 16:36:29', '2025-04-07 16:36:29'),
(131, 2, NULL, 'Cook', 'sdfasdadfasdf', '2025-04-16', 'active', '2025-04-10 15:59:52', '2025-04-10 15:59:52');

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lawyers`
--

CREATE TABLE `lawyers` (
  `lawyer_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `contact_info` varchar(255) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `law_firm` varchar(255) NOT NULL,
  `license_number` varchar(100) NOT NULL,
  `cases_handled` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `prison` int(11) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lawyers`
--

INSERT INTO `lawyers` (`lawyer_id`, `first_name`, `last_name`, `date_of_birth`, `contact_info`, `email`, `password`, `law_firm`, `license_number`, `cases_handled`, `created_at`, `updated_at`, `prison`, `profile_image`) VALUES
(11, 'tebka', 'new', '2025-03-06', 'hab@gma.co', 'hab@gma.co', 'aa', 'aa', 'aa', 1, '2025-03-15 01:07:50', '2025-03-18 10:25:57', 1, NULL),
(12, 'tebk', 'Gashu', '2025-03-15', 'sscsc', 'law@gmail.com', '$2y$12$tjcGCUY3TbozEkVyfsVfB.rTf2cQdN/N/2iQN761WX.E2HMFjRGvG', 'scsc', '1212', 33, '2025-03-15 05:59:22', '2025-03-29 02:10:16', 5, NULL),
(14, 'profesor', 'ss', '2025-03-05', 'fasfasdf', 'law2@gmail.com', '$2y$12$tkA5hr8nip0yP5m0238oNuVhlf4BR0nEw7GgGVJ1c6bvjloa8RMaW', '1234', '213', 2, '2025-03-15 19:41:12', '2025-03-18 14:53:10', 11, NULL),
(17, 'profesor', 'ss', '2025-03-05', 'fasfasdf', 'law3@gmail.com', '$2y$12$v5z/lWGApEqqA8pQx8K2O.Vm0Xp/NLZXppjlOVKdM5uflY4QOQMoO', '123455', '55213', 2, '2025-03-15 19:42:06', '2025-03-18 14:53:15', 2, NULL),
(20, 'Habtamu', 'Gashu', '2025-03-20', '222q22', 'bosss1@gmail.com', '$2y$12$7fmr/vuCS4/iWAgpLjNnk.R2OgRzhceE3VkOZeXkOVYMXftDU4k2O', 'scsc', '1212as', 22, '2025-03-18 06:14:22', '2025-03-18 14:53:27', 3, NULL),
(25, 'Habtamu', 'Gashu', '2025-03-08', '2341234', 'worabelaw@gmail.com', '$2y$12$U0gwbeCDDYhOZtnYkWL3Neiyv9j/ufsoEFCA.J5Ji.XhCQQxf8YJG', '2323', '323', 2, '2025-03-18 19:37:55', '2025-03-31 16:38:51', 6, NULL),
(26, 'Habtamu', 'Gashu', '2025-03-15', 'fasfasdf', 'worabelaw2@gmail.com', '$2y$12$Li3x0G7/L5c9sQjlZs9n3OO62BK61BBGEcyNczYXE3hkt.L.WIfl.', 'scsc', '5555213', 3, '2025-03-19 23:49:37', '2025-03-19 23:49:37', NULL, NULL),
(28, 'Habtamu', 'rGashu', '2025-03-13', 'fasfasdf', 'kembatalawrr@gmail.com', '$2y$12$qbDMsVgFIyFT1B4LFshEW.jPHHr3ZehfMTX/AWLUo86bSuIS4xagm', 'scscff', '121244', 12344, '2025-03-22 23:47:32', '2025-03-22 23:47:32', NULL, NULL),
(29, 'Habtamu', 'Gashu', '2025-03-05', 'fasfasdf', 'kembatainlll@gmail.com', '$2y$12$.R5AQJ2InypQrE5pk5e7kewRB6PDxFkhgrdGkTAafWaUrht4puHea', 'scsc33', '12123', 22, '2025-03-22 23:48:18', '2025-03-22 23:48:18', NULL, NULL),
(30, 'Habtamu', 'Gashu', '2025-03-05', 'fasfasdf', 'kembatain33lll@gmail.com', '$2y$12$0aCeP3wznBAVKzzBflLJS.vlIJwhe1BEctNdyL17tP8wDi2/IlfaO', 'scsc333', '121233', 322, '2025-03-22 23:48:30', '2025-03-22 23:48:30', NULL, NULL),
(32, 'Habtamu', 'Gashu', '2025-03-13', 'fasfasdf', 'bosssss@gmail.com', '$2y$12$xqhsxcwccFDMhmodHdVQzeMVEiXhrFcVcQ307aLfyQtMS3heVR3kS', '123422ss', '1212ssss', 2, '2025-03-23 03:36:16', '2025-03-23 03:36:16', NULL, NULL),
(39, 'Habtamu', 'Gashu', '2025-03-13', 'ss', 'bosjjks@gmail.com', '$2y$12$TGqfxkPiJrdmD7DnsQ3U.eQey56FFM6k7h2VMn0IoAB44iIBvHjWW', 'jh', 'u98;', 77300, '2025-03-30 22:13:03', '2025-03-31 19:29:35', 10, NULL),
(41, 'Habtamu', 'Gashu', '2025-03-21', 'llllmqowpodasd', 'law222@gmail.com', '$2y$12$qu5o1IGcffqkpWeQiK5Lzez1ln4maMliXOtpxMipXgKnY.bQjg7kW', '12342277044s12121', '1212121212', 21, '2025-04-01 02:58:14', '2025-04-01 03:00:03', 6, NULL),
(43, 'Habtamu', 'Gashu', '2025-03-14', 'llllm32ss', 'sdlksdss@gmail.com', '$2y$12$.QdZusxc.ydfnwHdIchBReu7uAn.UFGUlYiMP/Bv4uYl3/LsEBSTG', '123422772', '0s0s121277000002', 232, '2025-04-01 03:06:30', '2025-04-01 03:06:30', 6, NULL),
(46, 'adisu yebelu', 'Gashu', '2025-04-12', '0909029295', 'kembatlaw@gmail.com', '$2y$12$G1RzDTJMPuiMrzDYLdUPqODO9Y3BC1L8jPBUN6/jxLl3Rj27ePCsm', '23', '3223', 32, '2025-04-04 17:16:35', '2025-04-04 17:16:35', 5, 'lawyer_profiles/yggg0FqMNOnwNntgsXWC3rqMoqohz2mkLoXQM9Yk.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `lawyer_appointments`
--

CREATE TABLE `lawyer_appointments` (
  `id` int(11) NOT NULL,
  `prisoner_id` int(11) DEFAULT NULL,
  `lawyer_id` int(11) DEFAULT NULL,
  `appointment_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('scheduled','completed','cancelled') DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lawyer_appointments`
--

INSERT INTO `lawyer_appointments` (`id`, `prisoner_id`, `lawyer_id`, `appointment_date`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(215, 4, 12, '2025-03-11 04:00:00', 'scheduled', 'asdfasd', '2025-03-15 20:17:38', '2025-03-15 20:17:38'),
(216, 4, 12, '2025-03-26 04:00:00', 'scheduled', 'this neads to be handeled t', '2025-03-15 20:22:24', '2025-03-15 20:22:24'),
(217, 335, 12, '2025-03-12 04:00:00', 'scheduled', 'for test', '2025-03-15 20:30:15', '2025-03-15 20:30:15'),
(218, 335, 12, '2025-02-26 05:00:00', 'scheduled', 'dd', '2025-03-15 20:38:35', '2025-03-15 20:38:35'),
(219, 340, 22, '2025-05-03 04:00:00', 'scheduled', 'uhhfoasdf', '2025-04-05 02:08:50', '2025-04-05 02:08:50'),
(220, 342, 22, '2025-04-26 04:00:00', 'scheduled', 'uisdiausdasd', '2025-04-05 02:09:22', '2025-04-05 02:09:22');

-- --------------------------------------------------------

--
-- Table structure for table `lawyer_prisoner_assignment`
--

CREATE TABLE `lawyer_prisoner_assignment` (
  `assignment_id` int(11) NOT NULL,
  `prisoner_id` int(11) NOT NULL,
  `assignment_date` date NOT NULL,
  `assigned_by` int(11) NOT NULL,
  `lawyer_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `prison_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lawyer_prisoner_assignment`
--

INSERT INTO `lawyer_prisoner_assignment` (`assignment_id`, `prisoner_id`, `assignment_date`, `assigned_by`, `lawyer_id`, `created_at`, `updated_at`, `prison_id`) VALUES
(22, 335, '2025-03-13', 40, 12, '2025-03-15 01:10:04', '2025-03-18 15:49:26', 6),
(33, 4, '2025-03-12', 16, 14, '2025-03-15 01:31:54', '2025-03-15 21:37:56', NULL),
(35, 337, '2025-03-13', 40, 12, '2025-03-18 19:59:42', '2025-03-18 16:02:52', 6),
(37, 336, '2025-03-12', 37, 12, '2025-03-22 23:43:25', '2025-03-22 23:43:25', 5),
(38, 336, '2025-03-29', 37, 12, '2025-03-22 23:43:53', '2025-03-22 23:43:53', 5),
(41, 1, '2025-03-06', 22, 39, '2025-03-31 14:03:58', '2025-03-31 14:03:58', 10),
(42, 1, '2025-03-06', 22, 39, '2025-03-31 19:29:53', '2025-03-31 19:29:53', 10),
(43, 344, '2025-02-14', 64, 12, '2025-04-01 01:41:44', '2025-04-01 01:41:44', 5);

-- --------------------------------------------------------

--
-- Table structure for table `medical_appointments`
--

CREATE TABLE `medical_appointments` (
  `id` int(11) NOT NULL,
  `prisoner_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `appointment_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `diagnosis` text DEFAULT NULL,
  `treatment` text DEFAULT NULL,
  `status` enum('scheduled','completed','cancelled') DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `prison_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medical_appointments`
--

INSERT INTO `medical_appointments` (`id`, `prisoner_id`, `doctor_id`, `appointment_date`, `diagnosis`, `treatment`, `status`, `created_by`, `created_at`, `updated_at`, `prison_id`) VALUES
(212, 1, 14, '2025-03-14 23:13:50', 'asdfsdfasdf', 'asdfasd', 'scheduled', 14, '2025-03-19 23:13:50', '2025-03-19 23:13:50', NULL),
(213, 4, 73, '2025-04-06 14:42:05', 'Doloremque quam quas impedit non esse ea iusto necessitatibus.', 'Veritatis deleniti tempore quia in adipisci architecto beatae totam.', 'scheduled', 73, '2025-04-06 14:42:05', '2025-04-06 14:42:05', NULL),
(214, 3, 73, '2025-04-11 15:11:00', 'xxx', 'xx', 'completed', 73, '2025-04-06 19:09:55', '2025-04-06 19:09:55', NULL),
(215, 2, 73, '2025-04-09 15:21:00', 'aa', 'aa', 'cancelled', 73, '2025-04-06 19:18:21', '2025-04-06 19:18:21', NULL),
(216, 336, 73, '2025-04-07 16:25:57', 'aaa', 'aaaa', 'completed', 73, '2025-04-06 19:20:49', '2025-04-07 20:25:57', 5),
(217, 348, 68, '2025-11-13 16:50:00', 'Corrupti quibusdam', 'Quis et aut voluptat', 'completed', 68, '2025-04-06 21:34:46', '2025-04-06 21:34:46', NULL),
(218, 354, 73, '2025-04-07 15:54:57', 'sss', 'ss', 'completed', 73, '2025-04-07 19:53:29', '2025-04-07 19:54:57', 5),
(219, 353, 73, '2025-04-07 15:58:53', 'sss', 'ss', 'completed', 73, '2025-04-07 19:57:29', '2025-04-07 19:58:53', 5),
(220, 344, 73, '2025-04-08 10:23:43', 'sss', 'ss', 'completed', 73, '2025-04-07 19:58:21', '2025-04-08 14:23:43', 5);

-- --------------------------------------------------------

--
-- Table structure for table `medical_reports`
--

CREATE TABLE `medical_reports` (
  `id` int(11) NOT NULL,
  `prisoner_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `diagnosis` text DEFAULT NULL,
  `treatment` text DEFAULT NULL,
  `medications` text DEFAULT NULL,
  `report_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `appointment_id` int(11) DEFAULT NULL,
  `follow_up_date` date DEFAULT NULL,
  `notes` text NOT NULL,
  `follow_up` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medical_reports`
--

INSERT INTO `medical_reports` (`id`, `prisoner_id`, `doctor_id`, `diagnosis`, `treatment`, `medications`, `report_date`, `created_at`, `updated_at`, `appointment_id`, `follow_up_date`, `notes`, `follow_up`) VALUES
(1, 336, 73, 'aaa', 'aaaa', 'aa', '2025-04-07 04:00:00', '2025-04-07 19:03:50', '2025-04-07 19:03:50', 216, NULL, 'aa', '0'),
(2, 336, 73, 'aaa', 'aaaa', 'aa', '2025-04-07 04:00:00', '2025-04-07 19:04:54', '2025-04-07 19:04:54', 216, NULL, 'aa', '0'),
(3, 344, 73, 'ee', 'ee', 'ee', '2025-04-07 04:00:00', '2025-04-07 19:06:55', '2025-04-07 19:06:55', NULL, NULL, 'ee', '0'),
(4, 344, 73, 'ee', 'ee', 'ee', '2025-04-07 04:00:00', '2025-04-07 19:07:46', '2025-04-07 19:07:46', NULL, NULL, 'ee', '0'),
(5, 344, 73, 'Fugit quo esse.', '232 Margarita Crest', 'Illo ea necessitatibus.', '2024-06-01 04:00:00', '2025-04-07 19:08:34', '2025-04-07 19:08:34', NULL, '2026-03-19', '337', '1'),
(6, 353, 73, 'Iste quos non eos.', '868 Sigurd Squares', 'Nulla magnam delectus occaecati adipisci aliquid pariatur.', '2024-07-13 04:00:00', '2025-04-07 19:14:20', '2025-04-07 19:14:20', NULL, NULL, '323', '0'),
(7, 336, 73, 'aaa', 'aaaa', 'Voluptatem dolorem a', '2025-04-07 04:00:00', '2025-04-07 19:15:16', '2025-04-07 19:15:16', 216, '2025-04-26', 'Do delectus error m', '1'),
(8, 344, 73, 'kk', 'kk', 'kk', '2025-04-25 04:00:00', '2025-04-07 19:15:31', '2025-04-07 19:15:31', NULL, NULL, 'kk', '0'),
(9, 354, 73, 'sss', 'ssaas', 'as', '2025-04-07 04:00:00', '2025-04-07 19:54:57', '2025-04-07 19:54:57', 218, NULL, 'as', '0'),
(10, 353, 73, 'sss', 'ss', 'sd', '2025-04-17 04:00:00', '2025-04-07 19:58:53', '2025-04-07 19:58:53', 219, '2025-04-18', 'sd', '1'),
(11, 336, 73, 'aaa', 'aaaa', 'yyy', '2025-04-07 04:00:00', '2025-04-07 20:25:57', '2025-04-07 20:25:57', 216, NULL, 'yyy', '0'),
(12, 344, 73, 'sss.d', 'sscccccc', 'ccc', '2025-04-10 04:00:00', '2025-04-08 14:23:43', '2025-04-08 14:23:43', 220, NULL, 'cc', '0');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `new_visiting_requests`
--

CREATE TABLE `new_visiting_requests` (
  `id` int(11) NOT NULL,
  `visitor_id` int(11) DEFAULT NULL,
  `requested_date` date DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `prisoner_firstname` varchar(255) DEFAULT NULL,
  `prisoner_middlename` varchar(255) DEFAULT NULL,
  `prisoner_lastname` varchar(255) DEFAULT NULL,
  `prison_id` int(11) DEFAULT NULL,
  `requested_time` time NOT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `new_visiting_requests`
--

INSERT INTO `new_visiting_requests` (`id`, `visitor_id`, `requested_date`, `status`, `approved_by`, `created_at`, `updated_at`, `prisoner_firstname`, `prisoner_middlename`, `prisoner_lastname`, `prison_id`, `requested_time`, `note`) VALUES
(1, 16, '2025-04-23', 'approved', NULL, '2025-04-10 16:33:13', '2025-04-10 20:48:39', 'Habtamu', 'Bitew', 'Gashu', 1, '08:33:00', NULL),
(2, 16, '2025-04-23', 'pending', NULL, '2025-04-10 16:34:28', '2025-04-10 21:18:18', 'Habtamu', 'Bitew', 'Gashu', 1, '08:33:00', NULL),
(3, 16, '2025-04-18', 'rejected', NULL, '2025-04-10 16:34:42', '2025-04-10 15:14:38', 'Habtamu', 'Bitew', 'Gashu', 19, '11:34:00', 'this prisoner is not found '),
(4, 16, '2025-04-18', 'pending', NULL, '2025-04-10 16:39:22', '2025-04-11 13:08:01', 'Habtamu', 'Bitew', 'Gashu', 11, '20:41:00', 'kk'),
(5, 16, '2025-04-11', 'pending', NULL, '2025-04-10 16:39:49', '2025-04-10 19:02:41', 'Habtamu', 'Bitew', 'Gashu', 1, '08:41:00', 'dd'),
(6, 16, '2025-04-17', 'pending', NULL, '2025-04-10 18:29:05', '2025-04-10 20:48:22', 'ato', 'belete', 'Gashu', 6, '10:31:00', 'heloo this is the'),
(7, 16, '2025-04-11', 'approved', NULL, '2025-04-10 19:06:04', '2025-04-10 20:48:32', 'Habtamu', 'Bitew', 'Gashu', 20, '11:09:00', NULL),
(8, 16, '2025-04-24', 'pending', NULL, '2025-04-10 19:08:18', '2025-04-10 19:08:18', 'Habtamu', 'Bitew', 'Gashu', 17, '03:08:00', NULL),
(9, 16, '2025-04-10', 'pending', NULL, '2025-04-10 19:08:39', '2025-04-10 19:08:39', 'Habtamu', 'Bitew', 'Gashu', 6, '11:08:00', NULL),
(10, 17, '2025-04-25', 'rejected', NULL, '2025-04-10 19:34:53', '2025-04-10 15:40:49', 'Habtamu', 'Bitew', 'Gashu', 6, '00:34:00', 'fssf'),
(11, 17, '2025-04-10', 'approved', NULL, '2025-04-10 19:41:40', '2025-04-10 16:34:30', 'Habtamu', 'Bitew', 'Gashu', 6, '11:18:00', NULL),
(12, 17, '2025-04-10', 'pending', NULL, '2025-04-10 19:42:10', '2025-04-10 19:42:10', 'Habtamu', 'Bitew', 'Gashu', 22, '11:42:00', NULL),
(13, 16, '2025-04-18', 'pending', NULL, '2025-04-11 13:07:11', '2025-04-11 13:07:11', 'Habtamu', 'Bitew', 'Gashu', 5, '05:07:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` enum('unread','read') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `prison_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `account_id`, `message`, `status`, `created_at`, `updated_at`, `prison_id`) VALUES
(21374, 16, 'New request: medical_assistance', 'unread', '2025-03-31 20:57:24', '2025-03-31 20:57:24', 6),
(21375, 22, 'New request: medical_assistance', 'unread', '2025-03-31 20:57:24', '2025-03-31 20:57:24', 6),
(21376, 25, 'New request: medical_assistance', 'unread', '2025-03-31 20:57:24', '2025-03-31 20:57:24', 6),
(21377, 63, 'New request: medical_assistance', 'read', '2025-03-31 20:57:24', '2025-04-04 15:31:30', 6),
(21378, 14, 'New request: appeal_filing', 'unread', '2025-04-01 01:44:25', '2025-04-01 01:44:25', 5),
(21379, 16, 'New request: appeal_filing', 'unread', '2025-04-01 01:44:25', '2025-04-01 01:44:25', 5),
(21380, 22, 'New request: appeal_filing', 'unread', '2025-04-01 01:44:25', '2025-04-01 01:44:25', 5),
(21381, 25, 'New request: appeal_filing', 'unread', '2025-04-01 01:44:25', '2025-04-01 01:44:25', 5),
(21382, 63, 'New request: appeal_filing', 'unread', '2025-04-01 01:44:25', '2025-04-01 01:44:25', 5),
(21383, 64, 'New request: appeal_filing', 'unread', '2025-04-01 01:44:25', '2025-04-01 01:44:25', 5),
(21384, 14, 'New request: prison_transfer', 'unread', '2025-04-01 04:24:44', '2025-04-01 04:24:44', 5),
(21385, 16, 'New request: prison_transfer', 'unread', '2025-04-01 04:24:44', '2025-04-01 04:24:44', 5),
(21386, 22, 'New request: prison_transfer', 'unread', '2025-04-01 04:24:44', '2025-04-01 04:24:44', 5),
(21387, 25, 'New request: prison_transfer', 'unread', '2025-04-01 04:24:44', '2025-04-01 04:24:44', 5),
(21388, 63, 'New request: prison_transfer', 'unread', '2025-04-01 04:24:44', '2025-04-01 04:24:44', 5),
(21389, 64, 'New request: prison_transfer', 'unread', '2025-04-01 04:24:44', '2025-04-01 04:24:44', 5),
(21390, 14, 'New request: case_review', 'unread', '2025-04-05 02:05:57', '2025-04-05 02:05:57', 5),
(21391, 16, 'New request: case_review', 'unread', '2025-04-05 02:05:57', '2025-04-05 02:05:57', 5),
(21392, 22, 'New request: case_review', 'unread', '2025-04-05 02:05:58', '2025-04-05 02:05:58', 5),
(21393, 25, 'New request: case_review', 'unread', '2025-04-05 02:05:58', '2025-04-05 02:05:58', 5),
(21394, 63, 'New request: case_review', 'unread', '2025-04-05 02:05:58', '2025-04-05 02:05:58', 5),
(21395, 64, 'New request: case_review', 'unread', '2025-04-05 02:05:58', '2025-04-05 02:05:58', 5),
(21396, 14, 'New request: prison_transfer', 'unread', '2025-04-05 02:06:20', '2025-04-05 02:06:20', 5),
(21397, 16, 'New request: prison_transfer', 'unread', '2025-04-05 02:06:20', '2025-04-05 02:06:20', 5),
(21398, 22, 'New request: prison_transfer', 'unread', '2025-04-05 02:06:20', '2025-04-05 02:06:20', 5),
(21399, 25, 'New request: prison_transfer', 'unread', '2025-04-05 02:06:20', '2025-04-05 02:06:20', 5),
(21400, 63, 'New request: prison_transfer', 'unread', '2025-04-05 02:06:20', '2025-04-05 02:06:20', 5),
(21401, 64, 'New request: prison_transfer', 'unread', '2025-04-05 02:06:20', '2025-04-05 02:06:20', 5),
(21402, 14, 'New request: case_review', 'unread', '2025-04-05 04:38:42', '2025-04-05 04:38:42', 5),
(21403, 16, 'New request: case_review', 'unread', '2025-04-05 04:38:42', '2025-04-05 04:38:42', 5),
(21404, 22, 'New request: case_review', 'unread', '2025-04-05 04:38:42', '2025-04-05 04:38:42', 5),
(21405, 25, 'New request: case_review', 'unread', '2025-04-05 04:38:42', '2025-04-05 04:38:42', 5),
(21406, 63, 'New request: case_review', 'unread', '2025-04-05 04:38:42', '2025-04-05 04:38:42', 5),
(21407, 64, 'New request: case_review', 'unread', '2025-04-05 04:38:42', '2025-04-05 04:38:42', 5),
(21408, 14, 'New request: medical_assistance', 'unread', '2025-04-06 18:46:08', '2025-04-06 18:46:08', 6),
(21409, 16, 'New request: medical_assistance', 'unread', '2025-04-06 18:46:08', '2025-04-06 18:46:08', 6),
(21410, 22, 'New request: medical_assistance', 'unread', '2025-04-06 18:46:08', '2025-04-06 18:46:08', 6),
(21411, 25, 'New request: medical_assistance', 'unread', '2025-04-06 18:46:08', '2025-04-06 18:46:08', 6),
(21412, 63, 'New request: medical_assistance', 'read', '2025-04-06 18:46:08', '2025-04-07 01:24:44', 6),
(21413, 64, 'New request: medical_assistance', 'unread', '2025-04-06 18:46:08', '2025-04-06 18:46:08', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prisoners`
--

CREATE TABLE `prisoners` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `marital_status` enum('single','married','divorced','widowed') DEFAULT NULL,
  `crime_committed` text DEFAULT NULL,
  `status` enum('active','released','transferred') DEFAULT NULL,
  `time_serve_start` date DEFAULT NULL,
  `time_serve_end` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `emergency_contact_name` varchar(100) DEFAULT NULL,
  `emergency_contact_relation` varchar(50) DEFAULT NULL,
  `emergency_contact_number` varchar(20) DEFAULT NULL,
  `inmate_image` text DEFAULT NULL,
  `prison_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `room_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prisoners`
--

INSERT INTO `prisoners` (`id`, `first_name`, `middle_name`, `last_name`, `dob`, `gender`, `marital_status`, `crime_committed`, `status`, `time_serve_start`, `time_serve_end`, `address`, `emergency_contact_name`, `emergency_contact_relation`, `emergency_contact_number`, `inmate_image`, `prison_id`, `created_at`, `updated_at`, `room_id`) VALUES
(1, 'prisHabtamu', 'Bitew', 'Gashu', '2025-03-13', 'male', 'single', 'Assault', 'released', '2025-03-12', '2025-03-11', 'Bahir dar\r\nBahir dar,Ethiopia', 'Habtamu Gashu', 'dsdc', '0909029295', 'inmate_images/I744sa3Cr2eZCl51ywSxSWeWkjuZislU3Eqipp5I.png', 10, '2025-03-09 05:50:04', '2025-03-09 05:50:04', NULL),
(2, 'Habtamu', 'Bitew', 'Gashu', '2025-03-06', NULL, 'single', 'Drug Possession', 'active', '2025-03-13', '2025-03-12', 'Bahir dar\r\nBahir dar,Ethiopia', 'Habtamu Bitew Gashu', 'dddd', '0909029295', 'inmate_images/i1svZGblysxVKfHU6KFA7yML642kt5kka576h4ak.png', NULL, '2025-03-10 03:30:51', '2025-03-15 17:41:31', 6),
(3, 'Habtamu', 'Bitew', 'Gashu', '2025-03-13', 'male', 'single', 'Drug Possession', 'active', '2025-03-13', '2025-03-13', 'Bahir dar\r\nBahir dar,Ethiopia', 'Habtamu Gashu', 'dddd', '0909029295', 'inmate_images/ZL874YNeFXAN3iiKQj1E05jWbnSJA8B78HFLx61R.png', NULL, '2025-03-10 03:34:50', '2025-03-15 17:41:36', 5),
(4, 'TOLOSA', 'DEMLEW', 'SISAY', '2025-03-21', 'male', 'single', 'Drug Possession', 'active', '2025-04-01', '2025-03-13', 'Ethiopia', 'Habtamu Gashu', 'FRIND', '0909029295', 'inmate_images/d6NmXTwitPV3ffvPBLeaq19RsPS2nGldOzVBRWLv.jpg', 11, '2025-03-10 03:37:04', '2025-03-18 20:26:05', 14),
(335, 'first', 'lol', 'Gashu', '2025-03-14', 'male', 'single', 'Drug Possession', 'active', '2025-03-06', '2025-03-05', 'Bahir dar\r\nBahir dar,Ethiopia', 'Habtamu Bitew Gashu', 'sdfsd', '0909029295', 'inmate_images/LTQcy22ZL5xqWAufonNxNwsgSL5WMDOuKoE5rkeE.jpg', 3, '2025-03-11 14:53:12', '2025-03-14 19:31:06', 2),
(336, 'Habtamu', 'Bitew', 'Gashu', '2025-03-20', 'male', 'married', 'Assault', 'active', '2025-03-19', '2025-03-13', 'Ethiopia , Amhara Bahir Dar, Amhara-Mirab Gojam', 'Habtamu Gashu', 'sdsd', '0909029295', 'inmate_images/DseDmiqD739djW4X6jy88N3quEgII8B3HMpoljXJ.jpg', 5, '2025-03-18 05:55:31', '2025-03-22 06:54:40', 15),
(337, 'Habtamu', 'Bitew', 'Gashu', '2025-02-28', 'male', 'single', 'Drug Possession', 'active', '2025-03-18', '2025-03-19', 'Bahir dar\r\nBahir dar,Ethiopia', 'Habtamu Bitew Gashu', 'hfluy', '0909029295', 'inmate_images/6kWetb8zbvRikVpn7eGqO3jVs5dZJkf28ey0j6vy.jpg', 6, '2025-03-18 14:51:21', '2025-03-18 18:58:03', 4),
(338, 'Habtamu', 'Bitew', 'Gashu', '2025-03-13', 'male', 'single', 'Fraud', 'active', '2025-03-10', '2025-03-20', 'Bahir dar\r\nBahir dar,Ethiopia', 'Habtamu Bitew Gashu', 'asdfa', '0909029295', 'inmate_images/Pck9Hjb5LhjRohLRCAYdUAQi7eZj99m2P71pB3fR.jpg', 6, '2025-03-18 18:13:43', '2025-03-19 18:39:23', 10),
(339, 'Habtamu', 'Bitew', 'Gashu', '2025-03-19', 'male', 'single', 'Theft', 'active', '2025-03-11', '2025-03-28', 'hoseana', 'Habtamu Bitew Gashu', 'dddd', '0909029295', 'inmate_images/CD3NG2tyREfbm6K4Ip9e3yINZr2XZDeXsXLltrkb.jpg', 6, '2025-03-18 19:24:17', '2025-03-18 19:24:57', 3),
(340, 'worabe', 'Bitew', 'Gashu', '2025-03-28', 'male', 'single', 'Drug Possession', 'active', '2025-03-06', '2025-03-13', 'Bahir dar\r\nBahir dar,Ethiopia', 'Habtamu Bitew Gashu', 'de', '0909029295', 'inmate_images/AmkW0Iss62gxXORsGirghL6ntvJfPuBRGGXU5n3S.jpg', 6, '2025-03-18 20:13:44', '2025-03-18 20:14:38', 14),
(341, 'prisoner1', 'prisoner1', 'prisoner12', '2025-03-13', 'male', 'single', 'Assault', 'active', '2025-03-21', '2025-03-20', 'hose', 'family 1', 'family 1', 'family 1', 'inmate_images/xXVilbQOcwh1YDMGWRmOGPGL3waxzf9IY1iVoQYl.png', 6, '2025-03-19 17:48:45', '2025-03-19 18:39:29', 12),
(342, 'prisoner1worabe', 'prisoner1worabe', 'prisoner1worabe', '2025-03-28', 'male', 'single', 'Theft', 'active', '2025-03-11', '2025-03-11', 'worabe', 'Habtamu Bitew Gashu', 'family', '0909029295', 'inmate_images/CYhtNK2Uq3693irJZKwgJ1KAdhthz7IllaQ8n5mQ.png', 6, '2025-03-19 18:38:12', '2025-03-19 18:39:35', 13),
(343, 'Habtamu', 'Bitew', 'Gashu', '2025-03-14', 'male', 'single', 'Fraud', 'active', '2025-03-20', '2025-03-22', 'worabe', 'Habtamu Gashu', 'faam', '0909029295', 'inmate_images/3jXJXsl7pfrMmZ1moQqaubYeEWMIKrtWWm2NWmrQ.jpg', 6, '2025-03-19 23:52:02', '2025-03-22 02:25:16', 15),
(344, 'wow', 'Bitew', 'Gashu', '2025-03-22', 'male', 'single', 'Drug Possession', 'active', '2025-03-07', '2025-03-06', 'Bahir dar\r\nBahir dar,Ethiopia', 'Habtamu Bitew Gashu', 'rrr', '0909029295', 'inmate_images/PAHlqV6Zsd3SAIehlnRotnxNyFgoOqMhYNnBjNtU.png', 5, '2025-03-22 23:45:14', '2025-04-06 20:01:47', 19),
(345, 'Habtamu', 'kl', 'Gashu', '2025-03-20', 'male', 'single', 'Theft', 'active', '2025-03-20', '2025-03-13', 'Ethiopia , Amhara Bahir Dar, Amhara-Mirab Gojam', 'Habtamu Gashu', 'dddd', '0909029295', 'inmate_images/hSsEMKOiAojJLpJ2qdNJAyrEgIKZc299uEXGsL1F.jpg', 10, '2025-03-30 21:05:28', '2025-03-30 21:05:28', NULL),
(346, 'Habtamu', 'Bitew', 'Gashu', '2025-04-17', 'male', 'single', 'Theft', 'active', '2025-04-04', '2025-04-19', 'Bahir dar\r\nBahir dar,Ethiopia', 'Habtamu Gashu', 'sdsd', '0943392332', 'inmate_images/KqRq8s4MCkQh0zGP8Qvjpzd2ZfMudr9PGa9g6r9l.jpg', 10, '2025-04-03 21:59:42', '2025-04-03 21:59:42', NULL),
(347, 'Habtamu', 'Bitew', 'Gashu', '2025-04-30', 'male', 'single', 'Assault', 'active', '2025-04-18', 'life', 'Ethiopia , Amhara Bahir Dar, Amhara-Mirab Gojam', 'Habtamu Gashu', 'dddd', '0943392332', 'inmate_images/0IJS5ee1Jbdm9vtrbD25t8u5sMxzCMDaLym0v5BW.jpg', 10, '2025-04-04 01:48:08', '2025-04-04 01:48:08', NULL),
(348, 'Habtamu', 'Bitew', 'Gashu', '2025-04-18', 'male', 'single', 'Theft', 'active', '2024-04-17', 'death', 'Ethiopia , Amhara Bahir Dar, Amhara-Mirab Gojam', 'Habtamu Gashu', 'sdsd', '0909029295', 'inmate_images/gsTJopq1N5oeA0pxkYVsffOp6pm3uWCTVQ9kA8Xy.jpg', 10, '2025-04-04 01:53:28', '2025-04-04 01:53:28', NULL),
(349, 'Habtamu', 'Bitew', 'Gashu', '2025-04-26', 'male', 'single', 'Drug Possession', 'active', '2025-04-03', 'Death Sentence', 'Bahir dar\r\nBahir dar,Ethiopia', 'Habtamu Gashu', 'sdfsd', '0943392332', 'inmate_images/8DmqyXEGh6N3WNaSH88EGDMRld8QNNc9wkrWdKZl.jpg', 10, '2025-04-04 03:16:50', '2025-04-04 03:16:50', NULL),
(350, 'Habtamu', 'Bitew', 'Gashu', '2025-04-11', 'male', 'single', 'Assault', 'active', '2025-04-03', 'Life Sentence', 'Bahir dar\r\nBahir dar,Ethiopia', 'Habtamu Gashu', 'dddd', '0909029295', 'inmate_images/nzBHzzT9O0A1ITji4dvOkHJEjqu9SSq1gfdg49Kr.jpg', 10, '2025-04-04 03:19:21', '2025-04-04 03:19:21', NULL),
(351, 'Habtamu', 'Bitew', 'Gashu', '2025-04-05', 'male', 'single', 'Other', 'active', '2025-04-04', '2048-04-04', 'Bahir dar\r\nBahir dar,Ethiopia', 'Habtamu Gashu', 'dddd', '0909029295', 'inmate_images/UtL30vt2S6lmINALl2KJOBjcDq1faq9PRDexUtqV.jpg', 5, '2025-04-04 03:57:00', '2025-04-06 20:01:57', 15),
(352, 'Habtamu', 'Bitew', 'Gashu', '2025-04-15', 'male', 'single', 'Hate Crimes', 'active', '2025-04-04', '2035-04-04', 'Bahir dar\r\nBahir dar,Ethiopia', 'Habtamu Gashu', 'sdfsd', '0943392332', 'inmate_images/knYRdfmwIQTnu9yEeYnsotAFBOCki6h5iCmbYiao.jpg', 11, '2025-04-04 15:27:56', '2025-04-04 15:29:20', 11),
(353, 'Albertha', 'Reanna Cremin', 'Hickle', '2026-03-11', 'female', 'widowed', 'Fraud', 'active', '2025-09-12', '2053-09-12', '57556 Maggio Highway', 'Evie Hansen', 'Montserrat', '463-395-3425', 'inmate_images/cUs3EqldkZJjoaqhRNxwCPzySO6RpNWMY5wTqonJ.jpg', 5, '2025-04-06 20:06:21', '2025-04-06 20:07:20', 17),
(354, 'Philip', 'Ila Cartwright', 'Kautzer', '2026-01-26', 'female', 'married', 'Robbery', 'active', '2025-11-21', 'Death Sentence', '81435 Quigley Views', 'Mozell Hegmann', 'Eswatini', '416-008-7372', 'inmate_images/5wyDLEuEl5QsSC2f5DjbjjZIbvdMQS8Pc5NcJA5o.jpg', 5, '2025-04-06 21:27:26', '2025-04-06 21:29:34', 22);

-- --------------------------------------------------------

--
-- Table structure for table `prisons`
--

CREATE TABLE `prisons` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` text DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prisons`
--

INSERT INTO `prisons` (`id`, `name`, `location`, `capacity`, `created_at`, `updated_at`) VALUES
(1, 'wolkite prison', 'wolkite', 2121212, '2025-03-09 04:41:27', '2025-03-09 04:41:27'),
(2, 'gurage prison', 'gurage', 2312312, '2025-03-09 04:51:07', '2025-03-09 04:51:07'),
(3, 'hadya', 'hadia', 302222, '2025-03-09 04:55:05', '2025-03-09 04:55:05'),
(4, 'central ethiopia', 'hoseana', 232323, '2025-03-09 04:55:43', '2025-03-09 04:55:43'),
(5, 'kembata prison', 'kembata', 2121212, '2025-03-09 05:37:41', '2025-03-09 05:37:41'),
(6, 'worabe prison', 'worabe', 2323, '2025-03-09 05:40:06', '2025-03-09 05:40:06'),
(7, 'East Gurage Zone Priosn', 'Hawassa', 121212, '2025-03-09 05:43:21', '2025-03-09 05:43:21'),
(8, 'ddd', 'test', 222222, '2025-03-09 17:44:13', '2025-03-09 17:44:13'),
(10, 'Halaba Zone Prison', 'test', 300000, '2025-03-09 17:47:23', '2025-03-09 17:47:23'),
(11, 'Siltʼe Zone Prison', 'test', 333333, '2025-03-09 19:03:00', '2025-03-09 19:03:00'),
(13, 'DD2323', 'test', 32323, '2025-03-09 19:14:32', '2025-03-09 19:14:32'),
(14, 'asdfasdf', 'test', 2121, '2025-03-09 19:14:40', '2025-03-09 19:14:40'),
(15, 'hhhh', 'test', 2323, '2025-03-09 19:14:49', '2025-03-09 19:14:49'),
(16, '232323234', 'test', 234234, '2025-03-09 19:14:57', '2025-03-09 19:14:57'),
(17, 'asdasd', 'test', 232323, '2025-03-09 19:15:05', '2025-03-09 19:15:05'),
(18, 'weqwer', 'test', 2323, '2025-03-09 19:15:10', '2025-03-09 19:15:10'),
(19, 'Yem Zone Prison', 'test', 222, '2025-03-09 19:37:35', '2025-03-09 19:37:35'),
(20, 'abecho gode', 'test', 21212, '2025-03-09 19:41:16', '2025-03-09 19:41:16'),
(22, 'kemba', 'Addis Ababa', 222, '2025-03-18 19:32:14', '2025-03-18 19:32:14'),
(23, 'admin', 'Bahir Dar', 22, '2025-03-18 19:36:10', '2025-03-18 19:36:10'),
(24, 'tt', 'Bahir Dar', 3223, '2025-03-18 19:36:21', '2025-03-18 19:36:21'),
(25, 'DDoo', 'Addis Ababa', 1212, '2025-04-01 02:31:08', '2025-04-01 02:31:08'),
(26, 'hosseana prison', 'gurage', 12121212, '2025-04-03 16:42:37', '2025-04-03 16:42:37'),
(27, 'hos', 'Addis Ababa', 21212, '2025-04-03 16:43:22', '2025-04-03 16:43:22');

-- --------------------------------------------------------

--
-- Table structure for table `prison_assignments`
--

CREATE TABLE `prison_assignments` (
  `id` int(11) NOT NULL,
  `prison_id` int(11) DEFAULT NULL,
  `system_admin_id` int(11) DEFAULT NULL,
  `assigned_by` int(11) DEFAULT NULL,
  `assigned_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `generated_by` int(11) DEFAULT NULL,
  `report_type` enum('daily','monthly','annual','incident') DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `request_type` text DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `request_details` text DEFAULT NULL,
  `prisoner_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `lawyer_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `evaluation` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `request_type`, `status`, `approved_by`, `request_details`, `prisoner_id`, `created_at`, `updated_at`, `lawyer_id`, `user_id`, `evaluation`) VALUES
(13, 'legal_assistance', 'approved', NULL, 'this prisoner \r\n', 337, '2025-03-09 19:02:45', '2025-04-03 16:46:18', NULL, 16, 'fjhgjh'),
(2140, 'prison_transfer', 'rejected', NULL, 'c', 343, '2025-03-31 14:07:22', '2025-04-03 16:46:39', 39, NULL, 'hgh'),
(2141, 'human_rights_violation', 'approved', NULL, 'adjaskjdfaskldflskd', 338, '2025-03-31 14:10:38', '2025-03-31 19:11:36', 39, NULL, 'ahfasidf'),
(2142, 'appeal_filing', 'approved', NULL, 'mm', 343, '2025-03-31 14:10:52', '2025-04-01 04:55:02', 39, NULL, 'hhh'),
(2143, 'human_rights_violation', 'approved', NULL, 'n', 339, '2025-03-31 14:10:58', '2025-04-01 04:40:08', 39, NULL, 'kk'),
(2144, 'human_rights_violation', 'approved', NULL, 'this kjojsefiasdfmv', 343, '2025-03-31 14:11:11', '2025-03-31 19:12:17', 39, NULL, 'ggg'),
(2145, 'appeal_filing', 'approved', NULL, 'd', 340, '2025-03-31 20:33:35', '2025-04-01 01:44:54', NULL, NULL, 'w'),
(2146, 'case_review', 'approved', NULL, 'ii', 340, '2025-03-31 20:41:19', '2025-04-01 04:14:27', NULL, NULL, 'jhjk'),
(2147, 'medical_assistance', 'rejected', NULL, 'dd', 337, '2025-03-31 20:44:48', '2025-04-01 04:14:59', NULL, NULL, 'mmm'),
(2148, 'human_rights_violation', 'approved', NULL, 'ss', 340, '2025-03-31 20:45:24', '2025-04-01 04:15:07', NULL, NULL, 'kk'),
(2149, 'prison_transfer', 'approved', NULL, 'ii', 340, '2025-03-31 20:46:25', '2025-04-01 04:15:19', NULL, NULL, 'kk'),
(2150, 'medical_assistance', 'rejected', NULL, ',ll', 340, '2025-03-31 20:47:58', '2025-04-01 04:15:36', NULL, NULL, 'mm'),
(2151, 'medical_assistance', 'rejected', NULL, 'jjj', 340, '2025-03-31 20:48:05', '2025-04-01 04:15:41', NULL, NULL, 'kjk'),
(2152, 'case_review', 'rejected', NULL, 'ddd', 340, '2025-03-31 20:49:37', '2025-04-01 04:15:50', NULL, NULL, 'jkik'),
(2153, 'medical_assistance', 'approved', NULL, 'dd', 340, '2025-03-31 20:49:43', '2025-04-06 21:33:03', NULL, NULL, 'yyyy'),
(2154, 'medical_assistance', 'pending', NULL, 'xxx', 340, '2025-03-31 20:51:19', '2025-04-01 04:09:23', NULL, NULL, 'xx'),
(2155, 'medical_assistance', 'approved', NULL, 'sss', 340, '2025-03-31 20:54:42', '2025-04-01 04:09:12', NULL, NULL, 'xx'),
(2156, 'case_review', 'approved', NULL, 'sss', 340, '2025-03-31 20:56:11', '2025-04-01 04:16:09', NULL, NULL, 'jhjk'),
(2157, 'medical_assistance', 'rejected', NULL, 'sss', 337, '2025-03-31 20:57:24', '2025-04-01 04:16:16', NULL, NULL, 'jjkbmn'),
(2158, 'appeal_filing', 'approved', NULL, 'n', 335, '2025-04-01 01:44:25', '2025-04-04 04:13:38', 12, NULL, 'asfasdf'),
(2159, 'prison_transfer', 'approved', NULL, 'i want khoaskdfm asjkdhfjkashfln okjsdjfkasdf', 344, '2025-04-01 04:24:44', '2025-04-03 16:47:50', 12, NULL, 'm asjkdhfjkashfln okjsdjfkasd'),
(2160, 'case_review', 'pending', NULL, 'jjjj', 337, '2025-04-05 02:05:58', '2025-04-05 02:05:58', 12, NULL, NULL),
(2161, 'prison_transfer', 'approved', NULL, 'mmm', 344, '2025-04-05 02:06:20', '2025-04-05 20:44:02', 12, NULL, 'k'),
(2162, 'case_review', 'rejected', NULL, 'fd', 337, '2025-04-05 04:38:42', '2025-04-06 21:32:51', 12, NULL, 'nnnnn'),
(2163, 'medical_assistance', 'approved', NULL, 'fasfasd', 340, '2025-04-06 18:46:08', '2025-04-06 21:32:57', NULL, 40, 'hjhjh');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'System Administrator', 'gugui', '2025-03-09 04:04:02', '2025-03-09 04:04:02'),
(2, 'Inspector', 'hhh', '2025-03-09 04:07:59', '2025-03-09 04:07:59'),
(3, 'Central Administrator', 'this central admin controles overal syste', '2025-03-09 04:15:29', '2025-03-09 04:15:29'),
(4, 'Visitor', 'lol am i vitor', '2025-03-09 04:25:39', '2025-03-09 04:25:39'),
(5, 'Commissioner', 'zz', '2025-03-09 04:28:38', '2025-03-09 04:28:38'),
(6, 'Training Officer', 'sfasf', '2025-03-09 04:49:33', '2025-03-09 04:49:33'),
(8, 'Police Officer', 'Police officer role', '2025-03-18 17:38:19', '2025-03-18 17:38:19'),
(9, 'Medical Officer', 'Medical officer for prisons', '2025-04-04 16:10:47', '2025-04-04 16:10:47'),
(10, 'Security Officer', 'security for prisons', '2025-04-04 16:12:39', '2025-04-04 16:12:39'),
(11, 'Discipline Officer', NULL, '2025-04-04 16:14:10', '2025-04-04 16:14:10');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_number` varchar(20) NOT NULL,
  `capacity` int(11) DEFAULT NULL,
  `type` enum('cell','medical','security','training','visitor','isolation') DEFAULT NULL,
  `status` enum('available','occupied','under_maintenance') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `prison_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_number`, `capacity`, `type`, `status`, `created_at`, `updated_at`, `prison_id`) VALUES
(1, '11', 2, 'training', 'available', '2025-03-10 20:55:40', '2025-03-10 20:55:40', 20),
(2, '12', 21, 'training', 'occupied', '2025-03-10 20:57:21', '2025-03-10 20:57:21', 20),
(3, '13', 2, 'security', 'under_maintenance', '2025-03-10 21:07:49', '2025-03-10 21:07:49', 6),
(4, '32', 122, 'medical', 'occupied', '2025-03-10 21:08:23', '2025-03-10 21:08:23', NULL),
(5, '122', 1221, 'medical', 'occupied', '2025-03-10 21:08:43', '2025-03-10 21:08:43', NULL),
(6, '1212', 122, 'security', 'available', '2025-03-10 21:08:51', '2025-03-10 21:08:51', NULL),
(7, '121', 1212, 'medical', 'occupied', '2025-03-10 21:09:04', '2025-03-10 21:09:04', NULL),
(8, '1221', 122, 'medical', 'occupied', '2025-03-10 21:09:20', '2025-03-10 21:09:20', NULL),
(9, '123', 212, 'medical', 'available', '2025-03-10 21:09:38', '2025-03-10 21:09:38', NULL),
(10, '33', 1, 'security', 'occupied', '2025-03-10 21:09:51', '2025-03-10 21:09:51', NULL),
(11, '333', 3, 'cell', 'available', '2025-03-18 04:55:21', '2025-03-18 04:55:21', 10),
(12, '222', 222, 'cell', 'available', '2025-03-18 04:58:33', '2025-03-18 04:58:33', 10),
(13, '3123', 22, 'cell', 'available', '2025-03-18 18:40:09', '2025-03-18 18:40:09', 11),
(14, '234523', 33, 'cell', 'occupied', '2025-03-18 20:11:54', '2025-03-18 20:11:54', 6),
(15, '2345', 4, 'medical', 'available', '2025-03-18 20:12:40', '2025-03-18 20:12:40', 6),
(16, '777', 7, 'cell', 'available', '2025-03-18 20:25:11', '2025-03-18 20:25:11', 6),
(17, '1', 1, 'cell', 'available', '2025-03-22 06:54:31', '2025-03-22 06:54:31', 5),
(18, '44444', 4, 'cell', 'available', '2025-03-23 17:42:52', '2025-03-23 17:42:52', 11),
(19, '22222', 2, 'cell', 'available', '2025-03-31 03:07:31', '2025-03-31 03:07:31', 11),
(20, '98999', 89899, 'cell', 'available', '2025-04-01 16:07:55', '2025-04-01 16:07:55', 11),
(21, '121221', 12212, 'security', 'under_maintenance', '2025-04-04 17:11:18', '2025-04-04 17:11:18', 11),
(22, '2', 6, 'cell', 'available', '2025-04-06 21:28:58', '2025-04-06 21:28:58', 5);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('UMtYNX44OpToncieikAfVhIFy5xD3PPXOY2e7QfA', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YToxMzp7czo2OiJfdG9rZW4iO3M6NDA6IjBNWkhPTnZ4dnNXYjRLWTRSSDRWS0pMYUZuWTJPNjFEQ2F6R1RsS0MiO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM1OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbm90aWZpY2F0aW9ucyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MTA6InZpc2l0b3JfaWQiO2k6MTY7czoxMDoiZmlyc3RfbmFtZSI7czo3OiJIYWJ0YW11IjtzOjk6Imxhc3RfbmFtZSI7czo1OiJHYXNodSI7czoxMjoicGhvbmVfbnVtYmVyIjtzOjEwOiIwOTA5MDI5Mjk1IjtzOjEyOiJyZWxhdGlvbnNoaXAiO3M6MzoiZWVlIjtzOjc6ImFkZHJlc3MiO3M6OToiQmFoaXIgZGFyIjtzOjU6ImVtYWlsIjtzOjEyOiJ2aUBnbWFpbC5jb20iO3M6MjE6ImlkZW50aWZpY2F0aW9uX251bWJlciI7czoxNzoiMjEyMzMxMjQxMjM0MTIzNDIiO3M6ODoicm9sZW5hbWUiO3M6NzoidmlzaXRvciI7czo3OiJyb2xlX2lkIjtzOjE6IjQiO30=', 1744363139);

-- --------------------------------------------------------

--
-- Table structure for table `system_logs`
--

CREATE TABLE `system_logs` (
  `id` int(11) NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `action` text DEFAULT NULL,
  `entity` enum('account','prison','prisoner','report','backup','request','medical_report','certification_record') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `training_assignments`
--

CREATE TABLE `training_assignments` (
  `id` int(11) NOT NULL,
  `prisoner_id` int(11) DEFAULT NULL,
  `training_id` int(11) DEFAULT NULL,
  `assigned_by` int(11) DEFAULT NULL,
  `assigned_date` date DEFAULT NULL,
  `status` enum('in_progress','completed') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `training_assignments`
--

INSERT INTO `training_assignments` (`id`, `prisoner_id`, `training_id`, `assigned_by`, `assigned_date`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 74, '2025-04-11', NULL, '2025-04-05 02:25:43', '2025-04-05 02:52:30'),
(2, NULL, NULL, 74, '2025-04-17', NULL, '2025-04-05 02:34:01', '2025-04-05 02:52:35'),
(3, NULL, NULL, 74, '2025-04-04', NULL, '2025-04-05 02:55:57', '2025-04-05 03:05:05'),
(4, NULL, NULL, 74, '2025-04-17', NULL, '2025-04-05 03:05:16', '2025-04-05 20:36:15'),
(5, NULL, NULL, 74, '2025-04-17', NULL, '2025-04-05 03:05:23', '2025-04-10 19:25:44'),
(6, NULL, NULL, 74, '2025-04-24', NULL, '2025-04-05 03:05:33', '2025-04-06 01:49:44'),
(7, NULL, NULL, 74, '2025-04-18', NULL, '2025-04-06 01:49:33', '2025-04-10 19:25:55'),
(8, 354, 222, 68, '2025-04-11', 'in_progress', '2025-04-06 21:31:08', '2025-04-06 21:31:08'),
(9, NULL, NULL, NULL, '2025-04-17', NULL, '2025-04-07 16:35:39', '2025-04-07 16:36:07'),
(10, 3, 219, NULL, '2025-05-01', 'in_progress', '2025-04-07 16:35:51', '2025-04-07 16:35:51'),
(11, NULL, NULL, 74, '2025-04-17', NULL, '2025-04-10 19:24:58', '2025-04-10 19:25:57'),
(12, NULL, NULL, 74, '2025-04-16', NULL, '2025-04-10 19:25:19', '2025-04-10 19:25:54'),
(13, 336, 225, 74, '2025-04-18', 'in_progress', '2025-04-10 19:26:42', '2025-04-10 19:26:42');

-- --------------------------------------------------------

--
-- Table structure for table `training_programs`
--

CREATE TABLE `training_programs` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `prison_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `training_programs`
--

INSERT INTO `training_programs` (`id`, `name`, `description`, `created_by`, `created_at`, `updated_at`, `start_date`, `end_date`, `prison_id`) VALUES
(219, 'vocal', 'this is the first vocal', 74, '2025-04-05 00:58:37', '2025-04-05 01:20:00', '2025-04-04', '2025-04-11', NULL),
(222, 'DDnn', 'ajkdfaskdf', NULL, '2025-04-05 02:00:42', '2025-04-05 02:00:42', '2025-04-04', '2025-04-05', 5),
(223, 'jjjj', 'jjj', NULL, '2025-04-06 21:30:53', '2025-04-06 21:30:53', '2025-04-08', '2025-04-18', 5),
(224, 'we', 'ew', NULL, '2025-04-10 19:23:32', '2025-04-10 19:23:32', '2025-04-10', '2025-04-18', NULL),
(225, 'commuinity', 'this the new', NULL, '2025-04-10 19:26:28', '2025-04-10 19:26:28', '2025-04-17', '2025-04-19', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visiting_requests`
--

CREATE TABLE `visiting_requests` (
  `id` int(11) NOT NULL,
  `visitor_id` int(11) DEFAULT NULL,
  `requested_date` date DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `prisoner_firstname` varchar(255) DEFAULT NULL,
  `prisoner_middlename` varchar(255) DEFAULT NULL,
  `prisoner_lastname` varchar(255) DEFAULT NULL,
  `prison_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `relationship` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `identification_number` varchar(100) DEFAULT NULL,
  `email` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `first_name`, `last_name`, `phone_number`, `relationship`, `address`, `identification_number`, `email`, `password`, `created_at`, `updated_at`) VALUES
(2, 'Habtamu', 'Gashu', '0909029295', 'eee', 'Bahir dar', '2323', 'habyesuuuuuuuuuuuuuuuuuuuuuu@gmail.com', '$2y$12$8y9BWQ39rUYSw4zpoKTGSuz/AVN8chouFKjl0TMaCu2s90j.1HtYW', '2025-04-03 21:50:21', '2025-04-03 21:50:21'),
(3, 'TaShya', 'Walsh', '+1 (252) 961-6605', 'Dolores quia aut odi', 'Modi consequatur Pl', '15', 'losikazofu', '$2y$12$NSF9paRS6bo57/0kBYdAIOtYn.knVGASc5rYbo1ds6HYkg5ogIMV6', '2025-04-07 04:09:04', '2025-04-07 04:09:04'),
(5, 'Jaylen', 'King', '407-014-9588', 'Deserunt', '20502 Minnie Turnpike', '459', 'Bernadette_Davis@gmail.com', '$2y$12$5R/nIYgBTsv2SGvhEFHWZerZmZOjC5Ev9ae2M2SlrzBPFVlauQj5G', '2025-04-07 04:33:52', '2025-04-07 04:33:52'),
(6, 'Geo', 'Orn', '155-638-4077', 'Harum', '8569 Cade Neck', '206', 'Lula.Batz', '$2y$12$emSLXoXw5HGdLscblExqTuiu2A4brQjlxfWwx07BBhWgVraI4Gu0K', '2025-04-07 04:37:01', '2025-04-07 04:37:01'),
(7, 'Trystan', 'Dibbert', '761-160-3700', 'Sint tempore', '574 Schinner Mall', '392', 'your.email+fakedata60508@gmail.com', '$2y$12$pGMGy3qK6fiRvEqwk4/xI.a6a3bVvZaJSHEB.uD02gb8YR6gYV3Xe', '2025-04-07 04:52:03', '2025-04-07 04:52:03'),
(8, 'Kaci', 'Thiel', '614-495-0695', 'Possimus id blanditiis.', '8342 Batz Ways', '589', 'sssssss@gmail.com', '$2y$12$kKp8MYXSww4lsfeCxsFKsu5uBm.qc81ruyTK9tzT3sPf3JVClWXh2', '2025-04-07 04:53:30', '2025-04-07 04:53:30'),
(9, 'Habtamu', 'Gashu', '0909029295', 'ss', 'Ethiopia , Amhara Bahir Dar, Amhara-Mirab Gojam', 'worabeinss@gmail.com', 'Habtshss@gmail.com', '$2y$12$59E/lggzmD.1k/7.u5Aineh71rv7bOIsKshq3HSkga2kqLrspGnGm', '2025-04-10 14:38:49', '2025-04-10 14:38:49'),
(10, 'Habtamu', 'Gashu', '0909029295', 'eee', 'Ethiopia , Amhara Bahir Dar, Amhara-Mirab Gojam', '1212121212', '1asas@gmail.com', '$2y$12$VC9jRnufr54NlgTat4vSz.CuFJDO8Z7hL3oIRNBFM/vfnJqILo/wW', '2025-04-10 14:40:15', '2025-04-10 14:40:15'),
(11, 'gemchis', 'zerfu', '0909029295', 'family', 'Ethiopia , Amhara Bahir Dar, Amhara-Mirab Gojam', '23123123123', 'gemchisz@gmail.com', '$2y$12$NQ9wMR3lW/YEkyPc4tk.SOWF9eTJbl.3y3.r/lZx.uSyNCoNPKxcW', '2025-04-10 14:41:42', '2025-04-10 14:41:42'),
(12, 'gemchis', 'Gashu', '0909029295', 'Dolores quia aut odi', 'Ethiopia , Amhara Bahir Dar, Amhara-Mirab Gojam', 'sdasd@gmail.com', 'asdas@gmail.com', '$2y$12$U0zFo4JFjGfa7bQ2eJPS4.Q7ugNYlihikX/OmPZH4LJfIvZpj8Spm', '2025-04-10 14:44:12', '2025-04-10 14:44:12'),
(13, 'Habtamu', 'Gashu', '0909029295', 'Dolores quia aut odi', 'Ethiopia , Amhara Bahir Dar, Amhara-Mirab Gojam', '2234525', 'Habtsha2022351@gmail.com', '$2y$12$QAJgVk4mB2fSf9tQTDllwOXlLgFYsGhkEnkIkbv9V15mMf9oPQuoS', '2025-04-10 14:47:20', '2025-04-10 14:47:20'),
(14, 'ddd', 'Gashu', '0909029295', 'rr', 'Bahir dar', 'ssector@gmail.com', 'ss021@gmail.com', '$2y$12$rwRpd6a4IrsowDeDm/e6O.p0LI4Z4f4Jp0P7TyRmqxy5PGXr05.gW', '2025-04-10 14:48:21', '2025-04-10 14:48:21'),
(15, 'Habtamu', 'Gashu', '0909029295', 'eee', 'Bahir dar', '12123123123', 'visitor@gmail.com', '$2y$12$044UttdVKDbnFZbvMLYVc.tpyLpF1iKx5Jpipwvmopcn1tQAelgoW', '2025-04-10 14:49:15', '2025-04-10 14:49:15'),
(16, 'Habtamu', 'Gashu', '0909029295', 'eee', 'Bahir dar', '21233124123412342', 'vi@gmail.com', '$2y$12$F2lpP5PYnm6n6wg.uRFqIOmYK8864JWrkfAndvqmgPhKqgoAfdgwq', '2025-04-10 14:49:41', '2025-04-10 14:49:41'),
(17, 'Habtamu', 'Gashu', '0909029295', 'eee', 'Bahir dar', '121212', 'amare@gmail.com', '$2y$12$cKIhEgIkjreJQruMI8CpQ.NS7SrCGjJOx99kIpOAPVkI0zOIpVVX6', '2025-04-10 19:33:49', '2025-04-10 19:33:49'),
(18, 'Habtamu', 'Gashu', '0909029295', 'ss', 'Bahir dar', '12212122', 'Habtsha2021@gmail.com', '$2y$12$qdQuaJnEPYkLk7/5/4JG3OzFioNwghfDlNcSC7ELy.H2BuPhoUeUe', '2025-04-10 19:43:38', '2025-04-10 19:43:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `fk_accounts_prison` (`prison_id`);

--
-- Indexes for table `backups`
--
ALTER TABLE `backups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_backups_user` (`initiated_by`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `certification_records`
--
ALTER TABLE `certification_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_certification_records_prisoner` (`prisoner_id`),
  ADD KEY `fk_certification_records_issued_by` (`issued_by`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_assignments`
--
ALTER TABLE `job_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_job_assignments_prisoner` (`prisoner_id`),
  ADD KEY `fk_job_assignments_assigned_by` (`assigned_by`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lawyers`
--
ALTER TABLE `lawyers`
  ADD PRIMARY KEY (`lawyer_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `license_number` (`license_number`),
  ADD KEY `fk_lawyer_prisons` (`prison`);

--
-- Indexes for table `lawyer_appointments`
--
ALTER TABLE `lawyer_appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_lawyer_appointments_prisoner` (`prisoner_id`),
  ADD KEY `fk_lawyer_appointments_lawyer` (`lawyer_id`);

--
-- Indexes for table `lawyer_prisoner_assignment`
--
ALTER TABLE `lawyer_prisoner_assignment`
  ADD PRIMARY KEY (`assignment_id`),
  ADD KEY `prisoner_id` (`prisoner_id`),
  ADD KEY `assigned_by` (`assigned_by`),
  ADD KEY `fk_lawyer_prisoner` (`lawyer_id`),
  ADD KEY `fk_lawyer_assignment` (`prison_id`);

--
-- Indexes for table `medical_appointments`
--
ALTER TABLE `medical_appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_medical_appointments_prisoner` (`prisoner_id`),
  ADD KEY `fk_medical_appointments_doctor` (`doctor_id`),
  ADD KEY `fk_medical_appointments_created_by` (`created_by`),
  ADD KEY `fk_prisonformedical` (`prison_id`);

--
-- Indexes for table `medical_reports`
--
ALTER TABLE `medical_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_medical_reports_prisoner` (`prisoner_id`),
  ADD KEY `fk_medical_reports_doctor` (`doctor_id`),
  ADD KEY `fk_appointment` (`appointment_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_visiting_requests`
--
ALTER TABLE `new_visiting_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prison_id` (`prison_id`),
  ADD KEY `fk_approved_by` (`approved_by`),
  ADD KEY `fk_visitor_id` (`visitor_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_notifications_account` (`account_id`),
  ADD KEY `fk_prison` (`prison_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `prisoners`
--
ALTER TABLE `prisoners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_room` (`room_id`),
  ADD KEY `fk_prisoners_prison` (`prison_id`);

--
-- Indexes for table `prisons`
--
ALTER TABLE `prisons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `prison_assignments`
--
ALTER TABLE `prison_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assigned_by` (`assigned_by`),
  ADD KEY `fk_prison_assignments_prison` (`prison_id`),
  ADD KEY `fk_prison_assignments_system_admin` (`system_admin_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reports_generated_by` (`generated_by`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_prisoner_id` (`prisoner_id`),
  ADD KEY `fk_requests_approved_by` (`approved_by`),
  ADD KEY `fk_requests_lawyer` (`lawyer_id`),
  ADD KEY `fk_requests_user` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_prison_rooms` (`prison_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `system_logs`
--
ALTER TABLE `system_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `training_assignments`
--
ALTER TABLE `training_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prisoner_id` (`prisoner_id`),
  ADD KEY `training_id` (`training_id`),
  ADD KEY `assigned_by` (`assigned_by`);

--
-- Indexes for table `training_programs`
--
ALTER TABLE `training_programs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `fk_training_programs_prison` (`prison_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `visiting_requests`
--
ALTER TABLE `visiting_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `approved_by` (`approved_by`),
  ADD KEY `idx_prison_id` (`prison_id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `identification_number` (`identification_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `backups`
--
ALTER TABLE `backups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `certification_records`
--
ALTER TABLE `certification_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_assignments`
--
ALTER TABLE `job_assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `lawyers`
--
ALTER TABLE `lawyers`
  MODIFY `lawyer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `lawyer_appointments`
--
ALTER TABLE `lawyer_appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT for table `lawyer_prisoner_assignment`
--
ALTER TABLE `lawyer_prisoner_assignment`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `medical_appointments`
--
ALTER TABLE `medical_appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT for table `medical_reports`
--
ALTER TABLE `medical_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `new_visiting_requests`
--
ALTER TABLE `new_visiting_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21414;

--
-- AUTO_INCREMENT for table `prisoners`
--
ALTER TABLE `prisoners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=355;

--
-- AUTO_INCREMENT for table `prisons`
--
ALTER TABLE `prisons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `prison_assignments`
--
ALTER TABLE `prison_assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2164;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `system_logs`
--
ALTER TABLE `system_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `training_assignments`
--
ALTER TABLE `training_assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `training_programs`
--
ALTER TABLE `training_programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=226;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visiting_requests`
--
ALTER TABLE `visiting_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `fk_accounts_prison` FOREIGN KEY (`prison_id`) REFERENCES `prisons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_prison_id` FOREIGN KEY (`prison_id`) REFERENCES `prisons` (`id`);

--
-- Constraints for table `backups`
--
ALTER TABLE `backups`
  ADD CONSTRAINT `backups_ibfk_1` FOREIGN KEY (`initiated_by`) REFERENCES `accounts` (`user_id`),
  ADD CONSTRAINT `fk_backups_user` FOREIGN KEY (`initiated_by`) REFERENCES `accounts` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `certification_records`
--
ALTER TABLE `certification_records`
  ADD CONSTRAINT `certification_records_ibfk_1` FOREIGN KEY (`prisoner_id`) REFERENCES `prisoners` (`id`),
  ADD CONSTRAINT `certification_records_ibfk_2` FOREIGN KEY (`issued_by`) REFERENCES `accounts` (`user_id`),
  ADD CONSTRAINT `fk_certification_records_issued_by` FOREIGN KEY (`issued_by`) REFERENCES `accounts` (`user_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_certification_records_prisoner` FOREIGN KEY (`prisoner_id`) REFERENCES `prisoners` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_assignments`
--
ALTER TABLE `job_assignments`
  ADD CONSTRAINT `fk_job_assignments_assigned_by` FOREIGN KEY (`assigned_by`) REFERENCES `accounts` (`user_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_job_assignments_prisoner` FOREIGN KEY (`prisoner_id`) REFERENCES `prisoners` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_assignments_ibfk_1` FOREIGN KEY (`prisoner_id`) REFERENCES `prisoners` (`id`),
  ADD CONSTRAINT `job_assignments_ibfk_2` FOREIGN KEY (`assigned_by`) REFERENCES `accounts` (`user_id`);

--
-- Constraints for table `lawyers`
--
ALTER TABLE `lawyers`
  ADD CONSTRAINT `fk_lawyer_prisons` FOREIGN KEY (`prison`) REFERENCES `prisons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lawyer_appointments`
--
ALTER TABLE `lawyer_appointments`
  ADD CONSTRAINT `fk_lawyer_appointments_lawyer` FOREIGN KEY (`lawyer_id`) REFERENCES `accounts` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_lawyer_appointments_prisoner` FOREIGN KEY (`prisoner_id`) REFERENCES `prisoners` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lawyer_appointments_ibfk_1` FOREIGN KEY (`prisoner_id`) REFERENCES `prisoners` (`id`),
  ADD CONSTRAINT `lawyer_appointments_ibfk_2` FOREIGN KEY (`lawyer_id`) REFERENCES `accounts` (`user_id`);

--
-- Constraints for table `lawyer_prisoner_assignment`
--
ALTER TABLE `lawyer_prisoner_assignment`
  ADD CONSTRAINT `fk_lawyer_assignment` FOREIGN KEY (`prison_id`) REFERENCES `prisons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_lawyer_prisoner` FOREIGN KEY (`lawyer_id`) REFERENCES `lawyers` (`lawyer_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lawyer_prisoner_assignment_ibfk_2` FOREIGN KEY (`prisoner_id`) REFERENCES `prisoners` (`id`),
  ADD CONSTRAINT `lawyer_prisoner_assignment_ibfk_3` FOREIGN KEY (`assigned_by`) REFERENCES `accounts` (`user_id`);

--
-- Constraints for table `medical_appointments`
--
ALTER TABLE `medical_appointments`
  ADD CONSTRAINT `fk_medical_appointments_created_by` FOREIGN KEY (`created_by`) REFERENCES `accounts` (`user_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_medical_appointments_doctor` FOREIGN KEY (`doctor_id`) REFERENCES `accounts` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_medical_appointments_prisoner` FOREIGN KEY (`prisoner_id`) REFERENCES `prisoners` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_prisonformedical` FOREIGN KEY (`prison_id`) REFERENCES `prisons` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `medical_appointments_ibfk_1` FOREIGN KEY (`prisoner_id`) REFERENCES `prisoners` (`id`),
  ADD CONSTRAINT `medical_appointments_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `accounts` (`user_id`),
  ADD CONSTRAINT `medical_appointments_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `accounts` (`user_id`);

--
-- Constraints for table `medical_reports`
--
ALTER TABLE `medical_reports`
  ADD CONSTRAINT `fk_appointment` FOREIGN KEY (`appointment_id`) REFERENCES `medical_appointments` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_medical_reports_doctor` FOREIGN KEY (`doctor_id`) REFERENCES `accounts` (`user_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_medical_reports_prisoner` FOREIGN KEY (`prisoner_id`) REFERENCES `prisoners` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `medical_reports_ibfk_1` FOREIGN KEY (`prisoner_id`) REFERENCES `prisoners` (`id`),
  ADD CONSTRAINT `medical_reports_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `accounts` (`user_id`);

--
-- Constraints for table `new_visiting_requests`
--
ALTER TABLE `new_visiting_requests`
  ADD CONSTRAINT `fk_approved_by` FOREIGN KEY (`approved_by`) REFERENCES `accounts` (`user_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_prison_idd` FOREIGN KEY (`prison_id`) REFERENCES `prisons` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_visitor_id` FOREIGN KEY (`visitor_id`) REFERENCES `visitors` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `fk_notifications_account` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_prison` FOREIGN KEY (`prison_id`) REFERENCES `prisons` (`id`),
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`user_id`);

--
-- Constraints for table `prisoners`
--
ALTER TABLE `prisoners`
  ADD CONSTRAINT `fk_prisoners_prison` FOREIGN KEY (`prison_id`) REFERENCES `prisons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_room` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prisoners_ibfk_1` FOREIGN KEY (`prison_id`) REFERENCES `prisons` (`id`);

--
-- Constraints for table `prison_assignments`
--
ALTER TABLE `prison_assignments`
  ADD CONSTRAINT `fk_prison_assignments_prison` FOREIGN KEY (`prison_id`) REFERENCES `prisons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_prison_assignments_system_admin` FOREIGN KEY (`system_admin_id`) REFERENCES `accounts` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `prison_assignments_ibfk_1` FOREIGN KEY (`prison_id`) REFERENCES `prisons` (`id`),
  ADD CONSTRAINT `prison_assignments_ibfk_2` FOREIGN KEY (`system_admin_id`) REFERENCES `accounts` (`user_id`),
  ADD CONSTRAINT `prison_assignments_ibfk_3` FOREIGN KEY (`assigned_by`) REFERENCES `accounts` (`user_id`);

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `fk_reports_generated_by` FOREIGN KEY (`generated_by`) REFERENCES `accounts` (`user_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`generated_by`) REFERENCES `accounts` (`user_id`);

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `fk_prisoner_id` FOREIGN KEY (`prisoner_id`) REFERENCES `prisoners` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_requests_approved_by` FOREIGN KEY (`approved_by`) REFERENCES `accounts` (`user_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_requests_lawyer` FOREIGN KEY (`lawyer_id`) REFERENCES `lawyers` (`lawyer_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_requests_prisoner` FOREIGN KEY (`prisoner_id`) REFERENCES `prisoners` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_requests_user` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`user_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `requests_ibfk_2` FOREIGN KEY (`approved_by`) REFERENCES `accounts` (`user_id`);

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `fk_prison_rooms` FOREIGN KEY (`prison_id`) REFERENCES `prisons` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `system_logs`
--
ALTER TABLE `system_logs`
  ADD CONSTRAINT `system_logs_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`user_id`);

--
-- Constraints for table `training_assignments`
--
ALTER TABLE `training_assignments`
  ADD CONSTRAINT `training_assignments_ibfk_1` FOREIGN KEY (`prisoner_id`) REFERENCES `prisoners` (`id`),
  ADD CONSTRAINT `training_assignments_ibfk_2` FOREIGN KEY (`training_id`) REFERENCES `training_programs` (`id`),
  ADD CONSTRAINT `training_assignments_ibfk_3` FOREIGN KEY (`assigned_by`) REFERENCES `accounts` (`user_id`);

--
-- Constraints for table `training_programs`
--
ALTER TABLE `training_programs`
  ADD CONSTRAINT `fk_training_programs_prison` FOREIGN KEY (`prison_id`) REFERENCES `prisons` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `training_programs_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `accounts` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

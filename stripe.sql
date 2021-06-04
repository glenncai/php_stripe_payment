-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-06-04 04:35:09
-- 伺服器版本： 10.4.19-MariaDB
-- PHP 版本： 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `stripe`
--

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `item_number` varchar(10) DEFAULT NULL,
  `item_price` varchar(100) DEFAULT NULL,
  `currency` varchar(10) DEFAULT NULL,
  `txn_id` varchar(255) DEFAULT NULL,
  `payment_status` varchar(100) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT curtime(),
  `uploaded` timestamp NOT NULL DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `item_name`, `item_number`, `item_price`, `currency`, `txn_id`, `payment_status`, `token`, `session_id`, `created`, `uploaded`) VALUES
(1, 'Justin Bieber', 'user@email.com', 'Hello World', '2', '199', 'hkd', 'pi_1Iy7V9LSda4DLiyJVtnnG6G2', 'succeeded', NULL, 'cs_test_a14LvaJ0TJKPHkDnqtUjrEak6PFw3MWxjHztUvCM3lyp1zGFBs4UhTC1dJ', '2021-06-03 03:46:26', '2021-06-03 03:46:26'),
(2, 'Glenn Cai', 'glenn990203@gmail.com', '蠟筆小新', '4', '1235', 'hkd', 'pi_1Iy9gALSda4DLiyJNMJCmU9E', 'succeeded', NULL, 'cs_test_a1MwllMfftRn65mA6fPB3ouGOown37bKwS1qXDMRW9ngswlvY2ZFgHlCnq', '2021-06-03 06:05:47', '2021-06-03 06:05:47'),
(3, 'Justin Bieber', 'glenn990203@gmail.com', 'Hello World', '3', '199', 'hkd', 'pi_1IyC1pLSda4DLiyJYs0gDOeI', 'succeeded', NULL, 'cs_test_a1W9EoufHt2hEEteWVa4zlfJGVqywjEU6fmxXVZPM240qsFMT0IQv4YaTQ', '2021-06-03 08:36:13', '2021-06-03 08:36:13'),
(4, 'Glenn Cai', 'glenn990203@gmail.com', 'Hello World', '3', '199', 'hkd', 'pi_1IyCz5LSda4DLiyJ73B3cwPq', 'succeeded', NULL, 'cs_test_a1L5wgZE6dd9eSqfx7SijTmyATSLQJprm5RXa0T4U9xvbwOn2ReOiHXJw2', '2021-06-03 09:37:21', '2021-06-03 09:37:21'),
(5, 'Justin Bieber', 'user@email.com', 'Hello World', '3', '199', 'hkd', 'pi_1IySBELSda4DLiyJ1Dgv8wLB', 'succeeded', NULL, 'cs_test_a1iNUfUr760VbFL9Qa9XT4v6NBlClOKiHqpTIQS1OX56L75LUfo3CpmeJV', '2021-06-04 01:50:58', '2021-06-04 01:50:58');

-- --------------------------------------------------------

--
-- 資料表結構 `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_price` float DEFAULT NULL,
  `product_desc` varchar(255) NOT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT curtime(),
  `updated` timestamp NOT NULL DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_price`, `product_desc`, `product_image`, `created`, `updated`) VALUES
(2, 'Hello World', 199, 'It\'s so cheap!!!', '60b5eea865831.jpg', '2021-06-01 08:24:08', '2021-06-01 08:24:08'),
(3, 'Hello World', 199, 'asdasdas', '60b5fb7c4cd9d.jpg', '2021-06-01 09:18:52', '2021-06-01 09:18:52'),
(4, '蠟筆小新', 1235, 'kawayi!!!!', '60b5fe2dd7ea3.jpg', '2021-06-01 09:30:21', '2021-06-01 09:30:21'),
(5, 'Hello World', 12456.8, 'asdasfasf', '60b60576a0682.jpg', '2021-06-01 10:01:26', '2021-06-01 10:01:26');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

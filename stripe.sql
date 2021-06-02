-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-06-02 05:39:37
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
-- 資料表索引 `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

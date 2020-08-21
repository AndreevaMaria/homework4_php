-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 21 2020 г., 11:07
-- Версия сервера: 5.6.41
-- Версия PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `products`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(64) DEFAULT NULL,
  `sectorid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `category`, `sectorid`) VALUES
(1, 'Category1', 1),
(2, 'Category2', 1),
(4, 'Category3', 2),
(5, 'Category4', 3),
(6, 'Category5', 3),
(7, 'Category6', 2),
(8, 'Category7', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product` varchar(20) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `categoryid` int(11) DEFAULT NULL,
  `sectorid` int(11) DEFAULT NULL,
  `make` varchar(20) DEFAULT NULL,
  `model` varchar(20) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `info` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `product`, `price`, `categoryid`, `sectorid`, `make`, `model`, `country`, `info`) VALUES
(1, 'Product 1', 1100, 5, 3, 'Lorem ipsum China', '1100-1-1', 'China', ''),
(2, 'Product 2', 1300, 4, 2, 'Birtanem', '1300-1-1', 'Turkey', ''),
(3, 'Product 3', 1700, 6, 2, 'Ocksy Night', '1700-1-1', 'Poland', ''),
(4, 'Product 4', 3200, 7, 3, 'Lorem ipsum Russia', '3200-1-1', 'Russia', ''),
(5, 'Product 5', 13000, 1, 1, 'Lorem ipsum Italy', '13000-1-1', 'Italy', 'really great!'),
(6, 'Product 6', 1800, 2, 1, 'Lorem ipsum China', '1800-1-1', 'China', ''),
(7, 'Product 7', 1800, 1, 1, 'Lorem ipsum China', '1800-1-1', 'China', '');

-- --------------------------------------------------------

--
-- Структура таблицы `sectors`
--

CREATE TABLE `sectors` (
  `id` int(11) NOT NULL,
  `sector` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sectors`
--

INSERT INTO `sectors` (`id`, `sector`) VALUES
(1, 'Сектор 1'),
(2, 'Сектор 2'),
(3, 'Сектор 3');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(64) DEFAULT NULL,
  `pass` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `email`) VALUES
(1, '1234', '$2y$10$OggwDCwWs7ltl1ksRFPj5OyKKdksAKcQ74ORXZrcwjlXVKXBoqLQW', 'tdy@kfdn.com'),
(2, '12345', '$2y$10$LJKmBrwkJdvcMFAz6HcyQuUc4TR6pxXyzYC4CiVuVoIPLCrjc6JWm', 'qwer@mail.ru');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category` (`category`),
  ADD KEY `sectorid` (`sectorid`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product` (`product`),
  ADD KEY `categoryid` (`categoryid`),
  ADD KEY `sectorid` (`sectorid`);

--
-- Индексы таблицы `sectors`
--
ALTER TABLE `sectors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sector` (`sector`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `sectors`
--
ALTER TABLE `sectors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`sectorid`) REFERENCES `sectors` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`categoryid`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`sectorid`) REFERENCES `sectors` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

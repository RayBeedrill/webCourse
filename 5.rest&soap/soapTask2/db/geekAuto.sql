-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 28 2017 г., 14:56
-- Версия сервера: 5.5.50
-- Версия PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `auto`
--

-- --------------------------------------------------------

--
-- Структура таблицы `brands`
--

CREATE TABLE IF NOT EXISTS `brands` (
  `id_brand` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `brands`
--

INSERT INTO `brands` (`id_brand`, `name`) VALUES
(2, 'bmw'),
(4, 'mercedes'),
(1, 'mitsubishi');

-- --------------------------------------------------------

--
-- Структура таблицы `cars`
--

CREATE TABLE IF NOT EXISTS `cars` (
  `id_car` int(11) NOT NULL,
  `id_brand` int(11) NOT NULL,
  `model` varchar(300) NOT NULL,
  `id_year` int(11) NOT NULL,
  `id_engine` int(11) NOT NULL,
  `id_color` int(11) NOT NULL,
  `price` bigint(20) NOT NULL,
  `max_speed` int(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cars`
--

INSERT INTO `cars` (`id_car`, `id_brand`, `model`, `id_year`, `id_engine`, `id_color`, `price`, `max_speed`) VALUES
(1, 1, 'eclipse', 3, 2, 2, 25000, 300),
(2, 1, 'outlander', 1, 2, 4, 55000, 220),
(3, 1, 'lancer', 2, 1, 1, 15000, 250),
(4, 2, 'i8', 4, 3, 4, 50000, 300),
(5, 2, 'm6 gran coupe', 5, 4, 3, 120000, 350),
(6, 2, 'ActiveHybrid 5', 5, 5, 1, 100000, 180),
(7, 4, ' A 140', 6, 6, 3, 45000, 235),
(8, 4, 'E220 CDI', 7, 7, 5, 35000, 250),
(9, 4, 'AMG CLS 63', 8, 8, 2, 74350, 200);

-- --------------------------------------------------------

--
-- Структура таблицы `colors`
--

CREATE TABLE IF NOT EXISTS `colors` (
  `id_color` int(11) NOT NULL,
  `name` varchar(300) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `colors`
--

INSERT INTO `colors` (`id_color`, `name`) VALUES
(1, 'red\r\n'),
(2, 'black'),
(3, 'blue'),
(4, 'grey'),
(5, 'white');

-- --------------------------------------------------------

--
-- Структура таблицы `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id_customer` int(11) NOT NULL,
  `first_name` varchar(300) NOT NULL,
  `second_name` varchar(300) NOT NULL,
  `id_car` int(11) NOT NULL,
  `id_method` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `engines`
--

CREATE TABLE IF NOT EXISTS `engines` (
  `id_engine` int(11) NOT NULL,
  `capacity` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `engines`
--

INSERT INTO `engines` (`id_engine`, `capacity`) VALUES
(1, 1.58),
(2, 2.35),
(3, 1.5),
(4, 4.4),
(5, 2.97),
(6, 1.4),
(7, 2.5),
(8, 5.4);

-- --------------------------------------------------------

--
-- Структура таблицы `payment_method`
--

CREATE TABLE IF NOT EXISTS `payment_method` (
  `id_method` int(11) NOT NULL,
  `name` varchar(300) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `payment_method`
--

INSERT INTO `payment_method` (`id_method`, `name`) VALUES
(1, 'credit card'),
(2, 'cash');

-- --------------------------------------------------------

--
-- Структура таблицы `years`
--

CREATE TABLE IF NOT EXISTS `years` (
  `id_year` int(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `years`
--

INSERT INTO `years` (`id_year`, `year`) VALUES
(1, 2008),
(2, 2006),
(3, 2005),
(4, 2014),
(5, 2013),
(6, 1997),
(7, 2002),
(8, 2011);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id_brand`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id_car`),
  ADD KEY `cars_fk0` (`id_brand`),
  ADD KEY `cars_fk1` (`id_year`),
  ADD KEY `cars_fk2` (`id_engine`),
  ADD KEY `cars_fk3` (`id_color`);

--
-- Индексы таблицы `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id_color`);

--
-- Индексы таблицы `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id_customer`),
  ADD KEY `customers_fk0` (`id_car`),
  ADD KEY `customers_fk1` (`id_method`);

--
-- Индексы таблицы `engines`
--
ALTER TABLE `engines`
  ADD PRIMARY KEY (`id_engine`);

--
-- Индексы таблицы `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id_method`);

--
-- Индексы таблицы `years`
--
ALTER TABLE `years`
  ADD PRIMARY KEY (`id_year`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `brands`
--
ALTER TABLE `brands`
  MODIFY `id_brand` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `cars`
--
ALTER TABLE `cars`
  MODIFY `id_car` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `colors`
--
ALTER TABLE `colors`
  MODIFY `id_color` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `customers`
--
ALTER TABLE `customers`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `engines`
--
ALTER TABLE `engines`
  MODIFY `id_engine` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id_method` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `years`
--
ALTER TABLE `years`
  MODIFY `id_year` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_fk0` FOREIGN KEY (`id_brand`) REFERENCES `brands` (`id_brand`),
  ADD CONSTRAINT `cars_fk1` FOREIGN KEY (`id_year`) REFERENCES `years` (`id_year`),
  ADD CONSTRAINT `cars_fk2` FOREIGN KEY (`id_engine`) REFERENCES `engines` (`id_engine`),
  ADD CONSTRAINT `cars_fk3` FOREIGN KEY (`id_color`) REFERENCES `colors` (`id_color`);

--
-- Ограничения внешнего ключа таблицы `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_fk0` FOREIGN KEY (`id_car`) REFERENCES `cars` (`id_car`),
  ADD CONSTRAINT `customers_fk1` FOREIGN KEY (`id_method`) REFERENCES `payment_method` (`id_method`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

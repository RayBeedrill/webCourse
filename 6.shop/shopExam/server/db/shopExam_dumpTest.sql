-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 15 2017 г., 20:02
-- Версия сервера: 5.5.50
-- Версия PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shopExam`
--

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

DROP TABLE IF EXISTS `authors`;
CREATE TABLE IF NOT EXISTS `authors` (
  `id_author` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`id_author`, `name`) VALUES
(1, 'author1'),
(2, 'author2'),
(3, 'author3'),
(4, 'author4'),
(5, 'author5');

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `id_book` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `shortDesc` text NOT NULL,
  `description` text NOT NULL,
  `id_discount` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id_book`, `title`, `price`, `shortDesc`, `description`, `id_discount`) VALUES
(1, 'titleTest1', 300, 'short desc', 'desc', 1),
(2, 'titleTest2', 300, 'short desc', 'desc', 1),
(3, 'titleTest3', 300, 'short desc', 'desc', 1),
(4, 'titleTest4', 300, 'short desc', 'desc', 1),
(5, 'titleTest5', 300, 'short desc', 'desc', 1),
(6, 'titleTest6', 300, 'short desc', 'desc', 1),
(7, 'titleTest7', 300, 'short desc', 'desc', 1),
(8, 'titleTest9', 300, 'short desc', 'desc', 1),
(9, 'titleTest10', 300, 'short desc', 'desc', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `booksAuthor`
--

DROP TABLE IF EXISTS `booksAuthor`;
CREATE TABLE IF NOT EXISTS `booksAuthor` (
  `id` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `id_author` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `booksAuthor`
--

INSERT INTO `booksAuthor` (`id`, `id_book`, `id_author`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5),
(9, 6, 5),
(10, 6, 3),
(11, 8, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `booksGenre`
--

DROP TABLE IF EXISTS `booksGenre`;
CREATE TABLE IF NOT EXISTS `booksGenre` (
  `id` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `id_genre` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `booksGenre`
--

INSERT INTO `booksGenre` (`id`, `id_book`, `id_genre`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5),
(6, 6, 5),
(8, 8, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id_cart` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`id_cart`, `id_user`, `id_book`, `count`) VALUES
(2, 2, 1, 5),
(3, 2, 1, 5),
(4, 2, 1, 5),
(5, 2, 1, 5),
(6, 3, 1, 5),
(7, 2, 1, 5),
(8, 2, 1, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id_user` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `secondName` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_discount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `customers`
--

INSERT INTO `customers` (`id_user`, `name`, `secondName`, `phone`, `email`, `id_discount`) VALUES
(2, 'editName', 'editSecName', 'editPhone', 'email@asda', 1),
(3, 'name', 'secname', '380939', 'email@asda', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `discount`
--

DROP TABLE IF EXISTS `discount`;
CREATE TABLE IF NOT EXISTS `discount` (
  `id_discount` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `discount`
--

INSERT INTO `discount` (`id_discount`, `amount`) VALUES
(1, 30);

-- --------------------------------------------------------

--
-- Структура таблицы `genres`
--

DROP TABLE IF EXISTS `genres`;
CREATE TABLE IF NOT EXISTS `genres` (
  `id_genre` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `genres`
--

INSERT INTO `genres` (`id_genre`, `name`) VALUES
(1, 'genre1'),
(2, 'genre2'),
(3, 'genre3'),
(4, 'genre4'),
(5, 'genre5');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id_order` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `id_payment` int(11) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id_order`, `id_user`, `id_status`, `id_payment`, `data`) VALUES
(2, 3, 1, 1, '2017-10-15 19:12:44');

-- --------------------------------------------------------

--
-- Структура таблицы `order_full_info`
--

DROP TABLE IF EXISTS `order_full_info`;
CREATE TABLE IF NOT EXISTS `order_full_info` (
  `id_order` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `discount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_full_info`
--

INSERT INTO `order_full_info` (`id_order`, `id_book`, `quantity`, `discount`) VALUES
(2, 2, 30, 30);

-- --------------------------------------------------------

--
-- Структура таблицы `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `id_payment` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `payment`
--

INSERT INTO `payment` (`id_payment`, `name`) VALUES
(1, 'payment');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id_role` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id_role`, `name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `id_status` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`id_status`, `name`) VALUES
(1, 'shiping');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `userHash` varchar(32) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `id_role`, `login`, `password`, `userHash`, `status`) VALUES
(2, 2, 'login', 'pass', '', 1),
(3, 2, 'login', 'pass', '', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id_author`);

--
-- Индексы таблицы `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id_book`),
  ADD KEY `books_fk0` (`id_discount`);

--
-- Индексы таблицы `booksAuthor`
--
ALTER TABLE `booksAuthor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booksAuthor_fk0` (`id_book`),
  ADD KEY `booksAuthor_fk1` (`id_author`);

--
-- Индексы таблицы `booksGenre`
--
ALTER TABLE `booksGenre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booksGenre_fk0` (`id_book`),
  ADD KEY `booksGenre_fk1` (`id_genre`);

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `cart_fk0` (`id_user`),
  ADD KEY `cart_fk1` (`id_book`);

--
-- Индексы таблицы `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `customers_fk1` (`id_discount`);

--
-- Индексы таблицы `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`id_discount`);

--
-- Индексы таблицы `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id_genre`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `orders_fk0` (`id_user`),
  ADD KEY `orders_fk1` (`id_status`),
  ADD KEY `orders_fk2` (`id_payment`);

--
-- Индексы таблицы `order_full_info`
--
ALTER TABLE `order_full_info`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `order_full_info_fk1` (`id_book`);

--
-- Индексы таблицы `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id_payment`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `users_fk0` (`id_role`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `authors`
--
ALTER TABLE `authors`
  MODIFY `id_author` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `books`
--
ALTER TABLE `books`
  MODIFY `id_book` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `booksAuthor`
--
ALTER TABLE `booksAuthor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `booksGenre`
--
ALTER TABLE `booksGenre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `discount`
--
ALTER TABLE `discount`
  MODIFY `id_discount` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `genres`
--
ALTER TABLE `genres`
  MODIFY `id_genre` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `payment`
--
ALTER TABLE `payment`
  MODIFY `id_payment` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_fk0` FOREIGN KEY (`id_discount`) REFERENCES `discount` (`id_discount`);

--
-- Ограничения внешнего ключа таблицы `booksAuthor`
--
ALTER TABLE `booksAuthor`
  ADD CONSTRAINT `booksAuthor_fk1` FOREIGN KEY (`id_author`) REFERENCES `authors` (`id_author`),
  ADD CONSTRAINT `booksAuthor_fk0` FOREIGN KEY (`id_book`) REFERENCES `books` (`id_book`);

--
-- Ограничения внешнего ключа таблицы `booksGenre`
--
ALTER TABLE `booksGenre`
  ADD CONSTRAINT `booksGenre_fk1` FOREIGN KEY (`id_genre`) REFERENCES `genres` (`id_genre`),
  ADD CONSTRAINT `booksGenre_fk0` FOREIGN KEY (`id_book`) REFERENCES `books` (`id_book`);

--
-- Ограничения внешнего ключа таблицы `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_fk0` FOREIGN KEY (`id_user`) REFERENCES `customers` (`id_user`),
  ADD CONSTRAINT `cart_fk1` FOREIGN KEY (`id_book`) REFERENCES `books` (`id_book`);

--
-- Ограничения внешнего ключа таблицы `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_fk1` FOREIGN KEY (`id_discount`) REFERENCES `discount` (`id_discount`),
  ADD CONSTRAINT `customers_fk0` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_fk2` FOREIGN KEY (`id_payment`) REFERENCES `payment` (`id_payment`),
  ADD CONSTRAINT `orders_fk0` FOREIGN KEY (`id_user`) REFERENCES `customers` (`id_user`),
  ADD CONSTRAINT `orders_fk1` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`);

--
-- Ограничения внешнего ключа таблицы `order_full_info`
--
ALTER TABLE `order_full_info`
  ADD CONSTRAINT `order_full_info_fk1` FOREIGN KEY (`id_book`) REFERENCES `books` (`id_book`),
  ADD CONSTRAINT `order_full_info_fk0` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`);

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_fk0` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

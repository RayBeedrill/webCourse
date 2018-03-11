-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 26 2017 г., 02:41
-- Версия сервера: 5.6.34
-- Версия PHP: 5.6.29

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

CREATE TABLE `authors` (
  `id_author` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`id_author`, `name`) VALUES
(3, 'author3'),
(4, 'author4'),
(5, 'author5'),
(6, 'sqlAuthorUpdt'),
(7, 'authorPost'),
(8, 'new author');

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE `books` (
  `id_book` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `shortDesc` text NOT NULL,
  `description` text NOT NULL,
  `id_discount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id_book`, `title`, `price`, `shortDesc`, `description`, `id_discount`) VALUES
(2, 'titleTest2Update', 300, 'short desc', 'desc', 1),
(3, 'bookUpdate', 2, 'descUp', 'descUp', 1),
(4, 'titleTest4', 300, 'short desc', 'desc', 1),
(5, 'titleTest5', 300, 'short desc', 'desc', 1),
(6, 'titleTest6', 300, 'short desc', 'desc', 1),
(7, 'titleTest7', 300, 'short desc', 'desc', 1),
(8, 'titleTest9', 300, 'short desc', 'desc', 1),
(9, 'titleTest10', 300, 'short desc', 'desc', 1),
(18, 'bookUpdate', 2, 'descUp', 'descUp', 1),
(19, 'bookTest', 100, 'descTest', 'descTest', 1),
(20, 'titleAjax', 300, 'AjaxshortDesc', 'AjaxDesc', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `booksAuthor`
--

CREATE TABLE `booksAuthor` (
  `id` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `id_author` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `booksAuthor`
--

INSERT INTO `booksAuthor` (`id`, `id_book`, `id_author`) VALUES
(4, 4, 4),
(5, 5, 5),
(9, 6, 5),
(10, 6, 3),
(133, 18, 3),
(134, 18, 4),
(135, 20, 5),
(137, 3, 5),
(138, 2, 6),
(139, 7, 6),
(140, 8, 5),
(141, 9, 5),
(142, 19, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `booksGenre`
--

CREATE TABLE `booksGenre` (
  `id` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `id_genre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `booksGenre`
--

INSERT INTO `booksGenre` (`id`, `id_book`, `id_genre`) VALUES
(4, 4, 4),
(5, 5, 5),
(6, 6, 5),
(129, 18, 4),
(130, 18, 3),
(131, 20, 4),
(133, 3, 3),
(134, 2, 2),
(135, 7, 2),
(136, 8, 5),
(137, 9, 3),
(138, 19, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`id_cart`, `id_user`, `id_book`, `count`) VALUES
(4, 3, 3, 0),
(13, 12, 18, 1),
(14, 12, 9, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `customers`
--

CREATE TABLE `customers` (
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
(3, 'name', 'secname', '380939', 'email@asda', 1),
(4, 'testName', 'testSecondName', 'testPhone', 'testEmail', 1),
(5, 'testName1', 'testSecondName1', 'testPhoneName1', 'testEmailName1', 1),
(6, 'NameAjax', 'SecNameAjax', '38093032', 'demezis19942@dasdasa', 1),
(7, 'NameDIsc', 'SNameDis', '3412341', 'demssdas1994@gmail.com', 1),
(8, 'NameUp', 'SecNameUp', '231231', 'demezisup@dasdad', 5),
(9, 'registName', 'registsName', '231231231', 'registName@dasda', 1),
(10, 'redName', 'redSName', '42134124124', 'demezis@1994gmail', 1),
(11, 'demezis', 'secondDem', '3809442342342342', 'demezis1994@gamilc.om', 1),
(12, 'ros', 'rosSname', '3123121231', 'demezis@gasadsda', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `discount`
--

CREATE TABLE `discount` (
  `id_discount` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `discount`
--

INSERT INTO `discount` (`id_discount`, `amount`) VALUES
(1, 0),
(2, 20),
(3, 30),
(4, 40),
(5, 50),
(6, 60),
(7, 70),
(8, 80),
(9, 90),
(10, 100),
(11, 0),
(12, 100500),
(13, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `genres`
--

CREATE TABLE `genres` (
  `id_genre` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `genres`
--

INSERT INTO `genres` (`id_genre`, `name`) VALUES
(2, 'genre2Updt'),
(3, 'genre3'),
(4, 'genre4'),
(5, 'genre5'),
(6, 'sqlGenre');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `id_payment` int(11) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id_order`, `id_user`, `id_status`, `id_payment`, `data`) VALUES
(2, 3, 2, 1, '2017-10-15 19:12:44'),
(3, 3, 1, 1, '2017-10-18 00:12:00'),
(4, 3, 1, 1, '2017-10-18 00:12:25'),
(5, 2, 1, 1, '2017-10-18 00:18:07'),
(6, 2, 1, 1, '2017-10-18 00:18:58'),
(7, 2, 1, 1, '2017-10-18 00:19:12'),
(8, 2, 1, 1, '2017-10-18 00:22:38'),
(9, 2, 1, 1, '2017-10-18 00:24:14'),
(10, 2, 1, 1, '2017-10-18 00:24:35'),
(11, 2, 1, 1, '2017-10-18 00:26:48'),
(12, 2, 2, 1, '2017-10-18 00:27:19'),
(13, 2, 2, 1, '2017-10-18 00:35:04'),
(14, 2, 2, 1, '2017-10-18 00:35:15'),
(15, 2, 2, 1, '2017-10-18 01:47:18'),
(16, 2, 1, 1, '2017-10-23 00:02:13'),
(17, 11, 1, 1, '2017-10-25 03:20:03'),
(18, 11, 1, 1, '2017-10-25 03:20:03'),
(19, 11, 1, 1, '2017-10-25 03:23:37'),
(20, 11, 1, 1, '2017-10-25 03:23:37'),
(21, 11, 1, 1, '2017-10-25 04:23:25'),
(22, 11, 1, 1, '2017-10-25 04:23:25'),
(23, 11, 1, 2, '2017-10-26 02:15:00'),
(24, 11, 1, 2, '2017-10-26 02:15:00'),
(25, 11, 1, 2, '2017-10-26 02:15:00'),
(26, 11, 1, 2, '2017-10-26 02:15:00'),
(27, 11, 1, 2, '2017-10-26 02:15:00'),
(28, 11, 1, 2, '2017-10-26 02:15:00');

-- --------------------------------------------------------

--
-- Структура таблицы `order_full_info`
--

CREATE TABLE `order_full_info` (
  `id_order` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `discount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_full_info`
--

INSERT INTO `order_full_info` (`id_order`, `id_book`, `quantity`, `discount`) VALUES
(2, 2, 30, 30),
(6, 3, 30, 30),
(7, 3, 30, 30),
(8, 3, 30, 30),
(9, 3, 30, 30),
(10, 3, 30, 30),
(11, 3, 30, 30),
(12, 3, 30, 30),
(13, 3, 30, 30),
(14, 3, 30, 30),
(15, 3, 30, 30),
(16, 3, 30, 30),
(17, 7, 6, 0),
(18, 5, 6, 0),
(19, 5, 6, 0),
(20, 7, 6, 0),
(21, 4, 1, 0),
(22, 2, 5, 0),
(23, 2, 1, 0),
(24, 5, 1, 0),
(25, 7, 1, 0),
(26, 6, 1, 0),
(27, 3, 1, 0),
(28, 4, 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `payment`
--

CREATE TABLE `payment` (
  `id_payment` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `payment`
--

INSERT INTO `payment` (`id_payment`, `name`) VALUES
(1, 'payment'),
(2, 'payment2');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`id_status`, `name`) VALUES
(1, 'shiping'),
(2, 'sklad');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `userHash` varchar(32) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `id_role`, `login`, `password`, `userHash`, `status`) VALUES
(2, 2, 'login', 'pass', '', 1),
(3, 2, 'login', 'pass', '', 1),
(4, 2, 'testLogin', '50546565bcfc4885032c4952e8ba7f30', 'dbbabf158f0b52f57b57d71209645777', 1),
(5, 2, 'testLoginName1', '1498ccbff67db90df5efc0e7249ba58a', '', 1),
(6, 2, 'loginTestAjax', '49e56c0d57a46a7556dfc211cb4fca3f', '', 1),
(7, 2, 'NameDisc', '3adb4ddad83f81e17fc264f5f64a191d', '', 1),
(8, 2, 'demzsiUp', '3adb4ddad83f81e17fc264f5f64a191d', '', 1),
(9, 2, 'registLogin', '3adb4ddad83f81e17fc264f5f64a191d', '', 1),
(10, 2, 'loginRed', '49e56c0d57a46a7556dfc211cb4fca3f', '', 1),
(11, 1, 'demezis', '3adb4ddad83f81e17fc264f5f64a191d', '3dee0150b66151468d9cbb57fe69288d', 1),
(12, 2, 'raybeedrill', '3adb4ddad83f81e17fc264f5f64a191d', '597a21762eff2777cc6e386b887203ac', 1);

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
  MODIFY `id_author` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `books`
--
ALTER TABLE `books`
  MODIFY `id_book` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT для таблицы `booksAuthor`
--
ALTER TABLE `booksAuthor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;
--
-- AUTO_INCREMENT для таблицы `booksGenre`
--
ALTER TABLE `booksGenre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;
--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT для таблицы `discount`
--
ALTER TABLE `discount`
  MODIFY `id_discount` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `genres`
--
ALTER TABLE `genres`
  MODIFY `id_genre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT для таблицы `payment`
--
ALTER TABLE `payment`
  MODIFY `id_payment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
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
  ADD CONSTRAINT `booksAuthor_fk0` FOREIGN KEY (`id_book`) REFERENCES `books` (`id_book`),
  ADD CONSTRAINT `booksAuthor_fk1` FOREIGN KEY (`id_author`) REFERENCES `authors` (`id_author`);

--
-- Ограничения внешнего ключа таблицы `booksGenre`
--
ALTER TABLE `booksGenre`
  ADD CONSTRAINT `booksGenre_fk0` FOREIGN KEY (`id_book`) REFERENCES `books` (`id_book`),
  ADD CONSTRAINT `booksGenre_fk1` FOREIGN KEY (`id_genre`) REFERENCES `genres` (`id_genre`);

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
  ADD CONSTRAINT `customers_fk0` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `customers_fk1` FOREIGN KEY (`id_discount`) REFERENCES `discount` (`id_discount`);

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_fk0` FOREIGN KEY (`id_user`) REFERENCES `customers` (`id_user`),
  ADD CONSTRAINT `orders_fk1` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`),
  ADD CONSTRAINT `orders_fk2` FOREIGN KEY (`id_payment`) REFERENCES `payment` (`id_payment`);

--
-- Ограничения внешнего ключа таблицы `order_full_info`
--
ALTER TABLE `order_full_info`
  ADD CONSTRAINT `order_full_info_fk0` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`),
  ADD CONSTRAINT `order_full_info_fk1` FOREIGN KEY (`id_book`) REFERENCES `books` (`id_book`);

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_fk0` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

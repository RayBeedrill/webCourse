-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 26 2017 г., 04:52
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
(1, 'Джек Лондон'),
(2, 'Роджер Желязны'),
(3, 'Джон Рональд Толкин'),
(4, 'Роберт Хайнлайн'),
(5, 'Джордж Мартин'),
(6, 'Стругацкие');

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
(1, 'Властелин Колец', 300, 'Фродо долго тащит кольцо в мордор', 'Экскурсия по миру Толкина', 1),
(2, 'Дверь в лето', 24, 'Путишествия во времени', 'Ученый изобретает бытовых роботов и выясняет нечто странное', 1),
(3, 'Лингвистика Эльфов', 500, 'Описания эльфиского языка', 'Все что нужно знать о эльфийском', 1),
(4, 'Жук в муравейнике', 94, 'Опытного оперативника нанимают провести расследование', 'Детективная книга в рамках фантастики, фентези, которая поднимает много вопросов и дает пищу для ума', 1),
(5, 'Хроники Амбера', 150, 'Путешествие в фантастический роман на грани современности, фентези и исторических жанров', 'Повествование Идет от лица Корвина, наследника престола Амбера который может путешествовать между мирами', 8),
(6, 'Дикие Карты', 35, 'Сборник рассказов о людях с паранормальными способностями ', 'Сборник рассказов о людях с паранормальными способностями и о том как им живется в современном мире', 1);

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
(3, 1, 3),
(6, 3, 3),
(7, 2, 4),
(9, 4, 6),
(10, 5, 2),
(13, 6, 2),
(14, 6, 5);

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
(2, 1, 2),
(3, 1, 1),
(5, 3, 3),
(6, 2, 1),
(7, 2, 2),
(8, 4, 1),
(9, 4, 2),
(10, 4, 4),
(11, 5, 2),
(12, 5, 1),
(13, 5, 4),
(14, 5, 5),
(16, 6, 1);

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
(5, 'Rostislav', 'Reznichenko', '380933906237', 'demezis1994@gmail.com', 1),
(6, 'customer1', 'customerSecondname', '38093231231231', 'emailofcustomer@gmail', 1);

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
(2, 10),
(3, 20),
(4, 30),
(5, 40),
(6, 50),
(7, 60),
(8, 70),
(9, 80),
(10, 90),
(11, 100);

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
(1, 'фантастика'),
(2, 'фєнтези'),
(3, 'техническая литература'),
(4, 'классика'),
(5, 'роман');

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
(1, 6, 2, 2, '2017-10-26 04:46:49'),
(2, 6, 1, 2, '2017-10-26 04:46:49');

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
(1, 4, 9, 0),
(2, 2, 3, 0);

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
(1, 'cash'),
(2, 'by cart');

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
(1, 'in cart'),
(2, 'shiping'),
(3, 'done');

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
(5, 1, 'demezis', '3adb4ddad83f81e17fc264f5f64a191d', '1d621d226ac30c55efe32dbacf762705', 1),
(6, 2, 'customer1', 'd45efc7c6b88a1e6564b7bf84b5cf8ed', '00698cd45077970d7fd2379bdd48a37c', 1);

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
  MODIFY `id_author` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `books`
--
ALTER TABLE `books`
  MODIFY `id_book` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `booksAuthor`
--
ALTER TABLE `booksAuthor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT для таблицы `booksGenre`
--
ALTER TABLE `booksGenre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `discount`
--
ALTER TABLE `discount`
  MODIFY `id_discount` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `genres`
--
ALTER TABLE `genres`
  MODIFY `id_genre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
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

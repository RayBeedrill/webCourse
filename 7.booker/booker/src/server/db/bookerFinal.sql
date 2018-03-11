-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 10 2017 г., 06:57
-- Версия сервера: 5.6.34
-- Версия PHP: 5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `booker`
--

-- --------------------------------------------------------

--
-- Структура таблицы `bk_events`
--

CREATE TABLE `bk_events` (
  `id_event` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_room` int(11) NOT NULL,
  `desc` varchar(300) DEFAULT NULL,
  `dateTime_start` timestamp NULL DEFAULT NULL,
  `dateTime_end` timestamp NULL DEFAULT NULL,
  `repeat_flag` tinyint(1) DEFAULT NULL,
  `id_parent` int(11) DEFAULT NULL,
  `dateTime_created` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bk_events`
--

INSERT INTO `bk_events` (`id_event`, `id_user`, `id_room`, `desc`, `dateTime_start`, `dateTime_end`, `repeat_flag`, `id_parent`, `dateTime_created`) VALUES
(92, 1, 1, 'no recurent', '2017-11-10 06:00:00', '2017-11-10 07:00:00', 0, NULL, '2017-11-09 22:00:00'),
(95, 1, 1, 'recurent weekly', '2017-11-10 07:00:00', '2017-11-10 09:00:00', 1, NULL, '2017-11-09 22:00:00'),
(96, 1, 1, 'recurent weekly', '2017-11-17 07:00:00', '2017-11-17 09:00:00', 1, 95, '2017-11-09 22:00:00'),
(97, 1, 1, 'recurent weekly', '2017-11-24 07:00:00', '2017-11-24 09:00:00', 1, 95, '2017-11-09 22:00:00'),
(98, 11, 1, 'user one \r\n\r\nrecurent bi-weekly', '2017-11-16 14:15:00', '2017-11-16 17:45:00', 1, NULL, '2017-11-09 22:00:00'),
(99, 11, 1, 'user one \r\n\r\nrecurent bi-weekly', '2017-11-30 14:15:00', '2017-11-30 17:45:00', 1, 98, '2017-11-09 22:00:00'),
(100, 12, 1, 'recurent monthly\r\n\r\nuser two', '2017-11-13 06:00:00', '2017-11-13 07:00:00', 1, NULL, '2017-11-09 22:00:00'),
(101, 12, 1, 'recurent monthly\r\n\r\nuser two', '2017-12-13 06:00:00', '2017-12-13 07:00:00', 1, 100, '2017-11-09 22:00:00'),
(102, 11, 2, 'Room two test', '2017-11-10 06:00:00', '2017-11-10 16:00:00', 0, NULL, '2017-11-09 22:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `bk_roles`
--

CREATE TABLE `bk_roles` (
  `id_role` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bk_roles`
--

INSERT INTO `bk_roles` (`id_role`, `name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `bk_rooms`
--

CREATE TABLE `bk_rooms` (
  `id_room` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bk_rooms`
--

INSERT INTO `bk_rooms` (`id_room`, `name`) VALUES
(1, 'conversation room 1'),
(2, 'conversation room 2'),
(3, 'conversation room 3');

-- --------------------------------------------------------

--
-- Структура таблицы `bk_users`
--

CREATE TABLE `bk_users` (
  `id_user` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `id_role` int(11) NOT NULL,
  `login` varchar(50) DEFAULT NULL,
  `pass` varchar(50) DEFAULT NULL,
  `userHash` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bk_users`
--

INSERT INTO `bk_users` (`id_user`, `name`, `email`, `id_role`, `login`, `pass`, `userHash`) VALUES
(1, 'admin', 'adminMail@gmail.com', 1, 'admin', '65d470079eab69537ca1ba9146566f9b', '33029ede7f652e0158609f17769f429f'),
(11, 'userOne', 'userMail@gmail.com', 2, 'user1', '65d470079eab69537ca1ba9146566f9b', 'c0126944bf43d3b95071ece8bfb77554'),
(12, 'userTwo', 'user2email@gmail.com', 2, 'user2', '65d470079eab69537ca1ba9146566f9b', ''),
(13, 'userThree', 'user3email@gmail.com', 2, 'user3', '65d470079eab69537ca1ba9146566f9b', ''),
(14, 'userFour', 'user4mail@gmail.com', 2, 'user4', '65d470079eab69537ca1ba9146566f9b', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `bk_events`
--
ALTER TABLE `bk_events`
  ADD PRIMARY KEY (`id_event`),
  ADD KEY `bk_events_fk0` (`id_user`),
  ADD KEY `bk_events_fk1` (`id_room`),
  ADD KEY `bk_events_fk2` (`id_parent`);

--
-- Индексы таблицы `bk_roles`
--
ALTER TABLE `bk_roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Индексы таблицы `bk_rooms`
--
ALTER TABLE `bk_rooms`
  ADD PRIMARY KEY (`id_room`);

--
-- Индексы таблицы `bk_users`
--
ALTER TABLE `bk_users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `bk_users_fk0` (`id_role`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `bk_events`
--
ALTER TABLE `bk_events`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;
--
-- AUTO_INCREMENT для таблицы `bk_roles`
--
ALTER TABLE `bk_roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `bk_rooms`
--
ALTER TABLE `bk_rooms`
  MODIFY `id_room` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `bk_users`
--
ALTER TABLE `bk_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `bk_events`
--
ALTER TABLE `bk_events`
  ADD CONSTRAINT `bk_events_fk0` FOREIGN KEY (`id_user`) REFERENCES `bk_users` (`id_user`),
  ADD CONSTRAINT `bk_events_fk1` FOREIGN KEY (`id_room`) REFERENCES `bk_rooms` (`id_room`);

--
-- Ограничения внешнего ключа таблицы `bk_users`
--
ALTER TABLE `bk_users`
  ADD CONSTRAINT `bk_users_fk0` FOREIGN KEY (`id_role`) REFERENCES `bk_roles` (`id_role`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

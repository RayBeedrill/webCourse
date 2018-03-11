-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 31 2017 г., 12:38
-- Версия сервера: 5.5.50
-- Версия PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `booker`
--

-- --------------------------------------------------------

--
-- Структура таблицы `bk_events`
--

CREATE TABLE IF NOT EXISTS `bk_events` (
  `id_event` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_room` int(11) NOT NULL,
  `desc` varchar(300) DEFAULT NULL,
  `dateTime_start` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dateTime_end` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `repeat_flag` tinyint(1) DEFAULT NULL,
  `id_parent` int(11) DEFAULT NULL,
  `dateTime_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `bk_roles`
--

CREATE TABLE IF NOT EXISTS `bk_roles` (
  `id_role` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

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

CREATE TABLE IF NOT EXISTS `bk_rooms` (
  `id_room` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

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

CREATE TABLE IF NOT EXISTS `bk_users` (
  `id_user` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `id_role` int(11) NOT NULL,
  `login` varchar(50) DEFAULT NULL,
  `pass` varchar(50) DEFAULT NULL,
  `userHash` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bk_users`
--

INSERT INTO `bk_users` (`id_user`, `name`, `email`, `id_role`, `login`, `pass`, `userHash`) VALUES
(1, 'Rostislav', 'demezis1994@gmail.com', 1, 'demezis', '3adb4ddad83f81e17fc264f5f64a191d', ''),
(2, 'customer', 'customer@gmail.com', 2, 'customer', '65d470079eab69537ca1ba9146566f9b', '');

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
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `bk_roles`
--
ALTER TABLE `bk_roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `bk_rooms`
--
ALTER TABLE `bk_rooms`
  MODIFY `id_room` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `bk_users`
--
ALTER TABLE `bk_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `bk_events`
--
ALTER TABLE `bk_events`
  ADD CONSTRAINT `bk_events_fk2` FOREIGN KEY (`id_parent`) REFERENCES `bk_events` (`id_event`),
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

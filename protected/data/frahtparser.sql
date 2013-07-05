-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 05 2013 г., 19:50
-- Версия сервера: 5.1.68-community-log
-- Версия PHP: 5.3.23

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `frahtparser`
--

-- --------------------------------------------------------

--
-- Структура таблицы `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 - Транспорт, 2 - Груз',
  `name` varchar(255) NOT NULL,
  `phones` varchar(255) NOT NULL,
  `is_parsed` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `url` (`url`),
  KEY `type` (`type`),
  KEY `is_parsed` (`is_parsed`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=599 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET ucs2 NOT NULL,
  `company_id` int(11) NOT NULL,
  `phones` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

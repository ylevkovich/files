-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июн 11 2015 г., 08:53
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `database_cms`
--

-- --------------------------------------------------------

--
-- Структура таблицы `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `path` text NOT NULL,
  `share_link` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `files`
--

INSERT INTO `files` (`id`, `id_user`, `path`, `share_link`) VALUES
(1, 63, 'upload/demo/winrar-x64-511ru.exe', 'vkO3F44YD1'),
(2, 62, 'upload/Yurii_levkovich/winrar-x64-511ru.exe', 'g3rYtXEf43'),
(3, 62, 'upload/Yurii_levkovich/AsusSetup.exe', 'HXn7AcbyWt'),
(4, 62, 'upload/Yurii_levkovich/English.ini', '4yqjmyVYDk'),
(5, 62, 'upload/Yurii_levkovich/InstCtrl.txt', 'dgnw3y7zH'),
(6, 62, 'upload/Yurii_levkovich/download.jpg', 'ueM0spGlNy'),
(7, 62, 'upload/Yurii_levkovich/Desert.jpg', 'nJbZfQrWRM'),
(8, 62, 'upload/Yurii_levkovich/Koala.jpg', 'ArpoB7D1Y3');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=65 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `pass`, `email`) VALUES
(64, 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'demo@demo.demo'),
(62, 'Yurii_levkovich', 'bda9f42e0c8a294ecdf5cc72aae6a701', 'Yurii_levkovich@mail.ru');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

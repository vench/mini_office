-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Авг 20 2014 г., 23:21
-- Версия сервера: 5.1.73-0ubuntu0.10.04.1-log
-- Версия PHP: 5.2.17-0ubuntu0ppa3~lucid

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `wpoli_1753_corp`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Advert`
--

CREATE TABLE IF NOT EXISTS `Advert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `dateadv` int(11) NOT NULL,
  `timeadv` time NOT NULL,
  `advert` text NOT NULL,
  `important` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `Advert`
--

INSERT INTO `Advert` (`id`, `user_id`, `dateadv`, `timeadv`, `advert`, `important`) VALUES
(2, 2, 1405713600, '16:45:00', 'Df;yjt j,]zdktybt<br>', 1),
(3, 2, 1406404800, '16:45:00', 'ggggrg<br>ggggrg<br>ggggrg<br>ggggrg<br><br><br><br>', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `AuthAssignment`
--

CREATE TABLE IF NOT EXISTS `AuthAssignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `AuthAssignment`
--

INSERT INTO `AuthAssignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('Admin', '2', NULL, 'N;'),
('adverts', '2', NULL, 'N;'),
('routine', '3', NULL, 'N;'),
('subdivisions', '2', NULL, 'N;'),
('tabel', '2', NULL, 'N;'),
('users', '2', NULL, 'N;');

-- --------------------------------------------------------

--
-- Структура таблицы `AuthItem`
--

CREATE TABLE IF NOT EXISTS `AuthItem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `AuthItem`
--

INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('Admin', 2, 'Администратор', NULL, 'N;'),
('adverts', 0, 'Управление объявлениями', NULL, NULL),
('Authenticated', 2, 'Зарегистрированный пользователь', NULL, 'N;'),
('documents', 0, 'Управление документами', NULL, NULL),
('events', 0, 'Управление событиями', NULL, NULL),
('Guest', 2, 'Гость', NULL, 'N;'),
('instruct.set', 0, 'Давать поручения', NULL, NULL),
('message.remove', 0, 'Удалить сообщение', NULL, NULL),
('places', 0, 'Управление зданиями/местами', NULL, NULL),
('posts', 0, 'Управление должностями', NULL, NULL),
('routine', 0, 'Распорядок дня ', NULL, NULL),
('srules', 0, 'Управление правами доступа', NULL, NULL),
('subdivisions', 0, 'Управление подразделениями', NULL, NULL),
('tabel', 0, 'Управление тебелем', NULL, 'N;'),
('users', 0, 'Управление пользователями', NULL, NULL),
('workDeviations', 0, 'Управление причинами отсутствия', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `AuthItemChild`
--

CREATE TABLE IF NOT EXISTS `AuthItemChild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Documents`
--

CREATE TABLE IF NOT EXISTS `Documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `typedata` tinyint(4) NOT NULL DEFAULT '0',
  `description` varchar(128) NOT NULL,
  `url` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `Documents`
--

INSERT INTO `Documents` (`id`, `type`, `user_id`, `typedata`, `description`, `url`) VALUES
(1, 2, 2, 1, 'ууу', 'http://vk.com/id795744?z=photo795744_334169896%2Fphotos795744'),
(2, 2, 2, 1, '65656', '1.jpg'),
(3, 2, 2, 0, 'Некий набор шаблонов', 'ZfortYiiBook.0.4.pdf'),
(4, 2, 2, 0, '777', 'popup_районы.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `Event`
--

CREATE TABLE IF NOT EXISTS `Event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT 'creator',
  `place_id` int(11) DEFAULT NULL,
  `type_event_id` int(11) DEFAULT NULL,
  `dateevent` int(11) NOT NULL,
  `dateevent2` int(11) NOT NULL DEFAULT '0',
  `timestart` time NOT NULL,
  `timeend` time NOT NULL,
  `cyclic` tinyint(4) NOT NULL DEFAULT '0',
  `show_all` tinyint(4) NOT NULL DEFAULT '1',
  `name` varchar(128) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`place_id`,`type_event_id`),
  KEY `place_id` (`place_id`),
  KEY `type_event_id` (`type_event_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Дамп данных таблицы `Event`
--

INSERT INTO `Event` (`id`, `user_id`, `place_id`, `type_event_id`, `dateevent`, `dateevent2`, `timestart`, `timeend`, `cyclic`, `show_all`, `name`, `description`) VALUES
(1, 2, 2, 1, 1397246400, 0, '12:15:00', '13:30:00', 0, 1, 'test', '<p>\r\n	6565\r\n</p>'),
(2, 2, 1, 2, 1398542400, 0, '11:09:00', '12:30:00', 1, 1, 'Русское', 'екек'),
(3, 2, 1, 1, 1397505600, 0, '11:00:00', '11:30:00', 1, 1, 'Некоторый текст', '<p>\r\n	 re\r\n</p>'),
(4, 2, 1, 1, 1398196800, 0, '09:45:00', '09:45:00', 0, 1, 'rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr', 're'),
(5, 2, 1, 1, 1398196800, 0, '01:00:00', '01:00:00', 0, 1, '4343', '43'),
(6, 2, 1, 1, 1397332800, 0, '01:30:00', '01:30:00', 0, 1, 'DC', 'scs'),
(7, 2, 1, 1, 1398456000, 0, '09:15:00', '12:15:00', 0, 1, 'Субботник', 'Субботник'),
(8, 2, 1, 1, 1403294400, 0, '12:30:00', '12:30:00', 0, 1, 'Очень важное событие!', 'ыфвф ывфыв фыв фыв '),
(9, 2, 1, 1, 1400875200, 0, '10:30:00', '10:30:00', 0, 1, 'ыыыыыыыыыыы', 'ыыыыыыыыыыыыыыы'),
(11, 2, NULL, NULL, 1399579200, 0, '11:00:00', '12:00:00', 0, 1, 'День победы!', 'День победы!'),
(12, 2, 4, 3, 1405281600, 0, '04:00:00', '05:00:00', 0, 1, 'Собеседование с новым сотрудником', '<p>\r\n	     vvvv\r\n</p>'),
(13, 2, 2, 1, 1405368000, 0, '02:15:00', '02:15:00', 0, 1, 'Совещание по поводу покупки канцелярии!!!', '<p>\r\n	<span style="background-color: initial;">Совещание по поводу покупки канцелярии!!!</span>\r\n</p>'),
(14, 2, 1, 3, 1405454400, 0, '03:00:00', '04:00:00', 0, 1, 'Бронь переговорки', '<p>\r\n	ау\r\n</p>'),
(15, 2, 1, 3, 1405540800, 0, '03:45:00', '03:45:00', 0, 1, 'xxxx', '<p>\r\n	6565\r\n</p>'),
(16, NULL, 1, 3, 1405540800, 0, '03:45:00', '03:45:00', 0, 1, '6565', '<p>\r\n	666\r\n</p>'),
(17, 2, 1, 3, 1405540800, 0, '04:00:00', '04:00:00', 0, 1, 'u65u65', '<p>\r\n	666\r\n</p>'),
(18, 2, 1, 3, 1405627200, 0, '04:30:00', '04:30:00', 0, 1, '767', '<p>\r\n	76\r\n</p>'),
(19, 2, 1, 4, 1405713600, 0, '12:30:00', '12:30:00', 0, 1, 'yyyy', '<p>\r\n	yt\r\n</p>'),
(20, 2, 2, 4, 1405627200, 0, '02:15:00', '02:15:00', 0, 0, '777777', '<p>\r\n	76\r\n</p>'),
(21, 2, NULL, 4, 1405627200, 0, '02:30:00', '02:30:00', 0, 0, '6666', '<p>\r\n	777\r\n</p>'),
(22, 2, NULL, 4, 1405627200, 0, '02:30:00', '02:30:00', 0, 0, '6666', '<p>\r\n	777\r\n</p>'),
(23, 2, 1, 4, 1404244800, 0, '02:45:00', '02:45:00', 0, 0, '656565', '<p>\r\n	65\r\n</p>'),
(24, 2, 1, 4, 1404244800, 0, '02:45:00', '02:45:00', 0, 0, '656565', '<p>\r\n	65\r\n</p>'),
(25, 2, 1, 4, 1404244800, 0, '02:45:00', '02:45:00', 0, 0, '656565', '<p>\r\n	65\r\n</p>'),
(26, 2, 1, 4, 1406232000, 0, '03:00:00', '03:00:00', 0, 0, '7676767', '<p>\r\n	7777777777777777\r\n</p>'),
(27, 2, 2, 4, 1405540800, 0, '03:00:00', '03:00:00', 0, 0, 'рекеркерк', '<p>\r\n	рррррррррр\r\n</p>'),
(28, 2, 2, 4, 1406232000, 0, '03:00:00', '03:00:00', 0, 0, '76', '<p>\r\n	76\r\n</p>'),
(29, 2, 3, 4, 1405713600, 0, '03:00:00', '03:00:00', 0, 0, 'рекре', '<p>\r\n	ре\r\n</p>'),
(30, 3, 2, 4, 1405540800, 0, '05:15:00', '05:45:00', 0, 0, 'ПрИХОДИТЕ!!!', 'admin7'),
(31, 3, 1, 4, 1405627200, 0, '03:30:00', '03:30:00', 0, 0, 'Очень длинное название', 'Очень длинное названиеОчень длинное название\r\nОчень длинное название\r\nОчень длинное название\r\nОчень длинное название\r\nОчень длинное названиеОчень длинное названиеОчень длинное названиеы Очень длинное название'),
(32, 2, 1, 4, 1405627200, 0, '03:30:00', '03:30:00', 0, 0, 'Собеседование с новым сотрудником', '<p>\r\n	 <span style="background-color: initial;">Очень длинное название</span>\r\n</p>\r\n<p>\r\n	 <span style="background-color: initial;"><br>\r\n	 </span>\r\n</p>\r\n<p>\r\n	 <span style="background-color: initial;"> </span>\r\n</p>\r\n<iframe width="420" height="315" src="//www.youtube.com/embed/UgwziUTKmto" frameborder="0" allowfullscreen="">\r\n</iframe>\r\n<p>\r\n	 Очень длинное название\r\n</p>\r\n<p>\r\n	 <span style="background-color: initial;">1</span>\r\n</p>\r\n<p>\r\n	 <span style="background-color: initial;"><br>\r\n	 </span>\r\n</p>\r\n<p>\r\n	 Очень длинное название\r\n</p>'),
(33, 2, 2, 3, 1405540800, 0, '01:45:00', '01:45:00', 0, 1, 'grer', '<p>\r\n	greg\r\n</p>'),
(34, 2, NULL, 4, 1405886400, 0, '15:15:00', '15:15:00', 0, 0, '767', '<p>\r\n	76\r\n</p>'),
(35, 2, 2, 3, 1404244800, 0, '15:30:00', '16:30:00', 0, 1, 'gregr', '<p>\r\n	greg\r\n</p>'),
(36, 2, 1, 3, 1405972800, 0, '16:00:00', '17:00:00', 0, 1, 'Переговоры с Theysohn', '<p>\r\n	Приедут представители поставщика\r\n</p>'),
(37, 2, 2, 4, 1407355200, 0, '17:30:00', '17:45:00', 0, 0, 'test', '<p>\r\n	Давай суды\r\n</p>'),
(38, 2, 1, 3, 1407355200, 0, '17:15:00', '17:30:00', 0, 1, 'test', '<p>\r\n	бронирование переговорное!!!\r\n</p>'),
(39, 2, 1, 3, 1408564800, 0, '17:30:00', '18:00:00', 0, 1, 'аатаа', '<p>\r\n	говорить\r\n</p>'),
(40, 2, 1, 1, 1407528000, 0, '20:45:00', '20:45:00', 0, 1, 'dwqw', '<p>\r\n	dwq\r\n</p>'),
(41, 2, 1, 1, 1407960000, 0, '23:00:00', '23:00:00', 0, 1, 'scccccccccc', '<p>\r\n	admin\r\n</p>\r\n<p>\r\n	admin\r\n</p>\r\n<p>\r\n	admin\r\n</p>');

-- --------------------------------------------------------

--
-- Структура таблицы `EventInvited`
--

CREATE TABLE IF NOT EXISTS `EventInvited` (
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`event_id`,`user_id`),
  KEY `event_id` (`event_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `EventInvited`
--

INSERT INTO `EventInvited` (`event_id`, `user_id`) VALUES
(8, 2),
(9, 2),
(22, 2),
(24, 2),
(25, 2),
(26, 2),
(28, 2),
(29, 2),
(30, 2),
(31, 2),
(34, 2),
(37, 2),
(1, 3),
(32, 3),
(9, 6),
(1, 7),
(27, 8);

-- --------------------------------------------------------

--
-- Структура таблицы `EventType`
--

CREATE TABLE IF NOT EXISTS `EventType` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8 NOT NULL,
  `color` varchar(8) CHARACTER SET utf8 NOT NULL,
  `name_msg` varchar(128) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `EventType`
--

INSERT INTO `EventType` (`id`, `name`, `color`, `name_msg`) VALUES
(1, 'Совещение', '#cccc00', 'Участие в совещании'),
(2, 'Собеседование', '#ff0000', 'Приглашение на собеседование'),
(3, 'Бронирование переговорной', 'blue', 'Бронирование переговорной'),
(4, 'Запросить встречу', 'orange', 'Запрос встречи');

-- --------------------------------------------------------

--
-- Структура таблицы `Instruct`
--

CREATE TABLE IF NOT EXISTS `Instruct` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_to_id` int(11) NOT NULL,
  `datecreate` int(11) NOT NULL,
  `deadline` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `name` varchar(128) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `user_to_id` (`user_to_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='поручения' AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `Instruct`
--

INSERT INTO `Instruct` (`id`, `user_id`, `user_to_id`, `datecreate`, `deadline`, `status`, `name`, `description`) VALUES
(7, 2, 2, 1, 1406318400, 4, 'Новое поручение', 'вввввввввввввввввввввввввввввввв'),
(8, 2, 2, 1404719129, 1406750400, 1, 'Настроить сеть', '777'),
(9, 2, 3, 10, 1413230400, 4, 'Запросить КП', 'erwsfsdfsdfsdfsdf');

-- --------------------------------------------------------

--
-- Структура таблицы `Message`
--

CREATE TABLE IF NOT EXISTS `Message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT 'кто создал',
  `user_to_id` int(11) DEFAULT NULL,
  `datetime` int(11) NOT NULL,
  `is_new` tinyint(4) NOT NULL DEFAULT '1',
  `arhive` tinyint(4) NOT NULL,
  `subject` varchar(128) CHARACTER SET utf8 NOT NULL COMMENT 'Тема',
  `text` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `user_to_id` (`user_to_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Дамп данных таблицы `Message`
--

INSERT INTO `Message` (`id`, `user_id`, `user_to_id`, `datetime`, `is_new`, `arhive`, `subject`, `text`) VALUES
(1, 2, 2, 2014, 0, 1, 'eeee', 'eee'),
(2, 2, 2, 2014, 0, 1, 'eeee', 'eee'),
(4, 2, 6, 1398020076, 0, 0, 'Просто', 'сссссссссссссссссс<b>мкмкм<br>кукук</b>'),
(5, 2, 3, 1398020276, 1, 0, 'ewewew', '<span><div>can we see your code for your CJuiAutoComplete widget?&nbsp;–&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/users/1552160/stu">Stu</a>&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/questions/12461856/autocomplete-other-field-with-yii-cjuiautocomplete#comment16760692_12461856">Sep 17 ''12 at 14:56</a></div><span>&nbsp;&nbsp;&nbsp;<div>Additional code added. Sorry, I posted the original question yesterday evening but I was a bit in a hurry so it was "quick and dirty" :-) Hope it''s more clear now&nbsp;–&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/users/249245/tjeuten">tjeuten</a>&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/questions/12461856/autocomplete-other-field-with-yii-cjuiautocomplete#comment16777202_12461856">Sep 18 ''12 at 7:10</a></div></span></span><span><div>can we see your code for your CJuiAutoComplete widget?&nbsp;–&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/users/1552160/stu">Stu</a>&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/questions/12461856/autocomplete-other-field-with-yii-cjuiautocomplete#comment16760692_12461856">Sep 17 ''12 at 14:56</a></div><span>&nbsp;&nbsp;&nbsp;<div>Additional code added. Sorry, I posted the original question yesterday evening but I was a bit in a hurry so it was "quick and dirty" :-) Hope it''s more clear now&nbsp;–&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/users/249245/tjeuten">tjeuten</a>&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/questions/12461856/autocomplete-other-field-with-yii-cjuiautocomplete#comment16777202_12461856">Sep 18 ''12 at 7:10</a></div></span></span><span><div>can we see your code for your CJuiAutoComplete widget?&nbsp;–&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/users/1552160/stu">Stu</a>&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/questions/12461856/autocomplete-other-field-with-yii-cjuiautocomplete#comment16760692_12461856">Sep 17 ''12 at 14:56</a></div><span>&nbsp;&nbsp;&nbsp;<div>Additional code added. Sorry, I posted the original question yesterday evening but I was a bit in a hurry so it was "quick and dirty" :-) Hope it''s more clear now&nbsp;–&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/users/249245/tjeuten">tjeuten</a>&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/questions/12461856/autocomplete-other-field-with-yii-cjuiautocomplete#comment16777202_12461856">Sep 18 ''12 at 7:10</a></div></span></span>'),
(6, 2, 6, 1398020276, 0, 0, 'ewewew', '<span><div>can we see your code for your CJuiAutoComplete widget?&nbsp;–&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/users/1552160/stu">Stu</a>&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/questions/12461856/autocomplete-other-field-with-yii-cjuiautocomplete#comment16760692_12461856">Sep 17 ''12 at 14:56</a></div><span>&nbsp;&nbsp;&nbsp;<div>Additional code added. Sorry, I posted the original question yesterday evening but I was a bit in a hurry so it was "quick and dirty" :-) Hope it''s more clear now&nbsp;–&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/users/249245/tjeuten">tjeuten</a>&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/questions/12461856/autocomplete-other-field-with-yii-cjuiautocomplete#comment16777202_12461856">Sep 18 ''12 at 7:10</a></div></span></span><span><div>can we see your code for your CJuiAutoComplete widget?&nbsp;–&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/users/1552160/stu">Stu</a>&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/questions/12461856/autocomplete-other-field-with-yii-cjuiautocomplete#comment16760692_12461856">Sep 17 ''12 at 14:56</a></div><span>&nbsp;&nbsp;&nbsp;<div>Additional code added. Sorry, I posted the original question yesterday evening but I was a bit in a hurry so it was "quick and dirty" :-) Hope it''s more clear now&nbsp;–&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/users/249245/tjeuten">tjeuten</a>&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/questions/12461856/autocomplete-other-field-with-yii-cjuiautocomplete#comment16777202_12461856">Sep 18 ''12 at 7:10</a></div></span></span><span><div>can we see your code for your CJuiAutoComplete widget?&nbsp;–&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/users/1552160/stu">Stu</a>&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/questions/12461856/autocomplete-other-field-with-yii-cjuiautocomplete#comment16760692_12461856">Sep 17 ''12 at 14:56</a></div><span>&nbsp;&nbsp;&nbsp;<div>Additional code added. Sorry, I posted the original question yesterday evening but I was a bit in a hurry so it was "quick and dirty" :-) Hope it''s more clear now&nbsp;–&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/users/249245/tjeuten">tjeuten</a>&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/questions/12461856/autocomplete-other-field-with-yii-cjuiautocomplete#comment16777202_12461856">Sep 18 ''12 at 7:10</a></div></span></span>'),
(7, 2, 2, 1398020303, 0, 0, 'cscsc', 'вывывы<span><div>can we see your code for your CJuiAutoComplete widget?&nbsp;–&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/users/1552160/stu">Stu</a>&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/questions/12461856/autocomplete-other-field-with-yii-cjuiautocomplete#comment16760692_12461856">Sep 17 ''12 at 14:56</a></div><span>&nbsp;&nbsp;&nbsp;<div>Additional code added. Sorry, I posted the original question yesterday evening but I was a bit in a hurry so it was "quick and dirty" :-) Hope it''s more clear now&nbsp;–&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/users/249245/tjeuten">tjeuten</a>&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/questions/12461856/autocomplete-other-field-with-yii-cjuiautocomplete#comment16777202_12461856">Sep 18 ''12 at 7:10</a></div></span></span><span><div>can we see your code for your CJuiAutoComplete widget?&nbsp;–&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/users/1552160/stu">Stu</a>&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/questions/12461856/autocomplete-other-field-with-yii-cjuiautocomplete#comment16760692_12461856">Sep 17 ''12 at 14:56</a></div><span>&nbsp;&nbsp;&nbsp;<div>Additional code added. Sorry, I posted the original question yesterday evening but I was a bit in a hurry so it was "quick and dirty" :-) Hope it''s more clear now&nbsp;–&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/users/249245/tjeuten">tjeuten</a>&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/questions/12461856/autocomplete-other-field-with-yii-cjuiautocomplete#comment16777202_12461856">Sep 18 ''12 at 7:10</a></div></span></span><span><div>can we see your code for your CJuiAutoComplete widget?&nbsp;–&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/users/1552160/stu">Stu</a>&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/questions/12461856/autocomplete-other-field-with-yii-cjuiautocomplete#comment16760692_12461856">Sep 17 ''12 at 14:56</a></div><span>&nbsp;&nbsp;&nbsp;<div>Additional code added. Sorry, I posted the original question yesterday evening but I was a bit in a hurry so it was "quick and dirty" :-) Hope it''s more clear now&nbsp;–&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/users/249245/tjeuten">tjeuten</a>&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/questions/12461856/autocomplete-other-field-with-yii-cjuiautocomplete#comment16777202_12461856">Sep 18 ''12 at 7:10</a></div></span></span><span><div>can we see your code for your CJuiAutoComplete widget?&nbsp;–&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/users/1552160/stu">Stu</a>&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/questions/12461856/autocomplete-other-field-with-yii-cjuiautocomplete#comment16760692_12461856">Sep 17 ''12 at 14:56</a></div><span>&nbsp;&nbsp;&nbsp;<div>Additional code added. Sorry, I posted the original question yesterday evening but I was a bit in a hurry so it was "quick and dirty" :-) Hope it''s more clear now&nbsp;–&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/users/249245/tjeuten">tjeuten</a>&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/questions/12461856/autocomplete-other-field-with-yii-cjuiautocomplete#comment16777202_12461856">Sep 18 ''12 at 7:10</a></div></span></span>'),
(8, 2, 3, 1398020303, 1, 0, 'cscsc', 'вывывы<span><div>can we see your code for your CJuiAutoComplete widget?&nbsp;–&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/users/1552160/stu">Stu</a>&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/questions/12461856/autocomplete-other-field-with-yii-cjuiautocomplete#comment16760692_12461856">Sep 17 ''12 at 14:56</a></div><span>&nbsp;&nbsp;&nbsp;<div>Additional code added. Sorry, I posted the original question yesterday evening but I was a bit in a hurry so it was "quick and dirty" :-) Hope it''s more clear now&nbsp;–&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/users/249245/tjeuten">tjeuten</a>&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/questions/12461856/autocomplete-other-field-with-yii-cjuiautocomplete#comment16777202_12461856">Sep 18 ''12 at 7:10</a></div></span></span><span><div>can we see your code for your CJuiAutoComplete widget?&nbsp;–&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/users/1552160/stu">Stu</a>&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/questions/12461856/autocomplete-other-field-with-yii-cjuiautocomplete#comment16760692_12461856">Sep 17 ''12 at 14:56</a></div><span>&nbsp;&nbsp;&nbsp;<div>Additional code added. Sorry, I posted the original question yesterday evening but I was a bit in a hurry so it was "quick and dirty" :-) Hope it''s more clear now&nbsp;–&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/users/249245/tjeuten">tjeuten</a>&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/questions/12461856/autocomplete-other-field-with-yii-cjuiautocomplete#comment16777202_12461856">Sep 18 ''12 at 7:10</a></div></span></span><span><div>can we see your code for your CJuiAutoComplete widget?&nbsp;–&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/users/1552160/stu">Stu</a>&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/questions/12461856/autocomplete-other-field-with-yii-cjuiautocomplete#comment16760692_12461856">Sep 17 ''12 at 14:56</a></div><span>&nbsp;&nbsp;&nbsp;<div>Additional code added. Sorry, I posted the original question yesterday evening but I was a bit in a hurry so it was "quick and dirty" :-) Hope it''s more clear now&nbsp;–&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/users/249245/tjeuten">tjeuten</a>&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/questions/12461856/autocomplete-other-field-with-yii-cjuiautocomplete#comment16777202_12461856">Sep 18 ''12 at 7:10</a></div></span></span><span><div>can we see your code for your CJuiAutoComplete widget?&nbsp;–&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/users/1552160/stu">Stu</a>&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/questions/12461856/autocomplete-other-field-with-yii-cjuiautocomplete#comment16760692_12461856">Sep 17 ''12 at 14:56</a></div><span>&nbsp;&nbsp;&nbsp;<div>Additional code added. Sorry, I posted the original question yesterday evening but I was a bit in a hurry so it was "quick and dirty" :-) Hope it''s more clear now&nbsp;–&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/users/249245/tjeuten">tjeuten</a>&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/questions/12461856/autocomplete-other-field-with-yii-cjuiautocomplete#comment16777202_12461856">Sep 18 ''12 at 7:10</a></div></span></span>'),
(9, 2, 5, 1398020303, 1, 0, 'cscsc', 'вывывы<span><div>can we see your code for your CJuiAutoComplete widget?&nbsp;–&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/users/1552160/stu">Stu</a>&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/questions/12461856/autocomplete-other-field-with-yii-cjuiautocomplete#comment16760692_12461856">Sep 17 ''12 at 14:56</a></div><span>&nbsp;&nbsp;&nbsp;<div>Additional code added. Sorry, I posted the original question yesterday evening but I was a bit in a hurry so it was "quick and dirty" :-) Hope it''s more clear now&nbsp;–&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/users/249245/tjeuten">tjeuten</a>&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/questions/12461856/autocomplete-other-field-with-yii-cjuiautocomplete#comment16777202_12461856">Sep 18 ''12 at 7:10</a></div></span></span><span><div>can we see your code for your CJuiAutoComplete widget?&nbsp;–&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/users/1552160/stu">Stu</a>&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/questions/12461856/autocomplete-other-field-with-yii-cjuiautocomplete#comment16760692_12461856">Sep 17 ''12 at 14:56</a></div><span>&nbsp;&nbsp;&nbsp;<div>Additional code added. Sorry, I posted the original question yesterday evening but I was a bit in a hurry so it was "quick and dirty" :-) Hope it''s more clear now&nbsp;–&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/users/249245/tjeuten">tjeuten</a>&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/questions/12461856/autocomplete-other-field-with-yii-cjuiautocomplete#comment16777202_12461856">Sep 18 ''12 at 7:10</a></div></span></span><span><div>can we see your code for your CJuiAutoComplete widget?&nbsp;–&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/users/1552160/stu">Stu</a>&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/questions/12461856/autocomplete-other-field-with-yii-cjuiautocomplete#comment16760692_12461856">Sep 17 ''12 at 14:56</a></div><span>&nbsp;&nbsp;&nbsp;<div>Additional code added. Sorry, I posted the original question yesterday evening but I was a bit in a hurry so it was "quick and dirty" :-) Hope it''s more clear now&nbsp;–&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/users/249245/tjeuten">tjeuten</a>&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/questions/12461856/autocomplete-other-field-with-yii-cjuiautocomplete#comment16777202_12461856">Sep 18 ''12 at 7:10</a></div></span></span><span><div>can we see your code for your CJuiAutoComplete widget?&nbsp;–&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/users/1552160/stu">Stu</a>&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/questions/12461856/autocomplete-other-field-with-yii-cjuiautocomplete#comment16760692_12461856">Sep 17 ''12 at 14:56</a></div><span>&nbsp;&nbsp;&nbsp;<div>Additional code added. Sorry, I posted the original question yesterday evening but I was a bit in a hurry so it was "quick and dirty" :-) Hope it''s more clear now&nbsp;–&nbsp;&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/users/249245/tjeuten">tjeuten</a>&nbsp;<a target="_blank" rel="nofollow" href="http://stackoverflow.com/questions/12461856/autocomplete-other-field-with-yii-cjuiautocomplete#comment16777202_12461856">Sep 18 ''12 at 7:10</a></div></span></span>'),
(10, 2, 7, 1398104373, 1, 0, 'аа', 'аууууууууууууу'),
(11, 2, 2, 1398108683, 0, 0, 'новая тема', 'Необходимо исправить следующие ошибки:<ul><li>Необходимо заполнить поле «Сообщение».Необходимо исправить следующие ошибки:<ul><li>Необходимо заполнить поле «Сообщение».Необходимо исправить следующие ошибки:<ul><li>Необходимо заполнить поле «Сообщение».</li></ul></li></ul></li></ul>'),
(12, 2, 3, 1398108683, 1, 0, 'новая тема', 'Необходимо исправить следующие ошибки:<ul><li>Необходимо заполнить поле «Сообщение».Необходимо исправить следующие ошибки:<ul><li>Необходимо заполнить поле «Сообщение».Необходимо исправить следующие ошибки:<ul><li>Необходимо заполнить поле «Сообщение».</li></ul></li></ul></li></ul>'),
(13, 2, 7, 1398108683, 1, 0, 'новая тема', 'Необходимо исправить следующие ошибки:<ul><li>Необходимо заполнить поле «Сообщение».Необходимо исправить следующие ошибки:<ul><li>Необходимо заполнить поле «Сообщение».Необходимо исправить следующие ошибки:<ul><li>Необходимо заполнить поле «Сообщение».</li></ul></li></ul></li></ul>'),
(16, 2, 8, 1399402121, 1, 0, 'cdddddd', 'ddddccccccccccccccccccc'),
(17, 2, 4, 1399402138, 0, 0, 'sssssssssssss', 'sssssssssssssssss'),
(18, 2, 4, 1399403351, 0, 1, 'Hello', 'HelloHello'),
(19, 2, 2, 1404216119, 0, 0, 'вывы', 'вввввввввввввввввввввввв'),
(20, 2, 7, 1404216119, 1, 0, 'вывы', 'вввввввввввввввввввввввв'),
(21, 2, 2, 1404220401, 0, 0, 'Новое поручение', 'Вы получили новое поручение "Получить документы"<br><a href="#">Просмотреть подробно</a>'),
(22, 2, 2, 1404715616, 0, 0, 'Новое поручение', 'Вы получили новое поручение "Что то сделать"<br><a href="#">Просмотреть подробно</a>'),
(23, 2, 3, 1404716971, 1, 0, 'Новое поручение', 'Вы получили новое поручение "76767"<br><a href="#">Просмотреть подробно</a>'),
(24, 2, 2, 1404717947, 0, 0, 'Новое поручение', 'Вы получили новое поручение "мамама"<br><a href="#">Просмотреть подробно</a>'),
(25, 2, 2, 1404718727, 0, 0, 'Новое поручение', 'Вы получили новое поручение "Новое поручение"<br><a href="#">Просмотреть подробно</a>'),
(26, 2, 2, 1404719129, 0, 0, 'Новое поручение', 'Вы получили новое поручение "Настроить сеть"<br><a href="#">Просмотреть подробно</a>'),
(27, 2, 2, 1405680945, 0, 0, 'Участие в событии 656565', 'Участие в событии "Запросить встречу: 656565" '),
(28, 2, 2, 1405681232, 0, 0, 'Запросить встречу: 7676767', 'Участие в "Запросить встречу: 7676767" <br/><a href="/index.php?r=sEvent/event&amp;id=26">Подробно</a>'),
(29, 2, 8, 1405681533, 1, 0, 'Запрос встречи: рекеркерк', 'Участие в "Запрос встречи: рекеркерк" <br/><a href="/index.php?r=sEvent/event&amp;id=27">Подробно</a>'),
(30, 2, 2, 1405681577, 0, 0, 'Запрос встречи: 76', 'Участие в "Запрос встречи: 76" <br/><a href="/index.php?r=sEvent/event&amp;id=28">Подробно</a>'),
(31, 2, 2, 1405681743, 0, 0, 'Запрос встречи: рекре', 'Участие в "Запрос встречи: рекре"<br/>Дата 19.07.2014 03:00 03:00<br/><a href="/index.php?r=sEvent/event&amp;id=29">Подробно</a>'),
(32, 3, 2, 1405682870, 0, 0, 'Запрос встречи: ПрИХОДИТЕ!!!', 'Участие в "Запрос встречи: ПрИХОДИТЕ!!!"<br/>Дата 17.07.2014; c 05:15 по 05:45<br/><a href="/index.php?r=sEvent/event&amp;id=30">Подробно</a>'),
(33, 3, 2, 1405683140, 0, 0, 'Запрос встречи: Очень длинное название', 'Участие в "Запрос встречи: Очень длинное название"<br/>Дата 18.07.2014; c 03:30 по 03:30<br/><a href="/index.php?r=sEvent/event&amp;id=31">Подробно</a>'),
(34, 2, 3, 1405683315, 0, 0, 'Запрос встречи: Собеседование с новым сотрудником', 'Участие в "Запрос встречи: Собеседование с новым сотрудником"<br/>Дата 18.07.2014; c 03:30 по 03:30<br/><a href="/index.php?r=sEvent/event&amp;id=32">Подробно</a>'),
(35, 2, 2, 1405942206, 0, 0, 'Запрос встречи: 767', 'Участие в "Запрос встречи: 767"<br/>Дата 21.07.2014; c 15:15 по 15:15<br/><a href="/index.php?r=sEvent/event&amp;id=34">Подробно</a>'),
(36, 2, 2, 1407417268, 0, 0, 'Запрос встречи: test', 'Участие в "Запрос встречи: test"<br/>Дата 07.08.2014; c 17:30 по 17:45<br/><a href="/index.php?r=sEvent/event&amp;id=37">Подробно</a>');

-- --------------------------------------------------------

--
-- Структура таблицы `Place`
--

CREATE TABLE IF NOT EXISTS `Place` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `Place`
--

INSERT INTO `Place` (`id`, `name`) VALUES
(1, 'Переговорная 1'),
(2, 'Офис 27'),
(3, 'кабинет №320'),
(4, 'Переговорная 675');

-- --------------------------------------------------------

--
-- Структура таблицы `Post`
--

CREATE TABLE IF NOT EXISTS `Post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `Post`
--

INSERT INTO `Post` (`id`, `parent_id`, `name`) VALUES
(3, NULL, 'Менеджер'),
(4, NULL, 'Инженер'),
(7, NULL, 'Убрщица'),
(8, NULL, 'Разработчик ПО'),
(9, NULL, 'Охранник'),
(11, 3, 'Менеджер по персоналу'),
(12, NULL, 'Начальник службы безопасности');

-- --------------------------------------------------------

--
-- Структура таблицы `RememberPass`
--

CREATE TABLE IF NOT EXISTS `RememberPass` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `actual` tinyint(4) NOT NULL DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `datetime` int(11) DEFAULT NULL,
  `code` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `RememberPass`
--

INSERT INTO `RememberPass` (`id`, `actual`, `user_id`, `datetime`, `code`) VALUES
(1, 1, 2, 1396290789, 'ca509838573b6ebae98cdba53cd098b7');

-- --------------------------------------------------------

--
-- Структура таблицы `Rights`
--

CREATE TABLE IF NOT EXISTS `Rights` (
  `itemname` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`itemname`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `Routine`
--

CREATE TABLE IF NOT EXISTS `Routine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `for_all` tinyint(4) NOT NULL,
  `starttime` time NOT NULL,
  `endtime` time NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(128) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `Routine`
--

INSERT INTO `Routine` (`id`, `for_all`, `starttime`, `endtime`, `user_id`, `name`, `description`) VALUES
(1, 1, '09:10:00', '09:10:00', 2, 'Развоз от м. Академическая', 'Развоз от м. Академическая'),
(2, 1, '09:30:00', '09:30:00', 2, ' Начало рабочего дня', ' Начало рабочего дня'),
(3, 1, '12:00:00', '16:00:00', 2, 'Обед 30 минут', 'Обед 30 минут'),
(4, 1, '18:00:00', '18:00:00', 2, 'Конец рабочего дня', 'Конец рабочего дня'),
(5, 1, '18:15:00', '18:15:00', 2, 'Развоз до м. Академическая', 'Развоз до м. Академическая');

-- --------------------------------------------------------

--
-- Структура таблицы `Settings`
--

CREATE TABLE IF NOT EXISTS `Settings` (
  `name` varchar(64) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `value` varchar(64) NOT NULL,
  `descript` varchar(120) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Settings`
--

INSERT INTO `Settings` (`name`, `type`, `value`, `descript`) VALUES
('postsPerPage', 1, '10', 'Количество строк в таблицах'),
('speedEmptyEquipment', 1, '60', 'скорость пустой техники (км/ч)'),
('speedLoadedEquipment', 1, '40', 'скорость груженной техники (км/ч)'),
('sizeRisks', 1, '0.07', 'Риски в БДР'),
('sizeUnforeseen', 1, '0.03', 'Непредвиденные расходы в БДР'),
('sizeIndirectCosts', 1, '0.12', 'Косвенные затраты в БДР'),
('standardsetPropaneGas', 1, '200', 'Стандартный комплект газа пропан'),
('standardKitOxygenGas', 1, '50', 'Стандартный комплект газа кислород');

-- --------------------------------------------------------

--
-- Структура таблицы `Subdivision`
--

CREATE TABLE IF NOT EXISTS `Subdivision` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `Subdivision`
--

INSERT INTO `Subdivision` (`id`, `parent_id`, `name`) VALUES
(1, 2, 'Бухгалтерия'),
(2, NULL, 'Управление'),
(3, NULL, 'Нио ит'),
(4, 3, 'Печать'),
(5, 4, 'Цветная печать'),
(6, NULL, 'Обслуга'),
(7, NULL, 'Отдел персонала');

-- --------------------------------------------------------

--
-- Структура таблицы `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `subdivision_id` int(11) DEFAULT NULL,
  `datecreate` int(11) NOT NULL,
  `login` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `name` varchar(100) NOT NULL,
  `patronymic` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `phone` varchar(64) NOT NULL,
  `dateborn` int(11) NOT NULL,
  `dateworkat` int(11) NOT NULL DEFAULT '0',
  `dateworkto` int(11) NOT NULL,
  `actual` tinyint(1) NOT NULL DEFAULT '1',
  `is_super_admin` tinyint(1) NOT NULL DEFAULT '0',
  `photo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `subdivision_id` (`subdivision_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Дамп данных таблицы `User`
--

INSERT INTO `User` (`id`, `post_id`, `subdivision_id`, `datecreate`, `login`, `password`, `email`, `name`, `patronymic`, `surname`, `phone`, `dateborn`, `dateworkat`, `dateworkto`, `actual`, `is_super_admin`, `photo`) VALUES
(2, 4, 2, 1395427297, 'admin', '47d7e74638514655f7c58da8f368c788', 'nowwrit@mail.ru', 'Админ', 'Админ4', 'Админ', '555', 1407355200, 1391112000, 1388606400, 1, 1, '/var/www/wpoli_1753/data/www/corpsite.w-polis.ru/uploads/28/996161452531.jpg'),
(3, 3, 4, 1395429105, 'admin7', '9f08c02d5811d196121c043f2cf39ab5', 'nowwri6t@mail.ru', 'Иван', 'Иванович', 'Иванов', 'ccc', 1398974400, 75600, -10800, 1, 0, '/var/www/wpoli_1753/data/www/corpsite.w-polis.ru/uploads/38/b493bb892595.jpg'),
(4, 4, 2, 1395570062, 'cench', '064aef5846dcaaddd1a5cab0b90cb7af', 'cench@mail.ru', 'cench', 'cench', 'cench', '333333', 1386187200, -10800, -10800, 1, 0, ''),
(5, 3, 1, 1395774191, 'meraw', '6f8c7c10d9ffb8f777bf90097c466d5f', 'raskin-veniamin@yandex.ru', 'raskin-', 'raskin-', 'raskin-', '4444444', 1393617600, 0, 0, 0, 0, ''),
(6, 3, 1, 1397314625, 'admin67', '56b54848c6401f953a4ea8a5e000eede', 'cenc6h@mail.ru', 'Dfcz', 'cscs', 'cscsc', '888', 1398801600, -10800, -10800, 1, 0, ''),
(7, 8, 3, 1397316922, 's.gogin', 'd54b1238e08d25b731a891f805364ac1', 's.gogin@mail.ru', 'Сергей', 'Борисович', 'Гогин', '555-777, +7-911-7789876', 553982400, 0, 0, 1, 0, ''),
(8, 3, 2, 1398283502, 'admin65', '5a998df9c336c27af72029533c15a8c1', 'cen54ch@mail.ru', 'cench', 'cscs', 'cench', '333333', 1398456000, 0, 0, 1, 0, ''),
(9, 9, 5, 1399363302, 'ohrannik', 'ea1273aa382647894e23242a4d2eaeb2', 'm.garkusha@nordside.ru', 'Охранник', 'Вася', 'Пупкин', '112', 1398888000, 1399320000, -10800, 1, 0, ''),
(10, 3, 1, 1405937123, '434343', '38270efebff68669048138782cbce119', 'test@mail.ru', 'Den', '434343', '434343', '434343', 1404763200, 1405972800, 0, 1, 1, ''),
(11, 7, 6, 1406032227, '7676', '6b900663297a704bcdb8b5c81deb03a2', 'cscscsc@cscscsc.ew', 'Зуфра', 'Мухамедовна', 'Зафаровна', '7777', 1405972800, -10800, -10800, 1, 0, '/var/www/wpoli_1753/data/www/corpsite.w-polis.ru/uploads/97/9b2683268839.jpg'),
(12, 4, 2, 1406032323, '767676', '217bbff6e87b0320698f9be37052c4f1', 'cscscsc@cscs76csc.ew', 'Михаил', 'Сергеевич', 'Задорнов', '7777', -10800, -10800, -10800, 1, 0, ''),
(13, 7, 7, 1406032435, 'ytytyt', 'ecdcdeb055994ac080f1b30ce0c3882a', 'cscytscsc@cscs76csc.ew', 'Измаил', 'Измаилович', 'Мзмаил', '76767', 1405713600, -10800, -10800, 1, 0, ''),
(14, 3, 7, 1406032673, 'ytytyty54', 'ecdcdeb055994ac080f1b30ce0c3882a', 'cscytscsc@csy54cs76csc.ew', 'Надежда', 'Юрьевна', 'Андреева', '76767', 1405713600, -10800, -10800, 1, 0, ''),
(15, 3, NULL, 1406032854, 'ytytyty547', 'ecdcdeb055994ac080f1b30ce0c3882a', 'cscytscsc@csy6csc.ew', '76767', 'Гоголь', 'Николай', 'Васильевич', 1405713600, -10800, -10800, 1, 0, '/var/www/wpoli_1753/data/www/corpsite.w-polis.ru/uploads/78/596385623128.jpg'),
(16, 7, 6, 1406032876, 'ytytyty5647', 'ecdcdeb055994ac080f1b30ce0c3882a', 'csc6csc@csy6csc.ew', 'Ольга', 'Петровна', 'Бандаренко', '76767', 1405713600, -10800, -10800, 1, 0, ''),
(17, 3, NULL, 1406032937, 'ytytyty765647', 'ecdcdeb055994ac080f1b30ce0c3882a', 'cs6sc@csy6csc.ew', 'Мухамед', 'Магодед', 'Магодедов', '76767', 1405713600, -10800, -10800, 1, 0, ''),
(18, 3, 1, 1407594471, 'cench1', '401c65a94f8e8344094ee284fa4efbcd', 'cench1@mail.eu', 'cench1', 'cench1', 'cench1', '22222', 1407528000, 0, 0, 1, 0, ''),
(19, 3, 2, 1408084005, 'vasya', '149296a8945c0c3fa2da9bce527bf0d0', 'vasya@mail.ru', 'vasya', 'vasya', 'vasya', '2222', 1408046400, 1408046400, 0, 1, 0, '/var/www/wpoli_1753/data/www/corpsite.w-polis.ru/uploads/59/411369686927.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `UserWorkDeviation`
--

CREATE TABLE IF NOT EXISTS `UserWorkDeviation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `set_user_id` int(11) NOT NULL,
  `deviation_id` int(11) NOT NULL,
  `datestart` int(11) NOT NULL,
  `dateend` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`deviation_id`),
  KEY `deviation_id` (`deviation_id`),
  KEY `set_user_id` (`set_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `UserWorkDeviation`
--

INSERT INTO `UserWorkDeviation` (`id`, `user_id`, `set_user_id`, `deviation_id`, `datestart`, `dateend`) VALUES
(1, 2, 2, 1, 1393617600, 1397592000),
(2, 2, 2, 1, 1398196800, 1398542400),
(3, 5, 2, 1, 1396382400, 1398542400),
(4, 5, 2, 2, 1398542400, 1398542400),
(5, 4, 2, 3, 1397073600, 1397678400),
(7, 3, 2, 1, 1396987200, 1397764800),
(8, 3, 2, 4, 1398542400, 1398715200),
(9, 5, 2, 1, 1398888000, 1400875200),
(10, 2, 2, 3, 1399579200, 1399752000),
(11, 5, 2, 1, 1405886400, 1406750400),
(12, 15, 2, 1, 1406836800, 1409428800);

-- --------------------------------------------------------

--
-- Структура таблицы `VsChat`
--

CREATE TABLE IF NOT EXISTS `VsChat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expire` int(11) DEFAULT NULL,
  `user_to` int(11) DEFAULT NULL,
  `user_from` int(11) DEFAULT NULL,
  `is_new` tinyint(1) DEFAULT NULL,
  `comment` text CHARACTER SET utf8,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=85 ;

--
-- Дамп данных таблицы `VsChat`
--

INSERT INTO `VsChat` (`id`, `expire`, `user_to`, `user_from`, `is_new`, `comment`) VALUES
(27, 1406204948, 2, 2, 0, '<p>\r\n	77777\r\n</p>'),
(28, 1406205128, 2, 2, 0, '<p>\r\n	87\r\n</p>'),
(29, 1406205135, 10, 2, 0, '<p>\r\n	76\r\n</p>'),
(30, 1406205216, 6, 2, 0, '<p>\r\n	76\r\n</p>'),
(31, 1406205221, 6, 2, 0, '<p>\r\n	7676\r\n</p>'),
(32, 1406205226, 10, 2, 0, '<p>\r\n	7676\r\n</p>'),
(33, 1406205232, 10, 2, 0, '<p>\r\n	777777777\r\n</p>'),
(34, 1406205242, 6, 2, 0, '<p>\r\n	76767\r\n</p>'),
(35, 1406205260, 10, 2, 0, '<p>\r\n	6666666666666666666666666666666666666666666666\r\n</p>'),
(36, 1406205314, 10, 2, 0, '<p>\r\n	767\r\n</p>'),
(37, 1406205318, 2, 2, 0, '<p>\r\n	767\r\n</p>'),
(38, 1406205329, 4, 2, 0, '<p>\r\n	 767\r\n</p>'),
(39, 1406205437, 4, 2, 0, '<p>\r\n	6565\r\n</p>'),
(40, 1406205440, 4, 2, 0, '<p>\r\n	656565\r\n</p>'),
(41, 1406207480, 2, 6, 0, '<p>\r\n	767\r\n</p>'),
(42, 1406207532, 6, 2, 0, '<p>\r\n	65\r\n</p>'),
(43, 1406207719, 6, 2, 0, '<p>\r\n	Rhenj\r\n</p>'),
(44, 1406207737, 2, 6, 0, '<p>\r\n	? ???? ????? ??????????? ? ????!\r\n</p>'),
(45, 1406207971, 6, 2, 0, '<p>\r\n	Русский Язык самый лучший!\r\n</p>'),
(46, 1406208628, 2, 2, 0, '<p>\r\n	Ты тут?\r\n</p>'),
(47, 1406208682, 2, 6, 0, '<p>\r\n	Привет, зайди в чат"\r\n</p>'),
(48, 1406208704, 6, 2, 0, '<p>\r\n	Зашел\r\n</p>'),
(49, 1406208728, 2, 6, 0, '<p>\r\n	Много много текста!!!\r\n</p>'),
(50, 1406208740, 2, 6, 0, '<p>\r\n	Бла бла бла!!!\r\n</p>'),
(51, 1406208753, 2, 6, 0, '<p>\r\n	http://yiibooster.clevertech.biz/widgets/forms_inputs_wysiwyg/view/redactorjs.html\r\n</p>'),
(52, 1406208796, 10, 6, 0, '<p>\r\n	Привет!"""\r\n</p>'),
(53, 1406314749, 13, 2, 0, '<p>\r\n	re\r\n</p>'),
(54, 1406315055, 13, 2, 0, '<p>\r\n	ddvsds\r\n</p>'),
(55, 1406383494, 2, 11, 0, '<p>\r\n	Привет!\r\n</p>\r\n<p>\r\n	Как дела?\r\n</p>'),
(56, 1406383917, 11, 2, 0, '<p>\r\n	1\r\n</p>'),
(57, 1406456653, 11, 2, 0, '<p>\r\n	сссссссссссссссссссс\r\n</p>'),
(58, 1406459109, 2, 11, 0, '<p>\r\n	iui\r\n</p>'),
(59, 1406459113, 2, 11, 0, '<p>\r\n	iui\r\n</p>'),
(60, 1406459118, 2, 11, 0, '<p>\r\n	iu\r\n</p>'),
(61, 1406459163, 2, 11, 0, '<p>\r\n	Вы тут?\r\n</p>'),
(62, 1406459180, 11, 2, 0, '<p>\r\n	сы\r\n</p>'),
(63, 1406459184, 11, 2, 0, '<p>\r\n	вы\r\n</p>'),
(64, 1406459193, 2, 11, 0, '<p>\r\n	мвы\r\n</p>'),
(65, 1406459205, 2, 11, 0, '<p>\r\n	аааааааааааааааааааааааа\r\n</p>'),
(66, 1406459959, 2, 11, 0, '<p>\r\n	uy\r\n</p>'),
(67, 1406460176, 11, 2, 0, '<p>\r\n	Доброе утро зухра!\r\n</p>'),
(68, 1406460191, 2, 11, 0, '<p>\r\n	<strong>Привет З</strong>\r\n</p>'),
(69, 1406460695, 2, 3, 0, '<p>\r\n	<span style="background-color: initial;">admin7</span>\r\n</p>'),
(70, 1406460810, 4, 3, 1, '<p>\r\n	fd\r\n</p>'),
(71, 1406460819, 3, 2, 0, '<p>\r\n	Привет Мужик!!!\r\n</p>'),
(72, 1406464807, 3, 2, 0, '<p>\r\n	екек\r\n</p>'),
(73, 1406464834, 2, 3, 0, '<p>\r\n	вцву\r\n</p>'),
(74, 1406464836, 2, 3, 0, '<p>\r\n	увуву\r\n</p>'),
(75, 1406464838, 2, 3, 0, '<p>\r\n	вувув\r\n</p>'),
(76, 1406464839, 2, 3, 0, '<p>\r\n	ауа\r\n</p>'),
(77, 1406464841, 2, 3, 0, '<p>\r\n	аааааааааааааа\r\n</p>'),
(78, 1406464844, 2, 3, 0, '<p>\r\n	ауаа\r\n</p>'),
(79, 1406464854, 2, 3, 0, '<p>\r\n	уауцауцуца\r\n</p>\r\n<p>\r\n	сы\r\n</p>\r\n<p>\r\n	сф\r\n</p>\r\n<p>\r\n	сыф\r\n</p>'),
(80, 1406464860, 2, 3, 0, '<p>\r\n	<span style="background-color: initial;">ауцауцуца</span>\r\n</p>\r\n<p>\r\n	сы\r\n</p>\r\n<p>\r\n	сф\r\n</p>'),
(81, 1406464866, 2, 3, 0, '<h1><strong><span style="background-color: initial;">ауцауцуца</span></strong></h1>\r\n<h1><strong>сы</strong></h1>\r\n<h1>сф</h1>'),
(82, 1406464885, 3, 2, 0, '<p>\r\n	Хорош спамить!\r\n</p>'),
(83, 1406464898, 2, 3, 0, '<p>\r\n	Сам ты спамишь!\r\n</p>'),
(84, 1406626561, 11, 2, 1, '<p>\r\n	fe\r\n</p>');

-- --------------------------------------------------------

--
-- Структура таблицы `WorkDeviation`
--

CREATE TABLE IF NOT EXISTS `WorkDeviation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `charcode` varchar(2) NOT NULL,
  `name` varchar(128) NOT NULL,
  `work_time` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'как рабочее время',
  `color` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `WorkDeviation`
--

INSERT INTO `WorkDeviation` (`id`, `charcode`, `name`, `work_time`, `color`) VALUES
(1, 'О', 'Отпуск', 0, '#32c232'),
(2, 'К', 'Командировка', 1, '#ff0099'),
(3, 'Б', 'Болезнь', 0, '#990000'),
(4, 'П', 'Прогул', 0, '#336699');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Advert`
--
ALTER TABLE `Advert`
  ADD CONSTRAINT `Advert_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `AuthAssignment`
--
ALTER TABLE `AuthAssignment`
  ADD CONSTRAINT `AuthAssignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `AuthItemChild`
--
ALTER TABLE `AuthItemChild`
  ADD CONSTRAINT `AuthItemChild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `AuthItemChild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Documents`
--
ALTER TABLE `Documents`
  ADD CONSTRAINT `Documents_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ограничения внешнего ключа таблицы `Event`
--
ALTER TABLE `Event`
  ADD CONSTRAINT `Event_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `Event_ibfk_2` FOREIGN KEY (`place_id`) REFERENCES `Place` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `Event_ibfk_3` FOREIGN KEY (`type_event_id`) REFERENCES `EventType` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ограничения внешнего ключа таблицы `EventInvited`
--
ALTER TABLE `EventInvited`
  ADD CONSTRAINT `EventInvited_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `Event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `EventInvited_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Instruct`
--
ALTER TABLE `Instruct`
  ADD CONSTRAINT `Instruct_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Instruct_ibfk_2` FOREIGN KEY (`user_to_id`) REFERENCES `User` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Message`
--
ALTER TABLE `Message`
  ADD CONSTRAINT `Message_ibfk_5` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Message_ibfk_6` FOREIGN KEY (`user_to_id`) REFERENCES `User` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Post`
--
ALTER TABLE `Post`
  ADD CONSTRAINT `Post_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `Post` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `RememberPass`
--
ALTER TABLE `RememberPass`
  ADD CONSTRAINT `RememberPass_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ограничения внешнего ключа таблицы `Routine`
--
ALTER TABLE `Routine`
  ADD CONSTRAINT `Routine_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ограничения внешнего ключа таблицы `Subdivision`
--
ALTER TABLE `Subdivision`
  ADD CONSTRAINT `Subdivision_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `Subdivision` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `User`
--
ALTER TABLE `User`
  ADD CONSTRAINT `User_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `Post` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `User_ibfk_3` FOREIGN KEY (`subdivision_id`) REFERENCES `Subdivision` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `UserWorkDeviation`
--
ALTER TABLE `UserWorkDeviation`
  ADD CONSTRAINT `UserWorkDeviation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `UserWorkDeviation_ibfk_2` FOREIGN KEY (`deviation_id`) REFERENCES `WorkDeviation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `UserWorkDeviation_ibfk_3` FOREIGN KEY (`set_user_id`) REFERENCES `User` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
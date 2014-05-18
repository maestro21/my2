-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Янв 17 2012 г., 09:28
-- Версия сервера: 5.1.41
-- Версия PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `rusklub`
--

-- --------------------------------------------------------

--
-- Структура таблицы `blogs`
--

CREATE TABLE IF NOT EXISTS `blogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` text COLLATE utf8_unicode_ci,
  `name` text COLLATE utf8_unicode_ci,
  `theme` text COLLATE utf8_unicode_ci,
  `comments` int(11) DEFAULT '0',
  `labels` text COLLATE utf8_unicode_ci,
  `lang` text COLLATE utf8_unicode_ci,
  `mainpost` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `blogs`
--

INSERT INTO `blogs` (`id`, `url`, `name`, `theme`, `comments`, `labels`, `lang`, `mainpost`) VALUES
(1, 'klub', 'Клуб', NULL, 0, NULL, NULL, 0),
(2, 'hq', 'Генштаб', NULL, 0, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `globals`
--

CREATE TABLE IF NOT EXISTS `globals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `globals`
--

INSERT INTO `globals` (`id`, `name`, `value`) VALUES
(1, 'langs', 'en'),
(2, 'theme', 'rus'),
(3, 'deflang', 'ru'),
(4, 'defmodule', 'records');

-- --------------------------------------------------------

--
-- Структура таблицы `langs`
--

CREATE TABLE IF NOT EXISTS `langs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `abbr` text COLLATE utf8_unicode_ci,
  `name` text COLLATE utf8_unicode_ci,
  `isactive` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `langs`
--

INSERT INTO `langs` (`id`, `abbr`, `name`, `isactive`) VALUES
(1, 'en', 'English', 0),
(2, 'ru', 'Русский', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `links`
--

CREATE TABLE IF NOT EXISTS `links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT '0',
  `url` text COLLATE utf8_unicode_ci,
  `label` text COLLATE utf8_unicode_ci,
  `pos` int(11) DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=551 ;

--
-- Дамп данных таблицы `links`
--

INSERT INTO `links` (`id`, `pid`, `url`, `label`, `pos`, `date`) VALUES
(550, 0, 'retyu', 'tyu', 0, '2012-01-15 01:00:13');

-- --------------------------------------------------------

--
-- Структура таблицы `linktags`
--

CREATE TABLE IF NOT EXISTS `linktags` (
  `link_id` int(11) NOT NULL,
  `tag` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `linktags`
--

INSERT INTO `linktags` (`link_id`, `tag`) VALUES
(550, 'gr'),
(550, 'geg'),
(550, 'g');

-- --------------------------------------------------------

--
-- Структура таблицы `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` text COLLATE utf8_unicode_ci,
  `isactive` int(11) DEFAULT '0',
  `defrights` int(11) DEFAULT '0',
  `defrights_allow` text COLLATE utf8_unicode_ci,
  `defrights_deny` text COLLATE utf8_unicode_ci,
  `fields` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Дамп данных таблицы `modules`
--

INSERT INTO `modules` (`id`, `url`, `isactive`, `defrights`, `defrights_allow`, `defrights_deny`, `fields`) VALUES
(1, 'users', 1, 0, 'login,register,logout,recover,view', '', 'name text text\r\npass pass pass\r\nemail text text\r\nisadmin int checkbox\r\nrights text multselect'),
(7, 'globals', 1, 0, '', '', ''),
(9, 'modules', 1, 0, '', '', 'url text text\r\nisactive int checkbox\r\ndefrights int checkbox\r\ndefrights_allow text text\r\ndefrights_deny text text\r\nfields text textarea'),
(10, 'langs', 1, 0, '', '', 'abbr text text\r\nname text text\r\nisactive int checkbox'),
(17, 'links', 1, 0, '', '', NULL),
(12, 'pages', 1, 0, 'items,view', '', 'lang text select\r\nurl text text\r\ntitle text text\r\ntext text html'),
(13, 'records', 1, 0, '', '', NULL),
(14, 'topics', 1, 0, '', '', NULL),
(15, 'taggroups', 1, 0, '', '', NULL),
(16, 'blogs', 1, 0, '', '', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` text COLLATE utf8_unicode_ci,
  `url` text COLLATE utf8_unicode_ci,
  `title` text COLLATE utf8_unicode_ci,
  `text` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `lang`, `url`, `title`, `text`) VALUES
(1, 'en', 'welcome', 'Welcome!', 'Welcome to the website powered by Maestro engine! '),
(5, 'ru', 'welcome', 'Добро пожаловать !', 'Добро пожаловать на сайт, созданный на движке Маэстро!'),
(6, 'en', 'taggroups', 'Группы тегов', 'name text text\r\ntags multibox none');

-- --------------------------------------------------------

--
-- Структура таблицы `records`
--

CREATE TABLE IF NOT EXISTS `records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` text COLLATE utf8_unicode_ci,
  `maintext` text COLLATE utf8_unicode_ci,
  `text` text COLLATE utf8_unicode_ci,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `blog_id` int(11) DEFAULT '0',
  `tags` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `records`
--

INSERT INTO `records` (`id`, `label`, `maintext`, `text`, `date`, `blog_id`, `tags`) VALUES
(1, 'rt', 'yuityui', 'ertyu', '2012-01-09 09:24:45', 0, '11,3,18,35'),
(2, 'yui', NULL, '3y', '2012-01-14 23:56:20', 0, '26'),
(3, 'Проверка связи', NULL, 'Лорем испум', '2012-01-15 00:14:13', 0, '2,30,4,6'),
(4, 'Проверка связи', NULL, 'уо', '2012-01-15 00:43:32', 1, '');

-- --------------------------------------------------------

--
-- Структура таблицы `rightlist`
--

CREATE TABLE IF NOT EXISTS `rightlist` (
  `module` text COLLATE utf8_unicode_ci NOT NULL,
  `function` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `rightlist`
--


-- --------------------------------------------------------

--
-- Структура таблицы `taggroups`
--

CREATE TABLE IF NOT EXISTS `taggroups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci,
  `tags` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `taggroups`
--

INSERT INTO `taggroups` (`id`, `name`, `tags`) VALUES
(1, 'Страны', '26,42,40,28,2,31,41,46,27,30,13,39,7,44,25,23,1,4,6,24'),
(2, 'Медиа', '33,35,34,37,36,32'),
(3, 'События', '11,3,17,14,18,9,10,12,16'),
(4, 'Русский мир', '3,18,23,19,29,22,4,5,21'),
(5, 'Рубрики', '20,31,49,46,48,15,51,7,44,23,19,29,22,50,4,6,47,45'),
(6, 'На повестке дня', '3,17,41,1');

-- --------------------------------------------------------

--
-- Структура таблицы `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `post_id` int(11) NOT NULL,
  `tag` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `tags`
--

INSERT INTO `tags` (`post_id`, `tag`) VALUES
(1, '35'),
(1, '18'),
(1, '3'),
(1, '11'),
(2, '26'),
(3, '2'),
(3, '30'),
(3, '4'),
(3, '6');

-- --------------------------------------------------------

--
-- Структура таблицы `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci,
  `url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `color` text COLLATE utf8_unicode_ci NOT NULL,
  `bgcolor` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=52 ;

--
-- Дамп данных таблицы `topics`
--

INSERT INTO `topics` (`id`, `name`, `url`, `color`, `bgcolor`) VALUES
(1, 'Сирия\r', 'siriya\r', '', ''),
(2, 'Джамахирия', 'libya', '', 'darkgreen'),
(3, '20 лет без СССР\r', '20-let-bez-sssr\r', '', ''),
(4, 'СССР', 'cccp', 'gold', 'darkred'),
(5, 'Сталин\r', 'stalin\r', '', ''),
(6, 'США', 'usa', '', ''),
(7, 'НАТО\r', 'nato\r', '', ''),
(9, 'Война в Афганистане\r', 'vojna-v-afganistane\r', '', ''),
(10, 'Война в Ираке\r', 'vojna-v-irake\r', '', ''),
(11, '11 сентября\r', '11-sentyabrya\r', '', ''),
(12, 'Холодная война\r', 'holodnaya-vojna\r', '', ''),
(13, 'КНДР\r', 'kndr\r', '', ''),
(14, 'Агрессия против Югославии\r', 'agressiya-protiv-yugoslavii\r', '', ''),
(15, 'Кризис\r', 'krizis\r', '', ''),
(16, 'Экологическая катастрофа в Атлантике\r', 'ekologicheskaya-katastrofa-v-atlantike\r', '', ''),
(17, 'Occupy Wallstreet\r', 'Occupy-Wallstreet\r', '', ''),
(18, 'Великая Отечественная', 'velikaya-otechestvennaya', '', ''),
(19, 'Русофобия\r', 'rusofobiya\r', '', ''),
(20, 'Дикий Запад\r', 'dikij-zapad\r', '', ''),
(21, 'Политика в России', 'politika-v-rossii', '', ''),
(22, 'Сделаноунас\r', 'sdelanounas\r', '', ''),
(23, 'Россия\r', 'rossiya\r', '', ''),
(24, 'Украина\r', 'ukraina\r', '', ''),
(25, 'Прибалтика\r', 'pribaltika\r', '', ''),
(26, 'Белоруссия', 'belorussija', '', ''),
(27, 'Казахстан\r', 'kazahstan\r', '', ''),
(28, 'Грузия\r', 'gruziya\r', '', ''),
(29, 'Русский вопрос\r', 'russkij-vopros\r', '', ''),
(30, 'Китай', 'china', 'yellow', 'darkred'),
(31, 'Европа', 'europa', '', ''),
(32, 'Фото\r', 'foto\r', '', ''),
(33, 'Видео\r', 'video\r', '', ''),
(34, 'Музыка\r', 'muzika\r', '', ''),
(35, 'Игры\r', 'igri\r', '', ''),
(36, 'Кино', 'kino', '', ''),
(37, 'Пропаганда\r', 'propaganda\r', '', ''),
(39, 'Куба\r', 'kuba\r', '', ''),
(40, 'Вьетнам\r', 'vjetnam\r', '', ''),
(41, 'Иран\r', 'iran\r', '', ''),
(42, 'Венесуэлла', 'venezuella', '', ''),
(43, 'История\r', 'istoriya\r', '', ''),
(44, 'Постсоветское пространство\r', 'postsovetskoe-prostranstvo\r', '', ''),
(45, 'Юмор\r', 'yumor\r', '', ''),
(46, 'Исламский мир\r', 'islamskij-mir\r', '', ''),
(47, 'Толерантность\r', 'tolerantnostj\r', '', ''),
(48, 'Копирастия\r', 'kopirastiya\r', '', ''),
(49, 'Интернет\r', 'internet\r', '', ''),
(50, 'Социализм\r', 'socializm\r', '', ''),
(51, 'Мнения', 'mneniya', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci,
  `pass` text COLLATE utf8_unicode_ci,
  `email` text COLLATE utf8_unicode_ci,
  `isadmin` int(11) DEFAULT '0',
  `rights` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `pass`, `email`, `isadmin`, `rights`) VALUES
(1, 'НКВД', '566e9199ea6408a99fd1c7333047d8a3', 'tigerserb@gmail.com', 3, NULL),
(2, NULL, '566e9199ea6408a99fd1c7333047d8a3', 'test@mail.ru', 1, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

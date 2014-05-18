-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 19 2014 г., 00:22
-- Версия сервера: 5.1.41
-- Версия PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- База данных: `my2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `blogs`
--

CREATE TABLE IF NOT EXISTS `blogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` text COLLATE utf8_unicode_ci,
  `name` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `blogs`
--


-- --------------------------------------------------------

--
-- Структура таблицы `filemanager`
--

CREATE TABLE IF NOT EXISTS `filemanager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` text COLLATE utf8_unicode_ci,
  `content` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `filemanager`
--


-- --------------------------------------------------------

--
-- Структура таблицы `forumcomments`
--

CREATE TABLE IF NOT EXISTS `forumcomments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) DEFAULT '0',
  `uid` int(11) DEFAULT '0',
  `text` text COLLATE utf8_unicode_ci,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `forumcomments`
--


-- --------------------------------------------------------

--
-- Структура таблицы `forums`
--

CREATE TABLE IF NOT EXISTS `forums` (
  `pid` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci,
  `themes` int(11) DEFAULT '0',
  `msgs` int(11) DEFAULT '0',
  `order_id` int(11) DEFAULT '0',
  `lastcomment` datetime DEFAULT NULL,
  `lastauthor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `forums`
--


-- --------------------------------------------------------

--
-- Структура таблицы `forumthreads`
--

CREATE TABLE IF NOT EXISTS `forumthreads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) DEFAULT '0',
  `name` text COLLATE utf8_unicode_ci,
  `text` text COLLATE utf8_unicode_ci,
  `author` int(11) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `lastcomment` datetime DEFAULT NULL,
  `lastauthor` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `comments` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `forumthreads`
--


-- --------------------------------------------------------

--
-- Структура таблицы `globals`
--

CREATE TABLE IF NOT EXISTS `globals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci,
  `value` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

--
-- Дамп данных таблицы `globals`
--

INSERT INTO `globals` ( `name`, `value`) VALUES
( 'css', ''),
( 'langs', 'en,ru'),
( 'theme', 'demo'),
('defmodule', 'records'),
( 'deflang', 'en'),
( 'myblogdesc', '&lt;h1&gt;&lt;a href=\\&quot;http://maestrobay.net/blog/\\&quot;&gt;Бухта Маэстро&lt;/a&gt;&lt;/h1&gt;\r\n&lt;i&gt;Личный блог капитана Маэстро&lt;/i&gt;\r\n&lt;h3&gt;\r\n&lt;center&gt;\r\n&lt;a href=\\&quot;/\\&quot;&gt;Варкрафт&lt;/a&gt; ·\r\n&lt;a href=\\&quot;/\\&quot;&gt;Приколы&lt;/a&gt; ·\r\n&lt;a href=\\&quot;/\\&quot;&gt;Фильмы&lt;/a&gt; ·\r\n&lt;a href=\\&quot;/\\&quot;&gt;Музыка&lt;/a&gt; ·\r\n&lt;a href=\\&quot;/\\&quot;&gt;Веб&lt;/a&gt; ·\r\n&lt;a href=\\&quot;/\\&quot;&gt;Путешествия&lt;/a&gt;\r\n&lt;/center&gt;\r\n&lt;/h3&gt;'),
( 'myblogcss', '#content {\r\n  position:relative;\r\n  z-index:1;\r\n  width:80%;\r\n  margin-left:10%;\r\n}\r\n\r\n.top{\r\n  margin:20px;\r\n}\r\n\r\n.post{\r\n 	border-collapse: collapse;\r\n   border: 1px solid green;\r\n   border-radius: 8px;\r\n   -moz-border-radius: 8px;\r\n   -webkit-border-radius: 8px;\r\n   -khtml-border-radius: 8px;\r\n   background-color:white;\r\n   margin:20px;\r\n   padding-left:20px;\r\n   padding-right:20px;\r\n}\r\n\r\nimg#bg {\r\n  position:fixed;\r\n  top:0;\r\n  left:0;\r\n  width:100%;\r\n  height:100%;\r\n\r\n}\r\n\r\na{\r\n	color:#0000cc;\r\n	font-family:\\''Palatino Linotype\\'';\r\n font-weight:bold;\r\n}\r\nh1{\r\npadding:0px; margin:0px;\r\n}\r\n\r\nh3{ color:white; opacity:0.6;}\r\nh1 a{color:white}\r\nh3 a{\r\n   background-color:white;\r\n   border-collapse: collapse;\r\n   border: 1px solid white;\r\n   -moz-border-radius: 8px;\r\n   -webkit-border-radius: 8px;\r\n   -khtml-border-radius: 8px;\r\ncolor:green;\r\n padding:5px; margin:5px;\r\n}\r\n\r\n\r\nbody{\r\n	position:relative;\r\n	z-index:1; \r\n	font-family:\\''Lucida Grande\\'', Arial;\r\n	font-size:14px;\r\n}'),
( 'publicblog', '12'),
( 'bgpic', 'http://hq-oboi.ru/photo/kukuruznik_na_nebe_1600x1200.jpg'),
( 'videos_tagcloud', 'a:3:{i:0;a:2:{s:3:"tag";s:11:"youtube.com";s:5:"total";s:1:"3";}i:1;a:2:{s:3:"tag";s:2:"su";s:5:"total";s:1:"2";}i:2;a:2:{s:3:"tag";s:5:"girls";s:5:"total";s:1:"1";}}'),
( 'images_tagcloud', 'a:12:{i:0;a:2:{s:3:"tag";s:11:"youtube.com";s:5:"total";s:1:"5";}i:1;a:2:{s:3:"tag";s:2:"su";s:5:"total";s:1:"2";}i:2;a:2:{s:3:"tag";s:2:"ru";s:5:"total";s:1:"1";}i:3;a:2:{s:3:"tag";s:2:"us";s:5:"total";s:1:"1";}i:4;a:2:{s:3:"tag";s:5:"girls";s:5:"total";s:1:"1";}i:5;a:2:{s:3:"tag";s:6:"lolvid";s:5:"total";s:1:"1";}i:6;a:2:{s:3:"tag";s:3:"lol";s:5:"total";s:1:"1";}i:7;a:2:{s:3:"tag";s:3:"gif";s:5:"total";s:1:"1";}i:8;a:2:{s:3:"tag";s:18:"img0.joyreactor.cc";s:5:"total";s:1:"1";}i:9;a:2:{s:3:"tag";s:2:"ua";s:5:"total";s:1:"1";}i:10;a:2:{s:3:"tag";s:30:"radchenko-anna.livejournal.com";s:5:"total";s:1:"1";}i:11;a:2:{s:3:"tag";s:10:"fishki.net";s:5:"total";s:1:"1";}}'),
( 'tagcloud', 'a:11:{i:0;a:2:{s:3:"tag";s:11:"youtube.com";s:5:"total";s:1:"5";}i:1;a:2:{s:3:"tag";s:2:"ru";s:5:"total";s:1:"2";}i:2;a:2:{s:3:"tag";s:2:"su";s:5:"total";s:1:"2";}i:3;a:2:{s:3:"tag";s:2:"us";s:5:"total";s:1:"1";}i:4;a:2:{s:3:"tag";s:5:"girls";s:5:"total";s:1:"1";}i:5;a:2:{s:3:"tag";s:6:"lolvid";s:5:"total";s:1:"1";}i:6;a:2:{s:3:"tag";s:31:"marina-yudenich.livejournal.com";s:5:"total";s:1:"1";}i:7;a:2:{s:3:"tag";s:2:"ua";s:5:"total";s:1:"1";}i:8;a:2:{s:3:"tag";s:30:"radchenko-anna.livejournal.com";s:5:"total";s:1:"1";}i:9;a:2:{s:3:"tag";s:3:"lol";s:5:"total";s:1:"1";}i:10;a:2:{s:3:"tag";s:10:"fishki.net";s:5:"total";s:1:"1";}}'),
( 'tags', 'ru = Россия\nsu = СССР\nua = Украина\nus = США\nrk = Русский клуб\nlolvid = Смешные видео\ngif = .GIF\nlol = Прикол');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` text COLLATE utf8_unicode_ci,
  `title` text COLLATE utf8_unicode_ci,
  `tags` text COLLATE utf8_unicode_ci,
  `album_id` int(11) DEFAULT '0',
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `link_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `images`
--


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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `langs`
--

INSERT INTO `langs` (`id`, `abbr`, `name`, `isactive`) VALUES
(1, 'en', 'English', 1),
(2, 'ru', 'Русский', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `linkgroups`
--

CREATE TABLE IF NOT EXISTS `linkgroups` (
  `link_id` int(11) NOT NULL,
  `group` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `linkgroups`
--


-- --------------------------------------------------------

--
-- Структура таблицы `links`
--

CREATE TABLE IF NOT EXISTS `links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` text COLLATE utf8_unicode_ci,
  `title` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tags` text COLLATE utf8_unicode_ci NOT NULL,
  `img` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `links`
--


-- --------------------------------------------------------

--
-- Структура таблицы `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` text COLLATE utf8_unicode_ci,
  `isactive` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `modules`
--

INSERT INTO `modules` (`id`, `url`, `isactive`) VALUES
(1, 'users', 1),
(7, 'globals', 1),
(9, 'modules', 1),
(10, 'langs', 1),
(11, 'filemanager', 1),
(12, 'pages', 1),
(13, 'links', 1),
(14, 'projects', 1),
(15, 'tasks', 1),
(16, 'records', 1),
(17, 'blogs', 1),
(18, 'images', 1),
(19, 'forums', 1),
(20, 'forumthreads', 1),
(21, 'forumcomments', 1),
(22, 'videos', 1);

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
  `pid` int(11) DEFAULT '0',
  `order_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `pages`
--


-- --------------------------------------------------------

--
-- Структура таблицы `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `projects`
--


-- --------------------------------------------------------

--
-- Структура таблицы `records`
--

CREATE TABLE IF NOT EXISTS `records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` text COLLATE utf8_unicode_ci,
  `text` text COLLATE utf8_unicode_ci,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `blog_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `records`
--


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
-- Структура таблицы `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `post_id` int(11) NOT NULL,
  `tag` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `tags`
--


-- --------------------------------------------------------

--
-- Структура таблицы `tags_images`
--

CREATE TABLE IF NOT EXISTS `tags_images` (
  `img_id` int(11) NOT NULL,
  `tag` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `tags_images`
--


-- --------------------------------------------------------

--
-- Структура таблицы `tags_links`
--

CREATE TABLE IF NOT EXISTS `tags_links` (
  `link_id` int(11) NOT NULL,
  `tag` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `tags_links`
--


-- --------------------------------------------------------

--
-- Структура таблицы `tags_videos`
--

CREATE TABLE IF NOT EXISTS `tags_videos` (
  `video_id` int(11) NOT NULL,
  `tag` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `tags_videos`
--


-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT '0',
  `label` text COLLATE utf8_unicode_ci,
  `info` text COLLATE utf8_unicode_ci,
  `status` int(11) DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `tasks`
--


-- --------------------------------------------------------

--
-- Структура таблицы `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci,
  `surname` text COLLATE utf8_unicode_ci,
  `dob` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sex` int(11) DEFAULT '0',
  `lvl` int(11) DEFAULT '0',
  `money` float DEFAULT '0',
  `descr` text COLLATE utf8_unicode_ci,
  `country` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `test`
--


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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `users`
--


-- --------------------------------------------------------

--
-- Структура таблицы `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` text COLLATE utf8_unicode_ci,
  `tags` text COLLATE utf8_unicode_ci,
  `date` datetime DEFAULT NULL,
  `duration` int(11) DEFAULT '0',
  `channel` int(11) DEFAULT '0',
  `link_id` int(11) DEFAULT '0',
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `videos`
--


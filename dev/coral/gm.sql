-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Фев 22 2013 г., 01:16
-- Версия сервера: 5.1.41
-- Версия PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `gm`
--

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `spoiler` text COLLATE utf8_unicode_ci NOT NULL,
  `fulltext` text COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `time` datetime NOT NULL,
  `published` int(11) NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `spoiler`, `fulltext`, `lang`, `time`, `published`, `url`) VALUES
(2, 'Помолодевший Гамбург', '2 сентября 2012 года родилось движение «Гамбург Молодой» на основе Земельного Координационного совета российских соотечественников Гамбурга . С инициативой создания молодёжного движения выступил председатель Земельного совета Борис Зильберберг. «Гамбург Молодой» приглашает к участию всю русскоговорящую молодёжь нашего города. «Как было бы здорово снова ...', '&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;2 сентября 2012 года родилось&amp;nbsp;&lt;font color=&quot;#333333&quot; face=&quot;Arial, sans-serif&quot;&gt;&lt;span style=&quot;font-size: 12px; line-height: 18px;&quot;&gt;движение «Гамбург Молодой»&amp;nbsp;на основе Земельного&amp;nbsp;&lt;/span&gt;&lt;/font&gt;&lt;a href=&quot;http://www.russkoepole.de/index.php?option=com_content&amp;amp;view=category&amp;amp;layout=blog&amp;amp;id=121&amp;amp;Itemid=413&amp;amp;lang=ru&quot;&gt;Координационного совета российских соотечественников Гамбурга&lt;/a&gt;. С инициативой создания молодёжного движения выступил председатель Земельного совета Борис Зильберберг. «Гамбург Молодой» приглашает к участию всю русскоговорящую молодёжь нашего города.&lt;br&gt;«Как было бы здорово снова встретиться и не один раз, и не два, а регулярно, и желательно, в Гамбурге!» - предложила Виктория, одна из участниц поездки в Санкт-Петербург в рамках учебно-образовательной программы «Здравствуй, Россия!». В 2012 г. только из Германии в этой программе приняли участие 40 девчонок и ребят в возрасте 15-19 лет. Остались классные воспоминания об экскурсиях по городу, нашей «Северной жемчужине», о дискотеках каждый вечер и о русской пище, богатой витаминами и минеральными солями (например о гречке!).&lt;br&gt;Неделя в Питере сплотила группу, завязались новые знакомства и захотелось обязательно продолжить дружбу на немецкой земле.&amp;nbsp;&lt;br&gt;По возвращению домой ребят пригласили на заседание Земельного координационного Совета российских соотечественников Гамбурга. Их юношеский задор и энергия просто покорили членов Совета и они единогласно приняли решение поддержать молодое поколение в их начинаниях.&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;Теперь у русскоязычной молодёжи Гамбурга будет помещение для встреч. Что задумали ребята? А именно то, что&amp;nbsp;интересно в их возрасте: встречи, танцы, поездки, да просто общение и поддержка друг друга. Вновь созданная группа открыта для новых членов и новых предложений.&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;Благодаря поддержке Земельного Совета, у ребят будет возможность поехать на мероприятия для молодых лидеров, активно участвовать в общественной и политической жизни, заниматься на семинарах по профессиональной подготовке. Они смогут проявить свои творческие и организаторские способности во встречах на конференциях и круглых столах, на концертах и фестивалях.&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;По замыслу основателей движения, будут проводиться спортивные мероприятия с целью пропаганды здорового образа жизни, а также продолжится знакомство с Россией. Члены движения «Гамбург Молодой» войдут в состав делегаций на молодёжные форумы, примут участие в образовательных и экскурсионных программах молодёжного обмена.&lt;br&gt;Дерзайте ребята! Теперь у вас есть хороший шанс проявить себя!&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;Валентина Мюллер,&lt;br&gt;Пресс-секретарь Земельного координационного Совета российских соотечественников Гамбурга&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;Информационная служба сайта &quot;&lt;a href=&quot;http://russkoepole.de/undefined/&quot;&gt;Русское поле&lt;/a&gt;&quot;&lt;/p&gt;', 'ru', '2013-02-19 18:49:59', 1, 'pomolodevshij-gamburg'),
(3, '«Против расизма» - праздник в Гамбурге', 'Земельный координационный Совет российских соотечественников Гамбурга принял участие в празднике под девизом «Против расизма», проходившим по инициативе Центра интеграции городского района Eimsbüttel. В ходе интернационального праздника, который объединил многие национальные землячества Гамбурга', '&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;Земельный координационный Совет российских соотечественников Гамбурга принял участие в празднике под девизом «Против расизма», проходившим по инициативе Центра интеграции городского района Eimsbüttel. В ходе интернационального праздника, который объединил многие национальные землячества Гамбурга , жители города иностранного происхождения познакомили зрителей с культурой и искусством своих стран.&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;&lt;img src=&quot;http://russkoepole.de/images/stories/German/Hamburg/katja%20intern.fest%2031.08.2012.jpg&quot; border=&quot;0&quot; title=&quot;Праздник в Гамбурге&quot; width=&quot;600&quot; height=&quot;803&quot; style=&quot;margin: 0px; padding: 0px; &quot;&gt;&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;&lt;img src=&quot;http://russkoepole.de/images/stories/German/Hamburg/foto_konzert_31-08.2012%20mk.jpg&quot; border=&quot;0&quot; title=&quot;Концерт в Гамбурге&quot; width=&quot;590&quot; height=&quot;520&quot; style=&quot;margin: 0px; padding: 0px; &quot;&gt;&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;В состоявшемся концерте приняли участие дети из русской школы «Теремок». Мишель Коннен (12 лет) и Эдгар Бертельман (10 лет) исполнили на русском и английском языках песни, которые они разучили с преподавателем Ольгой Голос. Сольные номера «Луч солнца золотого» и «Куда уходит детство» были очень тепло встречены зрителями.&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;&lt;img src=&quot;http://russkoepole.de/images/stories/German/Hamburg/inter.fest%2031.08.12%20edgar%20%20bertelmann%20-%204%20mk.jpg&quot; border=&quot;0&quot; title=&quot;Выступает Эдгар Бертельман&quot; width=&quot;600&quot; height=&quot;539&quot; style=&quot;margin: 0px; padding: 0px; &quot;&gt;&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;В дни праздника в Интеграционном центре можно было увидеть работы учеников студии изобразительных искусств «Теремка». В этой студии под руководством Елены Кехтер занимаются юные художники от 3 до 16 лет.&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;Школа «Теремок» была создана Обществом&amp;nbsp;T(H)ЕМА - Freundeskreis Russischer Kultur e. V. Возглавляет школу Лора Лаевская. Ученикам в «Теремке» предлагаются занятия русским языком, музыкой и живописью.&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;В школе работает также театральная студия, а в нынешнем году должен начаться курс лекций по истории России.&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;Татьяна Борисова&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;&lt;a href=&quot;http://russkoepole.de/images/stories/logo-info.jpg&quot;&gt;&lt;img src=&quot;http://russkoepole.de/images/stories/logo-info.jpg&quot; border=&quot;0&quot; width=&quot;120&quot; height=&quot;75&quot; style=&quot;margin: 0px; padding: 0px; border: none; &quot;&gt;&lt;/a&gt;&lt;/p&gt;', 'ru', '2013-02-22 00:36:47', 1, 'protiv-rasizma-prazdnik-v-gamburge'),
(4, 'День открытых дверей в «АЗБУКЕ», Гамбург', 'Возможно ли пройти всю Россию и научиться говорить по-русски за 30 минут? Что такое тундра и далеко ли до Сибири? Как сплясать кадриль? Почему чай пьют с баранками и что такое пироги с капустой? На эти и многие другие вопросы получили ответы наши гости, которых АЗБУКА встречала 22 сентября на празднике Дня открытых дверей, который проходил в рамка...', '&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;Возможно ли пройти всю Россию и научиться говорить по-русски за 30 минут? Что такое тундра и далеко ли до Сибири? Как сплясать кадриль? Почему чай пьют с баранками и что такое пироги с капустой? На эти и многие другие вопросы получили ответы наши гости, которых АЗБУКА встречала 22 сентября на празднике Дня открытых дверей, который проходил в рамках проекта Nachbarschaft verbindet, что в свободном переводе звучит примерно как «Соседи из разных стран, объединяйтесь!».&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;&lt;img src=&quot;http://russkoepole.de/images/stories/German/Hamburg/Azbuka/unknown_parameter_value2.jpg&quot; border=&quot;0&quot; width=&quot;597&quot; height=&quot;581&quot; style=&quot;margin: 0px; padding: 0px; &quot;&gt;&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;В этот день в АЗБУКЕ работали несколько станций, на которых гости АЗБУКИ могли узнать много нового о России, познакомиться с работой нашего общества, задать различные вопросы. На станции «Страноведческая» Татьяна Мауль и ее ученики ответили на вопросы о природных условиях России, рассказали о важнейших вехах истории, показали видеоматериалы.&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;В мастерской Елены Трубачевой на станции «Волшебная кисточка» наши посетители рисовали русских матрешек, фольклорные русские узоры и многое другое. На «Музыкальной» станции гости пели с нашими учениками в хоре, в «Танцклассе» Надежды Крувель разучивали кадриль.&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;&amp;nbsp;&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;&lt;img src=&quot;http://russkoepole.de/images/stories/German/Hamburg/Azbuka/unknown_parameter_value3.jpg&quot; border=&quot;0&quot; width=&quot;600&quot; height=&quot;452&quot; style=&quot;margin: 0px; padding: 0px; &quot;&gt;&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;С педагогами из Stiftung deutsch-russischer Jugendaustausch Элеонорой Бюхнер и Светланой Помяловой на станции “Russischbox (Russisch kommt)“, отправились в «путешествие» по карте России и учились произносить по-русски географические названия.&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;&lt;img src=&quot;http://russkoepole.de/images/stories/German/Hamburg/Azbuka/unknown_parameter_value.jpg&quot; border=&quot;0&quot; width=&quot;600&quot; height=&quot;451&quot; style=&quot;margin: 0px; padding: 0px; &quot;&gt;&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;А еще играли в шахматы с Надеждой Нестулей и ее учениками, читали новые детские книги.&lt;br&gt;&lt;br&gt;Закончился праздник концертом наших юных талантов и спектаклем детской театральной группы «Теремок», который поставили Ксения Барберон и Надежда Крувель.&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;&lt;img src=&quot;http://russkoepole.de/images/stories/German/Hamburg/Azbuka/unknown_parameter_value4.jpg&quot; border=&quot;0&quot; width=&quot;600&quot; height=&quot;450&quot; style=&quot;margin: 0px; padding: 0px; &quot;&gt;&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;Вдохновителем и организатором этого мероприятия стала председатель общества «Азбука» Виктория Аронова.&lt;br&gt;&lt;br&gt;О своих впечатлениях о празднике наши гости рассказали в фильме, который был снят в этот день. Фильм вскоре появится на нашей странице в интернете: заходите на&amp;nbsp;&lt;a href=&quot;http://www.asbuka.de/&quot;&gt;www.asbuka.de&lt;/a&gt;, знакомьтесь с нами!&lt;br&gt;&lt;br&gt;Ваша АЗБУКА, Гамбург&lt;br&gt;&lt;br&gt;Информационная служба «&lt;a href=&quot;http://russkoepole.de/undefined/&quot;&gt;Русское поле&lt;/a&gt;»&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;&lt;a href=&quot;http://russkoepole.de/undefined/&quot;&gt;&lt;img src=&quot;http://russkoepole.de/images/stories/logo-info.jpg&quot; border=&quot;0&quot; width=&quot;120&quot; height=&quot;75&quot; style=&quot;margin: 0px; padding: 0px; border: none; &quot;&gt;&lt;/a&gt;&lt;/p&gt;', 'ru', '2013-02-22 00:46:27', 1, 'denj-otkritih-dverej-v-«azbukye»,-gamburg'),
(5, 'В Молодёжном доме Neuwiedentahl в Гамбурге прошел праздник', 'Гости, дети и родители, заполнили в этот день просторные помещения Молодежного дома в прайоне Neuwiedentah . Школа Asbuka-Süd тоже была здесь. Смешение языков улыбок, радостных лиц... Всё, что юные участники этого праздника подготовили заранее, было выставлено для  обозрения посетителей - абстрактные картины из подручного материала, зимние букеты,', '&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;Гости, дети и родители, заполнили в этот день просторные помещения Молодежного дома в прайоне Neuwiedentah . Школа Asbuka-Süd тоже была здесь. Смешение языков улыбок, радостных лиц... Всё, что юные участники этого праздника подготовили заранее, было выставлено для&amp;nbsp; обозрения посетителей - абстрактные картины из подручного материала, зимние букеты, половички, дорожки, поделки&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;из пластилина. Родители несли с собой домашние вкусности. В кофейном уголке их потом раздавали бесплатно. Русские ватрушки, блинчики и домашние кексики пользовались самым большим спросом.&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;Дети осваивались с первых&amp;nbsp;&lt;img src=&quot;http://2.image.hamburg.de/image/57162/neumoorstueck-3.jpg?width=484&amp;amp;height=196&quot; border=&quot;0&quot; width=&quot;400&quot; height=&quot;162&quot; style=&quot;margin: 3px 5px; padding: 0px; float: left; &quot;&gt;же минут и перебегали из одного уголка в другой. А вот и наш – русский уголок! Он не пустовал ни минуты!&lt;br&gt;Осмотрев выставку работ учеников нашей школы Asbuka-Süd дети, и даже родители, тут же подсаживались к столу - рисовать и раскрашивать русских матрёшек, лепить по образу и подобию дымковской игрушки своих скакунов, барышень и котов.&amp;nbsp; Радостный и деловой щебет и писк стоял в нашем русском зале. Все были заняты делом.&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;А взрослые внимательно рассматривали выставку. Разные города России, о которых рассказали ученики общества Asbuka-Süd красовались на стенах своими широкими проспектами, площадями и памятниками.&lt;br&gt;Большие фотографии из жизни нашей школы притягивали внимание не только русских, но и немецких посетителей.&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;Игрушки и посуда в русском народном стиле не оставались без внимания.&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;&lt;img src=&quot;http://russkoepole.de/images/stories/German/Hamburg/Azbuka/dsc03291.jpg&quot; border=&quot;0&quot; width=&quot;600&quot; height=&quot;396&quot; style=&quot;margin: 0px; padding: 0px; &quot;&gt;&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;Уж не говоря о художественных альбомах из жизни школы, искусно сделанных учителем и организатором школы Asbuka-Süd Мариной Трарбах.&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;&lt;img src=&quot;http://russkoepole.de/images/stories/German/Hamburg/Azbuka/dsc03332.jpg&quot; border=&quot;0&quot; width=&quot;600&quot; height=&quot;419&quot; style=&quot;margin: 0px; padding: 0px; &quot;&gt;&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;Счастливые дети наслаждались рукотворной деятельностью в стиле старинного русского мастерства, с удовольствием принимали участие в инсценировке сказки «Репка».&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;&lt;img src=&quot;http://russkoepole.de/images/stories/German/Hamburg/Azbuka/dsc03349.jpg&quot; border=&quot;0&quot; width=&quot;600&quot; height=&quot;417&quot; style=&quot;margin: 0px; padding: 0px; &quot;&gt;&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;Родители вспоминали давно забытые и впитывали новые впечатления. Русское художественное творчество царило в этом небольшом уголке вместе с немецким дизайном.&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;Вот так наше общество принимает участие в общественной жизни южной части Гамбурга.&lt;br&gt;&lt;br&gt;Asbuka-Süd, Гамбург&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;***&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;&lt;a href=&quot;http://www.russkoepole.de/&quot;&gt;&lt;img src=&quot;http://russkoepole.de/images/stories/logo-info.jpg&quot; border=&quot;0&quot; width=&quot;120&quot; height=&quot;75&quot; style=&quot;margin: 0px; padding: 0px; border: none; &quot;&gt;&lt;/a&gt;&lt;/p&gt;', 'ru', '2013-02-22 00:49:31', 1, 'v-molodyozhnom-dome-Neuwiedentahl-v-gamburge-proshel-prazdnik');

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `published` int(11) NOT NULL DEFAULT '0',
  `url` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `pid`, `title`, `text`, `published`, `url`, `lang`) VALUES
(1, 0, 'Про нас', '&lt;p style=&quot;margin: 0px; padding: 0px; &quot;&gt;&lt;b&gt;ГАМБУРГ&lt;/b&gt;&lt;/p&gt;&lt;p style=&quot;margin: 0px; padding: 0px; &quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;margin: 0px; padding: 0px; &quot;&gt;&lt;img src=&quot;http://russkoepole.de/images/stories/kss_germany/img_7643%20-%20kopie.jpg&quot; alt=&quot;&quot; width=&quot;300&quot; align=&quot;none&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;margin: 0px; padding: 0px; &quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;margin: 0px; padding: 0px; &quot;&gt;&lt;b&gt;Зильберберг Борис Соломонович&lt;/b&gt;&lt;br&gt;член Федерального Собрания ОКС, представитель в ОКС земли Гамбург, председатель Земельного КС российских соотечественников Гамбурга&lt;br&gt;&lt;br&gt;&lt;b&gt;Контактные данные:&lt;/b&gt;&lt;/p&gt;&lt;p style=&quot;margin: 0px; padding: 0px; &quot;&gt;тел. 040-49295253, моб. 0176-48200354. Эл. адрес:&lt;a href=&quot;mailto:bsh1966@mail.ru&quot;&gt;bsh1966@mail.ru&lt;/a&gt;&lt;/p&gt;&lt;p style=&quot;margin: 0px; padding: 0px; &quot;&gt;&quot;Наш Дом Гамбург&quot;&lt;br&gt;c/o Chabad Lubawitsch, Rentzelstr. 36-40, 20146 Hamburg&lt;/p&gt;', 1, 'about', 'ru'),
(3, 0, 'Über uns', 'Über uns', 1, 'about', 'de'),
(4, 0, 'Гамбург Молодой', '2 сентября 2012 года родилось &lt;b&gt;движение «Гамбург Молодой»&lt;/b&gt; на основе Земельного &lt;a href=&quot;http://www.russkoepole.de/index.php?option=com_content&amp;amp;view=category&amp;amp;layout=blog&amp;amp;id=121&amp;amp;Itemid=413&amp;amp;lang=ru&quot;&gt;Координационного совета российских соотечественников Гамбурга&lt;/a&gt;. С инициативой создания молодёжного движения выступил председатель Земельного совета Борис Зильберберг. «Гамбург Молодой» приглашает к участию всю русскоговорящую молодёжь нашего города.&lt;br&gt;«Как было бы здорово снова встретиться и не один раз, и не два, а регулярно, и желательно, в Гамбурге!» - предложила Виктория, одна из участниц поездки в Санкт-Петербург в рамках учебно-образовательной программы «Здравствуй, Россия!». В 2012 г. только из Германии в этой программе приняли участие 40 девчонок и ребят в возрасте 15-19 лет. Остались классные воспоминания об экскурсиях по городу, нашей «Северной жемчужине», о дискотеках каждый вечер и о русской пище, богатой витаминами и минеральными солями (например о гречке!).&lt;br&gt;Неделя в Питере сплотила группу, завязались новые знакомства и захотелось обязательно продолжить дружбу на немецкой земле.&lt;br&gt;По возвращению домой ребят пригласили на заседание Земельного координационного Совета российских соотечественников Гамбурга. Их юношеский задор и энергия просто покорили членов Совета и они единогласно приняли решение поддержать молодое поколение в их начинаниях.&lt;p&gt;&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;Теперь у русскоязычной молодёжи Гамбурга будет помещение для встреч. Что задумали ребята? А именно то, что&amp;amp; интересно в их возрасте: встречи, танцы, поездки, да просто общение и поддержка друг друга. Вновь созданная группа открыта для новых членов и новых предложений.&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;Благодаря поддержке Земельного Совета, у ребят будет возможность поехать на мероприятия для молодых лидеров, активно участвовать в общественной и политической жизни, заниматься на семинарах по профессиональной подготовке. Они смогут проявить свои творческие и организаторские способности во встречах на конференциях и круглых столах, на концертах и фестивалях.&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;По замыслу основателей движения, будут проводиться спортивные мероприятия с целью пропаганды здорового образа жизни, а также продолжится знакомство с Россией. Члены движения «Гамбург Молодой» войдут в состав делегаций на молодёжные форумы, примут участие в образовательных и экскурсионных программах молодёжного обмена.&lt;br&gt;Дерзайте ребята! Теперь у вас есть хороший шанс проявить себя!&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;Валентина Мюллер,&lt;br&gt;Пресс-секретарь Земельного координационного Совета российских соотечественников Гамбурга&lt;/p&gt;&lt;p style=&quot;margin: 10px 0px; padding: 0px; background-color: rgb(255, 255, 255); &quot;&gt;Информационная служба сайта &quot;&lt;a href=&quot;http://russkoepole.de/undefined/&quot;&gt;Русское поле&lt;/a&gt;&quot;&lt;/p&gt;', 1, 'hamburg-molodoj', 'ru'),
(5, 0, 'Hamburg Jungen', 'Hamburg Jungen', 1, 'hamburg-jungen', 'de');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
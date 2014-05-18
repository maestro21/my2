<?php /** 
This is list of metatags used for crossparsing into different blogs and forums;
Structure is following:

$_METATAGS = array(
	'tag' => array(
		'name' => 'Имя тега',
		'addlink' => true,
		'actions' => array(
			array(
				'action' => 'forumupdate', 
				'pid' 	 => 1,
				'cond'   => '',
			),
			array(
				'action' => '',
				'pid' 	 => 1,
				'cond'   => '',
			),
		),	
	),	
);	

'actions' values:
	blog_add,  - add new record to blog 
	blog_up,   - update blog record
	forum_add, - add new comment to forum thread
	forum_up   - update forum thread comment

	
For blog list see  http://maestro21.tk/blogs
For forum list see http://maestro21.tk/forums	
	
**/
$_METATAGS = array(

	/****** B L O G S - P R O J E C T S ******/

	'rk' => array(
		'name' => 'Русский Клуб',
		'desc' => 'О России, фотки (города, девушки, армия), патриотические видео, политвидео. Основной проект - rusklub.tk',
		'addlink' => true,
		'actions' => array(
			array(
				'action' => 'blog_add', 
				'pid' 	 => 2,
			),
		),	
	),
	
	'su' => array(
		'name' => 'СССР',
		'desc' => 'Всё, что связано с СССР. Потом это будет проект "В СССР - bcccp.tk" ',
		'addlink' => true,
		'actions' => array(
			array(
				'action' => 'blog_add', 
				'pid' 	 => 21,
			),
			array(
				'action' => 'forum_add', 
				'pid' 	 => 45,
			),
		),	
	),
	
	'dz' => array(
		'name' => 'Дикий Запад',
		'desc' => 'Пиздец на Западе как он есть. Проект - dikiyzapad.tk',
		'addlink' => true,
		'actions' => array(
			array(
				'action' => 'blog_add', 
				'pid' 	 => 20,
			),
		),	
	),
	
	'pd' => array(
		'name' => 'План Даллеса',
		'desc' => 'Весь пиздец, который происходит в России с 91 года - потом запилим проект plandalesa.tk',
		'addlink' => true,
		'actions' => array(
			array(
				'action' => 'blog_add', 
				'pid' 	 => 19,
			),
		),	
	),
	
	'nw' => array(
		'name' => 'Netwatch',
		'desc' => 'Обзор интернета - потом запилим проект netwatch.tk',
		'addlink' => true,
		'actions' => array(
			array(
				'action' => 'blog_add', 
				'pid' 	 => 17,
			),
		),	
	),
	
	'epic' => array(
		'name' => 'Эпичность',
		'desc' => 'То, что пойдет в блог Империума - imperium.tk',
		'addlink' => true,
		'actions' => array(
			array(
				'action' => 'blog_add', 
				'pid' 	 => 14,
			),
		),	
	),
	
	/******* C O U N T R I E S ********/
	
	'ru' => array(
		'name' => 'Россия',
		'desc' => 'Все, что связано с Россией',
		'addlink' => true,
		'actions' => array(
			array(
				'action' => 'forum_add', 
				'pid' 	 => 49,
			),
		),	
	),
	
	'us' => array(
		'name' => 'США',
		'desc' => 'Ебучий пиндостан',
		'addlink' => true,
		'actions' => array(
			array(
				'action' => 'forum_add', 
				'pid' 	 => 83,
			),
		),	
	),
	
	'ua' => array(
		'name' => 'Украина',
		'desc' => 'Все, что связано с Украиной',
		'addlink' => true,
		'actions' => array(
			array(
				'action' => 'forum_add', 
				'pid' 	 => 47,
			),
		),	
	),
	
	'lv' => array(
		'name' => 'Латвия',
		'desc' => 'Все, что связано с Латвией',
		'addlink' => true,
		'actions' => array(
			array(
				'action' => 'forum_add', 
				'pid' 	 => 60,
			),
		),	
	),
	
	'eu' => array(
		'name' => 'Eвропа',
		'desc' => 'Новости Европы и Евросоюза',
		'addlink' => true,
		'actions' => array(
			array(
				'action' => 'forum_add', 
				'pid' 	 => 79,
			),
		),	
	),
	
	'cn' => array(
		'name' => 'Китай',
		'desc' => 'Новости Китая',
		'addlink' => true,
		'actions' => array(
			array(
				'action' => 'forum_add', 
				'pid' 	 => 81,
			),
		),	
	),
	
	/****** F U N ******/
	
	'lol' => array(
		'name' => 'Приколы',
		'desc' => 'Общий тег для всех приколов',
		'addlink' => true,
		'actions' => array(
			array(
				'action' => 'blog_add', 
				'pid' 	 => 7,
			),
			array(
				'action' => 'forum_add', 
				'pid' 	 => 69,
			),
		),	
	),
	
	'dem' => array(
		'name' => 'Демотиваторы',
		'desc' => '',
		'addlink' => false,
		'actions' => array(
			array(
				'action' => 'forum_add', 
				'pid' 	 => 42,
			),
		),	
	),
	
	'lolpic' => array(
		'name' => 'Смешные картинки',
		'desc' => 'Смешной комикс или картинка',
		'addlink' => false,
		'actions' => array(
			array(
				'action' => 'forum_add', 
				'pid' 	 => 66,
			),
		),	
	),
	
	'gif' => array(
		'name' => 'Гифки',
		'desc' => 'прикольные анимированные картинки',
		'addlink' => false,
		'actions' => array(
			array(
				'action' => 'forum_add', 
				'pid' 	 => 41,
			),
		),	
	),
	
	'bash' => array(
		'name' => 'Башки',
		'desc' => 'C сайта bash.im',
		'addlink' => false,
		'actions' => array(
			array(
				'action' => 'forum_up', 
				'pid' 	 => 68,
				'cond'	 => " `time` LIKE '".date("Y-m-d")."%'",
			),
		),	
	),
	
	'plol' => array(
		'name' => 'Политические приколы',
		'desc' => 'Все приколы, связанные с политикой - видео',
		'addlink' => true,
		'actions' => array(
			array(
				'action' => 'forum_add', 
				'pid' 	 => 86,
			),
		),	
	),
	
	
	/****** V I D E O  ******/

	'lolvid' => array(
		'name' => 'Смешные видео',
		'desc' => 'Дурнев, 100500, КВН, Камикадзе, Комедиант',
		'addlink' => true,
		'actions' => array(
			array(
				'action' => 'forum_add', 
				'pid' 	 => 84,
			),
		),	
	),
	
	'polvid' => array(
		'name' => 'Политические видео',
		'desc' => 'Чеснтый понедельник, Соловьев и т.д.',
		'addlink' => true,
		'actions' => array(
			array(
				'action' => 'forum_add', 
				'pid' 	 => 59,
			),
		),	
	),
	
	'milvid' => array(
		'name' => 'Милитари видео',
		'desc' => 'Хеллмарши там и т.д.',
		'addlink' => true,
		'actions' => array(
			array(
				'action' => 'forum_add', 
				'pid' 	 => 67,
			),
		),	
	),
		
	'muzvid' => array(
		'name' => 'Музыкальные видео',
		'desc' => 'Клипы официальные и не очень. Рок, попса, раммштайн, VSP',
		'addlink' => true,
		'actions' => array(
			array(
				'action' => 'forum_add', 
				'pid' 	 => 65,
			),
		),	
	),
	
	'sek' => array(
		'name' => 'Кургинян',
		'desc' => 'Сергей Евландович Кургинян и все его видео и статьи',
		'addlink' => true,
		'actions' => array(
			array(
				'action' => 'forum_add', 
				'pid' 	 => 58,
			),
		),	
	),
	
	'durnev' => array(
		'name' => 'Дурнев+1',
		'desc' => 'Люмпены и Дурнев+1. Он слишком охуенен, чтобы теряться в общей толпе.',
		'addlink' => true,
		'actions' => array(
			array(
				'action' => 'forum_add', 
				'pid' 	 => 88,
			),
		),	
	),
	
	'kino' => array(
		'name' => 'Кино',
		'desc' => 'Ок фильмы, кинообзоры, трейлеры, киноновости и т.д.',
		'addlink' => true,
		'actions' => array(
			array(
				'action' => 'forum_add', 
				'pid' 	 => 89,
			),
		),	
	),
	
	
		
	/****** G I R L S ******/
	
	'xxx' => array(
		'name' => 'XXX',
		'addlink' => false,
		'actions' => array(
			array(
				'action' => 'forum_up', 
				'pid' 	 => 62,
				'cond'	 => " `date` LIKE '".date("Y-m-d")."%'",
			),
		),	
	),
	
	'girls' => array(
		'name' => 'Девушки',
		'desc' => 'Фотографии красивых девушек',
		'addlink' => false,
		'actions' => array(
			array(
				'action' => 'blog_add', 
				'pid' 	 => 1,
			),
			array(
				'action' => 'forum_add', 
				'pid' 	 => 40,
			),
		),	
	),
	
	'love' => array(
		'name' => 'Любовь, отношения',
		'desc' => 'Все о девушках, любви, отношениях, сексе и т.д. Статьи, картинки и т.д.',
		'addlink' => true,
		'actions' => array(
			array(
				'action' => 'forum_add', 
				'pid' 	 => 63,
			),
		),	
	),
	
	'pickup' => array(
		'name' => 'Пикап',
		'desc' => 'Все о пикапе и соблазнении. Статьи, картинки, видео, примеры и т.д.',
		'addlink' => true,
		'actions' => array(
			array(
				'action' => 'forum_add', 
				'pid' 	 => 44,
			),
		),	
	),
	
	
	/**** M I S C ***/
	
	'gd' => array(
		'name' => 'Game dev',
		'desc' => 'Разработка игр. Unity3d, android и другие технологии',
		'addlink' => true,
		'actions' => array(
			array(
				'action' => 'forum_add', 
				'pid' 	 => 52,
			),
		),	
	),
	
	'wd' => array(
		'name' => 'Web dev',
		'desc' => 'Web разработка - CSS, HTML, JS, PHP и т.д. ',
		'addlink' => true,
		'actions' => array(
			array(
				'action' => 'forum_add', 
				'pid' 	 => 72,
			),
		),	
	),
	
	'sdev' => array(
		'name' => 'Саморазвитие',
		'desc' => 'Психологические и прочие видео, тексты, ссылки и т.д. для саморазвития',
		'addlink' => true,
		'actions' => array(
			array(
				'action' => 'forum_add', 
				'pid' 	 => 57,
			),
		),	
	),
	
	'hw' => array(
		'name' => 'Холивары',
		'desc' => 'Горячие споры, срачи и дискуссии на любую тему',
		'addlink' => true,
		'actions' => array(
			array(
				'action' => 'forum_add', 
				'pid' 	 => 91,
			),
		),	
	),
	
	'cool' => array(
		'name' => 'Годнота',
		'desc' => 'Интересные статьи, рассказы, красивые картинки, видео и т.д.',
		'addlink' => true,
		'actions' => array(
			array(
				'action' => 'forum_add', 
				'pid' 	 => 92,
			),
			array(
				'action' => 'blog_add', 
				'pid' 	 => 17,
			),
		),	
	),
	
);	

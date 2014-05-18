<?php

function pages_ini(){
	if(isAdmin()) {

		$table = array(
			'title' 	=> 'text',
			'text' 		=> 'text',
			'url' 		=> 'text',
			'lang' 		=> 'string',
			'published' => 'int',
			'pos'		=> 'int',
		);
		
		install('pages', $table);
		redirect(BASE_PATH.'pages/admin');
	}
}



function pages_new() {
	if(isAdmin()) {
		global $title;	
		$title = T('create new page');	
	} else {
		redirect(BASE_PATH);
	}
}

function pages_edit() {
	if(isAdmin()) {
		global $title, $id;	
		$ret = DBrow(sprintf("SELECT * FROM pages WHERE id=%d", $id));
		$title = T('edit page') . " '". $ret['title'] . "'";
		return $ret;
	} else {
		redirect(BASE_PATH);
	}
}

function pages_save() {
	if(isAdmin()) {
		global $_POST, $_PAGES, $title;
		$data = $_POST['data']; //inspect($_POST);
		$id = (int)(@$data['id']);
		if($data['url'] == '') $data['url'] = translit($data['title']);
		$sql = 	  	"`title` 	= '" . SQLstring($data['title']) . "',
					`text`		= '" . SQLstring($data['text']) . "',
					`url`		= '" . SQLstring($data['url']) . "',
					`lang`		= '" . SQLstring($data['lang']) . "',
					`published`	= '" . (int)(@$data['publish'])  . "'
				";
		if($id > 0) 
			$sql = "UPDATE pages SET $sql WHERE `id` = $id";
		else
			$sql = "INSERT IGNORE INTO pages SET $sql";
		DBquery($sql);	//echo $sql; die();
		redirect(BASE_PATH.'pages/admin');
	} else {
		redirect(BASE_PATH);
	}
}

function pages_admin() {
	if(isAdmin()) {
		global $title, $_PATH;	
		$lang = (isset($_PATH[2])?$_PATH[2]:DEFLANG);
		$title = T('list of pages') . ' / <a href="' . BASE_PATH . 'pages/new">' . T('add new') . '</a>' ;
		$pages['lang'] = $lang; 	
		$pages['pages'] = DBall("SELECT * FROM pages WHERE lang='$lang' ORDER BY published DESC");	
		return $pages;
	} else {
		redirect(BASE_PATH);
	}
}

function pages_del(){
	if(isAdmin()) {
		global $id;
		DBquery(sprintf("DELETE FROM pages WHERE id=%d",$id));
		redirect(BASE_PATH.'pages/admin');
	} else {
		redirect(BASE_PATH);
	}
}


function pages_view() {
	global $_PATH, $title;
	if($_PATH[sizeof($_PATH)-1] =='') unset($_PATH[sizeof($_PATH)-1]);
	$url   = join('/',$_PATH);// var_dump($url);
	if($url == '') {
		$sql = sprintf("SELECT * FROM pages WHERE lang='%s' AND published=3", get_lang());
	}else{
		$sql = sprintf("SELECT * FROM pages WHERE url='%s' AND lang='%s' AND published>0", $url, get_lang());
	}
	//echo $sql;
	$page  = DBrow($sql);
	$page['text'] = str_replace("&nbsp"," ", $page['text']);
	if($url == 'register') $page['text'] = str_replace('[FORM]', tpl( 'orders', array( 'do' => 'new')), $page['text']);
	$title = $page['title'];
	return $page['text'];	
}

function pages_default() {
	return pages_view();
}
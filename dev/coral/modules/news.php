<?php

function news_new() {
	if(isAdmin()) {
		global $title;	
		$title = T('create new news item');	
	} else {
		redirect(BASE_PATH);
	}
}

function news_edit() {
	if(isAdmin()) {
		global $title, $id;	
		$sql = sprintf("SELECT * FROM news WHERE id=%d", $id); //echo $sql;
		$ret = DBrow($sql);
		$title = T('edit news') . " '". $ret['title'] . "'";
		return $ret;
	} else {
		redirect(BASE_PATH);
	}
}

function news_save() {
	if(isAdmin()) {
		global $_POST, $_news, $title, $_FILES;
		//inspect($_FILES); 
		$data = $_POST['data']; //inspect($_POST);
		$id = (int)(@$data['id']);
		if($data['url'] == '') $data['url'] = translit($data['title']);
		$sql = 	  	"`title` 	= '" . SQLstring($data['title']) . "',
					`spoiler`	= '" . SQLstring($data['spoiler']) . "',
					`fulltext`	= '" . SQLstring($data['fulltext']) . "',
					`url`		= '" . SQLstring($data['url']) . "',
					`lang`		= '" . SQLstring($data['lang']) . "',
					`published`	= '" . (int)(@$data['publish'])  . "',
					`time` 		= '" . $data['time'] . "' 
				";
		if($id > 0) {
			$sql = "UPDATE news SET $sql WHERE `id` = $id";
		} else {
			$sql = "INSERT IGNORE INTO news SET  $sql";
			$id = DBinsertId();
		}
		DBquery($sql);	//echo $sql; die();
		
		

		$filename = "up/news/pics/$id.jpg"; 
		if(move_uploaded_file($_FILES['pic']['tmp_name'], $filename)) {
			createthumb($filename,$filename,400,300);	
			createthumb($filename,"up/news/thumbs/$id.jpg",100,75);	
		}
		//die();
		redirect(BASE_PATH.'news/admin');
	} else {
		redirect(BASE_PATH);
	}
}

function news_admin() {
	if(isAdmin()) {
		global $title, $_PATH;	
		$lang = (isset($_PATH[2])?$_PATH[2]:DEFLANG);
		$title = T('list of news') . ' / <a href="' . BASE_PATH . 'news/new">' . T('add new') . '</a>' ;
		$news = DBall("SELECT * FROM news WHERE lang='$lang' ORDER BY time DESC");	
		return $news;
	} else {
		redirect(BASE_PATH);
	}
}

function news_del(){
	if(isAdmin()) {
		global $id;
		DBquery(sprintf("DELETE FROM news WHERE id=%d",$id));
		redirect(BASE_PATH.'news/list');
	} else {
		redirect(BASE_PATH);
	}
}

function news_default() { 
	global $_PATH, $tplfn;
	if(@$_PATH[1] != '') 
		return news_view();
	else
		return news_list();
}


function news_list() {
	global $title;
	$title = T('news');
	return DBall(sprintf("SELECT * FROM news WHERE lang='%s' AND published ORDER BY time DESC",  get_lang()));
}


function news_view() {
	global $_PATH, $title, $action;
	$url   = $_PATH[1]; 
	$news  = DBrow(sprintf("SELECT * FROM news WHERE url='%s' AND lang='%s' AND published", $url, get_lang()));
	$title = $news['title'];
	$action = 'view';
	return $news;	
}
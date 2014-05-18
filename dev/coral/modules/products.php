<?php

function products_ini(){
	if(isAdmin()) {
		$table = array(
			'name' 		=> 'text',			
			'text' 		=> 'text',	
			'shorttext' => 'text',		
			'lang'		=> 'text',
			'url'		=> 'text',
			'public' 	=> 'int',
		);
		install('products', $table);
		redirect(BASE_PATH.'products/admin');
	}
}


function products_new() {
	if(isAdmin()) {
		global $title;	
		$title = T('add new product');	
	} else {
		redirect(BASE_PATH);
	}
}

function products_edit() {
	if(isAdmin()) {
		global $title, $id;	
		$sql = sprintf("SELECT * FROM products WHERE id=%d", $id); //echo $sql;
		$ret = DBrow($sql);
		$title = T('edit products') . " '". $ret['title'] . "'";
		return $ret;
	} else {
		redirect(BASE_PATH);
	}
}

function products_save() {
	if(isAdmin()) {
		global $_POST, $_products, $title, $_FILES;
		//inspect($_FILES); 
		$data = $_POST['data']; //inspect($_POST);
		$id = (int)(@$data['id']);
		if($data['url'] == '') $data['url'] = translit($data['name']);
		$sql = 	  	"`name` 	= '" . SQLstring($data['name']) . "',
					`shorttext`	= '" . SQLstring($data['shorttext']) . "',
					`text`		= '" . SQLstring($data['text']) . "',
					`url`		= '" . SQLstring($data['url']) . "',
					`lang`		= '" . SQLstring($data['lang']) . "',
					`public`	= '" . (int)(@$data['public'])  . "'
				";
		if($id > 0) {
			$sql = "UPDATE products SET $sql WHERE `id` = $id";
		} else {
			$sql = "INSERT IGNORE INTO products SET  $sql";
			$id = DBinsertId();
		}
		DBquery($sql);// or die(mysql_error() . $sql);	echo $sql; die();
		
		

		$filename = "up/products/pic/$id.jpg"; 
		if(move_uploaded_file($_FILES['pic']['tmp_name'], $filename)) {
			createthumb($filename,$filename,220,220);	
			createthumb($filename,"up/products/thumb/$id.jpg",150,150);	
		}
		//die();
		redirect(BASE_PATH.'products/admin');
	} else {
		redirect(BASE_PATH);
	}
}

function products_admin() {
	if(isAdmin()) {
		global $title;	
		$sql = "";
		$title = T('list of products') . ' / <a href="' . BASE_PATH . 'products/new">' . T('add new') . '</a>' ;
		$products = DBall("SELECT * FROM products ORDER BY id DESC");	
		return $products;
	} else {
		redirect(BASE_PATH);
	}
}

function products_del(){ 
	if(isAdmin()) {
		global $id;
		DBquery(sprintf("DELETE FROM products WHERE id=%d",$id));
		redirect(BASE_PATH.'products/admin');
	} else {
		redirect(BASE_PATH);
	}
}

function products_default() { 
	global $_PATH, $tplfn;
	if(@$_PATH[1] != '') 
		return products_view();
	else
		return products_list();
}


function products_list() {
	global $title, $id, $pages;
	$page 	= $id; 
	if($page > 0) $page--; 
	$perpage= 10;
	$title 	= T('products');
	$ret 	= DBall(sprintf("SELECT * FROM products WHERE lang='%s' AND public ORDER BY id DESC LIMIT ".$page*$perpage.",".$perpage,  get_lang()));
	$pages 	= DBfield(sprintf("SELECT CEILING(COUNT(id)/%d) FROM products WHERE lang='%s' AND public", $perpage, get_lang()));
	return $ret;
}


function products_view() {
	global $_PATH, $title, $action;
	$url   = $_PATH[1]; 
	$products  = DBrow(sprintf("SELECT * FROM products WHERE url='%s' AND lang='%s' AND public", $url, get_lang()));
	$title = $products['name'];
	$action = 'view';
	return $products;	
}
<?php

function orders_ini(){
	if(isAdmin()) {
		$table = array(
			'name' 		=> 'text',
			'dob' 		=> 'text',
			'address' 	=> 'text',
			'email' 	=> 'text',
			'products' 	=> 'text',
			'info'		=> 'text',
			'submitted' => 'date'
		);
		install('orders', $table);
		redirect(BASE_PATH.'orders/admin');
	}
}


function orders_new() {
	if(isAdmin()) {
		global $title;	
		$title = T('add new product');	
	} else {
		redirect(BASE_PATH);
	}
}

function orders_edit() {
	if(isAdmin()) {
		global $title, $id;	
		$sql = sprintf("SELECT * FROM orders WHERE id=%d", $id); //echo $sql;
		$ret = DBrow($sql);
		$title = T('edit orders') . " #'". $ret['id'] . "'";
		return $ret;
	} else {
		redirect(BASE_PATH);
	}
}

function orders_save() {
	global $_POST, $_orders, $title, $_FILES;
	//inspect($_FILES); 
	$data = $_POST['data']; //inspect($_POST);
	$id = (int)(@$data['id']);
	$sql = 	  	"`name` 	= '" . SQLstring($data['name']) . "',
				`dob`		= '" . SQLstring($data['dob']) . "',
				`address`	= '" . SQLstring($data['address']) . "',
				`email`		= '" . SQLstring($data['email']) . "',
				`products`	= '" . SQLstring($data['products']) . "',
				`info`		= '" . SQLstring($data['info']) . "'
			";
			
	if($id > 0) {
		$sql = "UPDATE orders SET $sql WHERE `id` = $id";
	} else {
		$sql = "INSERT IGNORE INTO orders SET  $sql, `submitted`=NOW()";
		$id = DBinsertId();
	}
	DBquery($sql);// or die(mysql_error() . $sql);	echo $sql; die();

	if(isAdmin()) {
		redirect(BASE_PATH.'orders/admin');
	}else{
		redirect(BASE_PATH.'orders/submitted');
	}
}

function orders_submitted() {
	global $title;
	$title = '';//T('order submitted');
}

function orders_admin() {
	if(isAdmin()) {
		global $title;	
		$sql = "";
		$title = T('list of orders') . ' / <a href="' . BASE_PATH . 'orders/new">' . T('add new') . '</a>' ;
		$orders = DBall("SELECT * FROM orders ORDER BY id DESC");	
		return $orders;
	} else {
		redirect(BASE_PATH);
	}
}

function orders_del(){ 
	if(isAdmin()) {
		global $id;
		DBquery(sprintf("DELETE FROM orders WHERE id=%d",$id));
		redirect(BASE_PATH.'orders/admin');
	} else {
		redirect(BASE_PATH);
	}
}

function orders_default() { 
	global $_PATH, $action;
	$action = 'new';
}


function orders_list() {
	global $title;
	$title = T('orders');
	return DBall(sprintf("SELECT * FROM orders WHERE lang='%s' AND public ORDER BY id DESC",  get_lang()));
}


function orders_view() {
	if(isAdmin()) {
		global $_PATH, $title, $action;
		$id   = $_PATH[2]; 
		$orders  = DBrow(sprintf("SELECT * FROM orders WHERE id=%d", $id));
		$title = T('order number') . ' #' . $id;
		$action = 'view';
		return $orders;	
	} else {
		redirect(BASE_PATH);
	}
}
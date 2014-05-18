<?php


function users_login() {
	global $_POST, $title;
	//inspect($_POST);
	if(isset($_POST['data'])) {
		//echo $_POST['data']['pass']; die();
		if(md5($_POST['data']['pass']) == '21232f297a57a5a743894a0e4a801fc3'){
			$_SESSION['user'] = array('id' => 1, 'name' => 'admin');
			redirect(BASE_PATH);
		}			
	}
	
	$title = T('login');
	
}

function users_logout() {
	global $_SESSION;
	unset($_SESSION['user']);
	redirect(BASE_PATH);
}


function users_default() {
	redirect(BASE_PATH);
}
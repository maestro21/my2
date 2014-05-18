<?php 
session_name("gm");
session_start(); 

include("settings.php");
include("functions.php");
DBconnect();
get_labels();

//mapping
switch(@$_GET['q']){
	case 'adm':
		$_GET['q'] = 'users/login';
	break;
}

//main logic
$data 	 = array();
$content = '';
$title 	 = '';
$pages   = 0;

$_PATH = explode('/',@$_GET['q']);
$module = @$_PATH[0];
if($module == '') $module = DEFMODULE; 
if($module == 'filter'){ setVar(@$_PATH[1],@$_PATH[2]); goBack(); die(); }
if(!file_exists("modules/$module.php")) $module = DEFMODULE;
$action = @$_PATH[1]; if($action == '') $action = DEFACTION;
$id = (int)@$_PATH[2];
$fn	= $module . '_' . $action;  
include("modules/$module.php");
if(!function_exists($fn)){ $action = DEFACTION; $fn = $module . '_' . DEFACTION; }
$data = $fn(); 
$content = tpl($module, array('do' => $action , 'data' => $data, 'langs' => $langs, 'pages'	=> $pages, 'id' => $id));	
if($content == '') $title = T('404 page not found');

// output	
echo tpl('main',	
	array(
		'langs' 	=> $langs,
		'title'		=> $title,
		'content' 	=> $content,
	)
);	
?>
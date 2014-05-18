<?php
session_start();
include('sqlconf.php');
include("functions.php");
include('masterclass.php');
getLang();
DBconnect();
$_PATH = split('/',@$_GET['q']); //die(inspect($_PATH));
$cl = @$_PATH[0];

if($cl == 'login'){ include('login.php');die(); }
if(getVar('engineAdmin')==''){ redirect('login');  }

if($cl=='filter'){ setVar(@$_PATH[1],@$_PATH[2]); goBack(); die(); }

if(file_exists("classes/$cl.php")){
	include("classes/$cl.php");
	$class = new $cl();
}else
	$class = new masterclass();

$class->adminMode = true;
echo tpl('index', array(
		'path' => BASE_PATH,
		'class' =>$class->className,
		'langs' => array('en','ru'),
		'modules' => getModules(),
		'content' =>$class->parse()
		),1
	);	



?>
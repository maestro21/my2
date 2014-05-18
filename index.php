<?php 
session_name("engine");
session_start(); 
if(!file_exists('sqlconf.php')){
	include('install.php');
	die();
	}

include('sqlconf.php');
include("functions.php");
include('masterclass.php');
DBconnect();
getGlobals(); //echo G('mailFrom');

/*
if(superAdmin()) { 
	//$_GLOBALS['bgpic'] = G('mybgpic');
	setVar('lang','ru');
}else {
	setVar('lang','ru');
}	*/

getLang();
getTags();
getRights();
setVar('langs',Dball("SELECT * from langs"));

//login
//$_SESSION['logged'] = true;
//$_SESSION['logged'] = CheckLogged();
if(!$_SESSION['logged']) $_GET['q']='users/login';

$_PATH = split('/',@$_GET['q']); //die(inspect($_PATH));
if(@$_PATH[sizeof($_PATH)-1] == '') unset($_PATH[sizeof($_PATH)-1]);
if(@$_PATH[0]=='' && G('defmodule')!='') $_PATH[0] = G('defmodule');
$cl = $_PATH[0];
//if($_POST != array()) die(print_r($_POST));

//checking for filter
if($cl=='filter'){ setVar(@$_PATH[1],@$_PATH[2]); goBack(); die(); }
include('mapping.php');

//inspect($_GLOBALS);
//calling class
if(!DBfield("SELECT 1 FROM modules WHERE url='$cl'")) $cl = G('defmodule');
if(file_exists("classes/$cl.php")){
	include("classes/$cl.php");
	$class = new $cl(); //echo $cl;
}else
	$class = new masterclass();

$ajax = ($_POST['ajax'] || $class->ajax);
	
//drawing	
if($ajax)
	echo $class->parse();// . '<title>'.$class->title.'</title>';
else	
	echo tpl('index', array(
		'path' 		=> BASE_PATH,
		'class' 	=> $class->className,
		'langs' 	=> getVar('langs'),
		'modules' 	=> getModules(),
		'content' 	=> $class->parse(),
		'blogs'		=> $blogs,
		'sites'		=> $sites,
		'title'		=> $class->title,
		'buttons'	=> $class->buttons,
		'do'		=> $class->do,
		)
	);		
?>
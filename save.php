<?php
if(isset($_GET['url'])){
	include('sqlconf.php');
	include("functions.php");
	DBconnect();
	
	$url = parseString($_GET['url']);
	$page = file_get_contents($_GET['url']);	
	preg_match("/<title>(.*)<\/title>/", $page, $tit); //print_r($tit); die();
	$title = parseString(trim($tit[1]));
	date_default_timezone_set("Europe/Riga");
	$date = date("Y-m-d H:i:s");
	$sql = "INSERT INTO links SET `url`='$url', `label`='$title', `date`='$date'";
	DBquery($sql);

	/* TAGS */
	if(@$_GET['tags']!=''){
		$id= DBinsertId();
		$taglist = split(',',$_GET['tags']);
		$sql = "DELETE FROM linktags WHERE link_id='$id'";
		DBquery($sql);// echo $sql;
		if($taglist[0] != ''){
			foreach ($taglist as $tag){
				$tag = trim($tag);	
				$sql = "INSERT INTO	linktags SET link_id='$id', tag='$tag'";
				DBquery($sql); //echo $sql;
			}
		}
	}
	//$content = @file_get_contents('requests.html');
	//file_put_contents('requests.html',date("H:i, d.m.y")." <a href='$url' target=_blank><b>$url</b> - ".trim($tit[1])."</a><br>$content");
}
?>
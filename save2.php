<?php
if(isset($_GET['url'])){
	include('sqlconf.php');
	include("functions.php");
	DBconnect();
	
	$url = parseString($_GET['url']);
	$key = "rca.1.1.20140217T194504Z.a343e19f66dc557e.e2ec3f817b7dba35a503f25e44051a5eb57e4a0f";
	$result = file_get_contents("http://rca.yandex.com/?key=$key&url=$url");
	echo $result;
	/*$link = loadClass('links');
	$link->post['form'] = $data;
	$link->save();*/
}
?>
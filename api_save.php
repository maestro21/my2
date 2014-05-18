<?php 
include('sqlconf.php');
include("functions.php");
include('masterclass.php');
DBconnect();
$links = loadClass('links');
$links->post = $_REQUEST; 
$response = $links->getlink();
//echo json_encode($response);
?>
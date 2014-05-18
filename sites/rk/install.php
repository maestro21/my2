<?php
include('functions.php');
if(file_exists('sqlconf.php')){
	include("sqlconf.php");
	redirect(BASE_PATH);
}
$pre = "";//$pre = "themes/demo/";
if(@$_REQUEST['do'] == 'install'){
	@unlink("sqlconf.php");
	$content = "<?php 
		define('HOST_SERVER','".$_REQUEST['server']."');
		define('HOST_NAME','".$_REQUEST['name']."');
		define('HOST_PASS','".$_REQUEST['pass']."');
		define('HOST_DB','".$_REQUEST['db']."'); 
		define('BASE_PATH','".$_REQUEST['basepath']."');
		?>";
	file_put_contents("sqlconf.php",$content);
	include("sqlconf.php");// unlink("sqlconf.php");
	DBsrvconnect(); 
	$sql = "CREATE database IF NOT EXISTS`".$_REQUEST['db']."` CHARACTER SET utf8 COLLATE utf8_unicode_ci;";
	DBquery($sql);
	DBselDB();
	
	$file = file_get_contents('start.sql');  //die($sql);

	$queries = split(";",$file); //inspect($queries);
	foreach ($queries as $sql) DBquery($sql);
	
	$sql = "INSERT INTO users SET pass=MD5('".$_REQUEST['adminpass']."'), email='".$_REQUEST['adminmail']."', isadmin=2";
	DBquery($sql);// die($sql); 
	goBack();
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"> 
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<script language="javascript" src="<?=$path;?>/ajax.js"></script>
<script language="javascript" src="<?=$path;?>/functions.js"></script>
<link href="<?=$pre;?>style.css" type="text/css" rel="stylesheet" />

</head>
	<body class="content" bgcolor=lightgray>
		<center>
			<h1>Maestro engine installation</h1>
			<form method="post" action="">
				<input type="hidden" name="do" value="install">
				<table  class="login install" cellpadding=0 cellspacing=0>
					<tbody>
					
						<tr>
							<td colspan="2" class="h topleft"><b>Connection options</b></td>
							
							<td colspan="2" class="h topright"><b>Settings</b></td>
						</tr>
						
						
						
						<tr>
							<td>Server</td>
							<td><input type="text" name="server"></td>
							
							<td>Base URL</td>
							<td><input type="text" name="basepath"></td>
						</tr>	
						
						
						
						<tr>
							<td>User</td>
							<td><input type="text" name="name"></td>
							
							<td colspan="2"  class="h"><b>Superadmin settings</b></td>
						</tr>
						
						
						
						<tr>
							<td>Password</td>
							<td><input type="text" name="pass"></td>
							
							<td>Email</td>
							<td><input type="text" name="adminmail"></td>							
						</tr>
						
						
						
						<tr>
							<td>Database</td>
							<td><input type="text" name="db"></td>
							
							<td>Password</td>
							<td><input type="text" name="adminpass"></td>							
						</tr>
						
						
						
						<tr>
							<td colspan="4" class="bottom instl">
								<button class="btn" onclick="this.form.submit()"><img src="<?=$pre;?>img/save_big.png" align="absmiddle"> Install</button>
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		</center>
	</body>
 </html> 





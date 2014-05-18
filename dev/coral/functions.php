<?php
/** DATABASE FUNCTIONS **/
function DBconnect()
{
	$link = mysql_connect(HOST_SERVER, HOST_NAME , HOST_PASS) or die('cannot connect to server');
	define('HOST_LINK',$link);// var_dump(HOST_LINK); var_dump(HOST_DB);
	mysql_select_db(HOST_DB,$link) or die('cannot connect to database');
	mysql_query("SET CHARACTER SET 'UTF8'");
}

function DBquery($sql, $debug = 0)
{
	//var_dump(HOST_LINK);
	if($debug) die($sql);
	return mysql_query($sql,HOST_LINK);	
}

function striprow($bak = array()){
	if(!empty($bak))
		foreach ($bak as $k=>$v){
			$bak[$k] = stripslashes($v);
		}
		
	return $bak;
}

function DBrow($sql, $echo = false)
{
	$res = DBquery($sql);
	$bak = mysql_fetch_assoc($res);
	striprow($bak);
	mysql_free_result($res);
	return $bak;	
}

function DBcol($sql)
{	
	$bak = Array();
	$res = DBquery($sql);
	while ($row =mysql_fetch_row($res)) $bak[] = stripslashes($row[0]);	
	mysql_free_result($res);	
	return $bak;	
}

function DBall($sql, $echo = false)
{
	$bak = Array();
	$res = DBquery($sql);
	//print_r($res);
	while ($row = @mysql_fetch_assoc($res)) $bak[] = striprow($row);
	@mysql_free_result($res);	
	//print_r($bak);
	return $bak;	
}

function DBfield($sql, $echo = false)
{
	$res = DBquery($sql);
	$bak = stripslashes(@mysql_result($res,0));	
	mysql_free_result($res);	
	return $bak;		
}


function DBnumrows($sql, $echo = false) //select
{
	$res = DBquery($sql);
	$bak = mysql_num_rows($res);	
	mysql_free_result($res);
	return $bak;	
}

function DBinsertId(){
	return mysql_insert_id();
}

function DBaffrows($sql, $echo = false) //insert update delete
{
	$res = DBquery($sql);
	$bak = mysql_affected_rows(DBquery($sql));
	mysql_free_result($res);
	return $bak;		
}

function DBfields($sql){ //returns fields
	$return = Array();
	$query = DBquery($sql);
	$field = mysql_num_fields( $query );   
	for ( $i = 0; $i < $field; $i++ ) {   
		$f = mysql_field_name( $query, $i );   
		$return[$f]=$f;
	}
	//inspect($return);
	/*$res = DBrow($sql);
	
	foreach ($res as $k=>$v){
		$return[]=$k;
	} */
	return $return;
}

/** DEBUG FUNCTIONS **/

function debug($text=''){
	$info = debug_backtrace();
	//inspect($info);
	$info = $info[0];
	//inspect($info);
	$text = "File ".$info['file'] . "->class ".$info['type']."->function ".$info['function']."->line ".$info['line']."->data => (\n "
	.print_r($text,1);
	if(file_exists(LOGFILE)){
		$f = fopen(LOGFILE,"a+");
		fwrite($f,$text . "\n)\n\r");
		fclose($f);
	}	
}

/** TEMPLATE FUNCTIONS **/


function tpl($path,$vars=array()){
	foreach ($vars as $k =>$v){  // проходимся по всем элементам массива
		if(!is_array($v))
			$$k=html_entity_decode(stripslashes($v)); 
		else
			$$k=$v;
	}
	ob_start(); // начинаем вывод в буфер
	if(!strpos($path,".")) $path = 'tpl/'.$path.'.tpl.php';
	include($path); // подключаем темплейт
	$tpl = ob_get_contents(); // берем содержимое
	ob_end_clean(); // очищаем буфер
	return $tpl;	
}

/** FORMAT FUNCTIONS **/ 

function SQLstring($string){
	return addslashes(htmlspecialchars(trim($string)));
}

function HTMLstring($string){
	return htmlspecialchars_decode(strip_slashes($string));
}


function inspect($data){
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}

function replace($matches){
	print_r($matches);
}

function getGet($label,$defval = ''){
	global $_GET;
	return (isset($_GET[$label])?$_GET[$label]:$defval);
}

function getPost($label,$defval = ''){
	global $_POST;
	return (isset($_POST[$label])?$_POST[$label]:$defval);
}

function getAll($label,$defval = ''){
	global $_REQUEST;
	return (isset($_REQUEST[$label])?$_REQUEST[$label]:$defval);
}

function insertSQL($data=array()){
	$return = '';
	
}

function updateSQL($data,$cond){
	$return = '';
}

 
 /** SESSION **/
 
 
function getVar($label,$defval = ''){
	global $_SESSION;
	return (isset($_SESSION[$label])?$_SESSION[$label]:$defval);
}

function setVar($label,$val){
	global $_SESSION;
	$_SESSION[$label] = $val;
}

function unsetVar($label){
	global $_SESSION;
	unset($_SESSION[$label]);
}

function checkVar($label){
	global $_SESSION;
	return isset($_SESSION[$label]);
}

function debugVar($label){
	global $_SESSION;
	debug($_SESSION[$label]);
}

/** LANGUAGE FUNCTIONS **/


function label($label){
	global $_SESSION;
	 return (isset($_SESSION[$label])?$_SESSION[$label]:$label);
}

function output($html=''){
	$labels = getVar('labels');
	foreach ($labels as $k =>$v){
	//echo "$k => $v";
		$html=str_replace("%lng_$k%",$v,$html);
	}
	echo $html;
}


/*** FILTERS **/
function setFilter(){
	setVar(getAll('filter'),getAll('value'));
	unset($_GET['filter']);	
	goBack();
}



/** URL fuctions  **/

function redirect($to,$time=0){
	$to = str_replace('#','',$to);
	echo "<html><body><script>setTimeout(\"location.href='$to'\", {$time}000);</script></body></html>";
}	

function goBack($time=0){
	redirect($_SERVER['HTTP_REFERER'],$time);
	//echo "<html><body><script>window.location='".$_SERVER['HTTP_REFERER']."'</script></body></html>";
}


/*** MISC ***/



function T($text=''){
	global $labels;
	return (@$labels[$text]!=''?$labels[$text]:$text);
}

/*URL functions*/

function url2arr($url='',$print=0){
	if($url=='') return array();
	$arr = ''; 
	$tmparr = split('&',$url);
	foreach($tmparr as $var){
		//print_r($var);
		$tt = split('=',$var); //print_r($tt);
		$arr[$tt[0]] = $tt[1];
	}	
	if($print) inspect($arr);
	return $arr;
	
}

function arr2url($arr=array(),$print=0){
	if($arr==array()) return '';
	$url = '';
	$tmparr = array();
	foreach ($arr as $k=>$v){
		$tmparr[] = "$k=$v";
	}
	$url = join('&',$tmparr);
	if($print) echo $url;
	return $url;
}


/** STAT function **/
function logWrite(){
	global $_GET,$_SERVER;
	$url = arr2url($_GET);
	$time = date("Y-m-d H:i:s");
	$ip = getIp();
	$from = $_SERVER['HTTP_REFERER'];
	$h =fopen('stat/stat.txt','a+');
	fwrite($h,"$time,$ip,$url,$from\r\n");
	fclose($h);
	
}

function getIp(){
	if (@$_SERVER["HTTP_X_FORWARDED_FOR"] != "")
		return @$_SERVER["HTTP_X_FORWARDED_FOR"]; 
	else 
		return $_SERVER["REMOTE_ADDR"];
}


function logRead($url='stat/stat.txt',$print=0){
	$tmparr = file($url); 
	$ret = array();
	foreach ($tmparr as $line){
		$tmp = split(',',$line);
		$_tmp['time'] = $tmp[0];
		$_tmp['ip'] = $tmp[1];
		$_tmp['url'] = $tmp[2];
		$_tmp['from'] = $tmp[3];
		$ret[] = $_tmp;
	}	
	if($print) inspect($ret);
	return $ret;
}



/**/

function isAdmin(){
	global $_SESSION;
	return (@$_SESSION['user']['id'] == 1);
}


function createthumb($name,$filename,$new_w,$new_h){
	//$system=explode('.',$name);// echo $name;
	$size = getimagesize($name);
	if (preg_match('/jpg|jpeg/',$size['mime'])){
		$src_img=imagecreatefromjpeg($name); $type = "jpg";
	}
	if (preg_match('/png/',$size['mime'])){
		$src_img=imagecreatefrompng($name); $type = "png";
	}
	if(preg_match('/gif/',$size['mime'])){
		$src_img=imagecreatefromgif($name); $type = "gif";
	}
	$old_x=imageSX($src_img);
	$old_y=imageSY($src_img);
	//print_r($old_y); print_r($old_x);
	//if($old_x < $new_w && $old_y < $new_h) return true;
	$padding = 0;
	$paddingh = 0;
	$dstpadding = 0;
	$dstpaddingh = 0;
	
	if($old_x/$old_y > $new_w / $new_h){	
		$old2new = $old_y / $new_h; 
		$owidth = (int)($new_w * $old2new);
		$oheight = $old_y;
		if($owidth < $old_x){
			$padding = (int)(($old_x - $owidth ) / 2);
		}else{
			$dstpadding = (int)(($owidth - $old_x ) / 2 * $old2new);
		}
	}else{
		$old2new = $old_x / $new_w; 
		$oheight = (int)($new_h * $old2new);
		$owidth = $old_x;
		if($oheight < $old_y){
			$paddingh = (int)(($old_y - $oheight ) / 2);
		}else{
			$dstpaddingh = (int)(($oheight - $old_y ) / 2 * $old2new);
		}
	}
	
	/**echo "Old:x=$old_x,y=$old_y; <br>
		New:x=$new_h,y=$new_w;<br>
		oldheight to new height: $old2new;<br>
		new width in old dimensions: $owidth; <br>
		source padding: $padding, new padding:$dstpadding;";/**/
	

	$dst_img=ImageCreateTrueColor($new_w,$new_h);
		imagecopyresampled($dst_img,$src_img,$dstpadding,$dstpaddingh,$padding,$paddingh,$new_w,$new_h,$owidth,$oheight);
	/*if (preg_match("/png/",$system[1]))
	{
		imagepng($dst_img,$filename); 
	} else {
		imagejpeg($dst_img,$filename); 
	}*/
	switch($type){
		case 'jpeg':
		case 'jpg': imagejpeg($dst_img,$filename);  break;
		case 'gif': imagegif($dst_img,$filename);  break;
		case 'png': imagepng($dst_img,$filename); break;
	} 
	imagedestroy($dst_img); 
	imagedestroy($src_img); 
}

function get_lang(){
	return getVar('lang',DEFLANG);
}

function get_labels(){
	global $labels;
	$tmp = file("lang/".get_lang().".txt"); // print_r($tmp);
	foreach($tmp as $s){
		$_s = explode("=",$s); $label = $_s[0]; unset($_s[0]); $text = join("=",$_s);
		$labels[trim($label)] = trim($text);
	}
}

function G($text){
	global $_GLOBALS;
	return @$_GLOBALS[$text];
}

function fDate($date){
	$dat  = explode(" ",$date);
	$time = explode(":",$dat[1]);
	$date = explode("-",$dat[0]);
	
	return $date[2].".".$date[1]."." .($date[0]-2000).", ".(int)$time[0].":".$time[1];
}

	function translit($st)
	{
		return strtr($st,
			array(
					" " => "-",
					"а" => "a",
					"б" => "b",
					"в" => "v",
					"г" => "g",
					"д" => "d",
					"е" => "e",
					"ё" => "yo",
					"ж" => "zh",
					"з" => "z",
					"и" => "i",
					"й" => "j",
					"к" => "k",
					"л" => "l",
					"м" => "m",
					"н" => "n",
					"о" => "o",
					"п" => "p",
					"р" => "r",
					"с" => "s",
					"т" => "t",
					"у" => "u",
					"ф" => "f",
					"х" => "h",
					"ц" => "c",
					"ч" => "ch",
					"ш" => "sh",
					"щ" => "shch",
					"ь" => "j",
					"ы" => "i",
					"ъ" => "y",
					"э" => "e",
					"ю" => "yu",
					"я" => "ya",
					"А" => "a",
					"Б" => "b",
					"В" => "v",
					"Г" => "g",
					"Д" => "d",
					"Е" => "ye",
					"Ё" => "yo",
					"Ж" => "zh",
					"З" => "z",
					"И" => "i",
					"Й" => "j",
					"К" => "k",
					"Л" => "l",
					"М" => "m",
					"Н" => "n",
					"О" => "o",
					"П" => "p",
					"Р" => "r",
					"С" => "s",
					"Т" => "t",
					"У" => "u",
					"Ф" => "f",
					"Х" => "h",
					"Ц" => "c",
					"Ч" => "ch",
					"Ш" => "sh",
					"Щ" => "shch",
					"Ь" => "`",
					"Ы" => "i",
					"Ъ" => "'",
					"Э" => "e",
					"Ю" => "yu",
					"Я" => "ya",    


					"Ä" => "Ae", 
					"Ö" => "Oe", 
					"Ü" => "ue",
					"ä" => "ae", 
					"ö" => "oe", 
					"ü" => "ue",
					"ß" => "ss",					
                    )
             );
	}

function install($table_name, $fields) {
	$sql = "DROP TABLE IF EXISTS `$table_name`"; DBquery($sql);
	$sql =	"CREATE TABLE `$table_name`(
			id INT NOT NULL AUTO_INCREMENT PRIMARY KEY";
			foreach ($fields as  $field => $type){
				switch($type){
					case 'string': $type = ' VARCHAR(40)'; break;
					case 'blob': $type = ' BLOB'; break;
					case 'text': $type = ' TEXT'; break;
					case 'int' : $type = ' INT DEFAULT 0'; break;
					case 'date' :
					case 'time' : $type = ' DATETIME'; break;
					case 'float' : $type = ' FLOAT DEFAULT 0'; break;	
					default : $type = '';	
				}
				if($type!='' && $field!='') $sql .= ",`$field` $type";
			}
	$sql.=	");";
	//echo $sql; 
	DBquery($sql) or die(mysql_error());
	//die();
}	

?>
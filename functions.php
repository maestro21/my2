<?php
/** DATABASE FUNCTIONS **/
function DBconnect()
{
	$link = mysql_connect(HOST_SERVER, HOST_NAME , HOST_PASS) or die('cannot connect to server');
	define('HOST_LINK',$link);
	mysql_select_db(HOST_DB,$link) or die('cannot connect to database');
	mysql_query("SET CHARACTER SET 'UTF8'");
}

function DBsrvconnect()
{
	$link = mysql_connect(HOST_SERVER, HOST_NAME , HOST_PASS) or die('cannot connect to server');
	define('HOST_LINK',$link);
	mysql_query("SET CHARACTER SET 'UTF8'");
}

function DBselDB(){
	mysql_select_db(HOST_DB,HOST_LINK) or die('cannot connect to database');
		mysql_query("SET CHARACTER SET 'UTF8'");
}

function DBquery($sql)
{
	//var_dump(HOST_LINK);
	$res = mysql_query($sql,HOST_LINK) or die(mysql_error() . ' '.$sql);
	return $res;	
}

function striprow($arr = array()){
	if(!empty($arr))
		foreach ($arr as $k=>$v){
			$arr[$k] = stripslashes($v);
		}
		
	return $arr;
}

function DBrow($sql, $echo = false)
{
	$res = DBquery($sql); //echo $sql;
	if($res){
		$arr = mysql_fetch_assoc($res);
		striprow($arr);
		mysql_free_result($res);
		return $arr;
	}else return false;	
}

function DBcol($sql)
{	
	$arr = Array();
	$res = DBquery($sql);
	if($res){
		while ($row =mysql_fetch_row($res)) $arr[] = stripslashes($row[0]);	
		mysql_free_result($res);	
		return $arr;	
	}else return false;
}

function DBall($sql, $echo = false)
{
	$arr = Array();
	$res = DBquery($sql);
	//print_r($res);
	if($res){
		while ($row = @mysql_fetch_assoc($res)) $arr[] = striprow($row);
		@mysql_free_result($res);	
		//print_r($arr);
		return $arr;
	}else
		return false;
}

function DBfield($sql, $echo = false)
{
	$res = DBquery($sql);
	if($res){
		$arr = stripslashes(@mysql_result($res,0));	
		@mysql_free_result($res);	
		return $arr;
	}else	
		return false;
}

function DBcell($sql, $echo = false){
	return DBfield($sql, $echo); }

function DBnumrows($sql, $echo = false) //select
{
	$res = DBquery($sql);
	if($res){
		$arr = mysql_num_rows($res);	
		mysql_free_result($res);
		return $arr;
	}else
		return false;
}

function DBinsertId(){
	return mysql_insert_id();
}

function DBaffrows($sql, $echo = false) //insert update delete
{
	$res = DBquery($sql);
	if($res){
		$arr = mysql_affected_rows(DBquery($sql));
		mysql_free_result($res);
		return $arr;
	}else
		return false;
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

function otpl($class,$method,$vars=array()){
	global $_CLASSES;
    if($_CLASSES[$class]==null){
		if(file_exists("tpl/$class.php"))
			require_once("tpl/$class.php");

		$_CLASSES[$class] = new $class(); 
	}
	ob_start();
	call_user_func_array(array($_CLASSES['tpl_'.$class], $method), $vars);
	$tpl = ob_get_contents(); 
	ob_end_clean(); 
	return $tpl;
}

function globalize($vars){
	foreach ($vars as $k =>$v){  // ïðîõîäèìñÿ ïî âñåì ýëåìåíòàì ìàññèâà
		global $$k;
		if(!is_array($v))
			$$k=html_entity_decode(stripslashes($v)); 
		else
			$$k=$v;
	}
}

function G($text){
	global $_GLOBALS;
	return @$_GLOBALS[$text];
}

function tpl($_TPL,$vars=array(),$adminmode=false){
	//echo G('theme');
	$theme = (G('theme') == 'default'?'':G('theme'));	
	if($theme !='' && file_exists("themes/$theme/$_TPL.html"))
		$url = "themes/$theme/$_TPL.html";
	else
		$url = "tpl/$_TPL.html";
	//echo $url;
	$tpl = false;	
		
	if($url){	
		foreach ($vars as $k =>$v){  
			if(!is_array($v))
				$$k=html_entity_decode(stripslashes($v)); 
			else
				$$k=$v;
		}	
			
		ob_start(); 	
		include($url); 
		$tpl = ob_get_contents(); 
		ob_end_clean(); 
	
	}
	return $tpl;	
}

function stpl($_TPL,$vars=array()){ //simple template - include direct file

	foreach ($vars as $k =>$v){  // ïðîõîäèìñÿ ïî âñåì ýëåìåíòàì ìàññèâà
		if(!is_array($v))
			$$k=html_entity_decode(stripslashes($v)); 
		else
			$$k=$v;
	}
	ob_start(); // íà÷èíàåì âûâîä â áóôåð	
	include($_TPL); // ïîäêëþ÷àåì òåìïëåéò
	$tpl = ob_get_contents(); // áåðåì ñîäåðæèìîå
	ob_end_clean(); // î÷èùàåì áóôåð
	return $tpl;	
}

/** FORMAT FUNCTIONS **/ 

function parseString($string){
	return addslashes(htmlspecialchars(trim($string)));
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




/*** FILTERS **/
function setFilter(){
	setVar(getAll('filter'),getAll('value'));
	unset($_GET['filter']);	
	goBack();
} 

function getLang(){
	global $labels;
	$tmp = file("lang/".getVar('lang',G('deflang','en')).".txt"); // print_r($tmp);
	foreach($tmp as $s){
		$_s = split("=",$s); $label = $_s[0]; unset($_s[0]); $text = join("=",$_s);
		$labels[trim($label)] = trim($text);
	}
	if(file_exists('themes/'.G('theme').'/lang.php')) include('themes/'.G('theme').'/lang.php');
	//inspect($labels);
}

function getTags() {
	global $labels;
	$tmp = preg_split('/\n|\r\n?/',G('tags'));
	foreach($tmp as $s){
		$_s = split("=",$s); $label = $_s[0]; unset($_s[0]); $text = join("=",$_s);
		$labels[trim($label)] = trim($text);
	}
}

function getFilterState($class,$field){
	$f = split("_",getVar('sort_'.$class));
	if($f[0] == $field){
		switch ($f[1]){
			case 'NONE': return 'ASC'; break;
			case 'ASC': return 'DESC'; break;
			case 'DESC': return 'NONE'; break;		
		}	
	}
	return 'ASC';
}

function filterImg($class,$field){
	$f = split("_",getVar('sort_'.$class));
	if($f[0] == $field){
		switch ($f[1]){
			case 'ASC': echo "&uArr;"; break;
			case 'DESC': echo "&dArr;"; break;		
		}	
	}
}


/** URL fuctions  **/

function redirect($to,$time=0){
	$to = str_replace('#','',$to);
	echo "<html><body><script>setTimeout(\"location.href='$to'\", {$time}000);</script></body></html>";
	if($time==0) die();
}	

function goBack(){
	redirect($_SERVER['HTTP_REFERER']);
	//echo "<html><body><script>window.location='".$_SERVER['HTTP_REFERER']."'</script></body></html>";
}


/*** MISC ***/


function doLogin(){
	$sql = "SELECT * from users where login='".getPost('login')."' AND pass=md5('".getPost('pass')."')"; 
	//inspect($sql); die();
	if (DBnumrows($sql)>0){
		$user = DBrow($sql);
		$user['logged'] = 1;
		setVar('admin',$user);		
	}
	goBack();
}

function doLogout(){
	unsetVar('admin');
	unsetVar('logged');
	print_r($_SESSION); die();
	//debug(getVar('user'));
}

function T($text=''){
	global $labels;
	return (@$labels[$text]!=''?$labels[$text]:$text);
}


function getModules(){
	/*$modlist = array(); 
	$dh  = opendir("ini"); $i=0;
	while (false !== ($filename = readdir($dh))) {
		if($filename !='.' && $filename!='..')	
			$modlist[] = str_replace('.txt','',$filename);
	}
	return $modlist; */
	return DBcol("SELECT url FROM modules WHERE isactive");
	//return file("modules.txt");
}


/** data fuctions **/

 function drawForm($fields,$data,$options){   // ðèñóåò ôîðìó
	//inspect($fields); inspect($data); inspect($options);
        $ret = '';//<table cellpadding=0 cellspacing=0>'; 
		$prefix = 'form';
        foreach($fields as $k=>$v)
        {
	//inspect($k); inspect($v);
			$class = "info";
            $return = "";
            switch (@$v['widget']){
                case 'text':
                    $return .="<input type=text value='".@$data[$k]."' name='{$prefix}[$k]' id='$k' />";
                break;
                
                case 'textarea':
					$class = "tainfo";
                    $return .="<textarea cols=100 rows=20 name='{$prefix}[$k]' id=$k>".@$data[$k]."</textarea>";
                break;
				
				case 'html':
					$class = "tainfo";
                    $return .="<textarea cols=100 rows=20 name='{$prefix}[$k]' id=$k>".@$data[$k]."</textarea>
					<script type='text/javascript'>
						bkLib.onDomLoaded(function() {
						 new nicEditor({fullPanel : true,maxHeight : 300}).panelInstance('$k');
						 }); 
					</script>
					";
                break;
				
				
				case 'bbcode':
					$class = "tainfo";
					 $return .="<textarea cols=100 rows=15 name='{$prefix}[$k]' id='$k'>".@$data[$k]."</textarea>
								<script type='text/javascript'>
									jQuery('#$k').wysibb({resize_maxheight:400});									
								</script>";
				break;
				
                
                case 'pass':
                    $return .="<input type=password value='' name='{$prefix}[$k]' id=$k />";
                break;
		
				case 'hidden':
                    $return .="<input type=hidden value='".@$data[$k]."' name='{$prefix}[$k]' id=$k />";
                break;
                
                case 'checkbox':
                    $return .="<input type=hidden name='{$prefix}[$k]' value=''><input type=checkbox  value=1 ".(@$data[$k]==1?"checked":"")." name='{$prefix}[$k]' id=$k />
		    ";
                break;
                
                case 'radio':
                    foreach (@$options[$k] as $kk => $vv){
						$return .=T($vv)." <input type='radio' name='{$prefix}[$k]' value='$kk' ".($kk==@$data[$k]?' checked':'')." />";
					}
                break;
                
                case 'select':
                    $return .="<select name={$prefix}[$k] id=$k>";
                    foreach (@$options[$k] as $kk => $vv){
						$return .="<option value='$kk'".($kk==@$data[$k]?' selected="selected"':'').">".T($vv)."</option>";
					}
					$return .="</select>";
				break;        

				case 'multselect':
					$class = "tainfo";
					$return .="<select multiple name={$prefix}[$k][] id=$k>";
					$dat = array_flip(split(',',@$data[$k]));
					foreach (@$options[$k] as $kk => $vv){
						$return .="<option value='$kk'".(isset($dat[$kk])?' selected="selected"':'').">".T($vv)."</option>";
					}
                    $return .="</select>";
                break;     

				case 'date':
					//echo @$data[$k];
					preg_match_all("/[[:digit:]]{2,4}/",@$data[$k],$matches);	
					$nums = $matches[0]; //print_r($nums);
					$return .="<input type='text' class='date year' name={$prefix}[$k][y] value='".(isset($nums[0])?$nums[0]:date('Y'))."' size=4>-";
					$return .="<select name={$prefix}[$k][m]>"; if(!isset($nums[1])) $nums[1] = date('m');
					for($i=1;$i<13;$i++) $return .= "<option value='$i'".($i==@$nums[1]?' selected="selected"':'')."'>".T("mon_$i")."</option>";			
					$return.="</select>-";
							
					$return .="<input type='text' class='date' name={$prefix}[$k][d] value='".(isset($nums[2])?$nums[2]:date('d'))."' size=2> &nbsp&nbsp&nbsp";
					$return .="<input type='text' class='date' name={$prefix}[$k][h] value='".(isset($nums[3])?$nums[3]:date('G'))."' size=2>:";
					$return .="<input type='text' class='date' name={$prefix}[$k][mi] value='".(isset($nums[4])?$nums[4]:date('i'))."' size=2>:";
					$return .="<input type='text' class='date' name={$prefix}[$k][s] value='".(isset($nums[5])?$nums[5]:date('s'))."' size=2>(HH:MM:SS)";
				
				break;	
				
            }
			
			switch (@$v['widget']) {
			
				case 'none':
				break;
				
				case 'hidden':
					$ret .= $return;
				break;
				
				default:
					$ret .="<tr><td id='descr_$k' class='$class'>".T($k)."</td><td class='data'>$return</td></tr>";
				break;
				
			}
			
			
			
        }
       // $ret .= '</table>';
        return $ret;    
    }

function chkz($int){
	if($int<10) return '0'.$int;
}

 function sqlFormat($type, $value){
	switch($type){
		case 'int': $value = intval($value);
		break;
		
		default: $value =  parseString($value); //addslashes(htmlspecialchars($value));
		break;
		
		case 'float': $value = floatval($value);
		break;
		
		case 'pass' : $value = md5($value);
		break;
		
		case 'date': if($value=='') $value = date("Y-m-d H:i:s"); else{
				$value = date("Y-m-d H:i:s",mktime(intval($value['h']), intval($value['mi']), intval($value['s']),
				intval($value['m']), intval($value['d']), intval($value['y'])));
				/*$value = intval($value['y']).'-'.chkz(intval($value['m'])).'-'.chkz(intval($value['d'])).' '.
				chkz(intval($value['h'])).':'.chkz(intval($value['mi'])).':'.chkz(intval($value['s']));	
				echo $value;*/
			}		
		break;
	}
	return $value;
} 
/*
function CheckLogged(){
	global $_SESSION,$_POST;
	if(@$_SESSION['user']!=''){
		return true;
	}else{
		if(isset($_POST['login'])){
			$sql = "SELECT * FROM users WHERE login='".$_POST['login']."' AND pass='".md5($_POST['pass'])."'";
			$_SESSION['user'] = DBrow($sql);// echo $sql;
			if($_SESSION['user']!='') return true;	
		}
		echo tpl('login'); die();
	}	
} */


function CheckLogged(){
	global $_SESSION,$_POST,$_COOKIE;// inspect($_SESSION);
	
	if(isset($_SESSION['user'])) return true;
	
	if(isset($_COOKIE['mail'])){
		$sql ="SELECT * FROM users where email='{$_COOKIE['mail']}'"; //echo $sql;
		$res = DBrow($sql); //inspect($res);
		if($res !='') $_SESSION['user'] = $res;
	}
	
	return isset($_SESSION['user']);
}

function treeDraw($data,$tpl=''){
	$ret = '';
	foreach ($data as $row){
		$_T = $tpl;
		if($row['children']!='')
			$row['children'] =treeDraw($row['children'],$tpl);
			
		foreach ($row as $k=>$v){
			$_T = str_replace('$'.$k,$v,$_T);
		}
		$ret .=$_T;
	}
	return $ret;
}

function fDate($date){
	$dat = split(" ",$date);
	$time = split(":",$dat[1]);
	$date = split("-",$dat[0]);
	
	return "<i class='date'>".$date[2]." ".T('mon_'.(int)$date[1])." " .$date[0].", ".(int)$time[0].":".$time[1]."</i>";
}

function getGlobals(){
	global $_GLOBALS;
	$res = DBAll("SELECT * FROM globals");
	foreach ($res as $row){
		//inspect($row); echo $row['descr'] . ' ' .$row['value'];
		$_GLOBALS[$row['name']] = $row['value'];
	}
	//inspect($_GLOBALS);
}



function superAdmin(){
	global $_SESSION;
	return (@$_SESSION['logged']);//(@$_SESSION['user']['id'] == 1);
}


function getRights(){
	global $_SESSION;
	unset($_SESSION['rights']);
	if(@$_SESSION['rights']==''){
		$_SESSION['rights'] = '';
		$mods = DBall("SELECT * FROM modules");
		foreach ($mods as $mod){//inspect($mod);
			$_SESSION['rights'][$mod['url']]['allow'] = array_flip(split(',',$mod['defrights_allow']));
			$_SESSION['rights'][$mod['url']]['deny'] = array_flip(split(',',$mod['defrights_deny']));
			$_SESSION['rights'][$mod['url']]['default'] = $mod['defrights'];
		}
	}
}

function sendMail($to,$title,$subj){
	$headers = "MIME-Version: 1.0 \r\n
Content-type: text/html; charset=utf-8\r\n
From: ".G('mailFrom')."\r\n"; // echo $to; die();
	//echo $title; die();
	mail($to,$title,$subj,$headers); //die();
}function loadClass($cl,$clname=''){	if(file_exists("classes/$cl.php")){		require_once("classes/$cl.php");		$class = new $cl($clname); //echo $cl;	}else{		$class = new masterclass($clname);		$class->className = $cl;		}		return $class;}function createthumb($name,$filename,$new_w,$new_h,$type){	switch($type){		case 'image/jpg':		case 'image/jpeg':			$src_img=imagecreatefromjpeg($name); $type = "jpg";		break;				case 'image/gif':			$src_img=imagecreatefromgif($name); $type = "gif";		break;				case 'image/png':			$src_img=imagecreatefrompng($name); $type = "png";		break;	}	//size of src image	$orig_w = imagesx($src_img);	$orig_h = imagesy($src_img);			$w_ratio = ($new_w / $orig_w); 	$h_ratio = ($new_h / $orig_h);		if ($orig_w > $orig_h ) {//landscape		$crop_w = round($orig_w * $h_ratio);		$crop_h = $new_h;		$src_x = ceil( ( $orig_w - $orig_h ) / 2 );		$src_y = 0;	} elseif ($orig_w < $orig_h ) {//portrait		$crop_h = round($orig_h * $w_ratio);		$crop_w = $new_w;		$src_x = 0;		$src_y = ceil( ( $orig_h - $orig_w ) / 2 );	} else {//square		$crop_w = $new_w;		$crop_h = $new_h;		$src_x = 0;		$src_y = 0;		}	$dest_img = imagecreatetruecolor($new_w,$new_h);	imagecopyresampled($dest_img, $src_img, 0 , 0 , $src_x, $src_y, $crop_w, $crop_h, $orig_w, $orig_h);		   	switch($type){		case 'jpg': imagejpeg($dest_img,$filename);  break;		case 'gif': imagegif($dest_img,$filename);  break;		case 'png': imagepng($dest_img,$filename); break;	} 	imagedestroy($dest_img); 	imagedestroy($src_img); }

function BB($text)	{
		//inspect($text);
		
		$text = preg_replace('/\[(\/?)(b|i|u|s|center|left|right)\s*\]/', "<$1$2>", $text);
		
		$text = preg_replace('/\[code\]/', '<pre><code>', $text);
		$text = preg_replace('/\[\/code\]/', '</code></pre>', $text);
		
		$text = preg_replace('/\[(\/?)quote\]/', "<$1blockquote>", $text);
		$text = preg_replace('/\[(\/?)quote(\s*=\s*([\'"]?)([^\'"]+)\3\s*)?\]/', "<$1blockquote>Цитата $4:<br>", $text);
		
		//$text = preg_replace('/\[url\](?:http:\/\/)?([a-z0-9-.]+\.\w{2,4})\[\/url\]/', "<a href=\"http://$1\">$1</a>", $text);
		$text = preg_replace('/\[url\s*\](?:http:\/\/)?([^\]\[]+)\[\/url\]/', "<a href=\"http://$1\" target='_blank'>$1</a>", $text);
		$text = preg_replace('/\[url\s?=\s?([\'"]?)(?:http:\/\/)?(.*)\1\](.*?)\[\/url\]/', "<a href=\"http://$2\" target='_blank'>$3</a>", $text);
		
		
		$text = preg_replace('/\[img\s*\]([^\]\[]+)\[\/img\]/', "<img src='$1'/>", $text);
		$text = preg_replace('/\[img\s*=\s*([\'"]?)([^\'"\]]+)\1\]/', "<img src='$2'/>", $text);
		//inspect($text); die();
		return nl2br($text);
}

function getUser(){
	return 1;
}

function getHost($url) {
	$ret = parse_url($url);
	return $ret['host'];
}


function logwrite($filename, $content) {
	file_put_contents("logs/{$filename}.txt" , $content . "\r\n", FILE_APPEND);
}
?>
<?
$blogs = dbAll("SELECT * from blogs order by name asc");
$blogs = array_merge( array(0 => array('url'=>'all','name'=>'Все записи')),$blogs);
foreach ($blogs as $blog)
	if($blog['url']==$cl){
		$_PATH[5] = $blog['id'];
		$_PATH[6] = $blog['url'];
		$_PATH[7] = $blog['name'];
		$_PATH[0] = $cl = 'records';
	}
	
$_S = array(
		'blogs' 		=> 'blog',
		'links' 		=> 'link',
		'pages' 		=> 'page',
		'filemanager' 	=> 'file',
		'tags' 			=> 'tag',
		'sites'			=> 'site',
		'posts'			=> 'post',
		'globals'		=> 'global',
	);
	
function S($var){
	global $_S;
	if(isset($_S[$var])) return $_S[$var]; else return $var;
}	
?>
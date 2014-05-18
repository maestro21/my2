<?
$blogs = dbAll("SELECT * from blogs");// inspect($blogs);
foreach ($blogs as $blog)
	if($blog['url']==$cl){
		$_PATH[5] = $blog['id'];
		$_PATH[6] = $blog['url'];
		$_PATH[7] = $blog['name'];
		$_PATH[0] = $cl = 'records';
	}
?>
<?php
$arr = array(
	'add',
	'del',
	'edit',
	'list',
	'ini',
	'view',
	);
	//inspect($labels);
foreach ($arr as $item){
	$labels[$item] = "<img src='".BASE_PATH."img/{$item}_xsml.png' align=absmiddle alt='".T($item)."' title='".T($item)."'>";
}

?>
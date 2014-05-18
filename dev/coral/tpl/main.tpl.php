<!DOCTYPE HTML>
<html>
<head>
<title><?=($title!=''?strip_tags($title) . ' - ' : '') . T('sitename');?></title>
<link href="<?=BASE_PATH;?>favicon.ico" rel="shortcut icon" type="image/x-icon" />
<script src="<?=BASE_PATH;?>functions.js" type="text/javascript"></script>
<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<LINK REL=StyleSheet HREF="<?=BASE_PATH;?>style.css" TYPE="text/css" MEDIA=screen>
<meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
<body>
<?php if(isAdmin()) {  include('adminpanel.tpl.php'); }?>
<div class="page-wrapper">
	<div class="header">
		<div class="wrap">
			<div class="right date">
				<div class="flags">
					<? foreach($langs as $lang => $lang_name) { ?>
						<a href="<?=BASE_PATH;?>filter/lang/<?=$lang;?>"><img src="<?=BASE_PATH;?>img/<?=$lang;?>.png"></a> 
					<? } ?>
				</div>
			</div>
		
			<h1><a href="<?=BASE_PATH;?>"><img src="<?=BASE_PATH;?>img/logo.jpg" height="55" align="absmiddle"> <?=T('sitename');?> <img src="<?=BASE_PATH;?>img/hamburg.png" align="absmiddle" height="55"> </a></h1>
		</div>
	</div>
	
	<div class="menu">
		<center>
			<?php 
				$pages = DBall(sprintf("SELECT * FROM pages WHERE lang='%s' AND published=2",get_lang())); 
				foreach ( $pages as $page ) { ?>
				<a href="<?=BASE_PATH.$page['url'];?>/"><?=$page['title'];?></a>
			<? } ?>
		</center>
	</div>

	
	<div class="content">
		<div class="wrap">
		<h2><?=$title;?></h2>
		
		<?=$content;?>
		
		</div>
	</div>
	
	<div class="page-buffer"></div>
</div>	
		
		
<div class="footer">
	<div class="wrap">
		<div class="copy"><div class="dev"><?=T('dev');?> <a href="#">Maestro</a>
		</div>&copy; 2013 <?=T('sitename');?> |  Alpina Wurm <b><img src="<?=BASE_PATH;?>img/icon_phone.gif" align="absmiddle">+49(0)407337511 <img src="<?=BASE_PATH;?>img/icon_mob.gif" align="absmiddle">+49(0)1795329364</b></div>
	</div>
</div>
	
	
</body>
</html>
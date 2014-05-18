<div class="adminpanel">
	<div class="wrap">
		<div class="right">
			<a href="<?=BASE_PATH;?>users/logout"><?=T('logout');?></a>
		</div>
		<div class="admdropdown" style="padding-right:20px;"><?=T('control panel');?>:
		<!-- <a href="<?=BASE_PATH;?>news/admin"><?=T('list of pages');?></a> | <a href="<?=BASE_PATH;?>news/new"><?=T('create new page');?></a>-->
		</div> 
		
		<div class="admdropdown" style="width:100px;">
			<a href="javascript:void(0);" onclick="showHide('dropdownmenu1')"><img src="<?=BASE_PATH;?>img/arr.png" align="absmiddle"><?=T('modules');?></a><br>
			<div  class="dropdownmenu" id="dropdownmenu1">
				<a href="<?=BASE_PATH;?>pages/admin"><?=T('pages');?></a>								
				<a href="<?=BASE_PATH;?>products/admin"><?=T('products');?></a>
				<a href="<?=BASE_PATH;?>news/admin"><?=T('news');?></a>
				<a href="<?=BASE_PATH;?>orders/admin"><?=T('orders');?></a>
			</div>
		</div>
		
		<div class="admdropdown">
			<a href="javascript:void(0);" onclick="showHide('dropdownmenu2')"><img src="<?=BASE_PATH;?>img/arr.png" align="absmiddle"><?=T('add content');?></a><br>
			<div  class="dropdownmenu" id="dropdownmenu2">
				<a href="<?=BASE_PATH;?>pages/new"><?=T('create new page');?></a>				
				<a href="<?=BASE_PATH;?>products/new"><?=T('add new product');?></a>
				<a href="<?=BASE_PATH;?>news/new"><?=T('create new news item');?></a>					
			</div>
		</div>
	</div>
</div>
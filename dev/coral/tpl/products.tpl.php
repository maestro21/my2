<?php
switch($do) {
	case 'view': //inspect($data); ?>
		<div class="item">
			<? if(file_exists('up/products/'.$data['id'].'.jpg')) { ?>
				<img src="<?=BASE_PATH.'up/products/'.$data['id'].'.jpg';?>" align="left">	
			<? } ?>
			<?=$data['text'];?>
		</div>
	<?		
	break;
	
	case 'edit': $id = $data['id'];

	case 'new': ?>
	
	<form method="POST" action="<?=BASE_PATH;?>products/save" enctype="multipart/form-data">
		<? if(@$data['id']>0) { ?>
			<input name="data[id]" type="hidden" value="<?=$data['id'];?>">
		<? } ?>
		<table>
			<tr>
				<td class="label">
					<?=T('lang');?>:
				</td>
				<td>
					<select name="data[lang]">
						<? foreach ($langs as $k=>$v) { ?>
							<option value="<?=$k;?>"><?=$v;?></option>
						<? } ?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="label">
					<?=T('url');?>:
				</td>
				<td>
					<input name="data[url]" type="text" value="<?=@$data['url'];?>">
				</td>
			</tr>
			<tr>
				<td class="label">
					<?=T('name');?>:
				</td>
				<td>
					<input name="data[name]" type="text" value="<?=@$data['name'];?>">
				</td>
			</tr>	
			</tr>
			<tr>
				<td class="label">
					<?=T('shorttext');?>:
				</td>
				<td>	
					<textarea cols="80" rows="5" name="data[shorttext]" id="spoiler"><?=@$data['shorttext'];?>
					</textarea>
			</tr>
			
			<tr>
				<td class="label">
					<?=T('full description');?>:
				</td>
				<td>	
					<textarea cols="100" rows="30" name="data[text]" id="text" >
					<?=@$data['text'];?>
					</textarea>
					<script type='text/javascript'>
						bkLib.onDomLoaded(function() {
							new nicEditor({fullPanel : true,maxHeight : 300}).panelInstance('text');
						}); 						 
					</script>
				</td>
			</tr>

			<tr>
				<td class="label">
					<?=T('picture');?>:
				</td>
				<td>
					<input name="pic" type="file">
				</td>
			</tr>
			
			
			<tr>
				<td class="label">
					<?=T('public');?>:
				</td>
				<td>
					<input type="checkbox" name="data[public]" value="1"  <?=(@$data['public']>0?' checked':'');?>> 
				</td>
			</tr>
			<tr>
				<td>
				
				</td>
				<td>
					<input type="submit">
				</td>
			</tr>
		</table>	
	</form>
	<? break;
	
	case 'default':
	case 'list': // inspect($data); ?>		
		<? foreach ($data as $product) { 
		//inspect($product);?>
		<div class="item products">
				<div class="pic">
					<? if(file_exists('up/products/'.$product['id'].'.jpg')) { ?>
						<img src="<?=BASE_PATH.'up/products/'.$product['id'].'.jpg';?>" align="left">	
					<? } ?>
				</div>
				<div class="txt">
					<h2><?=$product['name'];?></h2>
					<p class="spoiler"><?=$product['shorttext'];?>
					<a href="<?=BASE_PATH;?>products/<?=$product['url'];?>"><?=T('read more');?> &rarr;</a></p>
				</div>
			</div>
		<? } ?>
		
	<center>
		<?php if($pages>1) for($i=1;$i<=$pages;$i++){ ?>
			<a href="<?=BASE_PATH?>products/list/<?=$i;?>" class="pagination<?php if ($id==$i) echo ' active';?>"><?=$i;?></a>
		<?}?>
	</center>
		
	<? 	break;
	
	case 'admin': //inspect($data); ?>
		<div class="item">
		<table>
			<thead>
			<tr>
				<td>
					<?=T('id');?>
				</td>
				<td>
					<?=T('name');?>
				</td>
				<td>
					<?=T('isactive');?>
				</td>
				<td>
					<?=T('options');?>
				</td>
			</tr>	
			</thead>
			<?  if(isset($data))
				foreach ($data as $kk => $vv) { ?>
			<tr>
				<td>
					<?=$vv['id'];?>
				</td>
				<td>
					<a href="<?=BASE_PATH;?>products/<?=$vv['url'];?>" target="_blank"><?=$vv['name'];?></a>
				</td>
				<td>
					<?=($vv['public']>0?T('yes'):T('no'));?>
				</td>
				<td>
					<a href="<?=BASE_PATH;?>products/edit/<?=$vv['id'];?>"><?=T('edit');?></a>
					<a href="<?=BASE_PATH;?>products/del/<?=$vv['id'];?>"><?=T('del');?></a>
				</td>
			</tr>
			
			<? } ?>
		</table>	
		</div>	
	<? break; ?>
<? } ?>
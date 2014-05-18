<?php
switch($do) {
	case 'view':  ?>
		<div class="item">
			<p class="info"><?=fDate($data['time']);?></p><br>
			<? if(file_exists('up/news/pics/'.$data['id'].'.jpg')) { ?>
				<p><center><img src="<?=BASE_PATH.'up/news/pics/'.$data['id'].'.jpg';?>"></center></p>	
			<? } ?>
			<?=$data['fulltext'];?>
		</div>
	<?		
	break;
	
	case 'edit': $id = $data['id'];

	case 'new': ?>
	
	<form method="POST" action="<?=BASE_PATH;?>news/save" enctype="multipart/form-data">
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
					<?=T('title');?>:
				</td>
				<td>
					<input name="data[title]" type="text" value="<?=@$data['title'];?>">
				</td>
			</tr>	
			</tr>
			<tr>
				<td class="label">
					<?=T('shorttext');?>:
				</td>
				<td>	
					<textarea cols="80" rows="5" name="data[spoiler]" id="spoiler"><?=@$data['spoiler'];?>
					</textarea>
			</tr>
			
			<tr>
				<td class="label">
					<?=T('text');?>:
				</td>
				<td>	
					<textarea cols="100" rows="30" name="data[fulltext]" id="fulltext" >
					<?=@$data['fulltext'];?>
					</textarea>
					<script type='text/javascript'>
						bkLib.onDomLoaded(function() {
							new nicEditor({fullPanel : true,maxHeight : 300}).panelInstance('fulltext');
						}); 						 
					</script>
				</td>
			</tr>

			<tr>
				<td class="label">
					<?=T('time');?>:
				</td>
				<td>
					<input name="data[time]" type="text" value="<?=(@$data['time']!=''?$data['time']:date("Y-m-d H:i:s"));?>">
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
					<?=T('public');?>
				</td>
				<td>
					<input type="checkbox" name="data[publish]" value="1"  <?=(@$data['published']>0?' checked':'');?>> 
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
	case 'list':  //inspect($data); ?>		
		<? foreach ($data as $news) { ?>
		<div class="item news">
			<div class="pic">
				<? if(file_exists('up/news/thumbs/'.$news['id'].'.jpg')) { ?>
					<img src="<?=BASE_PATH.'up/news/thumbs/'.$news['id'].'.jpg';?>">	
				<? } ?>
			</div>
			<div class="txt">
				<span class="info"><?=fDate($news['time']);?></span><br>
				<a href="<?=BASE_PATH;?>news/<?=$news['url'];?>"><?=$news['title'];?></a>
				<p class="spoiler"><?=$news['spoiler'];?>
				<a href="<?=BASE_PATH;?>news/<?=$news['url'];?>"><?=T('read more');?> &rarr;</a></p>
			</div>	
		</div>
		<? } ?>
		
	<center>
		<?php if($pages>1) for($i=1;$i<=$pages;$i++){ ?>
			<a href="<?=$pre.$class?>/items/<?=$i;?>/<?=$search;?>" class="pagination"><?=$i;?></a>
		<?}?>
	</center>

	<? 	break;
	
	case 'admin': //inspect($data); ?>
		<? foreach ($langs as $k=>$v) { ?><div class="ln"><a href="<?=BASE_PATH;?>news/admin/<?=$k;?>"><b><img src="<?=BASE_PATH;?>img/<?=$k;?>.png"> <?=$v;?></b></a></div> <? } ?>
		<div class="item">
		<table>
			<thead>
			<tr>
				<td>
					<?=T('id');?>
				</td>
				<td>
					<?=T('lang');?>
				</td>
				<td>
					<?=T('time');?>
				</td>
				<td>
					<?=T('title');?>
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
					<?=$vv['lang'];?>
				</td>
				<td>
					<?=fDate($vv['time']);?>
				</td>
				<td>
					<?=$vv['title'];?>
				</td>
				<td>
					<?=($vv['published']>0?T('yes'):T('no'));?>
				</td>
				<td>
					<a href="<?=BASE_PATH;?>news/edit/<?=$vv['id'];?>"><?=T('edit');?></a>
					<a href="<?=BASE_PATH;?>news/del/<?=$vv['id'];?>"><?=T('del');?></a>
				</td>
			</tr>
			
			<? } ?>
		</table>	
		</div>	
	<? break; ?>
<? } ?>
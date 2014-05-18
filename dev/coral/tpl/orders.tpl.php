<?php
switch($do) {

	case 'submitted': echo '<center>'.T('order submitted text').'</center>'; break;

	case 'view': ?>
			<?=$data['text'];?>
			<table>
				<tr>
					<td class="label">
						<?=T('submitted');?>
					</td>
					<td>
						<?=$data['submitted'];?>
					</td>
				</tr>
				<tr>
					<td class="label">
						<?=T('name');?>
					</td>
					<td>
						<?=$data['name'];?>
					</td>
				</tr>
				<tr>
					<td class="label">
						<?=T('dob');?>
					</td>
					<td>
						<?=$data['dob'];?>
					</td>
				</tr>
				<tr>
					<td class="label">
						<?=T('email');?>
					</td>
					<td>
						<?=$data['email'];?>
					</td>
				</tr>
				<tr>
					<td class="label">
						<?=T('address');?>
					</td>
					<td>
						<?=str_replace("\n","<br>",$data['address']);?>
					</td>
				</tr>
				<tr>
					<td class="label">
						<?=T('products');?>
					</td>
					<td>
						<?=str_replace("\n","<br>",$data['products']);?>
					</td>
				</tr>
				
				<tr>
					<td class="label">
						<?=T('info');?>
					</td>
					<td>
						<?=str_replace("\n","<br>",$data['info']);?>
					</td>
				</tr>
		</table>
	<?		
	break;
	
	case 'edit': $id = $data['id'];

	case 'new': ?>
	<form method="POST" action="<?=BASE_PATH;?>orders/save" id="regform">
		<? if(@$data['id']>0) { ?>
			<input name="data[id]" type="hidden" value="<?=$data['id'];?>">
		<? } ?>

		<p>
			<?=T('name surname');?>:<br>
			<input name="data[name]" type="text" value="<?=@$data['name'];?>">
		</p>

		<p>
			<?=T('dob');?>:<br>
			<input name="data[dob]" type="text" value="<?=@$data['dob'];?>">
		</p>
	
		<p>
			<?=T('address phone');?>:<br>
			<textarea cols="80" rows="3" name="data[address]" id="address"><?=@$data['address'];?></textarea>
		</p>
			
		<p>
			<?=T('email');?>:<br>
			<input name="data[email]" type="text" value="<?=@$data['email'];?>">
		</p>
			
		<p>
			<?=T('product list');?>:<br>
			<textarea cols="80" rows="3" name="data[products]" id="products"><?=@$data['products'];?></textarea>
		</p>

		<p>
			<?=T('additional info');?>:<br>
			<textarea cols="80" rows="3" name="data[info]" id="info"><?=@$data['info'];?></textarea>
		</p>	
		<center>	
			<input type="submit">
		</center>
	</form>
	<? break;
	
	case 'default':
	case 'list': // inspect($data); ?>		
		<? foreach ($data as $product) { 
		//inspect($product);?>
		<div class="item products">
				<h2><?=$product['name'];?></h2>
				<? if(file_exists('up/products/thumb/'.$product['id'].'.jpg')) { ?>
					<img src="<?=BASE_PATH.'up/products/thumb/'.$product['id'].'.jpg';?>" align="left">	
				<? } ?>
				<p class="spoiler"><?=$product['shorttext'];?>
				<a href="<?=BASE_PATH;?>products/<?=$product['url'];?>"><?=T('read more');?> &rarr;</a></p>
			</div>
		<? } ?>
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
					<?=T('name surname');?>
				</td>
				<td>
					<?=T('email');?>
				</td>
				<td>
					<?=T('submitted');?>
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
					<a href="<?=BASE_PATH;?>orders/view/<?=$vv['id'];?>" target="_blank"><?=$vv['id'];?></a>
				</td>
				<td>
					<?=$vv['name'];?>
				</td>
				<td>
					<?=$vv['email'];?>
				</td>
				<td>
					<?=$vv['submitted'];?>
				</td>
				<td>
					<a href="<?=BASE_PATH;?>orders/edit/<?=$vv['id'];?>"><?=T('edit');?></a>
					<a href="<?=BASE_PATH;?>orders/del/<?=$vv['id'];?>"><?=T('del');?></a>
				</td>
			</tr>
			
			<? } ?>
		</table>	
		</div>	
	<? break; ?>
<? } ?>
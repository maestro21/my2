<?php
switch($do) {
	case 'login': ?>
		<div class="item">
			<form method="POST" action="">
				<table>
					<!--<tr>
						<td>
							<?=T('login');?>
						</td>
						<td>
							<input name="data[login];">
						</td>
					</tr>-->
					<tr>
						<td>
							<?=T('pass');?>
						</td>
						<td>
							<input name="data[pass];" type="password">
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
		</div>
	<?
	break;
}
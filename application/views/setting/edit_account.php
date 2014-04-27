<BR/>Account Details<BR/><BR/>
<?php if ( $this->session->flashdata( 'message' ) ) : ?>
  <br/><p><font color="red"><?php echo $this->session->flashdata( 'message' ); ?></font></p>
<?php endif; ?>
	<? if($queries < 0 || empty($queries)):?>
		<BR/><BR/>No Result Found...
	<?else:?>
		<?foreach($queries as $q):?>
			<form action="<?=base_url()?>setting/updateAccount" method="post" id="signupform">
				<table border="1">
					<tr>
						<td>Name:</td>
						<td><input type="text" name="name" value="<?=$q->name?>"/></td>
					</tr>
					<tr>
						<td>Username:</td>
						<td><input type="text" name="username" value="<?=$q->username?>"/></td>
					</tr>
					<tr>
						<td>Old Password:</td>
						<td><input type="password" name="old_password" value=""/></td>
					</tr>
					<tr>
						<td>New Password:</td>
						<td><input type="password" name="password" id="password" value=""/></td>
					</tr>
					<tr>
						<td>Confirm Password:</td>
						<td><input type="password" name="confirm_password" id="confirm_password" value=""/></td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="hidden" name="id" value="<?=$q->id?>"/>
							<input type="submit" name="submit" value="submit"/>
							<input type="reset" name="reset" value="reset"/>
						</td>
					</tr>
				</table>
			</form>
	<?endforeach;?>
	<?endif;?>
	
<h6>Log In:</h6><br/>
<?php echo validation_errors(); ?>
<?php if ( $this->session->flashdata( 'message' ) ) : ?>
    <br/><p><font color="red"><?php echo $this->session->flashdata( 'message' ); ?></font></p>
<?php endif; ?>
<form action="login" method="post">
	<table border="1">
		<tr>
			<td><label for="regularInput">Username:</label></td>
			<td><input type="text" id="name" name="name"/></td>
		</tr>
		<tr>
			<td><label for="regularInput">Password:</label></td>
			<td><input type="password" id="pass" name="pass"/></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="submit" value="Submit"/></td>
		</tr>
	</table>
</form>





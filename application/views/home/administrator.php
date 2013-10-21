<br/>LOG IN:
<?php echo validation_errors(); ?>
<form action="login" method="post">
<table border="1">
	<tr>
		<td><h6>Username:</h6></td>
		<td><input type="text" id="name" name="name"/></td>
	</tr>
	<tr>
		<td><h6>Password:</h6></td>
		<td><input type="password" id="pass" name="pass"/></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" name="submit" value="Submit"/></td>
	</tr>
</table>
</form>
<?php if ( $this->session->flashdata( 'message' ) ) : ?>
    <p><?php echo $this->session->flashdata( 'message' ); ?></p>
<?php endif; ?>




<br/>LOG IN:
<?php echo validation_errors(); ?>
<form action="login" method="post">
<table border="1">
	<tr>
		<td>Username:</td>
		<td><input type="text" id="name" name="name"/></td>
	</tr>
	<tr>
		<td>Password:</td>
		<td><input type="password" id="pass" name="pass"/></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" name="submit" value="Submit"/></td>
	</tr>
</table>
</form>




<script src="<?=base_url()?>public/js/jquery-ui-1.10.3.custom.min.js"></script>
<link rel="stylesheet" href="<?=base_url()?>public/css/ui-lightness/jquery-ui-1.10.3.custom.min.css"/>
<style>
div.ui-datepicker{
 font-size:11px;
 width: 20em;
 
}
.ui-datepicker select.ui-datepicker-month, 
.ui-datepicker select.ui-datepicker-year { width: 80%;}
</style>
<h6>Leave Type Form</h6><br/>
<?php if ( $this->session->flashdata( 'message' ) ) : ?>
  <br/><p><font color="red"><?php echo $this->session->flashdata( 'message' ); ?></font></p>
<?php endif; ?>
<form action="<?=base_url()?>setting/insertLeave" method="post" id="frm">
	<table border="1">
		<tr>
			<td><label for="regularInput">Code:</label></td>
			<td>
				<input type="text" name="code"/>
			</td>
		</tr>
		<tr>
			<td><label for="regularInput">Description:</label></td>
			<td>
				<input type="text" name="desc"/>
			</td>
		</tr>
		<tr>
			<td><label for="regularInput">Days Per Year:</label></td>
			<td><input type="text" name="days"/></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="submit" name="submit" value="submit"/>
				<input type="reset" name="reset" value="reset"/>
			</td>
		</tr>
	</table>
</form>
<script src="<?=base_url()?>public/js/jquery-ui-1.10.3.custom.min.js"></script>
<link rel="stylesheet" href="<?=base_url()?>public/css/ui-lightness/jquery-ui-1.10.3.custom.min.css"/>
<style>
div.ui-datepicker{font-size:11px;width: 20em;}
</style>
<script>
$(document).ready(function() 
{
	//alert("TEST");
   $('#frm').submit(function() 
   {
		//alert('Submit Data Entry!');
		//return false;
	});
});
</script>
<script>
$(function()
{
	$( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd',minDate: 0});
	$( "#datepicker1" ).datepicker({dateFormat: 'yy-mm-dd',minDate: 0});
});
</script>
<br/>
<h6>Inquire Leaves</h6>
<?php if ( $this->session->flashdata( 'message' ) ) : ?>
    <br/><p><font color="red"><?php echo $this->session->flashdata( 'message' ); ?></font></p>
<?php endif; ?>
<br/>
<form action="viewLeave" method="post" id="frm">
	<table border="1">
		<tr>
			<td><label for="regularInput">Name:</label></td>
			<td><!--<input type="text" name="emp_name"/>-->
				<select name="emp_name">
					<option value="">Employees</option>
					<?foreach($queries as $q):?>
					<option value="<?=$q->first_name?>"><?=$q->first_name."&nbsp;".$q->last_name?></option>
					<?endforeach;?>
				</select>
			</td>
		</tr>
		<tr>
			<td><label for="regularInput">Date of Leave:</label></td>
			<td>
				<input type="text" name="start_date" id="datepicker"/>
				<label for="regularInput">to</label>
				<input type="text" name="end_date" id="datepicker1"/>
			</td>
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

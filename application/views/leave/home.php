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
	$( "#datepicker" ).datepicker({
										dateFormat: 'yy-mm-dd',
										minDate: 0
										//beforeShowDay:function (dt){return [dt.getDay() == 5 || dt.getDay() == 6 ? false : true];},
										//onSelect:showtime,
										//onClose:date_change
									});
	
	$( "#datepicker1" ).datepicker({
										dateFormat: 'yy-mm-dd',
										minDate: 0
										//beforeShowDay:function (dt){return [dt.getDay() == 5 || dt.getDay() == 6 ? false : true];},
										//onSelect:showtime,
										//onClose:date_change
									
									});
});
</script>
<h6>Leave Form</h6><br/>
<?php if ( $this->session->flashdata( 'message' ) ) : ?>
  <br/><p><font color="red"><?php echo $this->session->flashdata( 'message' ); ?></font></p>
<?php endif; ?>
<form action="leave/add" method="post" id="frm">
	<table border="1">
		<tr>
			<td><label for="regularInput">Name:</label></td>
			<td><!--<input type="text" name="emp_name"/>-->
				<select name="emp_id">
					<option value="">Employees</option>
					<?foreach($queries as $q):?>
					<option value="<?=$q->id?>"><?=$q->first_name."&nbsp;".$q->last_name?></option>
					<?endforeach;?>
				</select>
			</td>
		</tr>
		<tr>
			<td><label for="regularInput">Code:</label></td>
			<td><!--<input type="text" name="emp_name"/>-->
				<select name="leave_type">
					<option value="">Leave</option>
					<?foreach($leave_types as $l_type):?>
					<option value="<?=$l_type->code?>"><?=$l_type->desc?></option>
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
			<td><label for="regularInput">Days:</label></td>
			<td><input type="text" name="no_days"/></td>
		</tr>
		<tr>
			<td><label for="regularInput">Pay Type:</label></td>
			<td>
				<select name="pay_type">
					<option value="">Pay</option>
					<?foreach($pay_types as $p_type):?>
					<option value="<?=$p_type->code?>"><?=$p_type->desc?></option>
					<?endforeach;?>
				</select>
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
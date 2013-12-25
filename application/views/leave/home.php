
<script src="<?=base_url()?>public/js/jquery-1.9.1.js"></script>
<script src="<?=base_url()?>public/js/jquery-ui-1.10.3.custom.min.js"></script>
<link rel="stylesheet" href="<?=base_url()?>public/css/ui-lightness/jquery-ui-1.10.3.custom.min.css"/>
<style>
div.ui-datepicker{
 font-size:11px;
}
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
	$( "#datepicker" ).datepicker();
	$( "#datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	$( "#datepicker1" ).datepicker();
	$( "#datepicker1" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
});
</script>

<BR/><h4>Leave Form</h4>
		<form action="leave/add" method="post" id="frm">
			<table border="1">
				
				<tr>
					<td><h6>Name:</h6></td>
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
					<td><h6>Code:</h6></td>
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
					<td><h6>Date of Leave:</h6></td>
					<td>
						<input type="text" name="start_date" id="datepicker"/>
						to
						<input type="text" name="end_date" id="datepicker1"/>
					</td>
				</tr>
				<tr>
					<td><h6>Days:</h6></td>
					<td><input type="text" name="no_days"/></td>
				</tr>
				<tr>
					<td><h6>Pay Type:</h6></td>
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
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
	 
});</script>

<BR/><h4>Add Employee</h4>
		<form action="<?=site_url('hr/addEmp'); ?>" method="post" id="frm">
			<table border="1">
				
				<tr>
					<td>First Name:</td>
					<td><input type="text" name="f_name"/></td>
				</tr>
				<tr>
					<td>Last Name:</td>
					<td><input type="text" name="l_name"/></td>
				</tr>
				<tr>
					<td>Start Date:</td>
					<td><input type="text" name="start_date" id="datepicker"/></td>
				</tr>
				<tr>
					<td>Leave Per 365 days(VL,SL):</td>
					<td>
						<select name="num_days">
							<option value="">Select Type</option>
							<option value="15">15 days</option>
							<option value="21">21 days</option>
							<option value="30">30 days</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>VL Outstanding:</td>
					<td><input type="text" name="vl_outstanding"/></td>
				</tr>
				<tr>
					<td>SL Outstanding:</td>
					<td><input type="text" name="sl_outstanding"/></td>
				</tr>
				<!--
				<tr>
					<td>Type of Leave:</td>
					<td>
						<select name="type_of_leave">
							<option value="">Select Type</option>
							<option value="pd">Paid</option>
							<option value="ntpd">Not Paid</option>
						</select>
					</td>
				</tr>
				-->
				<tr>
					<td></td>
					<td>
						<input type="submit" name="submit" value="submit"/>
						<input type="reset" name="reset" value="reset"/>
					</td>
				</tr>
			</table>
		</form>
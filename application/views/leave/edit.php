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

<? if($queries < 0 || empty($queries)):?>
		<BR/><BR/>No Result Found...
	<?else:?>
		<?foreach($queries as $q):?>
			<form action="<?=base_url()?>leave/update" method="post" id="frm">
				<table border="1">
					<tr>
						<td><label for="regularInput">Name:</label></td>
						<td><!--<input type="text" name="emp_name"/>-->
							<select name="emp_id">
								<option value="" disabled="disabled">Employees</option>
								<?foreach($emps as $emp):?>
									<option value="<?=$emp->id?>" <?=(($emp->id==$q->employee_id)?'selected':'')?>><?=$emp->first_name."&nbsp;".$emp->last_name?></option>
								<?endforeach;?>
							</select>
						</td>
					</tr>
					<tr>
						<td><label for="regularInput">Code:</label></td>
						<td><!--<input type="text" name="emp_name"/>-->
							<select name="leave_type">
								<option value="" disabled="disabled">Leave</option>
									<?foreach($leave_types as $l_type):?>
										<option value="<?=$l_type->code?>" <?=(($l_type->code==$q->leave_type)?'selected':'')?>><?=$l_type->desc?></option>
									<?endforeach;?>
							</select>
						</td>
					</tr>
					<tr>
						<td><label for="regularInput">Date of Leave:</label></td>
						<td>
							<script>$(function(){$("#datepicker").datepicker( "setDate" , "<?=$q->start?>" );});</script>
							<input type="text" name="start_date" id="datepicker"/>
							<label for="regularInput">to</label>
							<script>$(function(){$("#datepicker1").datepicker( "setDate" , "<?=$q->end?>" );});</script>
							<input type="text" name="end_date" id="datepicker1"/>
						</td>
					</tr>
					<tr>
						<td><label for="regularInput">Days:</label></td>
						<td><input type="text" name="no_days" value="<?=(int)$q->no_days?>"/></td>
					</tr>
					<tr>
						<td><label for="regularInput">Pay Type:</label></td>
						<td>
							<select name="pay_type">
								<option value="">Pay</option>
								<?foreach($pay_types as $p_type):?>
									<option value="<?=$p_type->code?>" <?=(($p_type->code==$q->pay_type)?'selected':'')?>><?=$p_type->desc?></option>
								<?endforeach;?>
							</select>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="hidden" name="trans_id" value="<?=$q->id?>">
							<input type="submit" name="submit" value="update"/>
						</td>
					</tr>
				</table>
			</form>
		<?endforeach;?>
	<?endif;?>
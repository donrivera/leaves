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
										changeMonth: true,
										changeYear: true,
										dateFormat: 'yy-mm-dd'
										//beforeShowDay:function (dt){return [dt.getDay() == 5 || dt.getDay() == 6 ? false : true];},
										//onSelect:showtime,
										//onClose:date_change
									});
	
	 
});</script>
<BR/><h6>Edit Employee</h6><BR/>
	<? if($queries < 0 || empty($queries)):?>
		<BR/><BR/>No Result Found...
	<?else:?>
	
		<?foreach($queries as $q):?>
			
			<form action="<?=base_url()?>hr/updateEmpLeave" method="post" id="frm">
				<table border="1">
					<tr>
						<td><label for="regularInput">First Name:</label></td>
						<td><input type="text" name="f_name" value="<?=$q->first_name?>"/></td>
					</tr>
					<tr>
						<td><label for="regularInput">Last Name:</label></td>
						<td><input type="text" name="l_name" value="<?=$q->last_name?>"/></td>
					</tr>
					<tr>
						<td><label for="regularInput">Start Date:</label></td>
						<script>$(function(){$("#datepicker").datepicker( "setDate" , "<?=$q->start_date?>" );});</script>
						<td><input type="text" name="start_date" id="datepicker"/></td>
					</tr>
					<tr>
						<td><label for="regularInput">Leave Per Year(AL):</label></td>
						<td>
							<select name="num_days">
								<option value="">Select Type</option>
								<option value="15" selected="<?($q->num_of_days==15?'selected':'')?>">15 days</option>
								<option value="21" selected="<?($q->num_of_days==21?'selected':'')?>">21 days</option>
								<option value="30" selected="<?($q->num_of_days==30?'selected':'')?>">30 days</option>
							</select>
						</td>
					</tr>
					<?
						$this->load->model('leave_balance','',TRUE);
						$vl=$this->leave_balance->viewBalance($q->id,'VL')->row();
						$sl=$this->leave_balance->viewBalance($q->id,'SL')->row();
						$ul=$this->leave_balance->viewBalance($q->id,'UL')->row();
					?>
					<tr>
						<td><label for="regularInput">Annual Leave(Outstanding Balance):</label></td>
						<td><input type="text" name="vl_outstanding" value="<?=(empty($vl->balance)?'':$vl->balance)?>"/></td>
					</tr>
					<tr>
						<td><label for="regularInput">Sick Leave (Current Balance):</label></td>
						<td><input type="text" name="sl_outstanding" value="<?=(empty($sl->balance)?'':$sl->balance)?>"/></td>
					</tr>
					<tr>
						<td><label for="regularInput">Unpaid Leave:</label></td>
						<td><input type="text" name="ul_outstanding" value="<?=(empty($ul->balance)?'':$ul->balance)?>"/></td>
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
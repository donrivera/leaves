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
	$( "#datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd");
	
	 
});</script>
<BR/>Edit Employee
	<? if($queries < 0 || empty($queries)):?>
		<BR/><BR/>No Result Found...
	<?else:?>
	
		<?foreach($queries as $q):?>
			<form action="<?=base_url()?>hr/updateEmpLeave" method="post" id="frm">
				<table border="1">
					<tr>
						<td>First Name:</td>
						<td><input type="text" name="f_name" value="<?=$q->first_name?>"/></td>
					</tr>
					<tr>
						<td>Last Name:</td>
						<td><input type="text" name="l_name" value="<?=$q->last_name?>"/></td>
					</tr>
					<tr>
						<td>Start Date:</td>
						<script>$(function(){$("#datepicker").datepicker( "setDate" , "<?=$q->start_date?>" );});</script>
						<td><input type="text" name="start_date" id="datepicker"/></td>
					</tr>
					<tr>
						<td>Leave Per 365 days:</td>
						<td>
							<select name="num_days">
								<option value="">Select Type</option>
								<option value="15" selected="<?($q->num_of_days==15?'selected':'')?>">15 days</option>
								<option value="21" selected="<?($q->num_of_days==21?'selected':'')?>">21 days</option>
								<option value="30" selected="<?($q->num_of_days==30?'selected':'')?>">30 days</option>
							</select>
						</td>
					</tr>
					<!--
					<tr>
						<td>Outstanding Balance:</td>
						<td><input type="text" name="outstanding_balance" value="<?//=$q->outstanding_balance?>"/></td>
					</tr>
					-->
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
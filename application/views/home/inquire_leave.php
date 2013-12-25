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
<br/>
<h4>Inquire Leaves</h4>
<br/>
<?php if ( $this->session->flashdata( 'message' ) ) : ?>
    <p><?php echo $this->session->flashdata( 'message' ); ?></p>
<?php endif; ?>
<br/>
<form action="viewLeave" method="post" id="frm">
			<table border="1">
				<tr>
					<td><h6>Name:</h6></td>
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
					<td><h6>Date of Leave:</h6></td>
					<td>
						<input type="text" name="start_date" id="datepicker"/>
						to
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
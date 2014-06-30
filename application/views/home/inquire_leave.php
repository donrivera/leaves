<script src="<?=base_url()?>public/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="<?=base_url()?>public/js/jquery-combobox.js"></script>
<link rel="stylesheet" href="<?=base_url()?>public/css/ui-lightness/jquery-ui-1.10.3.custom.min.css"/>
<style>
div.ui-datepicker{font-size:11px;width: 20em;}
.ui-datepicker select.ui-datepicker-month, 
.ui-datepicker select.ui-datepicker-year { width: 80%;}
.custom-combobox{position: relative;display: inline-block;}
.custom-combobox-toggle
{
	position: absolute;top: 0;bottom: 0;margin-left: -1px;padding: 0;
    /* support: IE7 */
    *height: 1.7em;
    *top: 0.1em;
}
.custom-combobox-input{margin: 0;padding: 0.3em;}
.ui-autocomplete { height: 150px; overflow-y: scroll; overflow-x: hidden;}
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
	$( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd',});
	$( "#datepicker1" ).datepicker({dateFormat: 'yy-mm-dd',});
	$( "#combobox" ).combobox();
    $( "#toggle" ).click(function(){$( "#combobox" ).toggle();});
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
				<select name="emp_name" id="combobox">
					<option value="">Employees</option>
					<?foreach($queries as $q):?>
					<option value="<?=$q->id?>"><?=$q->first_name."&nbsp;".$q->last_name?></option>
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

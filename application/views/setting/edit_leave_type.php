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
<BR/>Edit Leave Type<BR/>
<?php if ( $this->session->flashdata( 'message' ) ) : ?>
  <br/><p><font color="red"><?php echo $this->session->flashdata( 'message' ); ?></font></p>
<?php endif; ?>
	<? if($queries < 0 || empty($queries)):?>
		<BR/><BR/>No Result Found...
	<?else:?>
	
		<?foreach($queries as $q):?>
			
			<form action="<?=base_url()?>setting/updateLeave" method="post" id="frm">
				<table border="1">
					<tr>
						<td>Code:</td>
						<td><input type="text" name="code" value="<?=$q->code?>"/></td>
					</tr>
					<tr>
						<td>Description:</td>
						<td><input type="text" name="desc" value="<?=$q->desc?>"/></td>
					</tr>
					<tr>
						<td>Days Per Year:</td>
						<td><input type="text" name="days" value="<?=$q->days?>"/></td>
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
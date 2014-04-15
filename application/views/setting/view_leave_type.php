<link rel="stylesheet" href="<?=base_url()?>public/js/table_sorter/themes/blue/style.css" media="print, projection, screen">
<script type="text/javascript" src="<?=base_url()?>public/js/table_sorter/jquery-latest.js"></script> 
<script type="text/javascript" src="<?=base_url()?>public/js/table_sorter/jquery.tablesorter.js"></script> 
<script type="text/javascript" src="<?=base_url()?>public/js/table_sorter/addons/pager/jquery.tablesorter.pager.js"></script>
<script>
$(function() 
{
	$("table")
		.tablesorter({widthFixed: true, widgets: ['zebra']})
		.tablesorterPager({container: $("#pager"),size:5});
});
</script>
<a href="<?=base_url()?>setting/addLeave"><h6>Add Leave</h6></a>	
<br/>
<?="<b><h6>".count($queries)."&nbsp;Record/s Found</h6></b>";?>
<br/>
<table class="tablesorter">
<thead> 
	<tr>
		<th align="center">Code</th>
		<th align="center">Description</th>
		<th align="center">Days Per Year</th>
		<th align="center">Action</th>
	</tr>
</thead> 
<tbody> 
	<? if($queries < 0 || empty($queries)):?>
	<tr>
		<td align="center"><h6>No Result Found...</h6></td>
	</tr>
	<?else:?>
	<?foreach($queries as $q):?>
	<tr>
		<td align="center"><h6><?=$q->code?></h6></td>
		<td align="center"><h6><?=$q->desc?></h6></td>
		<td align="center"><h6><?=($q->code=='VL'?'N/A':$q->days)?></h6></td>
		<td align="center">
			<h6>
				<a href="<?=base_url()?>setting/editLeave/<?=$q->id?>">Edit</a>
				<a href="<?=base_url()?>setting/deleteLeave/<?=$q->id?>" onclick="return confirm('Are you sure you want to cancel this record ?')">Delete</a>
			</h6>
		</td>
		
	</tr>
	<?endforeach;?>
	<? endif;?>
</tbody> 
</table>

<!-- pager -->
<div id="pager" class="pager">
  <form>
    <img src="<?=base_url()?>public/js/table_sorter/addons/pager/icons/first.png" class="first"/>
    <img src="<?=base_url()?>public/js/table_sorter/addons/pager/icons/prev.png" class="prev"/>
    <span class="pagedisplay"><input type="text" class="pagedisplay"></span> <!-- this can be any element, including an input -->
    <img src="<?=base_url()?>public/js/table_sorter/addons/pager/icons/next.png" class="next"/>
    <img src="<?=base_url()?>public/js/table_sorter/addons/pager/icons/last.png" class="last"/>
    <select class="pagesize" width="">
      <option selected="selected" value="5">5</option>
      <option value="10">10</option>
      <option value="15">15</option>
    </select>
  </form>
</div>
<br/><br/><br/><br/><br/>

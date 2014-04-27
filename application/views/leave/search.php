<link rel="stylesheet" href="<?=base_url()?>public/js/table_sorter/themes/blue/style.css" media="print, projection, screen">
<link rel="stylesheet" href="<?=base_url()?>public/stylesheets/search.css" media="print, projection, screen">
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
<!--<a href="<?=base_url()?>leave"><h6>Add Leave</h6></a>-->	
<h6>Search Leave</h6><br/>
<form action="<?=base_url()?>leave/search" method="post">
	<div id="firstBlock">
	Search:&nbsp;
	<select name="search" style="width:100px;">
		<option value="">Select</option>
		<option value="name">Name</option>
		<option value="id">Id</option>
	</select>
	</div>
	<div id="secondBlock">
	Keyword:&nbsp;
	<input type="text" name="key" class="keyword"/>
	</div>
	<div id="thirdBlock">
	<input type="submit" name="submit" value="Search" style="width:70px;height:30px;"/>
	</div>
</form>
<br/><br/>
<?="<b><h6>".count($queries)."&nbsp;Record/s Found</h6></b>";?>
<p class="iconPrint"><a href="<?=base_url()?>leave/printExcel/<?=$opt?>/<?=$key?>"><img src="<?=base_url()?>public/images/printButton.png"/></a></p>
<? #$this->session->set_userdata('query',$this->db->last_query());?> 
<table class="tablesorter">
<thead> 
	<tr>
		<th align="center">Employee ID</th>
		<th align="center">First Name</th>
		<th align="center">Last Name</th>
		<th align="center">Code</th>
		<th align="center">Start</th>
		<th align="center">End</th>
		<th align="center">Days</th>
		<th align="center">Pay</th>
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
		<td align="center"><h6><?=substr($q->id,5,8)?></h6></td>
		<td align="center"><h6><?=$q->first_name?></h6></td>
		<td align="center"><h6><?=$q->last_name?></h6></td>
		<td align="center"><h6><?=$q->leave_desc?></h6></td>
		<td align="center"><h6><?=$q->start?></h6></td>
		<td align="center"><h6><?=$q->end?></h6></td>
		<td align="center"><h6><?=$q->no_days?></h6></td>
		<td align="center"><h6><?=$q->pay_desc?></h6></td>
		
		<td align="center">
			<h6>
				<a href="<?=base_url()?>leave/edit/<?=$q->trans_id?>"><img src="<?=base_url()?>public/images/edit.png" title="Edit"/></a>
				<a href="<?=base_url()?>leave/cancel/<?=$q->trans_id?>" onclick="return confirm('Are you sure you want to cancel this record ?')"><img src="<?=base_url()?>public/images/delete.png" title="Delete"/></a>
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

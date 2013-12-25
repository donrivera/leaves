<link rel="stylesheet" href="<?=base_url()?>public/js/table_sorter/themes/blue/style.css" media="print, projection, screen">

<script type="text/javascript" src="<?=base_url()?>public/js/table_sorter/jquery-latest.js"></script> 
<script type="text/javascript" src="<?=base_url()?>public/js/table_sorter/jquery.tablesorter.js"></script> 
<script type="text/javascript" src="<?=base_url()?>public/js/table_sorter/addons/pager/jquery.tablesorter.pager.js"></script>
<script>
$(function() 
{
	$("table")
		.tablesorter({widthFixed: true, widgets: ['zebra']})
		.tablesorterPager({container: $("#pager")});
});
</script>
<br/>
<a href="<?=base_url()?>hr/"><h5>Add New</h5></a>	
<br/>
<table class="tablesorter"> 
<thead> 
	<tr>
		<th align="center">Employee ID</th>
		<th align="center">First Name</th>
		<th align="center">Last Name</th>
		<th align="center">Starting Date</th>
		<th align="center">Annual Leave</th>
		<th align="center">Leave Balance</th>
		<th align="center">Annual leave balance on</th>
		<th align="center">Action</th>
	</tr>
</thead> 
<tbody> 
	<? if($queries < 0 || empty($queries)):?>
	<tr>
		<td align="center"><h6>No Result Found...</h6></td>
	</tr>
	<?else:?>
	<?php foreach($queries as $q):?>
	<tr>
		<td align="center"><h6><?=substr($q->id,3,8)?></h6></td>
		<td align="center"><h6><?=$q->first_name?></h6></td>
		<td align="center"><h6><?=$q->last_name?></h6></td>
		<td align="center"><h6><?=$q->start_date?></h6></td>
		<td align="center"><h6><?=$q->num_of_days?></h6></td>
		<td align="center"><h6><?=$q->vl_outstanding?></h6></td>
		<td align="center"><h6>
		<?
			$date_hired=explode("-",$q->start_date);
			$year=date("Y", strtotime("- 1 year", mktime(0, 0, 0,$date_hired[2],$date_hired[1],date("Y"))));
			if(date("Y")==$date_hired[0]):
			echo date("Y-m-d", strtotime("+ 11 month", mktime(0, 0, 0,$date_hired[1],$date_hired[2],$date_hired[0])));
			elseif($year==$date_hired[0]):
			echo date("Y-m-d", strtotime("+ 11 month", mktime(0, 0, 0,$date_hired[1],$date_hired[2],$date_hired[0])));
			else:
			echo date("Y-m-d", strtotime("+ 11 month", mktime(0, 0, 0,$date_hired[1],$date_hired[2],date("Y"))));
			endif;
		?></h6>
		</td>
		<td align="center">
		<h6>
			<a href="<?=base_url()?>hr/editEmpLeave/<?=$q->id?>">Edit</a>
			<a href="<?=base_url()?>hr/deleteEmpLeave/<?=$q->id?>" onclick="return confirm('Are you sure you want to delete this record ?')">Delete</a>
		</h6>
		</td>
	</tr>
	<?php endforeach;?>
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
      <option selected="selected" value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </form>
</div>


<br/>
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
	<?
		
		$start_ts = strtotime($form['start_date']);
		$end_ts = strtotime($form['end_date']);
		$diff = $end_ts - $start_ts;
		//echo round($diff / 86400)."&nbsp;days";
	?>
<br/>
<?="<b><h6>".count($queries)."&nbsp;Record/s Found</h6></b>";?>
<br/>
<table class="tablesorter">
	<thead> 
		<tr>
			<th align="center">Employee ID</th>
			<th align="center">First Name</th>
			<th align="center">Last Name</th>
			<th align="center">Starting Date</th>
			<th align="center">Annual Leave</th>
			<th align="center">VL Balance</th>
			<th align="center">SL Current</th>
			<th align="center">UL Current</th>
			<th align="center">Annual leave balance on</th>
		</tr>
	<thead>
	<tbody>
		<? if($queries < 0 || empty($queries)):?>
		<tr>
			<td align="center"><h6>No Result Found...</h6></td>
		</tr>
		<?else:?>
		<?foreach($queries as $q):?>
		<?
		$this->load->model('leave_balance','',TRUE);
		$vl=$this->leave_balance->viewBalance($q->id,'VL')->row();
		$sl=$this->leave_balance->viewBalance($q->id,'SL')->row();
		$ul=$this->leave_balance->viewBalance($q->id,'UL')->row();
		?>
		<tr>
			<td align="center"><h6><?=substr($q->id,5,8)?></h6></td>
			<td align="center"><h6><?=$q->first_name?></h6></td>
			<td align="center"><h6><?=$q->last_name?></h6></td>
			<td align="center"><h6><?=$q->start_date?></h6></td>
			<td align="center"><h6><?=$q->num_of_days?></h6></td>
			<td align="center"><h6><?=(empty($vl->balance)?'No Input':$vl->balance)?></h6></td>
			<td align="center"><h6><?=(empty($sl->balance)?'No Input':$sl->balance)?></h6></td>
			<td align="center"><h6><?=(empty($ul->balance)?'No Input':$ul->balance)?></h6></td>
			<td align="center">
			<h6>
			<?
				$date_hired=explode("-",$q->start_date);
			$year=date("Y", strtotime("- 1 year", mktime(0, 0, 0,$date_hired[2],$date_hired[1],date("Y"))));
			/*
			if(date("Y")==$date_hired[0]):
			echo date("Y-m-d", strtotime("+ 11 month", mktime(0, 0, 0,$date_hired[1],$date_hired[2],$date_hired[0])));
			elseif($year==$date_hired[0]):
			echo date("Y-m-d", strtotime("+ 11 month", mktime(0, 0, 0,$date_hired[1],$date_hired[2],$date_hired[0])));
			else:
			echo date("Y-m-d", strtotime("+ 11 month", mktime(0, 0, 0,$date_hired[1],$date_hired[2],date("Y"))));
			endif;
			*/
			$prev_year=$year = date('Y')-1;
			
			if(date("Y")==$prev_year)
			{
				$accrual=date("Y-m-d", strtotime("+ 11 month", mktime(0, 0, 0,$date_hired[1],$date_hired[2],$date_hired[0])));
			}
			else
			{
				if($date_hired[1]==01)
				{	$prev_year +=1;
					$accrual=date("Y-m-d", strtotime("+ 11 month", mktime(0, 0, 0,$date_hired[1],$date_hired[2],$prev_year)));
				}
				else
				{
					$check_accrual=date("Y-m-d", strtotime("+ 11 month", mktime(0, 0, 0,$date_hired[1],$date_hired[2],$prev_year)));
					$check_month=explode("-",$check_accrual);
					if((date("m")>$check_month[1]))
					{	
						$prev_year +=1;
						$accrual=date("Y-m-d", strtotime("+ 11 month", mktime(0, 0, 0,$date_hired[1],$date_hired[2],$prev_year)));
					}
					else
					{
						$accrual=date("Y-m-d", strtotime("+ 11 month", mktime(0, 0, 0,$date_hired[1],$date_hired[2],$prev_year)));
					}
				}
			}
			echo $accrual;
			?>
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

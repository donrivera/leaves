<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=employees.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table> 
<thead style="font-family:verdana;"> 
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
</thead> 
<tbody align="center" style="font-family:verdana;"> 
	<? if($queries < 0 || empty($queries)):?>
	<tr>
		<td align="center"><h6>No Result/s Found...</h6></td>
	</tr>
	<?else:?>
	<?php foreach($queries as $q):?>
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
		<td align="center"><h6>
		<?
			$date_hired=explode("-",$q->start_date);
			$year=date("Y", strtotime("- 1 year", mktime(0, 0, 0,$date_hired[2],$date_hired[1],date("Y"))));
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
		?></h6>
		</td>
	</tr>
	<?php endforeach;?>
	<? endif;?>
</tbody> 
</table>
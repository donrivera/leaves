<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=leave_report.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table>
<thead style="font-family:verdana;"> 
	<tr>
		<th align="center">Employee ID</th>
		<th align="center">First Name</th>
		<th align="center">Last Name</th>
		<th align="center">Code</th>
		<th align="center">Start</th>
		<th align="center">End</th>
		<th align="center">Days</th>
		<th align="center">Pay</th>
	</tr>
</thead> 
<tbody align="center" style="font-family:verdana;"> 
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
	</tr>
	<?endforeach;?>
	<? endif;?>
</tbody> 
</table>
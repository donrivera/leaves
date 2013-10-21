<br/>
<?="<b><h5>".count($queries)."&nbsp;Record/s Found</h5></b>";?>
<br/>
<table border="1">
	<tr>
		<td align="center"><h6>Employee ID</h6></td>
		<td align="center"><h6>First Name</h6></td>
		<td align="center"><h6>Last Name</h6></td>
		<td align="center"><h6>Starting Date</h6></td>
		<td align="center"><h6>Annual Leave</h6></td>
		<td align="center"><h6>Leave Balance</h6></td>
		<td align="center"><h6>Annual leave balance on</h6></td>
	</tr>
	<? if($queries < 0 || empty($queries)):?>
	<tr>
		<td align="center"><h6>No Result Found...</h6></td>
	</tr>
	<?else:?>
	<?foreach($queries as $q):?>
	<tr>
		<td align="center"><h6><?=substr($q->id,5,7)?></h6></td>
		<td align="center"><h6><?=$q->first_name?></h6></td>
		<td align="center"><h6><?=$q->last_name?></h6></td>
		<td align="center"><h6><?=$q->start_date?></h6></td>
		<td align="center"><h6><?=$q->num_of_days?></h6></td>
		<td align="center"><h6><?=$q->outstanding_balance?></h6></td>
		<td align="center">
		<h6>
		<?
			$date_hired=explode("-",$q->start_date);
			$year=date("Y", strtotime("- 1 year", mktime(0, 0, 0,$date_hired[0],$date_hired[1],date("Y"))));
			if(date("Y")==$date_hired[2]):
			echo date("m-d-Y", strtotime("+ 11 month", mktime(0, 0, 0,$date_hired[0],$date_hired[1],$date_hired[2])));
			elseif($year==$date_hired[2]):
			echo date("m-d-Y", strtotime("+ 11 month", mktime(0, 0, 0,$date_hired[0],$date_hired[1],$date_hired[2])));
			else:
			echo date("m-d-Y", strtotime("+ 11 month", mktime(0, 0, 0,$date_hired[0],$date_hired[1],date("Y"))));
			endif;
		?>
		</h6>
		</td>
	</tr>
	<?endforeach;?>
	<? endif;?>
</table>

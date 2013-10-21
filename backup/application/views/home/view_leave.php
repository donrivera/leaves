<br/><br/>
<?="<b>".count($queries)."&nbsp;Record/s Found</b>";?>
<table border="1">
	<tr>
		<td>Employee ID</td>
		<td>First Name</td>
		<td>Last Name</td>
		<td>Starting Date</td>
		<td>Annual Leave as per Contract</td>
		<td>Leave Balance can be used now</td>
		<td>30 days more will be add to your annual leave balance on</td>
	</tr>
	<? if($queries < 0 || empty($queries)):?>
	<tr>
		<td>No Result Found...</td>
	</tr>
	<?else:?>
	<?foreach($queries as $q):?>
	<tr>
		<td><?=$q->id?></td>
		<td><?=$q->first_name?></td>
		<td><?=$q->last_name?></td>
		<td align="center"><?=$q->start_date?></td>
		<td align="center"><?=$q->num_of_days?></td>
		<td align="center"><?=$q->outstanding_balance?></td>
		<td align="center">
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
		</td>
	</tr>
	<?endforeach;?>
	<? endif;?>
</table>

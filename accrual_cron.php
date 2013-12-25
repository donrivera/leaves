<?php
function updateBalance($emp_id,$days,$code)
{mysql_query("UPDATE leave_balance SET balance= balance + $days  WHERE employee_id='$emp_id' AND leave_code='$code'");}
function accrual_history($emp_id,$code)
{mysql_query("INSERT INTO accrual_history(employee_id,leave_code,date,year) VALUES('".$emp_id."','".$code."','".date('Y-m-d G:i:s')."','".date('Y')."')");}
function insertBalance($emp_id,$code,$balance)
{mysql_query("INSERT INTO leave_balance(employee_id,leave_code,balance) VALUES('".$emp_id."','".$code."','".$balance."')");}
mysql_connect('localhost','root','mamamia') or die('Cannot connect to database...');
mysql_select_db('leaves') or die('Cannot select database...');
$result = mysql_query("SELECT * FROM employees");
while($row = mysql_fetch_array($result))
{
	$emp_id=$row['id'];
	$start_date=$row['start_date'];
	$date_hired=explode("-",$start_date);
	$accrual=date("Y-m-d", strtotime("+ 11 month", mktime(0, 0, 0,$date_hired[1],$date_hired[2],$date_hired[0])));
	$date_now=date("Y-m-d");
	if($accrual==$date_now || $accrual<$date_now)
	{
		$sql=mysql_query("SELECT * FROM accrual_history WHERE employee_id='$emp_id' AND year='".date('Y')."'");
		$accrual=mysql_fetch_array($sql);
		if(empty($accrual))
		{
			
			$days=$row['num_of_days'];
			$leave=mysql_query("SELECT * FROM leave_balance WHERE employee_id='$emp_id'");
			$balance=mysql_fetch_array($leave);
			if(empty($balance))
			{
				/*get outstanding balance*/
				$vl_balance=$days + $row['vl_outstanding'];
				$sl_balance=$days + $row['sl_outstanding'];
				insertBalance($emp_id,'VL',$vl_balance);
				insertBalance($emp_id,'SL',$sl_balance);
				accrual_history($emp_id,'VL');
				accrual_history($emp_id,'SL');
				echo "Inserted Balances:&nbsp;".$emp_id."<BR/>";
			}
			else
			{
				updateBalance($emp_id,$days,'VL');
				updateBalance($emp_id,$days,'SL');
				accrual_history($emp_id,'VL');
				accrual_history($emp_id,'SL');
				echo "Updated Balances:&nbsp;".$emp_id."<BR/>";
			}
		}
		else{echo "Employee has a accrual...<BR/>";}
	}
	else
	{
		echo "Exit Accrual...<BR/>";
	}
}
?>
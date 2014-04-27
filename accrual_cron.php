<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'mamamia');
define('DB_DATABASE', 'leaves');
class Connection
{
	function Dbase()
	{
		mysql_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD) or die('Cannot connect to database...');
		mysql_select_db(DB_DATABASE) or die('Cannot select database...');
	}
	function updateBalance($emp_id,$days,$code)
	{
		switch($code)
		{
			case 'VL':	{mysql_query("UPDATE leave_balance SET balance= balance + $days  WHERE employee_id='$emp_id' AND leave_code='$code'");}break;
			case 'SL':	{mysql_query("UPDATE leave_balance SET balance= $days  WHERE employee_id='$emp_id' AND leave_code='$code'");}break;
			case 'UL':	{mysql_query("UPDATE leave_balance SET balance= $days  WHERE employee_id='$emp_id' AND leave_code='$code'");}break;
			default:	{echo "Leave Code Not in List....<BR/>";}break;
		}
	}
<<<<<<< HEAD
=======
	public function getConnection() 
	{return $this->mysql_connection;}
	function updateBalance($emp_id,$days,$code)
	{
		switch($code)
		{
			case 'VL':	{mysql_query("UPDATE leave_balance SET balance= balance + $days  WHERE employee_id='$emp_id' AND leave_code='$code'");}break;
			case 'SL':	{mysql_query("UPDATE leave_balance SET balance= $days  WHERE employee_id='$emp_id' AND leave_code='$code'");}break;
			case 'UL':	{mysql_query("UPDATE leave_balance SET balance= $days  WHERE employee_id='$emp_id' AND leave_code='$code'");}break;
			default:	{echo "Leave Code Not in List....<BR/>";}break;
		}
	}
>>>>>>> e00d9e619bd1f3e6c227608012e6f19434c19799
	function accrual_history($emp_id,$code,$forfeit="",$remarks="")
	{mysql_query("INSERT INTO accrual_history(employee_id,leave_code,forfeit,remarks,date,year) VALUES('".$emp_id."','".$code."','".$forfeit."','".$remarks."','".date('Y-m-d G:i:s')."','".date('Y')."')");}
	function insertBalance($emp_id,$code,$balance)
	{mysql_query("INSERT INTO leave_balance(employee_id,leave_code,balance) VALUES('".$emp_id."','".$code."','".$balance."')");}
	function getBalancePerCode($code)
<<<<<<< HEAD
	{
		$sql=mysql_query("SELECT days FROM leave_type WHERE code='".$code."'");
		while($row = mysql_fetch_array($sql))
		{$days=$row['days'];}
		return $days;
	}
	function getEmployeeBalance($emp_id,$code)
	{
=======
	{
		$sql=mysql_query("SELECT days FROM leave_type WHERE code='".$code."'");
		while($row = mysql_fetch_array($sql))
		{$days=$row['days'];}
		return $days;
	}
	function getEmployeeBalance($emp_id,$code)
	{
>>>>>>> e00d9e619bd1f3e6c227608012e6f19434c19799
		$current_balance=mysql_query("SELECT balance FROM leave_balance WHERE employee_id='".$emp_id."' AND leave_code='".$code."'");
		while($row=mysql_fetch_array($current_balance))
		{$balance=$row['balance'];}
		return $balance;
	}
	function getYearAccrual($date_hired)
	{
		$date_hired=explode("-",$date_hired);
		$year=date("Y", strtotime("- 1 year", mktime(0, 0, 0,$date_hired[2],$date_hired[1],date("Y"))));
		$prev_year=$year = date('Y')-1;
		if(date("Y")==$prev_year)
		{$accrual=date("Y-m-d", strtotime("+ 11 month", mktime(0, 0, 0,$date_hired[1],$date_hired[2],$date_hired[0])));}
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
				{$accrual=date("Y-m-d", strtotime("+ 11 month", mktime(0, 0, 0,$date_hired[1],$date_hired[2],$prev_year)));}
			}
		}
		return $accrual;
	}
}
<<<<<<< HEAD

Connection::Dbase();
=======
Connection::getInstance();
#mysql_connect('','','') or die('Cannot connect to database...');
#mysql_select_db('') or die('Cannot select database...');
>>>>>>> e00d9e619bd1f3e6c227608012e6f19434c19799
#$sl_accrual_days=20;
$result = mysql_query("SELECT * FROM employees");
while($row = mysql_fetch_array($result))
{
	$emp_id=$row['id'];
	$start_date=$row['start_date'];
	$date_hired=explode("-",$start_date);
	$accrual=Connection::getYearAccrual($start_date);#date("Y-m-d", strtotime("+ 11 month", mktime(0, 0, 0,$date_hired[1],$date_hired[2],$date_hired[0])));
	$date_now=date("Y-m-d");
	
	if($accrual==$date_now)
	{	
		$sql=mysql_query("SELECT * FROM accrual_history WHERE employee_id='$emp_id' AND year='".date('Y')."'");
		$accrual=mysql_fetch_array($sql);
		if(empty($accrual))
		{
			#$days=$row['num_of_days'];
			$vl_days=$row['num_of_days'];#Connection::getBalancePerCode('VL');
			$sl_days=Connection::getBalancePerCode('SL');
			$ul_days=Connection::getBalancePerCode('UL');
			$leave=mysql_query("SELECT * FROM leave_balance WHERE employee_id='$emp_id'");
			$balance=mysql_fetch_array($leave);
			if(empty($balance))
			{
				
				#get outstanding balance
				$vl_balance=$vl_days + $row['vl_outstanding'];
				#$sl_balance=$sl_accrual_days + $row['sl_outstanding'];
				Connection::insertBalance($emp_id,'VL',$vl_balance);
				Connection::accrual_history($emp_id,'VL',"",$vl_balance." Added VL Balance");
				
				#$sl_current_balance=mysql_query("SELECT balance FROM leave_balance WHERE employee_id='".$emp_id."' AND leave_code='SL'");
				#while($row_sl_current_balance=mysql_fetch_array($sl_current_balance))
				#{$print_sl_balance=$row_sl_current_balance['balance'];}
				
				$sl_balance=Connection::getEmployeeBalance($emp_id,'SL');
				$ul_balance=Connection::getEmployeeBalance($emp_id,'UL');
				Connection::accrual_history($emp_id,'SL',$sl_balance,"Forfeit SL Balance");
				Connection::insertBalance($emp_id,'SL',$sl_days);
				Connection::accrual_history($emp_id,'UL',$ul_balance,"Forfeit UL Balance");
				Connection::insertBalance($emp_id,'UL',$ul_days);
				echo "Inserted Balances:&nbsp;".substr($emp_id,5,8)."<BR/>";
				
			}
			else
			{	
				
				Connection::updateBalance($emp_id,$vl_days,'VL');
				Connection::accrual_history($emp_id,'VL',"",$vl_days." Added VL Balance");
				
				#$sl_current_balance=mysql_query("SELECT balance FROM leave_balance WHERE employee_id='".$emp_id."' AND leave_code='SL'");
				#while($row_sl_current_balance=mysql_fetch_array($sl_current_balance))
				#{$print_sl_balance=$row_sl_current_balance['balance'];}
				
				$sl_balance=Connection::getEmployeeBalance($emp_id,'SL');
				$ul_balance=Connection::getEmployeeBalance($emp_id,'UL');
				Connection::accrual_history($emp_id,'SL',$sl_balance,"Forfeit SL Balance");
				Connection::updateBalance($emp_id,$sl_days,'SL');
				Connection::accrual_history($emp_id,'UL',$ul_balance,"Forfeit UL Balance");
				Connection::updateBalance($emp_id,$ul_days,'UL');
				echo "Updated Balances:&nbsp;".substr($emp_id,5,8)."<BR/>";
				
			}
		}
		else{echo "Employee&nbsp;".substr($emp_id,5,8)."&nbsp;has an accrual for year&nbsp;".date('Y')."&nbsp;...<BR/>";}
		
	}
	else{echo "Exit Accrual...<BR/>";}
	
}
Connection::accrual_history("001",'CJ',0,"Batch Process");
?>
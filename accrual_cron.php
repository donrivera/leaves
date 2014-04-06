<?php
class Connection 
{
	private $mysql_connection = NULL;
	private static $connection = NULL;
	private $host="localhost";
	private $user="root";
	private $pass="mamamia";
	private $db="leaves";
	private function __construct() 
	{
		$this->mysql_connection = mysql_connect($this->host,$this->user,$this->pass)or die("Error in Connection: ".mysql_error());
		if($this->mysql_connection){mysql_select_db($this->db) or die("Cannot select database:".mysql_error());}
	}
	public static function getInstance() 
	{
		if(is_null(Connection::$connection)) 
		{
			Connection::$connection = new Connection();
		}
		return Connection::$connection;
	}
	public function getConnection() 
	{return $this->mysql_connection;}
}
Connection::getInstance();
#mysql_connect('localhost','root','mamamia') or die('Cannot connect to database...');
#mysql_select_db('leaves') or die('Cannot select database...');
function updateBalance($emp_id,$days,$code)
{
	switch($code)
	{
		case 'VL':	{mysql_query("UPDATE leave_balance SET balance= balance + $days  WHERE employee_id='$emp_id' AND leave_code='$code'");}break;
		case 'SL':	{mysql_query("UPDATE leave_balance SET balance= $days  WHERE employee_id='$emp_id' AND leave_code='$code'");}break;
		default:	{echo "Leave Code Not in List....<BR/>";}break;
	}
}
function accrual_history($emp_id,$code,$forfeit="",$remarks="")
{mysql_query("INSERT INTO accrual_history(employee_id,leave_code,forfeit,remarks,date,year) VALUES('".$emp_id."','".$code."','".$forfeit."','".$remarks."','".date('Y-m-d G:i:s')."','".date('Y')."')");}
function insertBalance($emp_id,$code,$balance)
{mysql_query("INSERT INTO leave_balance(employee_id,leave_code,balance) VALUES('".$emp_id."','".$code."','".$balance."')");}
$sl_accrual_days=20;
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
				#get outstanding balance
				$vl_balance=$days + $row['vl_outstanding'];
				$sl_balance=$sl_accrual_days + $row['sl_outstanding'];
				insertBalance($emp_id,'VL',$vl_balance);
				accrual_history($emp_id,'VL',"",$days." Added VL Balance");
				$sl_current_balance=mysql_query("SELECT balance FROM leave_balance WHERE employee_id='".$emp_id."' AND leave_code='SL'");
				while($row_sl_current_balance=mysql_fetch_array($sl_current_balance))
				{$print_sl_balance=$row_sl_current_balance['balance'];}
				accrual_history($emp_id,'SL',$print_sl_balance,"Forfeit SL Balance");
				insertBalance($emp_id,'SL',$sl_balance);
				echo "Inserted Balances:&nbsp;".substr($emp_id,5,7)."<BR/>";
			}
			else
			{
				updateBalance($emp_id,$days,'VL');
				accrual_history($emp_id,'VL',"",$days." Added VL Balance");
				$sl_current_balance=mysql_query("SELECT balance FROM leave_balance WHERE employee_id='".$emp_id."' AND leave_code='SL'");
				while($row_sl_current_balance=mysql_fetch_array($sl_current_balance))
				{$print_sl_balance=$row_sl_current_balance['balance'];}
				accrual_history($emp_id,'SL',$print_sl_balance,"Forfeit SL Balance");
				updateBalance($emp_id,$sl_accrual_days,'SL');
				echo "Updated Balances:&nbsp;".substr($emp_id,5,7)."<BR/>";
			}
		}
		else{echo "Employee&nbsp;".substr($emp_id,5,7)."&nbsp;has an accrual for year&nbsp;".date('Y')."&nbsp;...<BR/>";}
	}
	else
	{
		echo "Exit Accrual...<BR/>";
	}
}
?>
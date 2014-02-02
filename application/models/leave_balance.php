<?php
Class Leave_balance extends CI_Model
{
	function __construct()
	{
        parent::__construct();
    }
	function viewBalance($id,$code)
	{
		$sql="SELECT balance FROM leave_balance WHERE employee_id='$id' AND leave_code='$code'";
		$query=$this->db->query($sql);
		return $query;
	}
	function updateBalance($id,$balance,$code)
	{
		/*
		extract($data);
		$dataArr = array(
							//'employee_id'			=> $employee_id,
							'first_name'      	 	=> $first_name,
							'last_name'      	 	=> $last_name,
							'start_date'     		=> $start_date,
							'num_of_days'          	=> $num_of_days,
							'outstanding_balance'   => $outstanding_balance
						);
		*/				
		return $this->db->update('leave_balance',array('balance'=>$balance),array('employee_id' => $id,'leave_code'=>$code));
		
	}	
	function add($data = array())
	{
		extract($data);
		$dataArr = array(
							'employee_id'		=> $employee_id,
							'leave_code'      	=> $leave_code,
							'balance'			=> $balance
						);
		return $this->db->insert('leave_balance',$dataArr);
	}
	
}
?>
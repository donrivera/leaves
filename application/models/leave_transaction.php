<?php
Class Leave_transaction extends CI_Model
{
	function __construct()
	{
        parent::__construct();
    }
	function view()
	{
		$sql="	SELECT e.id,e.first_name,e.last_name,t.start,t.end,t.no_days,lc.desc as leave_desc,pt.desc as pay_desc,t.id as trans_id
				FROM leave_transaction t 
				INNER JOIN employees e ON e.id=t.employee_id 
				INNER JOIN leave_type lc ON lc.code=t.leave_type
				INNER JOIN pay_type pt ON pt.code=t.pay_type
				WHERE t.status='active' ORDER BY t.start DESC";
		$query=$this->db->query($sql);
		return $query;
	}
	function add($data = array())
	{
		extract($data);
		$dataArr = array(
							'employee_id'		=> $employee_id,
							'leave_type'      	=> $leave_type,
							'pay_type'      	=> $pay_type,
							'no_days'     		=> $no_days,
							'start'          	=> $start,
							'end'          	    => $end,
							'vl'          	    => $vl,
							'sl'          	    => $sl,
							'ul'          	    => $ul,
							'status'			=> 'active',
							'date'				=> date('Y-m-d G:i:s')
						);
		return $this->db->insert('leave_transaction',$dataArr);
	}
	function getById($id)
	{
		$sql="SELECT * FROM leave_transaction WHERE id='$id'";
		$query=$this->db->query($sql);
		return $query;
	}
	function update($data=array(),$id)
	{
		extract($data);
		$dataArr = array(
							'employee_id'		=> $employee_id,
							'leave_type'      	=> $leave_type,
							'pay_type'      	=> $pay_type,
							'no_days'     		=> $no_days,
							'start'          	=> $start,
							'end'          	    => $end,
							'vl'          	    => $vl,
							'sl'          	    => $sl,
							'ul'          	    => $ul,
							'status'			=> 'active',
							'date'				=> date('Y-m-d G:i:s')
						);
		return $this->db->update('leave_transaction', $dataArr, array('id' => $id));
	}
	function cancelById($id)
	{	$dataArr = array('status'=>'cancelled');
		return $this->db->update('leave_transaction', $dataArr, array('id' => $id));
	}
	function search($option,$key)
	{	
		
		switch($option)
		{
			case 'name':	{$sql=" SELECT e.id,e.first_name,e.last_name,t.start,t.end,t.no_days,lc.desc as leave_desc,pt.desc as pay_desc,t.id as trans_id
									FROM leave_transaction t 
									INNER JOIN employees e ON e.id=t.employee_id 
									INNER JOIN leave_type lc ON lc.code=t.leave_type
									INNER JOIN pay_type pt ON pt.code=t.pay_type
									WHERE t.status='active' AND (LOWER(e.first_name) LIKE '%$key%' OR LOWER(e.last_name) LIKE '%$key%')";
							}break;
			case 'id':		{$sql=" SELECT e.id,e.first_name,e.last_name,t.start,t.end,t.no_days,lc.desc as leave_desc,pt.desc as pay_desc,t.id as trans_id
									FROM leave_transaction t 
									INNER JOIN employees e ON e.id=t.employee_id 
									INNER JOIN leave_type lc ON lc.code=t.leave_type
									INNER JOIN pay_type pt ON pt.code=t.pay_type
									WHERE t.status='active' AND e.id LIKE '%$key%'";
							}break;
			default:		{$sql=" SELECT e.id,e.first_name,e.last_name,t.start,t.end,t.no_days,lc.desc as leave_desc,pt.desc as pay_desc,t.id as trans_id
									FROM leave_transaction t 
									INNER JOIN employees e ON e.id=t.employee_id 
									INNER JOIN leave_type lc ON lc.code=t.leave_type
									INNER JOIN pay_type pt ON pt.code=t.pay_type
									WHERE t.status='active' AND (e.id LIKE '%$key%' OR e.first_name LIKE '%$key%' OR e.last_name LIKE '%$key%')";
							}break;
		}
		$query=$this->db->query($sql);
		return $query;
		
	}
	function duplicate($emp_id,$start,$end)
	{
		$sql="SELECT * FROM leave_transaction WHERE employee_id='$emp_id' AND (('".$start."' BETWEEN start AND end) OR ('".$end."' BETWEEN start AND end)) ";
		$query=$this->db->query($sql);
		return $query;
	}
}
?>
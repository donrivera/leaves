<?php
Class Leave_transaction extends CI_Model
{
	function __construct()
	{
        parent::__construct();
    }
	function view()
	{
		$sql="	SELECT e.id,e.first_name,e.last_name,t.start,t.end,t.no_days,lc.desc as leave_desc,pt.desc as pay_desc 
				FROM leave_transaction t 
				INNER JOIN employees e ON e.id=t.employee_id 
				INNER JOIN leave_type lc ON lc.code=t.leave_type
				INNER JOIN pay_type pt ON pt.code=t.pay_type
				LIMIT 0,10";
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
							'date'				=> date('Y-m-d G:i:s')
						);
		return $this->db->insert('leave_transaction',$dataArr);
	}
}
?>
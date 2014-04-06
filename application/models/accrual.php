<?php
Class Accrual extends CI_Model
{
	function __construct()
	{
        parent::__construct();
    }
	function view()
	{
		$sql="	SELECT e.id,e.first_name,e.last_name,lc.desc,a.forfeit,e.num_of_days,a.remarks,a.year
				FROM employees e
				INNER JOIN accrual_history a ON a.employee_id=e.id
				INNER JOIN leave_type lc ON lc.code=a.leave_code";
		$query=$this->db->query($sql);
		return $query;
	}
	
}
?>
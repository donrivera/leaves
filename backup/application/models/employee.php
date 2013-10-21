<?php
Class Employee extends CI_Model
{
	function __construct()
	{
        parent::__construct();
    }
	function addEmp($data = array())
	{
		extract($data);
		$dataArr = array(
							//'employee_id'			=> $employee_id,
							'first_name'      	 	=> $first_name,
							'last_name'      	 	=> $last_name,
							'start_date'     		=> $start_date,
							'num_of_days'          	=> $num_of_days,
							'outstanding_balance'   => $outstanding_balance
						);
						
		return $this->db->insert('employees',$dataArr);
	}
	function viewEmp()
	{
		$sql="SELECT * FROM employees";
		$query=$this->db->query($sql);
		return $query;
	}
	function getEmp($name)
	{
		$sql="SELECT * FROM employees WHERE first_name='$name'";
		$query=$this->db->query($sql);
		return $query;
	}
	function getEmpId($id)
	{
		$sql="SELECT * FROM employees WHERE id='$id'";
		$query=$this->db->query($sql);
		return $query;
	}
	function updateEmp($data=array(),$id)
	{
		extract($data);
		$dataArr = array(
							//'employee_id'			=> $employee_id,
							'first_name'      	 	=> $first_name,
							'last_name'      	 	=> $last_name,
							'start_date'     		=> $start_date,
							'num_of_days'          	=> $num_of_days,
							'outstanding_balance'   => $outstanding_balance
						);
						
		return $this->db->update('employees', $dataArr, array('id' => $id));
	}
	function deleteEmpLeave($id)
	{
		$this->db->delete('employees', array('id' => $id)); 
	}
}
?>

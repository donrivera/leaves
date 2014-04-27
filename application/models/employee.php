<?php
Class Employee extends CI_Model
{	private $date_added;
	function __construct()
	{
        parent::__construct();
		$this->date_added=date("Y-m-d H:i:s");
    }
	function addEmp($data = array())
	{
		extract($data);
		$dataArr = array(
							//'employee_id'	   => $employee_id,
							'first_name'       => $first_name,
							'last_name'        => $last_name,
							'start_date'       => $start_date,
							'num_of_days'      => $num_of_days,
							'vl_outstanding'   => $vl_outstanding,
							'sl_outstanding'   => $sl_outstanding,
							'ul_outstanding'   => $ul_outstanding,
							'date_added'	   => $this->date_added
						);
						
		$this->db->insert('employees',$dataArr);
		return $this->db->insert_id();
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
	function getIdByFname($name)
	{
		$sql="SELECT id FROM employees WHERE first_name='$name'";
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
							'vl_outstanding'   		=> $vl_outstanding,
							'sl_outstanding'   		=> $sl_outstanding,
							'ul_outstanding'   		=> $ul_outstanding
						);
						
		return $this->db->update('employees', $dataArr, array('id' => $id));
	}
	function search($option,$key)
	{	
		switch($option)
		{
			case 'name':	{$sql="SELECT * FROM employees WHERE LOWER(first_name) LIKE '%$key%' OR LOWER(last_name) LIKE '%$key%'";}break;
			case 'id':		{$sql="SELECT * FROM employees WHERE id LIKE '%$key%'";}break;
			default:		{$sql="SELECT * FROM employees WHERE id LIKE '%$key%' OR first_name LIKE '%$key%' OR last_name LIKE '%$key%'";}break;
		}
		$query=$this->db->query($sql);
		return $query;
		
	}
	function deleteEmpLeave($id)
	{
		$this->db->delete('employees', array('id' => $id)); 
	}
}
?>

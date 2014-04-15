<?php
Class Leave_type extends CI_Model
{
	function __construct()
	{
        parent::__construct();
    }
	function view()
	{
		$sql="SELECT * FROM leave_type";
		$query=$this->db->query($sql);
		return $query;
	}
	function add($data = array())
	{
		extract($data);
		$dataArr = array(
							'code'	=> $code,
							'desc'  => $desc,
							'days'  => $days,
							
						);
		return $this->db->insert('leave_type',$dataArr);
	}
	function getById($id)
	{
		$sql="SELECT * FROM leave_type WHERE id='$id'";
		$query=$this->db->query($sql);
		return $query;
	}
	function update($data=array(),$id)
	{
		extract($data);
		$dataArr = array(
							'code'	=> $code,
							'desc'  => $desc,
							'days'  => $days,
							
						);
		return $this->db->update('leave_type', $dataArr, array('id' => $id));
	}
	function delete($id)
	{
		$this->db->delete('leave_type', array('id' => $id)); 
	}
	function getDays($code)
	{
		$sql="SELECT days FROM leave_type WHERE id='$code'";
		$query=$this->db->query($sql);
		return $query;
	}
}
?>
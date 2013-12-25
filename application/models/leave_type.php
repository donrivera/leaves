<?php
Class Leave_type extends CI_Model
{
	function __construct()
	{
        parent::__construct();
    }
	function view()
	{
		$sql="SELECT * FROM leave_type LIMIT 0,10";
		$query=$this->db->query($sql);
		return $query;
	}
}
?>
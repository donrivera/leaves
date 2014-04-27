<?php
Class User extends CI_Model
{
	function login($username, $password)
	{
		$this -> db -> select('id, username,name, password,type');
		$this -> db -> from('users');
		$this -> db -> where('username', $username);
		$this -> db -> where('password', MD5($password));
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1){return $query->result();}
		else{return false;}
	}
	function addData($data = array())
	{
		extract($data);
		$dataArr = array('opportunity_img'=> $opportunity_img);
		return $this->insert_data($dataArr);
	}
	function getById($id)
	{
		$sql="SELECT * FROM users WHERE id='$id'";
		$query=$this->db->query($sql);
		return $query;
	}
	function validateById($id, $password)
	{
		$this -> db -> select('id, username,name, password,type');
		$this -> db -> from('users');
		$this -> db -> where('id', $id);
		$this -> db -> where('password', MD5($password));
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1){return $query->result();}
		else{return false;}
	}
	function update($data=array(),$id)
	{
		extract($data);
		$dataArr = array(
							'name'  	=> $name,
							'username'  => $username,
							'password'	=> md5($password)
						);
		return $this->db->update('users', $dataArr, array('id' => $id));
	}
}
?>

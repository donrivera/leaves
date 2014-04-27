<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Setting extends CI_Controller 
{
	function __construct()
    {
        parent::__construct();
        $this->load->library('template');
<<<<<<< HEAD
		$this->load->model('user','',TRUE);
=======
		//$this->load->model('user','',TRUE);
>>>>>>> e00d9e619bd1f3e6c227608012e6f19434c19799
		$this->load->model('leave_type','',TRUE);
	}
	function index()
	{}
	function leave()
	{
		$query=$this->leave_type->view()->result();
		$data=array('title'=>'Leave Settings','queries'=>$query,);
		$this->template->load('hr', '/setting/view_leave_type', $data);
	}
	function addLeave()
	{
		$data = array('title' => 'Add Leave Type',);
		$this->template->load('hr', '/setting/add_leave_type', $data);
	}
	function insertLeave()
	{
		$code=$this->input->post('code');
		$desc=$this->input->post('desc');
		$days=$this->input->post('days');
		if(empty($code) || empty($desc))
		{
			$this->session->set_flashdata( 'message', 'Please Complete Fields...' );
			redirect('setting/addLeave', 'refresh');
		}
		$dtl = array(
						'code'  => $code,
						'desc'  => $desc,
						'days'	=> $days
					);
		$id=$this->leave_type->add($dtl);
		redirect('setting/leave', 'refresh');
	}
	function editLeave()
	{
		$id=$this->uri->segment(3);
		$query=$this->leave_type->getById($id)->result();
		$data=array('title'=>'Edit Leave Type','queries'=>$query,);
		$this->template->load('hr', '/setting/edit_leave_type', $data);
	}
	function updateLeave()
	{
		$id=$this->input->post('id');
		$code=$this->input->post('code');
		$desc=$this->input->post('desc');
		$days=$this->input->post('days');
		if(empty($code) || empty($desc))
		{
			$this->session->set_flashdata( 'message', 'Please Complete Fields...' );
			redirect('setting/addLeave', 'refresh');
		}
		$dtl = array(
						'code'  => $code,
						'desc'  => $desc,
						'days'	=> $days
					);
		$this->leave_type->update($dtl,$id);
		redirect('setting/leave', 'refresh');
	}
	function deleteLeave()
	{
		$id=$this->uri->segment(3);
		$this->leave_type->delete($id);
		redirect('setting/leave', 'refresh');
	}
<<<<<<< HEAD
	function account()
	{
		$data=array('title'=>'Account','queries'=>$query="",);
		$this->template->load('hr', '/setting/account', $data);
	}
	function editAccount()
	{
		$session=$this->session->userdata('logged_in');
		$id=$session['id'];
		$query=$this->user->getById($id)->result();
		$data=array('title'=>'Edit Account','queries'=>$query,);
		$this->template->load('hr', '/setting/edit_account', $data);
	}
	function updateAccount()
	{
		#echo var_dump($this->input->post());
		$id=$this->input->post('id');
		$name=$this->input->post('name');
		$user=$this->input->post('username');
		$pass=$this->input->post('old_password');
		$new_pass=$this->input->post('password');
		$conf_pass=$this->input->post('confirm_password');
		$result = $this->user->validateById($id,$pass);
		if($result)
		{
			$n=strcmp($new_pass,$conf_pass);
			if($n < 0)
			{$this->session->set_flashdata( 'message', 'New and Confirm Password Did Not Match.' );redirect('setting/editAccount', 'refresh');}
			else
			{
				$dtl = array(
						'name'  	=> $name,
						'username'  => $user,
						'password'	=> $new_pass
					);
				$this->user->update($dtl,$id);
				$this->session->set_flashdata( 'message', 'Password Successfully Changed .' );redirect('setting/editAccount', 'refresh');
			}
			
		}
		else
		{$this->session->set_flashdata( 'message', 'Password Did Not Match.' );redirect('setting/editAccount', 'refresh');}
	}
=======
>>>>>>> e00d9e619bd1f3e6c227608012e6f19434c19799
}
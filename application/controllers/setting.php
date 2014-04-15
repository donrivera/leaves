<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Setting extends CI_Controller 
{
	function __construct()
    {
        parent::__construct();
        $this->load->library('template');
		//$this->load->model('user','',TRUE);
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
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Hr extends CI_Controller 
{
	function __construct()
    {
        parent::__construct();
        $this->load->library('template');
		//$this->load->model('user','',TRUE);
		$this->load->model('employee','',TRUE);
	}
	function index()
	{
		$data = array('title' => 'Dashboard',);
		$this->template->load('hr', '/hr/dashboard', $data);
	}
	function addEmp()
	{
		//echo var_dump($this->input->post());
		$dtl = array(
						//'employee_id'			=> $this->input->post('emp_id'),
               			'first_name'      	 	=> $this->input->post('f_name'),
						'last_name'      	 	=> $this->input->post('l_name'),
               			'start_date'     		=> $this->input->post('start_date'),
               			'num_of_days'          	=> $this->input->post('num_days'),
               			'vl_outstanding'        => $this->input->post('vl_outstanding'),
						'sl_outstanding'        => $this->input->post('sl_outstanding')
            		);
		$this->employee->addEmp($dtl);
		redirect('hr/viewEmp', 'refresh');
	}
	function viewEmp()
	{
		$query=$this->employee->viewEmp()->result();
		$data=array('title'=>'Employees','queries'=>$query,);
		$this->template->load('hr', '/hr/view_employee', $data);
	}
	function editEmpLeave()
	{
		$id=$this->uri->segment(3);
		$query=$this->employee->getEmpId($id)->result();
		$data=array('title'=>'Edit Employee','queries'=>$query,);
		$this->template->load('hr', '/hr/edit_employee', $data);
	}
	function updateEmpLeave()
	{
		//echo var_dump($this->input->post());
		$id=$this->input->post('id');
		$dtl = array(
						//'employee_id'					=> $this->input->post('emp_id'),
               			'first_name'      	 			=> $this->input->post('f_name'),
						'last_name'      	 			=> $this->input->post('l_name'),
               			'start_date'     				=> $this->input->post('start_date'),
               			'num_of_days'          			=> $this->input->post('num_days'),
               			//'outstanding_balance'           => $this->input->post('outstanding_balance')
            		);
		$this->employee->updateEmp($dtl,$id);
		redirect('hr/viewEmp', 'refresh');
		
	}
	function deleteEmpLeave()
	{
		$id=$this->uri->segment(3);
		$this->employee->deleteEmpLeave($id);
		redirect('hr/viewEmp', 'refresh');
	}
	function logout()
	{
		
		$this->session->unset_userdata('logged_in');
		//session_destroy();
		redirect('home', 'refresh');
	}
}
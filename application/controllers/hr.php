<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Hr extends CI_Controller 
{
	function __construct()
    {
        parent::__construct();
        $this->load->library('template');
		//$this->load->model('user','',TRUE);
		$this->load->model('employee','',TRUE);
		$this->load->model('leave_balance','',TRUE);
	}
	function index()
	{
		$data = array('title' => 'Dashboard',);
		$this->template->load('hr', '/hr/dashboard', $data);
	}
	function addEmp()
	{
		//echo var_dump($this->input->post());
		$vl_bal=$this->input->post('vl_outstanding');
		$sl_bal=$this->input->post('sl_outstanding');
		$ul_bal=$this->input->post('ul_outstanding');
		$fname=$this->input->post('f_name');
		$lname=$this->input->post('l_name');
		$employment=$this->input->post('start_date');
		if(empty($fname) || empty($lname) || empty($employment))
		{
			$this->session->set_flashdata( 'message', 'Please Complete Fields...' );
			redirect('hr', 'refresh');
		}
		else
		{
			$dtl = array(
							//'employee_id'			=> $this->input->post('emp_id'),
							'first_name'      	 	=> $this->input->post('f_name'),
							'last_name'      	 	=> $this->input->post('l_name'),
							'start_date'     		=> $this->input->post('start_date'),
							'num_of_days'          	=> $this->input->post('num_days'),
							'vl_outstanding'        => $vl_bal,
							'sl_outstanding'        => $sl_bal,
							'ul_outstanding'        => $ul_bal
						);
			$id=$this->employee->addEmp($dtl);
			$vl=array("employee_id"=>$id,"leave_code"=>'VL',"balance"=>$vl_bal);
			$sl=array("employee_id"=>$id,"leave_code"=>'SL',"balance"=>$sl_bal);
			$ul=array("employee_id"=>$id,"leave_code"=>'UL',"balance"=>$ul_bal);
			$this->leave_balance->add($vl);
			$this->leave_balance->add($sl);
			$this->leave_balance->add($ul);
			redirect('hr/viewEmp', 'refresh');
		}
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
		#echo var_dump($this->input->post());
		$vl_bal=$this->input->post('vl_outstanding');
		$sl_bal=$this->input->post('sl_outstanding');
		$ul_bal=$this->input->post('ul_outstanding');
		$id=$this->input->post('id');
		$dtl = array(
						//'employee_id'			=> $this->input->post('emp_id'),
               			'first_name'      	 	=> $this->input->post('f_name'),
						'last_name'      	 	=> $this->input->post('l_name'),
               			'start_date'     		=> $this->input->post('start_date'),
               			'num_of_days'          	=> $this->input->post('num_days'),
               			'vl_outstanding'        => $vl_bal,
						'sl_outstanding'        => $sl_bal,
						'ul_outstanding'        => $ul_bal
            		);
		$this->employee->updateEmp($dtl,$id);
		$this->leave_balance->updateBalance($id,$vl_bal,'VL');
		$this->leave_balance->updateBalance($id,$sl_bal,'SL');
		$check_ul=$this->leave_balance->viewBalance($id,'UL')->row();
		if(empty($check_ul->balance) || $check_ul->balance==NULL)
		{$this->leave_balance->add(array("employee_id"=>$id,"leave_code"=>'UL',"balance"=>$ul_bal));}
		else{$this->leave_balance->updateBalance($id,$ul_bal,'UL');}
		redirect('hr/viewEmp', 'refresh');
	}
	function deleteEmpLeave()
	{
		$id=$this->uri->segment(3);
		$this->employee->deleteEmpLeave($id);
		redirect('hr/viewEmp', 'refresh');
	}
	function search()
	{
		$option=$this->input->post('search');
		$key=$this->input->post('key');
		$query=$this->employee->search($option,$key)->result();
<<<<<<< HEAD
		$data=array('title'=>'Employees','queries'=>$query,'opt'=>$option,'key'=>$key);
=======
		$data=array('title'=>'Employees','queries'=>$query,);
>>>>>>> e00d9e619bd1f3e6c227608012e6f19434c19799
		$this->template->load('hr', '/hr/search', $data);
	}
	function printExcel()
	{	
<<<<<<< HEAD
		$opt=$this->uri->segment(3);
		$key=$this->uri->segment(4);
		if(!empty($opt)||!empty($key))
		{$query=$this->employee->search($opt,$key)->result();}
		else{$query=$this->employee->viewEmp()->result();}
=======
		$q=$this->session->userdata('query');
		$query=$this->db->query($q)->result();
>>>>>>> e00d9e619bd1f3e6c227608012e6f19434c19799
		$data=array('title'=>'Employees','queries'=>$query,);
		$this->template->load('plain', '/hr/excel', $data);
	}
	function logout()
	{
		
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('query');
		//session_destroy();
		redirect('home', 'refresh');
	}
}
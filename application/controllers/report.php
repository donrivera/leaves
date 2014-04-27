<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Report extends CI_Controller 
{
	function __construct()
    {
        parent::__construct();
        $this->load->library('template');
		$this->load->model('leave_transaction','',TRUE);
		$this->load->model('accrual','',TRUE);
	}
	function index()
	{	
		$query=$this->leave_transaction->view()->result();
		$data=array('title'=>'Reports','queries'=>$query);
		$this->template->load('hr', '/report/home', $data);
	}
	function accrual()
	{
		$query=$this->accrual->view()->result();
		$data=array('title'=>'Reports','queries'=>$query);
		$this->template->load('hr', '/report/accrual', $data);
	}
	function search()
	{
		$option=$this->input->post('search');
		$key=$this->input->post('key');
		$query=$this->leave_transaction->search($option,$key)->result();
<<<<<<< HEAD
		$data=array('title'=>'Reports','queries'=>$query,'opt'=>$option,'key'=>$key);
=======
		$data=array('title'=>'Reports','queries'=>$query,);
>>>>>>> e00d9e619bd1f3e6c227608012e6f19434c19799
		$this->template->load('hr', '/report/search', $data);
	}
	function printExcel()
	{	
<<<<<<< HEAD
		$opt=$this->uri->segment(3);
		$key=$this->uri->segment(4);
		if(!empty($opt)||!empty($key))
		{$query=$this->leave_transaction->search($opt,$key)->result();}
		else{$query=$this->leave_transaction->view()->result();}
=======
		$q=$this->session->userdata('query');
		$query=$this->db->query($q)->result();
>>>>>>> e00d9e619bd1f3e6c227608012e6f19434c19799
		$data=array('title'=>'Employees','queries'=>$query,);
		$this->template->load('plain', '/report/excel', $data);
	}
}
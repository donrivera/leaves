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
		$data=array('title'=>'Reports','queries'=>$query,);
		$this->template->load('hr', '/report/search', $data);
	}
	function printExcel()
	{	
		$q=$this->session->userdata('query');
		$query=$this->db->query($q)->result();
		$data=array('title'=>'Employees','queries'=>$query,);
		$this->template->load('plain', '/report/excel', $data);
	}
}
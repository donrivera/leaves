<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Report extends CI_Controller 
{
	function __construct()
    {
        parent::__construct();
        $this->load->library('template');
		$this->load->model('leave_transaction','',TRUE);
	}
	function index()
	{	
		$query=$this->leave_transaction->view()->result();
		$data=array('title'=>'Reports','queries'=>$query);
		$this->template->load('hr', '/report/home', $data);
	}
	
	
}
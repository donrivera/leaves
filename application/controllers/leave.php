<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Leave extends CI_Controller 
{
	function __construct()
    {
        parent::__construct();
        $this->load->library('template');
		$this->load->model('employee','',TRUE);
		$this->load->model('leave_type','',TRUE);
		$this->load->model('pay_type','',TRUE);
		$this->load->model('leave_balance','',TRUE);
		$this->load->model('leave_transaction','',TRUE);
		
	}
	function index()
	{	$queries=$this->employee->viewEmp()->result();
		$leave_type=$this->leave_type->view()->result();
		$pay_type=$this->pay_type->view()->result();
		$data=array('title'=>'Reports','queries'=>$queries,'leave_types'=>$leave_type,'pay_types'=>$pay_type);
		$this->template->load('hr', '/leave/home', $data);
	}
	function add()
	{
		echo var_dump($this->input->post());
		$id=$this->input->post('emp_id');
		$leave_type=$this->input->post('leave_type');
		$days=$this->input->post('no_days');
		
		switch($leave_type)
		{
			case 'VL':		{
								$vl_sql=$this->leave_balance->viewBalance($id,$leave_type)->row();
								$sl_sql=$this->leave_balance->viewBalance($id,'SL')->row();
								$vl=$vl_sql->balance - $days;
								$this->leave_balance->updateBalance($id,$vl,$leave_type);
								$sl=$sl_sql->balance;
							}break;
			case 'SL':		{
								$sl_sql=$this->leave_balance->viewBalance($id,$leave_type)->row();
								$vl_sql=$this->leave_balance->viewBalance($id,'VL')->row();
								$sl=$sl_sql->balance - $days;
								$this->leave_balance->updateBalance($id,$sl,$leave_type);
								$vl=$vl_sql->balance;
							}break;
			default:		{echo "Select Leave Type...";}break;
		}
		
		$dtl = array(
						'employee_id'	=> $id,
               			'leave_type'    => $leave_type,
						'start'    		=> $this->input->post('start_date'),
               			'end'     		=> $this->input->post('end_date'),
               			'no_days'       => $this->input->post('no_days'),
               			'pay_type'		=> $this->input->post('pay_type'),
						'vl'			=> $vl,
						'sl'		    => $sl
            		);
		$this->leave_transaction->add($dtl);
		redirect('leave', 'refresh');
		
	}
}
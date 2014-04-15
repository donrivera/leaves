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
		$data=array('title'=>'Leave Transactions','queries'=>$queries,'leave_types'=>$leave_type,'pay_types'=>$pay_type);
		$this->template->load('hr', '/leave/home', $data);
	}
	function view()
	{
		$query=$this->leave_transaction->view()->result();
		$data=array('title'=>'Reports','queries'=>$query);
		$this->template->load('hr', '/leave/view', $data);
	}
	function add()
	{
		#echo var_dump($this->input->post());
		$id=$this->input->post('emp_id');
		$leave_type=$this->input->post('leave_type');
		$start=$this->input->post('start_date');
		$end=$this->input->post('end_date');
		$days=$this->input->post('no_days');
		if(empty($leave_type) || empty($days))
		{
			$this->session->set_flashdata( 'message', 'Please Complete Fields...' );
			redirect('leave', 'refresh');
		}
		$duplicate=$this->leave_transaction->duplicate($id,$start,$end)->num_rows();
		
		if($duplicate > 0)
		{
			$this->session->set_flashdata( 'message', 'Duplicate Leave Transaction...');
			redirect('leave', 'refresh');
		}
		else
		{
			switch($leave_type)
			{
				case 'VL':	{
								$vl_sql=$this->leave_balance->viewBalance($id,$leave_type)->row();
								$sl_sql=$this->leave_balance->viewBalance($id,'SL')->row();
								$ul_sql=$this->leave_balance->viewBalance($id,'UL')->row();
								$vl=$vl_sql->balance - $days;
								if($vl<0)
								{
									$this->session->set_flashdata( 'message', 'Employee Does Not Have Enough VL Balance...' );
									redirect('leave', 'refresh');
								}
								$this->leave_balance->updateBalance($id,$vl,$leave_type);
								$sl=$sl_sql->balance;
								$ul=(empty($ul_sql->balance)?0:$ul_sql->balance);
							}break;
				case 'SL':	{
								$sl_sql=$this->leave_balance->viewBalance($id,$leave_type)->row();
								$vl_sql=$this->leave_balance->viewBalance($id,'VL')->row();
								$ul_sql=$this->leave_balance->viewBalance($id,'UL')->row();
								$sl=$sl_sql->balance - $days;
								if($sl<0)
								{
									$this->session->set_flashdata( 'message', 'Employee Does Not Have Enough SL Balance...' );
									redirect('leave', 'refresh');
								}
								$this->leave_balance->updateBalance($id,$sl,$leave_type);
								$vl=$vl_sql->balance;
								$ul=(empty($ul_sql->balance)?0:$ul_sql->balance);
							}break;
				case 'UL':	{
								$ul_sql=$this->leave_balance->viewBalance($id,$leave_type)->row();
								$ul=$ul_sql->balance + $days;
								$sl_sql=$this->leave_balance->viewBalance($id,'SL')->row();
								$sl=$sl_sql->balance;
								$vl_sql=$this->leave_balance->viewBalance($id,'VL')->row();
								$vl=$vl_sql->balance;
								$this->leave_balance->updateBalance($id,$ul,$leave_type);
							}break;
				default:	{echo "Select Leave Type...";}break;
			}
			$dtl = array(
							'employee_id'	=> $id,
							'leave_type'    => $leave_type,
							'start'    		=> $start,
							'end'     		=> $end,
							'no_days'       => $this->input->post('no_days'),
							'pay_type'		=> $this->input->post('pay_type'),
							'vl'			=> $vl,
							'sl'		    => $sl,
							'ul'			=> $ul
						);
			$this->leave_transaction->add($dtl);
			$this->session->set_flashdata( 'message', 'Processed Employee Leave/s...' );
			redirect('leave/view', 'refresh');
		}
	}
	function edit()
	{
		$id=$this->uri->segment(3);
		$query=$this->leave_transaction->getById($id)->result();
		$emp=$this->employee->viewEmp()->result();
		$leave_type=$this->leave_type->view()->result();
		$pay_type=$this->pay_type->view()->result();
		$data=array('title'=>'Edit','queries'=>$query,'leave_types'=>$leave_type,'pay_types'=>$pay_type,'emps'=>$emp);
		$this->template->load('hr', '/leave/edit', $data);
		
	}
	function update()
	{	
		$id=$this->input->post('trans_id');
		$emp_id=$this->input->post('emp_id');
		$leave_type=$this->input->post('leave_type');
		$days=$this->input->post('no_days');
		$query=$this->leave_transaction->getById($id)->result();
		foreach($query as $q):
			$current_days=(int)$q->no_days;
		endforeach;
		if(empty($leave_type) || empty($days))
		{
			
			$this->session->set_flashdata( 'message', 'Please Complete Fields...' );
			redirect('leave/edit/'.$id, 'refresh');
		}
		
		switch($leave_type)
		{
			case 'VL':		{
								$vl_sql=$this->leave_balance->viewBalance($emp_id,$leave_type)->row();
								$sl_sql=$this->leave_balance->viewBalance($emp_id,'SL')->row();
								$ul_sql=$this->leave_balance->viewBalance($emp_id,'UL')->row();
								if($current_days > $days)
								{
									$update_days=$current_days - $days;
									$vl=$vl_sql->balance + $update_days;
									
								}
								else
								{
									$update_days=$days - $current_days;
									$vl=$vl_sql->balance - $update_days;
									
								}
								#if($vl<0)
								#{
								#	$this->session->set_flashdata( 'message', 'Employee Does not have enough VL Balance...' );
								#	redirect('leave', 'refresh');
								#}
								$this->leave_balance->updateBalance($emp_id,$vl,$leave_type);
								$sl=$sl_sql->balance;
								$ul=$ul_sql->balance;
							}break;
			case 'SL':		{
								$sl_sql=$this->leave_balance->viewBalance($emp_id,$leave_type)->row();
								$vl_sql=$this->leave_balance->viewBalance($emp_id,'VL')->row();
								$ul_sql=$this->leave_balance->viewBalance($emp_id,'UL')->row();
								if($current_days > $days)
								{
									$update_days=$current_days - $days;
									$sl=$sl_sql->balance + $update_days;
									
								}
								else
								{
									$update_days=$days - $current_days;
									$sl=$sl_sql->balance - $update_days;
									
								}
								#if($sl<0)
								#{
								#	$this->session->set_flashdata( 'message', 'Employee Does not have enough SL Balance...' );
								#	redirect('leave', 'refresh');
								#}
								$this->leave_balance->updateBalance($emp_id,$sl,$leave_type);
								$vl=$vl_sql->balance;
								$ul=$ul_sql->balance;
							}break;
			case 'UL':		{
								$ul_sql=$this->leave_balance->viewBalance($emp_id,$leave_type)->row();
								$sl_sql=$this->leave_balance->viewBalance($emp_id,'SL')->row();
								$vl_sql=$this->leave_balance->viewBalance($emp_id,'VL')->row();
								if($current_days > $days)
								{
									$update_days=$current_days - $days;
									$ul=$ul_sql->balance - $update_days;
									
								}
								else
								{
									$update_days=$days - $current_days;
									$ul=$ul_sql->balance + $update_days;
									
								}
								#if($sl<0)
								#{
								#	$this->session->set_flashdata( 'message', 'Employee Does not have enough SL Balance...' );
								#	redirect('leave', 'refresh');
								#}
								$this->leave_balance->updateBalance($emp_id,$ul,$leave_type);
								$sl=$sl_sql->balance;
								$vl=$vl_sql->balance;
							}break;
			default:		{echo "Select Leave Type...";}break;
		}
		$dtl = array(
						'employee_id'	=> $emp_id,
               			'leave_type'    => $leave_type,
						'start'    		=> $this->input->post('start_date'),
               			'end'     		=> $this->input->post('end_date'),
               			'no_days'       => $this->input->post('no_days'),
               			'pay_type'		=> $this->input->post('pay_type'),
						'vl'			=> $vl,
						'sl'		    => $sl,
						'ul'			=> $ul
            		);
		$this->leave_transaction->update($dtl,$id);
		#$this->session->set_flashdata( 'message', 'Processed Employee Leave/s...' );
		redirect('leave/view', 'refresh');
	}
	function cancel()
	{
		$id=$this->uri->segment(3);
		$query=$this->leave_transaction->getById($id)->result();
		foreach($query as $q):
			$leave_type=$q->leave_type;
			$days=$q->no_days;
			$emp_id=$q->employee_id;
		endforeach;
		$leave_sql=$this->leave_balance->viewBalance($emp_id,$leave_type)->row();
		if($leave_type=='UL')
		{$balance=$leave_sql->balance - $days;}
		else{$balance=$leave_sql->balance + $days;}
		$this->leave_balance->updateBalance($emp_id,$balance,$leave_type);
		$this->leave_transaction->cancelById($id);
		redirect('leave/view', 'refresh');
	}
	function search()
	{
		$option=$this->input->post('search');
		$key=$this->input->post('key');
		$query=$this->leave_transaction->search($option,$key)->result();
		$data=array('title'=>'Leaves','queries'=>$query,);
		$this->template->load('hr', '/leave/search', $data);
	}
	function printExcel()
	{	
		$q=$this->session->userdata('query');
		$query=$this->db->query($q)->result();
		$data=array('title'=>'Employees','queries'=>$query,);
		$this->template->load('plain', '/leave/excel', $data);
	}
}
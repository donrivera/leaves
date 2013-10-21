<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        $this->load->library('template');
		$this->load->model('user','',TRUE);
		$this->load->model('employee','',TRUE);
	}
	public function index()
	{
		$data = array('title' => 'Leaves Monitoring System',);
		$this->template->load('default', '/home/index', $data);
	}
	public function inquireLeave()
	{
		$queries=$this->employee->viewEmp()->result();
		$data = array('title' => 'Check Leave Balance','queries'=>$queries);
		$this->template->load('default', '/home/inquire_leave', $data);
	}
	public function viewLeave()
	{
		$name=$this->input->post('emp_name');
		$query=$this->employee->getEmp($name)->result();
		$data = array('title' => 'View Leave Balance','queries'=>$query);
		$this->template->load('default', '/home/view_leave', $data);
	}
	public function admin()
	{
		$data = array('title' => 'Administrator',);
		//$this->template->load('default', '/index/index', $data);
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('pass', 'Password', 'trim|required|xss_clean|callback_login');
		if($this->form_validation->run() == FALSE)
		{
			//Field validation failed.  User redirected to login page
			//$this->load->view('login_view');
			$this->template->load('default', '/home/administrator', $data);
		}
		else
		{
			//Go to private area
			
			redirect('home', 'refresh');
		}
	}
	public function login()
	{
		$user=$this->input->post('name');
		$pass=$this->input->post('pass');
		$result = $this->user->login($user,$pass);
		if($result)
		{
			
			
			$sess_array = array();
			foreach($result as $row)
			{
				$sess_array = array('id'=>$row->id,'username'=>$row->username,'name'=>$row->name);
				$this->session->set_userdata('logged_in',$sess_array);
				$user_type=$row->type;
				switch($user_type)
				{
						case 'hr':	{redirect('hr', 'refresh');}break;
						default:	{redirect('home', 'refresh');}
				}
			}
			return TRUE;
			
		}
		else{$this->session->set_flashdata( 'message', 'A user does not exist for the username specified.' );redirect('home/admin', 'refresh');}

	}
	public function dashboard()
	{
		$data = array('title' => 'Dashboard',);
		$this->template->load('default', '/home/dashboard', $data);
	}
	function logout()
	{
		$this->session->unset_userdata('logged_in');
		//session_destroy();
		redirect('home', 'refresh');
	}
	public function test()
	{
		/*
			$dtl = array(
               			'id'      => $id,
               			'qty'     => $qty,
               			'price'   => $price,
               			'name'    => $name,
               			//'options' => array('Size' => 'L', 'Color' => 'Red')
            		);
		*/
	}
}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Hr extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        $this->load->library('template');
		$this->load->model('user','',TRUE);
	}
	public function index()
	{
		$data = array('title' => 'Dashboard',);
		$this->template->load('default', '/home/dashboard', $data);
	}
}
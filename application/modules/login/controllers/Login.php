<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if($this->aauth->is_loggedin() ){
            redirect('home');
        } 
	}

	function index()
	{
		$this->load->view('login');
	}

    function auth()
    {
    	$this->load->library('form_validation');
    	$this->form_validation->set_rules('uname', 'Username', 'trim|valid_email|required');
		$this->form_validation->set_rules('upass', 'Password', 'trim|min_length[5]|max_length[20]|required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata('activity','Failed login attempt.');
			redirect('login');
		}
		else
		{
			$remember = $this->input->post('uremember');
			$username = $this->input->post('uname');
			$password = $this->input->post('upass');
			if($remember)
			{
				$remember = TRUE;
			}
			else
			{
				$remember = FALSE;
			}
			if ($this->aauth->login($username,$password,$remember)){
				$this->session->set_userdata('activity','Successfully login.');
	            redirect('home');
	        }
	        else
	        {
	        	$this->session->set_userdata('activity','Failed login attempt.');
	        	redirect('login');
	        }
		}
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!$this->aauth->is_loggedin() ){
            redirect('login');
        } 
	}

	function index()
	{
		$this->aauth->logout();
		redirect("/");
		// use below when you need to integrate with SSO
		//logout from SSO since user selected sign out
		//button rather than Switch App button.
		//redirect('http://login.whyphylabs.com/logout/ref/'.urlencode(base64_encode(site_url())));
	}
}

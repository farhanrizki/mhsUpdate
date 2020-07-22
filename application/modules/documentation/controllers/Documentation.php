<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documentation extends CI_Controller {


	public function __construct() {
		parent::__construct();
		global $activeTemplate;
		date_default_timezone_set('Asia/Jakarta');
		if(!$this->aauth->is_loggedin() ){
            redirect('login');
        }  
	}

	public function index()
	{
		$cssList = array(
			'link'=>array(
				site_url().'assets/skin/bootstrap/css/bootstrap.min.css',
				'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css',
				'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
				site_url().'assets/skin/dist/css/AdminLTE.min.css',
				site_url().'assets/skin/dist/css/skins/_all-skins.min.css',
				site_url().'assets/skin/docs/style.css'
			),
			'script'=>array()
		);
		$jsList = array(
			'link'=>array(
				site_url().'assets/skin/plugins/jQuery/jQuery-2.2.0.min.js',
				site_url().'assets/skin/bootstrap/js/bootstrap.min.js',
				site_url().'assets/skin/plugins/fastclick/fastclick.js',
				site_url().'assets/skin/dist/js/app.min.js',
				site_url().'assets/skin/plugins/slimScroll/jquery.slimscroll.min.js',
				'https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js',
				site_url().'assets/skin/docs/docs.js',
			),
			'script'=>array()
		);
		$content = $this->load->view('documentation',array(),TRUE);
		//$sideBar = $this->obackend->sidebar(42);
		$sideBar = '';
		$viewData = $this->obackend->full(array('css'=>$cssList,'sidebar'=>$sideBar,'content'=>$content,'js'=>$jsList));
		//$activeTemplate = $this->obackend->getActiveTemplate();
		//$this->parser->parse($activeTemplate.'template',$viewData);
		$this->parser->parse('documentation',$viewData);
	}

}

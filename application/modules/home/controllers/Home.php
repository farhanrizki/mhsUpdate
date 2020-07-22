<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


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
		$content = $this->load->view('home',array(),TRUE);
		$sideBar = $this->obackend->sidebar(4);
		$viewData = $this->obackend->full(array('sidebar'=>$sideBar,'content'=>$content));
		$activeTemplate = $this->obackend->getActiveTemplate();
		$this->parser->parse($activeTemplate.'template',$viewData);
	}

	public function v2()
	{
		global $activeTemplate;
		$cssList = array(
			'link'=>array(
				site_url().'assets/skin/bootstrap/css/bootstrap.min.css',
				'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css',
				'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
				site_url().'assets/skin/plugins/jvectormap/jquery-jvectormap-1.2.2.css',
				site_url().'assets/skin/dist/css/AdminLTE.min.css',
				site_url().'assets/skin/dist/css/skins/_all-skins.min.css'
			),
			'script'=>array()
		);
		$jsList = array(
			'link'=>array(
				site_url().'assets/skin/plugins/jQuery/jQuery-2.2.0.min.js',
				site_url().'assets/skin/bootstrap/js/bootstrap.min.js',
				site_url().'assets/skin/plugins/fastclick/fastclick.js',
				site_url().'assets/skin/dist/js/app.min.js',
				site_url().'assets/skin/plugins/sparkline/jquery.sparkline.min.js',
				site_url().'assets/skin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
				site_url().'assets/skin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
				site_url().'assets/skin/plugins/slimScroll/jquery.slimscroll.min.js',
				site_url().'assets/skin/plugins/chartjs/Chart.min.js',
				site_url().'assets/skin/dist/js/pages/dashboard2.js',
				site_url().'assets/skin/dist/js/demo.js'
			),
			'script'=>array()
		);
		$content = $this->load->view('home_v2',array(),TRUE);
		$sideBar = $this->obackend->sidebar(5);
		$viewData = $this->obackend->full(array('css'=>$cssList,'sidebar'=>$sideBar,'content'=>$content,'js'=>$jsList));
		$activeTemplate = $this->obackend->getActiveTemplate();
		$this->parser->parse($activeTemplate.'template',$viewData);
	}
}

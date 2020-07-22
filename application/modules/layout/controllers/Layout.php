<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layout extends CI_Controller {

	public function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		if(!$this->aauth->is_loggedin() ){
            redirect('login');
        }  
	}

	public function top_navigation()
	{
		$cssList = array(
			'link'=>array(
				site_url().'assets/skin/bootstrap/css/bootstrap.min.css',
				'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css',
				'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
				site_url().'assets/skin/dist/css/AdminLTE.min.css',
				site_url().'assets/skin/dist/css/skins/_all-skins.min.css'
			),
			'script'=>array()
		);
		$jsList = array(
			'link'=>array(
				site_url().'assets/skin/plugins/jQuery/jQuery-2.2.0.min.js',
				site_url().'assets/skin/bootstrap/js/bootstrap.min.js',
				site_url().'assets/skin/plugins/slimScroll/jquery.slimscroll.min.js',
				site_url().'assets/skin/plugins/fastclick/fastclick.js',
				site_url().'assets/skin/dist/js/app.min.js',
				site_url().'assets/skin/dist/js/demo.js'
			),
			'script'=>array()
		);
		$content = $this->load->view('top_nav',array(),TRUE);
		//$sideBar = $this->obackend->sidebar(7);
		$viewData = $this->obackend->full(array('css'=>$cssList,'sidebar'=>'','content'=>$content,'js'=>$jsList));
		$activeTemplate = $this->obackend->getActiveTemplate();
		//$this->parser->parse($activeTemplate.'template',$viewData);
		$this->parser->parse('top_nav',$viewData);
	}

	public function boxed()
	{
		$cssList = array(
			'link'=>array(
				site_url().'assets/skin/bootstrap/css/bootstrap.min.css',
				'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css',
				'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
				site_url().'assets/skin/dist/css/AdminLTE.min.css',
				site_url().'assets/skin/dist/css/skins/_all-skins.min.css'
			),
			'script'=>array()
		);
		$jsList = array(
			'link'=>array(
				site_url().'assets/skin/plugins/jQuery/jQuery-2.2.0.min.js',
				site_url().'assets/skin/bootstrap/js/bootstrap.min.js',
				site_url().'assets/skin/plugins/slimScroll/jquery.slimscroll.min.js',
				site_url().'assets/skin/plugins/fastclick/fastclick.js',
				site_url().'assets/skin/dist/js/app.min.js',
				site_url().'assets/skin/dist/js/demo.js'
			),
			'script'=>array()
		);
		$content = $this->load->view('boxed_content',array(),TRUE);
		$sideBar = $this->obackend->sidebar(8);
		$viewData = $this->obackend->full(array('css'=>$cssList,'sidebar'=>$sideBar,'content'=>$content,'js'=>$jsList,'layout'=>'layout-boxed'));
		$activeTemplate = $this->obackend->getActiveTemplate();
		$this->parser->parse($activeTemplate.'template',$viewData);
	}

	public function fixed()
	{
		$cssList = array(
			'link'=>array(
				site_url().'assets/skin/bootstrap/css/bootstrap.min.css',
				'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css',
				'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
				site_url().'assets/skin/dist/css/AdminLTE.min.css',
				site_url().'assets/skin/dist/css/skins/_all-skins.min.css'
			),
			'script'=>array()
		);
		$jsList = array(
			'link'=>array(
				site_url().'assets/skin/plugins/jQuery/jQuery-2.2.0.min.js',
				site_url().'assets/skin/bootstrap/js/bootstrap.min.js',
				site_url().'assets/skin/plugins/slimScroll/jquery.slimscroll.min.js',
				site_url().'assets/skin/plugins/fastclick/fastclick.js',
				site_url().'assets/skin/dist/js/app.min.js',
				site_url().'assets/skin/dist/js/demo.js'
			),
			'script'=>array()
		);
		$content = $this->load->view('fixed_content',array(),TRUE);
		$sideBar = $this->obackend->sidebar(9);
		$viewData = $this->obackend->full(array('css'=>$cssList,'sidebar'=>$sideBar,'content'=>$content,'js'=>$jsList,'layout'=>'fixed'));
		$activeTemplate = $this->obackend->getActiveTemplate();
		$this->parser->parse($activeTemplate.'template',$viewData);
	}

	public function collapsed()
	{
		$cssList = array(
			'link'=>array(
				site_url().'assets/skin/bootstrap/css/bootstrap.min.css',
				'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css',
				'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
				site_url().'assets/skin/dist/css/AdminLTE.min.css',
				site_url().'assets/skin/dist/css/skins/_all-skins.min.css'
			),
			'script'=>array()
		);
		$jsList = array(
			'link'=>array(
				site_url().'assets/skin/plugins/jQuery/jQuery-2.2.0.min.js',
				site_url().'assets/skin/bootstrap/js/bootstrap.min.js',
				site_url().'assets/skin/plugins/slimScroll/jquery.slimscroll.min.js',
				site_url().'assets/skin/plugins/fastclick/fastclick.js',
				site_url().'assets/skin/dist/js/app.min.js',
				site_url().'assets/skin/dist/js/demo.js'
			),
			'script'=>array()
		);
		$content = $this->load->view('collapsed_content',array(),TRUE);
		$sideBar = $this->obackend->sidebar(10);
		$viewData = $this->obackend->full(array('css'=>$cssList,'sidebar'=>$sideBar,'content'=>$content,'js'=>$jsList,'layout'=>'sidebar-collapse'));
		$activeTemplate = $this->obackend->getActiveTemplate();
		$this->parser->parse($activeTemplate.'template',$viewData);
	}
}

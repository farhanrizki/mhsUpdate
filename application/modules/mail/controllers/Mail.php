<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail extends CI_Controller {


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
				site_url().'assets/skin/plugins/fullcalendar/fullcalendar.min.css',
				site_url().'assets/skin/dist/css/AdminLTE.min.css',
				site_url().'assets/skin/dist/css/skins/_all-skins.min.css',
				site_url().'assets/skin/plugins/iCheck/flat/blue.css'
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
				site_url().'assets/skin/plugins/iCheck/icheck.min.js',
				site_url().'assets/skin/dist/js/demo.js',
				
			),
			'script'=>array(
				'
					$(function () {
					    //Enable iCheck plugin for checkboxes
					    //iCheck for checkbox and radio inputs
					    $(\'.mailbox-messages input[type="checkbox"]\').iCheck({
					      checkboxClass: \'icheckbox_flat-blue\',
					      radioClass: \'iradio_flat-blue\'
					    });

					    //Enable check and uncheck all functionality
					    $(".checkbox-toggle").click(function () {
					      var clicks = $(this).data(\'clicks\');
					      if (clicks) {
					        //Uncheck all checkboxes
					        $(".mailbox-messages input[type=\'checkbox\']").iCheck("uncheck");
					        $(".fa", this).removeClass("fa-check-square-o").addClass(\'fa-square-o\');
					      } else {
					        //Check all checkboxes
					        $(".mailbox-messages input[type=\'checkbox\']").iCheck("check");
					        $(".fa", this).removeClass("fa-square-o").addClass(\'fa-check-square-o\');
					      }
					      $(this).data("clicks", !clicks);
					    });

					    //Handle starring for glyphicon and font awesome
					    $(".mailbox-star").click(function (e) {
					      e.preventDefault();
					      //detect type
					      var $this = $(this).find("a > i");
					      var glyph = $this.hasClass("glyphicon");
					      var fa = $this.hasClass("fa");

					      //Switch states
					      if (glyph) {
					        $this.toggleClass("glyphicon-star");
					        $this.toggleClass("glyphicon-star-empty");
					      }

					      if (fa) {
					        $this.toggleClass("fa-star");
					        $this.toggleClass("fa-star-o");
					      }
					    });
					  });
				'
			)
		);
		$content = $this->load->view('mail',array(),TRUE);
		$sideBar = $this->obackend->sidebar(32);
		$viewData = $this->obackend->full(array('css'=>$cssList,'sidebar'=>$sideBar,'content'=>$content,'js'=>$jsList));
		$activeTemplate = $this->obackend->getActiveTemplate();
		$this->parser->parse($activeTemplate.'template',$viewData);
	}

	public function compose()
	{
		$cssList = array(
			'link'=>array(
				site_url().'assets/skin/bootstrap/css/bootstrap.min.css',
				'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css',
				'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
				site_url().'assets/skin/plugins/fullcalendar/fullcalendar.min.css',
				site_url().'assets/skin/dist/css/AdminLTE.min.css',
				site_url().'assets/skin/dist/css/skins/_all-skins.min.css',
				site_url().'assets/skin/plugins/iCheck/flat/blue.css',
				site_url().'assets/skin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'
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
				site_url().'assets/skin/dist/js/demo.js',
				site_url().'assets/skin/plugins/iCheck/icheck.min.js',
				site_url().'assets/skin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'
				
			),
			'script'=>array(
				'
					$(function () {
						//Add text editor
						$("#compose-textarea").wysihtml5();
					});
				'
			)
		);
		$content = $this->load->view('compose',array(),TRUE);
		$sideBar = $this->obackend->sidebar(32);
		$viewData = $this->obackend->full(array('css'=>$cssList,'sidebar'=>$sideBar,'content'=>$content,'js'=>$jsList));
		$activeTemplate = $this->obackend->getActiveTemplate();
		$this->parser->parse($activeTemplate.'template',$viewData);
	}

	public function read()
	{
		$cssList = array(
			'link'=>array(
				site_url().'assets/skin/bootstrap/css/bootstrap.min.css',
				'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css',
				'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
				site_url().'assets/skin/plugins/fullcalendar/fullcalendar.min.css',
				site_url().'assets/skin/dist/css/AdminLTE.min.css',
				site_url().'assets/skin/dist/css/skins/_all-skins.min.css',
				site_url().'assets/skin/plugins/iCheck/flat/blue.css'
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
		$content = $this->load->view('read',array(),TRUE);
		$sideBar = $this->obackend->sidebar(32);
		$viewData = $this->obackend->full(array('css'=>$cssList,'sidebar'=>$sideBar,'content'=>$content,'js'=>$jsList));
		$activeTemplate = $this->obackend->getActiveTemplate();
		$this->parser->parse($activeTemplate.'template',$viewData);
	}
}

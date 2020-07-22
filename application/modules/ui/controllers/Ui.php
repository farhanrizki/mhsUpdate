<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ui extends CI_Controller {

	public function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		if(!$this->aauth->is_loggedin() ){
            redirect('login');
        }  
	}

	public function general()
	{
		$cssList = array(
			'link'=>array(
				site_url().'assets/skin/bootstrap/css/bootstrap.min.css',
				'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css',
				'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
				site_url().'assets/skin/dist/css/AdminLTE.min.css',
				site_url().'assets/skin/dist/css/skins/_all-skins.min.css'
			),
			'script'=>array(
				'
					.color-palette {
				      height: 35px;
				      line-height: 35px;
				      text-align: center;
				    }

				    .color-palette-set {
				      margin-bottom: 15px;
				    }

				    .color-palette span {
				      display: none;
				      font-size: 12px;
				    }

				    .color-palette:hover span {
				      display: block;
				    }

				    .color-palette-box h4 {
				      position: absolute;
				      top: 100%;
				      left: 25px;
				      margin-top: -40px;
				      color: rgba(255, 255, 255, 0.8);
				      font-size: 12px;
				      display: block;
				      z-index: 7;
				    }
				'
			)
		);
		$jsList = array(
			'link'=>array(
				site_url().'assets/skin/plugins/jQuery/jQuery-2.2.0.min.js',
				site_url().'assets/skin/bootstrap/js/bootstrap.min.js',
				site_url().'assets/skin/plugins/fastclick/fastclick.js',
				site_url().'assets/skin/dist/js/app.min.js',
				site_url().'assets/skin/dist/js/demo.js'
			),
			'script'=>array()
		);

		$content = $this->load->view('general',array(),TRUE);
		$sideBar = $this->obackend->sidebar(18);
		$viewData = $this->obackend->full(array('css'=>$cssList,'sidebar'=>$sideBar,'content'=>$content,'js'=>$jsList));
		$activeTemplate = $this->obackend->getActiveTemplate();
		$this->parser->parse($activeTemplate.'template',$viewData);
	}

	public function icons()
	{
		$cssList = array(
			'link'=>array(
				site_url().'assets/skin/bootstrap/css/bootstrap.min.css',
				'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css',
				'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
				site_url().'assets/skin/dist/css/AdminLTE.min.css',
				site_url().'assets/skin/dist/css/skins/_all-skins.min.css'
			),
			'script'=>array(
				'
					/* FROM HTTP://WWW.GETBOOTSTRAP.COM
				     * Glyphicons
				     *
				     * Special styles for displaying the icons and their classes in the docs.
				     */

				    .bs-glyphicons {
				      padding-left: 0;
				      padding-bottom: 1px;
				      margin-bottom: 20px;
				      list-style: none;
				      overflow: hidden;
				    }

				    .bs-glyphicons li {
				      float: left;
				      width: 25%;
				      height: 115px;
				      padding: 10px;
				      margin: 0 -1px -1px 0;
				      font-size: 12px;
				      line-height: 1.4;
				      text-align: center;
				      border: 1px solid #ddd;
				    }

				    .bs-glyphicons .glyphicon {
				      margin-top: 5px;
				      margin-bottom: 10px;
				      font-size: 24px;
				    }

				    .bs-glyphicons .glyphicon-class {
				      display: block;
				      text-align: center;
				      word-wrap: break-word; /* Help out IE10+ with class names */
				    }

				    .bs-glyphicons li:hover {
				      background-color: rgba(86, 61, 124, .1);
				    }

				    @media (min-width: 768px) {
				      .bs-glyphicons li {
				        width: 12.5%;
				      }
				    }
				'
			)
		);
		$jsList = array(
			'link'=>array(
				site_url().'assets/skin/plugins/jQuery/jQuery-2.2.0.min.js',
				site_url().'assets/skin/bootstrap/js/bootstrap.min.js',
				site_url().'assets/skin/plugins/fastclick/fastclick.js',
				site_url().'assets/skin/dist/js/app.min.js',
				site_url().'assets/skin/dist/js/demo.js'
			),
			'script'=>array()
		);

		$content = $this->load->view('icons',array(),TRUE);
		$sideBar = $this->obackend->sidebar(19);
		$viewData = $this->obackend->full(array('css'=>$cssList,'sidebar'=>$sideBar,'content'=>$content,'js'=>$jsList));
		$activeTemplate = $this->obackend->getActiveTemplate();
		$this->parser->parse($activeTemplate.'template',$viewData);
	}

	public function buttons()
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
				site_url().'assets/skin/plugins/fastclick/fastclick.js',
				site_url().'assets/skin/dist/js/app.min.js',
				site_url().'assets/skin/dist/js/demo.js'
			),
			'script'=>array()
		);

		$content = $this->load->view('buttons',array(),TRUE);
		$sideBar = $this->obackend->sidebar(20);
		$viewData = $this->obackend->full(array('css'=>$cssList,'sidebar'=>$sideBar,'content'=>$content,'js'=>$jsList));
		$activeTemplate = $this->obackend->getActiveTemplate();
		$this->parser->parse($activeTemplate.'template',$viewData);
	}

	public function sliders()
	{
		$cssList = array(
			'link'=>array(
				site_url().'assets/skin/bootstrap/css/bootstrap.min.css',
				'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css',
				'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
				site_url().'assets/skin/plugins/ionslider/ion.rangeSlider.css',
				site_url().'assets/skin/plugins/ionslider/ion.rangeSlider.skinNice.css',
				site_url().'assets/skin/plugins/bootstrap-slider/slider.css',
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
				site_url().'assets/skin/dist/js/demo.js',
				site_url().'assets/skin/plugins/ionslider/ion.rangeSlider.min.js',
				site_url().'assets/skin/plugins/bootstrap-slider/bootstrap-slider.js'
			),
			'script'=>array(
				'
					$(function () {
				    /* BOOTSTRAP SLIDER */
				    $(\'.slider\').slider();

				    /* ION SLIDER */
				    $("#range_1").ionRangeSlider({
				      min: 0,
				      max: 5000,
				      from: 1000,
				      to: 4000,
				      type: \'double\',
				      step: 1,
				      prefix: "$",
				      prettify: false,
				      hasGrid: true
				    });
				    $("#range_2").ionRangeSlider();

				    $("#range_5").ionRangeSlider({
				      min: 0,
				      max: 10,
				      type: \'single\',
				      step: 0.1,
				      postfix: " mm",
				      prettify: false,
				      hasGrid: true
				    });
				    $("#range_6").ionRangeSlider({
				      min: -50,
				      max: 50,
				      from: 0,
				      type: \'single\',
				      step: 1,
				      postfix: "°",
				      prettify: false,
				      hasGrid: true
				    });

				    $("#range_4").ionRangeSlider({
				      type: "single",
				      step: 100,
				      postfix: " light years",
				      from: 55000,
				      hideMinMax: true,
				      hideFromTo: false
				    });
				    $("#range_3").ionRangeSlider({
				      type: "double",
				      postfix: " miles",
				      step: 10000,
				      from: 25000000,
				      to: 35000000,
				      onChange: function (obj) {
				        var t = "";
				        for (var prop in obj) {
				          t += prop + ": " + obj[prop] + "\r\n";
				        }
				        $("#result").html(t);
				      },
				      onLoad: function (obj) {
				        //
				      }
				    });
				  });
				'
			)
		);

		$content = $this->load->view('sliders',array(),TRUE);
		$sideBar = $this->obackend->sidebar(21);
		$viewData = $this->obackend->full(array('css'=>$cssList,'sidebar'=>$sideBar,'content'=>$content,'js'=>$jsList));
		$activeTemplate = $this->obackend->getActiveTemplate();
		$this->parser->parse($activeTemplate.'template',$viewData);
	}

	public function timeline()
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
				site_url().'assets/skin/plugins/fastclick/fastclick.js',
				site_url().'assets/skin/dist/js/app.min.js',
				site_url().'assets/skin/dist/js/demo.js'
			),
			'script'=>array()
		);

		$content = $this->load->view('timeline',array(),TRUE);
		$sideBar = $this->obackend->sidebar(22);
		$viewData = $this->obackend->full(array('css'=>$cssList,'sidebar'=>$sideBar,'content'=>$content,'js'=>$jsList));
		$activeTemplate = $this->obackend->getActiveTemplate();
		$this->parser->parse($activeTemplate.'template',$viewData);
	}

	public function modals()
	{
		$cssList = array(
			'link'=>array(
				site_url().'assets/skin/bootstrap/css/bootstrap.min.css',
				'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css',
				'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
				site_url().'assets/skin/dist/css/AdminLTE.min.css',
				site_url().'assets/skin/dist/css/skins/_all-skins.min.css'
			),
			'script'=>array(
				'
					.example-modal .modal {
				      position: relative;
				      top: auto;
				      bottom: auto;
				      right: auto;
				      left: auto;
				      display: block;
				      z-index: 1;
				    }

				    .example-modal .modal {
				      background: transparent !important;
				    }
				'
			)
		);
		$jsList = array(
			'link'=>array(
				site_url().'assets/skin/plugins/jQuery/jQuery-2.2.0.min.js',
				site_url().'assets/skin/bootstrap/js/bootstrap.min.js',
				site_url().'assets/skin/plugins/fastclick/fastclick.js',
				site_url().'assets/skin/dist/js/app.min.js',
				site_url().'assets/skin/dist/js/demo.js'
			),
			'script'=>array()
		);

		$content = $this->load->view('modals',array(),TRUE);
		$sideBar = $this->obackend->sidebar(23);
		$viewData = $this->obackend->full(array('css'=>$cssList,'sidebar'=>$sideBar,'content'=>$content,'js'=>$jsList));
		$activeTemplate = $this->obackend->getActiveTemplate();
		$this->parser->parse($activeTemplate.'template',$viewData);
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forms extends CI_Controller {

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
		$content = $this->load->view('general',array(),TRUE);
		$sideBar = $this->obackend->sidebar(25);
		$viewData = $this->obackend->full(array('css'=>$cssList,'sidebar'=>$sideBar,'content'=>$content,'js'=>$jsList));
		$activeTemplate = $this->obackend->getActiveTemplate();
		$this->parser->parse($activeTemplate.'template',$viewData);
	}

	public function advance()
	{
		$cssList = array(
			'link'=>array(
				site_url().'assets/skin/bootstrap/css/bootstrap.min.css',
				'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css',
				'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
				site_url().'assets/skin/plugins/daterangepicker/daterangepicker-bs3.css',
				site_url().'assets/skin/plugins/datepicker/datepicker3.css',
				site_url().'assets/skin/plugins/iCheck/all.css',
				site_url().'assets/skin/plugins/colorpicker/bootstrap-colorpicker.min.css',
				site_url().'assets/skin/plugins/timepicker/bootstrap-timepicker.min.css',
				site_url().'assets/skin/plugins/select2/select2.min.css',
				site_url().'assets/skin/dist/css/AdminLTE.min.css',
				site_url().'assets/skin/dist/css/skins/_all-skins.min.css'
			),
			'script'=>array()
		);
		$jsList = array(
			'link'=>array(
				site_url().'assets/skin/plugins/jQuery/jQuery-2.2.0.min.js',
				site_url().'assets/skin/bootstrap/js/bootstrap.min.js',
				site_url().'assets/skin/plugins/select2/select2.full.min.js',
				site_url().'assets/skin/plugins/input-mask/jquery.inputmask.js',
				site_url().'assets/skin/plugins/input-mask/jquery.inputmask.date.extensions.js',
				site_url().'assets/skin/plugins/input-mask/jquery.inputmask.extensions.js',
				'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js',
				site_url().'assets/skin/plugins/daterangepicker/daterangepicker.js',
				site_url().'assets/skin/plugins/datepicker/bootstrap-datepicker.js',
				site_url().'assets/skin/plugins/colorpicker/bootstrap-colorpicker.min.js',
				site_url().'assets/skin/plugins/timepicker/bootstrap-timepicker.min.js',
				site_url().'assets/skin/plugins/slimScroll/jquery.slimscroll.min.js',
				site_url().'assets/skin/plugins/iCheck/icheck.min.js',
				site_url().'assets/skin/plugins/fastclick/fastclick.js',
				site_url().'assets/skin/dist/js/app.min.js',
				site_url().'assets/skin/dist/js/demo.js'
			),
			'script'=>array(
				'
					$(function () {
					    //Initialize Select2 Elements
					    $(".select2").select2();

					    //Datemask dd/mm/yyyy
					    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
					    //Datemask2 mm/dd/yyyy
					    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
					    //Money Euro
					    $("[data-mask]").inputmask();

					    //Date range picker
					    $(\'#reservation\').daterangepicker();
					    //Date range picker with time picker
					    $(\'#reservationtime\').daterangepicker({timePicker: true, timePickerIncrement: 30, format: \'MM/DD/YYYY h:mm A\'});
					    //Date range as a button
					    $(\'#daterange-btn\').daterangepicker(
					        {
					          ranges: {
					            \'Today\': [moment(), moment()],
					            \'Yesterday\': [moment().subtract(1, \'days\'), moment().subtract(1, \'days\')],
					            \'Last 7 Days\': [moment().subtract(6, \'days\'), moment()],
					            \'Last 30 Days\': [moment().subtract(29, \'days\'), moment()],
					            \'This Month\': [moment().startOf(\'month\'), moment().endOf(\'month\')],
					            \'Last Month\': [moment().subtract(1, \'month\').startOf(\'month\'), moment().subtract(1, \'month\').endOf(\'month\')]
					          },
					          startDate: moment().subtract(29, \'days\'),
					          endDate: moment()
					        },
					        function (start, end) {
					          $(\'#daterange-btn span\').html(start.format(\'MMMM D, YYYY\') + \' - \' + end.format(\'MMMM D, YYYY\'));
					        }
					    );

					    //Date picker
					    $(\'#datepicker\').datepicker({
					      autoclose: true
					    });

					    //iCheck for checkbox and radio inputs
					    $(\'input[type="checkbox"].minimal, input[type="radio"].minimal\').iCheck({
					      checkboxClass: \'icheckbox_minimal-blue\',
					      radioClass: \'iradio_minimal-blue\'
					    });
					    //Red color scheme for iCheck
					    $(\'input[type="checkbox"].minimal-red, input[type="radio"].minimal-red\').iCheck({
					      checkboxClass: \'icheckbox_minimal-red\',
					      radioClass: \'iradio_minimal-red\'
					    });
					    //Flat red color scheme for iCheck
					    $(\'input[type="checkbox"].flat-red, input[type="radio"].flat-red\').iCheck({
					      checkboxClass: \'icheckbox_flat-green\',
					      radioClass: \'iradio_flat-green\'
					    });

					    //Colorpicker
					    $(".my-colorpicker1").colorpicker();
					    //color picker with addon
					    $(".my-colorpicker2").colorpicker();

					    //Timepicker
					    $(".timepicker").timepicker({
					      showInputs: false
					    });
					  });
				'
			)
		);
		$content = $this->load->view('advance',array(),TRUE);
		$sideBar = $this->obackend->sidebar(26);
		$viewData = $this->obackend->full(array('css'=>$cssList,'sidebar'=>$sideBar,'content'=>$content,'js'=>$jsList));
		$activeTemplate = $this->obackend->getActiveTemplate();
		$this->parser->parse($activeTemplate.'template',$viewData);
	}

	public function editors()
	{
		$cssList = array(
			'link'=>array(
				site_url().'assets/skin/bootstrap/css/bootstrap.min.css',
				'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css',
				'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
				site_url().'assets/skin/dist/css/AdminLTE.min.css',
				site_url().'assets/skin/dist/css/skins/_all-skins.min.css',
				site_url().'assets/skin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'
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
				'https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js',
				site_url().'assets/skin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'
			),
			'script'=>array(
				'
					$(function () {
					    // Replace the <textarea id="editor1"> with a CKEditor
					    // instance, using default configuration.
					    CKEDITOR.replace(\'editor1\');
					    //bootstrap WYSIHTML5 - text editor
					    $(".textarea").wysihtml5();
					  });
				'
			)
		);
		$content = $this->load->view('editors',array(),TRUE);
		$sideBar = $this->obackend->sidebar(27);
		$viewData = $this->obackend->full(array('css'=>$cssList,'sidebar'=>$sideBar,'content'=>$content,'js'=>$jsList));
		$activeTemplate = $this->obackend->getActiveTemplate();
		$this->parser->parse($activeTemplate.'template',$viewData);
	}
}

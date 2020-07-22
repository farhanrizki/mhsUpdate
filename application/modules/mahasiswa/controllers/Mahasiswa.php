<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

	public function __construct() {
		parent::__construct();
		global $activeTemplate;
		date_default_timezone_set('Asia/Jakarta');
		if(!$this->aauth->is_loggedin() ){
            redirect('login');
        }  
        $this->load->model('mdl_mahasiswa');
	}

	public function index()
	{
		if($this->aauth->is_allowed(68))
		{
			$this->session->set_userdata('lbackend_activity','Users Menu Access - Success');
			$cssList = array(
				'link'=>array(
					site_url().'assets/skin/bootstrap/css/bootstrap.min.css',
					site_url().'assets/skin/cloudflare/font-awesome.min.css',
					site_url().'assets/skin/cloudflare/ionicons.min.css',
					site_url().'assets/skin/plugins/datatables/dataTables.bootstrap.css',
					site_url().'assets/skin/dist/css/AdminLTE.min.css',
					site_url().'assets/skin/dist/css/skins/_all-skins.min.css',
					site_url().'assets/skin/plugins/select2/select2.min.css'
				),
				'script'=>array()
			);
			$jsList = array(
				'link'=>array(
					site_url().'assets/skin/plugins/jQuery/jQuery-2.2.0.min.js',
					site_url().'assets/skin/bootstrap/js/bootstrap.min.js',
					site_url().'assets/skin/plugins/datatables/jquery.dataTables.min.js',
					site_url().'assets/skin/plugins/datatables/dataTables.bootstrap.min.js',
					site_url().'assets/skin/plugins/slimScroll/jquery.slimscroll.min.js',
					site_url().'assets/skin/plugins/fastclick/fastclick.js',
					site_url().'assets/skin/dist/js/app.min.js',
					site_url().'assets/skin/dist/js/demo.js',
					site_url().'assets/js/mahasiswa.js',
					site_url().'assets/js/sweetalert2.js',
					site_url().'assets/skin/plugins/select2/select2.min.js'
				),
				'script'=>array(
					'
						$(function () {
							$.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings)
			                {
			                    return {
			                        "iStart": oSettings._iDisplayStart,
			                        "iEnd": oSettings.fnDisplayEnd(),
			                        "iLength": oSettings._iDisplayLength,
			                        "iTotal": oSettings.fnRecordsTotal(),
			                        "iFilteredTotal": oSettings.fnRecordsDisplay(),
			                        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
			                        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
			                    };
			                };

							var t = $("#tablemhs").DataTable({
						    	responsive:true,
				                "processing": true,
				                "serverSide": true,
				                "ajax": "'.site_url('mahasiswa/getDataMHS').'",
				                "columns": [
						                        {"data": "id"},
						                        {"data": "nama"},
						                        {"data": "alamat"},
						                        {"data": "agama"},
						                        {
						                            "class": "text-center",
						                            "data": "aksi"
						                        }
						                    ],
						        "order": [[0, "asc"]],
						        "rowCallback": function (row, data, iDisplayIndex) {
			                        var info = this.fnPagingInfo();
			                        var page = info.iPage;
			                        var length = info.iLength;
			                        var index = page * length + (iDisplayIndex + 1);
			                        $("td:eq(0)", row).html(index);
			                    }
						    });
						});

						$(function () {
					      $("#getAgama").select2({
					         placeholder: "Pilih Agama",
					         pointer: true,
					         allowClear: true
					     });
					   	});
					'
				)
			);
			$content = $this->load->view('mahasiswa',array(),TRUE);
			$sideBar = $this->obackend->sidebar(68);
			$viewData = $this->obackend->full(array('css'=>$cssList,'sidebar'=>$sideBar,'content'=>$content,'js'=>$jsList));
		}
		else
		{
			$this->session->set_userdata('lbackend_activity','Access - Failed ( Permission )');
			//redirect('sample/error_404');
			$cssList = array(
				'link'=>array(
					site_url().'assets/skin/bootstrap/css/bootstrap.min.css',
					site_url().'assets/skin/cloudflare/font-awesome.min.css',
					site_url().'assets/skin/cloudflare/ionicons.min.css',
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
			$content  = $this->load->view('sample/error_404',array(),TRUE);
			$viewData = $this->obackend->full(array('css'=>$cssList,'content'=>$content,'js'=>$jsList));
		}
		$activeTemplate = $this->obackend->getActiveTemplate();
		$this->parser->parse($activeTemplate.'template',$viewData);
	}

	public function getDataMHS()
	{
		// DB table to use
        $table = 'tbmhs';
         
        // Table's primary key
        $primaryKey = 'id';
         
        // Column
        $columns = array(
            array( 'db' => 'id',  'dt' => 'id'),
            array( 'db' => 'nama', 'dt' => 'nama'),
            array( 'db' => 'alamat', 'dt' => 'alamat'),
            array( 'db' => 'agama', 'dt' => 'agama'),
            array(
                    'db' => 'id',
                    'dt' => 'aksi',
                    'formatter' => function( $d ) {
                        return '<a class= "fa fa-edit" href="' . site_url('mahasiswa/update/' . $d) . '"></a> 
                        		<a class= "fa fa-remove" href="javascript:void(0)" title="Hapus" onclick="deleteMHS('."'".$d."'".')"></a>';
                    }
                ),
        );
         
        // SQL server connection information
        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db'   => $this->db->database,
            'host' => $this->db->hostname,
            'charset' => 'utf8'
        );
        
        // Tampil SSP   
        echo json_encode(
			Sspbaru::simple( $_GET, $sql_details, $table, $primaryKey, $columns)
        );
	}

	/*public function getAgama(){
		$(function () {
	      $("#getAgama").select2({
	         placeholder: "Pilih Agama",
	         pointer: true,
	         ajax: { 
	           url: "'.site_url('mahasiswa/getAgama').'",
	           type: "post",
	           dataType: "json",
	           delay: 250,
	           data: function (params) {
	              return {
	                searchTerm: params.term 
	              };
	           },
	           processResults: function (response) {
	              return {
	                 results: response
	              };
	           },
	           cache: true
	         }
	     });
	   	});
		$searchTerm = $this->input->post('searchTerm');
		$response   = $this->mdl_mahasiswa->getAgama($searchTerm);
		echo json_encode($response);
    }*/

    public function saveDataMHS(){ 
		$data = $this->mdl_mahasiswa->saveDataMHS();
		redirect('mahasiswa');
	}

	public function deleteDataMHS()
	{
		$id   = $this->input->post('id');
		$data = $this->mdl_mahasiswa->deleteDataMHS($id);
        echo json_encode($data);
	}

}

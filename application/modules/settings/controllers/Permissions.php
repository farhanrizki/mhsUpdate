<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permissions extends CI_Controller {

	public function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		if(!$this->aauth->is_loggedin() ){
            redirect('login');
        }  
	}

	public function index($data = array())
	{
		if($this->aauth->is_allowed('59_menu'))
		{
			$this->session->set_userdata('lbackend_activity','Permissions Menu Access - Success');
			$cssList = array(
				'link'=>array(
					site_url().'assets/skin/bootstrap/css/bootstrap.min.css',
					site_url().'assets/skin/cloudflare/font-awesome.min.css',
					site_url().'assets/skin/cloudflare/ionicons.min.css',
					site_url().'assets/skin/plugins/datatables/dataTables.bootstrap.css',
					site_url().'assets/skin/dist/css/AdminLTE.min.css',
					site_url().'assets/skin/dist/css/skins/_all-skins.min.css'
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
					site_url().'assets/skin/dist/js/demo.js'
				),
				'script'=>array(
					'
						$(function () {
						    $("#example1").DataTable({
						    	"order": [[ 0, "asc" ]]
						    });

						});
					'
				)
			);
			$data['permList'] = $this->aauth->list_perms();
			$content = $this->load->view('permissions',$data,TRUE);
			$sideBar = $this->obackend->sidebar(59);
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
			$content = $this->load->view('sample/error_404',array(),TRUE);
			$viewData = $this->obackend->full(array('css'=>$cssList,'content'=>$content,'js'=>$jsList));
		}
		$activeTemplate = $this->obackend->getActiveTemplate();
		$this->parser->parse($activeTemplate.'template',$viewData);
	}
	
	public function add($data = array())
	{
		if($this->aauth->is_allowed('permission_add'))
		{
			$this->session->set_userdata('lbackend_activity','Add Permission Access - Success');
			$cssList = array(
				'link'=>array(
					site_url().'assets/skin/bootstrap/css/bootstrap.min.css',
					site_url().'assets/skin/cloudflare/font-awesome.min.css',
					site_url().'assets/skin/cloudflare/ionicons.min.css',
					site_url().'assets/skin/plugins/datatables/dataTables.bootstrap.css',
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
			$data['breadcrumb'] = array(
				array(
					'name'=>'Settings',
					'link'=>'#',
					'icon'=>'fa fa-gears'
				),
				array(
					'name'=>'Permissions',
					'link'=>site_url('settings/permissions')
				)
			);
			$data['breadcrumb'][] = array(
				'name'=>'Add',
				'link'=>'#'
			);
			$data['addFlag'] = TRUE;
			$content = $this->load->view('permissions_crud',$data,TRUE);
			$sideBar = $this->obackend->sidebar(59);
			$viewData = $this->obackend->full(array('css'=>$cssList,'sidebar'=>$sideBar,'content'=>$content,'js'=>$jsList));
			$activeTemplate = $this->obackend->getActiveTemplate();
			$this->parser->parse($activeTemplate.'template',$viewData);
		}
		else
		{
			$this->session->set_userdata('lbackend_activity','Access - Failed ( Permission )');
			$alertData = array(
				array(
					'alertType'=>'alert-danger',
					'alertIcon'=>'fa fa-ban',
					'alertCaption'=>'Error!',
					'alertContent'=>'You don\'t have permission to do this.'
				)
			);
			$this->index(array('alertData'=>$alertData));
		}
	}

	public function edit($permissionId='')
	{
		if($this->aauth->is_allowed('permission_edit'))
		{
			//LOGGING PURPOSE
			$_GET['permissionId'] = $permissionId;
			//
			if(is_numeric($permissionId))
			{
				$this->load->model('mdl_permissions');
				$permissionData = $this->mdl_permissions->permissionDetails($permissionId);
				if(count($permissionData)>0)
				{
					$this->session->set_userdata('lbackend_activity','Edit Permission Access - Success');
					$cssList = array(
						'link'=>array(
							site_url().'assets/skin/bootstrap/css/bootstrap.min.css',
							site_url().'assets/skin/cloudflare/font-awesome.min.css',
							site_url().'assets/skin/cloudflare/ionicons.min.css',
							site_url().'assets/skin/plugins/datatables/dataTables.bootstrap.css',
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
					$data['breadcrumb'] = array(
						array(
							'name'=>'Settings',
							'link'=>'#',
							'icon'=>'fa fa-gears'
						),
						array(
							'name'=>'Permissions',
							'link'=>site_url('settings/permissions')
						)
					);
					$data['breadcrumb'][] = array(
						'name'=>'Edit',
						'link'=>'#'
					);
					
					$data['permissionDetails'] = array(
						'permissionId'=>$permissionId,
						'name'=>$permissionData[0]->name,
						'desc'=>$permissionData[0]->definition
					);
					$content = $this->load->view('permissions_crud',$data,TRUE);
					$sideBar = $this->obackend->sidebar(59);
					$viewData = $this->obackend->full(array('css'=>$cssList,'sidebar'=>$sideBar,'content'=>$content,'js'=>$jsList));
					$activeTemplate = $this->obackend->getActiveTemplate();
					$this->parser->parse($activeTemplate.'template',$viewData);
				}
				else
				{
					$this->session->set_userdata('lbackend_activity','Edit Permission Access - Failed ( Not Found )');
					$alertData = array(
						array(
							'alertType'=>'alert-danger',
							'alertIcon'=>'fa fa-ban',
							'alertCaption'=>'Error!',
							'alertContent'=>'Permission not found.'
						)
					);
					$this->index(array('alertData'=>$alertData));
				}
			}
			else
			{
				$this->session->set_userdata('lbackend_activity','Edit Permission Access - Failed ( Not Numeric )');
				$alertData = array(
					array(
						'alertType'=>'alert-danger',
						'alertIcon'=>'fa fa-ban',
						'alertCaption'=>'Error!',
						'alertContent'=>'Unknown error occured.'
					)
				);
				$this->index(array('alertData'=>$alertData));
			}
		}
		else
		{
			$this->session->set_userdata('lbackend_activity','Access - Failed ( Permission )');
			$alertData = array(
				array(
					'alertType'=>'alert-danger',
					'alertIcon'=>'fa fa-ban',
					'alertCaption'=>'Error!',
					'alertContent'=>'You don\'t have permission to do this.'
				)
			);
			$this->index(array('alertData'=>$alertData));
		}
	}

	public function delete($permissionId='')
	{
		if($this->aauth->is_allowed('permission_delete'))
		{
			//LOGGING PURPOSE
			$_GET['permissionId'] = $permissionId;
			//
			if(is_numeric($permissionId))
			{
				$this->aauth->delete_perm($permissionId);
				$this->session->set_userdata('lbackend_activity','Delete Permission - Success');
				$alertData = array(
					array(
						'alertType'=>'alert-success',
						'alertIcon'=>'fa fa-check',
						'alertCaption'=>'Success!',
						'alertContent'=>'Permission Deleted.'
					)
				);
				$this->index(array('alertData'=>$alertData));
			}
			else
			{
				$this->session->set_userdata('lbackend_activity','Delete Permission - Failed ( Not Found )');
				$alertData = array(
					array(
						'alertType'=>'alert-danger',
						'alertIcon'=>'fa fa-ban',
						'alertCaption'=>'Error!',
						'alertContent'=>'Unknown error occured.'
					)
				);
				$this->index(array('alertData'=>$alertData));
			}
		}
		else
		{
			$this->session->set_userdata('lbackend_activity','Access - Failed ( Permission )');
			$alertData = array(
				array(
					'alertType'=>'alert-danger',
					'alertIcon'=>'fa fa-ban',
					'alertCaption'=>'Error!',
					'alertContent'=>'You don\'t have permission to do this.'
				)
			);
			$this->index(array('alertData'=>$alertData));
		}
	}

	public function save($permissionId='')
	{
		if($this->aauth->is_allowed('permission_add') || $this->aauth->is_allowed('permission_edit'))
		{
			if(is_numeric($permissionId))
			{
				//LOGGING PURPOSE
				$_GET['permissionId'] = $permissionId;
				//
				$this->load->model('mdl_permissions');
				$checkPermission = $this->mdl_permissions->permissionDetails($permissionId);
				if(count($checkPermission) > 0)
				{
					$permName = trim($this->input->post('pName'));
					$permDesc = trim($this->input->post('pDesc'));
					$this->aauth->update_perm($permissionId,$permName,$permDesc);
					$this->session->set_userdata('lbackend_activity','Permission Update - Success');
					$alertData = array(
						array(
							'alertType'=>'alert-success',
							'alertIcon'=>'fa fa-check',
							'alertCaption'=>'Success!',
							'alertContent'=>'Permission data updated.'
						)
					);
					$this->index(array('alertData'=>$alertData));
				}
				else
				{
					$this->session->set_userdata('lbackend_activity','Permission Update - Failed ( Not Found )');
					$alertData = array(
						array(
							'alertType'=>'alert-danger',
							'alertIcon'=>'fa fa-ban',
							'alertCaption'=>'Error!',
							'alertContent'=>'Permission not found.'
						)
					);
					$this->index(array('alertData'=>$alertData));
				}
			}
			else
			{
				if($permissionId == 'new')
				{
					$permName = trim($this->input->post('pName'));
					$permDesc = trim($this->input->post('pDesc'));
					$createPerm = $this->aauth->create_perm($permName,$permDesc);
					if($createPerm !== FALSE)
					{
						$this->session->set_userdata('lbackend_activity','Create Permission - Success');
						$alertData = array(
							array(
								'alertType'=>'alert-success',
								'alertIcon'=>'fa fa-check',
								'alertCaption'=>'Success!',
								'alertContent'=>'Permission created!'
							)
						);
						$this->index(array('alertData'=>$alertData));
					}
					else
					{
						$this->session->set_userdata('lbackend_activity','Create Permission - Failed ( Exists )');
						$alertData = array(
							array(
								'alertType'=>'alert-warning',
								'alertIcon'=>'fa fa-warning',
								'alertCaption'=>'Failed!',
								'alertContent'=>'Permission already exists. Please choose another permission name.'
							)
						);
						$this->add(array('alertData'=>$alertData));
					}
				}
				else
				{
					$this->session->set_userdata('lbackend_activity','Permissions - Failed ( Unknown Request )');
					$alertData = array(
						array(
							'alertType'=>'alert-danger',
							'alertIcon'=>'fa fa-ban',
							'alertCaption'=>'Error!',
							'alertContent'=>'Unknown error occured.'
						)
					);
					$this->index(array('alertData'=>$alertData));
				}
			}
		}
		else
		{
			$this->session->set_userdata('lbackend_activity','Access - Failed ( Permission )');
			$alertData = array(
				array(
					'alertType'=>'alert-danger',
					'alertIcon'=>'fa fa-ban',
					'alertCaption'=>'Error!',
					'alertContent'=>'You don\'t have permission to do this.'
				)
			);
			$this->index(array('alertData'=>$alertData));
		}
	}
}

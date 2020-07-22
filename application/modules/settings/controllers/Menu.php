<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

	public function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		if(!$this->aauth->is_loggedin() ){
            redirect('login');
        }  
	}

	public function index($data = array())
	{
		if($this->aauth->is_allowed('56_menu'))
		{
			$this->session->set_userdata('lbackend_activity','Menu Access - Success');
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
						    	"order": [[ 1, "asc" ]]
						    });

						});
					'
				)
			);
			$this->load->model('mdl_menu');
			$data['menuData'] = $this->mdl_menu->getMenuSegment();
			$content = $this->load->view('menu',$data,TRUE);
			$sideBar = $this->obackend->sidebar(56);
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

	public function up($menuId='',$parentId='')
	{
		if($this->aauth->is_allowed('menu_common'))
		{
			//LOGGING PURPOSE
			$_GET['menuId'] = $menuId;
			$_GET['parentId'] = $parentId;
			//
			$this->session->set_userdata('lbackend_activity','Menu/ Submenu Move Up - Success');
			$this->moveMenu($menuId,$parentId,'up');
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

	public function down($menuId='',$parentId='')
	{
		if($this->aauth->is_allowed('menu_common'))
		{
			//LOGGING PURPOSE
			$_GET['menuId'] = $menuId;
			$_GET['parentId'] = $parentId;
			//
			$this->session->set_userdata('lbackend_activity','Menu/ Submenu Move Down - Success');
			$this->moveMenu($menuId,$parentId,'down');
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

	public function details($menuId='',$parentId='', $data = array())
	{
		if($this->aauth->is_allowed('menu_common'))
		{
			//LOGGING PURPOSE
			$_GET['menuId'] = $menuId;
			$_GET['parentId'] = $parentId;
			//
			$this->session->set_userdata('lbackend_activity','Menu/ Submenu Details Access - Success');
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
						    	"order": [[ 1, "asc" ]]
						    });

						});
					'
				)
			);
			$this->load->model('mdl_menu');
			$menuDetails = $this->mdl_menu->getMenuDetails($menuId,$parentId);
			//var_dump($menuDetails);die();
			if(is_array($menuDetails))
			{
				$checkConfig = json_decode($menuDetails[0]->config,TRUE);
				$data['breadcrumb'] = array(
					array(
						'name'=>'Settings',
						'link'=>'#',
						'icon'=>'fa fa-gears'
					),
					array(
						'name'=>'Menu',
						'link'=>site_url('settings/menu')
					)
				);
				if(json_last_error())
				{
					$data['menuDetails'] = array(
						'name'=>$menuDetails[0]->config,
						'order'=>$menuDetails[0]->order,
						'menuId'=>$menuId,
						'parentId'=>$parentId
					);
					$data['breadcrumb'][] = array(
						'name'=>'Details',
						'link'=>'#'
					);
				}
				else
				{
					//var_dump($checkConfig);die();
					$data['menuDetails'] = array(
						'name'=>$checkConfig['menuName'],
						'order'=>$menuDetails[0]->order,
						'details'=>$checkConfig,
						'menuId'=>$menuId,
						'parentId'=>$parentId
					);
					$breadcrumbMenuId = $menuDetails[0]->parent_id;
					$checkParent = $this->mdl_menu->getParent($breadcrumbMenuId);
					$breadcrumbParentId = $checkParent[0]->parent_id;
					$data['breadcrumb'][] = array(
						'name'=>'Parent Menu',
						'link'=>site_url('settings/menu/details/'.$breadcrumbMenuId.'/'.$breadcrumbParentId)
					);
					$data['breadcrumb'][] = array(
						'name'=>'Details',
						'link'=>'#'
					);
				}
				$data['menuChild'] = $this->mdl_menu->getChild($menuId);
				$content = $this->load->view('menu_details',$data,TRUE);	
			}
			else
			{
				$data['menuData'] = $this->mdl_menu->getMenuSegment();
				$content = $this->load->view('menu',$data,TRUE);
			}
			$sideBar = $this->obackend->sidebar(56);
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

	public function add($menuId='',$parentId='')
	{
		if($this->aauth->is_allowed('menu_add'))
		{
			//LOGGING PURPOSE
			$_GET['menuId'] = $menuId;
			$_GET['parentId'] = $parentId;
			//
			$this->session->set_userdata('lbackend_activity','Add Menu/ Submenu Access - Success');
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
				'script'=>array()
			);
			$data['menuDetails'] = array(
				'name'=>'',
				'order'=>'',
				'menuId'=>$menuId,
				'parentId'=>$parentId
			);
			$data['breadcrumb'] = array(
				array(
					'name'=>'Settings',
					'link'=>'#',
					'icon'=>'fa fa-gears'
				),
				array(
					'name'=>'Menu',
					'link'=>site_url('settings/menu')
				)
			);
			$this->load->model('mdl_menu');
			if(!empty($menuId))
			{
				//menu
				$data['menuDetails']['details'] = array(
					'menuLink'=>'',
					'menuIcon'=>'',
					'menuNotifColor'=>''
				);			
				$data['breadcrumb'][] = array(
					'name'=>'Parent Menu',
					'link'=>site_url('settings/menu/details/'.$menuId.'/'.$parentId)
				);
				$data['breadcrumb'][] = array(
					'name'=>'Add',
					'link'=>'#'
				);
			} 
			else
			{
				$data['breadcrumb'][] = array(
					'name'=>'Add',
					'link'=>'#'
				);
			}
			$data['addFlag'] = true;
			$content = $this->load->view('menu_crud',$data,TRUE);
			$sideBar = $this->obackend->sidebar(56);
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

	public function edit($menuId='',$parentId='')
	{
		if($this->aauth->is_allowed('menu_edit'))
		{
			//LOGGING PURPOSE
			$_GET['menuId'] = $menuId;
			$_GET['parentId'] = $parentId;
			//
			$this->session->set_userdata('lbackend_activity','Edit Menu/ Submenu Access - Success');
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
				'script'=>array()
			);
			$this->load->model('mdl_menu');
			$menuDetails = $this->mdl_menu->getMenuDetails($menuId,$parentId);
			if(is_array($menuDetails))
			{
				$checkConfig = json_decode($menuDetails[0]->config,TRUE);
				$data['breadcrumb'] = array(
					array(
						'name'=>'Settings',
						'link'=>'#',
						'icon'=>'fa fa-gears'
					),
					array(
						'name'=>'Menu',
						'link'=>site_url('settings/menu')
					)
				);
				if(json_last_error())
				{
					$data['menuDetails'] = array(
						'name'=>$menuDetails[0]->config,
						'order'=>$menuDetails[0]->order,
						'menuId'=>$menuId,
						'parentId'=>$parentId
					);
					$data['breadcrumb'][] = array(
						'name'=>'Edit',
						'link'=>'#'
					);
				}
				else
				{
					$data['menuDetails'] = array(
						'name'=>$checkConfig['menuName'],
						'order'=>$menuDetails[0]->order,
						'details'=>$checkConfig,
						'menuId'=>$menuId,
						'parentId'=>$parentId
					);
					$breadcrumbMenuId = $menuDetails[0]->parent_id;
					$checkParent = $this->mdl_menu->getParent($breadcrumbMenuId);
					$breadcrumbParentId = $checkParent[0]->parent_id;
					$data['breadcrumb'][] = array(
						'name'=>'Parent Menu',
						'link'=>site_url('settings/menu/details/'.$breadcrumbMenuId.'/'.$breadcrumbParentId)
					);
					$data['breadcrumb'][] = array(
						'name'=>'Edit',
						'link'=>'#'
					);
				}
				$content = $this->load->view('menu_crud',$data,TRUE);	
			}
			else
			{
				$data['menuData'] = $this->mdl_menu->getMenuSegment();
				$this->session->set_userdata('lbackend_activity','Edit Menu/ Submenu Access - Failed ( Not Found )');
				$data['alertData'] = array(
					array(
						'alertType'=>'alert-danger',
						'alertIcon'=>'fa fa-ban',
						'alertCaption'=>'Error!',
						'alertContent'=>'Data not found.'
					)
				);
				$content = $this->load->view('menu',$data,TRUE);
			}
			$sideBar = $this->obackend->sidebar(56);
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

	public function delete($menuId='',$parentId='')
	{
		if($this->aauth->is_allowed('menu_delete'))
		{
			//LOGGING PURPOSE
			$_GET['menuId'] = $menuId;
			$_GET['parentId'] = $parentId;
			//
			if(is_numeric($menuId) && is_numeric($parentId))
			{
				$this->load->model('mdl_menu');
				$deleteResult = $this->mdl_menu->removeMenu($menuId);
				if($deleteResult == 0)
				{
					$this->aauth->delete_perm($menuId.'_menu');
					$this->session->set_userdata('lbackend_activity','Delete Menu/ Submenu - Success');
					$alertData = array(
						array(
							'alertType'=>'alert-success',
							'alertIcon'=>'fa fa-check',
							'alertCaption'=>'Success!',
							'alertContent'=>'Menu deleted.'
						)
					);
				}
				else
				{
					switch ($deleteResult) {
						case 1:
							$this->session->set_userdata('lbackend_activity','Delete Menu/ Submenu - Failed ( Not Found )');
							$alertData = array(
								array(
									'alertType'=>'alert-danger',
									'alertIcon'=>'fa fa-ban',
									'alertCaption'=>'Error!',
									'alertContent'=>'Data not found.'
								)
							);
							break;
						
						case 2:
							$this->session->set_userdata('lbackend_activity','Delete Menu/ Submenu - Failed ( Have Child )');
							$alertData = array(
								array(
									'alertType'=>'alert-warning',
									'alertIcon'=>'fa fa-warning',
									'alertCaption'=>'Warning!',
									'alertContent'=>'Failed to delete menu. This menu still have submenu. Please remove all submenu first.'
								)
							);
							break;
					}
					
				}
			}
			else
			{
				$this->session->set_userdata('lbackend_activity','Delete Menu/ Submenu - Failed ( Unknown Request )');
				$alertData = array(
					array(
						'alertType'=>'alert-danger',
						'alertIcon'=>'fa fa-ban',
						'alertCaption'=>'Error!',
						'alertContent'=>'Unexpected error occured.'
					)
				);
			}
			if($parentId !== '0')
			{
				$checkParent = $this->mdl_menu->getParent($parentId);
				$this->details($parentId,$checkParent[0]->parent_id,array('alertData'=>$alertData));	
			}
			else
			{
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

	public function save($menuId='',$parentId='', $addFlag='')
	{
		if($this->aauth->is_allowed('menu_add') || $this->aauth->is_allowed('menu_edit'))
		{
			//LOGGING PURPOSE
			$_GET['menuId'] = $menuId;
			$_GET['parentId'] = $parentId;
			$_GET['addFlag'] = $addFlag;
			//
			$this->load->model('mdl_menu');
			if(is_numeric($menuId) && is_numeric($parentId))
			{			
				if($parentId === '0' && empty($addFlag))
				{
					//parent
					$menuName = trim($this->input->post('mnuName'));
					$updateData = array('config'=>$menuName);				
				}
				else
				{
					//child
					$childName = trim($this->input->post('mnuName'));
					$childLink = trim($this->input->post('mnuLink'));
					$childIcon = trim($this->input->post('mnuIcon'));
					$childNotificationColor = trim($this->input->post('mnuNotifColor'));
					$childConfig = array(
						'menuName'=>$childName,
						'menuLink'=>$childLink,
						'menuIcon'=>$childIcon,
						'menuNotif'=>'',
						'menuNotifColor'=>$childNotificationColor,
						'menuActive'=>''
					);
					$encodedConfig = json_encode($childConfig,JSON_UNESCAPED_SLASHES);
					$updateData = array('config'=>$encodedConfig);
				}
				if($addFlag == 'new')
				{
					$newMenuId = $this->mdl_menu->addMenuDetails($menuId,$updateData);
					$this->aauth->create_perm($newMenuId.'_menu','Menu Permission');
					$this->session->set_userdata('lbackend_activity','Create Menu/ Submenu - Success');
					$alertData = array(
						array(
							'alertType'=>'alert-success',
							'alertIcon'=>'fa fa-check',
							'alertCaption'=>'Success!',
							'alertContent'=>'Menu/ Submenu successfully created.'
						)
					);
				}
				else
				{
					$this->session->set_userdata('lbackend_activity','Menu Update - Success');
					$this->mdl_menu->updateMenuDetails($menuId,$parentId,$updateData);
					$alertData = array(
						array(
							'alertType'=>'alert-success',
							'alertIcon'=>'fa fa-check',
							'alertCaption'=>'Success!',
							'alertContent'=>'Menu successfully updated.'
						)
					);
				}
			}
			else
			{
				if($menuId == 'new')
				{
					//parent
					$menuName = trim($this->input->post('mnuName'));
					$updateData = array('config'=>$menuName);
					$this->mdl_menu->addMenuDetails($menuId,$updateData);
					$this->session->set_userdata('lbackend_activity','Create Menu - Success');
					$alertData = array(
						array(
							'alertType'=>'alert-success',
							'alertIcon'=>'fa fa-check',
							'alertCaption'=>'Success!',
							'alertContent'=>'Menu successfully created.'
						)
					);
				}
				else
				{
					$this->session->set_userdata('lbackend_activity','Menu - Failed ( Unknown Request )');
					$alertData = array(
						array(
							'alertType'=>'alert-danger',
							'alertIcon'=>'fa fa-ban',
							'alertCaption'=>'Error!',
							'alertContent'=>'Unexpected error occured.'
						)
					);
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
		}
		$this->details($menuId,$parentId,array('alertData'=>$alertData));
	}

	private function moveMenu($menuId,$parentId,$direction)
	{
		if(!empty($menuId))
		{
			$this->load->model('mdl_menu');
			$this->mdl_menu->move($menuId,$direction);
		}
		if(empty($parentId))
		{
			$this->index();
		}
		else
		{
			$menuId = $parentId;
			$parentData = $this->mdl_menu->getParent($menuId);
			if(count($parentData) > 0)
			{
				$parentId = $parentData[0]->parent_id;
			}
			else
			{
				$parentId = 0;
			}
			$this->details($menuId,$parentId);
		}
	}

}

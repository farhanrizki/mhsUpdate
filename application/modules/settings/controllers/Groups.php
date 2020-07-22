<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Groups extends CI_Controller {

	public function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		if(!$this->aauth->is_loggedin() ){
            redirect('login');
        }  
	}

	public function index($data = array())
	{
		if($this->aauth->is_allowed('58_menu'))
		{
			$this->session->set_userdata('lbackend_activity','Groups Menu Access - Success');
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
			$this->load->model('mdl_groups');
			$data['groupList'] = $this->mdl_groups->list_groups();
			$content = $this->load->view('groups',$data,TRUE);
			$sideBar = $this->obackend->sidebar(58);
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
	
	public function add($groupId='',$data = array())
	{
		if($this->aauth->is_allowed('group_add'))
		{
			//LOGGING PURPOSE
			$_GET['groupId'] = $groupId;
			//
			$this->session->set_userdata('lbackend_activity','Add Group/ Subgroup Access - Success');
			$cssList = array(
				'link'=>array(
					site_url().'assets/skin/bootstrap/css/bootstrap.min.css',
					site_url().'assets/skin/cloudflare/font-awesome.min.css',
					site_url().'assets/skin/cloudflare/ionicons.min.css',
					site_url().'assets/skin/plugins/select2/select2.min.css',
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
					site_url().'assets/skin/plugins/select2/select2.full.min.js',
					site_url().'assets/skin/plugins/fastclick/fastclick.js',
					site_url().'assets/skin/dist/js/app.min.js',
					site_url().'assets/skin/dist/js/demo.js'
				),
				'script'=>array(
					'
						$(function () {
						    //Initialize Select2 Elements
						    $(".select2").select2();
						  });
					'
					)
			);
			$data['breadcrumb'] = array(
				array(
					'name'=>'Settings',
					'link'=>'#',
					'icon'=>'fa fa-gears'
				),
				array(
					'name'=>'Groups',
					'link'=>site_url('settings/groups')
				)
			);
			$data['breadcrumb'][] = array(
				'name'=>'Add',
				'link'=>'#'
			);
			$permissionData = $this->aauth->list_perms();
			$permissionList = array();
			for($i=0,$n=count($permissionData);$i<$n;$i++)
			{
				$permissionList[$permissionData[$i]->id] = $permissionData[$i]->definition;
			}
			/*$this->load->model('mdl_groups');
			$groupPermission = $this->mdl_groups->groupPermission($groupId);
			$groupPermissionList = array();
			for($i=0,$n=count($groupPermission);$i<$n;$i++)
			{
				$groupPermissionList[] = $groupPermission[$i]->perm_id;
			}*/	
			$data['permissionList'] = $permissionList;
			/*$data['groupPermission'] = $groupPermissionList;*/
			$data['groupPermission'] = array();
			$data['addFlag'] = TRUE;
			if($groupId != '')
			{
				$data['groupId'] = $groupId;
			}
			$content = $this->load->view('groups_crud',$data,TRUE);
			$sideBar = $this->obackend->sidebar(58);
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

	public function details($groupId='', $data = array())
	{
		if($this->aauth->is_allowed('group_common'))
		{
			//LOGGING PURPOSE
			$_GET['groupId'] = $groupId;
			//
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
			$this->load->model('mdl_groups');
			$groupDetails = $this->mdl_groups->groupDetails($groupId);
			
			if(is_array($groupDetails))
			{
				$this->session->set_userdata('lbackend_activity','Group/ Subgroup Details Access - Success');
				$data['breadcrumb'] = array(
					array(
						'name'=>'Settings',
						'link'=>'#',
						'icon'=>'fa fa-gears'
					),
					array(
						'name'=>'Groups',
						'link'=>site_url('settings/groups')
					),
					array(
						'name'=>'Details',
						'link'=>'#'
					)
				);
				$data['groupDetails'] = array(
					'name'=>$groupDetails[0]->name,
					'desc'=>$groupDetails[0]->definition,
					'groupId'=>$groupId
				);
				$subgroupList = $this->aauth->get_subgroups($groupId);
				$cleanSubgroup = array();
				if($subgroupList !== FALSE)
				{
					for($i=0,$n=count($subgroupList);$i<$n;$i++)
					{
						$subgroupDetails = $this->mdl_groups->groupDetails($subgroupList[$i]->subgroup_id);
						$cleanSubgroup[] = array(
								'id'=>$subgroupList[$i]->subgroup_id,
								'name'=>$subgroupDetails[0]->name,
								'definition'=>$subgroupDetails[0]->definition
							);
					}
				}
				$data['groupChild']=$cleanSubgroup;
				$content = $this->load->view('groups_details',$data,TRUE);	
				$sideBar = $this->obackend->sidebar(58);
				$viewData = $this->obackend->full(array('css'=>$cssList,'sidebar'=>$sideBar,'content'=>$content,'js'=>$jsList));
				$activeTemplate = $this->obackend->getActiveTemplate();
				$this->parser->parse($activeTemplate.'template',$viewData);
			}
			else
			{
				$this->session->set_userdata('lbackend_activity','Group/ Subgroup Details Access - Failed ( Not Found )');
				$alertData = array(
					array(
						'alertType'=>'alert-danger',
						'alertIcon'=>'fa fa-ban',
						'alertCaption'=>'Error!',
						'alertContent'=>'Group/ Subgroup data not found.'
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

	public function edit($groupId='')
	{
		if($this->aauth->is_allowed('group_edit'))
		{
			//LOGGING PURPOSE
			$_GET['groupId'] = $groupId;
			//
			if(is_numeric($groupId))
			{
				$this->load->model('mdl_groups');
				$groupData = $this->mdl_groups->groupDetails($groupId);
				if(count($groupData)>0)
				{
					$this->session->set_userdata('lbackend_activity','Edit Group/ Subgroup Access - Success');
					$cssList = array(
						'link'=>array(
							site_url().'assets/skin/bootstrap/css/bootstrap.min.css',
							site_url().'assets/skin/cloudflare/font-awesome.min.css',
							site_url().'assets/skin/cloudflare/ionicons.min.css',
							site_url().'assets/skin/plugins/select2/select2.min.css',
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
							site_url().'assets/skin/plugins/select2/select2.full.min.js',
							site_url().'assets/skin/plugins/slimScroll/jquery.slimscroll.min.js',
							site_url().'assets/skin/plugins/fastclick/fastclick.js',
							site_url().'assets/skin/dist/js/app.min.js',
							site_url().'assets/skin/dist/js/demo.js'
						),
						'script'=>array(
					'
							$(function () {
							    //Initialize Select2 Elements
							    $(".select2").select2();
							  });
						'
						)
					);
					$data['breadcrumb'] = array(
						array(
							'name'=>'Settings',
							'link'=>'#',
							'icon'=>'fa fa-gears'
						),
						array(
							'name'=>'Groups',
							'link'=>site_url('settings/groups')
						)
					);
					$data['breadcrumb'][] = array(
						'name'=>'Edit',
						'link'=>'#'
					);
					
					$data['groupDetails'] = array(
						'groupId'=>$groupId,
						'name'=>$groupData[0]->name,
						'desc'=>$groupData[0]->definition
					);
					$permissionData = $this->aauth->list_perms();
					$permissionList = array();
					for($i=0,$n=count($permissionData);$i<$n;$i++)
					{
						$permissionList[$permissionData[$i]->id] = $permissionData[$i]->definition;
					}
					$this->load->model('mdl_groups');
					$groupPermission = $this->mdl_groups->groupPermission($groupId);
					$groupPermissionList = array();
					for($i=0,$n=count($groupPermission);$i<$n;$i++)
					{
						$groupPermissionList[] = $groupPermission[$i]->perm_id;
					}	
					$data['permissionList'] = $permissionList;
					$data['groupPermission'] = $groupPermissionList;
					$content = $this->load->view('groups_crud',$data,TRUE);
					$sideBar = $this->obackend->sidebar(58);
					$viewData = $this->obackend->full(array('css'=>$cssList,'sidebar'=>$sideBar,'content'=>$content,'js'=>$jsList));
					$activeTemplate = $this->obackend->getActiveTemplate();
					$this->parser->parse($activeTemplate.'template',$viewData);
				}
				else
				{
					$this->session->set_userdata('lbackend_activity','Edit Group/ Subgroup Access - Failed ( Not Found )');
					$alertData = array(
						array(
							'alertType'=>'alert-danger',
							'alertIcon'=>'fa fa-ban',
							'alertCaption'=>'Error!',
							'alertContent'=>'Group/ Subgroup not found.'
						)
					);
					$this->index(array('alertData'=>$alertData));
				}
			}
			else
			{
				$this->session->set_userdata('lbackend_activity','Edit Group/ Subgroup Access - Failed ( Not Numeric )');
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

	public function delete($groupId='')
	{
		if($this->aauth->is_allowed('group_delete'))
		{
			//LOGGING PURPOSE
			$_GET['groupId'] = $groupId;
			//
			if(is_numeric($groupId))
			{
				$this->load->model('mdl_groups');
				//check have subgroup
				if($this->mdl_groups->haveSubgroup($groupId))
				{
					$this->session->set_userdata('lbackend_activity','Delete Group/ Subgroup - Failed ( Have Child )');
					$alertData = array(
						array(
							'alertType'=>'alert-warning',
							'alertIcon'=>'fa fa-warning',
							'alertCaption'=>'Failed!',
							'alertContent'=>'Cannot delete. This group/ subgroup still have subgroup.'
						)
					);
					$this->details($groupId,array('alertData'=>$alertData));
				}
				else
				{
					//get parent
					$parentId = $this->mdl_groups->getParent($groupId);
					$this->aauth->delete_group($groupId);

					if($parentId === FALSE)
					{
						$this->session->set_userdata('lbackend_activity','Delete Group - Success');
						$alertData = array(
							array(
								'alertType'=>'alert-success',
								'alertIcon'=>'fa fa-check',
								'alertCaption'=>'Success!',
								'alertContent'=>'Group Deleted.'
							)
						);
						$this->index(array('alertData'=>$alertData));
					}
					else
					{
						$this->session->set_userdata('lbackend_activity','Delete Subgroup - Success');
						$alertData = array(
							array(
								'alertType'=>'alert-success',
								'alertIcon'=>'fa fa-check',
								'alertCaption'=>'Success!',
								'alertContent'=>'Subgroup Deleted.'
							)
						);
						$this->details($parentId,array('alertData'=>$alertData));
					}
				}
				
			}
			else
			{
				$this->session->set_userdata('lbackend_activity','Delete Group/ Subgroup - Failed ( Not Numeric )');
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

	public function save($groupId='')
	{
		if($this->aauth->is_allowed('group_add') || $this->aauth->is_allowed('group_edit'))
		{
			//LOGGING PURPOSE
			$_GET['groupId'] = $groupId;
			//
			if(is_numeric($groupId))
			{
				$this->load->model('mdl_groups');
				$checkGroups = $this->mdl_groups->groupDetails($groupId);
				if(count($checkGroups) > 0)
				{
					$groupName = trim($this->input->post('gName'));
					$groupDesc = trim($this->input->post('gDesc'));
					$this->aauth->update_group($groupId,$groupName,$groupDesc);
					$groupPermission = $this->input->post('gPermission');
					//purge current permission
					$this->mdl_groups->purgePermission($groupId);
					if(!empty($groupPermission) && is_array($groupPermission))
	                {
	                	for($i=0,$n=count($groupPermission);$i<$n;$i++)
	                	{
	                		$this->aauth->allow_group($groupId,$groupPermission[$i]);
	                	}
	                }
					if($this->mdl_groups->checkSubgroup($groupId))
					{
						$this->session->set_userdata('lbackend_activity','Subgroup Update - Success');
						$alertData = array(
							array(
								'alertType'=>'alert-success',
								'alertIcon'=>'fa fa-check',
								'alertCaption'=>'Success!',
								'alertContent'=>'Subroup data updated.'
							)
						);
						$this->details($groupId,array('alertData'=>$alertData));
					}
					else
					{
						$this->session->set_userdata('lbackend_activity','Group Update - Success');
						$alertData = array(
							array(
								'alertType'=>'alert-success',
								'alertIcon'=>'fa fa-check',
								'alertCaption'=>'Success!',
								'alertContent'=>'Group data updated.'
							)
						);
						$this->index(array('alertData'=>$alertData));	
					}
					
				}
				else
				{
					$this->session->set_userdata('lbackend_activity','Group/ Subgroup Update - Failed ( Not Found )');
					$alertData = array(
						array(
							'alertType'=>'alert-danger',
							'alertIcon'=>'fa fa-ban',
							'alertCaption'=>'Error!',
							'alertContent'=>'Group not found.'
						)
					);
					$this->index(array('alertData'=>$alertData));
				}
			}
			else
			{
				if($groupId == 'new')
				{
					$groupName = trim($this->input->post('gName'));
					$groupDesc = trim($this->input->post('gDesc'));
					$groupParentId = trim($this->input->post('gId'));
					$createGroup = $this->aauth->create_group($groupName,$groupDesc);
					if(!empty($groupParentId))
					{					
						$this->aauth->add_subgroup($groupParentId,$createGroup);
					}
					
					if($createGroup !== FALSE)
					{
						$groupPermission = $this->input->post('gPermission');
						if(!empty($groupPermission) && is_array($groupPermission))
		                {
		                	for($i=0,$n=count($groupPermission);$i<$n;$i++)
		                	{
		                		$this->aauth->allow_group($createGroup,$groupPermission[$i]);
		                	}
		                }

						if(!empty($groupParentId))
						{
							$this->session->set_userdata('lbackend_activity','Create Subgroup - Success');
							$alertData = array(
								array(
									'alertType'=>'alert-success',
									'alertIcon'=>'fa fa-check',
									'alertCaption'=>'Success!',
									'alertContent'=>'Subgroup created!'
								)
							);
							$this->details($groupParentId,array('alertData'=>$alertData));
						}
						else
						{
							$this->session->set_userdata('lbackend_activity','Create Group - Success');
							$alertData = array(
								array(
									'alertType'=>'alert-success',
									'alertIcon'=>'fa fa-check',
									'alertCaption'=>'Success!',
									'alertContent'=>'Group created!'
								)
							);
							$this->index(array('alertData'=>$alertData));	
						}
						
					}
					else
					{
						$this->session->set_userdata('lbackend_activity','Create Group/ Subgroup - Failed ( Exists )');
						$alertData = array(
							array(
								'alertType'=>'alert-warning',
								'alertIcon'=>'fa fa-warning',
								'alertCaption'=>'Failed!',
								'alertContent'=>'Group already exists. Please choose another group name.'
							)
						);
						$this->add('',array('alertData'=>$alertData));
					}
				}
				else
				{
					$this->session->set_userdata('lbackend_activity','Groups - Failed ( Unknown Request )');
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

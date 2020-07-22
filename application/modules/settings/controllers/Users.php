<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		if(!$this->aauth->is_loggedin() ){
            redirect('login');
        }  
	}

	public function index($data = array())
	{
		if($this->aauth->is_allowed(57))
		{
			$this->session->set_userdata('lbackend_activity','Users Menu Access - Success');
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
						    var t = $("#example1").DataTable({
						    	"order": [[ 2, "asc" ]]
						    });

							t.on( \'order.dt search.dt\', function () {
						        t.column(0, {search:\'applied\', order:\'applied\'}).nodes().each( function (cell, i) {
						            cell.innerHTML = i+1;
						        } );
						    } ).draw();
						});
					'
				)
			);
			$this->load->model('mdl_users');
			$cleanUserList = array();
			$userList = $this->aauth->list_users(FALSE,FALSE,FALSE,TRUE);		
			for($i=0,$n=count($userList);$i<$n;$i++)
			{
				if($this->aauth->is_admin($userList[$i]->id) === FALSE)
				{
					$userGroup = $this->aauth->get_user_groups($userList[$i]->id);
					$cleanUserGroup ='';
					for($j=0,$m=count($userGroup);$j<$m;$j++)
					{
						$cleanUserGroup .= $userGroup[$j]->name.',';
					}
					$cleanUserGroup = substr($cleanUserGroup,0,-1);
					$cleanUserList[] = array(
						'id'=>$userList[$i]->id,
						'email'=>$userList[$i]->email,
						'username'=>$userList[$i]->username,
						'group'=>$cleanUserGroup,
						'bannedState'=>$userList[$i]->banned
					);
				}
			}
			$data['userData'] = $cleanUserList;
			$content = $this->load->view('users',$data,TRUE);
			$sideBar = $this->obackend->sidebar(57);
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
	
	public function profile($userId='',$data=array())
	{
		if($this->aauth->is_allowed('user_common'))
		{
			$this->session->set_userdata('lbackend_activity','Profile Access - Success');
			$longBreadcrumb = TRUE;
			if(empty($userId))
			{
				$userId = $this->session->userdata('id');
				$longBreadcrumb = FALSE;
			}
			//LOGGING PURPOSE
			$_GET['userId'] = $userId;
			//
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
					site_url().'assets/skin/plugins/datatables/jquery.dataTables.min.js',
					site_url().'assets/skin/plugins/datatables/dataTables.bootstrap.min.js',
					site_url().'assets/skin/plugins/select2/select2.full.min.js',
					site_url().'assets/skin/plugins/fastclick/fastclick.js',
					site_url().'assets/skin/dist/js/app.min.js',
					site_url().'assets/skin/dist/js/demo.js'
				),
				'script'=>array(
					'
						$(function () {
							$("#userLog").DataTable({
						    	"processing": true,
				                "serverSide": true,
				                "bAutoWidth": false,
				                "stateSave": false,
				                "pagingType": "simple_numbers",
				                "language": {
			                        "infoFiltered": "",
			                        "paginate": {
			                          "previous": "<",
			                          "next": ">"
			                        }
				                },
				                "ajax": {
					                url: "'.site_url("settings/users/userLog/").'",
					                data: function ( d ) {
					                	d.u_i = "'.$userId.'";
					                },
					                error: function (xhr, error, thrown) {
					               		alert("Cannot view log. Error database connection.");
					                }
					            }
						    });
						    //Initialize Select2 Elements
						    $(".select2").select2();

						    $("#showDetails").on("show.bs.modal", function (event) {
							  var button = $(event.relatedTarget) // Button that triggered the modal
							  var logId = button.data("lid") // Extract info from data-* attributes
							  var modal = $(this)
							  $.ajax({
							      url: "'.site_url('settings/users/logDetails').'",
							      data: {
							         lId: logId,
							         uId: '.$userId.'
							      },
							      error: function() {
							      	modal.find(".modal-body").empty();
							      	modal.find(".modal-body").append("<center>An error has occurred</center>");
							      },
							      success: function(data) {
							        modal.find(".modal-body").empty();
							  		modal.find(".modal-body").append(data);
							      },
							      type: "GET"
							   });
							})
						  });
					'
					)
			);
			
			$userData = $this->aauth->get_user($userId);
			$profilePic = $this->aauth->get_user_var('profilePic',$userId);
			if($profilePic === FALSE)
			{
				$profilePic = 'https://www.gravatar.com/avatar/'.md5(strtolower(trim($userData->email))).'?d=identicon';
			}
			else
			{
				$profilePic = site_url().$profilePic;
			}
			$groupData = $this->aauth->list_groups();
			$permissionData = $this->aauth->list_perms();
			$userGroup = $this->aauth->get_user_groups($userId);
			$userGroupList = array();
			for($i=0,$n=count($userGroup);$i<$n;$i++)
			{
				$userGroupList[] = $userGroup[$i]->id;
			}
			$groupList = array();
			for($i=0,$n=count($groupData);$i<$n;$i++)
			{
				$groupList[$groupData[$i]->id] = $groupData[$i]->name;
			}
			$permissionList = array();
			for($i=0,$n=count($permissionData);$i<$n;$i++)
			{
				$permissionList[$permissionData[$i]->id] = $permissionData[$i]->definition;
			}
			$this->load->model('mdl_users');
			$userPermission = $this->mdl_users->userPermission($userId);
			$userPermissionList = array();
			for($i=0,$n=count($userPermission);$i<$n;$i++)
			{
				$userPermissionList[] = $userPermission[$i]->perm_id;
			}	
			$profileData = array(
				'profileId'=>$userId,
				'profilePic'=>$profilePic,
				'profileName'=>$this->aauth->get_user_var('profileName',$userId),
				'profileJob'=>$this->aauth->get_user_var('profileJob',$userId),
				'profileReg'=>date('M. Y',strtotime($this->aauth->get_user_var('profileReg',$userId))),
				'profileEmail'=>$userData->email,
				'profileLink'=>site_url('profile'),
				'groupList'=>$groupList,
				'permissionList'=>$permissionList,
				'userGroup'=>$userGroupList,
				'userPermission'=>$userPermissionList,
				'longBreadcrumb'=>$longBreadcrumb			
			);
			if(isset($data['alertData']))
			{
				$profileData['alertData'] = $data['alertData'];
			}
			$content = $this->load->view('profile',$profileData,TRUE);
			$sideBar = $this->obackend->sidebar(57);
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

	public function add($data = array())
	{
		if($this->aauth->is_allowed('user_add'))
		{
			$this->session->set_userdata('lbackend_activity','User Add Access - Success');
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
			$data['breadcrumb'] = array(
				array(
					'name'=>'Settings',
					'link'=>'#',
					'icon'=>'fa fa-gears'
				),
				array(
					'name'=>'Users',
					'link'=>site_url('settings/users')
				)
			);
			$this->load->model('mdl_menu');
			$data['breadcrumb'][] = array(
				'name'=>'Add',
				'link'=>'#'
			);
			$content = $this->load->view('users_crud',$data,TRUE);
			$sideBar = $this->obackend->sidebar(57);
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

	public function ban($userId='')
	{
		if($this->aauth->is_allowed('user_ban'))
		{
			//LOGGING PURPOSE
			$_GET['userId'] = $userId;
			//
			$checkUser = $this->aauth->get_user($userId);
			if(!empty($userId) && $checkUser !== FALSE)
			{
				if($this->aauth->is_banned($userId) === FALSE)
				{
					$this->aauth->ban_user($userId);
					$this->session->set_userdata('lbackend_activity','Ban - Success');
					$alertData = array(
						array(
							'alertType'=>'alert-success',
							'alertIcon'=>'fa fa-check',
							'alertCaption'=>'Success!',
							'alertContent'=>'User banned.'
						)
					);
				}
				else
				{
					$this->session->set_userdata('lbackend_activity','Ban - Failed ( Banned )');
					$alertData = array(
						array(
							'alertType'=>'alert-danger',
							'alertIcon'=>'fa fa-ban',
							'alertCaption'=>'Error!',
							'alertContent'=>'User already banned.'
						)
					);
				}
			}
			else
			{
				$this->session->set_userdata('lbackend_activity','Ban - Failed ( Not Found )');
				$alertData = array(
					array(
						'alertType'=>'alert-danger',
						'alertIcon'=>'fa fa-ban',
						'alertCaption'=>'Error!',
						'alertContent'=>'User not found.'
					)
				);
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
		$this->index(array('alertData'=>$alertData));
	}

	public function unban($userId='')
	{
		if($this->aauth->is_allowed('user_unban'))
		{
			//LOGGING PURPOSE
			$_GET['userId'] = $userId;
			//
			$checkUser = $this->aauth->get_user($userId);
			if(!empty($userId) && $checkUser !== FALSE)
			{
				if($this->aauth->is_banned($userId) !== FALSE)
				{
					$this->aauth->unban_user($userId);
					$this->session->set_userdata('lbackend_activity','Unban Success');
					$alertData = array(
						array(
							'alertType'=>'alert-success',
							'alertIcon'=>'fa fa-check',
							'alertCaption'=>'Success!',
							'alertContent'=>'User unbanned.'
						)
					);
				}
				else
				{
					$this->session->set_userdata('lbackend_activity','Unban - Failed ( Unbanned )');
					$alertData = array(
						array(
							'alertType'=>'alert-danger',
							'alertIcon'=>'fa fa-ban',
							'alertCaption'=>'Error!',
							'alertContent'=>'User already unbanned.'
						)
					);
				}
			}
			else
			{
				$this->session->set_userdata('lbackend_activity','Unban - Failed ( Not Found )');
				$alertData = array(
					array(
						'alertType'=>'alert-danger',
						'alertIcon'=>'fa fa-ban',
						'alertCaption'=>'Error!',
						'alertContent'=>'User not found.'
					)
				);
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
		$this->index(array('alertData'=>$alertData));
	}

	public function save($type='')
	{
		if($this->aauth->is_allowed('user_add') || $this->aauth->is_allowed('user_edit') || $this->aauth->is_allowed('user_password'))
		{
			$profileId = trim($this->input->post('pId'));
			$checkUser = $this->aauth->get_user($profileId);
			if(!empty($profileId) && $checkUser !== FALSE)
			{
				switch ($type) {
					case 'profile':
						if($this->aauth->is_allowed('user_edit'))
						{
							$profileName = trim($this->input->post('pName'));
							$profileJob = trim($this->input->post('pJob'));
							$profileGroups = $this->input->post('pGroups');
							$profilePermission = $this->input->post('pPermission');
							$this->aauth->set_user_var('profileName',$profileName,$profileId);
							$this->aauth->set_user_var('profileJob',$profileJob,$profileId);
							//upload profile picture if any
							$config['upload_path'] = './assets/profilePicture/';
		                	$config['allowed_types'] = 'gif|jpg|png';
		                	$this->load->library('upload', $config);
			                if ( ! $this->upload->do_upload('userfile'))
			                {
			                		// do nothing on error
			                        //$error = array('error' => $this->upload->display_errors());
			                        //var_dump($error);die();
			                }
			                else
			                {
			                        $data = $this->upload->data();
			                        $profilePic = 'assets/profilePicture/'.$data['file_name'];
			                        $this->aauth->set_user_var('profilePic',$profilePic,$profileId);
			                }
			                $this->load->model('mdl_users');
			                if($this->aauth->is_allowed('user_group'))
			                {
				                //update user groups
				                $this->mdl_users->purgeGroup($profileId);
				                if(!empty($profileGroups) && is_array($profileGroups))
				                {
				                	for($i=0,$n=count($profileGroups);$i<$n;$i++)
				                	{
										$this->aauth->add_member($profileId,$profileGroups[$i]);
				                	}
				                }
				            }
				            if($this->aauth->is_allowed('user_permission'))
				            {
				                //update user permission
				                $this->mdl_users->purgePermission($profileId);
				                if(!empty($profilePermission) && is_array($profilePermission))
				                {
				                	for($i=0,$n=count($profilePermission);$i<$n;$i++)
				                	{
				                		$this->aauth->allow_user($profileId,$profilePermission[$i]);
				                	}
				                }
				            }
				            $this->session->set_userdata('lbackend_activity','Profile Update - Success');
							$alertData = array(
								array(
									'alertType'=>'alert-success',
									'alertIcon'=>'fa fa-check',
									'alertCaption'=>'Success!',
									'alertContent'=>'User details updated.'
								)
							);
						}
						else
						{
							$this->session->set_userdata('lbackend_activity','Profile Update - Failed ( Permission )');
							$alertData = array(
								array(
									'alertType'=>'alert-danger',
									'alertIcon'=>'fa fa-ban',
									'alertCaption'=>'Error!',
									'alertContent'=>'You don\'t have permission to do this.'
								)
							);
						}
						break;
					case 'password':
						if($this->aauth->is_allowed('user_password'))
						{
							$newPassword = trim($this->input->post('pPass'));
							$confNewPassword = trim($this->input->post('cpPass'));
							if(!empty($newPassword) && !empty($confNewPassword) && $newPassword == $confNewPassword)
							{
								$this->aauth->update_user($profileId,FALSE,$newPassword);
								$this->session->set_userdata('lbackend_activity','Password Update - Success');
								$alertData = array(
									array(
										'alertType'=>'alert-success',
										'alertIcon'=>'fa fa-check',
										'alertCaption'=>'Success!',
										'alertContent'=>'Password updated.'
									)
								);
							}
							else
							{
								$this->session->set_userdata('lbackend_activity','Password Update - Failed ( Not Match )');
								$alertData = array(
									array(
										'alertType'=>'alert-warning',
										'alertIcon'=>'fa fa-warning',
										'alertCaption'=>'Failed!',
										'alertContent'=>'Password not match.'
									)
								);	
							}
						}
						else
						{
							$this->session->set_userdata('lbackend_activity','Password Update - Failed ( Permission )');
							$alertData = array(
								array(
									'alertType'=>'alert-danger',
									'alertIcon'=>'fa fa-ban',
									'alertCaption'=>'Error!',
									'alertContent'=>'You don\'t have permission to do this.'
								)
							);
						}
						break;
				}
				$this->profile($profileId,array('alertData'=>$alertData));
			}
			else
			{
				if($type=='new')
				{
					$newUser = trim(str_replace(" ", "", $this->input->post('uName')));
					$newEmail = trim($this->input->post('uEmail'));
					$newPass = trim($this->input->post('uPass'));
					$createUser = $this->aauth->create_user($newEmail,$newPass,$newUser);
					if(is_numeric($createUser))
					{
						$this->session->set_userdata('lbackend_activity','Create User - Success');
						$alertData = array(
							array(
								'alertType'=>'alert-success',
								'alertIcon'=>'fa fa-check',
								'alertCaption'=>'Success!',
								'alertContent'=>'User created.'
							)
						);
						$this->profile($createUser,array('alertData'=>$alertData));
					}
					else
					{
						$this->session->set_userdata('lbackend_activity','Create User - Failed ( Exists )');
						$alertData = array(
							array(
								'alertType'=>'alert-danger',
								'alertIcon'=>'fa fa-ban',
								'alertCaption'=>'Failed!',
								'alertContent'=>'User already exists.'
							)
						);
						$this->add(array('alertData'=>$alertData));
					}
				}
				else
				{
					$this->session->set_userdata('lbackend_activity','Users - Failed ( Unknown Request )');
					$alertData = array(
						array(
							'alertType'=>'alert-danger',
							'alertIcon'=>'fa fa-ban',
							'alertCaption'=>'Error!',
							'alertContent'=>'Unexpected error occured.'
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

	public function userLog()
	{
		if($this->input->is_ajax_request() && $this->aauth->is_allowed('user_log'))
		{
			$this->session->set_userdata('doNotLog','TRUE');
			$request = '';
			$table = '
				users_activity
			';
			$primaryKey = 'ID';
			$columns = array(
				array( 
					'NO', 
					'dt' => 0 ,
					'searchable' => FALSE
				),
				array(
					'db' => 'ACTIVITY',
					'dt' => 1,
				),
				array( 
					'db' => 'URL_SOURCE', 
					'dt' => 2,
					'formatter' => function( $d, $row ) {
						if(strlen($d) > 44)
						{
							return substr($d, 0, 41).' ...';
						}
						else
						{
							return $d;
						}
			            
			        },
				),
				array(
					'db' => 'IP_ADDRESS',
					'dt' => 3,
				),
				array( 
					'db' => 'LOG_DATE', 
					'dt' => 4
				),
				array( 
					'db' => 'ID',
					'dt' => 5,
					'hidden'=>true
				),
				
			);
			
			$a_condition = array();
			$a_condition_type = array(); 
			$a_link = array();
			$a_src = array();
			$a_src_change = array();

			$a_link['Show Details'] = '<a href="#" title="#link_title#" class="#link_class#" data-toggle="modal" data-target="#showDetails" data-lid="#action_lock#"></a>';
			$a_src['Show Details'] = 'fa fa-search';

			//add to ajax columns
			$columns[] = array(
					'action',
					'dt'=>5,
					'condition'=>$a_condition,
					'condition_type'=>$a_condition_type,
					'action_link'=>$a_link,
					'action_src'=>$a_src,
					'action_src_change'=>$a_src_change,
					'action_lock'=>'ID'
				);
			
			// manual ordering at the first page load (server side)
			if($_GET['order'][0]['column'] == 0)
			{
				$_GET['order'][0]['column'] = '4';
				$_GET['order'][0]['dir'] = 'desc';
			}
			
			$custom_where = 'USER_ID = '.$_GET['u_i'];
			//
			echo json_encode(
				SSP::simple( $_GET, $table, $primaryKey, $columns, $custom_where)
			);
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

	public function logDetails()
	{
		$this->session->set_userdata('lbackend_activity','Log Details - Success');
		$logId = trim($this->input->get('lId'));
		$userId = trim($this->input->get('uId'));
		$this->load->model('mdl_users');
		$logDetails = $this->mdl_users->logDetails($userId,$logId);
		if(count($logDetails) > 0)
		{
			$requestData = json_decode($logDetails[0]->REQUEST_DATA,JSON_FORCE_OBJECT);
			$rField = '';
			if (json_last_error() === JSON_ERROR_NONE) {
				$rField = '<center>Request Data</center><dl class="dl-horizontal">';
			  	foreach($requestData as $f=>$v)
			   	{
			   		if(!is_array($v))
			   		{
						$rField .= '<dt>'.$f.'</dt><dd>'.$v.'</dd>';
					}
					else
					{
						$rField .= '<dt>'.$f.'</dt><dd>'.json_encode($v).'</dd>';
					}
			   	}
			   	$rField .= "</dl>";
			}
			else
			{
				$rField = '<center>'.$logDetails[0]->REQUEST_DATA.'</center>';
			}
			$logData = '
			<dl class="dl-horizontal">
				<dt>Activity</dt>
	            <dd>'.$logDetails[0]->ACTIVITY.'</dd>
	            <dt>Log Date</dt>
	            <dd>'.$logDetails[0]->LOG_DATE.'</dd>
	            <dt>IP Address</dt>
	            <dd>'.$logDetails[0]->IP_ADDRESS.'</dd>
	            <dt>Accessed URL</dt>
	            <dd>'.$logDetails[0]->URL_SOURCE.'</dd>
	        </dl>'.$rField;
		}
		else
		{
			$logData ='<center>Data Not Found</center>';
		}
		echo $logData;
	}
}

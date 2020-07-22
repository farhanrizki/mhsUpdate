<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Obackend {

	public $instance;

	public $verNo = '1.0.0';

	public $activeState = array();

	public function __construct() {
		global $instance;
		$this->instance = &get_instance();
		$this->instance->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
	}

	public function full($cOverite=array())
	{
		$pm_list = $this->instance->aauth->list_pms(5,0,$this->instance->session->userdata('id'));
		//var_dump($pm_list);die();
		$unreadPM = $this->instance->aauth->count_unread_pms();
		$messageList = array();
		for($i=0,$n=count($pm_list);$i<$n;$i++)
		{
			$senderImage = $this->instance->aauth->get_user_var('profilePic',$pm_list[$i]->sender_id);
			if($senderImage==FALSE)
			{
				//default picture
				$senderImage = 'assets/skin/dist/img/avatar5.png';
			}
			$messageList[$i]['messageId'] = $pm_list[$i]->id;
			$messageList[$i]['senderImage'] = site_url().$senderImage;
			$messageList[$i]['senderName'] = $this->instance->aauth->get_user_var('profileName',$pm_list[$i]->sender_id);
			$messageList[$i]['messageTitle'] = $pm_list[$i]->title;
			$messageList[$i]['recievedTime'] = $this->time_elapsed_string($pm_list[$i]->date_sent);
		}
		if($unreadPM > 0)
		{
			$allRead = false;
		}
		else
		{
			$allRead = true;
		}
		$messageData = array(
			'allRead'=>$allRead,
			'newMessage'=>$unreadPM,
			'messageLists'=>$messageList
		);

		$notificationData = array(
			'allRead'=>false,
			'newNotification'=>10,
			'notificationLists'=>array(
				array(
					'icon'=>'fa fa-users',
					'textColor'=>'text-aqua',
					'content'=>'5 new members joined today'
				),				
				array(
					'icon'=>'fa fa-warning',
					'textColor'=>'text-yellow',
					'content'=>'Very long description here that may not fit into the page and may cause design problems'
				),
				array(
					'icon'=>'fa fa-users',
					'textColor'=>'text-red',
					'content'=>'5 new members joined'
				),
				array(
					'icon'=>'fa fa-shopping-cart',
					'textColor'=>'text-green',
					'content'=>'25 sales made'
				),
				array(
					'icon'=>'fa fa-user',
					'textColor'=>'text-red',
					'content'=>'You changed your username'
				)
			)
		);
		$taskData = array(
			'allRead'=>false,
			'newTask'=>9,
			'taskLists'=>array(
				array(
					'barColor'=>'progress-bar-aqua',
					'title'=>'Design some buttons',
					'progress'=>'20'
				),				
				array(
					'barColor'=>'progress-bar-green',
					'title'=>'Create a nice theme',
					'progress'=>'40'
				),
				array(
					'barColor'=>'progress-bar-red',
					'title'=>'Some task I need to do',
					'progress'=>'60'
				),
				array(
					'barColor'=>'progress-bar-yellow',
					'title'=>'Make beautiful transitions',
					'progress'=>'80'
				)
			)
		);
		$userData = $this->instance->aauth->get_user();
		$profilePic = $this->instance->aauth->get_user_var('profilePic');
		if($profilePic === FALSE)
		{
			$profilePic = 'https://www.gravatar.com/avatar/'.md5(strtolower(trim($userData->email))).'?d=identicon';
		}
		else
		{
			$profilePic = site_url().$profilePic;
		}
		$profileData = array(
			'profilePic'=>$profilePic,
			'profileName'=>$this->instance->aauth->get_user_var('profileName'),
			'profileJob'=>$this->instance->aauth->get_user_var('profileJob'),
			'profileReg'=>date('M. Y',strtotime($this->instance->aauth->get_user_var('profileReg'))),
			'profileLink'=>site_url('profile')
		);
		/*		
		$menuData = array(
			array(
				'menuHeader'=>'MAIN NAVIGATION',
				'menuList'=>array(
					array(
						'menuName'=>'Dashboard',
						'menuLink'=>'#',
						'menuIcon'=>'fa fa-dashboard',
						'menuNotif'=>'',
						'menuNotifColor'=>'',
						'menuChild'=> array(
							array(
								'menuName'=>'Dashboard v1',
								'menuLink'=>'#',
								'menuIcon'=>'fa fa-circle-o',
								'menuNotif'=>'',
								'menuNotifColor'=>'',
								'menuChild'=>array(),
								'menuActive'=>'active'
							),
							array(
								'menuName'=>'Dashboard v2',
								'menuLink'=>'#',
								'menuIcon'=>'fa fa-circle-o',
								'menuNotif'=>'3',
								'menuNotifColor'=>'bg-red',
								'menuChild'=>array(),
								'menuActive'=>''
							)
						),
						'menuActive'=>'active'
					),
					array(
						'menuName'=>'Layout Options',
						'menuLink'=>'#',
						'menuIcon'=>'fa fa-files-o',
						'showNotif'=>true,
						'menuNotif'=>'4',
						'menuNotifColor'=>'label-primary',
						'menuChild'=> array(
							array(
								'menuName'=>'Top Navigation',
								'menuLink'=>'#',
								'menuIcon'=>'fa fa-circle-o',
								'menuNotif'=>'',
								'menuNotifColor'=>'',
								'menuChild'=>array(),
								'menuActive'=>''
							),
							array(
								'menuName'=>'Boxed',
								'menuLink'=>'#',
								'menuIcon'=>'fa fa-circle-o',
								'menuNotif'=>'',
								'menuNotifColor'=>'',
								'menuChild'=>array(),
								'menuActive'=>''
							),
							array(
								'menuName'=>'Fixed',
								'menuLink'=>'#',
								'menuIcon'=>'fa fa-circle-o',
								'menuNotif'=>'',
								'menuNotifColor'=>'',
								'menuChild'=>array(),
								'menuActive'=>''
							),
							array(
								'menuName'=>'Collapsed Sidebar',
								'menuLink'=>'#',
								'menuIcon'=>'fa fa-circle-o',
								'menuNotif'=>'',
								'menuNotifColor'=>'',
								'menuChild'=>array(),
								'menuActive'=>''
							)
						),
						'menuActive'=>''
					),
					array(
						'menuName'=>'Widgets',
						'menuLink'=>'#',
						'menuIcon'=>'fa fa-th',
						'menuNotif'=>'new',
						'menuNotifColor'=>'bg-green',
						'menuChild'=> array(),
						'menuActive'=>''
					),
					array(
						'menuName'=>'Charts',
						'menuLink'=>'#',
						'menuIcon'=>'fa fa-pie-chart',
						'menuNotif'=>'',
						'menuNotifColor'=>'',
						'menuChild'=> array(
							array(
								'menuName'=>'ChartJS',
								'menuLink'=>'#',
								'menuIcon'=>'fa fa-circle-o',
								'menuNotif'=>'',
								'menuNotifColor'=>'',
								'menuChild'=>array(),
								'menuActive'=>''
							),
							array(
								'menuName'=>'Morris',
								'menuLink'=>'#',
								'menuIcon'=>'fa fa-circle-o',
								'menuNotif'=>'',
								'menuNotifColor'=>'',
								'menuChild'=>array(),
								'menuActive'=>''
							),
							array(
								'menuName'=>'Flot',
								'menuLink'=>'#',
								'menuIcon'=>'fa fa-circle-o',
								'menuNotif'=>'',
								'menuNotifColor'=>'',
								'menuChild'=>array(),
								'menuActive'=>''
							),
							array(
								'menuName'=>'Inline charts',
								'menuLink'=>'#',
								'menuIcon'=>'fa fa-circle-o',
								'menuNotif'=>'',
								'menuNotifColor'=>'',
								'menuChild'=>array(),
								'menuActive'=>''
							)
						),
						'menuActive'=>''
					),
					array(
						'menuName'=>'UI Elements',
						'menuLink'=>'#',
						'menuIcon'=>'fa fa-laptop',
						'menuNotif'=>'',
						'menuNotifColor'=>'',
						'menuChild'=> array(
							array(
								'menuName'=>'General',
								'menuLink'=>'#',
								'menuIcon'=>'fa fa-circle-o',
								'menuNotif'=>'',
								'menuNotifColor'=>'',
								'menuChild'=>array(),
								'menuActive'=>''
							),
							array(
								'menuName'=>'Icons',
								'menuLink'=>'#',
								'menuIcon'=>'fa fa-circle-o',
								'menuNotif'=>'',
								'menuNotifColor'=>'',
								'menuChild'=>array(),
								'menuActive'=>''
							),
							array(
								'menuName'=>'Buttons',
								'menuLink'=>'#',
								'menuIcon'=>'fa fa-circle-o',
								'menuNotif'=>'',
								'menuNotifColor'=>'',
								'menuChild'=>array(),
								'menuActive'=>''
							),
							array(
								'menuName'=>'Sliders',
								'menuLink'=>'#',
								'menuIcon'=>'fa fa-circle-o',
								'menuNotif'=>'',
								'menuNotifColor'=>'',
								'menuChild'=>array(),
								'menuActive'=>''
							),
							array(
								'menuName'=>'Timeline',
								'menuLink'=>'#',
								'menuIcon'=>'fa fa-circle-o',
								'menuNotif'=>'',
								'menuNotifColor'=>'',
								'menuChild'=>array(),
								'menuActive'=>''
							),
							array(
								'menuName'=>'Modals',
								'menuLink'=>'#',
								'menuIcon'=>'fa fa-circle-o',
								'menuNotif'=>'',
								'menuNotifColor'=>'',
								'menuChild'=>array(),
								'menuActive'=>''
							)
						),
						'menuActive'=>''
					),
					array(
						'menuName'=>'Forms',
						'menuLink'=>'#',
						'menuIcon'=>'fa fa-edit',
						'menuNotif'=>'',
						'menuNotifColor'=>'',
						'menuChild'=> array(
							array(
								'menuName'=>'General Elements',
								'menuLink'=>'#',
								'menuIcon'=>'fa fa-circle-o',
								'menuNotif'=>'',
								'menuNotifColor'=>'',
								'menuChild'=>array(),
								'menuActive'=>''
							),
							array(
								'menuName'=>'Advanced Elements',
								'menuLink'=>'#',
								'menuIcon'=>'fa fa-circle-o',
								'menuNotif'=>'',
								'menuNotifColor'=>'',
								'menuChild'=>array(),
								'menuActive'=>''
							),
							array(
								'menuName'=>'Editors',
								'menuLink'=>'#',
								'menuIcon'=>'fa fa-circle-o',
								'menuNotif'=>'',
								'menuNotifColor'=>'',
								'menuChild'=>array(),
								'menuActive'=>''
							)
						),
						'menuActive'=>''
					),
					array(
						'menuName'=>'Tables',
						'menuLink'=>'#',
						'menuIcon'=>'fa fa-table',
						'menuNotif'=>'',
						'menuNotifColor'=>'',
						'menuChild'=> array(
							array(
								'menuName'=>'Simple tables',
								'menuLink'=>'#',
								'menuIcon'=>'fa fa-circle-o',
								'menuNotif'=>'',
								'menuNotifColor'=>'',
								'menuChild'=>array(),
								'menuActive'=>''
							),
							array(
								'menuName'=>'Data tables',
								'menuLink'=>'#',
								'menuIcon'=>'fa fa-circle-o',
								'menuNotif'=>'',
								'menuNotifColor'=>'',
								'menuChild'=>array(),
								'menuActive'=>''
							)
						),
						'menuActive'=>''
					),
					array(
						'menuName'=>'Calendar',
						'menuLink'=>'#',
						'menuIcon'=>'fa fa-calendar',
						'menuNotif'=>'3',
						'menuNotifColor'=>'bg-red',
						'menuChild'=> array(),
						'menuActive'=>''
					),
					array(
						'menuName'=>'Mailbox',
						'menuLink'=>'#',
						'menuIcon'=>'fa fa-envelope',
						'menuNotif'=>'12',
						'menuNotifColor'=>'bg-yellow',
						'menuChild'=> array(),
						'menuActive'=>''
					),
					array(
						'menuName'=>'Examples',
						'menuLink'=>'#',
						'menuIcon'=>'fa fa-folder',
						'menuNotif'=>'',
						'menuNotifColor'=>'',
						'menuChild'=> array(
							array(
								'menuName'=>'Invoice',
								'menuLink'=>'#',
								'menuIcon'=>'fa fa-circle-o',
								'menuNotif'=>'',
								'menuNotifColor'=>'',
								'menuChild'=>array(),
								'menuActive'=>''
							),
							array(
								'menuName'=>'Profile',
								'menuLink'=>'#',
								'menuIcon'=>'fa fa-circle-o',
								'menuNotif'=>'',
								'menuNotifColor'=>'',
								'menuChild'=>array(),
								'menuActive'=>''
							),
							array(
								'menuName'=>'Login',
								'menuLink'=>'#',
								'menuIcon'=>'fa fa-circle-o',
								'menuNotif'=>'',
								'menuNotifColor'=>'',
								'menuChild'=>array(),
								'menuActive'=>''
							),
							array(
								'menuName'=>'Register',
								'menuLink'=>'#',
								'menuIcon'=>'fa fa-circle-o',
								'menuNotif'=>'',
								'menuNotifColor'=>'',
								'menuChild'=>array(),
								'menuActive'=>''
							),
							array(
								'menuName'=>'Lockscreen',
								'menuLink'=>'#',
								'menuIcon'=>'fa fa-circle-o',
								'menuNotif'=>'',
								'menuNotifColor'=>'',
								'menuChild'=>array(),
								'menuActive'=>''
							),
							array(
								'menuName'=>'404 Error',
								'menuLink'=>'#',
								'menuIcon'=>'fa fa-circle-o',
								'menuNotif'=>'',
								'menuNotifColor'=>'',
								'menuChild'=>array(),
								'menuActive'=>''
							),
							array(
								'menuName'=>'500 Error',
								'menuLink'=>'#',
								'menuIcon'=>'fa fa-circle-o',
								'menuNotif'=>'',
								'menuNotifColor'=>'',
								'menuChild'=>array(),
								'menuActive'=>''
							),
							array(
								'menuName'=>'Blank Page',
								'menuLink'=>'#',
								'menuIcon'=>'fa fa-circle-o',
								'menuNotif'=>'',
								'menuNotifColor'=>'',
								'menuChild'=>array(),
								'menuActive'=>''
							),
							array(
								'menuName'=>'Pace Page',
								'menuLink'=>'#',
								'menuIcon'=>'fa fa-circle-o',
								'menuNotif'=>'',
								'menuNotifColor'=>'',
								'menuChild'=>array(),
								'menuActive'=>''
							)
						),
						'menuActive'=>''
					),
					array(
						'menuName'=>'Multilevel',
						'menuLink'=>'#',
						'menuIcon'=>'fa fa-share',
						'menuNotif'=>'',
						'menuNotifColor'=>'',
						'menuChild'=> array(
							array(
								'menuName'=>'Level One',
								'menuLink'=>'#',
								'menuIcon'=>'fa fa-circle-o',
								'menuNotif'=>'',
								'menuNotifColor'=>'',
								'menuChild'=>array(),
								'menuActive'=>''
							),
							array(
								'menuName'=>'Level One',
								'menuLink'=>'#',
								'menuIcon'=>'fa fa-circle-o',
								'menuNotif'=>'',
								'menuNotifColor'=>'',
								'menuChild'=>array(
									array(
										'menuName'=>'Level Two',
										'menuLink'=>'#',
										'menuIcon'=>'fa fa-circle-o',
										'menuNotif'=>'',
										'menuNotifColor'=>'',
										'menuChild'=>array(),
										'menuActive'=>''
									),
									array(
										'menuName'=>'Level Two',
										'menuLink'=>'#',
										'menuIcon'=>'fa fa-circle-o',
										'menuNotif'=>'',
										'menuNotifColor'=>'',
										'menuChild'=>array(
											array(
												'menuName'=>'Level Three',
												'menuLink'=>'#',
												'menuIcon'=>'fa fa-circle-o',
												'menuNotif'=>'',
												'menuNotifColor'=>'',
												'menuChild'=>array(),
												'menuActive'=>''
											),
											array(
												'menuName'=>'Level Three',
												'menuLink'=>'#',
												'menuIcon'=>'fa fa-circle-o',
												'menuNotif'=>'',
												'menuNotifColor'=>'',
												'menuChild'=>array(),
												'menuActive'=>''
											)
										),
										'menuActive'=>''
									)
								),
								'menuActive'=>''
							),
							array(
								'menuName'=>'Level One',
								'menuLink'=>'#',
								'menuIcon'=>'fa fa-circle-o',
								'menuNotif'=>'',
								'menuNotifColor'=>'',
								'menuChild'=>array(),
								'menuActive'=>''
							)
						),
						'menuActive'=>''
					),
					array(
						'menuName'=>'Documentation',
						'menuLink'=>'#',
						'menuIcon'=>'fa fa-book',
						'menuNotif'=>'',
						'menuNotifColor'=>'',
						'menuChild'=> array(),
						'menuActive'=>''
					)
				)
			),
			array(
				'menuHeader'=>'LABELS',
				'menuList'=>array(
					array(
						'menuName'=>'Important',
						'menuLink'=>'#',
						'menuIcon'=>'fa fa-circle-o text-red',
						'menuNotif'=>'',
						'menuNotifColor'=>'',
						'menuChild'=> array(),
						'menuActive'=>''
					),
					array(
						'menuName'=>'Warning',
						'menuLink'=>'#',
						'menuIcon'=>'fa fa-circle-o text-yellow',
						'menuNotif'=>'',
						'menuNotifColor'=>'',
						'menuChild'=> array(),
						'menuActive'=>''
					),
					array(
						'menuName'=>'Information',
						'menuLink'=>'#',
						'menuIcon'=>'fa fa-circle-o text-aqua',
						'menuNotif'=>'',
						'menuNotifColor'=>'',
						'menuChild'=> array(),
						'menuActive'=>''
					)
				)
			)
		);
		$sidebarData = array(
			'profileData'=>$profileData,
			'showSearch'=>false,
			'menuData'=>$menuData	
		);
		*/
		if(isset($cOverite['css']))
		{
			$cssList = $cOverite['css'];
		}
		else
		{
			$cssList = array(
				'link'=>array(
					site_url().'assets/skin/bootstrap/css/bootstrap.min.css',
					'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css',
					'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
					site_url().'assets/skin/dist/css/AdminLTE.min.css',
					site_url().'assets/skin/dist/css/skins/_all-skins.min.css',
					site_url().'assets/skin/plugins/iCheck/flat/blue.css',
					site_url().'assets/skin/plugins/morris/morris.css',
					site_url().'assets/skin/plugins/jvectormap/jquery-jvectormap-1.2.2.css',
					site_url().'assets/skin/plugins/datepicker/datepicker3.css',
					site_url().'assets/skin/plugins/daterangepicker/daterangepicker-bs3.css',
					site_url().'assets/skin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'
				),
				'script'=>array()
			);
		}
		$cssData = '';
		for($i=0,$n=count($cssList['link']);$i<$n;$i++)
		{
			$cssData .= '<link rel="stylesheet" href="'.$cssList['link'][$i].'">'."\n";
		}
		for($i=0,$n=count($cssList['script']);$i<$n;$i++)
		{
			$cssData .= '<style>'.$cssList['script'][$i].'</style>';	
		}

		if(isset($cOverite['js']))
		{
			$jsList = $cOverite['js'];
			//add quick read pop up window
			$jsList['script'][] = '
				$(function () {
					$("#quickRead").on("show.bs.modal", function (event) {
					  var button = $(event.relatedTarget) // Button that triggered the modal
					  var messageId = button.data("mid") // Extract info from data-* attributes
					  var modal = $(this)
					  $.ajax({
					      url: "'.site_url('message/box').'",
					      data: {
					         pId: messageId,
					         uId: '.$this->instance->session->userdata('id').',
					         boxType: \'read\'
					      },
					      error: function() {
					      	modal.find(".modal-body").empty();
					      	modal.find(".modal-body").append("<center>An error has occurred</center>");
					      },
					      success: function(data) {
					      	var modalData = JSON.parse(data);
					      	if(modalData[\'pmUnread\'] > 0)
					        {
					        	if(modalData[\'pmUnread\'] == 1)
					        	{
					        		$(".unreadMessageCountLong").empty().append("1 new message");
					        	}
					        	else
					        	{
					        		$(".unreadMessageCountLong").empty().append(modalData[\'pmUnread\'] + " new messages");
					        	}
					        	$(".unreadMessageCount").show();
					        }
					        else
					        {
					        	$(".unreadMessageCount").hide();
					        	$(".unreadMessageCountLong").empty().append("No new message");
					        }
					      	modal.find(".message-modal-title").empty().append(modalData[\'pmData\'].title);
					      	modal.find(".message-modal-sender").empty().append(modalData[\'pmData\'].senderName);
					        modal.find(".message-modal-body").empty().append(modalData[\'pmData\'].message);
					      },
					      type: "GET"
					   });
					});
				});
			';
		}
		else
		{
			$jsList = array(
				'link'=>array(
					site_url().'assets/skin/plugins/jQuery/jQuery-2.2.0.min.js',
					'https://code.jquery.com/ui/1.11.4/jquery-ui.min.js',
					site_url().'assets/skin/bootstrap/js/bootstrap.min.js',
					'https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js',
					site_url().'assets/skin/plugins/morris/morris.min.js',
					site_url().'assets/skin/plugins/sparkline/jquery.sparkline.min.js',
					site_url().'assets/skin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
					site_url().'assets/skin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
					site_url().'assets/skin/plugins/knob/jquery.knob.js',
					'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js',
					site_url().'assets/skin/plugins/daterangepicker/daterangepicker.js',
					site_url().'assets/skin/plugins/datepicker/bootstrap-datepicker.js',
					site_url().'assets/skin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
					site_url().'assets/skin/plugins/slimScroll/jquery.slimscroll.min.js',
					site_url().'assets/skin/plugins/fastclick/fastclick.js',
					site_url().'assets/skin/dist/js/app.min.js',
					site_url().'assets/skin/dist/js/pages/dashboard.js',
					site_url().'assets/skin/dist/js/demo.js'
				),
				'script'=>array(
					"$.widget.bridge('uibutton', $.ui.button);"
				)
			);
		}
		$jsData = '';
		for($i=0,$n=count($jsList['link']);$i<$n;$i++)
		{
			$jsData .= '<script src="'.$jsList['link'][$i].'"></script>';
		}
		for($i=0,$n=count($jsList['script']);$i<$n;$i++)
		{
			$jsData .= '<script>'.$jsList['script'][$i].'</script>';	
		}
		$message = $this->instance->load->view('default/message',$messageData,TRUE);
		$notification = $this->instance->load->view('default/notification',$notificationData,TRUE);
		$task = $this->instance->load->view('default/task',$taskData,TRUE);
		$profile = $this->instance->load->view('default/profile',$profileData,TRUE);
		//$sideBar = $this->instance->load->view('sidebar',$sidebarData,TRUE);
		if(isset($cOverite['sidebar']))
		{
			$sideBar = $cOverite['sidebar'];
		}
		else
		{
			$sideBar = $this->sidebar();
		}
		$controlSidebar = $this->instance->load->view('default/control_sidebar',array(),TRUE);
		if(isset($cOverite['content']))
		{
			$content = $cOverite['content'];
			//add modal message
			$content .= '
				<div class="modal fade" id="quickRead" tabindex="-2" role="dialog" aria-labelledby="quickReadLabel">
					<div class="modal-dialog" role="document">
					  <div class="modal-content">
					    <div class="modal-header">
					      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					        <span aria-hidden="true">&times;</span></button>
					      <h4 class="message-modal-title modal-title">Message Details</h4>
					      <h6 class="message-modal-sender"></h6>
					    </div>
					    <div class="message-modal-body modal-body">
					      
					    </div>
					    <div class="modal-footer">
					      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
					      <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
					    </div>
					  </div>
					  <!-- /.modal-content -->
					</div>
				</div>';
		}
		else
		{
			$content = $this->instance->load->view('default/defaultPage',array(),TRUE);
		}
		if(isset($cOverite['layout']))
		{
			$layoutData = $cOverite['layout'];
		}
		else
		{
			$layoutData = '';
		}
		
		$viewData = array(
			'layout'=>$layoutData,
			'css'=>$cssData,
			'sidebar'=>$sideBar,
			'controlSidebar'=>$controlSidebar,
			'content'=>$content,
			'message'=>$message,
			'notification'=>$notification,
			'task'=>$task,
			'profile'=>$profile,
			'versionNumber'=>$this->verNo,
			'js'=>$jsData
		);
		return $viewData;
	}

	public function sidebar($menuId = 0)
	{
		$userData = $this->instance->aauth->get_user();
		$profilePic = $this->instance->aauth->get_user_var('profilePic');
		if($profilePic === FALSE)
		{
			$profilePic = 'https://www.gravatar.com/avatar/'.md5(strtolower(trim($userData->email))).'?d=identicon';
		}
		else
		{
			$profilePic = site_url().$profilePic;
		}
		$profileData = array(
			'profilePic'=>$profilePic,
			'profileName'=>$this->instance->aauth->get_user_var('profileName'),
			'profileJob'=>$this->instance->aauth->get_user_var('profileJob'),
			'profileReg'=>date('M. Y',strtotime($this->instance->aauth->get_user_var('profileReg'))),
			'profileLink'=>site_url('profile')
		);	
		
		$rawMenu = $this->instance->db->select('*')->where('parent_id',0)->order_by('order','asc')->get('backendMenu')->result();
		for($i=0,$n=count($rawMenu);$i<$n;$i++)
		{
			$showHeader = FALSE;
			$menuData[$i]['menuHeader'] = $rawMenu[$i]->config;
			$rawLevel_1 = $this->instance->db->select('*')->where('parent_id',$rawMenu[$i]->id)->order_by('order','asc')->get('backendMenu')->result();
			if(count($rawLevel_1)>0)
			{
				for($j=0,$m=count($rawLevel_1);$j<$m;$j++)
				{
					$showHeaderLevel_1 = FALSE;
					$menuData[$i]['menuList'][$j]=json_decode($rawLevel_1[$j]->config,TRUE);
					$rawLevel_2 = $this->instance->db->select('*')->where('parent_id',$rawLevel_1[$j]->id)->order_by('order','asc')->get('backendMenu')->result();
					if(count($rawLevel_2)>0)
					{
						for($k=0,$o=count($rawLevel_2);$k<$o;$k++)
						{
							$showHeaderLevel_2 = FALSE;
							$menuData[$i]['menuList'][$j]['menuChild'][$k] = json_decode($rawLevel_2[$k]->config,TRUE);
							$rawLevel_3 = $this->instance->db->select('*')->where('parent_id',$rawLevel_2[$k]->id)->order_by('order','asc')->get('backendMenu')->result();
							if(count($rawLevel_3) > 0)
							{
								for($l=0,$p=count($rawLevel_3);$l<$p;$l++)
								{
									$showHeaderLevel_3 = FALSE;
									$menuData[$i]['menuList'][$j]['menuChild'][$k]['menuChild'][$l] = json_decode($rawLevel_3[$l]->config,TRUE);
									$rawLevel_4 = $this->instance->db->select('*')->where('parent_id',$rawLevel_3[$l]->id)->order_by('order','asc')->get('backendMenu')->result();
									if(count($rawLevel_4)>0)
									{
										for($x=0,$y=count($rawLevel_4);$x<$y;$x++)
										{
											$showHeaderLevel_4 = FALSE;
											$menuData[$i]['menuList'][$j]['menuChild'][$k]['menuChild'][$l]['menuChild'][$x] = json_decode($rawLevel_4[$x]->config,TRUE);
											$menuData[$i]['menuList'][$j]['menuChild'][$k]['menuChild'][$l]['menuChild'][$x]['menuChild'] = array();
											if($this->instance->aauth->is_allowed($rawLevel_4[$x]->id."_menu"))
											{
												$showHeaderLevel_3 = TRUE;
												$showHeaderLevel_4 = TRUE;
											}
											$menuData[$i]['menuList'][$j]['menuChild'][$k]['menuChild'][$l]['menuChild'][$x]['menuVisible'] = $showHeaderLevel_4;
										}
									}
									else
									{
										$menuData[$i]['menuList'][$j]['menuChild'][$k]['menuChild'][$l]['menuChild'] = array();			
									}
									if($this->instance->aauth->is_allowed($rawLevel_3[$l]->id."_menu") || $showHeaderLevel_3)
									{
										$showHeaderLevel_2 = TRUE;
										$showHeaderLevel_3 = TRUE;
									}
									$menuData[$i]['menuList'][$j]['menuChild'][$k]['menuChild'][$l]['menuVisible'] = $showHeaderLevel_3;
								}
							}
							else
							{
								$menuData[$i]['menuList'][$j]['menuChild'][$k]['menuChild'] = array();
							}
							if($this->instance->aauth->is_allowed($rawLevel_2[$k]->id."_menu") || $showHeaderLevel_2)
							{
								$showHeaderLevel_1 = TRUE;
								$showHeaderLevel_2 = TRUE;
							}
							$menuData[$i]['menuList'][$j]['menuChild'][$k]['menuVisible'] = $showHeaderLevel_2;
						}
					}
					else
					{
						$menuData[$i]['menuList'][$j]['menuChild'] = array();
					}
					if($this->instance->aauth->is_allowed($rawLevel_1[$j]->id."_menu") || $showHeaderLevel_1)
					{
						$showHeader = TRUE;
						$showHeaderLevel_1 = TRUE;
					}
					$menuData[$i]['menuList'][$j]['menuVisible'] = $showHeaderLevel_1;
				}
			}
			$menuData[$i]['menuVisible'] = $showHeader;
		}
		$menuData = $this->setActive($menuData,$menuId);
		$sidebarData = array(
			'profileData'=>$profileData,
			'showSearch'=>false,
			'menuData'=>$menuData	
		);
		$sideBar = $this->instance->load->view('default/sidebar',$sidebarData,TRUE);
		return $sideBar;
	}

	public function getActiveTemplate()
	{
		$activeTemplate = $this->instance->aauth->get_user_var('activeTemplate');
		if($activeTemplate == FALSE)
		{
			$activeTemplate = 'default/';
			$this->instance->aauth->set_user_var('activeTemplate',$activeTemplate);
		}
		return $activeTemplate;
	}

	function getActiveState($menuId)
	{
		$get_parent = $this->instance->db->select('*')->where('id',$menuId)->get('backendMenu')->result();
		if(count($get_parent) > 0)
		{
			$this->activeState[] = $get_parent[0]->order;
			$this->getActiveState($get_parent[0]->parent_id);
		}
		else
		{
			return false;
		}
	}

	function setActive($menuData,$menuId)
	{
		$this->activeState = array();
		$this->activeState[] = $menuId;
		$this->getActiveState($menuId);
		//var_dump($this->activeState);die();
		$maxLevel = count($this->activeState);
		switch($maxLevel)
		{
			case '3':
				$i = $this->activeState[$maxLevel-1];
				$j = $this->activeState[$maxLevel-2];
				$menuData[$i]['menuList'][$j]['menuActive'] = 'active';
				break;
			case '4':
				$i = $this->activeState[$maxLevel-1];
				$j = $this->activeState[$maxLevel-2];
				$k = $this->activeState[$maxLevel-3];
				$menuData[$i]['menuList'][$j]['menuActive'] = 'active';
				$menuData[$i]['menuList'][$j]['menuChild'][$k]['menuActive'] = 'active';
				break;
			case '5':
				$i = $this->activeState[$maxLevel-1];
				$j = $this->activeState[$maxLevel-2];
				$k = $this->activeState[$maxLevel-3];
				$l = $this->activeState[$maxLevel-4];
				$menuData[$i]['menuList'][$j]['menuActive'] = 'active';
				$menuData[$i]['menuList'][$j]['menuChild'][$k]['menuActive'] = 'active';
				$menuData[$i]['menuList'][$j]['menuChild'][$k]['menuChild'][$l]['menuActive'] = 'active';
				break;
			case '6':
				$i = $this->activeState[$maxLevel-1];
				$j = $this->activeState[$maxLevel-2];
				$k = $this->activeState[$maxLevel-3];
				$l = $this->activeState[$maxLevel-4];
				$x = $this->activeState[$maxLevel-5];
				$menuData[$i]['menuList'][$j]['menuActive'] = 'active';
				$menuData[$i]['menuList'][$j]['menuChild'][$k]['menuActive'] = 'active';
				$menuData[$i]['menuList'][$j]['menuChild'][$k]['menuChild'][$l]['menuActive'] = 'active';
				$menuData[$i]['menuList'][$j]['menuChild'][$k]['menuChild'][$l]['menuChild'][$x]['menuActive'] = 'active';
				break;
		}
		//print_r($menuData);die();
		return $menuData;
	}

	function time_elapsed_string($datetime, $full = false) {
	    $now = new DateTime;
	    $ago = new DateTime($datetime);
	    $diff = $now->diff($ago);

	    $diff->w = floor($diff->d / 7);
	    $diff->d -= $diff->w * 7;

	    $string = array(
	        'y' => 'year',
	        'm' => 'month',
	        'w' => 'week',
	        'd' => 'day',
	        'h' => 'hour',
	        'i' => 'min',
	        's' => 'sec',
	    );
	    foreach ($string as $k => &$v) {
	        if ($diff->$k) {
	            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
	        } else {
	            unset($string[$k]);
	        }
	    }

	    if (!$full) $string = array_slice($string, 0, 1);
	    return $string ? implode(', ', $string) . ' ago' : 'just now';
	}
}

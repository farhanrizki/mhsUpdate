<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller {


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
				site_url().'assets/skin/plugins/select2/select2.min.css',
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
				site_url().'assets/skin/plugins/select2/select2.full.min.js',
				site_url().'assets/skin/plugins/fastclick/fastclick.js',
				site_url().'assets/skin/dist/js/app.min.js',
				site_url().'assets/skin/plugins/iCheck/icheck.min.js',
				site_url().'assets/skin/dist/js/demo.js',
				site_url().'assets/skin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'
				
			),
			'script'=>array(
				'
					var activeMailNav = "inbox";
					var listOffset = 0;
					var selectedMessage = [];
					$(function () {
						$("#loadingState,#readingView,#composeView,#composeControls").hide();
						$("#pmContent").wysihtml5();
						$(".select2").select2();

					    //Enable iCheck plugin for checkboxes
					    //iCheck for checkbox and radio inputs
					    $(\'.mailbox-messages input[type="checkbox"]\').iCheck({
					      checkboxClass: \'icheckbox_flat-blue\',
					      radioClass: \'iradio_flat-blue\'
					    });

						$(\'#boxContent\').on("ifChecked",function(event){
							selectedMessage.push(event.target.value);
						});

						$(\'#boxContent\').on("ifUnchecked",function(event){
							var getIndex = selectedMessage.indexOf(event.target.value);
							selectedMessage.splice(getIndex, 1);
						});

					    //Enable check and uncheck all functionality
					    $(".checkbox-toggle").click(function () {
					      var clicks = $(this).data(\'clicks\');
					      if (clicks) {
					        //Uncheck all checkboxes
					        $(".mailbox-messages input[type=\'checkbox\']").iCheck("uncheck");
					        $(".fa", this).removeClass("fa-check-square-o").addClass(\'fa-square-o\');
					        selectedMessage = [];
					      } else {
					        //Check all checkboxes
					        $(".mailbox-messages input[type=\'checkbox\']").iCheck("check");
					        $(".fa", this).removeClass("fa-square-o").addClass(\'fa-check-square-o\');
					        $(".mailbox-messages input[type=\'checkbox\']").each(function(){
							    selectedMessage.push($(this).val());
							});
					      }
					      $(this).data("clicks", !clicks);
					    });

						//Compose
						$("#compose").on("click",function(){
							$("#loadingState").show();
							$(".nextPage,.prevPage,.refreshBox,.deleteBox,.checkbox-toggle,.has-feedback").hide();
							$("#mailboxTitle").empty().append("Compose");
							$("#boxContent").empty();
							$(".box-footer").removeClass("no-padding");
							$("#composeView,#composeControls").show();
					      	$("#loadingState").hide();
						});
						
						
						//Discard 
						$("#discardMessage").on("click",function(){
							$("#mailNav li[id=inbox]").trigger("click");
						});

						//Send
						$("#sendMessage").on("click",function(){
							var mTitle = $("#pmTitle").val();
							var mDest = $("#pmDest").val();
							var mContent = window.btoa($("#pmContent").val());
							//show loading
							$("#loadingState").show();
							$.ajax({
						      url: "'.site_url('message/send').'",
						      data: {
						         mTitle: mTitle,
						         mDest: mDest,
						         mContent: mContent,
						         uId: '.$this->session->userdata('id').'
						      },
						      error: function() {
						      	$("#boxContent").empty();
						      	$("#boxContent").append("<center><h1>An error has occurred</h1></center>");
						      	$("#loadingState").hide();
						      },
						      success: function(data) {
						      	$("#loadingState").hide();
						      	$("#mailNav li[id=inbox]").trigger("click");
						      },
						      type: "POST"
						   });
						});
						
						//Handle mailbox navigation
						$("#mailNav li").on("click",function(){
							$(".nextPage,.prevPage,.refreshBox,.deleteBox,.checkbox-toggle,.has-feedback").show();
							$("#readingView").hide();
							$("#composeView,#composeControls").hide();
							$("#messageList").show();
							$(".box-footer").addClass("no-padding");
							//get id
							var currentNav = $(this).attr("id");
							if(currentNav != activeMailNav)
							{
								//remove current active nav
								$("#"+activeMailNav).removeClass("active");
								//set active nav
								$("#"+currentNav).addClass("active");
								activeMailNav = currentNav;
								$("#mailboxTitle").empty().append(activeMailNav.charAt(0).toUpperCase() + activeMailNav.slice(1));
								listOffset = 0;
							}
							//show loading
							$("#loadingState").show();
							//load data using ajax 
							$.ajax({
							      url: "'.site_url('message/box').'",
							      data: {
							         boxType: activeMailNav,
							         uId: '.$this->session->userdata('id').',
							         offset: listOffset
							      },
							      error: function() {
							      	$("#boxContent").empty();
							      	$("#boxContent").append("<center><h1>An error has occurred</h1></center>");
							      	$("#loadingState").hide();
							      },
							      success: function(data) {
							      	$("#loadingState").hide();
							        $("#boxContent").empty();
							        boxData = JSON.parse(data);
							        var newContent = "";
							        $(".unreadMessageCount").empty().append(boxData[\'pmUnread\']);
							        if(boxData[\'pmUnread\'] > 0)
							        {
							        	if(boxData[\'pmUnread\'] == 1)
							        	{
							        		$(".unreadMessageCountLong").empty().append("1 new message");
							        	}
							        	else
							        	{
							        		$(".unreadMessageCountLong").empty().append(boxData[\'pmUnread\'] + " new messages");
							        	}
							        	$(".unreadMessageCount").show();
							        }
							        else
							        {
							        	$(".unreadMessageCount").hide();
							        	$(".unreadMessageCountLong").empty().append("No new message");
							        }
							        if(boxData[\'pmData\'].length > 0)
							        {
								        for(var i = 0, n =boxData[\'pmData\'].length; i<n; i++)
								        {
								        	if(boxData[\'pmData\'][i].date_read == null)
								        	{
								        		readState = "";
								        	}
								        	else
								        	{
								        		readState = "mailbox-read-time";
								        	}
								        	newContent += \'<tr>\' + 
							                  \' <td><input type="checkbox" value="\' + boxData[\'pmData\'][i].id +\'"></td> \' + 
							                  \' <td class="mailbox-name"><a href="javascript:read(\' + boxData[\'pmData\'][i].id + \')">\' + boxData[\'pmData\'][i].senderName +\'</a></td>\' + 
							                  \' <td class="mailbox-subject \' + readState + \'"><a href="javascript:read(\' + boxData[\'pmData\'][i].id + \')" style="text-decoration:inherit; color:inherit;"><b>\' + boxData[\'pmData\'][i].title +\'</b> - \' + boxData[\'pmData\'][i].message +
							                  \' </a></td> \' + 
							                  \' <td class="mailbox-attachment"></td>\' + 
							                  \' <td class="mailbox-date">\' + boxData[\'pmData\'][i].recieveTime +\'</td>\' + 
							                \' </tr>\';
								        }
								    }
								    else
								    {
								    	newContent = "<center><h1>No Data</h1></center>";
								    }
							  		$("#boxContent").append(newContent);
							  		$(\'.mailbox-messages input[type="checkbox"]\').iCheck({
								      checkboxClass: \'icheckbox_flat-blue\',
								      radioClass: \'iradio_flat-blue\'
								    });
							      },
							      type: "GET"
							   });
							//end load ajax
						});

						$(".nextPage").on("click", function(){
							listOffset++;
							$("#mailboxTitle").empty().append(activeMailNav.charAt(0).toUpperCase() + activeMailNav.slice(1));
							//show loading
							$("#loadingState").show();
							//load data using ajax 
							$.ajax({
							      url: "'.site_url('message/box').'",
							      data: {
							         boxType: activeMailNav,
							         uId: '.$this->session->userdata('id').',
							         offset: listOffset
							      },
							      error: function() {
							      	$("#boxContent").empty();
							      	$("#boxContent").append("<center><h1>An error has occurred</h1></center>");
							      	$("#loadingState").hide();
							      },
							      success: function(data) {
							      	$("#loadingState").hide();
							        $("#boxContent").empty();
							        boxData = JSON.parse(data);
							        var newContent = "";
							        listOffset = boxData[\'offset\'];
							        $(".unreadMessageCount").empty().append(boxData[\'pmUnread\']);
							        if(boxData[\'pmUnread\'] > 0)
							        {
							        	if(boxData[\'pmUnread\'] == 1)
							        	{
							        		$(".unreadMessageCountLong").empty().append("1 new message");
							        	}
							        	else
							        	{
							        		$(".unreadMessageCountLong").empty().append(boxData[\'pmUnread\'] + " new messages");
							        	}
							        	$(".unreadMessageCount").show();
							        }
							        else
							        {
							        	$(".unreadMessageCount").hide();
							        	$(".unreadMessageCountLong").empty().append("No new message");
							        }
							        for(var i = 0, n =boxData[\'pmData\'].length; i<n; i++)
							        {
							        	if(boxData[\'pmData\'][i].date_read == null)
							        	{
							        		readState = "";
							        	}
							        	else
							        	{
							        		readState = "mailbox-read-time";
							        	}
							        	newContent += \'<tr>\' + 
						                  \' <td><input type="checkbox" value="\' + boxData[\'pmData\'][i].id +\'"></td> \' + 
						                  \' <td class="mailbox-name"><a href="javascript:read(\' + boxData[\'pmData\'][i].id + \')">\' + boxData[\'pmData\'][i].senderName +\'</a></td>\' + 
						                  \' <td class="mailbox-subject \' + readState + \'"><a href="javascript:read(\' + boxData[\'pmData\'][i].id + \')" style="text-decoration:inherit; color:inherit;"><b>\' + boxData[\'pmData\'][i].title +\'</b> - \' + boxData[\'pmData\'][i].message +
						                  \' </a></td> \' + 
						                  \' <td class="mailbox-attachment"></td>\' + 
						                  \' <td class="mailbox-date">\' + boxData[\'pmData\'][i].recieveTime +\'</td>\' + 
						                \' </tr>\';
							        }
							  		$("#boxContent").append(newContent);
							  		$(\'.mailbox-messages input[type="checkbox"]\').iCheck({
								      checkboxClass: \'icheckbox_flat-blue\',
								      radioClass: \'iradio_flat-blue\'
								    });
							      },
							      type: "GET"
							   });
						});

						$(".prevPage").on("click", function(){
							listOffset--;
							if(listOffset < 0 )
							{
								listOffset = 0;
							}
							$("#mailboxTitle").empty().append(activeMailNav.charAt(0).toUpperCase() + activeMailNav.slice(1));
							//show loading
							$("#loadingState").show();
							//load data using ajax 
							$.ajax({
							      url: "'.site_url('message/box').'",
							      data: {
							         boxType: activeMailNav,
							         uId: '.$this->session->userdata('id').',
							         offset: listOffset
							      },
							      error: function() {
							      	$("#boxContent").empty();
							      	$("#boxContent").append("<center><h1>An error has occurred</h1></center>");
							      	$("#loadingState").hide();
							      },
							      success: function(data) {
							      	$("#loadingState").hide();
							        $("#boxContent").empty();
							        boxData = JSON.parse(data);
							        var newContent = "";
							        listOffset = boxData[\'offset\'];
							        $(".unreadMessageCount").empty().append(boxData[\'pmUnread\']);
							        if(boxData[\'pmUnread\'] > 0)
							        {
							        	if(boxData[\'pmUnread\'] == 1)
							        	{
							        		$(".unreadMessageCountLong").empty().append("1 new message");
							        	}
							        	else
							        	{
							        		$(".unreadMessageCountLong").empty().append(boxData[\'pmUnread\'] + " new messages");
							        	}
							        	$(".unreadMessageCount").show();
							        }
							        else
							        {
							        	$(".unreadMessageCount").hide();
							        	$(".unreadMessageCountLong").empty().append("No new message");
							        }
							        for(var i = 0, n =boxData[\'pmData\'].length; i<n; i++)
							        {
							        	if(boxData[\'pmData\'][i].date_read == null)
							        	{
							        		readState = "";
							        	}
							        	else
							        	{
							        		readState = "mailbox-read-time";
							        	}
							        	newContent += \'<tr>\' + 
						                  \' <td><input type="checkbox" value="\' + boxData[\'pmData\'][i].id +\'"></td> \' + 
						                  \' <td class="mailbox-name"><a href="javascript:read(\' + boxData[\'pmData\'][i].id + \')">\' + boxData[\'pmData\'][i].senderName +\'</a></td>\' + 
						                  \' <td class="mailbox-subject \' + readState + \'"><a href="javascript:read(\' + boxData[\'pmData\'][i].id + \')" style="text-decoration:inherit; color:inherit;"><b>\' + boxData[\'pmData\'][i].title +\'</b> - \' + boxData[\'pmData\'][i].message +
						                  \' </a></td> \' + 
						                  \' <td class="mailbox-attachment"></td>\' + 
						                  \' <td class="mailbox-date">\' + boxData[\'pmData\'][i].recieveTime +\'</td>\' + 
						                \' </tr>\';
							        }
							  		$("#boxContent").append(newContent);
							  		$(\'.mailbox-messages input[type="checkbox"]\').iCheck({
								      checkboxClass: \'icheckbox_flat-blue\',
								      radioClass: \'iradio_flat-blue\'
								    });
							      },
							      type: "GET"
							   });
						});

						$(".refreshBox").on("click", function(){
							//show loading
							$("#loadingState").show();
							//load data using ajax 
							$.ajax({
							      url: "'.site_url('message/box').'",
							      data: {
							         boxType: activeMailNav,
							         uId: '.$this->session->userdata('id').',
							         offset: listOffset
							      },
							      error: function() {
							      	$("#boxContent").empty();
							      	$("#boxContent").append("<center><h1>An error has occurred</h1></center>");
							      	$("#loadingState").hide();
							      },
							      success: function(data) {
							      	$("#loadingState").hide();
							        $("#boxContent").empty();
							        boxData = JSON.parse(data);
							        var newContent = "";
							        listOffset = boxData[\'offset\'];
							        $(".unreadMessageCount").empty().append(boxData[\'pmUnread\']);
							        if(boxData[\'pmUnread\'] > 0)
							        {
							        	if(boxData[\'pmUnread\'] == 1)
							        	{
							        		$(".unreadMessageCountLong").empty().append("1 new message");
							        	}
							        	else
							        	{
							        		$(".unreadMessageCountLong").empty().append(boxData[\'pmUnread\'] + " new messages");
							        	}
							        	$(".unreadMessageCount").show();
							        }
							        else
							        {
							        	$(".unreadMessageCount").hide();
							        	$(".unreadMessageCountLong").empty().append("No new message");
							        }
							        if(boxData[\'pmData\'].length > 0)
							        {
								        for(var i = 0, n =boxData[\'pmData\'].length; i<n; i++)
								        {
								        	if(boxData[\'pmData\'][i].date_read == null)
								        	{
								        		readState = "";
								        	}
								        	else
								        	{
								        		readState = "mailbox-read-time";
								        	}
								        	newContent += \'<tr>\' + 
							                  \' <td><input type="checkbox" value="\' + boxData[\'pmData\'][i].id +\'"></td> \' + 
							                  \' <td class="mailbox-name"><a href="javascript:read(\' + boxData[\'pmData\'][i].id + \')">\' + boxData[\'pmData\'][i].senderName +\'</a></td>\' + 
							                  \' <td class="mailbox-subject \' + readState + \'"><a href="javascript:read(\' + boxData[\'pmData\'][i].id + \')" style="text-decoration:inherit; color:inherit;"><b>\' + boxData[\'pmData\'][i].title +\'</b> - \' + boxData[\'pmData\'][i].message +
							                  \' </a></td> \' + 
							                  \' <td class="mailbox-attachment"></td>\' + 
							                  \' <td class="mailbox-date">\' + boxData[\'pmData\'][i].recieveTime +\'</td>\' + 
							                \' </tr>\';
								        }
								    }
								    else
								    {
								    	newContent = "<center><h1>No Data</h1></center>"
								    }
							  		$("#boxContent").append(newContent);
							  		$(\'.mailbox-messages input[type="checkbox"]\').iCheck({
								      checkboxClass: \'icheckbox_flat-blue\',
								      radioClass: \'iradio_flat-blue\'
								    });
							      },
							      type: "GET"
							   });
						});

						$(".deleteBox").on("click", function(){
							if(selectedMessage.length > 0)
							{
								//show loading
								$("#loadingState").show();
								//load data using ajax 
								$.ajax({
								      url: "'.site_url('message/delete').'",
								      data: {
								         boxType: activeMailNav,
								         uId: '.$this->session->userdata('id').',
								         mIdList: selectedMessage
								      },
								      error: function() {
								      	$("#boxContent").empty();
								      	$("#boxContent").append("<center><h1>An error has occurred</h1></center>");
								      	$("#loadingState").hide();
								      },
								      success: function(data) {
								      	$(".fa", ".checkbox-toggle").removeClass("fa-check-square-o").addClass(\'fa-square-o\');
								      	$("#loadingState").hide();
								      	$(".refreshBox").trigger("click");
								      	selectedMessage = [];
								      },
								      type: "GET"
								   });
							}
						});

						$(".refreshBox").trigger("click");
					  });

					function read(pId)
					{
						$(".nextPage,.prevPage,.refreshBox,.deleteBox,.checkbox-toggle,.has-feedback").hide();
						$("#loadingState").show();
						$.ajax({
						      url: "'.site_url('message/box').'",
						      data: {
						         boxType: \'read\',
						         uId: '.$this->session->userdata('id').',
						         pId: pId
						      },
						      error: function() {
						      	$("#boxContent").empty();
						      	$("#boxContent").append("<center><h1>An error has occurred</h1></center>");
						      	$("#loadingState").hide();
						      },
						      success: function(data) {
						      	$("#messageList").hide();
						      	messageData = JSON.parse(data);
						      	$(".unreadMessageCount").empty().append(messageData[\'pmUnread\']);
						      	if(messageData[\'pmUnread\'] == 0)
						      	{
						      		$(".unreadMessageCount").hide();
						      		$(".unreadMessageCountLong").empty().append("No new message");
						      	}
						      	else
						      	{
						      		$(".unreadMessageCount").show();
						      		if(messageData[\'pmUnread\'] == 1)
						        	{
						        		$(".unreadMessageCountLong").empty().append("1 new message");
						        	}
						        	else
						        	{
						        		$(".unreadMessageCountLong").empty().append(messageData[\'pmUnread\'] + " new messages");
						        	}
						      	}
						      	$("#messageContent").empty().append(messageData[\'pmData\'].message);
						      	$("#messageTitle").empty().append(messageData[\'pmData\'].title);
						      	$("#messageSender").empty().append(messageData[\'pmData\'].senderName);
						      	$("#messageTime").empty().append(messageData[\'pmData\'].recieveTime);
								$("#readingView").show();
								$("#loadingState").hide();
						      },
						      type: "GET"
						   });
						
					}
				'
			)
		);
		$this->load->model('mdl_message');
		$destName = $this->mdl_message->getDestList();
		$cleanDestName = array();
		for($i=0,$n=count($destName);$i<$n;$i++)
		{
			$cleanDestName[$destName[$i]->id] = $destName[$i]->value;
		}
		$userList = $this->aauth->list_users();
		$destUserList = array();
		for($i=0,$n=count($userList);$i<$n;$i++)
		{
			if($userList[$i]->id !== $this->session->userdata('id'))
			{
				$destData = array(
					'id'=>$userList[$i]->id,
					'name'=>$userList[$i]->email
				);
				if(isset($cleanDestName[$userList[$i]->id]))
				{
					$destData['name']=$cleanDestName[$userList[$i]->id];
				}
				$destUserList[] = $destData;
			}
		}
		$unreadPm = $this->aauth->count_unread_pms();
		$mailData = array(
			'unreadPm'=>$unreadPm,
			'availableDest'=>$destUserList
		);
		$content = $this->load->view('mail',$mailData,TRUE);
		$sideBar = $this->obackend->sidebar(61);
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
		$sideBar = $this->obackend->sidebar(61);
		$viewData = $this->obackend->full(array('css'=>$cssList,'sidebar'=>$sideBar,'content'=>$content,'js'=>$jsList));
		$activeTemplate = $this->obackend->getActiveTemplate();
		$this->parser->parse($activeTemplate.'template',$viewData);
	}

	public function box()
	{
		$this->session->set_userdata('doNotLog','TRUE');
		$userId = trim($this->input->get('uId'));
		$boxType = trim($this->input->get('boxType'));
		$offset = trim($this->input->get('offset'));
		if($userId === $this->session->userdata('id'))
		{
			$this->load->model('mdl_message');
			switch($boxType)
			{
				case 'inbox':
					$pmTotal = $this->mdl_message->getTotal($userId);
					$pmUnread = $this->aauth->count_unread_pms();
					$pmData = $this->mdl_message->getByReciever($userId,10,$offset);
					if(count($pmData) == 0 && $offset > 0)
					{
						//fall back offset
						$offset--;
						$pmData = $this->mdl_message->getByReciever($userId,10,$offset);
					}
					for($i=0,$n=count($pmData);$i<$n;$i++)
					{
						$pmData[$i]->senderName = $this->aauth->get_user_var('profileName',$pmData[$i]->sender_id);
						$pmData[$i]->recieveTime = $this->obackend->time_elapsed_string($pmData[$i]->date_sent);
					}
					break;
				case 'sent':
					$pmTotal = $this->mdl_message->getTotal($userId,'sent');
					$pmUnread = $this->aauth->count_unread_pms();
					$pmData = $this->mdl_message->getBySender($userId,10,$offset);
					if(count($pmData) == 0 && $offset > 0)
					{
						//fall back offset
						$offset--;
						$pmData = $this->mdl_message->getBySender($userId,10,$offset);
					}
					for($i=0,$n=count($pmData);$i<$n;$i++)
					{
						$pmData[$i]->senderName = $this->aauth->get_user_var('profileName',$pmData[$i]->receiver_id);
						$pmData[$i]->recieveTime = $this->obackend->time_elapsed_string($pmData[$i]->date_sent);
					}
					break;
				case 'trash':
					$pmData = $this->mdl_message->getDeleted($userId,10,$offset);
					if(count($pmData) == 0 && $offset > 0)
					{
						//fall back offset
						$offset--;
						$pmData = $this->mdl_message->getDeleted($userId,10,$offset);
					}
					for($i=0,$n=count($pmData);$i<$n;$i++)
					{
						$senderName = $this->aauth->get_user_var('profileName',$pmData[$i]->sender_id);
						$receiverName = $this->aauth->get_user_var('profileName',$pmData[$i]->receiver_id);
						$pmData[$i]->senderName = $senderName.' to '.$receiverName;
						$pmData[$i]->recieveTime = $this->obackend->time_elapsed_string($pmData[$i]->date_sent);
					}
					$pmUnread = $this->aauth->count_unread_pms();
					$pmTotal = 0;
					$offset = 0;
					break;
				case 'read':
					$pmId = trim($this->input->get('pId'));
					$pmData = $this->aauth->get_pm($pmId,$userId);
					$pmUnread = $this->aauth->count_unread_pms();
					$pmData->senderName = $this->aauth->get_user_var('profileName',$pmData->sender_id);
					$pmData->recieveTime = date('d M Y h:i A',strtotime($pmData->date_sent));
					$pmTotal = 0;
					$offset = 0;
					break;
				default:
					break;
			}
			$ajaxResponse = array(
					'pmTotal'=>$pmTotal,
					'pmUnread'=>$pmUnread,
					'pmData'=>$pmData,
					'offset'=>$offset
				);
			echo json_encode($ajaxResponse);
		}
		else
		{

		}
	}

	public function delete()
	{
		$userId = trim($this->input->get('uId'));
		if($this->session->userdata('id') == $userId)
		{
			$boxType = trim($this->input->get('boxType'));
			$selectedMessage = $this->input->get('mIdList');
			for($i=0,$n=count($selectedMessage);$i<$n;$i++)
			{
				$checkDelete = $this->aauth->delete_pm($selectedMessage[$i],$userId);
			}
		}
		else
		{

		}
	}

	public function send()
	{
		$userId = trim($this->input->post('uId'));
		if($this->session->userdata('id') == $userId)
		{
			$messageTitle = trim($this->input->post(''));
			echo 'IN';
		}
		else
		{

		}
	}
}

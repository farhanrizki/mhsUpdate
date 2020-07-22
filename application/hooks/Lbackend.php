<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Lbackend {

	public $instance;

	public $requestMethod;

	public function __construct() {
		global $instance,$request_method;
		$this->instance = &get_instance();
		$this->requestMethod = $this->instance->input->server('REQUEST_METHOD');
	}

	function activity()
	{
		//log user activity
		$logState = $this->instance->session->userdata('doNotLog');
		if(is_null($logState))
		{
			$logState = TRUE;
		}
		else
		{
			$logState = FALSE;
			$this->instance->session->unset_userdata('doNotLog');
		}
		switch ($this->requestMethod) {
			case 'GET':
				$getData = $this->instance->input->get();
				$cleanGetData = array();
				foreach($getData as $k=>$v)
				{
					if(strripos($k, 'pass') !== FALSE)
					{
						$v = 'No Peeping Password !';
					}
					$cleanGetData[$k]=$v;
				}
				if(!empty($cleanGetData))
				{
					$requestData = json_encode($cleanGetData,JSON_FORCE_OBJECT);
				}
				else
				{
					$requestData = 'No Request Data';
				}
				break;
			case 'POST':
				$postData = $this->instance->input->post();
				$cleanPostData = array();
				foreach($postData as $k=>$v)
				{
					if(strripos($k, 'pass') !== FALSE)
					{
						$v = 'No Peeping Password !';
					}
					$cleanPostData[$k]=$v;
				}
				if(!empty($cleanPostData))
				{
					$requestData = json_encode($cleanPostData,JSON_FORCE_OBJECT);	
				}
				else
				{	
					$requestData = 'No Request Data';
				}
				break;
			case 'PUT':
				parse_str(file_get_contents("php://input"),$input_array);
				$requestData = json_encode($input_array,JSON_FORCE_OBJECT);
				break;
			case 'DELETE':
				parse_str(file_get_contents("php://input"),$input_array);
				$requestData = json_encode($input_array,JSON_FORCE_OBJECT);
				break;
			default:
				$logState = FALSE;
				break;
		}
		if($logState)
		{
			$logActivity = $this->requestMethod;
			$customLogActivity = $this->instance->session->userdata('lbackend_activity');
			if(!is_null($customLogActivity))
			{
				$logActivity .= ' : '.$customLogActivity;
				$this->instance->session->unset_userdata('lbackend_activity');
			}
			$userId = $this->instance->session->userdata('id');
			if(is_null($userId))
			{
				$userId = 0;
			}
			$logData = array(
				'USER_ID'=>$userId,
				'ACTIVITY'=>$logActivity,
				'URL_SOURCE'=>current_url(),
				'REQUEST_DATA'=>$requestData,
				'IP_ADDRESS'=>$this->instance->input->ip_address()
			);
			$this->instance->db->insert('users_activity',$logData);
		}
	}

}

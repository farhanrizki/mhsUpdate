<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_users extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function userPermission($userId)
    {
    	return $this->db->select('*')->where('user_id',$userId)->get('aauth_perm_to_user')->result();
    }

    function purgePermission($userId)
    {
    	$this->db->where('user_id',$userId)->delete('aauth_perm_to_user');
    }

    function purgeGroup($userId)
    {
    	$this->db->where('user_id',$userId)->delete('aauth_user_to_group');
    }

    function logDetails($userId,$logId)
    {
        return $this->db->select('*')->where('USER_ID',$userId)->where('ID',$logId)->get('users_activity')->result();
    }
}
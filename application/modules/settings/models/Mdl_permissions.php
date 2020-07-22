<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_permissions extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function permissionDetails($permissionId)
    {
        return $this->db->select('*')->where('id',$permissionId)->get('aauth_perms')->result();
    }

    function groupPermission($groupId)
    {
        return $this->db->select('*')->where('group_id',$groupId)->get('aauth_perm_to_group')->result();
    }

     function purgePermission($groupId)
    {
        $this->db->where('group_id',$groupId)->delete('aauth_perm_to_group');
    }
}
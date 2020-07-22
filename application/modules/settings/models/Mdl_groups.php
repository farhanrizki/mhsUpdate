<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_groups extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function groupDetails($groupId)
    {
        return $this->db->select('*')->where('id',$groupId)->get('aauth_groups')->result();
    }

    function groupPermission($groupId)
    {
        return $this->db->select('*')->where('group_id',$groupId)->get('aauth_perm_to_group')->result();
    }

    function purgePermission($groupId)
    {
        $this->db->where('group_id',$groupId)->delete('aauth_perm_to_group');
    }

    function list_groups()
    {
        $q_group = "
            SELECT 
                *
            FROM
                aauth_groups AS ag 
            WHERE
                id NOT IN ( SELECT subgroup_id FROM aauth_group_to_group )
        ";
        return $this->db->query($q_group)->result();
    }

    function checkSubgroup($groupId)
    {
        $checkData = $this->db->select('*')->where('subgroup_id',$groupId)->get('aauth_group_to_group')->result();
        if(count($checkData) > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    function haveSubgroup($groupId)
    {
        $checkData = $this->db->select('*')->where('group_id',$groupId)->get('aauth_group_to_group')->result();
        if(count($checkData) > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    function getParent($groupId)
    {
        $checkData = $this->db->select('*')->where('subgroup_id',$groupId)->get('aauth_group_to_group')->result();
        if(count($checkData) > 0)
        {
            return $checkData[0]->group_id;
        }
        else
        {
            return FALSE;
        }
    }
}
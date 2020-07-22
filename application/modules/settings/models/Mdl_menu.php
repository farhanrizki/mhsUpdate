<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_menu extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function getMenuSegment()
    {
        return $this->db->select('*')->where('parent_id',0)->order_by('order','asc')->get('backendMenu')->result();
    }

    function getMenuDetails($menuId,$parentId)
    {
        $menuData = $this->db->where('id',$menuId)->where('parent_id',$parentId)->get('backendMenu')->result();
        if(count($menuData) > 0)
        {
            return $menuData;
        }
        else
        {
            return FALSE;
        }
    }

    function getChild($parentId)
    {
        return $this->db->where('parent_id',$parentId)->order_by('order','asc')->get('backendMenu')->result();
    }

    function getParent($id)
    {
        return $this->db->where('id',$id)->get('backendMenu')->result();
    }

    function updateMenuDetails($menuId,$parentId,$updateData)
    {
        $this->db->where('id',$menuId)->where('parent_id',$parentId)->update('backendMenu',$updateData);
    }

    function addMenuDetails($parentId,$insertData)
    {
        $insertData['parent_id'] = $parentId;
        $q_order = "
            SELECT 
                MAX(`order`) as maxMenuOrder 
            FROM 
                backendMenu 
            WHERE 
                parent_id = ?
        ";
        $q_result = $this->db->query($q_order,array($parentId))->result();
        if(is_null($q_result[0]->maxMenuOrder))
        {
            $insertData['order'] = 0;
        }
        else
        {
            $insertData['order'] = $q_result[0]->maxMenuOrder + 1;
        }
        $this->db->insert('backendMenu',$insertData);
        return $this->db->insert_id();
    }

    function removeMenu($menuId)
    {
        $checkExists = $this->db->select('*')->where('id',$menuId)->get('backendMenu')->result();
        if(count($checkExists) > 0)
        {
            //check used by another menu
            $checkParent = $this->db->select('*')->where('parent_id',$menuId)->get('backendMenu')->result();
            if(count($checkParent) == 0)
            {
                $checkOrder = $checkExists[0]->order;
                $checkAnotherMenu = $this->db->select('*')->where('parent_id',$checkExists[0]->parent_id)->where('order >',$checkOrder)->order_by('order','asc')->get('backendMenu')->result();
                if(count($checkAnotherMenu)>0)
                {
                    for($i=0,$n=count($checkAnotherMenu);$i<$n;$i++)
                    {
                        $this->db->where('id',$checkAnotherMenu[$i]->id)->update('backendMenu',array('order'=>$checkAnotherMenu[$i]->order-1));
                    }
                }
                $this->db->where('id',$menuId)->delete('backendMenu');
                return 0;
            }
            else
            {
                return 2;
            }
        }
        else
        {
            return 1;
        }
    }

    function move($menuId,$orientation='')
    {
        $menuData = $this->db->select('*')->where('id',$menuId)->get('backendMenu')->result();
        if(count($menuData) > 0)
        {
            $currentOrder = $menuData[0]->order;
            if($orientation == 'up')
            {
                $newOrder = $menuData[0]->order - 1;
            }
            else
            {
                $newOrder = $menuData[0]->order + 1;   
            }
            $targetMenu = $this->db->select('*')->where('parent_id',$menuData[0]->parent_id)->where('order',$newOrder)->get('backendMenu')->result();
            if(count($targetMenu) > 0)
            {
                $updateMenu = array(
                    'order'=>$newOrder
                );
                $updateTarget = array(
                    'order'=>$currentOrder
                );  
                $this->db->where('id',$menuId)->update('backendMenu',$updateMenu);
                $this->db->where('id',$targetMenu[0]->id)->update('backendMenu',$updateTarget);
            }
        }
    }
}
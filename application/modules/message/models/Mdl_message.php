<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_message extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function getTotal($userId,$type='')
    {
    	switch($type)
    	{
    		case 'sent':
    			return count($this->db->select('*')->where('sender_id',$userId)->get('aauth_pms')->result());
    			break;
    		default:
        		return count($this->db->select('*')->where('receiver_id',$userId)->get('aauth_pms')->result());
        		break;
        }
    }

    function getByReciever($userId,$limit,$offset)
    {
    	return $this->db->select('id,sender_id,receiver_id,IF(LENGTH(title)>20,CONCAT(SUBSTR(title,1,20)," ..."),title) as title,IF(LENGTH(message)>50,CONCAT(SUBSTR(message,1,50)," ..."),message) as message,date_sent,date_read')->where('receiver_id',$userId)->where('pm_deleted_receiver',NULL)->order_by('id','DESC')->get('aauth_pms',$limit,$offset*10)->result();
    }

    function getBySender($userId,$limit,$offset)
    {
    	return $this->db->select('id,sender_id,receiver_id,IF(LENGTH(title)>20,CONCAT(SUBSTR(title,1,20)," ..."),title) as title,IF(LENGTH(message)>50,CONCAT(SUBSTR(message,1,50)," ..."),message) as message,date_sent,date_read')->where('sender_id',$userId)->where('pm_deleted_sender',NULL)->order_by('id','DESC')->get('aauth_pms',$limit,$offset*10)->result();
    }

    function getDeleted($userId,$limit,$offset)
    {
    	return $this->db->select('id,sender_id,receiver_id,IF(LENGTH(title)>20,CONCAT(SUBSTR(title,1,20)," ..."),title) as title,IF(LENGTH(message)>50,CONCAT(SUBSTR(message,1,50)," ..."),message) as message,date_sent,date_read')->where('pm_deleted_sender IS NOT',NULL)->or_where('pm_deleted_receiver IS NOT',NULL)->get('aauth_pms',$limit,$offset*10)->result();
    }

    function getDestList()
    {
        $queryName = "
            SELECT 
                au.id,
                auv.value
            FROM 
                aauth_user_variables as auv
                RIGHT JOIN aauth_users as au
                    ON auv.user_id = au.id
            WHERE
                auv.data_key = 'profileName'
        ";
        return $this->db->query($queryName)->result();
    }
}
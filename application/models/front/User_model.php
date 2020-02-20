<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	
	function check_user($data = array()){

		$this->email   	= $data['email'];
        $this->password 	=  $data['password'];
		$login = false;
		$query = "SELECT id,email_id,full_name,'user_type' FROM tbl_user WHERE email_id = '".$this->email."' and password = '".md5($this->password)."' AND status = 'Active'";
		
		$rs = $this->db->query($query);
		if ($rs->num_rows() >0 )
		{
			$row = $rs->row();
			$login = true;			
		}
		
		if($login == true)	{			
			$this->session->set_userdata('user_id', $row->id);
			$this->session->set_userdata('user_type', $row->user_type);
			$this->session->set_userdata('user_email', $row->email_id);
			$this->session->set_userdata('user_full_name', $row->full_name);
			return true;
		}
		else
		{
			return false;
		}


	}

function valideOldPassword($data){

		$oldpassword = $data['oldpassword'];
		$user_email = $this->session->userdata('user_email');
		
		$admin_pwd_sql = "SELECT count(*) as CNT FROM tbl_user WHERE email_id ='".$user_email."' and password ='".md5($oldpassword)."'";
		$recordSet = $this->db->query($admin_pwd_sql);
		$rs = false;		
		if($recordSet->num_rows() > 0)
		{
			$rs = array();
			$isEscapeArr = array();
			$row = $recordSet->row_array();
			if($row['CNT']>0)
			{
			
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			
			return false;
		}

}

function updateUserPass($email,$data)
	{
		$new_admin_pwd	=	$data['new_admin_pwd'];
		
		$query = "update tbl_user set password = '".md5($new_admin_pwd)."' where email_id ='".$email."'";
		$rs = $this->db->query($query);


		if($this->db->affected_rows())
		{
			return true;
		}
		else
		{
			
			return false;
		}
 }

function check_pin($data = array()){

    $this->pin    = $data['pin'];
        $login = false;
    $query = "SELECT * FROM tbl_db_connection WHERE pin = '".$this->pin."' AND status = 'Active'";
    
    $rs = $this->db->query($query);
    //print_r($rs->num_rows()); exit;
    if ($rs->num_rows() >0 )
    {
      $row = $rs->row();
      
      $login = true;      
    }
    
    if($login == true)  {     
      $this->session->set_userdata('pin_id', $row->id);
      $this->session->set_userdata('pin', $row->pin);
      $this->session->set_userdata('admin_type', $row->admin_type);
      $this->session->set_userdata('project_name', $row->project_name);
      $this->session->set_userdata('hostname', $row->hostname);
      $this->session->set_userdata('username', $row->username);
      $this->session->set_userdata('db_name', $row->db_name);
      $this->session->set_userdata('password', $row->password);
      $this->session->set_userdata('status', $row->status);
      return true;
    }
    else
    {
      return false;
    }


  }
////////////////// End Class /////////////////////

}

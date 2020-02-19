<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome_model extends CI_Model {

	
	function check_admin($data = array()){

		$this->username   	= $data['username'];
        $this->password 	=  $data['password'];
		$login = false;
		$query = "SELECT id,username,full_name,'user_group' FROM tbl_admin WHERE username = '".$this->username."' and password = '".md5($this->password)."' AND status = 'Active'";
		
		$rs = $this->db->query($query);
		if ($rs->num_rows() >0 )
		{
			$row = $rs->row();
			$login = true;			
		}
		
		if($login == true)	{			
			$this->session->set_userdata('user_id', $row->id);
			$this->session->set_userdata('user_group', $row->user_group);
			$this->session->set_userdata('user_name', $row->username);
			$this->session->set_userdata('user_full_name', $row->full_name);
			return true;
		}
		else
		{
			return false;
		}


	}


////////////////// End Class /////////////////////

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user_model extends CI_Model {

function getAllUser(){
	$this->db->select('*');
	$this->db->order_by('id','desc');
	$res = $this->db->get('tbl_user')->result_array();
	return $res;
 }

function addUser($data=array()){
  //print_r($data);
	if($data['id']!=''){

		$this->db->where('id',$data['id']);
		$this->db->update('tbl_user',$data);
		$last_id = $data['id'];

	}else{
		$this->db->insert('tbl_user',$data);
		$last_id = $this->db->insert_id();

	}

	return $last_id;


}

 function getUserDetail($id){
 	$this->db->select('*');
 	$this->db->where('id',$id);
 	$res = $this->db->get('tbl_user')->result_array();
 	return $res;


 }

 function addSms($data=array()){
  
		$this->db->insert('tbl_sms_data',$data);
		$last_id = $this->db->insert_id();

	return $last_id;
 }

 function addSmsDetail($data=array()){
 	 $this->db->insert('tbl_sms_data_detail',$data);
	 $last_id = $this->db->insert_id();

 }

  function user_delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('tbl_user');
		return true;
	}

////////////////// End Class /////////////////////

}

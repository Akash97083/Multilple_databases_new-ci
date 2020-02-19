<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Addon_model extends CI_Model {

  function getAllAddon(){
  		$this->db->select('*');
  		$this->db->order_by('id','DESC');
  		$res = $this->db->get('tbl_addon')->result_array();
  		return $res;
  	}

 function getAddonDetail($id){
 	$this->db->select('*');
 	$this->db->where('id',$id);
 	$res = $this->db->get('tbl_addon')->result_array();
 	return $res;


 }

 function addAddon($data){
 	if($data['id']!=''){
 		$this->db->where('id',$data['id']);
 		$this->db->update('tbl_addon',$data);
 		$last_id = $data['id'];

 	}else{
 		$this->db->insert('tbl_addon',$data);
 		$last_id = $this->db->insert_id();

 	}
 	return $last_id;


 }


 function addon_delete($id){
 	$this->db->select('*');
 	$this->db->where('id',$id);
 	$this->db->delete('tbl_addon');
 	return true;

 }


////////////////// End Class /////////////////////

}

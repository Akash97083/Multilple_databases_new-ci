<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms_model extends CI_Model {

  function getAllCms(){
  		$this->db->select('*');
  		$this->db->order_by('id','DESC');
  		$res = $this->db->get('tbl_cms')->result_array();
  		return $res;
  	}

 function getCmsDetail($id){
 	$this->db->select('*');
 	$this->db->where('id',$id);
 	$res = $this->db->get('tbl_cms')->result_array();
 	return $res;


 }

 function addCms($data){
 	if($data['id']!=''){
 		$this->db->where('id',$data['id']);
 		$this->db->update('tbl_cms',$data);
 		return $data['id'];

 	}else{

 	}


 }


////////////////// End Class /////////////////////

}

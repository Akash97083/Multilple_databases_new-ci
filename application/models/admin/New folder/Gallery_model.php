<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery_model extends CI_Model {

  function getAllTestimonial(){
  		$this->db->select('*');
  		$this->db->order_by('id','DESC');
  		$res = $this->db->get('tbl_gallery')->result_array();
  		return $res;
  	}

 function getGalleryDetail($id){
 	$this->db->select('*');
 	$this->db->where('id',$id);
 	$res = $this->db->get('tbl_gallery')->result_array();
 	return $res;


 }

 function addGallery($data){
 	if($data['id']!=''){
 		$this->db->where('id',$data['id']);
 		$this->db->update('tbl_gallery',$data);
 		$last_id = $data['id'];

 	}else{
 		$this->db->insert('tbl_gallery',$data);
 		$last_id = $this->db->insert_id();

 	}
 	return $last_id;


 }


 function image_delete($id){
 	$this->db->select('*');
 	$this->db->where('id',$id);
 	$this->db->delete('tbl_gallery');
 	return true;

 }


////////////////// End Class /////////////////////

}

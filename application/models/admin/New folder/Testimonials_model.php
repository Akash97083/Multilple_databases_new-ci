<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonials_model extends CI_Model {

  function getAllTestimonial(){
  		$this->db->select('*');
  		$this->db->order_by('id','DESC');
  		$res = $this->db->get('tbl_testimonial')->result_array();
  		return $res;
  	}

 function getTestimonialDetail($id){
 	$this->db->select('*');
 	$this->db->where('id',$id);
 	$res = $this->db->get('tbl_testimonial')->result_array();
 	return $res;


 }

 function addTestimonialDetail($data){
 	if($data['id']!=''){
 		$this->db->where('id',$data['id']);
 		$this->db->update('tbl_testimonial',$data);
 		$last_id = $data['id'];

 	}else{
 		$this->db->insert('tbl_testimonial',$data);
 		$last_id = $this->db->insert_id();

 	}
 	return $last_id;


 }


 function delete_testimonial($id){
 	$this->db->select('*');
 	$this->db->where('id',$id);
 	$this->db->delete('tbl_testimonial');
 	return true;

 }


////////////////// End Class /////////////////////

}

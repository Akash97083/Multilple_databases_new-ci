<?php defined('BASEPATH') OR exit('No direct script access allowed');

 class Order_model extends CI_Model
 {
 	

 	function getAllorder(){
  		$this->db->select('*');
  		$this->db->order_by('id','DESC');
  		$res = $this->db->get('tbl_order')->result_array();
  		return $res;
  	}

 function getorderDetail($id){
 	$this->db->select('*');
 	$this->db->where('id',$id);
 	$res = $this->db->get('tbl_order')->result_array();
 	return $res;
 }

 function getReceiverDetail($receiver_id){
  $this->db->select('*');
  $this->db->where('id',$receiver_id);
  $res = $this->db->get('tbl_shipping')->result_array();
  return $res[0];

 }

  function addorder($data){
 	if($data['id']!=''){
 		$this->db->where('id',$data['id']);
 		$this->db->update('tbl_order',$data);
 		$last_id = $data['id'];

 	}else{

 		//$this->db->insert('tbl_category',$data);
 		//$last_id = $this->db->insert_id();

 	}

 	return $last_id;


 }
 	
////////////// End Class ///////////////
 	
 }
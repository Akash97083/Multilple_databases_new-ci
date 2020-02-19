<?php defined('BASEPATH') OR exit('No direct script access allowed');

 class Coupon_model extends CI_Model
 {
 	

 	function getAllCoupon(){
  		$this->db->select('*');
  		$this->db->order_by('id','DESC');
  		$res = $this->db->get('tbl_coupon')->result_array();
  		return $res;
  	}

 function getCouponDetail($id){
 	$this->db->select('*');
 	$this->db->where('id',$id);
 	$res = $this->db->get('tbl_coupon')->result_array();
 	return $res;


 }

 function addCoupon($data){
 	if($data['id']!=''){
 		$this->db->where('id',$data['id']);
 		$this->db->update('tbl_coupon',$data);
 		$last_id = $data['id'];

 	}else{

 		$this->db->insert('tbl_coupon',$data);
 		$last_id = $this->db->insert_id();

 	}

 	return $last_id;


 }

 function check_coupon($id,$cat_name){
	$this->db->select('coupon_code');
	$this->db->where('coupon_code',$cat_name);
	if(!empty($id)){
    $this->db->where('id !=',$id);
    }

 	$res = $this->db->get('tbl_coupon')->num_rows();

 	return $res;


 }

function checkExistsCoupon($data,$editID=''){
	if($editID != ''){
      $this->db->where('id != ',$editID); 
    }
    
    $num_rows = $this->db->get_where('tbl_coupon',array('coupon_code' => $data['coupon_name']))->num_rows();
    //echo $this->db->last_query(); exit;
    return $num_rows;

}
 	
////////////// End Class ///////////////
 	
 }
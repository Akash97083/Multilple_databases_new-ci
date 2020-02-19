<?php defined('BASEPATH') OR exit('No direct script access allowed');

 class Hike_price_model extends CI_Model
 {
 	

 	function GetAllHikePrice(){
  		$this->db->select('*');
      $this->db->where('is_delete','1');
  		$this->db->order_by('id','DESC');
  		$res = $this->db->get('tbl_hike_price')->result_array();
  		return $res;
  	}

 function getHikeDetail($id){
 	$this->db->select('*');
 	$this->db->where('id',$id);
 	$res = $this->db->get('tbl_hike_price')->result_array();
 	return $res;


 }

 function addHikePrice($data){
 	if($data['id']!=''){
 		$this->db->where('id',$data['id']);
 		$this->db->update('tbl_hike_price',$data);
 		$last_id = $data['id'];

 	}else{

 		$this->db->insert('tbl_hike_price',$data);
 		$last_id = $this->db->insert_id();

 	}

 	return $last_id;


 }

 function check_category($id,$cat_name){
	$this->db->select('category_name');
	$this->db->where('category_name',$cat_name);
	if(!empty($id)){
    $this->db->where('id !=',$id);
    }

 	$res = $this->db->get('tbl_category')->num_rows();

 	return $res;


 }

function checkExistsCategory($data,$editID=''){
	if($editID != ''){
      $this->db->where('id != ',$editID); 
    }
    
    $num_rows = $this->db->get_where('tbl_category',array('category_name' => $data['category_name']))->num_rows();
    //echo $this->db->last_query(); exit;
    return $num_rows;

}
 	
////////////// End Class ///////////////
 	
 }
<?php defined('BASEPATH') OR exit('No direct script access allowed');

 class Card_message_model extends CI_Model
 {
 	

 	function getCardMessage(){
  		$this->db->select('*');
  		$this->db->order_by('id','DESC');
  		$res = $this->db->get('tbl_card_message')->result_array();
  		return $res;
  	}

 function getCardMessageDetail($id){
 	$this->db->select('*');
 	$this->db->where('id',$id);
 	$res = $this->db->get('tbl_card_message')->result_array();
 	return $res;


 }

 function addCardMessage($data){
 	if($data['id']!=''){
 		$this->db->where('id',$data['id']);
 		$this->db->update('tbl_card_message',$data);
 		$last_id = $data['id'];

 	}else{

 		$this->db->insert('tbl_card_message',$data);
 		$last_id = $this->db->insert_id();

 	}

 	return $last_id;


 }

 function check_short_message($id,$cat_name){
	$this->db->select('short_name');
	$this->db->where('short_name',$cat_name);
	if(!empty($id)){
    $this->db->where('id !=',$id);
    }

 	$res = $this->db->get('tbl_card_message')->num_rows();

 	return $res;


 }

function checkExistsCardMessage($data,$editID=''){
	if($editID != ''){
      $this->db->where('id != ',$editID); 
    }
    
    $num_rows = $this->db->get_where('tbl_card_message',array('short_name' => $data['short_message']))->num_rows();
    //echo $this->db->last_query(); exit;
    return $num_rows;

}
 	
////////////// End Class ///////////////
 	
 }
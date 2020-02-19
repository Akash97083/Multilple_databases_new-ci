<?php defined('BASEPATH') OR exit('No direct script access allowed');

 class Database_model extends CI_Model
 {
 	

 	function getAllDB(){
  		$this->db->select('*');
  		$this->db->order_by('id','DESC');
  		$res = $this->db->get('tbl_db_connection')->result_array();
  		return $res;
  	}

 function getDBDetail($id){
 	$this->db->select('*');
 	$this->db->where('id',$id);
 	$res = $this->db->get('tbl_db_connection')->result_array();
 	return $res;


 }

 function adddatabase($data){
 	if($data['id']!=''){
 		$this->db->where('id',$data['id']);
 		$this->db->update('tbl_db_connection',$data);
 		$last_id = $data['id'];

 	}else{
    $data['create_at']= date('Y-m-d H:i:s');
 		$this->db->insert('tbl_db_connection',$data);
 		$last_id = $this->db->insert_id();

 	}

 	return $last_id;


 }

 function check_User($id,$cat_name){
	$this->db->select('User_name');
	$this->db->where('User_name',$cat_name);
	if(!empty($id)){
    $this->db->where('id !=',$id);
    }

 	$res = $this->db->get('tbl_db_connection')->num_rows();

 	return $res;


 }

function checkpin($data,$editID=''){
	if($editID != ''){
      $this->db->where('id != ',$editID); 
    }
    
    $num_rows = $this->db->get_where('tbl_db_connection',array('pin' => $data['pin']))->num_rows();
    //echo $this->db->last_query(); exit;
    return $num_rows;

}
 	
////////////// End Class ///////////////
 	
 }
<?php defined('BASEPATH') OR exit('No direct script access allowed');

 class Tat_model extends CI_Model
 {
 	

 	function getAllTat(){
  		$this->db->select('*');
  		$res = $this->db->get('tbl_tat')->result_array();
  		return $res;
  	}

 function getTATDetail($id){
 	$this->db->select('*');
 	$this->db->where('id',$id);
 	$res = $this->db->get('tbl_tat')->result_array();
 	return $res;
 }

 function addtat($data){
 	if($data['id']!=''){
 		$this->db->where('id',$data['id']);
 		$this->db->update('tbl_tat',$data);
 		$last_id = $data['id'];

 	}else{
    $data['create_at'] = date('Y-m-d H:i:s');
 		$this->db->insert('tbl_tat',$data);
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

 	$res = $this->db->get('tbl_item')->num_rows();

 	return $res;


 }

function checkExistsCategory($data,$editID=''){
	if($editID != ''){
      $this->db->where('id != ',$editID); 
    }
    
    $num_rows = $this->db->get_where('tbl_tat',array('consignee_address' => $data['consignee_address']))->num_rows();
    //echo $this->db->last_query(); exit;
    return $num_rows;

}

function batchInsertdata($data = array()){
  foreach($data as $key => $row){
    $consignee_address = perticularFlied('tbl_tat','consignee_address',array('consignee_address'=>$row['ConsigneeAddress']))[0];

    if($row['ConsigneeAddress']!=$consignee_address['consignee_address']){
      $tat_data = array(
        'consignee_address'=>$row['ConsigneeAddress'],
        'type'=>$row['Type'],
        'local'=>$row['Local'],
        'delivery_tat_trnsport'=>$row['DELV_TAT_TRNSPORT'],
        'delivery_tat_courier'=>$row['DELV_TAT_COURIER'],
        'admin_id'=>$this->session->userdata('admin_id'),
        'create_at'=>date('Y-m-d H:i:s'),
      );

      $this->db->insert('tbl_tat',$tat_data);
      $last_id = $this->db->insert_id();


    }

    
  }

   return true;

}
 	
////////////// End Class ///////////////
 	
 }
<?php defined('BASEPATH') OR exit('No direct script access allowed');

 class Item_model extends CI_Model
 {
 	

 	function getAllItem(){
  		$this->db->select('*');
  		$this->db->order_by('id','DESC');
  		$res = $this->db->get('tbl_item')->result_array();
  		return $res;
  	}

 function getItemDetail($id){
 	$this->db->select('*');
 	$this->db->where('id',$id);
 	$res = $this->db->get('tbl_item')->result_array();
 	return $res;


 }

 function additem($data){
 	if($data['id']!=''){
 		$this->db->where('id',$data['id']);
 		$this->db->update('tbl_item',$data);
 		$last_id = $data['id'];

 	}else{
    $data['create_at'] = date('Y-m-d H:i:s');
 		$this->db->insert('tbl_item',$data);
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
    
    $num_rows = $this->db->get_where('tbl_item',array('material_code' => $data['material_code']))->num_rows();
    //echo $this->db->last_query(); exit;
    return $num_rows;

}

function batchInsertdata($data = array()){
  foreach($data as $key => $row){
    $material_code = perticularFlied('tbl_item','material_code',array('material_code'=>$row['MaterialCode']))[0];

    if($row['MaterialCode']!=$material_code['material_code']){
      $item_data = array(
        'material_code'=>$row['MaterialCode'],
        'material_name'=>$row['MaterialName'],
        'cold_chain_non_cold_chain'=>$row['ColdChain/NonColdChain'],
        'fixed_weight'=>$row['Fixedweight'],
        'admin_id'=>$this->session->userdata('admin_id'),
        'create_at'=>date('Y-m-d H:i:s'),
      );

      $this->db->insert('tbl_item',$item_data);
      $last_id = $this->db->insert_id();


    }

    
  }

   return true;

}
 	
////////////// End Class ///////////////
 	
 }
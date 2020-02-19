<?php defined('BASEPATH') OR exit('No direct script access allowed');

 class Item_model extends CI_Model
 {

  function getAllitem($id=null){
   //$this->db->select('*');
   $this->db->select('tbl_item.*,tbl_item.id as item_id,tbl_sub_categoery.id as sub_cat_id,tbl_sub_categoery.sub_cat_name,tbl_category.id as category_id,tbl_category.category_name');
   $this->db->join('tbl_sub_categoery','tbl_sub_categoery.id=tbl_item.sub_cat_id','left');
   $this->db->join('tbl_category','tbl_category.id=tbl_item.category_id');
   $res = $this->db->get('tbl_item')->result_array();
   return $res;
   }
 function getitemDetail($id){

 	$this->db->select('*');
 	$this->db->where('id',$id);
 	$res = $this->db->get('tbl_item')->row_array();
 	return $res;


 }

function checkExistsItem($data,$editID){
   if($editID != ''){
      $this->db->where('id != ',$editID); 
    }
    
    $num_rows = $this->db->get_where('tbl_item',array('category_id'=>$data['category_id'],'item_name' => $data['name'],'is_delete'=>'0'))->num_rows();
    //echo $this->db->last_query(); exit;
    return $num_rows;


}

 function additem($param=array()){
  $id = $this->session->userdata('user_id');
  if($param['id']!=''){

  	$this->db->where('id',$param['id']);
  	$this->db->update('tbl_item',$param);
  	$last_id = $param['id'];

  }else{

  	$param['item_code'] = substr(number_format(time() * mt_rand(0, 999999),0,'',''),0,6);
  	$param['added_by'] = $id;
    $param['add_timestamp'] = date('Y-m-d h:i:s');
   $this->db->insert('tbl_item',$param);
   $last_id = $this->db->insert_id();

  }

  return $last_id;

 }

 }
<?php defined('BASEPATH') OR exit('No direct script access allowed');

 class Subcategory_model extends CI_Model
 {

  function getAllSubcategory($id=null){
   $this->db->select('*');

  // $this->db->select('tbl_sub_categoery.id as sub_cat_id,tbl_sub_categoery.cat_id,tbl_sub_categoery,tbl_sub_categoery.sub_cat_name,tbl_category.category_name');
   //$this->db->join('tbl_category','tbl_category.id=tbl_sub_categoery.cat_id','left');

   if($id!=''){
    $this->db->where('cat_id',$id);

    }else{
      $this->db->where('is_delete','1');

    }

   $res = $this->db->get('tbl_sub_categoery')->result_array();
   return $res;
   }
 function getSubcategoryDetail($id){
 	$this->db->select('*');
 	$this->db->where('id',$id);
 	$res = $this->db->get('tbl_sub_categoery')->result_array();
 	return $res;


 }

 function addSubcategory($data){
 	if($data['id']!=''){
 		$this->db->where('id',$data['id']);
 		$this->db->update('tbl_sub_categoery',$data);
 		$last_id = $data['id'];

 	}else{

 		$this->db->insert('tbl_sub_categoery',$data);
 		$last_id = $this->db->insert_id();

 	}

 	return $last_id;


 }

 function checkExistsItem($data,$editID){
 	if($editID != ''){
      $this->db->where('id != ',$editID); 
    }
    
    $num_rows = $this->db->get_where('tbl_sub_categoery',array('cat_id'=>$data['category_id'],'sub_cat_name' => $data['name'],'is_delete'=>'1'))->num_rows();
    //echo $this->db->last_query(); exit;
    return $num_rows;
}


 function addsubcategoery($param=array()){
  $id = $this->session->userdata('user_id');
  //print_r($param); exit;
  if($param['id']!=''){

  	$this->db->where('id',$param['id']);
  	$this->db->update('tbl_sub_categoery',$param);
  	$last_id = $param['id'];

  }else{

    $param['added_by'] = $id;
    $param['add_timestamp'] = date('Y-m-d h:i:s');
   $this->db->insert('tbl_sub_categoery',$param);
   $last_id = $this->db->insert_id();

  }

  return $last_id;

 }

function getAlloccasionTpye(){
  $this->db->select('*');
  $this->db->where('cat_id',5);
  $this->db->where('status','Active');
  $this->db->where('is_delete','1');
  $res = $this->db->get('tbl_sub_categoery')->result_array();
  return $res;
}

}

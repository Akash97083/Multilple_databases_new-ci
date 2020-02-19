<?php defined('BASEPATH') OR exit('No direct script access allowed');

 class Costomer_model extends CI_Model
 {
 	

 	function getAllCostomer(){
  		$this->db->select('*');
  		$res = $this->db->get('tbl_costomer')->result_array();
  		return $res;
  	}

 function getCostomerDetail($id){
 	$this->db->select('*');
 	$this->db->where('id',$id);
 	$res = $this->db->get('tbl_costomer')->result_array();
 	return $res;
 }

 function addcostomer($data){
 	if($data['id']!=''){
 		$this->db->where('id',$data['id']);
 		$this->db->update('tbl_costomer',$data);
 		$last_id = $data['id'];

 	}else{
    $data['create_at'] = date('Y-m-d H:i:s');
 		$this->db->insert('tbl_costomer',$data);
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
    
    $num_rows = $this->db->get_where('tbl_costomer',array('sap_sold_to' => $data['sap_sold_to']))->num_rows();
    //echo $this->db->last_query(); exit;
    return $num_rows;

}

function batchInsertdata($data = array()){
  foreach($data as $key => $row){
    $material_code = perticularFlied('tbl_costomer','sap_sold_to,name',array('sap_sold_to'=>$row['SAPSoldto']))[0];

    if($row['SAPSoldto']!=$material_code['sap_sold_to'] && $row['Name']!= $material_code['name']){
      $costomer_data = array(
        'sap_sold_to'=>$row['SAPSoldto'],
        'name'=>$row['Name'],
        'pin_code'=>$row['PinCode'],
        'state'=>$row['State'],
        'customer_mobile'=>$row['CustMobileNo'],
        'mode_of_transport'=>$row['MODEOFTRANSPORT'],
        'cold_chain_transport'=>$row['COLDCHAINTRANSPORTER'],
        'non_cold_chain_transport'=>$row['NONCOLDCHAINTRANSPORTER'],
        'admin_id'=>$this->session->userdata('admin_id'),
        'create_at'=>date('Y-m-d H:i:s'),
      );

      $this->db->insert('tbl_costomer',$costomer_data);
      $last_id = $this->db->insert_id();


    }

    
  }

   return true;

}
 	
////////////// End Class ///////////////
 	
 }
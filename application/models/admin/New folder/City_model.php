<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class City_model extends CI_Model {

  function getAllCity(){
  		$this->db->select('*');
  		$this->db->order_by('id','ASC');
  		$res = $this->db->get('tbl_city')->result_array();
  		return $res;
  	}

 function getCityDetail($id=''){
 	$this->db->select('*');
 	$this->db->where('id',$id);
 	$res = $this->db->get('tbl_city')->result_array();
 	return $res;

 }

 function getAllDeliveryDetail($city_id=''){
 	$this->db->select('tbl_delivery_charges.id as delivery_charges_id,tbl_delivery_charges.city_id,tbl_delivery_charges.from_time,tbl_delivery_charges.to_time,tbl_delivery_charges.delivert_charge,tbl_delivery_charges.delivery_status,tbl_city.city_name');
 	$this->db->join('tbl_city','tbl_city.id=tbl_delivery_charges.city_id');
 	$this->db->where('tbl_delivery_charges.city_id',$city_id);
 	$res = $this->db->get('tbl_delivery_charges')->result_array();
 	return $res;


 }

  function addCity($data = array()){
 	if($data['id']!=''){
 		$this->db->where('id',$data['id']);
 		$this->db->update('tbl_city',$data);
 		$last_id = $data['id'];

 	}else{

 		//$this->db->insert('tbl_city',$data);
 		//$last_id = $this->db->insert_id();

 	}

 	return $last_id;

 }

 function addDelivery($data = array()){
 	if($data['id']!=''){
 		$this->db->where('id',$data['id']);
 		$this->db->update('tbl_delivery_charges',$data);
 		$last_id = $data['id'];

 	}else{

 		$this->db->insert('tbl_delivery_charges',$data);
 		$last_id = $this->db->insert_id();

 	}

 	return $last_id;

 }

 function getDeliveryDetail($id){
 	$this->db->select('*');
 	$this->db->where('id',$id);
 	$res = $this->db->get('tbl_delivery_charges')->result_array();
 	return $res;

 }

////////////////// End Class /////////////////////

}

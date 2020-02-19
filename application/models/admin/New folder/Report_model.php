<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {

  function AllSms(){
     $this->db->select('*');
     $res = $this->db->get('tbl_sms_data')->result_array();
     return $res;


  }


function getAllSmsFilter($param=array()){
 	//pr($param);

 	$this->db->select('*');
	if($param['to_date']!=''){
   	 	 $this->db->where('when_send >=',$param['to_date'].' 00:00:00');
   	 }

   	 if($param['from_date']!=''){
   	 	$this->db->where('when_send <=',$param['from_date'].' 00:00:00');
   	 }

     $this->db->order_by('id','DESC');
    $res = $this->db->get('tbl_sms_data')->result_array();
   	//echo $this->db->last_query(); exit;
   	return $res;


 }

 function getSmsDetail($id){
    $this->db->select('*');
    $this->db->where('id',$id);
    $res = $this->db->get('tbl_sms_data')->result_array();
    return $res;
  }

 function getAllUserWhoRecivedSms($id){
    $this->db->select('*');
    $this->db->where('sms_data_id',$id);
    $res = $this->db->get('tbl_sms_data_detail')->result_array();
    return $res;

 }

////////////////// End Class /////////////////////

}

<?php defined('BASEPATH') OR exit('No direct script access allowed');

 class Invoice_model extends CI_Model
 {
 	

 	function getAllInvoice(){
  		$this->db->select('*');
      $this->db->group_by('invoiceno');
      $this->db->order_by('bookingdate','DESC');
  		$res = $this->db->get('tbl_invoices')->result_array();
  		return $res;
  	}
  function getAllInvoices($id){
      $this->db->select('*');
      $this->db->where('invoiceno',$id);
      $this->db->order_by('id','DESC');
      $res = $this->db->get('tbl_invoices')->result_array();
      return $res;
    }

 function GetInvoiceDeliveryStatus($id){
 	$this->db->select('*');
 	$this->db->where('invoiceno',$id);
 	$res = $this->db->get('tbl_invoices')->result_array();
 	return $res;


 }

 function addUser($data){
 	if($data['id']!=''){
 		$this->db->where('id',$data['id']);
 		$this->db->update('tbl_user',$data);
 		$last_id = $data['id'];

 	}else{

 		$this->db->insert('tbl_user',$data);
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

 	$res = $this->db->get('tbl_user')->num_rows();

 	return $res;


 }

function checkExistsUser($data,$editID=''){
	if($editID != ''){
      $this->db->where('id != ',$editID); 
    }
    
    $num_rows = $this->db->get_where('tbl_user',array('User_name' => $data['User_name']))->num_rows();
    //echo $this->db->last_query(); exit;
    return $num_rows;

}

public function getDeliveryStatus($id){
  $this->db->select('*');
  $this->db->where('id',$id);
  $res = $this->db->get('tbl_invoices')->result_array();
  return $res;
}

public function UpdateDelivery($data){
  if($data['id'] !=''){
    $this->db->where('id',$data['id']);
    $this->db->update('tbl_invoices',$data);
    return $data['id'];

  }

}

function GetAllInvoiceCount(){
    $query = $this->db->select('*')->get('tbl_invoices');
    return $query->num_rows();
  }

function DBgetAllinvoice($limit,$start,$col,$dir){

    $query = $this
                ->db
                ->group_by('invoiceno')
                ->limit($limit,$start)
                ->order_by('id','DESC')
                ->order_by($col,$dir)
                ->get('tbl_invoices');
        
        if($query->num_rows()>0)
        {
            return $query->result_array(); 
        }
        else
        {
            return null;
        }

    
   }

function DBgetAllinvoice_search($limit,$start,$search,$col,$dir)
    {

      /*$query = $this->db
              ->select('*')
              ->like('invoiceno',$search)
              ->or_like('bookingdate',date('d-m-y',strtotime($search)))
              ->or_like('awbno',$search)
              ->or_like('invoicevalue',$search)
              ->or_like('consigneecode',$search)
              ->or_like('consignee',$search)
              ->group_by('invoiceno')
              ->get('tbl_invoices');*/
      $sql = "select * from tbl_invoices where `invoiceno` LIKE '%".$search."%' OR `bookingdate` LIKE '%".date('d-m-y',strtotime($search))."%' OR `awbno` LIKE '%".$search."%' OR `invoicevalue` LIKE '%".$search."%' OR `consigneecode` LIKE '%".$search."%' OR `consignee` LIKE '%".$search."%' GROUP BY `invoiceno` ORDER BY ".$col." LIMIT ".$limit." ";
      $query = $this->db->query($sql);
     
     if($query->num_rows()>0)
          {
              return $query->result_array();  
          }
          else
          {
              return null;
          }
    }

     function DBgetAllinvoice_search_count($limit,$start,$search,$col,$dir)
    {
     $sql = "select * from tbl_invoices where `invoiceno` LIKE '%".$search."%' OR `bookingdate` LIKE '%".date('d-m-y',strtotime($search))."%' OR `awbno` LIKE '%".$search."%' OR `invoicevalue` LIKE '%".$search."%' OR `consigneecode` LIKE '%".$search."%' OR `consignee` LIKE '%".$search."%' GROUP BY `invoiceno` ORDER BY ".$col." LIMIT ".$limit." ";
     $query = $this->db->query($sql);

      return $query->num_rows();
    }

 	
////////////// End Class ///////////////
 	
 }
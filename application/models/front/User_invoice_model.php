<?php defined('BASEPATH') OR exit('No direct script access allowed');

 class User_invoice_model extends CI_Model
 {
 	

 	function getAllInvoice(){
  		$this->db->select('*');
      $this->db->where('user_id',$this->session->userdata('user_id'));
      $this->db->group_by('invoiceno');
      $this->db->order_by('bookingdate','DESC');
  		$res = $this->db->get('tbl_invoices')->result_array();
  		return $res;
  	}
  function getAllInvoices($invoice_no){
      $this->db->select('*');
      $this->db->where('invoiceno',$invoice_no);
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

 function AddDeliveryStatus($data){
 	if($data['id']!=''){
 		$this->db->where('id',$data['id']);
 		$this->db->update('tbl_invoices',$data);
 		$last_id = $data['id'];

 	}else{

 		$this->db->insert('tbl_invoices',$data);
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

public function batchInsertdata($data = array()){
  foreach($data as $key=> $row){
    if(intval($row['InvoiceNo']) && $row['InvoiceNo'] !=''){
      $check_invoice = perticularFlied('tbl_invoices','invoiceno',array('invoiceno'=>$row['InvoiceNo']))[0];
      if($row['InvoiceNo']==$check_invoice['invoiceno']){
        $insert_data = array(
          'bookingdate'=>$row['BookingDate'],
          'awbno'=>$row['AwbNo'],
          'transport/courier/local'=>$row['Transport/Courier/Local'],
          'origin'=>$row['Origin'],
          'consignor'=>$row['Consignor'],
          'consigneecode'=>$row['ConsigneeCode'],
          'consignee'=>$row['Consignee'],
          'consigneeaddress'=>$row['ConsigneeAddress'],
          'consigneemobileno'=>$row['ConsigneeMobileNo'],
          'consigneepin'=>$row['ConsigneePin'],
          'packages'=>$row['Packages'],
          'actualweight'=>$row['ActualWeight'],
          'volumetricweight'=>$row['VolumetricWeight'],
          'chargedweight'=>$row['ChargedWeight'],
          'invoiceno'=>$row['InvoiceNo'],
          'invoicevalue'=>$row['InvoiceValue'],
          'coldchain/noncoldchain'=>$row['Cold Chain/Non Cold Chain'],
          'deliverystatus'=>$row['DeliveryStatus'],
          'other_note'=>'',
          'deliverydate'=>$row['DeliveryDate'],
          'user_id'=>$this->session->userdata('user_id'),
          'create_at'=>date('Y-m-d H:i:s'),
          );

         $this->db->insert('tbl_invoices',$insert_data);

      }else{
        //echo "<pre>";print_r($row);
        $insert_data = array(
          'bookingdate'=>$row['BookingDate'],
          'awbno'=>$row['AwbNo'],
          'transport/courier/local'=>$row['Transport/Courier/Local'],
          'origin'=>$row['Origin'],
          'consignor'=>$row['Consignor'],
          'consigneecode'=>$row['ConsigneeCode'],
          'consignee'=>$row['Consignee'],
          'consigneeaddress'=>$row['ConsigneeAddress'],
          'consigneemobileno'=>$row['ConsigneeMobileNo'],
          'consigneepin'=>$row['ConsigneePin'],
          'packages'=>$row['Packages'],
          'actualweight'=>$row['ActualWeight'],
          'volumetricweight'=>$row['VolumetricWeight'],
          'chargedweight'=>$row['ChargedWeight'],
          'invoiceno'=>$row['InvoiceNo'],
          'invoicevalue'=>$row['InvoiceValue'],
          'coldchain/noncoldchain'=>$row['Cold Chain/Non Cold Chain'],
          'deliverystatus'=>$row['DeliveryStatus'],
          'other_note'=>'',
          'deliverydate'=>$row['DeliveryDate'],
          'user_id'=>$this->session->userdata('user_id'),
          'create_at'=>date('Y-m-d H:i:s'),
          );

          //echo "<pre>";print_r($insert_data); exit;
         $this->db->insert('tbl_invoices',$insert_data);

      }

      //return true;
    }
  }

}
 
function GetAllInvoiceCount(){
    $query = $this->db->select('*')->where('user_id',$this->session->userdata('user_id'))->group_by('invoiceno')->get('tbl_invoices');
    return $query->num_rows();
  }

function DBgetAllinvoice($limit,$start,$col,$dir){

    $query = $this
                ->db
                ->where('user_id',$this->session->userdata('user_id'))
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
      $sql = "select * from tbl_invoices where user_id ='".$this->session->userdata('user_id')."' AND (`invoiceno` LIKE '%".$search."%' OR `bookingdate` LIKE '%".date('d-m-y',strtotime($search))."%' OR `awbno` LIKE '%".$search."%' OR `invoicevalue` LIKE '%".$search."%' OR `consigneecode` LIKE '%".$search."%' OR `consignee` LIKE '%".$search."%') GROUP BY `invoiceno` ORDER BY ".$col." LIMIT ".$limit." ";
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
      $sql = "select * from tbl_invoices where user_id ='".$this->session->userdata('user_id')."' AND (`invoiceno` LIKE '%".$search."%' OR `bookingdate` LIKE '%".date('d-m-y',strtotime($search))."%' OR `awbno` LIKE '%".$search."%' OR `invoicevalue` LIKE '%".$search."%' OR `consigneecode` LIKE '%".$search."%'OR `consignee` LIKE '%".$search."%') GROUP BY `invoiceno`";
      $query = $this->db->query($sql);

      return $query->num_rows();
    }
    
////////////// End Class ///////////////
 	
 }
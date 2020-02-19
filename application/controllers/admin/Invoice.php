<?php defined('BASEPATH') OR exit('No direct script access allowed');

 class Invoice extends CI_Controller
 {
 	
 	public function __construct()
 	{
 		parent::__construct();
 		$this->load->model('admin/Invoice_model');
        $this->controller = 'user';
        checkAdmin($this->controller."/");
 	}

 	public function index(){
		checkAdmin($this->controller."/");
		$data=array('errmsg'=>'');
		$data = array('succmsg'=>'');
		$data['page_title']="Manage Invoice";

		$data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url().'">Home</a></li><li class="active">Manage User</li>';
		//$data['recordset'] = $this->Invoice_model->getAllInvoice();
    $data['recordset'] = array();
    $this->load->view('admin/invoice/index',$data);
 	}

function add_delivery($id= null){
	if($id !=''){
		$data['page_title']='Update Delivery';
        $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/dashboard').'">Home</a></li><li><a href="'.base_url('admin/user').'">Invoice List</a></li><li class="active">Update Delivery</li>';

	}
    
    $data['succmsg'] = '';
    $data['errmsg'] = '';
    $data['InvoiceDetail'] = $this->Invoice_model->GetInvoiceDeliveryStatus($id)[0];
    $data['recordset'] = $this->Invoice_model->getAllInvoices($id);
    $this->load->view('admin/invoice/add_delivery_status',$data);
 }

 function User_data(){
    $User_name = $this->input->post('User_name');
    $contentId =$this->input->post('User_id');
   if($User_name !=''){
   	$checkExistsUser = $this->Invoice_model->checkExistsUser(array('User_name'=>$User_name),$this->input->post('User_id'));
   	if($checkExistsUser > 0){
	$this->session->set_flashdata('errmsg', 'User Already Exists.');
	redirect(base_url("admin/User/add_User/".$contentId));
	return true;
	}else{

      $data = array(
            'id'=>$this->input->post('User_id'),
            'User_name'=>$this->input->post('User_name'),
            'description'=>$this->input->post('description'),
            'status'=>'active',
            'user_id'=>$this->session->userdata('user_id'),
            'when_added'=>date('Y-m-d H:i:s')

        );

        //print_r($data); exit();
        $last_id = $this->Invoice_model->addUser($data);

      }

        if(!empty($data['id'])){
        	$slug_data = array('id'=>$last_id,'User_slug'=>strtolower(str_replace(" ", "-", $this->input->post('User_name').'-indonesia')));

         $this->Invoice_model->addUser($slug_data);

            $this->session->set_flashdata('succmsg', "".ucfirst($User_name)." Updated Successfully");
        }else{
        	$slug_data = array('id'=>$last_id,'User_slug'=>strtolower(str_replace(" ", "-", $this->input->post('User_name').'-indonesia')));

         $this->Invoice_model->addUser($slug_data);


            $this->session->set_flashdata('succmsg', "".$User_name." Add Successfully");
        }
        
        redirect('admin/User');




    }else{
        redirect('admin/cms','refresh');
    }


 }

 function User_check(){
 	$cat_id = $this->input->post('cat_id');
 	$User_name = $this->input->post('User_name');
	$count = $this->Invoice_model->check_User($cat_id,$User_name);
 	echo $count;
 }

function changestatus()
	 {
		$id = $this->input->post('id');
		$userstatus = $this->Invoice_model->getUserDetail($id);
		if($userstatus[0]['status']=='Active')
		{
			$user_data = array('id'=>$id,'status'=>'Inactive');
			$this->Invoice_model->addUser($user_data);
			echo 'Inactive';
		}
		if($userstatus[0]['status']=='Inactive')
		{
		
			$user_data = array('id'=>$id,'status'=>'Active');
			$this->Invoice_model->addUser($user_data);
			echo 'Active';
		}
	
	}

 public function delivery_status(){
   $id = $this->input->post('id');
   $invoice_detail = $this->Invoice_model->getDeliveryStatus($id)[0];
   if($invoice_detail['deliverystatus'] == 'Out_for_Delivery'){
    $selected = 'selected=selected';

   }
   if($invoice_detail['deliverystatus'] == 'Dispatched'){
    $selected1 = 'selected=selected';
   }
   if($invoice_detail['deliverystatus'] == 'Delivered'){
    $selected2 = 'selected=selected';

   }
   if($invoice_detail['deliverystatus'] == 'Others'){
    $selected3 = 'selected=selected';

   }


   $html = '<select class="control-label" name="delivery_id" onchange="select_other(this.value)">
                      <option value="">Choose Delivery Status</option>
                      <option value="Out_for_Delivery" '.$selected.'>Out for Delivery</option>
                      <option value="Delivered" '.$selected2.'>Delivered</option>
                      <option value="Dispatched" '.$selected1.'>Dispatched</option>
                      <option value="Others" '.$selected3.'>Others</option>
                     </select>';
 echo $html;

 }

 public function get_delivery_value(){
    $id = $this->input->post('id');
    $invoice_detail = $this->Invoice_model->getDeliveryStatus($id)[0];
    if($invoice_detail['deliverystatus'] == 'Others'){
        echo json_encode(array('other_note'=>$invoice_detail['other_note'],'val'=>'1'));
    }else{
        echo json_encode(array('val'=>'2'));
    }

 }

 public function invoice_delivery_data(){
    $upadte_date = array(
        'id'=>$this->input->post('invoice_id'),
        'deliverystatus'=>$this->input->post('delivery_id'),
        'other_note'=>($this->input->post('delivery_id')=='Others'?$this->input->post('other_note'):''),
        'user_id'=>$this->session->userdata('admin_id'),
        'update_at'=>date('Y-m-d H:i:s')
    );

    //print_r($upadte_date);
    //exit;
    $this->Invoice_model->UpdateDelivery($upadte_date);
    if(!empty($upadte_date['id'])){
            $this->session->set_flashdata('succmsg', "".ucfirst($this->input->post('invoice_number'))." Updated Successfully");
        }
        
        redirect('admin/invoice/add_delivery/'.$this->input->post('invoice_number'));
  }

  public function all_invoice(){
        $columns = array(
            0 => 'id',
            1 => 'invoiceno',
            2 => 'bookingdate',
            3 => 'awbno',
            4 => 'invoicevalue',
            5 => 'consigneecode',
            6 => 'consignee',
            7 => 'consigneemobileno',
            8 => 'user_id',
        );

        $draw = $_GET['draw'];
        $start = $_GET['start'];
        $length = $_GET['length'];
        $nf_date_lead = $_GET['nf_date_lead'];
        $search_value = $_GET['search']['value'];
        $order_by = $columns[$_GET['order'][0]['column']];
        $dir = $_GET['order'][0]['dir'];
        
        $userCount = $this->Invoice_model->GetAllInvoiceCount($length,$start,$order_by,$dir);
        $lead_array = array();
        $inc_arr = array();
        

      if(empty($search_value))
        {            
            $leads = $this->Invoice_model->DBgetAllinvoice($length,$start,$order_by,$dir);
            
        }else{
            

            $leads =  $this->Invoice_model->DBgetAllinvoice_search($length,$start,$search_value,$order_by,$dir);

            $userCount = $this->Invoice_model->DBgetAllinvoice_search_count($length,$start,$search_value,$order_by,$dir);
        }

        if(!empty($leads)){
            $inc = 0;
            foreach($leads as $val_leads){
                    $user = perticularFlied('tbl_user','full_name',array('id'=>$val_leads['user_id']))[0];

                    $inc_arr[0] = $inc+1;
                    $inc_arr[1] = '<a href="invoice/add_delivery/'.$val_leads['invoiceno'].'" title="">'.$val_leads['invoiceno'].'</a>';
                    $inc_arr[2] = date('d-m-y',strtotime($val_leads['bookingdate']));
                    $inc_arr[3] = $val_leads['awbno'];
                    $inc_arr[4] = $val_leads['invoicevalue'];
                    $inc_arr[5] = $val_leads['consigneecode'];
                    $inc_arr[6] = $val_leads['consignee'];
                    $inc_arr[7] = $val_leads['consigneemobileno'];
                    $inc_arr[8] = $user['full_name'];
                    array_push($lead_array,$inc_arr);
                    $inc++;
            }
        }else{
            $leads = array();
        }

        $array = array (
        'recordsTotal' => intval($userCount),
        'recordsFiltered' => intval($userCount),
        'data' => $lead_array,
        );

        echo json_encode($array);

    }



 /////////////////////////
 }
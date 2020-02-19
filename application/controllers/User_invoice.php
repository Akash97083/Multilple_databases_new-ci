<?php defined('BASEPATH') OR exit('No direct script access allowed');

 class User_invoice extends CI_Controller
 {
 	
 	public function __construct()
 	{
 		parent::__construct();
 		$this->load->model('front/User_Invoice_model');
        $this->controller = 'user_invoice';
        checkUser($this->controller);
 	}

 	public function index(){
		$data=array('errmsg'=>'');
		$data = array('succmsg'=>'');
		$data['page_title']="Manage Invoice";

		$data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('user/dashboard').'">Home</a></li><li class="active">Manage Invoice</li>';
		//$data['recordset'] = $this->User_Invoice_model->getAllInvoice();
        $data['recordset'] = array();
		$this->load->view('front/invoice/index',$data);
 	}

function add_delivery($id= null){
	if($id !=''){
		$data['page_title']='Update Delivery';
        $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('user/dashboard').'">Home</a></li><li><a href="'.base_url('user_invoice').'">Invoice List</a></li><li class="active">Update Delivery</li>';

	}
    
    $data['succmsg'] = '';
    $data['errmsg'] = '';
    $data['InvoiceDetail'] = $this->User_Invoice_model->GetInvoiceDeliveryStatus($id)[0];
    $data['recordset'] = $this->User_Invoice_model->getAllInvoices($id);
    $this->load->view('front/invoice/add_delivery_status',$data);
 }

 public function add_new_excel(){
    $data['page_title']='Add new excel';
    $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('user/dashboard').'">Home</a></li><li><a href="'.base_url('user_invoice').'">Invoice List</a></li><li class="active">Add new excel</li>';

    $data['succmsg'] = '';
    $data['errmsg'] = '';
    $this->load->view('front/invoice/add_excel',$data);

 }

 public function add_new_excel_data(){
    $this->load->library('excel_reader/PHPExcel');
    $this->load->library('excel_reader/PHPExcel/Iofactory');
    if ((!empty($_FILES['excel_file']['name'])) && ($_FILES['excel_file']['size'] > 0)) {
                    $array = explode('.', $_FILES['excel_file']['name']);
                    $extension       = end($array);
                    $valid_extension = array(
                                                "xlsx",
                                                "csv",
                                                "xls"
                                            );
                    if (in_array($extension, $valid_extension)){
                        $config['upload_path']   = 'assets/execel_file';
                        $config['allowed_types'] = '*'; // all file
                        $config['encrypt_name']  = false;
                        $this->load->library('upload');
                        $this->upload->initialize($config);
                        //echo "<pre>";print_r($_FILES['excel_file']);
                        if($this->upload->do_upload('excel_file'))
                        {
                            $data1 = $this->upload->data();
                            $file  = 'assets/execel_file/' . $data1['file_name'];
                            //echo "<pre>";print_r($file);exit;
                            $objPHPExcel = $this->iofactory->load($file);
                            $sheetCount  = $objPHPExcel->getSheetCount();
                            $inventory_master_data = array();
                            for ($i = 0; $i < $sheetCount; $i++) 
                            {
                                $csv_data = array();
                                //$csv_data = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                                $csv_data = $objPHPExcel->setActiveSheetIndex($i)->toArray(null, true, true, true);
                                    if (array_key_exists('B', $csv_data[1])) {
                                        foreach ($csv_data as $key => $value) {
                                            if ($key == 1) {
                                                continue;
                                            } else {
                                                $exceldata                 = array();
                                                $exceldata['BookingDate']     =  convert_date(trim($value['A']));
                                                $exceldata['AwbNo']    = trim($value['B']);
                                                $exceldata['Transport/Courier/Local']    = trim($value['C']);
                                                $exceldata['Origin']    = trim($value['D']);
                                                $exceldata['Consignor']    = trim($value['E']);
                                                $exceldata['ConsigneeCode']    = trim($value['F']);
                                                $exceldata['Consignee']    = trim($value['G']);
                                                $exceldata['ConsigneeAddress']    = trim($value['H']);
                                                $exceldata['ConsigneeMobileNo']    = trim($value['I']);
                                                $exceldata['ConsigneePin']    = trim($value['J']);
                                                $exceldata['Packages']    = trim($value['K']);
                                                $exceldata['ActualWeight']    = trim($value['L']);
                                                $exceldata['VolumetricWeight']    = trim($value['M']);
                                                $exceldata['ChargedWeight']    = trim($value['N']);
                                                $exceldata['InvoiceNo']    = trim($value['O']);
                                                $exceldata['InvoiceValue']    = trim($value['P']);
                                                $exceldata['Cold Chain/Non Cold Chain']    = trim($value['Q']);
                                                $exceldata['DeliveryStatus']    = trim($value['R']);
                                                $exceldata['DeliveryDate']    = convert_date(trim($value['S']));

                                               //$exceldata['TaxableAmount'] = $objPHPExcel->getActiveSheet()->rangeToArray('H2:R4');
                                                $excel_master_data[] = $exceldata;
                                            }
                                        }
                                    }

                            }
                            $objPHPExcel->disconnectWorksheets();
                            unset($objPHPExcel);

                            if(!empty($excel_master_data) && count($excel_master_data) > 0) {
                        
                                    $details_arr = $this->User_Invoice_model->batchInsertdata($excel_master_data);
                                }
                            unlink($file);
                            $this->session->set_flashdata('succmsg', 'Sucessfully ' . $extension . ' file imported');
                            redirect(base_url() . "user_invoice/");

                        }
                    }else{
                        $this->session->set_flashdata('errmsg', 'Only ' . $valid_extension[0] . ' And '.$valid_extension[2] .' '.'extension are allowed.');
                            redirect(base_url() . "user_invoice/add_new_excel");

                    }
                
            }
  
 }

 function user_invoice_status_data(){
    $invoice_no = $this->input->post('invoice_no');
    $delivery_id = $this->input->post('delivery_id');
    $other_note = $this->input->post('other_note');
    $this->User_Invoice_model->getAllInvoices($invoice_no);
    $data = array(
            'id'=>'',
            'invoiceno'=>$invoice_no,
            'other_note'=>$other_note,
            'deliverystatus'=>$delivery_id,
            'deliverydate'=>($delivery_id=='Delivered'?date('Y-m-d H:i:s'):''),
            'user_id'=>$this->session->userdata('user_id'),
            'update_at'=>date('Y-m-d H:i:s')
        );

        //echo "<pre>";print_r($data); exit();
        $last_id = $this->User_Invoice_model->AddDeliveryStatus($data);

      if(!empty($data['id'])){
        	$this->session->set_flashdata('succmsg', "".ucfirst($invoice_no)." Updated Successfully");
        }else{
        	$this->session->set_flashdata('succmsg', "DeliveryStatus Added Successfully");
        }
        
        redirect('user_invoice/add_delivery/'.$invoice_no);




    }

 function User_check(){
 	$cat_id = $this->input->post('cat_id');
 	$User_name = $this->input->post('User_name');
	$count = $this->User_Invoice_model->check_User($cat_id,$User_name);
 	echo $count;
 }

function changestatus()
	 {
		$id = $this->input->post('id');
		$userstatus = $this->User_Invoice_model->getUserDetail($id);
		if($userstatus[0]['status']=='Active')
		{
			$user_data = array('id'=>$id,'status'=>'Inactive');
			$this->User_Invoice_model->addUser($user_data);
			echo 'Inactive';
		}
		if($userstatus[0]['status']=='Inactive')
		{
		
			$user_data = array('id'=>$id,'status'=>'Active');
			$this->User_Invoice_model->addUser($user_data);
			echo 'Active';
		}
	
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
            8 => 'user_id'
        );

        $draw = $_GET['draw'];
        $start = $_GET['start'];
        $length = $_GET['length'];
        $nf_date_lead = $_GET['nf_date_lead'];
        $search_value = $_GET['search']['value'];
        $order_by = $columns[$_GET['order'][0]['column']];
        $dir = $_GET['order'][0]['dir'];
        $userCount = $this->User_Invoice_model->GetAllInvoiceCount($length,$start,$order_by,$dir);
        $lead_array = array();
        $inc_arr = array();
        

      if(empty($search_value))
        {            
            $leads = $this->User_Invoice_model->DBgetAllinvoice($length,$start,$order_by,$dir);
            
        }else{
            

            $leads =  $this->User_Invoice_model->DBgetAllinvoice_search($length,$start,$search_value,$order_by,$dir);

            $userCount = $this->User_Invoice_model->DBgetAllinvoice_search_count($length,$start,$search_value,$order_by,$dir);
        }

        if(!empty($leads)){
            $inc = 0;
            foreach($leads as $val_leads){
                    $user = perticularFlied('tbl_user','full_name',array('id'=>$val_leads['user_id']))[0];

                    $inc_arr[0] = $inc+1;
                    $inc_arr[1] = '<a href="user_invoice/add_delivery/'.$val_leads['invoiceno'].'" title="">'.$val_leads['invoiceno'].'</a>';
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

/////////////////////////////End Class ////////////////////////
 }
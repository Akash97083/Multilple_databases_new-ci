<?php defined('BASEPATH') OR exit('No direct script access allowed');

 class Costomer extends CI_Controller
 {
 	
 	public function __construct()
 	{
 		parent::__construct();
 		$this->load->model('admin/Costomer_model');
        $this->controller = 'costomer';
 	}

 	public function index(){
		checkAdmin($this->controller."/");
		$data=array('errmsg'=>'');
		$data = array('succmsg'=>'');
		$data['page_title']="Costomer Master";

		$data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url().'">Home</a></li><li class="active">Costomer Master</li>';
		$data['recordset'] = $this->Costomer_model->getAllCostomer();
		$this->load->view('admin/costomer/index',$data);
 	}

function add_costomer($id= null){
	if($id !=''){
		$data['page_title']='Update Costomer';
        $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/dashboard').'">Home</a></li><li><a href="'.base_url('admin/costomer').'">Costomer List</a></li><li class="active">Update Costomer</li>';

	}else{
		$data['page_title']='Add Costomer';
        $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/dashboard').'">Home</a></li><li><a href="'.base_url('admin/costomer').'">Costomer List</a></li><li class="active">Add Costomer</li>';

	}
    
    $data['succmsg'] = '';
    $data['errmsg'] = '';
    $data['costomerDetail'] = $this->Costomer_model->getCostomerDetail($id)[0];
    $this->load->view('admin/costomer/add_costomer',$data);
 }

 function add_costomer_data(){
    $sap_sold_to = $this->input->post('sap_sold_to');
    $contentId =$this->input->post('costomer_id');
   if($sap_sold_to !=''){
   	$checkExistsmaterial = $this->Costomer_model->checkExistsCategory(array('sap_sold_to'=>$sap_sold_to),$this->input->post('costomer_id'));
   	if($checkExistsmaterial > 0){
	$this->session->set_flashdata('errmsg', 'Sap Sold Already Exists.');
	redirect(base_url("admin/costomer/add_costomer/".$contentId));
	return true;
	}else{

      $data = array(
            'id'=>$this->input->post('costomer_id'),
            'sap_sold_to'=>$this->input->post('sap_sold_to'),
            'name'=>$this->input->post('costomer_name'),
            'pin_code'=>$this->input->post('pin_code'),
            'state'=>$this->input->post('state'),
            'customer_mobile'=>$this->input->post('customer_mobile'),
            'mode_of_transport'=>$this->input->post('mode_of_transport'),
            'cold_chain_transport'=>$this->input->post('cold_chain_transport'),
            'non_cold_chain_transport'=>$this->input->post('non_cold_chain_transport'),
            'status'=>'active',
            'admin_id'=>$this->session->userdata('admin_id'),
            'update_at'=>date('Y-m-d H:i:s')

        );

        //print_r($data); exit();
        $last_id = $this->Costomer_model->addcostomer($data);

      }

        if(!empty($data['id'])){
        	$this->session->set_flashdata('succmsg', "<b>".ucfirst($this->input->post('costomer_name'))."</b> Updated Successfully");
        }else{
        	$this->session->set_flashdata('succmsg', "<b>".ucfirst($this->input->post('costomer_name'))."</b> Add Successfully");
        }
        
        redirect('admin/costomer');




    }else{
        redirect('admin/costomer','refresh');
    }


 }

  public function add_new_costomer_excel(){
    $data['page_title']='Add new costomer excel';
    $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('user/dashboard').'">Home</a></li><li><a href="'.base_url('admin/costomer').'">Costomer List</a></li><li class="active">Add new costomer excel</li>';

    $data['succmsg'] = '';
    $data['errmsg'] = '';
    $this->load->view('admin/costomer/add_costomer_excel',$data);

 }

 public function add_new_costomer_excel_data(){
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
                                                $exceldata['SAPSoldto'] = trim($value['A']);
                                                $exceldata['Name']    = trim($value['B']);
                                                $exceldata['PinCode']    = trim($value['C']);
                                                $exceldata['State']    = trim($value['D']);
                                                $exceldata['CustMobileNo']    = trim($value['E']);
                                                $exceldata['MODEOFTRANSPORT']    = trim($value['F']);
                                                $exceldata['COLDCHAINTRANSPORTER']    = trim($value['G']);
                                                $exceldata['NONCOLDCHAINTRANSPORTER']    = trim($value['H']);
                                                

                                               //$exceldata['TaxableAmount'] = $objPHPExcel->getActiveSheet()->rangeToArray('H2:R4');
                                                $excel_master_data[] = $exceldata;
                                            }
                                        }
                                    }

                            }
                            $objPHPExcel->disconnectWorksheets();
                            unset($objPHPExcel);

                            if(!empty($excel_master_data) && count($excel_master_data) > 0) {
                                    //echo "<pre>";print_r($excel_master_data);
                                    //exit;
                                 $details_arr = $this->Costomer_model->batchInsertdata($excel_master_data);
                                }
                            unlink($file);
                            $this->session->set_flashdata('succmsg', 'Sucessfully ' . $extension . ' file imported');
                            redirect(base_url() . "admin/costomer/");

                        }
                    }else{
                        $this->session->set_flashdata('errmsg', 'Only ' . $valid_extension[0] . ' And '.$valid_extension[2] .' '.'extension are allowed.');
                            redirect(base_url() . "admin/costomer/add_new_costomer_excel");

                    }
                
            }
  
 }

 function category_check(){
 	$cat_id = $this->input->post('cat_id');
 	$category_name = $this->input->post('category_name');
	$count = $this->Costomer_model->check_category($cat_id,$category_name);
 	echo $count;
 }

function changestatus()
	 {
		$id = $this->input->post('id');
		$userstatus = $this->Costomer_model->getCostomerDetail($id);
		if($userstatus[0]['status']=='Active')
		{
			$user_data = array('id'=>$id,'status'=>'Inactive');
			$this->Costomer_model->addcostomer($user_data);
			echo 'Inactive';
		}
		if($userstatus[0]['status']=='Inactive')
		{
		
			$user_data = array('id'=>$id,'status'=>'Active');
			$this->Costomer_model->addcostomer($user_data);
			echo 'Active';
		}
	
	}

 }
<?php defined('BASEPATH') OR exit('No direct script access allowed');

 class Tat extends CI_Controller
 {
 	
 	public function __construct()
 	{
 		parent::__construct();
 		$this->load->model('admin/Tat_model');
        $this->controller = 'tat';
 	}

 	public function index(){
		checkAdmin($this->controller."/");
		$data=array('errmsg'=>'');
		$data = array('succmsg'=>'');
		$data['page_title']="TAT Master";

		$data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url().'">Home</a></li><li class="active">Tat Master</li>';
		$data['recordset'] = $this->Tat_model->getAllTat();
		$this->load->view('admin/tat/index',$data);
 	}

function add_tat($id= null){
	if($id !=''){
		$data['page_title']='Update TAT';
        $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/dashboard').'">Home</a></li><li><a href="'.base_url('admin/costomer').'">TAT List</a></li><li class="active">Update TAT</li>';

	}else{
		$data['page_title']='Add TAT';
        $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/dashboard').'">Home</a></li><li><a href="'.base_url('admin/costomer').'">TAT List</a></li><li class="active">Add TAT</li>';

	}
    
    $data['succmsg'] = '';
    $data['errmsg'] = '';
    $data['tatDetail'] = $this->Tat_model->getTATDetail($id)[0];
    $this->load->view('admin/tat/add_tat',$data);
 }

 function add_tat_data(){
    $consignee_address = $this->input->post('consignee_address');
    $contentId =$this->input->post('tat_id');
   if($consignee_address !=''){
   	$checkExistsmaterial = $this->Tat_model->checkExistsCategory(array('consignee_address'=>$consignee_address),$this->input->post('tat_id'));
   	if($checkExistsmaterial > 0){
	$this->session->set_flashdata('errmsg', 'Consignee Address Already Exists.');
	redirect(base_url("admin/tat/add_tat/".$contentId));
	return true;
	}else{

      $data = array(
            'id'=>$this->input->post('tat_id'),
            'consignee_address'=>$this->input->post('consignee_address'),
            'type'=>$this->input->post('type'),
            'local'=>$this->input->post('local'),
            'delivery_tat_trnsport'=>$this->input->post('delivery_tat_trnsport'),
            'delivery_tat_courier'=>$this->input->post('delivery_tat_courier'),
            'status'=>'active',
            'admin_id'=>$this->session->userdata('admin_id'),
            'update_at'=>date('Y-m-d H:i:s')

        );

        //print_r($data); exit();
        $last_id = $this->Tat_model->addtat($data);

      }

        if(!empty($data['id'])){
        	$this->session->set_flashdata('succmsg', "<b>".ucfirst($this->input->post('consignee_address'))."</b> Updated Successfully");
        }else{
        	$this->session->set_flashdata('succmsg', "<b>".ucfirst($this->input->post('consignee_address'))."</b> Add Successfully");
        }
        
        redirect('admin/tat');




    }else{
        redirect('admin/tat','refresh');
    }


 }

  public function add_new_tat_excel(){
    $data['page_title']='Add new tat excel';
    $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('user/dashboard').'">Home</a></li><li><a href="'.base_url('admin/costomer').'">TAT List</a></li><li class="active">Add new costomer excel</li>';

    $data['succmsg'] = '';
    $data['errmsg'] = '';
    $this->load->view('admin/tat/add_tat_excel',$data);

 }

 public function add_new_tat_excel_data(){
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
                                                $exceldata['ConsigneeAddress'] = trim($value['A']);
                                                $exceldata['Type']    = trim($value['B']);
                                                $exceldata['Local']    = trim($value['C']);
                                                $exceldata['DELV_TAT_TRNSPORT']    = trim($value['D']);
                                                $exceldata['DELV_TAT_COURIER']    = trim($value['E']);
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
                                 $details_arr = $this->Tat_model->batchInsertdata($excel_master_data);
                                }
                            unlink($file);
                            $this->session->set_flashdata('succmsg', 'Sucessfully ' . $extension . ' file imported');
                            redirect(base_url() . "admin/tat/");

                        }
                    }else{
                        $this->session->set_flashdata('errmsg', 'Only ' . $valid_extension[0] . ' And '.$valid_extension[2] .' '.'extension are allowed.');
                            redirect(base_url() . "admin/tat/add_new_tat_excel");

                    }
                
            }
  
 }

 function category_check(){
 	$cat_id = $this->input->post('cat_id');
 	$category_name = $this->input->post('category_name');
	$count = $this->Tat_model->check_category($cat_id,$category_name);
 	echo $count;
 }

function changestatus()
	 {
		$id = $this->input->post('id');
		$userstatus = $this->Tat_model->getTATDetail($id);
		if($userstatus[0]['status']=='Active')
		{
			$user_data = array('id'=>$id,'status'=>'Inactive');
			$this->Tat_model->addtat($user_data);
			echo 'Inactive';
		}
		if($userstatus[0]['status']=='Inactive')
		{
		
			$user_data = array('id'=>$id,'status'=>'Active');
			$this->Tat_model->addtat($user_data);
			echo 'Active';
		}
	
	}

 }
<?php defined('BASEPATH') OR exit('No direct script access allowed');

 class Item extends CI_Controller
 {
 	
 	public function __construct()
 	{
 		parent::__construct();
 		$this->load->model('admin/Item_model');
        $this->controller = 'category';
 	}

 	public function index(){
		checkAdmin($this->controller."/");
		$data=array('errmsg'=>'');
		$data = array('succmsg'=>'');
		$data['page_title']="Item Master";

		$data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url().'">Home</a></li><li class="active">Item Master</li>';
		$data['recordset'] = $this->Item_model->getAllItem();
		$this->load->view('admin/item/index',$data);
 	}

function add_item($id= null){
	if($id !=''){
		$data['page_title']='Update Item';
        $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/dashboard').'">Home</a></li><li><a href="'.base_url('admin/item').'">item List</a></li><li class="active">Update Item</li>';

	}else{
		$data['page_title']='Add Item';
        $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/dashboard').'">Home</a></li><li><a href="'.base_url('admin/item').'">Item List</a></li><li class="active">Add Item</li>';

	}
    
    $data['succmsg'] = '';
    $data['errmsg'] = '';
    $data['itemDetail'] = $this->Item_model->getItemDetail($id)[0];
    $this->load->view('admin/item/add_item',$data);
 }

 function add_item_data(){
    $material_code = $this->input->post('material_code');
    $contentId =$this->input->post('item_id');
   if($material_code !=''){
   	$checkExistsmaterial = $this->Item_model->checkExistsCategory(array('material_code'=>$material_code),$this->input->post('item_id'));
   	if($checkExistsmaterial > 0){
	$this->session->set_flashdata('errmsg', 'Material Code Already Exists.');
	redirect(base_url("admin/item/add_item/".$contentId));
	return true;
	}else{

      $data = array(
            'id'=>$this->input->post('item_id'),
            'material_code'=>$this->input->post('material_code'),
            'material_name'=>$this->input->post('material_name'),
            'cold_chain_non_cold_chain'=>$this->input->post('cold_chain_non_cold_chain'),
            'fixed_weight'=>$this->input->post('fixed_weight'),
            'status'=>'active',
            'admin_id'=>$this->session->userdata('admin_id'),
            'update_at'=>date('Y-m-d H:i:s')

        );

        //print_r($data); exit();
        $last_id = $this->Item_model->additem($data);

      }

        if(!empty($data['id'])){
        	$this->session->set_flashdata('succmsg', "<b>".ucfirst($this->input->post('material_name'))."</b> Updated Successfully");
        }else{
        	$this->session->set_flashdata('succmsg', "<b>".ucfirst($this->input->post('material_name'))."</b> Add Successfully");
        }
        
        redirect('admin/item');




    }else{
        redirect('admin/cms','refresh');
    }


 }

  public function add_new_item_excel(){
    $data['page_title']='Add new excel';
    $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('user/dashboard').'">Home</a></li><li><a href="'.base_url('admin/item').'">Item List</a></li><li class="active">Add new excel</li>';

    $data['succmsg'] = '';
    $data['errmsg'] = '';
    $this->load->view('admin/item/add_item_excel',$data);

 }

 public function add_new_item_excel_data(){
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
                                                $exceldata['MaterialCode'] = trim($value['A']);
                                                $exceldata['MaterialName']    = trim($value['B']);
                                                $exceldata['ColdChain/NonColdChain']    = trim($value['C']);
                                                $exceldata['Fixedweight']    = trim($value['D']);

                                               //$exceldata['TaxableAmount'] = $objPHPExcel->getActiveSheet()->rangeToArray('H2:R4');
                                                $excel_master_data[] = $exceldata;
                                            }
                                        }
                                    }

                            }
                            $objPHPExcel->disconnectWorksheets();
                            unset($objPHPExcel);

                            if(!empty($excel_master_data) && count($excel_master_data) > 0) {

                                    $details_arr = $this->Item_model->batchInsertdata($excel_master_data);
                                }
                            unlink($file);
                            $this->session->set_flashdata('succmsg', 'Sucessfully ' . $extension . ' file imported');
                            redirect(base_url() . "admin/item/");

                        }
                    }else{
                        $this->session->set_flashdata('errmsg', 'Only ' . $valid_extension[0] . ' And '.$valid_extension[2] .' '.'extension are allowed.');
                            redirect(base_url() . "admin/item/add_new_item_excel");

                    }
                
            }
  
 }

 function category_check(){
 	$cat_id = $this->input->post('cat_id');
 	$category_name = $this->input->post('category_name');
	$count = $this->Item_model->check_category($cat_id,$category_name);
 	echo $count;
 }

function changestatus()
	 {
		$id = $this->input->post('id');
		$userstatus = $this->Item_model->getItemDetail($id);
		if($userstatus[0]['status']=='Active')
		{
			$user_data = array('id'=>$id,'status'=>'Inactive');
			$this->Item_model->additem($user_data);
			echo 'Inactive';
		}
		if($userstatus[0]['status']=='Inactive')
		{
		
			$user_data = array('id'=>$id,'status'=>'Active');
			$this->Item_model->additem($user_data);
			echo 'Active';
		}
	
	}

 }
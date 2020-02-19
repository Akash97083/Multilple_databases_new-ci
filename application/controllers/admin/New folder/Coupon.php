<?php defined('BASEPATH') OR exit('No direct script access allowed');

 class Coupon extends CI_Controller
 {
 	
 	public function __construct()
 	{
 		parent::__construct();
 		$this->load->model('admin/Coupon_model');
        $this->controller = 'Coupon';
 	}

 	public function index(){
		checkAdmin($this->controller."/");
		$data=array('errmsg'=>'');
		$data = array('succmsg'=>'');
		$data['page_title']="Manage Coupon";

		$data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url().'">Home</a></li><li class="active">Manage Coupon</li>';
		$data['recordset'] = $this->Coupon_model->getAllCoupon();
		$this->load->view('admin/coupon/index',$data);
 	}

function add_coupon($id= null){
	if($id !=''){
		$data['page_title']='Update Coupon';
        $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/dashboard').'">Home</a></li><li><a href="'.base_url('admin/coupon').'">Coupon List</a></li><li class="active">Update Coupon</li>';

	}else{
		$data['page_title']='Add Coupon';
        $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/dashboard').'">Home</a></li><li><a href="'.base_url('admin/coupon').'">Coupon List</a></li><li class="active">Add Coupon</li>';

	}
    
    $data['succmsg'] = '';
    $data['errmsg'] = '';
    $data['CouponDetail'] = $this->Coupon_model->getCouponDetail($id)[0];
    $this->load->view('admin/coupon/add_coupon',$data);
 }

 function coupon_data(){
    $Coupon_name = $this->input->post('coupon_code');
    $contentId =$this->input->post('coupon_id');
   if($Coupon_name !=''){
   	$checkExistsCoupon = $this->Coupon_model->checkExistsCoupon(array('coupon_name'=>$Coupon_name),$this->input->post('coupon_id'));
    //echo $checkExistsCoupon; exit;
   	if($checkExistsCoupon > 0){
	$this->session->set_flashdata('errmsg', 'Coupon Already Exists.');
	redirect(base_url("admin/coupon/add_coupon/".$contentId));
	return true;
	}else{

      $data = array(
            'id'=>$this->input->post('coupon_id'),
            'coupon_code'=>$this->input->post('coupon_code'),
            'coupon_type'=>$this->input->post('coupon_type'),
            'coupon_value'=>$this->input->post('coupon_value'),
            'decription'=>$this->input->post('description'),
            'status'=>'active',
            'user_id'=>$this->session->userdata('user_id'),
            'when_added'=>date('Y-m-d H:i:s')

        );

        //print_r($data); exit();
        $last_id = $this->Coupon_model->addCoupon($data);

      }

        if(!empty($data['id'])){
        	$this->session->set_flashdata('succmsg', "".ucfirst($Coupon_name)." Updated Successfully");
        }else{
        	$this->session->set_flashdata('succmsg', "".$Coupon_name." Add Successfully");
        }
        
        redirect('admin/Coupon');




    }else{
        redirect('admin/cms','refresh');
    }


 }

 function coupon_check(){
 	$coupon_id = $this->input->post('coupon_id');
 	$coupon_name = $this->input->post('coupon_name');
	$count = $this->Coupon_model->check_coupon($coupon_id,$coupon_name);
 	echo $count;
 }

function changestatus()
	 {
		$id = $this->input->post('id');
		$userstatus = $this->Coupon_model->getCouponDetail($id);
		if($userstatus[0]['status']=='Active')
		{
			$user_data = array('id'=>$id,'status'=>'Inactive');
			$this->Coupon_model->addCoupon($user_data);
			echo 'Inactive';
		}
		if($userstatus[0]['status']=='Inactive')
		{
		
			$user_data = array('id'=>$id,'status'=>'Active');
			$this->Coupon_model->addCoupon($user_data);
			echo 'Active';
		}
	
	}

 }
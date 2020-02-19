<?php defined('BASEPATH') OR exit('No direct script access allowed');

 class Company extends CI_Controller
 {
 	
 	public function __construct()
 	{
 		parent::__construct();
 		$this->load->model('admin/Company_model');
        //$this->load->model('admin/Location_model');
        $this->controller = 'company';
        checkAdmin($this->controller."/");
 	}

 	public function index(){
		checkAdmin($this->controller."/");
		$data=array('errmsg'=>'');
		$data = array('succmsg'=>'');
		$data['page_title']="Manage Company";

		$data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url().'">Home</a></li><li class="active">Manage User</li>';
		$data['recordset'] = $this->Company_model->getAllCompany();
		$this->load->view('admin/company/index',$data);
 	}

function add_company($id= null){
	if($id !=''){
		$data['page_title']='User Detail';
        $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/dashboard').'">Home</a></li><li><a href="'.base_url('admin/company').'">User List</a></li><li class="active">Company Detail</li>';
        $data['companyDetail'] = $this->Company_model->getCompanyDetail($id)[0];

	}else{
		$data['page_title']='Add User';
        $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/dashboard').'">Home</a></li><li><a href="'.base_url('admin/company').'">User List</a></li><li class="active">Add Company</li>';
        $data['companyDetail'] = array();

	}
    
    $data['succmsg'] = '';
    $data['errmsg'] = '';
    
    $this->load->view('admin/company/add_company',$data);
 }

 function company_data(){
    $company_name = $this->input->post('company_name');
    $contentId =$this->input->post('company_id');
   if($company_name !=''){
   	$checkEmailUser = $this->Company_model->checkCompanyName(array('company_name'=>$company_name),$this->input->post('company_id'));
   	if($checkEmailUser > 0){
	$this->session->set_flashdata('errmsg', 'Company name Already Exists.');
	redirect(base_url("admin/company/add_company/".$contentId));
	return true;
	}else{

      $data = array(
            'id'=>$this->input->post('company_id'),
            'company_name'=>$this->input->post('company_name'),
            'description'=>$this->input->post('description'),
            'status'=>'active',
            'admin_id'=>$this->session->userdata('admin_id'),
            'update_at'=>date('Y-m-d H:i:s')

        );

        // print_r($data); exit();
        $last_id = $this->Company_model->addCompany($data);

      }

        if(!empty($data['id'])){
        	$this->session->set_flashdata('succmsg', "Company <b>".ucfirst($this->input->post('company_name'))."</b> Updated Successfully");
        }else{
        	$this->session->set_flashdata('succmsg', "Company <b>".ucfirst($this->input->post('company_name'))."</b> Add Successfully");
        }
        
        redirect('admin/company');
    }


 }

 function User_check(){
 	$cat_id = $this->input->post('cat_id');
 	$User_name = $this->input->post('User_name');
	$count = $this->Company_model->check_User($cat_id,$User_name);
 	echo $count;
 }

function changestatus()
	 {
		$id = $this->input->post('id');
		$userstatus = $this->Company_model->getCompanyDetail($id);
		if($userstatus[0]['status']=='Active')
		{
			$user_data = array('id'=>$id,'status'=>'Inactive');
			$this->Company_model->addCompany($user_data);
			echo 'Inactive';
		}
		if($userstatus[0]['status']=='Inactive')
		{
		
			$user_data = array('id'=>$id,'status'=>'Active');
			$this->Company_model->addCompany($user_data);
			echo 'Active';
		}
	
	}

 public function email_check(){
    $id = $this->input->post('id');
    $email_id = $this->input->post('email_id');
    $count = $this->Company_model->checkEmailUser(array('email_id'=>$email_id),$id);
    echo $count;
 }

 }
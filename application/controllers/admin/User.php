<?php defined('BASEPATH') OR exit('No direct script access allowed');

 class User extends CI_Controller
 {
 	
 	public function __construct()
 	{
 		parent::__construct();
 		$this->load->model('admin/User_model');
        $this->load->model('admin/Branch_model');
        $this->controller = 'user';
        checkAdmin($this->controller."/");
 	}

 	public function index(){
		checkAdmin($this->controller."/");
		$data=array('errmsg'=>'');
		$data = array('succmsg'=>'');
		$data['page_title']="Manage User";

		$data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url().'">Home</a></li><li class="active">Manage User</li>';
		$data['recordset'] = $this->User_model->getAllUser();
		$this->load->view('admin/user/index',$data);
 	}

function add_user($id= null){
	if($id !=''){
		$data['page_title']='User Detail';
        $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/dashboard').'">Home</a></li><li><a href="'.base_url('admin/user').'">User List</a></li><li class="active">User Detail</li>';

	}else{
		$data['page_title']='Add User';
        $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/dashboard').'">Home</a></li><li><a href="'.base_url('admin/User').'">User List</a></li><li class="active">Add User</li>';

	}
    
    $data['succmsg'] = '';
    $data['errmsg'] = '';
    $data['UserDetail'] = $this->User_model->getUserDetail($id)[0];
    $data['allbranch'] = $this->Branch_model->GetAllBranch();
    $this->load->view('admin/user/add_user',$data);
 }

 function User_data(){
    $email_id = $this->input->post('email_id');
    $contentId =$this->input->post('user_id');
   if($email_id !=''){
   	$checkEmailUser = $this->User_model->checkEmailUser(array('email_id'=>$email_id),$this->input->post('user_id'));
   	if($checkEmailUser > 0){
	$this->session->set_flashdata('errmsg', 'User Email Already Exists.');
	redirect(base_url("admin/User/add_User/".$contentId));
	return true;
	}else{

      $data = array(
            'id'=>$this->input->post('user_id'),
            'full_name'=>$this->input->post('user_name'),
            'email_id'=>$this->input->post('email_id'),
            'branch_id'=>$this->input->post('branch_id'),
            'contact_no'=>$this->input->post('mobile_number'),
            'location'=>$this->input->post('location'),
            'status'=>'active',
            'admin_id'=>$this->session->userdata('admin_id'),
            'update_at'=>date('Y-m-d H:i:s')

        );

        //print_r($data); exit();
        $last_id = $this->User_model->addUser($data);

      }

        if(!empty($data['id'])){
        	$this->session->set_flashdata('succmsg', "User <b>".ucfirst($this->input->post('user_name'))."</b> Updated Successfully");
        }else{
        	$this->session->set_flashdata('succmsg', "User <b>".ucfirst($this->input->post('user_name'))."</b> Add Successfully");
        }
        
        redirect('admin/user');
    }


 }

 function User_check(){
 	$cat_id = $this->input->post('cat_id');
 	$User_name = $this->input->post('User_name');
	$count = $this->User_model->check_User($cat_id,$User_name);
 	echo $count;
 }

function changestatus()
	 {
		$id = $this->input->post('id');
		$userstatus = $this->User_model->getUserDetail($id);
		if($userstatus[0]['status']=='Active')
		{
			$user_data = array('id'=>$id,'status'=>'Inactive');
			$this->User_model->addUser($user_data);
			echo 'Inactive';
		}
		if($userstatus[0]['status']=='Inactive')
		{
		
			$user_data = array('id'=>$id,'status'=>'Active');
			$this->User_model->addUser($user_data);
			echo 'Active';
		}
	
	}

 public function email_check(){
    $id = $this->input->post('id');
    $email_id = $this->input->post('email_id');
    $count = $this->User_model->checkEmailUser(array('email_id'=>$email_id),$id);
    echo $count;
 }

 }
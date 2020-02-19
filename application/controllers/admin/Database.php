<?php defined('BASEPATH') OR exit('No direct script access allowed');

 class Database extends CI_Controller
 {
 	
 	public function __construct()
 	{
 		parent::__construct();
 		$this->load->model('admin/database_model');
        $this->controller = 'database';
        checkAdmin($this->controller."/");
 	}

 	public function index(){
		checkAdmin($this->controller."/");
		$data=array('errmsg'=>'');
		$data = array('succmsg'=>'');
		$data['page_title']="Manage Databases";

		$data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url().'">Home</a></li><li class="active">Manage User</li>';
		$data['recordset'] = $this->database_model->getAllDB();
		$this->load->view('admin/database/index',$data);
 	}

function add_database($id= null){
	if($id !=''){
		$data['page_title']='Databases Detail';
        $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/dashboard').'">Home</a></li><li><a href="'.base_url('admin/database').'">User Databases</a></li><li class="active">User Databases</li>';

	}else{
		$data['page_title']='Add Databases';
        $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/dashboard').'">Home</a></li><li><a href="'.base_url('admin/database').'">User Databases</a></li><li class="active">Add Databases</li>';

	}
    
    $data['succmsg'] = '';
    $data['errmsg'] = '';
    $data['DbDetail'] = $this->database_model->getDBDetail($id)[0];
    $this->load->view('admin/database/add_database',$data);
 }

 function database_data(){
    $pin = $this->input->post('pin');
    $contentId =$this->input->post('database_id');
    if($pin !=''){
   	$checkpinUser = $this->database_model->checkpin(array('pin'=>$pin),$this->input->post('database_id'));
   	if($checkpinUser > 0){
	$this->session->set_flashdata('errmsg', 'Databases Pin Already Exists.');
	redirect(base_url("admin/database/add_database/".$contentId));
	return true;
	}else{

      $data = array(
            'id'=>$this->input->post('database_id'),
            'admin_type'=>$this->input->post('admin_type'),
            'pin'=>$this->input->post('pin'),
            'project_name'=>$this->input->post('project_name'),
            'hostname'=>$this->input->post('host_name'),
            'username'=>$this->input->post('username'),
            'db_name'=>$this->input->post('db_name'),
            'password'=>$this->input->post('db_password'),
            'status'=>'active',
            'admin_id'=>$this->session->userdata('admin_id'),
            'update_at'=>date('Y-m-d H:i:s')

        );

        //print_r($data); exit();
        $last_id = $this->database_model->adddatabase($data);

      }

        if(!empty($data['id'])){
        	$this->session->set_flashdata('succmsg', "Project <b>".ucfirst($this->input->post('project_name'))."</b> Updated Successfully");
        }else{
        	$this->session->set_flashdata('succmsg', "Project <b>".ucfirst($this->input->post('project_name'))."</b> Add Successfully");
        }
        
        redirect('admin/database');
    }


 }

 function User_check(){
 	$cat_id = $this->input->post('cat_id');
 	$User_name = $this->input->post('User_name');
	$count = $this->database_model->check_User($cat_id,$User_name);
 	echo $count;
 }

function changestatus()
	 {
		$id = $this->input->post('id');
		$userstatus = $this->database_model->getDBDetail($id);
		if($userstatus[0]['status']=='Active')
		{
			$user_data = array('id'=>$id,'status'=>'Inactive');
			$this->database_model->adddatabase($user_data);
			echo 'Inactive';
		}
		if($userstatus[0]['status']=='Inactive')
		{
		
			$user_data = array('id'=>$id,'status'=>'Active');
			$this->database_model->adddatabase($user_data);
			echo 'Active';
		}
	
	}

 public function pin_check(){
    $id = $this->input->post('id');
    $pin = $this->input->post('pin');
    $count = $this->database_model->checkpin(array('pin'=>$pin),$id);
    echo $count;
 }

 }
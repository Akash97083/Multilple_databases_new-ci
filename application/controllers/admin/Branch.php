<?php 
defined('BASEPATH') OR exit ('No direct script access allowed');
class Branch extends Ci_controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('admin/Branch_model');
		$this->load->model('admin/Company_model');
		checkAdmin($this->controller."/");
		
	}

	public function index(){
		checkAdmin($this->controller."/");
		$data=array('errmsg'=>'');
		$data = array('succmsg'=>'');
		$data['page_title']="Manage Branch";

		$data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url().'">Home</a></li><li class="active">Manage Branch</li>';
		$data['recordset'] = $this->Branch_model->GetAllBranch();
		$this->load->view('admin/branch/index',$data);
	}


	public function add_branch($id = NULL){
		if($id !=''){
			$data['page_title']='Edit Branch';
        $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/dashboard').'">Home</a></li><li><a href="'.base_url('admin/branch').'">Branch List</a></li><li class="active">Branch Detail</li>';

		}else{
			$data['page_title']='Add New Branch';
        $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/dashboard').'">Home</a></li><li><a href="'.base_url('admin/branch').'">Branch List</a></li><li class="active">Add New Branch</li>';

		}

		$data['succmsg'] = '';
		$data['errmsg'] = '';
		$data['all_company'] = $this->Company_model->getAllCompany();
		$data['BranchDetail'] = $this->Branch_model->getBranchDetail($id)[0];
		$this->load->view('admin/branch/add_branch',$data);

	}

	public function branch_data(){
		$data = array(
			'id'=>$this->input->post('branch_id'),
			'company_id'=>$this->input->post('company_id'),
			'branch_name'=>$this->input->post('branch_name'),
			'branch_code'=>$this->input->post('branch_code'),
			'branch_description'=>$this->input->post('branch_description'),
			'update_at'=>date('Y-m-d H:i:s')
		);

		$this->Branch_model->AddBranch($data);

		if(!empty($data['id'])){
        	$this->session->set_flashdata('succmsg', " Branch <b>".ucfirst($this->input->post('branch_name'))."</b> Updated Successfully");
        }else{
        	$this->session->set_flashdata('succmsg', " Branch <b>".ucfirst($this->input->post('branch_name'))."</b> Add Successfully");
        }
        
        redirect('admin/branch');


	}

	function changestatus()
	 {
		$id = $this->input->post('id');
		$userstatus = $this->Branch_model->getBranchDetail($id);
		if($userstatus[0]['status']=='Active')
		{
			$user_data = array('id'=>$id,'status'=>'Inactive');
			$this->Branch_model->AddBranch($user_data);
			echo 'Inactive';
		}
		if($userstatus[0]['status']=='Inactive')
		{
		
			$user_data = array('id'=>$id,'status'=>'Active');
			$this->Branch_model->AddBranch($user_data);
			echo 'Active';
		}
	
	}


	///////////// End Class ////////////
}
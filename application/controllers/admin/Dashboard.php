<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        checkAdmin('');
        $this->load->model('admin/Admin_model');
        $this->controller = 'global_settings';
    }

	
	public function index()
	{ 
		checkAdmin($this->controller."/");
		$data['page_title'] = 'Dashboard';
		$this->load->view('admin/dashboard/index',$data);
	}

 function global_settings(){
 	checkAdmin($this->controller."/");
 	$data['page_title'] = 'global_settings';
 	$data['global'] = $this->ModelGlobal_settings->getGlobalData();

	$data['breadcrumb']			= '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url().'">Home</a></li><li class="active">Global Settings</li>';
 	$data['succmsg']= '';
 	$data['errmsg']= '';
	$this->load->view('admin/global_settings/index',$data);
 	
 }
	
 function logout(){
  checkAdmin($this->controller."/");
  $this->session->sess_destroy();
  redirect(base_url("admin/"));

  }


 function change_password()
	{
	  checkAdmin($this->controller.'/change_password/');

		$data['page_title']	= 'Change Password';

		$data['breadcrumb']	= '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/dashboard').'">Home</a></li><li class="active">Change Password</li>';

		$data['msg'] = "";
		
		$data['back_link'] 	 = base_url('admin/dashboard');

		$id = $this->session->userdata('admin_id');

		$data['succmsg'] = $this->session->userdata('succmsg');

		$data['errmsg'] = $this->session->userdata('errmsg');


		$this->session->set_userdata('succmsg', "");

		$this->session->set_userdata('errmsg', "");
		$this->load->view('admin/dashboard/change_password',$data);

	}

  function do_changepass()
	{
		$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|min_length[5]|max_length[20]|xss_clean');

		$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[5]|max_length[20]|matches[confirm_new_password]|xss_clean');

		$this->form_validation->set_rules('confirm_new_password', 'Comfirm New Password','trim|required|min_length[5]|max_length[20]|xss_clean');

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		

		$id = $this->session->userdata('admin_id');

		$data['msg'] = "";

		if($this->form_validation->run() == FALSE)
		{
			$data['oldpassword'] = $this->input->post('old_password');
			//print_r($data['oldpassword']); exit;
			$isTrue = $this->Admin_model->valideOldPassword($data);
			
			if($isTrue)
			{
				$data['new_admin_pwd'] = $this->input->post('new_password');

				$this->Admin_model->updateAdminPass($id,$data);
				
				//updateLog('Change Password','Account Password Changed');

				$this->session->set_userdata('succmsg',"Password Changed Successfully.");
				
			}
			else
			{
				$this->session->set_userdata('errmsg',"Invalid Old Password.");
			}			
			
			redirect(base_url('admin/dashboard/change_password/'));
			return true;
		}
		else
		{
			$this->change_password(); 
			return true;
		}
	}

 function profile(){
 	$this->load->view('admin/dashboard/profile');
 }

////////////////// End Class /////////////////////

}

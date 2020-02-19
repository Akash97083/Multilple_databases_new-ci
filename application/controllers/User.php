<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('class/utcpro.class.php');
include_once('class/utcpro.settings.php');

class User extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('front/User_model');
        $d   = filter_input(INPUT_GET, 'd', FILTER_SANITIZE_STRING);
        $w   = (int) filter_input(INPUT_GET, 'w', FILTER_SANITIZE_NUMBER_INT);
        $h   = (int) filter_input(INPUT_GET, 'h', FILTER_SANITIZE_NUMBER_INT);
        $this->controller = 'user';
        $this->load->library('cart');
        $this->load->helper('captcha');
      }

  public function index()
	{
    $data=array('errmsg'=>'');
		$this->load->view('front/index',$data);
	}

  function user_do_login(){
    $data['email'] = $this->input->post("email");
    $data['password'] = $this->input->post("password");
    $check_login = $this->User_model->check_user($data);
    if($check_login!='') {
      redirect(base_url("user/dashboard/"));
    } else {
            $this->session->set_flashdata('errmsg', "Invalid username and/or password.");
            redirect(base_url($this->controller."/"));
          }
  }

  public function dashboard(){
    checkUser($this->controller.'/dashboard/');
    $data['page_title'] = 'Welcome user';
    $this->load->view('front/dashboard/index',$data);
  }

  public function logout(){
    checkUser($this->controller."/");
    $this->session->sess_destroy();
    redirect(base_url("/"));
  }

  public function change_password(){

    checkUser($this->controller.'/change_password/');

    $data['page_title'] = 'Change Password';

    $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('user/dashboard').'">Home</a></li><li class="active">Change Password</li>';

    $data['msg'] = "";
    
    $data['back_link']   = base_url('user/dashboard');

    $data['succmsg'] = $this->session->userdata('succmsg');

    $data['errmsg'] = $this->session->userdata('errmsg');


    $this->session->set_userdata('succmsg', "");

    $this->session->set_userdata('errmsg', "");
    $this->load->view('front/dashboard/change_password',$data);

  }
function do_changepass()
  {
    $this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|min_length[5]|max_length[20]|xss_clean');

    $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[5]|max_length[20]|matches[confirm_new_password]|xss_clean');

    $this->form_validation->set_rules('confirm_new_password', 'Comfirm New Password','trim|required|min_length[5]|max_length[20]|xss_clean');

    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    

    $user_email = $this->session->userdata('user_email');

    $data['msg'] = "";

    if($this->form_validation->run() == FALSE)
    {
      $data['oldpassword'] = $this->input->post('old_password');
      //print_r($data['oldpassword']); exit;
      $isTrue = $this->User_model->valideOldPassword($data);
      
      if($isTrue)
      {
        $data['new_admin_pwd'] = $this->input->post('new_password');

        $this->User_model->updateUserPass($user_email,$data);
        
        //updateLog('Change Password','Account Password Changed');

        $this->session->set_userdata('succmsg',"Password Changed Successfully.");
        
      }
      else
      {
        $this->session->set_userdata('errmsg',"Invalid Old Password.");
      }     
      
      redirect(base_url('user/change_password/'));
      return true;
    }
    else
    {
      $this->change_password(); 
      return true;
    }
  }
////////////////// End Class /////////////////////

}

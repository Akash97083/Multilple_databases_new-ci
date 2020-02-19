<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Admin_model');
        $this->controller = 'admin';
    }


	public function index()
	{
		 //checkAdmin($this->controller."/");
		$data=array('errmsg'=>'');
		$this->load->view('admin/pin',$data);
	}


function do_pin(){
        $data = array();

        $this->form_validation->set_rules('pin', 'PIN', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');


            $data['pin'] = $this->input->post("pin");
            $check_login = $this->Admin_model->check_pin($data);
            //print_r($check_login); exit;
            if($check_login!='') {
                redirect(base_url("admin/login/"));
                

             } else {
                $this->session->set_flashdata('errmsg', "Invalid Pin Contect Your Administrator.");
               redirect(base_url($this->controller."/"));
                

            }
    
        }
    public function login()
    {
        checkPIN($this->controller."/");
        //$userDB = ChkDB();
        //print_r($userDB);
        $data=array('errmsg'=>'');
        $this->load->view('admin/login',$data);
    }

function do_login(){
		$data = array();

	    $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');


			$data['email'] = $this->input->post("email");
            $data['password'] = $this->input->post("password");
            //$check_login = array();
            //print_r($data);exit;
            $check_login = $this->Admin_model->check_admin($data);
            //print_r($check_login); exit;
            if($check_login!='') {
            	redirect(base_url("admin/dashboard/"));
            	

             } else {
             	$this->session->set_flashdata('errmsg', "Invalid username and/or password.");
               redirect(base_url($this->controller."/login"));
				

            }
	
		}


////////////////// End Class /////////////////////

}

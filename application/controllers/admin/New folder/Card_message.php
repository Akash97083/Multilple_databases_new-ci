<?php defined('BASEPATH') OR exit('No direct script access allowed');

 class Card_message extends CI_Controller
 {
 	
 	public function __construct()
 	{
 		parent::__construct();
 		$this->load->model('admin/Card_message_model');
        $this->controller = 'card_message';
 	}

 	public function index(){
		checkAdmin($this->controller."/");
		$data=array('errmsg'=>'');
		$data = array('succmsg'=>'');
		$data['page_title']="Manage Card Message";

		$data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url().'">Home</a></li><li class="active">Manage Card Message</li>';
		$data['recordset'] = $this->Card_message_model->getCardMessage();
		$this->load->view('admin/card_message/index',$data);
 	}

function add_card_message($id= null){
	if($id !=''){
		$data['page_title']='Update Card Message';
        $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/dashboard').'">Home</a></li><li><a href="'.base_url('admin/category').'">Card Message List</a></li><li class="active">Update Card Message</li>';

	}else{
		$data['page_title']='Add Card Message';
        $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/dashboard').'">Home</a></li><li><a href="'.base_url('admin/category').'">Card Message List</a></li><li class="active">Add Card Message</li>';

	}
    
    $data['succmsg'] = '';
    $data['errmsg'] = '';
    $data['CardMessageDetail'] = $this->Card_message_model->getCardMessageDetail($id)[0];
    $this->load->view('admin/card_message/add_card_message',$data);
 }

 function card_message_data(){
    $short_message = $this->input->post('short_message');
    $contentId =$this->input->post('card_medssage_id');
   if($short_message !=''){
   	$checkExistsCardMessage = $this->Card_message_model->checkExistsCardMessage(array('short_message'=>$short_message),$this->input->post('card_medssage_id'));
   	if($checkExistsCardMessage > 0){
	$this->session->set_flashdata('errmsg', 'Card Message Already Exists.');
	redirect(base_url("admin/card_message/add_card_message/".$contentId));
	return true;
	}else{

      $data = array(
            'id'=>$this->input->post('card_medssage_id'),
            'short_name'=>$this->input->post('short_message'),
            'description'=>$this->input->post('description'),
            'status'=>'active',
            'user_id'=>$this->session->userdata('user_id'),
            'when_added'=>date('Y-m-d H:i:s')

        );

        $last_id = $this->Card_message_model->addCardMessage($data);

      }

        if(!empty($data['id'])){
        	$this->session->set_flashdata('succmsg', "".ucfirst($short_message)." Updated Successfully");
        }else{
        	 $this->session->set_flashdata('succmsg', "".$short_message." Add Successfully");
        }
        
        redirect('admin/card_message');




    }else{
        redirect('admin/card_message','refresh');
    }


 }

 function short_message_check(){
 	$short_message_id = $this->input->post('short_message_id');
 	$short_message_name = $this->input->post('short_message_name');
	$count = $this->Card_message_model->check_short_message($short_message_id,$short_message_name);
 	echo $count;
 }

function changestatus()
	 {
		$id = $this->input->post('id');
		$userstatus = $this->Card_message_model->getCardMessageDetail($id);
		if($userstatus[0]['status']=='Active')
		{
			$user_data = array('id'=>$id,'status'=>'Inactive');
			$this->Card_message_model->addCardMessage($user_data);
			echo 'Inactive';
		}
		if($userstatus[0]['status']=='Inactive')
		{
		
			$user_data = array('id'=>$id,'status'=>'Active');
			$this->Card_message_model->addCardMessage($user_data);
			echo 'Active';
		}
	
	}


 	

///////////// End Class /////////////////////////
 }
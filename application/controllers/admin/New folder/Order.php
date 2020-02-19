<?php defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'libraries/PHPMailer/PHPMailerAutoload.php');
 class Order extends CI_Controller
 {
 	
 	public function __construct()
 	{
 		parent::__construct();
 		$this->load->model('admin/Order_model');
        $this->controller = 'order';
        $d   = filter_input(INPUT_GET, 'd', FILTER_SANITIZE_STRING);
        $w   = (int) filter_input(INPUT_GET, 'w', FILTER_SANITIZE_NUMBER_INT);
        $h   = (int) filter_input(INPUT_GET, 'h', FILTER_SANITIZE_NUMBER_INT);
 	}

 	public function index(){
		checkAdmin($this->controller."/");
		$data=array('errmsg'=>'');
		$data = array('succmsg'=>'');
		$data['page_title']="Manage order";

		$data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url().'">Home</a></li><li class="active">Manage order</li>';
		$data['recordset'] = $this->Order_model->getAllorder();
		$this->load->view('admin/order/index',$data);
 	}

function add_order($id= null){
	if($id !=''){
		$data['page_title']='Update order';
        $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/dashboard').'">Home</a></li><li><a href="'.base_url('admin/order').'">order List</a></li><li class="active">Update order</li>';

	}else{
		$data['page_title']='Add order';
        $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/dashboard').'">Home</a></li><li><a href="'.base_url('admin/order').'">order List</a></li><li class="active">Add order</li>';

	}
    
    $data['succmsg'] = '';
    $data['errmsg'] = '';
    $data['orderDetail'] = $this->Order_model->getorderDetail($id)[0];
    $data['receiverDetail'] = $this->Order_model->getReceiverDetail($data['orderDetail']['shipping_id']);
    $this->load->view('admin/order/add_order',$data);
 }

 function order_data(){
    $order_name = $this->input->post('order_name');
    $contentId =$this->input->post('order_id');
   if($order_name !=''){
   	$checkExistsorder = $this->Order_model->checkExistsorder(array('order_name'=>$order_name),$this->input->post('order_id'));
   	if($checkExistsorder > 0){
	$this->session->set_flashdata('errmsg', 'order Already Exists.');
	redirect(base_url("admin/order/add_order/".$contentId));
	return true;
	}else{

      $data = array(
            'id'=>$this->input->post('order_id'),
            'order_name'=>$this->input->post('order_name'),
            'description'=>$this->input->post('description'),
            'status'=>'active',
            'user_id'=>$this->session->userdata('user_id'),
            'when_added'=>date('Y-m-d H:i:s')

        );

        print_r($data); exit();
        $last_id = $this->Order_model->addorder($data);

      }

        if(!empty($data['id'])){
        	$this->session->set_flashdata('succmsg', "".ucfirst($order_name)." Updated Successfully");
        }else{
        	$this->session->set_flashdata('succmsg', "".$order_name." Add Successfully");
        }
        
        redirect('admin/order');




    }else{
        redirect('admin/cms','refresh');
    }


 }

 function order_check(){
 	$cat_id = $this->input->post('cat_id');
 	$order_name = $this->input->post('order_name');
	$count = $this->Order_model->check_order($cat_id,$order_name);
 	echo $count;
 }

function changestatus()
	 {
		$id = $this->input->post('id');
		$userstatus = $this->Order_model->getorderDetail($id);
		if($userstatus[0]['status']=='Active')
		{
			$user_data = array('id'=>$id,'status'=>'Inactive');
			$this->Order_model->addorder($user_data);
			echo 'Inactive';
		}
		if($userstatus[0]['status']=='Inactive')
		{
		
			$user_data = array('id'=>$id,'status'=>'Active');
			$this->Order_model->addorder($user_data);
			echo 'Active';
		}
	
	}

public function mail_fuction($to,$sub,$html)
    {
          $this->load->library('email');
          $config['protocol']='smtp';
          $config['smtp_host']=gethostbyname("i75rv.com");
          $config['smtp_port']='587';
          $config['smtp_user']='no-reply@i75rv.com';
          $config['smtp_pass']='[3MDN+zNel8q';
          $config['charset']='utf-8';
          $config['SMTPSecure']='tls';
          $config['newline']="\r\n";
          $config['wordwrap'] = TRUE;
          $config['mailtype'] = 'html';
          $this->email->initialize($config);
          $this->email->set_newline("\r\n");
          //$this->email->from('no-reply@saesha-flower.com',"Saesha Flower");
          $this->email->from("vishal143.niit@gmail.com","Saesha Flower");
          $this->email->to($to);// change it to yours
          if($sub!="New Message Received"){
              $this->email->cc('');
          }
          //$this->email->bcc();
          $this->email->subject($sub);
          $this->email->message($html);
          if($this->email->send()){
            return 1;
          }else{
            return "0000";
          }    
    }


function order_confirmation_data(){
    $order_id = $this->input->post('order_id');

    $to_email = $this->input->post('receiver_email');
    $subject = $this->input->post('email_subject');
    /*$html = 'Coming Soon..!!!!';
    //$mail=$this->mail_fuction($to_email,$subject,$html);
    $mail = new PHPMailer();
     $mail->isSMTP();
     $mail->Host = 'smtp.google.com';
     $mail->Mailer = 'smtp';
     $mail->Port = 587;
     $mail->SMTPAuth = true;
     $mail->Username = 'vishal143.niit@gmail.com';
     $mail->Password = '9002544556';
     $mail->SMTPSecure = 'tls';
     $mail->From = 'vishal143.niit@gmail.com';
     $mail->FromName = 'Vishal Gupta';
     $mail->addAddress(trim($to_email));
     $mail->WordWrap = 50;
     $mail->isHTML(true);
     $mail->Subject = $subject;
     $mail->Body = '<b>Coming Soon..!!!</b>';
     $mail->AltBody = 'This is the body in plain text non-Html mail client';
     $mail->send();
*/

      $Order_update = array('id'=>$order_id,'order_status'=>'confirm');
      $data['orderDetailData'] = perticularFlied('tbl_order_detail','*',array('order_id'=>$order_id));

      $message = $this->load->view('admin/email/order_confirm',$data,TRUE);
      //echo $message; exit;

      $mail=$this->mail_fuction($to_email,"Your Order Confirm",$message);

      $this->Order_model->addorder($Order_update);

     //echo "<pre>";print_r($mail); exit;
     redirect('admin/order/add_order/'.$order_id);
 }

   function email_tamplate(){

        $order_id = $this->input->post('order_id');
        $data['orderDetailData'] = perticularFlied('tbl_order_detail','*',array('order_id'=>$order_id));
         $output = array(
            'html'=>$this->load->view('admin/email/order_confirm',$data),
            'sender'=>'sdds',

        );
        echo json_encode($output);
    }
 function order_forward(){
    $order_id = $this->input->post('order_id');
    $data['orderData'] = perticularFlied('tbl_order','*',array('id'=>$order_id))[0];
         $output = array(
            'html'=>$this->load->view('admin/email/forward_order',$data),
        );

        echo json_encode($output);

 }

function forward_order_data(){
    $forward_order_to = $this->input->post('forward_order_to');
    $forward_order_email = $this->input->post('forward_order_email');
    $forword_email_subject = $this->input->post('forword_email_subject');
    $delivery_time_florist = $this->input->post('delivery_time_florist');
    $delivery_date = $this->input->post('delivery_date');
    $order_id = $this->input->post('order_id');

    $data['orderData'] = perticularFlied('tbl_order','*',array('id'=>$order_id))[0];
    //echo "<pre>";print_r($data['orderData']);
    //exit;
    $data['orderData']['vendor_name']= $forward_order_to;
    $message = $this->load->view('admin/email/forward_order',$data,TRUE);
    //print_r($message); exit;
    $mail=$this->mail_fuction($forward_order_email,"Order Forword",$message);
    redirect('admin/order/add_order/'.$order_id);
   

}

public function order_delivery(){ 

}


function order_delivery_data(){
 $order_id = $this->input->post('order_id');
 $orderData = perticularFlied('tbl_order','oder_no',array('id'=>$order_id))[0];

 $Order_update = array('id'=>$order_id,'order_status'=>'delivered');
 $this->Order_model->addorder($Order_update);
 $this->session->set_flashdata('succmsg', "Order No ".$orderData['oder_no']." Has Been Delivered Successfully");
 redirect('admin/order/add_order/'.$order_id);
  
}

/////////////End Class ///////////////////////
 }
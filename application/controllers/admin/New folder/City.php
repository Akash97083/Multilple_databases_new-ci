<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class City extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        checkAdmin('');
        $this->load->model('admin/City_model');
        $this->controller = 'city';



    }


	public function index()
	{
		checkAdmin($this->controller."/");
		$data=array('errmsg'=>'');
        $data = array('succmsg'=>'');
        $data['page_title']="Manage City";
        
        $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url().'">Home</a></li><li class="active">City List</li>';
        $data['recordset'] = $this->City_model->getAllCity();
		$this->load->view('admin/city/index',$data);
	}

 function add_city($id = null){
    $data['page_title']= ($id !=''?'Update City':'Add City');
    $data['breadcrumb'] = ($id !='' ?'<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/city/').'">Home</a></li><li class="active">Update City</li>':'<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/city/').'">Home</a></li><li class="active">Add City</li>');
    $data['succmsg'] = '';
    $data['errmsg'] = '';
    $data['city_detail'] = $this->City_model->getCityDetail($id)[0];
    $data['city_recordset'] = $this->City_model->getAllDeliveryDetail($id);
    $this->load->view('admin/city/add_city',$data);
 }

 function add_city_data(){

    $city_data = array(
        'id'=>$this->input->post('city_id'),
        'midnight_delivery'=>$this->input->post('midnight_delivery'),
        'delivery_frequency'=>$this->input->post('delivery_frequency')
    );

    $this->City_model->addCity($city_data);

    if(!empty($this->input->post('city_id'))){
           $this->session->set_flashdata('succmsg', "City Updated Successfully");
        }else{
           $this->session->set_flashdata('succmsg'," City Add Successfully");
        }

    redirect(base_url('admin/city/'));

 }


function changestatus()
     {
        $id = $this->input->post('id');
        $userstatus = $this->City_model->getCityDetail($id);
        if($userstatus[0]['status']=='Active')
        {
            $user_data = array('id'=>$id,'status'=>'Inactive');
            $this->City_model->addCity($user_data);
            echo 'Inactive';
        }
        if($userstatus[0]['status']=='Inactive')
        {
        
            $user_data = array('id'=>$id,'status'=>'Active');
            $this->City_model->addCity($user_data);
            echo 'Active';
        }
    
}

function changedeliverystatus(){
    $id = $this->input->post('id');
        $userstatus = $this->City_model->getDeliveryDetail($id);
        if($userstatus[0]['delivery_status']=='Active')
        {
            $user_data = array('id'=>$id,'delivery_status'=>'Inactive');
            $this->City_model->addDelivery($user_data);
            echo 'Inactive';
        }
        if($userstatus[0]['delivery_status']=='Inactive')
        {
        
            $user_data = array('id'=>$id,'delivery_status'=>'Active');
            $this->City_model->addDelivery($user_data);
            echo 'Active';
        }

}


 function add_delivery_data(){
    $city_id = $this->input->post('city_id');
    $from_time = $this->input->post('from_time');
    $to_time = $this->input->post('to_time');
    $city_name = getNameTable('tbl_city','city_name','id',$city_id);


    $delivery_data = array(
        'id'=>$this->input->post('delivery_id'),
        'city_id'=> $city_id,
        'from_time'=>$from_time,
        'to_time'=>$to_time,
        'delivert_charge'=>$this->input->post('delivery_charge')
    );

    $this->City_model->addDelivery($delivery_data);

    if(!empty($delivery_data['id'])){
           $this->session->set_flashdata('succmsg', "Delivery Charge Updated Successfully In ".$city_name);
        }else{
           $this->session->set_flashdata('succmsg'," Delivery Charge Add Successfully In ".$city_name);
        }

    redirect(base_url('admin/city/add_city/'.$city_id));

 }

function GetDeliveryChargeDetail(){
    $delivery_id = $this->input->post('id'); 
    $city_id = $this->input->post('city_id'); 
    $delivery_detail = $this->City_model->getDeliveryDetail($delivery_id);
    echo json_encode($delivery_detail);
    

}

////////////////// End Class /////////////////////

}

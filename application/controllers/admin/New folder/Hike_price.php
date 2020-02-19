<?php defined('BASEPATH') OR exit('No direct script access allowed');

 class Hike_price extends CI_Controller
 {
 	
 	public function __construct()
 	{
 		parent::__construct();
 		$this->load->model('admin/Hike_price_model');
        $this->controller = 'hike_price';
        $prefs = array(
        'show_next_prev'  => TRUE,
        //'next_prev_url'   => 'http://example.com/index.php/calendar/show/'
        );
        $this->load->library('calendar',$prefs);
 	}

 	public function index(){
		checkAdmin($this->controller."/");
		$data=array('errmsg'=>'');
		$data = array('succmsg'=>'');
		$data['page_title']="Manage Hike Price";

		$data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url().'">Home</a></li><li class="active">Manage Hike Price</li>';
		$data['recordset'] = $this->Hike_price_model->GetAllHikePrice();
		$this->load->view('admin/hike_price/index',$data);
 	}

function add_hike_price($id= null){
	if($id !=''){
		$data['page_title']='Update Hike Price';
        $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/dashboard').'">Home</a></li><li><a href="'.base_url('admin/hike_price').'">Hike  List</a></li><li class="active">Update Hike Price</li>';

	}else{
		$data['page_title']='Add Category';
        $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/dashboard').'">Home</a></li><li><a href="'.base_url('admin/hike_price').'">Hike List</a></li><li class="active">Add Hike Price</li>';

	}
    
    $data['succmsg'] = '';
    $data['errmsg'] = '';
    $data['CategoryDetail'] = $this->Hike_price_model->getHikeDetail($id)[0];
    $this->load->view('admin/hike_price/add_hike_price',$data);
 }


 function update_hike_price($id=''){
    if($id !=''){
        $data['page_title']='Update Hike Price';
        $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/dashboard').'">Home</a></li><li><a href="'.base_url('admin/hike_price').'">Hike  List</a></li><li class="active">Update Hike Price</li>';

    }else{
        $data['page_title']='Add Hike Price';
        $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/dashboard').'">Home</a></li><li><a href="'.base_url('admin/hike_price').'">Hike List</a></li><li class="active">Add Hike Price</li>';

    }
    
    $data['succmsg'] = '';
    $data['errmsg'] = '';
    $data['hikeDetail'] = $this->Hike_price_model->getHikeDetail($id)[0];
    $this->load->view('admin/hike_price/update_hike_price',$data);

 }

 function hike_price_data(){
    $title = $this->input->post('title');
    $start = $this->input->post('start');
    $end = $this->input->post('end');
    $date_end = date("Y-m-d 23:59:59", strtotime($start));
    $value = $this->input->post('value');

    $hike_data =array(
        'id'=>$this->input->post('hike_price_id'),
        'title'=>$title,
        'hike_value'=> $value,
        'hike_varient'=>'High',
        'start_date'=>$start,
        'end_date'=> $date_end,
    );

    $last_id = $this->Hike_price_model->addHikePrice($hike_data);
    if(!empty($hike_data['id'])){
            $this->session->set_flashdata('succmsg', "".ucfirst($title)." Hike Price Updated Successfully");
        }else{
           $this->session->set_flashdata('succmsg', "".ucfirst($title)." Hike Price Add Successfully");
        }
        
        redirect('admin/hike_price');
    
 }

 function GetAllHikePrice(){
    $data = $this->Hike_price_model->GetAllHikePrice();
    echo json_encode($data);
 }

function changestatus()
	 {
		$id = $this->input->post('id');
		$userstatus = $this->Hike_price_model->getHikeDetail($id);
		if($userstatus[0]['status']=='Active')
		{
			$user_data = array('id'=>$id,'status'=>'Inactive');
			$this->Hike_price_model->addHikePrice($user_data);
			echo 'Inactive';
		}
		if($userstatus[0]['status']=='Inactive')
		{
		
			$user_data = array('id'=>$id,'status'=>'Active');
			$this->Hike_price_model->addHikePrice($user_data);
			echo 'Active';
		}
	
	}
     function hike_price_delete()
     {
      $id = $this->input->post('id');
      $item_data = array(
       
         'id'=> $id,
         'is_delete'=>'0'
         );
      //echo $id;
    $this->Hike_price_model->addHikePrice($item_data);

     
     }

 }
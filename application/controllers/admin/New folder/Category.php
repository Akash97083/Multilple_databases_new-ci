<?php defined('BASEPATH') OR exit('No direct script access allowed');

 class Category extends CI_Controller
 {
 	
 	public function __construct()
 	{
 		parent::__construct();
 		$this->load->model('admin/Category_model');
        $this->controller = 'category';
 	}

 	public function index(){
		checkAdmin($this->controller."/");
		$data=array('errmsg'=>'');
		$data = array('succmsg'=>'');
		$data['page_title']="Manage Category";

		$data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url().'">Home</a></li><li class="active">Manage Category</li>';
		$data['recordset'] = $this->Category_model->getAllCategory();
		$this->load->view('admin/category/index',$data);
 	}

function add_category($id= null){
	if($id !=''){
		$data['page_title']='Update Category';
        $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/dashboard').'">Home</a></li><li><a href="'.base_url('admin/category').'">Category List</a></li><li class="active">Update Category</li>';

	}else{
		$data['page_title']='Add Category';
        $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/dashboard').'">Home</a></li><li><a href="'.base_url('admin/category').'">Category List</a></li><li class="active">Add Category</li>';

	}
    
    $data['succmsg'] = '';
    $data['errmsg'] = '';
    $data['CategoryDetail'] = $this->Category_model->getCategoryDetail($id)[0];
    $this->load->view('admin/category/add_category',$data);
 }

 function category_data(){
    $category_name = $this->input->post('category_name');
    $contentId =$this->input->post('category_id');
   if($category_name !=''){
   	$checkExistsCategory = $this->Category_model->checkExistsCategory(array('category_name'=>$category_name),$this->input->post('category_id'));
   	if($checkExistsCategory > 0){
	$this->session->set_flashdata('errmsg', 'Category Already Exists.');
	redirect(base_url("admin/category/add_category/".$contentId));
	return true;
	}else{

      $data = array(
            'id'=>$this->input->post('category_id'),
            'category_name'=>$this->input->post('category_name'),
            'description'=>$this->input->post('description'),
            'status'=>'active',
            'user_id'=>$this->session->userdata('user_id'),
            'when_added'=>date('Y-m-d H:i:s')

        );

        //print_r($data); exit();
        $last_id = $this->Category_model->addCategory($data);

      }

        if(!empty($data['id'])){
        	$slug_data = array('id'=>$last_id,'category_slug'=>strtolower(str_replace(" ", "-", $this->input->post('category_name').'-indonesia')));

         $this->Category_model->addCategory($slug_data);

            $this->session->set_flashdata('succmsg', "".ucfirst($category_name)." Updated Successfully");
        }else{
        	$slug_data = array('id'=>$last_id,'category_slug'=>strtolower(str_replace(" ", "-", $this->input->post('category_name').'-indonesia')));

         $this->Category_model->addCategory($slug_data);


            $this->session->set_flashdata('succmsg', "".$category_name." Add Successfully");
        }
        
        redirect('admin/category');




    }else{
        redirect('admin/cms','refresh');
    }


 }

 function category_check(){
 	$cat_id = $this->input->post('cat_id');
 	$category_name = $this->input->post('category_name');
	$count = $this->Category_model->check_category($cat_id,$category_name);
 	echo $count;
 }

function changestatus()
	 {
		$id = $this->input->post('id');
		$userstatus = $this->Category_model->getcategoryDetail($id);
		if($userstatus[0]['status']=='Active')
		{
			$user_data = array('id'=>$id,'status'=>'Inactive');
			$this->Category_model->addcategory($user_data);
			echo 'Inactive';
		}
		if($userstatus[0]['status']=='Inactive')
		{
		
			$user_data = array('id'=>$id,'status'=>'Active');
			$this->Category_model->addcategory($user_data);
			echo 'Active';
		}
	
	}

 }
<?php defined('BASEPATH') OR exit('No direct script access allowed');

 class Subcategory extends CI_Controller
 {
 	
 	public function __construct()
 	{
 		parent::__construct();
 		$this->load->model('admin/Category_model');
 		$this->load->model('admin/Item_model');
 		$this->load->model('admin/Subcategory_model');
        $this->controller = 'subcategory';
 	}

function index()
	{	
		checkAdmin('admin'.$this->controller.'/');

		$data['page_title']			= 'All Subcategory';

		$config['base_url'] 		= base_url('');

		$data['getAllSubcategory'] 			= $this->Subcategory_model->getAllSubcategory();
		$data['breadcrumb']			= '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/subcategory').'">Home</a></li><li class="active">All Subcategory</li>';
		$data['recordset'] = $data['getAllSubcategory'];
		$this->load->view('admin/subcategory/index',$data);
	
	}
 
 function add_subcategory($id = NULL)
	{	
	 checkAdmin('admin/subcategory/add_subcategory');

	   if($id!=''){

			$data['page_title']			= 'Edit Subcategory';
		}else{
			$data['page_title']			= 'Add Subcategory';
			

		}

		$config['base_url'] 		= base_url($this->controller."/index/");

		$data['getAllcategory'] = $this->Category_model->getAllcategory();
		$data['subCategoryDetail'] 			= $this->Subcategory_model->getSubcategoryDetail($id)[0];
		//print_r($data['getAllcategory']);
		

		if($id!=''){

			$data['breadcrumb']			= '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/item').'">Home</a></li><li class="active">Edit Subcategory</li>';

		}else{

		$data['breadcrumb']			= '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/item').'">Home</a></li><li class="active">Add Subcategory</li>';
		}
		$this->load->view('admin/subcategory/add_subcategory',$data);
	}

 function add_sub_category_data(){
			if($_POST['sub_category_name']){

				$data['id'] = $this->input->post('sub_category_id');
				$data['name'] = $this->input->post('sub_category_name');
				$data['category_id'] = $this->input->post('category_id');
				$contentId = $this->input->post('sub_category_id');
			 	$checkExistsItem = $this->Subcategory_model->checkExistsItem($data,$contentId);

				 if($checkExistsItem > 0){
				 	  $this->session->set_flashdata('errmsg', 'Sub category already exists.');
						redirect(base_url("admin/subcategory/add_subcategory/".$contentId));
						return true;
						}else{

						 $data = array(
					   
					     'id'=> $this->input->post('sub_category_id'),
					     'cat_id'=> $this->input->post('category_id'),
						 'sub_cat_name'=>$this->input->post('sub_category_name'),
						 'description'=>$this->input->post('description')
						 );
						  $last_id = $this->Subcategory_model->addsubcategoery($data);
						}
					if(!empty($data['id'])){
					$this->session->set_flashdata('succmsg', "Sub Category Updated Successfully");
					
					$slug_data = array('id'=>$last_id,'slug'=>strtolower(str_replace(" ", "-", $this->input->post('sub_category_name').'-indonesia')));
					$this->Subcategory_model->addsubcategoery($slug_data);

					}else{

						$slug_data = array('id'=>$last_id,'slug'=>strtolower(str_replace(" ", "-", $this->input->post('sub_category_name').'-indonesia')));

         				$this->Subcategory_model->addsubcategoery($slug_data);

					 $this->session->set_flashdata('succmsg', "Sub Category Add Successfully");
					}
					redirect('admin/subcategory');
			}else{
		    	redirect('admin/subcategory');
		    }
	}

function changestatus(){
		$id = $this->input->post('id');
		$userstatus = $this->Subcategory_model->getSubcategoryDetail($id);
		if($userstatus[0]['status']=='Active')
		{
			$user_data = array('id'=>$id,'status'=>'Inactive');
			$this->Subcategory_model->addSubcategory($user_data);
			echo 'Inactive';
		}
		if($userstatus[0]['status']=='Inactive')
		{
		
			$user_data = array('id'=>$id,'status'=>'Active');
			$this->Subcategory_model->addSubcategory($user_data);
			echo 'Active';
		}
	
	}

/////////////// End Class //////////
 }
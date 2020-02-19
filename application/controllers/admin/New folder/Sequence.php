<?php defined('BASEPATH') OR exit('No direct script access allowed');

 class Sequence extends CI_Controller
 {
 	
 	public function __construct()
 	{
 		parent::__construct();
 		$this->load->model('admin/Sequence_model');
        $this->load->model('admin/Category_model');
        $this->load->model('admin/Subcategory_model');
        $this->controller = 'sequence';
        $d   = filter_input(INPUT_GET, 'd', FILTER_SANITIZE_STRING);
        $w   = (int) filter_input(INPUT_GET, 'w', FILTER_SANITIZE_NUMBER_INT);
        $h   = (int) filter_input(INPUT_GET, 'h', FILTER_SANITIZE_NUMBER_INT);
 	}

 	public function index(){
		checkAdmin($this->controller."/");
		$data=array('errmsg'=>'');
		$data = array('succmsg'=>'');
		$data['page_title']="Manage Item sequence";

		$data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url().'">Home</a></li><li class="active">Manage Item sequence</li>';
		$data['getAllcategory'] = $this->Category_model->getAllCategory();
        $data['item'] = array();
        $data['post_category'] = '';
        $data['post_sub_category'] = '';
		$this->load->view('admin/sequence/index',$data);
 	}

function selected_sub_cat(){
    $category_id = $this->input->post('category_id');
    $sub_cat_id = $this->input->post('sub_cat_id');
    $allsubcategory = $this->Subcategory_model->getAllSubCategory($category_id);
    //echo $sub_cat_id;
    //echo "<pre>";print_r($allsubcategory);
    echo '<option value="">Select Sub Category</option>';
    foreach($allsubcategory as $sub_cat){
        if($sub_cat['id'] ==$sub_cat_id){
            $selected = 'selected';

        }else{
            $selected = '';
        }

        echo '<option value="'.$sub_cat['id'].'" '.$selected.'>'.$sub_cat['sub_cat_name'].'</option>';

    }
  }

 function get_all_Item(){
    checkAdmin($this->controller."/");
    $category_id = $this->input->post('category_id');
    $sub_cat_id = $this->input->post('sub_category_id');
    $data=array('errmsg'=>'');
    $data = array('succmsg'=>'');
    $data['page_title']="Manage Item sequence";

    $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url().'">Home</a></li><li class="active">Manage Item sequence</li>';
    $data['getAllcategory'] = $this->Category_model->getAllCategory();
    $data['item'] = get_all_item($category_id,$sub_cat_id);
    $data['post_category'] = $this->input->post('category_id');
    $data['post_sub_category'] = $this->input->post('sub_category_id');

    //print_r($data['item']);
    $this->load->view('admin/sequence/index',$data);

}


 function updateItemSequence(){
    $position = $this->input->post('position');
    $this->Sequence_model->UpdateSequence($position);
    $this->session->set_flashdata('message', '<strong>Success!</strong> Item position update.');
 }

  /////////////// End Class //////////////////
 }
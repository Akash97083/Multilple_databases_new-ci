<?php defined('BASEPATH') OR exit('No direct script access allowed');

 class Item extends CI_Controller
 {
 	
 	public function __construct()
 	{
 		parent::__construct();
 		$this->load->model('admin/Category_model');
 		$this->load->model('admin/Item_model');
        $this->load->model('admin/Subcategory_model');
        $this->controller = 'item';
        $d   = filter_input(INPUT_GET, 'd', FILTER_SANITIZE_STRING);
        $w   = (int) filter_input(INPUT_GET, 'w', FILTER_SANITIZE_NUMBER_INT);
        $h   = (int) filter_input(INPUT_GET, 'h', FILTER_SANITIZE_NUMBER_INT);
 	}

function index()
	{	
		checkAdmin('admin'.$this->controller.'/');

		$data['page_title']			= 'All Item';

		$config['base_url'] 		= base_url('');

		$data['getAllitem'] 			= $this->Item_model->getAllitem();
		$data['getAllcategory'] 			= $this->Category_model->getAllCategory();

		$data['breadcrumb']			= '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/item').'">Home</a></li><li class="active">All Item</li>';
		$data['recordset'] = $data['getAllitem'];
		$this->load->view('admin/item/index',$data);
	
	}
 
 function add_item($id = NULL)
	{	
	 checkAdmin('admin/item/add_item');

	   if($id!=''){

			$data['page_title']			= 'Edit Item';
		}else{
			$data['page_title']			= 'Add Item';
			

		}

		$config['base_url'] 		= base_url($this->controller."/index/");

		$data['itemDetail'] = $this->Item_model->getitemDetail($id);
		$data['getAllcategory'] = $this->Category_model->getAllcategory();
		$data['getAllSubCategory'] 			= $this->Subcategory_model->getAllSubCategory();
		$data['occasionTpye'] = $this->Subcategory_model->getAlloccasionTpye();
		//print_r($data['getAllcategory']);
		
		if($id!=''){

			$data['breadcrumb']			= '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/item').'">Home</a></li><li class="active">Edit Item</li>';

		}else{

		$data['breadcrumb']			= '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/item').'">Home</a></li><li class="active">Add Item</li>';
		}
		
		$this->load->view('admin/item/add_item',$data);
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


function add_item_data(){
			if($_POST['item_name']){
				//$occasionType = array();
				$data['category_id'] = $this->input->post('category_id');
				$data['name'] = $this->input->post('item_name');
				$contentId = $this->input->post('item_id');
			 	$checkExistsItem = $this->Item_model->checkExistsItem($data,$contentId);
			 	$occasion = $this->input->post('occasionType');
			 	$occasionType = implode(",",$occasion);
			 	
				if($checkExistsItem > 0){
						$this->session->set_flashdata('errmsg', 'Item Already Exists of the Same Category.');
						redirect(base_url("admin/item/add_item/".$contentId));
						return true;
						}else{

						 $data = array(
					   
					     'id'=> $this->input->post('item_id'),
					     'category_id'=> $this->input->post('category_id'),
					     'sub_cat_id'=>$this->input->post('sub_category_id'),
						 'item_name'=>$this->input->post('item_name'),
						 'packs_slot'=>'1',
						 'item_price'=> $this->input->post('item_price'),
						 'secial_price'=> $this->input->post('secial_price'),
						 'description'=>$this->input->post('description'),
						 'stock'=>$this->input->post('stock'),
						 'double_the_quantity_price'=>$this->input->post('double_the_quantity_price'),
						 'double_qty_description'=>$this->input->post('double_qty_description'),
						 'shown_short_description'=>$this->input->post('shown_short_description'),
						 'upgrade_option_price'=>$this->input->post('upgrade_option_price'),
						 'upgrade_option_description'=>$this->input->post('upgrade_option_description'),
						 'meta_tilte'=>$this->input->post('meta_tilte'),
						 'meta_description'=>$this->input->post('meta_description'),
						 'occasion_type'=>$occasionType,
						 
						 
						 );



						 $last_id = $this->Item_model->additem($data);
						}

		///// Image Upload /////
        if (isset($_FILES['item_image']) && $_FILES['item_image']['size'] > 0) {

        	$item_data = $this->Item_model->getitemDetail($last_id);
        	$img_url = "uploads/item_image/".$item_data['item_image'];
        	$img_thumbnail = "uploads/item_image/thumbnail/".$item_data['item_image'];

        	//echo $img_url; exit;
        	unlink($img_url);
        	unlink($img_thumbnail);
        	$image_name = $last_id .'_'.$_FILES['item_image']['name'];
        	$fileUploadType 			= "item_image";
        	$config['allowed_types']  	= 'gif|jpg|png';
			$config['upload_path']	  	= './uploads/item_image/';
			$config['max_size']	   	  	= 0;
			$config['max_width']	  	= 0;
			$file_name_ar				= explode(".",$_FILES['item_image']['name']);

			$config['file_name']	  	= $image_name;
		    $this->load->library('Upload',$config);

			$this->upload->do_upload('item_image',true);
			$data 						= array('upload_data' => $this->upload->data());
			$fileArray['item_image'] = $this->upload->file_name;
			$upload_info 				= $this->upload->data();		
			$upload_info['fileUploadType'] = $fileUploadType;
			$file_name					= $upload_info['file_name'];
			$file_ext	 				= $upload_info['file_ext'];
			$ext 		  				= $this->upload->data();
			$img_err 					= $this->upload->display_errors();

			if($file_name <> ''){

			$uploaddir  = "uploads/item_image/thumbnail/";

			$file_name  = $fileArray['item_image'];

			$thumb_target_path = $uploaddir.$file_name;

			$target_path  = $config['upload_path'].$fileArray['item_image'];

			$width 		= '100';

			$height    = '100';

			$ext 	= $ext['file_ext'];

			make_thumb($target_path,$thumb_target_path,$width,$height,$ext);

			$data2 = array('id'=>$last_id,'item_image'=>$file_name);
            $this->Item_model->additem($data2);

			}



        }              

      ///// End Image Upload ///
       
       if(!empty($this->input->post('item_id'))){

			$slug_data = array('id'=>$last_id,'item_slug'=>strtolower(str_replace(" ", "-", $this->input->post('item_name').'-'.$last_id)));
			$this->Item_model->additem($slug_data);

			$this->session->set_flashdata('succmsg', "Item Updated Successfully");
			}else{

			$slug_data = array('id'=>$last_id,'item_slug'=>strtolower(str_replace(" ", "-", $this->input->post('item_name').'-'.$last_id)),'sequence_order'=>$last_id);
			$this->Item_model->additem($slug_data);

			 $this->session->set_flashdata('succmsg', "Item Add Successfully");
			}
			redirect('admin/item');
	 }else{
		    	redirect('admin/item');
		    }
	}

function changestatus()
	 {
		$id = $this->input->post('id');
		$userstatus = $this->Item_model->getitemDetail($id);
		
		if($userstatus['status']=='Active')
		{
			$user_data = array('id'=>$id,'status'=>'Inactive');
			$this->Item_model->additem($user_data);
			echo 'Inactive';
		}
		if($userstatus['status']=='Inactive')
		{
		
			$user_data = array('id'=>$id,'status'=>'Active');
			$this->Item_model->additem($user_data);
			echo 'Active';
		}
	
}

	 function item_delete()
	 {
	  $id = $this->input->post('id');
	  $item_data = array(
	   
	     'id'=> $id,
		 'is_delete'=>'0'
		 );
	  //echo $id;
	$this->Item_model->additem($item_data);

	 
	 }
 function price_percentage(){
		 	$item_id = $this->input->post('item_id');
		 	$value = $this->input->post('value');
		 	if($value == 0){
		 		$price_percentage_variant = 'NULL';

		 	}else{
		 		$price_percentage_variant = 'High';

		 	}

		 	$item_data = array(
			    'id'=> $item_id,
				 'price_percentage'=>$value,
				 'price_percentage_variant'=>$price_percentage_variant,
				 );
				$this->Item_model->additem($item_data);
				echo '1';
			//print_r($item_data);
   }


/////////////// End Class ///////////////////
 }
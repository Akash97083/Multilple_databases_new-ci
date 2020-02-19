<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('class/utcpro.class.php');
include_once('class/utcpro.settings.php');

class Gallery extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        checkAdmin('');
        $this->load->model('admin/Gallery_model');
        $this->controller = 'gallery';
        $d   = filter_input(INPUT_GET, 'd', FILTER_SANITIZE_STRING);
        $w   = (int) filter_input(INPUT_GET, 'w', FILTER_SANITIZE_NUMBER_INT);
        $h   = (int) filter_input(INPUT_GET, 'h', FILTER_SANITIZE_NUMBER_INT);
    }


	public function index()
	{
		checkAdmin($this->controller."/");
		$data=array('errmsg'=>'');
        $data = array('succmsg'=>'');
        $data['page_title']="Manage Slider";
        
        $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/testimonials/').'">Home</a></li><li class="active">Slider</li>';
        $data['recordset'] = $this->Gallery_model->getAllTestimonial();
		$this->load->view('admin/gallery/index',$data);
	}

 function add_gallery($id = null){
    $data['page_title']= ($id !=''?'Update Slder':'Add Slider');
    $data['breadcrumb'] = ($id !='' ?'<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/testimonials/').'">Home</a></li><li class="active">Update Slider</li>':'<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/testimonials/').'">Home</a></li><li class="active">Add Slider</li>');
    $data['succmsg'] = '';
    $data['errmsg'] = '';
    $data['gallery_detail'] = $this->Gallery_model->getGalleryDetail($id)[0];
    $this->load->view('admin/gallery/add_gallery',$data);
 }

 function add_gallery_data(){
    $this->load->library('upload');
  if($this->input->post('image_name_en') !=''){
      $data = array(
            'id'=>$this->input->post('gallery_id'),
            'name_english'=>$this->input->post('image_name_en'),
            'status'=>'active',
            'added_date'=>date('Y-m-d H:i:s')

        );

        $last_id = $this->Gallery_model->addGallery($data);

        #Image Upload Start #
        $image_name = $last_id .'_'.$_FILES['galleryfile']['name'];
        $config['upload_path'] = './uploads/gallery/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['overwrite'] = TRUE;
        $config['max_size'] = '100000';
        //$config['max_width'] = '1024';
        //$config['max_height'] = '768';
        $config['file_name'] = $image_name;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

    if(!$this->upload->do_upload('galleryfile')){
                if($_FILES['galleryfile']['name'] ==''){

                }else{
                //$this->Gallery_model->delete_testimonial($last_id); # Delete the last inserted testimonial
                $this->session->set_flashdata('errormsg',$this->upload->display_errors());
                redirect('admin/gallery/add_gallery/'.$this->input->post('gallery_id'));
               }

        }else{
            $uploaded_image = $this->Gallery_model->getGalleryDetail($this->input->post('gallery_id'))[0];

            $image_url = 'uploads/gallery/'.$uploaded_image['image'];
            unlink($image_url);
            $update_image = array('id'=>$last_id,'image'=>$image_name);
            $last_id = $this->Gallery_model->addGallery($update_image);
    }
   
     #End of the Image Upload Start #

  if(!empty($data['id'])){
            $this->session->set_flashdata('succmsg', "Slider File Has Been ".ucfirst($_FILES['galleryfile']['name'])." Updated Successfully");
    }else{
          $this->session->set_flashdata('succmsg', " Slider File Has Been ".ucfirst($_FILES['galleryfile']['name'])." Add Successfully");
    }
        
    redirect('admin/gallery');

 }else{
        redirect('admin/gallery','refresh');
    }


 }

function image_delete(){
    $id = $this->input->post('id');
    $uploaded_image = $this->Gallery_model->getGalleryDetail($id)[0];
    $image_url = 'uploads/gallery/'.$uploaded_image['image'];
    unlink($image_url);
    $this->Gallery_model->image_delete($id);


}

function changestatus()
     {
        $id = $this->input->post('id');
        $userstatus = $this->Gallery_model->getGalleryDetail($id);
        if($userstatus[0]['status']=='Active')
        {
            $user_data = array('id'=>$id,'status'=>'Inactive');
            $last_id = $this->Gallery_model->addGallery($user_data);
            echo 'Inactive';
        }
        if($userstatus[0]['status']=='Inactive')
        {
        
            $user_data = array('id'=>$id,'status'=>'Active');
            $last_id = $this->Gallery_model->addGallery($user_data);
            echo 'Active';
        }
    
    }
    

////////////////// End Class /////////////////////

}

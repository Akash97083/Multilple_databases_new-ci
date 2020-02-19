<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonials extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        checkAdmin('');
        $this->load->model('admin/Testimonials_model');
        $this->controller = 'testimonials';



    }


	public function index()
	{
		checkAdmin($this->controller."/");
		$data=array('errmsg'=>'');
        $data = array('succmsg'=>'');
        $data['page_title']="Manage Testimonials";
        
        $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/testimonials/').'">Home</a></li><li class="active">Testimonials</li>';
        $data['recordset'] = $this->Testimonials_model->getAllTestimonial();
		$this->load->view('admin/testimonial/index',$data);
	}

 function add_testimonial($id = null){
    $data['page_title']= ($id !=''?'Update Testimonial':'Add Testimonial');
    $data['breadcrumb'] = ($id !='' ?'<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/testimonials/').'">Home</a></li><li class="active">Update Testimonials</li>':'<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/testimonials/').'">Home</a></li><li class="active">Add Testimonials</li>');
    $data['succmsg'] = '';
    $data['errmsg'] = '';
    $data['testimonial_detail'] = $this->Testimonials_model->getTestimonialDetail($id)[0];
    $this->load->view('admin/testimonial/add_testimonial',$data);
 }

 function add_testimonial_data(){
    $this->load->library('upload');
    $uploaded_image = $this->Testimonials_model->getTestimonialDetail($this->input->post('testimonial_id'))[0];
  if($this->input->post('client_name_en') !=''){
      $data = array(
            'id'=>$this->input->post('testimonial_id'),
            'name_english'=>$this->input->post('client_name_en'),
            'name_arabic'=>$this->input->post('client_name_ar'),
            'description'=>$this->input->post('description'),
            'arabic_description'=> $this->input->post('arabic_description'),
            'status'=>'active',
            'added_date'=>date('Y-m-d H:i:s')

        );

        $last_id = $this->Testimonials_model->addTestimonialDetail($data);

        //print_r($_FILES['testimonialfile']); exit;

        #Image Upload Start #
        $image_name = $last_id .'_'.$_FILES['testimonialfile']['name'];
        $config['upload_path'] = './uploads/testimonials/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = TRUE;
        $config['max_size'] = '3000';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $config['file_name'] = $image_name;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

    if(!$this->upload->do_upload('testimonialfile')){
                if($_FILES['testimonialfile']['name'] ==''){

                }else{
                //$this->Testimonials_model->delete_testimonial($last_id); # Delete the last inserted testimonial
                $this->session->set_flashdata('errormsg',$this->upload->display_errors());
                redirect('admin/testimonials/add_testimonial/');
               }

        }else{
           $uploaded_image = $this->Testimonials_model->getTestimonialDetail($this->input->post('testimonial_id'))[0];

            $image_url = 'uploads/testimonials/'.$uploaded_image['image'];
            unlink($image_url);
           $update_image = array('id'=>$last_id,'image'=>$image_name);
           $last_id = $this->Testimonials_model->addTestimonialDetail($update_image);
    }
   
     #End of the Image Upload Start #

  if(!empty($data['id'])){
            $this->session->set_flashdata('succmsg', "Testimonial ".ucfirst($this->input->post('client_name_en'))." Updated Successfully");
    }else{
          $this->session->set_flashdata('succmsg', " Testimonial ".$this->input->post('client_name_en')." Add Successfully");
    }
        
    redirect('admin/testimonials');

 }else{
        redirect('admin/testimonials','refresh');
    }


 }

function testimonial_delete(){
    $id = $this->input->post('id');
    $uploaded_image = $this->Testimonials_model->getTestimonialDetail($id)[0];
    $image_url = 'uploads/testimonials/'.$uploaded_image['image'];
    unlink($image_url);
    $this->Testimonials_model->delete_testimonial($id);


}

////////////////// End Class /////////////////////

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('class/utcpro.class.php');
include_once('class/utcpro.settings.php');

class Addon extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        checkAdmin('');
        $this->load->model('admin/Addon_model');
        $this->controller = 'addon';
        $d   = filter_input(INPUT_GET, 'd', FILTER_SANITIZE_STRING);
        $w   = (int) filter_input(INPUT_GET, 'w', FILTER_SANITIZE_NUMBER_INT);
        $h   = (int) filter_input(INPUT_GET, 'h', FILTER_SANITIZE_NUMBER_INT);
    }


	public function index()
	{
		checkAdmin($this->controller."/");
		$data=array('errmsg'=>'');
        $data = array('succmsg'=>'');
        $data['page_title']="Manage Add-on";
        
        $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/dashboard/').'">Home</a></li><li class="active">Add-on</li>';
        $data['recordset'] = $this->Addon_model->getAllAddon();
		$this->load->view('admin/addon/index',$data);
	}

 function add_addon($id = null){
    $data['page_title']= ($id !=''?'Update Add-On':'Add Add-On');
    $data['breadcrumb'] = ($id !='' ?'<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/dashboard/').'">Home</a></li><li class="active">Update Add-On</li>':'<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/dashboard/').'">Home</a></li><li class="active">Add Add-On</li>');
    $data['succmsg'] = '';
    $data['errmsg'] = '';
    $data['addon_detail'] = $this->Addon_model->getAddonDetail($id)[0];
    $this->load->view('admin/addon/add_addon',$data);
 }

 function add_addon_data(){
    $this->load->library('upload');
  if($this->input->post('addon_name') !=''){
      $data = array(
            'id'=>$this->input->post('addon_id'),
            'addon_name'=>$this->input->post('addon_name'),
            'addon_price'=>$this->input->post('price'),
            'status'=>'Active',
            'when_added'=>date('Y-m-d H:i:s')

        );
      //print_r($data);
      //exit;

        $last_id = $this->Addon_model->addAddon($data);

        #Image Upload Start #
        $image_name = $last_id .'_'.$_FILES['addonfile']['name'];
        $config['upload_path'] = './uploads/addon/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['overwrite'] = TRUE;
        $config['max_size'] = '100000';
        //$config['max_width'] = '1024';
        //$config['max_height'] = '768';
        $config['file_name'] = $image_name;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

    if(!$this->upload->do_upload('addonfile')){
                if($_FILES['addonfile']['name'] ==''){

                }else{
                //$this->Addon_model->delete_testimonial($last_id); # Delete the last inserted testimonial
                $this->session->set_flashdata('errormsg',$this->upload->display_errors());
                redirect('admin/addon/add_addon/'.$this->input->post('addon_id'));
               }

        }else{
            $uploaded_image = $this->Addon_model->getAddonDetail($this->input->post('addon_id'))[0];

            $image_url = 'uploads/addon/'.$uploaded_image['image'];
            unlink($image_url);
            $update_image = array('id'=>$last_id,'image'=>$image_name);
            $last_id = $this->Addon_model->addAddon($update_image);
    }
   
     #End of the Image Upload Start #

  if(!empty($data['id'])){
            $this->session->set_flashdata('succmsg', "Add-On Item Has Been ".ucfirst($_FILES['addonfile']['name'])." Updated Successfully");
    }else{
          $this->session->set_flashdata('succmsg', " Add-On Item Has Been ".ucfirst($_FILES['addonfile']['name'])." Add Successfully");
    }
        
    redirect('admin/addon');

 }else{
        redirect('admin/addon','refresh');
    }


 }

function image_delete(){
    $id = $this->input->post('id');
    $uploaded_image = $this->Addon_model->getAddonDetail($id)[0];
    $image_url = 'uploads/addon/'.$uploaded_image['image'];
    unlink($image_url);
    $this->Addon_model->addon_delete($id);


}

////////////////// End Class /////////////////////

}

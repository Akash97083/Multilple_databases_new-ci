<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        checkAdmin('');
        $this->load->model('admin/Cms_model');
        $this->controller = 'cms';



    }


	public function index()
	{
		checkAdmin($this->controller."/");
		$data=array('errmsg'=>'');
        $data = array('succmsg'=>'');
        $data['page_title']="Manage Cms";
        
        $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url().'">Home</a></li><li class="active">Page Settings</li>';
        $data['recordset'] = $this->Cms_model->getAllCms();
		$this->load->view('admin/cms/index',$data);
	}

 function add_cms($id= null){
    $data['page_title']='Update CMS';
    $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url('admin/dashboard').'">Home</a></li><li><a href="'.base_url('admin/cms').'">CMS List</a></li><li class="active">Update CMS</li>';
    $data['succmsg'] = '';
    $data['errmsg'] = '';
    $data['cms_detail'] = $this->Cms_model->getCmsDetail($id)[0];
    $this->load->view('admin/cms/add_cms',$data);
 }

 function update_cms(){
    $alias = $this->input->post('alias');
   if($alias !=''){
      $data = array(
            'id'=>$this->input->post('cms_id'),
            'heading'=>$this->input->post('heading'),
            'description'=>$this->input->post('description'),
            'arabic_description'=> $this->input->post('arabic_description'),
            'status'=>'active',
            'image'=>'',
            'post_date'=>date('Y-m-d H:i:s')

        );

        //print_r($data); exit();
        $this->Cms_model->addCms($data);

        if(!empty($data['id'])){
            $this->session->set_flashdata('succmsg', "CMS ".ucfirst($alias)." Page Updated Successfully");
        }else{
             $this->session->set_flashdata('succmsg', "CMS ".$alias." Page Add Successfully");
        }
        
        redirect('admin/cms');




    }else{
        redirect('admin/cms','refresh');
    }


 }

 function file_change(){
    checkAdmin($this->controller."/");
        $data=array('errmsg'=>'');
        $data['page_title']="File Changes";
        
        $data['breadcrumb'] = '<li><i class="ace-icon fa fa-home home-icon"></i><a href="'.base_url().'">Home</a></li><li class="active">File Changes</li>';
        $file_location = $_SERVER['DOCUMENT_ROOT']."/new_version/uploads/css/style.css";
        $fp = file_get_contents($file_location);
        $lines = explode("\n", $fp);
        $data['css'] = $lines;
        $this->load->view('admin/file_changes/file_changes',$data);

 }

 function do_fileChange(){
   $css = $this->input->post('css');
   $file_location = $_SERVER['DOCUMENT_ROOT']."/new_version/uploads/css/style.css";
   //$fp = fopen($file_location, "r");

    //$content = fread($fp, filesize($file_location));
    //$lines = explode("\n", $content);
    //fclose($fp);
    //echo $lines[0]; exit;

   $fp = fopen($file_location, 'w');
   fwrite($fp,$css);
   fclose($fp);
   $this->file_change();
   
 }


////////////////// End Class /////////////////////

}

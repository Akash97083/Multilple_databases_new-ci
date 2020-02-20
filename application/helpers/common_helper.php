<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function checkAdmin($section_name)
    {
        $CI = & get_instance();
        if (!$CI->session->userdata('admin_id')) {

            $CI->session->set_flashdata('errmsg', 'Login Now');
            redirect('admin/');
        }
    }

function checkPIN($section_name)
    {
        $CI = & get_instance();
        if (!$CI->session->userdata('pin')) {

            $CI->session->set_flashdata('errmsg', 'First Enter Your Pin');
            redirect('admin/');
        }
    }

function checkUserpin($section_name)
    {
        $CI = & get_instance();
        if (!$CI->session->userdata('pin')) {

            $CI->session->set_flashdata('errmsg', 'First Enter Your Pin');
            redirect('/');
        }
    }

function checkUser($section_name)
    {
        $CI = & get_instance();
        if (!$CI->session->userdata('user_email')) {
          $CI->session->set_flashdata('errmsg', 'Login Now');
            redirect('/login');
        }
    }

if(!function_exists('get_permission'))
  {
    function get_permission($menu_id,$function)
    {
      $ci =& get_instance();
      
      $user_id = $ci->session->userdata('user_id');
      
      $query = $ci->db->get_where('user_permission',array('user_id' => $user_id , 'menu_id' => $menu_id));
      
      $row = $query->row();
      //echo $ci->db->last_query(); exit;
      
      return $row->$function;
    }
  }

  function select_options(){
    $ci =& get_instance();

    $ci->db->select('*');
    $ci->db->where('status','Active');
    $user_data = $ci->db->get('tbl_user')->result_array();
     

  $output = '';
    foreach($user_data as $item){
        $output.= '<option value="' . $item['phoneno'] . '"' . (in_array($item['user_name'], $selected) ? ' selected' : '') . '>' . $item['user_name'] . '</option>';
    }
    return $output;


  }

  function allActiveUserPhone(){
    $ci =& get_instance();
    $ci->db->select('phoneno');
    $ci->db->where('status','Active');
    $user_data = $ci->db->get('tbl_user')->result_array();
    $user_phon = array();
    foreach($user_data as $row){
      array_push($user_phon,$row['phoneno']);
    }

    $phone_no = implode(',', $user_phon);
    return $phone_no;


  }


 function perticularFlied($table,$fliedName,$where=array()){
  $ci =& get_instance();
  $ci->db->select($fliedName);
  $ci->db->where($where);
  $res = $ci->db->get($table)->result_array();
  //echo $ci->db->last_query();
  return $res;

 }

  function perticularFliedOrderby($table,$fliedName,$where=array(),$order = array()){
  $ci =& get_instance();
  $ci->db->select($fliedName);
  $ci->db->where($where);
  $ci->db->order_by($order['order_by'],$order['offset']);
  $res = $ci->db->get($table)->result_array();
  //echo $ci->db->last_query();
  return $res;

 }


 function get_language_data($data = array()){
  $arr = array();
  $ci =& get_instance();
  $alias = $data['alias'];
  if($data['language']=='arabic'){
    $ci->load->db->select('id,alias,heading,arabic_description as language_description');

  }else{
    $ci->load->db->select('id,alias,heading,description as language_description');

  }
  
  $ci->db->where('alias',$alias);
  $ci->db->where('status','Active');
  $res = $ci->db->get('tbl_cms')->result_array();
  array_push($res,array("language"=>$data['language']));
  return $res;

 }

 function get_all_testimonial($language=''){
  $ci =& get_instance();
  if($language =='arabic'){
     $ci->load->db->select('id,name_arabic as author_name,image,arabic_description as testimonial_description');

  }else{

    $ci->load->db->select('id,name_english as author_name,image,description as testimonial_description');

  }
  $ci->db->where('status','Active');
  $res = $ci->db->get('tbl_testimonial')->result_array();
  return $res;
 }
 
 function get_alias_language_wise($data = array()){
  $arabic_alias = array(
    'ول '=>'about-us',
    'مؤسس  '=>'the-founder',
    'الدورات  '=>'courses',
    'ورش عمل '=>'workshops',
    'ليل الموردين '=>'supplier-directory',
    'ختبار كفاءة الأزياء '=>'fashion-aptitude-test',
    'التشاور مع الدفع الفوري '=>'pay-as-you-go-consultations',
    'دريب '=>'coaching',
    'الة عرض '=>'gallery',
    'وحدة إنتاج الملابس '=>'garment-production-unit',
    'تصل بنا '=>'contact-us',
  );

  if($data['laguage']=='arabic'){

    $res = array_search($data['alias'],$arabic_alias);

  }else{
    $res = $data['alias'];

  }

  return $res;


 }

 function GetAllGallery($laguage){
  $ci =& get_instance();
  if($laguage =='arabic'){
    $ci->db->select('id,name_arabic as album_name,image,added_date');

  }else{
    $ci->db->select('id,name_english as album_name,image,added_date');

  }

  $ci->db->where('status','Active');
  $res = $ci->db->get('tbl_gallery')->result_array();
  return $res;

}
function getNameTable($table,$col,$field='',$value='',$field1='',$value1='',$field2='',$value2='')
        {
            $CI =& get_instance();
            $query="SELECT ".$col." FROM ".$table." WHERE 1 ";
            if($field!='' && $value!='')
            {
              $query.="AND ".$field."='".$value."' ";
            }
            if($field1!='' && $value1!='')
            {
              $query.="AND ".$field1."='".$value1."' ";
            }
            if($field2!='' && $value2!='')
            {
              $query.="AND ".$field2."='".$value2."' ";
            }
            $recordSet = $CI->db->query($query);
            //echo $query;
            //echo $this->obj->db->last_query();
            if($recordSet->num_rows() > 0)
            {
                $row = $recordSet->row_array();
                return $row[$col];
            }
            else
            {
                return "";
            }
  }

if( ! function_exists('make_thumb')){
    function make_thumb($img_name,$filename,$new_w,$new_h,$ext)
    {
      
      //get image extension.
      
      //creates the new image using the appropriate function from gd library
      
      if(!strcmp(".jpg",$ext) || !strcmp(".jpeg",$ext) || !strcmp(".JPG",$ext) || !strcmp(".JPEG",$ext))
      $src_img=@imagecreatefromjpeg($img_name);
      
      if(!strcmp(".gif",$ext) || !strcmp(".GIF",$ext))
      $src_img=@imagecreatefromgif($img_name);
      
      if(!strcmp(".bmp",$ext) || !strcmp(".BMP",$ext))
      $src_img=@imagecreatefromwbmp($img_name);
    
      
      if(!strcmp(".png",$ext) || !strcmp(".PNG",$ext))
      $src_img=@imagecreatefrompng($img_name);
      
      if($src_img){
      //gets the dimmensions of the image
      $old_x=imagesx($src_img);
      $old_y=imagesy($src_img);
      
      // next we will calculate the new dimmensions for the thumbnail image
      // the next steps will be taken:
      // 1. calculate the ratio by dividing the old dimmensions with the new ones
      // 2. if the ratio for the width is higher, the width will remain the one define in WIDTH variable
      // and the height will be calculated so the image ratio will not change
      // 3. otherwise we will use the height ratio for the image
      // as a result, only one of the dimmensions will be from the fixed ones
      $ratio1=$old_x/$new_w;
      $ratio2=$old_y/$new_h;
      if($ratio1>$ratio2) {
        $thumb_w=$new_w;
        $thumb_h=$old_y/$ratio1;
      }
      else {
        $thumb_h=$new_h;
        $thumb_w=$old_x/$ratio2;
      }
      
      // we create a new image with the new dimmensions
      $dst_img=imagecreatetruecolor($thumb_w,$thumb_h);
      
      /*********************************************************************************************************************************
      if($transparency) 
      {*/
        if($ext==".png") {
          imagealphablending($dst_img, false);
          $colorTransparent = imagecolorallocatealpha($dst_img, 0, 0, 0, 127);
          imagefill($dst_img, 0, 0, $colorTransparent);
          imagesavealpha($dst_img, true);
        } 
        elseif($ext==".gif") {
          $trnprt_indx = imagecolortransparent($src_img);
          if ($trnprt_indx >= 0) {
            //its transparent
            $trnprt_color = imagecolorsforindex($src_img, $trnprt_indx);
            $trnprt_indx = imagecolorallocate($dst_img, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
            imagefill($dst_img, 0, 0, $trnprt_indx);
            imagecolortransparent($dst_img, $trnprt_indx);
          }
        }
      /*} 
      else 
      {
        Imagefill($dst_img, 0, 0, imagecolorallocate($dst_img, 255, 255, 255));
      }
      *********************************************************************************************************************************/
      
      // resize the big image to the new created one
      imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);
      
      // output the created image to the file. Now we will have the thumbnail into the file named by $filename
      if(!strcmp(".png",$ext))
        imagepng($dst_img,$filename);
      else
        imagejpeg($dst_img,$filename);
      
      if(!strcmp(".gif",$ext))
        imagegif($dst_img,$filename);
      if(!strcmp(".bmp",$ext))    
        imagewbmp($dst_img,$filename);  
      
        
      
      //destroys source and destination images.
      imagedestroy($dst_img);
      imagedestroy($src_img);
      
      return true;
      }else{
        return false;
      }
    }
  }


if(!function_exists('get_all_item')){
  function get_all_item($cat_id,$sub_cat_id){
    $ci =& get_instance();
    $ci->db->select('*');
    $ci->db->where('category_id',$cat_id);
    $ci->db->where('sub_cat_id',$sub_cat_id);
    $ci->db->order_by('sequence_order','asc');
    $ci->db->where('is_delete','1');
    $res = $ci->db->get('tbl_item')->result_array();
    return $res;
  }


}

if(!function_exists('invoice_number')){
   function invoice_number(){
    $prefix = 'FR';
    $ci =& get_instance();
    $ci->db->select('order_no');
     $ci->db->order_by('id', 'desc');
    
    $query = $ci->db->get('order');
      $lastOrderNumber = $query->row_array();
      //$final_code = $lastOrderNumber['order_no'];

      $last_pr_code = explode("-",$lastOrderNumber['order_no']);


      if($lastOrderNumber['order_no'] !=''){
        $last_code = $last_pr_code[1];
    }else{

        $last_code = '000000';
      

    }

     $final_code = $prefix."-".str_pad(($last_code+1), 6, '0', STR_PAD_LEFT);


    
    return $final_code;
   }


 }

 function hike_price_chk(){
  $ci =& get_instance();
  //$sql = "SELECT hike_value FROM tbl_hike_price WHERE start_date BETWEEN '".$start."' AND '".$end."'";
  $ci->db->select('hike_value');
  $ci->db->where('start_date',date('Y-m-d'));
  $ci->db->where('status','Active');
  $res = $ci->db->get('tbl_hike_price')->result_array();
  //echo $ci->db->last_query();
  return $res[0]['hike_value'];
     
 }

 function GetAllAddOn($user_id,$count){
  $ci =& get_instance();
  $ci->db->select('*');
  $ci->db->where('user_id',$user_id);
  $ci->db->where('count',$count);
  $ci->db->where('status','Active');
  $res = $ci->db->get('tbl_temp_add_on_item')->result_array();
  //echo $ci->db->last_query();
  return $res;

 }
 
if(!function_exists('get_global_data')){
        function get_global_data($where)
        {
                $ci =& get_instance();
                $ci->db->select('field_value');
                $ci->db->from('global_config');
                $ci->db->where(array('field_key' => $where));
                $ci->db->order_by('id','desc');
                $query = $ci->db->get();
    
                $result = $query->row();
                return $result;
        }
    }
 function GetAllAddonItem($user_id){
  $ci =& get_instance();
  $ci->db->select('*');
  $ci->db->where('user_id',$user_id);
  $ci->db->where('status','Active');
  $res = $ci->db->get('tbl_temp_add_on_item')->result_array();
  //echo $ci->db->last_query();
  return $res;

 }


function convert_date($date_string){
  $date = date_create_from_format('m-d-y',$date_string);
  return date_format($date,"Y-m-d");
};


function ChkDB(){
   $ci =& get_instance();
   $ci->load->library('session');
   $userdata = $ci->session->userdata();
   return $userdata;
}


/* End of file user_helper.php */
<?php defined('BASEPATH') OR exit('No direct script access allowed');

 class Sequence_model extends CI_Model
 {
 	

 	function UpdateSequence($data = array()){
    $i=1;
      foreach ($data as $key => $value) {
             $sql = "Update tbl_item SET sequence_order=".$i." WHERE id=".$value;
             $query = $this->db->query($sql);
    

      $i++;

  }

}





////////////// End Class ///////////////
 	
 }
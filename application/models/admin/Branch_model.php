<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Branch_model extends CI_Model{

	public function getBranchDetail($id){
		$this->db->select('*');
		$this->db->where('id',$id);
		$res = $this->db->get('tbl_branch')->result_array();
		return $res;

	}

	public function AddBranch($data = array()){
		$id = $this->session->userdata('admin_id');
		
		if($data['id'] !=''){
			$this->db->where('id',$data['id']);
			$this->db->update('tbl_branch',$data);
			return $data['id'];

		}else{
			$data['admin_id'] = $id;
			$data['create_at']=date('Y-m-d H:i:s');

			$this->db->insert('tbl_branch',$data);
			$last_id = $this->db->insert_id();
			return $last_id;

		}

	}

 public function GetAllBranch(){
 	$this->db->select('*');
 	$this->db->where('is_delete','1');
 	$this->db->order_by('id','DESC');
 	$res = $this->db->get('tbl_branch')->result_array();
 	return $res;
 }



}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class MListPartner extends CI_Model {
  //       public function get_data_umkm(){
		// 	$sql = "SELECT * FROM user WHERE username = ? and password = ?";
		// 	return $this->db->query($sql, array($username,md5($password)));
		// }

		public function change_status($id,$val){
			$this->db->set('status',$val);
			$this->db->set('update_by',$this->session->userdata('user_name'));
			$this->db->set('update_time',date("Y-m-d H:i:s"));
			$this->db->where('id',$id);
			$this->db->update('user');
		}

		public function change_req($id,$val){
			$this->db->set('reqruitment',$val);
			// $this->db->set('update_by',$this->session->userdata('user_name'));
			// $this->db->set('update_time',date("Y-m-d H:i:s"));
			$this->db->where('id_user',$id);
			$this->db->update('partner');
		}
    }


    
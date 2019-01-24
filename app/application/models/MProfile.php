<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class MProfile extends CI_Model {

		public function get_data_user($id)
		{
			$sql = "SELECT nama,username,email,no_tlp,alamat FROM user WHERE id = ?";
			return $this->db->query($sql, array($id));
		}

		public function get_data_partner($id)
		{
			$sql = "SELECT * FROM partner WHERE id_user = ?";
			return $this->db->query($sql, array($id));
		}

        public function get_data_umkm(){
			$sql = "SELECT * FROM user WHERE username = ? and password = ?";
			return $this->db->query($sql, array($username,md5($password)));
		}

		public function update_data($id,$data){
			$nama = $data['nama'];
			$password = md5("1@3$5".$data['password']);
			$no_tlp = $data['no_tlp'];
			$alamat = $data['alamat'];
			$this->db->set('nama',$nama);
			$this->db->set('password',$password);
			$this->db->set('no_tlp',$no_tlp);
			$this->db->set('alamat',$alamat);
			$this->db->set('update_time',date("Y-m-d h:i:sa"));
			$this->db->where('id',$id);
			$this->db->update('user');
		}

		public function update_data_partner($id,$data){

			$this->db->where('id_user', $id);
			$this->db->update('partner', $data);
		}

		public function update_data_umkm($id,$data){

			$this->db->where('id_user', $id);
			$this->db->update('umkm', $data);
		}
    }
    
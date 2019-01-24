<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class MTestPartner extends CI_Model {

        public function get_data_soal_test(){
			$sql = "SELECT id,no_soal,soal_test,jawaban_a,jawaban_b,jawaban_c,jawaban_d,kunci FROM soal_test_partner";
			return $this->db->query($sql);
		}

		public function get_ipk($id){
			$sql = "SELECT ipk,semester FROM partner";
			return $this->db->query($sql);
		}

		public function get_hasil_test($id){
			$sql = "SELECT id FROM jawaban_soal_test WHERE id_user = $id";
			return $this->db->query($sql);
		}

		public function get_reqruitment_partner($id){
			$sql = "SELECT reqruitment FROM partner WHERE id_user = $id";
			return $this->db->query($sql);
		}

		public function create_data_nilai_test($data)
		{
			$this->db->insert('jawaban_soal_test', $data);
			return $this->db->insert_id();
		}

		public function create_data_we($data)
		{
			$this->db->insert('we', $data);
			return $this->db->insert_id();
		}

		
    }
    
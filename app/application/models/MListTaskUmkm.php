<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class MListTaskUmkm extends CI_Model {

		public function create_task($data)
		{
			$this->db->insert('task', $data);
			return $this->db->insert_id();
		}

		public function update_data($id,$data){

			$this->db->where('id', $id);
			$this->db->update('task', $data);
		}

		public function update_task_history($id,$data){

			$this->db->where('id_task', $id);
			$this->db->update('task_history', $data);
		}

	}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class MHistoryTask extends CI_Model {

		public function update_data($id,$data){

			$this->db->where('id', $id);
			$this->db->update('task_history', $data);
		}

		public function update_task($id,$data){

			$this->db->where('id', $id);
			$this->db->update('task', $data);
		}

		public function get_id_task_by_id_history($id){

			$sql = "SELECT id_task FROM task_history WHERE id = ?";
			return $this->db->query($sql, array($id));
		}
    }
    
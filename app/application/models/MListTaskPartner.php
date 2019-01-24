<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class MListTaskPartner extends CI_Model {
        public function get_id_partner($id_user){
			$sql = "SELECT id FROM partner WHERE id_user = ?";
			return $this->db->query($sql, array($id_user));
		}

		public function ambil_task($id,$val){
			$this->db->set('status',$val);
			$this->db->where('id',$id);
			$this->db->update('task');
		}

		public function create_task_history($data){
			$this->db->insert('task_history',$data);
			$id_task = $this->db->insert_id();
			return $id_task;
		}
    }


    
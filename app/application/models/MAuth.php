<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class MAuth extends CI_Model {

		public function cekData($username,$password){
			$sql = "SELECT * FROM user WHERE username = ? and password = ?";
			return $this->db->query($sql, array($username,md5($password)));
		}

		public function cekStatus($username,$password){
			$sql = "SELECT * FROM user WHERE username = ? and password = ? and status = 1";
			return $this->db->query($sql, array($username,md5($password)));
		}

		public function create_data($data)
		{
			$this->db->insert('user', $data);
			return $this->db->insert_id();
		}

		public function checkUserAviable($username){
			$sql = "SELECT username FROM user WHERE username = ?";
			return $this->db->query($sql, array($username));
		}

		public function get_reqruitment_partner($id_user){
			$sql = "SELECT reqruitment FROM partner WHERE id_user = ?";
			return $this->db->query($sql, array($id_user));
		}

		public function create_data_partner($data)
		{
			$this->db->insert('partner', $data);
			return $this->db->insert_id();
		}
		public function create_data_umkm($data)
		{
			$this->db->insert('umkm', $data);
			return $this->db->insert_id();
		}

		public function check_hasil_test($id){
			$sql = "SELECT id FROM jawaban_soal_test WHERE id_user = $id";
			return $this->db->query($sql);
		}
	
	    public function updateDateVerifikasi($id){
	    	$sql = "UPDATE user set date_update_verifikasi=now() where id = ?";
	    	$this->db->query($sql, $id);
	    }

	    public function addLogLogin($id){
	    	$this->db->query("INSERT into log_user(id_user, waktu_login) values('$id',now())");
	    }

	    public function addLogLogout($id){
	    	$id_log = $this->db->query("SELECT id_log FROM log_user where id_user='$id' and date(waktu_login) = date(now()) order by id_log desc limit 1");
	    	foreach ($id_log->result() as $value) {
	    		$id_log = $value->id_log;
	    	}
	    	$this->db->query("UPDATE log_user set waktu_logout = now() where id_log = '$id_log' ");
	    }

	    public function getHakAkses($id){
	    	return $this->db->query("SELECT
										g.nama_group,
										m.nama_menu
									FROM
										`user` u
									LEFT JOIN list_user_group g ON u.user_group = g.id
									LEFT JOIN hak_akses ha ON g.id = ha.id_user_group
									LEFT JOIN menu m ON ha.id_menu = m.id
									WHERE
										u.id = $id
									GROUP BY
										nama_menu
									ORDER BY
										m.id ASC");
	    }

	    // public function cekMaintenance(){
	    // 	$data = $this->db->query("SELECT * FROM maintenance");
	    // 	foreach ($data->result() as $value) {
	    // 		if($value->do == 1){
	    // 			return true;
	    // 		}else{
	    // 			return false;
	    // 		}
	    // 	}
	    // }

	    // public function setMaintenance($value){
	    // 	$this->db->query("UPDATE maintenance set do = '$value'");
	    // }

	    // public function setPhoneNoPartner($id,$tlp,$partner){
	    // 	$data = array(
	    // 		"tlp" => $tlp,
	    // 		"company" => $partner
	    // 	);
	    // 	$this->db->where('id', $id);
		// 	$this->db->update('user', $data);
	    // }
	}
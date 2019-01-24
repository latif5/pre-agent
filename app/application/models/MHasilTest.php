<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class MHasilTest extends CI_Model {

		public function get_data_test($id)
		{
			$sql = "SELECT
						u.nama,
						u.username,
						u.no_tlp,
						js.nilai,
						we.we
					FROM
						jawaban_soal_test AS js
					JOIN `user` AS u ON js.id_user = u.id
					JOIN we ON js.id_user = we.id_user
					WHERE
						js.id_user = ?";
			return $this->db->query($sql, array($id));
		}


    }
    
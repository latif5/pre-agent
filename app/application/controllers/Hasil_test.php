<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hasil_test extends CI_Controller {

    public function __construct() {
        Parent::__construct();
        $this->load->model('MHasilTest');
        if($this->session->userdata('id') == ""){
            redirect('Auth');
        }
    }

    function dateTimeFormat($date){
  		if($date != null ){
  			$date = date_create($date);
    			$date = date_format($date, 'Y-m-d');
    			return $date;
  		}
  		$date = "-";
  		return $date;
  		
  	}
	
	function index(){
    $data = $this->MHasilTest->get_data_test($this->session->userdata('id'));
    if($data->num_rows() != null){
      foreach ($data->result() as $value) {
        $this->template['nama'] = $value->nama;
        $this->template['username'] = $value->username;
        $this->template['no_tlp'] = $value->no_tlp;
        $this->template['nilai'] = $value->nilai;
        $this->template['we'] = $value->we;
      }
    }
    $data = '';
    $this->template['header_start']   = $this->load->view('layout/header_start','', TRUE);
    $this->template['header_end']   = $this->load->view('layout/header_end','', TRUE);

    $this->template['footer_start'] = $this->load->view('layout/footer_start','', TRUE);
    $this->template['footer_end'] = $this->load->view('layout/footer_end','', TRUE);
      

		$this->load->view("hasil-test", $this->template);
	}
}
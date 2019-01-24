<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct() {
        Parent::__construct();
        $this->load->model('MProfile');
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
    $data = $this->MProfile->get_data_user($this->session->userdata('id'));
      if($data->num_rows() != null){
        foreach ($data->result() as $value) {
          $this->template['email'] = $value->email;
          $this->template['nama'] = $value->nama;
          $this->template['user_name'] = $value->username;
          $this->template['no_tlp'] = $value->no_tlp;
          $this->template['alamat'] = $value->alamat;
        }
      }
      $data = '';
      $this->template['header_start']   = $this->load->view('layout/header_start','', TRUE);
      $this->template['header_end']   = $this->load->view('layout/header_end','', TRUE);

      $this->template['footer_start'] = $this->load->view('layout/footer_start','', TRUE);
      $this->template['footer_end'] = $this->load->view('layout/footer_end','', TRUE);
      //partner
      if ($this->session->userdata('user_group') == 3) {
        $data = $this->MProfile->get_data_partner($this->session->userdata('id'));
        if($data->num_rows() != null){
          foreach ($data->result() as $value) {
            $this->template['semester'] = $value->semester;
            $this->template['ipk'] = $value->ipk;
            $this->template['file_krs'] = $value->file_krs;
          }
        }

        $this->template['form_upload_krs_partner'] = $this->load->view('form/form_upload_krs','', TRUE);
              $this->template['form_input_semester'] = $this->load->view('form/form_input_semester','', TRUE);
              $this->template['form_input_ipk'] = $this->load->view('form/form_input_ipk','', TRUE);

      }elseif ($this->session->userdata('user_group') == 2) {
        $this->template['form_input_pemilik_umkm'] = $this->load->view('form/form_pemilik_umkm','', TRUE);
      }

		$this->load->view("profile", $this->template);
	}

  public function update()
  {
    $id = $this->session->userdata('id');
    $user_group = $this->session->userdata('user_group');
    $data = array();
     $data = array(
        "nama" => $this->input->post('nama'),
        "password" => $this->input->post('password'),
        "no_tlp" => $this->input->post('no_tlp'),
        "alamat" => $this->input->post('alamat')
      );
      
      $res = $this->MProfile->update_data($id,$data);
    if ($user_group == 2) {
      $data = array(
        "pemilik_umkm" => $this->input->post('nama'),
      );
      
      $res = $this->MProfile->update_data_umkm($id,$data);
    }elseif ($user_group == 3) {
      
      if ($_FILES['file_krs']['name'] != null) {
          $fileName = time()."_".$this->session->userdata('user_name')."_". $_FILES['file_krs']['name'];
          $path_name = $this->upload_krs($fileName);
        }
      if ($_FILES['file_krs']['name'] != null) {
        $data = array(
          "semester" => $this->input->post('semester'),
          "ipk" => $this->input->post('password'),
          "file_krs" => $path_name
        );
      }else{
        $data = array(
          "semester" => $this->input->post('semester'),
          "ipk" => $this->input->post('ipk')
        );
      }
  
      $res = $this->MProfile->update_data_partner($id,$data);
    }
    
    
    if ($res !== false){
        $this->session->set_flashdata('success',true);
        $this->session->set_flashdata('message',"Update data user success.");
        redirect('Profile','refresh');
    }else{ 
        $this->session->set_flashdata('gagal',true);
        $this->session->set_flashdata('message',"Sorry, can't update data.");
        redirect('Profile','refresh');
    }
  }

  public function upload_krs($fileName){
    $fileName = str_replace(' ', '_', $fileName);
    $time_upload = date('Y-m-d H:i:s');
    $arr = explode('-', $time_upload);
    // $target_path_media = "/$arr[0]/$arr[1]/";

     if (!file_exists("./assets/file/krs/$arr[0]/$arr[1]/")) {
        try{
            // echo "ini buat bulan->".var_dump(MEDIADIR."/$arr[0]/$arr[1]/");
            mkdir("./assets/file/krs/$arr[0]/$arr[1]/", 0755, true);
            // exit();
          }catch(PDOException $e){
          $massage = $e->getMessage();
          $return = array(
            'message' => $massage,
            'isLogin' => false
          );
          exit();
        }
    }

    $inputFileName = "./assets/file/krs/$arr[0]/$arr[1]/";
    // var_dump($_FILES['file_krs']);
    // exit();
    
    $config['upload_path'] = $inputFileName;
    $config['file_name'] = $fileName;
    $config['allowed_types'] = 'pdf';
    $config['max_size'] = 1500000;
    $this->load->library('upload');
    $this->upload->initialize($config);
    if(! $this->upload->do_upload('file_krs') ){
      $error = $this->upload->display_errors();
      // menampilkan pesan error
      print_r($error);
    }
    $media = $this->upload->data();
    return $inputFileName.''.$fileName;

  }

}
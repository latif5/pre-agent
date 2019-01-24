<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth extends CI_Controller {
  function __construct()
  {
    parent::__construct();
  	$this->load->model("MAuth");
  }
  
  public function index($nama_user = null) {
    $this->template['header_account']   = $this->load->view('layout/header_account','', TRUE);
    $this->template['footer_account']   = $this->load->view('layout/footer_account','', TRUE);
    /*$date = $this->dateSerialToDateTime(43046);
    echo $date."<br>";
    echo date('Y', $date)."-".date('m', $date)."-".date('d', $date);*/
    $this->load->view('signin', $this->template);
  }


  public function successLogin($email,$id,$nama,$no_tlp,$user_group,$username,$alamat){
    $this->session->unset_userdata("nama_userTemp");
    $this->session->unset_userdata("passwordTemp");
    $data['email'] = $email;
    $data['id'] = $id;
    // $data['nama'] = $nama;
    // $data['no_tlp'] = $no_tlp;
    $data['user_group'] = $user_group;
    $data['user_name'] = $username;
    // $data['alamat'] = $alamat;
    $hakAkses = $this->MAuth->getHakAkses($id);
    $access = array();
    $menu = array();
    $admin = false;
    foreach ($hakAkses->result() as $value) {
      if($value->nama_group == "Admin"){
        $admin = true;
      }
      $data['nama_group'] = $value->nama_group;
      array_push($menu, $value->nama_menu);
      // array_push($access, $value->hak_akses);
    }
    $data['nama_menu'] = $menu;
 
    $this->session->set_userdata($data);
    $this->MAuth->addLogLogin($id);
    if(sizeof($menu) == 0){
        redirect('Auth','refresh');
    }
    // echo json_encode($menu);
    // exit();
    if($menu[0] == "List UMKM"){
      redirect('List_umkm','refresh');
    }
    if($menu[0] == "List Partner"){
      redirect('List_partner','refresh');
    }
    // if($menu[0] == "Daftar UMKM"){
    //   redirect('Daftar UMKM','refresh');
    // }
    // if($menu[0] == "Profil UMKM"){
    //   redirect('Profil UMKM','refresh');
    // }
    if($menu[0] == "List Task Jobs"){
      redirect('List_task_umkm','refresh');
    }
    // if($menu[0] == "Add Task Jobs"){
    //   redirect('Add Task Jobs','refresh');
    // }
    // if($menu[0] == "Daftar Partner"){
    //   redirect('Daftar Partner','refresh');
    // }
    // if($menu[0] == "Profil Partner"){
    //   redirect('Profil Partner','refresh');
    // }
    if($menu[0] == "Test Partner"){
      if ($user_group == 3) {
        $nilai_test = $this->MAuth->check_hasil_test($this->session->userdata('id'));
        // echo json_encode($nilai_test);
        // exit();
        
        if ($nilai_test->num_rows()==0) {

          $hasil_nilai['sudah_test'] = 'false';
          $this->session->set_userdata($hasil_nilai);
          redirect('Test_partner','refresh');
        }else{
          $data_partner = $this->MAuth->get_reqruitment_partner($id);
          foreach ($data_partner->result() as $val) {
            $reqruitment = $val->reqruitment;
          }

          if ($reqruitment!=1) {
            $hasil_nilai['sudah_test'] = 'true';
            $hasil_nilai['reqruitment'] = 'false';
            $this->session->set_userdata($hasil_nilai);
            redirect('Hasil_test','refresh');
          }else{
            $hasil_nilai['sudah_test'] = 'true';
            $hasil_nilai['reqruitment'] = 'true';
            $this->session->set_userdata($hasil_nilai);
            redirect('List_task_partner','refresh');
          }
          
        }
        
      }else{
        redirect('List_task_partner','refresh');
      }
      
    }
    // if($menu[0] == "Hasil Test Partner"){
    //   redirect('Hasil Test Partner','refresh');
    // }
    // if($menu[0] == "History Task Jobs"){
    //   redirect('History Task Jobs','refresh');
    // }
    // if($menu[0] == "List Task Jobs"){
    //   redirect('List Task Jobs','refresh');
    // }
    // }
  }

  public function login(){
      $nama_user = $this->input->post("username");
      $password = $this->input->post("password");
      $this->session->set_userdata("nama_userTemp",$nama_user);
      $this->session->set_userdata("passwordTemp",$password);
    
      if($this->MAuth->cekData($nama_user,'1@3$5'.$password)->num_rows() != null){
        $data = $this->MAuth->cekStatus($nama_user,'1@3$5'.$password);
        if($data->num_rows() != null){
          foreach ($data->result() as $value) {
            $email = $value->email;
            $id = $value->id;
            $nama = $value->nama;
            $username = $value->username;
            $no_tlp = $value->no_tlp;
            $user_group = $value->user_group;
            $alamat = $value->alamat;
          }
          
          $this->successLogin($email,$id,$nama,$no_tlp,$user_group,$username,$alamat);
          
        }else{
          $this->session->set_flashdata('gagal',true);
          $this->session->set_flashdata('message',"Sorry, your account is inactive.");
          redirect('Auth','refresh');
        }
      }else{
        $this->session->set_flashdata('gagal',true);
        $this->session->set_flashdata('message',"The username you entered couldn't be found or your password was incorrect. <br> Please try again.");
        redirect('Auth','refresh');
      }
      
  }

  public function checkUserAviable(){
    // var_dump($_REQUEST);
    $user_name = $_REQUEST['user_name'];
    // echo $nama_user;
    $data = $this->MAuth->checkUserAviable($user_name);
    // echo json_encode($data->result());
    // echo $data->num_rows();
    if ($data->num_rows() > 0) {
      echo '""';
    }else{
      echo '"true"';
    }
  }

  public function register(){
    if ($_REQUEST['type'] != null) {
      $this->template['header_account']   = $this->load->view('layout/header_account','', TRUE);
      $this->template['footer_account']   = $this->load->view('layout/footer_account','', TRUE);
      $type = $_REQUEST['type'];
      $this->template['type_user'] = $type; 
      if ($type == 'umkm') {
        $this->template['form_register_umkm']   = $this->load->view('form/form_register_umkm','', TRUE);
      }elseif($type == 'partner') {
        // $this->template['form_singup']   = $this->load->view('layout/form_partner','', TRUE);
        $this->template['form_register_partner'] = $this->load->view('form/form_register_partner','', TRUE);
      }

      $this->load->view('signup', $this->template);
    }else{
      redirect('Auth','refresh');
    }
    
  }
 
  public function newAccount()
  {
    if ($this->input->post('type_user') == 'partner') {
      $data = array(
        "nama" => $this->input->post('nama'),
        "username" => $this->input->post('user_name'),
        "password" => md5("1@3$5".$this->input->post('password')),
        "email" => $this->input->post('email'),
        "no_tlp" => $this->input->post('no_tlp'),
        "alamat" => $this->input->post('alamat'),
        "status" => 1,
        "user_group" => 3
      );
      // echo json_encode($data);

      $res = $this->MAuth->create_data($data);
      // echo $res;
      // exit();
      if ($res!=null) {
        //upload file
        if ($_FILES['file_krs']['name'] != null) {
          $fileName = time()."_".$this->session->userdata('user_name')."_". $_FILES['file_krs']['name'];
          $path_name = $this->upload_krs($fileName);
        }
       
        $data = array(
          "id_user" => $res,
          "semester" => $this->input->post('semester'),
          "ipk" => $this->input->post('ipk'),
          "file_krs" => $path_name,
          "reqruitment" => 0
        );
        
        $id_partner = $this->MAuth->create_data_partner($data);
        if ($id_partner==null) {
          //jika gagal upload
          $this->template['header_account']   = $this->load->view('layout/header_account','', TRUE);
          $this->template['footer_account']   = $this->load->view('layout/footer_account','', TRUE);

          // $this->template['form_singup']   = $this->load->view('layout/form_partner','', TRUE);
          $this->template['form_register_partner'] = $this->load->view('form/form_register_partner','', TRUE);
        
          $this->load->view('signup', $this->template);
        }else{
          $this->session->set_flashdata('success',true);
          $this->session->set_flashdata('message',"Register new partner success. <br> Please signin to answer AGENT.");
        
          redirect('Auth','refresh');
        }
        
      }
    }elseif ($this->input->post('type_user') == 'umkm') {
      $data = array(
        "nama" => $this->input->post('nama'),
        "username" => $this->input->post('user_name'),
        "password" => md5("1@3$5".$this->input->post('password')),
        "email" => $this->input->post('email'),
        "no_tlp" => $this->input->post('no_tlp'),
        "alamat" => $this->input->post('alamat'),
        "status" => 1,
        "user_group" => 2
      );
      // echo json_encode($data);

      $res = $this->MAuth->create_data($data);
      if ($res!=null) {
       
        $data = array(
          "id_user" => $res,
          "pemilik_umkm" => $this->input->post('pemilik_umkm'),
        );
        $id_umkm = $this->MAuth->create_data_umkm($data);
        if ($id_umkm==null) {
          //jika gagal upload
          $this->template['header_account']   = $this->load->view('layout/header_account','', TRUE);
          $this->template['footer_account']   = $this->load->view('layout/footer_account','', TRUE);

          // $this->template['form_singup']   = $this->load->view('layout/form_partner','', TRUE);
          $this->template['form_register_partner'] = $this->load->view('form/form_register_partner','', TRUE);
        
          $this->load->view('signup', $this->template);
        }else{
          $this->session->set_flashdata('success',true);
          $this->session->set_flashdata('message',"Register new UMKM success. <br> Please signin.");

          redirect('Auth','refresh');
        }
        
      }
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
 

  public function checkCaptcha(){
    if(md5($this->input->post("captcha")) == $this->session->userdata("keycode")){
      return true;
    }else{
      return false;
    }
  }

  public function reCaptcha(){
    $this->session->unset_userdata('captcha');  
    redirect('Auth','refresh');
  }


  public function logout(){
    if(!empty($this->session->userdata('id'))){
      $this->MAuth->addLogLogout($this->session->userdata('id'));  
      $dataSession = $this->session->all_userdata();
      $this->session->unset_userdata($dataSession['id']);
      $this->session->unset_userdata($dataSession['email']);
      // $this->session->unset_userdata($dataSession['nama']);
      // $this->session->unset_userdata($dataSession['no_tlp']);
      $this->session->unset_userdata($dataSession['user_group']);
      $this->session->unset_userdata($dataSession['user_name']);
      $this->session->sess_destroy();
    }
    redirect('Auth','refresh');
  }

  public function setMaintenance(){
    $this->MAuth->setMaintenance($this->uri->segment(3));
    $data['maintenance'] = $this->uri->segment(3);
    $this->session->set_userdata($data);
    redirect('Dashboard','refresh');
  }
}
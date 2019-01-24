<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History_task_partner extends CI_Controller {

    public function __construct() {
        Parent::__construct();
        $this->load->model('MHistoryTask');
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
	
	function index()
	{

        $this->template['header_start']   = $this->load->view('layout/header_start.php','', TRUE);
        $this->template['header_end']   = $this->load->view('layout/header_end','', TRUE);

        $this->template['footer_start'] = $this->load->view('layout/footer_start','', TRUE);
        $this->template['footer_end'] = $this->load->view('layout/footer_end','', TRUE);
		$this->load->view("history-task-partner",$this->template);
    }
    
    public function get_data(){
        $partner =$this->session->userdata('user_name');
        $start  = $_REQUEST['iDisplayStart'];
        $length = $_REQUEST['iDisplayLength'];
        $sSearch = $_REQUEST['sSearch'];
    
        $col = $_REQUEST['iSortCol_0'];
    
        $arr = array(0 => 'no', 1 => 'nama', 2 => 'pemilik_umkm', 3=> 'email', 4=>'alamat', 5=>'no_tlp', 6=>'task_job', 7=>'task_completed');
    
        $sort_by = $arr[$col];
        $sort_type = $_REQUEST['sSortDir_0'];
    
        if($sort_by == 'nama'){
          $sort_by = "nama";
          $sort_type = "desc";
        }
            
        $qry = "SELECT
                    th.id,
                    t.nama_task,
                    t.file_task,
                    um.pemilik_umkm,
                    u.email,
                    u.no_tlp,
                    th.status_task_job,
                    th.file_partner
                FROM
                    task_history AS th
                JOIN task AS t ON th.id_task = t.id
                LEFT JOIN umkm AS um ON um.id_user = t.created_by
                LEFT JOIN `user` AS u ON t.created_by = u.id
                WHERE
                    th.create_by = \"$partner\"
                AND (
                    t.nama_task like ?
                    OR um.pemilik_umkm like ?
                    OR th.file_partner like ?
                )
                ORDER BY \"$sort_by\" \"$sort_type\"
                LIMIT ?,? ";
        $res = $this->db->query($qry, array("%".$sSearch."%", "%".$sSearch."%", "%".$sSearch."%", intval($start),intval($length)));
    
        $qry = "SELECT
                    count(t.id) as count
                FROM
                    task_history AS th
                JOIN task AS t ON th.id_task = t.id
                LEFT JOIN umkm AS um ON um.id_user = t.created_by
                LEFT JOIN `user` AS u ON t.created_by = u.id
                WHERE
                th.create_by = \"$partner\"
                AND (
                    t.nama_task like ?
                    OR um.pemilik_umkm like ?
                    OR th.file_partner like ?
                )";
        $result = $this->db->query($qry, array("%".$sSearch."%", "%".$sSearch."%", "%".$sSearch."%"));
    
        foreach($result->result() as $key)
        {
            $iTotal = $key->count;
        }
    
        $rec = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );
    
        $k=0;
        $no = 1;
        if($res->num_rows() != null){
            
            foreach ($res->result() as $value) {
                if($value->nama_task==NULL){ $nama_task='-';}else{$nama_task=$value->nama_task;}
                if($value->pemilik_umkm==NULL){ $pemilik_umkm='-';}else{$pemilik_umkm=$value->pemilik_umkm;}
                if($value->email==NULL){ $email='-';}else{$email=$value->email;}
                if($value->no_tlp==NULL){ $no_tlp='-';}else{$no_tlp=$value->no_tlp;}
                // if($value->updatedate=="0000-00-00 00:00:00" || $value->updatedate==NULL){ $updatedate='-';}else{$updatedate=$value->updatedate;}
                $index = NULL;

                if($value->status_task_job == "on progress"){
                    $status = '<span class="badge badge-custom">ON Progress</span>';
                }elseif ($value->status_task_job == "on review") {
                    $status = '<span class="badge badge-secondary">ON Review</span>';
                }elseif ($value->status_task_job == "complate") {
                    $status = '<span class="badge badge-success">Complete</span>';
                }else{
                    $status = '<span class="badge badge-danger">Reject</span>';
                }

                if($value->file_partner != NULL){
                    $file_partner = "<div class=\"file-img-box\">
                                    <img src=\"assets/images/file_icons/xls.svg\" id=\"tooltip-hover\" alt=\"icon\" style=\"height: 25px;\" title=\"$value->file_partner\">
                                    <a href=\"$value->file_partner\" data-id=\"$value->id\" class=\"file-download\"><i class=\"mdi mdi-download\" style=\"height: 25px;\"></i> </a>
                                </div>";
                }else{
                    $file_partner = "<div class=\"file-img-box\">
                                        <img src=\"assets/images/file_icons/xls.svg\" id=\"tooltip-hover\" alt=\"icon\" style=\"height: 25px;\">
                                        <a href=\"#\" class=\"file-upload\" data-id=\"$value->id\" data-toggle=\"modal\" data-target=\"#upload-file\"><i class=\"mdi mdi-upload\" style=\"height: 25px;\"></i> </a>
                                    </div>";
                }

                if($value->file_task != NULL){
                    $file_task = "<div class=\"file-img-box\">
                                    <img src=\"assets/images/file_icons/xls.svg\" id=\"tooltip-hover\" alt=\"icon\" style=\"height: 25px;\" title=\"$value->file_partner\">
                                    <a href=\"$value->file_task\" data-id=\"$value->id\" class=\"file-download\"><i class=\"mdi mdi-download\" style=\"height: 25px;\"></i> </a>
                                </div>";
                }else{
                    $file_task = "-";
                }
                $iteration = 0;
                
                $rec['aaData'][$k] = array(
                    $iteration => 't|no||'.$no,
                    $iteration+=1 => 't|nama||'.$nama_task,
                    $iteration+=1 => 't|pemilik_umkm||'.$pemilik_umkm,
                    $iteration+=1 => 't|status||'.$status,
                    $iteration+=1 => 't|file_task||'.$file_task,
                    $iteration+=1 => 't|upload||'.$file_partner,
                    $iteration+=1 => 't|email||'.$email,
                    $iteration+=1 => 't|no_tlp||'.$no_tlp

                );
                $no++;
                $k++;
                $start++;
            }
    
        }
        echo json_encode($rec);
    }

    public function update_task_partner() {
        $data = array();
        $id_task_history = $this->input->post('id_task');
        $fileName = time()."_".$this->session->userdata('user_name')."_". $_FILES['file_partner']['name'];
        // $id_partner = $this->MProfile->get_partner($this->session->userdata('id'));

        $upload_path = $this->upload_file_partner($fileName);
       
        $data = array(
            "id" => $id_task_history,
            "file_partner" => $upload_path,
            "status_task_job" => "on review",
            "update_by" => $this->session->userdata('user_name') ,
            "update_at" => date('Y-m-d H:i:s'),
        );
          
        $res = $this->MHistoryTask->update_data($id_task_history,$data);
        $id_task_partner = $this->MHistoryTask->get_id_task_by_id_history($id_task_history);
        $data = array(
            "status" => "on review",
            "updated_by" => $this->session->userdata('user_name') ,
            "updated_at" => date('Y-m-d H:i:s'),
        );

        $response = $this->MHistoryTask->update_task($id_task_history,$data);
        redirect('History_task_partner','refresh');
    }

    public function upload_file_partner($fileName){
        $fileName = str_replace(' ', '_', $fileName);
        $time_upload = date('Y-m-d H:i:s');
        $arr = explode('-', $time_upload);
        // $target_path_media = "/$arr[0]/$arr[1]/";

        if (!file_exists("./assets/file/task_partner/$arr[0]/$arr[1]/")) {
            try{
                // echo "ini buat bulan->".var_dump(MEDIADIR."/$arr[0]/$arr[1]/");
                mkdir("./assets/file/task_partner/$arr[0]/$arr[1]/", 0755, true);
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

        $inputFileName = "./assets/file/task_partner/$arr[0]/$arr[1]/";
        // var_dump($_FILES['file_krs']);
        // exit();
        
        $config['upload_path'] = $inputFileName;
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx';
        $config['max_size'] = 1500000;
        $this->load->library('upload');
        $this->upload->initialize($config);
        if(! $this->upload->do_upload('file_partner') ){
          $error = $this->upload->display_errors();
          // menampilkan pesan error
          print_r($error);
        }
        $media = $this->upload->data();
        return $inputFileName.''.$fileName;

      }
}
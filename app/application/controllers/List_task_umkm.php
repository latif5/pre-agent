<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class List_task_umkm extends CI_Controller {

    public function __construct() {
        Parent::__construct();
        $this->load->model('MListTaskUmkm');
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

        $this->template['header_start']   = $this->load->view('layout/header_start','', TRUE);
        $this->template['header_end']   = $this->load->view('layout/header_end','', TRUE);

        $this->template['footer_start'] = $this->load->view('layout/footer_start','', TRUE);
        $this->template['footer_end'] = $this->load->view('layout/footer_end','', TRUE);
		$this->load->view("list-task-umkm",$this->template);
    }
    
    public function get_data(){
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
                    t.id,
                    t.nama_task,
                    t.`status`,
                    th.create_by as nama,
                    th.file_partner,
                    t.file_task
                FROM
                    task as t
                LEFT JOIN task_history as th ON t.id = th.id_task
                LEFT JOIN `user` as u on t.id_partner = u.id
                WHERE 
                t.created_by = ?
                AND (
                    t.nama_task like ?
                    OR t.`status` like ?
                    OR u.nama like ?
                    OR th.file_partner like ?
                    OR t.file_task like ?
                )
                ORDER BY \"$sort_by\" \"$sort_type\"
                LIMIT ?,? ";
        $res = $this->db->query($qry, array($this->session->userdata('id'),"%".$sSearch."%", "%".$sSearch."%","%".$sSearch."%", "%".$sSearch."%", "%".$sSearch."%", intval($start),intval($length)));
    
        $qry = "SELECT
                    count(t.id) as count
                FROM
                    task as t
                LEFT JOIN task_history as th ON t.id = th.id_task
                LEFT JOIN `user` as u on t.id_partner = u.id
                WHERE 
                (
                    t.nama_task like ?
                    OR t.`status` like ?
                    OR u.nama like ?
                    OR th.file_partner like ?
                    OR t.file_task like ?
                )";
        $result = $this->db->query($qry, array("%".$sSearch."%", "%".$sSearch."%","%".$sSearch."%", "%".$sSearch."%", "%".$sSearch."%"));
    
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
                // if($value->status==NULL){ $status='-';}else{$status=$value->status;}
                if($value->nama==NULL){ $nama='-';}else{$nama=$value->nama;}
                if($value->file_task==NULL){ $file_task='-';}else{$file_task=$value->file_task;}
                // if($value->updatedate=="0000-00-00 00:00:00" || $value->updatedate==NULL){ $updatedate='-';}else{$updatedate=$value->updatedate;}
                $index = NULL;

                $iteration = 0;

                if($value->status == "available"){
                    $status = '<span  class="badge badge-success">Available</span>';
                }elseif ($value->status == "on progress") {
                    $status = '<span  class="badge badge-custom">On Progres</span>';
                }elseif ($value->status == "on review") {
                    $status = '<a data-id="'.$value->id.'" href="#" data-toggle="modal" data-target="#review-task" status="'.$value->status.'" class="review"><span  class="badge badge-warning">Review</span></a>';
                }elseif ($value->status == "complate") {
                    $status = '<span  class="badge badge-success">Complate</span>';
                }elseif ($value->status == "reject") {
                    $status = '<a data-id="'.$value->id.'" href="#" class="" status="'.$value->status.'"><span  class="badge badge-danger">Reject</span></a>';
                }

                if($value->file_partner != NULL){
                    $file_partner = "<div class=\"file-img-box\">
                                    <img src=\"assets/images/file_icons/xls.svg\" id=\"tooltip-hover\" alt=\"icon\" style=\"height: 25px;\" title=\"$value->file_partner\">
                                    <a href=\"$value->file_partner\" data-id=\"$value->id\" class=\"file-download\"><i class=\"mdi mdi-download\" style=\"height: 25px;\"></i> </a>
                                </div>";
                }else{
                    $file_partner = "-";
                }

                if($value->file_task != NULL){
                    $file_task = "<div class=\"file-img-box\">
                                    <img src=\"assets/images/file_icons/xls.svg\" id=\"tooltip-hover\" alt=\"icon\" style=\"height: 25px;\" title=\"$value->file_task\">
                                    <a href=\"$value->file_task\" data-id=\"$value->id\" class=\"file-download\"><i class=\"mdi mdi-download\" style=\"height: 25px;\"></i> </a>
                                </div>";
                }else{
                    $file_task = "-";
                }
                
                $rec['aaData'][$k] = array(
                    $iteration => 't|no||'.$no,
                    $iteration+=1 => 't|nama||'.$nama_task,
                    $iteration+=1 => 't|status||'.$status,
                    $iteration+=1 => 't|nama_partner||'.$nama,
                    $iteration+=1 => 't|file_task||'.$file_task,
                    $iteration+=1 => 't|file_partner||'.$file_partner
                    
                );
                $no++;
                $k++;
                $start++;
            }
    
        }
        echo json_encode($rec);
    }

    public function create_task(){
        if ($_FILES['file_task']['name'] != null) {
            $fileName = time()."_".$this->session->userdata('user_name')."_". $_FILES['file_task']['name'];
            $fileName = str_replace(' ', '_', $fileName);
            $upload_path = $this->upload_file($fileName);

            $data = array(
                "nama_task" => $this->input->post('task_name'),
                "file_task" => $upload_path,
                "status" => "available",
                "created_by" => $this->session->userdata('id'),
                "created_at" => date('Y-m-d H:i:s')
            );
            $id_task = $this->MListTaskUmkm->create_task($data);
            if ($id_task!=null) {
                redirect('List_task_umkm');
            }
        }
   
    }

    public function update_task() {
        $data = array();
        $id_task = $this->input->post('id');
        $status = $this->input->post('status');
        // $id_partner = $this->MProfile->get_partner($this->session->userdata('id'));
       
        $data = array(
            "id" => $id_task,
            "status" => $status,
            "updated_by" => $this->session->userdata('user_name') ,
            "updated_at" => date('Y-m-d H:i:s'),
        );
        
        $res = $this->MListTaskUmkm->update_data($id_task,$data);
        if ($status=="reject") {
            $data = array(
                "file_partner" => "",
                "status_task_job" => $status,
                "update_by" => $this->session->userdata('user_name') ,
                "update_at" => date('Y-m-d H:i:s'),
            );
        }else{
            $data = array(
                "status_task_job" => $status,
                "update_by" => $this->session->userdata('user_name') ,
                "update_at" => date('Y-m-d H:i:s'),
            );
        }
        
          
        $response = $this->MListTaskUmkm->update_task_history($id_task,$data);
        echo 1;
        // redirect('List_task_umkm','refresh');
    }

    public function upload_file($fileName){
        $time_upload = date('Y-m-d H:i:s');
        $arr = explode('-', $time_upload);
        // $target_path_media = "/$arr[0]/$arr[1]/";

         if (!file_exists("./assets/file/task/umkm/$arr[0]/$arr[1]/")) {
            try{
              // echo "ini buat bulan->".var_dump(MEDIADIR."/$arr[0]/$arr[1]/");
                mkdir("./assets/file/task/umkm/$arr[0]/$arr[1]/", 0755, true);
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

        $inputFileName = "./assets/file/task/umkm/$arr[0]/$arr[1]/";
        // var_dump($_FILES['file_krs']);
        // exit();
        
        $config['upload_path'] = $inputFileName;
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx';
        $config['max_size'] = 1500000;
        $this->load->library('upload');
        $this->upload->initialize($config);
        if(! $this->upload->do_upload('file_task') ){
          $error = $this->upload->display_errors();
          // menampilkan pesan error
          print_r($error);
        }
        $media = $this->upload->data();
        return $inputFileName.''.$fileName;
    }
}
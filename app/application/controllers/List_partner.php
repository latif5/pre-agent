<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class List_partner extends CI_Controller {

    public function __construct() {
        Parent::__construct();
        $this->load->model('MListPartner');
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
	
	function index() {

        $this->template['header_start']   = $this->load->view('layout/header_start','', TRUE);
        $this->template['header_end']   = $this->load->view('layout/header_end','', TRUE);

        $this->template['footer_start'] = $this->load->view('layout/footer_start','', TRUE);
        $this->template['footer_end'] = $this->load->view('layout/footer_end','', TRUE);
		$this->load->view("admin-list-partner",$this->template);
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
                    u.id,
                    u.nama,
                    u.alamat,
                    u.email,
                    u.alamat,
                    u.no_tlp,
                    p.semester,
                    p.ipk,
                    js.nilai,
                    we.we,
                    p.file_krs,
                    p.reqruitment,
                    COUNT(th.id_task) AS task_complated,
                    u.`status` AS `status`
                FROM
                    partner AS p
                LEFT JOIN `user` AS u ON p.id_user = u.id
                LEFT JOIN task AS t ON u.id = t.id_partner
                LEFT JOIN (
                    SELECT
                        id,
                        id_task
                    FROM
                        task_history
                    WHERE
                        status_task_job = \"complated\"
                ) AS th ON t.id = th.id_task
                LEFT JOIN jawaban_soal_test as js ON u.id = js.id_user
                LEFT JOIN we ON u.id = we.id_user
                WHERE 
                    js.nilai >= 20
                AND 
                (
                    u.nama like ?
                    OR u.email like ?
                    OR u.alamat like ?
                    OR u.no_tlp like ?
                    OR p.semester like ?
                    OR p.ipk like ?
                    OR js.nilai like ?
                    OR p.file_krs like ?
                    OR p.reqruitment like ?
                )
                GROUP BY u.id
                ORDER BY \"$sort_by\" \"$sort_type\"
                LIMIT ?,? ";
        $res = $this->db->query($qry, array("%".$sSearch."%", "%".$sSearch."%", "%".$sSearch."%", "%".$sSearch."%", "%".$sSearch."%","%".$sSearch."%", "%".$sSearch."%", "%".$sSearch."%", "%".$sSearch."%", intval($start),intval($length)));
    
        $qry = "SELECT
                    count(u.id) as count
                FROM
                    partner AS p
                LEFT JOIN `user` AS u ON p.id_user = u.id
                LEFT JOIN task AS t ON u.id = t.id_partner
                LEFT JOIN (
                    SELECT
                        id,
                        id_task
                    FROM
                        task_history
                    WHERE
                        status_task_job = \"complated\"
                ) AS th ON t.id = th.id_task
                LEFT JOIN jawaban_soal_test as js ON u.id = js.id_user
                WHERE 
                (
                    u.nama like ?
                    OR u.email like ?
                    OR u.alamat like ?
                    OR u.no_tlp like ?
                    OR p.semester like ?
                    OR p.ipk like ?
                    OR js.nilai like ?
                    OR p.file_krs like ?
                    OR p.reqruitment like ?
                )
                GROUP BY u.id";
        $result = $this->db->query($qry, array("%".$sSearch."%", "%".$sSearch."%", "%".$sSearch."%", "%".$sSearch."%", "%".$sSearch."%","%".$sSearch."%","%".$sSearch."%", "%".$sSearch."%", "%".$sSearch."%"));
    
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
                if($value->nama==NULL){ $nama='-';}else{$nama=$value->nama;}
                if($value->email==NULL){ $email='-';}else{$email=$value->email;}
                if($value->alamat==NULL){ $alamat='-';}else{$alamat=$value->alamat;}
                if($value->no_tlp==NULL){ $no_tlp='-';}else{$no_tlp=$value->no_tlp;}
                if($value->semester==0){ $semester='-';}else{$semester=$value->semester;}
                if($value->ipk==0){ $ipk='-';}else{$ipk=$value->ipk;}
                if($value->nilai==0){ $nilai_tes='-';}else{$nilai_tes=$value->nilai;}
                if($value->we==0){ $we='-';}else{$we=$value->we;}
                // if($value->file_krs==NULL){ $file_krs='-';}else{$file_krs=$value->file_krs;}
                if($value->task_complated==0){ $task_complated='-';}else{$task_complated=$value->task_complated;}
                // if($value->updatedate=="0000-00-00 00:00:00" || $value->updatedate==NULL){ $updatedate='-';}else{$updatedate=$value->updatedate;}
                $index = NULL;

                if($value->reqruitment == "1"){
                    $reqruitment = '<a data-id="'.$value->id.'" href="#" class="change-reqruitment" val="'.$value->reqruitment.'"><span class="badge badge-success">Yes</span></a>';
                }elseif ($value->reqruitment == "0") {
                    $reqruitment = '<a data-id="'.$value->id.'" href="#" class="change-reqruitment" val="'.$value->reqruitment.'"><span class="badge badge-secondary">No</span></a>';
                }else{
                    $reqruitment = '-';
                }         

                if($value->file_krs != NULL){
                    $file_krs = "<div class=\"file-img-box\">
                                    <img src=\"assets/images/file_icons/pdf.svg\" id=\"tooltip-hover\" alt=\"icon\" style=\"height: 25px;\" title=\"$value->file_krs\">
                                    <a href=\"$value->file_krs\" class=\"file-download\"><i class=\"mdi mdi-download\"></i> </a>
                                </div>";
                }else{
                    $file_krs = '-';
                }
                

                if($value->status == "1"){
                    $status = '<a data-id="'.$value->id.'" href="#" class="change-status" status="'.$value->status.'"><span  class="badge badge-success">Active</span></a>';
                }elseif ($value->status == "0") {
                    $status = '<a data-id="'.$value->id.'" href="#" class="change-status" status="'.$value->status.'"><span class="badge badge-secondary">Inactive</span></a>';
                }else{
                    $status = '-';
                }
                $iteration = 0;
                
                $rec['aaData'][$k] = array(
                    $iteration => 't|no||'.$no,
                    $iteration+=1 => 't|nama||'.$nama,
                    $iteration+=1 => 't|email||'.$email,
                    $iteration+=1 => 't|alamat||'.$alamat,
                    $iteration+=1 => 't|no_tlp||'.$no_tlp,
                    $iteration+=1 => 't|task_job||'.$semester,
                    $iteration+=1 => 't|email||'.$ipk,
                    $iteration+=1 => 't|alamat||'.$nilai_tes,
                    $iteration+=1 => 't|we||'.$we,
                    $iteration+=1 => 't|no_tlp||'.$file_krs,
                    $iteration+=1 => 't|reqruitment||'.$reqruitment,
                    $iteration+=1 => 't|task_complated||'.$task_complated,
                    $iteration+=1 => 't|status||'.$status,
                    $iteration+=1 => 't|status||'
                );
                $no++;
                $k++;
                $start++;
            }
    
        }
        echo json_encode($rec);
    }

    public function change_status(){
        $id = $this->input->post('id');
        if ($this->input->post('val') == 1) {
            $val = 0;
        }else{
            $val= 1;
        }
        $res = $this->MListPartner->change_status($id,$val);
        if ($res !== false){
            echo 1;
        }else{ 
            echo $res;
        }
    }

    public function change_req(){
        $id = $this->input->post('id');
        if ($this->input->post('val') == 1) {
            $val = 0;
        }else{
            $val= 1;
        }
        $res = $this->MListPartner->change_req($id,$val);
        if ($res !== false){
            echo 1;
        }else{ 
            echo $res;
        }
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class List_task_partner extends CI_Controller {

    public function __construct() {
        Parent::__construct();
        $this->load->model('MListTaskPartner');
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
		$this->load->view("list-task-partner",$this->template);
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
                    um.pemilik_umkm,
                    t.status
                FROM
                    task AS t
                LEFT JOIN umkm AS um ON t.created_by = um.id_user
                WHERE 
                (
                    t.nama_task like ?
                    OR um.pemilik_umkm like ?
                    OR t.status like ?
                )
                ORDER BY \"$sort_by\" \"$sort_type\"
                LIMIT ?,? ";
        $res = $this->db->query($qry, array("%".$sSearch."%", "%".$sSearch."%", "%".$sSearch."%", intval($start),intval($length)));
    
        $qry = "SELECT
                    count(t.id) as count
                FROM
                    task AS t
                LEFT JOIN umkm AS um ON t.created_by = um.id_user
                WHERE 
                (
                    t.nama_task like ?
                    OR um.pemilik_umkm like ?
                    OR t.status like ?
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
                // if($value->updatedate=="0000-00-00 00:00:00" || $value->updatedate==NULL){ $updatedate='-';}else{$updatedate=$value->updatedate;}
                $index = NULL;

                if($value->status == "available"){
                    $action = '<a data-id="'.$value->id.'" href="#" class="ambil-task" status="'.$value->status.'"><span  class="badge badge-success">Ambil Task</span></a>';
                }elseif ($value->status == "on progress") {
                    $action = '<span  class="badge badge-custom">On Progres</span>';
                }elseif ($value->status == "on review") {
                    $action = '<span  class="badge badge-secondary">On Review</span>';
                }elseif ($value->status == "complate") {
                    $action = '<span  class="badge badge-success">Complate</span>';
                }elseif ($value->status == "reject") {
                    $action = '<a data-id="'.$value->id.'" href="#" class="" status="'.$value->status.'"><span  class="badge badge-danger">Reject</span></a>';
                }
                $iteration = 0;
                
                $rec['aaData'][$k] = array(
                    $iteration => 't|no||'.$no,
                    $iteration+=1 => 't|nama||'.$nama_task,
                    $iteration+=1 => 't|pemilik_umkm||'.$pemilik_umkm,
                    $iteration+=1 => 't|action||'.$action
                );
                $no++;
                $k++;
                $start++;
            }
    
        }
        echo json_encode($rec);
    }

    public function ambil_task(){
        $id = $this->input->post('id');
        if ($this->input->post('val') == "available") {
            $val = "on progress";
        }
        // $res = true;
        $res = $this->MListTaskPartner->ambil_task($id,$val);
        if ($res !== false){
            $data_paertner = $this->MListTaskPartner->get_id_partner($this->session->userdata('id'))->result();
            // echo json_encode($data_paertner);
            // echo $this->session->userdata('id');
            // exit();
            foreach ($data_paertner as $value) {
                $id_partner = $value->id;
            }
            $data = array(
                "id_partner" => $id_partner,
                "id_task" => $id,
                "create_by" => $this->session->userdata('user_name'),
                "create_at" => date("Y-m-d h:i:sa"),
                "status_task_job" => "on progress"
            );
            // echo json_encode($data);
            // exit();
            $this->MListTaskPartner->create_task_history($data);
            echo 1;
        }else{ 
            echo $res;
        }
    }
}
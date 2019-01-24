<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class List_umkm extends CI_Controller {

    public function __construct() {
        Parent::__construct();
        $this->load->model('MListUmkm');
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
      	if($this->session->userdata('user_group') == 3){
            $this->template['form_upload_krs_partner'] = $this->load->view('form/form_upload_krs','', TRUE);
            $this->template['form_input_semester'] = $this->load->view('form/form_input_semester','', TRUE);
            $this->template['form_input_ipk'] = $this->load->view('form/form_input_ipk','', TRUE);
        }elseif ($this->session->userdata('user_group') == 2) {
        	$this->template['form_input_pemilik_umkm'] = $this->load->view('form/form_pemilik_umkm','', TRUE);
        }
		$this->load->view("admin-list-umkm.php", $this->template);
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
                    u.nama AS nama,
                    um.pemilik_umkm AS pemilik_umkm,
                    u.email AS email,
                    u.alamat AS alamat,
                    u.no_tlp AS no_tlp,
                    COUNT(t.id) AS task_job,
                    COUNT(th.id_task) AS task_complated,
                    u.`status` AS status
                FROM
                    umkm AS um
                LEFT JOIN `user` AS u ON um.id_user = u.id
                LEFT JOIN task AS t ON u.id = t.created_by
                LEFT JOIN (
                    SELECT
                        id,
                        id_task
                    FROM
                        task_history
                    WHERE
                        status_task_job = \"complate\"
                ) AS th ON t.id = th.id_task
				WHERE 
				(
					u.nama like ?
					OR um.pemilik_umkm like ?
					OR u.email like ?
					OR u.alamat like ?
					OR u.no_tlp like ?
				)
                GROUP BY u.id
				ORDER BY \"$sort_by\" \"$sort_type\"
				LIMIT ?,? ";
        $res = $this->db->query($qry, array("%".$sSearch."%", "%".$sSearch."%", "%".$sSearch."%", "%".$sSearch."%", "%".$sSearch."%", intval($start),intval($length)));
    
        $qry = "SELECT
					count(u.id) as count
				FROM
					umkm AS um
				LEFT JOIN `user` AS u ON um.id_user = u.id
				LEFT JOIN task AS t ON u.id = t.created_by
				LEFT JOIN (
					SELECT
						id,
						id_task
					FROM
						task_history
					WHERE
						status_task_job = \"complate\"
				) AS th ON t.id = th.id_task
				WHERE 
				(
					u.nama like ?
					OR um.pemilik_umkm like ?
					OR u.email like ?
					OR u.alamat like ?
					OR u.no_tlp like ?
				)";
        $result = $this->db->query($qry, array("%".$sSearch."%", "%".$sSearch."%", "%".$sSearch."%", "%".$sSearch."%", "%".$sSearch."%"));
    
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
				if($value->pemilik_umkm==NULL){ $pemilik_umkm='-';}else{$pemilik_umkm=$value->pemilik_umkm;}
				if($value->email==NULL){ $email='-';}else{$email=$value->email;}
				if($value->alamat==NULL){ $alamat='-';}else{$alamat=$value->alamat;}
				if($value->no_tlp==NULL){ $no_tlp='-';}else{$no_tlp=$value->no_tlp;}
				if($value->task_job==0){ $task_job='-';}else{$task_job=$value->task_job;}
				if($value->task_complated==0){ $task_complated='-';}else{$task_complated=$value->task_complated;}

                // if($value->updatedate=="0000-00-00 00:00:00" || $value->updatedate==NULL){ $updatedate='-';}else{$updatedate=$value->updatedate;}
                $index = NULL;           

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
                    $iteration+=1 => 't|pemilik_umkm||'.$pemilik_umkm,
                    $iteration+=1 => 't|email||'.$email,
                    $iteration+=1 => 't|alamat||'.$alamat,
                    $iteration+=1 => 't|no_tlp||'.$no_tlp,
                    $iteration+=1 => 't|task_job||'.$task_job,
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
        $res = $this->MListUmkm->change_status($id,$val);
        if ($res !== false){
            echo 1;
        }else{ 
            echo $res;
        }
    }
}
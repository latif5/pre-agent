<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_partner extends CI_Controller {

    public function __construct() {
        Parent::__construct();
        $this->load->model('MTestPartner');
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
        // echo $this->session->userdata('user_group');
        // exit();
         $check_test = $this->MTestPartner->get_hasil_test($this->session->userdata('id'));
        if ($check_test->num_rows()!=0) {
            redirect('Hasil_test','refresh');
        }else{
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
            $this->template['list_soal'] = $this->MTestPartner->get_data_soal_test()->result();
            // $this->template['content'] = $this->load->view($data, true);
            
    		$this->load->view("test_partner", $this->template);
        }
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
                    u.nama,
                    u.alamat,
                    u.email,
                    u.alamat,
                    u.no_tlp,
                    p.semester,
                    p.ipk,
                    p.nilai_tes,
                    p.file_krs,
                    p.reqruitment,
                    COUNT(th.id_task) AS task_complated,
                    u.`status` AS `status`
                FROM
                    partner AS p
                LEFT JOIN `user` AS u ON p.id_user = u.id
                LEFT JOIN task AS t ON u.id = t.id_user
                LEFT JOIN (
                    SELECT
                        id,
                        id_task
                    FROM
                        task_history
                    WHERE
                        status_task_job = \"complated\"
                ) AS th ON t.id = th.id_task
                WHERE 
                (
                    u.nama like ?
                    OR u.email like ?
                    OR u.alamat like ?
                    OR u.no_tlp like ?
                    OR p.semester like ?
                    OR p.ipk like ?
                    OR p.nilai_tes like ?
                    OR p.file_krs like ?
                    OR p.reqruitment like ?
                )
                ORDER BY \"$sort_by\" \"$sort_type\"
                LIMIT ?,? ";
        $res = $this->db->query($qry, array("%".$sSearch."%", "%".$sSearch."%", "%".$sSearch."%", "%".$sSearch."%", "%".$sSearch."%","%".$sSearch."%", "%".$sSearch."%", "%".$sSearch."%", "%".$sSearch."%", intval($start),intval($length)));
    
        $qry = "SELECT
                    count(u.id) as count
                FROM
                    partner AS p
                LEFT JOIN `user` AS u ON p.id_user = u.id
                LEFT JOIN task AS t ON u.id = t.id_user
                LEFT JOIN (
                    SELECT
                        id,
                        id_task
                    FROM
                        task_history
                    WHERE
                        status_task_job = \"complated\"
                ) AS th ON t.id = th.id_task
                WHERE 
                (
                    u.nama like ?
                    OR u.email like ?
                    OR u.alamat like ?
                    OR u.no_tlp like ?
                    OR p.semester like ?
                    OR p.ipk like ?
                    OR p.nilai_tes like ?
                    OR p.file_krs like ?
                    OR p.reqruitment like ?
                )";
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
        if($res->num_rows() != null){
            
            foreach ($res->result() as $value) {
                if($value->nama==NULL){ $nama='-';}else{$nama=$value->nama;}
                if($value->email==NULL){ $email='-';}else{$email=$value->email;}
                if($value->alamat==NULL){ $alamat='-';}else{$alamat=$value->alamat;}
                if($value->no_tlp==NULL){ $no_tlp='-';}else{$no_tlp=$value->no_tlp;}
                if($value->semester==0){ $semester='-';}else{$semester=$value->semester;}
                if($value->ipk==0){ $ipk='-';}else{$ipk=$value->ipk;}
                if($value->nilai_tes==0){ $nilai_tes='-';}else{$nilai_tes=$value->nilai_tes;}
                // if($value->file_krs==NULL){ $file_krs='-';}else{$file_krs=$value->file_krs;}
                if($value->task_complated==0){ $task_complated='-';}else{$task_complated=$value->task_complated;}
                // if($value->updatedate=="0000-00-00 00:00:00" || $value->updatedate==NULL){ $updatedate='-';}else{$updatedate=$value->updatedate;}
                $index = NULL;

                if($value->reqruitment == "1"){
                    $reqruitment = '<span class="badge badge-success">Yes</span>';
                }elseif ($value->reqruitment == "0") {
                    $reqruitment = '<span class="badge badge-secondary">No</span>';
                }else{
                    $reqruitment = '-';
                }         

                if($value->file_krs != NULL){
                    $file_krs = "<div class=\"file-img-box\">
                                    <img src=\"assets/images/file_icons/pdf.svg\" id=\"tooltip-hover\" alt=\"icon\" style=\"height: 25px;\" title=\"$value->file_krs\">
                                    <a href=\"#\" class=\"file-download\"><i class=\"mdi mdi-download\"></i> </a>
                                </div>";
                }else{
                    $file_krs = '-';
                }
                

                if($value->status == "1"){
                    $status = '<span class="badge badge-success">Active</span>';
                }elseif ($value->status == "0") {
                    $status = '<span class="badge badge-secondary">Inactive</span>';
                }else{
                    $status = '-';
                }
                $iteration = 0;
                $no = 1;
                $rec['aaData'][$k] = array(
                    $iteration => 't|no||'.$no,
                    $iteration+=1 => 't|nama||'.$nama,
                    $iteration+=1 => 't|email||'.$email,
                    $iteration+=1 => 't|alamat||'.$alamat,
                    $iteration+=1 => 't|no_tlp||'.$no_tlp,
                    $iteration+=1 => 't|task_job||'.$semester,
                    $iteration+=1 => 't|email||'.$ipk,
                    $iteration+=1 => 't|alamat||'.$nilai_tes,
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

    public function test_nilai()
    {
        $bobot_ipk = $this->bobot_ipk(3.55);
        $bobot_ipk = $bobot_ipk*0.3;
        $bobot_semester = $this->bobot_semester(5);
        $bobot_semester = $bobot_semester*0.2;
        $bobot_nilai_test = $this->bobot_nilai(6);
        $bobot_nilai_test = $bobot_nilai_test*0.5;
        echo $bobot_ipk ." bobot ipk | ". $bobot_semester ." bobot semester | ". $bobot_nilai_test ." bobot test | ";
        
        $we = $bobot_ipk + $bobot_semester + $bobot_nilai_test;
        echo " | we -> ".$we;
        exit();
    }

    public function submit_answer() {   
        $nilai = 0;
        $check_test = $this->MTestPartner->get_hasil_test($this->session->userdata('id'));
        if ($check_test->num_rows()!=0) {
            redirect('Hasil_test','refresh');
        }else{
            $list_soal = $this->MTestPartner->get_data_soal_test()->result();
            $kunci = array();
            foreach ($list_soal as $val) {
                array_push($kunci, $val->kunci);
            }
            $j=0;
            for ($i=1; $i <= count($kunci) ; $i++) {
                if ($this->input->post("soal_".$i)==$kunci[$j]) {
                    $nilai++;
                }
                $j++;
            }
            $data = array(
                "id_user" => $this->session->userdata('id'),
                "nilai" => $nilai*3.33,
                "createdtime" => date("Y-m-d h:i:sa"),
                "createdby" => $this->session->userdata('user_name')
            );

            $id_nilai_test = $this->MTestPartner->create_data_nilai_test($data);
            
            $data_partner = $this->MTestPartner->get_ipk($this->session->userdata('id'))->result();

            foreach ($data_partner as $value) {
                $ipk = $value->ipk;
                $semester = $value->semester;

            }

            // $bobot_ipk = $this->bobot_ipk($ipk);
            // $bobot_semester = $this->bobot_semester($semester);
            // $bobot_nilai_test = $this->bobot_nilai($nilai);

            $bobot_ipk = $this->bobot_ipk($ipk);
            $bobot_ipk = $bobot_ipk*0.3;
            $bobot_semester = $this->bobot_semester($semester);
            $bobot_semester = $bobot_semester*0.2;
            $bobot_nilai_test = $this->bobot_nilai($nilai);
            $bobot_nilai_test = $bobot_nilai_test*0.5;
            
            $we = $bobot_ipk + $bobot_semester + $bobot_nilai_test;

            $data_we = array(
                "id_user" => $this->session->userdata('id'),
                "we" => $we
            );
            $id_we = $this->MTestPartner->create_data_we($data_we);
            redirect('Hasil_test','refresh');
        }
        
    }

    public function bobot_ipk($ipk){
        if ($ipk>=1 && $ipk <= 1.99) {
            return $bobot_ipk = 0.1;
        }elseif ($ipk>=2 && $ipk <= 2.99) {
            return $bobot_ipk = 0.2;
        }elseif ($ipk>=3 && $ipk <= 3.49) {
            return $bobot_ipk = 0.3;
        }elseif ($ipk>=3.5 && $ipk <= 4) {
            return $bobot_ipk = 0.4;
        }
    }

    public function bobot_semester($niliai){
        if ($niliai>=1 && $niliai <= 2) {
            return $bobot_niliai = 0.1;
        }elseif ($niliai>=3 && $niliai <= 4) {
            return $bobot_niliai = 0.2;
        }elseif ($niliai>=5 && $niliai <= 6) {
            return $bobot_niliai = 0.3;
        }elseif ($niliai>=7) {
            return $bobot_niliai = 0.4;
        }
    }

    public function bobot_nilai($niliai){
        if ($niliai>=1 && $niliai <= 9) {
            return $bobot_niliai = 0.1;
        }elseif ($niliai>=10 && $niliai <= 14) {
            return $bobot_niliai = 0.2;
        }elseif ($niliai>=15 && $niliai <= 19) {
            return $bobot_niliai = 0.3;
        }elseif ($niliai>=20 && $niliai <= 24) {
            return $bobot_niliai = 0.4;
        }elseif ($niliai>=25 && $niliai <= 30) {
            return $bobot_niliai = 0.5;
        }
    }
}
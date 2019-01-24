<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	 public function __construct() {
        Parent::__construct();
        $this->load->model('MDashboard');

        if($this->session->userdata('id') == "" || $can == false){
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

		$this->load->view("excel_export_view.php", array());
	}

	function demo()
	{
		$this->load->view("dashboard.php");
	}

	function get_data_employee()
	{
	    $employee = $this->excel_export_model->get_employee();;

	    $data = array();
	    foreach($employee->result() as $row) {
	        $data['data'][] = array(
	        	'id' => $row->id, 
                'name' => $row->name,
                'address' => $row->address,
                'age' => $row->age,
                'birthday' => $this->dateTimeFormat($row->birthday),
                'phone' => $row->phone,
                'hoby' => $row->hoby,
                'gender' => $row->gender,
                'religion' => $row->religion,
                'status' => $row->status,
                'nik' => $row->nik,
                'blood_type' => $row->blood_type,
                'region' => $row->region,
                'city' => $row->city,
                'mother' => $row->mother,
                'father' => $row->father
	        );
	    }

	    echo json_encode($data);
	    exit();
	}

	function get_single_data_employee()
	{
		$id = $_POST['employee'];
	    $employee = $this->excel_export_model->get_single_employee($id);;
	    // echo var_dump($employee[0]->id);
	    // echo $employee[0]->birthday;

    	$id = $employee[0]->id;
        $name = $employee[0]->name;
        $address = $employee[0]->address;
        $age = $employee[0]->age;
        $birthday = $this->dateTimeFormat($employee[0]->birthday);
        $phone = $employee[0]->phone;
        $hoby = $employee[0]->hoby;
        $gender = $employee[0]->gender;
        $religion = $employee[0]->religion;
        $status = $employee[0]->status;
        $nik = $employee[0]->nik;
        $blood_type = $employee[0]->blood_type;
        $region = $employee[0]->region;
        $city = $employee[0]->city;
        $mother = $employee[0]->mother;
        $father = $employee[0]->father;

	    echo "<div id='detail-content'>     
	    		<div class='form-group col-md-12'>                               
	            	<label>Enter Your Name</label>  
	            	<input type='text' name='name' id='name' class='form-control' value='$name' required/> 
	            </div>
            	<div class='form-row'>
				    <div class='form-group col-md-6'>
				      <label for='age'>Select Your Age</label>
				      <input type='number' class='form-control' name='age' id='age' value='$age' required/>
				    </div>
				    <div class='form-group col-md-6'>
				      <label for='birthday'>Select Your Birthday</label>
				      <input type='date' class='form-control' name='birthday' id='birthday' value='$birthday' required></input>
				    </div>
				</div>
				<div class='form-group col-md-12'>
	            	<label>Enter Your Address</label>
	            	<textarea class='form-control' name='address' id='address' rows='3' required>$address</textarea>
	            </div>
	            <div class='form-group col-md-12'>                               
	            	<label>Enter Your Hoby</label>  
	            	<input type='text' name='hoby' id='hoby' class='form-control' value='$hoby' required/> 
	            </div>
	            <div class='form-group col-md-12'>                               
	            	<label>Enter Your Phone Number</label>  
	            	<input type='number' name='phone' id='phone' class='form-control' value='$phone' required/> 
	            </div>
	            <div class='form-group col-md-12'>                               
	            	<label>Select Your Gender</label>  
	            	<select class='form-control' id='gender'>
						
				     	<option value='male'>Male</option>
				     	<option value='female'>Female</option>   
				    </select>
	            </div>
	            <div class='form-group col-md-12'>                               
	            	<label>Enter Your Religion</label>  
	            	<input type='text' name='religion' id='religion' class='form-control' value='$religion' required/> 
	            </div>
	            <div class='form-group col-md-12'>                               
	            	<label>Select Your Status</label>  
	            	<select class='form-control' id='status'>
				      <option value='maried'>Maried</option>
				      <option value='single'>Single</option>   
				    </select>
	            </div>
	            <div class='form-group col-md-12'>                               
	            	<label>Enter Your NIK</label>  
	            	<input type='number' name='nik' id='nik' class='form-control' value='$nik' required/> 
	            </div>
	            <div class='form-group col-md-12'>                               
	            	<label>Select Your Blood Type</label>  
	            	<select class='form-control' id='blood-type'>
				      <option value='a'>A</option>
				      <option value='b'>B</option>
				      <option value='ab'>AB</option>
				      <option value='o'>O</option>   
				    </select> 
	            </div>
	            <div class='form-group col-md-12'>                               
	            	<label>Enter Your Region</label>  
	            	<input type='text' name='region' id='region' class='form-control' value='$region' required/> 
	            </div>
	            <div class='form-group col-md-12'>                               
	            	<label>Enter Your City</label>  
	            	<input type='text' name='city' id='city' class='form-control' value='$city' required/> 
	            </div>
	            <div class='form-group col-md-12'>                               
	            	<label>Enter Your Mother</label>  
	            	<input type='text' name='mother' id='mother' class='form-control' value='$mother' required/> 
	            </div>
	            <div class='form-group col-md-12'>                               
	            	<label>Enter Your Father</label>  
	            	<input type='text' name='father' id='father' class='form-control' value='$father' required/> 
	            </div>

	            <input type='hidden' name='id_employee_edit' id='id_employee_edit' class='form-control' value='$id' /> 
        	</div>";

        	//
	    exit();
	}

	function form_employee()
	{
	    echo "<div id='detail-content'>     
	    		<div class='form-group col-md-12'>                               
	            	<label>Enter Your Name</label>  
	            	<input type='text' name='add-name' id='add-name' class='form-control' value='' required/> 
	            </div>
            	<div class='form-row'>
				    <div class='form-group col-md-6'>
				      <label for='age'>Select Your Age</label>
				      <input type='number' class='form-control' name='add-age' id='add-age' value='' required/>
				    </div>
				    <div class='form-group col-md-6'>
				      <label for='birthday'>Select Your Birthday</label>
				      <input type='date' class='form-control' name='add-birthday' id='add-birthday' value='' required></input>
				    </div>
				</div>
				<div class='form-group col-md-12'>
	            	<label>Enter Your Address</label>
	            	<textarea class='form-control' name='add-address' id='add-address' rows='3' required></textarea>
	            </div>
	            <div class='form-group col-md-12'>                               
	            	<label>Enter Your Hoby</label>  
	            	<input type='text' name='add-hoby' id='add-hoby' class='form-control' value='' required/> 
	            </div>
	            <div class='form-group col-md-12'>                               
	            	<label>Enter Your Phone Number</label>  
	            	<input type='number' name='add-phone' id='add-phone' class='form-control' value='' required/> 
	            </div>
	            <div class='form-group col-md-12'>                               
	            	<label>Select Your Gender</label>  
	            	<select class='form-control' id='add-gender'>
				      <option value='male'>Male</option>
				      <option value='female'>Female</option>   
				    </select>
	            </div>
	            <div class='form-group col-md-12'>                               
	            	<label>Enter Your Religion</label>  
	            	<input type='text' name='add-religion' id='add-religion' class='form-control' value='' required/> 
	            </div>
	            <div class='form-group col-md-12'>                               
	            	<label>Select Your Status</label>  
	            	<select class='form-control' id='add-status'>
				      <option value='maried'>Maried</option>
				      <option value='single'>Single</option>   
				    </select>
	            </div>
	            <div class='form-group col-md-12'>                               
	            	<label>Enter Your NIK</label>  
	            	<input type='number' name='add-nik' id='add-nik' class='form-control' value='' required/> 
	            </div>
	            <div class='form-group col-md-12'>                               
	            	<label>Select Your Blood Type</label>  
	            	<select class='form-control' id='add-blood-type'>
				      <option value='a'>A</option>
				      <option value='b'>B</option>
				      <option value='ab'>AB</option>
				      <option value='o'>O</option>   
				    </select> 
	            </div>
	            <div class='form-group col-md-12'>                               
	            	<label>Enter Your Region</label>  
	            	<input type='text' name='add-region' id='add-region' class='form-control' value='' required/> 
	            </div>
	            <div class='form-group col-md-12'>                               
	            	<label>Enter Your City</label>  
	            	<input type='text' name='add-city' id='add-city' class='form-control' value='' required/> 
	            </div>
	            <div class='form-group col-md-12'>                               
	            	<label>Enter Your Mother</label>  
	            	<input type='text' name='add-mother' id='add-mother' class='form-control' value='' required/> 
	            </div>
	            <div class='form-group col-md-12'>                               
	            	<label>Enter Your Father</label>  
	            	<input type='text' name='add-father' id='add-father' class='form-control' value='' required/> 
	            </div>
        	</div>";
	    exit();
	}

	function form_email()
	{
	    echo "<div id='detail-content'>     
	    		<div class='form-group col-md-12'>                               
	            	<label>Enter Your Name</label>  
	            	<input type='text' name='email-name' id='email-name' class='form-control' value='' required/> 
	            </div>
	            <div class='form-group col-md-12'>                               
	            	<label>Enter Email Address</label>  
	            	<input type='email' name='email-email' id='email-email' class='form-control' value='' required/> 
	            </div>
				<div class='form-group col-md-12'>                               
	            	<label>Enter Subject</label>  
	            	<input type='text' name='email-subject' id='email-subject' class='form-control' value='' required/> 
	            </div>
	            <div class='form-group col-md-12'>
	            	<label>Enter Text Email</label>
	            	<textarea class='form-control' name='email-text' id='email-text' rows='3' required></textarea>
	            </div>
	            
        	</div>";
	    exit();
	}

	function send_email(){
		$subject = $this->input->post("subject");
		$email = $this->input->post("email");
		$file_data = base_url().'cache-data/Employee-Data.xls';

		if($file_data)
	  	{
			$message = '
			   <h3 align="center">Programmer Details</h3>
			    <table border="1" width="100%" cellpadding="5">
			     <tr>
			      <td width="30%">Name</td>
			      <td width="70%">'.$this->input->post("name").'</td>
			     </tr>
			     <tr>
			      <td width="30%">Additional Information</td>
			      <td width="70%">'.$this->input->post("text-email").'</td>
			     </tr>
			    </table>
			   ';

		    $config = Array(
		        'protocol'  => 'smtp',
		        'smtp_host' => 'ssl://smtp.googlemail.com',
		        'smtp_port' => 465,
		        'smtp_user' => 'test@gmail.com', 
		        'smtp_pass' => 'ltfabdl', 
		        'mailtype'  => 'html',
		        'charset'  => 'iso-8859-1',
		        'wordwrap'  => TRUE
		    );

		    $this->load->library('email', $config);
		    $this->email->set_newline("\r\n");
		    $this->email->from($this->input->post("email"));
		    $this->email->to('ahmadsyari001@gmail.com');
		    $this->email->subject($subject);
		    $this->email->message($message);
		    $this->email->attach(base_url().'cache-data/Employee-Data.xls');
		        if($this->email->send())
		        {
		          // if(delete_files($file_data['file_path']))
		          // {
		        	$this->session->set_flashdata('message', 'Application Sended');
		        	redirect('');
		          // }
		        }else
		        {
		          // if(delete_files($file_data['file_path']))
		          // {
		        	$this->session->set_flashdata('message', 'There is an error in email send');
		        	redirect('');
		          // }
		        }
	    }else{
	    	$this->session->set_flashdata('message', 'There is an error in attach file');
	        redirect('');
	    }
	}

	function generate_file(){

		$config['upload_path'] = 'uploads/';
		$config['allowed_types'] = 'xls|xlsx';
		$this->load->library('upload', $config);
		if($this->upload->do_upload('resume'))
		{
			return $this->upload->data();   
		}else{
			return $this->upload->display_errors();
		}
	}

	function add_employee()
	{
		// var_dump($_POST);
		$name = $_POST['name'];
		$address = $_POST['address'];
		$age = $_POST['age'];
		$birthday = $_POST['birthday'];
		$phone = $_POST['phone'];
		$hoby = $_POST['hoby'];
		$gender = $_POST['gender'];
		$religion = $_POST['religion'];
		$status = $_POST['status'];
		$nik = $_POST['nik'];
		$blood_type = $_POST['blood_type'];
		$region = $_POST['region'];
		$city = $_POST['city'];
		$mother = $_POST['mother'];
		$father = $_POST['father'];

		$data[] = array(
			// 'id' => $column_id,
            'name' => $name,
            'address' => $address,
            'age' => $age,
            'birthday' => $birthday,
            'hoby' => $hoby,
            'phone' => $phone,
            'gender' => $gender,
            'religion' => $religion,
            'status' => $status,
            'nik' => $nik,
            'blood_type' => $blood_type,
            'region' => $region,
            'city' => $city,
            'mother' => $mother,
            'father' => $father
            
		);
		$this->excel_export_model->add_employee($data);
		// echo json_encode($data);
	}

	function update_column()
	{
		// var_dump($_POST);
		$column_name = $_POST['name'];
		$data = array(
			'column' => $column_name,
			'value' => $_POST['value'],
			'pk' => $_POST['pk']
		);
		$this->excel_export_model->update_column($data);
		// echo json_encode($data);
	}

	function delete_single_data_employee()
	{
		var_dump($_POST);
		$id_employee = $_POST['employee'];
		echo "<div id='detail-content'>     
	
				<div id='detail-content'>                                      
	            	<h3>Are you sure?</h3>
	        	</div>
	            <input type='hidden' name='id_delete_employee' id='id_delete_employee' class='form-control' value='$id_employee' /> 
        	</div>";
	}

	function delete_employee()
	{
		// var_dump($_POST);
		$id_employee = $_POST['employee'];
		$this->excel_export_model->delete_column($id_employee);
		// echo json_encode($data);
	}

	function update_employee()
	{
		// var_dump($_POST);
		$column_id = $_POST['employee'];
		$name = $_POST['name'];
		$address = $_POST['address'];
		$age = $_POST['age'];
		$birthday = $_POST['birthday'];
		$phone = $_POST['phone'];
		$hoby = $_POST['hoby'];
		$gender = $_POST['gender'];
		$religion = $_POST['religion'];
		$status = $_POST['status'];
		$nik = $_POST['nik'];
		$blood_type = $_POST['blood_type'];
		$region = $_POST['region'];
		$city = $_POST['city'];
		$mother = $_POST['mother'];
		$father = $_POST['father'];

		$data = array(
			// 'id' => $column_id,
            'name' => $name,
            'address' => $address,
            'age' => $age,
            'birthday' => $birthday,
            'hoby' => $hoby,
            'phone' => $phone,
            'gender' => $gender,
            'religion' => $religion,
            'status' => $status,
            'nik' => $nik,
            'blood_type' => $blood_type,
            'region' => $region,
            'city' => $city,
            'mother' => $mother,
            'father' => $father
            
		);
		$this->excel_export_model->update_employee($column_id, $data);
		// echo json_encode($data);
	}

	function action()
	{
		$this->load->model("excel_export_model");
		$this->load->library("excel");
		$object = new PHPExcel();

		$object->setActiveSheetIndex(0);

		$table_columns = array("No","Name", "Address", "Age", "Birthday", "Hoby", "Phone", "Gender", "Religion", "Status", "NIK", "Blood Type", "Region", "City", "Mother", "Father");

		$column = 0;

		foreach($table_columns as $field)
		{
			$object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
			$column++;
		}

		$employee_data = $this->excel_export_model->fetch_data();

		$excel_row = 2;
		$i=1;
		foreach($employee_data as $row)
		{
			// $name = $row->firstname.$row->lastname;
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $i);
			$object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->name);
			$object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->address);
			$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->age);
			$object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->birthday);
			$object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->hoby);
			$object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->phone);
			$object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row->gender);
			$object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row->religion);
			$object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row->status);
			$object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $row->nik);
			$object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $row->blood_type);
			$object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $row->region);
			$object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, $row->city);
			$object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, $row->mother);
			$object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row, $row->father);
			$excel_row++;
			$i++;
		}

		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		// $object_writer->save(ROOT_UPLOAD_IMPORT_PATH.'Employee-Data.xls');
		// header("location: " . base_url() . "cache-data/Employee-Data.xls");
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Employee-Data.xls"');
		$object_writer->save('php://output');
	}

	
	
}

















































	
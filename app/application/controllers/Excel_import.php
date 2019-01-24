<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Excel_import extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('excel_import_model');
		$this->load->library('excel');
	}
	
	function import()
	{
		if(isset($_FILES["file"]["name"]))
		{
			$path = $_FILES["file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				for($row=2; $row<=$highestRow; $row++)
				{
					$name = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$address = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$age = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$birthday = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$hoby = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$phone = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
					$gender = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
					$religion = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
					$status = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
					$nik = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
					$blood_type = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
					$region = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
					$city = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
					$mother = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
					$father = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
					
					$data[] = array(
						'name' => $name,
						'address' => $address,
						'age' => $age,
						'birthday' => $birthday,
						'hoby'=> $hoby,
						'phone' => $phone,
						'gender' => $gender,
						'religion' => $religion,
						'status' => $status,
						'nik' => $nik,
						'blood_type' => $blood_type,
						'region' => $region,
						'city' => $city,
						'mother' => $mother,
						'father' => $father,
					);
				}
			}
			$this->excel_import_model->insert($data);
			echo 'Data Imported successfully';
		}	
	}
}

?>
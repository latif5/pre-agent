<?php
class MDashboard extends CI_Model
{
	public function __construct(){
		$this->load->database();
	}

	function fetch_data()
	{
		$this->db->order_by("id", "DESC");
		$query = $this->db->get("employee");
		return $query->result();
	}

	function get_employee()
	{
		$this->db->order_by("id", "DESC");
		return $this->db->get("employee");
		// $result = json_encode($query->result());
		// return $result;
	}

	function get_single_employee($id)
	{
		$this->db->where("id", $id);
		// echo "id->".$id;
		$query =  $this->db->get("employee");
		// $result = json_encode($query->result());
		return $query->result();
	}

	function add_employee($data)
	{
		$this->db->insert_batch('employee', $data);
	}

	function update_column($data)
	{
		
		$column_name = $data['column'];
		$column_value = $data['value'];
		$column_pk = $data['pk'];
		$this->db->query("UPDATE `employee` SET `$column_name`='$column_value' WHERE (`id`='$column_pk')");
	}

	function update_employee($id,$data)
	{
		// $column_id = $data['id'];
		$this->db->where("id", $id); 
        $this->db->update("employee", $data);  
		// echo json_encode($this->db->get("employee"));
	}

	function delete_column($data)
	{
		$this->db->where("id", $data); 
        $this->db->delete("employee");  
		
	}

	
}

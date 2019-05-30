<?php

class LED_model extends CI_Model {

	function fetchMemberData($id = null) 
	{
		if($id) {
			$sql = "SELECT * FROM led WHERE ID = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM led order by ID DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	function get_CCT_option()
	{
		$this->db->order_by("value","asc");
		$this->db->select("*");
		$this->db->from('cct_option');
		$query=$this->db->get();
		return $query->result_array();
	}

	public function insert($data)
	{
		$insert=$this->db->insert('led',$data);

   		return  $insert;
	}

	function update($data, $id)
	{
		$this->db->where('ID', $id);
		$sql = $this->db->update('led', $data);

		return $sql;
	}

	function get_by_code($code){
		$this->db->select("*");
	 	$this->db->where('Code ',$code);
		$this->db->from("led");
		$query=$this->db->get();
		return $query->result_array();
	}

	function get_led_basic_info()
	{
		$this->db->select("ID,Code");
		$this->db->from("led");
		$query=$this->db->get();
		return $query->result_array();
	}

	 function get_LED_by_ids($id_array)
	 {
	 	$this->db->select("*");
	 	$this->db->where_in('led.ID ',$id_array);
	 	$this->db->from("led");
	 	$query=$this->db->get();
		return $query->result_array();
	 }

	function get_led_supplier_id($id)
	{
		$this->db->select("SupplierID");
	 	$this->db->where('ID ',$id);
		$this->db->from("led");
		$result=$this->db->get();
		$ret = $result->row();
	 	return $ret->SupplierID;
	}
}
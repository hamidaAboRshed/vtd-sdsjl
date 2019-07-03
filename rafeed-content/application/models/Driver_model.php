<?php

class Driver_model extends CI_Model {

	public function insert($data)
	{
		$insert= $this->db->insert('driver',$data);
		$insert_id = $this->db->insert_id();
   		return  $insert_id;
	}
	function update($data, $id)
	{
		$this->db->where('ID', $id);
		$sql = $this->db->update('driver', $data);

		return $sql;
	}

	public function insert_driver_accessory($data)
	{
		return $this->db->insert('driver_accessory',$data);
	}

	public function insert_driver_dimmable($data)
	{
		return $this->db->insert('driver_dimmable',$data);
	}
	public function remove_driver_dimmable($driver_id)
	{
		$this->db->where('DriverID', $driver_id);
		return $this->db->delete('driver_dimmable');
	}

	public function insert_cost($data)
	{
		return $this->db->insert('driver_cost',$data);
	}

	public function get_accessory()
	{
		$query = $this->db->query('SELECT Name, Accessory_id as ID FROM accessory_language ,accessory where 
			accessory.ID=accessory_language.Accessory_id and Type=3');

		return $query->result_array();
	}

	 function get_by_code($code)
	 {
	 	$this->db->select("*");
	 	$this->db->where('code ',$code);
		$this->db->from("driver");
		$query=$this->db->get();
		return $query->result_array();
	 }

	 function get_by_id($id)
	 {
	 	//to get last cost
	 	$this->db->select("*");
	 	$this->db->where('driver.ID ',$id);
		$this->db->from("driver");
	 	$query=$this->db->get();
	 	return $query->row_array();
	 }

	 function get_driver_supplier_id($id)
	 {
	 	$this->db->select("SupplierID");
	 	$this->db->where('ID ',$id);
		$this->db->from("driver");
		$result=$this->db->get();
		$ret = $result->row();
	 	return $ret->SupplierID;
		/*$id = (int) $result->result();
		return $id;*/
	 }

	 function get_driver_basic_info()
	{
		$this->db->select("ID,code");
		$this->db->from("driver");
		$query=$this->db->get();
		return $query->result_array();
	}

	function fetchMemberData($id = null) 
	{
		if($id) {
			$sql = "SELECT * FROM driver WHERE ID = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM driver order by ID DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	function get_driver_dimmable($driver_id)
	{
		if($driver_id)
		{
			$this->db->select("DimmableTypeID");
			$this->db->where('DriverID',$driver_id);
			$this->db->from('driver_dimmable');
			$query=$this->db->get();
			return $query->result_array();
		}
		return null;
	}
}
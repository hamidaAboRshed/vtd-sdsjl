<?php

class Accessory_model extends CI_Model {

	public function insert($data)
	{
		$insert= $this->db->insert('accessory',$data);
		$insert_id = $this->db->insert_id();
   		return  $insert_id;
	}

	function get_accessory_count (){
		$sql = "SELECT count(*) as serial FROM accessory";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	public function insert_accessory_language($data)
	{
		$insert= $this->db->insert('accessory_language',$data);
   		return  $insert;
	}
	public function insert_accessory_image($data)
	{
		$insert= $this->db->insert('accessory_image',$data);
   		return  $insert;
	}

	function get_accessory_image_by_id($id)
	{
		$this->db->select("*");
	 	$this->db->where('accessory_id',$id);
		$this->db->from("accessory_image");
		$result=$this->db->get();
		return $result->result_array();
	}
	
	function update($data, $id)
	{
		$this->db->where('ID', $id);
		$sql = $this->db->update('accessory', $data);

		return $sql;
	}

	function delete_image($id)
	{
		$result = $this->db->query("delete  from accessory_image where accessory_id='".$id."'");
   		return  $result;
	}

	public function update_accessory_language($data,$id,$Language_id)
	{
		$this->db->where('Accessory_id', $id);
		$this->db->where('Language_id', $Language_id);
		$sql= $this->db->update('accessory_language',$data);
   		return  $sql;
	}

	public function insert_cost($data)
	{
		return $this->db->insert('accessory_cost',$data);
	}
	
	function get_by_id($id)
	 {
	 	$this->db->select("*");
	 	$this->db->where('Accessory.ID ',$id);
		$this->db->from("accessory_cost");
	 	$this->db->join('accessory_cost', 'accessory.ID = accessory_cost.accessory_id', 'left');
	 	$this->db->join('supplier_contact', 'accessory_cost.supplier_contact_id = supplier_contact.ID', 'left');
	 	$this->db->order_by('offer_date', 'DESC');
	 	$query=$this->db->get();
	 	$ret = $query->row();
		return $ret;
	 }

	 function get_accessory_supplier_id($id)
	{
		$this->db->select("SupplierID");
	 	$this->db->where('ID ',$id);
		$this->db->from("accessory");
		$result=$this->db->get();
		$ret = $result->row();
	 	return $ret->SupplierID;
	}

	function get_accessory_by_premium_dimension_id($dim_id)
	{
		$this->load->model('Index_model');
		$default_lan=$this->Index_model->get_default_language();
		$this->db->select("accessory.*, accessory_language.*");
		$this->db->from('premium_product_family_dimension_accessory');
		$this->db->join('accessory', 'accessory.ID = premium_product_family_dimension_accessory.accessory_id', 'left');
	 	$this->db->join('accessory_language', 'accessory.ID = accessory_language.Accessory_id', 'left');
		$this->db->where('premium_product_family_dimension_id',$dim_id);
		$this->db->where('accessory_language.Language_id',$default_lan);
		$this->db->order_by("Code", 'AESC');
		$result=$this->db->get();
		return $result->result_array();
	}

	function fetchMemberData($id = null) 
	{
		$this->load->model('Index_model');
		$default_lan=$this->Index_model->get_default_language();
		if($id) {
			$sql = "SELECT DISTINCT accessory.* FROM accessory INNER JOIN accessory_language ON accessory.ID=accessory_language.Accessory_id WHERE accessory.ID = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT DISTINCT accessory.* FROM accessory INNER JOIN accessory_language ON accessory.ID=accessory_language.Accessory_id order by accessory.ID DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	function fetchLanguageData($id=null)
	{
		if($id) {
			$sql = "SELECT Name FROM accessory_language WHERE Accessory_id = ".$id." order by Language_id";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
	}

	function get_accessory_by_type_supplier($type,$supplier)
	{
		$this->load->model('Index_model');
		$default_lan=$this->Index_model->get_default_language();

		$sql = "SELECT accessory.ID ,	accessory_language.Name FROM accessory INNER JOIN accessory_language ON accessory.ID=accessory_language.Accessory_id  WHERE Language_id=".$default_lan." and Type=".$type. " and SupplierID=".$supplier;
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	function get_accessory_by_type($type)
	{
		$this->load->model('Index_model');
		$default_lan=$this->Index_model->get_default_language();

		$sql = "SELECT accessory.ID ,	accessory_language.Name FROM accessory INNER JOIN accessory_language ON accessory.ID=accessory_language.Accessory_id  WHERE Language_id=".$default_lan." and Type=".$type;
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	function get_rail_accessory($wires)
	{
		$this->db->select("rail_installation_way, rail_length, Code, Series_id");
		$this->db->from('accessory');
		$this->db->where('is_trak_rail',1);
		$this->db->where('rail_wires',$wires);
		$this->db->order_by("Code", 'AESC');
		
		$result = $this->db->get();
		return $result->result_array();
	}
}
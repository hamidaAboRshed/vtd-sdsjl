<?php

class Accessory_model extends CI_Model {

	function insert($data)
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

	function insert_accessory_language($data)
	{
		$insert= $this->db->insert('accessory_language',$data);
   		return  $insert;
	}
	function insert_accessory_image($data)
	{
		$insert= $this->db->insert('accessory_image',$data);
   		return  $insert;
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

	function update_accessory_language($data,$id,$Language_id)
	{
		$this->db->where('Accessory_id', $id);
		$this->db->where('Language_id', $Language_id);
		$sql= $this->db->update('accessory_language',$data);
   		return  $sql;
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

	function get_accessory_by_dim_id($dim_id)
	{
		$this->db->select('Fitting_accessory_id');
		$this->db->from('premium_product_collection');
		$this->db->where('premium_product_family_dimension_id',$dim_id);
		$result=$this->db->get();
		return $result->result();
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
}
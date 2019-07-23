<?php

class Economic_product_model extends CI_Model {

	function fetchMemberData($id = null) 
	{
		$this->load->model('Index_model');
		$default_lan=$this->Index_model->get_default_language();
		if($id) {
			$sql = "SELECT DISTINCT Product.*,economic_product.*,economic_product_language.* FROM product INNER JOIN economic_product ON product.ID=economic_product.ProductId LEFT JOIN economic_product_language on economic_product.ID= economic_product_language.economic_product_id WHERE economic_product_language.Language_id=".$default_lan." and product.ID = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT DISTINCT Product.*,economic_product.*,economic_product_language.* FROM product INNER JOIN economic_product ON product.ID=economic_product.ProductId LEFT JOIN economic_product_language on economic_product.ID= economic_product_language.economic_product_id where economic_product_language.Language_id=".$default_lan." order by product.ID DESC";
		$query = $this->db->query($sql);
		
		return $query->result_array();
	}

	function get_product_id_by_economic_id($economic_id)
	{
		$this->db->select('ProductId');
		$this->db->where('ID',$economic_id);
		$this->db->from("economic_product");
		$result=$this->db->get();
		$data=$result->result();
		$id='';
		foreach ($data as $row)
		{
			$id=$row->ProductId;
		}
		return $id;
	}

	function get_collection_by_economic_id($economic_id)
	{
		$this->db->select('*');
   		$this->db->where('economic_product_id ',$economic_id);
		$this->db->from("economic_product_collection");
		$this->db->order_by("ID", "DESC");
		$result=$this->db->get();
		return $result->result_array();
	}

	function get_collection_id_by_column($column,$value)
	{
		$this->db->select('ID');
		$this->db->where($column,$value);
		$this->db->from('economic_product_collection');
		$result=$this->db->get();
		$id = (int) $result->result();
		return $id;
	}

	function get_economic_coding_data($economic_id)
	{
		$this->db->select('economic_product_collection.ID as ID,family_shortcut_code, CCT');
		$this->db->from("economic_product");
		$this->db->join('economic_product_collection', 'economic_product_id = economic_product.ID', 'inner');
		$this->db->where('economic_product.ID',$economic_id);
		$result=$this->db->get();
		return $result->result_array();
	}
	
}
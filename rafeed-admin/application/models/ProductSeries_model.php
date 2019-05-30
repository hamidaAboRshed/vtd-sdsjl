<?php

class ProductSeries_model extends CI_Model {

	function insert_data($data){
		$this->db->insert('product_series',$data);
	}

	public function fetch_date(){
		$this->db->select('*');
		$this->db->from('product_series');
		$query=$this->db->get();
		return $query->result();
	}

	function get_premium_id()
	{
		$this->db->select("product_series_id");
		$this->db->where("Name","Premium");
		$this->db->from("product_series_language");
		$result=$this->db->get();
		$id = (int) $result->result();
		return $id;
	}

	function get_series_str($id='')
	{	
		if ($id) {
			$this->db->select("Code_str");
			$this->db->where("ID",$id);
			$this->db->from("product_series");
			$result=$this->db->get();
			foreach ($result->result_array() as $row) {
				$str=$row['Code_str'];
			}
		}
		else {
			$str="RFA";
		}
		
		return $str;
	}
}
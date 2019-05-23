<?php

class ProductSeries_model extends CI_Model {

	public function fetch_date(){
		$this->db->cache_on();
		$this->db->select('*');
		$this->db->from('series');
		$this->db->order_by('display_order');
		$query=$this->db->get();
		$this->db->cache_off();

		return $query->result_array();
	}


	function get_series_category($series_id)
	{
		$this->db->select("*");
		$this->db->where("series_id",$series_id);
		$this->db->where("is_deleted",0);
		$this->db->from("category");
		$result=$this->db->get();
		return $result->result_array();
	}
}
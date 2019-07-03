<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Custom_query_model extends grocery_CRUD_model {
 
	private  $query_str = ''; 
	function __construct() {
		parent::__construct();
	}
 
	function get_list() {
		$query=$this->db->query($this->query_str);
 
		$results_array=$query->result();
		return $results_array;		
	}
 
	public function set_query_str($query_str) {
		$this->query_str = $query_str;
	}

	function get_total_results()
	{
		return $this->db->query($this->query_str)->num_rows();	
	}

	function order_by($order_by , $direction) {
		$this->set_query_str($this->query_str . " ORDER BY " . $order_by . " " . $direction);
	}
}
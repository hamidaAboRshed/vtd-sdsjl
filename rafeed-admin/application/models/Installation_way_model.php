<?php

class Installation_way_model extends CI_Model {

	public function get_premium_installation_way($installation_way_id,$accessory_id)
	{
		$this->db->select("ID");
	 	$this->db->where('installation_way_id',$installation_way_id);
	 	$this->db->where('accessory_id',$accessory_id);
		$this->db->from("premium_installation_way");
		$result=$this->db->get();
		$ret = $result->row();
		if($ret)
			return $ret->ID;
	 	return 0;
	}

	function insert_premium_installation_way($data)
	{
		$this->db->insert('premium_installation_way',$data);
		$insert_id = $this->db->insert_id();
   		return  $insert_id;
	}

	function get_installation_way_by_dim_id($dim_id){
		$this->db->select('Fitting_installation_way_id');
		$this->db->distinct();
		$this->db->from('premium_product_collection');
		$this->db->where('premium_product_family_dimension_id',$dim_id);
		$result=$this->db->get();
		return $result->result_array();
	}

	function get_installation_way_by_id($id){
		$this->db->select('*');
		$this->db->where('ID',$id);
		$this->db->from('premium_installation_way');
		$result=$this->db->get();
		return $result->result_array();
	}
	
}
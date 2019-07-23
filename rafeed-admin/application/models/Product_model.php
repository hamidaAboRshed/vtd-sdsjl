<?php

class Product_model extends CI_Model {

	function get_product_by_id($id)
	{
		$this->db->select('*');
		$this->db->where('ID',$id);
		$this->db->from('product');
		$result=$this->db->get();
		return $result->row_array();
	}

	function insert($data){
		$this->db->insert('product',$data);
		$insert_id = $this->db->insert_id();
   		return  $insert_id;
	}

	function insert_product_solution($data){
		$this->db->insert('product_solution',$data);
	}

	function get_attachment_id_by_type($type){
		$this->db->select('attachment_type_id');
		$this->db->where('Name',$type);
		$this->db->from("attachment_type_language");
		$query=$this->db->get();
		$ret = $query->row();
	   return $ret->attachment_type_id;
	}

	function get_product_photo_type_attachment(){
		$this->db->select('attachment_type_id');
		$this->db->where('Name = ','Product photo');
		$this->db->from("attachment_type_language");
		$query=$this->db->get();
		$ret = $query->row();
	   return $ret->attachment_type_id;
	}

	function get_dimension_photo_type_attachment(){
		$this->db->select('attachment_type_id');
		$this->db->where('Name = ','Dimension photo');
		$this->db->from("attachment_type_language");
		$query=$this->db->get();
		$ret = $query->row();
	   return $ret->attachment_type_id;
	}

	function insert_premium_dimension_attachment($data){
		$this->db->insert('premium_dimension_attachment',$data);
	}

	function delete_premium_dimension_attachment($dim_id,$type){
		if($dim_id)
		{
			$this->db->where('premium_dimension_id', $dim_id);
			$this->db->where('AttachmentTypeID', $type);
			$delete = $this->db->delete('premium_dimension_attachment');
			return  $delete;
		}
		return null;
	}
	
	function insert_product_attachment($data)
	{
		return $this->db->insert('product_attachment',$data);
	}

	function delete_product_attachment($product_id,$type){
		if($product_id)
		{
			$this->db->where('ProductID', $product_id);
			$this->db->where('AttachmentTypeID', $type);
			$delete = $this->db->delete('product_attachment');
			return  $delete;
		}
		return null;
	}

	function insert_product_application($data)
	{
		return $this->db->insert('product_application',$data);
	}

	function insert_product_certification($data)
	{
		return $this->db->insert('product_certification',$data);
	}

	function insert_product_installation_way($data)
	{
		return $this->db->insert('product_installation_way',$data);
	}

	function delete_product_installation_way($product_id,$installation_id)
	{
		if($product_id)
		{
			$this->db->where('Product_id', $product_id);
			$this->db->where('installation_way_id', $installation_id);
			$delete = $this->db->delete('product_installation_way');
			return  $delete;
		}
		return null;
		
	}

	function insert_premium_product($data)
	{
		$this->db->insert('premium_product',$data);
		$insert_id = $this->db->insert_id();
   		return  $insert_id;
	}

	function insert_premium_product_language($data)
	{
		$this->db->insert('premium_product_language',$data);
	}

	function insert_premium_product_family_dimension($data)
	{
		$this->db->insert('premium_product_family_dimension',$data);
		$insert_id = $this->db->insert_id();
   		return  $insert_id;
	}	

	function insert_premium_product_family_dimension_accessory($data)
	{
		$this->db->insert('premium_product_family_dimension_accessory',$data);
		$insert_id = $this->db->insert_id();
   		return  $insert_id;
	}

	function insert_premium_product_collection($data)
	{
		$this->db->insert('premium_product_collection',$data);
		$insert_id = $this->db->insert_id();
   		return  $insert_id;
	}

	function insert_premium_product_collection_driver($data)
	{
		return $this->db->insert('premium_product_collection_driver',$data);
	}

	function insert_premium_product_application($data)
	{
		return $this->db->insert('product_application',$data);
	}

	function insert_premium_product_certification($data)
	{
		return $this->db->insert('product_certification',$data);
	}
	
	function get_id_by_family_name($family_name,$table)
	{
		$this->db->select('ID');
		$this->db->where('Family_name',$family_name);
		$this->db->from($table);
		$result=$this->db->get();
		$id = (int) $result->result();
		return $id;
	}

   	function get_product_solution($product_id,$language_id)
   	{
   		$this->db->select('solution_language.Name as Name');
   		$this->db->where('product_id ',$product_id);
   		$this->db->where('Language_id ',$language_id);
   		$this->db->join('solution_language', 'solution_language.solution_id = product_solution.solution_id', 'left');
		$this->db->from("product_solution");
		$result=$this->db->get();
		return $result->result_array();
   	}

   	function get_product_application($product_id,$language_id){
		$this->db->select('application_language.Name as Name');
   		$this->db->where('Product_id ',$product_id);
   		$this->db->where('Language_id ',$language_id);
   		$this->db->join('application', 'application.ID = product_application.ApplicationID', 'left');
   		$this->db->join('application_language', 'application_language.Application_id = product_application.ApplicationID', 'left');
		$this->db->from("product_application");
		$this->db->order_by("product_application.ID", "asc");
		$result=$this->db->get();
		return $result->result_array();
	}

	function get_product_certification($product_id){
		$this->db->select('certification.Name as Name');
   		$this->db->where('Product_id ',$product_id);
   		$this->db->join('certification', 'certification.ID = product_certification.CertificationID', 'left');
		$this->db->from("product_certification");
		$result=$this->db->get();
		return $result->result_array();
	}

	function get_product_attachment_byProduct_id($product_id)
	{
		if ($product_id) {
			$this->db->select('*');
	   		$this->db->where('ProductID ',$product_id);
			$this->db->from("product_attachment");
			$result=$this->db->get();
			return $result->result_array();
		}
	}

	function get_product_installation_way($product_id,$language_id)
	{
		$this->db->select('installation_way_language.Name as Name, application_photo,product_installation_way.installation_way_id as ID');
   		$this->db->where('Product_id ',$product_id);
   		$this->db->where('Language_id ',$language_id);
		$this->db->from("product_installation_way");
   		$this->db->join('installation_way_language', 'installation_way_language.Installation_way_id = product_installation_way.installation_way_id', 'left');
		$result=$this->db->get();
		return $result->result_array();
	}

	function get_collection_serial($table){
   		$this->db->select_max('serial_num');
		$this->db->from($table);
		$result=$this->db->get();
		$ret = $result->row();
	 	return $ret->serial_num;
   	}
}
<?php

class Index_model extends CI_Model {

	
	function get_index($index_name){
		$query=$this->db->get($index_name);
		return $query->result_array();
	}
	
	function get_default_language(){
		$this->db->select('ID');
		$this->db->where("isDefault = 1");
		$this->db->from('Language');
		/*$result=$this->db->get();
		//$row = $result->row();
		$id = (int) $result->result();
		return $id;*/
		return $this->db->get()->row()->ID;
	}

	function get_index_language($index_name){
		//get id for default language
		$language_id=$this->get_default_language();

		//get values for default language
		$this->db->select($index_name.'_id as ID,Name');
		$this->db->where('language_id='.$language_id);
		$this->db->from($index_name.'_language');
		$query=$this->db->get();

		return $query->result_array();
	}

   	function get_value_by_name($index_name,$index_value){
   		$this->db->select('*');
		$this->db->where("Name = '". $index_value."'");
		$this->db->from($index_name);
		$query=$this->db->get();
		return $query->result_array();
   	}

   	function get_value_by_id($index_name,$id)
   	{
   		//get id for default language
		$language_id= $this->ui_language->get_ui_language();
		$this->db->select('Name');
		if($this->db->table_exists(strtolower($index_name.'_language')))
		{
			$this->db->where('language_id='.$language_id);
			$this->db->where($index_name.'_id',$id);
			$this->db->from($index_name.'_language');
		}
		else {
			$this->db->where('ID',$id);
			$this->db->from($index_name);
		}
		//get values for default language
		
		$result=$this->db->get();
		$data=$result->result();
		$name='';
		foreach ($data as $row)
		{
			$name=$row->Name;
		}
		return $name;
   	}

   	function set_index($index_name,$data){
   		$this->db->set($data);
   		$this->db->insert($index_name);
   		$insert_id = $this->db->insert_id();
   		return  $insert_id;
   	}

   	function update_index($index_name,$data,$id){

		$this->db->where('ID', $id);
		$this->db->update($index_name, $data);

   	}

   
   	function get_subcat($id)
   	{
   		$language_id=$this->get_default_language();

		//get values for default language
		$query = $this->db->query("SELECT Product_category_id as ID,Name FROM product_category_language ,product_category WHERE Product_category_id=product_category.ID and Product_type=".$id." and language_id=".$language_id);

		return $query->result();
   	}


	function get_category_code($cat_id)
	{
		$this->db->select('Code_str');
		$this->db->where('ID',$cat_id);
		$this->db->from('product_category');
		$result=$this->db->get();
		$code = $result->result();
		return $code[0]->Code_str;
	}

	function delete_by_tablename_id($tablename, $field_name, $id)
	{
		if(!empty($id)){
			$this->db->where_in($field_name, $id);
			$delete = $this->db->delete($tablename);
			return  $delete;
		}
		return null;
	}

	function get_by_tablename_id($tablename, $field_name, $id)
	{
		if($id){
			$this->db->select('*');
			$this->db->where_in($field_name, $id);
			$this->db->from($tablename);
			$query=$this->db->get();

			return $query->result_array();
		}
		return null;
	}
}
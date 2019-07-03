<?php

class Product_model extends CI_Model {

	public function get_product($cat_id)
	{
		$this->db->select('*');
		$this->db->where('category_id',$cat_id);
		$this->db->where("is_deleted",0);
		$this->db->from('item');
		$query=$this->db->get();
		return $query->result_array();
	}

	public function get_product_by_id($product_id)
	{
		$this->db->select('*');
		$this->db->where('ID',$product_id);
		$this->db->from('item');
		$query=$this->db->get();
		return $query->result_array();
	}

	public function get_premium_product_by_id($product_id)
	{
		$language_id = $this->ui_language->get_ui_language();
		$this->db->select('product.*,premium_product.*,premium_product_language.*');
		$this->db->where('product.ID',$product_id);
		$this->db->where('Language_id',$language_id);
		$this->db->from('product');
		$this->db->join('premium_product', 'product.ID = premium_product.ProductId', 'left');
		$this->db->join('premium_product_language', 'premium_product.ID = premium_product_language.Premium_product_id', 'left');
		$query=$this->db->get();
		return $query->row_array();
	}

	public function get_product_files($dim_id)
	{
		$this->db->select('*');
		$this->db->where('dimension_id',$dim_id);
		$this->db->from('item_files');
		$query=$this->db->get();
		return $query->result_array();
	}

	public function get_product_dimension($product_id){
		$this->db->select('*');
		$this->db->where('Item_id',$product_id);
		$this->db->from('item_dimension');
		$query=$this->db->get();
		return $query->result_array();
	}

	public function get_premium_product_dimension($premium_id)
	{
		$this->db->select('*');
		$this->db->where('Premium_product_id',$premium_id);
		$this->db->from('premium_product_family_dimension');
		$query=$this->db->get();
		return $query->result_array();
	}

	public function get_product_option($dimension_id){
		$this->db->select('*');
		$this->db->where('Item_dimension_id',$dimension_id);
		$this->db->from('item_option');
		$query=$this->db->get();
		return $query->result_array();
	}

	public function get_premium_product_option($dimension_id)
	{
		$this->db->select('*');
		$this->db->where('premium_product_family_dimension_id',$dimension_id);
		$this->db->from('premium_product_collection');
		$query=$this->db->get();
		return $query->result_array();
	}

	public function get_electric_info($item_id)
	{
		$this->db->select('*');
		$this->db->where('Item_id',$item_id);
		$this->db->from('electric_spec');
		$query=$this->db->get();
		return $query->result_array();
	}

	public function get_product_feature($item_id)
	{
		$this->db->select('*');
		$this->db->where('Item_id',$item_id);
		$this->db->from('item_feature');
		$query=$this->db->get();
		return $query->result_array();
	}

	public function get_powersupply_info($item_id)
	{
		$this->db->select('*');
		$this->db->where('Item_id',$item_id);
		$this->db->from('power_supply_spec');
		$query=$this->db->get();
		return $query->result_array();
	}

	public function get_smart_static_info($item_id)
	{
		$this->db->select('*');
		$this->db->where('Item_id',$item_id);
		$this->db->from('smart_home_static_spec');
		$query=$this->db->get();
		return $query->result_array();
	}

	public function get_smart_info($item_id)
	{
		$this->db->select('*');
		$this->db->where('Item_id',$item_id);
		$this->db->from('smart_home_spec');
		$query=$this->db->get();
		return $query->result_array();
	}

	public function get_category_name_by_id($pro_id){
		$this->db->select('category_id');
		$this->db->where('ID',$pro_id);
		$this->db->from('item');
		$result=$this->db->get();
		$ret = $result->row();

	 	$this->db->select('Name');
		$this->db->where('ID',$ret->category_id);
		$this->db->from('old_category');
		$result=$this->db->get();
		$ret = $result->row();
		return $ret->Name;
	}

	public function get_series_by_Pid($pro_id)
	{
		$query = $this->db->query('SELECT series_id as ID FROM old_category ,item where 
			old_category.ID=item.category_id and item.ID='.$pro_id);
		$data=$query->result_array();
		return $data[0]['ID'];
	}
	
	public function get_series_by_category($cat_id)
	{
		$query = $this->db->query('SELECT series_id as ID FROM old_category where 
			old_category.ID='.$cat_id);
		$data=$query->result_array();
		return $data[0]['ID'];
	}

	public function get_accessory_by_catID($cat_id)
	{
		$this->db->select('*');
		$this->db->where('category_id',$cat_id);
		$this->db->from('old_accessory');
		$query=$this->db->get();
		return $query->result_array();
	}

	public function get_accessory_by_proID($pro_id,$cat_id)
	{
		$this->db->select('*');
		$this->db->where('Item_id',$pro_id)->or_where('category_id',$cat_id);;
		$this->db->from('old_accessory');
		$query=$this->db->get();
		return $query->result_array();
	}

}
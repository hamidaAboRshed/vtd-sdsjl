<?php

class ProductSeries_model extends CI_Model {

	public function fetch_date(){
		$this->db->cache_on();
		$language_id = $this->ui_language->get_ui_language();
		$this->db->select('product_series.ID as ID,product_series_language.Name as Name, product_series.logo as logo');
		$this->db->where("Language_id",$language_id);
		$this->db->from('product_series');
		$this->db->join('product_series_language', 'product_series.ID = product_series_language.product_series_id', 'left');
		$this->db->order_by('Order');
		$query=$this->db->get();
		$this->db->cache_off();

		return $query->result_array();
	}


	function get_series_category($series_id,$sol_id=0)
	{
		$language_id = $this->ui_language->get_ui_language();
		$this->db->distinct();
		$this->db->select('product_category.ID as ID,product_category_language.Name as Name, product_category.icon as icon');
		$this->db->where("Language_id",$language_id);
		$this->db->from('product_category');
		$this->db->join('product_category_language', 'product_category.ID = product_category_language.product_category_id', 'left');
		if($sol_id != 0){
			$this->db->join('product', 'product.ProductCategoryID = product_category.ID', 'inner');
			$this->db->where('product_solution.solution_id',$sol_id);
			$this->db->join('product_solution', 'product.ID = product_solution.product_id', 'left');
		}
		//$this->db->order_by('Order');
		$result=$this->db->get();
		return $result->result_array();
	}

	function old_get_series_category($series_id)
	{
		$this->db->select("*");
		$this->db->where("series_id",$series_id);
		$this->db->where("is_deleted",0);
		$this->db->from("old_category");
		$result=$this->db->get();
		return $result->result_array();
	}

	function get_premium_solution()
	{
		$this->db->select('solution.ID as ID,solution_language.Name as Name, solution.icon as icon');
		$this->db->where("Language_id",$this->ui_language->get_ui_language());
		$this->db->from('solution');
		$this->db->join('solution_language', 'solution.ID = solution_language.solution_id', 'left');
		$this->db->order_by("Order", "asc");

		$query=$this->db->get();

		return $query->result_array();
	}

	function get_premium_product_list($sol_id,$cat_id=0)
	{
		$language_id = $this->ui_language->get_ui_language();

		$this->db->select('Family_name ,Family_description,datasheet_description, product.ID as ID, FileName as img, product_solution.display_order as solution_order, premium_product.display_order as premium_order');
		$this->db->where("Language_id",$language_id);
		
		$this->db->where('product_solution.solution_id',$sol_id);
		$this->db->from('product');
		$this->db->join('product_solution', 'product.ID = product_solution.product_id', 'left');
		$this->db->join('product_attachment', 'product.ID = product_attachment.ProductID and AttachmentTypeID = 2', 'left');
		$this->db->join('premium_product', 'product.ID = premium_product.ProductId', 'left');
		$this->db->join('premium_product_language', 'premium_product.ID = premium_product_language.Premium_product_id', 'left');

		if ($sol_id == 6 || $sol_id == 1) 
			$this->db->order_by("product_solution.display_order", "asc");
		else
			$this->db->order_by("premium_product.display_order", "asc");

		if ($cat_id!==0) {
			$this->db->where("ProductCategoryID",$cat_id);
		}
		$result=$this->db->get();
		return $result->result_array();
	}

	function get_premium_id()
	{
		$this->db->select("product_series_id");
		$this->db->where("Name","Premium");
		$this->db->from("product_series_language");
		$result=$this->db->get();
		$ret = $result->row();
		if($ret)
			return $ret->product_series_id;
	 	return 0;
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
			/*$str = $result->result();
			$str = $str->Code_str;*/
		}
		else {
			$str="RFA";
		}
		
		return $str;
	}
}
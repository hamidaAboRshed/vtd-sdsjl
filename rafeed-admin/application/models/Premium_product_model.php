<?php

class Premium_product_model extends CI_Model {

	function fetchMemberData($id = null) 
	{
		$this->load->model('Index_model');
		$default_lan=$this->Index_model->get_default_language();
		if($id) {
			$sql = "SELECT DISTINCT Product.*,premium_product.*,premium_product_language.* FROM product INNER JOIN premium_product ON product.ID=premium_product.ProductId LEFT JOIN premium_product_language on premium_product.ID= premium_product_language.Premium_product_id  where premium_product_language.Language_id=".$default_lan." and premium_product.ID = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT DISTINCT Product.*,premium_product.*,premium_product_language.* FROM product INNER JOIN premium_product ON product.ID=premium_product.ProductId LEFT JOIN premium_product_language on premium_product.ID= premium_product_language.Premium_product_id  where premium_product_language.Language_id=".$default_lan." order by product.ID DESC";
		$query = $this->db->query($sql);
		return $query->result_array();

		return array();;
	}

	function fetchMemberData_byUser() 
	{
		$this->load->model('Index_model');
		$default_lan=$this->Index_model->get_default_language();
		if($this->session->userdata('Full_name')){
			$sql = "SELECT DISTINCT Product.*,premium_product.*,premium_product_language.* FROM product INNER JOIN premium_product ON product.ID=premium_product.ProductId LEFT JOIN premium_product_language on premium_product.ID= premium_product_language.Premium_product_id  where premium_product_language.Language_id=".$default_lan." and CreatedBy='".$this->session->userdata('Full_name')."'  order by product.ID DESC";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		return array();;
	}

	function fetchMemberData_bySolutionType($type) 
	{
		$this->load->model('Index_model');
		$default_lan=$this->Index_model->get_default_language();
		if($type){
			$sql = "SELECT DISTINCT Product.*,premium_product.*,premium_product_language.* FROM product INNER JOIN premium_product ON product.ID=premium_product.ProductId LEFT JOIN premium_product_language on premium_product.ID= premium_product_language.Premium_product_id LEFT JOIN product_solution ON product_solution.product_id = product.ID where premium_product_language.Language_id=".$default_lan." and product_solution.solution_id =".$type."  order by product.ID DESC";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		return array();;
	}

	function get_premium_id_by_dimension_id($dimension_id)
	{
		$this->db->select('Premium_product_id');
		$this->db->where("ID",$dimension_id);
		$this->db->from('premium_product_family_dimension');
		return $this->db->get()->row()->Premium_product_id;
	}
	function get_premium_color_series_by_product_id($id)
	{
		$query = $this->db->query("SELECT Fitting_color_series_id, color_series_photo FROM premium_product_collection WHERE premium_product_family_dimension_id in( SELECT ID FROM `premium_product_family_dimension` WHERE `Premium_product_id` in (select ID FROM premium_product WHERE ProductId=".$id." )) ");
		return $query->result_array();
	}

	function update_premium_collection_price_by_power($dimension_id='', $power='', $price='')
	{
		if ($dimension_id) {
			if ($power) {
				 $this->db->where('Power',$power);
			}
			$value=array('price'=>$price);
	        $this->db->where('premium_product_family_dimension_id',$dimension_id);
	        
	        return $this->db->update('premium_product_collection',$value);
	    }
	}

	function change_premium_product_order_by_solution($product_id, $solution_id,$data){
		if ($product_id) {

			$this->db->where('solution_id',$solution_id);
	        $this->db->where('product_id',$product_id);
	        
	        return $this->db->update('product_solution',$data);
	    }
	}
	
	function insert_collection($data)
	{
		$this->db->insert('premium_product_collection',$data);
		$insert_id = $this->db->insert_id();
   		return  $insert_id;
	}
	
	function update_premium($data,$id)
	{
		$this->db->where('ID',$id);
		
   		return  $this->db->update('premium_product',$data);
	}
	
	function update_collection($data,$id)
	{
		$this->db->where('ID',$id);
		
   		return  $this->db->update('premium_product_collection',$data);
	}
	
	function delete_collection($col_id)
	{
		if($col_id){
			$this->db->where_in('ID', $col_id);
			$delete = $this->db->delete('premium_product_collection');
			return  $delete;
		}
		return null;
	}

	function delete_collection_driver($col_driver_id){
		if($col_driver_id)
			{
				$this->db->where_in('ID', $col_driver_id);
				$delete = $this->db->delete('premium_product_collection_driver');
				return  $delete;
			}
		return null;
	}

	function delete_dimension($dim_id)
	{
		if($dim_id){
			$this->db->where_in('ID', $dim_id);
			$delete = $this->db->delete('premium_product_family_dimension');
			return  $delete;
		}
		return null;
	}

	function delete_dimension_accessory($dim_acc_id){
		if($dim_acc_id)
			{
				$this->db->where_in('ID', $dim_acc_id);
				$delete = $this->db->delete('premium_product_collection_driver');
				return  $delete;
			}
		return null;
	}

	function change_color_series_photo($color_series_id,$value){
		if($color_series_id)
			{
				$value=array('color_series_photo'=>$value);
	        	$this->db->where('Fitting_color_series_id',$color_series_id);
	        	//$this->db->where('color_series_photo',$file_name);
	        
	        	return $this->db->update('premium_product_collection',$value);
			}
		return null;
	}
	
	function get_changed_collection_installation_way($dim_id){
		$this->db->select('Driver_id,`Led_id`,`Fixture_id`,`Fitting_id`,`Fitting_color_series_id`,`Fitting_accessory_id`');
		$this->db->distinct();
		$this->db->where('premium_product_family_dimension_id',$dim_id);
		$this->db->from('premium_product_collection');
		$result=$this->db->get();
		return $result->result_array();
	}

	function get_changed_collection_accessory($dim_id){
		$this->db->select('Driver_id,`Led_id`,`Fixture_id`,`Fitting_id`,`Fitting_color_series_id`,`Fitting_installation_way_id`');
		$this->db->distinct();
		$this->db->where('premium_product_family_dimension_id',$dim_id);
		$this->db->from('premium_product_collection');
		$result=$this->db->get();
		return $result->result_array();
	}

	function get_changed_collection_color_series($dim_id){
		$this->db->select('Driver_id,`Led_id`,`Fixture_id`,`Fitting_id`,`Fitting_accessory_id`,`Fitting_installation_way_id`');
		$this->db->distinct();
		$this->db->where('premium_product_family_dimension_id',$dim_id);
		$this->db->from('premium_product_collection');
		$result=$this->db->get();
		return $result->result_array();
	}

	function get_premium_installation_way_by_product_id($pro_id){
		$this->db->select('installation_way_id');
		$this->db->from('premium_product_collection');
		$this->db->where('premium_product.ProductId',$pro_id);
   		$this->db->join('premium_product_family_dimension', 'premium_product_family_dimension.ID = premium_product_collection.premium_product_family_dimension_id', 'left');
   		$this->db->join('premium_product', 'premium_product.ID = premium_product_family_dimension.Premium_product_id', 'left');

		$result=$this->db->get();
		return $result->result_array();
	}

	function get_dimension_installation_way($dim_id){
		$this->db->select('`Fitting_installation_way_id`');
		$this->db->distinct();
		$this->db->where('premium_product_family_dimension_id',$dim_id);
		$this->db->from('premium_product_collection');
		$result=$this->db->get();
		return $result->result_array();
	}

	function get_dimension_accessory($dim_id){
		$this->db->select('`Fitting_accessory_id`');
		$this->db->distinct();
		$this->db->where('premium_product_family_dimension_id',$dim_id);
		$this->db->from('premium_product_collection');
		$result=$this->db->get();
		return $result->result_array();
	}

	function get_dimension_color_series($dim_id){
		$this->db->select('`Fitting_color_series_id`');
		$this->db->distinct();
		$this->db->where('premium_product_family_dimension_id',$dim_id);
		$this->db->from('premium_product_collection');
		$result=$this->db->get();
		return $result->result_array();
	}

	function get_max_collection_serial($dim_id){
   		$this->db->select_max('serial_num');
   		$this->db->where('premium_product_family_dimension_id ',$dim_id);
		$this->db->from("premium_product_collection");
		$result=$this->db->get();
		$ret = $result->row();
	 	return $ret->serial_num;
   	}

   	function get_max_dimension_serial($premium_id){
   		$this->db->select_max('serial_num');
   		$this->db->where('Premium_product_id ',$premium_id);
		$this->db->from("premium_product_family_dimension");
		$result=$this->db->get();
		$ret = $result->row();
	 	return $ret->serial_num;
   	}

   	function get_premium_id_by_dimension($dim_id){
		$this->db->select("Premium_product_id");
	 	$this->db->where('ID',$dim_id);
		$this->db->from("premium_product_family_dimension");
		$result=$this->db->get();
		$ret = $result->row();
		if($ret)
			return $ret->Premium_product_id;
	 	return 0;
	}

	function get_product_id_by_premium_id($premium_id)
	{
		$this->db->select("ProductId");
	 	$this->db->where('ID',$premium_id);
		$this->db->from("premium_product");
		$result=$this->db->get();
		$ret = $result->row();
		if($ret)
			return $ret->ProductId;
	 	return 0;
	}


	function get_premium_dimension($premium_id){
		$this->db->select('*');
   		$this->db->where('Premium_product_id ',$premium_id);
		$this->db->from("premium_product_family_dimension");
		$this->db->order_by("serial_num", "asc");
		$result=$this->db->get();
		return $result->result_array();
	}

	function get_premium_dimension_attachment($type,$dim_id)
	{
		$query = $this->db->query("SELECT FileName FROM premium_dimension_attachment WHERE premium_dimension_id=".$dim_id." and AttachmentTypeID=".$type);
		return $query->result_array();
	}

	function get_premium_collection_by_dimension_id($dimension_ids){
		/*$query = $this->db->query("SELECT premium_product_collection.* FROM premium_product_collection inner join premium_product_family_dimension on premium_product_collection.premium_product_family_dimension_id = premium_product_family_dimension.ID WHERE premium_product_family_dimension.Premium_product_id= ".$premium_id);
		return $query->result_array();*/
		if($dimension_ids){
			$this->db->select('premium_product_collection.*');
			//$this->db->distinct();
	   		$this->db->where_in('premium_product_family_dimension_id ',$dimension_ids);
			$this->db->from("premium_product_collection");
			$this->db->order_by("serial_num", "asc");
			$result=$this->db->get();
			return $result->result_array();
		}
		return null;
	}

	function get_premium_collection_driver_by_id($id)
	{
		if($id){
			$this->db->select("driver_id");
			$this->db->where("premium_product_collection_id",$id);
			$this->db->from("premium_product_collection_driver");
			$query=$this->db->get();
			return $query->result_array();
		}
	}
	function get_premium_collection_by_id($col_id){
		$this->db->select('*');
   		$this->db->where('ID ',$col_id);
		$this->db->from("premium_product_collection");
		$result=$this->db->get();
		return $result->row();
	}

	function get_premium_product_byProduct_id($product_id)
	{
		$this->db->select('*');
   		$this->db->where('ProductId',$product_id);
		$this->db->from("premium_product");
		$result=$this->db->get();
		return $result->row_array();
	}

	function get_premium_product_attachment_byProduct_id($product_id)
	{
		if($product_id){
			$this->db->select("*");
			$this->db->where("ProductID",$id);
			$this->db->from("product_attachment");
			$query=$this->db->get();
			return $query->result_array();
		}
	}
	function get_premium_product_language($premium_id,$language_id)
	{
		if ($language_id!=0) {
			$this->db->where('Language_id',$language_id);
		}
		$this->db->select('*');
   		$this->db->where('Premium_product_id',$premium_id);
   		
		$this->db->from("premium_product_language");
		$result=$this->db->get();
		return $result->result_array();
	}

	function delete_premium_product($product_id)
	{
		//Product
		//Product Attchment
		//Product Application
		//Product Certification
		//premium
		//premium language
		//premium Dimension
		//premium Collection
		//premium Collection driver
		//color series 
	}

	function get_premium_coding_data($premium_id)
	{
		$query = $this->db->query("SELECT premium_product_collection.ID,CCT,CRI, product.ProductCategoryID as cat_id , premium_product_language.Family_name as family_name, Power_up,Power ,premium_product_family_dimension.serial_num as serial_dim FROM `product` INNER JOIN `premium_product` ON product.ID=premium_product.ProductId INNER JOIN `premium_product_language` ON premium_product.ID=premium_product_language.Premium_product_id INNER JOIN `premium_product_family_dimension` on premium_product.ID=premium_product_family_dimension.Premium_product_id INNER JOIN `premium_product_collection` on premium_product_family_dimension.ID=premium_product_collection.premium_product_family_dimension_id WHERE premium_product.ID = ".$premium_id." and premium_product_language.Language_id=1");
		return $query->result_array();
	}

	function get_premium_family_num($premium_id = null)
	{
		$this->db->where('Review_check ',1);
		$this->db->from('premium_product');
		$ret = $this->db->count_all_results();
	 	return $ret;	
	}

	function get_premium_product_color_series_by_product_id($product_id)
	{
		$this->db->select('Fitting_color_series_id as ID, fitting_part_language.Name as part, color_language.Name as color,material_language.Name as material,color_series_photo');
		$this->db->distinct();
		$this->db->from('premium_product');
		$this->db->join('premium_product_family_dimension', 'premium_product.ID = premium_product_family_dimension.Premium_product_id', 'left');
		$this->db->join('premium_product_collection', 'premium_product_family_dimension.ID = premium_product_collection.premium_product_family_dimension_id', 'left');
		$this->db->join('fitting_color_series', 'fitting_color_series.id = premium_product_collection.Fitting_color_series_id', 'left');
   		$this->db->join('fitting_color', 'fitting_color.Fitting_color_series_id = fitting_color_series.ID', 'left');

		$this->db->where('color_language.Language_id',1);
		$this->db->where('material_language.Language_id',1);
		$this->db->where('fitting_part_language.Language_id',1);
   		$this->db->join('color_texture', 'color_texture.ID = fitting_color.color_texture_id', 'left');
   		$this->db->join('color_language', 'color_language.Color_id = color_texture.ColorID', 'left');
   		$this->db->join('material_language', 'material_language.Material_id = color_texture.MaterialID', 'left');
   		$this->db->join('fitting_part_language', 'fitting_part_language.Fitting_part_id = fitting_color.FittingPartID', 'left');
   		
		$this->db->where('premium_product.ProductId',$product_id);
		$result=$this->db->get();
		return $result->result_array();
	}

}
<?php

class Premium_product_model extends CI_Model {

	function get_product_by_id($id)
	{
		$this->db->select('*');
		$this->db->where('ID',$id);
		$this->db->from('product');
		$result=$this->db->get();
		return $result->row_array();
	}

	function get_premium_product_byId($premium_id)
	{
		$this->db->select('*');
   		$this->db->where('ID',$premium_id);
		$this->db->from("premium_product");
		$result=$this->db->get();
		return $result->row_array();
	}

	function get_premium_product_byProduct_id($product_id)
	{
		$this->db->select('*');
   		$this->db->where('ProductId',$product_id);
		$this->db->from("premium_product");
		$result=$this->db->get();
		return $result->row_array();
	}

	function get_product_solution($product_id,$language_id)
   	{
   		$this->db->select('solution_language.Name as Name, solution_language.solution_id as ID');
   		$this->db->where('product_id ',$product_id);
   		$this->db->where('Language_id ',$language_id);
   		$this->db->join('solution_language', 'solution_language.solution_id = product_solution.solution_id', 'left');
		$this->db->from("product_solution");
		$result=$this->db->get();
		return $result->result_array();
   	}

   	function get_premium_product_language($premium_id,$language_id)
	{
		$this->db->select('*');
   		$this->db->where('Premium_product_id',$premium_id);
   		$this->db->where('Language_id',$language_id);
		$this->db->from("premium_product_language");
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

	function get_attachment_id_by_type($type){
		$this->db->select('attachment_type_id');
		$this->db->where('Name',$type);
		$this->db->from("attachment_type_language");
		$query=$this->db->get();
		$ret = $query->row();
	   return $ret->attachment_type_id;
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

	function get_product_certification($product_id){//desen't had language 
		$this->db->select('certification.Name as Name, certification.Logo as Logo');
   		$this->db->where('Product_id ',$product_id);
   		$this->db->join('certification', 'certification.ID = product_certification.CertificationID', 'left');
		$this->db->from("product_certification");
		$result=$this->db->get();
		return $result->result_array();
	}


	function get_product_installation_way($product_id,$language_id)
	{
		$this->db->select('installation_way_language.Name as Name, installation_way.Logo as Logo, application_photo,product_installation_way.installation_way_id as ID');
   		$this->db->where('Product_id',$product_id);
   		$this->db->where('Language_id',$language_id);
		$this->db->from("product_installation_way");
   		$this->db->join('installation_way_language', 'installation_way_language.Installation_way_id = product_installation_way.installation_way_id', 'left');
   		$this->db->join('installation_way', 'installation_way_language.Installation_way_id = installation_way.ID', 'inner');
		$result=$this->db->get();
		return $result->result_array();
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

	
	function get_file_type_attachment($type){
		$this->db->select('attachment_type_id');
		$this->db->where('Name = ',$type);
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
    
    function get_min_premium_collection_by_dimension_id($dimension_ids){
		if($dimension_ids){
			$this->db->select('ID,product_code, Power,Power_up, Lumen, CCT, CRI, IP, Multiple_ip, Front_ip, Back_ip, SymmetricBeam, BeamAngleH, BeamAngleV, BeamAngleValue, Fitting_color_series_id');
			//$this->db->distinct();
	   		$this->db->where_in('premium_product_family_dimension_id ',$dimension_ids);
			$this->db->from("premium_product_collection");
			$this->db->order_by("serial_num", "asc");
			$result=$this->db->get();
			return $result->result_array();
		}
		return null;
	}
    
    function get_total_premium_collection_by_id($id)
    {
        $this->db->select('premium_product_collection.* ,premium_product_collection.ID as collection_id ,premium_product_collection.serial_num as product_serial, premium_product_family_dimension.*');
   		$this->db->where('premium_product_collection.ID ',$id);
   		$this->db->join('premium_product_family_dimension', 'premium_product_family_dimension.ID = premium_product_family_dimension_id', 'left');
		$this->db->from("premium_product_collection");
        $result=$this->db->get();
        return $result->row();
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

	function get_product_download_attachment_byPremium_id($premium_id)
	{
		if($premium_id){
			$this->db->select("product_attachment.*");
			$this->db->where("premium_product.ID",$premium_id);
			$this->db->where("is_download_file",'1');
			$this->db->from("product_attachment");
			$this->db->join('premium_product', 'product_attachment.ProductID = premium_product.ProductId', 'left');
			$this->db->join('attachment_type', 'attachment_type.ID = product_attachment.AttachmentTypeID', 'left');
			$query=$this->db->get();
			return $query->result_array();
		}
	}

}
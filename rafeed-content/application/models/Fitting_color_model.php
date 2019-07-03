<?php

class Fitting_color_model extends CI_Model {

	/*get_color_series_by_dim_id not used I delete it*/
	function get_fitting_color_by_collection_id($series_id)
	{

		$this->db->select('Fitting_color_series_id as ID, fitting_part_language.Name as part, color_language.Name as color,material_language.Name as material,Texture_photo');
		$this->db->from('fitting_color');
		$this->db->where('color_language.Language_id',1);
		$this->db->where('material_language.Language_id',1);
		$this->db->where('fitting_part_language.Language_id',1);
   		$this->db->join('color_texture', 'color_texture.ID = fitting_color.color_texture_id', 'left');
   		$this->db->join('color_language', 'color_language.Color_id = color_texture.ColorID', 'left');
   		$this->db->join('material_language', 'material_language.Material_id = color_texture.MaterialID', 'left');
   		$this->db->join('fitting_part_language', 'fitting_part_language.Fitting_part_id = fitting_color.FittingPartID', 'left');
   		
		$this->db->where('Fitting_color_series_id',$series_id);
		$result=$this->db->get();
		return $result->result_array();
	}

	function get_fitting_texture_by_product_id($product_id)
	{

		$this->db->select('Texture_photo');
		$this->db->distinct();
		$this->db->from('premium_product');
		$this->db->join('premium_product_family_dimension', 'premium_product.ID = premium_product_family_dimension.Premium_product_id', 'left');
		$this->db->join('premium_product_collection', 'premium_product_family_dimension.ID = premium_product_collection.premium_product_family_dimension_id', 'left');
		$this->db->join('fitting_color_series', 'fitting_color_series.id = premium_product_collection.Fitting_color_series_id', 'left');
   		$this->db->join('fitting_color', 'fitting_color.Fitting_color_series_id = fitting_color_series.ID', 'left');
   		$this->db->join('color_texture', 'color_texture.ID = fitting_color.color_texture_id', 'left');
   		
		$this->db->where('premium_product.ProductId',$product_id);
		$result=$this->db->get();
		return $result->result_array();
	}

	function get_color_texture_id($color_id,$mat_id)
	{
		$this->db->select('ID');
		$this->db->from('color_texture');
		$this->db->where('ColorID',$color_id);
		$this->db->where('MaterialID',$mat_id);
		$result=$this->db->get();
		$ret = $result->row();
		if($ret)
			return $ret->ID;
	 	return 0;
	}

	function insert_color_texture($data){
		$this->db->insert('color_texture',$data);
		$insert_id = $this->db->insert_id();
   		return  $insert_id;
	}
	function update_color_texture($id, $data){
		$this->db->where('ID', $id);
		$sql = $this->db->update('color_texture', $data);

		return $sql;
	}

	function insert_color_series($data){
		$this->db->insert('fitting_color_series',$data);
		$insert_id = $this->db->insert_id();
   		return  $insert_id;
	}

	function insert_fitting_color($data)
	{
		$this->db->insert('fitting_color',$data);
		$insert_id = $this->db->insert_id();
   		return  $insert_id;
	}

	function delete_color_series($color_series_id)
	{
		//fitting color series
		$this->db->where_in('ID', $color_series_id);
		$delete = $this->db->delete('fitting_color_series');

		//fitting color
		$this->db->where_in('Fitting_color_series_id', $color_series_id);
		$delete = $this->db->delete('fitting_color');
		return $delete;
	}

	function get_color_texture_by_id($id)
	{
		$this->db->select('*');
		$this->db->where('ID',$id);
		$this->db->from('color_texture');
		$result=$this->db->get();
		return $result->row_array();
	}

	function get_texture()
	{
		$this->load->model('Index_model');
		$temp_texture=$this->Index_model->get_index('color_texture');
		$Texture = array();
		foreach ($temp_texture as $key => $value) {
			$name='';
			$name=$this->Index_model->get_value_by_id('Material',$value['MaterialID']);
			$name.= ', '.$this->Index_model->get_value_by_id('Color',$value['ColorID']);

			array_push($Texture, array('ID' => $value['ID'],'Name' => $name ,'Texture'=>$value['Texture_photo'] ) );
		}
		return $Texture;
	}

}
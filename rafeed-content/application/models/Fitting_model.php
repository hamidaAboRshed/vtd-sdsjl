<?php

class Fitting_model extends CI_Model {

	public function insert_fitting($data)
	{
		$this->db->insert('fitting',$data);
		$insert_id = $this->db->insert_id();
   		return  $insert_id;
	}

	public function insert_fitting_color($data)
	{
		return $this->db->insert('fitting_color',$data);
	}

	public function insert_fitting_accessory($data)
	{
		return $this->db->insert('fitting_accessory',$data);
	}

	public function insert_fitting_lighting_distribution($data)
	{
		return $this->db->insert('fitting_lighting_distributor',$data);
		/*//check if color distributor found 
		$this->db->select("ID");
	 	$this->db->where('LightingDistributionKindID',$data['LightingDistributionKindID']);
	 	$this->db->where('LightingDistributionTextureID',$data['LightingDistributionTextureID']);
		$this->db->from("fitting_lighting_distributor");
		$result=$this->db->get();
		$ret = $result->row();
	 	if($ret->ID)
	 		return $ret->ID;
	 	else
			{
				$this->db->insert('fitting_lighting_distributor',$data);
				$insert_id = $this->db->insert_id();
   				return  $insert_id;
   			}*/
	}

	public function insert_fitting_lighting_distribution_series($data)
	{
		$this->db->insert('fitting_lighting_distributor_series',$data);
		$insert_id = $this->db->insert_id();
   		return  $insert_id;
	}

	function get_fitting_lighting_distributor_by_series_id($series_id)
	{

		$this->db->select('lighting_distribution_kind_language.Name as kind, color_language.Name as color,material_language.Name as material,Texture_photo');
		$this->db->from('fitting_lighting_distributor');
		$this->db->where('color_language.Language_id',1);
		$this->db->where('material_language.Language_id',1);
		$this->db->where('lighting_distribution_kind_language.Language_id',1);
   		$this->db->join('color_texture', 'color_texture.ID = fitting_lighting_distributor.LightingDistributionTextureID', 'left');
   		$this->db->join('color_language', 'color_language.Color_id = color_texture.ColorID', 'left');
   		$this->db->join('material_language', 'material_language.Material_id = color_texture.MaterialID', 'left');
   		$this->db->join('lighting_distribution_kind_language', 'lighting_distribution_kind_language.Lighting_distribution_kind_id = fitting_lighting_distributor.LightingDistributionKindID', 'left');
   		
		$this->db->where('lighting_distributor_series_id',$series_id);
		$result=$this->db->get();
		return $result->result_array();
	}

	function insert_Fitting_color_series($data)
	{
		$this->db->insert('Fitting_color_series',$data);
		$insert_id = $this->db->insert_id();
   		return  $insert_id;
	}

	

	public function get_accessory()
	{
		$query = $this->db->query('SELECT Name, Accessory_id as ID FROM accessory_language ,accessory where 
			accessory.ID=accessory_language.Accessory_id and Type="Fitting"');

		return $query->result_array();
	}

	public function get_fitting_supplier_id($id)
	{
		$this->db->select("SupplierID");
	 	$this->db->where('ID ',$id);
		$this->db->from("fitting");
		$result=$this->db->get();
		$ret = $result->row();
	 	return $ret->SupplierID;
	}

	function get_fitting_by_id($id){
		$this->db->select('*');
		$this->db->where('ID',$id);
		$this->db->from('fitting');
		$result=$this->db->get();
		return $result->row();
	}
}
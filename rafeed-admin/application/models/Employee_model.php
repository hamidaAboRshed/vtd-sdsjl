<?php

class Employee_model extends CI_Model {

	
	function get_employee_by_id($emp_id)
	{
		//$this->db->select('FirstName,LastName');
		$this->db->where('ID ',$emp_id);
		$this->db->from('employee');
		$query=$this->db->get();
		return $query->result();
	}

	//for profile
	function get_country_by_city_id($city_id)
	{
		//country ID
		$this->db->select('CountryID');
		$this->db->where('ID',$city_id);
		$this->db->from('city');
		$result1=$this->db->get();
		$data=$result1->result();
		$country_id=null;
		foreach ($data as $row)
		{
			$country_id=$row->CountryID;
		}
		$country_name='';
		if($country_id)
		{
			//country name
			$this->db->select('Name');
			$this->db->where('ID ',$country_id);
			$this->db->from('country');
			$result=$this->db->get();
			//$data = array_shift($result->result_array());
			$data=$result->result();
			foreach ($data as $row)
			{
				$country_name=$row->Name;
			}
		}
		return $country_name;
	}

	function get_position_by_id($id)
	{
		$this->db->select('Name');
		$this->db->where('ID ',$id);
		$this->db->from('position');
		$result=$this->db->get();
		$data=$result->result();
		$position_name=null;
		foreach ($data as $row)
		{
			$position_name=$row->Name;
		}

		return $position_name;
	}

	function get_city_by_id($id)
	{
		$this->db->select('Name');
		$this->db->where('ID ',$id);
		$this->db->from('city');
		$result=$this->db->get();
		$data=$result->result();
		$city_name='';
		foreach ($data as $row)
		{
			$city_name=$row->Name;
		}

		return $city_name;
	}

	function get_city_by_country($cat_id)  
    {  
    	$this->db->select('city_language.Name as Name,city.ID as ID');
		$this->db->from('city');
		$this->db->join('city_language', 'city_language.City_id = city.ID');
		$this->db->where('city.CountryID', $cat_id);

		$query = $this->db->get();  
      	return $query->result();  
    } 

    function update($data)
    {
    	$this->db->where('ID', $this->session->userdata['emp_id']);
    	$this->db->update('employee', $data);
    }
}
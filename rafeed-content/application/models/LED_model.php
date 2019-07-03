<?php

class LED_model extends CI_Model {

	function fetchMemberData($id = null) 
	{
		if($id) {
			$sql = "SELECT * FROM led WHERE ID = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM led order by ID DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	function get_CCT_option()
	{
		$this->db->order_by("value","asc");
		$this->db->select("*");
		$this->db->from('cct_option');
		$query=$this->db->get();
		return $query->result_array();
	}

	function get_led_option($led_id)
	{
		if($led_id)
		{
			$this->db->select("CCT,CRI,ID");
			$this->db->where('LED_id',$led_id);
			$this->db->where('is_deleted',0);
			$this->db->from('led_option');
			$query=$this->db->get();
			return $query->result_array();
		}
		return null;
	}
	function get_led_option_by_id($led_option_id)
	{
		if($led_option_id)
		{
			$this->db->select("CCT,CRI,ID");
			$this->db->where('ID',$led_option_id);
			$this->db->from('led_option');
			$query=$this->db->get();
			return $query->row_array();
		}
		return null;
	}

	function get_led_by_optionID($option_ids)
	{
		$this->db->select("led.*");
		$this->db->distinct();
		$this->db->where_in('led_option.ID',$option_ids);
		$this->db->join('led', 'led.ID = led_option.LED_id', 'left');
		$this->db->from('led_option');
		$query=$this->db->get();
		return $query->result_array();
	}
	function get_led_options_by_id($led_option_id)
	{
		if($led_option_id)
		{
			$this->db->select("CCT,CRI,ID");
			//$this->db->where('ID',$led_option_id);
			$this->db->where_in('ID',$led_option_id);//ID array
			$this->db->where('is_deleted',0);
	 		$this->db->order_by("CCT", "asc");
	 		$this->db->order_by("CRI", "asc");
			$this->db->from('led_option');
			$query=$this->db->get();
			return $query->result_array();
		}
		return null;
	}

	public function insert($data)
	{
		$insert=$this->db->insert('led',$data);
		//$insert_id = $this->db->insert_id();

   		return  $insert;
	}

	public function insert_LED_option($LED_id,$CCT,$CRI)
	{
		$insert=null;
		foreach ($CCT as $key => $value) {
			foreach ($CRI as $key2 => $value2) {
				$insert = $this->db->insert('led_option', array('CCT' => $value,'CRI' => $value2, 'LED_id' => $LED_id));
			}
		}
		return $insert;
	}

	function update($data, $id)
	{
		$this->db->where('ID', $id);
		$sql = $this->db->update('led', $data);

		return $sql;
	}

	function get_led_option_by_CCT($cct='',$led_id)
	{
		if($cct)
		{
			$this->db->select("ID");
			$this->db->where_in('CCT',$cct);//ID array
			$this->db->where('LED_id',$led_id);
			$this->db->from('led_option');
			$query=$this->db->get();

			return $query->result_array();
		}
		return null;
	}

	function get_led_option_by_CRI($cri='',$led_id)
	{
		if($cri)
		{
			$this->db->select("ID");
			$this->db->where_in('CRI',$cri);//ID array
			$this->db->where('LED_id',$led_id);
			$this->db->from('led_option');
			$query=$this->db->get();
			return $query->result_array();
		}
		return null;
	}

	function delete_LED_option($option_ids)
	{
		if($option_ids)
		{
			$ids = array();
			foreach ($option_ids as $id)
			    {
			        $ids[] = $id['ID'];
			    }

			$this->db->where_in('ID', $ids);
			return $this->db->update('led_option', array('is_deleted' => 1));
		}
		return null;
	}

	function update_LED_option($led_id,$CCT_array,$CRI_array)
	{

		$led_db_option = $this->get_led_option($led_id);
		$CRI_option=array_unique(array_column($led_db_option, 'CRI'));
		$CCT_option =array_unique(array_column($led_db_option, 'CCT'));
		/*if ((count(array_intersect($CCT_option, $CCT_array)) == count($CCT_option)) && (count(array_intersect($CRI_option, $CRI_array)) == count($CRI_option))) {*/
		foreach ($CRI_option as $key => $value) {
			if(!in_array($value,$CRI_array)){
				//remove data not need it, is_deleted = 1
				$options_id=$this->get_led_option_by_CRI($value,$led_id);
				$this->delete_LED_option($options_id);
			}
		}
		foreach ($CCT_option as $key => $value) {
			if(!in_array($value,$CCT_array)){
				//remove data not need it, is_deleted = 1
				$options_id=$this->get_led_option_by_CCT($value,$led_id);
				$this->delete_LED_option($options_id);
			}
		}
		

		$update=true;
		$new_CCT_values=array_diff($CCT_array, $CCT_option);
		$new_CRI_values=array_diff($CRI_array, $CRI_option);
		
		//make mixer and add it into database
		if (count($new_CRI_values)>0) {
			$update = $this->insert_LED_option($led_id,$CCT_array,$new_CRI_values);
		}
		if (count($new_CCT_values)>0) {
			$update = $this->insert_LED_option($led_id,$new_CCT_values,$CRI_array);
		}
		
		return $update;
	}

	public function insert_cost($data)
	{
		return $this->db->insert('led_cost',$data);
	}

	function get_by_code($code){
		$this->db->select("*");
	 	$this->db->where('Code ',$code);
		$this->db->from("led");
		$query=$this->db->get();
		return $query->result_array();
	}

	public function get_led_basic_info()
	{
		$this->db->select("ID,Code");
		$this->db->from("led");
		$query=$this->db->get();
		return $query->result_array();
	}

	function get_cost_by_id($id)
	 {
	 	$this->db->select("*");
	 	$this->db->where('led.ID ',$id);
		$this->db->from("led");
	 	$this->db->join('led_cost', 'led.ID = led_cost.led_id', 'left');
	 	$this->db->join('supplier_contact', 'led_cost.supplier_contact_id = supplier_contact.ID', 'left');
	 	$this->db->order_by('offer_date', 'DESC');
	 	$query=$this->db->get();
	 	$ret = $query->row();
		return $ret;
	 }

	 function get_by_id($id_array)
	 {
	 	$this->db->select("CCT,CRI");
	 	$this->db->where_in('led.ID ',$id_array);
	 	$this->db->order_by("CCT", "asc");
	 	$this->db->order_by("CRI", "asc");
	 	$this->db->from("led");
	 	$query=$this->db->get();
		return $query->result_array();
	 }

	 function get_LED_by_ids($id_array)
	 {
	 	$this->db->select("*");
	 	$this->db->where_in('led.ID ',$id_array);
	 	$this->db->from("led");
	 	$query=$this->db->get();
		return $query->result_array();
	 }

	function get_led_supplier_id($id)
	{
		$this->db->select("SupplierID");
	 	$this->db->where('ID ',$id);
		$this->db->from("led");
		$result=$this->db->get();
		$ret = $result->row();
	 	return $ret->SupplierID;
	}
}
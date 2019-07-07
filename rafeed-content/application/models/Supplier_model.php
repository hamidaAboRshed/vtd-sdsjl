<?php

class Supplier_model extends CI_Model {


	function fetch_supplier_conntact_Data($id) 
	{
		
		$sql = "SELECT * ,supplier_contact.ID as supp_con_id , supplier_contact.note as supp_con_note  FROM supplier_contact join supplier on supplier.ID=supplier_contact.SupplierID WHERE SupplierID =".$id;
		$query = $this->db->query($sql);
		return $query->result_array();
	
	}


	public function get_contact($supplier_id)
	{
		$this->db->select("*");
	 	$this->db->where('SupplierID ',$supplier_id);
		$this->db->from("supplier_contact");
		$query=$this->db->get();
		return $query->result_array();
	}

	function get_supplier($id)
	{
		$this->db->select("*");
	 	$this->db->where('ID ',$id);
		$this->db->from("supplier");
		$query=$this->db->get();
		return $query->row_array();
	}

	function get_contact_type($supplier_contact_id = null)
	{
		if($supplier_contact_id)
		{
			$this->db->DISTINCT('ContactType');
			$this->db->select(" * ");
			$this->db->from("supplier_contact_details");
			$this->db->where("SupplierContactID",$supplier_contact_id);
			$query=$this->db->get();
			return $query->result_array();
		}
		else
		{
			$this->db->DISTINCT();
			$this->db->select("ContactType");
			$this->db->from("supplier_contact_details");
			$query=$this->db->get();
			return $query->result();			
		}

	}


	function get_unique_contact_type($supplier_id)
	{
		$this->db->DISTINCT();
		$this->db->select(" ContactType");
		$this->db->from("supplier_contact_details");
		$this->db->join("supplier_contact","supplier_contact.ID=supplier_contact_details.SupplierContactID");
		$this->db->where("supplier_contact.SupplierID",$supplier_id);
		$query=$this->db->get();
		return $query->result_array();
	}

	function get_supplier_contact_data($supplier_contact_id)
	{
		
		$this->db->select("*,supplier_contact_details.ID as id_sup_con_det");
		$this->db->from("supplier_contact_details");
		$this->db->join("supplier_contact","supplier_contact.ID=supplier_contact_details.SupplierContactID");
		$this->db->where("supplier_contact_details.SupplierContactID",$supplier_contact_id);
		$query=$this->db->get();
		return $query->result_array();
	}


	function update_data($table,$data,$id)
	{
	
		$query=$this->db->where('ID', $id);
		$query=$this->db->update($table, $data);
		return $query;

	}


	function delete_supplier_detalis($supplier_contact_id)
  	{
	    $sup_det_query= $this->db->where('ID', $supplier_contact_id);
	    $sup_det_query=$this->db->delete('supplier_contact_details');
	    return $sup_det_query;
  	}



	function delete_supplier_contact($id)
	{
	    $sup_query= $this->db->where('ID', $id);
	    $sup_query=$this->db->delete('supplier_contact');

	    $sup_det_query= $this->db->where('SupplierContactID', $id);
	    $sup_det_query=$this->db->delete('supplier_contact_details');
	    return $sup_det_query;
	    
	}
	  


}
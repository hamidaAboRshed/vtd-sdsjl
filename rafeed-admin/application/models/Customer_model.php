<?php

class Customer_model extends CI_Model {
    
    function update($data)
    {
    	$this->db->where('ID', $this->session->userdata['customer_id']);
    	$this->db->update('customer', $data);
    }
}
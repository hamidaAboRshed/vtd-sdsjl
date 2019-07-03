<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Language_model extends CI_Model {
    
    public function index()
    {
    }
    
    public function get_language() {
        $this->db->select('*');
        $this->db->from('language');
        $query=$this->db->get();
        return $query->result_array();
    }
    
    public function get_default_language(){
        $this->db->select('ID');
        $this->db->where("isDefault = 1");
        $this->db->from('language');
        return $this->db->get()->row()->ID;
    }
}
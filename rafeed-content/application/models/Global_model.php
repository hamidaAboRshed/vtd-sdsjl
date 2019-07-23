<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Global_model extends CI_Model {

	//constant function insert
	public function insert($table,$data)
	{
		$this->db->insert($table,$data);
	}

	public  function get_data($table)
	{
		// here we select every column of the table
		$q = $this->db->get($table);
		return $q->result();
	}
    
        public function updateData($table, $data, $id)
    {
        $this->db->where('ID', $id);
        $this->db->update("$table", $data);

        return true;
    }
}
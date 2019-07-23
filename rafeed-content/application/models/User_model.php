<?php

class User_model extends CI_Model {

	function insert_data($data){
		$this->db->insert('user',$data);
		$insert_id = $this->db->insert_id();
   		return  $insert_id;
	}
	function get_user_by_username($username)
	{
		$this->db->select('*');
		$this->db->where('username ',$username);
		$this->db->from('user');
		$query=$this->db->get();
		return $query->result_array();
	}

	function login_validate($username,$password)
	{
		$this->db->where('username', $username);
		$this->db->where('password', md5($password));
		$this->db->where('Active', 1);
		$query = $this->db->get('user');
		
		if($query->num_rows() == 1)
		{
			return $query->result();
		}	
	}

	function get_default_username()
	{
		return "administrator";
	}
	function is_User_password($password)
	{
		if($this->session->userdata['password']==md5($password))
			return true;
		return false;
	}

	function update_user($data)
	{
		$this->db->where('id', $this->session->userdata['user_id']);
    	$this->db->update('user', $data);
	}
    
    

}
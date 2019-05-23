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
			$this->load->model('Employee_model');
			foreach ($query->result() as $value) {
			$data = array(
					'user_id'=>$value->ID,
					'username' => $value->Username,
					'password' => $value->Password,
					'emp_id' =>  $value->EmployeeID,
					//'user_photo'=>$value->image,
					'is_logged_in' => true//,
					//'postion'=>$this->get_user_sp($value->user_id),
					//'permession'=>$this->user_model->get_roles_by_id($value->user_id)
				);
			}
			$current_employee=$this->Employee_model->get_employee_by_id($data['emp_id']);
			if($current_employee)
			{
				foreach ($current_employee as $row)
				{
					$data['Full_name'] = $row->FirstName.' '.$row->LastName;
					$data['Position'] = $this->Employee_model->get_position_by_id($row->PositionID);
					$data['Photo'] =  $row->Photo;
				}
			}
			//$permession=$data['permession'];
			/*$data['usr_edit']="";
			$data['usr_del']="";
			$data['usr_add']="";*/
			/*foreach ($permession as  $value) {
				//////side bar (navigation) ////////
				if ($value->role_code=="USR_VIEW" && $value->active=='nonactive') {
					$data['usr_view']="cnt-hide";
				}
				if ($value->role_code=="PRJ_VIEW" && $value->active=='nonactive') {
					$data['prj_view']="cnt-hide";
				}
				if ($value->role_code=="SPE_VIEW" && $value->active=='nonactive') {
					$data['spe_view']="cnt-hide";
				}
				if ($value->role_code=="REP_VIEW" && $value->active=='nonactive') {
					$data['rep_view']="cnt-hide";
				}
				/////// user page ///////
				if ($value->role_code=="USR_ADD" && $value->active=='nonactive') {
					$data['usr_add']="cnt-hide";
				}
				if ($value->role_code=="USR_EDIT" && $value->active=='nonactive') {
					$data['usr_edit']="cnt-hide";
				}
				if ($value->role_code=="USR_DEL" && $value->active=='nonactive') {
					$data['usr_del']="cnt-hide";
				}
				if ($value->role_code=="USR_SPE" && $value->active=='nonactive') {
					$data['usr_spe']="cnt-hide";
				}
				if ($value->role_code=="USR_PERM" && $value->active=='nonactive') {
					$data['usr_perm']="cnt-hide";
				}
				if ($value->role_code=="USR_ACC" && $value->active=='nonactive') {
					$data['usr_acc']="cnt-hide";
				}
				////// project ///////
				if ($value->role_code=="PRJ_ADD" && $value->active=='nonactive') {
					$data['prj_add']="cnt-hide";
				}
				if ($value->role_code=="PRJ_EDIT" && $value->active=='nonactive') {
					$data['prj_edit']="cnt-hide";
				}
				if ($value->role_code=="PRJ_DEL" && $value->active=='nonactive') {
					$data['prj_del']="cnt-hide";
				}
				if ($value->role_code=="PRJ_MEM" && $value->active=='nonactive') {
					$data['prj_mem']="cnt-hide";
				}
				if ($value->role_code=="TSK_VIEW" && $value->active=='nonactive') {
					$data['tsk_view']="cnt-hide";
				}
				
				
				
			}*/
		
			$this->session->set_userdata($data);
			//$this->main_permission();
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
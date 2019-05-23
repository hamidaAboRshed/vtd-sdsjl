<?php

class User extends CI_Controller {
	
	function __construct()
	{
        parent::__construct();
	 
		$this->load->database();
		$this->load->helper('url');
		/* ------------------ */ 
		 
		$this->load->library('grocery_CRUD');
	 
	}
 
	public function index()
	{
		$crud = new grocery_CRUD();
		$crud->set_table('user')->display_as('EmployeeID','Employee')
								->display_as('Active','Status');
		$crud->set_relation('EmployeeID','Employee','{FirstName} {LastName}');
		$crud->set_relation_n_n('Roles', 'role_user', 'role', 'UserID', 'RoleID', 'Name');
		$crud->fields('Active','Roles');
		$crud->field_type('Active','true_false');
		$crud->unset_columns('Password');

		$crud->unset_add();
		$crud->unset_delete(); 

		$crud->unset_jquery();
		$output = $crud->render();

		$this->_example_output($output);
	}

	function _example_output($output = null)
	{
		$data['subview'] = 'template.php';
		$data['output']=$output;
		$data['pageTitle']='User';
		$this->load->view('layouts/layout.php',$data);
	}

	function login()
	{
		$data['bool']=false;
		$this->load->view('login',$data);		
	}
	
	function create_user($emp_id)
	{
		$default_password='rafeed';
		$this->load->model('User_model');
		$this->load->model('Employee_model');
		$employee=$this->Employee_model->get_employee_by_id($emp_id);
		$username='';
		if($employee)
		{
			foreach ($employee as $row)
			{
				$username=$row->FirstName.'.'.$row->LastName;
			    /*foreach($row as $key=>$val)
		    	{
		    		$username.="$val".'_';
		    	}*/
			}
			$username.=$emp_id;
		}
		$username=str_replace(' ', '',$username);
		$user_data = array('Username' => $username,
				'Password' => md5($default_password),
				'Active' => true,
				'EmployeeID' =>$emp_id
				);

		$data['pageTitle'] = 'add user';
		$data['subview'] = 'empty_page';
		if(!$this->User_model->get_user_by_username($username))
		{
			if($this->User_model->insert_data($user_data) >0)
			{
				$data['result']='Congratulations! user Added Successfully in system. <br /> Username :  '.$username.'<br /> Password :  '.$default_password;
			}
			else
				$data['result']='Error.';
		}
		else
			$data['result']='Error this user aready in system.';

		$data['output']='';
		$this->load->view('layouts/layout.php',$data);
	}

	function validate_credentials()
	{	
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

	   if($this->form_validation->run() == true)
	    {
			$this->load->model('User_model');
			$query = $this->User_model->login_validate($this->input->post('username'),$this->input->post('password'));
			if($query) // if the user's credentials validated...
			{
				redirect(site_url('Welcome/index'));
			}
			else // incorrect username or password
			{
				$data['bool']=true;
				$data['string']="wrong username or password,try again";
				$this->load->view('login',$data);
			}
		}
		  else
		{
			$data['bool']=false;
			$this->load->view('login',$data);
		}	
	}


	function logout()
	{
		$this->session->sess_destroy();
		$this->login();
	}

	function change_password_form()
	{
		if($this->user_validate->check_login())
		{
			$data['subview'] = 'change_password';
			$data['output']='';
			$data['pageTitle']='change password'; 
			$data['bool']='';
			$data['string']="";
			$this->load->view('layouts/layout.php',$data); 
		}
	}

	function update_password()
	{
		$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required');
		$this->form_validation->set_rules('new_password', 'New Password', 'trim|required');
		$this->form_validation->set_rules('new_password_confirm','New Password Confrim',
		                      'required|trim|matches[new_password]');

		if($this->form_validation->run() == true)
	    {
			$this->load->model('User_model');
			$result = $this->User_model->is_User_password($this->input->post('old_password'));
			if($result) 
			{
				$user_data = array(	'Password' => md5($this->input->post('new_password_confirm')));
				$this->User_model->update_user($user_data);
				redirect(site_url('Welcome/index'));
				
			}
			else
			{
				$data['bool']=true;
				$data['string']="wrong old password,try again";
				$data['subview'] = 'change_password';
				$data['output']='';
				$data['pageTitle']='change password';   
				$this->load->view('layouts/layout.php',$data);
			}
		}
	  	else
		{
			$data['bool']=false;
			$data['subview'] = 'change_password';
			$data['output']='';
			$data['pageTitle']='change password';   
			$this->load->view('layouts/layout.php',$data);
		}	
	}
}

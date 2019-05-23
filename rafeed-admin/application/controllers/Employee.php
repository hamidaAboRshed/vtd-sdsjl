<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Employee extends CI_Controller {

//protected $personal_data=null;

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
	//$crud->set_theme('datatables');
	$crud->set_table('employee')->display_as('CityID','City')
								->display_as('PositionID','Position');
	$crud->required_fields('FirstName','LastName','DateOfBirth');
	//$crud->set_relation('CityID','city','Name');
	$crud->set_relation('PositionID','Position','Name');
	$crud->unset_jquery();
	
	$crud->add_action('Add user', '', 'User/create_user' ,'fa fa-user-plus');

	$output = $crud->render();

	$this->_example_output($output);
}
 
function _example_output($output = null)
{
	$data['subview'] = 'template.php';
	$data['output']=$output;
	$data['pageTitle']='Employee';
	$this->load->view('layouts/layout.php',$data);    
}

  

function view_profile()
{
	if($this->user_validate->check_login())
	{		
		$this->load->model('Employee_model');
		$current_employee=$this->Employee_model->get_employee_by_id($this->session->userdata['emp_id']);
		if($current_employee)
		{
			foreach ($current_employee as $row)
			{
				$data['output'] = array('Full_name' => $this->session->userdata['Full_name'],
									'Gender' => $row->Gender,
									'Address' => $row->Address,
									'DateOfBirth' => $row->DateOfBirth,
									'MobilePhone' => $row->MobilePhone,
									'Email' => $row->Email,
									//'Country' => $this->Employee_model->get_country_by_city_id($row->CityID),
									//'City' => $this->Employee_model->get_city_by_id($row->CityID),
									'Position'=>$this->session->userdata['Position'],
									'Photo'=>$row->Photo,
									'QQ'=>$row->QQ,
									'Skype'=>$row->Skype,
									'Wechat'=>$row->Wechat,
									);
			}
		}
		$personal_data = $data['output'];
		$this->session->set_userdata($personal_data);
		$data['subview'] = 'Profile_view';
		$this->load->view('Profile',$data);
	}
}

function edit_profile()
{
	if($this->user_validate->check_login())
	{
		$this->load->model('Index_model');
		//$data['Countries']=$this->Index_model->get_index_language('country');
		$data['subview'] = 'Profile_edit';
		$data['output'] = $this->session->userdata;
		$this->load->view('Profile',$data);
	}
}

public function build_drop_cities()  
{  
	  //set selected country id from POST  
	  $id_country = $this->input->post('id',TRUE); 
	  $this->load->model('Employee_model');
	  //run the query for the cities we specified earlier  
	  $data=$this->Employee_model->get_city_by_country($id_country);  
	  $output = '';  
	  foreach ($data as $row)  
	  {  
	     //here we build a dropdown item line for each query result  
	     $output .= "<option value='".$row->ID."' ".(($row->Name ==  $this->session->userdata['City']) ? ' selected="selected"' : '')." >".$row->Name;
	  }  
	  echo json_encode($output);  
}  

function update_employee()
{
	//upload photo
	$config['upload_path']    = './../rafeed-includes/upload_files/Employee_photos/';
    $config['allowed_types']  = 'gif|jpg|png|jpeg';
    //$config['max_size']       = '2000';
    //$config['max_width']      = '2000';
    //$config['m_checkstatus(conn, identifier)ax_height']     = '2000';

    $newname=$this->session->userdata('username');
    $config['file_name'] = $newname;
    $config['overwrite'] = TRUE;
    $this->load->library('upload', $config);
    //echo $this->input->post('is_default');
    if($this->input->post('is_default')=='on')
	{
		$image['img']='default_photo.png';
	}
	else
	    if ($this->upload->do_upload('Photo'))
	    {             
	        $file_data = $this->upload->data();
	        $image['img'] = $file_data['file_name'];
	    }
	    else
	    {
	    	$image['img']=$this->session->userdata('Photo');
	    }


	$this->load->model('Employee_model');
	$data = array('CityID' => $this->input->post('City'),
				'Address' => $this->input->post('Address'),
				'MobilePhone' => $this->input->post('MobilePhone'),
				'Email' => $this->input->post('Email'),
				'QQ' => $this->input->post('QQ'),
				'Skype' => $this->input->post('Skype'),
				'Wechat' => $this->input->post('Wechat'),
				'Photo' => $image['img']
			);
	$this->Employee_model->update($data);
	$this->view_profile();
}


}
 
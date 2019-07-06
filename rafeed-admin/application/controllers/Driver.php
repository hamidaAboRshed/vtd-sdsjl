<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Driver extends CI_Controller {

	function __construct()
	{
        parent::__construct();
		 
		$this->load->helper(array('form', 'url'));
		/* ------------------ */ 

	 	$this->load->model('Driver_model');
	 	$this->load->model('Supplier_model');
	 	$this->load->model('Index_model');
	 	$this->load->model('Enums');
	 	$this->load->model('User_model');
	 	$this->load->model('Accessory_model');
	}
	 
	public function index()
	{
		if($this->user_validate->check_login())
		{
			$data['Brand']=$this->Index_model->get_index('brand');
			$data['DimmableType']=$this->Index_model->get_index_language('dimmable_type');
			$data['DriverType']=$this->Enums->get_DriverType();
			$data['DriverOutputType']=$this->Enums->get_DriverOutputType();
			$data['Country']=$this->Index_model->get_index_language('country');
			$data['DriverAccessory']=$this->Accessory_model->get_accessory_by_type(3);
			$data['Supplier']=$this->Index_model->get_index('supplier');

			$data['output'] = '';
			$data['subview'] = 'driver_grid.php';
			$data['pageTitle']='Driver Table';
			$this->load->view('layouts/layout',$data);
		}
	}

	function get_driver_by_code()
	{
		$this->load->model('Driver_model');
		$result=$this->Driver_model->get_by_code($this->input->post('code'));
		foreach ($result as $key => $value) {
			$data=	array( 'Min Input Voltage' => $value['InputVoltageMin'],
							'Max Input Voltage' => $value['InputVoltageMax'],
							'Min Output Voltage' => $value['OutputVoltageMin'],
							'Max Output Voltage' => $value['OutputVoltageMax'],
							'Output Current' => $value['OutputCurrent'],
							'Accessory Note' => $value['AccessoryNote'],
							'ID' => $value['ID']);
		}
		echo json_encode($data);
	}

	function get_driver_by_id()
	{
		$value=$this->Driver_model->fetchMemberData($this->input->post('id'));
		$data=	array( 
			'Driver Type' => $this->Enums->get_DriverType_byId($value['DriverType']),
			'Code' => $value['Code'],
			'Power' => $value['Power'],
			'Output Current' => $this->global_function->get_range($value['OutputCurrentMin'],$value['OutputCurrentMax']),
			'Input Voltage' => $this->global_function->get_range($value['InputVoltageMin'],$value['InputVoltageMax']),
			'Output Voltage' => $value['OutputVoltageMin'] ." - ".$value['OutputVoltageMax'],
			'Origin Country' => $this->global_function->get_referance_value('country',$value['OriginCountryID']),
			'Supplier' => $this->global_function->get_referance_value('supplier',$value['SupplierID']),
			'Datasheet' =>'<a href="'.(is_null($value['Datasheet_file']) ? '#' : $this->navigation->get_includes_url().'/upload_files/Datasheet/Driver/'.$value['Datasheet_file'].'" download="driver_datasheet_'.$value['Code']).'">Download Datasheet</a>'
			);
		echo json_encode($data);
	}

	function get_drivers()
	{
		$result=$this->Driver_model->get_driver_basic_info();
		
		echo json_encode($result);
	}


	public function fetchMemberData() 
	{
		$result = array('data' => array());

		$data = $this->Driver_model->fetchMemberData();


		foreach ($data as $key => $value) {
			
			// button
			$buttons = '
			<div class="btn-group">
			  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    Action <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu">
			    <li><a type="button" class="" onclick="editDriverMember('.$value['ID'].')" data-toggle="modal" data-target="#editDriverMemberModal">Edit</a></li>
			    <li><a type="button" class="" onclick="uploadDriverDatasheet('.$value['ID'].')" data-toggle="modal" data-target="#uploadDriverDatasheetModal">Upload Datasheet</a></li>
			  </ul>
			</div>
			';

			$InputVoltage=$this->global_function->get_range($value['InputVoltageMin'],$value['InputVoltageMax']);
			
			$OutputVoltage=$this->global_function->get_range($value['OutputVoltageMin'],$value['OutputVoltageMax']);

			$OutputCurrent=$this->global_function->get_range($value['OutputCurrentMin'],$value['OutputCurrentMax']);
			
			$result['data'][$key] = array(
				$this->Enums->get_DriverType_byId($value['DriverType']),
				$value['Code'],
				$value['Power'],
				$OutputCurrent,
				$InputVoltage,
				$OutputVoltage,
				$value['IPRate'],
				$this->global_function->get_referance_value('country',$value['OriginCountryID']),
				$this->global_function->get_referance_value('supplier',$value['SupplierID']),
				(is_null($value['Datasheet_file']) ?'': '<a href="'. $this->navigation->get_includes_url().'/upload_files/Datasheet/Driver/'.$value['Datasheet_file'].'" download="driver_datasheet_'.$value['Code'].'">Download Datasheet</a>'),
				$buttons		
			);
		} // end foreach

		echo json_encode($result);
	}

	function getSelectedMemberInfo($id) 
	{
		if($id) {
			$data = $this->Driver_model->fetchMemberData($id);
			$data['Dimmable'] = $this->Driver_model->get_driver_dimmable($id);
			$data['Dimmable'] = array_column($data['Dimmable'], 'DimmableTypeID');
			echo json_encode($data);
		}
	}

	function create_driver() 
	{
		$validator = array('success' => false, 'messages' => array());

		$config = array(
			array(
		        'field' => 'DriverType',
		        'label' => 'DriverType',
		        'rules' => 'trim|required'	            
		    ),
		    array(
		        'field' => 'Code',
		        'label' => 'Code',
		        'rules' => 'trim|required|is_unique[Driver.Code]',
	        	'errors' => array(
	        		'required' => 'You must provide a %s.',
	        		'is_unique'=> 'This %s already exists.'
	        	)      
		    ),
		    array(
		        'field' => 'Power',
		        'label' => 'Power',
		        'rules' => 'trim|required|numeric'	            
		    ),
		     array(
		        'field' => 'OutputType',
		        'label' => 'OutputType',
		        'rules' => 'trim|required'	            
		    ),
		    array(
		    	'field' => 'InputVoltageMax',
		    	'label' => 'InputVoltageMax',
		    	'rules' => 'greater_than_equal_to['.$this->input->post('InputVoltageMin').']'  
		    ),
		    array(
		    	'field' => 'OutputVoltageMax',
		    	'label' => 'OutputVoltageMax',
		    	'rules' => 'greater_than_equal_to['.$this->input->post('OutputVoltageMin').']'  
		    ),
		    array(
		    	'field' => 'OutputCurrentMax',
		    	'label' => 'OutputCurrentMax',
		    	'rules' => 'greater_than_equal_to['.$this->input->post('OutputCurrentMin').']'  
		    ),
		    array(
		        'field' => 'PowerFactor',
		        'label' => 'PowerFactor',
		        'rules' => 'trim|numeric'	            
		    )
		);

		
		$this->form_validation->set_rules($config);
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if($this->form_validation->run() === true) {
			if($this->session->userdata('Full_name'))
				$username=$this->session->userdata('Full_name');
			else 
				$username=$this->User_model->get_default_username();

			$format = "%Y-%m-%d %H:%i";

			$data=array(
				'DriverType' => $this->input->post('DriverType'),
				'Code' => $this->input->post('Code'),
				'Power' => $this->input->post('Power') == '' ? null : $this->input->post('Power'),
				'InputVoltageMin' => $this->input->post('InputVoltageMin') == '' ? null : $this->input->post('InputVoltageMin'),
				'InputVoltageMax' => $this->input->post('InputVoltageMax') == '' ? null : $this->input->post('InputVoltageMax'),
				'OutputVoltageMin' => $this->input->post('OutputVoltageMin') == '' ? null : $this->input->post('OutputVoltageMin'),
				'OutputVoltageMax' => $this->input->post('OutputVoltageMax') == '' ? null : $this->input->post('OutputVoltageMax'),
				'OutputCurrentMin' => $this->input->post('OutputCurrentMin') == '' ? null : $this->input->post('OutputCurrentMin'),
				'OutputCurrentMax' => $this->input->post('OutputCurrentMax') == '' ? null : $this->input->post('OutputCurrentMax'),
				'OutputType'=>$this->input->post('OutputType') ,
				'PowerFactor'=>$this->input->post('PowerFactor') == '' ? null : $this->input->post('PowerFactor'),
				'IPRate'=>$this->input->post('IPRate') == '' ? null : $this->input->post('IPRate'),
				'OriginCountryID'=>$this->input->post('OriginCountryID'),
				'SupplierID'=>$this->input->post('SupplierID'),
				'CreatedBy'=>$username,
				'CreatedDate'=>mdate($format)
			);

			$id=$this->Driver_model->insert($data);

			$Dimmable_data=$this->input->post('Dimmable');
			if ($Dimmable_data) {
				if ($id) {
					foreach ($Dimmable_data as $key => $value) {
						$createMember=$this->Driver_model->insert_driver_dimmable(array('DriverID' =>$id , 'DimmableTypeID' => $value ));
					}
					$createMember=true;
				}
				else
					$createMember=false;
			}
			else
				$createMember=true;

			if($createMember === true) {
				$validator['success'] = true;
				$validator['messages'] = "Successfully added";
			} else {
				$validator['success'] = false;
				$validator['messages'] = "Error while updating the infromation";
			}			
		} 
		else {
			$validator['success'] = false;
			foreach ($_POST as $key => $value) {
				$validator['messages'][$key] = form_error($key);	
			}			
		}

		echo json_encode($validator);
	}

	function upload_datasheet($id)
	{
		$validator = array('success' => false, 'messages' => array());

		//custom validation is_file_selected
		$this->form_validation->set_rules('datasheet_file', 'Document', 'callback_is_file_selected');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');


		if($this->form_validation->run() === true) {

			//upload file
			$data['Datasheet_file'] = $this->global_function->upload_file('./../rafeed-includes/upload_files/Datasheet/Driver/','driver_'.$id,'datasheet_file');
        	$createMember = $this->Driver_model->update($data,$id); 
            
            if($createMember === true) {
				$validator['success'] = true;
				$validator['messages'] = "Successfully added";
			} else {
				$validator['success'] = false;
				$validator['messages'] = "Error while updating the infromation";
			}			
		} 
		else {
			$validator['success'] = false;
			foreach ($_POST as $key => $value) {
				$validator['messages'][$key] = form_error($key);	
			}			
		}

		echo json_encode($validator);
	}

	function is_file_selected(){

	    $this->form_validation->set_message('file_selected_test', 'Please select file.');
	    if (empty($_FILES['datasheet_file']['name'])) {
            return false;
        }else{
            return true;
        }
	}

	function edit($id = null) 
	{
		if($id) {
			$validator = array('success' => false, 'messages' => array());

			$config = array(
			    array(
			        'field' => 'editDriverType',
			        'label' => 'DriverType',
			        'rules' => 'trim|required'	            
			    ),
			    array(
			        'field' => 'editPower',
			        'label' => 'Power',
			        'rules' => 'trim|required|numeric'	            
			    ),
			     array(
			        'field' => 'editOutputType',
			        'label' => 'OutputType',
			        'rules' => 'trim|required'	            
			    ),
			    array(
			    	'field' => 'editInputVoltageMax',
			    	'label' => 'editInputVoltageMax',
			    	'rules' => 'greater_than_equal_to['.$this->input->post('editInputVoltageMin').']'  
			    ),
			    array(
			    	'field' => 'editOutputVoltageMax',
			    	'label' => 'editOutputVoltageMax',
			    	'rules' => 'greater_than_equal_to['.$this->input->post('editOutputVoltageMin').']'  
			    ),
			    array(
			    	'field' => 'editOutputCurrentMax',
			    	'label' => 'editOutputCurrentMax',
			    	'rules' => 'greater_than_equal_to['.$this->input->post('editOutputCurrentMin').']'            
			    ),
			    array(
			        'field' => 'editPowerFactor',
			        'label' => 'editPowerFactor',
			        'rules' => 'trim|numeric'	            
			    )
			);

			$this->form_validation->set_rules($config);
			
			$old_value=$this->input->post('editCodeOldVal');
			if ($this->input->post('editCode')!=$old_value) {

			  	$this->form_validation->set_rules('editCode','Code','trim|required|is_unique[Driver.Code]');

			} else {
			  	$this->form_validation->set_rules('editCode','Code','trim|required');
			}

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

			if($this->form_validation->run() === true) {

				if($this->session->userdata('Full_name'))
					$username=$this->session->userdata('Full_name');
				else 
					$username=$this->User_model->get_default_username();

				$format = "%Y-%m-%d %H:%i";

				$data=array(
				'DriverType' => $this->input->post('editDriverType'),
				'Code' => $this->input->post('editCode'),
				'Power' => $this->input->post('editPower') == '' ? null : $this->input->post('editPower'),
				'InputVoltageMin' => $this->input->post('editInputVoltageMin') == '' ? null : $this->input->post('editInputVoltageMin'),
				'InputVoltageMax' => $this->input->post('editInputVoltageMax') == '' ? null : $this->input->post('editInputVoltageMax'),
				'OutputVoltageMin' => $this->input->post('editOutputVoltageMin') == '' ? null : $this->input->post('editOutputVoltageMin'),
				'OutputVoltageMax' => $this->input->post('editOutputVoltageMax') == '' ? null : $this->input->post('editOutputVoltageMax'),
				'OutputCurrentMin' => $this->input->post('editOutputCurrentMin') == '' ? null : $this->input->post('editOutputCurrentMin'),
				'OutputCurrentMax' => $this->input->post('editOutputCurrentMax') == '' ? null : $this->input->post('editOutputCurrentMax'),
				'OutputType'=>$this->input->post('editOutputType') ,
				'PowerFactor'=>$this->input->post('editPowerFactor') == '' ? null : $this->input->post('editPowerFactor'),
				'IPRate'=>$this->input->post('editIPRate') == '' ? null : $this->input->post('editIPRate'),
				'OriginCountryID'=>$this->input->post('editOriginCountryID'),
				'SupplierID'=>$this->input->post('editSupplierID'),
				'EditedBy'=>$username,
				'EditedDate'=>mdate($format)
				);

				$editMember = $this->Driver_model->update($data,$id); 

				$Dimmable_data = $this->input->post('editDimmable[]');

				if ($Dimmable_data) {
					//remove dimmable option 
					$this->Driver_model->remove_driver_dimmable($id);

					//add dimmable option 
					foreach ($Dimmable_data as $key => $value) {
						$editMember=$this->Driver_model->insert_driver_dimmable(array('DriverID' =>$id , 'DimmableTypeID' => $value ));
					}
				}

				if($editMember === true) {
					$validator['success'] = true;
					$validator['messages'] = "Successfully updated";
				} else {
					$validator['success'] = false;
					$validator['messages'] = "Error while updating the infromation";
				}			
			} 
			else {
				$validator['success'] = false;
				foreach ($_POST as $key => $value) {
					$validator['messages'][$key] = form_error($key);	
				}			
			}
			echo json_encode($validator);
		}
	}
}
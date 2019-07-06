<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LED extends CI_Controller {

	function __construct()
	{
        parent::__construct();

		$this->load->model('Enums');
		$this->load->model('LED_model');
		$this->load->model('Supplier_model');
	 	$this->load->model('Index_model');
	 	$this->load->model('User_model');
	}
	 
	function index()
	{
		if($this->user_validate->check_login())
		{
			$data['LEDType']=$this->Index_model->get_index('led_type');
			$data['Supplier']=$this->Index_model->get_index('supplier');
			$data['SocketType']=$this->Index_model->get_index('socket_type');
			$data['PinType']=$this->Index_model->get_index('pin_type');
			$data['Country']=$this->Index_model->get_index_language('country');
			$data['LightSourceType']=$this->Index_model->get_index_language('led_lightsource_type');

			$data['output'] = '';
			$data['subview'] = 'led_grid.php';
			$data['pageTitle']='LED Table';
			$this->load->view('layouts/layout',$data);
		}
	}

	public function fetchMemberData() 
	{
		$result = array('data' => array());

		$data = $this->LED_model->fetchMemberData();

		foreach ($data as $key => $value) {
			
			// button
			$buttons = '
			<div class="btn-group">
			  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    Action <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu">
			    <li><a type="button" class="" onclick="editMember('.$value['ID'].')" data-toggle="modal" data-target="#editMemberModal">Edit</a></li>
			    <li><a type="button" class="" onclick="uploadLEDDatasheet('.$value['ID'].')" data-toggle="modal" data-target="#uploadLEDDatasheetModal">Upload Datasheet</a></li>
			  </ul>
			</div>
			';

            $LightSource=$this->global_function->get_referance_value('led_lightsource_type',$value['LightSourceTypeID']);
			switch ($LightSource) {
				case 'Module':
					$type=$this->global_function->get_referance_value('led_type',$value['Type']);
					break;
				case 'Tube':
					$type=$this->global_function->get_referance_value('pin_type',$value['Type']);
					break;
				case 'Bulb':
					$type=$this->global_function->get_referance_value('socket_type',$value['Type']);
					break;
				default:
					$type=$value['Type'];
					break;
			}

			$result['data'][$key] = array(
				$LightSource,
				$type,
				$value['Code'],
				$this->global_function->get_referance_value('country',$value['OriginCountryID']),
				$this->global_function->get_referance_value('supplier',$value['SupplierID']),
				(is_null($value['Datasheet_file']) ?'': '<a href="'.$this->navigation->get_includes_url().'/upload_files/Datasheet/Led/'.$value['Datasheet_file'].'" download="led_datasheet_'.$value['Code'].'">Download Datasheet</a>'),
				$buttons
			);
		}

		echo json_encode($result);
	}

	//used in change_led_code
	function get_LED_by_code()
	{
		$this->load->model('LED_model');
		$result=$this->LED_model->get_by_code($this->input->post('code'));
		foreach ($result as $key => $value) {
			$data=	array( 'Length' => $value['DimensionL'],
							'Height' => $value['DimensionH'],
							'Width' => $value['DimensionW'],
							'Radius' => $value['DimensionR'],
							'Power' => $value['Power'],
							'VoltageMin' => $value['VoltageMin'],
							'VoltageMax' => $value['VoltageMax'],
							'OperationCurrent' => $value['OperationCurrent'],
							'Lumen' => $value['Lumen'],
							'ColorTemperature' => $value['ColorTemperature'],
							'CRI' => $value['CRI'],
							'Macadam' => $value['Macadam'],
							'IP' => $value['IP'],
							'CoolingRequired' => $value['CoolingRequired'],
							'ID' => $value['ID']
						);
		}
		echo json_encode($data);
	}

	//used in info btn
	function get_LED_by_id()
	{
		$this->load->model('LED_model');
		$value=$this->LED_model->fetchMemberData($this->input->post('id'));

		$LightSource=$this->global_function->get_referance_value('led_lightsource_type',$value['LightSourceTypeID']);
			switch ($LightSource) {
				case 'Module':
					$type=$this->global_function->get_referance_value('led_type',$value['Type']);
					break;
				case 'Tube':
					$type=$this->global_function->get_referance_value('pin_type',$value['Type']);
					break;
				case 'Bulb':
					$type=$this->global_function->get_referance_value('socket_type',$value['Type']);
					break;
				default:
					$type=$value['Type'];
					break;
			}

			$data=	array( 
				'Lighting Source' => $LightSource,
				'Lighting Source Type' => $type,
				'Code' => $value['Code'],
				'Origin Country' => $this->global_function->get_referance_value('country',$value['OriginCountryID']),
				'Supplier' => $this->global_function->get_referance_value('supplier',$value['SupplierID']),
				'Datasheet' => '<a href="'.(is_null($value['Datasheet_file']) ? ' ' : $this->navigation->get_includes_url().'/upload_files/Datasheet/Led/'.$value['Datasheet_file']).'" download="led_datasheet_'.$value['Code'].'">Download Datasheet</a>'
			);
		echo json_encode($data);
	}

	public function create_led() 
	{
		$validator = array('success' => false, 'messages' => array());

		$config = array(
		    array(
		        'field' => 'LEDCode',
		        'label' => 'Code',
		        'rules' => 'trim|required|is_unique[LED.Code]',
		        'errors' => array(
		        		'required' => 'You must provide a %s.',
		        		'is_unique'=> 'This %s already exists.'
		        	)
		    )
		);

		$this->form_validation->set_rules($config);
		
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if($this->form_validation->run() === true) {

			$type='';
			switch ($this->input->post('LightSourceTypeID')) {
				case 1:
					$type=$this->input->post('led_type');
					break;
				case 2:
					$type=$this->input->post('LED_pin_type');
					break;
				case 3:
					$type=$this->input->post('LED_socket_type');
					break;
				default:
					$type=$this->input->post('LED_strips_m');
					break;
			}
			if($this->session->userdata('Full_name'))
				$username=$this->session->userdata('Full_name');
			else 
				$username=$this->User_model->get_default_username();
			
			$format = "%Y-%m-%d %H:%i";

			$data=array(
				'LightSourceTypeID' => $this->input->post('LightSourceTypeID'),
				'Type' => $type,
				'Code' => $this->input->post('LEDCode'),
				'OriginCountryID'=>$this->input->post('LEDOriginCountryID'),
				'SupplierID'=>$this->input->post('LEDSupplierID'),
				'CreatedBy'=>$username,
				'CreatedDate'=>mdate($format)
			);

			$createMember=$this->LED_model->insert($data);

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

	public function getSelectedMemberInfo($id) 
	{
		if($id) {
			$data = $this->LED_model->fetchMemberData($id);

			echo json_encode($data);
		}
	}

	public function edit($id = null) 
	{
		if($id) {
			$validator = array('success' => false, 'messages' => array());

			$old_value=$this->input->post('editLEDCodeOldVal');
			if ($this->input->post('editLEDCode')!=$old_value) {

			  	$this->form_validation->set_rules('editLEDCode','Code','trim|required|is_unique[LED.Code]');

			} else {
			  	$this->form_validation->set_rules('editLEDCode','Code','trim|required');
			}
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

			if($this->form_validation->run() === true) {
				$type='';
				switch ($this->input->post('editLightSourceTypeID')) {
					case 1:
						$type=$this->input->post('editled_type');
						break;
					case 2:
						$type=$this->input->post('editLED_pin_type');
						break;
					case 3:
						$type=$this->input->post('editLED_socket_type');
						break;
					default:
						$type=$this->input->post('editLED_strips_m');
						break;
				}

				if($this->session->userdata('Full_name'))
					$username=$this->session->userdata('Full_name');
				else 
					$username=$this->User_model->get_default_username();
				$format = "%Y-%m-%d %H:%i";

				$data=array(
					'LightSourceTypeID' => $this->input->post('editLightSourceTypeID'),
					'Type' => $type,
					'Code' => $this->input->post('editLEDCode'),
					'OriginCountryID'=>$this->input->post('editLEDOriginCountryID'),
					'SupplierID'=>$this->input->post('editLEDSupplierID'),
					'EditedBy'=>$username,
					'EditedDate'=>mdate($format)
				);

				$editMember = $this->LED_model->update($data,$id); 

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

	function upload_datasheet($id)
	{
		$this->form_validation->set_rules('datasheet_file', 'Document', 'callback_is_file_selected');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if($this->form_validation->run() === true) {
			//upload file
			$createMember = $this->global_function->upload_file('./../rafeed-includes/upload_files/Datasheet/Led/','led_'.$id,'datasheet_file');
			
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

	function get_leds()
	{
		$result=$this->LED_model->get_led_basic_info();
		
		echo json_encode($result);
	}

	function get_led_options($id){

		$value2=$this->LED_model->get_led_option_by_id($id);
		$new_result = array('ID' => $value2['ID'], 'CCT' => $value2['CRI'], 'CRI' => $value2['CCT'] );
		echo json_encode($new_result);
	}
}
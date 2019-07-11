<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Accessory extends CI_Controller {
 
	function __construct()
	{
        parent::__construct();
	 
		$this->load->helper('url');
		/* ------------------ */ 
		 
		$this->load->model('Accessory_model');
		$this->load->model('Enums');
	 	$this->load->model('User_model');
	 	$this->load->model('Index_model');
	 	$this->load->model('ProductSeries_model');
	 	$this->load->model('Accessory_model');
	}
 
	function index()
	{
		if($this->user_validate->check_login())
		{
			$data['Supplier']=$this->Index_model->get_index('supplier');
			$data['AccessoryType']=$this->Enums->get_AccessoryType();
			$data['Language']=$this->Index_model->get_index('language');
			$data['series'] = $this->Index_model->get_index_language('product_series');

			$data['output'] = '';
			$data['subview'] = 'accessory_grid.php';
			$data['pageTitle']='Accessory Table';
			$this->load->view('layouts/layout',$data);
		}
	}

	function get_accessory_by_type($type,$supplier)
	{
		if(!is_null($type)){
			if ($this->Enums->get_AccessoryType_byId($type)=="public") {
				$result=$this->Accessory_model->get_accessory_by_type($type);
				echo json_encode($result);
			}
			elseif (!is_null($supplier)) {
				$result=$this->Accessory_model->get_accessory_by_type_supplier($type,$supplier);
				echo json_encode($result);
			}
		}
	}

	function fetchMemberData() 
	{
		$result = array('data' => array());

		$data = $this->Accessory_model->fetchMemberData();

		foreach ($data as $key => $value) {
			
			// button
			$buttons = '
			<div class="btn-group">
			  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    Action <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu">
			    <li><a type="button" class="" onclick="editAccessoryMember('.$value['ID'].')" data-toggle="modal" data-target="#editAccessoryMemberModal">Edit</a></li>
			    <li><a type="button" class="" onclick="copyAccessoryMember('.$value['ID'].')" data-toggle="modal" data-target="#addAccessoryMadal">Copy</a></li>
			    <li><a type="button" class="" onclick="changeImageAccessoryMember('.$value['ID'].')" data-toggle="modal" data-target="#changeImageMemberModal">Change Accessory Image</a></li>
			  </ul>
			</div>
			';
			$language_data = $this->Accessory_model->fetchLanguageData((int)$value['ID']);
			$language = array();
			foreach ( $language_data as $key_a => $value_a) {
				array_push($language, $value_a['Name']);
			}

			$series_str=$this->ProductSeries_model->get_series_str($value['Series_id']);

			$accessory_images = $this->Accessory_model->get_accessory_image_by_id($value['ID']);
			//var_dump($accessory_images);
			$image = 'accessory_default.png';

			if ($accessory_images) {
				$image= $accessory_images[0]['photo'];
			}
			elseif (!is_null($value['Photo'])) {
				$image = $value['Photo'];
			}
			$result['data'][$key] = array(
				'<img hight=100 width=100 src="'.$this->navigation->get_includes_url().'/upload_files/Accessory/'.$image.'" />',
				$series_str.'-'.$value['Code'],
				$value['SupplierCode']);
			$result['data'][$key]= array_merge($result['data'][$key],$language);

			$result['data'][$key]= array_merge($result['data'][$key],array(	
				$this->Enums->get_AccessoryType_byId($value['Type']),
				$this->global_function->get_referance_value('product_series',$value['Series_id']),
				$this->global_function->get_referance_value('supplier',$value['SupplierID']),
				$value['price'],
				$buttons)
			);
		} // end foreach

		echo json_encode($result);
	}

	function getSelectedMemberInfo($id) 
	{
		if($id) {
			$data = $this->Accessory_model->fetchMemberData($id);
			$language_data = $this->Accessory_model->fetchLanguageData($id);
			$language = array();
			foreach ( $language_data as $key_a => $value_a) {
				array_push($language, $value_a['Name']);
			}
			$data= array_merge($data,$language);
			echo json_encode($data);
		}
	}
	
	function change_image($id)
	{
		$validator = array('success' => false, 'messages' => array());

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		$upload_photo_data = $this->global_function->upload_multiple_file('./../rafeed-includes/upload_files/Accessory/','accessory'.$id,'change_accessory_photo');
		if (!empty($upload_photo_data))
		{
			$this->Accessory_model->delete_image($id);

			foreach ($upload_photo_data as $key => $value) {
				$data=array(
					'accessory_id' => $id,
					'photo' => $value
				);
				$createMember = $this->Accessory_model->insert_accessory_image($data);
			}

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
			$validator['messages'][0]="Please select file";
		}

		echo json_encode($validator);
	}

	function create_accessory() 
	{
		$validator = array('success' => false, 'messages' => array());

		$config = array();

		$description    = $this->input->post('accessory_description[]');
		foreach($description as $ind=>$val){
			array_push($config,array(
		        'field' => 'accessory_description['.$ind.']',
		        'label' => 'accessory_description_'.$ind,
		        'rules' => 'trim|required'	            
		    ));
		}
		
		$this->form_validation->set_rules($config);
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if($this->form_validation->run() === true) 
		{
			if($this->session->userdata('Full_name'))
				$username=$this->session->userdata('Full_name');
			else 
				$username=$this->User_model->get_default_username();

			$format = "%Y-%m-%d %H:%i";
			$serial=$this->Accessory_model->get_accessory_count();
			
       		$data=array(
				'Code' => str_pad(($serial['serial'] +1), 4, '0', STR_PAD_LEFT),
				'SupplierCode' => $this->input->post('AccessoryCode'),
				'Type' => $this->input->post('AccessoryType'),
				'SupplierID'=>$this->input->post('accessory_supplierID'),
				'Series_id'=>$this->input->post('series'),
				'price' => empty($this->input->post('price'))? NULL : $this->input->post('price'),
				'CreatedBy'=>$username,
				'CreatedDate'=>mdate($format)
			);
 			
			$id=$this->Accessory_model->insert($data);

			$createMember=false;

			//add language description
			foreach($description as $ind=>$val){
				$data=array(
			        'Language_id' => (int)$this->input->post('accessory_Language_id['.$ind.']'),
			        'Accessory_id' => $id,
			        'Name' => $val
			    );
			    $createMember=$this->Accessory_model->insert_accessory_language($data);
			}
			
			//upload accessory photos
			$upload_photo_data = $this->global_function->upload_multiple_file('./../rafeed-includes/upload_files/Accessory/',str_pad(($serial['serial'] +1), 4, '0', STR_PAD_LEFT),'upload_photo');

			foreach ($upload_photo_data as $key => $value) {
				$data=array(
					'accessory_id' => $id,
					'photo' => $value
				);
				$this->Accessory_model->insert_accessory_image($data);
			}

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

	function edit($id = null) 
	{
		if($id) {
			$validator = array('success' => false, 'messages' => array());

			$description    = $this->input->post('editAccessory_description');
			$config = array();
			foreach($description as $ind=>$val){
				array_push($config,array(
			        'field' => 'editAccessory_description['.$ind.']',
			        'label' => 'editAccessory_description_'.$ind,
			        'rules' => 'trim|required'	            
			    ));
			}

			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

			if($this->form_validation->run() === true) {
				if($this->session->userdata('Full_name'))
					$username=$this->session->userdata('Full_name');
				else 
					$username=$this->User_model->get_default_username();

				$format = "%Y-%m-%d %H:%i";

				$data=array(
				'SupplierCode' => $this->input->post('editAccessoryCode'),
				'Type' => $this->input->post('editAccessoryType_ID'),
				'SupplierID'=>$this->input->post('editAccessory_supplierID'),
				'Series_id'=>$this->input->post('edit_series'),
				'price' => empty($this->input->post('editprice'))? NULL : $this->input->post('editprice'),
				'EditedBy'=>$username,
				'EditedDate'=>mdate($format)
				);

				$editMember = $this->Accessory_model->update($data,$id); 

				foreach($description as $ind=>$val){
					$data=array(
				        'Name' => $val
				    );
				    $editMember=$this->Accessory_model->update_accessory_language($data,$id,(int)$this->input->post('editAccessory_Language_id['.$ind.']'));
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

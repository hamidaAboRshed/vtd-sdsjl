<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Economic_product extends CI_Controller {
	function __construct()
	{
        parent::__construct();
        $this->load->model('Economic_product_model');
	 	$this->load->model('Product_model');
	 	$this->load->model('Fitting_model');
	 	$this->load->model('Fitting_color_model');
	 	$this->load->model('Driver_model');
	 	$this->load->model('LED_model');
	 	$this->load->model('Index_model');
	 	$this->load->model('Enums');
	 	$this->load->model('Global_model');
	 	$this->load->library('form_validation');
	 	$this->load->helper('form');
	 	$this->load->helper('url');
	}
 
	public function index()
	{
		if($this->user_validate->check_login())
		{
			$data['output'] = '';
			$array = array();
			$array['grid_header'] = array(
				'Family name' ,
				'Family shortcut' ,
				'Category',
				'Working Temperature',
				'Review Check',
				'Options');

			$array['read_action'] = '../Economic_product/fetchEchonomicFamiliesData/';

			$data['ProductType']=$this->Enums->get_ProductType();
			$data['Application']=$this->Index_model->get_index_language('application');
			$data['Certification']=$this->Index_model->get_index('certification');
			$data['Language']=$this->Index_model->get_index('language');
			$data['InstallationWay']=$this->Index_model->get_index_language('installation_way');
			$data['ProductPowerType']=$this->Enums->get_ProductPowerType();
			$data['DriverType']=$this->Enums->get_DriverType();
			$data['ManufacturingTechnique']=$this->Enums->get_productMode();
			$data['LightingSource']=$this->Enums->get_BaseFixture();
			$data['ACProductFunction']=$this->Enums->get_ACProductFunction();
			$data['SocketType']=$this->Index_model->get_index('socket_type');
			$data['PinType']=$this->Index_model->get_index('pin_type');
			$data['TubeModel']=$this->Index_model->get_index('tube_model');
			$data['LightingSourceType'] = $this->Enums->get_LightingSourceType();
			$data['LEDType']=$this->Index_model->get_index('led_type');
			$data['AttachmentType']=$this->Index_model->get_index_language_not_deleted('attachment_type');

			$array['custom_modal_file'] = 'economic_product_grid.php';
			$array['custom_modal_data'] = $data;

			$data['grid_body_data']= $array;
			$data['subview'] = 'grid_view.php';
			
			// add breadcrumbs
			$this->breadcrumbs->push('Economic product', '/Economic_product/index');

			// output
			$data['breadcrumb'] = $this->breadcrumbs->show();
			$data['pageTitle']='Economic Product Table';
			$this->load->view('layouts/layout',$data);
		}
	}

	public function fetchEchonomicFamiliesData() 
	{
		$result = array('data' => array());
		
		$data = $this->Economic_product_model->fetchMemberData();	
			
		$default_language=$this->Index_model->get_default_language();

		foreach ($data as $key => $value) {
			
			// button
			$buttons = '
			<div class="btn-group">
			  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    Action <span class="caret"></span>
			  </button>
				<ul class="dropdown-menu">'
				.($value['Review_check']==0?
					'<li><a type="button" class="" onclick="checkEconomicProduct('.$value['economic_product_id'].')" data-toggle="modal" data-target="#checkEconomicProductModal">Review Check</a></li>' : '')
				.'<li><a type="button" class="" onclick="upload_photos('.$value['ProductId'].')" data-toggle="modal" data-target="#uploadPhotosModal">Add attach file</a></li>'
				.'<li><a type="button" class="" onclick="updateApplicationPhoto('.$value['ProductId'].')" data-toggle="modal" data-target="#uploadApplicationPhotosModal">Change application photo</a></li>'
				
			    .'<li><a type="button" class="" href="../Print_pdf/economic_family_report/'.$value['ProductId'].'"  target="_blank">View Report</a></li>
			    <li><a type="button" class="" href="./collection_grid_view/'.$value['economic_product_id'].'">View Collection</a></li>
			  </ul>
			</div>
			';

			
			$result['data'][$key] = array(	
				$value['Family_name'],
				$value['family_shortcut_code'],
				$this->Index_model->get_value_by_id('product_category',$value['ProductCategoryID']),
				$this->get_range($value['MinWorkingTemperature'],$value['MaxWorkingTemperature']),
				'<div class="check-icon"><i id="E-series" class="fa '.($value['Review_check']==1? 'fa-check-circle' : 'fa-circle').'"></i></div>',
				$buttons);
		} 
		echo json_encode($result);
	}

	function collection_grid_view($economic_product_id){
		$data['output'] = '';
		$array = array();
		$array['grid_header'] = array(
			'Product Number' ,
			'Referance Code' ,
			'Dimension',
			'Power',
			'Current',
			'CCT',
			'CRI',
			'Lumen',
			'IP',
			'IK',
			'BeamAngle',
			'Power factor',
			'Fitting Color',
			//'Lighting Disturbation',
			'Price',
			'Option');

		$array['read_action'] = '../fetchFamilyCollectionData/'.$economic_product_id;

		$array['custom_modal_file'] = 'economic_product_collection_grid.php';
		$array['custom_modal_data'] = $economic_product_id;

		$data['grid_body_data']= $array;

		$this->breadcrumbs->push('Economic product', '/Economic_product/index');
		$this->breadcrumbs->push('Economic Collection', '/Economic_product/collection_grid_view/'.$economic_product_id);
		$data['breadcrumb'] = $this->breadcrumbs->show();

		$data['subview'] = 'grid_view.php';
		$data['pageTitle']='Economic product collection table';
		$this->load->view('layouts/layout',$data);
	}

	function fetchFamilyCollectionData($economic_product_id)
	{
		$result = array('data' => array());

		$data = $this->Economic_product_model->get_collection_by_economic_id($economic_product_id);

		foreach ($data as $key => $value) {
			
			// button
			$buttons = '
			<div class="btn-group">
			  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    Action <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu">
			  	<li><a type="button" class="" href="'.site_url("Economic_product/edit_family_collection?id=".$economic_product_id.'&collection_id='.$value['ID']).'">Edit</a></li>
			   	<li><a type="button" class="" href="'.site_url("Economic_product/add_family_collection?id=".$economic_product_id.'&collection_id='.$value['ID']).'">Copy</a></li>
			  </ul>
			</div>
			';

			$fitting_color = $this->Fitting_color_model->get_fitting_color_by_collection_id($value['Fitting_color_series_id']);
			$fitting_color_data='';

			foreach ($fitting_color as $key_fitting => $value_fitting) {
				$fitting_color_data .= '<img hight=30 width=30 src="'.$this->navigation->get_includes_url().'/upload_files/Texture/'.$value_fitting['Texture_photo'].'" />'
							.$value_fitting['color']." / ".$value_fitting['material']." (".$value_fitting['part'].")";
				if($key_fitting !== count($fitting_color) -1 )
					$fitting_color_data.='</br>';
			}

			$lighting_distribution_date = $this->Fitting_model->get_fitting_lighting_distributor_by_series_id($value['lighting_distributor_series_id']);
            $lighting_distribution='';
            foreach ($lighting_distribution_date as $key_dis => $value_dis) {
            	$lighting_distribution .= '<img hight=30 width=30 src="'.$this->navigation->get_includes_url().'/upload_files/Texture/'.$value_dis['Texture_photo'].'" />'
							.$value_dis['color']." / ".$value_dis['material']." (".$value_dis['kind'].")";
				if($key_dis !== count($lighting_distribution_date) -1 )
					$lighting_distribution.='</br>';
            }

			$result['data'][$key] = array(	
				$value['product_number'],
				$value['reference_code'],
				$this->Index_model->get_value_by_id('shape',$value['FittingShapeID']),
				$value['Power'],
				$value['Current'],
				(is_null($this->Enums->get_CCTRangeValues_byId($value['CCT'])) ? $value['CCT'] : $this->Enums->get_CCTRangeValues_byId($value['CCT'])),
				$value['CRI'],
				$value['Lumen'],
				($value['Multiple_ip'] == 0 ? $value['IP'] : $value['Front_ip'].'/'.$value['Back_ip']),
				$value['IK'],
				($value['SymmetricBeam']==1 ? $value['BeamAngleValue'] : $this->get_range($value['BeamAngleH'],$value['BeamAngleV'])),
				$value['PowerFactor'],
				$fitting_color_data,
				//$lighting_distribution,//$this->Index_model->get_value_by_id('lighting_distribution_kind',$value['LightingDistributionKindID']),
				$value['price'],
				$buttons);
		} // /foreach

		echo json_encode($result);
	}

	public function getSelectedCollectionInfo($id) 
	{
		if($id) {
			$data = $this->Global_model->getDataOneColumn('economic_product_collection', 'ID', $id);
			//var_dump($data);
			$data[0]->color = $this->Fitting_color_model->get_fitting_color_by_collection_id($data[0]->Fitting_color_series_id);
			$data[0]->lighting_distribution = $this->Fitting_model->get_fitting_lighting_distributor_by_series_id($data[0]->lighting_distributor_series_id);
			$data[0]->base_url=$this->navigation->get_includes_url();
			echo json_encode($data);
		}
	}

	function change_family_application_photo($product_id)
	{
		$validator = array('success' => false, 'messages' => array());
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if ($product_id) {

			$photo_name='application_file_'.$this->input->post('installation_id');
			/*if($type=="small solo"){
				$type_id = $this->Product_model->get_file_type_attachment('Family photo - small (solo)');
				$photo_name = 'family_photo_solo_';
			}*/

			$this->Product_model->delete_product_installation_way($product_id, $this->input->post('installation_id'));
			$photos = $this->global_function->upload_file('./../rafeed-includes/upload_files/Product/Economic/'.$product_id,$photo_name,'application_photo');

			$data= array(
				'product_id' => $product_id, 
				'installation_way_id' => $this->input->post('installation_id'), 
				'application_photo' => $photos
			);
			$createMember = $this->Product_model->insert_product_installation_way($data);
				
			if($createMember === true) {

					$validator['success'] = true;
					$validator['messages'] = "Successfully added";
				} else {
					$validator['success'] = false;
					$validator['messages'] = "Error while updating the infromation";
				}			
			//} 
			}
			else {
				$validator['success'] = false;
				$validator['messages']['application_photo']='<p class="text-danger">Please select file</p>';
			}

		
		echo json_encode($validator);
	}

	function change_family_photo($product_id)
	{
		$createMember=false;
		$validator = array('success' => false, 'messages' => array());
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if (!is_null($this->input->post('AttachmentTypeID'))) {

			$photo_name='attachment_file_'.$this->input->post('AttachmentTypeID');
			/*if($type=="small solo"){
				$type_id = $this->Product_model->get_file_type_attachment('Family photo - small (solo)');
				$photo_name = 'family_photo_solo_';
			}*/

			$this->Product_model->delete_product_attachment($product_id, $this->input->post('AttachmentTypeID'));
			$photos = $this->global_function->upload_file('./../rafeed-includes/upload_files/Product/Economic/'.$product_id,$photo_name,'product_photo');
			$data= array(
				'ProductID' => $product_id, 
				'AttachmentTypeID' => $this->input->post('AttachmentTypeID'), 
				'FileName' => $photos
			);
			$createMember = $this->Product_model->insert_product_attachment($data);
			if($createMember === true) {

					$validator['success'] = true;
					$validator['messages'] = "Successfully added";
				} else {
					$validator['success'] = false;
					$validator['messages'] = "Error while updating the infromation";
				}			
			//} 
			}
			else {
				$validator['success'] = false;
				$validator['messages']['product_photo']='<p class="text-danger">Please select file</p>';
			}

		
		echo json_encode($validator);
	}


	function get_range($min,$max)
	{
		if ($min == $max || $max==NULL) {
				return $min;
			}
		else
			return $min ." - ".$max;
	}

	public function is_null($value){
		if($value =='')
			return NULL;
		else
			return $value;
	}

	function family_exist()
	{
		if($this->Product_model->get_id_by_family_name($this->input->post('Family_name'),'economic_product_language')>0)
		{
			//family exist
			echo json_encode(true) ;
		}
		else
			echo json_encode(False);
	}

	function code_exist()
	{
		if($this->Economic_product_model->get_collection_id_by_column('reference_code',$this->input->post('code'))>0)
		{
			echo json_encode(true) ;
		}
		else
			echo json_encode(False);
	}

	function get_family_collection_form_data()
	{
		$queries = array();
		parse_str($_SERVER['QUERY_STRING'], $queries);
		$data['economic_product_id'] = $queries['id'];
		$data['economic_product_collection_id'] = $queries['collection_id'];
		$data['Shape']=$this->Index_model->get_index_language('shape');
		$data['Material']=$this->Index_model->get_index_language('material');
		$data['Color']=$this->Index_model->get_index_language('color');
		$data['Place']=$this->Index_model->get_index_language('fitting_part');
		
		$data['Texture']=$this->Fitting_color_model->get_texture();

		$data['SocketType']=$this->Index_model->get_index('socket_type');
		$data['PinType']=$this->Index_model->get_index('pin_type');
		$data['LightingDistributionKind']=$this->Index_model->get_index_language('lighting_distribution_kind');
		$data['Brand']=$this->Index_model->get_index('brand');
		$data['DimmableType']=$this->Index_model->get_index_language('dimmable_type');
		$data['DriverType']=$this->Enums->get_DriverType();
		$data['DriverOutputType']=$this->Enums->get_DriverOutputType();
		$data['Country']=$this->Index_model->get_index_language('country');
		$data['LightSourceType']=$this->Index_model->get_index_language('led_lightsource_type');
		$data['Application']=$this->Index_model->get_index_language('application');
		$data['Certification']=$this->Index_model->get_index('certification');
		$data['AttachmentType']=$this->Index_model->get_index_language_not_deleted('attachment_type');
		$data['VoltageType'] = $this->Index_model->get_index('voltage_type');

		$data['ProductPowerType']=$this->Enums->get_ProductPowerType();

		$data['CCT_option']=$this->LED_model->get_CCT_option();
		$data['CCT_static_option'] = $this->Enums->get_CCTRangeValues();

		$data['CRI_option']=$this->Index_model->get_index('cri_option');

		$data['LEDType']=$this->Index_model->get_index('led_type');

		$data['Supplier']=$this->Index_model->get_index('Supplier');

		/*
		$supplier 
		$Accessory=$this->Accessory_model->get_accessory_by_type_supplier($type,$supplier)*/

		//enum
		// light source
		$data['LightingSource']=$this->Enums->get_BaseFixture();
		$data['AdjustableType']=$this->Enums->get_AdjustableType();
		$data['AccessoryType']=$this->Enums->get_AccessoryType();
		
		$data['FittingAccessory']=$this->Fitting_model->get_accessory();
		return $data;
	}

	function add_family_collection()
	{
		$data= $this->get_family_collection_form_data();

		$subview='add_economic_product_collection';
		$data['output'] = '';

		$this->breadcrumbs->push('Economic product', '/Economic_product/index');
		$this->breadcrumbs->push('Economic product collection', '/Economic_product/collection_grid_view/'.$data['economic_product_id']);
		$this->breadcrumbs->push('Add economic product collection', '/Economic_product/add_family_collection?id='.$data['economic_product_id'].'&collection_id=0');

		$data['breadcrumb'] = $this->breadcrumbs->show();
		$data['subview'] = $subview;
		$data['pageTitle']='Add Economic Product';
		$this->load->view('layouts/layout',$data);
	}

	function edit_family_collection()
	{
		$data= $this->get_family_collection_form_data();

		$subview='edit_economic_product_collection';
		$data['output'] = '';

		$this->breadcrumbs->push('Economic product', '/Economic_product/index');
		$this->breadcrumbs->push('Economic product collection', '/Economic_product/collection_grid_view/'.$data['economic_product_id']);
		$this->breadcrumbs->push('Edit economic product collection', '/Economic_product/edit_family_collection?id='.$data['economic_product_id'].'&collection_id='.$data['economic_product_collection_id']);

		$data['breadcrumb'] = $this->breadcrumbs->show();
		$data['subview'] = $subview;
		$data['pageTitle']='Edit Economic Product';
		$this->load->view('layouts/layout',$data);
	}

	function add_family()
	{	
		$validator = array('success' => false, 'messages' => array());
		//delete all null data
		//$_POST = array_filter($_POST);

		foreach($_POST as $key => $stuff ) {
		    $_POST[$key]=$this->is_null($stuff);
		     if(is_array( $stuff ) ) {
		        foreach( $stuff as $subKey => $thing ) {
		            $stuff[$subKey]==$this->is_null($thing);
		        }
		    }
	    }
	    //add product
		if($this->session->userdata('Full_name'))
			$username=$this->session->userdata('Full_name');
		else 
			$username=$this->User_model->get_default_username();
		$format = "%Y-%m-%d %H:%i";
		$series_data = $this->Index_model->get_value_by_name('product_series_language','E-Series');
		$product_data = array(
			'ProductCategoryID' => $this->is_null($this->input->post('ProductCatID')),
			'series_id' => $series_data[0]['product_series_id'],
			'CreatedBy'=>$username,
			'CreatedDate'=>mdate($format)
			);

		$product_id=$this->Product_model->insert($product_data);
		$type=NULL;
		switch ($this->input->post('ACProductFunction')) {
			case 1:
				$type=$this->input->post('SocketTypeID');
				break;
			case 2:
				$type=$this->input->post('TubeModelID');
				break;
			case 3:
				$type=$this->input->post('TubeModelID');
				break;
			case 4:
				$type=$this->input->post('PinTypeID');
				break;
		}

		//add economic product
		$economic_product = array(
			'ProductId' => $product_id,
			'manufacturing_technique' => $this->is_null($this->input->post('ManufacturingTechnique')),
			'lighting_source_type'=> $this->is_null($this->input->post('LightingSourceTypeID')),
			'led_type' => $this->is_null($this->input->post('led_type')),
			'product_function' => $this->is_null($this->input->post('ACProductFunction')),
			'base_type' => $type,
			'Firerated' => $this->is_null($this->input->post('Firerated')),
			'driver_type' => $this->is_null($this->input->post('DriverType')),
			'MinWorkingTemperature' => $this->is_null($this->input->post('LuminaryMinWorkingTemperature')),
			'MaxWorkingTemperature' => $this->is_null($this->input->post('LuminaryMaxWorkingTemperature')),
			'PowerType' => $this->is_null($this->input->post('ProductPowerTypeID')),
			'family_shortcut_code' => $this->is_null($this->input->post('FamilyShortcut'))
			);


		$economic_product_id=$this->Global_model->insertDataReturnLastId('economic_product',$economic_product);

		//language
		$product_Language_data=$this->input->post('Language_id');
		$product_language_family_name_data=  $this->input->post('ProductFamily');
		$product_language_family_description_data=  $this->input->post('ProductFamilyDescription');


		if($product_language_family_name_data)
		{
			foreach($product_language_family_name_data as $key =>$value){
				$product_language = array(
					'economic_product_id' => $economic_product_id,
					'Language_id' => $product_Language_data[$key],
					'Family_name' => $value,
					'Family_description' =>$product_language_family_description_data[$key]
					);
				$this->Global_model->insertData('economic_product_language',$product_language);
			}
		}

    	$this->add_application_data($product_id);
		$this->add_certification_data($product_id);
		$this->add_installation_way_data($product_id);
		if($product_id) {
			$validator['success'] = true;
			$validator['messages'] = "Successfully added";
		}
		else {
			$validator['success'] = true;
			$validator['messages'] = "Error when add product .";
		}

		echo json_encode($validator);
	}

	function add_application_data($product_id){
		$product_application_data=  $this->input->post('ApplicationID');
		if($product_application_data)
		{
			foreach($product_application_data as $key =>$value){
				$data = array(
					'ApplicationID' => $value,
					'Product_id' => $product_id
					 );
				$this->Product_model->insert_product_application($data);
			}
		}
	}

	function add_certification_data($product_id){
		$product_certification_data=  $this->input->post('CertificationID');

		if($product_certification_data)
		{
			foreach($product_certification_data as $key =>$value){
				$data = array(
					'CertificationID' => $value,
					'Product_id' => $product_id
					 );
				$this->Product_model->insert_product_certification($data);
			}
		}
	}

	function add_installation_way_data($product_id){

		if($product_id){
			//insert action
			$installation_way_option=$this->input->post('InstallationWayID');
			foreach ($installation_way_option as $key => $value) {
				//upload photo 
				/*$file_name = $this->upload_file('./assets/App_files/Product/Premium/'.$product_id,'application_'.$product_id.'_'.$value,'application_photo_installation_'.$value);*/
				$installation_data = array( 'installation_way_id' => $value,
										 'product_id' => $product_id
									);
				$this->Product_model->insert_product_installation_way($installation_data);
			}
		}
	}

	function test()
	{
		echo $this->Economic_product_model->get_product_id_by_economic_id(22);
	}

	function get_post_data_economic_collection()
	{
		$economic_product_id = $this->input->post('economic_product_id');
		$product_id=$this->Economic_product_model->get_product_id_by_economic_id($economic_product_id);

		// add color series
		if ($this->input->post('Fitting_color_series_id')) {
			$color_series_id = $this->input->post('Fitting_color_series_id');
		}
		else{
			$data = array('fitting_series_image' => null);
			$color_series_id = $this->Fitting_color_model->insert_color_series($data);
			foreach ($this->input->post('PlaceID') as $key_color_details => $value_color_details) {
				$data = array(
					'FittingPartID' => $value_color_details,
					'color_texture_id' => $this->input->post('TextureID')[$key_color_details],
					'Fitting_color_series_id' => $color_series_id
				);
				$this->Fitting_color_model->insert_fitting_color($data);
			}
		}

		// add lighting distributor
		if ($this->input->post('lighting_distributor_series_id')) {
			$distributor_series_id = $this->input->post('lighting_distributor_series_id');
		}
		else{
			$data = array('value' => NULL );
			$distributor_series_id = $this->Fitting_model->insert_fitting_lighting_distribution_series($data);

			foreach ($this->input->post('LightingDistributionKindID') as $key_distributor_details => $value_distributor_details) {
				$data = array(
					'LightingDistributionKindID' => $value_distributor_details,
					'LightingDistributionTextureID' => $this->input->post('LightingDisturbationTextureID')[$key_distributor_details],
					'lighting_distributor_series_id' => $distributor_series_id
				);
				$this->Fitting_model->insert_fitting_lighting_distribution($data);
			}
		}

		//color_series_photo
		if (isset($_FILES['color_series_photo'])) {
			$color_series_photo = $this->global_function->upload_file('./../rafeed-includes/upload_files/Product/Economic/'.$product_id,'color_series_photo','color_series_photo')	;
		}

		$data = array(
				'economic_product_id' => $economic_product_id, 
				'Length' => $this->is_null($this->input->post('length')), 
				'Width' => $this->is_null($this->input->post('width')), 
				'Height' => $this->is_null($this->input->post('height')), 
				'Radius' => $this->is_null($this->input->post('diameter')),
				"Cut_out" => $this->is_null($this->input->post('cut_out')),
				'FittingShapeID' => $this->is_null($this->input->post('shape')), 
				'AdjustableType' =>$this->is_null($this->input->post('AdjustableType')), 
				'TiltedHMin' => $this->is_null($this->input->post('THMin')), 
				'TiltedHMax' => $this->is_null($this->input->post('THMax')), 
				'TiltedVMin' => $this->is_null($this->input->post('TVMin')), 
				'TiltedVMax' => $this->is_null($this->input->post('TVMax')), 
				'RotatedHMin' => $this->is_null($this->input->post('RHMin')), 
				'RotatedHMax' => $this->is_null($this->input->post('RHMax')), 
				'RotatedVMin' => $this->is_null($this->input->post('RVMin')), 
				'RotatedVMax' => $this->is_null($this->input->post('RVMax')),
				'Weight' => $this->is_null($this->input->post('weight')),
				'Led_id' => $this->input->post('led_isnull') == 0 ? NULL : $this->is_null($this->input->post('led_id')),
				'CCT' => $this->is_null($this->input->post('CCT')),
				'CRI' => $this->is_null($this->input->post('CRI')),
				'Multiple_ip' => $this->is_null($this->input->post('IP_check_checkbox')),
				'Front_ip' => $this->is_null($this->input->post('FittingFrontIP')),
				'Back_ip' => $this->is_null($this->input->post('FittingBackIP')),
				'IP' => $this->is_null($this->input->post('FittingSingleIP')),
				'IK' => $this->is_null($this->input->post('FittingIK')),
				'Power' => $this->is_null($this->input->post('LuminaryPowerDown')),
				'Power_up' => $this->is_null($this->input->post('LuminaryPowerUp')),
				'Current' => $this->is_null($this->input->post('LuminaryCurrent')),
				'frequency' => $this->is_null($this->input->post('frequency')),
				'Lumen' => $this->is_null($this->input->post('LuminaryLumen')),
				'SymmetricBeam' => $this->is_null($this->input->post('SymmetricBeam')),
				'BeamAngleH' => $this->is_null($this->input->post('BeamAngleH')),
				'BeamAngleV' => $this->is_null($this->input->post('BeamAngleV')),
				'BeamAngleValue' => $this->is_null($this->input->post('BeamAngleValue')),
				'UGRRate' => $this->is_null($this->input->post('UGRRate')),
				'lighting_distributor_series_id' => $distributor_series_id,
				'Fitting_color_series_id' => $color_series_id,
				'color_series_photo' => isset($color_series_photo) ? $color_series_photo : NULL ,
				'Led_id' =>  $this->input->post('driver_isnull') == 0 ? NULL : $this->is_null($this->input->post('led')),
				'driver_id' => $this->is_null($this->input->post('driver')),
				'InputVoltageMin' => $this->is_null($this->input->post('InputVoltageMin')),
				'InputVoltageMax' => $this->is_null($this->input->post('InputVoltageMax')),
				'PowerFactor' => $this->is_null($this->input->post('power_factor')),
				'reference_code' => $this->is_null($this->input->post('Code')),
				'PCB_description' => $this->is_null($this->input->post('PCB_description')),
				'supplier_id' => $this->is_null($this->input->post('Fitting_supplierID')),
				'warranty' => $this->is_null($this->input->post('Warranty')),
				'lifespan' => $this->is_null($this->input->post('LifeSpan')),
				'price' => $this->is_null($this->input->post('price')),
				'voltage_type_id' => $this->is_null($this->input->post('VoltageTypeID'))
			);

		return $data;
	}

	function add_economic_collection()
	{
		$config = array(
			 array(
		        'field' => 'shape',
		        'label' => 'Shape',
		        'rules' => 'required|is_natural'
		    ),
		    array(
		        'field' => 'LuminaryPowerDown',
		        'label' => 'Power Down',
		        'rules' => 'required'
		    ),
		    array(
		        'field' => 'LuminaryPowerUp',
		        'label' => 'Power Up',
		        'rules' => 'required'
		    ),
		    array(
		    	'field' => 'LuminaryLumen',
		        'label' => 'Lumen',
		        'rules' => 'required'
		    ),
		   /* array(
		    	'field' => 'basic_CCT_option',
		        'label' => 'CCT',
		        'rules' => 'required|is_natural'
		    ),
		    array(
		        'field' => 'basic_CRI_option',
		        'label' => 'CRI',
		        'rules' => 'required|is_natural'
		    ),*/
		    array(
		    	'field' => 'Code',
		        'label' => 'Code',
		        'rules' => 'required'
		    ),
		    array(
		    	'field' => 'price',
		        'label' => 'Price',
		        'rules' => 'required'
		    )
		);

		$this->form_validation->set_rules($config);
		
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if($this->form_validation->run() === true) {
			$data = $this->get_post_data_economic_collection();
			$collection_id = $this->Global_model->insertDataReturnLastId('economic_product_collection',$data);

			//upload photo
			$economic_product_id = $this->input->post('economic_product_id');
			$product_id=$this->Economic_product_model->get_product_id_by_economic_id($economic_product_id);

			$product_photo_type_id = $this->Product_model->get_product_photo_type_attachment();
			$dimension_photo_type_id = $this->Product_model->get_dimension_photo_type_attachment();
			
			
			

			if (isset($_FILES['dimension_photo'])) {
				$dimension_photo = $this->upload_multiple_file('./../rafeed-includes/upload_files/Product/Economic/'.$product_id,'dimension_photo','dimension_photo');
			}
			if (isset($_FILES['product_photo'])) {
				$product_photo = $this->upload_multiple_file('./../rafeed-includes/upload_files/Product/Economic/'.$product_id,'product_photo','product_photo');
			}
			//upload IES file
			if (isset($_FILES['ies_file'])) {
				$ies_file = $this->global_function->upload_file('./../rafeed-includes/upload_files/Product/Economic/'.$product_id,'ies_file','ies_file');
				$ies_file_type_id = $this->Product_model->get_product_photo_type_attachment('IES file');
			}
			if (isset($_FILES['dialog_study_file'])) {
				$dailog_study_file = $this->global_function->upload_file('./../rafeed-includes/upload_files/Product/Economic/'.$product_id,'dialog_study_file','dialog_study_file');
				$diaalog_study_file_type_id = $this->Product_model->get_product_photo_type_attachment('Dialog study');
			}

			if (isset($_FILES['lux_file'])) {
				$lux_file = $this->global_function->upload_file('./../rafeed-includes/upload_files/Product/Economic/'.$product_id,'lux_file','lux_file');
				$lux_file_type_id = $this->Product_model->get_product_photo_type_attachment('Lux file');
			}
			if (isset($_FILES['photo_mertic_report'])) {
				$photo_mertic_report = $this->global_function->upload_file('./../rafeed-includes/upload_files/Product/Economic/'.$product_id,'photo_mertic_report','photo_mertic_report');
				$photo_mertic_report_type_id = $this->Product_model->get_product_photo_type_attachment('Photo metric report');
			}

			if (isset($_FILES['pcb_design_file'])) {
				$pcb_design_file = $this->global_function->upload_file('./../rafeed-includes/upload_files/Product/Economic/'.$product_id,'pcb_design_file','pcb_design_file');
				$PCB_design_file_type_id = $this->Product_model->get_product_photo_type_attachment('PCB design file');
			}

			foreach ($dimension_photo as $key_photo => $value_photo) {
				$data= array(
					'economic_product_collection_id' => $collection_id, 
					'AttachmentTypeID' => $dimension_photo_type_id, 
					'FileName' => $value_photo
				);
				$this->Global_model->insertData('economic_product_collection_attachment',$data);
			}
			
			foreach ($product_photo as $key_photo => $value_photo) {
				$data= array(
					'economic_product_collection_id' => $collection_id, 
					'AttachmentTypeID' => $product_photo_type_id, 
					'FileName' => $value_photo
				);
				$this->Global_model->insertData('economic_product_collection_attachment',$data);
			}

			if ($dailog_study_file) {
				$data= array(
					'economic_product_collection_id' => $collection_id, 
					'AttachmentTypeID' => $diaalog_study_file_type_id, 
					'FileName' => $dailog_study_file
				);
				$this->Global_model->insertData('economic_product_collection_attachment',$data);
			}
			

			if ($ies_file) {
				$data= array(
					'economic_product_collection_id' => $collection_id, 
					'AttachmentTypeID' => $ies_file_type_id, 
					'FileName' => $ies_file
				);
				$this->Global_model->insertData('economic_product_collection_attachment',$data);
			}

			if ($lux_file) {
				$data= array(
					'economic_product_collection_id' => $collection_id, 
					'AttachmentTypeID' => $lux_file_type_id, 
					'FileName' => $lux_file
				);
				$this->Global_model->insertData('economic_product_collection_attachment',$data);
			}

			if ($photo_mertic_report) {
				$data= array(
					'economic_product_collection_id' => $collection_id, 
					'AttachmentTypeID' => $photo_mertic_report_type_id, 
					'FileName' => $photo_mertic_report
				);
				$this->Global_model->insertData('economic_product_collection_attachment',$data);
			}

			if ($pcb_design_file) {
				$data= array(
					'economic_product_collection_id' => $collection_id, 
					'AttachmentTypeID' => $PCB_design_file_type_id, 
					'FileName' => $pcb_design_file
				);
				$this->Global_model->insertData('economic_product_collection_attachment',$data);
			}

			//add Product Accessory
			
			$product_accessory=$this->input->post('AccessoryID');
			if($product_accessory)
			foreach ($product_accessory as $key_acc => $value_acc) {
				if (!($value_acc=='')) {
					$data = array(
						'economic_product_collection_id' => $collection_id,
						'accessory_id' => $value_acc
				 	);
				 	$this->Global_model->insertData('economic_product_collection_accessory',$data);
			 	}
			}

			$validator['success'] = true;
			$validator['url'] = site_url('/Economic_product/collection_grid_view/'.$economic_product_id);
		}
		else {
			$validator['success'] = false;
			foreach ($_POST as $key => $value) {
				$validator['messages'][$key] = form_error($key);	
			}			
		}

		echo json_encode($validator);
		// go back to grid
	}

	function edit_economic_collection()
	{
		$validator = array('success' => false, 'messages' => array());
		$config = array(
			array(
		        'field' => 'shape',
		        'label' => 'Shape',
		        'rules' => 'required|is_natural'
		    ),
		    array(
		        'field' => 'LuminaryPowerDown',
		        'label' => 'Power Down',
		        'rules' => 'required'
		    ),
		    array(
		        'field' => 'LuminaryPowerUp',
		        'label' => 'Power Up',
		        'rules' => 'required'
		    ),
		    array(
		    	'field' => 'LuminaryLumen',
		        'label' => 'Lumen',
		        'rules' => 'required'
		    ),
		    array(
		    	'field' => 'price',
		        'label' => 'Price',
		        'rules' => 'required'
		    )
		);

		$this->form_validation->set_rules($config);
		
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		if($this->form_validation->run() === true) {
			$data = $this->get_post_data_economic_collection();
			$id=$this->input->post('economic_product_collection_id');
			unset($data['reference_code']);

			$this->Global_model->updateData('economic_product_collection',$data,$id);

			$validator['success'] = true;
			$validator['url'] = site_url('/Economic_product/collection_grid_view/'.$data['economic_product_id']);
		}
		else {
			$validator['success'] = false;
			foreach ($_POST as $key => $value) {
				$validator['messages'][$key] = form_error($key);	
			}			
		}

		echo json_encode($validator);
			
	}

	function upload_multiple_file($path,$file_name,$element)
	{
		$uploadImgData = array();
		//if (isset($_FILES[$element])) {
		//if( !empty($_FILES[$element]['tmp_name']) && is_uploaded_file($_FILES[$element]['tmp_name'])){
			$image = array();
			$ImageCount = count($_FILES[$element]['name']);
		    for($i = 0; $i < $ImageCount; $i++){
		        $_FILES['file']['name']       = $_FILES[$element]['name'][$i];
		        $_FILES['file']['type']       = $_FILES[$element]['type'][$i];
		        $_FILES['file']['tmp_name']   = $_FILES[$element]['tmp_name'][$i];
		        $_FILES['file']['error']      = $_FILES[$element]['error'][$i];
		        $_FILES['file']['size']       = $_FILES[$element]['size'][$i];

		        // File upload configuration

		        $config['upload_path'] = $path;
		        $config['file_name'] = $file_name.$i;
		        $config['allowed_types'] = '*';

		        if (!is_dir($path))
			    {
			        mkdir($path, 0777, true);
			    }
			    
		        // Load and initialize upload library
		        $this->load->library('upload', $config);
		        $this->upload->initialize($config);



		        // Upload file to server
		        if($this->upload->do_upload('file')){
		            // Uploaded file data
		            $imageData = $this->upload->data();
		            $uploadImgData[$i] = $imageData['file_name'];

		        }
		    }
		//}
	    return ($uploadImgData);
	}

	function upload_file($path,$file_name,$element)
	{
		$file=null;
		
        // File upload configuration
        
        $config['upload_path'] = $path;
        $config['file_name'] = $file_name;
        $config['overwrite'] = TRUE;
        $config['allowed_types'] = '*';

		if (!is_dir($path))
		{
			mkdir($path, 0777, true);
		}

        // Load and initialize upload library
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        // Upload file to server
        if($this->upload->do_upload($element)){
            // Uploaded file data
            $imageData = $this->upload->data();
            $file = $imageData['file_name'];

		}
		/*else
	    {
	    	$output = array('error' => $this->upload->display_errors());
            $this->load->view('empty_page', $output);
		}*/

        return $file;
	}

	function set_economic_product_collection_code($economic_id)
	{
		$product_data=$this->Economic_product_model->get_economic_coding_data($economic_id);
		if ($product_data) {

			$serial=$this->Product_model->get_collection_serial('economic_product_collection');
			//$serial=17995;
			$serial++;
			$is_development_product = 0;
			foreach ($product_data as $key => $value) {
				$data = array(
					'product_number' => $this->product_coding->get_economic_number($value['family_shortcut_code'],$value['CCT'],$serial,$is_development_product),
					'serial_num' => $serial
				);
				//update 
				$editMember = $this->Global_model->updateData('economic_product_collection',$data,$value['ID']);
				$serial++;
			}

			if($editMember === true) {
				//update the family check review to true value.
				$data = array('Review_check' => 1);
				$this->Global_model->updateData('economic_product',$data,$economic_id);
				$validator['success'] = true;
				$validator['messages'] = "Successfully updated";
			} else {
				$validator['success'] = false;
				$validator['messages'] = "Error while updating the infromation";
			}	
		}
		else {
			$validator['success'] = false;
			$validator['messages']['error_msg']='Sorry, this family doesn`t have any option!' ;
		}
		echo json_encode($validator);
	}
}
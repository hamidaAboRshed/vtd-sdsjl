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
	}
 
	public function index()
	{
		if($this->user_validate->check_login())
		{
			$data['output'] = '';
			$array = array();
			$array['grid_header'] = array(
				'Family name' ,
				'Category',
				'Working Temperature',
				'Life Span',
				'Warranty',
				'Supplier',
				'Review Check',
				'Options');

			$array['read_action'] = '../Economic_product/fetchEchonomicFamiliesData/';

			$data['ProductType']=$this->Enums->get_ProductType();
			$data['Supplier']=$this->Index_model->get_index('supplier');
			$data['Application']=$this->Index_model->get_index_language('application');
			$data['Certification']=$this->Index_model->get_index('certification');
			$data['Language']=$this->Index_model->get_index('language');
			$data['InstallationWay']=$this->Index_model->get_index_language('installation_way');
			$data['ProductPowerType']=$this->Enums->get_ProductPowerType();

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
			    .'<li><a type="button" class="" href="./Print_pdf/economic_family_report/'.$value['ProductId'].'"  target="_blank">View Report</a></li>
			    <li><a type="button" class="" href="./collection_grid_view/'.$value['economic_product_id'].'">View Collection</a></li>
			  </ul>
			</div>
			';

			
			$result['data'][$key] = array(	
				$value['Family_name'],
				$this->Index_model->get_value_by_id('product_category',$value['ProductCategoryID']),
				$this->global_function->get_range($value['MinWorkingTemperature'],$value['MaxWorkingTemperature']),
				$value['LifeSpan'],
				$value['Warranty'],
				$this->Index_model->get_value_by_id('supplier',$value['SupplierID']),
				'<div class="check-icon"><i class="fa '.($value['Review_check']==1? 'fa-check-circle' : 'fa-circle').'"></i></div>',
				$buttons);
		} 
		echo json_encode($result);
	}

	function collection_grid_view($economic_product_id){
		$data['output'] = '';
		$array = array();
		$array['grid_header'] = array(
			'Code' ,
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
			'Lighting Disturbation',
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

			$result['data'][$key] = array(	
				$value['product_code'],
				$this->Index_model->get_value_by_id('shape',$value['FittingShapeID']),
				$value['Power'],
				$value['Current'],
				(is_null($this->Enums->get_CCTRangeValues_byId($value['CCT'])) ? $value['CCT'] : $this->Enums->get_CCTRangeValues_byId($value['CCT'])),
				$value['CRI'],
				$value['Lumen'],
				($value['Multiple_ip'] == 0 ? $value['IP'] : $value['Front_ip'].'/'.$value['Back_ip']),
				$value['IK'],
				($value['SymmetricBeam']==1 ? $value['BeamAngleValue'] : $this->global_function->get_range($value['BeamAngleH'],$value['BeamAngleV'])),
				$value['PowerFactor'],
				$fitting_color_data,
				1,
				$value['price'],
				$buttons);
		}
		echo json_encode($result);
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
		if($this->Economic_product_model->get_collection_id_by_code($this->input->post('code'))>0)
		{
			echo json_encode(true) ;
		}
		else
			echo json_encode(False);
	}

	function add_family_collection($economic_product_id='')
	{
		$queries = array();
		parse_str($_SERVER['QUERY_STRING'], $queries);
		$data['economic_product_id'] = $queries['id'];
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

		$data['ProductPowerType']=$this->Enums->get_ProductPowerType();

		$data['CCT_option']=$this->LED_model->get_CCT_option();
		$data['CCT_static_option'] = $this->Enums->get_CCTRangeValues();

		$data['CRI_option']=$this->Index_model->get_index('cri_option');
		/*$data['AttachmentType'] = array(
			'Main photo (application)' ,
			'CAD (2D)',
			'CAD (3D)',
			'Certificate'
			 );*/

		$data['LEDType']=$this->Index_model->get_index('led_type');

		//enum
		// light source
		$data['LightingSource']=$this->Enums->get_BaseFixture();
		$data['AdjustableType']=$this->Enums->get_AdjustableType();
		$data['AccessoryType']=$this->Enums->get_AccessoryType();
		
		$data['FittingAccessory']=$this->Fitting_model->get_accessory();

		$subview='add_economic_product_collection';
		$data['output'] = '';
		/*$data['output1'] = ''$this->get_driver_data();
		$data['output2'] = $this->get_led_data();*/
		//$data['output']->output = str_replace('class="print-icon crud-action"', 'class="print-icon crud-action" target="_blank"', $data['output']->output); // additional line
		$this->breadcrumbs->push('Economic product', '/Economic_product/index');
		$this->breadcrumbs->push('Economic product collection', '/Economic_product/collection_grid_view/'.$queries['id']);
		$this->breadcrumbs->push('Add economic product collection', '/Economic_product/add_family_collection?id='.$queries['id']);
		$data['breadcrumb'] = $this->breadcrumbs->show();
		$data['subview'] = $subview;
		$data['pageTitle']='Add Economic Product';
		$this->load->view('layouts/layout',$data);
	}

	function add_family()
	{	
		$validator = array('success' => false, 'messages' => array());
		//delete all null data
		//$_POST = array_filter($_POST);

		foreach($_POST as $key => $stuff ) {
		    $_POST[$key]=$this->global_function->is_null($stuff);
		     if(is_array( $stuff ) ) {
		        foreach( $stuff as $subKey => $thing ) {
		            $stuff[$subKey]==$this->global_function->is_null($thing);
		        }
		    }
	    }
	    //add product
		if($this->session->userdata('Full_name'))
			$username=$this->session->userdata('Full_name');
		else 
			$username=$this->User_model->get_default_username();
		$format = "%Y-%m-%d %H:%i";
		$series_data = array(
			'ProductCategoryID' => $this->global_function->is_null($this->input->post('ProductCatID')),
			'CreatedBy'=>$username,
			'CreatedDate'=>mdate($format)
			);

		$product_id=$this->Product_model->insert($series_data);
		
		//add economic product
		$economic_product = array(
			'ProductId' => $product_id,
			'Firerated' => $this->global_function->is_null($this->input->post('Firerated')),
			'MinWorkingTemperature' => $this->global_function->is_null($this->input->post('LuminaryMinWorkingTemperature')),
			'MaxWorkingTemperature' => $this->global_function->is_null($this->input->post('LuminaryMaxWorkingTemperature')),
			'LifeSpan' => $this->global_function->is_null($this->input->post('LifeSpan')),
			'Warranty' => $this->global_function->is_null($this->input->post('Warranty')),
			'PowerType' => $this->global_function->is_null($this->input->post('ProductPowerTypeID')),
			'SupplierID' => $this->global_function->is_null($this->input->post('Fitting_supplierID'))
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
				/*$file_name = $this->upload_file('./../rafeed-includes/upload_files/Product/Premium/'.$product_id,'application_'.$product_id.'_'.$value,'application_photo_installation_'.$value);*/
				$installation_data = array( 'installation_way_id' => $value,
										 'product_id' => $product_id
									);
				$this->Product_model->insert_product_installation_way($installation_data);
			}
		}
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
		    	'field' => 'Weight',
		        'label' => 'Weight',
		        'rules' => 'required'
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
		        'field' => 'serial_num',
		        'label' => 'Serial number',
		        'rules' => 'required'
		    ),
		    array(
		    	'field' => 'Code',
		        'label' => 'Code',
		        'rules' => 'required'
		    ),
		    array(
		        'field' => 'power_factor',
		        'label' => 'Power Factor',
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
			$type='';
			switch ($this->input->post('LightSourceTypeID')) {
				case 1:
					$type=$this->input->post('led_type_ID');
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
			$economic_product_id = $this->input->post('economic_product_id');
			// add color series

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

			// add lighting distributor

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

			//upload IES file
			if (isset($_FILES['ies_file'])) {
				$ies_file = $this->global_function->upload_file('./../rafeed-includes/upload_files/Product/Economic/'.$economic_product_id,'ies_file','ies_file');
			}
			
			
			//color_series_photo
			if (isset($_FILES['color_series_photo'])) {
				$color_series_photo = $this->global_function->upload_file('./../rafeed-includes/upload_files/Product/Economic/'.$economic_product_id,'color_series_photo','color_series_photo')	;
			}

			$data = array(
					'economic_product_id' => $economic_product_id, 
					'Length' => $this->global_function->is_null($this->input->post('length')), 
					'Width' => $this->global_function->is_null($this->input->post('width')), 
					'Height' => $this->global_function->is_null($this->input->post('height')), 
					'Radius' => $this->global_function->is_null($this->input->post('diameter')),
					"Cut_out" => $this->global_function->is_null($this->input->post('cut_out')),
					'FittingShapeID' => $this->global_function->is_null($this->input->post('shape')), 
					'AdjustableType' =>$this->global_function->is_null($this->input->post('AdjustableType')), 
					'TiltedHMin' => $this->global_function->is_null($this->input->post('THMin')), 
					'TiltedHMax' => $this->global_function->is_null($this->input->post('THMax')), 
					'TiltedVMin' => $this->global_function->is_null($this->input->post('TVMin')), 
					'TiltedVMax' => $this->global_function->is_null($this->input->post('TVMax')), 
					'RotatedHMin' => $this->global_function->is_null($this->input->post('RHMin')), 
					'RotatedHMax' => $this->global_function->is_null($this->input->post('RHMax')), 
					'RotatedVMin' => $this->global_function->is_null($this->input->post('RVMin')), 
					'RotatedVMax' => $this->global_function->is_null($this->input->post('RVMax')),
					//'Dim_photo' => NULL,//isset($uploadImgData['dimension_photo'][$key]) ? $uploadImgData['dimension_photo'][$key] : NULL, 
					//'product_photo' => NULL,//isset($uploadImgData['product_photo'][$key]) ? $uploadImgData['product_photo'][$key] : NULL,
					'Weight' => $this->global_function->is_null($this->input->post('weight')),
					'Led_id' => $this->input->post('led_isnull') == 0 ? NULL : $this->global_function->is_null($this->input->post('led_id')),
					'CCT' => $this->global_function->is_null($this->input->post('CCT')),
					'CRI' => $this->global_function->is_null($this->input->post('CRI')),
					'Multiple_ip' => $this->global_function->is_null($this->input->post('IP_check_checkbox')),
					'Front_ip' => $this->global_function->is_null($this->input->post('FittingFrontIP')),
					'Back_ip' => $this->global_function->is_null($this->input->post('FittingBackIP')),
					'IP' => $this->global_function->is_null($this->input->post('FittingSingleIP')),
					'IK' => $this->global_function->is_null($this->input->post('FittingIK')),
					'Power' => $this->global_function->is_null($this->input->post('LuminaryPowerDown')),
					'Power_up' => $this->global_function->is_null($this->input->post('LuminaryPowerUp')),
					'Current' => $this->global_function->is_null($this->input->post('LuminaryCurrent')),
					'Lumen' => $this->global_function->is_null($this->input->post('LuminaryLumen')),
					'SymmetricBeam' => $this->global_function->is_null($this->input->post('SymmetricBeam')),
					'BeamAngleH' => $this->global_function->is_null($this->input->post('BeamAngleH')),
					'BeamAngleV' => $this->global_function->is_null($this->input->post('BeamAngleV')),
					'BeamAngleValue' => $this->global_function->is_null($this->input->post('BeamAngleValue')),
					'UGRRate' => $this->global_function->is_null($this->input->post('UGRRate')),
					'lighting_distributor_series_id' => $distributor_series_id,
					'Fitting_color_series_id' => $color_series_id,
					'IES_file' => isset($ies_file) ? $ies_file : NULL ,
					'color_series_photo' => isset($color_series_photo) ? $color_series_photo : NULL ,
					'LightingSourceID' => $this->global_function->is_null($this->input->post('LightSourceTypeID')),
					'Type' => $type,
					'Led_id' =>  $this->input->post('driver_isnull') == 0 ? NULL : $this->global_function->is_null($this->input->post('led')),
					'driver_id' => $this->global_function->is_null($this->input->post('driver')),
					'InputVoltageMin' => $this->global_function->is_null($this->input->post('InputVoltageMin')),
					'InputVoltageMax' => $this->global_function->is_null($this->input->post('InputVoltageMax')),
					'PowerFactor' => $this->global_function->is_null($this->input->post('power_factor')),
					'product_code' => $this->global_function->is_null($this->input->post('Code')),
					'price' => $this->global_function->is_null($this->input->post('price')),
					'serial_num' => $this->global_function->is_null($this->input->post('serial_num'))
				);
			$this->Global_model->insertData('economic_product_collection',$data);
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

	}
}
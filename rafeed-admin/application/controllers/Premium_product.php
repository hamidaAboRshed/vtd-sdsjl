<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Premium_product extends CI_Controller {

	function __construct()
	{
        parent::__construct();
		 
		$this->load->database();
		$this->load->helper('url');
		//$this->load->library('breadcrumbs');
		//$this->load->library('breadcrumbcomponent');
		/* ------------------ */ 
		 // load Breadcrumbs
		//$this->load->library('breadcrumbs');

		$this->load->library('grocery_CRUD');
		$this->load->model('Premium_product_model');
	 	$this->load->model('Installation_way_model');
	 	$this->load->model('Fitting_color_model');
	 	$this->load->model('ProductSeries_model');
	 	$this->load->model('Product_model');
	 	$this->load->model('Fitting_model');
	 	$this->load->model('Driver_model');
	 	$this->load->model('LED_model');
	 	$this->load->model('Index_model');
	 	$this->load->model('Enums');
	 	$this->load->model('Global_model');
	 
	}

	public function fetchMemberData($filter) 
	{
		$result = array('data' => array());

		if ($filter == -1) {
			$data = $this->Premium_product_model->fetchMemberData();	
		}
		else
			if ($filter == -2) {
				$data = $this->Premium_product_model->fetchMemberData_byUser();	
			}
			else
				$data = $this->Premium_product_model->fetchMemberData_bySolutionType($filter,"");			
			
		$default_language=$this->Index_model->get_default_language();
		
		foreach ($data as $key => $value) {
			
			// button
			$buttons = '
			<div class="btn-group">
			  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    Action <span class="caret"></span>
			  </button>
				<ul class="dropdown-menu">'.($value['Review_check']==0?
				'<li><a type="button" class="" onclick="checkPremiumProduct('.$value['Premium_product_id'].')" data-toggle="modal" data-target="#checkPremiumProductModal">Review Check</a></li>' : '')
				.'<li><a type="button" class="" onclick="change_family_order('.$value['Premium_product_id'].')" data-toggle="modal" data-target="#premiumFamilyOrderModal">Change family display order</a></li>'
				.'<li><a type="button" class="" onclick="change_family_description('.$value['Premium_product_id'].',\'Family_description\')" data-toggle="modal" data-target="#premiumFamilyDescriptionModal">Change family description</a></li>'
				.'<li><a type="button" class="" onclick="change_family_description('.$value['Premium_product_id'].',\'datasheet_description\')" data-toggle="modal" data-target="#premiumFamilyDescriptionModal">Change family datasheet description</a></li>'
				.'<li><a type="button" class="" onclick="update_color_series_photo('.$value['ProductId'].')" data-toggle="modal" data-target="#colorSeriesPhotoModal">change color series photo</a></li>'
				.'<li><a type="button" class="" onclick="upload_photos('.$value['ProductId'].')" data-toggle="modal" data-target="#uploadPhotosModal">Add attach file</a></li>'
				.'<li><a type="button" class="" onclick="updateApplicationPhoto('.$value['ProductId'].')" data-toggle="modal" data-target="#uploadApplicationPhotosModal">Change application photo</a></li>'
			    .'<li><a type="button" class="" href="./Print_pdf/premium_family_report/'.$value['ProductId'].'"  target="_blank">View Report</a></li>
			    <li><a type="button" class="" href="./Premium_product/dimension_grid_view/'.$value['Premium_product_id'].'">View Dimension</a></li>
			    <li><a type="button" class="" onclick="deletePremiumProduct('.$value['ProductId'].')" data-toggle="modal" data-target="#deletePremiumProductModal">Delete</a></li>
			  </ul>
			</div>
			';
			
			$_sol_val='';
			if (is_null($value['ProductSolutionID'])) {
	           $sol_str='';
	            $solution_data = $this->Product_model->get_product_solution($value['ProductId'],$default_language);

	            foreach ($solution_data as $key_sol => $value_sol) {
	                $sol_str .= $value_sol['Name'];
	                if($key_sol !== count($solution_data) -1 )
	                {
	                    $sol_str.=' & ';
	                }
	            }
	            $_sol_val = $sol_str; 
	        }
	        else
	            $_sol_val = $this->Index_model->get_value_by_id("solution",$value['ProductSolutionID']);


			$result['data'][$key] = array(	
				$value['Family_name'],
				$this->Index_model->get_value_by_id('product_category',$value['ProductCategoryID']),
				$_sol_val,
				$this->Index_model->get_value_by_id('premium_type',$value['PremiumTypeID']),
				$this->Enums->get_BaseFixture_byId($value['LightingSource']),
				$this->get_range($value['MinWorkingTemperature'],$value['MaxWorkingTemperature']),
				$value['LifeSpan'],
				$value['Warranty'],
				$this->Index_model->get_value_by_id('supplier',$value['SupplierID']),
				'<div class="check-icon"><i class="fa '.($value['Review_check']==1? 'fa-check-circle' : 'fa-circle').'"></i></div>',
				$buttons);
		} // /foreach

		echo json_encode($result);
	}

	function fetchFamilyDimensionData($premium_id)
	{
		$result = array('data' => array());

		$data = $this->Premium_product_model->get_premium_dimension($premium_id);

		foreach ($data as $key => $value) {
			
			// button
			$buttons = '
			<div class="btn-group">
			  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    Action <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu">
			    <li><a type="button" class="" onclick="upload_photos('.$premium_id.','.$value['ID'].',\'product\')" data-toggle="modal" data-target="#uploadPhotosModal" >Upload product photos</a></li>
			  	<li><a type="button" class="" onclick="upload_photos('.$premium_id.','.$value['ID'].',\'product dimension\')" data-toggle="modal" data-target="#uploadPhotosModal" >Upload dimension photos</a></li>
			  	<li><a type="button" class="" onclick="updatePricesModal('.$value['ID'].')" data-toggle="modal" data-target="#updatePricesModal" >Update dimension prices</a></li>
			    <li><a type="button" class="" href="../collection_grid_view/'.$value['ID'].'">View Collection</a></li>
			  </ul>
			</div>
			';
			$adjustable_value='';
			switch ($this->Enums->get_AdjustableType_byId($value['AdjustableType'])) {
				case 'Tilted':
				  $adjustable_value = ' '. $value['TiltedVMin'] .' - '. $value['TiltedVMax']. ' [V] /'. $value['TiltedHMin'] .' - '. $value['TiltedHMax'].' [H]';
				  break;
			
				case 'Rotated':
				  $adjustable_value = ' '. $value['RotatedVMin'] .' - '. $value['RotatedVMax']. ' [V] /'. $value['RotatedHMin'] .' - '. $value['RotatedHMax'].' [H]';
				  break;
				case 'Tilted & Rotated':
				  $adjustable_value = ' (Tilted) '. $value['TiltedVMin'] .' - '. $value['TiltedVMax']. ' [V] /'. $value['TiltedHMin'] .' - '. $value['TiltedHMax'].' [H]';
				  $adjustable_value += ' (Rotated) '. $value['RotatedVMin'] .' - '. $value['RotatedVMax']. ' [V] /'. $value['RotatedHMin'] .' - '. $value['RotatedHMax'].' [H]';
				  break;
			  }
			$result['data'][$key] = array(	
				$this->Index_model->get_value_by_id('shape',$value['FittingShapeID']),
				$value['Length'],
				$value['Width'],
				$value['Height'],
				$value['Radius'],
				$value['Phases'],
				$value['Wires'],
				$this->Enums->get_AdjustableType_byId($value['AdjustableType']),
				$adjustable_value,
				$buttons);
		} // /foreach

		echo json_encode($result);
	}

	function fetchFamilyCollectionData($dimension_id)
	{
		$result = array('data' => array());

		$data = $this->Premium_product_model->get_premium_collection_by_dimension_id($dimension_id);

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
			$texture_date = $this->Fitting_color_model->get_color_texture_by_id($value['LightingDistributionTextureID']);
			$fitting_color = $this->Fitting_color_model->get_fitting_color_by_collection_id($value['Fitting_color_series_id']);
			$fitting_color_data='';
			foreach ($fitting_color as $key_fitting => $value_fitting) {
				$fitting_color_data .= '<img hight=30 width=30 src="'.$this->navigation->get_includes_url().'/upload_files/Texture/'.$value_fitting['Texture_photo'].'" />'
							.$value_fitting['color']." / ".$value_fitting['material']." (".$value_fitting['part'].")";
				if($key_fitting !== count($fitting_color) -1 )
					$fitting_color_data.='</br>';
			}
			$result['data'][$key] = array(	
				$value['Name'],
				$value['Power'],
				(is_null($this->Enums->get_CCTRangeValues_byId($value['CCT'])) ? $value['CCT'] : $this->Enums->get_CCTRangeValues_byId($value['CCT'])),
				$value['CRI'],
				$value['Lumen'],
				($value['Multiple_ip'] == 0 ? $value['IP'] : $value['Front_ip'].'/'.$value['Back_ip']),
				$value['IK'],
				($value['SymmetricBeam']==1? $value['BeamAngleValue'] : $this->get_range($value['BeamAngleH'],$value['BeamAngleV'])),
				$fitting_color_data,
				$this->Index_model->get_value_by_id('lighting_distribution_kind',$value['LightingDistributionKindID']),
				'<img hight=30 width=30 src="'.$this->navigation->get_includes_url().'/upload_files/Texture/'.$texture_date['Texture_photo'].'" />'.
				$this->Index_model->get_value_by_id('material',$texture_date['MaterialID']).' /'.
				$this->Index_model->get_value_by_id('color',$texture_date['ColorID']),
				$this->Index_model->get_value_by_id('installation_way',$value['installation_way_id']),
				$value['price'],
				$buttons);
		} // /foreach

		echo json_encode($result);
	}

	function dimension_grid_view($premium_id){
		$data['output'] = '';
		$array = array();
		$array['grid_header'] = array(
			'Shape' ,
			'Length',
			'Width',
			'Height',
			'Radius',
			'Phases',
			'Wires',
			'AdjustableType',
			'Adjustable H/V',
			'Option');
		$array['read_action'] = '../../Premium_product/fetchFamilyDimensionData/'.$premium_id;
		$array['custom_modal_file'] = 'dimension_grid.php';
		$array['custom_modal_data'] = null;
		$data['grid_body_data']= $array;
		//$data['subview'] = 'view_premium_products.php';

		$this->breadcrumbs->push('Premium product', '/Premium_product');
		$this->breadcrumbs->push('Product Dimension', '/Premium_product/dimension_grid_view/'.$premium_id);
		$data['breadcrumb'] = $this->breadcrumbs->show();
		
		$data['subview'] = 'grid_view.php';
		$data['pageTitle']='Premium Product Table';
		$this->load->view('layouts/layout',$data);
	}

	function collection_grid_view($dimension_id){
		$data['output'] = '';
		$array = array();
		$array['grid_header'] = array(
			'Code' ,
			'Power',
			'CCT',
			'CRI',
			'Lumen',
			'IP',
			'IK',
			'BeamAngle',
			'Fitting Color',
			'Lighting Disturbation kind',
			'Lighting Disturbation Texture',
			'Installation way',
			'Price',
			'Option');
		$array['read_action'] = '../../Premium_product/fetchFamilyCollectionData/'.$dimension_id;
		$data['grid_body_data']= $array;
		//$data['subview'] = 'view_premium_products.php';
		$premium_id= $this->Premium_product_model->get_premium_id_by_dimension_id($dimension_id);

		$this->breadcrumbs->push('Premium product', '/Premium_product');
		$this->breadcrumbs->push('Product Dimension', '/Premium_product/dimension_grid_view/'.$premium_id);
		$this->breadcrumbs->push('Product Collection', '/Premium_product/collection_grid_view/'.$dimension_id);
		$data['breadcrumb'] = $this->breadcrumbs->show();

		$data['subview'] = 'grid_view.php';
		$data['pageTitle']='Premium Product Table';
		$this->load->view('layouts/layout',$data);
	}
	
	function index()
	{
		if($this->user_validate->check_login())
		{
			$data['output'] = '';
			/*$array = array();
			$array['grid_header'] = array(
				'Family name' ,
				'Category',
				'Solution',
				'Premium Type',
				'LightingSource',
				'Working Temperature',
				'Life Span',
				'Warranty',
				'Supplier',
				'Option');*/
			//$array['read_action'] = './Premium_product/fetchMemberData';
			//$data['grid_body_data']= $array;
			$data['subview'] = 'premium_products_grid.php';
			//$data['subview'] = 'grid_view.php';
			// add breadcrumbs
			$this->breadcrumbs->push('Premium product', '/Premium_product');
			// unshift crumb
			//$this->breadcrumbs->unshift('Home', '/');
			$data['filter_options'] = $this->Index_model->get_index_language('solution');

			$data['AttachmentType']=$this->Index_model->get_index_language_not_deleted('attachment_type');
			$data['Language']=$this->Index_model->get_index('language');
			// output
			$data['breadcrumb'] = $this->breadcrumbs->show();
			$data['pageTitle']='Premium Product Table';
			$this->load->view('layouts/layout',$data);
		}
	}

	function get_product_installation_way(){
		$product_id = $this->input->post('id');
		if($product_id){
			$default_language=$this->Index_model->get_default_language();
			$result = $this->Product_model->get_product_installation_way($product_id,$default_language);
			if (!$result) {
				$result = $this->Index_model->get_index_language('installation_way');
			}
			
			echo json_encode($result);
		}
	}

	function get_premium_product_info($id,$solution_id) 
	{
		if($id) {
			if ($solution_id >0 ) {
				$product_data = $this->Premium_product_model->fetchMemberData($id);
				$data_temp = $this->Global_model->getDataTwoColumn('product_solution','solution_id',$solution_id,'product_id',$product_data['ProductId']);
				$data['display_order'] = $data_temp[0]->display_order;
			}
			else
				$data = $this->Premium_product_model->fetchMemberData($id);
			echo json_encode($data);
		}
	}
	function change_family_display_order($premium_id,$solution_id)
	{
		$validator = array('success' => false, 'messages' => array());	
		$config = array(
		    array(
		        'field' => 'family_order',
		        'label' => 'family order',
		        'rules' => 'trim|required'	            
		    )
		);

		$this->form_validation->set_rules($config);

		if($this->form_validation->run() === true) {
			$data = array('display_order' => $this->input->post('family_order'));
			if ($solution_id > 0) {
				//get product id
				$product_data = $this->Premium_product_model->fetchMemberData($premium_id);
				$Member = $this->Premium_product_model->change_premium_product_order_by_solution($product_data['ProductId'],$solution_id,$data);
			}
			else{
				$Member = $this->Global_model->updateData('premium_product',$data,$premium_id);
			}
				
			if($Member === true) {
				$validator['success'] = true;
				$validator['messages'] = "Successfully added";
			} 
			else {
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

	function get_product_family_description($id)
	{
		if($id) {
			$data = $this->Premium_product_model->get_premium_product_language($id,0);
			echo json_encode($data);
		}
	}

	function change_product_family_description($premium_id,$type)
	{
		$validator = array('success' => false, 'messages' => array());	
		if ($premium_id) {

			$premium_product_language= $this->input->post('ProductFamily_language_id[]');
			$ProductFamily= $this->input->post('ProductFamily[]');
			$ProductFamilyDescription= $this->input->post('ProductFamilyDescription[]');
			$Language_id= $this->input->post('Language_id[]');

			foreach ($ProductFamily as $key => $value) {
				if ($premium_product_language[$key]==0) {
					# create new one
					$data = array(
						'Premium_product_id' => $premium_id,
						'Language_id' => $Language_id[$key],
						'Family_name' => $value,
						$type =>$ProductFamilyDescription[$key]
						);
					$Member = $this->Product_model->insert_premium_product_language($data);
				}
				else{
					# update
					$data = array(
						'Family_name' => $value,
						$type =>$ProductFamilyDescription[$key]
						);
					$Member = $this->Global_model->updateData('premium_product_language',$data,$premium_product_language[$key]);
				}
			}

			
				
			if($Member === true) {
				$validator['success'] = true;
				$validator['messages'] = "Successfully added";
			} 
			else {
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

	function get_product_color_series($product_id)
	{
		$color_series_array = $this->Premium_product_model->get_premium_color_series_by_product_id($product_id);
	 	$product_color_series = array_unique(array_column($color_series_array, 'Fitting_color_series_id'));
        $product_color_series_photo = array_unique(array_column($color_series_array, 'color_series_photo'));

        $color_series_data = array();

        foreach ($product_color_series as $key => $value) {
            $color_series_data[$key] = $this->Fitting_color_model->get_fitting_color_by_collection_id($value);
        }
        
        $result = array('color_series_data' =>$color_series_data ,'color_series_photo_data' => $product_color_series_photo,'Product_id' => $product_id ,'base_url' => $this->navigation->get_includes_url()) ;

        echo json_encode($result);
	}

	function change_product_color_series_photo($product_id,$color_series_id)
	{
		$validator = array('success' => false, 'messages' => array());	
		if ($color_series_id) {
			$photo_name='update_color_series_'.$color_series_id;

			$photo = $this->upload_file('./../rafeed-includes/upload_files/Product/Premium/'.$product_id,$photo_name,'file');

			$Member = $this->Premium_product_model->change_color_series_photo($color_series_id,$photo);
				
			if($Member === true) {
				$validator['success'] = true;
				$validator['messages'] = "Successfully added";
			} 
			else {
				$validator['success'] = false;
				$validator['messages'] = "Error while updating the infromation";
			}			
		 
		}
		else {
			$validator['success'] = false;
			$validator['messages']['application_photo']='<p class="text-danger">Please select file</p>';
		}
		
		echo json_encode($validator);	
	}

	function delete_color_series_photo()
	{
		$validator = array('success' => false, 'messages' => array());
		//delete file
		unlink('./../rafeed-includes/upload_files/Product/Premium/'.$this->input->post('Product_id').'/'.$this->input->post('file_name'));

		//delete from database

		$removeMember = $this->Premium_product_model->change_color_series_photo($this->input->post('color_series_id'),null);
		if($removeMember === true) {
			$validator['success'] = true;
			$validator['messages'] = "Successfully added";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while updating the infromation";
		}	
		echo json_encode($validator);	
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
			$photos = $this->upload_file('./../rafeed-includes/upload_files/Product/Premium/'.$product_id,$photo_name,'application_photo');

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
			$photos = $this->upload_file('./../rafeed-includes/upload_files/Product/Premium/'.$product_id,$photo_name,'product_photo');
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
			}
			else {
				$validator['success'] = false;
				$validator['messages']['product_photo']='<p class="text-danger">Please select file</p>';
			}

		
		echo json_encode($validator);
	}

	function change_product_photo($premium_id , $dimension_id, $type)
	{
		$validator = array('success' => false, 'messages' => array());
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if (isset($_FILES['product_photo'])) {
			$createMember=false;

			$product_id = $this->Premium_product_model->get_product_id_by_premium_id($premium_id);
			$photo_name='';
			if($type=="product"){
				$product_photo_type_id = $this->Product_model->get_product_photo_type_attachment();
				$photo_name = 'upldate_product_photo_';
			}
			else{
				$product_photo_type_id = $this->Product_model->get_dimension_photo_type_attachment();
				$photo_name = 'upldate_dimension_photo_';
			}

			$product_files = $this->Premium_product_model->get_premium_dimension_attachment($product_photo_type_id,$dimension_id);
			foreach ($product_files as $key => $value) {
				unlink('./../rafeed-includes/upload_files/Product/Premium/'.$product_id.'/'.$value['FileName']);
			}

			$this->Product_model->delete_premium_dimension_attachment($dimension_id,$product_photo_type_id);
			$photos = $this->upload_multiple_file('./../rafeed-includes/upload_files/Product/Premium/'.$product_id,$photo_name,'product_photo');
			foreach ($photos as $key_photo => $value_photo) {
				$data= array(
					'premium_dimension_id' => $dimension_id, 
					'AttachmentTypeID' => $product_photo_type_id, 
					'FileName' => $value_photo
				);
				$createMember = $this->Product_model->insert_premium_dimension_attachment($data);
			}
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

	function get_dimension_power(){
		$dimension_id = $this->input->post('id');
		if($dimension_id){
			$array = $this->Premium_product_model->get_premium_collection_by_dimension_id($dimension_id);
			$power_array = array_unique(array_column($array, 'Power'));
			$prices_array = array_unique(array_column($array, 'price'));
			$result = array("power" => $power_array, "price" => $prices_array);
			echo json_encode($result);
		}
	}

	function change_product_dimension_price($dimension_id=null){
		$validator = array('success' => false, 'messages' => array());
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if ($dimension_id) {
			$count = $this->input->post('power_count');
			$editMember = false;
			for ($i=0; $i < $count; $i++) { 
				//if ($this->input->post('power_'.$i)) {			
					$power= $this->input->post('power_'.$i);
					$editMember = $this->Premium_product_model->update_premium_collection_price_by_power($dimension_id,$power,empty($this->input->post('price_'.$i))?NULL : $this->input->post('price_'.$i) ) ;
				//}
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
				$validator['messages']['error_msg']='<p class="text-danger">Add price please.</p>';
			}

		
		echo json_encode($validator);
	}

	function set_premium_product_collection_code($premium_id)
	{
		
		$product_data=$this->Premium_product_model->get_premium_coding_data($premium_id);
		if ($product_data) {
			$product_type_code=$this->Index_model->get_category_code($product_data[0]['cat_id']);
			$product_type_num=$this->Index_model->get_category_num($product_data[0]['cat_id']);
			$serial=$this->Premium_product_model->get_collection_serial();
			//$serial=17995;
			$family_num = $this->Premium_product_model->get_premium_family_num($premium_id);
			$serial++;
			$family_num++;
			foreach ($product_data as $key => $value) {
				$data = array(
					'product_code' => $this->product_coding->get_premium_code($product_type_code,$value['family_name'],($value['Power']+$value['Power_up']),$value['serial_dim'],$serial),
					'product_number' => $this->product_coding->get_premium_number($product_type_num,$family_num,($value['Power']+$value['Power_up']),$value['CCT'],$value['CRI'],$serial),
					'serial_num' => $serial
				);
				//update 
				$editMember = $this->Premium_product_model->update_collection($data,$value['ID']);
				$serial++;
			}

			if($editMember === true) {
				//update the family check review to true value.
				$data = array('Review_check' => 1);
				$this->Premium_product_model->update_premium($data,$premium_id);
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

	function get_range($min,$max)
	{
		if ($min == $max || $max==NULL) {
				return $min;
			}
		else
			return $min ." - ".$max;
	}

	function delete_premium_product($product_id)
	{	
		if($product_id) {
			$validator = array('success' => false, 'messages' => array());
			//Product
			$removeMember = $this->Index_model->delete_by_tablename_id("product", "ID", $product_id);

			//Product Attchment
			$this->Index_model->delete_by_tablename_id("product_attachment", "ProductID" ,$product_id);

			//Product Application
			$this->Index_model->delete_by_tablename_id("product_application", "Product_id" ,$product_id);

			//Product Certification
			$this->Index_model->delete_by_tablename_id("product_certification", "Product_id" ,$product_id);

			//premium
			$data = $this->Index_model->get_by_tablename_id("premium_product", "ProductId" ,$product_id);
			//var_dump(array_unique(array_column($data, 'ID')));
			$this->Index_model->delete_by_tablename_id("premium_product", "ProductId" ,$product_id);

			//premium language
			$this->Index_model->delete_by_tablename_id("premium_product_language", "Premium_product_id" ,array_unique(array_column($data, 'ID')));

			//premium Dimension
			$data = $this->Index_model->get_by_tablename_id("premium_product_family_dimension", "Premium_product_id" ,array_unique(array_column($data, 'ID')));
			//var_dump(array_unique(array_column($data, 'ID')));
			$this->Index_model->delete_by_tablename_id("premium_product_family_dimension", "ID" ,array_unique(array_column($data, 'ID')));

			//premium Dimension Accessory
			$this->Index_model->delete_by_tablename_id("premium_product_family_dimension_accessory", "premium_product_family_dimension_id" ,array_unique(array_column($data, 'ID')));

			//premium Collection
			$data = $this->Index_model->get_by_tablename_id("premium_product_collection", "premium_product_family_dimension_id" ,array_unique(array_column($data, 'ID')));		
			$this->Index_model->delete_by_tablename_id("premium_product_collection", "ID" ,array_unique(array_column($data, 'ID')));

			//premium Collection driver
			$this->Index_model->delete_by_tablename_id("premium_product_collection_driver", "premium_product_collection_id" ,array_unique(array_column($data, 'ID')));

			//color series 
			$this->Fitting_color_model->delete_color_series(array_unique(array_column($data, 'Fitting_color_series_id')));

			if($removeMember === true) {
				$validator['success'] = true;
				$validator['messages'] = "Successfully removed";
			}
			else {
				$validator['success'] = true;
				$validator['messages'] = "Error when remove product .";
			}

			echo json_encode($validator);
		}
	}

	function delete_premium_product_dimension($product_id)
	{
		
	}

	function delete_premium_product_collection($product_id)
	{
		
	}

	function add_new(){
		$data['PremiumType']=$this->Index_model->get_index_language('premium_type');
		$data['ProductType']=$this->Enums->get_ProductType();
		//$data['Product_category']=$this->Index_model->get_index_language('Product_category');
		//$data['ProductType']=$this->Index_model->get_maincat();
		$data['InstallationWay']=$this->Index_model->get_index_language('installation_way');
		$data['Shape']=$this->Index_model->get_index_language('shape');
		$data['Material']=$this->Index_model->get_index_language('material');
		$data['Color']=$this->Index_model->get_index_language('color');
		
		$data['Place']=$this->Index_model->get_index_language('fitting_part');
		$data['SocketType']=$this->Index_model->get_index('socket_type');
		$data['PinType']=$this->Index_model->get_index('pin_type');
		$data['LightingDisturbationKind']=$this->Index_model->get_index_language('lighting_distribution_kind');
		$data['Supplier']=$this->Index_model->get_index('supplier');
		$data['Brand']=$this->Index_model->get_index_language('brand');
		$data['DimmableType']=$this->Index_model->get_index_language('dimmable_type');
		$data['Country']=$this->Index_model->get_index_language('country');
		$data['LightSourceType']=$this->Index_model->get_index_language('lightsource_type');
		$data['Application']=$this->Index_model->get_index_language('application');
		$data['Certification']=$this->Index_model->get_index_language('certification');
		$data['AttachmentType']=$this->Index_model->get_index_language('attachment_type');
		$data['Language']=$this->Index_model->get_index('language');
		$data['LEDType']=$this->Index_model->get_index('led_type');

		//enum
		// light source 
		$data['LightingSource']=$this->Enums->get_BaseFixture();

		$data['FittingAccessory']=$this->Fitting_model->get_accessory();
		
		$data['DriverAccessory']=$this->Driver_model->get_accessory();

		/*$config['image_library'] = 'imagemagick';
		$config['library_path'] = '/usr/X11R6/bin/';
		$config['source_image'] = '/path/to/image/mypic.jpg';
		$config['x_axis'] = 100;
		$config['y_axis'] = 60;

		$this->image_lib->initialize($config);

		if ( ! $this->image_lib->crop())
		{
		        echo $this->image_lib->display_errors();
		}*/

		$subview='add_premium_product';
		$data['output'] = '';
		$data['subview'] = $subview;
		$data['pageTitle']='Add Product';
		$this->load->view('layouts/layout',$data);
	}
	/*public function index()
	{
		$crud = new grocery_CRUD();
		//$crud->set_model('custom_query_model');
		$crud->set_model('Custom_grocery_crud_model');
		$crud->set_table('product'); //Change to your table name
		$crud->unset_add();
		$crud->unset_delete();
		$crud->unset_clone();
		$crud->unset_read();
		$crud->unset_edit();

		//$crud->basic_model->set_query_str
		$crud->unset_jquery();
		$crud->basic_model->set_custom_query("SELECT premium_product.ID as 'ID',premium_type_language.Name as 'premium_type' , FinishedPremium as 'Finished_Premium' ,product_category_language.Name as 'product type',premium_product_language.Family_name ,premium_product_language.Family_description FROM product,premium_type_language,product_category_language ,premium_product,premium_product_language WHERE product.ID=premium_product.ProductId and premium_product.PremiumTypeID =premium_type_language.premium_type_id AND premium_type_language.Language_id=1 AND premium_product.ProductCategoryID=product_category_language.Product_category_id AND product_category_language.Language_id=1 AND premium_product_language.Pemium_product_id=premium_product.ID AND premium_product_language.Language_id=1"); //Query text here
		$crud->basic_model->order_by('ID','desc');
		$crud->columns('Family_name','Family_description','premium_type','Finished_Premium','product type');

		//$crud->add_action('Copy and new', '', null ,'fa fa-copy',array($this,'remove_link'));
		$crud->add_action('Duplicate', '', 'Premium_product/duplicate' ,'fa fa-copy');
		$crud->add_action('View Dimension', '', 'premium_product_dimension/index' ,'icon-Dimensions');
		$crud->add_action('View application', '', 'Premium_product_application/index' ,'icon-Application');
		$crud->add_action('View certifications', '', 'Premium_product_certification/index' ,'icon-Certificate');
		
		$crud->order_by('Family_name','desc');
		$output = $crud->render();

		$this->_example_output($output);
	}*/

	function remove_link($primary_key , $row){
		return '';
	}
	function _example_output($output = null)
	{
		$data['subview'] = 'template_costom.php';
		$data['output']=$output;
		$data['action']="Product/AddProduct/premium/0";
		//$data['pageTitle']='<a href="'.site_url("Product_series/index").'" >&#8592;</a> Premium Product';
		$this->breadcrumbcomponent->add('Premium Product', base_url().'/Product_series/index/');  
		//$data['breadcrumbs']=$this->breadcrumbcomponent->output();
		$data['pageTitle'] = array('Product series' =>'Product_series/index',
									'Premium Product' => 'Premium_product/index'); 
		//$this->breadcrumbs->push('Premium Product', '/Premium_product/index/');
		//$data['breadcrumbs']=$this->breadcrumbs->show();
		$this->load->view('layouts/layout.php',$data);
	}

	function just_a_test($primary_key , $row){
		return site_url('premium_product_dimension/index').'?id='.$row->ID;
	}

	function family_exist()
	{
		$this->load->model('Product_model');
		if($this->Product_model->get_id_by_family_name($this->input->post('Family_name'),'premium_product_language')>0)
		{
			//family exist
			echo json_encode(true) ;
		}
		else
			echo json_encode(False);
	}

	function duplicate($prem_id){
		$data['PremiumType']=$this->Index_model->get_index_language('premium_type');
		//$data['ProductType']=$this->Index_model->get_maincat();
		$data['Language']=$this->Index_model->get_index('language');
		$data['premium_id']=$prem_id;

		$data['subview'] = 'duplicate_family.php';
		$data['output']='';
		$data['bool']=false;
		
		$data['pageTitle'] = array('Product series' =>'Product_series/index',
									'Premium Product' => 'Premium_product/index'); 
		$this->load->view('layouts/layout.php',$data);
	}

	function add_product_data(){
		
		$series_data = array(
			'ProductSeriesID' => $this->ProductSeries_model->get_premium_id()
			);

		//add product
		$product_id=$this->Product_model->insert($series_data);
		return $product_id;
	}

	public function is_null($value){
		if($value =='')
			return NULL;
		else
			return $value;
	}

	function add_premium_data($product_id){
		//premium product
		$product_type=$this->is_null($this->input->post('ProductTypeSubCatID'));
		if($product_type==null)
		{
			$product_type=$this->is_null($this->input->post('ProductTypeID'));
		}

		$premium_product = array(
			'PremiumTypeID' => $this->input->post('PremiumType'),
			'ProductPhases' =>  $this->is_null($this->input->post('ProductPhases')),
			'ProductWires' => $this->is_null($this->input->post('ProductWires')),
			'ProductNote' => $this->is_null($this->input->post('ProductNote')),
			'FinishedPremium' => $this->input->post('SKD_Finished'),
			'ProductTypeID' => $product_type,
			'ProductId' => $product_id
			);

		
		$premium_product_id=$this->Product_model->insert_premium_product($premium_product);
		return $premium_product_id;
	}

	function add_premium_product_language_data($premium_product_id){
		$premium_product_Language_data=$this->input->post('Language_id');
		$premium_product_language_family_name_data=  $this->input->post('ProductFamily');
		$premium_product_language_family_description_data=  $this->input->post('ProductFamilyDescription');
		

		if($premium_product_language_family_name_data)
		{
			foreach($premium_product_language_family_name_data as $key =>$value){
				$premium_product_language = array(
					'Pemium_product_id' => $premium_product_id,
					'Language_id' => $premium_product_Language_data[$key],
					'Family_name' => $value,
					'Family_description' =>$premium_product_language_family_description_data[$key]
					);
				$this->Product_model->insert_premium_product_language($premium_product_language);
			}
		}
	}

	function save_premium_product(){

		//damily added
		$product_id =$this->add_product_data();
    	$premium_product_id=$this->add_premium_data($product_id);
    	$this->add_premium_product_language_data($premium_product_id);

		//get all dimension
		$dimension_data=$this->Premium_product_model->get_premium_dimension($this->input->post('premium_id'));
		//var_dump($dimension_data);
		if($dimension_data)
		{
			
			foreach ($dimension_data as $key => $value) {
				$dimension_data[$key]['Premium_product_id']=$premium_product_id;
				
				//get all collection
				$collection_data=$this->Premium_product_model->get_premium_collection_by_dimension_id($dimension_data[$key]['ID']);

				unset($dimension_data[$key]['ID']);
				//$dimension_data[$key]['ID']='';

				//insert dimension
				$dimension_id=$this->Product_model->insert_premium_product_family_dimension($dimension_data[$key]);

				if($collection_data)
				{
					foreach ($collection_data as $key2 => $value2) {
						unset($collection_data[$key2]['ID']);
						$collection_data[$key2]['premium_product_family_dimension_id']=$dimension_id;
						//insert collection
						$this->Product_model->insert_premium_product_collection($collection_data[$key2]);
						//var_dump($collection_data[$key2]);
					}
				}
			}
			
		}

		//get all application
		$application_data=$this->Premium_product_model->get_premium_application($this->input->post('premium_id'));
		if ($application_data) {
			
			//$application_data['ID']=NULL;
			foreach ($application_data as $key => $value) {
				unset($application_data[$key]['ID']);
				$application_data[$key]['Premium_product_id']=$premium_product_id;

				//insert application
				$this->Product_model->insert_premium_product_application($application_data[$key]);
			}
			
		}

    	//get all certification
    	$certification_data=$this->Premium_product_model->get_premium_certification($this->input->post('premium_id'));
    	if ($certification_data) {

			foreach ($certification_data as $key => $value) {
				unset($certification_data[$key]['ID']);
				$certification_data[$key]['Premium_product_id']=$premium_product_id;

				//insert certification
				$this->Product_model->insert_premium_product_certification($certification_data[$key]);
			}
			
		}

		//upload file

		redirect(site_url('Premium_product/index'));
	}

}
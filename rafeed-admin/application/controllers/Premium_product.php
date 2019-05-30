<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Premium_product extends CI_Controller {

	function __construct()
	{
        parent::__construct();
		 
		$this->load->model('Premium_product_model');
	 	$this->load->model('Installation_way_model');
	 	$this->load->model('Fitting_color_model');
	 	$this->load->model('ProductSeries_model');
	 	$this->load->model('Product_model');
	 	$this->load->model('Index_model');
	 	$this->load->model('Enums'); 
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

			$data['filter_options'] = $this->Index_model->get_index_language('solution');

			$data['AttachmentType']=$this->Index_model->get_index_language_not_deleted('attachment_type');
			// output
			$data['breadcrumb'] = $this->breadcrumbs->show();
			$data['pageTitle']='Premium Product Table';
			$this->load->view('layouts/layout',$data);
		}
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
				$this->global_function->get_range($value['MinWorkingTemperature'],$value['MaxWorkingTemperature']),
				$value['LifeSpan'],
				$value['Warranty'],
				$this->Index_model->get_value_by_id('supplier',$value['SupplierID']),
				'<div class="check-icon"><i class="fa '.($value['Review_check']==1? 'fa-check-circle' : 'fa-circle').'"></i></div>',
				$buttons);
		}

		echo json_encode($result);
	}

	function dimension_grid_view($premium_id)
	{
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
		$array['custom_modal_file'] = 'premium_dimension_grid.php';
		$array['custom_modal_data'] = null;
		$data['grid_body_data']= $array;

		$this->breadcrumbs->push('Premium product', '/Premium_product');
		$this->breadcrumbs->push('Product Dimension', '/Premium_product/dimension_grid_view/'.$premium_id);
		$data['breadcrumb'] = $this->breadcrumbs->show();
		
		$data['subview'] = 'grid_view.php';
		$data['pageTitle']='Premium Product Table';
		$this->load->view('layouts/layout',$data);
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
		}

		echo json_encode($result);
	}

	function collection_grid_view($dimension_id)
	{
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

		$premium_id= $this->Premium_product_model->get_premium_id_by_dimension_id($dimension_id);

		$this->breadcrumbs->push('Premium product', '/Premium_product');
		$this->breadcrumbs->push('Product Dimension', '/Premium_product/dimension_grid_view/'.$premium_id);
		$this->breadcrumbs->push('Product Collection', '/Premium_product/collection_grid_view/'.$dimension_id);
		$data['breadcrumb'] = $this->breadcrumbs->show();

		$data['subview'] = 'grid_view.php';
		$data['pageTitle']='Premium Product Table';
		$this->load->view('layouts/layout',$data);
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
				$fitting_color_data .= '<img hight=30 width=30 src="'.base_url().'assets/App_files/Texture/'.$value_fitting['Texture_photo'].'" />'
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
				($value['SymmetricBeam']==1? $value['BeamAngleValue'] : $this->global_function->get_range($value['BeamAngleH'],$value['BeamAngleV'])),
				$fitting_color_data,
				$this->Index_model->get_value_by_id('lighting_distribution_kind',$value['LightingDistributionKindID']),
				'<img hight=30 width=30 src="'.base_url().'assets/App_files/Texture/'.$texture_date['Texture_photo'].'" />'.
				$this->Index_model->get_value_by_id('material',$texture_date['MaterialID']).' /'.
				$this->Index_model->get_value_by_id('color',$texture_date['ColorID']),
				$this->Index_model->get_value_by_id('installation_way',$value['installation_way_id']),
				$value['price'],
				$buttons);
		}

		echo json_encode($result);
	}

	function get_product_installation_way()
	{
		$product_id = $this->input->post('id');
		if($product_id){
			$default_language=$this->Index_model->get_default_language();
			$result = $this->Product_model->get_product_installation_way($product_id,$default_language);
			echo json_encode($result);
		}
	}

	function change_family_application_photo($product_id)
	{
		$validator = array('success' => false, 'messages' => array());
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if ($product_id) {

			$photo_name='application_file_'.$this->input->post('installation_id');

			$this->Product_model->delete_product_installation_way($product_id, $this->input->post('installation_id'));
			$photos = $this->global_function->upload_file('./assets/App_files/Product/Premium/'.$product_id,$photo_name,'application_photo');

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

			$this->Product_model->delete_product_attachment($product_id, $this->input->post('AttachmentTypeID'));
			$photos = $this->global_function->upload_file('./assets/App_files/Product/Premium/'.$product_id,$photo_name,'product_photo');
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
			$product_id = $this->Premium_product_model->get_product_id_by_premium_id($premium_id);
			$photo_name='';
			if($type=="product"){
				$product_photo_type_id = $this->Product_model->get_product_photo_type_attachment();
				$photo_name = 'product_photo_';
			}
			else{
				$product_photo_type_id = $this->Product_model->get_dimension_photo_type_attachment();
				$photo_name = 'dimension_photo_';
			}

			$this->Product_model->delete_premium_dimension_attachment($dimension_id,$product_photo_type_id);
			$photos = $this->upload_multiple_file('./assets/App_files/Product/Premium/'.$product_id,$photo_name,'product_photo');
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

	function get_dimension_power()
	{
		$dimension_id = $this->input->post('id');
		if($dimension_id){
			$array = $this->Premium_product_model->get_premium_collection_by_dimension_id($dimension_id);
			$power_array = array_unique(array_column($array, 'Power'));
			$prices_array = array_unique(array_column($array, 'price'));
			$result = array("power" => $power_array, "price" => $prices_array);
			echo json_encode($result);
		}
	}

	function change_product_dimension_price($dimension_id=null)
	{
		$validator = array('success' => false, 'messages' => array());
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if ($dimension_id) {
			$count = $this->input->post('power_count');
			$editMember = false;
			for ($i=0; $i < $count; $i++) { 			
				$power= $this->input->post('power_'.$i);
				$editMember = $this->Premium_product_model->update_premium_collection_price_by_power($dimension_id,$power,empty($this->input->post('price_'.$i))?NULL : $this->input->post('price_'.$i) ) ;
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
	
	function delete_premium_product($product_id)
	{	
		if($product_id) {
			$validator = array('success' => false, 'messages' => array());
			//Product
			$removeMember = $this->Global_model->deleteByColumn("product", "ID", $product_id);

			//Product Attchment
			$this->Global_model->deleteByColumn("product_attachment", "ProductID" ,$product_id);

			//Product Application
			$this->Global_model->deleteByColumn("product_application", "Product_id" ,$product_id);

			//Product Certification
			$this->Global_model->deleteByColumn("product_certification", "Product_id" ,$product_id);

			//premium
			$data = $this->Global_model->getDataArrayOneColumn("premium_product", "ProductId" ,$product_id);
			//var_dump(array_unique(array_column($data, 'ID')));
			$this->Global_model->deleteByColumn("premium_product", "ProductId" ,$product_id);

			//premium language
			$this->Global_model->deleteByColumn("premium_product_language", "Premium_product_id" ,array_unique(array_column($data, 'ID')));

			//premium Dimension
			$data = $this->Global_model->getDataArrayOneColumn("premium_product_family_dimension", "Premium_product_id" ,array_unique(array_column($data, 'ID')));

			$this->Global_model->deleteByColumn("premium_product_family_dimension", "ID" ,array_unique(array_column($data, 'ID')));

			//premium Dimension Accessory
			$this->Global_model->deleteByColumn("premium_product_family_dimension_accessory", "premium_product_family_dimension_id" ,array_unique(array_column($data, 'ID')));

			//premium Collection
			$data = $this->Global_model->getDataArrayOneColumn("premium_product_collection", "premium_product_family_dimension_id" ,array_unique(array_column($data, 'ID')));		
			$this->Global_model->deleteByColumn("premium_product_collection", "ID" ,array_unique(array_column($data, 'ID')));

			//premium Collection driver
			$this->Global_model->deleteByColumn("premium_product_collection_driver", "premium_product_collection_id" ,array_unique(array_column($data, 'ID')));

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
}
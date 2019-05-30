<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	function __construct()
	{
        parent::__construct();

		$this->load->library('product_coding');
	 	$this->load->model('Premium_product_model');
	 	$this->load->model('Installation_way_model');
	 	$this->load->model('Fitting_color_model');
	 	$this->load->model('ProductSeries_model');
	 	$this->load->model('Product_model');
	 	$this->load->model('Fitting_model');
	 	$this->load->model('Driver_model');
	 	$this->load->model('LED_model');
	 	$this->load->model('Index_model');
	 	$this->load->model('Accessory_model');
	 	$this->load->model('Enums');
	 	$this->load->model('User_model');
	}

	function index()
	{
	}

	function add_premium_product()
	{
		$data['PremiumType']=$this->Index_model->get_index_language('premium_type');
		$data['ProductType']=$this->Enums->get_ProductType();
		$data['Solution']=$this->Index_model->get_index_language('solution');
		$data['Product_category'] = $this->Index_model->get_all_category();
		$data['InstallationWay']=$this->Index_model->get_index_language('installation_way');
		$data['Shape']=$this->Index_model->get_index_language('shape');
		$data['Material']=$this->Index_model->get_index_language('material');
		$data['Color']=$this->Index_model->get_index_language('color');
		$data['Place']=$this->Index_model->get_index_language('fitting_part');
		$data['Texture']=$this->Fitting_color_model->get_texture();
		$data['SocketType']=$this->Index_model->get_index('socket_type');
		$data['PinType']=$this->Index_model->get_index('pin_type');
		$data['LightingDistributionKind']=$this->Index_model->get_index_language('lighting_distribution_kind');
		$data['Supplier']=$this->Index_model->get_index('Supplier');
		$data['Brand']=$this->Index_model->get_index('brand');
		$data['DimmableType']=$this->Index_model->get_index_language('dimmable_type');
		$data['Country']=$this->Index_model->get_index_language('country');
		$data['LightSourceType']=$this->Index_model->get_index_language('led_lightsource_type');
		$data['Application']=$this->Index_model->get_index_language('application');
		$data['Certification']=$this->Index_model->get_index('certification');
		$data['AttachmentType']=$this->Index_model->get_index_language_not_deleted('attachment_type');
		$data['CCT_option']=$this->LED_model->get_CCT_option();
		$data['CRI_option']=$this->Index_model->get_index('cri_option');
		$data['Language']=$this->Index_model->get_index('language');
		$data['LEDType']=$this->Index_model->get_index('led_type');

		//enum
		$data['ProductPowerType']=$this->Enums->get_ProductPowerType();
		$data['CCT_static_option'] = $this->Enums->get_CCTRangeValues();
		$data['DriverType']=$this->Enums->get_DriverType();
		$data['DriverOutputType']=$this->Enums->get_DriverOutputType();
		$data['LightingSource']=$this->Enums->get_BaseFixture();
		$data['ProductMode']=$this->Enums->get_productMode();
		$data['AdjustableType']=$this->Enums->get_AdjustableType();
		$data['AccessoryType']=$this->Enums->get_AccessoryType();
		$data['ProductFamilyType']=$this->Enums->get_ProductFamilyType();
		
		$data['FittingAccessory']=$this->Fitting_model->get_accessory();

		$data['DriverAccessory']=$this->Accessory_model->get_accessory_by_type(3);

		$subview='add_premium_product';

		$data['output'] = '';
		$this->breadcrumbs->push('Premium product', '/Premium_product');
		$this->breadcrumbs->push('Add', '/product/add_new/');
		$data['breadcrumb'] = $this->breadcrumbs->show();

		$data['subview'] = $subview;
		$data['pageTitle']='Add Premium Product';
		$this->load->view('layouts/layout',$data);
	}

	function get_basedata($dimension_count)
	{
		$product_data= array();
		$baserole_data= array();
    	$dimension_id=1;
    	$index=0;


    	while (count($product_data)<$dimension_count) {

	    	while (is_null($this->input->post("LuminaryPowerDown".$dimension_id))) {
	       		$dimension_id++;
	    	}

			$powers_up=$this->input->post("LuminaryPowerUp".$dimension_id);
			$powers_down=$this->input->post("LuminaryPowerDown".$dimension_id);
	       	$currents=$this->input->post("LuminaryCurrent".$dimension_id);
	       	if($powers_down){
		        $power_data= array(count($powers_down));
		        $power_index=0;
		        $power_id=1;
		        $base_power_data = array();
		        foreach ($powers_down as $key => $value) {//get led for this power
					$power_down=$value;
					$power_up=$powers_up[$key];
		            while (is_null($this->input->post('led'.$dimension_id.$power_id))) {
		            	$power_id++;
		            }
		            
					$leds=$this->input->post('led'.$dimension_id.$power_id);

		            $leds_data = array();

		            //make mixer for led in same power
		            $cct_option = $this->input->post('LED_CCT_value'.$dimension_id.$power_id);
	            	$cri_option = $this->input->post('LED_CRI_value'.$dimension_id.$power_id);

	            	$led_index=0;
		            foreach ($leds as $key_led => $value_led) {
		            	foreach ($cct_option as $key_cct => $value_cct) {
		            		foreach ($cri_option as $key_cri => $value_cri) {
		            			$leds_data[$led_index]['ID'] = $value_led;
		            			$leds_data[$led_index]['CCT'] = $value_cct;
								$leds_data[$led_index]['CRI'] = $value_cri;
								$led_index++;
		            		}
		            	}
		            }
		            if($leds){
			            //driver option
			            $driver_count_id=1;
			            $drivers_count=$this->input->post('driver_count'.$dimension_id.$power_id);
						$price=$this->input->post("Price".$dimension_id.$power_id);
						$lifespan = $this->input->post("LifeSpan".$dimension_id.$power_id);
						$warranty = $this->input->post("Warranty".$dimension_id.$power_id);

			            foreach ($drivers_count as $key2 => $value2) {
			            	if ($this->input->post("ProductPowerTypeID") != 1) {
			            		$value2 = 0;
			            	}
			            	//if count aqual zero 
			            	if ($value2 != 0) {
								while (is_null($this->input->post('driver'.$dimension_id.$power_id.$driver_count_id))) {
									$driver_count_id++;
								}
							}
			                //get all driver id in this row
			                $drivers=$this->input->post('driver'.$dimension_id.$power_id.$driver_count_id);
			                if($drivers)
			                	$drivers_count[$key2] = array("value" => $value2, "driver_data" => $drivers,"Price" => $price[$key2] ,"LifeSpan"=> $lifespan[$key2] ,"Warranty" => $warranty[$key2] );
			                else
								$drivers_count[$key2] = array("value" => $value2, "driver_data" => NULL,"Price" => $price[$key2] ,"LifeSpan"=> $lifespan[$key2] ,"Warranty" => $warranty[$key2] );
								
							$driver_count_id++;
			            }
		            }

		            $ba_option = $this->input->post('beamangle_value'.$dimension_id.$power_id);
		            $power_data[$power_index] = array();
		            $power_data[$power_index]["value_up"]=$power_up;
					$power_data[$power_index]["value_down"]=$power_down;
					$power_data[$power_index]['Beamangle_index'] = $ba_option;
		            $power_data[$power_index]["current"]=$currents[$key];
		            $power_data[$power_index]["led_data"]=$leds_data;
		            $power_data[$power_index]["driver_count_data"]=$drivers_count;
		            array_push($base_power_data, array('power_up' => $power_up, 'power_down' => $power_down,'CCT'=> $this->input->post('cct_value'.$dimension_id.$power_id),'CRI' => $this->input->post('cri_value'.$dimension_id.$power_id),'Lumen' => $this->input->post('lumen'.$dimension_id.$power_id))); 
		            
					$power_index++;
					$power_id++;
		        }
		        $product_data[$index] = array('dim' => $index,'power_data' => $power_data);
		        $baserole_data[$index]=array('power_data' => $base_power_data);
	       		$index++;
	       	}
	       	$dimension_id++;
       	}

       	$data['base_data']=$product_data;
       	$data['base_role']=$baserole_data;
    	return $data;
	}

	function add_premium_family()
	{	
		//delete all null data
		foreach($_POST as $key => $stuff ) {
		    $_POST[$key]=$this->is_null($stuff);
		     if(is_array( $stuff ) ) {
		        foreach( $stuff as $subKey => $thing ) {
		            $stuff[$subKey]==$this->is_null($thing);
		        }
		    }
	    }
	    //add Premium product
		$product_id =$this->add_product_data();

		//add product solution
		$this->add_product_solution_data($product_id);
		
    	$premium_product_id=$this->add_premium_data($product_id);
    	$this->add_premium_product_language_data($premium_product_id);
    	$this->add_application_data($product_id);
		$this->add_certification_data($product_id);
		$this->add_installation_way_data($product_id);

		//add dimension
		$Shape_list = $this->input->post('Shape');
		$product_AccessoryID = $this->input->post('product_AccessoryID');
		$product_dimension_ids = array();
		
		$product_photo_type_id = $this->Product_model->get_product_photo_type_attachment();
		$dimension_photo_type_id = $this->Product_model->get_dimension_photo_type_attachment();
		
		if ($Shape_list) {
			if (isset($_FILES['dailog_study_file'])) {
				$uploadImgData['dailog_study_file'] = $this->upload_multiple_file('./assets/App_files/Product/Premium/'.$product_id,'dailog_study_file','dailog_study_file');
			}
			$dimension_id=1;
			foreach ($Shape_list as $key => $value) {
				$data = array(
					'Premium_product_id' => $premium_product_id, 
					'Length' => $this->is_null($this->input->post('length')[$key]), 
					'Width' => $this->is_null($this->input->post('width')[$key]), 
					'Height' => $this->is_null($this->input->post('height')[$key]), 
					'Radius' => $this->is_null($this->input->post('diameter')[$key]), 
					"Cut_out" => $this->is_null($this->input->post('cut_out')[$key]),
					'is_head' => $this->is_null($this->input->post('is_head')[$key]),
					'head_count' => $this->is_null($this->input->post('head_count')[$key]),
					'FittingShapeID' => $value, 
					'Phases' => $this->is_null($this->input->post('Phases')[$key]), 
					'Wires' => $this->is_null($this->input->post('Wires')[$key]), 
					'AdjustableType' =>$this->is_null($this->input->post('AdjustableType')[$key]), 
					'TiltedHMin' => $this->is_null($this->input->post('THMin')[$key]), 
					'TiltedHMax' => $this->is_null($this->input->post('THMax')[$key]), 
					'TiltedVMin' => $this->is_null($this->input->post('TVMin')[$key]), 
					'TiltedVMax' => $this->is_null($this->input->post('TVMax')[$key]), 
					'RotatedHMin' => $this->is_null($this->input->post('RHMin')[$key]), 
					'RotatedHMax' => $this->is_null($this->input->post('RHMax')[$key]), 
					'RotatedVMin' => $this->is_null($this->input->post('RVMin')[$key]), 
					'RotatedVMax' => $this->is_null($this->input->post('RVMax')[$key]),
					'Dim_photo' => isset($uploadImgData['dimension_photo'][$key]) ? $uploadImgData['dimension_photo'][$key] : NULL, 
					'product_photo' => isset($uploadImgData['product_photo'][$key]) ? $uploadImgData['product_photo'][$key] : NULL, 
					'dialog_study_file' => isset($uploadImgData['product_photo'][$key]) ? $uploadImgData['product_photo'][$key] : NULL, 
					'Weight' => $this->is_null($this->input->post('weight')[$key]),
					'serial_num' => ($key+1)
				);

				$premium_product_family_dimension_id=$this->Product_model->insert_premium_product_family_dimension($data);
				array_push($product_dimension_ids,$premium_product_family_dimension_id);

				//add images
				while (!isset($_FILES['dimension_photo'.$dimension_id])) {
					$dimension_id++;
				 }

				if (isset($_FILES['dimension_photo'.$dimension_id])) {
					$dimension_photo = $this->upload_multiple_file('./assets/App_files/Product/Premium/'.$product_id,'dimension_photo','dimension_photo'.$dimension_id);
				}
				if (isset($_FILES['product_photo'.$dimension_id])) {
					$product_photo = $this->upload_multiple_file('./assets/App_files/Product/Premium/'.$product_id,'product_photo','product_photo'.$dimension_id);
				}

				foreach ($dimension_photo as $key_photo => $value_photo) {
					$data= array(
						'premium_dimension_id' => $premium_product_family_dimension_id, 
						'AttachmentTypeID' => $dimension_photo_type_id, 
						'FileName' => $value_photo
					);
					$this->Product_model->insert_premium_dimension_attachment($data);
					
				}
				
				foreach ($product_photo as $key_photo => $value_photo) {
					$data= array(
						'premium_dimension_id' => $premium_product_family_dimension_id, 
						'AttachmentTypeID' => $product_photo_type_id, 
						'FileName' => $value_photo
					);
					$this->Product_model->insert_premium_dimension_attachment($data);
				}
				$dimension_id++;

				//add Product Accessory
				
				$product_accessory=$this->get_array($this->input->post('product_AccessoryID')[$key]);
				foreach ($product_accessory as $key_acc => $value_acc) {
					if (!($value_acc=='')) {
						$data = array(
							'premium_product_family_dimension_id' => $premium_product_family_dimension_id,
							'accessory_id' => $value_acc
					 	);
					 	$this->Product_model->insert_premium_product_family_dimension_accessory($data);
				 	}
				}		
			}
		}

		//add color series
		//for add it I need add fitting color
		$color_series_option=$this->input->post('color_series_count');
		$color_series_number=1;
		$color_series_index=0;
		$color_series_ids = array();
		while ($color_series_index < $color_series_option) {
			//add color series to DB
			$data = array('fitting_series_image' => null);// I need add color series image (dont forget that)
			$color_series_id = $this->Fitting_color_model->insert_color_series($data);
			while (is_null($this->input->post('PlaceID'.$color_series_number))) {
				$color_series_number++;
			}

			foreach ($this->input->post('PlaceID'.$color_series_number) as $key_color_details => $value_color_details) {
				$data = array(
					'FittingPartID' => $value_color_details,
					'color_texture_id' => $this->input->post('TextureID'.$color_series_number)[$key_color_details],
					'Fitting_color_series_id' => $color_series_id
				);
				$this->Fitting_color_model->insert_fitting_color($data);
			}
			//this array important for collection data
			array_push($color_series_ids,$color_series_id);
			$color_series_index++;
			$color_series_number++;
		}

		//lighting distributor series 

		//update 3-3-2019
		$distributor_series_option=$this->input->post('lightingDistributor_series_count');
		$distributor_series_number=1;
		$distributor_series_index=0;
		$distributor_series_ids = array();
		while ($distributor_series_index < $distributor_series_option) {
			//add color series to DB
			$data = array('value' => NULL );
			$distributor_series_id = $this->Fitting_model->insert_fitting_lighting_distribution_series($data);

			while (is_null($this->input->post('LightingDistributionKindID'.$distributor_series_number))) {
				$distributor_series_number++;
			}

			foreach ($this->input->post('LightingDistributionKindID'.$distributor_series_number) as $key_distributor_details => $value_distributor_details) {
				$data = array(
					'LightingDistributionKindID' => $value_distributor_details,
					'LightingDistributionTextureID' => $this->input->post('LightingDisturbationTextureID'.$distributor_series_number)[$key_distributor_details],
					'lighting_distributor_series_id' => $distributor_series_id
				);
				$this->Fitting_model->insert_fitting_lighting_distribution($data);
			}
			//this array important for collection data
			array_push($distributor_series_ids,$distributor_series_id);
			$distributor_series_index++;
			$distributor_series_number++;
		}
		

		//upload IES file
		if (isset($_FILES['ies_file'])) {
			$uploadImgData['ies_file'] = $this->upload_multiple_file('./assets/App_files/Product/Premium/'.$product_id,'ies_file','ies_file');
		}
		
		
		//color_series_photo
		if (isset($_FILES['color_series_photo'])) {
			$uploadImgData['color_series_photo'] = $this->upload_multiple_file('./assets/App_files/Product/Premium/'.$product_id,'color_series_photo','color_series_photo')	;
		}

		//upload attachment file
		/*with reem*/
		$this->add_upload_data($product_id);

		//collection
		if ($this->input->post('ProductFamilyTypeID') == 1 || $this->input->post('ProductFamilyTypeID') == 3) {
			//Fitting with lighting source OR Both

			$temp=$this->get_basedata(count($product_dimension_ids));
			$lumen_option=$this->calc_lumen($temp['base_data'],$temp['base_role']);
			$this->add_premium_collection_power_mixer($product_dimension_ids,$lumen_option,$distributor_series_ids,$color_series_ids);
		}
		if ($this->input->post('ProductFamilyTypeID') == 2 || $this->input->post('ProductFamilyTypeID') == 3) {
			//Just fitting without lighting source OR Both
			$this->add_premium_collection_fitting_mixer($product_dimension_ids,$distributor_series_ids,$color_series_ids);
		}
		
		redirect(base_url() .'index.php/Product/get_premium_report/'.$product_id);
	}

	function add_premium_collection_power_mixer($product_dimension_ids,$lumen_option,$distributor_series_ids,$color_series_ids)
	{
		$ips_check = $this->input->post('IP_check');
		$temp_ips_single=$this->input->post('FittingSingleIP');
		$temp_ips_front=$this->input->post('FittingFrontIP');
		$temp_ips_back=$this->input->post('FittingBackIP');
		$ips_single = array();
		$ips_front = array();
		$ips_back = array();
		$multi_id=0;
		$single_id=0;
		foreach ($ips_check as $key => $value) {
			$ips_single[$key] = ($value == 1 ? NULL : $temp_ips_single[$key]);
			$ips_front[$key] = ($value == 0 ? NULL : $temp_ips_front[$key]);
			$ips_back[$key] = ($value == 0 ? NULL : $temp_ips_back[$key]);
		}

		$iks=$this->get_array($this->input->post('FittingIK'));
		if (empty($iks)) {
			$iks=array(
				"value" => null
			);
		}

		$BeamAngle=array();
		$BeamAngleH=array();
		$BeamAngleV=array();
		if($this->input->post('SymmetricBeam')!=0){
			$BeamAngle=$this->get_array($this->input->post('BeamAngleValue'));	
			$BeamAngleH = array(count($BeamAngle));
			$BeamAngleV = array(count($BeamAngle));
			if(empty($BeamAngle))
				$BeamAngle = array('value'=> null);
			foreach ($BeamAngle as $key => $value) {
				$BeamAngleH[$key]=null;
				$BeamAngleV[$key]=null;
			}
		}
		else{
			$BeamAngleH=$this->get_array($this->input->post('BeamAngleH'));
			$BeamAngleV=$this->get_array($this->input->post('BeamAngleV'));
			if(empty($BeamAngleH))
			{
				$BeamAngleH = array('value'=> null);
				$BeamAngleV = array('value'=> null);
			}
			$BeamAngle = array(count($BeamAngleH));
			foreach ($BeamAngleH as $key => $value) {
				$BeamAngle[$key]=null;
			}
		}

		$LightingTypeID=$this->input->post('SocketTypeID');
		if (empty($LightingTypeID) || is_null($LightingTypeID)) {
			$LightingTypeID = $this->input->post('PinTypeID');
			if (empty($LightingTypeID)) {
				$LightingTypeID=array(
					"value" => null
				);
			}
		}

		$lumen_option_key=0;
		$product_type_code=$this->Index_model->get_category_code($this->input->post('ProductCatID'));
		$Family_name=$this->input->post('ProductFamily')[0];
		$serial=$this->Premium_product_model->get_collection_serial();
		$serial++;
		$all_option=array();
		foreach ($product_dimension_ids as $key2 => $value2) {
			while ($lumen_option[$lumen_option_key]['dim_id'] == $key2) {
				//add collection driver
				$driver_option = $lumen_option[$lumen_option_key]['driver_count_data'];
				foreach ($driver_option as $key_driver => $value_driver) {
					foreach ($distributor_series_ids as $key_dist => $value_dist) {
						foreach ($color_series_ids as $key_color => $value_color) {
							foreach ($lumen_option[$lumen_option_key]['Beamangle_index'] as $key_angle => $value_angle) {
								foreach ($ips_check as $key_ip => $value_ip) {
									foreach ($iks as $key_ik => $value_ik) {
										foreach ($LightingTypeID as $key_lighting_type => $value_lighting_type) {
											//upload Color series product photo
											$data = array(
												'serial_num' => $serial,
												'premium_product_family_dimension_id' => $value2 ,
												'Led_id' => $lumen_option[$lumen_option_key]['led_id'],
												'CCT' => $lumen_option[$lumen_option_key]['CCT'],
												'CRI' => $lumen_option[$lumen_option_key]['CRI'],
												'Fitting_color_series_id' => $value_color,
												'Multiple_ip' => $value_ip,
												'Front_ip' => $ips_front[$key_ip],
												'Back_ip' => $ips_back[$key_ip],
												'IP' => $ips_single[$key_ip],
												'IK' => $value_ik,
												'Power' => $this->is_null($lumen_option[$lumen_option_key]['power_down']),
												'Power_up' => $this->is_null($lumen_option[$lumen_option_key]['power_up']),
												'Current' => $this->is_null($lumen_option[$lumen_option_key]['current']),
												'Lumen' => $lumen_option[$lumen_option_key]['lumen'],
												'SymmetricBeam' => $this->input->post('SymmetricBeam'),
												'BeamAngleH' => $BeamAngleH[$value_angle],
												'BeamAngleV' => $BeamAngleV[$value_angle],
												'BeamAngleValue' => $BeamAngle[$value_angle],
												'UGRRate' => $this->input->post('UGRRate'),
												'lighting_distributor_series_id' => $value_dist,
												'lighting_source_type_id' => $value_lighting_type,
												'installation_way_id' => NULL ,//$value_inst,
												'IES_file' => isset($uploadImgData['ies_file'][$key_angle]) ? $uploadImgData['ies_file'][$key_angle] : NULL ,
												'color_series_photo' => isset($uploadImgData['color_series_photo'][$key_color]) ? $uploadImgData['color_series_photo'][$key_color] : NULL ,
												'Name' => $this->product_coding->get_premium_code($product_type_code,$Family_name,($lumen_option[$lumen_option_key]['power_down']+$lumen_option[$lumen_option_key]['power_up']),($key2+1),$serial),
												'Code' => null,
												'price' => empty($value_driver['Price'])? NULL : $value_driver['Price'],
												'LifeSpan' => $value_driver['LifeSpan'],
												'Warranty' => $value_driver['Warranty']
											);
											$lumen_option[$key2]['serial']=$serial;
											$premium_product_collection_id = $this->Product_model->insert_premium_product_collection($data);
											
											if($value_driver['value'] != 0)
												foreach ($value_driver['driver_data'] as $key_driver_data => $value_driver_data) {
													$data = array(
														'premium_product_collection_id' => $premium_product_collection_id,
														'driver_id' => $value_driver_data );
													$this->Product_model->insert_premium_product_collection_driver($data);
												}
										
											$serial++;
										}//end lighting source
									}//end ik
								}//end ip
							}//end beam angle
						}//end color series
					}//driver
				}//end distribution
				$lumen_option_key++;
				if($lumen_option_key >= count($lumen_option))
					break;
			}//end lumen option
			//$serial=1;
		}//end dimension
	}

	function add_premium_collection_fitting_mixer($product_dimension_ids,$distributor_series_ids,$color_series_ids)
	{
		$ips_check = $this->input->post('IP_check');
		$temp_ips_single=$this->input->post('FittingSingleIP');
		$temp_ips_front=$this->input->post('FittingFrontIP');
		$temp_ips_back=$this->input->post('FittingBackIP');
		$ips_single = array();
		$ips_front = array();
		$ips_back = array();
		$multi_id=0;
		$single_id=0;
		foreach ($ips_check as $key => $value) {
			$ips_single[$key] = ($value == 1 ? NULL : $temp_ips_single[$key]);
			$ips_front[$key] = ($value == 0 ? NULL : $temp_ips_front[$key]);
			$ips_back[$key] = ($value == 0 ? NULL : $temp_ips_back[$key]);
		}

		$iks=$this->get_array($this->input->post('FittingIK'));
		if (empty($iks)) {
			$iks=array(
				"value" => null
			);
		}

		$BeamAngle=array();
		$BeamAngleH=array();
		$BeamAngleV=array();
		if($this->input->post('SymmetricBeam')!=0){
			$BeamAngle=$this->get_array($this->input->post('BeamAngleValue'));	
			$BeamAngleH = array(count($BeamAngle));
			$BeamAngleV = array(count($BeamAngle));
			if(empty($BeamAngle))
				$BeamAngle = array('value'=> null);
			foreach ($BeamAngle as $key => $value) {
				$BeamAngleH[$key]=null;
				$BeamAngleV[$key]=null;
			}
		}
		else{
			$BeamAngleH=$this->get_array($this->input->post('BeamAngleH'));
			$BeamAngleV=$this->get_array($this->input->post('BeamAngleV'));
			if(empty($BeamAngleH))
			{
				$BeamAngleH = array('value'=> null);
				$BeamAngleV = array('value'=> null);
			}
			$BeamAngle = array(count($BeamAngleH));
			foreach ($BeamAngleH as $key => $value) {
				$BeamAngle[$key]=null;
			}
		}

		$LightingTypeID=$this->input->post('SocketTypeID');
		if (empty($LightingTypeID) || is_null($LightingTypeID)) {
			$LightingTypeID = $this->input->post('PinTypeID');
			if (empty($LightingTypeID)) {
				$LightingTypeID=array(
					"value" => null
				);
			}
		}

		$power_option=$this->input->post('max_power');
		$price_option=$this->input->post('fitting_price');
		$lumen_option_key=0;
		$product_type_code=$this->Index_model->get_category_code($this->input->post('ProductCatID'));
		$Family_name=$this->input->post('ProductFamily')[0];
		$serial=$this->Premium_product_model->get_collection_serial();
		$serial++;
		$all_option=array();

		foreach ($product_dimension_ids as $key2 => $value2) {
			foreach ($distributor_series_ids as $key_dist => $value_dist) {
				foreach ($color_series_ids as $key_color => $value_color) {
					foreach ($BeamAngle as $key_angle => $value_angle) {
						foreach ($ips_check as $key_ip => $value_ip) {
							foreach ($iks as $key_ik => $value_ik) {
								foreach ($LightingTypeID as $key_lighting_type => $value_lighting_type) {
									//upload Color series product photo
									$data = array(
										'serial_num' => $serial,
										'premium_product_family_dimension_id' => $value2 ,
										'Fitting_color_series_id' => $value_color,
										'Multiple_ip' => $value_ip,
										'Front_ip' => $ips_front[$key_ip],
										'Back_ip' => $ips_back[$key_ip],
										'IP' => $ips_single[$key_ip],
										'IK' => $value_ik,
										'Power' => $this->is_null($power_option[$key2]),
										'SymmetricBeam' => $this->input->post('SymmetricBeam'),
										'BeamAngleH' => $BeamAngleH[$key_angle],
										'BeamAngleV' => $BeamAngleV[$key_angle],
										'BeamAngleValue' => $BeamAngle[$key_angle],
										'UGRRate' => $this->input->post('UGRRate'),
										'lighting_distributor_series_id' => $value_dist,
										'lighting_source_type_id' => $value_lighting_type,
										'IES_file' => isset($uploadImgData['ies_file'][$key_angle]) ? $uploadImgData['ies_file'][$key_angle] : NULL ,
										'color_series_photo' => isset($uploadImgData['color_series_photo'][$key_color]) ? $uploadImgData['color_series_photo'][$key_color] : NULL ,
										'Name' => $this->product_coding->get_premium_code($product_type_code,$Family_name,$power_option[$key2],($key2+1),$serial),
										'Code' => null,
										'price' => empty($price_option[$key2])? NULL : $price_option[$key2],
										'LifeSpan' => $this->input->post('LifeSpan'),
										'Warranty' => $this->input->post('Warranty')
									);
									$lumen_option[$key2]['serial']=$serial;
									$this->Product_model->insert_premium_product_collection($data);
									$serial++;
								}//end lighting source
							}//end ik
						}//end ip
					}//end beam angle
				}//end color series
			}//end distribution
		}//end dimension
	}

	function get_premium_report($product_id)
	{
		$data['pageTitle'] = 'add Premium Product';
		$this->breadcrumbs->push('Premium product', '/Premium_product');
		$data['breadcrumb'] = $this->breadcrumbs->show();
		$data['subview'] = 'empty_page';
		$data['output']='';
		if($product_id)
			$data['result']='Congratulations! Product Added Successfully in system. <br />To Download Family report <a href='.base_url().'index.php/Print_pdf/premium_family_report/'.$product_id.' target="_blank">click here</a>';
			
		else
			$data['result']='Error.';
		
		$this->load->view('layouts/layout.php',$data);
	}

	function calc_lumen($base_data,$baserole_data)
	{
		$all_option = array();
		$baserow_array=array();

		foreach ($base_data as $key => $value) {
			if ($value['power_data'])
			foreach ($value['power_data'] as $key2 => $value2) {
				$baserow=$baserole_data[$key];
				$baserow=$baserow['power_data'][$key2];
				array_push($baserow_array, array('power_up'=>$value2['value_up'],'power_down'=>$value2['value_down'],'CCT'=>$baserow['CCT'],'CRI'=>$baserow['CRI'],'Lumen'=>$baserow['Lumen']));
				$led_data=$value2['led_data'];
				foreach ($led_data as $key3 => $value3) {
					//if CCT is static value
					$lumen_val=0;
					$baserow_key=$this->filter_led($baserow_array,$value3['CCT'],$value2['value_down']);
					if($baserow_key!=-1)
						$baserow=$baserow_array[$baserow_key];

					if($baserow['CCT']==$value3['CCT'] && $baserow['CRI']==$value3['CRI'])
					{
						$lumen_val=$baserow['Lumen'];
					}
					else
						if(is_null($this->Enums->get_CCTRangeValues_byId($value3['CCT']))){
							if ($baserow['CCT']==$value3['CCT']) {
								//modify the CRI
								$cri=$this->round_CRI((int)$baserow['CRI']);
								$current_cri=$this->round_CRI((int)$value3['CRI']);
								$lumen_val=$baserow['Lumen'];
								
								while ($cri != $current_cri) {
									if($cri < $current_cri){
										$factor=$this->get_CRI_factor($cri, $cri+10);
										$lumen_val=$lumen_val*$factor;
										$cri=$cri+10;
									}
									else
									{
										$factor=$this->get_CRI_factor($cri-10 ,$cri);
										$lumen_val=$lumen_val/$factor;
										$cri=$cri-10;
									}
								}

							}
							else
							{
								//modify CCT
								$cct=$this->round_CCT($baserow['CCT']);
								$current_cct=$this->round_CCT($value3['CCT']);
								$lumen_val=$baserow['Lumen'];
								while ($cct != $current_cct) {
									if($cct<$current_cct){
										$factor=$this->get_CCT_factor($cct, $cct+1000);
										$lumen_val=$lumen_val/$factor;
										$cct=$cct+1000;
									}
									else
									{
										$factor=$this->get_CCT_factor($cct-1000,$cct);
										$lumen_val=$lumen_val*$factor;
										$cct=$cct-1000;
									}
								}
								array_push($baserow_array, array('power_up'=>$value2['value_up'],'power_down'=>$value2['value_down'],'CCT'=>$value3['CCT'],'CRI'=>$value3['CRI'],'Lumen'=>$lumen_val));
							}
						}
					array_push($all_option, array('dim_id'=>$key, 'power_id'=>$key2,'power_up'=>$value2['value_up'],'power_down'=>$value2['value_down'],'current'=> $value2['current'],'CCT'=>$value3['CCT'],'CRI'=>$value3['CRI'],'led_id' => $value3['ID'],'Beamangle_index' => $value2['Beamangle_index'],'driver_count_data' =>$value2['driver_count_data'] ,'lumen'=>round($lumen_val)));
				}		
			}
		}
		return $all_option;
	}

	function filter_led($arr,$cct,$power)
	{
		$keys = array_keys(
		    array_filter(
		        $arr,
		        function ($v) use ($cct,$power) { return $v['CCT'] == $cct && $v['power_down'] == $power; }
		    )
		);
		if($keys)
			$key = $keys[0];
		else {
			$key=-1;
		}
		return $key;
	}

	function get_CRI_factor($min,$max)
	{
		if ($min==70 && $max==80) {
			return 0.90;
		}
		if ($min==80 && $max==90) {
			return 0.84;
		}
		if ($min==90 && $max==100) {
			return 0.95;
		}
	}

	function get_CCT_factor($min,$max)
	{
		if ($min==2000 && $max==3000) {
			return 0.97;
		}
		if ($min==3000 && $max==4000) {
			return 0.95;
		}
		if ($min==4000 && $max==5000) {
			return 0.95;
		}
		if ($min==5000 && $max==6000) {
			return 0.95;
		}
	}

	function is_basevalue_cct($value)
	{
		$cct_values = array(2000, 3000, 4000, 5000, 6000);
		return in_array($value, $cct_values);
	}

	function is_basevalue_cri($value)
	{
		$cri_values = array(70, 80, 90, 100);
		return in_array($value, $cri_values);
	}

	function round_CRI($value)
	{
		
		if($value<70)
			$value=70;
		else
			if (($value >= 70 && $value<101)) {
				$value =round($value/10) *10;
			}
			else
				$value=100;
		return $value;
	}

	function round_CCT ($value)
	{
		if($value<2700)
			$value=2000;
		else
			if($value >=2700 && $value<3000)
				if($value<2850)
					$value=2000;
				else
					$value=3000;
			else
				if (($value >=3000 && $value<4000) || ($value >=4000 && $value<5000) || ($value >=5000 && $value<6000)) {
					$value =round($value/1000) *1000;
				}
				else {
					$value=6000;
				}
		return $value;
	}

	function add_product_data()
	{
		if($this->session->userdata('Full_name'))
			$username=$this->session->userdata('Full_name');
		else 
			$username=$this->User_model->get_default_username();
		$format = "%Y-%m-%d %H:%i";

		$series_data = array(
			'ProductCategoryID' => $this->is_null($this->input->post('ProductCatID')),
			'CreatedBy'=>$username,
			'CreatedDate'=>mdate($format)
			);

		//add product
		$product_id=$this->Product_model->insert($series_data);

		return $product_id;
	}

	function add_product_solution_data($Product_id)
	{
		$solution_data = $this->is_null($this->input->post('ProductSolID'));
		foreach ($solution_data as $key => $value) {
			$data = array(
			'solution_id' => $value,
			'product_id' =>  $Product_id
			);
		$this->Product_model->insert_product_solution($data);
		}	
	}

	function add_premium_data($product_id)
	{
		//premium product
		$premium_product = array(
			'PremiumTypeID' => $this->is_null($this->input->post('PremiumType')),
			'FinishedPremium' => $this->is_null($this->input->post('SKD_Finished')),
			'ProductId' => $product_id,
			'LightingSource' => $this->is_null($this->input->post('LightingSource')),
			'Firerated' => $this->is_null($this->input->post('Firerated')),
			'MinWorkingTemperature' => $this->is_null($this->input->post('LuminaryMinWorkingTemperature')),
			'MaxWorkingTemperature' => $this->is_null($this->input->post('LuminaryMaxWorkingTemperature')),
			'PowerType' => $this->is_null($this->input->post('ProductPowerTypeID')),
			'FamilyType' => $this->is_null($this->input->post('ProductFamilyTypeID')),
			'SupplierID' => $this->is_null($this->input->post('Fitting_supplierID'))
			);


		$premium_product_id=$this->Product_model->insert_premium_product($premium_product);
		return $premium_product_id;
	}

	function add_premium_product_language_data($premium_product_id)
	{
		$premium_product_Language_data=$this->input->post('Language_id');
		$premium_product_language_family_name_data=  $this->input->post('ProductFamily');
		$premium_product_language_family_description_data=  $this->input->post('ProductFamilyDescription');


		if($premium_product_language_family_name_data)
		{
			foreach($premium_product_language_family_name_data as $key =>$value){
				$premium_product_language = array(
					'Premium_product_id' => $premium_product_id,
					'Language_id' => $premium_product_Language_data[$key],
					'Family_name' => $value,
					'Family_description' =>$premium_product_language_family_description_data[$key]
					);
				$this->Product_model->insert_premium_product_language($premium_product_language);
			}
		}
	}

	function add_application_data($premium_product_id)
	{
		$premium_product_application_data=  $this->input->post('ApplicationID');
		if($premium_product_application_data)
		{
			foreach($premium_product_application_data as $key =>$value){
				$data = array(
					'ApplicationID' => $value,
					'Product_id' => $premium_product_id
					 );
				$this->Product_model->insert_premium_product_application($data);
			}
		}
	}

	function add_certification_data($premium_product_id)
	{
		$premium_product_certification_data=  $this->input->post('CertificationID');

		if($premium_product_certification_data)
		{
			foreach($premium_product_certification_data as $key =>$value){
				$data = array(
					'CertificationID' => $value,
					'Product_id' => $premium_product_id
					 );
				$this->Product_model->insert_premium_product_certification($data);
			}
		}
	}

	function add_installation_way_data($product_id)
	{
		if($product_id){
			//insert action
			$installation_way_option=$this->input->post('InstallationWayID');
			foreach ($installation_way_option as $key => $value) {
				//upload photo 
				$file_name = $this->upload_file('./assets/App_files/Product/Premium/'.$product_id,'application_'.$product_id.'_'.$value,'application_photo_installation_'.$value);
				$installation_data = array( 'installation_way_id' => $value,
										 'product_id' => $product_id,
										 'application_photo' => $file_name
									);
				$this->Product_model->insert_product_installation_way($installation_data);
			}
		}
	}

	function add_upload_data($product_id)
	{
		//upload file
		$upload_attachment_data = $this->upload_multiple_file('./assets/App_files/Product/Premium/'.$product_id,'attachment_file','FileName');
		$upload_attachment_type_data=$this->input->post('AttachmentTypeID');
		if($upload_attachment_data)
		{
			foreach($upload_attachment_data as $key =>$value){
				$data = array(
					'FileName' => $value,
					'AttachmentTypeID' => $upload_attachment_type_data[$key],
					'ProductID' => $product_id
					 );
				$this->Product_model->insert_product_attachment($data);
			}
		}
	}
}

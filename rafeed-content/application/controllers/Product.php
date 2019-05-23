<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function index()
	{
		$data['subview'] = 'Products_list.php';
		$data['pageTitle']='Products Page';
		$this->load->view('layouts/layout.php',$data);   
	}

	function get_category_product($cat_id){
		$this->load->model('Product_model');
		$product=$this->Product_model->get_product($cat_id);
		foreach ($product as $key => $value) {
			$product[$key]['description']=$this->get_product_description($value['ID']);
		}
		return $product;
	}


	function Product_series_list($series_id,$cat_id=0){
		//edit series to active

		$this->load->library("navigation");
		$temp=$this->navigation->update_navigation($series_id,$cat_id);

		if($cat_id==0)
			$cat_id=$temp;
		
		if($series_id==5)
		{
			//LED Screen
			$data['subview'] = 'led_screen.php';
			$data['pageTitle']='Products Page';
		}
		else{
			
			//get product
			$data['product']=$this->get_category_product($cat_id);
			
			$data['subview'] = 'Products_list.php';
			$data['pageTitle']='Products Page';
		}
		
		$this->load->view('layouts/layout.php',$data);   
	}

	function Product_category_list($cat_id){

		$this->load->library("navigation");
		$this->navigation->update_navigation(0,$cat_id);

		$smart_array = array(26,25,24,23 );
		
		if(in_array($cat_id, $smart_array))
			$cat_id=19;

		$data['product']=$this->get_category_product($cat_id);
		
		$data['subview'] = 'Products_list.php';
		$data['pageTitle']='Products Page';
		$this->load->view('layouts/layout.php',$data);
	}


	function get_product_description($pro_id){

		$this->load->model('Product_model');
		$description='';
		
		//get category
		$description=$this->Product_model->get_category_name_by_id($pro_id);

		switch ($description) {
			case 'Extension Socket':
				$product_info=$this->Product_model->get_electric_info($pro_id);
				$description.=', '.$product_info[0]["voltage"].'<br/>'.$product_info[0]["current"].' , '.$product_info[0]["power"].'</br>';
				$description.=$product_info[0]['Plug_type'].'<br/>';

				$Cord_length_var='Cord length ';

				foreach ($product_info as $key => $value) {
					if(!is_null($value['Cord_length']))
					{
						$description.= $Cord_length_var.$value['Cord_length'];
						if($key !== count($product_info) -1 )
							$description.=', ';
					}
				}
				break;
			case 'Power Supply':
				$product_info=$this->Product_model->get_powersupply_info($pro_id);
				$description='';
				foreach ($product_info as $key => $value) {
					$description.= 'DC Voltage : '.$value['DC_Voltage'].'<br/>';
					$description.= 'Rated Current : '.$value['Rated_Current'].'<br/>';
					$description.= 'DC Power : '.$value['DC_Power'].'<br/>';
					$description.= 'AC Voltage range : '.$value['AC_Voltage_range'].'<br/>';
				}
				break;
			case 'Controller':
				//smart home
				$description='';
				
				//static info
				$product_info=$this->Product_model->get_smart_static_info($pro_id);
				foreach ($product_info as $key => $value) {
					$description.= 'Working temperature : '.$value['Working_temperature'].'<br/>';
					$description.= 'DC Voltage supply : '.$value['DC_Voltage_supply'].'<br/>';
					$description.= 'Output power	 : '.$value['Output_power'].'<br/>';
				}

				/*//smart home data
				$product_info=$this->Product_model->get_smart_info($pro_id);
				foreach ($product_info as $key => $value) {
					$description.= 'Working temperature : '.$value['Working_temperature'].'<br/>';
					$description.= 'DC Voltage supply : '.$value['DC_Voltage_supply'].'<br/>';
					$description.= 'Output power	 : '.$value['Output_power'].'<br/>';
				}*/

				break;
			default:
				//get dimension
				$product_dimension=$this->Product_model->get_product_dimension($pro_id);
				$description.=', its available by size';
				$pro_power=array();
				$pro_CCT=array();
				$pro_beamangle=array();
				$pro_lumen=array();

				foreach ($product_dimension as $key => $value) {
					$description.=' '.$value["shape"].' '.$value["size"].' ';//.'</br>';
					$product_options=$this->Product_model->get_product_option($value["ID"]);

					foreach ($product_options as $key1 => $value1) {
						array_push($pro_power, $value1["Power"]);
						array_push($pro_CCT, $value1["CCT"]);
						array_push($pro_beamangle, $value1["Beam_angle"]);
						array_push($pro_lumen, $value1["lumen"]);
					}
				  	if($key == count($product_dimension) -1 ) {
				  		$description.='<br/>Voltage equal to '.$product_options[0]['Voltage_HZ'].'</br>';
				  	}
				  	else
				  		$description.=',';

				}

				//power
				$result = array_unique($pro_power);
				$strips_array = array(59 ,58,25,24,23 );
				if(!empty($result))
					$description.='Power';
				foreach ($result as $key => $value) {
					if($value !=='' && $value !=='-')
						$description.=' '.$value;
					if(!in_array($pro_id, $strips_array))
						$description.='w';
					end($result);
					if($key != key($result))
						$description.=',';
				}

				//get cct
				$result = array_unique($pro_CCT);
				if(!empty($result))
					$description.='<br/>CCT';
				foreach ($result as $key => $value) {
					if($value !=='' && $value !=='-')
						$description.=' '.$value.'';
					end($result);
					if($key != key($result))
						$description.=',';
				}

				//get Beam angle
				$result = array_unique($pro_beamangle);
				if(!empty($result))
					$description.='<br/>Beam angle';
				foreach ($result as $key => $value) {
					if($value !=='' && $value !=='-')
						$description.=' '.$value.'°';
					end($result);
					if($key != key($result))
						$description.=',';
				}

				//get lumen
				$result = array_unique($pro_lumen);
				if(!empty($result))
					$description.=' <br/>Lumen';
				foreach ($result as $key => $value) {
					if($value !=='' && $value !=='-')
					{
						if($key != (key($result)+1) && $key !=0)
							$description.=',';
						$description.=' '.$value.'lm';
						end($result);
						
					}
				}
				$description.='.';
				break;
		}

		
		return $description;

	}

	public function product_view($pro_id)
	{


		$this->load->model('Product_model');
		$product_cat='';
		
		//get category
		$product_cat=$this->Product_model->get_category_name_by_id($pro_id);
		$series_id = $this->Product_model->get_series_by_Pid($pro_id);
		$cat_id='';

		$data = array();
		switch ($series_id) {
			case 1:
				# Premium
				$data['product_cat'] = $this->Product_model->get_category_name_by_id($pro_id);
				$data['product_data']=$this->Product_model->get_product_by_id($pro_id);	

				$data['product_dimension']=$this->Product_model->get_product_dimension($pro_id);
				$data['Power_option'] = array();
				foreach ($data['product_dimension'] as $key => $value) {
						$data['product_dimension'][$key]['option']=$this->Product_model->get_product_option($value['ID']);
						$data['product_dimension'][$key]['Power_option'] =array_unique(array_column($data['product_dimension'][$key]['option'], 'Power'));
						//$data['product_dimension'][$key]['photos']  = array('1.png','2.png','3.png');;
						$data['product_dimension'][$key]['photos']  = $this->Product_model->get_product_files($value['ID']);
					}	
				//$data['Power_option'] = array_unique($data['Power_option']);
				$data['product_basicFeature'] = array(
					'Voltage_HZ' => $data['product_dimension'][0]['option'][0]['Voltage_HZ'], 
					'lifespan' => $data['product_dimension'][0]['option'][0]['lifespan'].'hrs',
					'IP' => $data['product_dimension'][0]['option'][0]['IP'],
					'Beam_angle' => $data['product_dimension'][0]['option'][0]['Beam_angle'].'º',
					'Lighting_Type' => $data['product_data'][0]['Lighting_Type'],
					'LEDType' => $data['product_data'][0]['Base'],
					'Installation_way' => $data['product_data'][0]['lighting_icon']
					);
				$data['document'] = array(array(
						'file_name' => 'Product data sheet',
						'type' => 'pdf',
						'size' => '545.73 kB' ),
					 	array(
						'file_name' => 'Energy label',
						'type' => 'pdf',
						'size' => '142.40 kB' )
					);
				//$data['accessories']=$this->Product_model->get_accessory_by_catID($data['product_data'][0]['category_id']);
				$data['accessories']=$this->Product_model->get_accessory_by_proID($data['product_data'][0]['ID'],$data['product_data'][0]['category_id']);
/*				array_push($data['accessories'], $accessory_product);
				$accessory_product=$this->Product_model->get_accessory_by_proID($data['product_data'][0]['ID']);
				array_push($data['accessories'], $accessory_product);*/
				/*$data['accessories'] = array(array(
						'code' => 'RF-0367',
						'name' => 'Reflector for 25 watt COB High surface down light  White',
						'description' => 'Size Φ165mm*H77mm, White color' ),
					 	array(
						'code' => 'RF-0368',
						'name' => 'Reflector for 25 watt COB High surface down light  Black',
						'description' => 'Size Φ165mm*H77mm, Black color' )
					);*/
				$data['subview'] = 'e_series_product.php';
				$data['pageTitle']='Premium - '.$data['product_cat'].' - '.$data['product_data'][0]['Name'];
				break;
			case 2:
				# E-series
				$data['product_cat'] = $this->Product_model->get_category_name_by_id($pro_id);
				$data['product_data']=$this->Product_model->get_product_by_id($pro_id);	

				$data['product_dimension']=$this->Product_model->get_product_dimension($pro_id);
				$data['Power_option'] = array();
				foreach ($data['product_dimension'] as $key => $value) {
						$data['product_dimension'][$key]['option']=$this->Product_model->get_product_option($value['ID']);
						$data['product_dimension'][$key]['Power_option'] =array_unique(array_column($data['product_dimension'][$key]['option'], 'Power'));
						//$data['product_dimension'][$key]['photos']  = array('1.png','2.png','3.png');;
						$data['product_dimension'][$key]['photos']  = $this->Product_model->get_product_files($value['ID']);
					}	
				//$data['Power_option'] = array_unique($data['Power_option']);
				$data['product_basicFeature'] = array(
					'Voltage_HZ' => $data['product_dimension'][0]['option'][0]['Voltage_HZ'], 
					'lifespan' => $data['product_dimension'][0]['option'][0]['lifespan'].'hrs',
					'IP' => $data['product_dimension'][0]['option'][0]['IP'],
					'Beam_angle' => $data['product_dimension'][0]['option'][0]['Beam_angle'].'º',
					'Lighting_Type' => $data['product_data'][0]['Lighting_Type'],
					'LEDType' => $data['product_data'][0]['Base'],
					'Installation_way' => $data['product_data'][0]['lighting_icon']
					);
				$data['document'] = array(array(
						'file_name' => 'Product data sheet',
						'type' => 'pdf',
						'size' => '545.73 kB' ),
					 	array(
						'file_name' => 'Energy label',
						'type' => 'pdf',
						'size' => '142.40 kB' )
					);
				$data['accessories']=$this->Product_model->get_accessory_by_catID($data['product_data'][0]['category_id']);
				$data['subview'] = 'e_series_product.php';
				$data['pageTitle']='E-series - '.$product_cat.' - '.$data['product_data'][0]['Name'];
				break;
			case 3:
				# Electric
				switch ($product_cat) {
					case 'Extension Socket':
						$data['tech_data']=$this->Product_model->get_electric_info($pro_id);
						$data['feature_data']=$this->Product_model->get_product_feature($pro_id);
						if($pro_id==60 || $pro_id==61)
							$data['option_data']=array('title'=>'Meter Cabel','data'=>array("2 meter","5 meter"));
						else
							$data['option_data']=null;
						$data['product_data']=$this->Product_model->get_product_by_id($pro_id);

						$data['subview'] = 'electric_series_product.php';
						$data['pageTitle']='Products Page';
						break;
					case 'Power Supply':
						$data['tech_data']=$this->Product_model->get_powersupply_info($pro_id);
						$data['feature_data']=$this->Product_model->get_product_feature($pro_id);
						if($pro_id==60 || $pro_id==61)
							$data['option_data']=array('title'=>'Meter Cabel','data'=>array("2 meter","5 meter"));
						else
							$data['option_data']=null;
						$data['product_data']=$this->Product_model->get_product_by_id($pro_id);

						$data['subview'] = 'electric_series_product.php';
						$data['pageTitle']='Electric - Power Supply -'.$data['product_data'][0]['Name'];
						break;
					}
				break;
			case 4:
				# Smart
				$data['tech_data']=$product_info=$this->Product_model->get_smart_static_info($pro_id);
				$data['feature_data']=$this->Product_model->get_product_feature($pro_id);
				$data['option_data']=null;
				$data['product_data']=$this->Product_model->get_product_by_id($pro_id);
				$data['subview'] = 'electric_series_product.php';
				$data['pageTitle']='Smart Home - '.$data['product_data'][0]['Name'];
				break;
			default:
				$this->load->library("navigation");
				$this->session->set_userdata('navdata',$this->navigation->set_navigation());

				$data['subview'] = 'Home.php';
				$data['pageTitle']='Home Page';
				break;

		}

		$this->load->library("navigation");
		$temp=$this->navigation->update_navigation($series_id,$data['product_data'][0]['category_id']);

		$this->load->view('layouts/layout.php',$data);
	}
	
}
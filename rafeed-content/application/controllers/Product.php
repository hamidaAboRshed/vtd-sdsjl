<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Product_model');
		$this->load->model('ProductSeries_model');
		$this->load->model('Premium_product_model');
		$this->load->model('Fitting_color_model');
		$this->load->model('Fitting_model');
		$this->load->model('Driver_model');
		$this->load->model('LED_model');
		$this->load->model('Index_model');
		$this->load->model('Accessory_model');
		$this->load->model('Enums');
		$this->load->helper('text');
		$this->load->model('Supplier_model');
		$this->load->library('pdf');
	}

	function get_range($min,$max)
    {
        if ($min == $max || $max==NULL) {
                return $min;
            }
        else
            return $min ." - ".$max;
    }
	public function index()
	{
		$data['subview'] = 'Products_list.php';
		$data['pageTitle']='Products Page';
		$this->load->view('layouts/layout.php',$data);   
	}

	function get_category_product($cat_id){
		
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
		$premium_id= $this->ProductSeries_model->get_premium_id();
		$data['pageTitle']='Products Page';
		switch($series_id){
			case $premium_id : 
				$data['product']=array();
				$data['category_list']= $this->ProductSeries_model->get_series_category($series_id,$cat_id);
				$data['subview'] = 'Premium_products_list.php';
				break;
			case 5:
				//LED Screen
				$data['subview'] = 'led_screen.php';
				$data['pageTitle']='LED Screen';
				break;
			default:
				//get product
				$data['product']=$this->get_category_product($cat_id);
				
				$data['subview'] = 'Products_list.php';
		}
		
		$this->load->view('layouts/layout.php',$data);   
	}

	function Premium_product_category_list($cat_id)
	{
		$sol_id = $this->navigation->get_active_category();
		if ($cat_id==0) {
			$data = $this->productSeries_model->get_premium_product_list($sol_id);
		}
		else
			$data = $this->productSeries_model->get_premium_product_list($sol_id,$cat_id);
		foreach ($data as $key => $value) {
			
			$html = strip_tags ($value['Family_description'],'<br>');
			$data[$key]['colors']=$this->Fitting_color_model->get_fitting_texture_by_product_id($value['ID']);
			/*$content='';
			foreach($html->find('p') as $e)
			{
			    $content .= $e;
			}*/
			$data[$key]['Family_description'] = character_limiter($html,255);
		}
		echo json_encode($data);
	}
	function Product_category_list($cat_id){

		$this->load->library("navigation");
		$this->navigation->update_navigation(0,$cat_id);

		$smart_array = array(26,25,24,23 );
		
		if(in_array($cat_id, $smart_array))
			$cat_id=19;
		
		if($this->session->userdata('is_premium')==1){
			$data['product']=array();
			$premium_id= $this->ProductSeries_model->get_premium_id();
			$data['category_list'] = $this->ProductSeries_model->get_series_category($premium_id,$cat_id);
			$data['subview'] = 'Premium_products_list.php';
		}
		else
		{
			$data['product']=$this->get_category_product($cat_id);
			$data['subview'] = 'Products_list.php';
		}
		
		
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

	public function home_product_view($pro_id)
	{
		$this->navigation->update_navigation(1);
		$this->premium_product_view($pro_id);
	}

	public function product_view($pro_id)
	{
		$this->load->model('Product_model');
		if($this->session->userdata('is_premium')==1 ){
			
			$this->premium_product_view($pro_id);
			$series_id=3;
		}
		else
		{
			if(!$this->session->userdata('navdata')){
				redirect($this->navigation->get_base_url() .'index.php/Home');
			}

			$product_cat='';
			/*if()*/
			$series_id = $this->Product_model->get_series_by_Pid($pro_id);
			
			$cat_id='';

			$data = array();
			switch ($series_id) {
				case 2:
					# E-series

					//get category
					$product_cat=$this->Product_model->get_category_name_by_id($pro_id);
					

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

					//get category
					$product_cat=$this->Product_model->get_category_name_by_id($pro_id);
					$series_id = $this->Product_model->get_series_by_Pid($pro_id);

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
					//get category
					$product_cat=$this->Product_model->get_category_name_by_id($pro_id);
					$series_id = $this->Product_model->get_series_by_Pid($pro_id);
				
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
	
	public function get_dimension_collection($dimension_id)
	{
		
		$result['premium_product_collection'] = $this->Premium_product_model->get_min_premium_collection_by_dimension_id($dimension_id);
		$result['base_url']= $this->navigation->get_includes_url();
		foreach ($result['premium_product_collection'] as $key => $value) {
			$result['premium_product_collection'][$key]['IP'] = ($value['Multiple_ip'] == 0 ? $value['IP'] : $value['Front_ip'].'/'.$value['Back_ip']);
            $result['premium_product_collection'][$key]['color'] = $this->Fitting_color_model->get_fitting_color_by_collection_id($value['Fitting_color_series_id']);
             $result['premium_product_collection'][$key]['CCT'] = (is_null($this->Enums->get_CCTRangeValues_byId($value['CCT'])) ? $value['CCT'] : $this->Enums->get_CCTRangeValues_byId($value['CCT']));
		}
		// dimension photo
		$dimension_type_id = $this->Premium_product_model->get_file_type_attachment('Dimension photo');
		$product_type_id = $this->Premium_product_model->get_file_type_attachment('Product photo');

		$result['dimension_photo'] = $this->Premium_product_model->get_premium_dimension_attachment($dimension_type_id,$dimension_id);
		$result['product_photo'] = $this->Premium_product_model->get_premium_dimension_attachment($product_type_id,$dimension_id);

		echo json_encode($result);
	}

	function collection_info($Collection_id)
	{
		$this->load->model('productSeries_model');
        $result = $this->Premium_product_model->get_total_premium_collection_by_id($Collection_id);

        $language = $this->Index_model->get_index('language');

        foreach ($language as $key => $value) {
        	$result->description[$value['Name']] = $this->Premium_product_model->get_premium_product_language($result->Premium_product_id,$value['ID']);
        }

        $result->opened_solution = null;
        $activated_solution = $this->navigation->get_active_category();
        if ($activated_solution) {
        	$result->opened_solution = $this->Index_model->get_value_by_id("solution",$activated_solution);
        }
        

		$result->CCT = (is_null($this->Enums->get_CCTRangeValues_byId($result->CCT)) ? $result->CCT : $this->Enums->get_CCTRangeValues_byId($result->CCT));

        $result->Shape=$this->Index_model->get_value_by_id('shape',$result->FittingShapeID);
        $result->AdjustableType = $this->Enums->get_AdjustableType_byId($result->AdjustableType);
        
        $result->color = $this->Fitting_color_model->get_fitting_color_by_collection_id($result->Fitting_color_series_id);
        
        $result->lighting_distributor = $this->Fitting_model->get_fitting_lighting_distributor_by_series_id($result->lighting_distributor_series_id);
        
        $product_photo_type_id = $this->Premium_product_model->get_product_photo_type_attachment();

        $dimension_photo_type_id = $this->Premium_product_model->get_dimension_photo_type_attachment();
        
        $result->product_photo = $this->Premium_product_model->get_premium_dimension_attachment($product_photo_type_id,$result->premium_product_family_dimension_id);
        $result->Dim_photo = $this->Premium_product_model->get_premium_dimension_attachment($dimension_photo_type_id,$result->premium_product_family_dimension_id);
        $result->accessories = $this->Accessory_model->get_accessory_by_premium_dimension_id($result->premium_product_family_dimension_id);
        $result->product_serial=str_pad($result->product_serial, 6, '0', STR_PAD_LEFT);
        $series_str = 'PR';
        foreach ($result->accessories as $key => $value) {
        	 $result->accessories[$key]['photos'] = $this->Accessory_model->get_accessory_image_by_id($value['Accessory_id']);
        	 $result->accessories[$key]['Code'] = $series_str.'-'.$value['Code'];
        }

        //get document files
        if($result->Led_id)
    	{
    		$LED_data = $this->LED_model->fetchMemberData($result->Led_id);
    		$LightSource=$this->get_referance_value('led_lightsource_type',$LED_data['LightSourceTypeID']);
			switch ($LightSource) {
				case 'Module':
					$type=$this->get_referance_value('led_type',$LED_data['Type']);
					break;
				case 'Tube':
					$type=$this->get_referance_value('pin_type',$LED_data['Type']);
					break;
				case 'Bulb':
					$type=$this->get_referance_value('socket_type',$LED_data['Type']);
					break;
				default:
					$type=$LED_data['Type'];
					break;
			}
			$result->LightSource = $LightSource;
			$result->type = $type;
			$result->LED_supplier = $this->get_referance_value('supplier',$LED_data['SupplierID']);
    		$result->LED_datasheet = $LED_data['Datasheet_file'];
    		/*$file_path = 'http://rafeed-srv5/rafeed/assets/App_files/Datasheet/Led/'.$LED_data['Datasheet_file'];
   			$result->LED_datasheet_size = filesize($file_path);*/
    	}
        else 
        	$result->LED_datasheet = null;

        $driver_data = $this->Premium_product_model->get_premium_collection_driver_by_id($Collection_id);
        $result->Driver_datasheet = null;
        foreach ($driver_data as $key => $value) {
        	$driver = $this->Driver_model->fetchMemberData($value['driver_id']);
        	$result->Input_Voltage = $this->get_range($driver['InputVoltageMin'],$driver['InputVoltageMax']);
        	$result->PowerFactor = $driver['PowerFactor'];
        	$supplier = $this->Supplier_model->get_supplier($driver['SupplierID']);
        	if ($supplier['is_brand']) {
        		$result->Driver_supplier = $supplier['Name'];
        	}
        	else
        		$result->Driver_supplier = null;
        	
        	$result->Driver_datasheet[$key] = $driver['Datasheet_file'];
        }

        //get attachment files
        $attach_files = $this->Premium_product_model->get_product_download_attachment_byPremium_id($result->Premium_product_id);
        foreach ($attach_files as $key => $value) {
        	$attach_files[$key]['file_type'] = $this->Index_model->get_value_by_id('attachment_type',$value['AttachmentTypeID']);
        }

        $result->attach_files = $attach_files;
//        var_dump($result);
      
        return $result;
	}

    function get_referance_value($table_name,$id)
	{
		return $this->Index_model->get_value_by_id($table_name,$id);

	}


    function get_collection_info($Collection_id)
    {
    	$result = $this->collection_info($Collection_id);
        echo json_encode($result);
    }

    function premium_datasheet_view($Collection_id)
	{
		/*require_once APPPATH .'third_party/mpdf7/src/Mpdf.php';
		$mpdf = new \Mpdf\Mpdf();
		$mpdf->WriteHTML('<h1>Hello world!</h1>');
		$mpdf->Output();*/
		ini_set('max_execution_time', 0);
        ini_set('memory_limit', '2024M');
        // load library
        ob_start();
        $pdf = $this->pdf->load();
        $pdf->SetFont('Helvetica-Neue-Light-ar');
        $pdf->SetFont('Helvetica-Neue-Light');
        //$pdf->AddFontDirectory(base_url().'assets/font');
        
        
        $data=$this->collection_info($Collection_id);

         //certification 
        $default_language=$this->Index_model->get_default_language();
        $premium_id = $data->Premium_product_id;
       	$premium_data = $this->Premium_product_model->get_premium_product_byId($premium_id);
       	$product_data=$this->Premium_product_model->get_product_by_id($premium_data['ProductId']);
       	$product_id = $premium_data['ProductId'];

       	if (!$data->LifeSpan) {
        	$data->LifeSpan = $premium_data['LifeSpan'];
        }

        
        $data->product_id=$product_id;
        $data->certification = $this->Premium_product_model->get_product_certification($product_id);
        $data->application = $this->Premium_product_model->get_product_application($product_id,$default_language);
        $data->product_category=$this->Index_model->get_value_by_id("product_category",$product_data['ProductCategoryID']);
        $data->installation_way = $this->Premium_product_model->get_product_installation_way($product_id,$default_language);
        $data->MinWorkingTemperature = $premium_data['MinWorkingTemperature'];
        $data->MaxWorkingTemperature =$premium_data['MaxWorkingTemperature'];

        $product_supplier = $this->get_referance_value('supplier',$premium_data['SupplierID']);

        if ($product_supplier == $data->Driver_supplier) {
        	$data->Driver_supplier=null;
        }

        $pdf->SetProtection(array('print-highres','print'), null, md5(time()), 128);

        $html = $this->load->view('report_template/datasheet/Datasheet', $data, true);
        $stylesheet = file_get_contents(base_url().'assets/report/datasheet.css');
        $pdf->WriteHTML($stylesheet,1);

        $stylesheet = file_get_contents(base_url().'assets/icons/rafeed/style.css');
        $pdf->WriteHTML($stylesheet,1);

        $pdf->SetTitle('datasheet');
        
        $pdf->SetKeywords();

        $pdf->SetAuthor('Rafeed');
        $pdf->SetCreator('Rafeed');
        $pdf->WriteHTML($html,2);
        //$this->load->view('report_template/datasheet/Datasheet',$data);	
        $output = 'datasheet' . date('Y_m_d_H_i_s') . '.pdf';
        ob_clean(); // cleaning the buffer before Output()
        ob_end_flush();
        $pdf->Output("$output", 'I');
	}

	function premium_datasheet_view2($Collection_id)
	{
		/*require_once APPPATH .'third_party/mpdf7/src/Mpdf.php';
		$mpdf = new \Mpdf\Mpdf();
		$mpdf->WriteHTML('<h1>Hello world!</h1>');
		$mpdf->Output();*/
		ini_set('max_execution_time', 0);
        ini_set('memory_limit', '2024M');
        // load library
        ob_start();
        $pdf = $this->pdf->load();
        $pdf->SetFont('Helvetica-Neue-Light-ar');
        $pdf->SetFont('Helvetica-Neue-Light');
        //$pdf->AddFontDirectory(base_url().'assets/font');
        
        
        $data=$this->collection_info($Collection_id);

         //certification 
        $default_language=$this->Index_model->get_default_language();
        $premium_id = $data->Premium_product_id;
       	$premium_data = $this->Premium_product_model->get_premium_product_byId($premium_id);
       	$product_data=$this->Premium_product_model->get_product_by_id($premium_data['ProductId']);
       	$product_id = $premium_data['ProductId'];
        
        $data->product_id=$product_id;
        $data->certification = $this->Premium_product_model->get_product_certification($product_id);
        $data->application = $this->Premium_product_model->get_product_application($product_id,$default_language);
        $data->product_category=$this->Index_model->get_value_by_id("product_category",$product_data['ProductCategoryID']);
        $data->installation_way = $this->Premium_product_model->get_product_installation_way($product_id,$default_language);
        $data->MinWorkingTemperature = $premium_data['MinWorkingTemperature'];
        $data->MaxWorkingTemperature =$premium_data['MaxWorkingTemperature'];

        $html = $this->load->view('report_template/datasheet/Datasheet2', $data, true);
        $stylesheet = file_get_contents(base_url().'assets/report/datasheet.css');
        $pdf->WriteHTML($stylesheet,1);

        $stylesheet = file_get_contents(base_url().'assets/icons/rafeed/style.css');
        $pdf->WriteHTML($stylesheet,1);
//        $pdf->SetFooter('<div style="text-align: center">wefd</div>');
        $pdf->SetTitle('datasheet');
        
        //$pdf->WriteHTML($stylesheet,1);
        $pdf->WriteHTML($html,2);
        //$this->load->view('report_template/datasheet/Datasheet',$data);	
        $output = 'family-report' . date('Y_m_d_H_i_s') . '_.pdf';
        ob_clean(); // cleaning the buffer before Output()
        ob_end_flush();
        $pdf->Output("$output", 'I');
	}
    
     public function premium_datasheet($Collection_id)
	{
		$data = $this->collection_info($Collection_id);

		 //certification 
        $default_language=$this->Index_model->get_default_language();
        $premium_id = $data->Premium_product_id;
       	$premium_data = $this->Premium_product_model->get_premium_product_byId($premium_id);
       	$product_data=$this->Premium_product_model->get_product_by_id($premium_data['ProductId']);
       	$product_id = $premium_data['ProductId'];
         $data->product_id=$product_id;
        $data->certification = $this->Premium_product_model->get_product_certification($product_id);
        $data->application = $this->Premium_product_model->get_product_application($product_id,$default_language);
        $data->product_category=$this->Index_model->get_value_by_id("product_category",$product_data['ProductCategoryID']);
        $data->installation_way = $this->Premium_product_model->get_product_installation_way($product_id,$default_language);
        $data->MinWorkingTemperature = $premium_data['MinWorkingTemperature'];
        $data->MaxWorkingTemperature =$premium_data['MaxWorkingTemperature'];
         
         
	    $this->load->view('report_template/datasheet/Datasheet',$data);	
	}

	public function premium_product_view($pro_id)
	{
		$language = $this->Index_model->get_index('language');
        $default_language=$this->Index_model->get_default_language();

        $product_id=$pro_id;

        $product_data=$this->Premium_product_model->get_product_by_id($product_id);
        
        $premium_product = $this->Premium_product_model->get_premium_product_byProduct_id($product_id);
        
        //product solution
         $solution_id = $product_data['ProductSolutionID'];
        if (is_null($product_data['ProductSolutionID'])) {
           $sol_str='';
            $solution_data = $this->Premium_product_model->get_product_solution($product_id,$default_language);

            foreach ($solution_data as $key => $value) {
                $sol_str .= $value['Name'];
                if($key !== count($solution_data) -1 )
                {
                    $sol_str.=' & ';
                }
                $solution_id = $value['ID'];
            }
            $data['product_solution']=$sol_str; 
        }
        else{
            	$data['product_solution']=$this->Index_model->get_value_by_id("solution",$product_data['ProductSolutionID']);
            	//$solution_id =$product_data['ProductSolutionID'];
    	}





        //end product solution

        $premium_language = $this->Premium_product_model->get_premium_product_language($premium_product["ID"],$default_language);
        $data['Product_id'] = $product_id;
        $data['family_name']=$premium_language[0]['Family_name'];
        $data['description']=$premium_language[0]['Family_description'];
        $data['datasheet_description']=$premium_language[0]['datasheet_description'];
        $data['product_category']=$this->Index_model->get_value_by_id("product_category",$product_data['ProductCategoryID']);

        $data['WorkingTemperature'] = $premium_product['MinWorkingTemperature'] ."°C - ".$premium_product['MaxWorkingTemperature'].'°C';

        $data['LightingSource'] = array(
            'LightingSourceType' => $this->Enums->get_BaseFixture_byId($premium_product['LightingSource']),
            'SocketType' => $this->Index_model->get_value_by_id("socket_type",$premium_product['SocketTypeID']),
            'PinType' => $this->Index_model->get_value_by_id("pin_type",$premium_product['PinTypeID']),
            'Firerated' => $premium_product['Firerated'] ==0 ? 'not': ''
        );

        //get main photos
        $product_attachment = $this->Premium_product_model->get_product_attachment_byProduct_id($product_id);
        $main_photo_id=$this->Premium_product_model->get_attachment_id_by_type('Main family photo (solo)');
        $application_photo_id=$this->Premium_product_model->get_attachment_id_by_type('Main photo (application)');

        foreach ($product_attachment as $key_att => $value_att) {
            switch ($value_att['AttachmentTypeID']) {
                case $main_photo_id:
                    $data['family_photo'] = $value_att['FileName'];
                    break;
                
                case $application_photo_id:
                    $data['application_photo'] = $value_att['FileName'];
                    break;
            }
        }
        //end get main photos

        $data['application'] = $this->Premium_product_model->get_product_application($product_id,$default_language);
        $data['certification'] = $this->Premium_product_model->get_product_certification($product_id);
        $data['installation_way'] = $this->Premium_product_model->get_product_installation_way($product_id,$default_language);
        
        //dimension data
        $data['dimension_data']= $this->Premium_product_model->get_premium_dimension($premium_product["ID"]);
        $product_photo_type_id = $this->Premium_product_model->get_product_photo_type_attachment();

        $dimension_photo_type_id = $this->Premium_product_model->get_dimension_photo_type_attachment();
        
        foreach ($data['dimension_data'] as $key => $value) {
            $data['dimension_data'][$key]['FittingShape'] = $this->Index_model->get_value_by_id("shape",$value['FittingShapeID']);
            $data['dimension_data'][$key]['AdjustableType'] = $this->Enums->get_AdjustableType_byId($value['AdjustableType']);
            $data['dimension_data'][$key]['product_id'] = $product_id;
            if(is_null($value["product_photo"])){
                $data['dimension_data'][$key]["product_photo"] = $this->Premium_product_model->get_premium_dimension_attachment($product_photo_type_id,$value["ID"]);
                $data['dimension_data'][$key]["Dim_photo"] = $this->Premium_product_model->get_premium_dimension_attachment($dimension_photo_type_id,$value["ID"]);
            }
        }

        $data['accessory_data'] = null;
        if ($data['dimension_data'][0]['Wires']) {
        	$accessory_data = $this->Accessory_model->get_rail_accessory($data['dimension_data'][0]['Wires']);
        	foreach ($accessory_data as $key => $value) {
        		$series_str = $this->ProductSeries_model->get_series_str($value['Series_id']);
        		$accessory_data[$key]['Code'] = $series_str.'-'.$value['Code'];
        		$accessory_data[$key]['rail_installation_way'] = $this->Index_model->get_value_by_id("installation_way",$value['rail_installation_way']);
        	}
        	$data['accessory_data'] = $accessory_data;
        }


        //led type Model 

        
        $installation_way_data = array();
        $installation_way_data2 = array();
        if (empty($data['installation_way'])) {
            $installation_way_data = array_unique(array_column($product_collection, 'installation_way_id'));
            foreach ($installation_way_data as $key => $value) {
                $installation_way_data2[$key]['Name'] = $this->Index_model->get_value_by_id("installation_way",$value);
            }
            $data['installation_way'] = $installation_way_data2;
        }
            
        // boost the memory limit if it's low ;)
        $data['subview'] = 'premium_product.php';
		$data['pageTitle']='Premium - '.$data['product_category'].' - '.$data['family_name'];

		$this->load->library("navigation");
		$this->navigation->update_navigation(1,$solution_id);
	
		$this->load->view('layouts/layout.php',$data);	
	}


}


<?php

/* @property mpdf_model $mpdf_model */
class Print_pdf  extends CI_Controller {
    

    function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('Premium_product_model');
        $this->load->model('Installation_way_model');
        $this->load->model('Fitting_color_model');
        $this->load->model('ProductSeries_model');
        $this->load->model('Fitting_model');
        $this->load->model('Driver_model');
        $this->load->model('LED_model');
        $this->load->model('Index_model');
        $this->load->model('Accessory_model');
        $this->load->model('Enums');
        $this->load->model('Supplier_model');
        $this->load->library('pdf');
    }

    function premium_family_report($id)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '2024M');
        // load library
        ob_start();
        $pdf = $this->pdf->load();

        $pdf->SetFont('Helvetica-Neue-MdCn');

        $stylesheet = file_get_contents(base_url().'/assets/report/premium_family_theme.css');

        $language = $this->Index_model->get_index('language');
        $default_language=$this->Index_model->get_default_language();
   
       $product_id=$id;

        $data['cover_data']=$this->Product_model->get_product_by_id($product_id);
        
        $premium_product = $this->Premium_product_model->get_premium_product_byProduct_id($product_id);
    
        //product solution

        if (is_null($data['cover_data']['ProductSolutionID'])) {
           $sol_str='';
            $solution_data = $this->Product_model->get_product_solution($product_id,$default_language);
            var_dump($solution_data);
            foreach ($solution_data as $key => $value) {
                $sol_str .= $value['Name'];
                if($key !== count($solution_data) -1 )
                {
                    $sol_str.=' & ';
                }
            }
            $data['cover_data']['product_solution']=$sol_str; 
        }
        else
            $data['cover_data']['product_solution']=$this->Index_model->get_value_by_id("solution",$data['cover_data']['ProductSolutionID']);

        $premium_language = $this->Premium_product_model->get_premium_product_language($premium_product["ID"],$default_language);
        $data['cover_data']['family_name']=$premium_language[0]['Family_name'];
        $data['cover_data']['product_category']=$this->Index_model->get_value_by_id("product_category",$data['cover_data']['ProductCategoryID']);
        
        $Family_name = $data['cover_data']['family_name'];
        $product_type_code = $this->Index_model->get_category_code($data['cover_data']['ProductCategoryID']);

        $data['basic_data'] = array(
            'Category' => $data['cover_data']['product_category'],
            'Solution' => $data['cover_data']['product_solution'],
            'PremiumType' => $this->Index_model->get_value_by_id("premium_type",$premium_product['PremiumTypeID']),
            'FinishedPremium' => $premium_product['FinishedPremium'] ==0? "SKD" :"finished",
            'LightingSource' => $this->Enums->get_BaseFixture_byId($premium_product['LightingSource']),
            'SocketType' => $this->Index_model->get_value_by_id("socket_type",$premium_product['SocketTypeID']),
            'PinType' => $this->Index_model->get_value_by_id("pin_type",$premium_product['PinTypeID']),
            'Firerated' => $premium_product['Firerated'] ==0 ? 'not': '',
            'WorkingTemperature' => $premium_product['MinWorkingTemperature'] ."°C - ".$premium_product['MaxWorkingTemperature'].'°C',
            'Supplier' => $this->Supplier_model->get_supplier($premium_product['SupplierID']),
            'Product_id' => $product_id
             );

        $product_attachment = $this->Product_model->get_product_attachment_byProduct_id($product_id);
        $main_photo_id=$this->Product_model->get_attachment_id_by_type('Main family photo (solo)');
        $application_photo_id=$this->Product_model->get_attachment_id_by_type('Main photo (application)');
        foreach ($product_attachment as $key_att => $value_att) {
            switch ($value_att['AttachmentTypeID']) {
                case $main_photo_id:
                    $data['basic_data']['family_photo'] = $value_att['FileName'];
                    break;
                
                case $application_photo_id:
                    $data['basic_data']['application_photo'] = $value_att['FileName'];
                    break;
            }
        }
        
        $data['basic_data']['application'] = $this->Product_model->get_product_application($product_id,$default_language);
        $data['basic_data']['certification'] = $this->Product_model->get_product_certification($product_id);
        $data['basic_data']['installation_way'] = $this->Product_model->get_product_installation_way($product_id,$default_language);
        

        $data['basic_data']['Family_language']=$premium_language;

        $data['dimension_data']= $this->Premium_product_model->get_premium_dimension($premium_product["ID"]);
        $product_photo_type_id = $this->Product_model->get_product_photo_type_attachment();

        $dimension_photo_type_id = $this->Product_model->get_dimension_photo_type_attachment();
        
        foreach ($data['dimension_data'] as $key => $value) {
            $data['dimension_data'][$key]['FittingShape'] = $this->Index_model->get_value_by_id("shape",$value['FittingShapeID']);
            $data['dimension_data'][$key]['AdjustableType'] = $this->Enums->get_AdjustableType_byId($value['AdjustableType']);
            $data['dimension_data'][$key]['product_id'] = $product_id;
            if(is_null($value["product_photo"])){
                $data['dimension_data'][$key]["product_photo"] = $this->Premium_product_model->get_premium_dimension_attachment($product_photo_type_id,$value["ID"]);
                $data['dimension_data'][$key]["Dim_photo"] = $this->Premium_product_model->get_premium_dimension_attachment($dimension_photo_type_id,$value["ID"]);
            }
        }

        $product_collection = $this->Premium_product_model->get_premium_collection_by_dimension_id(array_column($data['dimension_data'], 'ID'));
        if($product_collection) 
        {
            //color_data
            $product_color_series = array_unique(array_column($product_collection, 'Fitting_color_series_id'));
             $product_color_series_photo2 = array_unique(array_column($product_collection, 'color_series_photo'));

            $color_series_data = array();
            $color_series_id_data = array();
            $product_color_series_photo = array();

            foreach ($product_color_series as $key => $value) {
                array_push($color_series_data, $this->Fitting_color_model->get_fitting_color_by_collection_id($value));
                array_push($color_series_id_data, $value);
                array_push($product_color_series_photo, $product_color_series_photo2[$key]);
            }
            
            $data['color_data'] = array('color_series_data' =>$color_series_data ,'color_series_photo_data' => $product_color_series_photo,'Product_id' => $product_id ) ;

            $dimension_id=0;
            $driver_data = array();
            $installation_way_data = array();
            foreach ($product_collection as $key => $value) {
                if (is_null($value['LightingDistributionKindID'])) {
                    $lighting_distribution_date = $this->Fitting_model->get_fitting_lighting_distributor_by_series_id($value['lighting_distributor_series_id']);
                    $kind='';
                    $texture='';
                    foreach ($lighting_distribution_date as $key_dis => $value_dis) {
                        $kind .= $value_dis['kind'].', ';
                        $texture .= $value_dis['color'] .'/'. $value_dis['material'];
                        if($key_dis !== count($lighting_distribution_date) -1 )
                            {
                                $kind.='</br>';
                                $texture.='</br>';
                            }
                    }
                    $product_collection[$key]['LightingDisturbationKind'] = $kind;
                    $product_collection[$key]['texture'] = $texture;
                }
                else{
                    $product_collection[$key]['LightingDisturbationKind'] = $this->Index_model->get_value_by_id("lighting_distribution_kind",$value['LightingDistributionKindID']);
                    $color_id=$this->Fitting_color_model->get_color_texture_by_id($value['LightingDistributionTextureID']);
                    if($color_id)
                        $product_collection[$key]['texture'] = $this->Index_model->get_value_by_id('color', $color_id['ColorID']). '/ '. $this->Index_model->get_value_by_id('material', $color_id['MaterialID']);
                }

                $product_collection[$key]['IP'] = ($value['Multiple_ip'] == 0 ? $value['IP'] : $value['Front_ip'].'/'.$value['Back_ip']);
                $product_collection[$key]['CCT'] = (is_null($this->Enums->get_CCTRangeValues_byId($value['CCT'])) ? $value['CCT'] : $this->Enums->get_CCTRangeValues_byId($value['CCT']));
                
                $driver_ids = $this->Premium_product_model->get_premium_collection_driver_by_id($value['ID']);
                $drivers = array();

                foreach ($driver_ids as $key_driver => $value_driver) {
                    $driver=$this->Driver_model->get_by_id($value_driver['driver_id']);
                    $drivers[$key_driver] = $driver['Code'];
                    array_push($driver_data,  $driver);
                }

                $product_collection[$key]['driver'] = implode(', ',$drivers);
                

                //calc series id
                $product_collection[$key]['color_series']= array_search($value['Fitting_color_series_id'],$color_series_id_data) +1;
                if($key!=0)
                    if($value['premium_product_family_dimension_id'] != $product_collection[$key-1]['premium_product_family_dimension_id'])
                        $dimension_id++;
            }

            $data['collection_data'] = $product_collection;
            $installation_way_data = array();
            $installation_way_data2 = array();
            if (empty($data['basic_data']['installation_way'])) {
                $installation_way_data = array_unique(array_column($product_collection, 'installation_way_id'));
                foreach ($installation_way_data as $key => $value) {
                    $installation_way_data2[$key]['Name'] = $this->Index_model->get_value_by_id("installation_way",$value);
                }
                $data['basic_data']['installation_way'] = $installation_way_data2;
            }

            //LED Data
            $product_led = array_unique(array_column($product_collection, 'Led_id'));
            $product_CCT = array_unique(array_column($product_collection, 'CCT'));
            $product_CRI = array_unique(array_column($product_collection, 'CRI'));

            //$LED_data = $this->LED_model->get_led_by_optionID($product_led_option);
            $LED_data = $this->LED_model->get_LED_by_ids($product_led);
            foreach ($LED_data as $key => $value) {
                $LED_data[$key]['LightSourceTypeID'] = $this->Index_model->get_value_by_id('led_lightsource_type',$value['LightSourceTypeID']);
                $LED_data[$key]['OriginCountryID'] = $this->Index_model->get_value_by_id('country',$value['OriginCountryID']);
                $CCT_option='';
                $CRI_option='';
                $LED_data[$key]['CCT']=$CCT_option;
                $LED_data[$key]['CRI']=$CRI_option;
            }
            $data['led_data'] = $LED_data;

            $driver_data = array_unique($driver_data, SORT_REGULAR);
            foreach ($driver_data as $key => $value) {
                $driver_data[$key]['DriverType'] = $this->Enums->get_DriverType_byId($value['DriverType']);
                $driver_data[$key]['OutputType'] = $this->Enums->get_DriverOutputType_byId($value['OutputType']);
                $driver_data[$key]['PowerFactor'] = (is_null($value['PowerFactor'])? '-': $value['PowerFactor']); 
                $driver_data[$key]['OriginCountryID'] = $this->Index_model->get_value_by_id('country',$value['OriginCountryID']);
                $driver_data[$key]['InputVoltage'] = (is_null($value['InputVoltageMin'])? '-': $this->global_function->get_range($value['InputVoltageMin'],$value['InputVoltageMax']).' V');
                $driver_data[$key]['OutputVoltage'] = (is_null($value['OutputVoltageMin'])? '-': $this->global_function->get_range($value['OutputVoltageMin'],$value['OutputVoltageMax']).' V');
                 $driver_data[$key]['OutputCurrent'] = (is_null($value['OutputCurrentMin'])? '-': $this->global_function->get_range($value['OutputCurrentMin'],$value['OutputCurrentMin']).' mA');
                $Supplier = $this->Supplier_model->get_supplier($value['SupplierID']);
                $driver_data[$key]['SupplierID'] = $Supplier['Name'];
            }
            $data['driver_data'] = $driver_data;
        }
        else
        {
            $data['driver_data']=null;
            $data['led_data']=null;
            $data['collection_data']=null;
        }
        // boost the memory limit if it's low ;)
        $html = $this->load->view('report_template/content/mpdf', $data, true);

        // render the view into HTML
        $pdf->WriteHTML($stylesheet,1);
        $pdf->WriteHTML($html,2);

        // write the HTML into the PDF
        $output = $data['cover_data']['family_name'].'_family-report' . date('Y_m_d_H_i_s') . '_.pdf';
        ob_clean(); // cleaning the buffer before Output()
        ob_end_flush();
        $pdf->Output("$output", 'I');
    }
}
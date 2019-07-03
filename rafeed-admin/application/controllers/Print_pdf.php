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
        $this->load->model('Economic_product_model');
        
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
   
        // retrieve data from model
        //$data['news'] = $this->mpdf_model->get_news();
        /*$data['news']  = array('ne_title' => 'koko','ne_desc'=>'12' );;
        $data['title'] = "items";*/
        $product_id=$id;

        $data['cover_data']=$this->Product_model->get_product_by_id($product_id);
        
        $premium_product = $this->Premium_product_model->get_premium_product_byProduct_id($product_id);
        
        //$premium_product = $this->Premium_product_model->get_premium_product_byProduct_id($product_id);
        //product solution

        if (is_null($data['cover_data']['ProductSolutionID'])) {
           $sol_str='';
            $solution_data = $this->Product_model->get_product_solution($product_id,$default_language);
            //var_dump($solution_data);
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
        //$data['basic_data']['application'][0] = $this->Product_model->get_product_application($premium_product["ID"],1);//must set product 
      /*  foreach ($language as $key => $value) {
            $data['basic_data']['application'][$key] = $this->Product_model->get_product_application($premium_product["ID"],$value['ID']);//must set product id not premium
        }*/
        
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
            $product_color_series_photo = array_column($product_collection, 'color_series_photo');

            $color_series_data = array();

            foreach ($product_color_series as $key => $value) {
                $color_series_data[$key] = $this->Fitting_color_model->get_fitting_color_by_collection_id($value);
            }
            
            $data['color_data'] = array('color_series_data' =>$color_series_data ,'color_series_photo_data' => $product_color_series_photo,'Product_id' => $product_id ) ;
           
            $dimension_id=0;
            $driver_data = array();
            $installation_way_data = array();
            foreach ($product_collection as $key => $value) {
                
                //$product_collection[$key]['Installation_way'] = $this->Index_model->get_value_by_id("installation_way",$value['installation_way_id']);
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
                $product_collection[$key]['color_series']= array_search($value['Fitting_color_series_id'],$product_color_series) +1;
                //$product_collection[$key]['code'] = "PR-".$product_type_code."-".strtoupper(substr($Family_name, 0, 3)).
                //                                            $value['Power']."-".str_pad(($data['dimension_data'][$dimension_id]['serial_num']), 2, '0', STR_PAD_LEFT)."-".str_pad($value['serial_num'], 5, '0', STR_PAD_LEFT);
                //$product_collection[$key]['code'] = $this->product_coding->get_premium_code($product_type_code,$Family_name, $value['Power'],$data['dimension_data'][$dimension_id]['serial_num'],$value['serial_num']);
                //$product_collection[$key]['code'] 
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
                /*$LED_option=$this->LED_model->get_led_option($value['ID']);
                if($LED_option){
                    $CRI_option=array_unique(array_column($LED_option, 'CRI'));
                    $CCT_option =array_unique(array_column($LED_option, 'CCT'));
                    $CCT_option=implode(",",$CCT_option);
                    $CRI_option=implode(",",$CRI_option);
                }
                else{
                    $CCT_option='';
                    $CRI_option='';
                }*/
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
                $driver_data[$key]['InputVoltage'] = (is_null($value['InputVoltageMin'])? '-': $this->get_range($value['InputVoltageMin'],$value['InputVoltageMax']).' V');
                $driver_data[$key]['OutputVoltage'] = (is_null($value['OutputVoltageMin'])? '-': $this->get_range($value['OutputVoltageMin'],$value['OutputVoltageMax']).' V');
                 $driver_data[$key]['OutputCurrent'] = (is_null($value['OutputCurrentMin'])? '-': $this->get_range($value['OutputCurrentMin'],$value['OutputCurrentMin']).' mA');
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
        $html = $this->load->view('report_template/premium_family_report/report', $data, true);
        // render the view into HTML
        /*$pdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
        $pdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);*/

        
        $pdf->WriteHTML($stylesheet,1);
        $pdf->WriteHTML($html,2);
        //$pdf->WriteHTML($html);
        // write the HTML into the PDF
        $output = 'family-report' . date('Y_m_d_H_i_s') . '_.pdf';
        ob_clean(); // cleaning the buffer before Output()
        ob_end_flush();
        $pdf->Output("$output", 'I');
        // save to file because we can exit();
        // - See more at: http://webeasystep.com/blog/view_article/codeigniter_tutorial_pdf_to_create_your_reports#sthash.QFCyVGLu.dpuf
    }

    function economic_family_report($id)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '2024M');
        // load library
        ob_start();
        $pdf = $this->pdf->load('L');
        //$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
        $pdf->SetTitle('My Title');
        $pdf->SetFont('Helvetica-Neue-MdCn');

        $stylesheet = file_get_contents(base_url().'/assets/report/economic_family_theme.css');
        $language = $this->Index_model->get_index('language');
        $default_language=$this->Index_model->get_default_language();

        $product_id=$id;

        $data['cover_data']= $this->Product_model->get_product_by_id($product_id);
        $economic_product = $this->Economic_product_model->fetchMemberData($product_id);
        $data['cover_data']['family_name']=$economic_product['Family_name'];
        //$data['cover_data']['family_description']=$economic_product['Family_description'];
        $data['cover_data']['product_category']=$this->Index_model->get_value_by_id("product_category",$data['cover_data']['ProductCategoryID']);

        $data['basic_data'] = array(
            'Category' => $data['cover_data']['product_category'],
            'Firerated' => $economic_product['Firerated'] ==0 ? 'not': '',
            'WorkingTemperature' => $economic_product['MinWorkingTemperature'] ."°C - ".$economic_product['MaxWorkingTemperature'].'°C',
            'Supplier' => $this->Supplier_model->get_supplier($economic_product['SupplierID']),
            'Life_span' => $economic_product['LifeSpan'],
            'Warranty' => $economic_product['Warranty'],
            'Product_id' => $product_id
             );

        $data['basic_data']['application'] = $this->Product_model->get_product_application($product_id,$default_language);
        $data['basic_data']['certification'] = $this->Product_model->get_product_certification($product_id);
        $data['basic_data']['installation_way'] = $this->Product_model->get_product_installation_way($product_id,$default_language);

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

        $product_collection = $this->Economic_product_model->get_collection_by_economic_id($economic_product['economic_product_id']);
       /* echo $economic_product['ID'];
        var_dump($product_collection);*/
        if($product_collection) 
        {
            foreach ($product_collection as $key => $value) {

                $product_collection[$key]['FittingShape'] = $this->Index_model->get_value_by_id("shape",$value['FittingShapeID']);
                $product_collection[$key]['AdjustableType'] = $this->Enums->get_AdjustableType_byId($value['AdjustableType']);
                //color_data
                $color='';
                $color_val = $this->Fitting_color_model->get_fitting_color_by_collection_id($value['Fitting_color_series_id']);
                foreach ($color_val as $key => $value_color) {
                     $color .= $value_color['part'].' - '.$value_color['color'].'-'.$value_color['material'].'<img hight=30 width=30 src='.base_url().'assets/App_files/Texture/'.$value_color['Texture_photo'];
                      }
                $product_collection[$key]['color'] =  $color;
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
                $product_collection[$key]['IP'] = ($value['Multiple_ip'] == 0 ? $value['IP'] : $value['Front_ip'].'/'.$value['Back_ip']);
                $product_collection[$key]['CCT'] = (is_null($this->Enums->get_CCTRangeValues_byId($value['CCT'])) ? $value['CCT'] : $this->Enums->get_CCTRangeValues_byId($value['CCT']));
            }
        }

        $data['collection_data'] = $product_collection;
        $html = $this->load->view('report_template/economic_family_report/report', $data, true);
        //$this->load->view('report_template/economic_family_report/report', $data);

        $pdf->SetTitle($economic_product['Family_name']);
        
        $pdf->WriteHTML($stylesheet,1);
        $pdf->WriteHTML($html,2);
        $output = 'family-report' . date('Y_m_d_H_i_s') . '_.pdf';
        ob_clean(); // cleaning the buffer before Output()
        ob_end_flush();
        $pdf->Output("$output", 'I');
    }
    function view_report($id)
    {
        
         $language = $this->Index_model->get_index('language');
        $default_language=$this->Index_model->get_default_language();
   
        // retrieve data from model
        //$data['news'] = $this->mpdf_model->get_news();
        $data['news']  = array('ne_title' => 'koko','ne_desc'=>'12' );;
        $data['title'] = "items";
        $product_id=$id;

        $data['cover_data']=$this->Product_model->get_product_by_id($product_id);
        
        $premium_product = $this->Premium_product_model->get_premium_product_byProduct_id($product_id);
        
        //$premium_product = $this->Premium_product_model->get_premium_product_byProduct_id($product_id);
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
        


        //$data['basic_data']['application'][0] = $this->Product_model->get_product_application($premium_product["ID"],1);//must set product 
      /*  foreach ($language as $key => $value) {
            $data['basic_data']['application'][$key] = $this->Product_model->get_product_application($premium_product["ID"],$value['ID']);//must set product id not premium
        }*/
        
        $data['basic_data']['application'] = $this->Product_model->get_product_application($product_id,$default_language);
        $data['basic_data']['certification'] = $this->Product_model->get_product_certification($product_id);
        $data['basic_data']['installation_way'] = $this->Product_model->get_product_installation_way($product_id,$default_language);
        //get applicaation photo
        $product_attachment = $this->Product_model->get_product_attachment_byProduct_id($product_id);

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
            $product_color_series_photo = array_column($product_collection, 'color_series_photo');

            $color_series_data = array();
            $color_series_id_data = array();

            foreach ($product_color_series as $key => $value) {
                array_push($color_series_data, $this->Fitting_color_model->get_fitting_color_by_collection_id($value));
                array_push($color_series_id_data, $value);
            }
            
            $data['color_data'] = array('color_series_data' =>$color_series_data ,'color_series_photo_data' => $product_color_series_photo,'Product_id' => $product_id ) ;
           
            $dimension_id=0;
            $driver_data = array();
            $installation_way_data = array();
            foreach ($product_collection as $key => $value) {

               
                //$product_collection[$key]['Installation_way'] = $this->Index_model->get_value_by_id("installation_way",$value['installation_way_id']);
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
                //$product_collection[$key]['code'] = "PR-".$product_type_code."-".strtoupper(substr($Family_name, 0, 3)).
                //                                            $value['Power']."-".str_pad(($data['dimension_data'][$dimension_id]['serial_num']), 2, '0', STR_PAD_LEFT)."-".str_pad($value['serial_num'], 5, '0', STR_PAD_LEFT);
                //$product_collection[$key]['code'] = $this->product_coding->get_premium_code($product_type_code,$Family_name, $value['Power'],$data['dimension_data'][$dimension_id]['serial_num'],$value['serial_num']);
                //$product_collection[$key]['code'] 
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
                /*$LED_option=$this->LED_model->get_led_option($value['ID']);
                if($LED_option){
                    $CRI_option=array_unique(array_column($LED_option, 'CRI'));
                    $CCT_option =array_unique(array_column($LED_option, 'CCT'));
                    $CCT_option=implode(",",$CCT_option);
                    $CRI_option=implode(",",$CRI_option);
                }
                else{
                    $CCT_option='';
                    $CRI_option='';
                }*/
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
                $driver_data[$key]['InputVoltage'] = (is_null($value['InputVoltageMin'])? '-': $this->get_range($value['InputVoltageMin'],$value['InputVoltageMax']).' V');
                $driver_data[$key]['OutputVoltage'] = (is_null($value['OutputVoltageMin'])? '-': $this->get_range($value['OutputVoltageMin'],$value['OutputVoltageMax']).' V');
                 $driver_data[$key]['OutputCurrent'] = (is_null($value['OutputCurrentMin'])? '-': $this->get_range($value['OutputCurrentMin'],$value['OutputCurrentMin']).' mA');
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
        
        $this->load->view('report_template/content/mpdf', $data);
    }
}
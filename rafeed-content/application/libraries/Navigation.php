<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 class navigation {

 	function __construct()
    {
    	
    }

    public function get_base_url()
    {
    	$http = 'http' . ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 's' : '') . '://';
		$newurl = $http . $_SERVER['SERVER_NAME'] .$_SERVER['SCRIPT_NAME'];
    	return $newurl;
    }

    public function get_includes_url()
    {
    	$http = 'http' . ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 's' : '') . '://';
		$newurl = str_replace("index.php","", $_SERVER['SCRIPT_NAME']);
		$newurl = $http . $_SERVER['SERVER_NAME'] .$newurl.'/rafeed-includes';
    	return $newurl;
    }

	public function set_navigation(){
			
			$CI =& get_instance();

			//load libraries
			$CI->load->database();
			$CI->load->library("session");
		  	//echo 'Variable is not set';
			$CI->load->model("ProductSeries_model");
			$series=$CI->ProductSeries_model->fetch_date();

			foreach ($series as $key => $value) {
				$series[$key]['active']=0;
				$series[$key]['catergory']=$CI->ProductSeries_model->get_series_category($value['ID']);
				foreach ($series[$key]['catergory'] as $key2 => $value2) {
					$series[$key]['catergory'][$key2]['active']=0;
				}
				//$series[$key]['catergory']['active']=0;
			}
			return $series;

			//$CI->session->set_userdata('navdata',$series);
		//}
	}

	public function update_navigation($series_id=0,$cat_id=0)
	{
		$CI =& get_instance();

		//load libraries
		$CI->load->database();
		$CI->load->library("session");
		  	//echo 'Variable is not set';
		$CI->load->model("Product_model");
		if(!$CI->session->userdata('navdata'))
		{
			$CI->session->set_userdata('navdata',$this->set_navigation());

		}

		$temp = $CI->session->userdata('navdata'); 

		if($series_id==0){
			$series_id=$CI->Product_model->get_series_by_category($cat_id);
		}
		foreach ($temp as $key => $value) {
			if($value['ID']==$series_id){
				$temp[$key]['active'] = 1;
				if($cat_id==0){
					if($value['catergory'][0])
					{
						$cat_id=$value['catergory'][0]['ID'];
						$temp[$key]['catergory'][0]['active']=1;
					}
				}
				else{
					foreach ($temp[$key]['catergory'] as $key2 => $value2) {
					if($value2['ID']==$cat_id){
						$temp[$key]['catergory'][$key2]['active']=1;
					}
					else
						$temp[$key]['catergory'][$key2]['active']=0;
					}
				}
			}
			else {
				$temp[$key]['active'] = 0;
				foreach ($temp[$key]['catergory'] as $key2 => $value2) {
					$temp[$key]['catergory'][$key2]['active']=0;
				}
			}
		}

		$CI->session->set_userdata('navdata', $temp);  
		return $cat_id;
	}

 }
?>
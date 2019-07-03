<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 class Navigation {

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
		$CI->ui_language->get_website_language();
		//load libraries
		$CI->load->database();
		$CI->load->library("session");
		//echo 'Variable is not set';
		$CI->load->model("ProductSeries_model");
		$series=$CI->ProductSeries_model->fetch_date();
		
		foreach ($series as $key => $value) {
			$series[$key]['active']=0;
			//premium
			if($value['ID'] == $CI->ProductSeries_model->get_premium_id())
				$series[$key]['category'] = $CI->ProductSeries_model->get_premium_solution();
			else
				$series[$key]['category']=$CI->ProductSeries_model->old_get_series_category($value['ID']);
			
			foreach ($series[$key]['category'] as $key2 => $value2) {
				$series[$key]['category'][$key2]['active']=0;
			}
			//$series[$key]['category']['active']=0;
		}
		$CI->session->set_userdata('is_premium',0);
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
		
		$CI->load->model("Product_model");
		$CI->load->model("ProductSeries_model");

		if(!$CI->session->userdata('navdata'))
		{
			$CI->session->set_userdata('navdata',$this->set_navigation());
		}

		$temp = $CI->session->userdata('navdata');

		if($series_id == $CI->ProductSeries_model->get_premium_id())
			$CI->session->set_userdata('is_premium',1);
		elseif ($series_id != 0) {
			$CI->session->set_userdata('is_premium',0);
		}
			
		if($series_id==0)
		 	if($CI->session->userdata('is_premium')==0){
				$series_id=$CI->Product_model->get_series_by_category($cat_id);
			}
			else {
				$series_id = $CI->ProductSeries_model->get_premium_id();
			}
		/*if($CI->session->userdata('is_premium') || $series_id == $CI->ProductSeries_model->get_premium_id()){
			//get solution
			$solution_data = $CI->ProductSeries_model->get_premium_solution();
			
			foreach ($solution_data as $key => $value) {
				if($value['ID'] == $cat_id)
					$solution_data[$key]['active']=1;
				else 
					$solution_data[$key]['active']=0;
			}
			$CI->session->set_userdata('is_premium',1);
		}
		else{
			//$series_id = $CI->Product_model->get_series_by_category($cat_id);
		}*/

		foreach ($temp as $key => $value) {
			if($value['ID']==$series_id){
				$temp[$key]['active'] = 1;
				if($cat_id===0){
					if($value['category'][0])
					{
						foreach ($temp[$key]['category'] as $key2 => $value2) {
							$temp[$key]['category'][$key2]['active']=0;
						}
						
						$cat_id=$value['category'][0]['ID'];
						$temp[$key]['category'][0]['active']=1;
					}
				}
				else{
					foreach ($temp[$key]['category'] as $key2 => $value2) {
					if($value2['ID']==$cat_id){
						$temp[$key]['category'][$key2]['active']=1;
					}
					else
						$temp[$key]['category'][$key2]['active']=0;
					}
				}
			}
			else {
				$temp[$key]['active'] = 0;
				foreach ($temp[$key]['category'] as $key2 => $value2) {
					$temp[$key]['category'][$key2]['active']=0;
				}
			}
		}
		$CI->session->set_userdata('navdata', $temp);  
		return $cat_id;
	}

	function get_active_category(){
		$CI =& get_instance();

		//load libraries
		$CI->load->database();
		$CI->load->library("session");
		
		if(!$CI->session->userdata('navdata'))
		{
			$CI->session->set_userdata('navdata',$this->set_navigation());
		}

		$temp = $CI->session->userdata('navdata');
		foreach ($temp as $key => $value) {
			if($value['active']==1){
				foreach ($value['category'] as $key2 => $value2) {
					if($value2['active']==1)
						return $value2['ID'];
				}
			}
		}
	}
	function update_secoundary_nav($navdata)
	{
		$category = array();

		/*foreach ($navdata as $key => $value) {
			array_push(array(
				'ID' => ,
				'Name' => ,
				'icon' => ,
				'active' => 
			),$category);
		}
		foreach ($temp as $key => $value) {
			if($value['ID']==$series_id){
				$temp[$key]['active'] = 1;
				if($cat_id==0){
					if($value['category'][0])
					{
						$cat_id=$value['category'][0]['ID'];
						$temp[$key]['category'][0]['active']=1;
					}
				}
				else{
					foreach ($temp[$key]['category'] as $key2 => $value2) {
						if($value2['ID']==$cat_id){
							$temp[$key]['category'][$key2]['active']=1;
						}
						else
							$temp[$key]['category'][$key2]['active']=0;
						}
					}
			}
			else {
				$temp[$key]['active'] = 0;
				foreach ($temp[$key]['category'] as $key2 => $value2) {
					$temp[$key]['category'][$key2]['active']=0;
				}
			}
		}*/
	}

 }
?>
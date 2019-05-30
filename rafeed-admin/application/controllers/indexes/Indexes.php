<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Indexes extends CI_Controller {
 	
	function is_exist($index_name,$index_values,$has_languages)
	{
		$exist=false;
		$this->load->model('Index_model');
		$ix_name=$index_name;
		if($has_languages==1)
			$ix_name.='_language';
		foreach ($index_values as $row) {
		    if($this->Index_model->get_value_by_name($ix_name,$row)){
		    	$exist=true;
			}
		}
		return $exist;
	}

	function set_value()
	{
		$index_id=0;
		if(!$this->is_exist($this->input->post('index_name'),$this->input->post('index_value'),$this->input->post('has_languages')))
		{
			//add index main row
			$this->load->model('Index_model');

			if($this->input->post('has_languages')==0){
				$index_values=$this->input->post('index_value');
				$language_values=$this->input->post('Language_Ids');
				foreach($index_values as $key =>$value){
					$data=array('Order' => NULL,
								'Name' => $value
						 		);
					if($language_values[$key]==1)
						$index_id=$this->Index_model->set_index($this->input->post('index_name'),$data);
				}
			}
			else{
				if ($this->input->post('index_name')=='product_category') {
					$data=array(
						'Order' => NULL,
						'Product_Type' =>$this->input->post('product_type'),
						'Code_str' =>$this->input->post('Code_str'),
						'Code_num' =>$this->input->post('Code_num')
					);
				}
				else
					$data=array('Order' => NULL);
				$index_id=$this->Index_model->set_index($this->input->post('index_name'),$data);

				//add index language
				$index_values=$this->input->post('index_value');
				$language_values=$this->input->post('Language_Ids');
				foreach($index_values as $key =>$value){
					$data = array(
						'Name' => $value,
						$_POST['index_name'].'_id' => $index_id,
						'Language_id' => $language_values[$key]
						 );
					$this->Index_model->set_index($this->input->post('index_name')."_language",$data);
				}
			}
		}
		echo json_encode($index_id);
		
	}

	function get_index($index_name){
		$this->load->model('Index_model');
		if($this->input->post('has_languages')==0)
			$result=$this->Index_model->get_index($index_name);
		else
			$result=$this->Index_model->get_index_language($index_name);
		echo json_encode($result);
	}

	function get_system_index_name(){
		return array('Application',
			'Brand',
			'Certification',
			'City',
			'Color',
			'Country',
			'Dimmable_type',
			'Installation_way',
			'Language',
			'Led_type',
			'Life_span',
			'Lighting_distribution_kind',
			'Lighting_source',
			'Lightsource_type',
			'Material',
			'Part',
			'Pin_type',
			'Position',
			'Premium_type',
			'Product_family',
			'Product_series',
			'Product_category',
			'Shape',
			'Socket_type',
			'Warranty'
		);
	}

}


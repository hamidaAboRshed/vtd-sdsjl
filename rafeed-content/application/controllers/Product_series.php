<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Product_series extends CI_Controller {
 
	function __construct()
	{
        parent::__construct();
	 
		$this->load->database();
		$this->load->helper('url');
		//$this->load->library('breadcrumbs');
		$this->load->library('breadcrumbcomponent');
		/* ------------------ */ 
		 
		$this->load->library('grocery_CRUD');
	 
	}
 
	public function index()
	{
		$this->load->model('Index_model');
		$language_id=$this->Index_model->get_default_language();
		$crud = new grocery_CRUD();
		$crud->set_table('product_series_language')->display_as('product_series_id','Order');
		$crud->where('language_id =', $language_id);
		$crud->columns('Name','product_series_id');
		$crud->set_relation('product_series_id','product_series','order');
		$crud->add_action('View Products', '', 'Product/view_series_product' ,'icon-Products');
		$crud->unset_jquery();

		$crud->unset_add();
		$crud->unset_delete();
		$crud->unset_clone();
		$crud->unset_read();
		$crud->unset_edit();
		
		$output = $crud->render();

		$this->_example_output($output);
	}

	
	function _example_output($output = null)
	{
		$data['subview'] = 'template.php';
		$data['output']=$output;
		//$this->breadcrumbs->push('Product series', '/Product_series/index/');
		$this->breadcrumbcomponent->add('Product series', base_url().'/Product_series/index/');  
		//$data['breadcrumbs']=$this->breadcrumbcomponent->output();
		//$data['breadcrumbs']=$this->breadcrumbs->show();
		//$data['pageTitle']='Product series';   
		$data['pageTitle'] = array('Product series' =>'Product_series/index'); 
		
		$this->load->view('layouts/layout.php',$data);    
	}

}
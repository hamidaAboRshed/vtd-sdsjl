<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Product_category extends CI_Controller {
 
	function __construct()
	{
        parent::__construct();
	 
		$this->load->database();
		$this->load->helper('url');
		/* ------------------ */ 
		 
		$this->load->library('grocery_CRUD');
	 
	}
 
	public function index()
	{
		$crud = new grocery_CRUD();
		$crud->set_table('product_category');
		$crud->unset_jquery();
		$output = $crud->render();

		$this->_example_output($output);
	}

	
	function _example_output($output = null)
	{
		$data['subview'] = 'template.php';
		$data['output']=$output;
		$data['pageTitle']='Product category';   
		$this->load->view('layouts/layout.php',$data);    
	}

	function get_subcategory()
	{
		$this->load->model('Index_model');
		$result=$this->Index_model->get_subcat($this->input->post('id'));
		echo json_encode($result);
		/*if($result)
		{
			//family exist
			echo json_encode(true) ;
		}
		else
			echo json_encode(False);*/
	}
}
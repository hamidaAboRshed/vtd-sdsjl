<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Language extends CI_Controller {
 
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
		$crud->set_table('language');
		$crud->unset_jquery();
		$output = $crud->render();

		$this->_example_output($output);
	}

	
	function _example_output($output = null)
	{
		$data['subview'] = 'template.php';
		$data['output']=$output;
		$data['pageTitle']='Language';   
		$this->load->view('layouts/layout.php',$data);    
	}

	function get_language(){
		$this->load->model('Index_model');
		$result=$this->Index_model->get_index('language');
		echo json_encode($result);
	}

}



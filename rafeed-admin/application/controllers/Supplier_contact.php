<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Supplier_contact extends CI_Controller {
 
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
		$crud->set_table('supplier_contact')->display_as('ContactTypeID','Contact Type')
											->display_as('SupplierID','Supplier')
											->display_as('Active','Status');
		$crud->set_relation('ContactTypeID','Contact_Type','Name');
		$crud->set_relation('SupplierID','Supplier','Name');
		$crud->field_type('Active','true_false');
		$crud->unset_jquery();
		$output = $crud->render();

		$this->_example_output($output);
	}

	
	function _example_output($output = null)
	{
		$data['subview'] = 'template.php';
		$data['output']=$output;
		$data['pageTitle']='supplier contact';   
		$this->load->view('layouts/layout.php',$data);    
	}

}
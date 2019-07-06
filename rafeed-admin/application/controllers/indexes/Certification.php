<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Certification extends CI_Controller {
 
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
		/*$data['output'] = '';
		$array = array();
		$array['grid_header'] = array(
			'Name' ,
			'Logo',
			'Option');
		$array['read_action'] = '../../Premium_product/fetchFamilyDimensionData/'.$premium_id;
		$array['custom_modal_file'] = 'dimension_grid.php';
		$array['custom_modal_data'] = null;
		$data['grid_body_data']= $array;
		//$data['subview'] = 'view_premium_products.php';

		$this->breadcrumbs->push('Premium product', '/Premium_product');
		$this->breadcrumbs->push('Product Dimension', '/Premium_product/dimension_grid_view/'.$premium_id);
		$data['breadcrumb'] = $this->breadcrumbs->show();
		
		$data['subview'] = 'grid_view.php';
		$data['pageTitle']='Premium Product Table';
		$this->load->view('layouts/layout',$data);*/

		$crud = new grocery_CRUD();
		$crud->set_table('certification');
		$crud->set_field_upload('Logo','./../rafeed-includes/upload_files/Certification');
		$crud->columns('Name','Logo');
		$crud->unset_jquery();
		$output = $crud->render();

		$this->_example_output($output);
	}

	
	function _example_output($output = null)
	{
		$data['subview'] = 'template.php';
		$data['output']=$output;
		$data['pageTitle']='Certification';
		$this->load->view('layouts/layout.php',$data);    
	}

}


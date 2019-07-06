<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Installation_way extends CI_Controller {
 
	function __construct()
	{
        parent::__construct();
	 
		$this->load->database();
		$this->load->helper('url');
		/* ------------------ */ 
		 
		$this->load->library('grocery_CRUD');
		$this->load->model('Index_model');
	 	$this->load->model('Global_model');
	}
 
	public function index()
	{
		$data['output'] = '';
		$array = array();
		$array['grid_header'] = array(
			'Name' ,
			'Logo',
			'Option');
		$array['read_action'] = './Installation_way/fetchMemberData';
		$array['custom_modal_file'] = 'index_grid';
		$array['custom_modal_data']  = array('action' => 'indexes/Installation_way/update_logo');
		$data['grid_body_data']= $array;
		//$data['subview'] = 'view_premium_products.php';

		$this->breadcrumbs->push('Installation way', '/Installation_way');
		$data['breadcrumb'] = $this->breadcrumbs->show();
		
		$data['subview'] = 'grid_view.php';
		$data['pageTitle']='Installation way Table';
		$this->load->view('layouts/layout',$data);

		/*$crud = new grocery_CRUD();
		$crud->set_table('installation_way_language');
		$crud->set_relation('Installation_way_id','installation_way','Logo');

		$crud->unset_jquery();
		$output = $crud->render();

		$this->_example_output($output);*/
	}

	function fetchMemberData()
	{
		$result = array('data' => array());

		$data = $this->Index_model->get_index_language_logo('installation_way');	
		
		foreach ($data as $key => $value) {
			
			// button
			$buttons = '
			<div class="btn-group">
			  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    Action <span class="caret"></span>
			  </button>
				<ul class="dropdown-menu">'.
			    '<li><a type="button" class="" onclick="upload_photo('.$value['ID'].')" data-toggle="modal" data-target="#uploadPhotoModal">Change Logo</a></li>
			  </ul>
			</div>
			';

			$result['data'][$key] = array(	
				$value['Name'],
				'<img hight=45 width=45 src="'.base_url().'./../rafeed-includes/upload_files/Installation_way/'.(is_null($value['Logo'])? 'default.jpg':$value['Logo']).'" />',
				$buttons);
		} // /foreach

		echo json_encode($result);
	}

	function update_logo($id)
	{
		$validator = array('success' => false, 'messages' => array());
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if ($id) {

			$photo_name='installation_way'.$id;

			$photo = $this->upload_file('./../rafeed-includes/upload_files/Installation_way/',$photo_name,'photo');

			$data= array(
				'Logo' => $photo
			);
			$createMember = $this->Global_model->updateData('Installation_way',$data,$id);
				
			if($createMember === true) {

					$validator['success'] = true;
					$validator['messages'] = "Successfully added";
				} else {
					$validator['success'] = false;
					$validator['messages'] = "Error while updating the infromation";
				}			
			//} 
			}
			else {
				$validator['success'] = false;
				$validator['messages']['photo']='<p class="text-danger">Please select file</p>';
			}

		
		echo json_encode($validator);
	}

	function upload_file($path,$file_name,$element)
	{
		$file=null;
		
        // File upload configuration
        
        $config['upload_path'] = $path;
        $config['file_name'] = $file_name;
        $config['overwrite'] = TRUE;
        $config['allowed_types'] = '*';

		if (!is_dir($path))
		{
			mkdir($path, 0777, true);
		}

        // Load and initialize upload library
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        // Upload file to server
        if($this->upload->do_upload($element)){
            // Uploaded file data
            $imageData = $this->upload->data();
            $file = $imageData['file_name'];

		}
		/*else
	    {
	    	$output = array('error' => $this->upload->display_errors());
            $this->load->view('empty_page', $output);
		}*/

        return $file;
	}

	
	function _example_output($output = null)
	{
		$data['subview'] = 'template.php';
		$data['output']=$output;
		$data['pageTitle']='Installation way';   
		$this->load->view('layouts/layout.php',$data);    
	}

}



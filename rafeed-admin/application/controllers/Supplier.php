<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Supplier extends CI_Controller {
 
	function __construct()
	{
        parent::__construct();
	 
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');
		$this->load->model('Supplier_model');
		$this->load->model('Global_model');
		$this->load->model('User_model');
	 
	}
 
	public function index()
	{
		if($this->user_validate->check_login())
		{
			$crud = new grocery_CRUD();
			$crud->set_table('supplier');
			$crud->unset_jquery();
			$crud->add_action('Add Supplier Contact', '', 'Supplier/supplier_contact','fa fa-user');
			$crud->field_type('is_brand','true_false');
			$crud->unset_delete();

			$output = $crud->render();

			$this->_example_output($output);
		}
	}

	
	function _example_output($output = null)
	{
		$data['subview'] = 'template.php';
		$data['output']=$output;
		$data['pageTitle']='Supplier';   
		$this->load->view('layouts/layout.php',$data);    
	}


	public function fetchSupplierData($id) 
	{
		$result = array('data' => array());
		$contact_details=$this->Supplier_model->get_unique_contact_type($id);
		$contact_details=array_column($contact_details,'ContactType');
		$data_supplier = $this->Supplier_model->fetch_supplier_conntact_Data($id);

		foreach ($data_supplier as $key => $value)
		{
			$buttons = '
				<div class="btn-group">
				  	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    Action <span class="caret"></span>
				  	</button>
				  	<ul class="dropdown-menu">
				  		<li><a href="'.base_url().'index.php/supplier/edit_supplier_contact/'.$value['ID'].'/'.$value['supp_con_id'].'">Edit </a></li>

				    	<li><a type="button" class="" onclick="delete_supplier_contact('.$value['supp_con_id'].')" data-toggle="modal" data-target="#delete_supplier_con_Modal">Delete</a>
				    	</li>
				    </ul>
			    </div> ';
			$contact_details_value=$this->Supplier_model->get_contact_type($value['supp_con_id']);
      		$array_contact = array();
      		
      		foreach ($contact_details as $key_cont => $value_cont)
      		{
				$contact_text_val = '';
            	foreach ($contact_details_value as $key_value => $val)
            	 {
      				if ($val['ContactType']==$value_cont ) 
      				 {
      				  $contact_text_val.=$val['ContactText'];
      				  $contact_text_val.='<br/>';
      				 }
      			 } 
	      		array_push($array_contact, $contact_text_val);
      		} 
			$result['data'][$key]  = array_merge( 
				array($value['FullName'],$value['supp_con_note']),
				$array_contact,
				array($buttons)
			);

		} //foreach

	  echo json_encode($result);
	}


	public function supplier_contact($id)
	{
		if($this->user_validate->check_login())
		{
			$array = array();

			$data = $this->Supplier_model->fetch_supplier_conntact_Data($id);
			$contact_details=$this->Supplier_model->get_unique_contact_type($id);

			$contact_details=array_column($contact_details,'ContactType');
			$array['grid_header'] = array_merge(array('Full Name' ,'Note'),$contact_details,array('option'));
			$array['read_action'] = '../../Supplier/fetchSupplierData/'.$id;
			$data['grid_body_data']= $array;
			$data['custom_modal_file'] = 'supplier_contact_grid.php';
			$data['custom_modal_data'] = $id; 

			$this->breadcrumbs->push('Supplier', '/Supplier');
			$this->breadcrumbs->push('Supplier Contact', '/Supplier/supplier_contact/'.$id);
			$data['breadcrumb'] = $this->breadcrumbs->show();

			$data['output'] = '';
			$data['subview'] = 'grid_view.php';
			$data['pageTitle']='Supplier Contact Table';
			$this->load->view('layouts/layout',$data);
		}

	}

	function add_supplier_contact($supplier_id)
	{
		$data['supplier'] = $this->Supplier_model->get_supplier($supplier_id);
		$data['supp_cont_type'] = $this->Supplier_model->get_contact_type();
		if (empty($data['supp_cont_type'])) 
		{  
			// Create new stdClass Object
			$init = new stdClass;

			// Add some test data
			$init->ContactType = "Phone";
			$data['supp_cont_type'][0]=$init;

			$init = new stdClass;
			$init->ContactType = "Email";
			$data['supp_cont_type'][1]=$init;
			
			$init = new stdClass;
			$init->ContactType = "QQ";
			$data['supp_cont_type'][2]=$init;
		}
		$data['subview'] = 'add_supplier_contact.php';

		$this->breadcrumbs->push('Supplier', '/Supplier');
		$this->breadcrumbs->push('Supplier Contact', '/Supplier/supplier_contact/'.$supplier_id);
		$this->breadcrumbs->push('Add Supplier Contact', '/Supplier/add_supplier_contact/'.$supplier_id);
		$data['breadcrumb'] = $this->breadcrumbs->show();

		$data['output']="";
		$data['pageTitle']='Add supplier contact'; 
		$this->load->view('layouts/layout.php',$data);    
	}
		

	function edit_supplier_contact($supplier_id,$supplier_contact_id)
	{
		$data['supplier'] = $this->Supplier_model->get_supplier($supplier_id);
		$data['contact_details'] = $this->Supplier_model->get_supplier_contact_data($supplier_contact_id);
		$data['supp_cont_type'] = $this->Supplier_model->get_contact_type();
		$data['subview'] = 'add_supplier_contact.php';

		$this->breadcrumbs->push('Supplier', '/Supplier');
		$this->breadcrumbs->push('Supplier Contact', '/Supplier/supplier_contact/'.$supplier_id);
		$this->breadcrumbs->push('Edit Supplier Contact', '/Supplier/edit_supplier_contact/'.$supplier_id.'/'.$supplier_contact_id);
		$data['breadcrumb'] = $this->breadcrumbs->show();

		$data['output']="";
		$data['id_sup_con']=$supplier_contact_id;
		$data['pageTitle']='Edit supplier contact';   
		$this->load->view('layouts/layout.php',$data);    
	}


	function create_supplier_contact()
	{
		$FullName=$this->input->post('FullName');
		$SupplierID=$this->input->post('SupplierID');
		$Note=$this->input->post('Note');

		if($this->session->userdata('Full_name'))
			$username=$this->session->userdata('Full_name');
		else 
			$username=$this->User_model->get_default_username();

		$data_supplier_contact = array(
			'FullName'=>$FullName,
			'SupplierID'=>$SupplierID,
			'Note'=>$Note,
        );

	 	$last_id_supplier_contact=$this->Global_model->insertDataReturnLastId('supplier_contact',$data_supplier_contact);

        $rowcount=$this->input->post('rowcount');
	 	for ($i=1; $i <=$rowcount ; $i++) 
	 	 { 
	 	 	$type=$this->input->post("type_".$i);
			$value=$this->input->post("value_".$i);
			$active_check=$this->input->post("active_check_".$i);
			if (!$active_check) {$active_check=0;}
			if( $value!="")
			{
				$data_contact_details = array(
					'SupplierContactID'=>$last_id_supplier_contact,
					'ContactType'=>$type,
					'ContactText'=>$value,
					'Active '=>$active_check,

		          );
			 	$last_id_contact_details=$this->Global_model->insertDataReturnLastId('supplier_contact_details',$data_contact_details);
			}
		}
		
		//redirect($_SERVER['HTTP_REFERER']); 
		redirect(base_url() .'index.php/Supplier/supplier_contact/'.$SupplierID);
  
	} 


	function update_supplier_contact()
	{
		$FullName=$this->input->post('FullName');
		$SupplierID=$this->input->post('SupplierID');
		$Note=$this->input->post('Note');
		$id_supplier_conntact=$this->input->post('id_sup_con');

		if($this->session->userdata('Full_name'))
			$username=$this->session->userdata('Full_name');
		else 
			$username=$this->User_model->get_default_username();

			$data_supplier_contact = array(
				'FullName'=>$FullName,
				'SupplierID'=>$SupplierID,
				'Note'=>$Note,
         	 );

			 $update_supplier_contact=$this->Supplier_model->update_data('supplier_contact',$data_supplier_contact,$id_supplier_conntact);

		 	//edit contact delails
	        $edit_rowcount=$this->input->post('edit_rowcount');
		 	for ($i=0; $i <=$edit_rowcount ; $i++) 
		 	{ 
		 	 	$edit_id_sup_con_det=$this->input->post("id_sup_con_det".$i);
		 	 	$edit_type=$this->input->post("edit_type_".$i);
				$edit_value=$this->input->post("edit_value_".$i);
				$edit_active_check=$this->input->post("edit_active_check_".$i);
				if (!$edit_active_check) {$edit_active_check=0;}
				if( $edit_value!="")
				{
					$edit_data_contact_details = array(
					'SupplierContactID'=>$id_supplier_conntact,
					'ContactType'=>$edit_type,
					'ContactText'=>$edit_value,
					'Active '=>$edit_active_check,

		         	 );

				 	$update_contact_details=$this->Supplier_model->update_data('supplier_contact_details',$edit_data_contact_details,$edit_id_sup_con_det);
				}

			}

			//add contact detail 
	        $rowcount=$this->input->post('rowcount');
		 	for ($i=1; $i <=$rowcount ; $i++) 
		 	{ 
		 	 	$type=$this->input->post("type_".$i);
				$value=$this->input->post("value_".$i);
				$active_check=$this->input->post("active_check_".$i);
				if (!$active_check) {$active_check=0;}
				if( $value!="")
				{
					$data_contact_details = array(
					'SupplierContactID'=>$id_supplier_conntact,
					'ContactType'=>$type,
					'ContactText'=>$value,
					'Active '=>$active_check,
		            );

				 	$last_id_contact_details=$this->Global_model->insertDataReturnLastId('supplier_contact_details',$data_contact_details);
				}

			}
		//redirect($_SERVER['HTTP_REFERER']);
		redirect(base_url() .'index.php/Supplier/supplier_contact/'.$SupplierID);
	}

	function delete_supplier_contact_details($id)
	{
		 
		$rsponse= $this->Supplier_model->delete_supplier_detalis($id);
		 if($rsponse === true) {
				$validator['success'] = true;
				$validator['messages'] = "Successfully removed";
			}
			else
			{
				$validator['success'] = false;
				$validator['messages'] = "Error when remove supplier details .";
			}

			echo json_encode($validator);

	}

	function delete_supplier_contact($id)
	{
		$rsponse= $this->Supplier_model->delete_supplier_contact($id);
		 if($rsponse === true) {
			$validator['success'] = true;
			$validator['messages'] = "Successfully removed";
		}
		else {
			$validator['success'] = false;
			$validator['messages'] = "Error when remove supplier contact.";
		}

		echo json_encode($validator);
	}
}
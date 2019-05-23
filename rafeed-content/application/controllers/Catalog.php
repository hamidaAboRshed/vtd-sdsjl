<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalog extends CI_Controller {

	//public $CI = NULL;
	function __construct() {
        parent::__construct();
		$this->load->model("Global_model");
    }
	public function index()
	{
		//if(!$this->session->userdata('navdata'))
		{
			$this->load->library("navigation");
			$this->session->set_userdata('navdata',$this->navigation->set_navigation());

		}
		/*$this->set_navigation();*/
		$data['subview'] = 'Home.php';
		$data['pageTitle']='Home Page';
		$this->load->view('layouts/layout.php',$data);   
	}

	public function economic()
	{
		$data['book_name']='eseries';
		//$this->load->view('catalog_viewer.php',$data); 
		$this->load->view('flipbook_viewer.php',$data); 
	}

	public function old_premium()
	{
		$data['book_name']='premium';
		$this->load->view('catalog_viewer.php',$data);   
	}

	public function smart()
	{
		$data['book_name']='smart';
		//$this->load->view('catalog_viewer.php',$data);   
		$this->load->view('flipbook_viewer.php',$data); 
	}

	public function premium()
	{
		$data['book_name']=$this->Global_model->get_data('catalogue');
		
		$this->load->view('premium_flipbook.php',$data); 
		/*//last version
		$this->load->view('premium_catalog_viewer.php',$data);  */
	}

	public function fashion(){
		$data['book_name']='fashion';
		$this->load->view('catalog_viewer.php',$data);
	}

	public function outdoor(){
		$data['book_name']='outdoor';
		$this->load->view('catalog_viewer.php',$data);
	}

	public function industrial()
	{
		$data['book_name']='industrial';
		$this->load->view('catalog_viewer.php',$data);
	}
	public function hospitality()
	{
		$data['book_name']='hospitality';
		$this->load->view('catalog_viewer.php',$data);
	}

	public function street()
	{
		$data['book_name']='street';
		$this->load->view('catalog_viewer.php',$data);
	}

	public function offices()
	{
		$data['book_name']='offices';
		$this->load->view('catalog_viewer.php',$data);
	}
	
	public function Authentication()
	{
		if(strtolower($this->input->post('username')) == "rafeed2019_2020" && strtolower($this->input->post('password')) == "catalogue#20192020")
		//if(strtolower($this->input->post('username')) == "test" && strtolower($this->input->post('password')) == "test")
			{
				$data['success']=1;
			}
		else
			$data['success']=0;
		echo json_encode($data);
	}

	//some code to constant function 
	public function insert_read()
	{

		$id_cat=$this->input->post('catl_id');
		 $data = array(
	        'Catalog_id'=>$id_cat,
	        'Date'=>date("Y-m-d H:i:s"),
	        'Type'=>'read'
          );
		 $data['query']=$this->Global_model->insert('catalogue_log',$data);
	}

}

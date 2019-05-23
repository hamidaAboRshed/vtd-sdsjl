<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	//public $CI = NULL;

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
		$this->output->cache(1);
		$this->load->view('layouts/layout.php',$data);   
	}

	
	public function contact_us()
	{
		$this->load->library("navigation");
		$this->session->set_userdata('navdata',$this->navigation->set_navigation());
		$data['subview'] = 'contact_us.php';
		$data['pageTitle']='Contact us';
		$this->load->view('layouts/layout.php',$data);   
	}

	public function about($value='')
	{
		$this->load->library("navigation");
		$this->session->set_userdata('navdata',$this->navigation->set_navigation());
		$data['subview'] = 'about.php';
		$data['pageTitle']='About Rafeed Company';
		$this->load->view('layouts/layout.php',$data);   
	}

	public function cct_info($value='')
	{
		$this->load->library("navigation");
		$this->session->set_userdata('navdata',$this->navigation->set_navigation());
		$data['subview'] = 'cct_tech.php';
		$data['pageTitle']='Color Temprature';
		$this->load->view('layouts/layout.php',$data);
	}

	public function led_info($value='')
	{
		$this->load->library("navigation");
		$this->session->set_userdata('navdata',$this->navigation->set_navigation());
		$data['subview'] = 'led_tech.php';
		$data['pageTitle']='LED Technology';
		$this->load->view('layouts/layout.php',$data); 
	}

	public function services($value='')
	{
		# code...
	}

	public function agents()
	{
		$this->load->library("navigation");
		$this->session->set_userdata('navdata',$this->navigation->set_navigation());
		$data['subview'] = 'agents.php';
		$data['pageTitle']='Rafeed Agent';
		$this->load->view('layouts/layout.php',$data); 
	}
}

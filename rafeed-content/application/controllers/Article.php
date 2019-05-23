<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {
	  function __construct() {
        parent::__construct();
		$this->load->model("Article_model");
		$this->load->helper('text');
    }
	public function index()
	{
		$this->load->library("navigation");
		$this->session->set_userdata('navdata',$this->navigation->set_navigation());
		$data['subview'] = 'articles_list.php';
		$data['pageTitle']='Articals List';

		$data['atricle'] = $this->Article_model->get_data_article();
		$this->load->view('layouts/layout',$data);   
	}

		public function article_page($id)
	{
		$this->load->library("navigation");
		$this->session->set_userdata('navdata',$this->navigation->set_navigation());
		$data['subview'] = 'article_page.php';
		

		$data['keyword'] = $this->Article_model->get_article_key($id);
		$data['details_article'] = $this->Article_model->get_data_article($id);
		$data['paragraph'] = $this->Article_model->get_paragraph_article($id);
		foreach ($data['paragraph'] as $key => $value) {
			$data['paragraph'][$key]['sub_paragraph'] = $this->Article_model->get_sub_paragraph($value['ID']);
		}
	
		$data['pageTitle']='Articles - '.$data['details_article'][0]->Title;
		$this->load->view('layouts/layout',$data);   
	}


}

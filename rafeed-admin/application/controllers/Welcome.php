<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['subview'] = 'welcome_message';
		$data['output']='';
		$this->breadcrumbs->push('Home', '/Welcome/index');
		$data['breadcrumb'] = $this->breadcrumbs->show();
		$data['pageTitle']='Welcome';   

		$this->load->view('layouts/layout.php',$data); 
		//$this->load->view('welcome_message');
	}
	function test(){
		/*$this->load->library('upload');
		$this->upload->initialize($config);*/
		$this->load->view("crop_image");
	}

	function crop(){
		$targ_w = $targ_h = 150;
		$jpeg_quality = 90;

		$src = base_url().'/assets/images/c1.jpg';
		$img_r = imagecreatefromjpeg($src);
		$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

		imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
		$targ_w,$targ_h,$_POST['w'],$_POST['h']);

		header('Content-type: image/jpeg');
		imagejpeg($dst_r,null,$jpeg_quality);

	}
}

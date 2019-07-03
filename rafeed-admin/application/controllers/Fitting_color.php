<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fitting_color extends CI_Controller {

	function __construct()
	{
        parent::__construct();

		$this->load->model('Fitting_color_model');
	}

	public function index()
	{

	}

	function check_texture() {
	    $MaterialID = $this->input->post('MaterialID');// get fiest name
	    $ColorID = $this->input->post('ColorID');// get last name
	    $this->db->select('ID');
	    $this->db->from('color_texture');
	    $this->db->where('MaterialID', $MaterialID);
	    $this->db->where('ColorID', $ColorID);
	    $query = $this->db->get();
	    $num = $query->num_rows();
	    if ($num > 0) {
	        return FALSE;
	    } else {
	        return TRUE;
	    }
	}

	function create_texture() 
	{
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');

		$validator = array('success' => false, 'messages' => array());

		$config = array(
		    array(
				'field' => 'MaterialID',
		        'label' => 'Material',
		        'rules' => 'trim|required|callback_check_texture',
		        'errors' => array(
	        		'check_texture'=> 'Material and color selected are added before.')
		    )
		    
		);
		
		$this->form_validation->set_rules($config);
		$this->form_validation->set_error_delimiters('<p class="text-danger" style="padding-left : 15px">','</p>');

		if($this->form_validation->run() === true) 
		{
			$data=array(
				'ColorID' => $this->input->post('ColorID'),
				'MaterialID' => $this->input->post('MaterialID')
			);

			$createMember_id=$this->Fitting_color_model->insert_color_texture($data);

			$targ_w = $targ_h = 150;
			$jpeg_quality = 90;

			if (empty($_FILES["Texture"]["tmp_name"])) {
				$src = "./../rafeed-includes/upload_files/Texture/default.jpg";
			}
			else
				$src = $_FILES["Texture"]["tmp_name"];

			//get any file type.
			switch(mime_content_type($src)) {
				case 'image/png':
				  $img_r = imagecreatefrompng($src);
				  break;
				case 'image/gif':
				  $img_r = imagecreatefromgif($src);
				  break;
				case 'image/jpeg':
				  $img_r = imagecreatefromjpeg($src);
				  break;
				case 'image/bmp':
				  $img_r = imagecreatefrombmp($src);
				  break;
				default:
				  $img_r = null; 
			}
			
			 //get image size from $src handle

    		list($width, $height) = getimagesize($src);
			
			$newHeight = 400;
			$newWidth=600; 

			$tmp = imagecreatetruecolor($newWidth, $newHeight);

    		imagecopyresized($tmp, $img_r, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

			$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
			
			imagecopyresampled($dst_r,$tmp,0,0,$_POST['x'],$_POST['y'],
			$targ_w,$targ_h,$_POST['w'],$_POST['h']);

			imagejpeg($dst_r,"./../rafeed-includes/upload_files/Texture/".$createMember_id.".jpg",$jpeg_quality);

			$data=array(
				'Texture_photo' => $createMember_id.".jpg"
			);
			$createMember= $this->Fitting_color_model->update_color_texture($createMember_id,$data);
			
			if($createMember === true) {
				$validator['success'] = true;
				$validator['messages'] = "Successfully added";
			} else {
				$validator['success'] = false;
				$validator['messages'] = "Error while updating the infromation";
			}			
		} 
		else {
			$validator['success'] = false;
			foreach ($_POST as $key => $value) {
				$validator['messages'][$key] = form_error($key);	
			}			
		}

		echo json_encode($validator);
	}

	function get_fitting_texture()
	{
		echo json_encode($this->Fitting_color_model->get_texture());
	}

}

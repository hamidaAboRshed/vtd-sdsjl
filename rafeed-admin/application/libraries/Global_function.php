<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class global_function {

    function __construct()
    {
    	$CI =& get_instance();
        $CI->load->model('Index_model');
    }

    function get_referance_value($table_name,$id)
	{
		$CI =& get_instance();
		return $CI->Index_model->get_value_by_id($table_name,$id);

	}

	function get_range($min,$max)
	{
		if ($min == $max || $max==NULL) {
				return $min;
			}
		else
			return $min ." - ".$max;
	}

	public function is_null($value){
		if($value =='')
			return NULL;
		else
			return $value;
	}

	function get_array($str)
	{
		$length = strlen($str);
		$thisWordCodeVerdeeld = array();
		$val='';
		for ($i=0; $i<$length; $i++) {
			
			if($str[$i]==','){
		    	array_push($thisWordCodeVerdeeld, $val);
		    	$val='';
			}
		    else
		    	$val.=$str[$i];

		    if($i==$length-1)
		    	array_push($thisWordCodeVerdeeld, $val);
		}

		return $thisWordCodeVerdeeld;
	}

	function upload_file($path,$file_name,$element)
	{
		$CI =& get_instance();
		$file=null;
		
        // File upload configuration
        
        $config['upload_path'] = $path;
        $config['file_name'] = $file_name;
        $config['overwrite'] = FALSE;
        $config['allowed_types'] = '*';

		if (!is_dir($path))
		{
			mkdir($path, 0777, true);
		}

        // Load and initialize upload library
        $CI->load->library('upload', $config);
        $CI->upload->initialize($config);

        // Upload file to server
        if($CI->upload->do_upload($element)){
            // Uploaded file data
            $imageData = $CI->upload->data();
            $file = $imageData['file_name'];

		}
		/*else
	    {
	    	$output = array('error' => $this->upload->display_errors());
            $this->load->view('empty_page', $output);
		}*/

        return $file;
	}

	function upload_multiple_file($path,$file_name,$element)
	{
		$CI =& get_instance();
		$uploadImgData = array();
		if (isset($_FILES[$element])) 
		{
			$image = array();
			$ImageCount = count($_FILES[$element]['name']);
			for($i = 0; $i < $ImageCount; $i++)
			{
				$_FILES['file']['name']       = $_FILES[$element]['name'][$i];
				$_FILES['file']['type']       = $_FILES[$element]['type'][$i];
				$_FILES['file']['tmp_name']   = $_FILES[$element]['tmp_name'][$i];
				$_FILES['file']['error']      = $_FILES[$element]['error'][$i];
				$_FILES['file']['size']       = $_FILES[$element]['size'][$i];

				// File upload configuration
				$config['upload_path'] = $path;
				$config['file_name'] = $file_name.$i;
				$config['allowed_types'] = '*';
				$config['overwrite'] = FALSE;

				if (!is_dir($path))
				{
					mkdir($path, 0777, true);
				}
				
				// Load and initialize upload library
				$CI->load->library('upload', $config);
				$CI->upload->initialize($config);

				// Upload file to server
				if($CI->upload->do_upload('file'))
				{
					// Uploaded file data
					$imageData = $CI->upload->data();
					$uploadImgData[$i] = $imageData['file_name'];
				}
			}
		}
	    return ($uploadImgData);
	}
}
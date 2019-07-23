<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
	{

		parent::__construct();
        $this->load->model("Global_model");
        $this->load->model("User_model");
        $this->load->library('form_validation');
        $this->load->helper('form');
            
    }
    function validate_credentials()
	{	
		$this->form_validation->set_rules('Username', 'Username', 'trim|required');
		$this->form_validation->set_rules('Password', 'Password', 'trim|required');

	   if($this->form_validation->run() == true)
	    {
			$this->load->model('User_model');
			$query = $this->User_model->login_validate($this->input->post('Username'),$this->input->post('Password'));
			if($query) // if the user's credentials validated...
			{
				echo json_encode(true);
			}
			else // incorrect username or password
			{
				$data['bool']=true;
				$data['string']="wrong username or password,try again";
				echo json_encode(false);
			}
		}
		  else
		{
			$data['bool']=false;
		}	
	}
    
    function encryptor($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'rAf159';
    $secret_iv = 'rAf159';

    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    //do the encyption given text/string/number
    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
    	//decrypt the given text/string/number
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}
        
    function active_user($id){
        if($id != null)
        {
        $decrypted_id=$this->encryptor('decrypt',''.$id.'');    
        $active_data = array(
        'Active' => '1'     
            );
        $this->Global_model->updateData('user', $active_data, $decrypted_id);  
        $this->load->library("navigation");
        $this->session->set_userdata('navdata',$this->navigation->set_navigation());
        $data['subview'] = 'email_confirmation.php';
		$data['pageTitle']='email confirmation Page';
        $this->load->view('layouts/layout.php',$data);
        }
        else
            echo 'null';
             
}
}
?>
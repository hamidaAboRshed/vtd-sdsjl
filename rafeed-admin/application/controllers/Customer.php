<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Customer extends CI_Controller {

function __construct()
{
    parent::__construct();
    $this->load->model("Global_model");
    $this->load->model("User_model");
    $this->load->model("Customer_model");
 
	$this->load->database();
	$this->load->helper('url');
	/* ------------------ */ 
	 
	$this->load->library('grocery_CRUD');
 
}
 
//public function index()
//{
//	$crud = new grocery_CRUD();
//
//	$crud->required_fields('FirstName','LastName','Phone','Company','JobTitle','Email');
//
//	$output = $crud->render();
//
//	$this->_example_output($output);
//}
// 
//function _example_output($output = null)
//{
//	$data['subview'] = 'template.php';
//	$data['output']=$output;
//	$data['pageTitle']='Customer';
//	$this->load->view('layouts/layout.php',$data);    
//}
    
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
    
function add_customer(){
    $result = $this->Global_model->getDataOneColumn('customer','Email', $this->input->post('Email'));
    if($result == null){
        $data = array(
        'FirstName' => $this->input->post('FirstName'),
        'LastName' => $this->input->post('LastName'),
        'Phone' => $this->input->post('Phone'),
        'Company' => $this->input->post('Company'),
        'JobTitle' => $this->input->post('JobTitle'),
        'Email' => $this->input->post('Email'),
    );
   $customer_id = $this->Global_model->insertDataReturnLastId('customer',$data);
    $user_data = array(
        'Username' => $this->input->post('Email'),
        'Password' => md5($this->input->post('Password')),
        'Active' => '0',
        'CustomerID' => $customer_id,
        
    );
    $user_id = $this->Global_model->insertDataReturnLastId('user',$user_data);
        
         
    $this->send_activation_email($this->input->post('Email'));
        
        echo json_encode(true);
    }
    else
        echo json_encode(false);
    }
    
    function send_activation_email($email){
                
       $result=$this->Global_model->getDataOneColumn('user', 'Username', $email);
       $id = $result[0]->ID;
 
        $result2=$this->Global_model->getDataOneColumn('customer', 'Email', $email);
        $firstname = $result2[0]->FirstName;
        $lastname  = $result2[0]->LastName;
        $topMsg = 'Dear '.$firstname.' '.$lastname;

        
        //Encrypt       
        $encrypted_id=$this->encryptor('encrypt',''.$id.'');
        $this->load->config('email');
        $this->load->library('email');
        $config = array (
                  'protocol' => 'smtp',
                  'smtp_host' => 'mail.atclighting.co',
                  'smtp_user'    => 'test@atclighting.co',
                  'smtp_pass'   => '123456',
                  'smtp_port' => '25',
                  'smtp_timeout' => '7',
                  'mailtype' => 'html',
                  'charset'  => 'utf-8',
                  'priority' => '1',
                  'newline'  => "\r\n"
                );
        
        $this->email->initialize($config);
        $this->email->from('test@atclighting.co');
        $this->email->to($email);
        $this->email->subject('Activate your Rafeed account');
        
        $bodyMsg = '<p style="font-size:14px;font-weight:normal;margin-bottom:10px;margin-top:0;">We\'re so happy you\'ve join us<br>just click the button below to activate your account</p><a href="https://rafeed.co/User/active_user/'.$encrypted_id.'"><button style="cursor: pointer;">Activate my account</button></a>';
        $delimeter = "Rafeed co";
        $dataMail = array('topMsg'=> $topMsg, 'bodyMsg'=>$bodyMsg, 'thanksMsg'=>'Best regards,', 'delimeter'=> $delimeter);
        $message  = $this->load->view('mailTemplate/contactForm.php', $dataMail); //$message  =
        $this->email->message($message);
        $this->email->send();

    }

}
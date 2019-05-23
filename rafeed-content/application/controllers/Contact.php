<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	//public $CI = NULL;
	 public function __construct() {
        parent::__construct();
        // load email lib
        $this->load->library('email');
    }
	public function index()
	{
		//if(!$this->session->userdata('navdata'))
		{
			$this->load->library("navigation");
			$this->session->set_userdata('navdata',$this->navigation->set_navigation());

		}
		/*$this->set_navigation();*/
		$data['subview'] = 'contact_us';
		$data['pageTitle']='Contact us';
		$this->load->view('layouts/layout.php',$data);   
	}

	// send information
    public function send() {
        $this->load->library('form_validation');
        // field name, error message, validation rules
        $this->form_validation->set_rules('name', 'Name', 'trim|required');     
        $this->form_validation->set_rules('email', 'Your Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('comment', 'Comments', 'trim|required');
                   
        if($this->form_validation->run() == FALSE) {
            $this->index();
        } else {        
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $contact_no = $this->input->post('contact_no');
            $comment = $this->input->post('comment');            
            if(!empty($email)) {
                // send mail
                $config = array (
                  'protocol' => 'smtp',
                  'smtp_host' => 'mail.atclighting.co',
                  'smtp_user'    => 'enquire@atclighting.co',
                  'smtp_pass'   => 'rafeedEnquire2019',
                  'smtp_port' => '25',
                  'smtp_timeout' => '7',
                  'mailtype' => 'html',
                  'charset'  => 'utf-8',
                  'priority' => '1',
                  'newline'  => "\r\n"
                );
                $message='';
                $bodyMsg = '<p style="font-size:14px;font-weight:normal;margin-bottom:10px;margin-top:0;">'.$comment.'</p>';   
                $delimeter = $name."<br>".$contact_no."<br>".$email;
                $dataMail = array('topMsg'=>'Dear Rafeed Team', 'bodyMsg'=>$bodyMsg, 'thanksMsg'=>'Best regards,', 'delimeter'=> $delimeter);
 
                $this->email->initialize($config);
                $this->email->from($email,$name);
                $this->email->to("enquire@atclighting.co");//info
                $this->email->subject('Contact Form - Rafeed Website');
                $message = $this->load->view('mailTemplate/contactForm.php', $dataMail, TRUE);
                $this->email->message($message);
                $this->email->send();
 
                // confirm mail
                $bodyMsg = '<p style="font-size:14px;font-weight:normal;margin-bottom:10px;margin-top:0;">Thank you for contacting us.</p>';                 
                $dataMail = array('topMsg'=>'Dear '.$name, 'bodyMsg'=>$bodyMsg, 'thanksMsg'=>'Best regards,', 'delimeter'=> 'Rafeed Team' );
 
                $this->email->initialize($config);
                $this->email->from("enquire@atclighting.co", "Rafeed");//Info
                $this->email->to($email);
                $this->email->subject('Contact Form Confimation');
                $message = $this->load->view('mailTemplate/contactForm.php', $dataMail, TRUE);
                $this->email->message($message);
                $this->email->send();           
            }
            $data['msg']= 'Thank you for your message. It has been sent.';
			$data['subview'] = 'contact_us';
			$data['pageTitle']='Contact us';
			$this->load->view('layouts/layout.php',$data);  
        }
    }   
}
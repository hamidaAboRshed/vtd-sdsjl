<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 class UI_Language {

 	function __construct()
    {
    	
    }
    
    function get_ui_language() {
        $CI =& get_instance();
        
        //load libraries
        $CI->load->database();
        $CI->load->library("session");
        $CI->load->model('Language_model');
        //get session
        
        if (!$CI->session->userdata('user_language')) {
            $CI->session->set_userdata('user_language',$CI->Language_model->get_default_language());
        }
        return $CI->session->userdata('user_language');
    }

    function get_website_language()
    {
        $CI =& get_instance();
        
        //load libraries
        $CI->load->database();
        $CI->load->library("session");
        $CI->load->model('Language_model');
        //get session
        
        if (!$CI->session->userdata('site_language')) {
            $CI->session->set_userdata('site_language',$CI->Language_model->get_language());
        }
    }
    
 }
?>
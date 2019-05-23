<?php 
   class Cache_controller extends CI_Controller { 
	
      public function index() { 
         $this->output->cache(1); 
         $this->load->view('Home'); 
      }
		
      public function delete_file_cache() { 
         $this->output->delete_cache('cachecontroller'); 
      } 
   } 
?>
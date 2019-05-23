<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Example use of the CodeIgniter Sitemap Generator Model
 * 
 * @author Gerard Nijboer <me@gerardnijboer.com>
 * @version 1.0
 * @access public
 *
 */
class Sitemap extends CI_Controller {
	public function __construct() {
		parent::__construct();
		// We load the url helper to be able to use the base_url() function
		$this->load->helper('url');
		
		$this->load->model('Product_model');
		$this->load->model('sitemap_model');

		$this->articles = array();
		
		$this->load->library("navigation");
		$this->session->set_userdata('navdata',$this->navigation->set_navigation());
		// Array of some articles for demonstration purposes
		 foreach ($this->session->userdata('navdata') as $key => $value) {
            foreach ($value["catergory"] as $key2 => $value2) {
            	$url_link="";
                if($value2["ID"]==22)
                	$url_link = array(
                		'loc' => base_url().'index.php/Product/Product_series_list/5',
						'lastmod' => date('Y-m-d', time()),
						'changefreq' => 'monthly',
						'priority' => '1'
					);
                else 
                	$url_link = array(
                		'loc' => base_url()."index.php/Product/Product_category_list/".$value2["ID"],
						'lastmod' => date('Y-m-d', time()),
						'changefreq' => 'monthly',
						'priority' => '1'
					);
                array_push($this->articles, $url_link);
                //get all product link
                $products=$this->Product_model->get_product($value2["ID"]);
                foreach ($products as $key3 => $value3) {
                	$url_link = array(
                		'loc' => base_url().'index.php/Product/Product_view/'.$value3["ID"],
						'lastmod' => date('Y-m-d', time()),
						'changefreq' => 'monthly',
						'priority' => '1'
					);
					array_push($this->articles, $url_link);
                }
            }
        }
	}
	
	/**
	 * Generate a sitemap index file
	 * More information about sitemap indexes: http://www.sitemaps.org/protocol.html#index
	 */
	public function index() {
		$this->sitemap_model->add(base_url('sitemap/general'), date('Y-m-d', time()));
		$this->sitemap_model->add(base_url('sitemap/articles'), date('Y-m-d', time()));
		$this->sitemap_model->output('sitemapindex');
	}
	
	/**
	 * Generate a sitemap both based on static urls and an array of urls
	 */
	public function general() {
		$this->sitemap_model->add(base_url(), NULL, 'monthly', 1);
		$this->sitemap_model->add(base_url().'index.php/Home/contact_us', NULL, 'monthly', 0.9);
		$this->sitemap_model->add(base_url().'index.php/Home/about', NULL, 'monthly', 0.9);
		$this->sitemap_model->add(base_url().'index.php/Home/agents', NULL, 'monthly', 0.9);
		$this->sitemap_model->add(base_url().'index.php/Home/cct_info', NULL, 'monthly', 0.9);
		$this->sitemap_model->add('https://www.facebook.com/AtcLighting/', NULL, 'monthly', 0.9);
		foreach ($this->articles as $article) {
			$this->sitemap_model->add($article['loc'], $article['lastmod'], $article['changefreq'], $article['priority']);
		}
		$this->sitemap_model->output();
	}
	
	/**
	 * Generate a sitemap only on an array of urls
	 */
	public function articles() {
		foreach ($this->articles as $article) {
			$this->sitemap_model->add($article['loc'], $article['lastmod'], $article['changefreq'], $article['priority']);
		}
		$this->sitemap_model->output();
	}
	
}
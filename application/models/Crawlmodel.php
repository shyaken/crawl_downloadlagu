<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crawlmodel extends CI_Model {

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
         private $database;
         
         function __construct() {
             parent::__construct();
             $this->database = 'track';
         }
    
        public function getPage($page) 
        {
            $content = file_get_contents("http://downloadlagupro.com/lagu-terbaru?page=$page");
            preg_match_all('/<a title="(.*?)" href="(.*?)" class="ellip">(.*?)<\/a>/', $content, $matches);
            return $matches;
        }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trackmodel extends CI_Model {

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
	public function __construct()
	{
		
	}
        
        public function test() 
        {
            echo "Inside Test function";
        }
        
        public function saveMulti($data) {
            $this->db->replace_batch('tracks',$data);
        }
        
        public function save($data) {
            $this->db->replace('tracks', $data);
        }
        
        public function getAll() {
            return $this->db->get('tracks')->result();
        }
}

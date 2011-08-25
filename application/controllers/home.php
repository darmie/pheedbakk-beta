<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->ion_auth->check_login();
	}
	
	private function isLogged() {
		if($this->ion_auth->logged == true) {
			redirect("users");
		}
		return false;
	}
	
	public function index()
	{
		//Data to be passed to the view
		$data['title'] = "Welcome to PheedBakk";
		
		$this->isLogged();
		$this->load->view('templates/header',$data);
		$this->load->view('homepage');
		$this->load->view('templates/footer');
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
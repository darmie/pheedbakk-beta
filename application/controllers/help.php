<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 /**
  * Controller for help and support
  */
  class Help extends CI_Controller {
  
  function __construct() {
	  parent::__construct();
	  $this->ion_auth->check_login();
  }
  function index() {
	  $data['title'] = "Help And Support | PheedBakk ";
	  $data['logged'] = $this->ion_auth->logged;
	  $data['username'] = $this->ion_auth->username;
	  $data['user'] = $this->ion_auth->user;
	  $data['user_id'] = $this->ion_auth->user_id;
	  
	  if($data['logged'] == true) {
		  $this->load->view('templates/user_header',$data);
	  }else {
		  $this->load->view('templates/header',$data);
	  }
	  $this->load->view('help/index');
	  $this->load->view('templates/footer');
  }
  function pheeds() {
	  $this->load->view('help/pheeds');
  }
  function keywords() {
	  $this->load->view('help/keywords');
  }
  function conversations() {
	   $this->load->view('help/conversations');
  }
  function discussions() {
	  $this->load->view('help/discussions');
  }
}
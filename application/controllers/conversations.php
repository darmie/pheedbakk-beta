<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  class Conversations extends CI_Controller {
	  
	  /**
	  * Class Construct
	  */
	  function __construct() {
		  parent::__construct();
		  $this->ion_auth->check_login();
	  }
	  
	  /**
	  * Index function of conversation controller
	  * Displays all user's conversations with other users's
	  */
	  function index() {
		  $data['title'] = $this->ion_auth->username. " Conversations| PheedBakk";
		  $data['logged'] = $this->ion_auth->logged;
		  $data['username'] = $this->ion_auth->username;
		  $data['user'] = $this->ion_auth->user;
		  $data['user_id'] = $this->ion_auth->user_id;
		  
		  $this->load->view('templates/user_header',$data);
		  $this->load->view('users/conversations');
		  $this->load->view('templates/footer');
	  }
}
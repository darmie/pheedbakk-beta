<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** 
* Conversation Controler
* @author Patrick Foh
*/
  class Conversations extends CI_Controller {
	  
	  /**
	  * Class Construct
	  */
	  function __construct() {
		  parent::__construct();
		  $this->ion_auth->check_login();
	  }
	  /**
	  * Index method of the Conversation Controller
	  * Displays all a users conversation inbox
	  */
	  function index() {
		  //Load neccessary models,libraries,helpers
		  $this->load->model('conversation_model');
		  
		 $data['title'] = "Conversations | PheedBakk";
		 $data['username'] = $this->ion_auth->username;
		 $data['user_id'] = $this->ion_auth->user_id;
		 $data['messages'] = $this->conversation_model->get_user_conversations($this->ion_auth->user_id);
		  
		  $this->load->view('templates/user_header',$data);
		  $this->load->view('users/conversations');
		  $this->load->view('templates/footer');
	  }
}
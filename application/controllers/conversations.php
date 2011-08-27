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
		  //load model
		  $this->load->model('conversation_model');
		  $this->load->model('user_model');
  
		  $data['title'] = $this->ion_auth->username. " Conversations| PheedBakk";
		  $data['logged'] = $this->ion_auth->logged;
		  $data['username'] = $this->ion_auth->username;
		  $data['user'] = $this->ion_auth->user;
		  $data['user_id'] = $this->ion_auth->user_id;
		  $gist_array = array();
		  $conversations = $this->conversation_model->get_conversations();
		  foreach($conversations as $conv) {
			  $gist['sender_id'] = $this->user_model->return_username($conv->sender_id);
			  $gist['reciever_id'] = $this->user_model->return_username($conv->reciever_id);
			  $gist_array[] = $gist;
		  }
		  $data['conversations'] = $gist_array;
		  
		  $this->load->view('templates/user_header',$data);
		  $this->load->view('users/conversations');
		  $this->load->view('templates/footer');
	  }
	  function start($reciever) {
		  $this->load->model('conversation_model');
		  
		  $data['title'] = $this->ion_auth->username. " and ".$reciever." | PheedBakk";
		  $data['logged'] = $this->ion_auth->logged;
		  $data['username'] = $this->ion_auth->username;
		  $data['user'] = $this->ion_auth->user;
		  $data['user_id'] = $this->ion_auth->user_id;
		  $data['reciever'] = $reciever;
		  $data['conv_id'] = $this->conversation_model->start_conversation($reciever);
		  
		  $this->load->view('templates/user_header',$data);
		  $this->load->view('users/conversing');
		  $this->load->view('templates/footer');
	  }
	  function post_message() {
		  //Load the conversation model
		  $this->load->model('conversation_model');
		  //Get values from post array
		  $r_id = $this->input->post('reciever');
		  $msg = ltrim($this->input->post('message'),"");
		  $conv_id = $this->input->post('conv_id');
		  $time = time();
		  
		  $data = array(
		  	"C_id"=>$conv_id,
			"message"=>$msg,
			"post_time"=>$time,
			"read"=>0,
			"U_id"=>$this->ion_auth->user_id
		  );
		  if($this->conversation_model->new_message($data) == true )
		  {
			  return true;
		  }else {
			  return false;
		  }
	  }
}
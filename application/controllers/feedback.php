<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  class Feedback extends CI_Controller {
	  
	  function __construct() {
		  parent::__construct();
		  $this->ion_auth->check_login();
	  }
	  
	  function index() {
		  $data['title'] = "Feedback | PheedBakk";
		  $data['user_id'] = $this->ion_auth->user_id;
		  $data['username'] = $this->ion_auth->username;
		  $data['logged'] = $this->ion_auth->logged;
		  
		  if($data['logged'] == true) {
			  $this->load->view('templates/user_header',$data);
		  } else {
			  $this->load->view('templates/header',$data);
		  }
		  $this->load->view('feedback');
		  $this->load->view('templates/footer');
	  }
	  
	  function send_feedback() {
		  $this->load->library('email');
		  $this->load->model('user_model');
		  
		  $email = $this->input->post('email');
		  $comment = $this->input->post('comment');
		  
		  $to = "feedback@pheedbakk.com";
		  $from = $email;
		  $subject = "Feedback on PheedBakk";
		  $msg = $comment;
		  
		  if($this->ion_auth->logged == true) {
			  $name = $this->user_model->get_name($this->ion_auth->username);
		  }else { $name = "Guest"; }
		
		  
		  $this->email->to($to);
		  $this->email->subject($subject);
		  $this->email->from($from,$name);
		  
		  if($this->email->send()) {
			  echo "<p>Feedback Sent, thank you</p>";
		  } else {
			  echo "<p>An error occured while sending your feedback</p>";
		  }
	  }
  }
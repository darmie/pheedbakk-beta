<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  class Comments extends CI_Controller {
	  
	  function __construct() {
		  parent::__construct();
		  $this->ion_auth->check_login();
	  }
	  
	  function get_comments() {
		  $this->load->model('comment_model');
		  $this->load->model('user_model');
		  $this->load->helper('date');
		  
		  $pheed_id = $this->input->post('pheed_id');
		  $comments = $this->comment_model->retrieve_comments($pheed_id);
		  $commts = array();
		  foreach ($comments as $comment) {
			  $cm['comment'] = $comment->comment;
			  $cm['user'] = $this->user_model->return_username($comment->U_id);
			  $cm['time'] = timespan($comment->post_time,time());
			  
			  $commts[] = $cm;
		  }
		  echo json_encode($commts);
	  }
	  
	  function post_comment() {
		  $this->load->model('comment_model');
		  $this->load->model('user_model');
		  
		  $user_id = $this->ion_auth->user_id;
		  $comment = strip_tags($this->input->post('comment'));
		  $comment = mysql_real_escape_string($comment);
		  $pheed_id = $this->input->post('pheed_id');
		  
		  $data = array (
		  "U_id"=>$user_id,
		  "P_id"=>$pheed_id,
		  "comment"=>$comment,
		  "post_time"=>time()
		  );
		  if($this->comment_model->new_comment($data) == true) {
			  $response['response'] = "ok";
			  $response['user'] = $this->ion_auth->username;
			  echo json_encode($response);
		  }else {
		  $response['response'] = "no";
		  echo json_encode($response);
		  }
	  }
	  
	  
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class Conversation_model extends CI_Model {
	  public $user_id;
	  
	  function __construct() {
		  parent::__construct();
		  $this->user_id = $this->ion_auth->user_id;
	  }
	  
	  	/**
		* Retrieves all a user's conversations
		*/
		function get_conversations() {
			//query
			$q = "SELECT * FROM conversation_meta WHERE sender_id='$this->user_id'
			OR reciever_id='$this->user_id'";
			$result = $this->db->query($q);	
			$msg = $result->result();
			return $msg;
		}
		/**
		* Start a new conversation with a user
		*/
		function start_conversation($user) {
			//Load
			$this->load->model('user_model');
			//convert username to the user id of the party to start the conversation with
			$reciever_id = $this->user_model->get_user_id($user);
			$sender_id = $this->ion_auth->user_id;
			//First check if a conversation between the two users exists
			$q = "SELECT * FROM conversation_meta
			WHERE sender_id='$sender_id' AND reciever_id='$reciever_id'
			LIMIT 1";
			$result = $this->db->query($q);
			$rows = $result->row();
			if(count($rows) == 1 ) {
				return $rows->id;
			}
			//if no prior conversation was found start one
			else {
				//build values
				$conv = array("sender_id"=>$sender_id,
							"reciever_id"=>$reciever_id
							);
				$query = $this->db->insert('conversation_meta',$conv);
				return $this->db->insert_id();
			}
		}
		function new_message($options) {
			$q = $this->db->insert('conversations',$options);
			if($this->db->affected_rows() > 0 ) {
				return true;
			}
			return false;
		}
  }
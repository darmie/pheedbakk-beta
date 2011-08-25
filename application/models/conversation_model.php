<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class Conversation_model extends CI_Model {
	  public $user_id;
	  
	  function __construct() {
		  parent::__construct();
		  $this->user_id = $this->ion_auth->user_id;
	  }
	  
		function get_conversations() {
			//query
			$q = "SELECT * FROM conversation_meta WHERE sender_id='$this->user_id'
			OR revciever_id='$this->user_id'";
			$result = $this->db->query($q);	
			$msg = $result->result();
			return $msg;
		}
		
  }
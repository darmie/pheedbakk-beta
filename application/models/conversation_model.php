<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class Conversation_model extends CI_Model {
   
   /**
   * Retrieves all a user's conversations
   * @param user_id
   * @return array
   */
   function get_user_conversations($user_id) {
	   //database query
	   $q = $this->db->select('*')
	   				 ->from('conversations_inbox')
					 ->where('R_id',$user_id)
					 ->order_by('post_time','desc')
					 ->get();
		$result = $q->result();
   }
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class Comment_model extends CI_Model {
  function count_comments($pheed_id) {
	  //Query
	  $q = $this->db->select('*')
	  				 ->from('pheed_comments')
					 ->where('P_id',$pheed_id)
					 ->get();
			$comments = $q->result();
			$no_comments = count($comments);
			return $no_comments;
  }
  
  function retrieve_comments($pheed_id) {
	  //query
	  $q = $this->db->select('*')
	  			    ->from('pheed_comments')
					->where('P_id',$pheed_id)
					->get();
			$comments = $q->result();
			return $comments;
  }
  function new_comment($options = array()) {
	  //query
	  $q = $this->db->insert('pheed_comments',$options);
	   if($this->db->affected_rows() > 0) {
		   
			return true;
		}
			return false;
		}
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class User_model extends CI_Model {
	 
  /** Utility Functions **/
  	
  	/**
  	 * Gets the username of a user
  	 * @param integer $user_id
  	 * @return string username;
  	 * @access public
  	 */
  function get_username($user_id) {
  	//query
		$q = $this->db->select('username')
		->from('users')
		->where('email',$user_id)
		->get();
		$row = $q->row();
		$u = $row->username;
		return $u;
  }
  function return_username($id) {
	  $q = $this->db->select('username')
		->from('users')
		->where('id',$id)
		->get();
		$row = $q->row();
		$u = $row->username;
		return $u;
  }
  function get_user_id($username) {
	  $q = $this->db->select('id')
	  ->from('users')
	  ->where('username',$username)
	  ->get();
	  $result = $q->row();
	  $user_id = $result->id;
	  return $user_id;
  }
  
  /**
   * 
   * Gets the full name of a user
   * @param string $username
   * @return string name
   * @access public
   */
  function get_name($username) {
  	//Query
  	$q = $this->db->select('*')
  	->from('users')
  	->where('username',$username)
  	->join('profiles','users.id=profiles.user_id');
  	//Result
  	$row = $q->get()->row_array();
  	$fn = ucwords($row['first_name']);
  	$ln = ucwords($row['last_name']);
  	
  	$name = $fn ." ".$ln;
  	return $name;
  }

}
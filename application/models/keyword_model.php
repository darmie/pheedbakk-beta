<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class Keyword_model extends CI_Model {
  /**
  * Retreives all the keywords of a user
  * @param integer $user_id
  * @return array
  * <p>Returns an array of a user keywords</p>
  */
  function 	get_user_keywords($user_id) {
	  //Query
	  $q = $this->db->select('id,keywords')
	  				->from('keywords')
					->where('U_id',$user_id)
					->order_by('create_date','asc');
					
		$rows = $q->get();
		$words = $rows->result();
		$keywords = explode(",",$words[0]->keywords);
		return $keywords;
  }
  /**
   * Adds a new keywords to user keyword list
   * @param array $options
   * <p>Array Keys</p>
   * <p>user_id</p>
   * <p>create_date</p>
   * <p>keywords</p>
   * @return boolean
   * <p>Returns true if sucessfull and false if failed</p>
   */
  function add_keyword($options = array()) {
  	//first check if the user has already started his keywords list
	$q = $this->db->select('*')
				->from('keywords')
				->where('U_id',$options['U_id'])
				->get();
		$result = $q->result();
		$no_rows = count($result);
		//If a keyword list is found update it with the new keyword
		if($no_rows == 1 ) {
			$current_list = $result[0]->keywords;
			$new_keyword = $options['keywords'];
			$updated_list = $current_list.",".$new_keyword;
			
			$data = array(
				"keywords"=>$updated_list,
				"create_date"=>time()
			);
			$sql = $this->db->where('U_id',$options['U_id'])
							->update('keywords',$data);
							//check if any row was affected
							if($this->db->affected_rows() > 0 ) {
								return true;
							}
		} else {
			//If no prior keyword list was found start a new one
			$query = $this->db->insert('keywords',$options);
			if($this->db->affected_rows() > 0 ) {
								return true;
							} else {
								return false;
							}
		}
  	}
	
	/**
	* Deletes a keyword from a user's keyword list
	* @param string $keyword
	* @access public
	* @return boolean
	* true if successfull and false if not
	*/
	function delete_keyword($keyword) {
		//user id
		$user_id = $this->ion_auth->user_id;
		//query
		$q = $this->db->select('*')
					->from('keywords')
					->where('U_id',$user_id)
					->get();
		$row = $q->result();
		//User's keyword list
		$keyword_list = $row[0]->keywords;
		//Keyword to be deleted from the list
		$unwanted_keyword = $keyword;
		//explode the list into an array
		$keyword_list = explode(",",$keyword_list);
		//search for the keyword to be deleted and remove from the keyword list array from the explode function above
		unset($keyword_list[ array_search($keyword,$keyword_list) ]);
		//Rebuild the list without the deleted keyword
		$keyword_list = implode(',',$keyword_list);
		//Store the new list in $updated_list varibale
		$updated_list = $keyword_list;
		
		//build an array of data to be updated in the database
		$data = array(
			"keywords"=>$updated_list,
			"create_date"=>time()
		);
		//update the list in the database
		$sql = $this->db->where('U_id',$user_id)
						 ->update('keywords',$data);
			//Check if query was successfull
			if($this->db->affected_rows() > 0 ) {
				return true;
			} else {
				return false;
			}
	}
	
 }
 /**
 * End of file keyword_model.php
 * Location: /beta/application/models/keyword_model.php
 */
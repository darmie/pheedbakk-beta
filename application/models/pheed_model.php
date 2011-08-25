<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	  * Pheed Model
	  * Handles All Database interactions for pheeds
	  * @author Patrick.T.Foh
	 */
 class Pheed_model extends CI_Model {
	
	 function user_keywords($user_id) {
		 //Get all the user keywords
		 $q = $this->db->select('keywords')
		 				->from('keywords')
						->where('U_id',$user_id);
					$words = $q->get()->result();
					$keywords = explode(",",$words[0]->keywords);
					return $keywords;
	 }
	/**
	 * 
	 * Retrieeves the latest pheeds
	 */
	function get_latest_pheeds() {
     $data = $this->user_keywords($this->ion_auth->user_id);
	 $keyword = $data;
	 $user_id = $this->ion_auth->user_id;
			foreach($keyword as $key => $word) {
				
				$q = "SELECT *,COUNT(pheed_comments.comment_id) as comments
				FROM pheeds
				LEFT JOIN pheed_comments ON pheed_comments.P_id=pheeds.pheed_id
				WHERE pheed LIKE '%$word%' OR user_id='$user_id'
				GROUP BY pheeds.pheed_id
				ORDER BY datetime DESC";
				$result = $this->db->query($q);
				$rows[] = $result->result();
				
			}
			return $rows;
	}
	 /**
	 * Add a new pheed to database
	 * @var array options
	 * Array Structure
	 * user_id
	 * pheed
	 * datetime
	 */
	 function new_pheed($options = array()) {
		 //Create query
		 $q = $this->db->insert('pheeds',$options);
		 if($this->db->affected_rows() > 0) {
			return true;
		}
			return false;
		}
		
		/**
		* Repheeds a pheed
		* Re posts a pheed with all the containg keywords
		* @param integer $pheed_id
		* @return integer
		* No of repheeds of the pheed
		*/
	   function repheed_pheed($pheed_id) {
		   $q = $this->db->select('*')
		   				  ->from('pheeds')
						  ->where('pheed_id',$pheed_id)
						  ->limit(1)
						  ->get();
			$result = $q->row();
			//Pheed to be repheeded
			$pheed = $result->pheed;
			$repheeds = $result->repheeds;
			
	   }
 }
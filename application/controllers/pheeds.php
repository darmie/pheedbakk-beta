<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Pheeds extends CI_Controller {
	 /** 
	 *	Pheed Controller
	 *  Handles all pheed actions, adding,updating,removing
	 *  @author Patrick.T.Foh
	 */
	 	
		function __construct() {
 			parent::__construct();
 			$this->ion_auth->check_login();
			
 		}
 		/**
 		 * Checks if a user is logged in
 		 * @return boolean
 		 * Returns true if user is logged in
 		 * Retunrs false if user if not logged in
 		 */
		private function isLogged() {
			if($this->ion_auth->logged == false) {
				return false;
			}
			return true;
		}
		/**
		* Posts a new pheed
		* @access Public
		*/
	 	function add() {
			 $this->load->model('pheed_model');
			
			$pheedtime = time();
			$user_id = $this->ion_auth->user_id;
			$pheed = ltrim($this->input->post('pheed'));
			
			$options = array (
				"user_id"=>$user_id,
				"pheed"=>$pheed,
				"datetime"=>$pheedtime
			);
			
			if($this->pheed_model->new_pheed($options) == true) {
				echo "<p>Pheed Posted</p>";
			} else {
				echo "<p>Error in posting pheed</p>";
			}
		}
		
		function repheed() {
			$pheed_id = $this->input->post('pheed_id');
			//load the model
			$this->load->model('pheed_model');
			//repheed the pheed and return the number of repheeds to update the page
			$no_repheeds = $this->pheed_model->repheed_pheed($pheed_id);
			echo $no_repheeds;
		}
		function latest_pheeds() {
			//Confirm if a user is logged before allowing access
			if($this->isLogged() == true) {
			//load the pheed model for database interaction
			$this->load->model('pheed_model');
			//load user model
			$this->load->model('user_model');
			//load comment model
			$this->load->model('comment_model');
			//store the pheeds to a the $data variable
			$data = $this->pheed_model->get_latest_pheeds();
			//Load the date helper to calculate time difference between post time and current time
			$this->load->helper('date');
			//Current time(unix timetamp)
            $time = time();
			//pheeds
			$pheeds = array();
			if(count($data) > 0 ) {
				foreach($data as $pheed) {
					$row['pheed_id'] = $pheed->pheed_id;
					$row['user_id'] = $this->user_model->return_username($pheed->user_id);
					$row['pheed'] = $pheed->pheed;
					$row['datetime'] = timespan($pheed->datetime,$time);
					$row['comments'] = $this->comment_model->count_comments($pheed->pheed_id);
					$row['repheeds'] = $pheed->repheeds;
					$pheeds[] = $row;
				}
			  
			  echo json_encode($pheeds);
			}
			} else {
				
			}
			return false;
		}
		
		function favourites() {
			if($this->isLogged() == true) {
				//load model
				$this->load->model('pheed_model');
				$pheed = array();
				$pheeds = $this->pheed_model->user_favourite_pheeds($this->ion_auth->user_id);
				
				$data['title'] = "Your Favourite Pheeds | PheedBakk";
				$data['username'] = $this->ion_auth->username;
				$data['user_id'] = $this->ion_auth->user_id;
				$data['fav_pheeds'] = $pheeds;
				
				
				$this->load->view('templates/user_header',$data);
				$this->load->view('users/favourite_pheeds');
				$this->load->view('templates/footer');
			}
		}
		
		function favourite_pheed() {
			if($this->isLogged() == true) {
				//Load Model
				$this->load->model('pheed_model');
				///The id of the pheed to be favourited
				$pheed_id = $this->input->post('pheed_id');
				//The id of the user making the request
				$user_id = $this->ion_auth->user_id;
				//Current time(UNIX timestamp)
				$time = time();
				//build data array
				$data = array(
					"U_id"=>$user_id,
					"P_id"=>$pheed_id,
					"datetime"=>$time
				);
				if($this->pheed_model->make_favourite($data) == true) {
					$response = array(
					"message"=>"The pheed has been added to your favourite list"
					);
					echo json_encode($response);
				} else {
					$response = array(
					"message"=>"The pheed has already been added to your favourite list"
					);
					echo json_encode($response);
				}
			}
		}
	 /**
	 * End of file pheeds.php
	 * Location: application/controller/pheeds
	 */
 }
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 	/**
 	 * Users Controller
 	 * <p>Handles All user actions</p>
 	 * @author Patrick Foh
 	 * @filesource application/controllers/users.php
 	 *
 	 */	
	class Users extends CI_Controller {
 		
		/**
		* Users Controller construct function
		*/
 		function __construct() {
 			parent::__construct();
 			$this->ion_auth->check_login();
			
 		}
		private function isLogged() {
			if($this->ion_auth->logged == false) {
				redirect("");
			}
			return true;
		}
		/**
		* Insdex function for the users controller
		* Displays user homepage
		*/
		function index() {
			$this->isLogged();
			$data['title'] = "Home | PheedBakk";
			$data['logged'] = $this->ion_auth->logged;
 			$data['username'] = $this->ion_auth->username;
 			$data['user'] = $this->ion_auth->user;
 			$data['user_id'] = $this->ion_auth->user_id;
			
			$this->load->view('templates/user_header',$data);
			$this->load->view('users/home');
			$this->load->view('templates/footer');
		}
 		
 		function login() {
 			$data['title'] = "Welcome to PheedBakk";
 			
 			$this->form_validation->set_rules('email','Email','required|valid_email');
 			$this->form_validation->set_rules('password','Password','required');
 			
 			if($this->form_validation->run() == true) {
 				$remember = (bool) $this->input->post('remember');
				$email = $this->input->post('email');
				$password = $this->input->post('password');
 			}
			if($this->ion_auth->login($email,$password,$remember) !== false) {
					redirect('users');
				} else {
					$data['message'] = $this->ion_auth->errors();
				}
			
 			$this->load->view('templates/header',$data);
 			$this->load->view('homepage');
 			$this->load->view('templates/footer');
 		}
 		
 		/**
 		 * 
 		 * Registers a new user
 		 */
 		function signup() {
 			
 			//Data to be passed to the views
 			$data['title'] = "Sign Up | PheedBakk";
 			$data['logged'] = $this->ion_auth->logged;
 			$data['username'] = $this->ion_auth->username;
 			$data['user'] = $this->ion_auth->user;
 			$data['user_id'] = $this->ion_auth->user_id;
 			
 			//Validate Form
 			$this->form_validation->set_rules('first_name','First Name','required|alpha');
 			$this->form_validation->set_rules('last_name','Last Name','required|alpha');
 			$this->form_validation->set_rules('email','Email','required|valid_email');
 			$this->form_validation->set_rules('emailconf','Confirm Email','required|valid_email|matches[email]');
 			$this->form_validation->set_rules('username','Username','required');
 			$this->form_validation->set_rules('password','Password','required|min_lenght[6]|max_lenght[10]');
 			$this->form_validation->set_rules('passconf','Confirm Password','required||min_lenght[6]|max_lenght[10]|matches[password]');
 			
 			
 			//If form data is valid continue
	 		if($this->form_validation->run()) {
				
			//If form passes validation carry on
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$username = $this->input->post('username');
			$firstname = $this->input->post('first_name');
			$lastname = $this->input->post('last_name');
			
				$user_data = array(
				"first_name"=>$firstname,
				"last_name"=>$lastname
				);
			}
			if($this->form_validation->run() &&
			$this->ion_auth->register($username,$password,$email,$user_data)) {
				$this->session->set_flashdata('user_email',$email);
				redirect("users/account_created");
			}
 		
 			//Load Views
 			$this->load->view('templates/header',$data);
 			$this->load->view('users/signup');
 			$this->load->view('templates/footer');
 			
 		}
 		
 		function account_created() {
 			
 			//Data to be passed to the view
 			$data['title'] = "Sign Up Complete | PheedBakk";
 			$data['logged'] = $this->ion_auth->logged;
 			$data['username'] = $this->ion_auth->username;
 			$data['user'] = $this->ion_auth->user;
 			$data['user_id'] = $this->ion_auth->user_id;
 			$data['user_email'] = $this->session->flashdata('user_email');
 			
 			//Load Views
 			$this->load->view('templates/header',$data);
 			$this->load->view('users/signup_complete');
 			$this->load->view('templates/footer');
 	
 		}
 		function activate($id,$code=false) {
 		if ($code !== false) {
			$activation = $this->ion_auth->activate($id, $code);
				$this->load->view('templates/header');
				$this->load->view('users/activated');
				$this->load->view('templates/footer');
				
 			} 
 		}
 		function resetpassword() {
 			
 		}
		
		function logout() {
			$this->ion_auth->logout();
	 	redirect($this->config->item('base_url'));
		}
 /*
  * End of file users.php
  * Location: ./application/controllers/users.php 
  */
 }
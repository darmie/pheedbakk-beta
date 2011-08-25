  <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Keywords extends CI_Controller {
		
		function __construct() {
			parent::__construct();
			$this->ion_auth->check_login();
		}
		
		function index() {
			$this->load->model('keyword_model');
			  $data['title'] = "Keywords | PheedBakk";
			  $data['logged'] = $this->ion_auth->logged;
			  $data['username'] = $this->ion_auth->username;
			  $data['user'] = $this->ion_auth->user;
			  $data['user_id'] = $this->ion_auth->user_id;
			
			
			$this->load->view('templates/user_header',$data);
			$this->load->view('users/keywords');
			$this->load->view('templates/footer');
		}
		
		function user_keywords() {
			//load keyword model
			$this->load->model('keyword_model');
			//Store keywords in $word
			$words = $this->keyword_model->get_user_keywords($this->ion_auth->user_id);
		   //check if user has created keywords
		  if(count($words) != 0 ) {
			 for($i=0; $i<count($words); $i++) {
				 $k[] = array("keywords"=>$words[$i]);
			 }
			 echo json_encode($k);
		  }
		}
		
		function new_keyword() {
		  //Load keyword model
		  $this->load->model('keyword_model');
		  //Current time(unix)
		  $time = time();
		  //keyword from form
		  $keyword = $this->input->post('keyword');
		  //Id of the user
		  $user_id = $this->ion_auth->user_id;
		  
		  //build an array of values to passed to the model
		  $options = array(
		  	"U_id"=>$user_id,
			"keywords"=>$keyword,
			"create_date"=>$time
		  );
		  //Create the keyword
		  if($this->keyword_model->add_keyword($options) == true) {
			  echo "<p>Keyword created</p>";
		  } else {
			  echo "<p>An error has occured</p>";
		  }
		}
		
		function remove_keyword() {
			$this->load->model('keyword_model');
			
			$keyword = $this->input->post('keyword');
			
			if($this->keyword_model->delete_keyword($keyword) == true) {
				return 1;
			} else { return 0; }
		}
  }
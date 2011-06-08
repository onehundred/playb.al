<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	class Main extends CI_Controller { 
		function __construct() { 
			parent::__construct(); $this->load->helper('MY_form_helper');
			 #$this->output->cache(3600);
		} 
		
		function index() { 
			$is_logged_in = $this->session->userdata('is_logged_in'); 
			if(isset($is_logged_in) && $is_logged_in == true) { 
				redirect('sportchoice/sport'); 
			}else{ $data['main_content'] = 'main_index'; 
				$this->load->view('includes/template', $data); 
			} 
		} 
				
		function login() { 
		
			$username = $_POST['username'];
			$password = $_POST['password'];
		
			$this->load->model('main_model'); 
			$query = $this->main_model->validate($username, $password); 
			if($query) { 
		
			$queryid = $this->db->query("SELECT user_id, gebruikersnaam FROM users WHERE gebruikersnaam = '$username' OR email = '$username';");
			
		    if ($queryid->num_rows() > 0) { 
		    	foreach ($queryid->result() as $row) { 
		    		$id= $row->user_id; 
		    		$username = $row->gebruikersnaam; 
		    	} 
		    } 
		    $data = array( 
		    'username' => $username, 
		    'user_id' => $id, 
		    'is_logged_in' => true ); 
		    
		    $this->session->set_userdata($data); 
		    
		    $check = 'true';
		    echo json_encode($check); 
			}else{ 
			
			$check = 'false';
			echo json_encode($check); 
			} 
		} 
		
	  function signup() { 
	  	 $data['main_content']= 'main_signup';
	   	 $this->load->view('includes/template', $data); 
	   } 
	   
	   function logout() { 
	   	$this->session->sess_destroy(); 
	   	$this->index(); 
	   	} 
	   	
	   	function create_user() { 
	   		$this->load->library('form_validation'); 
	   		$this->form_validation->set_rules('voornaam', 'Name', 'trim|required'); 
	   		$this->form_validation->set_rules('achternaam', 'Last Name', 'trim|required'); 
	   		$this->form_validation->set_rules('land', 'Country', 'trim|required'); 
	   		$this->form_validation->set_rules('email', 'E-maill', 'trim|required|valid_email'); 
	   		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]'); 
	   		$this->form_validation->set_rules('paswoord', 'Password', 'trim|required|min_length[4]'); 
	   		$this->form_validation->set_rules('paswoord2', 'Password confirmation', 'trim|required|matches[paswoord]'); 
	   		if($this->form_validation->run() == FALSE) { 
	   			$this->signup(); 
	   		}else{ 
	   		
	   			$this->load->model('main_model'); 
	   			if($suery = $this->main_model->create_user()) { 
	   				$data['main_content'] = 'signup_succesful'; 
	   				$this->load->view('includes/template', $data); 
	   			}else{ 
	   				$this->signup(); 
	   			}
	   		 } 
	   	}
} 
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
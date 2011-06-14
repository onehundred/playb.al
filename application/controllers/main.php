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
			}else{ 
				$data['main_content'] = 'main_index'; 
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
	   
	  function check_username(){
	  	$username = $_POST['username'];
	  	$email = $_POST['email'];
	  	
	  	$this->load->model('main_model'); 
	   	$check = $this->main_model->check_username($username, $email);
	  	
	  	echo json_encode($check);
	  	
	  } 
	   
	   function logout() { 
	   	$this->session->sess_destroy(); 
	   	$this->index(); 
	   	} 
	   	
	   	function create_user() { 
	   	
	   		$username =$_POST['username'];
	   		$paswoord = $_POST['password'];
	   		$voornaam = $_POST['voornaam'];
	   		$achternaam = $_POST['achternaam'];
	   		$email = $_POST['email'];
	   		
	   			$this->load->model('main_model'); 
	   			$this->main_model->create_user($username, $paswoord, $voornaam, $achternaam, $email);
	   		
	   			   		
	   		 
	   	}
	   	
	   	function signup_success()
	   	{
	   	 $data['main_content']= 'signup_succesful';
	   	 $this->load->view('includes/template', $data); 
	
	   	}
		
		
		function resend_password()
		{
			if(isset($_POST['email'])){
			
				$this->load->model('main_model');
				$check = $this->main_model->resend_password($_POST['email']);
				
				if($check == false){
					$data['resend'] = "error";
				}else{
				
					$data['resend'] = "resend";
				}
				$data['main_content'] = 'main_resend_password'; 
				$this->load->view('includes/template', $data); 
				
			}else{
		
				$data['main_content'] = 'main_resend_password'; 
				$this->load->view('includes/template', $data); 
			}
		}
		
		
		function update_password()
		{
			if(isset($_POST['password1'])){
				$this->load->library('form_validation');

			
			$this->form_validation->set_rules('password1', 'Password', 'required|matches[password2]');
			$this->form_validation->set_rules('password2', 'Password Confirmation', 'required');
			
				if ($this->form_validation->run() == FALSE)
				{
					$data['update'] = 'true';
					$data['main_content'] = 'main_resend_password'; 
					$this->load->view('includes/template', $data);
				}
				else
				{
					$userid = $this->uri->segment('3');
					$this->load->model('main_model');
					$this->main_model->reset_paswoord($_POST['password1'], $userid);
				
					$data['update'] = 'success';
					$data['main_content'] = 'main_resend_password'; 
					$this->load->view('includes/template', $data);
				}
			
			}else{
			
				$userid = $this->uri->segment('3');
				$oud_pass = $this->uri->segment('4');
				
				if($userid == ''){
						$data['update'] = 'false';
						$data['main_content'] = 'main_resend_password'; 
						$this->load->view('includes/template', $data);
				}else{
					$this->load->model('main_model');
					$check = $this->main_model->update_password($userid, $oud_pass);
						
						if($check === true){
							$data['update'] = 'true';
							$data['main_content'] = 'main_resend_password'; 
							$this->load->view('includes/template', $data); 
						
						}else{
							$data['update'] = 'false';
							$data['main_content'] = 'main_resend_password'; 
							$this->load->view('includes/template', $data);
						}
				}
			}	
		}
		
} 
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
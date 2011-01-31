<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
	}

	function index()
	{
				
		$data['main_content'] = 'main_login';
		$this->load->view('includes/template', $data);
		
	}
	
	
	function login()
	{
		$this->load->model('main_model');
		$query = $this->main_model->validate();
		
		if($query) //als de inloggegevens juist zijn
		{
			$data = array(
				'username' => $this->input->post('username'),
				'is_logged_in' => true
			
			);
			
			$this->session->set_userdata($data);
			$this->login_succes();
		
		}
		else{
			$this->index();
		}
	
	}
	
	
	
	function login_succes()
	{
			$data['main_content']= 'main_sportkeuze';
	
			$this->load->view('includes/template', $data);
	}
	
	
	
	function signup()
	{
					$data['main_content']= 'main_signup';
	
			$this->load->view('includes/template', $data);
	}
	
	function create_user()
	{
		echo "hello";
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
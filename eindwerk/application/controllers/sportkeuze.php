<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sportkeuze extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
		
	}

	function sport()
	{
				
		$data['main_content'] = 'main_sportkeuze';
		$this->load->view('includes/template', $data);
		
	}
	
	
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			echo 'you must be logged in';
			echo '<a href="../main">Login</a>';
			die();
			 
		}
	
	}
	
	



}
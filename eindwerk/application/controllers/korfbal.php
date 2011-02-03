<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Korfbal extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();

		
		
	}
	
	//kijken of men ingelogd is
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
		 $data['main_content'] = 'session_fail';
		 $this->load->view('includes/template', $data);
			
		}
	}


	function start()
	{
		$team_id = $this->uri->segment('3');
		$data['main_content'] = 'korfbal/korfbal_index';
		$this->load->view('korfbal/includes/template', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
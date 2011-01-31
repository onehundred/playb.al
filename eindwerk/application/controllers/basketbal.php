<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Basketbal extends CI_Controller {

	function __construct()
	{
		parent::__construct();
			
	}

	function index()
	{
		echo "Dit is de basketbal Controller";
		echo $this->session->userdata('session_id');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
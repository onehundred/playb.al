<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
	
	}
	
	
	
	function fill_division()
	{
		$this->load->model('cron_model');
		$this->cron_model->bots();
	
	
	}
	
	
	function cron_test()
	{
	$mdate = date('Y-m-d h:i:s');
	
		$data = array(
			'deadline' => $mdate
		
		
		);
		$this->db->insert('korf_transfers',$data);
	
	}
	
	
	function arrange_games()
	{
		$this->load->model('cron_model');
		$this->cron_model->arrange_matches();
	
	}
	
	
}	
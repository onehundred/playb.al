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
	$teamid = 5;
		
		$this->load->model('training_model');
		$energiecheck = $this->training_model->check_energie($teamid);
		
		
		if($energiecheck == true){
		
		
		}else{
			$arr = array('energiecheck' => $energiecheck);
		 	$json = json_encode($arr); 
		 	echo $json;
		
		}


	}
	
	
	function arrange_games()
	{
		$this->load->model('cron_model');
		$this->cron_model->arrange_matches();
	
	}
	
	function energy_point()
	{
		$this->load->model('cron_model');
		$this->cron_model->energy_point();
	
	}
	
	
}	
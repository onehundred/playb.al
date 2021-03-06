<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Training extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		
	}
	
	
	function train_passing()
	{
		$teamid = $_POST['teamid'];
		
		
		$this->load->model('training_model');
		$energiecheck = $this->training_model->check_energie($teamid);
		
		if($energiecheck == true){
		
			$this->training_model->adjust_energie($teamid);
			$training = $this->training_model->train_passing($teamid);
			echo json_encode($training);
		
		}else{
		 $arr = array('energiecheck' => $energiecheck);
		 $json = json_encode($arr); 
		 echo $json;
		 
		 }
	
	}
	
	
	function train_stamina()
	{
		$teamid = $_POST['teamid'];
		
		$this->load->model('training_model');
		$energiecheck = $this->training_model->check_energie($teamid);
		
		
		if($energiecheck == true){
			$this->training_model->adjust_energie($teamid);
			$training = $this->training_model->train_stamina($teamid);
			echo json_encode($training);

		}else{
			$arr = array('energiecheck' => $energiecheck);
		 	$json = json_encode($arr); 
		 	echo $json;
		
		}
	
	}
	
	
	function train_shotpower()
	{
		$teamid = $_POST['teamid'];
		
		$this->load->model('training_model');
		$energiecheck = $this->training_model->check_energie($teamid);
		
		
		if($energiecheck == true){
			$this->training_model->adjust_energie($teamid);
			$training = $this->training_model->train_shotpower($teamid);
			echo json_encode($training);

		}else{
			$arr = array('energiecheck' => $energiecheck);
		 	$json = json_encode($arr); 
		 	echo $json;
		
		}


	}
	
	function train_shotprecision()
	{
		$teamid = $_POST['teamid'];
		
		$this->load->model('training_model');
		$energiecheck = $this->training_model->check_energie($teamid);
		
		
		if($energiecheck == true){
			$this->training_model->adjust_energie($teamid);
			$training = $this->training_model->train_shotprecision($teamid);
			echo json_encode($training);

		}else{
			$arr = array('energiecheck' => $energiecheck);
		 	$json = json_encode($arr); 
		 	echo $json;
		
		}
	}
	
	function train_intercepting()
	{
		$teamid = $_POST['teamid'];
		
		$this->load->model('training_model');
		$energiecheck = $this->training_model->check_energie($teamid);
		
		
		if($energiecheck == true){
			$this->training_model->adjust_energie($teamid);
			$training = $this->training_model->train_intercepting($teamid);
			echo json_encode($training);

		}else{
			$arr = array('energiecheck' => $energiecheck);
		 	$json = json_encode($arr); 
		 	echo $json;
		
		}
	}
	
	function train_rebound()
	{	
		$teamid = $_POST['teamid'];
		
		$this->load->model('training_model');
		$energiecheck = $this->training_model->check_energie($teamid);
		
		
		if($energiecheck == true){
			$this->training_model->adjust_energie($teamid);
			$training = $this->training_model->train_rebound($teamid);
			echo json_encode($training);

		}else{
			$arr = array('energiecheck' => $energiecheck);
		 	$json = json_encode($arr); 
		 	echo $json;
		
		}
	
	}
	
	function train_playmaking()
	{
		$teamid = $_POST['teamid'];
		
		$this->load->model('training_model');
		$energiecheck = $this->training_model->check_energie($teamid);
		
		
		if($energiecheck == true){
			$this->training_model->adjust_energie($teamid);
			$training = $this->training_model->train_playmaking($teamid);
			echo json_encode($training);

		}else{
			$arr = array('energiecheck' => $energiecheck);
		 	$json = json_encode($arr); 
		 	echo $json;
		
		}

		
	}
	
	
}	
	
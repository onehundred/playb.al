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
		$mannen = 0;
			$vrouwen = 0;
			$vak =2;
			$field = "attack3";
			$spelernaam = "dimitri";
			$geslacht = "male";
			//kijken of er al 2 mannen of vrouwen in een vak staan
			if($vak == 1){
				$this->db->select('*');
				$this->db->where('FK_team_id', 3);
				$query = $this->db->get('korf_opstelling');


				foreach($query->result() as $row){
					$r1 = $row->rebound1_geslacht;
					$p1 = $row->playmaking1_geslacht;
					$a1 = $row->attack1_geslacht;
					$a2 = $row->attack2_geslacht;

				}

				if($r1 == "male"){
					$mannen = $mannen + 1;
				}
				if($p1 == "male"){
					$mannen = $mannen + 1;
				}
				if($a1 == "male"){
					$mannen = $mannen + 1;
				}
				if($a2 == "male"){
					$mannen = $mannen + 1;
				}
				if($r1 == "female"){
					$vrouwen = $vrouwen + 1;
				}
				if($p1 == "female"){
					$vrouwen =$vrouwen + 1;
				}
				if($a1 == "female"){
					$vrouwen =$vrouwen + 1;
				}
				if($a2 == "female"){
					$vrouwen =$vrouwen + 1;
				}

			}

			if($vak == 2){
				$this->db->select('*');
				$this->db->where('FK_team_id', 3);
				$query = $this->db->get('korf_opstelling');


				foreach($query->result() as $row){
					$r2 = $row->rebound2_geslacht;
					$p2 = $row->playmaking2_geslacht;
					$a3 = $row->attack3_geslacht;
					$a4 = $row->attack4_geslacht;

				}

				if($r2 == "male"){
					$mannen = $mannen + 1;
				}
				if($p2 == "male"){
					$mannen = $mannen + 1;
				}
				if($a3 == "male"){
					$mannen = $mannen + 1;
				}
				if($a4 == "male"){
					$mannen = $mannen + 1;
				}
				if($r2 == "female"){
					$vrouwen = $vrouwen + 1;
				}
				if($p2 == "female"){
					$vrouwen =$vrouwen + 1;
				}
				if($a3 == "female"){
					$vrouwen =$vrouwen + 1;
				}
				if($a4 == "female"){
					$vrouwen =$vrouwen + 1;
				}

			}
			
			if($geslacht == "female"){

			if($vrouwen < 2){
				$update = array(
					$field."_speler" => $spelernaam,
					$field."_geslacht" => $geslacht
				);


				$this->db->where('FK_team_id', 3);
				$this->db->update('korf_opstelling', $update);

				$vakcheck = "valid";
				echo $vakcheck;

			}else{
				$vakcheck ="invalid vrouwen";
				echo $vakcheck;
			}
		}
		
			if($geslacht == "male"){

			if($mannen < 2){
				$update = array(
					$field."_speler" => $spelernaam,
					$field."_geslacht" => $geslacht
				);


				$this->db->where('FK_team_id', 3);
				$this->db->update('korf_opstelling', $update);

				$vakcheck = "valid";
				echo $vakcheck;

			}else{
				$vakcheck ="invalid mannen";
				echo $vakcheck;
			}

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
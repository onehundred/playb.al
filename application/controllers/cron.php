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
		$teamid = 41;
		
		$this->db->select('shotprecision_tr, shotprecision, skill_id, training_id, voornaam, achternaam');
    	$this->db->from('korf_training');
    	$this->db->join('korf_skills', 'FK_skill_id = skill_id');
    	$this->db->join('korf_spelers', 'FK_player_id = speler_id');
    	$this->db->join('korf_teams', 'FK_team_id = team_id');
    	$this->db->where('team_id', $teamid);
    	$query = $this->db->get();
    	
    	
    	$trainingsarray = array();
    	$i =1;
    	foreach($query->result() as $row){
    		$voornaam = $row->voornaam;
    		$achternaam = $row->achternaam;
    		$trainingid = $row->training_id;
    		//echo $trainingid;
    		$skillid = $row->skill_id;
    		//echo "id=".$skillid;
    		$shotprecision_tr =  $row->shotprecision_tr;
    		$rand = rand(20, 50);
    		$updateshotprecision_tr = $shotprecision_tr + $rand;
    		
    		$shotprecision = $row->shotprecision; 
    		$updateshotprecision = $shotprecision + 1;
    		//echo "passing=".$updatepassing; 
    		 
    		 
    		$trainingsarray[$i]['naam'] = $voornaam." ".$achternaam;
    		  		
    		if($updateshotprecision_tr >= 1000){
    			$updateshotprecision = $shotprecision+ 1;
    			$update = array(
    				'shotprecision' => $updateshotprecision
    			
    			);
    			
    			$this->db->where('skill_id', $skillid);
    			$this->db->update('korf_skills',$update);
    			
    			
    			$update2 = array(
    				'shotprecision_tr' => 0
    			
    			);
    			
    			$this->db->where('training_id', $trainingid);
    			$this->db->update('korf_training',$update2);
    		
    			$trainingsarray[$i]['niveau'] = $updateshotprecision;
    		}else{
    			
    			$update = array(
    				'shotprecision_tr' => $updateshotprecision_tr
    			
    			);
    			
    			$this->db->where('training_id', $trainingid);
    			$this->db->update('korf_training',$update);
    			
    			$trainingsarray[$i]['gestegen'] = $rand;
    			$trainingsarray[$i]['totaal'] = $updateshotprecision_tr;
    		
    		}
    		$i++;
    	
    
    	}
    	
    	return $trainingsarray;
    	



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
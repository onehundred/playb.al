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
	$this->db->select('passing_tr, passing, skill_id, training_id, voornaam, achternaam');
    	$this->db->from('korf_training');
    	$this->db->join('korf_skills', 'FK_skill_id = skill_id');
    	$this->db->join('korf_spelers', 'FK_player_id = speler_id');
    	$this->db->join('korf_teams', 'FK_team_id = team_id');
    	$this->db->where('team_id', 5);
    	$query = $this->db->get();
    	
    	
    	$trainingarray = array();
    	$i =1;
    	foreach($query->result() as $row){
    		$voornaam = $row->voornaam;
    		$achternaam = $row->achternaam;
    		$trainingid = $row->training_id;
    		//echo $trainingid;
    		$skillid = $row->skill_id;
    		//echo "id=".$skillid;
    		$passing_tr =  $row->passing_tr;
    		$rand = rand(20, 50);
    		$updatepassing_tr = $passing_tr + $rand;
    		
    		$passing = $row->passing; 
    		$updatepassing = $passing + 1;
    		//echo "passing=".$updatepassing; 
    		 
    		 
    		$trainingsarray[$i]['naam'] = $voornaam.$achternaam;
    		  		
    		if($updatepassing_tr >= 1000){
    			$updatepassing = $passing + 1;
    			$update = array(
    				'passing' => $updatepassing
    			
    			);
    			
    			$this->db->where('skill_id', $skillid);
    			$this->db->update('korf_skills',$update);
    			
    			
    			$update2 = array(
    				'passing_tr' => 0
    			
    			);
    			
    			$this->db->where('training_id', $trainingid);
    			$this->db->update('korf_training',$update2);
    		
    			$trainingarray[$i]['skill'] = 'Speler is gestegen naar niveau '.$updatepassing;
    		}else{
    			
    			$update = array(
    				'passing_tr' => $updatepassing_tr
    			
    			);
    			
    			$this->db->where('training_id', $trainingid);
    			$this->db->update('korf_training',$update);
    			
    			$trainingsarray[$i]['skill'] = 'Speler is '.$rand.' punten gestegen en heeft een totaal van '.$updatepassing_tr;
    		
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
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
	
	}
	
	
	//maakt alle divisies aan
	function create_divisions()
	{
		$this->load->model('cron_model');
		$this->cron_model->create_divisions();	
	}
	
	
	//vult alle divisies op met playbal teams
	function fill_division()
	{
		$this->load->model('cron_model');
		$this->cron_model->bots();
	
	
	}
	
	
	function cron_test()
	{
	$getal = 0; 
    //verdienen degradatie naar 4de
    for($i=1;$i<5;$i++){
    	$this->db->select('team_id, FK_division_id');
    	$this->db->from('korf_teams');
    	$this->db->join('korf_divisies','FK_division_id = divisie_id');
    	$this->db->where('divisie', 3);
    	$this->db->where('sub_divisie', $i);
    	$this->db->order_by('divisiepunten', 'asc');
    	$this->db->limit(2);
    	$degradatie = $this->db->get();
    	
    	$k =1 + $getal;
    	foreach($degradatie ->result() as $row)
    	{
    		
    		$degrTeamId[$k] = $row->team_id;
    		$degrDivId[$k] = $row->FK_division_id; 
    		$k++;  		
    	
    	}
    	
    	//verdienen promotie naar 3de
    	$l =1 +$getal;
    	for($j=1+$getal;$j<3+$getal;$j++)
    	{
    		//echo $j;
    		
    		
    		$this->db->select('*');
    		$this->db->from('korf_teams');
    		$this->db->join('korf_divisies','FK_division_id = divisie_id');
    		$this->db->where('divisie', 4);
    		$this->db->where('sub_divisie', $j);
    		$this->db->order_by('divisiepunten', 'desc');
    		$this->db->limit(1);
    		$promotie2 = $this->db->get();
    		
    		
    		foreach($promotie2->result() as $row)
    		{
    			
    		$promTeamId = $row->team_id;
    		$promDivId = $row->FK_division_id;
    		
    		//echo $l;
    		//echo $degrDivId[$l];
    		//echo $degrTeamId[$l];
    		//echo $promTeamId;
    		//echo $promDivId;
    		//echo '<br/>';
    		
    		$update = array(
    			'FK_division_id' => $degrDivId[$l]
    		);
    		
    		$this->db->where('team_id',$promTeamId );
    		$this->db->update('korf_teams', $update);
    		
    		$update2 =array(
    			'FK_division_id' => $promDivId
    		);
    		
    		$this->db->where('team_id', $degrTeamId[$l]);
    		$this->db->update('korf_teams', $update2);
    		
    		}
    		$l++;
    	}
    	$getal = $getal + 2;	
    	}

    
	    	    	
	}
	
	//op het begin van elk nieuw seizoen
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
	
	//om de 2 dagen na het spelen van de matchen
	function update_week()
	{
		$this->load->model('cron_model');
		$query = $this->cron_model->get_croninfo();
		
		foreach($query->result() as $row)
		{
			$week = $row->week;
		}
		
		$this->cron_model->update_week($week);
		
	
	}
	
	
	//om de maand ongeveer, als alle wedstrijden van het vorige seizoen zijn gespeeld
	function update_season()
	{
		
		$this->load->model('cron_model');
		$query = $this->cron_model->get_croninfo();
		
		foreach($query->result() as $row)
		{
			$seizoen = $row->seizoen;
		}
		
		//$this->cron_model->update_seizoen($seizoen);
		
		$this->cron_model->promotion_division3();

	}
	
	//elke minuut nakijken
	function check_transfers()
	{
		$this->load->model('cron_model');
		$this->cron_model->check_transfers();
	
	}
	
	//om de 2 dagen
	function play_games()
	{
		$this->load->model('cron_model');
		$wedstrijd = $this->cron_model->get_wedstrijden();
		$thuisstats = $this->cron_model->get_statsthuisteam($wedstrijd);
		$uitstats = $this->cron_model->get_statsuitteam($wedstrijd);
		$thuis = $this->cron_model->play_games($thuisstats, $uitstats, $wedstrijd);
		//print_r ($thuisstats);	
		
	}
	
	
	function create_korfbaltransfers()
	{
		$this->load->model('cron_model');
		
		for($i=0;$i<4;$i++){
			$this->cron_model->create_transferMan();
			$this->cron_model->create_transferVrouw();
		}
	
	}
	
	
}	
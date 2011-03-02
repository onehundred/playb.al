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
		
		$this->cron_model->update_seizoen($seizoen);

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
		//print_r ($thuis);
		
	}
	
	
}	
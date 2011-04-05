<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Korfbal_other_team extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
			
	}
	
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		
		if(!isset($is_logged_in) || $is_logged_in != true)
		{

		 redirect('main/index');
			
		}
	}
	function korfbal_overview()
	{
		$team_id = $this->uri->segment('3');
		
		//altijd meegeven -> voor nav view zodat de id in de url word meegegeven
		$data['team_id'] = $team_id;
		$this->load->model('korfbal_model');
		
		$team = $this->korfbal_model->get_team($team_id);
		foreach($team->result() as $row)
		{
		$data['teamnaam'] = $row->naam; 
		}
		
		
		$stadion = $this->korfbal_model->get_stadion($team_id); 
		foreach($stadion->result() as $row)
		{
		$data['stadionnaam'] = $row->naam;
		$data['stadionplaatsen'] = $row->aantal_plaatsen;
		
		}
		
		
		
		$data['main_content'] = 'korfbal/korfbal_index';
		$this->load->view('korfbal/includes_other_team/template', $data);
	}

	function korfbal_players()
	{
		$team_id = $this->uri->segment('3');
		$data['team_id'] = $team_id;
		$this->load->model('korfbal_model');
		
		$data['spelers'] = $this->korfbal_model->get_spelers($team_id);
		
		$team = $this->korfbal_model->get_team($team_id);
		foreach($team->result() as $row)
		{
		$data['teamnaam'] = $row->naam; 
		}
		
		
		$data['main_content'] = 'korfbal/korfbal_spelers';
		$this->load->view('korfbal/includes_other_team/template', $data);

		
	}
	
	

	function korfbal_matches()
	{
		$team_id = $this->uri->segment('3');
		$data['team_id'] = $team_id;	
		$this->load->model('korfbal_model');
		
		$data['matches'] = $this->korfbal_model->get_matches($team_id);
		
		$data['vorige_matchen'] = $this->korfbal_model->get_vorige_matchen($team_id);
		$data['volgende_matchen'] = $this->korfbal_model->get_volgende_matchen($team_id);
		
		$team = $this->korfbal_model->get_team($team_id);
		foreach($team->result() as $row)
		{
		$data['teamnaam'] = $row->naam; 
		}
		
		$data['alien'] = "alien";
		
		
		$data['main_content'] = 'korfbal/korfbal_matches';
		$this->load->view('korfbal/includes_other_team/template', $data);
	
	}
	
	function korfbal_division()
	{
				$team_id = $this->uri->segment('3');
		$data['team_id'] = $team_id;
		$this->load->model('korfbal_model');
		
		$data['divisie'] = $this->korfbal_model->get_divisie($team_id);
		
		$data['vorige_matchen'] = $this->korfbal_model->get_vorige_matchen($team_id);
		$data['volgende_matchen'] = $this->korfbal_model->get_volgende_matchen($team_id);	
		
		
		$team = $this->korfbal_model->get_team($team_id);
		foreach($team->result() as $row)
		{
		$data['teamnaam'] = $row->naam; 
		}
		
		
		$data['main_content'] = 'korfbal/korfbal_divisie';
		$this->load->view('korfbal/includes_other_team/template', $data);	
	}
	
	function korfbal_stadium()
	{
		$team_id = $this->uri->segment('3');
		$data['team_id'] = $team_id;
		$this->load->model('korfbal_model');
		
		$data['stadion'] = $this->korfbal_model->get_stadion($team_id);
		
		$team = $this->korfbal_model->get_team($team_id);
		foreach($team->result() as $row)
		{
		$data['teamnaam'] = $row->naam; 
		}
		
		
		$data['alien'] = "alien";
		
		$data['main_content'] = 'korfbal/korfbal_stadion';
		$this->load->view('korfbal/includes_other_team/template', $data);
	
	}
	function korfbal_manager()
	{
		$team_id = $this->uri->segment('3');
		$data['team_id'] = $team_id;
		$this->load->model('korfbal_model');
		
		$data['manager'] = $this->korfbal_model->get_manager();
		
		$team = $this->korfbal_model->get_team($team_id);
		foreach($team->result() as $row)
		{
		$data['teamnaam'] = $row->naam; 
		}
		
		$data['main_content'] = 'korfbal/korfbal_manager';
		$this->load->view('korfbal/includes_other_team/template', $data);
	
	}

	function korfbal_review()
	{
	
		$team_id = $this->uri->segment('3');
		$data['team_id'] = $team_id;
		
		$this->load->model('korfbal_model');
		$team = $this->korfbal_model->get_team($team_id);
		foreach($team->result() as $row)
		{
		$data['teamnaam'] = $row->naam; 
		}
		
		$data['main_content'] = 'korfbal/korfbal_verslag';
		$this->load->view('korfbal/includes_other_team/template', $data);
	
	}
	function korfbal_player()
	{
	
		$team_id = $this->uri->segment('3');
		$data['team_id'] = $team_id;
		$speler_id = $this->uri->segment('4');
		$data['speler_id'] = $speler_id;
		
		$this->load->model('korfbal_model');
		$data['speler'] = $this->korfbal_model->get_speler($speler_id);
		
		$team = $this->korfbal_model->get_team($team_id);
		foreach($team->result() as $row)
		{
		$data['teamnaam'] = $row->naam; 
		}
		
		$data['alien'] = 'alien';
		
		$data['main_content'] = 'korfbal/korfbal_speler';
		$this->load->view('korfbal/includes_other_team/template', $data);
	}
	


	

	
}
 
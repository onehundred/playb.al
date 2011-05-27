<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Korfbal extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
		$this->is_your_team();
		
		//#$this->output->cache(3600);
	}
	
	//kijken of men ingelogd is
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		
		if(!isset($is_logged_in) || $is_logged_in != true)
		{

		 redirect('main/index');
			
		}
	}
	function is_your_team(){
		$teamid = $this->uri->segment('3');
		
		$this->load->model('korfbal_model');
		$team_user_id = $this->korfbal_model->is_your_team();		
		if($teamid !== $team_user_id){
			redirect('korfbal_other_team/korfbal_overview/'.$teamid);
		}
	}
	//de mainfunctie van korfbal -> laadt de hoofdpage
	function korfbal_start()
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
		
		$data['calendar'] = $this->korfbal_model->get_sidebar_calendar($team_id);
		$data['divisie_eerste'] = $this->korfbal_model->get_sidebar_divisie();
		$data['divisie'] = $this->korfbal_model->get_divisie($team_id);
		
		$data['main_content'] = 'korfbal/korfbal_index';
		$this->load->view('korfbal/includes/template', $data);
	}
	
	
	
	//functie die de spelers laat zien
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
		$this->load->view('korfbal/includes/template', $data);

		
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
		$this->load->view('korfbal/includes/template', $data);
	
	}
	//functie die de details van een speler laat zien
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
		
		$data['main_content'] = 'korfbal/korfbal_speler';
		$this->load->view('korfbal/includes/template', $data);
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
		
		
		$data['main_content'] = 'korfbal/korfbal_stadion';
		$this->load->view('korfbal/includes/template', $data);
	
	}
	
	
	
	function korfbal_teamorders()
	{
		$team_id = $this->uri->segment('3');
		$data['team_id'] = $team_id;
		$this->load->model('korfbal_model');
		
		$data['spelers'] = $this->korfbal_model->get_spelers($team_id);
		//$data['opstelling'] = $this->korfbal_model->get_opstelling($team_id);
		
		$team = $this->korfbal_model->get_team($team_id);
		foreach($team->result() as $row)
		{
		$data['teamnaam'] = $row->naam; 
		}
		
		
		$data['main_content'] = 'korfbal/korfbal_opstelling';
		$this->load->view('korfbal/includes/template', $data);
		
		
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
		
		$data['calendar'] = $this->korfbal_model->get_sidebar_calendar($team_id);
		
		$data['main_content'] = 'korfbal/korfbal_divisie';
		$this->load->view('korfbal/includes/template', $data);
	
	}
	
	
	function korfbal_manager()
	{
		$team_id = $this->uri->segment('3');
		$data['team_id'] = $team_id;
		$this->load->model('korfbal_model');
		
		$data['manager'] = $this->korfbal_model->get_manager();
		$data['achievements'] = $this->korfbal_model->get_achievements($team_id);
		
		$team = $this->korfbal_model->get_team($team_id);
		foreach($team->result() as $row)
		{
		$data['teamnaam'] = $row->naam; 
		}
		
		$data['main_content'] = 'korfbal/korfbal_manager';
		$this->load->view('korfbal/includes/template', $data);
	
	}
	
	
	function korfbal_finances()
	{
		$team_id = $this->uri->segment('3');
		$data['team_id'] = $team_id;	
		$this->load->model('korfbal_model');
		
		$data['financien'] = $this->korfbal_model->get_finances($team_id);
		$data['financien_vorige'] = $this->korfbal_model->get_finances_vorige($team_id);
		
		
		$team = $this->korfbal_model->get_team($team_id);
		foreach($team->result() as $row)
		{
		$data['teamnaam'] = $row->naam; 
		}
		
		
		$data['main_content'] = 'korfbal/korfbal_financien';
		$this->load->view('korfbal/includes/template', $data);

		
	
	}
	
	function korfbal_matches()
	{
		$team_id = $this->uri->segment('3');
		$data['team_id'] = $team_id;	
		$this->load->model('korfbal_model');
		
		$data['matches'] = $this->korfbal_model->get_matches($team_id);
		
		
		$team = $this->korfbal_model->get_team($team_id);
		foreach($team->result() as $row)
		{
		$data['teamnaam'] = $row->naam; 
		}
		
		$data['calendar'] = $this->korfbal_model->get_sidebar_calendar($team_id);
		
		$data['main_content'] = 'korfbal/korfbal_matches';
		$this->load->view('korfbal/includes/template', $data);
	
	}
	
	
	function korfbal_transfers()
	{
		
		$team_id = $this->uri->segment('3');
		$data['team_id'] = $team_id;	
		$this->load->model('korfbal_model');
		
		$data['transfers'] = $this->korfbal_model->get_transfers();
		
		
		$team = $this->korfbal_model->get_team($team_id);
		foreach($team->result() as $row)
		{
		$data['teamnaam'] = $row->naam; 
		}
		
		$data['calendar'] = $this->korfbal_model->get_sidebar_calendar($team_id);
		
		$data['main_content'] = 'korfbal/korfbal_transfers';
		$this->load->view('korfbal/includes/template', $data);
	
	}
	
	
	function korfbal_training()
	{
		$team_id = $this->uri->segment('3');
		$data['team_id'] = $team_id;	
		$this->load->model('korfbal_model');
		
		$data['training'] = $this->korfbal_model->get_training($team_id);
		$data['energie'] =$this->korfbal_model->get_energie($team_id);
		

		$team = $this->korfbal_model->get_team($team_id);
		foreach($team->result() as $row)
		{
		$data['teamnaam'] = $row->naam; 
		}
		
		$data['main_content'] = 'korfbal/korfbal_training';
		$this->load->view('korfbal/includes/template', $data);
	}
			
}


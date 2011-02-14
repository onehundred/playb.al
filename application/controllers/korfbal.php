<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Korfbal extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
		

		
		
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
		
		
		$stadion = $this->korfbal_model->get_stadion($team_id);
		foreach($stadion->result() as $row)
		{
		$data['stadionnaam'] = $row->naam;
		$data['stadionplaatsen'] = $row->aantal_plaatsen;
		
		}
		
		
		
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
		
		
		$data['main_content'] = 'korfbal/korfbal_spelers';
		$this->load->view('korfbal/includes/template', $data);

		
	}
	
	
	function korfbal_stadium()
	{
		$team_id = $this->uri->segment('3');
		$data['team_id'] = $team_id;
		$this->load->model('korfbal_model');
		
		$data['stadion'] = $this->korfbal_model->get_stadion($team_id);
		
		
		$data['main_content'] = 'korfbal/korfbal_stadion';
		$this->load->view('korfbal/includes/template', $data);
	
	}
	
	function korfbal_teamorders()
	{
		$team_id = $this->uri->segment('3');
		$data['team_id'] = $team_id;
		$this->load->model('korfbal_model');
		
		$data['spelers'] = $this->korfbal_model->get_spelers($team_id);
		$data['opstelling'] = $this->korfbal_model->get_opstelling($team_id);
		
		
		$data['main_content'] = 'korfbal/korfbal_opstelling';
		$this->load->view('korfbal/includes/template', $data);
		
		
	}
	
	
	//nakijken welke positie word ingevuld en dan inserten of updaten indien team bestaat of niet
	function korfbal_reorder()
	{
		$spelersnaam = $_POST['spelername'];
		$positie = $_POST['positie'];
		$teamid = $_POST['teamid'];
		
		if($positie=="rebound1")
		{
			$field = "rebound1_speler";
		}
		
		if($positie=="playmaking1")
		{
			$field = "playmaking1_speler";
		}
		
		if($positie=="attack1")
		{
			$field = "attack1_speler";
		}
		
		if($positie=="attack2")
		{
			$field = "attack2_speler";
		}
		
		if($positie=="playmaking2")
		{
			$field = "playmaking2_speler";
		}
		
		if($positie=="rebound2")
		{
			$field = "rebound2_speler";
		}
		
		if($positie=="attack3")
		{
			$field = "attack3_speler";
		}
		
		if($positie=="attack4")
		{
			$field = "attack4_speler";
		}
		
		if($positie=="captain")
		{
			$field = "captain_speler";
		}
		
		if($positie=="setpieces")
		{
			$field = "setpieces_speler";
		}
		
		$this->load->model(korfbal_model);
		$this->korfbal_model->insert_opstelling($field,$spelersnaam,$teamid);
	}
	
	function korfbal_division()
	{
		$team_id = $this->uri->segment('3');
		$data['team_id'] = $team_id;
		$this->load->model('korfbal_model');
		
		$data['divisie'] = $this->korfbal_model->get_divisie($team_id);
		
		
		$data['main_content'] = 'korfbal/korfbal_divisie';
		$this->load->view('korfbal/includes/template', $data);
	
	}
	
	
	function korfbal_manager()
	{
		$team_id = $this->uri->segment('3');
		$data['team_id'] = $team_id;
		$this->load->model('korfbal_model');
		
		$data['manager'] = $this->korfbal_model->get_manager();
		
		$data['main_content'] = 'korfbal/korfbal_manager';
		$this->load->view('korfbal/includes/template', $data);
	
	}
	
	
	function korfbal_finances()
	{
		$team_id = $this->uri->segment('3');
		$data['team_id'] = $team_id;	
		$this->load->model('korfbal_model');
		
		$data['financien'] = $this->korfbal_model->get_finances($team_id);
		
		
		$data['main_content'] = 'korfbal/korfbal_financien';
		$this->load->view('korfbal/includes/template', $data);

		
	
	}
	
	function korfbal_matches()
	{
		$team_id = $this->uri->segment('3');
		$data['team_id'] = $team_id;	
		$this->load->model('korfbal_model');
		
		$data['matches'] = $this->korfbal_model->get_matches($team_id);
		
		
		$data['main_content'] = 'korfbal/korfbal_matches';
		$this->load->view('korfbal/includes/template', $data);
	
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
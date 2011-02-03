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
		 $data['main_content'] = 'session_fail';
		 $this->load->view('includes/template', $data);
			
		}
	}

	//de mainfunctie van korfbal -> laad de hoofdpage
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
		
	
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
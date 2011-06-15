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
		
		$team_ori = $this->korfbal_model->get_team_ori();
		foreach($team_ori->result() as $row2)
		{
			$data['teamnaam_ori'] = $row2->naam;
			$data['profilepic_ori'] = $row2->afbeelding;  
		}
		
		$data['profilepic'] = $this->korfbal_model->get_profile_pic($team_id);
		$data['calendar'] = $this->korfbal_model->get_sidebar_calendar($team_id);
		$data['divisie_eerste'] = $this->korfbal_model->get_sidebar_divisie();
		$data['divisie'] = $this->korfbal_model->get_divisie($team_id);
		$data['stats'] = $this->korfbal_model->get_sidebar_stats($team_id);
		
		$data['alien'] = "alien";
		
		$data['main_content'] = 'korfbal/korfbal_index';
		$this->load->view('korfbal/includes_other_team/template', $data);
	}

	function korfbal_team()
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
		
		$team_ori = $this->korfbal_model->get_team_ori();
		foreach($team_ori->result() as $row2)
		{
			$data['teamnaam_ori'] = $row2->naam;
			$data['profilepic_ori'] = $row2->afbeelding;  
		}
		
		$data['profilepic'] = $this->korfbal_model->get_profile_pic($team_id);
		$data['calendar'] = $this->korfbal_model->get_sidebar_calendar($team_id);
		
		$data['alien'] = "alien";
		
		$data['main_content'] = 'korfbal/korfbal_training';
		$this->load->view('korfbal/includes_other_team/template', $data);
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
		
		$team_ori = $this->korfbal_model->get_team_ori();
		foreach($team_ori->result() as $row2)
		{
			$data['teamnaam_ori'] = $row2->naam;
			$data['profilepic_ori'] = $row2->afbeelding;  
		}
		
		$data['profilepic'] = $this->korfbal_model->get_profile_pic($team_id);
		$data['calendar'] = $this->korfbal_model->get_sidebar_calendar($team_id);
	
		
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
		
		$team_ori = $this->korfbal_model->get_team_ori();
		foreach($team_ori->result() as $row2)
		{
			$data['teamnaam_ori'] = $row2->naam;
			$data['profilepic_ori'] = $row2->afbeelding;  
		}
		
		$data['profilepic'] = $this->korfbal_model->get_profile_pic($team_id);
		$data['calendar'] = $this->korfbal_model->get_sidebar_calendar($team_id);		
		
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
		
		$team_ori = $this->korfbal_model->get_team_ori();
		foreach($team_ori->result() as $row2)
		{
			$data['teamnaam_ori'] = $row2->naam;
			$data['profilepic_ori'] = $row2->afbeelding;  
		}
		
		
		$data['alien'] = "alien";
		
		$data['main_content'] = 'korfbal/korfbal_stadion';
		$this->load->view('korfbal/includes_other_team/template', $data);
	
	}
	function korfbal_manager()
	{$team_id = $this->uri->segment('3');
		$data['team_id'] = $team_id;
		$this->load->model('korfbal_model');
		
		$data['manager'] = $this->korfbal_model->get_manager($team_id);
		$data['achievements'] = $this->korfbal_model->get_achievements($team_id);
		
		$team = $this->korfbal_model->get_team($team_id);
		foreach($team->result() as $row)
		{
		$data['teamnaam'] = $row->naam; 
		}
		
		$team_ori = $this->korfbal_model->get_team_ori();
		foreach($team_ori->result() as $row2)
		{
			$data['teamnaam_ori'] = $row2->naam;
			$data['profilepic_ori'] = $row2->afbeelding;  
		}
		
		$data['profilepic'] = $this->korfbal_model->get_profile_pic($team_id);
		$data['calendar'] = $this->korfbal_model->get_sidebar_calendar($team_id);
		$data['alien'] = 'alien';		
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
		
		$team_ori = $this->korfbal_model->get_team_ori();
		foreach($team_ori->result() as $row2)
		{
			$data['teamnaam_ori'] = $row2->naam;
			$data['profilepic_ori'] = $row2->afbeelding;  
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
		
		$team_ori = $this->korfbal_model->get_team_ori();
		foreach($team_ori->result() as $row2)
		{
			$data['teamnaam_ori'] = $row2->naam;
			$data['profilepic_ori'] = $row2->afbeelding;  
		}
		
		$data['alien'] = 'alien';
		
		$data['main_content'] = 'korfbal/korfbal_speler';
		$this->load->view('korfbal/includes_other_team/template', $data);
	}
	


	

	
}
 
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sportkeuze extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
		
		
		
	}


	//functie om na te gaan of er al teams zijn aangemaakt voor een van de drie sporten 
	function sport()
	{

		$username = $this->session->userdata('username');
		$user_id = $this->session->userdata('user_id');
		
		$this->load->model('sportkeuze_model');
		
		
		//checken of er al een korfbalteam bestaat
		$korfquery = $this->sportkeuze_model->check_korfbal($user_id);
		if($korfquery)
		{
			$this->db->select('team_id, naam');
			$this->db->where('FK_user_id', $user_id);
			$korfNaamquery=$this->db->get('korf_teams');
			
			foreach ($korfNaamquery->result() as $row)
  				 {
      				 $korfNaam= $row->naam;
      				 $korfId = $row->team_id;
      				
  				 }
			$data['korfNaam'] = $korfNaam;
			$data['korfId'] = $korfId;  
		}
		
		//kijken of er al een volleybalteam bestaat
		$volquery = $this->sportkeuze_model->check_volleybal($user_id);
		if($volquery)
		{
		
		
			$this->db->select('team_id, naam');
			$this->db->where('FK_user_id', $user_id);
			$volNaamquery=$this->db->get('vol_teams');
			
			foreach ($volNaamquery->result() as $row)
  				 {
      				 $volNaam= $row->naam;
      				 $volId = $row->team_id;
      				
  				 }
  			$data['volNaam'] = $volNaam; 
  			$data['volId'] = $volId;
  			
		}
		
		//kijken of er al een basketbalteam bestaat
		$basquery = $this->sportkeuze_model->check_basketbal($user_id);
		if($basquery)
		{
			
			$this->db->select('team_id, naam');
			$this->db->where('FK_user_id', $user_id);
			$basNaamquery=$this->db->get('bas_teams');
			
			foreach ($basNaamquery->result() as $row)
  				 {
      				 $basNaam= $row->naam;
      				 $basId = $row->team_id;
      				
  				 }
  			$data['basNaam'] = $basNaam; 
  			$data['basId'] = $basId;
		}
		
		$data['main_content'] = 'main_sportkeuze';
		
		$this->load->view('includes/template', $data);
		
		
		
	}
	
	//kijken of je bent ingelogd of niet
	//functie in constructor plaatsen
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
		 $data['main_content'] = 'session_fail';
		 $this->load->view('includes/template', $data);
			
			 
		}
		
	
	}
	
	//registreren voor een korfbalteam
	function korfbal_signup()
	{
			
	
		
		$data['main_content'] = 'korfbal/korfbal_signup';
		$this->load->view('includes/template', $data);
	
	
	}
	
	//registreren voor een volleybalteam
	function volleybal_signup()
	{
		$data['main_content'] = 'volleybal/volleybal_signup';
		$this->load->view('includes/template', $data);
	
	
	}
	
	
	//registreren voor een basketbalteam
	function basketbal_signup()
	{
		$data['main_content'] = 'basketbal/basketbal_signup';
		$this->load->view('includes/template', $data);
	
	
	
	}
	
	function create_korfbalteam()
	{
		$this->load->library('form_validation');
		//field name, error message, validation rules
		
			$this->form_validation->set_rules('teamnaam', 'Team Name', 'trim|required');
			$this->form_validation->set_rules('stadionnaam', 'Arena Name', 'trim|required');
			
			
			if($this->form_validation->run() == FALSE)
			{
				$this->korfbal_signup();
			}
			else{
				$this->load->model('sportkeuze_model');
				if($query = $this->sportkeuze_model->create_korfbalteam())
				{
					$data['main_content'] = 'korfbalsignup_succesful';
					$this->load->view('includes/template', $data);
				}
				else{
					$this->korfbal_signup();
				}
			}
		

	
	}
	
	



}
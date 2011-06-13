<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sportchoice extends CI_Controller {

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
		
		$data['korfRank'] = $this->sportkeuze_model->get_rankschikking($user_id);
		
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
  			$this->load->model('korfbal_model');
  			$data['profilepic'] = $this->korfbal_model->get_profile_pic($korfId);	 
  			$data['korfNaam'] = $korfNaam;
			$data['korfId'] = $korfId;  
			$data['teamnaam'] = $korfNaam;  
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
		  redirect('main/index');

			
			 
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
	
	function check_teamnaam(){
		$teamnaam = $_POST['teamnaam'];
		
		$this->load->model('sportkeuze_model');
		$check = $this->sportkeuze_model->check_teamnaam($teamnaam);
		
		echo json_encode($check);
		
	
	}
	
	function korfbalsignup_success(){
		$data['main_content'] = 'korfbal/korfbal_signup_succesful';
		$this->load->view('includes/template', $data);
	
	}
	
	function create_korfbalteam()
	{
		$teamnaam = $_POST['teamnaam'];
		$stadionnaam = $_POST['stadionnaam'];
	
				$this->load->model('sportkeuze_model');
				if($query = $this->sportkeuze_model->create_korfbalteam($teamnaam))
				{
					for($i=0;$i<6;$i++)
    	    			{
    	    			//6 spelers per sexe worden aangemaakt
    	    		$this->sportkeuze_model->create_korfbalplayer_man();
    	    		$this->sportkeuze_model->create_korfbalplayer_vrouw();
    	    	
    	    			}
    	    		//Na het aanmaken van de speler worden skills aan ieder van hen toegekend
    	    		
    	    		   $playeridquery = $this->sportkeuze_model->get_korfbalplayer();
    				   foreach($playeridquery->result() as $row)
						{
						//skills worden toegewezen per spelers
						$playerid = $row->speler_id;
						$this->sportkeuze_model->assign_korfbalskills($playerid);
			
						}
						
					//toewijzing trainingspunten
					
					$this->sportkeuze_model->assign_trainingspunten();	
						
					//toewijzing financien
					
					$this->sportkeuze_model->create_korfbalfinancien();	
						//creatie stadion
    	    		$this->sportkeuze_model->create_korfbalstadion($stadionnaam);
    	    			//creatie teamstats
    	    		$this->sportkeuze_model->create_korfbalteamstats();
    	    		
    	    		$done = true;
    	    		echo json_encode($done);
					
				}
				
	}
	
	
	//vollaybalteamcreatie
	
	function create_volleybalteam()
	{
		$this->load->library('form_validation');
		//field name, error message, validation rules
		
			$this->form_validation->set_rules('teamnaam', 'Team Name', 'trim|required');
			$this->form_validation->set_rules('stadionnaam', 'Arena Name', 'trim|required');
			
			
			if($this->form_validation->run() == FALSE)
			{	
				$this->volleybal_signup();
			}
			else{
				$this->load->model('sportkeuze_model');
				if($query = $this->sportkeuze_model->create_volleybalteam())	
				{
					for($i=0;$i<12;$i++)
    	    			{
    	    		$this->sportkeuze_model->create_volleybalplayer();
    	    	
    	    			}
    	    		$this->sportkeuze_model->create_volleybalstadion();
    	    			
					$data['main_content'] = 'volleybal/volleybal_signup_succesful';
					$this->load->view('includes/template', $data);
				}
				else{
					
					$this->volleybal_signup();
				}
			}

	
	}
	
	
	function create_basketbalteam()
	{
	
		$this->load->library('form_validation');
		//field name, error message, validation rules
		
			$this->form_validation->set_rules('teamnaam', 'Team Name', 'trim|required');
			$this->form_validation->set_rules('stadionnaam', 'Arena Name', 'trim|required');
			
			
			if($this->form_validation->run() == FALSE)
			{	
				$this->basketbal_signup();
			}
			else{
				$this->load->model('sportkeuze_model');
				if($query = $this->sportkeuze_model->create_basketbalteam())	
				{
					for($i=0;$i<12;$i++)
    	    			{
    	    		$this->sportkeuze_model->create_basketbalplayer();
    	    	
    	    			}
    	    		$this->sportkeuze_model->create_basketbalstadion();
    	    			
					$data['main_content'] = 'basketbal/basketbal_signup_succesful';
					$this->load->view('includes/template', $data);
				}
				else{
					
					$this->basketbal_signup();
				}
			}

	
	
	
	
	}
	
	



}
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
		$data['opstelling'] = $this->korfbal_model->get_opstelling($team_id);
		
		$team = $this->korfbal_model->get_team($team_id);
		foreach($team->result() as $row)
		{
		$data['teamnaam'] = $row->naam; 
		}
		
		
		$data['main_content'] = 'korfbal/korfbal_opstelling';
		$this->load->view('korfbal/includes/template', $data);
		
		
	}
	
	
	//nakijken welke positie word ingevuld en dan inserten of updaten indien team bestaat of niet
	function korfbal_reorder()
	{
		$spelersnaam = $_POST['spelername'];
		$positie = $_POST['positie'];
		$teamid = $_POST['teamid'];
		$geslacht = $_POST['geslacht'];
		
		
		
		if($positie=="rebound1")
		{
			$field = "rebound1";
			$vak = 1;
		}
		
		if($positie=="playmaking1")
		{
			$field = "playmaking1";
			$vak = 1;
		}
		
		if($positie=="attack1")
		{
			$field = "attack1";
			$vak = 1;
		}
		
		if($positie=="attack2")
		{
			$field = "attack2";
			$vak = 1;
		}
		
		if($positie=="playmaking2")
		{
			$field = "playmaking2";
			$vak = 2;
		}
		
		if($positie=="rebound2")
		{
			$field = "rebound2";
			$vak = 2;
		}
		
		if($positie=="attack3")
		{
			$field = "attack3";
			$vak = 2;
		}
		
		if($positie=="attack4")
		{
			$field = "attack4";
			$vak = 2;
		}
		
		if($positie=="captain")
		{
			$field = "captain";
		}
		
		if($positie=="setpieces")
		{
			$field = "setpieces";
		}
		
		$this->load->model('korfbal_model');
		$vakcheck = $this->korfbal_model->insert_opstelling($field,$spelersnaam,$teamid,$geslacht,$vak);
		
		$arr = array('check' => $vakcheck);
		$json = json_encode($arr); // returnt: { "item 2":"value 2", "item 3":"value 3", "item 3":"value 3"  } 
		echo $json;
	}
	
	function korfbal_division()
	{
		$team_id = $this->uri->segment('3');
		$data['team_id'] = $team_id;
		$this->load->model('korfbal_model');
		
		$data['divisie'] = $this->korfbal_model->get_divisie($team_id);	
		
		
		$team = $this->korfbal_model->get_team($team_id);
		foreach($team->result() as $row)
		{
		$data['teamnaam'] = $row->naam; 
		}
		
		
		$data['main_content'] = 'korfbal/korfbal_divisie';
		$this->load->view('korfbal/includes/template', $data);
	
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
		$this->load->view('korfbal/includes/template', $data);
	
	}
	
	
	function korfbal_finances()
	{
		$team_id = $this->uri->segment('3');
		$data['team_id'] = $team_id;	
		$this->load->model('korfbal_model');
		
		$data['financien'] = $this->korfbal_model->get_finances($team_id);
		
		
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
	
	//voegt een transfer toe van een speler
	function korfbal_addTransfer()
	{
		 $bedrag = $_POST['bedrag'];
		 $speler_id = $_POST['spelerid'];
		 $team_id = $_POST['teamid'];
		 
		 
		 $this->load->model('korfbal_model');
		 $check = $this->korfbal_model->addTransfer($bedrag, $speler_id, $team_id);
		 
		 //array omzetten naar json, gaat naar de succes function van de ajaxcall
		 $arr = array('check' => $check);
		 $json = json_encode($arr); // returnt: { "item 2":"value 2", "item 3":"value 3", "item 3":"value 3"  } 
		 echo $json;	
 
	
	}
	
	
	//update de bieder op een speler
	function korfbal_updateTransfer()
	{
		$bedrag = $_POST['bedrag'];
		$spelerid = $_POST['spelerid'];
		$teamid = $_POST['teamid'];
		
		
		$this->load->model('korfbal_model');
		$check = $this->korfbal_model->check_bodwaarden($bedrag, $spelerid, $teamid);
		
		//array omzetten naar jason, gaat naar de succes function van de ajaxcall
		$arr = array('check' => $check);
		$json = json_encode($arr); // returnt: { "item 2":"value 2", "item 3":"value 3", "item 3":"value 3"  } 
		echo $json;	

	

		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
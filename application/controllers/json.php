<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Json extends CI_Controller {

	function __construct()
	{
		parent::__construct();
			
	}
	
	
	function korfbal_jsonStadion()
	{
		$teamid = $_POST['teamid'];
		
		$this->load->model('korfbal_model');
		$json = $this->korfbal_model->getJsonStadion($teamid);
		echo json_encode($json);
	
	}
	
	function korfbal_buySection()
	{
		$sectie = $_POST['id'];
		$teamid = $_POST['teamid'];
		
		$this->load->model('korfbal_model');
		$buy['section'] = $this->korfbal_model->buySection($sectie, $teamid);
		
		echo json_encode($buy);
	
	}
	
	function korfbal_buySeats()
	{
		$sectie = $_POST['id'];
		$teamid = $_POST['teamid'];
		$plaatsen = $_POST['aantalplaatsen'];
		
		$this->load->model('korfbal_model');
		$buy['seats'] = $this->korfbal_model->buySeats($sectie, $teamid, $plaatsen);
		
		echo json_encode($buy);

	
	}
	
	function korfbal_jsonSpelerNaam()
	{
		$spelerid = $_POST['spelerid'];
		
		$this->load->model('korfbal_model');
		$json = $this->korfbal_model->getSpelerNaam($spelerid);
		echo json_encode($json);
	
	}
	
	function korfbal_jsonTeamNaam()
	{
		$teamid = $_POST['teamid'];
		
		$this->load->model('korfbal_model');
		$json = $this->korfbal_model->getTeamNaam($teamid);
		echo json_encode($json);
	
	}

	function korfbal_jsonReview()
	{
		$wedstrijdid = $_POST['wedstrijdid'];
		
		$this->load->model('korfbal_model');
		$json = $this->korfbal_model->getJsonReview($wedstrijdid);
		echo json_encode($json);
	
	
	}
	
	function get_JsonOpstelling()
	{
		$team_id = $_POST['teamid'];
		$this->load->model('korfbal_model');
		$opstelling = $this->korfbal_model->get_opstelling($team_id);
		echo json_encode($opstelling);
	}
	
	function korfbal_jsonPlayers()
	{
		$teamid = $_POST['teamid'];
		
		$this->load->model('korfbal_model');
		$json = $this->korfbal_model->getJson($teamid);
		echo json_encode($json);
	}
	
	//nakijken welke positie word ingevuld en dan inserten of updaten indien team bestaat of niet
	function korfbal_reorder()
	{
		$positie = $_POST['positie'];
		$teamid = $_POST['teamid'];
		$geslacht = $_POST['geslacht'];
		$spelerid = $_POST['spelerid'];
		
		
		
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
			$vak = 0;
		}
		
		if($positie=="setpieces")
		{
			$field = "setpieces";
			$vak = 0;
		}
		
		$this->load->model('korfbal_model');
		$vakcheck = $this->korfbal_model->insert_opstelling($field,$teamid,$geslacht,$vak,$spelerid);
		
		$arr = array('check' => $vakcheck);
		$json = json_encode($arr); // returnt: { "item 2":"value 2", "item 3":"value 3", "item 3":"value 3"  } 
		echo $json;
	}
	
	function removePlayer_Opstelling()
	{
		$spelerid = $_POST['spelerid'];
		$teamid = $_POST['teamid'];
		$positie = $_POST['positie'];
		
		$this->load->model('korfbal_model');
		
		$query = $this->korfbal_model->removePlayer_Opstelling($spelerid, $teamid, $positie);
	
	}
	
	//voegt een transfer toe van een speler
	function korfbal_addTransfer()
	{
		 $bedrag = $_POST['bedrag'];
		 $speler_id = $_POST['spelerid'];
		 $team_id = $_POST['teamid'];
		 $positie = $_POST['positie'];
		 
		 $this->load->model('korfbal_model');
		 $check = $this->korfbal_model->addTransfer($bedrag, $speler_id, $team_id, $positie);
		 
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
	
	
	function korfbal_sponsors()
	{
		$teamid = $_POST['teamid'];
		
		$this->load->model('korfbal_model');
		$sponsors = $this->korfbal_model->get_sponsors($teamid);
		$json = json_encode($sponsors);
		echo $json;
	
	
	}
	
	function korfbal_get_sponsors()
	{
		$cat = $_POST['cat'];
		
		$this->load->model('korfbal_model');
		$sponsors = $this->korfbal_model->sponsors($cat);
		$json = json_encode($sponsors);
		echo $json;
	
	}
	
	function korfbal_contract_sponsor()
	{
		$sponsorid = $_POST['sponsorid'];
		$teamid = $_POST['teamid'];
		
		$this->load->model('korfbal_model');
		$sponsors = $this->korfbal_model->contract_sponsor($sponsorid, $teamid);
		$json = json_encode($sponsors);
		echo $json;
		
	
	}
	
	function korfbal_finances()
	{	
		$teamid = $_POST['teamid'];
		
		$this->load->model('korfbal_model');
		$finances = $this->korfbal_model->get_weekfinances($teamid);
		$json = json_encode($finances);
		echo $json;

	}
	
	function korfbal_transfers()
	{
		$positie = $_POST['positie'];
		
		$this->load->model('korfbal_model');
		$transfers = $this->korfbal_model->get_transfers($positie);
		$json = json_encode($transfers);
		echo $json;

	
	}
	
	function get_berichten()
	{
		$team_id = $_POST['teamid'];
		$status = $_POST['status'];
		
		$this->load->model('korfbal_model');
		$data = $this->korfbal_model->get_sidebar_berichten($team_id, $status);
		echo json_encode($data);
	
	}
	
	function update_berichten()
	{
		$berichtid = $_POST['berichtid'];
		$this->load->model('korfbal_model');
		$data = $this->korfbal_model->update_sidebar_berichten($berichtid);
		echo json_encode($data);
	}
	
	function verwijder_berichten()
	{
		$berichtid = $_POST['berichtid'];
		$this->load->model('korfbal_model');
		$data = $this->korfbal_model->verwijder_sidebar_berichten($berichtid);
		echo json_encode($data);
	}
	
	function get_aantal_wedstrijden()
	{
		$teamid = $_POST['teamid'];
		$this->load->model('korfbal_model');
		$data = $this->korfbal_model->get_aantal_wedstrijden($teamid);
		echo json_encode($data);
	
	}
	
	function get_energie()
	{
		$teamid = $_POST['teamid'];
		$this->load->model('korfbal_model');
		$result = $this->korfbal_model->get_energie($teamid);
		
		foreach($result->result() as $row){
			echo json_encode($row->energie);
		}
	}


}
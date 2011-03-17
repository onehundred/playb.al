<?php class Korfbal_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	function is_your_team()
	{
		$username = $this->session->userdata('username');
		
		$this->db->select('team_id');
		$this->db->from('korf_teams');
		$this->db->join('users', 'FK_user_id = user_id');
		$this->db->where('gebruikersnaam', $username);
		$query = $this->db->get();
		
		foreach($query->result() as $row)
		{
			$team_user_id = $row->team_id;
			
 		
		}
		return $team_user_id;

	
	}


	function get_team($team_id)
	{
		$this->db->where('team_id', $team_id);
		$this->db->select('naam');
		$query = $this->db->get('korf_teams');
		return $query;

	}
	

	function get_stadion($team_id)
	{
		$this->db->where('FK_team_id', $team_id);
		$this->db->select('*');
		$query = $this->db->get('korf_stadion');
		return $query;

	}



	function get_spelers($team_id)
	{
		$this->db->select('*');
		$this->db->from('korf_spelers');
		$this->db->join('korf_skills','FK_player_id = speler_id');
		$this->db->where('FK_team_id', $team_id);
		$query = $this->db->get();

		return $query;


	}


	function get_speler($speler_id)
	{
		$this->db->select('*');
		$this->db->from('korf_spelers');
		$this->db->join('korf_skills','FK_player_id = speler_id');
		$this->db->where('speler_id', $speler_id);
		$query = $this->db->get();

		return $query;

	}


	function get_opstelling($team_id)
	{
		$this->db->select('*');
		$this->db->where('FK_team_id', $team_id);
		$query = $this->db->get('korf_opstelling');
		
		if($query->num_rows() == 0){
			return false;
		
		}else{
		
		$spelers = array();
		
		foreach($query->result() as $row)
		{
			$spelers[0] = $row->rebound1_speler;
			$spelers[1] = $row->playmaking1_speler;
			$spelers[2] = $row->attack1_speler;
			$spelers[3] = $row->attack2_speler;
			$spelers[4] = $row->rebound2_speler;
			$spelers[5] = $row->playmaking2_speler;
			$spelers[6] = $row->attack3_speler;
			$spelers[7] = $row->attack4_speler;
			$spelers[8] = $row->captain_speler;
			$spelers[9] = $row->setpieces_speler;
		}
		
		$opstelling = array();
		
		if($query->num_rows > 0){
		for($i=0;$i<10;$i++){
		
			if($spelers[$i] == null || $spelers[$i] == "null"){
				$opstelling[$i]['voornaam']= 'null';
				$opstelling[$i]['achternaam']= 'null';

			}else{
			$this->db->where('speler_id', $spelers[$i]);
			$speler = $this->db->get('korf_spelers');
			
				foreach($speler->result() as $rij){
				
				
					$opstelling[$i]['voornaam']= $rij->voornaam;
					$opstelling[$i]['achternaam']= $rij->achternaam;
					$opstelling[$i]['id'] = $rij->speler_id;
				
			
				}
			}
			
		}
		}
		
		return $opstelling;
		}

	}
	
	
	function removePlayer_Opstelling($spelerid, $teamid, $positie)
	{
		$data = array(
			$positie.'_speler' => null,
			$positie.'_geslacht' => null
		
		);
		
		$this->db->where('FK_team_id', $teamid);
		$this->db->update('korf_opstelling', $data);
		
	}

	function get_manager()
	{

		$user_id = $this->session->userdata('user_id');

		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('korf_teams', 'FK_user_id = user_id');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		return $query;


	}


	function get_finances($team_id)
	{
		$this->db->where('FK_team_id', $team_id);
		$this->db->select('*');
		$query = $this->db->get('korf_financien');
		return $query;

	}


	function get_divisie($team_id)
	{
		$this->db->where('team_id', $team_id);
		$this->db->select('FK_division_id');
		$query = $this->db->get('korf_teams');


		foreach($query->result() as $row)
		{
			$division_id = $row->FK_division_id;

		}

		$this->db->select('*');
		$this->db->from('korf_divisies');
		$this->db->join('korf_teams', 'FK_division_id = divisie_id');
		$this->db->where('divisie_id', $division_id);
		$this->db->order_by('divisiepunten','desc');
		$this->db->order_by('doelpunten_tegen','asc');
		$query = $this->db->get();
		return $query;


	}


	function get_transfers()
	{

		$this->db->select('*');
		$this->db->from('korf_transfers');
		$this->db->join('korf_spelers', 'FK_speler_id = speler_id');
		$this->db->join('korf_teams','FK_hoogste_bieder = team_id');
		$this->db->order_by('deadline', 'asc');
		$query = $this->db->get();

		return $query;




	}
	
	function get_training($team_id)
	{
		$this->db->select('*');
		$this->db->from('korf_spelers');
		$this->db->join('korf_skills', 'FK_player_id = speler_id');
		$this->db->join('korf_training', 'FK_skill_id = skill_id');
		$this->db->where('FK_team_id', $team_id);
		$query = $this->db->get();
		return $query;
	
	}
	
	function get_energie($team_id)
	{
		$this->db->select('*');
		$this->db->where('team_id', $team_id);
		$query = $this->db->get('korf_teams');
		return $query;
		
	}


	function get_matches($team_id)
	{
		$this->load->model('cron_model');
		$cron = $this->cron_model->get_croninfo();
		
		foreach($cron->result() as $crow)
		{
			$seizoen = $crow->seizoen;
		}
		
		$query = $this->db->query('SELECT * FROM korf_wedstrijden WHERE (thuisteam = '.$team_id.' OR bezoekersteam = '.$team_id.') AND  seizoen = '.$seizoen.'');

		$wedstrijdarray = array();
		$i =1;

		//elke wedstrijdrij afgaan
		foreach($query->result() as $row)
		{
			$wedstrijdarray[$i]['wedstrijdid']= $row->wedstrijd_id;
			//thuisteam van elke rij ophalen
			$thuisteam = $row->thuisteam;
			$this->db->select('naam');
			$this->db->from('korf_teams');
			$this->db->where('team_id',$thuisteam);
			$thuisnaam = $this->db->get();

			foreach($thuisnaam->result() as $rij)
			{
				//thuisteam in array zetten
				$wedstrijdarray[$i]['thuis'] =  $rij->naam;



			}

			//uitteam van elke rij ophalen
			$uitteam = $row->bezoekersteam;
			$this->db->select('naam');
			$this->db->from('korf_teams');
			$this->db->where('team_id',$uitteam);
			$uitnaam = $this->db->get();

			foreach($uitnaam->result() as $rij)
			{
				//uitteam in array zetten
				$wedstrijdarray[$i]['uit'] = $rij->naam;




			}
			//uitslag van elke wedstrijd meegeven in de array
			$wedstrijdarray[$i]['uitslag'] = $row->uitslag;

			$i++;

		}
		return $wedstrijdarray;

	}


	function insert_opstelling($field,$teamid,$geslacht,$vak, $spelerid)
	{



		$this->db->select('FK_team_id');
		$this->db->where('FK_team_id', $teamid);
		$query = $this->db->get('korf_opstelling');

		//als er nog geen opstelling is dan inserten we er een
		if($query->num_rows == 0)
		{

			$insert = array(
				$field."_speler" => $spelerid,
				$field."_geslacht" => $geslacht,
				'FK_team_id' => $teamid
			);


			$this->db->insert('korf_opstelling', $insert);
			$vakcheck = "valid";
			return $vakcheck;

		}
		else{ //is er al wel een opstelling dan updaten we de huidige
			$mannen = 0;
			$vrouwen = 0;
			//kijken of er al 2 mannen of vrouwen in een vak staan
			if($vak == 1){
				$this->db->select('*');
				$this->db->where('FK_team_id', $teamid);
				$query = $this->db->get('korf_opstelling');


				foreach($query->result() as $row){
					$r1 = $row->rebound1_geslacht;
					$p1 = $row->playmaking1_geslacht;
					$a1 = $row->attack1_geslacht;
					$a2 = $row->attack2_geslacht;

				}

				if($r1 == "male"){
					$mannen = $mannen + 1;
				}
				if($p1 == "male"){
					$mannen = $mannen + 1;
				}
				if($a1 == "male"){
					$mannen = $mannen + 1;
				}
				if($a2 == "male"){
					$mannen = $mannen + 1;
				}
				if($r1 == "female"){
					$vrouwen = $vrouwen + 1;
				}
				if($p1 == "female"){
					$vrouwen =$vrouwen + 1;
				}
				if($a1 == "female"){
					$vrouwen =$vrouwen + 1;
				}
				if($a2 == "female"){
					$vrouwen =$vrouwen + 1;
				}

			}

			if($vak == 2){
				$this->db->select('*');
				$this->db->where('FK_team_id', $teamid);
				$query = $this->db->get('korf_opstelling');


				foreach($query->result() as $row){
					$r2 = $row->rebound2_geslacht;
					$p2 = $row->playmaking2_geslacht;
					$a3 = $row->attack3_geslacht;
					$a4 = $row->attack4_geslacht;

				}

				if($r2 == "male"){
					$mannen = $mannen + 1;
				}
				if($p2 == "male"){
					$mannen = $mannen + 1;
				}
				if($a3 == "male"){
					$mannen = $mannen + 1;
				}
				if($a4 == "male"){
					$mannen = $mannen + 1;
				}
				if($r2 == "female"){
					$vrouwen = $vrouwen + 1;
				}
				if($p2 == "female"){
					$vrouwen =$vrouwen + 1;
				}
				if($a3 == "female"){
					$vrouwen =$vrouwen + 1;
				}
				if($a4 == "female"){
					$vrouwen =$vrouwen + 1;
				}

			}


			if($geslacht =="female"){
				if($vrouwen < 2){
					$update = array(
						$field."_speler" => $spelerid,
						$field."_geslacht" => $geslacht
					);


					$this->db->where('FK_team_id', $teamid);
					$this->db->update('korf_opstelling', $update);

					$vakcheck = "valid";
					return $vakcheck;

				}else{
					$vakcheck ="invalid vrouwen";
					return $vakcheck;
				}
			}

			if($geslacht =="male"){
				if($mannen < 2){
					$update = array(
						$field."_speler" => $spelerid,
						$field."_geslacht" => $geslacht
					);


					$this->db->where('FK_team_id', $teamid);
					$this->db->update('korf_opstelling', $update);

					$vakcheck = "valid";
					return $vakcheck;

				}else{
					$vakcheck ="invalid mannen";
					return $vakcheck;
				}
			}




		}



	}


	function addTransfer($minimum, $spelerid, $team_id)
	{


		$this->db->where('FK_team_id', $team_id);
		$this->db->where('transfer', 0);
		$query = $this->db->get('korf_spelers');

		//kijken of er nog op zijn minst 8 spelers in een team zijn
		if($query->num_rows < 9){
			$check = "invalid";
			return $check;

		}else{ // genoeg spelers in een team, speler kan op de transfermarkt geplaatst worden

			$deadline = date('Y-m-d h:i:s', strtotime("+3 days"));

			$insert = array(
				'minimum_bod' => $minimum,
				'FK_speler_id' => $spelerid,
				'deadline' => $deadline,
				'FK_hoogste_bieder' => $team_id

			);


			$this->db->insert('korf_transfers', $insert);


			$update = array(
				'transfer' => 1
			);

			$this->db->where('speler_id', $spelerid);
			$this->db->update('korf_spelers',$update);

			$check = "valid";
			return $check;
		}


	}



	function check_bodwaarden($bedrag, $spelerid, $teamid)
	{

		$this->db->where('FK_speler_id', $spelerid);
		$query = $this->db->get('korf_transfers');

		foreach($query->result() as $row)
		{
			$huidig = $row->huidig_bod;
			$minimum = $row->minimum_bod;

		}

		//kijken of het ingevoerde bedrag groter is dan het huidige bod en het minimum bod
		if($bedrag > $minimum && $bedrag > $huidig){
			$this->db->where('FK_speler_id', $spelerid);

			$update = array(
				'huidig_bod' => $bedrag,
				'FK_hoogste_bieder' => $teamid

			);

			$this->db->update('korf_transfers', $update);
			$valid = "valid";
			return $valid;

		}else{
			$valid = "invalid";
			return $valid;

		}

	}
	
	function getJson($teamid)
	{
		$this->db->select('*');
		$this->db->from('korf_skills');
		$this->db->join('korf_training', 'FK_skill_id = skill_id');
		$this->db->join('korf_spelers', 'FK_player_id  = speler_id');
		$this->db->where('FK_team_id', $teamid);
		$query = $this->db->get();
		
		$spelers = array();
		$i=1;
		foreach($query->result() as $row)
		{
			$spelers[$i]['spelerid'] = $row->speler_id;
			$spelers[$i]['rebound'] = $row->rebound;
			$spelers[$i]['stamina'] = $row->stamina;
			$spelers[$i]['shotpower'] = $row->shotpower;
			$spelers[$i]['shotprecision'] = $row->shotprecision;
			$spelers[$i]['passing'] = $row->passing;
			$spelers[$i]['intercepting'] = $row->intercepting;
			$spelers[$i]['playmaking'] = $row->playmaking;
			$spelers[$i]['leadership'] = $row->leadership;
			
			$spelers[$i]['rebound_tr'] = $row->rebound_tr;
			$spelers[$i]['stamina_tr'] = $row->stamina_tr;
			$spelers[$i]['shotpower_tr'] = $row->shotpower_tr;
			$spelers[$i]['shotprecision_tr'] = $row->shotprecision_tr;
			$spelers[$i]['passing_tr'] = $row->passing_tr;
			$spelers[$i]['intercepting_tr'] = $row->intercepting_tr;
			$spelers[$i]['playmaking_tr'] = $row->playmaking_tr;
			$spelers[$i]['leadership_tr'] = $row->leadership_tr;
			
			$i++;
		
		}
		
		return $spelers ;
		
		
	
	}
	
	function getJsonStadion($teamid)
	{
		$this->db->select('*');
		$this->db->from('korf_stadion');
		$this->db->where('FK_team_id', $teamid);
		$query = $this->db->get();
		
		$stadion = array();
		
		foreach($query->result() as $row)
		{
			$stadion['a']['sectie'] = $row->sectie_a;
			$stadion['b']['sectie'] = $row->sectie_b;
			$stadion['c']['sectie'] = $row->sectie_c;
			$stadion['d']['sectie'] = $row->sectie_d;
			$stadion['e']['sectie'] = $row->sectie_e;
			$stadion['f']['sectie'] = $row->sectie_f;
			$stadion['g']['sectie'] = $row->sectie_g;
			$stadion['h']['sectie'] = $row->sectie_h;
			
			$stadion['a']['plaatsen'] = $row->plaatsen_a;
			$stadion['b']['plaatsen'] = $row->plaatsen_b;
			$stadion['c']['plaatsen'] = $row->plaatsen_c;
			$stadion['d']['plaatsen'] = $row->plaatsen_d;
			$stadion['e']['plaatsen'] = $row->plaatsen_e;
			$stadion['f']['plaatsen'] = $row->plaatsen_f;
			$stadion['g']['plaatsen'] = $row->plaatsen_g;
			$stadion['h']['plaatsen'] = $row->plaatsen_h;
			
		
		}
		
		return $stadion;
	
	}
	
	function getJsonReview($wedstrijdid)
	{
		$this->db->where('FK_wedstrijd_id',$wedstrijdid);
		$query = $this->db->get('korf_verslagen');
		
		
		$verslag = array();
		
		foreach($query->result() as $row)
		{
			$verslag['acties'] = $row->acties;
			$verslag['minuten'] =$row->minuten;
			$verslag['spelers'] = $row->spelers;
			$verslag['tussenstand'] =$row->tussenstand;		
		}

		return $verslag;
	
	}
	
	function buySection($sectie, $teamid)
	{
		$data = array(
			$sectie => 1
		);
		
		$this->db->where('FK_team_id', $teamid);
		$update = $this->db->update('korf_stadion', $data);
		if($update){
			return true;
		}else{
			return false;
		}
	
	
	}
	
	function buySeats($sectie, $teamid, $aantalplaatsen)
	{
		
		$this->db->select(''.$sectie.'');
		$this->db->where('FK_team_id', $teamid);
		$this->db->from('korf_stadion');
		$query = $this->db->get();
		
		foreach($query->result() as $row)
		{
			$plaatsen = $row->$sectie;
		
		}
		
		$totaalplaatsen = $plaatsen + $aantalplaatsen;
		
		$data = array(
			$sectie => $totaalplaatsen
		
		);
		
		$this->db->where('FK_team_id', $teamid);
		$update = $this->db->update('korf_stadion', $data);
		if($update){
			return true;
		}else{
		
			return false;
		}
	
	}




}
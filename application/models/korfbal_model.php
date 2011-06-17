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
	function get_profile_pic($team_id){
	
		$this->db->select('afbeelding');
		$this->db->from('users');
		$this->db->join('korf_teams', 'FK_user_id = user_id');
		$this->db->where('team_id', $team_id);
		$query = $this->db->get();
		
		$afbeelding = null;
		foreach($query->result() as $row){
			$afbeelding = $row->afbeelding;
		}
		
		return $afbeelding;
	}
	function get_sidebar_stats($teamid)
	{
		$stats = array();
	
		$this->db->where('FK_team_id', $teamid);
		$query = $this->db->get('korf_teamstats');
		foreach($query->result() as $row){
			$verkocht = $row->laatste_verkocht;
			$gekocht = $row->laatste_gekocht;
			$stats['verkocht'] = $this->getSpelerNaam($verkocht);
			$stats['gekocht'] = $this->getSpelerNaam($gekocht);
		}
		
		$this->db->select('*');
		$this->db->from('korf_team_achievements');
		$this->db->join('korf_achievements', 'FK_achievements_id = achievement_id');
		$this->db->where('FK_team_id', $teamid);
		$this->db->order_by('team_achievements_id', 'DESC');
		$this->db->limit('1');
		$query2 = $this->db->get();
		
		foreach($query2->result() as $row2){
			$stats['achievement']['naam'] = $row2->naam;
			$stats['achievement']['punten'] = $row2->punten;
			$stats['achievement']['afbeelding'] = $row2->afbeelding;
		}
		
		
		$this->db->select('naam');
		$this->db->from('korf_trophies');
		$this->db->where('FK_team_id', $teamid);
		$query3 = $this->db->get();
		
		foreach($query3->result() as $row3){
			$stats['award'] = $row3->naam;
		
		}
		
		return $stats;
	}
	
	function get_team($team_id)
	{
	
		$this->db->where('team_id', $team_id);
		$this->db->select('naam');
		$query = $this->db->get('korf_teams');
		return $query;

	}
	
	function get_team_ori(){
	
		$userid = $this->session->userdata('user_id');
		
		$this->db->select('naam, afbeelding');
		$this->db->from('users');
		$this->db->join('korf_teams', 'FK_user_id = user_id');
		$this->db->where('user_id', $userid);
		$query = $this->db->get();
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
		$this->db->join('korf_training', 'FK_skill_id = skill_id');
		$this->db->where('speler_id', $speler_id);
		$query = $this->db->get();

		return $query;

	}
	function get_spelerstats($speler_id)
	{
		$this->db->where('FK_speler_id', $speler_id);
		$query = $this->db->get('korf_spelerstats');
		
		$data = array();
		foreach($query->result() as $row){
			$data['goals_carriere'] = $row->goals_carriere;
			$data['goals_seizoen'] = $row->goals_seizoen;
			$data['goals_wedstrijd'] = $row->goals_wedstrijd;
			$data['laatste_prestatie'] = $row->prestatie_laatste;
			$data['beste_prestatie'] = $row->prestatie_beste;
			$data['laatste_positie'] = $row->laatste_positie;
			$data['aantal_matchen'] = $row->aantal_matchen;
		}
		return $data;
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
	
		if($positie == 'captain' || $positie == 'setpieces'){
		
			$data = array(
				$positie.'_speler' => null,
			);
			
			$this->db->where('FK_team_id', $teamid);
			$this->db->update('korf_opstelling', $data);
		
		}else{
			$this->db->select('captain_speler, setpieces_speler');
			$this->db->where('FK_team_id', $teamid);
			$spelers = $this->db->get('korf_opstelling');
			
			foreach($spelers->result() as $srow){
				$cap = $srow->captain_speler;
				$set = $srow->setpieces_speler;
			}
			
			if($cap == $spelerid){
				
				$data = array(
					'captain_speler' => null,
				);
				
				$this->db->where('FK_team_id', $teamid);
				$this->db->update('korf_opstelling', $data);
			
			}
			
			if($set == $spelerid){
				$data = array(
					'setpieces_speler' => null,
				);
				
				$this->db->where('FK_team_id', $teamid);
				$this->db->update('korf_opstelling', $data);
			}
			
			$data = array(
				$positie.'_speler' => null,
				$positie.'_geslacht' => null
			
			);
			
			$this->db->where('FK_team_id', $teamid);
			$this->db->update('korf_opstelling', $data);
		
		}
		
	}

	function get_manager($team_id)
	{

		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('korf_teams', 'FK_user_id = user_id');
		$this->db->join('korf_teamstats', 'FK_team_id = team_id');
		$this->db->where('team_id', $team_id);
		$query = $this->db->get();
		return $query;


	}
	
	function update_manager($upfile, $userid)
	{
		$update = array(
			'afbeelding' => $upfile
		);
		
		$this->db->where('user_id', $userid);
		$this->db->update('users', $update);
		
	}


	function get_finances($team_id)
	{
		$cron = $this->db->get('korf_cron');
		foreach($cron->result() as $row)
		{
			$week = $row->week;
			$seizoen = $row->seizoen;
		}
		$this->db->where('week', $week);
		$this->db->where('seizoen', $seizoen);
		$this->db->where('FK_team_id', $team_id);
		$this->db->select('*');
		$query = $this->db->get('korf_financien');
		return $query;

	}
	
	function get_finances_vorige($team_id)
	{
		$cron = $this->db->get('korf_cron');
		foreach($cron->result() as $row)
		{
			$week = $row->week;
			$seizoen = $row->seizoen;
		}
		$this->db->where('week', $week-1);
		$this->db->where('seizoen', $seizoen);
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
	
	function get_vorige_matchen($team_id)
	{
		$cron = $this->db->get('korf_cron');
		foreach($cron->result() as $row)
		{
			$week = $row->week;
			$seizoen = $row->seizoen;
		}
		if($week == 1){
		
		}
		else{
		
		$this->db->where('team_id',$team_id);
		$divisie = $this->db->get('korf_teams');
		foreach($divisie->result() as $row){
			$divisieid = $row->FK_division_id;
		
		}
		
		$this->db->where('FK_divisie_id',$divisieid);
		$this->db->where('week', $week-1);
		$this->db->where('seizoen', $seizoen);
		$wedstrijd = $this->db->get('korf_wedstrijden');
		
			$i=1;
		foreach($wedstrijd->result() as $row){
			$team[$i]['uitslag'] = $row->uitslag;
			$thuisteamid = $row->thuisteam;
			$uitteamid = $row->bezoekersteam;
			$thuisteam = $this->get_team($thuisteamid);
			$uitteam = $this->get_team($uitteamid);
			foreach($thuisteam->result() as $row){
				$team[$i]['thuis'] = $row->naam;
			}
			foreach($uitteam->result() as $row){
				$team[$i]['uit'] = $row->naam;
			}
			$i++;
		}
	
		return $team;
		}
	}
	
	function get_volgende_matchen($team_id)
	{
		$cron = $this->db->get('korf_cron');
		foreach($cron->result() as $row)
		{
			$week = $row->week;
			$seizoen = $row->seizoen;
		}
		
		
		$this->db->where('team_id',$team_id);
		$divisie = $this->db->get('korf_teams');
		foreach($divisie->result() as $row){
			$divisieid = $row->FK_division_id;
		
		}
		
		$this->db->where('FK_divisie_id',$divisieid);
		$this->db->where('week', $week);
		$this->db->where('seizoen', $seizoen);
		$wedstrijd = $this->db->get('korf_wedstrijden');
		
			$i=1;
		foreach($wedstrijd->result() as $row){
			$thuisteamid = $row->thuisteam;
			$uitteamid = $row->bezoekersteam;
			$thuisteam = $this->get_team($thuisteamid);
			$uitteam = $this->get_team($uitteamid);
			foreach($thuisteam->result() as $row){
				$team[$i]['thuis'] = $row->naam;
			}
			foreach($uitteam->result() as $row){
				$team[$i]['uit'] = $row->naam;
			}
			$i++;
		}
		return $team;
	}


	function get_transfers($positie)
	{

		$this->db->select('*');
		$this->db->from('korf_transfers');
		$this->db->join('korf_spelers', 'FK_speler_id = speler_id');
		$this->db->join('korf_teams','FK_hoogste_bieder = team_id');
		if($positie != 'all'){
			$this->db->where('positie', $positie);
		}
	
		$this->db->order_by('deadline', 'asc');
		$query = $this->db->get();
		
		$transfers = array();
		
		$i = 1;
		foreach($query->result() as $row){
			$transfers[$i]['spelernaam'] = $row->voornaam.' '.$row->achternaam;
			$transfers[$i]['leeftijd'] = $row->leeftijd;
			$transfers[$i]['geslacht'] = $row->geslacht;
			$transfers[$i]['hoogste_bieder'] = $row->naam;
			$transfers[$i]['positie'] = $row->positie;
			$transfers[$i]['minimum_bod'] = $row->minimum_bod;
			$transfers[$i]['huidig_bod'] = $row->huidig_bod;
			$transfers[$i]['deadline'] = $row->deadline;
			$transfers[$i]['spelerid'] = $row->speler_id;
			$transfers[$i]['teamid'] = $row->team_id;
		
			$i++;
		}

		return $transfers;
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
		
				//nagaan of speler al op het veld staat
				$this->db->select('*');
				$this->db->where('FK_team_id', $teamid);
				$spelers = $this->db->get('korf_opstelling');
				
				foreach($spelers->result() as $srow){
					$sp['r1'] = $srow->rebound1_speler;
					$sp['p1'] = $srow->playmaking1_speler;
					$sp['a1'] = $srow->attack1_speler;
					$sp['a2'] = $srow->attack2_speler;
					$sp['r2'] = $srow->rebound2_speler;
					$sp['p2'] = $srow->playmaking2_speler;
					$sp['a3'] = $srow->attack3_speler;
					$sp['a4'] = $srow->attack4_speler;

				
				}
				
				if($vak == 0){
					if(in_array($spelerid, $sp)){
					$update = array(
						$field."_speler" => $spelerid,
					);


					$this->db->where('FK_team_id', $teamid);
					$this->db->update('korf_opstelling', $update);

					$vakcheck = "valid";
					return $vakcheck;
					}else{
						$vakcheck = "invalid opgesteld";
						return $vakcheck;
					
					}
				}else{
				
				//print_r($sp);
				if(in_array($spelerid, $sp)){
					$vakcheck = "invalid dezelfde";
					return $vakcheck;
				
				}else{
				
				
			
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

		}

	}


	function addTransfer($minimum, $spelerid, $team_id, $positie)
	{


		$this->db->where('FK_team_id', $team_id);
		$this->db->where('transfer', 0);
		$query = $this->db->get('korf_spelers');

		//kijken of er nog op zijn minst 8 spelers in een team zijn
		if($query->num_rows < 9){
			$check = "invalid";
			return $check;

		}else{ // genoeg spelers in een team, speler kan op de transfermarkt geplaatst worden
			
			date_default_timezone_set('Europe/Brussels');
			$deadline = date('Y-m-d h:i:s', strtotime("+3 days"));

			$insert = array(
				'minimum_bod' => $minimum,
				'FK_speler_id' => $spelerid,
				'deadline' => $deadline,
				'FK_hoogste_bieder' => $team_id, 
				'positie' => $positie,

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
			$verslag['prest_thuisteam']=$row->prestaties_thuisteam;
			$verslag['opst_thuisteam']=$row->opstelling_thuisteam;
			$verslag['prest_uitteam']=$row->prestaties_uitteam;
			$verslag['opst_uitteam']=$row->opstelling_uitteam;	
			$verslag['thuisteamid']=$row->thuisteam_id;
			$verslag['uitteamid']= $row->uitteam_id;
		}

		return $verslag;
	
	}
	
	function getSpelerNaam($spelerid)
	{
		$this->db->where('speler_id', $spelerid);
		$query = $this->db->get('korf_spelers');
		$speler = array();
			$speler['id'] = $spelerid;
		foreach($query->result() as $row){
			$speler['voornaam'] = $row->voornaam;
			$speler['achternaam'] = $row->achternaam;		
		}
		
		return $speler;
		
	}
	
	function getTeamNaam($teamid)
	{
		$this->db->where('team_id', $teamid);
		$query = $this->db->get('korf_teams');
		foreach($query->result() as $row){
			$team['teamnaam'] = $row->naam;
				
		}
		
		return $team;
		
		
	
	}
	function buySection($sectie, $teamid)
	{
		$this->db->select('totaal, stadion, financien_id');
		$this->db->from('korf_financien');
		$this->db->where('FK_team_id', $teamid);
		$this->db->order_by('financien_id', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		
		foreach($query->result() as $row){
			$fid = $row->financien_id;
			$totaal = $row->totaal;
			$stadion = $row->stadion;
		}
		$verschil = $totaal - $stadion;
		if($verschil < 500000){
			return false;
		}else{
	
	
			$stadion = array(
				'stadion' => $stadion + 500000,
			);
			
			$this->db->where('financien_id', $fid);
			$update = $this->db->update('korf_financien', $stadion);
			
			
			$data = array(
				$sectie => 1
			);
			$this->db->where('FK_team_id', $teamid);
			$update = $this->db->update('korf_stadion', $data);

			return true;
		
		}
	
	}
	
	function buySeats($sectie, $teamid, $aantalplaatsen)
	{
	
		$betalen = $aantalplaatsen * 100;
		
		$this->db->select('totaal, stadion, financien_id');
		$this->db->from('korf_financien');
		$this->db->where('FK_team_id', $teamid);
		$this->db->order_by('financien_id', 'DESC');
		$this->db->limit(1);
		$finances = $this->db->get();
		
		foreach($finances->result() as $row){
			$fid = $row->financien_id;
			$totaal = $row->totaal;
			$stadion = $row->stadion;
		}
		
		$verschil = $totaal - $stadion;
		
		if($verschil < $aantalplaatsen){
			return false;
		}else{
		
			$this->db->select(''.$sectie.'');
			$this->db->where('FK_team_id', $teamid);
			$this->db->from('korf_stadion');
			$query = $this->db->get();
			
			foreach($query->result() as $row)
			{
				$plaatsen = $row->$sectie;
			
			}
			
			$totaalplaatsen = $plaatsen + $aantalplaatsen;
			
			if($totaalplaatsen > 5000){
				return false;
			}else{
			
				$stadion = array(
					'stadion' => $stadion + $betalen,
				);
			
				$this->db->where('financien_id', $fid);
				$update = $this->db->update('korf_financien', $stadion);
				
				$data = array(
					$sectie => $totaalplaatsen
				
				);
				
				$this->db->where('FK_team_id', $teamid);
				$update = $this->db->update('korf_stadion', $data);
			
				return true;
			}
		}	
	
	}
	
	function get_sponsors($teamid)
	{	
	$this->db->select('*');
	$this->db->from('korf_teams');
	$this->db->join('korf_team_sponsors','team_id = FK_team_id');
	$this->db->join('korf_sponsors', 'FK_sponsor_id = sponsor_id');
	$this->db->where('team_id', $teamid);
	$query = $this->db->get();
	if($query->num_rows() == 0){
		$niks = "niks";
		return $niks;
		
	}else{
		$sponsors = "";
		$i=1;
		foreach($query->result() as $row){
			$sponsors[$i]['naam'] = $row->naam;
			$sponsors[$i]['bedrag'] = $row->bedrag;
			$sponsors[$i]['weken'] =$row->aantal_weken;
			$i++;
		}
		return $sponsors;
	}
	
	}
	
	function sponsors($cat)
	{
		$this->db->where('categorie', $cat);
		$query = $this->db->get('korf_sponsors');
		$i = 1;
		foreach($query->result() as $row){
			$sponsor[$i]['id'] = $row->sponsor_id;
			$sponsor[$i]['aantal_weken'] = $row->aantal_weken;
			$sponsor[$i]['bedrag'] = $row->bedrag;
			$sponsor[$i]['naam'] =$row->naam;
			$i++;
		}
		return $sponsor;
	
	}
	
	function contract_sponsor($sponsorid, $teamid)
	{
	
		$this->db->where('sponsor_id', $sponsorid);
		$query = $this->db->get('korf_sponsors');
		
		foreach($query->result() as $row){
			$weken = $row->aantal_weken;
		}
		
	
		$data = array(
			'FK_team_id' => $teamid, 
			'FK_sponsor_id' => $sponsorid,
			'weken_lopend' => $weken,
		);
	
		$this->db->insert('korf_team_sponsors', $data);
	
	}
	
	function get_weekfinances($teamid)
	{
		$cron = $this->db->get('korf_cron');
		foreach($cron->result() as $row)
		{
			$seizoen = $row->seizoen;
		}
		
		$this->db->where('FK_team_id', $teamid);
		$this->db->where('seizoen', $seizoen);
		$this->db->order_by('week');
		$query = $this->db->get('korf_financien');
		$i = 1;
		foreach($query->result() as $row)
		{
			$finances[$i] = $row->totaal;
			$i++;
		}
		return $finances;
	}
	
	function get_achievements($teamid)
	{
	
		$this->db->select('*');
		$this->db->from('korf_team_achievements');
		$this->db->where('FK_team_id', $teamid);
		$this->db->join('korf_achievements','FK_achievements_id = achievement_id');
		$query = $this->db->get();
		
		return $query;
	
	}
	
	function get_sidebar_calendar($team_id){
	
		$data = array();
		$cron_query = $this->db->get('korf_cron');
		foreach($cron_query->result() as $cron){
			$data['week'] = $cron->week;
			$data['seizoen'] = $cron->seizoen;
		}
		
		//geen active record omdat de query te complex is
		$m_query = "SELECT thuisteam, bezoekersteam from korf_wedstrijden where week = '".$data['week']."' and seizoen = '".$data['seizoen']."' and (thuisteam = '".$team_id."' or bezoekersteam = '".$team_id."');";
		
		$match_query = $this->db->query($m_query);
	
		foreach($match_query->result() as $match){
			$thuisteam_id = $match->thuisteam;
			$bezoekers_id = $match->bezoekersteam;
			
			$data['thuisteam'] = $this->getTeamNaam($thuisteam_id);
			$data['uitteam'] = $this->getTeamNaam($bezoekers_id);
		}
		
		return $data;
	}
	
	function get_sidebar_divisie()
	{
		

		$this->db->select('naam, divisiepunten');
		$this->db->from('korf_divisies');
		$this->db->join('korf_teams', 'FK_division_id = divisie_id');
		$this->db->where('divisie_id', 1);
		$this->db->order_by('divisiepunten','desc');
		$this->db->order_by('doelpunten_tegen','asc');
		$query = $this->db->get();
		return $query;
	}
	
	function get_sidebar_berichten($team_id, $status){
		
		$this->db->where('ontvanger', $team_id);
		$this->db->where('status', $status);
		$query = $this->db->get('korf_berichten');
		
		$i = 0;
		foreach($query->result() as $row){
			$data[$i]['onderwerp'] = $row->onderwerp;
			$data[$i]['bericht'] = $row->bericht;
			$data[$i]['verzender'] = $row->verzender;
			$data[$i]['datum'] = $row->datum;
			$data[$i]['bericht_id'] = $row->bericht_id;
			$i++;
		
		}
		
		return $data;
	}	
	
	function update_sidebar_berichten($berichtid)
	{
		$data = array(
			'status' => 1,
		
		);
		
		$this->db->where('bericht_id', $berichtid);
		$this->db->update('korf_berichten', $data);
		
		return true;
	
	}
	
	function verwijder_sidebar_berichten($berichtid)
	{
		$this->db->where('bericht_id', $berichtid);
		$this->db->delete('korf_berichten');
		
		return true;
	
	}
	function get_aantal_wedstrijden($teamid)
	{
		
		$data = array();
		
		$this->db->where('FK_team_id', $teamid);
		$query = $this->db->get('korf_teamstats');
		
		foreach($query->result() as $row){
			$data['overzicht']['gewonnen'] = $row->gewonnen_matchen;
			$data['overzicht']['verloren'] = $row->verloren_matchen;
			$data['overzicht']['gelijke'] = $row->gelijke_matchen;
		
		}
		
		$this->db->where('team_id', $teamid);
		$query2 = $this->db->get('korf_teams');
		
		foreach($query2->result() as $row2){
			$data['seizoen']['gewonnen'] = $row2->gewonnen;
			$data['seizoen']['verloren'] = $row2->verloren;
			$data['seizoen']['gelijke'] = $row2->gelijk;
		}
		return $data;
		
	}
	
}
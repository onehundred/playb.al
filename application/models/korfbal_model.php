<?php class Korfbal_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
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
		$this->db->select('naam, aantal_plaatsen');
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
		return $query;

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
		$query = $this->db->get();
		return $query;


	}


	function get_transfers(){

		$this->db->select('*');
		$this->db->from('korf_transfers');
		$this->db->join('korf_spelers', 'FK_speler_id = speler_id');
		$this->db->join('korf_teams','FK_hoogste_bieder = team_id');
		$this->db->order_by('deadline', 'asc');
		$query = $this->db->get();

		return $query;




	}


	function get_matches($team_id)
	{

		$this->db->where('thuisteam', $team_id);
		$this->db->or_where('bezoekersteam', $team_id);
		$query = $this->db->get('korf_wedstrijden');

		$wedstrijdarray = array();
		$i =1;

		//elke wedstrijdrij afgaan
		foreach($query->result() as $row)
		{

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


	function insert_opstelling($field,$spelernaam,$teamid,$geslacht,$vak)
	{



		$this->db->select('FK_team_id');
		$this->db->where('FK_team_id', $teamid);
		$query = $this->db->get('korf_opstelling');

		//als er nog geen opstelling is dan inserten we er een
		if($query->num_rows == 0)
		{

			$insert = array(
				$field."_speler" => $spelernaam,
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
						$field."_speler" => $spelernaam,
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
						$field."_speler" => $spelernaam,
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




}
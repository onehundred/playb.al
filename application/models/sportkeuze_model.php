<?php class Sportkeuze_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
       
    }
    
    function get_teamid()
    {
    
    
    }
    //functie die kijkt of er al een korfbalteam bestaat
    function check_korfbal($id)
    {
    	
    	
    	$this->db->where('FK_user_id',$id );
    	
    	$query = $this->db->get('korf_teams');
    	
    	
    	if($query->num_rows==1)
    	{
    			return true;
    	}

    }
    
    //functie die kijkt of er al een volleybalteam bestaat
    function check_volleybal($id)
    {
    
    	$this->db->where('FK_user_id',$id );
    	
    	$query = $this->db->get('vol_teams');
    	
    	
    	if($query->num_rows==1)
    	{
    			return true;
    	}

    }
    
    //functie die kijkt of er al een basketbalteam bestaat
    function check_basketbal($id)
    {
    	$this->db->where('FK_user_id',$id );
    	
    	$query = $this->db->get('bas_teams');
    	
    	
    	if($query->num_rows==1)
    	{
    			return true;
    	}

    
    }
    
    
    
    //maakt het korfbalteam aan
    function create_korfbalteam()
    {
    
    	$user_id = $this->session->userdata('user_id');    	
    	$mdate =  date('Y-m-d h:i:s');
    	
    	$this->db->select('team_id');
    	$this->db->where('bot', '0');
    	$this->db->order_by('team_id','desc');
    	$query = $this->db->get('korf_teams');
    	
    	
    	 foreach($query->result() as $row)
    	 {
    	 	$teamid = $row->team_id;
    	 
    	 }   	
    	    	
    	    	
    	$new_team_update_data = array(
    		'naam' => $this->input->post('teamnaam'),
    		'FK_user_id' => $user_id,
    		'startdatum' => $mdate, 
    		'bot' => '1'
    	
    	);
    	
    	
    	$this->db->where('team_id', $teamid);
    	$update = $this->db->update('korf_teams', $new_team_update_data);
    	return $update;			
    }
    
    //maakt het korfbalstadion aan
    function create_korfbalstadion()
    {
    
    $user_id = $this->session->userdata('user_id');
    	
    	$this->db->where('FK_user_id', $user_id);
    	$this->db->select('team_id');
    	$teamidquery = $this->db->get('korf_teams');
    	
    	
    	foreach($teamidquery->result() as $row)
    	{
    		$team_id = $row->team_id;
    	
    	}
    	
    	$new_stadion_insert_data = array(
    		'naam' => $this->input->post('stadionnaam'),
    		'plaatsen_a' => rand(500,2000), 
    		'FK_team_id' => $team_id
    		
    	
    	);
    	
    	$this->db->where('FK_team_id', $team_id);
    	$insert = $this->db->insert('korf_stadion', $new_stadion_insert_data);
    	
    }
    
    
    function create_korfbalfinancien()
    {
    
    $user_id = $this->session->userdata('user_id');
    	
    	$this->db->where('FK_user_id', $user_id);
    	$this->db->select('team_id');
    	$teamidquery = $this->db->get('korf_teams');
    	
    	
    	foreach($teamidquery->result() as $row)
    	{
    		$team_id = $row->team_id;
    	
    	}
		
		
    	$new_financien_insert_data = array(
    		'totaal' => 500000,
    		'FK_team_id' => $team_id
    		
    	
    	);
    	
    	$this->db->where('FK_team_id', $team_id);
    	$insert = $this->db->insert('korf_financien', $new_financien_insert_data);
    
    
    }
    
    //functie om het team toe te wijzen aan een divisie
    // word automatisch gedaan in de cron/bot functie
    /*function assign_korfbaldivisie()
    {
    	$user_id = $this->session->userdata('user_id');
    	
    	$this->db->where('FK_user_id', $user_id);
    	$this->db->select('team_id');
    	$teamidquery = $this->db->get('korf_teams');
    	
    	
    	foreach($teamidquery->result() as $row)
    	{
    		$team_id = $row->team_id;
    	
    	}
    	
    	
    	
    	//gaat elke divisie af, waar het getal onder de 8 is daar voegt hij het team aan toe
    	
    	$divisies = $this->db->get('korf_divisies');
    	$divRows = $divisies->num_rows();
    	
    	for($i=1;$i<=$divRows;$i++){
    	
    			$this->db->where('FK_division_id', $i);
    			$this->db->where('bot', 0);
    			$teams = $this->db->get('korf_teams');
    			
    			$teamRows = $teams->num_rows();
               
            if($teamRows < 8){
            
            	$data = array(
            		'FK_division_id' => $i
            	
            	
            	);
            
               	$this->db->where('FK_user_id', $user_id);
               	$this->db->update('korf_teams', $data);
                break;

            }



          }
    	

    	
    
    }*/
    
    
    //functie om een speler(man) aan te maken
    function create_korfbalplayer_man(){
    	$user_id = $this->session->userdata('user_id');
    	
    	$this->db->where('FK_user_id', $user_id);
    	$this->db->select('team_id');
    	$teamidquery = $this->db->get('korf_teams');
    	
    	
    	foreach($teamidquery->result() as $row)
    	{
    		$team_id = $row->team_id;
    	
    	}
    	
    	
    	    	$voornamen = array(
    					
    					'Aamos', 'Aapo', 'Aarne', 'Aatos', 'Ahti', 'Aki', 'Aki-Petteri','Akseli', 'Aleksi', 'Anssi', 'Antero', 'Antti', 'Ari', 'Ari-Pekka', 'Armas' ,'Arsi', 'Arto', 'Arttu', 'Arvi', 'Arvid Atso', 'Atte August', 'Aulis','Christian', 'Eemeli', 'Eemil', 'Eerik', 'Eero', 'Eetu', 'Eino', 'Einojuhani', 'Elias', 'Emppu', 'Ensio', 'Erkki', 'Erno', 'Esa', 'Esa-Pekka','Esko'


    				);
    				
    	$achternamen = array(
    					'Smith',
        				'Jones',
       				    'Winkler',
                        'Cooper',
                        'Cline'
    	
    	
    	);
    	
    	
    	$leeftijden = array(
    					'16',
    					'17',
    					'18',
    					'19',
    					'20',
    					'21',
    					'22',
    					'23'
    					
    	
    	);		
    	
    	$rugnummer = rand(0, 44);	
    		
    		
    				
    	$voornaam = $voornamen[array_rand($voornamen)];
    	$achternaam = $achternamen[array_rand($achternamen)];
    	$leeftijd = $leeftijden[array_rand($leeftijden)];
    	
    	$new_player_insert_data = array(
    		'voornaam' => $voornaam,
    		'achternaam' => $achternaam,
    		'leeftijd' => $leeftijd,
    		'geslacht' => 'male',
    		'rugnummer' => $rugnummer,
    		'FK_team_id' => $team_id
    		
    	
    	);
		
		
		
		$this->db->where('FK_team_id', $team_id);
    	$insert = $this->db->insert('korf_spelers', $new_player_insert_data);
    	
    	
    	}
    	
    	
    	//query voor het halen van de spelersgegevens
    	function get_korfbalplayer()
    	{
    	$user_id = $this->session->userdata('user_id');
    	
    	$this->db->where('FK_user_id', $user_id);
    	$this->db->select('team_id');
    	$teamidquery = $this->db->get('korf_teams');
    	
    	foreach($teamidquery->result() as $row)
    	{
    		$team_id = $row->team_id;
    	
    	}

    	
    	
    	$playeridquery = $this->db->query("select speler_id from korf_spelers where FK_team_id ='$team_id';");
    	return $playeridquery;

    	
    	
    	}
    	
    	
    	function assign_trainingspunten()
    	{
    		$user_id = $this->session->userdata('user_id');
    	
    	$this->db->where('FK_user_id', $user_id);
    	$this->db->select('team_id');
    	$teamidquery = $this->db->get('korf_teams');
    	
    	foreach($teamidquery->result() as $row)
    	{
    		$team_id = $row->team_id;
    	
    	}

    	
    	
    	$playeridquery = $this->db->query("select speler_id from korf_spelers where FK_team_id ='$team_id';");
    	
    	
    	foreach($playeridquery->result() as $row)
    	{
    		$spelerid = $row->speler_id;
    		
    		$this->db->select('skill_id');
    		$this->db->from('korf_skills');
    		$this->db->where('FK_player_id', $spelerid);
    		$skillidquery = $this->db->get();
    		
    		
    		foreach($skillidquery->result() as $row)
    		{
    			$skillid = $row->skill_id;
    			
    			$insert = array(
    			'FK_skill_id' => $skillid
    			
    			);
    			
    			$this->db->insert('korf_training', $insert);
    		
    		}	
    	}
    	
    	}
    	
    	
    	//functie die elke speler skills toekent bij het maken van een team
    	function assign_korfbalskills($playerid)
		{
			//randomwoorde(1-20) teowijzen aan de skills van elke speler
		
		$new_skills_insert_data = array(
			'rebound' => rand(1,12),
			'passing' => rand(1,12),
			'stamina' => rand(1,20),
			'shotpower' => rand(1,12),
			'shotprecision' => rand(1,12),
			'playmaking' => rand(1,12),
			'intercepting' => rand(1,12),
			'leadership'  => rand(1, 20),
			'FK_player_id' => $playerid
		);
		
		$this->db->where('FK_player_id', $playerid);
		$insert = $this->db->insert('korf_skills', $new_skills_insert_data);
		
		}
		
		
		
    	
    	//functie om een speler(vrouw) aan te maken
    function create_korfbalplayer_vrouw(){
    	$user_id = $this->session->userdata('user_id');
    	
    	$this->db->where('FK_user_id', $user_id);
    	$this->db->select('team_id');
    	$teamidquery = $this->db->get('korf_teams');
    	
    	
    	foreach($teamidquery->result() as $row)
    	{
    		$team_id = $row->team_id;
    	
    	}
    	
    	$voornamen = array(
    					'josefien', 
    					'nele',
    					'anke',
    					'mieke',
    					'maria'
    				);
    				
    	$achternamen = array(
    					'vandevelde',
        				'pony',
       				    'deboi',
                        'deschelde',
                        'de moeder'
    	
    	
    	);
    	
    	
    	$leeftijden = array(
    					'16',
    					'17',
    					'18',
    					'19',
    					'20',
    					'21',
    					'22',
    					'23'
    					
    	
    	);			
    		
    	$rugnummer = rand(46, 99);	
    				
    	$voornaam = $voornamen[array_rand($voornamen)];
    	$achternaam = $achternamen[array_rand($achternamen)];
    	$leeftijd = $leeftijden[array_rand($leeftijden)];
    	
    	$new_player_insert_data = array(
    		'voornaam' => $voornaam,
    		'achternaam' => $achternaam,
    		'leeftijd' => $leeftijd,
    		'geslacht' => 'female',
    		'rugnummer' => $rugnummer,
    		'FK_team_id' => $team_id
    		
    	
    	);
		
		
		
		$this->db->where('FK_team_id', $team_id);
    	$insert = $this->db->insert('korf_spelers', $new_player_insert_data);
    	}
    	
    	
    	//maakt volleybalteam aan
    	function create_volleybalteam()
    	{
    
    	$user_id = $this->session->userdata('user_id');    	
    	    	
    	    	
    	    	
    	$new_team_insert_data = array(
    		'naam' => $this->input->post('teamnaam'),
    		'FK_user_id' => $user_id,
    		'startdatum' => 'now()'
    	
    	);
    	
    	
    	$this->db->where('FK_user_id', $user_id);
    	$insert = $this->db->insert('vol_teams', $new_team_insert_data);
    	return $insert;			
    	}

    	
    	
    	//maakt volleybalspeler aan
    	function create_volleybalplayer()
    	{
    		$user_id = $this->session->userdata('user_id');
    	
    	$this->db->where('FK_user_id', $user_id);
    	$this->db->select('team_id');
    	$teamidquery = $this->db->get('vol_teams');
    	
    	
    	foreach($teamidquery->result() as $row)
    	{
    		$team_id = $row->team_id;
    	
    	}
    	
    	$voornamen = array(
    					'josefien', 
    					'nele',
    					'anke',
    					'mieke',
    					'maria'
    				);
    				
    	$achternamen = array(
    					'vandevelde',
        				'pony',
       				    'deboi',
                        'deschelde',
                        'de moeder'
    	
    	
    	);
    	
    	
    	$leeftijden = array(
    					'16',
    					'17',
    					'18',
    					'19',
    					'20',
    					'21',
    					'22',
    					'23'
    					
    	
    	);			
    		
    		
    				
    	$voornaam = $voornamen[array_rand($voornamen)];
    	$achternaam = $achternamen[array_rand($achternamen)];
    	$leeftijd = $leeftijden[array_rand($leeftijden)];
    	
    	$new_player_insert_data = array(
    		'voornaam' => $voornaam,
    		'achternaam' => $achternaam,
    		'leeftijd' => $leeftijd,
    		'FK_team_id' => $team_id
    		
    	
    	);
		
		
		
		$this->db->where('FK_team_id', $team_id);
    	$insert = $this->db->insert('vol_spelers', $new_player_insert_data);
    	
    	}
    	
    	//maakt volleybalstadion aan
    	function create_volleybalstadion()
    {
    
    $user_id = $this->session->userdata('user_id');
    	
    	$this->db->where('FK_user_id', $user_id);
    	$this->db->select('team_id');
    	$teamidquery = $this->db->get('vol_teams');
    	
    	
    	foreach($teamidquery->result() as $row)
    	{
    		$team_id = $row->team_id;
    	
    	}
    	
    	$new_stadion_insert_data = array(
    		'naam' => $this->input->post('stadionnaam'),
    		'FK_team_id' => $team_id
    		
    	
    	);
    	
    	$this->db->where('FK_team_id', $team_id);
    	$insert = $this->db->insert('vol_stadion', $new_stadion_insert_data);
    	
    }
    
    
   		 //maakt basketbalteam aan
    	function create_basketbalteam()
    	{
    
    	$user_id = $this->session->userdata('user_id');    	
    	    	
    	    	
    	    	
    	$new_team_insert_data = array(
    		'naam' => $this->input->post('teamnaam'),
    		'FK_user_id' => $user_id,
    		'startdatum' => 'now()'
    	
    	);
    	
    	
    	$this->db->where('FK_user_id', $user_id);
    	$insert = $this->db->insert('bas_teams', $new_team_insert_data);
    	return $insert;			
    	}
    	
    	
    	
    	//maakt basketbalspeler aan
    	function create_basketbalplayer()
    	{
    		$user_id = $this->session->userdata('user_id');
    	
    	$this->db->where('FK_user_id', $user_id);
    	$this->db->select('team_id');
    	$teamidquery = $this->db->get('bas_teams');
    	
    	
    	foreach($teamidquery->result() as $row)
    	{
    		$team_id = $row->team_id;
    	
    	}
    	
    	$voornamen = array(
    					'josefien', 
    					'nele',
    					'anke',
    					'mieke',
    					'maria'
    				);
    				
    	$achternamen = array(
    					'vandevelde',
        				'pony',
       				    'deboi',
                        'deschelde',
                        'de moeder'
    	
    	
    	);
    	
    	
    	$leeftijden = array(
    					'16',
    					'17',
    					'18',
    					'19',
    					'20',
    					'21',
    					'22',
    					'23'
    					
    	
    	);			
    		
    		
    				
    	$voornaam = $voornamen[array_rand($voornamen)];
    	$achternaam = $achternamen[array_rand($achternamen)];
    	$leeftijd = $leeftijden[array_rand($leeftijden)];
    	
    	$new_player_insert_data = array(
    		'voornaam' => $voornaam,
    		'achternaam' => $achternaam,
    		'leeftijd' => $leeftijd,
    		'FK_team_id' => $team_id
    		
    	
    	);
		
		
		
		$this->db->where('FK_team_id', $team_id);
    	$insert = $this->db->insert('bas_spelers', $new_player_insert_data);
    	
    	}


	//maakt volleybalstadion aan
    	function create_basketbalstadion()
    {
    
    $user_id = $this->session->userdata('user_id');
    	
    	$this->db->where('FK_user_id', $user_id);
    	$this->db->select('team_id');
    	$teamidquery = $this->db->get('bas_teams');
    	
    	
    	foreach($teamidquery->result() as $row)
    	{
    		$team_id = $row->team_id;
    	
    	}
    	
    	$new_stadion_insert_data = array(
    		'naam' => $this->input->post('stadionnaam'),
    		'FK_team_id' => $team_id
    		
    	
    	);
    	
    	$this->db->where('FK_team_id', $team_id);
    	$insert = $this->db->insert('bas_stadion', $new_stadion_insert_data);
    	
    }



    
    }

<?php class Cron_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function get_croninfo(){
    	$query = $this->db->get('korf_cron');
    	return $query;
    }
    
    //om de 2 dagen
    function update_week($week)
    {
    	$update = array(
    		'week' => $week +1
    	
    	);
    	
    	$this->db->update('korf_cron', $update);
    	
    }
    
    //om de maand ongeveer
    
    function update_seizoen($seizoen)
    {
    	$update = array(
    		'seizoen' => $seizoen +1
    	
    	);
    	
    	$this->db->update('korf_cron', $update);

    }
    
    //elke minuut om na te kijken
    function check_transfers()
    {	
    	$query = $this->db->get('korf_transfers');
    	
    	foreach($query->result() as $row)
    	{
    		$deadline = $row->deadline;
    		$spelerid = $row->FK_speler_id;
    		$hoogste_bieder = $row->FK_hoogste_bieder;
    		$huidigbod = $row->huidig_bod;
    		$transferid = $row->transfer_id;
    		
    		
    		$mdate =  date('Y-m-d h:i:s');
    	
    		if($deadline <= $mdate)
    		{
    			if($huidigbod == null)
    			{
    				$update = array(
    				'transfer' => 0
    				
    				);
    				
    				$this->db->where('speler_id', $spelerid);
    				$this->db->update('korf_spelers', $update);
    			}else{
    				$update = array(
    					'transfer' => 0,
    					'FK_team_id'=> $hoogste_bieder    				
    				
    				
    				);
    				
    				$this->db->where('speler_id', $spelerid);
    				$this->db->update('korf_spelers', $update);
    			
    			}
    			
    			$this->db->where('transfer_id', $transferid);
    			$this->db->delete('korf_transfers');
    	
    		}
    	
    	}
    	
    	
    
    
    }
    
    //elk nieuw seizoen ŽŽn keer runnen
    //create scriptje aanmaken voor extra divisies bij te voegen
    function bots()
    {
    
    	//gaat elke divisie af, waar het getal onder de 8 is daar voegt hij een bot toe
    	$divisies = $this->db->get('korf_divisies');
    	$divRows = $divisies->num_rows();
    	$mdate =  date('Y-m-d h:i:s');
    	
    	for($i=1;$i<=$divRows;$i++){
    	
    			$this->db->where('FK_division_id', $i);
    			$teams = $this->db->get('korf_teams');
    			
    			$teamRows = $teams->num_rows();
               
            if($teamRows < 8){
            
            	$data = array(
            		'FK_division_id' => $i,
            		'naam' => 'playbal',
            		'bot' =>  0,
            		'gespeeld' => 0,
            		'gewonnen' => 0,
            		'verloren' => 0,
            		'gelijk' => 0,
            		'doelpunten_voor' => 0,
            		'doelpunten_tegen' => 0,
            		'divisiepunten' => 0,
            		'energie' => 100,
            		'moraal' => 100,
            		'startdatum' => $mdate
            	
            	
            	);
            	
            	
            	$teamaanvul = 8 - $teamRows;
            	
            		for($j=0;$j<$teamaanvul;$j++){
               
               	$this->db->insert('korf_teams', $data);
               		 }

            }



          }
    	

    
    
    }
    
    
    function energy_point()
    {
    	$this->db->select('energie,team_id');
    	$query = $this->db->get('korf_teams');
    	
    	foreach($query->result() as $row)
    	{
    		$teamid = $row->team_id;
    		$energie = $row->energie;
    		if($energie < 100){
    		$updateenergie = $energie + 1;
    		
    		$update = array(
    			'energie' => $updateenergie
    		);
    		
    		$this->db->where('team_id', $teamid);
    		$this->db->update('korf_teams', $update);
    		}
    			
    		
    	
    	}
    
    
    
    }
    
    //teams tegen elkaar uitzetten per divisie
    function arrange_matches()
    {
    	
    	
    	$naamarray = array();
    	
    	
    	$seizoenquery = $this->db->get('korf_cron');
    	
    	foreach($seizoenquery->result() as $rij){
    		$season = $rij->seizoen;
    	
    	}
    	
    	
    		
    	
    	$divisies = $this->db->get('korf_divisies');
    	$divRows = $divisies->num_rows() + 1;
    	
    	
    	
    	
		for($i=1;$i<$divRows;$i++){
		
		$this->db->where('FK_division_id', $i);
    	$query = $this->db->get('korf_teams');
    	
    	
    	$j=1;
    	
    	foreach($query->result() as $row)
    	{
    		$naamarray[$j] = $row->team_id; 
    		$j++;
    		
    	}
    	
    	//week1
    	$match1 = array(
    		'thuisteam' => $naamarray[1],
    		'bezoekersteam' => $naamarray[2],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 1
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match1);
    	
    	$match2 = array(
    		'thuisteam' => $naamarray[3],
    		'bezoekersteam' => $naamarray[4],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 1
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match2);
    	
    	$match3 = array(
    		'thuisteam' => $naamarray[5],
    		'bezoekersteam' => $naamarray[6],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 1
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match3);
    	
    	$match4 = array(
    		'thuisteam' => $naamarray[7],
    		'bezoekersteam' => $naamarray[8],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 1
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match4);
    	
    	
    	//week2
    	
    	$match5 = array(
    		'thuisteam' => $naamarray[4],
    		'bezoekersteam' => $naamarray[1],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 2
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match5);
    	
    	$match6 = array(
    		'thuisteam' => $naamarray[2],
    		'bezoekersteam' => $naamarray[3],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 2
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match6);
    	
    	$match7 = array(
    		'thuisteam' => $naamarray[8],
    		'bezoekersteam' => $naamarray[5],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 2
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match7);
    	
    	$match8 = array(
    		'thuisteam' => $naamarray[6],
    		'bezoekersteam' => $naamarray[7],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 2
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match8);
    	
    	
    	//week3
    	
    	$match9 = array(
    		'thuisteam' => $naamarray[1],
    		'bezoekersteam' => $naamarray[6],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 3
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match9);
    	
    	
    	$match10 = array(
    		'thuisteam' => $naamarray[5],
    		'bezoekersteam' => $naamarray[2],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 3
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match10);
    	
    	$match11 = array(
    		'thuisteam' => $naamarray[3],
    		'bezoekersteam' => $naamarray[8],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 3
    		
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match11);
    	
    	$match12 = array(
    		'thuisteam' => $naamarray[4],
    		'bezoekersteam' => $naamarray[7],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 3
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match12);
    	
    	//week4
    	
    	$match13 = array(
    		'thuisteam' => $naamarray[8],
    		'bezoekersteam' => $naamarray[1],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 4
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match13);
    	
    	
    	$match14 = array(
    		'thuisteam' => $naamarray[2],
    		'bezoekersteam' => $naamarray[7],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 4
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match14);
    	
    	$match15 = array(
    		'thuisteam' => $naamarray[6],
    		'bezoekersteam' => $naamarray[3],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 4
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match15);
    	
    	$match16 = array(
    		'thuisteam' => $naamarray[5],
    		'bezoekersteam' => $naamarray[4],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 4
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match16);
    	
    	//week5
    	
    	$match17 = array(
    		'thuisteam' => $naamarray[1],
    		'bezoekersteam' => $naamarray[3],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 5
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match17);
    	
    	
    	$match18 = array(
    		'thuisteam' => $naamarray[5],
    		'bezoekersteam' => $naamarray[7],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 5
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match18);
    	
    	$match19 = array(
    		'thuisteam' => $naamarray[2],
    		'bezoekersteam' => $naamarray[4],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 5
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match19);
    	
    	$match20 = array(
    		'thuisteam' => $naamarray[6],
    		'bezoekersteam' => $naamarray[8],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 5
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match20);
    	
    	
    	//week6
    	
    	$match21 = array(
    		'thuisteam' => $naamarray[5],
    		'bezoekersteam' => $naamarray[1],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 6
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match21);
    	
    	
    	$match22 = array(
    		'thuisteam' => $naamarray[7],
    		'bezoekersteam' => $naamarray[3],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 6
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match22);
    	
    	$match23 = array(
    		'thuisteam' => $naamarray[6],
    		'bezoekersteam' => $naamarray[2],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 6
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match23);
    	
    	$match24 = array(
    		'thuisteam' => $naamarray[8],
    		'bezoekersteam' => $naamarray[4],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 6
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match24);
    	
    	
    	//week7
    	
    	$match25 = array(
    		'thuisteam' => $naamarray[1],
    		'bezoekersteam' => $naamarray[7],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 7
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match25);
    	
    	
    	$match26 = array(
    		'thuisteam' => $naamarray[3],
    		'bezoekersteam' => $naamarray[5],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 7
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match26);
    	
    	$match27 = array(
    		'thuisteam' => $naamarray[2],
    		'bezoekersteam' => $naamarray[8],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 7
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match27);
    	
    	$match28 = array(
    		'thuisteam' => $naamarray[4],
    		'bezoekersteam' => $naamarray[6],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 7
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match28);
    	
    	
    	//alles omdraaien voor de tweede helft van het seizoen
    	
    	
    	//week8
    	$match29 = array(
    		'thuisteam' => $naamarray[2],
    		'bezoekersteam' => $naamarray[1],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 8
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match29);
    	
    	$match30 = array(
    		'thuisteam' => $naamarray[4],
    		'bezoekersteam' => $naamarray[3],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 8
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match30);
    	
    	$match31 = array(
    		'thuisteam' => $naamarray[6],
    		'bezoekersteam' => $naamarray[5],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 8
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match31);
    	
    	$match32 = array(
    		'thuisteam' => $naamarray[8],
    		'bezoekersteam' => $naamarray[7],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 8
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match32);
    	
    	
    	//week9
    	
    	$match33 = array(
    		'thuisteam' => $naamarray[1],
    		'bezoekersteam' => $naamarray[4],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 9
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match33);
    	
    	$match34 = array(
    		'thuisteam' => $naamarray[3],
    		'bezoekersteam' => $naamarray[2],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 9
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match34);
    	
    	$match35 = array(
    		'thuisteam' => $naamarray[5],
    		'bezoekersteam' => $naamarray[8],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 9
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match35);
    	
    	$match36 = array(
    		'thuisteam' => $naamarray[7],
    		'bezoekersteam' => $naamarray[6],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 9
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match36);
    	
    	
    	//week10
    	
    	$match37 = array(
    		'thuisteam' => $naamarray[6],
    		'bezoekersteam' => $naamarray[1],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 10
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match37);
    	
    	
    	$match38 = array(
    		'thuisteam' => $naamarray[2],
    		'bezoekersteam' => $naamarray[5],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 10
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match38);
    	
    	$match39 = array(
    		'thuisteam' => $naamarray[8],
    		'bezoekersteam' => $naamarray[3],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 10
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match39);
    	
    	$match40 = array(
    		'thuisteam' => $naamarray[7],
    		'bezoekersteam' => $naamarray[4],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 10
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match40);
    	
    	//week11
    	
    	$match41 = array(
    		'thuisteam' => $naamarray[1],
    		'bezoekersteam' => $naamarray[8],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 11
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match41);
    	
    	
    	$match42 = array(
    		'thuisteam' => $naamarray[7],
    		'bezoekersteam' => $naamarray[2],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 11
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match42);
    	
    	$match43 = array(
    		'thuisteam' => $naamarray[3],
    		'bezoekersteam' => $naamarray[6],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 11
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match43);
    	
    	$match44 = array(
    		'thuisteam' => $naamarray[4],
    		'bezoekersteam' => $naamarray[5],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 11
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match44);
    	
    	//week12
    	
    	$match45 = array(
    		'thuisteam' => $naamarray[3],
    		'bezoekersteam' => $naamarray[1],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 12
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match45);
    	
    	
    	$match46 = array(
    		'thuisteam' => $naamarray[7],
    		'bezoekersteam' => $naamarray[5],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 12
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match46);
    	
    	$match47 = array(
    		'thuisteam' => $naamarray[4],
    		'bezoekersteam' => $naamarray[2],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 12
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match47);
    	
    	$match48 = array(
    		'thuisteam' => $naamarray[8],
    		'bezoekersteam' => $naamarray[6],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 12
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match48);
    	
    	
    	//week13
    	
    	$match49 = array(
    		'thuisteam' => $naamarray[1],
    		'bezoekersteam' => $naamarray[5],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 13
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match49);
    	
    	
    	$match50 = array(
    		'thuisteam' => $naamarray[3],
    		'bezoekersteam' => $naamarray[7],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 13
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match50);
    	
    	$match51 = array(
    		'thuisteam' => $naamarray[2],
    		'bezoekersteam' => $naamarray[6],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 13
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match51);
    	
    	$match52 = array(
    		'thuisteam' => $naamarray[4],
    		'bezoekersteam' => $naamarray[8],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 13
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match52);
    	
    	
    	//week14
    	
    	$match53 = array(
    		'thuisteam' => $naamarray[7],
    		'bezoekersteam' => $naamarray[1],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 14
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match53);
    	
    	
    	$match54 = array(
    		'thuisteam' => $naamarray[5],
    		'bezoekersteam' => $naamarray[3],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 14
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match54);
    	
    	$match55 = array(
    		'thuisteam' => $naamarray[8],
    		'bezoekersteam' => $naamarray[2],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 14
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match55);
    	
    	$match56 = array(
    		'thuisteam' => $naamarray[6],
    		'bezoekersteam' => $naamarray[4],
    		'FK_divisie_id' => $i,
    		'seizoen' => $season,
    		'week' => 14
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match56);

    	
    	
    
    	//print_r($naamarray);
    	
    	}	
    }
    
 }  
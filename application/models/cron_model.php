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
    
    
    function create_divisions()
    {
    		//divisie 1
		
		$divisie1 = array(
			'divisie' => 1,
			'sub_divisie' => 1
		);
		
		$this->db->insert('korf_divisies', $divisie1);
		
		
		//divisie 2 
		
		for($i=1;$i<3;$i++)
		{
			$divisie2 = array(
			'divisie' => 2,
			'sub_divisie' => $i
		);
		
		$this->db->insert('korf_divisies',$divisie2);
		
		}
		
		
		//divisie3
		
		for($i=1;$i<5;$i++)
		{
			$divisie3 = array(
			'divisie' => 3,
			'sub_divisie' => $i
		);
		
		$this->db->insert('korf_divisies',$divisie3);
		
		}
		
		//divisie4
		for($i=1;$i<9;$i++)
		{
			$divisie4 = array(
			'divisie' => 4,
			'sub_divisie' => $i
		);
		
		$this->db->insert('korf_divisies',$divisie4);
		
		}
		
		
		//divisie5
		
		for($i=1;$i<17;$i++)
		{
			$divisie5 = array(
			'divisie' => 5,
			'sub_divisie' => $i
		);
		
		$this->db->insert('korf_divisies',$divisie5);
		
		}
		
		//divisie6
		
		for($i=1;$i<33;$i++)
		{
			$divisie6 = array(
			'divisie' => 6,
			'sub_divisie' => $i
		);
		
		$this->db->insert('korf_divisies',$divisie6);
		
		}
		
		
		//divisie7
		
		for($i=1;$i<65;$i++)
		{
			$divisie7 = array(
			'divisie' => 7,
			'sub_divisie' => $i
		);
		
		$this->db->insert('korf_divisies',$divisie7);
		
		}
		
		//divisie8
		
		for($i=1;$i<129;$i++)
		{
			$divisie8 = array(
			'divisie' => 8,
			'sub_divisie' => $i
		);
		
		$this->db->insert('korf_divisies',$divisie8);
		
		}
		
		//divisie9
		
		for($i=1;$i<257;$i++)
		{
			$divisie9 = array(
			'divisie' => 9,
			'sub_divisie' => $i
		);
		
		$this->db->insert('korf_divisies',$divisie9);
		
		}

    
    }
    
    //elk nieuw seizoen ŽŽn keer runnen
    //create scriptje aanmaken voor extra divisies bij te voegen
    function bots()
    {
    
    	//gaat elke divisie af, waar het getal onder de 8 is daar voegt hij een bot toe
    	$divisies = $this->db->get('korf_divisies');
    	//$divRows = $divisies->num_rows();
    	$mdate =  date('Y-m-d h:i:s');
    	
    	foreach($divisies->result() as $row){
    			$divisieid = $row->divisie_id;
    	
    			$this->db->where('FK_division_id', $divisieid );
    			$teams = $this->db->get('korf_teams');
    			
    			$teamRows = $teams->num_rows();
               
            if($teamRows < 8){
            
            	$data = array(
            		'FK_division_id' => $divisieid,
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
    	$mdate =  date('Y-m-d h:i:s');
    	
    	foreach($divisies->result() as $row){
    		$divisieid = $row->divisie_id;
    	
		
		$this->db->where('FK_division_id', $divisieid);
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
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 1
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match1);
    	
    	$match2 = array(
    		'thuisteam' => $naamarray[3],
    		'bezoekersteam' => $naamarray[4],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 1
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match2);
    	
    	$match3 = array(
    		'thuisteam' => $naamarray[5],
    		'bezoekersteam' => $naamarray[6],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 1
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match3);
    	
    	$match4 = array(
    		'thuisteam' => $naamarray[7],
    		'bezoekersteam' => $naamarray[8],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 1
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match4);
    	
    	
    	//week2
    	
    	$match5 = array(
    		'thuisteam' => $naamarray[4],
    		'bezoekersteam' => $naamarray[1],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 2
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match5);
    	
    	$match6 = array(
    		'thuisteam' => $naamarray[2],
    		'bezoekersteam' => $naamarray[3],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 2
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match6);
    	
    	$match7 = array(
    		'thuisteam' => $naamarray[8],
    		'bezoekersteam' => $naamarray[5],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 2
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match7);
    	
    	$match8 = array(
    		'thuisteam' => $naamarray[6],
    		'bezoekersteam' => $naamarray[7],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 2
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match8);
    	
    	
    	//week3
    	
    	$match9 = array(
    		'thuisteam' => $naamarray[1],
    		'bezoekersteam' => $naamarray[6],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 3
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match9);
    	
    	
    	$match10 = array(
    		'thuisteam' => $naamarray[5],
    		'bezoekersteam' => $naamarray[2],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 3
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match10);
    	
    	$match11 = array(
    		'thuisteam' => $naamarray[3],
    		'bezoekersteam' => $naamarray[8],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 3
    		
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match11);
    	
    	$match12 = array(
    		'thuisteam' => $naamarray[4],
    		'bezoekersteam' => $naamarray[7],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 3
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match12);
    	
    	//week4
    	
    	$match13 = array(
    		'thuisteam' => $naamarray[8],
    		'bezoekersteam' => $naamarray[1],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 4
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match13);
    	
    	
    	$match14 = array(
    		'thuisteam' => $naamarray[2],
    		'bezoekersteam' => $naamarray[7],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 4
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match14);
    	
    	$match15 = array(
    		'thuisteam' => $naamarray[6],
    		'bezoekersteam' => $naamarray[3],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 4
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match15);
    	
    	$match16 = array(
    		'thuisteam' => $naamarray[5],
    		'bezoekersteam' => $naamarray[4],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 4
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match16);
    	
    	//week5
    	
    	$match17 = array(
    		'thuisteam' => $naamarray[1],
    		'bezoekersteam' => $naamarray[3],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 5
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match17);
    	
    	
    	$match18 = array(
    		'thuisteam' => $naamarray[5],
    		'bezoekersteam' => $naamarray[7],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 5
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match18);
    	
    	$match19 = array(
    		'thuisteam' => $naamarray[2],
    		'bezoekersteam' => $naamarray[4],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 5
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match19);
    	
    	$match20 = array(
    		'thuisteam' => $naamarray[6],
    		'bezoekersteam' => $naamarray[8],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 5
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match20);
    	
    	
    	//week6
    	
    	$match21 = array(
    		'thuisteam' => $naamarray[5],
    		'bezoekersteam' => $naamarray[1],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 6
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match21);
    	
    	
    	$match22 = array(
    		'thuisteam' => $naamarray[7],
    		'bezoekersteam' => $naamarray[3],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 6
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match22);
    	
    	$match23 = array(
    		'thuisteam' => $naamarray[6],
    		'bezoekersteam' => $naamarray[2],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 6
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match23);
    	
    	$match24 = array(
    		'thuisteam' => $naamarray[8],
    		'bezoekersteam' => $naamarray[4],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 6
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match24);
    	
    	
    	//week7
    	
    	$match25 = array(
    		'thuisteam' => $naamarray[1],
    		'bezoekersteam' => $naamarray[7],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 7
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match25);
    	
    	
    	$match26 = array(
    		'thuisteam' => $naamarray[3],
    		'bezoekersteam' => $naamarray[5],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 7
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match26);
    	
    	$match27 = array(
    		'thuisteam' => $naamarray[2],
    		'bezoekersteam' => $naamarray[8],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 7
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match27);
    	
    	$match28 = array(
    		'thuisteam' => $naamarray[4],
    		'bezoekersteam' => $naamarray[6],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 7
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match28);
    	
    	
    	//alles omdraaien voor de tweede helft van het seizoen
    	
    	
    	//week8
    	$match29 = array(
    		'thuisteam' => $naamarray[2],
    		'bezoekersteam' => $naamarray[1],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 8
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match29);
    	
    	$match30 = array(
    		'thuisteam' => $naamarray[4],
    		'bezoekersteam' => $naamarray[3],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 8
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match30);
    	
    	$match31 = array(
    		'thuisteam' => $naamarray[6],
    		'bezoekersteam' => $naamarray[5],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 8
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match31);
    	
    	$match32 = array(
    		'thuisteam' => $naamarray[8],
    		'bezoekersteam' => $naamarray[7],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 8
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match32);
    	
    	
    	//week9
    	
    	$match33 = array(
    		'thuisteam' => $naamarray[1],
    		'bezoekersteam' => $naamarray[4],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 9
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match33);
    	
    	$match34 = array(
    		'thuisteam' => $naamarray[3],
    		'bezoekersteam' => $naamarray[2],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 9
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match34);
    	
    	$match35 = array(
    		'thuisteam' => $naamarray[5],
    		'bezoekersteam' => $naamarray[8],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 9
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match35);
    	
    	$match36 = array(
    		'thuisteam' => $naamarray[7],
    		'bezoekersteam' => $naamarray[6],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 9
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match36);
    	
    	
    	//week10
    	
    	$match37 = array(
    		'thuisteam' => $naamarray[6],
    		'bezoekersteam' => $naamarray[1],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 10
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match37);
    	
    	
    	$match38 = array(
    		'thuisteam' => $naamarray[2],
    		'bezoekersteam' => $naamarray[5],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 10
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match38);
    	
    	$match39 = array(
    		'thuisteam' => $naamarray[8],
    		'bezoekersteam' => $naamarray[3],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 10
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match39);
    	
    	$match40 = array(
    		'thuisteam' => $naamarray[7],
    		'bezoekersteam' => $naamarray[4],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 10
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match40);
    	
    	//week11
    	
    	$match41 = array(
    		'thuisteam' => $naamarray[1],
    		'bezoekersteam' => $naamarray[8],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 11
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match41);
    	
    	
    	$match42 = array(
    		'thuisteam' => $naamarray[7],
    		'bezoekersteam' => $naamarray[2],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 11
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match42);
    	
    	$match43 = array(
    		'thuisteam' => $naamarray[3],
    		'bezoekersteam' => $naamarray[6],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 11
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match43);
    	
    	$match44 = array(
    		'thuisteam' => $naamarray[4],
    		'bezoekersteam' => $naamarray[5],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 11
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match44);
    	
    	//week12
    	
    	$match45 = array(
    		'thuisteam' => $naamarray[3],
    		'bezoekersteam' => $naamarray[1],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 12
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match45);
    	
    	
    	$match46 = array(
    		'thuisteam' => $naamarray[7],
    		'bezoekersteam' => $naamarray[5],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 12
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match46);
    	
    	$match47 = array(
    		'thuisteam' => $naamarray[4],
    		'bezoekersteam' => $naamarray[2],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 12
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match47);
    	
    	$match48 = array(
    		'thuisteam' => $naamarray[8],
    		'bezoekersteam' => $naamarray[6],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 12
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match48);
    	
    	
    	//week13
    	
    	$match49 = array(
    		'thuisteam' => $naamarray[1],
    		'bezoekersteam' => $naamarray[5],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 13
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match49);
    	
    	
    	$match50 = array(
    		'thuisteam' => $naamarray[3],
    		'bezoekersteam' => $naamarray[7],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 13
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match50);
    	
    	$match51 = array(
    		'thuisteam' => $naamarray[2],
    		'bezoekersteam' => $naamarray[6],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 13
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match51);
    	
    	$match52 = array(
    		'thuisteam' => $naamarray[4],
    		'bezoekersteam' => $naamarray[8],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 13
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match52);
    	
    	
    	//week14
    	
    	$match53 = array(
    		'thuisteam' => $naamarray[7],
    		'bezoekersteam' => $naamarray[1],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 14
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match53);
    	
    	
    	$match54 = array(
    		'thuisteam' => $naamarray[5],
    		'bezoekersteam' => $naamarray[3],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 14
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match54);
    	
    	$match55 = array(
    		'thuisteam' => $naamarray[8],
    		'bezoekersteam' => $naamarray[2],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 14
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match55);
    	
    	$match56 = array(
    		'thuisteam' => $naamarray[6],
    		'bezoekersteam' => $naamarray[4],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 14
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match56);

    	
    	
    
    	//print_r($naamarray);
    	
    	}
    		
    }
    
    function get_wedstrijden()
    {
    	$seizoenquery = $this->db->get('korf_cron');
    	
    	foreach($seizoenquery->result() as $rij){
    		$season = $rij->seizoen;
    		$week = $rij->week;
    	
    	}
    	
    	
    	$this->db->where('week', $week);
    	$this->db->where('seizoen', $season);
    	$wedstrijdenquery = $this->db->get('korf_wedstrijden');
    	
    	//elke wedstrijd
    	$i=1;
    	$wedstrijd = array();
    	foreach($wedstrijdenquery->result() as $row)
    	{	
    		//wedstrijdid
    		$wedstrijd[$i]['wedstrijdid'] = $row->wedstrijd_id;
    		$wedstrijd[$i]['thuisteam'] = $row->thuisteam;
    		//echo $row->thuisteam;
    		$wedstrijd[$i]['uitteam'] = $row->bezoekersteam;
    		$i++;
    	}	
    	
    	return $wedstrijd;

    }
    
    function get_statsuitteam($wedstrijd)
    {
    	//aantal wedstrijden
    	$lengte =  sizeof($wedstrijd)+1;
    	
    	$rebound1id = array();
    	$play1id = array();
    	$att1id = array();
    	$att2id = array();
    	$rebound2id = array();
    	$play2id = array();
    	$att3id = array();
    	$att4id = array();
    	
    		
    		//thuisteamstats
    		for($j=1;$j<$lengte;$j++){
    			
    			$empty = "empty";
    			
    			$this->db->select('*');
    			$this->db->from('korf_opstelling');
    			$this->db->where('FK_team_id', $wedstrijd[$j]['uitteam']);
    			$query = $this->db->get();
    			
    			if($query->num_rows() == 0){
    				$rebound1id[$j] = "empty";
    				$play1id[$j] ="empty";
    				$att1id[$j] ="empty";
    				$att2id[$j] ="empty";
    				$rebound2id[$j] ="empty";
    				$play2id[$j] ="empty";
    				$att3id[$j] ="empty";
    				$att4id[$j] ="empty";

    				
    			}else{
    			
    			foreach($query->result() as $uitrow)
    			{
    				$rebound1id[$j] = $uitrow->rebound1_speler;
    				$play1id[$j] = $uitrow->playmaking1_speler;
    				$att1id[$j] =$uitrow -> attack1_speler;
    				$att2id[$j] =$uitrow -> attack2_speler;
    				$rebound2id[$j] = $uitrow -> rebound2_speler;
    				$play2id[$j] = $uitrow -> playmaking2_speler;
    				$att3id[$j] =$uitrow -> attack3_speler;
					$att4id[$j] = $uitrow -> attack4_speler;

    			}
    				}
    		}
    		
    		//2044 reboundspelers
    		$lengterebound1 = sizeof($rebound1id) + 1;
    		
    			
    			
    				$thuisstats = array();
    				
    				
    				//rebound1 skill ophalen
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('rebound,rebound_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $rebound1id[$k]);
	    			$reboundquery = $this->db->get();
    				
    				if($reboundquery->num_rows() == 0)
    				{
    					$uitstats[$k]['rebound'] = 0;
    				}else{
    			
	    				foreach($reboundquery->result() as $row)
	    				{
	    					 $rebound = $row->rebound;;
	    					 $rebound_tr = $row->rebound_tr;
	    					 $uitstats[$k]['rebound'] = $rebound .'.'. $rebound_tr;
	    					
	    			
	    				}
	    				}
    				
    				}
    				
    				//playmaking1 skill ophalen
    				
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('playmaking,playmaking_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $play1id[$k]);
	    			$playmakingquery = $this->db->get();
    				
    				if($playmakingquery->num_rows() == 0)
    				{
    					$uitstats[$k]['playmaking'] = 0;
    				
    				}else{
    			
	    				foreach($playmakingquery->result() as $row)
	    				{
	    					 $playmaking = $row->playmaking;
	    					 $playmaking_tr = $row->playmaking_tr;
	    					 $uitstats[$k]['playmaking'] = $playmaking.'.'.$playmaking_tr;
	    					 
	    			
	    				}
	    				}
    				
    				}
    				
    				//attack1 skill ophalen
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('shotpower,shotpower_tr, shotprecision, shotprecision_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $att1id[$k]);
	    			$attackquery = $this->db->get();
    				
    				if($attackquery->num_rows() == 0)
    				{
    					$uitstats[$k]['attack'] = 0;
    				}else{
    			
	    				foreach($attackquery->result() as $row)
	    				{
	    				
	    						$shotpower = $row->shotpower;
	    						$shotpower_tr = $row->shotpower_tr;
	    						$shotprecision = $row->shotprecision;
	    						$shotprecision_tr = $row->shotprecision_tr;
	    					 	$uitstats[$k]['attack'] = $shotpower + $shotprecision.'.'.($shotprecision_tr + $shotpower_tr)/2;
	    			
	    				}
	    				}
    				
    				}
    				
    				//attack2 skill ophalen
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('shotpower,shotpower_tr, shotprecision, shotprecision_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $att2id[$k]);
	    			$attackquery2 = $this->db->get();
    				
    				if($attackquery2->num_rows() == 0)
    				{
    					$uitstats[$k]['attack2'] = 0;
    				}else{
    			
	    				foreach($attackquery2->result() as $row)
	    				{
	    				
	    						$shotpower = $row->shotpower;
	    						$shotpower_tr = $row->shotpower_tr;
	    						$shotprecision = $row->shotprecision;
	    						$shotprecision_tr = $row->shotprecision_tr;
	    					 	$uitstats[$k]['attack2'] = $shotpower + $shotprecision.'.'.($shotprecision_tr + $shotpower_tr)/2;
	    			
	    				}
	    				}
    				
    				}
    				
    				//rebound2 skill ophalen
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('rebound,rebound_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $rebound2id[$k]);
	    			$rebound2query = $this->db->get();
    				
    				if($rebound2query->num_rows() == 0)
    				{
    					$uitstats[$k]['rebound2'] = 0;
    				}else{
    			
	    				foreach($rebound2query->result() as $row)
	    				{
	    					 $rebound = $row->rebound;;
	    					 $rebound_tr = $row->rebound_tr;
	    					 $uitstats[$k]['rebound2'] = $rebound .'.'. $rebound_tr;
	    					
	    			
	    				}
	    				}
    				
    				}
    				
    				//playmaking2 skill ophalen
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('playmaking,playmaking_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $play2id[$k]);
	    			$playmaking2query = $this->db->get();
    				
    				if($playmaking2query->num_rows() == 0)
    				{
    					$uitstats[$k]['playmaking2'] = 0;
    				
    				}else{
    			
	    				foreach($playmaking2query->result() as $row)
	    				{
	    					 $playmaking = $row->playmaking;
	    					 $playmaking_tr = $row->playmaking_tr;
	    					 $uitstats[$k]['playmaking2'] = $playmaking.'.'.$playmaking_tr;
	    					 
	    			
	    				}
	    				}
    				
    				}
    				
					//attack3 skill ophalen
					for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('shotpower,shotpower_tr, shotprecision, shotprecision_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $att3id[$k]);
	    			$attack3query = $this->db->get();
    				
    				if($attack3query->num_rows() == 0)
    				{
    					$uitstats[$k]['attack3'] = 0;
    				}else{
    			
	    				foreach($attack3query->result() as $row)
	    				{
	    				
	    						$shotpower = $row->shotpower;
	    						$shotpower_tr = $row->shotpower_tr;
	    						$shotprecision = $row->shotprecision;
	    						$shotprecision_tr = $row->shotprecision_tr;
	    					 	$uitstats[$k]['attack3'] = $shotpower + $shotprecision.'.'.($shotprecision_tr + $shotpower_tr)/2;
	    			
	    				}
	    				}
    				
    				}
    				
    				//attack4 skill ophalen
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('shotpower,shotpower_tr, shotprecision, shotprecision_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $att4id[$k]);
	    			$attack4query = $this->db->get();
    				
    				if($attack4query->num_rows() == 0)
    				{
    					$uitstats[$k]['attack4'] = 0;
    				}else{
    			
	    				foreach($attack4query->result() as $row)
	    				{
	    				
	    						$shotpower = $row->shotpower;
	    						$shotpower_tr = $row->shotpower_tr;
	    						$shotprecision = $row->shotprecision;
	    						$shotprecision_tr = $row->shotprecision_tr;
	    					 	$uitstats[$k]['attack4'] = $shotpower + $shotprecision.'.'.($shotprecision_tr + $shotpower_tr)/2;
	    			
	    				}
	    				}
    				
    				}
			return $uitstats;

    }
    
    function get_statsthuisteam($wedstrijd)
    {
    	//aantal wedstrijden
    	$lengte =  sizeof($wedstrijd)+1;
    	
    	$rebound1id = array();
    	$play1id = array();
    	$att1id = array();
    	$att2id = array();
    	$rebound2id = array();
    	$play2id = array();
    	$att3id = array();
    	$att4id = array();
    	
    		
    		//thuisteamstats
    		for($j=1;$j<$lengte;$j++){
    			
    			$empty = "empty";
    			
    			$this->db->select('*');
    			$this->db->from('korf_opstelling');
    			$this->db->where('FK_team_id', $wedstrijd[$j]['thuisteam']);
    			$query = $this->db->get();
    			
    			if($query->num_rows() == 0){
    				$rebound1id[$j] = "empty";
    				$play1id[$j] ="empty";
    				$att1id[$j] ="empty";
    				$att2id[$j] ="empty";
    				$rebound2id[$j] ="empty";
    				$play2id[$j] ="empty";
    				$att3id[$j] ="empty";
    				$att4id[$j] ="empty";

    				
    			}else{
    			
    			foreach($query->result() as $thuisrow)
    			{
    				$rebound1id[$j] = $thuisrow->rebound1_speler;
    				$play1id[$j] = $thuisrow->playmaking1_speler;
    				$att1id[$j] =$thuisrow -> attack1_speler;
    				$att2id[$j] =$thuisrow -> attack2_speler;
    				$rebound2id[$j] = $thuisrow -> rebound2_speler;
    				$play2id[$j] = $thuisrow -> playmaking2_speler;
    				$att3id[$j] =$thuisrow -> attack3_speler;
					$att4id[$j] = $thuisrow -> attack4_speler;

    			}
    				}
    		}
    		
    		//2044 reboundspelers
    		$lengterebound1 = sizeof($rebound1id) + 1;
    		
    			
    			
    				$thuistats = array();
    				$thuisstats_tr =array();
    				
    				//rebound1 skill ophalen
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('rebound,rebound_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $rebound1id[$k]);
	    			$reboundquery = $this->db->get();
    				
    				if($reboundquery->num_rows() == 0)
    				{
    					$thuisstats[$k]['rebound'] = 0;
    				}else{
    			
	    				foreach($reboundquery->result() as $row)
	    				{
	    					 $rebound = $row->rebound;;
	    					 $rebound_tr = $row->rebound_tr;
	    					 $thuisstats[$k]['rebound'] = $rebound .'.'. $rebound_tr;
	    					
	    			
	    				}
	    				}
    				
    				}
    				
    				//playmaking1 skill ophalen
    				
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('playmaking,playmaking_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $play1id[$k]);
	    			$playmakingquery = $this->db->get();
    				
    				if($playmakingquery->num_rows() == 0)
    				{
    					$thuisstats[$k]['playmaking'] = 0;
    				
    				}else{
    			
	    				foreach($playmakingquery->result() as $row)
	    				{
	    					 $playmaking = $row->playmaking;
	    					 $playmaking_tr = $row->playmaking_tr;
	    					 $thuisstats[$k]['playmaking'] = $playmaking.'.'.$playmaking_tr;
	    					 
	    			
	    				}
	    				}
    				
    				}
    				
    				//attack1 skill ophalen
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('shotpower,shotpower_tr, shotprecision, shotprecision_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $att1id[$k]);
	    			$attackquery = $this->db->get();
    				
    				if($attackquery->num_rows() == 0)
    				{
    					$thuisstats[$k]['attack'] = 0;
    				}else{
    			
	    				foreach($attackquery->result() as $row)
	    				{
	    				
	    						$shotpower = $row->shotpower;
	    						$shotpower_tr = $row->shotpower_tr;
	    						$shotprecision = $row->shotprecision;
	    						$shotprecision_tr = $row->shotprecision_tr;
	    					 	$thuisstats[$k]['attack'] = $shotpower + $shotprecision.'.'.($shotprecision_tr + $shotpower_tr)/2;
	    			
	    				}
	    				}
    				
    				}
    				
    				//attack2 skill ophalen
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('shotpower,shotpower_tr, shotprecision, shotprecision_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $att2id[$k]);
	    			$attackquery2 = $this->db->get();
    				
    				if($attackquery2->num_rows() == 0)
    				{
    					$thuisstats[$k]['attack2'] = 0;
    				}else{
    			
	    				foreach($attackquery2->result() as $row)
	    				{
	    				
	    						$shotpower = $row->shotpower;
	    						$shotpower_tr = $row->shotpower_tr;
	    						$shotprecision = $row->shotprecision;
	    						$shotprecision_tr = $row->shotprecision_tr;
	    					 	$thuisstats[$k]['attack2'] = $shotpower + $shotprecision.'.'.($shotprecision_tr + $shotpower_tr)/2;
	    			
	    				}
	    				}
    				
    				}
    				
    				//rebound2 skill ophalen
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('rebound,rebound_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $rebound2id[$k]);
	    			$rebound2query = $this->db->get();
    				
    				if($rebound2query->num_rows() == 0)
    				{
    					$thuisstats[$k]['rebound2'] = 0;
    				}else{
    			
	    				foreach($rebound2query->result() as $row)
	    				{
	    					 $rebound = $row->rebound;;
	    					 $rebound_tr = $row->rebound_tr;
	    					 $thuisstats[$k]['rebound2'] = $rebound .'.'. $rebound_tr;
	    					
	    			
	    				}
	    				}
    				
    				}
    				
    				//playmaking2 skill ophalen
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('playmaking,playmaking_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $play2id[$k]);
	    			$playmaking2query = $this->db->get();
    				
    				if($playmaking2query->num_rows() == 0)
    				{
    					$thuisstats[$k]['playmaking2'] = 0;
    				
    				}else{
    			
	    				foreach($playmaking2query->result() as $row)
	    				{
	    					 $playmaking = $row->playmaking;
	    					 $playmaking_tr = $row->playmaking_tr;
	    					 $thuisstats[$k]['playmaking2'] = $playmaking.'.'.$playmaking_tr;
	    					 
	    			
	    				}
	    				}
    				
    				}
    				
					//attack3 skill ophalen
					for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('shotpower,shotpower_tr, shotprecision, shotprecision_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $att3id[$k]);
	    			$attack3query = $this->db->get();
    				
    				if($attack3query->num_rows() == 0)
    				{
    					$thuisstats[$k]['attack3'] = 0;
    				}else{
    			
	    				foreach($attack3query->result() as $row)
	    				{
	    				
	    						$shotpower = $row->shotpower;
	    						$shotpower_tr = $row->shotpower_tr;
	    						$shotprecision = $row->shotprecision;
	    						$shotprecision_tr = $row->shotprecision_tr;
	    					 	$thuisstats[$k]['attack3'] = $shotpower + $shotprecision.'.'.($shotprecision_tr + $shotpower_tr)/2;
	    			
	    				}
	    				}
    				
    				}
    				
    				//attack4 skill ophalen
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('shotpower,shotpower_tr, shotprecision, shotprecision_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $att4id[$k]);
	    			$attack4query = $this->db->get();
    				
    				if($attack4query->num_rows() == 0)
    				{
    					$thuisstats[$k]['attack4'] = 0;
    				}else{
    			
	    				foreach($attack4query->result() as $row)
	    				{
	    				
	    						$shotpower = $row->shotpower;
	    						$shotpower_tr = $row->shotpower_tr;
	    						$shotprecision = $row->shotprecision;
	    						$shotprecision_tr = $row->shotprecision_tr;
	    					 	$thuisstats[$k]['attack4'] = $shotpower + $shotprecision.'.'.($shotprecision_tr + $shotpower_tr)/2; //gedeeld door 2 omwille van dubbele skilloptelling
	    			
	    				}
	    				}
    				
    				}
			return $thuisstats;
    
    }
    //speel wedstrijden
    function play_games($thuis, $uit, $wedstrijd)
    {
    	$lengte = sizeof($thuis);
    	$uitslag = array();
    	
    	for($i=1;$i<$lengte+1;$i++){
    	
    		$wedstrijdid = $wedstrijd[$i]['wedstrijdid'];
    		$thuisteamid = $wedstrijd[$i]['thuisteam'];
    		$uitteamid = $wedstrijd[$i]['uitteam'];
    		
    		
    		$thuistotaal = $thuis[$i]['rebound'] + $thuis[$i]['playmaking'] + $thuis[$i]['attack'] + $thuis[$i]['attack2'] + $thuis[$i]['rebound2'] +$thuis[$i]['playmaking2'] + $thuis[$i]['attack3'] + $thuis[$i]['attack4'];
    		
    		
    		$uittotaal = $uit[$i]['rebound'] + $uit[$i]['playmaking'] + $uit[$i]['attack'] + $uit[$i]['attack2'] + $uit[$i]['rebound2'] +$uit[$i]['playmaking2'] + $uit[$i]['attack3'] + $uit[$i]['attack4'];


		
		$uitslag['thuis'] = 0;
		$uitslag['uit'] = 0;
	
		
		
		//eerste actie
		$randmin1 = rand(0,3);
		if($thuistotaal + rand(0,75) >= $uittotaal + rand(0,75))
		{
			$uitslag['thuis'] = $uitslag['thuis'] + 1;
		
		}else{
			$uitslag['uit'] = $uitslag['uit'] + 1;
		
		}
		
		//2de actie
		$randmin2 = rand(3,5);
			if($thuistotaal + rand(0,75) >= $uittotaal + rand(0,75))
		{
			$uitslag['thuis'] = $uitslag['thuis'] + 1;
		
		}else{
			$uitslag['uit'] = $uitslag['uit'] + 1;
		
		}
		
		//3de actie
		$randmin3 = rand(6,7);
		if($thuistotaal + rand(0,75) >= $uittotaal + rand(0,75))
		{
			$uitslag['thuis'] = $uitslag['thuis'] + 1;
		
		}else{
			$uitslag['uit'] = $uitslag['uit'] + 1;
		
		}
		
		//4de actie
		$randmin4 = rand(8,11);
		if($thuistotaal + rand(0,75) >= $uittotaal + rand(0,75))
		{
			$uitslag['thuis'] = $uitslag['thuis'] + 1;
		
		}else{
			$uitslag['uit'] = $uitslag['uit'] + 1;
		
		}
		
		//5de actie
		$randmin5 = rand(12,16);
		if($thuistotaal + rand(0,75) >= $uittotaal + rand(0,75))
		{
			$uitslag['thuis'] = $uitslag['thuis'] + 1;
		
		}else{
			$uitslag['uit'] = $uitslag['uit'] + 1;
		
		}
		
		//6de actie
		$randmin6 = rand(17,30);
		if($thuistotaal + rand(0,75) >= $uittotaal + rand(0,75))
		{
			$uitslag['thuis'] = $uitslag['thuis'] + 1;
		
		}else{
			$uitslag['uit'] = $uitslag['uit'] + 1;
		
		}
		
		
		//minutenstring om te inserten en de databank
		$minuten = '';
		$minuten =+ $randmin1.';'.$randmin2.';'.$randmin3.';'.$randmin4.';'.$randmin5.';'.$randmin6;
		
		//gelijkstand
		if($uitslag['thuis'] == $uitslag['uit']){
			//insert verslag
			$insert = array(
				'FK_wedstrijd_id' => $wedstrijdid,
				'minuten' => $minuten
			
			);
			
			$this->db->insert('korf_verslagen', $insert);
			
			//haal de thuisteamgegevens op
			$this->db->select('gespeeld, gelijk, doelpunten_voor, doelpunten_tegen, divisiepunten');
			$this->db->from('korf_teams');
			$this->db->where('team_id', $thuisteamid);
			$thuisteamquery = $this->db->get();
			
			foreach($thuisteamquery->result() as $row)
			{
				$gespeeld = $row->gespeeld;
				$gelijk = $row->gelijk;
				$voor = $row->doelpunten_voor;
				$tegen = $row->doelpunten_tegen;
				$punten = $row->divisiepunten;
			
			}
			
			$thuisupdate = array(
				'gespeeld' => $gespeeld +1,
				'gelijk' => $gelijk + 1,
				'doelpunten_voor' => $voor + $uitslag['thuis'],
				'doelpunten_tegen' => $tegen + $uitslag['uit'], 
				'divisiepunten' => $punten + 1
			
			);
			
			$this->db->where('team_id', $thuisteamid);
			$this->db->update('korf_teams', $thuisupdate);
			
			//haal de uitteamgegevens op
			$this->db->select('gespeeld, gelijk, doelpunten_voor, doelpunten_tegen, divisiepunten');
			$this->db->from('korf_teams');
			$this->db->where('team_id', $uitteamid);
			$uitteamquery = $this->db->get();
			
			foreach($uitteamquery->result() as $row)
			{
				$gespeeld = $row->gespeeld;
				$gelijk = $row->gelijk;
				$voor = $row->doelpunten_voor;
				$tegen = $row->doelpunten_tegen;
				$punten = $row->divisiepunten;
			
			}

			
			$uitupdate = array(
				'gespeeld' => $gespeeld +1,
				'gelijk' => $gelijk + 1,
				'doelpunten_voor' => $voor + $uitslag['uit'],
				'doelpunten_tegen' => $tegen + $uitslag['thuis'], 
				'divisiepunten' => $punten + 1
			
			);
			
			$this->db->where('team_id', $uitteamid);
			$this->db->update('korf_teams', $uitupdate);
			
		}
		
		//thuisteam wint////////////////////////////
		if($uitslag['thuis'] > $uitslag['uit']){
		//insert verslag
			$insert = array(
				'FK_wedstrijd_id' => $wedstrijdid,
				'minuten' => $minuten
			
			);
			
			$this->db->insert('korf_verslagen', $insert);
			
			//haal de thuisteamgegevens op
			$this->db->select('gespeeld, gewonnen, doelpunten_voor, doelpunten_tegen, divisiepunten');
			$this->db->from('korf_teams');
			$this->db->where('team_id', $thuisteamid);
			$thuisteamquery = $this->db->get();
			
			foreach($thuisteamquery->result() as $row)
			{
				$gespeeld = $row->gespeeld;
				$gewonnen = $row->gewonnen;
				$voor = $row->doelpunten_voor;
				$tegen = $row->doelpunten_tegen;
				$punten = $row->divisiepunten;
			
			}
			
			$thuisupdate = array(
				'gespeeld' => $gespeeld +1,
				'gewonnen' => $gewonnen + 1,
				'doelpunten_voor' => $voor + $uitslag['thuis'],
				'doelpunten_tegen' => $tegen + $uitslag['uit'], 
				'divisiepunten' => $punten + 2
			
			);
			
			$this->db->where('team_id', $thuisteamid);
			$this->db->update('korf_teams', $thuisupdate);
			
			//haal de uitteamgegevens op
			$this->db->select('gespeeld, verloren, doelpunten_voor, doelpunten_tegen');
			$this->db->from('korf_teams');
			$this->db->where('team_id', $uitteamid);
			$uitteamquery = $this->db->get();
			
			foreach($uitteamquery->result() as $row)
			{
				$gespeeld = $row->gespeeld;
				$verloren = $row->verloren;
				$voor = $row->doelpunten_voor;
				$tegen = $row->doelpunten_tegen;
				
			
			}

			
			$uitupdate = array(
				'gespeeld' => $gespeeld +1,
				'verloren' => $verloren + 1,
				'doelpunten_voor' => $voor + $uitslag['uit'],
				'doelpunten_tegen' => $tegen + $uitslag['thuis']
				
			
			);
			
			$this->db->where('team_id', $uitteamid);
			$this->db->update('korf_teams', $uitupdate);
			
		
		
		
		}
		
		//uitteam wint////////////////////////////
		if($uitslag['thuis'] < $uitslag['uit']){
		//insert verslag
			$insert = array(
				'FK_wedstrijd_id' => $wedstrijdid,
				'minuten' => $minuten
			
			);
			
			$this->db->insert('korf_verslagen', $insert);
			
			//haal de thuisteamgegevens op
			$this->db->select('gespeeld, verloren, doelpunten_voor, doelpunten_tegen');
			$this->db->from('korf_teams');
			$this->db->where('team_id', $thuisteamid);
			$thuisteamquery = $this->db->get();
			
			foreach($thuisteamquery->result() as $row)
			{
				$gespeeld = $row->gespeeld;
				$verloren = $row->verloren;
				$voor = $row->doelpunten_voor;
				$tegen = $row->doelpunten_tegen;
				
			
			}
			
			$thuisupdate = array(
				'gespeeld' => $gespeeld +1,
				'verloren' => $verloren + 1,
				'doelpunten_voor' => $voor + $uitslag['thuis'],
				'doelpunten_tegen' => $tegen + $uitslag['uit']
				
			
			);
			
			$this->db->where('team_id', $thuisteamid);
			$this->db->update('korf_teams', $thuisupdate);
			
			//haal de uitteamgegevens op
			$this->db->select('gespeeld, gewonnen, doelpunten_voor, doelpunten_tegen, divisiepunten');
			$this->db->from('korf_teams');
			$this->db->where('team_id', $uitteamid);
			$uitteamquery = $this->db->get();
			
			foreach($uitteamquery->result() as $row)
			{
				$gespeeld = $row->gespeeld;
				$gewonnen = $row->gewonnen;
				$voor = $row->doelpunten_voor;
				$tegen = $row->doelpunten_tegen;
				$punten = $row->divisiepunten;
				
			
			}

			
			$uitupdate = array(
				'gespeeld' => $gespeeld +1,
				'gewonnen' => $gewonnen + 1,
				'doelpunten_voor' => $voor + $uitslag['uit'],
				'doelpunten_tegen' => $tegen + $uitslag['thuis'], 
				'divisiepunten' => $punten + 2
				
			
			);
			
			$this->db->where('team_id', $uitteamid);
			$this->db->update('korf_teams', $uitupdate);
			
		
		
		
		}

		$einduitslag = array(
			'uitslag' => $uitslag['thuis'].'-'.$uitslag['uit']
		
		);		
		
		$this->db->where('wedstrijd_id', $wedstrijdid);
		$this->db->update('korf_wedstrijden', $einduitslag);
		
    	}
    	   //return $uitslag; 
    }
    
    
    
    
    
    
    
    
    
    
    
    
 }  
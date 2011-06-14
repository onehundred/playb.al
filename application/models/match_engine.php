<?php class Match_engine extends CI_Model {

    function __construct()
    {
        parent::__construct();
       
    }
    
    function send_message($titel, $onderwerp, $bericht, $cat, $verzender, $ontvanger){
    	
    	
    	$mdate =  date("F j Y, H:m"); 
    	
    	$data = array(
    		'titel' => $titel,
    		'onderwerp' => $onderwerp, 
    		'bericht' => $bericht, 
    		'categorie' => $cat, 
    		'verzender' => $verzender, 
    		'ontvanger' => $ontvanger,
    		'datum' => $mdate,
    		'status' => 0,
    	);
    	
    	
    	$this->db->insert('korf_berichten', $data);
    
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
    		//loop door alle uitteams van de wedstrijden
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
    		
    		//2044 spelers
    		$lengterebound1 = sizeof($rebound1id) + 1;
    		
    			
    			
    				$thuisstats = array();
    				
    				
    				//rebound1 skill ophalen
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('voornaam, achternaam, rebound,rebound_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $rebound1id[$k]);
	    			$reboundquery = $this->db->get();
    				
    				if($reboundquery->num_rows() == 0)
    				{
    					$uitstats[$k]['rebound'] = 0;
    					$uitstats[$k]['reboundspeler'] = "playbalspeler";
    					$uitstats[$k]['reboundspelerid'] = 0;
    				}else{
    			
	    				foreach($reboundquery->result() as $row)
	    				{
	    					 $rebound = $row->rebound;;
	    					 $rebound_tr = $row->rebound_tr;
	    					 $uitstats[$k]['rebound'] = $rebound .'.'. $rebound_tr;
	    					 $uitstats[$k]['reboundspeler'] = $row->voornaam.' '.$row->achternaam;
	    					 $uitstats[$k]['reboundspelerid'] = $rebound1id[$k];
	    					
	    			
	    				}
	    				}
    				
    				}
    				
    				//playmaking1 skill ophalen
    				
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('voornaam, achternaam, playmaking,playmaking_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $play1id[$k]);
	    			$playmakingquery = $this->db->get();
    				
    				if($playmakingquery->num_rows() == 0)
    				{
    					$uitstats[$k]['playmaking'] = 0;
    					$uitstats[$k]['playmakingspeler'] = "playbalspeler";
    					$uitstats[$k]['playmakingspelerid'] = 0;
    				}else{
    			
	    				foreach($playmakingquery->result() as $row)
	    				{
	    					 $playmaking = $row->playmaking;
	    					 $playmaking_tr = $row->playmaking_tr;
	    					 $uitstats[$k]['playmaking'] = $playmaking.'.'.$playmaking_tr;
	    					 $uitstats[$k]['playmakingspeler'] = $row->voornaam.' '.$row->achternaam;
							 $uitstats[$k]['playmakingspelerid'] = $play1id[$k];
	    					 
	    			
	    				}
	    				}
    				
    				}
    				
    				//attack1 skill ophalen
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('voornaam, achternaam, shotpower,shotpower_tr, shotprecision, shotprecision_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $att1id[$k]);
	    			$attackquery = $this->db->get();
    				
    				if($attackquery->num_rows() == 0)
    				{
    					$uitstats[$k]['attack'] = 0;
    					$uitstats[$k]['attackspeler'] = "playbalspeler";
    					$uitstats[$k]['attackspelerid'] = 0;
    				}else{
    			
	    				foreach($attackquery->result() as $row)
	    				{
	    				
	    						$shotpower = $row->shotpower;
	    						$shotpower_tr = $row->shotpower_tr;
	    						$shotprecision = $row->shotprecision;
	    						$shotprecision_tr = $row->shotprecision_tr;
	    					 	$uitstats[$k]['attack'] = $shotpower + $shotprecision.'.'.($shotprecision_tr + $shotpower_tr)/2;
	    					 	$uitstats[$k]['attackspeler'] = $row->voornaam.' '.$row->achternaam;
								$uitstats[$k]['attackspelerid'] =  $att1id[$k];
	    			
	    				}
	    				}
    				
    				}
    				
    				//attack2 skill ophalen
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('voornaam, achternaam, shotpower,shotpower_tr, shotprecision, shotprecision_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $att2id[$k]);
	    			$attackquery2 = $this->db->get();
    				
    				if($attackquery2->num_rows() == 0)
    				{
    					$uitstats[$k]['attack2'] = 0;
    					$uitstats[$k]['attack2speler'] = "playbalspeler";
    					$uitstats[$k]['attack2spelerid'] = 0;
    				}else{
    			
	    				foreach($attackquery2->result() as $row)
	    				{
	    				
	    						$shotpower = $row->shotpower;
	    						$shotpower_tr = $row->shotpower_tr;
	    						$shotprecision = $row->shotprecision;
	    						$shotprecision_tr = $row->shotprecision_tr;
	    					 	$uitstats[$k]['attack2'] = $shotpower + $shotprecision.'.'.($shotprecision_tr + $shotpower_tr)/2;
	    					 	$uitstats[$k]['attack2speler'] = $row->voornaam.' '.$row->achternaam;
								$uitstats[$k]['attack2spelerid'] = $att2id[$k];
	    			
	    				}
	    				}
    				
    				}
    				
    				//rebound2 skill ophalen
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('voornaam, achternaam, rebound,rebound_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $rebound2id[$k]);
	    			$rebound2query = $this->db->get();
    				
    				if($rebound2query->num_rows() == 0)
    				{
    					$uitstats[$k]['rebound2'] = 0;
    					$uitstats[$k]['rebound2speler'] = "playbalspeler";
    					$uitstats[$k]['rebound2spelerid'] = 0;
    				}else{
    			
	    				foreach($rebound2query->result() as $row)
	    				{
	    					 $rebound = $row->rebound;;
	    					 $rebound_tr = $row->rebound_tr;
	    					 $uitstats[$k]['rebound2'] = $rebound .'.'. $rebound_tr;
	    					 $uitstats[$k]['rebound2speler'] = $row->voornaam.' '.$row->achternaam;
							 $uitstats[$k]['rebound2spelerid'] = $rebound2id[$k];
	    					
	    			
	    				}
	    				}
    				
    				}
    				
    				//playmaking2 skill ophalen
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('voornaam, achternaam, playmaking,playmaking_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $play2id[$k]);
	    			$playmaking2query = $this->db->get();
    				
    				if($playmaking2query->num_rows() == 0)
    				{
    					$uitstats[$k]['playmaking2'] = 0;
    					$uitstats[$k]['playmaking2speler'] = "playbalspeler";
    					$uitstats[$k]['playmaking2spelerid'] = 0;
    				}else{
    			
	    				foreach($playmaking2query->result() as $row)
	    				{
	    					 $playmaking = $row->playmaking;
	    					 $playmaking_tr = $row->playmaking_tr;
	    					 $uitstats[$k]['playmaking2'] = $playmaking.'.'.$playmaking_tr;
	    					 $uitstats[$k]['playmaking2speler'] = $row->voornaam.' '.$row->achternaam;
							 $uitstats[$k]['playmaking2spelerid'] =  $play2id[$k] ;
	    					 
	    			
	    				}
	    				}
    				
    				}
    				
					//attack3 skill ophalen
					for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('voornaam, achternaam, shotpower,shotpower_tr, shotprecision, shotprecision_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $att3id[$k]);
	    			$attack3query = $this->db->get();
    				
    				if($attack3query->num_rows() == 0)
    				{
    					$uitstats[$k]['attack3'] = 0;
    					$uitstats[$k]['attack3speler'] = "playbalspeler";
    					$uitstats[$k]['attack3spelerid'] = 0;
    				}else{
    			
	    				foreach($attack3query->result() as $row)
	    				{
	    				
	    						$shotpower = $row->shotpower;
	    						$shotpower_tr = $row->shotpower_tr;
	    						$shotprecision = $row->shotprecision;
	    						$shotprecision_tr = $row->shotprecision_tr;
	    					 	$uitstats[$k]['attack3'] = $shotpower + $shotprecision.'.'.($shotprecision_tr + $shotpower_tr)/2;
	    					    $uitstats[$k]['attack3speler'] = $row->voornaam.' '.$row->achternaam;
								$uitstats[$k]['attack3spelerid'] = $att3id[$k] ;
	    			
	    				}
	    				}
    				
    				}
    				
    				//attack4 skill ophalen
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('voornaam, achternaam, shotpower,shotpower_tr, shotprecision, shotprecision_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $att4id[$k]);
	    			$attack4query = $this->db->get();
    				
    				if($attack4query->num_rows() == 0)
    				{
    					$uitstats[$k]['attack4'] = 0;
    					$uitstats[$k]['attack4speler'] = "playbalspeler";
    					$uitstats[$k]['attack4spelerid'] = 0 ;
    				}else{
    			
	    				foreach($attack4query->result() as $row)
	    				{
	    				
	    						$shotpower = $row->shotpower;
	    						$shotpower_tr = $row->shotpower_tr;
	    						$shotprecision = $row->shotprecision;
	    						$shotprecision_tr = $row->shotprecision_tr;
	    					 	$uitstats[$k]['attack4'] = $shotpower + $shotprecision.'.'.($shotprecision_tr + $shotpower_tr)/2;
	    					    $uitstats[$k]['attack4speler'] = $row->voornaam.' '.$row->achternaam;
								$uitstats[$k]['attack4spelerid'] = $att4id[$k] ;
	    						
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
    				
	    			$this->db->select('voornaam, achternaam, rebound,rebound_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $rebound1id[$k]);
	    			$reboundquery = $this->db->get();
    				
    				if($reboundquery->num_rows() == 0)
    				{
    					$thuisstats[$k]['rebound'] = 0;
    					$thuisstats[$k]['reboundspeler'] = "playbalspeler";
    				    $thuisstats[$k]['reboundspelerid'] = 0;

    				}else{
    			
	    				foreach($reboundquery->result() as $row)
	    				{
	    					 $rebound = $row->rebound;
	    					 $rebound_tr = $row->rebound_tr;
	    					 $thuisstats[$k]['rebound'] = $rebound .'.'. $rebound_tr;
	    					 $thuisstats[$k]['reboundspeler'] = $row->voornaam.' '.$row->achternaam;
	    					 $thuisstats[$k]['reboundspelerid'] = $rebound1id[$k];
	    					
	    			
	    				}
	    				}
    				
    				}
    				
    				//playmaking1 skill ophalen
    				
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('voornaam, achternaam, playmaking,playmaking_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $play1id[$k]);
	    			$playmakingquery = $this->db->get();
    				
    				if($playmakingquery->num_rows() == 0)
    				{
    					$thuisstats[$k]['playmaking'] = 0;
    					$thuisstats[$k]['playmakingspeler'] = "playbalspeler";
    				    $thuisstats[$k]['playmakingspelerid'] = 0;
    				
    				}else{
    			
	    				foreach($playmakingquery->result() as $row)
	    				{
	    					 $playmaking = $row->playmaking;
	    					 $playmaking_tr = $row->playmaking_tr;
	    					 $thuisstats[$k]['playmaking'] = $playmaking.'.'.$playmaking_tr;
	    					 $thuisstats[$k]['playmakingspeler'] = $row->voornaam.' '.$row->achternaam;
	    					 $thuisstats[$k]['playmakingspelerid'] = $play1id[$k];

	    			
	    				}
	    				}
    				
    				}
    				
    				//attack1 skill ophalen
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('voornaam, achternaam, shotpower,shotpower_tr, shotprecision, shotprecision_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $att1id[$k]);
	    			$attackquery = $this->db->get();
    				
    				if($attackquery->num_rows() == 0)
    				{
    					$thuisstats[$k]['attack'] = 0;
    					$thuisstats[$k]['attackspeler'] = "playbalspeler";
    					$thuisstats[$k]['attackspelerid'] = 0;
    				}else{
    			
	    				foreach($attackquery->result() as $row)
	    				{
	    				
	    						$shotpower = $row->shotpower;
	    						$shotpower_tr = $row->shotpower_tr;
	    						$shotprecision = $row->shotprecision;
	    						$shotprecision_tr = $row->shotprecision_tr;
	    					 	$thuisstats[$k]['attack'] = $shotpower + $shotprecision.'.'.($shotprecision_tr + $shotpower_tr)/2;
	    					 	$thuisstats[$k]['attackspeler'] = $row->voornaam.' '.$row->achternaam;
	    						$thuisstats[$k]['attackspelerid'] = $att1id[$k];
	    				}
	    				}
    				
    				}
    				
    				//attack2 skill ophalen
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('voornaam, achternaam, shotpower,shotpower_tr, shotprecision, shotprecision_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $att2id[$k]);
	    			$attackquery2 = $this->db->get();
    				
    				if($attackquery2->num_rows() == 0)
    				{
    					$thuisstats[$k]['attack2'] = 0;
    					$thuisstats[$k]['attack2speler'] = "playbalspeler";
    					$thuisstats[$k]['attack2spelerid'] = 0;
    				}else{
    			
	    				foreach($attackquery2->result() as $row)
	    				{
	    				
	    						$shotpower = $row->shotpower;
	    						$shotpower_tr = $row->shotpower_tr;
	    						$shotprecision = $row->shotprecision;
	    						$shotprecision_tr = $row->shotprecision_tr;
	    					 	$thuisstats[$k]['attack2'] = $shotpower + $shotprecision.'.'.($shotprecision_tr + $shotpower_tr)/2;
	    					 	$thuisstats[$k]['attack2speler'] = $row->voornaam.' '.$row->achternaam;
	    						$thuisstats[$k]['attack2spelerid'] = $att2id[$k];
	    				}
	    				}
    				
    				}
    				
    				//rebound2 skill ophalen
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('voornaam, achternaam, rebound,rebound_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $rebound2id[$k]);
	    			$rebound2query = $this->db->get();
    				
    				if($rebound2query->num_rows() == 0)
    				{
    					$thuisstats[$k]['rebound2'] = 0;
    					$thuisstats[$k]['rebound2speler'] = "playbalspeler";
    					$thuisstats[$k]['rebound2spelerid'] = 0;
    				}else{
    			
	    				foreach($rebound2query->result() as $row)
	    				{
	    					 $rebound = $row->rebound;;
	    					 $rebound_tr = $row->rebound_tr;
	    					 $thuisstats[$k]['rebound2'] = $rebound .'.'. $rebound_tr;
	    					 $thuisstats[$k]['rebound2speler'] = $row->voornaam.' '.$row->achternaam;
	    					 $thuisstats[$k]['rebound2spelerid'] = $rebound2id[$k];
	    				}
	    				}
    				
    				}
    				
    				//playmaking2 skill ophalen
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('voornaam, achternaam, playmaking,playmaking_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $play2id[$k]);
	    			$playmaking2query = $this->db->get();
    				
    				if($playmaking2query->num_rows() == 0)
    				{
    					$thuisstats[$k]['playmaking2'] = 0;
    					$thuisstats[$k]['playmaking2speler'] = "playbalspeler";
    					$thuisstats[$k]['playmaking2spelerid'] = 0;
    				
    				}else{
    			
	    				foreach($playmaking2query->result() as $row)
	    				{
	    					 $playmaking = $row->playmaking;
	    					 $playmaking_tr = $row->playmaking_tr;
	    					 $thuisstats[$k]['playmaking2'] = $playmaking.'.'.$playmaking_tr;
	    					 $thuisstats[$k]['playmaking2speler'] = $row->voornaam.' '.$row->achternaam;
	    					 $thuisstats[$k]['playmaking2spelerid'] = $play2id[$k];
	    			
	    				}
	    				}
    				
    				}
    				
					//attack3 skill ophalen
					for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('voornaam, achternaam, shotpower,shotpower_tr, shotprecision, shotprecision_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $att3id[$k]);
	    			$attack3query = $this->db->get();
    				
    				if($attack3query->num_rows() == 0)
    				{
    					$thuisstats[$k]['attack3'] = 0;
    					$thuisstats[$k]['attack3speler'] = "playbalspeler";
    					$thuisstats[$k]['attack3spelerid'] = 0;
    				}else{
    			
	    				foreach($attack3query->result() as $row)
	    				{
	    				
	    						$shotpower = $row->shotpower;
	    						$shotpower_tr = $row->shotpower_tr;
	    						$shotprecision = $row->shotprecision;
	    						$shotprecision_tr = $row->shotprecision_tr;
	    					 	$thuisstats[$k]['attack3'] = $shotpower + $shotprecision.'.'.($shotprecision_tr + $shotpower_tr)/2;
	    					 	$thuisstats[$k]['attack3speler'] = $row->voornaam.' '.$row->achternaam;
	    						$thuisstats[$k]['attack3spelerid'] = $att3id[$k];
	    				}
	    				}
    				
    				}
    				
    				//attack4 skill ophalen
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('voornaam, achternaam, shotpower,shotpower_tr, shotprecision, shotprecision_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $att4id[$k]);
	    			$attack4query = $this->db->get();
    				
    				if($attack4query->num_rows() == 0)
    				{
    					$thuisstats[$k]['attack4'] = 0;
    					$thuisstats[$k]['attack4speler'] = "playbalspeler";
    						$thuisstats[$k]['attack4spelerid'] = 0;
    				}else{
    			
	    				foreach($attack4query->result() as $row)
	    				{
	    				
	    						$shotpower = $row->shotpower;
	    						$shotpower_tr = $row->shotpower_tr;
	    						$shotprecision = $row->shotprecision;
	    						$shotprecision_tr = $row->shotprecision_tr;
	    					 	$thuisstats[$k]['attack4'] = $shotpower + $shotprecision.'.'.($shotprecision_tr + $shotpower_tr)/2; //gedeeld door 2 omwille van dubbele skilloptelling
	    					 	$thuisstats[$k]['attack4speler'] = $row->voornaam.' '.$row->achternaam;
	    						$thuisstats[$k]['attack4spelerid'] = $att4id[$k];
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
    		
    		
    	//spelersprestaties ingeven voor thuisteam
			//reboundspeler
		$rebound1_th = $this->speler_stats($thuis[$i]['reboundspelerid'],$thuis[$i]['rebound'], 'rebound');
			//playmakingspeler
		$playmaking1_th = $this->speler_stats($thuis[$i]['playmakingspelerid'],$thuis[$i]['playmaking'], 'playmaking');
			//attack1
		$attack1_th = $this->speler_stats($thuis[$i]['attackspelerid'],$thuis[$i]['attack'], 'attack');
			//attack2
		$attack2_th = $this->speler_stats($thuis[$i]['attack2spelerid'],$thuis[$i]['attack2'], 'attack');
			//rebound2
		$rebound2_th = $this->speler_stats($thuis[$i]['rebound2spelerid'],$thuis[$i]['rebound2'], 'rebound');
			//playmaking2
		$playmaking2_th = $this->speler_stats($thuis[$i]['playmaking2spelerid'],$thuis[$i]['playmaking2'], 'playmaking');	
			//attack3
		$attack3_th = $this->speler_stats($thuis[$i]['attack3spelerid'],$thuis[$i]['attack3'], 'attack');		
			//attack4
		$attack4_th = $this->speler_stats($thuis[$i]['attack4spelerid'],$thuis[$i]['attack4'], 'attack');		
    	
    	
    	//spelersprestaties ingeven voor uitteam
			//reboundspeler
		$rebound1_uit = $this->speler_stats($uit[$i]['reboundspelerid'],$uit[$i]['rebound'], 'rebound');
			//playmakingspeler
		$playmaking1_uit = $this->speler_stats($uit[$i]['playmakingspelerid'],$uit[$i]['playmaking'], 'playmaking');
			//attack1
		$attack1_uit = $this->speler_stats($uit[$i]['attackspelerid'],$uit[$i]['attack'], 'attack');
			//attack2
		$attack2_uit = $this->speler_stats($uit[$i]['attack2spelerid'],$uit[$i]['attack2'], 'attack');
			//rebound2
		$rebound2_uit = $this->speler_stats($uit[$i]['rebound2spelerid'],$uit[$i]['rebound2'], 'rebound');
			//playmaking2
		$playmaking2_uit = $this->speler_stats($uit[$i]['playmaking2spelerid'],$uit[$i]['playmaking2'], 'playmaking');	
			//attack3
		$attack3_uit = $this->speler_stats($uit[$i]['attack3spelerid'],$uit[$i]['attack3'], 'attack');		
			//attack4
		$attack4_uit = $this->speler_stats($uit[$i]['attack4spelerid'],$uit[$i]['attack4'], 'attack');	
    		
    		//totaal opmaken adhv de sterkte/zwakte van de spelers
    		$thuistotaal = $rebound1_th + $playmaking1_th + $attack1_th + $attack2_th + $rebound2_th + $playmaking2_th + $attack3_th + $attack4_th;    		
    		$uittotaal = $rebound1_uit + $playmaking1_uit + $attack1_uit + $attack2_uit + $rebound2_uit + $playmaking2_uit + $attack3_uit + $attack4_uit; 

		// inititaliseren van variabelen voor het opslagen van de gegevens
		$uitslag['thuis'] = 0;
		$uitslag['uit'] = 0;
		$acties = '';
		$spelers = '';
		$tussenstand = '';
		$minuten = '';
		$prest_thuisteam = '';
		$prest_uitteam = '';
		$opst_thuisteam = '';
		$opst_uitteam = '';
		
		
		
		$opst_thuisteam .= $thuis[$i]['reboundspelerid'].';'.$thuis[$i]['playmakingspelerid'].';'.$thuis[$i]['attackspelerid'].';'.$thuis[$i]['attack2spelerid'].';'.$thuis[$i]['rebound2spelerid'].';'.$thuis[$i]['playmaking2spelerid'].';'.$thuis[$i]['attack3spelerid'].';'.$thuis[$i]['attack4spelerid'];
		
		$opst_uitteam .= $uit[$i]['reboundspelerid'].';'.$uit[$i]['playmakingspelerid'].';'.$uit[$i]['attackspelerid'].';'.$uit[$i]['attack2spelerid'].';'.$uit[$i]['rebound2spelerid'].';'.$uit[$i]['playmaking2spelerid'].';'.$uit[$i]['attack3spelerid'].';'.$uit[$i]['attack4spelerid'];

		
		$prest_thuisteam .= $rebound1_th.';'.$playmaking1_th.';'.$attack1_th.';'.$attack2_th.';'.$rebound2_th.';'.$playmaking2_th.';'.$attack3_th.';'.$attack4_th.';';
		$prest_uitteam .= $rebound1_uit.';'.$playmaking1_uit.';'.$attack1_uit.';'.$attack2_uit.';'.$rebound2_uit.';'.$playmaking2_uit.';'.$attack3_uit.';'.$attack4_uit.';';
		
		//in array steken om random speler te laten scoren
		$thuisspelerarray = array($thuis[$i]['attack2speler'],$thuis[$i]['attackspeler'],$thuis[$i]['attack3speler'],$thuis[$i]['attack4speler'],$thuis[$i]['reboundspeler'],$thuis[$i]['rebound2speler'],$thuis[$i]['playmakingspeler'],$thuis[$i]['playmaking2speler']);
		$uitspelerarray = array($uit[$i]['attack2speler'],$uit[$i]['attackspeler'],$uit[$i]['attack3speler'],$uit[$i]['attack4speler'],$uit[$i]['reboundspeler'],$uit[$i]['rebound2speler'],$uit[$i]['playmakingspeler'],$uit[$i]['playmaking2speler']);
		
		
		//id's opvragen om aantal goals te kunnen toevoegen
		$thuisspeleridarray = array($thuis[$i]['attack2spelerid'],$thuis[$i]['attackspelerid'],$thuis[$i]['attack3spelerid'],$thuis[$i]['attack4spelerid'],$thuis[$i]['reboundspelerid'],$thuis[$i]['rebound2spelerid'],$thuis[$i]['playmakingspelerid'],$thuis[$i]['playmaking2spelerid']);
		
		$uitspeleridarray = array($uit[$i]['attack2spelerid'],$uit[$i]['attackspelerid'],$uit[$i]['attack3spelerid'],$uit[$i]['attack4spelerid'],$uit[$i]['reboundspelerid'],$uit[$i]['rebound2spelerid'],$uit[$i]['playmakingspelerid'],$uit[$i]['playmaking2spelerid']);
		
		//doelpunten resetten van vorige wedstrijd
		foreach($thuisspeleridarray as $tspelerid){
			$this->reset_doelpunten_wedstrijd($tspelerid);
		
		}
		foreach($uitspeleridarray as $uspelerid){
			$this->reset_doelpunten_wedstrijd($uspelerid);
		
		}
		
		//matchacties en goals
		for($j=1;$j<60;$j++){
			$randkans1 = rand(0,2);
			$randmin1 = rand($j,$j+1);
			$randomspeler = rand(0,7);
			if($randkans1 == 1 || $randkans1 == 2){
					if($thuistotaal + rand(0,400) >= $uittotaal + rand(0,400))
					{
						$uitslag['thuis'] = $uitslag['thuis'] + 1;
						$minuten .= $randmin1.';';
						$acties .= rand(1,2).';';
						$spelers .= $thuisspelerarray[$randomspeler].';';
						$tussenstand .= $uitslag['thuis'].'-'.$uitslag['uit'].';';
						
						$this->update_doelpunten($thuisspeleridarray[$randomspeler]);
						
					}else{
						$uitslag['uit'] = $uitslag['uit'] + 1;
						$acties .= '1;';
						$spelers .= $uitspelerarray[$randomspeler].';';
						$tussenstand .= $uitslag['thuis'].'-'.$uitslag['uit'].';';
						$minuten .= $randmin1.';';
						
						$this->update_doelpunten($uitspeleridarray[$randomspeler]);
					
					}
			}

		
		}
		$this->wedstrijdinkomsten($thuisteamid); // enkel inkomsten voor het thuisteam
		$this->update_gespeeld($thuisteamid);
		$this->update_gespeeld($uitteamid);		
		
		//insert verslag
		$insert = array(
				'FK_wedstrijd_id' => $wedstrijdid,
				'minuten' => $minuten,
				'acties' => $acties,
				'spelers' => $spelers,
				'tussenstand' => $tussenstand,
				'prestaties_thuisteam' => $prest_thuisteam,
				'prestaties_uitteam' => $prest_uitteam,
				'opstelling_thuisteam' => $opst_thuisteam,
				'opstelling_uitteam' => $opst_uitteam,
				'thuisteam_id' => $thuisteamid,
				'uitteam_id' => $uitteamid
		);
			
		$this->db->insert('korf_verslagen', $insert);
		
		
			
						
		
		//gelijkstand
		if($uitslag['thuis'] == $uitslag['uit']){
		
			$this->update_gelijk($thuisteamid);
			$this->update_gelijk($uitteamid);
			
			$this->overwinningenOpRij($thuisteamid, 0);
			$this->overwinningenOpRij($uitteamid, 0);
			
			//haal de thuisteamgegevens op
			$tstats = $this->get_teamstats($thuisteamid);
			
			$thuisupdate = array(
				'gespeeld' => $tstats['gespeeld'] +1,
				'gelijk' => $tstats['gelijk'] + 1,
				'doelpunten_voor' => $tstats['voor'] + $uitslag['thuis'],
				'doelpunten_tegen' => $tstats['tegen'] + $uitslag['uit'], 
				'divisiepunten' => $tstats['punten'] + 1
			
			);
			
			$this->db->where('team_id', $thuisteamid);
			$this->db->update('korf_teams', $thuisupdate);
			
			//haal de uitteamgegevens op
			$ustats = $this->get_teamstats($uitteamid);

			$uitupdate = array(
				'gespeeld' => $ustats['gespeeld'] +1,
				'gelijk' => $ustats['gelijk'] + 1,
				'doelpunten_voor' => $ustats['voor'] + $uitslag['uit'],
				'doelpunten_tegen' => $ustats['tegen'] + $uitslag['thuis'], 
				'divisiepunten' => $ustats['punten'] + 1
			
			);
			
			$this->db->where('team_id', $uitteamid);
			$this->db->update('korf_teams', $uitupdate);
			
		}
		
		//thuisteam wint////////////////////////////
		if($uitslag['thuis'] > $uitslag['uit']){
		
		$this->update_gewonnen($thuisteamid);
		$this->update_verloren($uitteamid);
		
		$this->overwinningenOpRij($thuisteamid, 1);
		$this->overwinningenOpRij($uitteamid, 0);
		
	
			
			//haal de thuisteamgegevens op
			$tstats = $this->get_teamstats($thuisteamid);
			
			$thuisupdate = array(
				'gespeeld' => $tstats['gespeeld'] +1,
				'gewonnen' => $tstats['gewonnen'] + 1,
				'doelpunten_voor' => $tstats['voor'] + $uitslag['thuis'],
				'doelpunten_tegen' => $tstats['tegen'] + $uitslag['uit'], 
				'divisiepunten' => $tstats['punten'] + 2
			
			);
			
			$this->db->where('team_id', $thuisteamid);
			$this->db->update('korf_teams', $thuisupdate);
			
			//haal de uitteamgegevens op
			$ustats = $this->get_teamstats($uitteamid);

			$uitupdate = array(
				'gespeeld' => $ustats['gespeeld'] +1,
				'verloren' => $ustats['verloren'] + 1,
				'doelpunten_voor' => $ustats['voor'] + $uitslag['uit'],
				'doelpunten_tegen' => $ustats['tegen'] + $uitslag['thuis']
				
			
			);
			
			$this->db->where('team_id', $uitteamid);
			$this->db->update('korf_teams', $uitupdate);
		}
		
		//uitteam wint////////////////////////////
		if($uitslag['thuis'] < $uitslag['uit']){
		
		$this->update_gewonnen($uitteamid);
		$this->update_verloren($thuisteamid);
		
		$this->overwinningenOpRij($thuisteamid, 0);
		$this->overwinningenOpRij($uitteamid, 1);
		
			//haal de thuisteamgegevens op
			$tstats = $this->get_teamstats($thuisteamid);
			
			$thuisupdate = array(
				'gespeeld' => $tstats['gespeeld'] +1,
				'verloren' => $tstats['verloren'] + 1,
				'doelpunten_voor' => $tstats['voor'] + $uitslag['thuis'],
				'doelpunten_tegen' => $tstats['tegen'] + $uitslag['uit']
				
			
			);
			
			$this->db->where('team_id', $thuisteamid);
			$this->db->update('korf_teams', $thuisupdate);
			
			//haal de uitteamgegevens op
			$ustats = $this->get_teamstats($uitteamid);

			$uitupdate = array(
				'gespeeld' => $ustats['gespeeld'] +1,
				'gewonnen' => $ustats['gewonnen'] + 1,
				'doelpunten_voor' => $ustats['voor'] + $uitslag['uit'],
				'doelpunten_tegen' => $ustats['tegen'] + $uitslag['thuis'], 
				'divisiepunten' => $ustats['punten'] + 2
				
			
			);
			
			$this->db->where('team_id', $uitteamid);
			$this->db->update('korf_teams', $uitupdate);
			
		
		
		
		}

		$einduitslag = array(
			'uitslag' => $uitslag['thuis'].'-'.$uitslag['uit']
		
		);		
		
		$this->db->where('wedstrijd_id', $wedstrijdid);
		$this->db->update('korf_wedstrijden', $einduitslag);
		
		$this->send_message('', 'Wedstrijd', 'Uw team heeft een wedstrijd gespeeld, bekijk vlug het resultaat onder wedstrijden.',1, 'playb.al', $thuisteamid);
    	$this->send_message('', 'Wedstrijd', 'Uw team heeft een wedstrijd gespeeld, bekijk vlug het resultaat onder wedstrijden.',1, 'playb.al', $uitteamid);
    	
    	//achievements check
    	$this->load->model('achievements_model');
    	$this->achievements_model->aantal_matchen($thuisteamid);
    	$this->achievements_model->aantal_matchen($uitteamid);
    	
    	$this->achievements_model->aantal_overwinningen($thuisteamid);
    	$this->achievements_model->aantal_overwinningen($uitteamid);
		
    	}
    	
    	
    	
    }
    
    function speler_stats($id, $hoofdskill, $positie){
			if($id == 0){
				$prestatie = 0;
				return $prestatie;
				
			}else{
					//echo $thuis[$i]['rebound'];
			    $prestatie = ($hoofdskill*3.5)+rand(0, 10); //(rebound = 70%)(stamina=20%)(random factor = 10%) @TODO-> stamina ophalen
       				$this->db->where('FK_speler_id', $id);
				$statsquery = $this->db->get('korf_spelerstats');
				
				//als er nog geen entry bestaat == eerste wedstrijd voor deze speler
				if($statsquery->num_rows() == 0){
					$data = array(
						'FK_speler_id' => $id,
						'prestatie_laatste' => $prestatie,
						'prestatie_beste' =>$prestatie,
						'laatste_positie' => $positie
					
					);
					
					$this->db->insert('korf_spelerstats',$data);
				
				}else{
					foreach($statsquery->result() as $row){
						$beste = $row->prestatie_beste;
					}
						if($beste < $prestatie){
							$beste_final = $prestatie;
						}else{
							$beste_final = $beste;
						
						} 
					
					 
					$data = array(
						'prestatie_laatste' => $prestatie,
						'prestatie_beste' => $beste_final,
						'laatste_positie' => $positie
					
					);
					$this->db->where('FK_speler_id',$id);
					$this->db->update('korf_spelerstats', $data); 
				
					
				}
				return $prestatie;
			}

		
		}
		
		function get_teamstats($teamid){
			$this->db->select('gespeeld, gewonnen, divisiepunten, verloren, doelpunten_voor, doelpunten_tegen, gelijk');
			$this->db->from('korf_teams');
			$this->db->where('team_id', $teamid);
			$thuisteamquery = $this->db->get();
			
			foreach($thuisteamquery->result() as $row)
			{
				$stats['gespeeld'] = $row->gespeeld;
				$stats['verloren'] = $row->verloren;
				$stats['gewonnen'] = $row->gewonnen;
				$stats['voor'] = $row->doelpunten_voor;
				$stats['tegen'] = $row->doelpunten_tegen;
				$stats['punten'] = $row->divisiepunten;
				$stats['gelijk'] =$row->gelijk;
			
			}

			return $stats;
		}
		
		
		//update aantal gepseelde wedstrijden
		function update_gespeeld($teamid){
			$this->db->select('gespeeld_matchen');
			$this->db->from('korf_teamstats');
			$this->db->where('FK_team_id', $teamid);
			$query = $this->db->get();
			
			if($query->num_rows() != 0){
				foreach($query->result() as $row){
					$gespeeld = $row->gespeeld_matchen;
				}
			
				$update = array(
					'gespeeld_matchen' => $gespeeld+1,
				
				
				);
				
				$this->db->where('FK_team_id', $teamid);
				$this->db->update('korf_teamstats',$update);
			}

		
		
		}
		//update aantal gelijke wedstrijden
		function update_gelijk($teamid){
		
			$this->db->select('gelijke_matchen');
			$this->db->from('korf_teamstats');
			$this->db->where('FK_team_id', $teamid);
			$query = $this->db->get();
			
			if($query->num_rows() != 0){
				foreach($query->result() as $row){
					$gelijk = $row->gelijke_matchen;
				}
			
				$update = array(
					'gelijke_matchen' => $gelijk+1,
				
				
				);
				
				$this->db->where('FK_team_id', $teamid);
				$this->db->update('korf_teamstats',$update);
			}
		}
		//update aantal gewonnen wedstrijden
		function update_gewonnen($teamid){
		
			$this->db->select('gewonnen_matchen');
			$this->db->from('korf_teamstats');
			$this->db->where('FK_team_id', $teamid);
			$query = $this->db->get();
			
			if($query->num_rows() != 0){
				foreach($query->result() as $row){
					$gewonnen = $row->gewonnen_matchen;
				}
			
				$update = array(
					'gewonnen_matchen' => $gewonnen+1,
				
				
				);
				
				$this->db->where('FK_team_id', $teamid);
				$this->db->update('korf_teamstats',$update);
			}
		
		}
		//update aantal verloren wedstrijden
		function update_verloren($teamid){
			$this->db->select('verloren_matchen');
			$this->db->from('korf_teamstats');
			$this->db->where('FK_team_id', $teamid);
			$query = $this->db->get();
			
			if($query->num_rows() != 0){
				foreach($query->result() as $row){
					$verloren = $row->verloren_matchen;
				}
			
				$update = array(
					'verloren_matchen' => $verloren+1,
				
				
				);
				
				$this->db->where('FK_team_id', $teamid);
				$this->db->update('korf_teamstats',$update);
			}
		}
		
		
		function overwinningenOpRij($teamid, $boolean){
			if($boolean == 0){
				$update = array(
					'overwinningen_op_rij' => 0,
				);
				$this->db->where('FK_team_id', $teamid);
				$this->db->update('korf_teamstats',$update);
			
			}else{
				$this->db->select('overwinningen_op_rij');
				$this->db->from('korf_teamstats');
				$this->db->where('FK_team_id', $teamid);
				$query = $this->db->get();
				
				if($query->num_rows() != 0){
				foreach($query->result() as $row){
					$oprij = $row->overwinningen_op_rij;
				}
			
				$update = array(
					'overwinningen_op_rij' => $oprij+1,
				
				);
				
				$this->db->where('FK_team_id', $teamid);
				$this->db->update('korf_teamstats',$update);
			
				
			
			}
			
		}
	}
	
	function wedstrijdinkomsten($teamid){
		$this->db->select('*');
		$this->db->from('korf_stadion');
		$this->db->where('FK_team_id', $teamid);
		$query = $this->db->get();
		
		if($query->num_rows() != 0){
			foreach($query->result() as $row){
				$plaatsena = $row->plaatsen_a;
				$plaatsenb = $row->plaatsen_b;
				$plaatsenc = $row->plaatsen_c;
				$plaatsend = $row->plaatsen_d;
				$plaatsene = $row->plaatsen_e;
				$plaatsenf = $row->plaatsen_f;
				$plaatseng = $row->plaatsen_g;
				$plaatsenh = $row->plaatsen_h;
			}
		$totaalplaatsen = $plaatsena + $plaatsenb + $plaatsenc + $plaatsend + $plaatsene + $plaatsenf + $plaatseng + $plaatsenh;
		
		$inkomsten = 15 * (rand($totaalplaatsen-800, $totaalplaatsen)); // random aantal toeschouwers per wedstrijd
		
		$cron = $this->db->get('korf_cron');
		
		foreach($cron->result() as $crow){
			$week = $crow->week;
			$seizoen = $crow->seizoen;
		}
		
		$update = array(
			'wedstrijdinkomsten' => $inkomsten,
		
		);
		
		$this->db->where('FK_team_id', $teamid);
		$this->db->where('week', $week);
		$this->db->where('seizoen', $seizoen);
		$this->db->update('korf_financien', $update);
		
		}
	
	}
	
	function reset_doelpunten_wedstrijd($spelerid)
	{
		$this->db->select('aantal_matchen');
		$this->db->from('korf_spelerstats');
		$this->db->where('FK_speler_id', $spelerid);
		$query = $this->db->get();
		
		$matchen = 0;
		foreach($query->result() as $row){
			$matchen = $row->aantal_matchen;
		}
	
		$update = array(
			'goals_wedstrijd' => 0,
			'aantal_matchen' => $matchen + 1,
			
		);
	
		$this->db->where('FK_speler_id', $spelerid);
		$this->db->update('korf_spelerstats', $update);
	}
	
	
	function update_doelpunten($spelerid)
	{
		$this->db->select('goals_carriere, goals_seizoen, goals_wedstrijd');
		$this->db->from('korf_spelerstats');
		$this->db->where('FK_speler_id', $spelerid);
		$query = $this->db->get();
		
		$carriere = 0;
		$seizoen = 0;
		$wedstrijd = 0;
		
		foreach($query->result() as $row){
			$carriere = $row->goals_carriere;
			$seizoen = $row->goals_seizoen;
			$wedstrijd = $row->goals_wedstrijd;
		}
		
		$update = array(
			'goals_carriere' => $carriere + 1,
			'goals_seizoen' => $seizoen + 1,
			'goals_wedstrijd' => $wedstrijd +1,
		
		);
	
		$this->db->where('FK_speler_id', $spelerid);
		$this->db->update('korf_spelerstats', $update);
		
	
	}
}
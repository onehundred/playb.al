<?php class Training_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    
    function check_energie($teamid)
    {
    
    	$this->db->select('energie');
    	$this->db->where('team_id',$teamid);
    	$query = $this->db->get('korf_teams');
    	
    	foreach($query->result() as $row)
    	{
    		$energie = $row->energie;
    	
    	}

    	if($energie >= 30){
    		return true;
    	
    	} 
    	else{
    		return false;
    	
    	}
    	
    	    
    }
    
    function adjust_energie($teamid)
    {
    	$this->db->select('energie');
    	$this->db->where('team_id',$teamid);
    	$query = $this->db->get('korf_teams');
    	
    	foreach($query->result() as $row)
    	{
    		$energie = $row->energie;
    	
    	}
    	
    	
    	$updateenergie = $energie -30;
    	
    	
    	$update = array(
    		'energie' => $updateenergie
    	
    	);
    	
    	$this->db->where('team_id', $teamid);
    	$this->db->update('korf_teams', $update);
    
    }
    
    
    //passing
    function train_passing($teamid)
    {
    	$this->db->select('passing_tr, passing, skill_id, training_id, voornaam, achternaam');
    	$this->db->from('korf_training');
    	$this->db->join('korf_skills', 'FK_skill_id = skill_id');
    	$this->db->join('korf_spelers', 'FK_player_id = speler_id');
    	$this->db->join('korf_teams', 'FK_team_id = team_id');
    	$this->db->where('team_id', $teamid);
    	$query = $this->db->get();
    	
    	
    	$trainingsarray = array();
    	$i =1;
    	foreach($query->result() as $row){
    		$voornaam = $row->voornaam;
    		$achternaam = $row->achternaam;
    		$trainingid = $row->training_id;
    		//echo $trainingid;
    		$skillid = $row->skill_id;
    		//echo "id=".$skillid;
    		$passing_tr =  $row->passing_tr;
    		$rand = rand(20, 50);
    		$updatepassing_tr = $passing_tr + $rand;
    		
    		$passing = $row->passing; 
    		$updatepassing = $passing + 1;
    		//echo "passing=".$updatepassing; 
    		 
    		 
    		$trainingsarray[$i]['naam'] = $voornaam." ".$achternaam;
    		  		
    		if($updatepassing_tr >= 1000){
    			$updatepassing = $passing + 1;
    			$update = array(
    				'passing' => $updatepassing
    			
    			);
    			
    			$this->db->where('skill_id', $skillid);
    			$this->db->update('korf_skills',$update);
    			
    			
    			$update2 = array(
    				'passing_tr' => 0
    			
    			);
    			
    			$this->db->where('training_id', $trainingid);
    			$this->db->update('korf_training',$update2);
    		
    			$trainingsarray[$i]['niveau'] = $updatepassing;
    		}else{
    			
    			$update = array(
    				'passing_tr' => $updatepassing_tr
    			
    			);
    			
    			$this->db->where('training_id', $trainingid);
    			$this->db->update('korf_training',$update);
    			
    			$trainingsarray[$i]['gestegen'] = $rand;
    			$trainingsarray[$i]['totaal'] = $updatepassing_tr;
    		
    		}
    		$i++;
    	
    
    	}
    	
    	return $trainingsarray;
    
    }
    
    //stamina
    function train_stamina($teamid)
    {
    	$this->db->select('stamina_tr, stamina, skill_id, training_id, voornaam, achternaam');
    	$this->db->from('korf_training');
    	$this->db->join('korf_skills', 'FK_skill_id = skill_id');
    	$this->db->join('korf_spelers', 'FK_player_id = speler_id');
    	$this->db->join('korf_teams', 'FK_team_id = team_id');
    	$this->db->where('team_id', $teamid);
    	$query = $this->db->get();
    	
    	
    	$trainingsarray = array();
    	$i =1;
    	foreach($query->result() as $row){
    		$voornaam = $row->voornaam;
    		$achternaam = $row->achternaam;
    		$trainingid = $row->training_id;
    		//echo $trainingid;
    		$skillid = $row->skill_id;
    		//echo "id=".$skillid;
    		$stamina_tr =  $row->stamina_tr;
    		$rand = rand(20, 50);
    		$updatestamina_tr = $stamina_tr + $rand;
    		
    		$stamina = $row->stamina; 
    		$updatestamina = $stamina + 1;
    		//echo "passing=".$updatepassing; 
    		 
    		 
    		$trainingsarray[$i]['naam'] = $voornaam." ".$achternaam;
    		  		
    		if($updatestamina_tr >= 1000){
    			$updatestamina = $stamina+ 1;
    			$update = array(
    				'stamina' => $updatestamina
    			
    			);
    			
    			$this->db->where('skill_id', $skillid);
    			$this->db->update('korf_skills',$update);
    			
    			
    			$update2 = array(
    				'stamina_tr' => 0
    			
    			);
    			
    			$this->db->where('training_id', $trainingid);
    			$this->db->update('korf_training',$update2);
    		
    			$trainingsarray[$i]['niveau'] = $updatestamina;
    		}else{
    			
    			$update = array(
    				'stamina_tr' => $updatestamina_tr
    			
    			);
    			
    			$this->db->where('training_id', $trainingid);
    			$this->db->update('korf_training',$update);
    			
    			$trainingsarray[$i]['gestegen'] = $rand;
    			$trainingsarray[$i]['totaal'] = $updatestamina_tr;
    		
    		}
    		$i++;
    	
    
    	}
    	
    	return $trainingsarray;

    
    }
    
    //shotpower
    function train_shotpower($teamid){
    	    	$this->db->select('shotpower_tr, shotpower, skill_id, training_id, voornaam, achternaam');
    	$this->db->from('korf_training');
    	$this->db->join('korf_skills', 'FK_skill_id = skill_id');
    	$this->db->join('korf_spelers', 'FK_player_id = speler_id');
    	$this->db->join('korf_teams', 'FK_team_id = team_id');
    	$this->db->where('team_id', $teamid);
    	$query = $this->db->get();
    	
    	
    	$trainingsarray = array();
    	$i =1;
    	foreach($query->result() as $row){
    		$voornaam = $row->voornaam;
    		$achternaam = $row->achternaam;
    		$trainingid = $row->training_id;
    		//echo $trainingid;
    		$skillid = $row->skill_id;
    		//echo "id=".$skillid;
    		$shotpower_tr =  $row->shotpower_tr;
    		$rand = rand(20, 50);
    		$updateshotpower_tr = $shotpower_tr + $rand;
    		
    		$shotpower = $row->shotpower; 
    		$updateshotpower = $shotpower + 1;
    		//echo "passing=".$updatepassing; 
    		 
    		 
    		$trainingsarray[$i]['naam'] = $voornaam." ".$achternaam;
    		  		
    		if($updateshotpower_tr >= 1000){
    			$updateshotpower = $shotpower+ 1;
    			$update = array(
    				'shotpower' => $updateshotpower
    			
    			);
    			
    			$this->db->where('skill_id', $skillid);
    			$this->db->update('korf_skills',$update);
    			
    			
    			$update2 = array(
    				'shotpower_tr' => 0
    			
    			);
    			
    			$this->db->where('training_id', $trainingid);
    			$this->db->update('korf_training',$update2);
    		
    			$trainingsarray[$i]['niveau'] = $updateshotpower;
    		}
    		else{
    			
    			$update = array(
    				'shotpower_tr' => $updateshotpower_tr
    			
    			);
    			
    			$this->db->where('training_id', $trainingid);
    			$this->db->update('korf_training',$update);
    			
    			$trainingsarray[$i]['gestegen'] = $rand;
    			$trainingsarray[$i]['totaal'] = $updateshotpower_tr;
    		
    		}

    		$i++;
    	
    
    	}
    	
    	return $trainingsarray;
    	
    
    }
    
    //shotprecision
    function train_shotprecision($teamid)
    {
    	$this->db->select('shotprecision_tr, shotprecision, skill_id, training_id, voornaam, achternaam');
    	$this->db->from('korf_training');
    	$this->db->join('korf_skills', 'FK_skill_id = skill_id');
    	$this->db->join('korf_spelers', 'FK_player_id = speler_id');
    	$this->db->join('korf_teams', 'FK_team_id = team_id');
    	$this->db->where('team_id', $teamid);
    	$query = $this->db->get();
    	
    	
    	$trainingsarray = array();
    	$i =1;
    	foreach($query->result() as $row){
    		$voornaam = $row->voornaam;
    		$achternaam = $row->achternaam;
    		$trainingid = $row->training_id;
    		//echo $trainingid;
    		$skillid = $row->skill_id;
    		//echo "id=".$skillid;
    		$shotprecision_tr =  $row->shotprecision_tr;
    		$rand = rand(20, 50);
    		$updateshotprecision_tr = $shotprecision_tr + $rand;
    		
    		$shotprecision = $row->shotprecision; 
    		$updateshotprecision = $shotprecision + 1;
    		//echo "passing=".$updatepassing; 
    		 
    		 
    		$trainingsarray[$i]['naam'] = $voornaam." ".$achternaam;
    		  		
    		if($updateshotprecision_tr >= 1000){
    			$updateshotprecision = $shotprecision+ 1;
    			$update = array(
    				'shotprecision' => $updateshotprecision
    			
    			);
    			
    			$this->db->where('skill_id', $skillid);
    			$this->db->update('korf_skills',$update);
    			
    			
    			$update2 = array(
    				'shotprecision_tr' => 0
    			
    			);
    			
    			$this->db->where('training_id', $trainingid);
    			$this->db->update('korf_training',$update2);
    		
    			$trainingsarray[$i]['niveau'] = $updateshotprecision;
    		}else{
    			
    			$update = array(
    				'shotprecision_tr' => $updateshotprecision_tr
    			
    			);
    			
    			$this->db->where('training_id', $trainingid);
    			$this->db->update('korf_training',$update);
    			
    			$trainingsarray[$i]['gestegen'] = $rand;
    			$trainingsarray[$i]['totaal'] = $updateshotprecision_tr;
    		
    		}
    		$i++;
    	
    
    	}
    	
    	return $trainingsarray;
    	

    	
    }
    
    //intercepting
    function train_intercepting($teamid)
    {	
    	 	$this->db->select('intercepting_tr, intercepting, skill_id, training_id, voornaam, achternaam');
    	$this->db->from('korf_training');
    	$this->db->join('korf_skills', 'FK_skill_id = skill_id');
    	$this->db->join('korf_spelers', 'FK_player_id = speler_id');
    	$this->db->join('korf_teams', 'FK_team_id = team_id');
    	$this->db->where('team_id', $teamid);
    	$query = $this->db->get();
    	
    	
    	$trainingsarray = array();
    	$i =1;
    	foreach($query->result() as $row){
    		$voornaam = $row->voornaam;
    		$achternaam = $row->achternaam;
    		$trainingid = $row->training_id;
    		//echo $trainingid;
    		$skillid = $row->skill_id;
    		//echo "id=".$skillid;
    		$intercepting_tr =  $row->intercepting_tr;
    		$rand = rand(20, 50);
    		$updateintercepting_tr = $intercepting_tr + $rand;
    		
    		$intercepting = $row->intercepting; 
    		$updateintercepting = $intercepting + 1;
    		//echo "passing=".$updatepassing; 
    		 
    		 
    		$trainingsarray[$i]['naam'] = $voornaam." ".$achternaam;
    		  		
    		if($updateintercepting_tr >= 1000){
    			$updateintercepting = $intercepting+ 1;
    			$update = array(
    				'intercepting' => $updateintercepting
    			
    			);
    			
    			$this->db->where('skill_id', $skillid);
    			$this->db->update('korf_skills',$update);
    			
    			
    			$update2 = array(
    				'intercepting_tr' => 0
    			
    			);
    			
    			$this->db->where('training_id', $trainingid);
    			$this->db->update('korf_training',$update2);
    		
    			$trainingsarray[$i]['niveau'] = $updateintercepting;
    		}else{
    			
    			$update = array(
    				'intercepting_tr' => $updateintercepting_tr
    			
    			);
    			
    			$this->db->where('training_id', $trainingid);
    			$this->db->update('korf_training',$update);
    			
    			$trainingsarray[$i]['gestegen'] = $rand;
    			$trainingsarray[$i]['totaal'] = $updateintercepting_tr;
    		
    		}
    		$i++;
    	
    
    	}
    	
    	return $trainingsarray;
    
    }
    
    //rebound
    function train_rebound($teamid)
    {
     	$this->db->select('rebound_tr, rebound, skill_id, training_id, voornaam, achternaam');
    	$this->db->from('korf_training');
    	$this->db->join('korf_skills', 'FK_skill_id = skill_id');
    	$this->db->join('korf_spelers', 'FK_player_id = speler_id');
    	$this->db->join('korf_teams', 'FK_team_id = team_id');
    	$this->db->where('team_id', $teamid);
    	$query = $this->db->get();
    	
    	
    	$trainingsarray = array();
    	$i =1;
    	foreach($query->result() as $row){
    		$voornaam = $row->voornaam;
    		$achternaam = $row->achternaam;
    		$trainingid = $row->training_id;
    		//echo $trainingid;
    		$skillid = $row->skill_id;
    		//echo "id=".$skillid;
    		$rebound_tr =  $row->rebound_tr;
    		$rand = rand(20, 50);
    		$updaterebound_tr = $rebound_tr + $rand;
    		
    		$rebound = $row->rebound; 
    		$updaterebound = $rebound + 1;
    		//echo "passing=".$updatepassing; 
    		 
    		 
    		$trainingsarray[$i]['naam'] = $voornaam." ".$achternaam;
    		  		
    		if($updaterebound_tr >= 1000){
    			$updaterebound = $rebound+ 1;
    			$update = array(
    				'rebound' => $updaterebound
    			
    			);
    			
    			$this->db->where('skill_id', $skillid);
    			$this->db->update('korf_skills',$update);
    			
    			
    			$update2 = array(
    				'rebound_tr' => 0
    			
    			);
    			
    			$this->db->where('training_id', $trainingid);
    			$this->db->update('korf_training',$update2);
    		
    			$trainingsarray[$i]['niveau'] = $updaterebound;
    		}else{
    			
    			$update = array(
    				'rebound_tr' => $updaterebound_tr
    			
    			);
    			
    			$this->db->where('training_id', $trainingid);
    			$this->db->update('korf_training',$update);
    			
    			$trainingsarray[$i]['gestegen'] = $rand;
    			$trainingsarray[$i]['totaal'] = $updaterebound_tr;
    		
    		}
    		$i++;
    	
    
    	}
    	
    	return $trainingsarray;
    
    
    }
    
    
    //playmaking
    function train_playmaking($teamid)
    {
     	$this->db->select('playmaking_tr, playmaking, skill_id, training_id, voornaam, achternaam');
    	$this->db->from('korf_training');
    	$this->db->join('korf_skills', 'FK_skill_id = skill_id');
    	$this->db->join('korf_spelers', 'FK_player_id = speler_id');
    	$this->db->join('korf_teams', 'FK_team_id = team_id');
    	$this->db->where('team_id', $teamid);
    	$query = $this->db->get();
    	
    	
    	$trainingsarray = array();
    	$i =1;
    	foreach($query->result() as $row){
    		$voornaam = $row->voornaam;
    		$achternaam = $row->achternaam;
    		$trainingid = $row->training_id;
    		//echo $trainingid;
    		$skillid = $row->skill_id;
    		//echo "id=".$skillid;
    		$playmaking_tr =  $row->playmaking_tr;
    		$rand = rand(20, 50);
    		$updateplaymaking_tr = $playmaking_tr + $rand;
    		
    		$playmaking = $row->playmaking; 
    		$updateplaymaking = $playmaking + 1;
    		//echo "passing=".$updatepassing; 
    		 
    		 
    		$trainingsarray[$i]['naam'] = $voornaam." ".$achternaam;
    		  		
    		if($updateplaymaking_tr >= 1000){
    			$updateplaymaking = $playmaking+ 1;
    			$update = array(
    				'playmaking' => $updateplaymaking
    			
    			);
    			
    			$this->db->where('skill_id', $skillid);
    			$this->db->update('korf_skills',$update);
    			
    			
    			$update2 = array(
    				'playmaking_tr' => 0
    			
    			);
    			
    			$this->db->where('training_id', $trainingid);
    			$this->db->update('korf_training',$update2);
    		
    			$trainingsarray[$i]['niveau'] = $updateplaymaking;
    		}else{
    			
    			$update = array(
    				'playmaking_tr' => $updateplaymaking_tr
    			
    			);
    			
    			$this->db->where('training_id', $trainingid);
    			$this->db->update('korf_training',$update);
    			
    			$trainingsarray[$i]['gestegen'] = $rand;
    			$trainingsarray[$i]['totaal'] = $updateplaymaking_tr;
    		
    		}
    		$i++;
    	
    
    	}
    	
    	return $trainingsarray;
    
    
    }
 }   
<?php class Achievements_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    //1 match gespeeld
    function eerste_match($teamid)
    {
    
    	$this->db->where('FK_team_id', $teamid);
    	$query = $this->db->get('korf_teamstats');
    	
    	foreach($query->result() as $row){
    		$aantal_matchen = $row->gespeeld_matchen;
    	
    	}
    	
    	if($aantal_matchen == 1){   
    	
    		$this->db->select('naam');
    		$this->db->from('korf_teams');
    		$this->db->where('team_id', $teamid);
    		$naamquery = $this->db->get(); 
    		
    		foreach($naamquery->result() as $row)
    		{
    			$naam = $row->naam;
    		}	
    		
    		$this->db->select('naam');
    		$this->db->from('korf_achievements');
    		$this->db->where('achievement_id', 1);
    		$aquery = $this->db->get(); 
    		
    		foreach($aquery->result() as $row)
    		{
    			$anaam = $row->naam;
    		}
    			
    		$insert = array(
    			'FK_team_id' => $teamid,
    			'FK_achievements_id' => 1
    		);
    		
    		$bericht = "Gefeliciteerd u heeft de achievement:".$anaam." verkregen!";
    		
    		$this->db->insert('korf_team_achievements', $insert);
    		
    		$bericht = array(
    			'verzender' => 'playb.al',
    			'ontvanger' => $naam,
    			'onderwerp' => 'Achievement',
    			'bericht' => $bericht,
    			'categorie' => 1
    		
    		);
    		
    		$this->db->insert('korf_berichten', $bericht);
    	}
    	
    }
    
    
    //10 matchen gespeeld
    function tien_matchen($teamid)
    {
    	$this->db->where('FK_team_id', $teamid);
    	$query = $this->db->get('korf_teamstats');
    	
    	foreach($query->result() as $row){
    		$aantal_matchen = $row->gespeeld_matchen;
    	
    	}
    	
    	if($aantal_matchen == 10){   
    	
    		$this->db->select('naam');
    		$this->db->from('korf_teams');
    		$this->db->where('team_id', $teamid);
    		$naamquery = $this->db->get(); 
    		
    		foreach($naamquery->result() as $row)
    		{
    			$naam = $row->naam;
    		}	
    		
    		$this->db->select('naam');
    		$this->db->from('korf_achievements');
    		$this->db->where('achievement_id', 2);
    		$aquery = $this->db->get(); 
    		
    		foreach($aquery->result() as $row)
    		{
    			$anaam = $row->naam;
    		}
    			
    		$insert = array(
    			'FK_team_id' => $teamid,
    			'FK_achievements_id' => 2
    		);
    		
    		$bericht = "Gefeliciteerd u heeft de achievement:".$anaam." verkregen!";
    		
    		$this->db->insert('korf_team_achievements', $insert);
    		
    		$bericht = array(
    			'verzender' => 'playb.al',
    			'ontvanger' => $naam,
    			'onderwerp' => 'Achievement',
    			'bericht' => $bericht,
    			'categorie' => 1
    		
    		);
    		
    		$this->db->insert('korf_berichten', $bericht);
    	}

    
    }
    
    //25 matchen gespeeld
    function vijfentwintig_matchen($teamid)
    {
    	$this->db->where('FK_team_id', $teamid);
    	$query = $this->db->get('korf_teamstats');
    	
    	foreach($query->result() as $row){
    		$aantal_matchen = $row->gespeeld_matchen;
    	
    	}
    	
    	if($aantal_matchen == 25){   
    	
    		$this->db->select('naam');
    		$this->db->from('korf_teams');
    		$this->db->where('team_id', $teamid);
    		$naamquery = $this->db->get(); 
    		
    		foreach($naamquery->result() as $row)
    		{
    			$naam = $row->naam;
    		}	
    		
    		$this->db->select('naam');
    		$this->db->from('korf_achievements');
    		$this->db->where('achievement_id', 3);
    		$aquery = $this->db->get(); 
    		
    		foreach($aquery->result() as $row)
    		{
    			$anaam = $row->naam;
    		}
    			
    		$insert = array(
    			'FK_team_id' => $teamid,
    			'FK_achievements_id' => 3
    		);
    		
    		$bericht = "Gefeliciteerd u heeft de achievement:".$anaam." verkregen!";
    		
    		$this->db->insert('korf_team_achievements', $insert);
    		
    		$bericht = array(
    			'verzender' => 'playb.al',
    			'ontvanger' => $naam,
    			'onderwerp' => 'Achievement',
    			'bericht' => $bericht,
    			'categorie' => 1
    		
    		);
    		
    		$this->db->insert('korf_berichten', $bericht);
    	}
      }

      //50 matchen gespeeld
      function vijftig_matchen($teamid){
      	$this->db->where('FK_team_id', $teamid);
    	$query = $this->db->get('korf_teamstats');
    	
    	foreach($query->result() as $row){
    		$aantal_matchen = $row->gespeeld_matchen;
    	
    	}
    	
    	if($aantal_matchen == 50){   
    	
    		$this->db->select('naam');
    		$this->db->from('korf_teams');
    		$this->db->where('team_id', $teamid);
    		$naamquery = $this->db->get(); 
    		
    		foreach($naamquery->result() as $row)
    		{
    			$naam = $row->naam;
    		}	
    		
    		$this->db->select('naam');
    		$this->db->from('korf_achievements');
    		$this->db->where('achievement_id', 4);
    		$aquery = $this->db->get(); 
    		
    		foreach($aquery->result() as $row)
    		{
    			$anaam = $row->naam;
    		}
    			
    		$insert = array(
    			'FK_team_id' => $teamid,
    			'FK_achievements_id' => 5
    		);
    		
    		$bericht = "Gefeliciteerd u heeft de achievement:".$anaam." verkregen!";
    		
    		$this->db->insert('korf_team_achievements', $insert);
    		
    		$bericht = array(
    			'verzender' => 'playb.al',
    			'ontvanger' => $naam,
    			'onderwerp' => 'Achievement',
    			'bericht' => $bericht,
    			'categorie' => 1
    		
    		);
    		
    		$this->db->insert('korf_berichten', $bericht);
    	}
      
      }
      
      //100 matchen gespeeld
      function honderd_matchen($teamid){
      	$this->db->where('FK_team_id', $teamid);
    	$query = $this->db->get('korf_teamstats');
    	
    	foreach($query->result() as $row){
    		$aantal_matchen = $row->gespeeld_matchen;
    	
    	}
    	
    	if($aantal_matchen == 100){   
    	
    		$this->db->select('naam');
    		$this->db->from('korf_teams');
    		$this->db->where('team_id', $teamid);
    		$naamquery = $this->db->get(); 
    		
    		foreach($naamquery->result() as $row)
    		{
    			$naam = $row->naam;
    		}	
    		
    		$this->db->select('naam');
    		$this->db->from('korf_achievements');
    		$this->db->where('achievement_id', 5);
    		$aquery = $this->db->get(); 
    		
    		foreach($aquery->result() as $row)
    		{
    			$anaam = $row->naam;
    		}
    			
    		$insert = array(
    			'FK_team_id' => $teamid,
    			'FK_achievements_id' => 5
    		);
    		
    		$bericht = "Gefeliciteerd u heeft de achievement:".$anaam." verkregen!";
    		
    		$this->db->insert('korf_team_achievements', $insert);
    		
    		$bericht = array(
    			'verzender' => 'playb.al',
    			'ontvanger' => $naam,
    			'onderwerp' => 'Achievement',
    			'bericht' => $bericht,
    			'categorie' => 1
    		
    		);
    		
    		$this->db->insert('korf_berichten', $bericht);
    	}
      }
}    
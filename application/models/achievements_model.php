<?php class Achievements_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
   	function get_teamnaam($teamid){
		$this->db->select('naam');
		$this->db->from('korf_teams');
		$this->db->where('team_id', $teamid);
		$naamquery = $this->db->get(); 
		
		foreach($naamquery->result() as $row)
		{
			$naam = $row->naam;
		}	
		
		return $naam;
	}
   	
   	function complete_achievement($teamid, $naam, $anumber)
   	{
   		//achievementnaam ophalen om mee te sturen met bericht
   			if($anumber != 0){
   		
    		$this->db->select('naam');
    		$this->db->from('korf_achievements');
    		$this->db->where('achievement_id', $anumber);
    		$aquery = $this->db->get(); 
    		
    		foreach($aquery->result() as $row)
    		{
    			$anaam = $row->naam;
    		}
    			
    		$insert = array(
    			'FK_team_id' => $teamid,
    			'FK_achievements_id' => $anumber
    		);
    		$this->db->insert('korf_team_achievements', $insert);
    		
    		$bericht = "Gefeliciteerd u heeft de achievement:".$anaam." verkregen!";
    		
    		$mdate =  date('Y-m-d h:i:s');
    		$bericht_insert = array(
    			'verzender' => 'playb.al',
    			'ontvanger' => $naam,
    			'onderwerp' => 'Achievement',
    			'bericht' => $bericht,
    			'categorie' => 1,
    			'datum' => $mdate, 
    			'status' => 0,
    		
    		);
    		
    		$this->db->insert('korf_berichten', $bericht_insert);
    	}	
	}
   
    function aantal_matchen($teamid)
    {
    	$anumber = 0;
    	$this->db->where('FK_team_id', $teamid);
    	$query = $this->db->get('korf_teamstats');
    	
    	
    	
    	if($query->num_rows() != 0){
	    	foreach($query->result() as $row){
	    		$aantal_matchen = $row->gespeeld_matchen;
	    	}
	    	
	    		 //1 match gespeeld
	    	if($aantal_matchen == 1){ 
	    		$anumber = 1;
	    	}
	    	if($aantal_matchen == 10){
	    		$anumber = 2;
	    	}
	    	if($aantal_matchen == 25){
	    		$anumber == 3;
	    	}
	    	if($aantal_matchen == 50){
	    		$anumber == 4;
	    	}
	    	if($aantal_matchen == 100){
	    		$anumber == 5;
	    	}
	    	  
	    	//teamnaam ophalen om het bericht te versturen 
	    	$naam = $this->get_teamnaam($teamid);
	    		
	    	$this->complete_achievement($teamid, $naam, $anumber);	
    	}	
  }
    
  function aantal_overwinningen($teamid)
  {
    //TODO - check if the team has allready has this achievement
    	$anumber = 0;
    	
    	$this->db->where('FK_team_id', $teamid);
    	$query = $this->db->get('korf_teamstats');
    	
    	if($query->num_rows() != 0){
	    	foreach($query->result() as $row){
	    		$gewonnen_matchen = $row->gewonnen_matchen;
	    	}
	    	
	    	if($gewonnen_matchen == 1){
	    		$anumber = 6;
	    	}
	    	if($gewonnen_matchen == 3){
	    		$anumber = 7;
	    	}
	    	
	    	//teamnaam ophalen om het bericht te versturen 
	    	$naam = $this->get_teamnaam($teamid);
	    		
	    	$this->complete_achievement($teamid, $naam, $anumber);	
    	}
    }
    
    //kan uitgebreid worden tot meeer achievements voor meer transfers
    function aantal_transfers($teamid){
    	//checken of achievement al behaald is -> array en dan check_in array
    	$anumber = 0;
    
    	$this->db->where('FK_team_id', $teamid);
    	$query = $this->db->get('korf_teamstats');
    	
    	foreach($query->result() as $row){
    		$verkocht = $row->verkochte_spelers;
    		$gekocht = $row->gekochte_spelers;
    	}
    	
    	$totaal = $verkocht + $gekocht;
    	
    	$time = date("H:i:s");
    	
    	
    	if($totaal == 1){
    		$anumber = 8;
    	}
    	//nachtbraker
    	if($time > '24:00:00'){
    		$anumber = 9;
    	}
    	//early bird
    	if($time > '04:00:00' && $time < '08:00:00'){
    		$anumber = 10;
    	}
    	
    	$naam = $this->get_teamnaam($teamid);
    	$this->complete_achievement($teamid, $naam, $anumber);
    }
}    
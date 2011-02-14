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
    	$query = $this->db->get();
    	return $query;
    	
    
    }
    
    
    function get_matches($team_id)
    {
    
    
    $this->db->where('team_id',$team_id);
    $quer = $this->db->get('korf_teams');
    
    
    foreach($quer->result() as $row)
    {
    	$team = $row->naam;
    
    }
    
    $this->db->where('thuisteam', $team);
    $this->db->or_where('bezoekersteam', $team);
    $query = $this->db->get('korf_wedstrijden');
    return $query;
    
    
    }
    
    
    function insert_opstelling($field,$spelernaam,$teamid)
    {
    
    
    $this->db->select('FK_team_id');
    $this->db->where('FK_team_id', $teamid);
    $query = $this->db->get('korf_opstelling');
    
    if($query->num_rows == 0)
    {
    	$insert = array(
    		$field => $spelernaam,
    		'FK_team_id' => $teamid,
    		
    	
    	
    	);
    	
    	
    	$this->db->insert('korf_opstelling', $insert);
    
    }
    else{
    	$update = array(
			$field => $spelernaam,
			
		
		);
		
		
		$this->db->where('FK_team_id', $teamid);
		$this->db->update('korf_opstelling', $update);
    	}
    
    }
    
    
   
    
    
}
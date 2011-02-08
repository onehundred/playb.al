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
    
    
   
    
    
}
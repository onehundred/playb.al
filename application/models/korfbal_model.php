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
    
    
   
    
    
}
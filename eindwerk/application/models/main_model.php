<?php class Main_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    
    function validate()
    {
    	$this->db->where('gebruikersnaam', $this->input->post('username'));
    	
    	
    	$this->db->where('paswoord', md5($this->input->post('password')));
    	
    	$query = $this->db->get('users');
    	
    	
    	if($query->num_rows==1)
    	{
    			return true;
    	}
    
    }
			
			
    
    
}
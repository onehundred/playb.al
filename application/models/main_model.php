<?php class Main_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    
    function validate()
    {
    	$this->db->where('gebruikersnaam', $this->input->post('username'));
    	$this->db->where('paswoord', md5($this->input->post('password')));
    	
    	$query1 = $this->db->get('users');
    	
    	
    	if($query1->num_rows==1)
    	{
    			return true;
    	}
    	
    	$this->db->where('email', $this->input->post('username'));
    	$this->db->where('paswoord', md5($this->input->post('password')));
    	
    	$query2 = $this->db->get('users');
    	
    	if($query2->num_rows==1)
    	{
    			return true;
    	}

    
    }
    
    
    function create_user()
    {
    	

		$mdate =  date('Y-m-d h:i:s');
		
    	$new_user_insert_data = array(
    		'voornaam' => $this->input->post('voornaam'),
    		'achternaam' => $this->input->post('achternaam'),
    		'email' => $this->input->post('email'),
    		'land' => $this->input->post('land'),
    		'gebruikersnaam' => $this->input->post('username'),
    		
    		'paswoord' => md5($this->input->post('paswoord')),
    		'datum_creatie' => $mdate
    	
    	);
    	
    	$insert = $this->db->insert('users', $new_user_insert_data);
    	return $insert;
    
    }
			
			
    
    
}
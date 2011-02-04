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
    
    
    function create_user()
    {
    	$new_user_insert_data = array(
    		'voornaam' => $this->input->post('voornaam'),
    		'achternaam' => $this->input->post('achternaam'),
    		'email' => $this->input->post('email'),
    		'land' => $this->input->post('land'),
    		'gemeente' => $this->input->post('gemeente'),
    		'adres' => $this->input->post('adres'),
    		'gebruikersnaam' => $this->input->post('username'),
    		
    		'paswoord' => md5($this->input->post('paswoord')),
    		'datum_creatie' => 'now()'
    	
    	);
    	
    	$insert = $this->db->insert('users', $new_user_insert_data);
    	return $insert;
    
    }
			
			
    
    
}